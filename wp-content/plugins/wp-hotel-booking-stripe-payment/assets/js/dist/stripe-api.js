/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@stripe/stripe-js/dist/stripe.esm.js":
/*!***********************************************************!*\
  !*** ./node_modules/@stripe/stripe-js/dist/stripe.esm.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   loadStripe: () => (/* binding */ loadStripe)
/* harmony export */ });
var V3_URL = 'https://js.stripe.com/v3';
var V3_URL_REGEX = /^https:\/\/js\.stripe\.com\/v3\/?(\?.*)?$/;
var EXISTING_SCRIPT_MESSAGE = 'loadStripe.setLoadParameters was called but an existing Stripe.js script already exists in the document; existing script parameters will be used';
var findScript = function findScript() {
  var scripts = document.querySelectorAll("script[src^=\"".concat(V3_URL, "\"]"));

  for (var i = 0; i < scripts.length; i++) {
    var script = scripts[i];

    if (!V3_URL_REGEX.test(script.src)) {
      continue;
    }

    return script;
  }

  return null;
};

var injectScript = function injectScript(params) {
  var queryString = params && !params.advancedFraudSignals ? '?advancedFraudSignals=false' : '';
  var script = document.createElement('script');
  script.src = "".concat(V3_URL).concat(queryString);
  var headOrBody = document.head || document.body;

  if (!headOrBody) {
    throw new Error('Expected document.body not to be null. Stripe.js requires a <body> element.');
  }

  headOrBody.appendChild(script);
  return script;
};

var registerWrapper = function registerWrapper(stripe, startTime) {
  if (!stripe || !stripe._registerWrapper) {
    return;
  }

  stripe._registerWrapper({
    name: 'stripe-js',
    version: "2.3.0",
    startTime: startTime
  });
};

var stripePromise = null;
var onErrorListener = null;
var onLoadListener = null;

var onError = function onError(reject) {
  return function () {
    reject(new Error('Failed to load Stripe.js'));
  };
};

var onLoad = function onLoad(resolve, reject) {
  return function () {
    if (window.Stripe) {
      resolve(window.Stripe);
    } else {
      reject(new Error('Stripe.js not available'));
    }
  };
};

var loadScript = function loadScript(params) {
  // Ensure that we only attempt to load Stripe.js at most once
  if (stripePromise !== null) {
    return stripePromise;
  }

  stripePromise = new Promise(function (resolve, reject) {
    if (typeof window === 'undefined' || typeof document === 'undefined') {
      // Resolve to null when imported server side. This makes the module
      // safe to import in an isomorphic code base.
      resolve(null);
      return;
    }

    if (window.Stripe && params) {
      console.warn(EXISTING_SCRIPT_MESSAGE);
    }

    if (window.Stripe) {
      resolve(window.Stripe);
      return;
    }

    try {
      var script = findScript();

      if (script && params) {
        console.warn(EXISTING_SCRIPT_MESSAGE);
      } else if (!script) {
        script = injectScript(params);
      } else if (script && onLoadListener !== null && onErrorListener !== null) {
        var _script$parentNode;

        // remove event listeners
        script.removeEventListener('load', onLoadListener);
        script.removeEventListener('error', onErrorListener); // if script exists, but we are reloading due to an error,
        // reload script to trigger 'load' event

        (_script$parentNode = script.parentNode) === null || _script$parentNode === void 0 ? void 0 : _script$parentNode.removeChild(script);
        script = injectScript(params);
      }

      onLoadListener = onLoad(resolve, reject);
      onErrorListener = onError(reject);
      script.addEventListener('load', onLoadListener);
      script.addEventListener('error', onErrorListener);
    } catch (error) {
      reject(error);
      return;
    }
  }); // Resets stripePromise on error

  return stripePromise["catch"](function (error) {
    stripePromise = null;
    return Promise.reject(error);
  });
};
var initStripe = function initStripe(maybeStripe, args, startTime) {
  if (maybeStripe === null) {
    return null;
  }

  var stripe = maybeStripe.apply(undefined, args);
  registerWrapper(stripe, startTime);
  return stripe;
}; // eslint-disable-next-line @typescript-eslint/explicit-module-boundary-types

var stripePromise$1;
var loadCalled = false;

var getStripePromise = function getStripePromise() {
  if (stripePromise$1) {
    return stripePromise$1;
  }

  stripePromise$1 = loadScript(null)["catch"](function (error) {
    // clear cache on error
    stripePromise$1 = null;
    return Promise.reject(error);
  });
  return stripePromise$1;
}; // Execute our own script injection after a tick to give users time to do their
// own script injection.


Promise.resolve().then(function () {
  return getStripePromise();
})["catch"](function (error) {
  if (!loadCalled) {
    console.warn(error);
  }
});
var loadStripe = function loadStripe() {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  loadCalled = true;
  var startTime = Date.now(); // if previous attempts are unsuccessful, will re-load script

  return getStripePromise().then(function (maybeStripe) {
    return initStripe(maybeStripe, args, startTime);
  });
};




/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************************!*\
  !*** ./assets/js/stripe-api.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stripe_stripe_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stripe/stripe-js */ "./node_modules/@stripe/stripe-js/dist/stripe.esm.js");
/**
 * Stripe js handle payment with form mount from Lib Stripe JS
 *
 * @since 1.7.8
 * @version 1.0.0
 */

