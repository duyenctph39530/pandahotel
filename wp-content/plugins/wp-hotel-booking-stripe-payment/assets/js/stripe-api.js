/**
 * Stripe js handle payment with form mount from Lib Stripe JS
 *
 * @since 1.7.8
 * @version 1.0.0
 */
import { loadStripe } from '@stripe/stripe-js';

const wphbStripe = ( () => {
	let Stripe;
	let elCheckoutForm;
	let elStripeForm, elPageCheckout;
	const idStripeForm = 'wphb-stripe-iframe-wrap';
	// const idBtnPlaceHolder = 'learn-press-checkout-place-order';
	const idPageCheckout = 'hotel-booking-payment';
	let urlHandle;
	let mountStripeDone = false;
	let errorMessage;

	const fetchAPI = ( args, callBack = {} ) => {
		fetch( urlHandle, {
			method: 'POST',
			body: args,
		} )
			.then( ( res ) => res.text() )
			.then( ( data ) => {
				console.log( data );
				data = parseJson( data );
				callBack.success( data );
			} )
			.finally( () => {
				callBack.completed();
			} )
			.catch( ( err ) => callBack.error( err ) );
	};

	const parseJson = ( data ) => {
		if ( typeof data !== 'string' ) {
			return data;
		}
		const m = String.raw( { raw: data } ).match( /<!-- HB_AJAX_START -->(.*)<!-- HB_AJAX_END -->/s );
		try {
			if ( m ) {
				data = JSON.parse( m[ 1 ].replace( /(?:\r\n|\r|\n)/g, '' ) );
			} else {
				data = JSON.parse( data );
			}
		} catch (e) {
			data = {};
		}
		return data;
	}

	/**
	 * Load Stripe JS via publish key
	 * then mount form Stripe
	 *
	 * @return {Promise<void>}
	 */
	const mountFormStripe = async () => {
		try {
			Stripe = await loadStripe( hotel_booking_stripe_params.publish_key || '' );

			// Display form Stripe
			const options = {
				clientSecret: hotel_booking_stripe_params.publishableKey || '',
				appearance: {},
			};
			elStripeForm = Stripe.elements( options );

			// Create and mount the Payment Element
			const paymentElement = elStripeForm.create( 'payment' );
			paymentElement.on( 'loaderror', function( event ) {
				errorMessage = event.error.message;
			} );
			paymentElement.on( 'ready', function( event ) {
				mountStripeDone = true;
			} );
			paymentElement.mount( `#${ idStripeForm }` );
		} catch ( error ) {
			errorMessage = error.message;
		}
	};

	/**
	 * Confirm the PaymentIntent with url has parameter "payment_intent"
	 *
	 * https://stripe.com/docs/js/payment_intents/confirm_payment
	 *
	 * @param  return_url
	 * @param  callBack
	 */
	const confirmStripePayment = ( return_url, callBack ) => {
		if ( typeof Stripe === 'undefined' ) {
			console.log( 'Stripe is not defined' );
		}
		if ( typeof elStripeForm === 'undefined' ) {
			console.log( 'Stripe form not mounted' );
		}

		Stripe.confirmPayment( {
			elements: elStripeForm,
			confirmParams: {
				return_url,
			},
		} ).then( function( result ) {
			callBack( result );
		} );
	};
	const setMessageError = ( mess_text ) => {
		const elMessage = `<div class="hb-message message">${ mess_text }</div>`;
		elPageCheckout.insertAdjacentHTML( 'afterbegin', elMessage );
		elPageCheckout.scrollIntoView( {
			behavior: 'smooth',
		} );
	};

	return {
		init: async () => {
			if ( 'undefined' === typeof hotel_booking_stripe_params ) {
				console.log( 'Stripe Setting is not defined' );
			}

			if ( 'undefined' === typeof hotel_booking_stripe_params.payment_stripe_via_iframe ) {
				return;
			}

			elPageCheckout = document.getElementById( idPageCheckout );
			elCheckoutForm = document.getElementById( 'hb-payment-form' );
			if ( ! elCheckoutForm ) {
				return;
			}

			await mountFormStripe();
		},
		events: () => {
			elCheckoutForm = document.getElementById( 'hb-payment-form' );
			if ( ! elCheckoutForm ) {
				return;
			}
			elCheckoutForm.addEventListener( 'click', function( e ) {
				const target = e.target;

				if ( target.classList.contains( 'hb_button' ) && target.type == 'submit' ) {
					const elBtnPlaceHolder = target;
					const formData = new FormData( elCheckoutForm );
					if ( formData.get( 'hb-payment-method' ) !== 'stripe' ) {
						return;
					}
					e.preventDefault();

					if ( ! elPageCheckout ) {
						console.error( 'Page checkout is not defined' );
						return;
					}

					const elMes = elPageCheckout.querySelectorAll( '.hb-message.message' );
					if ( elMes.length > 0 ) {
						elMes.forEach( ( el ) => {
							el.remove();
						} );
					}

					if ( 'undefined' !== typeof errorMessage ) {
						setMessageError( errorMessage );
						return;
					}

					if ( 'undefined' === typeof hotel_booking_stripe_params.publishableKey ) {
						setMessageError( 'Stripe Publish Key is generate failed, please check again config key!' );
						return;
					}

					if ( ! mountStripeDone ) {
						setMessageError( 'Stripe payment not load done. Please wait!' );

						return;
					}

					elBtnPlaceHolder.classList.add( 'wphb_loading' );
					elBtnPlaceHolder.innerText = hotel_booking_stripe_params.button_processing;

					/**
					 * Submit form Stripe to check valid fields
					 * https://stripe.com/docs/js/elements/submit
					 *
					 * When check all fields is valid, will submit checkout to create order,
					 * then pass url lp order to confirmStripePayment() to call Stripe API,
					 * Stripe API will return url redirect has parameter "payment_intent",
					 * server will catch it and check if payment_intent is valid, LP Order will set to Complete
					 */
					elStripeForm.submit()
						.then( function( result ) {
							if ( 'undefined' !== typeof result.error ) {
								return;
							}

							// elBtnPlaceHolder.classList.add( 'loading' );
							elBtnPlaceHolder.disabled = true;
							// elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_processing;

							urlHandle = new URL( hotel_settings.ajax );

							fetchAPI( formData, {
								before: () => {},
								success: ( res ) => {
									console.log(res);
									if ( 'fail' === res.result ) {
										// elBtnPlaceHolder.classList.remove( 'loading' );
										elBtnPlaceHolder.disabled = false;
										// elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_place_order;
										setMessageError( res.message );
									} else if ( 'success' === res.result ) {
										// elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_redirecting;
										confirmStripePayment( res.redirect, ( result ) => {
											console.log( result );
										} );
									}
								},
								error: ( error ) => {},
								completed: () => {},
							} );
						} );
				}
			} );
		},
	};
} )();

document.addEventListener( 'DOMContentLoaded', () => {
	wphbStripe.init().then( () => {} );
} );

wphbStripe.events();
