<?php
/**
 * Plugin Name: WP Hotel Booking Stripe Payment
 * Plugin URI: http://thimpress.com/
 * Description: Stripe payment gateway for WP Hotel Booking
 * Author: ThimPress
 * Version: 1.7.8
 * Requires at least: 6.3
 * Requires PHP: 7.4
 * Author URI: http://thimpress.com
 * Tags: wphb
 * Text Domain: wp-hotel-booking-stripe
 */

define( 'TP_HB_STRIPE_DIR', plugin_dir_path( __FILE__ ) );
define( 'TP_HB_STRIPE_URI', plugins_url( '', __FILE__ ) );
// const TP_HB_STRIPE_PAYMENT_FILE = __FILE__;
//define( 'TP_HB_STRIPE_VER', '1.7.6' );

if ( ! class_exists( 'WP_Hotel_Booking_Payment_Stripe' ) ) {
	/**
	 * Class WP_Hotel_Booking_Payment_Stripe
	 */
	class WP_Hotel_Booking_Payment_Stripe {

		protected static $_instance = null;

		/**
		 * @var bool
		 */
		public $is_hotel_active = false;

		/**
		 * @var string
		 */
		public $slug = 'stripe';

		/**
		 * WP_Hotel_Booking_Payment_Stripe constructor.
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'is_hotel_active' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			if ( ! is_admin() ) {
				add_action( 'init', array( $this, 'check_stripe_payment' ) );
			}
		}

		/**
		 * Check hotel booking activated.
		 */
		public function is_hotel_active() {
			if ( ! function_exists( 'is_plugin_active' ) ) {
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if ( ( class_exists( 'TP_Hotel_Booking' ) && is_plugin_active( 'tp-hotel-booking/tp-hotel-booking.php' ) ) || ( is_plugin_active( 'wp-hotel-booking/wp-hotel-booking.php' ) && class_exists( 'WP_Hotel_Booking' ) ) ) {
				$this->is_hotel_active = true;
			}

			if ( ! $this->is_hotel_active ) {
				add_action( 'admin_notices', array( $this, 'add_notices' ) );
			} else {
				// add payment
				add_filter( 'hb_payment_gateways', array( $this, 'add_payment_classes' ) );
				if ( $this->is_hotel_active ) {
					require_once TP_HB_STRIPE_DIR . '/vendor/autoload.php';

					require_once TP_HB_STRIPE_DIR . '/inc/class-hb-payment-gateway-stripe.php';
				}
			}

			$this->load_text_domain();
		}

		/**
		 * Load text domain.
		 */
		public function load_text_domain() {
			$default     = WP_LANG_DIR . '/plugins/wp-hotel-booking-stripe-' . get_locale() . '.mo';
			$plugin_file = TP_HB_STRIPE_DIR . '/languages/wp-hotel-booking-stripe-' . get_locale() . '.mo';
			if ( file_exists( $default ) ) {
				$file = $default;
			} else {
				$file = $plugin_file;
			}
			if ( $file ) {
				load_textdomain( 'wp-hotel-booking-stripe', $file );
			}
		}

		/**
		 * Filter callback add payments.
		 *
		 * @param $payments
		 *
		 * @return mixed
		 */
		public function add_payment_classes( $payments ) {
			if ( array_key_exists( $this->slug, $payments ) ) {
				return $payments;
			}

			$payments[ $this->slug ] = HB_Payment_Gateway_Stripe::instance();

			return $payments;
		}

		/**
		 * Notices missing WP Hotel Booking plugin.
		 */
		public function add_notices() {
			?>
			<div class="error">
				<p><?php _e( 'The <strong>WP Hotel Booking</strong> is not installed and/or activated. Please install and/or activate before you can using <strong>WP Hotel Booking Stripe Payment</strong> add-on.' ); ?></p>
			</div>
			<?php
		}

		/**
		 * Enqueue scripts.
		 */
		public function enqueue_scripts() {
			if ( ! class_exists( 'WPHB_Settings' ) ) {
				return;
			}
			// stripe and checkout assets

			$setting = WPHB_Settings::instance()->get( 'stripe' );

			$ver = '1.7.8';
			$min = '.min';
			if ( WPHB_DEBUG ) {
				$min = '';
				$ver = uniqid();
			}

			wp_register_script(
				'wphb-stripe-action-js',
				TP_HB_STRIPE_URI . '/assets/js/dist/stripe-api' . $min . '.js',
				array(),
				$ver,
				array(
					'in_footer' => true,
					'strategy'  => 'defer',
				)
			);

			if ( ! empty( $setting['enable'] ) && $setting['enable'] == 'on' && $setting['checkout_on_stripe'] == 'off' ) {

				// stripe
				$test_publish_key = $setting['test_publish_key'];
				$live_publish_key = $setting['live_publish_key'];
				$publish_key      = $setting['test_mode'] == 'on' ? $test_publish_key : $live_publish_key;
				wp_enqueue_script( 'wphb-stripe-action-js' );

				$data_localize  = array(
					'publish_key'       => $publish_key,
					'button_verify'     => esc_html__( 'Checkout', 'wp-hotel-booking-stripe' ),
					'button_processing' => esc_html__( 'Processing', 'wp-hotel-booking-stripe' ),
					'error_verify'      => esc_html__( 'Unable to process this payment, please try again or use alternative method.', 'wp-hotel-booking-stripe' ),
					'',
				);
				$wphb_stripe    = HB_Payment_Gateway_Stripe::instance();
				$payment_intent = $wphb_stripe->create_payment_intent();
				if ( 'object' === gettype( $payment_intent ) ) {
					$data_localize['publishableKey'] = $payment_intent->client_secret;
				}
				$data_localize['payment_stripe_via_iframe'] = 1;

				wp_localize_script( 'wphb-stripe-action-js', 'hotel_booking_stripe_params', $data_localize );
			}
		}

		/**
		 * [check_stripe_payment check payment status]
		 * @thrown Exceptions
		 */
		public function check_stripe_payment() {
			try {
				$wphb_stripe = HB_Payment_Gateway_Stripe::instance();
				if ( $wphb_stripe->checkout_on_stripe() ) {
					if ( isset( $_GET['wphb_stripe_session_id'] ) ) {
						$session_id = sanitize_text_field( $_GET['wphb_stripe_session_id'] );
						$wphb_stripe->retrieve_stripe_session( $session_id );
					}
				} else {
					if ( isset( $_GET['wphb-stripe-confirm-payment'] ) ) {
						if ( isset( $_GET['payment_intent'] ) ) {
							$payment_intent = sanitize_text_field( $_GET['payment_intent'] );
							$wphb_stripe->stripe_retrieve_payment_intent( $payment_intent );
						}
					}
				}
			} catch ( Throwable $e ) {
				error_log( $e->getMessage() );
			}
		}

		public static function instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

WP_Hotel_Booking_Payment_Stripe::instance();