const wphbStripe = (() => {
  let Stripe;
  let elCheckoutForm;
  let elStripeForm, elPageCheckout;
  const idStripeForm = 'wphb-stripe-iframe-wrap';
  // const idBtnPlaceHolder = 'learn-press-checkout-place-order';
  const idPageCheckout = 'hotel-booking-payment';
  let urlHandle;
  let mountStripeDone = false;
  let errorMessage;
  const fetchAPI = (args, callBack = {}) => {
    fetch(urlHandle, {
      method: 'POST',
      body: args
    }).then(res => res.text()).then(data => {
      console.log(data);
      data = parseJson(data);
      callBack.success(data);
    }).finally(() => {
      callBack.completed();
    }).catch(err => callBack.error(err));
  };
  const parseJson = data => {
    if (typeof data !== 'string') {
      return data;
    }
    const m = String.raw({
      raw: data
    }).match(/<!-- HB_AJAX_START -->(.*)<!-- HB_AJAX_END -->/s);
    try {
      if (m) {
        data = JSON.parse(m[1].replace(/(?:\r\n|\r|\n)/g, ''));
      } else {
        data = JSON.parse(data);
      }
    } catch (e) {
      data = {};
    }
    return data;
  };

  /**
   * Load Stripe JS via publish key
   * then mount form Stripe
   *
   * @return {Promise<void>}
   */
  const mountFormStripe = async () => {
    try {
      Stripe = await (0,_stripe_stripe_js__WEBPACK_IMPORTED_MODULE_0__.loadStripe)(hotel_booking_stripe_params.publish_key || '');

      // Display form Stripe
      const options = {
        clientSecret: hotel_booking_stripe_params.publishableKey || '',
        appearance: {}
      };
      elStripeForm = Stripe.elements(options);

      // Create and mount the Payment Element
      const paymentElement = elStripeForm.create('payment');
      paymentElement.on('loaderror', function (event) {
        errorMessage = event.error.message;
      });
      paymentElement.on('ready', function (event) {
        mountStripeDone = true;
      });
      paymentElement.mount(`#${idStripeForm}`);
    } catch (error) {
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
  const confirmStripePayment = (return_url, callBack) => {
    if (typeof Stripe === 'undefined') {
      console.log('Stripe is not defined');
    }
    if (typeof elStripeForm === 'undefined') {
      console.log('Stripe form not mounted');
    }
    Stripe.confirmPayment({
      elements: elStripeForm,
      confirmParams: {
        return_url
      }
    }).then(function (result) {
      callBack(result);
    });
  };
  const setMessageError = mess_text => {
    const elMessage = `<div class="hb-message message">${mess_text}</div>`;
    elPageCheckout.insertAdjacentHTML('afterbegin', elMessage);
    elPageCheckout.scrollIntoView({
      behavior: 'smooth'
    });
  };
  return {
    init: async () => {
      if ('undefined' === typeof hotel_booking_stripe_params) {
        console.log('Stripe Setting is not defined');
      }
      if ('undefined' === typeof hotel_booking_stripe_params.payment_stripe_via_iframe) {
        return;
      }
      elPageCheckout = document.getElementById(idPageCheckout);
      elCheckoutForm = document.getElementById('hb-payment-form');
      if (!elCheckoutForm) {
        return;
      }
      await mountFormStripe();
    },
    events: () => {
      elCheckoutForm = document.getElementById('hb-payment-form');
      if (!elCheckoutForm) {
        return;
      }
      elCheckoutForm.addEventListener('click', function (e) {
        const target = e.target;
        if (target.classList.contains('hb_button') && target.type == 'submit') {
          const elBtnPlaceHolder = target;
          const formData = new FormData(elCheckoutForm);
          if (formData.get('hb-payment-method') !== 'stripe') {
            return;
          }
          e.preventDefault();
          if (!elPageCheckout) {
            console.error('Page checkout is not defined');
            return;
          }
          const elMes = elPageCheckout.querySelectorAll('.hb-message.message');
          if (elMes.length > 0) {
            elMes.forEach(el => {
              el.remove();
            });
          }
          if ('undefined' !== typeof errorMessage) {
            setMessageError(errorMessage);
            return;
          }
          if ('undefined' === typeof hotel_booking_stripe_params.publishableKey) {
            setMessageError('Stripe Publish Key is generate failed, please check again config key!');
            return;
          }
          if (!mountStripeDone) {
            setMessageError('Stripe payment not load done. Please wait!');
            return;
          }
          elBtnPlaceHolder.classList.add('wphb_loading');
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
          elStripeForm.submit().then(function (result) {
            if ('undefined' !== typeof result.error) {
              return;
            }

            // elBtnPlaceHolder.classList.add( 'loading' );
            elBtnPlaceHolder.disabled = true;
            // elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_processing;

            urlHandle = new URL(hotel_settings.ajax);
            fetchAPI(formData, {
              before: () => {},
              success: res => {
                console.log(res);
                if ('fail' === res.result) {
                  // elBtnPlaceHolder.classList.remove( 'loading' );
                  elBtnPlaceHolder.disabled = false;
                  // elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_place_order;
                  setMessageError(res.message);
                } else if ('success' === res.result) {
                  // elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_redirecting;
                  confirmStripePayment(res.redirect, result => {
                    console.log(result);
                  });
                }
              },
              error: error => {},
              completed: () => {}
            });
          });
        }
      });
    }
  };
})();
document.addEventListener('DOMContentLoaded', () => {
  wphbStripe.init().then(() => {});
});
wphbStripe.events();
})();

/******/ })()
;
//# sourceMappingURL=stripe-api.js.map