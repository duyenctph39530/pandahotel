<?php
/**
 * HB_WPML_Support
 *
 * @author   ThimPress
 * @package  WP-Hotel-Booking/Stripe/Classes
 * @version  1.7.3
 */

// Prevent loading this file directly
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'HB_Payment_Gateway_Stripe' ) ) {
	/**
	 * Class HB_Payment_Gateway_Stripe
	 */
	class HB_Payment_Gateway_Stripe extends WPHB_Payment_Gateway_Base {

		protected static $_instance = null;

		/**
		 * @var array
		 */
		protected $_settings = array();

		/**
		 * @var string
		 */
		public $slug = 'stripe';

		/**
		 * @var string
		 */
		protected $_api_endpoint = '';

		/**
		 * protected strip secret
		 */
		protected $_stripe_secret = null;

		/**
		 * @var mixed|null
		 */
		protected $_stripe_publish = null;

		/**
		 * @var null
		 */
		protected $_stripe = null;

		/**
		 * Request Token
		 *
		 * @var string
		 */
		protected $source = null;

		// /**
		//  * @var null
		//  */
		// protected $intent_id = null;

		/**
		 * HB_Payment_Gateway_Stripe constructor.
		 */
		public function __construct() {
			parent::__construct();
			$this->_title       = __( 'Stripe', 'wp-hotel-booking-stripe' );
			$this->_description = __( 'Pay with Stripe', 'wp-hotel-booking-stripe' );
			$this->_settings    = maybe_unserialize( WPHB_Settings::instance()->get( 'stripe' ) );

			$debug = ( ! isset( $this->_settings['test_mode'] ) || $this->_settings['test_mode'] === 'on' ) ? true : false;
			if ( ! isset( $this->_settings['test_secret_key'] ) || ! $this->_settings['test_secret_key'] ) {
				$this->_settings['test_secret_key'] = 'sk_test_NRayUQ1DIth4X091iEH9qzaq';
			}

			if ( ! isset( $this->_settings['test_publish_key'] ) || ! $this->_settings['test_publish_key'] ) {
				$this->_settings['test_publish_key'] = 'pk_test_HHukcwWCsD7qDFWKKpKdJeOT';
			}

			if ( ! isset( $this->_settings['live_secret_key'] ) || ! $this->_settings['live_secret_key'] ) {
				$this->_settings['live_secret_key'] = 'pk_test_HHukcwWCsD7qDFWKKpKdJeOT';
			}

			if ( ! isset( $this->_settings['live_publish_key'] ) || ! $this->_settings['live_publish_key'] ) {
				$this->_settings['live_publish_key'] = 'pk_live_n5AVJxHj8XSFV4HsPIaiFgo3';
			}

			$this->_stripe_secret  = $debug ? $this->_settings['test_secret_key'] : $this->_settings['live_secret_key'];
			$this->_stripe_publish = ( ! isset( $this->_settings['test_mode'] ) || $this->_settings['test_mode'] === 'on' ) ? $this->_settings['test_publish_key'] : $this->_settings['live_publish_key'];

			// add_action( 'hotel_booking_before_checkout_form', array( $this, 'htb_stripe_publish_key' ) );

			// add_action('wp_ajax_verify_intent_after_checkout', array($this,'verify_intent_after_checkout'));

			// add_action('wp_ajax_nopriv_verify_intent_after_checkout',array($this,'verify_intent_after_checkout'));

			// $this->_api_endpoint = 'https://api.stripe.com/v1';
			$this->init();
		}

		/**
		 * Init.
		 */
		public function init() {
			add_action( 'hb_payment_gateway_form_' . $this->slug, array( $this, 'form' ) );
		}

		/**
		 * Admin settings.
		 */
		public function admin_settings() {
			include_once TP_HB_STRIPE_DIR . '/inc/views/strip-settings.php';
		}

		/**
		 * @return bool
		 */
		public function is_enable() {
			return ! empty( $this->_settings['enable'] ) && $this->_settings['enable'] == 'on';
		}

		public function checkout_on_stripe() {
			return ! empty( $this->_settings['checkout_on_stripe'] ) && $this->_settings['checkout_on_stripe'] == 'on';
		}

		/**
		 * @param null $booking_id
		 * @throws Exception
		 *
		 * @return array
		 */
		public function process_checkout( $booking_id = null ) {
			$cart        = WPHB_Cart::instance();
			$advance_pay = $cart->get_advance_payment();
			$cart_total  = $cart->get_total();
			if ( ! hb_get_request( 'pay_all' ) ) {
				// when advance pay setting = 0%, amount is cart total
				$amount_total = $advance_pay > 0 ? $advance_pay : $cart_total;
			} else {
				$amount_total = $cart_total;
			}
			if ( $this->checkout_on_stripe() ) {
				$stripe_url = $this->get_url_payment_on_stripe_page( $booking_id, (float) $amount_total );
				$return     = array(
					'result'   => 'success',
					'redirect' => $stripe_url,
				);
			} else {
				if ( ! session_id() ) {
					session_start();
				}
				$stripe_pi = unserialize( $_SESSION['wphb_stripe_awaiting_payment_intent'] );
				// error_log(json_encode($stripe_pi));
				$pi_id   = $stripe_pi->id;
				$booking = WPHB_Booking::instance( $booking_id );
				$this->update_payment_intent( $pi_id, $booking_id, (float) $amount_total );
				$redirect_url = hb_get_thank_you_url( $booking_id, $booking->booking_key );
				$return       = array(
					'result'   => 'success',
					'redirect' => add_query_arg( 'wphb-stripe-confirm-payment', 1, $redirect_url ),
					'message'  => esc_html__( 'The payment is processing.', 'wp-hotel-booking-stripe' ),
				);
			}

			return $return;
		}

		/**
		 * Get stripe checkout url.
		 * via create a checkout Session
		 * https://stripe.com/docs/api/checkout/sessions/create?lang=php
		 *
		 * @param int $booking_id wphb booking id
		 * @param float $amount_total payment amount
		 * @return string|null
		 * @throws ApiErrorException
		 * @throws Exception
		 * @version 1.0.0
		 * @since 1.7.8
		 */
		public function get_url_payment_on_stripe_page( int $booking_id, float $amount_total ) {

			$booking                 = WPHB_Booking::instance( $booking_id );
			$stripe                  = new StripeClient( $this->_stripe_secret );
			$success_url             = hb_get_thank_you_url( $booking_id, $booking->booking_key );
			$cancel_url              = hb_get_checkout_url();
			$stripe_checkout_session = $stripe->checkout->sessions->create(
				array(
					'line_items'  => array(
						array(
							'price_data' => array(
								'currency'     => strtolower( hb_get_currency() ),
								'product_data' => array(
									'name' => sprintf( __( 'Order %s', 'wp-hotel-booking-stripe' ), $booking->get_booking_number() ),
								),
								'unit_amount'  => $amount_total * 100,
							),
							'quantity'   => 1,
						),
					),
					'mode'        => 'payment',
					'success_url' => add_query_arg( 'wphb_stripe_session_id', '{CHECKOUT_SESSION_ID}', $success_url ),
					'cancel_url'  => $cancel_url,
					'metadata'    => array(
						'wphb_order_id' => $booking_id,
					),
				)
			);

			return $stripe_checkout_session->url;
		}
		/**
		 * Retrieve stripe session.
		 * Check status payment by checkout session id.
		 *
		 * @throws ApiErrorException
		 * @version 1.0.0
		 * @since 1.7.8
		 */
		public function retrieve_stripe_session( string $checkout_session_id ) {
			$stripe   = new StripeClient( $this->_stripe_secret );
			$retrieve = $stripe->checkout->sessions->retrieve( $checkout_session_id );
			$cart     = WPHB_Cart::instance();
			if ( $retrieve->payment_status === Session::PAYMENT_STATUS_PAID ) {
				$booking_id  = $retrieve->metadata->wphb_order_id;
				$booking     = WPHB_Booking::instance( $booking_id );
				$paid_amount = floatval( $retrieve->amount_total ) / 100;
				if ( (float) $paid_amount == (float) $booking->total() ) {
					$booking->update_status( 'completed' );
				} else {
					$booking->update_status( 'processing' );
				}
			}
			$cart->empty_cart();
		}
		/**
		 * Create Stripe payment intent.
		 *
		 * @return Stripe\PaymentIntent|null
		 * @version 1.0.0
		 * @since 1.7.8
		 */
		public function create_payment_intent() {
			$cart           = WPHB_Cart::instance();
			$payment_intent = null;
			try {
				if ( ! $cart ) {
					return $payment_intent;
				}

				$total_amount = $cart->get_total();
				if ( (float) $total_amount <= 0 ) {
					return $payment_intent;
				}
				$stripe         = new StripeClient( $this->_stripe_secret );
				$payment_intent = $stripe->paymentIntents->create(
					array(
						'amount'                    => (float) $total_amount * 100,
						'currency'                  => strtolower( hb_get_currency() ),
						'automatic_payment_methods' => array( 'enabled' => true ),
					)
				);
				if ( ! session_id() ) {
					session_start();
				}
				$_SESSION['wphb_stripe_awaiting_payment_intent'] = serialize( $payment_intent );

			} catch ( Throwable $e ) {
				error_log( __METHOD__ . $e->getMessage() );
			}
			return $payment_intent;
		}
		/**
		 * Update payment intent Stripe
		 *
		 * @throws ApiErrorException
		 * @version 1.0.0
		 * @since 1.7.8
		 */
		public function update_payment_intent( string $pi, int $booking_id, float $amount_total ) {
			$stripe     = new StripeClient( $this->_stripe_secret );
			$update_arr = array(
				'metadata' => array(
					'wphb_order_id' => $booking_id,
				),
			);
			$cart       = WPHB_Cart::instance();
			if ( $amount_total == (float) $cart->get_advance_payment() ) {
				$update_arr['amount'] = (float) $cart->get_advance_payment() * 100;
			}
			$stripe->paymentIntents->update( $pi, $update_arr );
		}

		/**
		 * Check Stripe payment intent.
		 *
		 * @throws Exception
		 * @version 1.0.0
		 * @since 1.7.8
		 */
		public function stripe_retrieve_payment_intent( $payment_intent ) {
			$stripe                  = new StripeClient( $this->_stripe_secret );
			$payment_intent_retrieve = $stripe->paymentIntents->retrieve( $payment_intent, array() );
			if ( $payment_intent_retrieve->status === 'succeeded' ) {
				$booking_id = $payment_intent_retrieve->metadata->wphb_order_id;
				$booking    = WPHB_Booking::instance( $booking_id );
				if ( ! $booking ) {
					throw new Exception( 'Invalid booking.', 'wp-hotel-booking-stripe' );
				}
				if ( get_post_status( $booking_id ) == 'hb-completed' ) {
					return;
				}
				$paid_amount = floatval( $payment_intent_retrieve->amount_received ) / 100;
				if ( (float) $paid_amount == (float) $booking->total() ) {
					$booking->update_status( 'completed' );
				} else {
					$booking->update_status( 'processing' );
				}
				unset( $_SESSION['wphb_stripe_awaiting_payment_intent'] );
				$cart = WPHB_Cart::instance();
				$cart->empty_cart();
			} else {
				throw new Exception( $payment_intent_retrieve->status );
			}
		}
		/**
		 * @param null $booking_id
		 * @param null $customer
		 *
		 * @return mixed|null|string|WP_Error
		 */
		public function add_customer( $booking_id = null, $customer = null ) {

			$booking = WPHB_Booking::instance( $booking_id );

			$user_id = $booking->user_id;
			$cus_id  = null;

			if ( ! $cus_id ) {
				// create customer
				try {
					$convert      = array(
						'type'  => 'card',
						'token' => sanitize_text_field( $_POST['id'] ),
					);
					$test_convert = $this->stripe_request( $convert, 'sources' );

					$this->source = $test_convert->id;

					$params   = array(
						'description' => sprintf( '%s', $booking->customer_email ),
						'source'      => $this->source, // token get by stripe.js
					);
					$response = $this->stripe_request( $params, 'customers' );
					$cus_id   = $response->id;
					if ( $user_id ) {
						update_user_meta( $user_id, 'tp-hotel-booking-stripe-id', $cus_id );
					} else {
						update_post_meta( $booking_id, 'tp-hotel-booking-stripe-id', $cus_id );
					}
					add_post_meta( $customer, 'tp-hotel-booking-stripe-id', $cus_id );

					return $cus_id;
				} catch ( Exception $e ) {
					return new WP_Error( 'tp-hotel-booking-stripe-error', sprintf( '%s', $e->getMessage() ) );
				}
			}

			return $cus_id;
		}


		/**
		 * Global js.
		 */
		public function htb_stripe_publish_key() {
			//echo '<input type="hidden" name="htb_stripe_secret" value="'.$this->_stripe_secret.'">';
			echo '<input type="hidden" name="htb_stripe_publish" value="' . $this->_stripe_publish . '">';
		}

		/**
		 * Form payment.
		 */
		public function form() {
			// _e( 'Pay with Credit card', 'wp-hotel-booking-stripe' );
			$allowed_html = array(
				'div' => array(
					'class' => array(),
					'id'    => array(),
				),
			);
			echo wp_kses( '<div id="wphb-stripe-iframe-wrap" ></div>', $allowed_html );
			// echo "test";
		}
		/**
		 * Create an instance of the plugin if it is not created
		 *
		 * @static
		 * @return object|WP_Hotel_Booking
		 */
		public static function instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}


add_filter( 'hb_payment_gateways', 'hotel_booking_payment_stripe' );

if ( ! function_exists( 'hotel_booking_payment_stripe' ) ) {
	/**
	 * @param $payments
	 *
	 * @return mixed
	 */
	function hotel_booking_payment_stripe( $payments ) {
		if ( array_key_exists( 'stripe', $payments ) ) {
			return $payments;
		}

		$payments['stripe'] = HB_Payment_Gateway_Stripe::instance();

		return $payments;
	}
}
