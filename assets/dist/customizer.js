(window["webpackJsonp_generatepress"] = window["webpackJsonp_generatepress"] || []).push([["style-customizer"],{

/***/ "./src/customizer-controls/color-picker/style.scss":
/*!*********************************************************!*\
  !*** ./src/customizer-controls/color-picker/style.scss ***!
  \*********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/customizer-controls/font-picker/style.scss":
/*!********************************************************!*\
  !*** ./src/customizer-controls/font-picker/style.scss ***!
  \********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/customizer-controls/range/style.scss":
/*!**************************************************!*\
  !*** ./src/customizer-controls/range/style.scss ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/customizer-controls/select/style.scss":
/*!***************************************************!*\
  !*** ./src/customizer-controls/select/style.scss ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/customizer-controls/text/style.scss":
/*!*************************************************!*\
  !*** ./src/customizer-controls/text/style.scss ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/customizer-controls/toggle/style.scss":
/*!***************************************************!*\
  !*** ./src/customizer-controls/toggle/style.scss ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/style.scss":
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

}]);

/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		"customizer": 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp_generatepress"] = window["webpackJsonp_generatepress"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["./src/customizer.js","style-customizer"]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithHoles.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

module.exports = _arrayWithHoles;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/extends.js":
/*!********************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/extends.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _extends() {
  module.exports = _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  module.exports["default"] = module.exports, module.exports.__esModule = true;
  return _extends.apply(this, arguments);
}

module.exports = _extends;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _iterableToArrayLimit(arr, i) {
  var _i = arr && (typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]);

  if (_i == null) return;
  var _arr = [];
  var _n = true;
  var _d = false;

  var _s, _e;

  try {
    for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

module.exports = _iterableToArrayLimit;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableRest.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableRest.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableRest;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/slicedToArray.js":
/*!**************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/slicedToArray.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayWithHoles = __webpack_require__(/*! ./arrayWithHoles.js */ "./node_modules/@babel/runtime/helpers/arrayWithHoles.js");

var iterableToArrayLimit = __webpack_require__(/*! ./iterableToArrayLimit.js */ "./node_modules/@babel/runtime/helpers/iterableToArrayLimit.js");

var unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray.js */ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js");

var nonIterableRest = __webpack_require__(/*! ./nonIterableRest.js */ "./node_modules/@babel/runtime/helpers/nonIterableRest.js");

function _slicedToArray(arr, i) {
  return arrayWithHoles(arr) || iterableToArrayLimit(arr, i) || unsupportedIterableToArray(arr, i) || nonIterableRest();
}

module.exports = _slicedToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray.js */ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;
module.exports["default"] = module.exports, module.exports.__esModule = true;

/***/ }),

/***/ "./node_modules/classnames/index.js":
/*!******************************************!*\
  !*** ./node_modules/classnames/index.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/* global define */

(function () {
	'use strict';

	var hasOwn = {}.hasOwnProperty;

	function classNames() {
		var classes = [];

		for (var i = 0; i < arguments.length; i++) {
			var arg = arguments[i];
			if (!arg) continue;

			var argType = typeof arg;

			if (argType === 'string' || argType === 'number') {
				classes.push(arg);
			} else if (Array.isArray(arg)) {
				if (arg.length) {
					var inner = classNames.apply(null, arg);
					if (inner) {
						classes.push(inner);
					}
				}
			} else if (argType === 'object') {
				if (arg.toString === Object.prototype.toString) {
					for (var key in arg) {
						if (hasOwn.call(arg, key) && arg[key]) {
							classes.push(key);
						}
					}
				} else {
					classes.push(arg.toString());
				}
			}
		}

		return classes.join(' ');
	}

	if ( true && module.exports) {
		classNames.default = classNames;
		module.exports = classNames;
	} else if (true) {
		// register as 'classnames', consistent with npm package name
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {
			return classNames;
		}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}());


/***/ }),

/***/ "./src/customizer-controls/color-picker/GeneratePressColorControl.js":
/*!***************************************************************************!*\
  !*** ./src/customizer-controls/color-picker/GeneratePressColorControl.js ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressColorControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressColorControlForm */ "./src/customizer-controls/color-picker/GeneratePressColorControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressColorControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
    control.rgbaControlNotifications();
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressColorControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      default: control.params.defaultValue,
      alpha: control.params.alpha
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        // Move this control into the wrapper.
        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  },

  /**
   * Handles notifications.
   *
   * @return {void}
   */
  rgbaControlNotifications: function rgbaControlNotifications() {
    var control = this;
    var code = 'long_title'; // Make sure we have the message before proceeding.

    if (!window._wpCustomizeControlsL10n.cheatin) {
      return;
    }

    var patternTest = RegExp(/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/);
    wp.customize(control.id, function (setting) {
      setting.bind(function (value) {
        value = value.toLowerCase();

        if (false === patternTest.test(value) && !value.includes('var')) {
          setting.notifications.add(code, new wp.customize.Notification(code, {
            type: 'warning',
            message: window._wpCustomizeControlsL10n.cheatin
          }));
        } else {
          setting.notifications.remove(code);
        }
      });
    });
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressColorControl);

/***/ }),

/***/ "./src/customizer-controls/color-picker/GeneratePressColorControlForm.js":
/*!*******************************************************************************!*\
  !*** ./src/customizer-controls/color-picker/GeneratePressColorControlForm.js ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/slicedToArray */ "./node_modules/@babel/runtime/helpers/slicedToArray.js");
/* harmony import */ var _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");
/* harmony import */ var classnames__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(classnames__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/color-picker/style.scss");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);








var GeneratePressColorControlForm = function GeneratePressColorControlForm(props) {
  var _useState = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState2 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState, 2),
      isOpen = _useState2[0],
      setOpen = _useState2[1];

  var _useState3 = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["useState"])(false),
      _useState4 = _babel_runtime_helpers_slicedToArray__WEBPACK_IMPORTED_MODULE_0___default()(_useState3, 2),
      colorKey = _useState4[0],
      setColorKey = _useState4[1];
  /**
   * Save the value when changing the colorpicker.
   *
   * @param {Object} color - The color object from react-color.
   * @return {void}
   */


  var handleChangeComplete = function handleChangeComplete(color) {
    wp.customize.control(props.customizerSetting.id).setting.set(color);
  };

  var toggleVisible = function toggleVisible() {
    setOpen(true);
  };

  var toggleClose = function toggleClose() {
    setOpen(false);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", {
    className: "description customize-control-description",
    dangerouslySetInnerHTML: {
      __html: props.description
    }
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["BaseControl"], {
    className: "generate-component-color-picker-wrapper"
  }, !!props.label && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "generate-color-component-label"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("span", null, props.label)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "generate-color-picker-area"
  }, !isOpen && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: classnames__WEBPACK_IMPORTED_MODULE_2___default()('components-color-palette__item-wrapper components-circular-option-picker__option-wrapper', props.value ? '' : 'components-color-palette__custom-color')
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["Tooltip"], {
    text: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Choose Color', 'generatepress'),
    position: "top left"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("button", {
    type: "button",
    "aria-expanded": isOpen,
    className: "components-color-palette__item components-circular-option-picker__option",
    onClick: toggleVisible,
    "aria-label": Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Custom color picker', 'generatepress'),
    style: {
      color: props.value ? props.value : 'transparent'
    }
  }))), isOpen && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: classnames__WEBPACK_IMPORTED_MODULE_2___default()('components-color-palette__item-wrapper components-circular-option-picker__option-wrapper', props.value ? '' : 'components-color-palette__custom-color')
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["Tooltip"], {
    text: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Choose Color', 'generatepress')
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("button", {
    type: "button",
    "aria-expanded": isOpen,
    className: "components-color-palette__item components-circular-option-picker__option",
    onClick: toggleClose,
    "aria-label": Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Custom color picker', 'generatepress'),
    style: {
      color: props.value ? props.value : 'transparent'
    }
  }))), isOpen && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["Popover"], {
    position: "bottom left",
    className: "generate-component-color-picker",
    onClose: toggleClose,
    focusOnMount: "container"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["BaseControl"], {
    key: colorKey
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["ColorPicker"], {
    key: colorKey,
    color: props.value ? props.value : '',
    onChangeComplete: function onChangeComplete(color) {
      var colorString;

      if ('undefined' === typeof color.rgb || color.rgb.a === 1) {
        colorString = color.hex;
      } else {
        var _color$rgb = color.rgb,
            r = _color$rgb.r,
            g = _color$rgb.g,
            b = _color$rgb.b,
            a = _color$rgb.a;
        colorString = "rgba(".concat(r, ", ").concat(g, ", ").concat(b, ", ").concat(a, ")");
      }

      handleChangeComplete(colorString);
    },
    disableAlpha: !props.alpha
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])("div", {
    className: "generate-color-input-wrapper"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["TextControl"], {
    id: "generate-color-input-field",
    className: "generate-color-input",
    type: 'text',
    value: props.value || '',
    onChange: function onChange(color) {
      handleChangeComplete(color);
    },
    onBlur: function onBlur() {
      setColorKey(props.value);
    }
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["Button"], {
    isSmall: true,
    isSecondary: true,
    className: "components-color-clear-color",
    onClick: function onClick() {
      var defaultValue = props.defaultValue ? props.defaultValue : '';
      wp.customize.control(props.customizerSetting.id).setting.set(defaultValue);
      setColorKey(defaultValue);
      setTimeout(function () {
        document.querySelector('.generate-color-input-wrapper input').focus();
      }, 10);
    }
  }, Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Default', 'generatepress')))), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["BaseControl"], {
    className: "generate-component-color-picker-palette"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["ColorPalette"], {
    colors: generateCustomizerControls.palette,
    value: props.value,
    onChange: function onChange(color) {
      handleChangeComplete(color);
      setColorKey(color);
    },
    disableCustomColors: true,
    clearable: false
  }))))));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressColorControlForm);

/***/ }),

/***/ "./src/customizer-controls/color-picker/index.js":
/*!*******************************************************!*\
  !*** ./src/customizer-controls/color-picker/index.js ***!
  \*******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressColorControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressColorControl */ "./src/customizer-controls/color-picker/GeneratePressColorControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-color-control'] = _GeneratePressColorControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer-controls/font-picker/GeneratePressFontFamilyControl.js":
/*!*******************************************************************************!*\
  !*** ./src/customizer-controls/font-picker/GeneratePressFontFamilyControl.js ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressFontFamilyControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressFontFamilyControlForm */ "./src/customizer-controls/font-picker/GeneratePressFontFamilyControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressFontFamilyControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressFontFamilyControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      defaultValue: control.params.defaultValue
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        // Move this control into the wrapper.
        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressFontFamilyControl);

/***/ }),

/***/ "./src/customizer-controls/font-picker/GeneratePressFontFamilyControlForm.js":
/*!***********************************************************************************!*\
  !*** ./src/customizer-controls/font-picker/GeneratePressFontFamilyControlForm.js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _google_fonts_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./google-fonts.json */ "./src/customizer-controls/font-picker/google-fonts.json");
var _google_fonts_json__WEBPACK_IMPORTED_MODULE_1___namespace = /*#__PURE__*/__webpack_require__.t(/*! ./google-fonts.json */ "./src/customizer-controls/font-picker/google-fonts.json", 1);
/* harmony import */ var _utils_get_font_weights__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/get-font-weights */ "./src/utils/get-font-weights/index.js");
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/font-picker/style.scss");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);







var GeneratePressFontFamilyControlForm = function GeneratePressFontFamilyControlForm(props) {
  /**
   * Save the value when changing the control.
   *
   * @param {Object} value - The value.
   * @return {void}
   */
  var handleChangeComplete = function handleChangeComplete(value) {
    wp.customize.control(props.customizerSetting.id).setting.set(value);
  };

  var onFontShortcut = function onFontShortcut(event) {
    wp.customize.control(props.customizerSetting.id).setting.set(event.target.value);
    onFontChange(event.target.value);
  };

  var fontWeightSettingId = props.customizerSetting.id.replace('family', 'weight');
  var googleFontSettingId = props.customizerSetting.id.replace('family', 'google');
  var fontCategoryId = props.customizerSetting.id.replace('family', 'category');
  var fontVariantsId = props.customizerSetting.id.replace('family', 'variants');
  var fonts = [{
    value: '',
    label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Quick select…', 'generateblocks')
  }, {
    value: 'default',
    label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Default', 'generateblocks')
  }, {
    value: 'Arial',
    label: 'Arial'
  }, {
    value: 'Helvetica',
    label: 'Helvetica'
  }, {
    value: 'Times New Roman',
    label: 'Times New Roman'
  }, {
    value: 'Georgia',
    label: 'Georgia'
  }];
  Object.keys(_google_fonts_json__WEBPACK_IMPORTED_MODULE_1__).slice(0, 20).forEach(function (k) {
    fonts.push({
      value: k,
      label: k
    });
  });

  var onFontChange = function onFontChange(value) {
    if ('default' === value) {
      value = props.defaultValue;
    }

    wp.customize.control(props.customizerSetting.id).setting.set(value);
    var fontWeightControl = wp.customize.control(fontWeightSettingId);

    if (fontWeightControl) {
      var fontWeight = fontWeightControl.setting.get(); // Temporarily set font weight setting to force it to re-render with font-family specific values.

      fontWeightControl.setting.set('refresh');

      if (fontWeight && Object.values(Object(_utils_get_font_weights__WEBPACK_IMPORTED_MODULE_2__["default"])(value)).indexOf(fontWeight) < 0) {
        fontWeightControl.setting.set('');
      } else {
        fontWeightControl.setting.set(fontWeight);
      }
    }

    if (typeof _google_fonts_json__WEBPACK_IMPORTED_MODULE_1__[value] !== 'undefined') {
      wp.customize.control(googleFontSettingId).setting.set(true);
      wp.customize.control(fontCategoryId).setting.set(_google_fonts_json__WEBPACK_IMPORTED_MODULE_1__[value].category);
      wp.customize.control(fontVariantsId).setting.set(_google_fonts_json__WEBPACK_IMPORTED_MODULE_1__[value].variants.join(', '));
    } else {
      wp.customize.control(googleFontSettingId).setting.set(false);
      wp.customize.control(fontCategoryId).setting.set('');
      wp.customize.control(fontVariantsId).setting.set('');
    }
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", {
    className: "description customize-control-description",
    dangerouslySetInnerHTML: {
      __html: props.description
    }
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["BaseControl"], {
    className: "generate-component-font-family-picker-wrapper",
    label: !!props.label ? props.label : null,
    id: "generate-font-family-field"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("select", {
    className: "components-select-control__input components-select-control__input--generate-fontfamily",
    onChange: function onChange(value) {
      onFontShortcut(value);
    },
    onBlur: function onBlur() {// do nothing
    }
  }, fonts.map(function (option, index) {
    return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("option", {
      key: "".concat(option.label, "-").concat(option.value, "-").concat(index),
      value: option.value
    }, option.label);
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__["TextControl"], {
    id: "generate-font-family-field",
    value: props.value,
    help: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Font family name', 'generatepress'),
    onChange: handleChangeComplete
  })));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressFontFamilyControlForm);

/***/ }),

/***/ "./src/customizer-controls/font-picker/google-fonts.json":
/*!***************************************************************!*\
  !*** ./src/customizer-controls/font-picker/google-fonts.json ***!
  \***************************************************************/
/*! exports provided: Roboto, Open Sans, Noto Sans JP, Lato, Montserrat, Roboto Condensed, Source Sans Pro, Oswald, Poppins, Roboto Mono, Noto Sans, Raleway, PT Sans, Roboto Slab, Merriweather, Ubuntu, Playfair Display, Nunito, Noto Sans KR, Open Sans Condensed, Rubik, Lora, Work Sans, Mukta, Noto Sans TC, Nunito Sans, PT Serif, Nanum Gothic, Inter, Fira Sans, Noto Serif, Quicksand, Titillium Web, Hind Siliguri, Karla, Barlow, Inconsolata, Heebo, Noto Sans SC, Oxygen, Source Code Pro, Anton, Josefin Sans, Arimo, PT Sans Narrow, IBM Plex Sans, Dosis, Noto Sans HK, Libre Franklin, Libre Baskerville, Cabin, Hind, Bitter, Crimson Text, Bebas Neue, Lobster, Yanone Kaffeesatz, Dancing Script, Cairo, Abel, Fjalla One, Varela Round, Source Serif Pro, Arvo, EB Garamond, Barlow Condensed, Architects Daughter, Zilla Slab, Indie Flower, Mulish, Comfortaa, DM Sans, Pacifico, Exo 2, Kanit, Prompt, Shadows Into Light, Questrial, Merriweather Sans, Teko, Balsamiq Sans, Asap, Hind Madurai, Cormorant Garamond, Antic Slab, Archivo Narrow, Overpass, Abril Fatface, Slabo 27px, Exo, Assistant, Maven Pro, Domine, Fira Sans Condensed, Caveat, Rajdhani, IBM Plex Serif, Martel, Play, Amatic SC, Bree Serif, Tajawal, Noto Serif JP, Righteous, Satisfy, Signika, Catamaran, Acme, Manrope, Fredoka One, Nanum Myeongjo, ABeeZee, Amiri, Patrick Hand, PT Sans Caption, Archivo, Alfa Slab One, Cinzel, Crete Round, Permanent Marker, Alegreya Sans, Almarai, Barlow Semi Condensed, Russo One, Vollkorn, Sarabun, Krona One, M PLUS Rounded 1c, Noticia Text, Courgette, Monda, Alegreya, Frank Ruhl Libre, Patua One, Ubuntu Condensed, Great Vibes, Quattrocento Sans, M PLUS 1p, Spartan, Yantramanav, Lobster Two, Archivo Black, Kaushan Script, Tinos, Cardo, Orbitron, Sacramento, IBM Plex Mono, Francois One, Luckiest Guy, Gothic A1, Kalam, Parisienne, Gloria Hallelujah, Didact Gothic, Cantarell, Press Start 2P, Jost, Rokkitt, Paytone One, Prata, Baloo 2, Cuprum, Chivo, Encode Sans, News Cycle, Old Standard TT, Hind Guntur, Pathway Gothic One, Red Hat Display, Public Sans, Secular One, Volkhov, Concert One, Asap Condensed, Montserrat Alternates, Ropa Sans, Josefin Slab, Poiret One, Passion One, Padauk, Changa, Saira Condensed, Ultra, Quattrocento, Arapey, Vidaloka, Playfair Display SC, Cookie, Chakra Petch, Istok Web, Cormorant, DM Serif Display, Neuton, Spectral, Sawarabi Mincho, Lemonada, Yellowtail, Handlee, Merienda, Philosopher, Sanchez, Hammersmith One, Special Elite, Economica, Staatliches, Sriracha, Hind Vadodara, Monoton, Ruda, Advent Pro, Saira, Homemade Apple, Sigmar One, Mitr, Bangers, Khand, Faustina, Saira Semi Condensed, Cabin Condensed, Gudea, Fira Sans Extra Condensed, DM Serif Text, El Messiri, Electrolize, Taviraj, PT Mono, Gentium Basic, Space Mono, Alice, Unica One, Ubuntu Mono, Pragati Narrow, Noto Serif TC, Amaranth, Karma, Actor, Nanum Pen Script, Noto Serif SC, Tangerine, Carter One, Neucha, Unna, Pontano Sans, Bai Jamjuree, Marck Script, BenchNine, Fugaz One, Yeseva One, Eczar, Bad Script, Viga, Gentium Book Basic, Jura, Allura, Palanquin, Sawarabi Gothic, Rock Salt, Lusitana, Alef, Julius Sans One, Tenor Sans, Nothing You Could Do, Cutive Mono, Khula, Adamina, Playball, Audiowide, Jaldi, Black Ops One, Signika Negative, Shadows Into Light Two, Armata, Mali, Antic, Varela, Berkshire Swash, Aleo, Gelasio, Rufina, Markazi Text, Nanum Gothic Coding, Allan, Noto Serif KR, Abhaya Libre, Quantico, Marcellus, Sorts Mill Goudy, Alata, Knewave, Alex Brush, Aclonica, Gruppo, Damion, Itim, Bungee, Gochi Hand, Mr Dafoe, Freckle Face, Baloo Chettan 2, Trirong, Kosugi Maru, Rubik Mono One, Fira Mono, Cantata One, Suez One, Niconne, Six Caps, Miriam Libre, Sarala, Sintony, Titan One, Encode Sans Condensed, Cousine, PT Serif Caption, Courier Prime, Overlock, Allerta, Arsenal, Black Han Sans, Squada One, Lateef, Arima Madurai, Ramabhadra, Covered By Your Grace, Martel Sans, Rancho, Enriqueta, Syncopate, Pinyon Script, Chewy, Oleo Script, Kreon, Candal, Spinnaker, Reem Kufi, Krub, Michroma, Annie Use Your Telescope, Lilita One, Coda, Fredericka the Great, Mukta Malar, Bowlby One SC, Average, Londrina Solid, New Tegomin, Glegoo, Pridi, Boogaloo, Red Hat Text, Aldrich, Basic, Capriola, Forum, Reenie Beanie, Laila, Alegreya Sans SC, Share Tech Mono, Italianno, Lalezar, Lexend Deca, Caveat Brush, Shrikhand, Creepster, Kameron, Coda Caption, Goudy Bookletter 1911, Coming Soon, Saira Extra Condensed, Yrsa, Telex, Bevan, Voltaire, Days One, Cabin Sketch, Norican, Rambla, Mukta Vaani, Average Sans, Arbutus Slab, Sansita, Mada, Just Another Hand, Nobile, Gilda Display, VT323, Mandali, Caudex, Anonymous Pro, Bentham, Overpass Mono, Sen, Kadwa, Cambay, Yesteryear, Molengo, Nixie One, Scada, Crimson Pro, Arizonia, Racing Sans One, Scheherazade, Seaweed Script, Belleza, Harmattan, Leckerli One, Ovo, Merienda One, Holtwood One SC, Cinzel Decorative, Literata, Mrs Saint Delafield, Schoolbell, Bungee Inline, Herr Von Muellerhoff, Oranienbaum, Baloo Tamma 2, Sniglet, Bubblegum Sans, Rochester, Judson, Marcellus SC, Darker Grotesque, Changa One, Alegreya SC, Pattaya, Mallanna, Share, Podkova, Allerta Stencil, Charm, Niramit, Halant, Graduate, Nanum Brush Script, Amita, Rozha One, Kristi, Biryani, Lustria, Delius, Suranna, Amethysta, Contrail One, Averia Serif Libre, Do Hyeon, IBM Plex Sans Condensed, Marvel, Rye, Fauna One, Corben, Cedarville Cursive, Jockey One, Libre Caslon Text, Carrois Gothic, Calligraffitti, Trocchi, Spectral SC, Coustard, Copse, Athiti, Carme, Rosario, Limelight, Jua, Petit Formal Script, Love Ya Like A Sister, GFS Didot, Aladin, Palanquin Dark, Amiko, Cormorant Infant, Wallpoet, Magra, Grand Hotel, Sunflower, Big Shoulders Display, Slabo 13px, Pangolin, Mr De Haviland, K2D, Marmelad, Thasadith, La Belle Aurore, Hanuman, Metrophobic, Epilogue, Radley, Poly, Commissioner, Averia Libre, IM Fell Double Pica, Comic Neue, Baskervville, Kelly Slab, Oxygen Mono, Maitree, Buenard, Duru Sans, Baloo Da 2, Grandstander, Balthazar, ZCOOL XiaoWei, Cutive, Antic Didone, Waiting for the Sunrise, B612 Mono, Chonburi, Montaga, UnifrakturMaguntia, Kosugi, Gravitas One, Mirza, Manjari, Alike, Lekton, Sora, Gabriela, Lemon, Esteban, Alatsi, Turret Road, Monsieur La Doulaise, Pompiere, Cormorant SC, Kurale, Frijole, Rammetto One, Chelsea Market, Megrim, IM Fell English, Oregano, Andada, Mate, Convergence, Rouge Script, Bowlby One, Emilys Candy, Wendy One, Fira Code, Dawning of a New Day, Sue Ellen Francisco, Gurajada, David Libre, Sofia, Short Stack, Chau Philomene One, Bellefair, Belgrano, Expletus Sans, Original Surfer, Doppio One, Be Vietnam, Sail, Inder, Give You Glory, IM Fell DW Pica, McLaren, Encode Sans Semi Condensed, Bungee Shade, Baumans, Brawler, Tenali Ramakrishna, Ceviche One, B612, Zeyada, Mountains of Christmas, Sedgwick Ave, Gugi, Oleo Script Swash Caps, Skranji, Meddon, NTR, Finger Paint, Blinker, Fanwood Text, Grenze Gotisch, Hepta Slab, Anaheim, Major Mono Display, Quando, Andika, Qwigley, Vast Shadow, Happy Monkey, Montez, Proza Libre, Homenaje, Ma Shan Zheng, Loved by the King, Trade Winds, Stardos Stencil, Raleway Dots, Libre Barcode 39, Recursive, Numans, RocknRoll One, Rakkas, Mouse Memoirs, BioRhyme, Ranchers, Patrick Hand SC, Codystar, Rasa, Meera Inimai, Clicker Script, DM Mono, Gaegu, Aguafina Script, Unkempt, Over the Rainbow, Fondamento, Battambang, Cambo, Crafty Girls, Nova Mono, Tillana, Alike Angular, Kumbh Sans, Katibeh, Sarpanch, Antonio, Mansalva, Faster One, Federo, Dokdo, Hi Melody, Euphoria Script, Orienta, Space Grotesk, Galada, Timmana, JetBrains Mono, Baloo Thambi 2, Averia Sans Libre, UnifrakturCook, Tauri, Share Tech, Walter Turncoat, Geo, Atma, Almendra, Jomhuria, Strait, Encode Sans Expanded, Metamorphous, Iceland, Ledger, Poller One, Vollkorn SC, Vesper Libre, Aref Ruqaa, Livvic, Caladea, Montserrat Subrayada, Vampiro One, Farro, New Rocker, Delius Swash Caps, Calistoga, Carrois Gothic SC, Italiana, Inknut Antiqua, Life Savers, Imprima, Mako, Lily Script One, Bilbo Swash Caps, IM Fell English SC, Red Rose, Shojumaru, Prosto One, Bodoni Moda, Mukta Mahee, Bubbler One, The Girl Next Door, Artifika, Cantora One, Scope One, Yusei Magic, Oxanium, Tienne, Salsa, Flamenco, Port Lligat Sans, Denk One, Fontdiner Swanky, Nova Round, Gafata, Cormorant Upright, Cherry Cream Soda, Asul, Big Shoulders Text, Voces, Dynalight, Peralta, Mina, Headland One, Medula One, Englebert, Nova Square, Delius Unicase, Sumana, Bilbo, Engagement, ZCOOL QingKe HuangYou, Fresca, Ranga, Orelega One, Zen Dots, Shippori Mincho, Henny Penny, Della Respira, Cherry Swash, Notable, Arya, Slackey, Vibur, Coiny, Lexend Zetta, Elsie, Fjord One, Puritan, Just Me Again Down Here, Khmer, Girassol, Bellota Text, Yatra One, Stalemate, Wire One, Spicy Rice, Saira Stencil One, Kite One, Port Lligat Slab, Baloo Bhaina 2, Pavanam, Eater, Text Me One, Ribeye, Pirata One, Amarante, Milonga, Habibi, Ruslan Display, Encode Sans Semi Expanded, Nokora, Rowdies, Kranky, Bigelow Rules, League Script, Swanky and Moo Moo, Karantina, Lovers Quarrel, Mate SC, Manuale, Germania One, Sura, Sarina, Macondo Swash Caps, Kotta One, IM Fell French Canon SC, Julee, Charmonman, Shanti, Gamja Flower, Averia Gruesa Libre, Stint Ultra Expanded, Uncial Antiqua, Mystery Quest, Goldman, Paprika, IM Fell French Canon, Prociono, Kodchasan, Libre Barcode 39 Text, Quintessential, Moul, Libre Barcode 128, Ramaraja, Modak, Song Myung, East Sea Dokdo, Crushed, Dekko, Chilanka, Hanalei Fill, Mogra, Baloo Tammudu 2, Baloo Bhai 2, Libre Barcode 39 Extended Text, Rosarivo, KoHo, Offside, Reggae One, Syne, Zilla Slab Highlight, Donegal One, Bellota, Stoke, Cormorant Unicase, Cagliostro, Rationale, Margarine, Sancreek, Inria Serif, Overlock SC, Nosifer, Libre Barcode EAN13 Text, Yeon Sung, Ruluko, Simonetta, Lakki Reddy, Baloo Paaji 2, Chango, Galdeano, Fahkwang, Elsie Swash Caps, Buda, Condiment, Barrio, Chicle, Angkor, Akronim, Tomorrow, Sonsie One, Kumar One, Autour One, Libre Caslon Display, Farsan, Fenix, Solway, Kulim Park, Stint Ultra Condensed, Metal, Rum Raisin, Redressed, Tulpen One, Petrona, Marko One, Asar, Nova Flat, Koulen, Lexend Exa, Londrina Outline, Cute Font, IM Fell Great Primer, Junge, Stylish, Lexend, Spirax, Piazzolla, Piedra, Ribeye Marrow, Dorsa, Ibarra Real Nova, IM Fell DW Pica SC, Wellfleet, Eagle Lake, Meie Script, Goblin One, Flavors, Gotu, Linden Hill, Chathura, Croissant One, Jomolhari, Srisakdi, Modern Antiqua, Joti One, Kavoon, Sulphur Point, Castoro, Chela One, Atomic Age, Maiden Orange, Ruthie, Bayon, Potta One, Iceberg, Bigshot One, Gorditas, Sree Krushnadevaraya, Trykker, Kufam, Diplomata SC, Poor Story, Sirin Stencil, Kavivanar, Syne Mono, Metal Mania, Arbutus, Unlock, MuseoModerno, Glass Antiqua, Miniver, Griffy, Bokor, Felipa, Inika, Princess Sofia, Mrs Sheppards, Monofett, Sahitya, Dela Gothic One, Shippori Mincho B1, Beth Ellen, Lancelot, Rhodium Libre, Fraunces, Hachi Maru Pop, Snippet, Content, Revalia, Diplomata, Libre Barcode 128 Text, Jacques Francois Shadow, Long Cang, Caesar Dressing, Odor Mean Chey, Jolly Lodger, Texturina, DotGothic16, Ewert, Romanesco, Kantumruy, Asset, Odibee Sans, Emblema One, Kdam Thmor, Dr Sugiyama, Bahiana, GFS Neohellenic, Oldenburg, Molle, Ravi Prakash, Gayathri, Almendra SC, Varta, Risque, Sansita Swashed, Kiwi Maru, Dangrek, Devonshire, Big Shoulders Stencil Text, Jim Nightshade, Smythe, Stick, Lexend Mega, Siemreap, Londrina Shadow, Train One, IM Fell Great Primer SC, Barriecito, Underdog, Stalinist One, Mr Bedfort, Freehand, MedievalSharp, Lexend Giga, Keania One, Peddana, Galindo, Fascinate, Londrina Sketch, Gupter, Nova Slim, Snowburst One, ZCOOL KuaiLe, Plaster, Fascinate Inline, Newsreader, Purple Purse, Sedgwick Ave Display, Jacques Francois, Almendra Display, Irish Grover, Kumar One Outline, Andika New Basic, Libre Barcode 39 Extended, Taprom, Miss Fajardose, IM Fell Double Pica SC, Macondo, Ruge Boogie, Sunshiney, Brygada 1918, Grenze, Erica One, Seymour One, Supermercado One, Zhi Mang Xing, Butterfly Kids, Kirang Haerang, Federant, Liu Jian Mao Cao, Chenla, Hanalei, Langar, Trochut, Smokum, Black And White Picture, Preahvihear, Bungee Outline, Astloch, Fasthand, Akaya Telivigala, Inria Sans, Bonbon, Combo, Nova Script, Sofadi One, Passero One, Suwannaphum, Miltonian Tattoo, Bungee Hairline, Gidugu, Geostar Fill, Nerko One, Lacquer, Butcherman, Sevillana, Nova Oval, Aubrey, Akaya Kanadaka, Nova Cut, Vibes, Miltonian, Moulpali, BioRhyme Expanded, Bahianita, Suravaram, Fruktur, Single Day, Imbue, Lexend Tera, Big Shoulders Inline Text, Dhurjati, Warnes, Kenia, Lexend Peta, Big Shoulders Stencil Display, Geostar, Big Shoulders Inline Display, Oi, Xanh Mono, Viaoda Libre, Truculenta, Syne Tactile, Trispace, Ballet, Benne, default */
/***/ (function(module) {

module.exports = JSON.parse("{\"Roboto\":{\"variants\":[\"100\",\"100italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Open Sans\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"sans-serif\"},\"Noto Sans JP\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Lato\":{\"variants\":[\"100\",\"100italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Montserrat\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Roboto Condensed\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Source Sans Pro\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Oswald\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Poppins\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Roboto Mono\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"monospace\"},\"Noto Sans\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Raleway\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"PT Sans\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Roboto Slab\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Merriweather\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Ubuntu\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Playfair Display\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Nunito\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Noto Sans KR\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Open Sans Condensed\":{\"variants\":[\"300\",\"300italic\",\"700\"],\"category\":\"sans-serif\"},\"Rubik\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Lora\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"Work Sans\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Mukta\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Noto Sans TC\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Nunito Sans\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"PT Serif\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Nanum Gothic\":{\"variants\":[\"regular\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Inter\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Fira Sans\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Noto Serif\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Quicksand\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Titillium Web\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"900\"],\"category\":\"sans-serif\"},\"Hind Siliguri\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Karla\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\"],\"category\":\"sans-serif\"},\"Barlow\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Inconsolata\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"monospace\"},\"Heebo\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Noto Sans SC\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Oxygen\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Source Code Pro\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"monospace\"},\"Anton\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Josefin Sans\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"Arimo\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"PT Sans Narrow\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"IBM Plex Sans\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Dosis\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Noto Sans HK\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Libre Franklin\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Libre Baskerville\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"serif\"},\"Cabin\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"Hind\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Bitter\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Crimson Text\":{\"variants\":[\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Bebas Neue\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lobster\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Yanone Kaffeesatz\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Dancing Script\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"handwriting\"},\"Cairo\":{\"variants\":[\"200\",\"300\",\"regular\",\"600\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Abel\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Fjalla One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Varela Round\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Source Serif Pro\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Arvo\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"EB Garamond\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\"],\"category\":\"serif\"},\"Barlow Condensed\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Architects Daughter\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Zilla Slab\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Indie Flower\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mulish\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Comfortaa\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"display\"},\"DM Sans\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Pacifico\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Exo 2\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Kanit\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Prompt\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Shadows Into Light\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Questrial\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Merriweather Sans\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\"],\"category\":\"sans-serif\"},\"Teko\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Balsamiq Sans\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Asap\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"Hind Madurai\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Cormorant Garamond\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Antic Slab\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Archivo Narrow\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Overpass\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Abril Fatface\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Slabo 27px\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Exo\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Assistant\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Maven Pro\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Domine\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Fira Sans Condensed\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Caveat\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"handwriting\"},\"Rajdhani\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"IBM Plex Serif\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Martel\":{\"variants\":[\"200\",\"300\",\"regular\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Play\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Amatic SC\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Bree Serif\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Tajawal\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Noto Serif JP\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"900\"],\"category\":\"serif\"},\"Righteous\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Satisfy\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Signika\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Catamaran\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Acme\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Manrope\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Fredoka One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nanum Myeongjo\":{\"variants\":[\"regular\",\"700\",\"800\"],\"category\":\"serif\"},\"ABeeZee\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"sans-serif\"},\"Amiri\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Patrick Hand\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"PT Sans Caption\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Archivo\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Alfa Slab One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Cinzel\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Crete Round\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Permanent Marker\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Alegreya Sans\":{\"variants\":[\"100\",\"100italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Almarai\":{\"variants\":[\"300\",\"regular\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Barlow Semi Condensed\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Russo One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Vollkorn\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Sarabun\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"sans-serif\"},\"Krona One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"M PLUS Rounded 1c\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Noticia Text\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Courgette\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Monda\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Alegreya\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Frank Ruhl Libre\":{\"variants\":[\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"serif\"},\"Patua One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ubuntu Condensed\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Great Vibes\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Quattrocento Sans\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"M PLUS 1p\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Spartan\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Yantramanav\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Lobster Two\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Archivo Black\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Kaushan Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Tinos\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Cardo\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"serif\"},\"Orbitron\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Sacramento\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"IBM Plex Mono\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Francois One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Luckiest Guy\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gothic A1\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Kalam\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"handwriting\"},\"Parisienne\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Gloria Hallelujah\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Didact Gothic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Cantarell\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Press Start 2P\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jost\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Rokkitt\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Paytone One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Prata\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Baloo 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Cuprum\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"Chivo\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Encode Sans\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"News Cycle\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Old Standard TT\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"serif\"},\"Hind Guntur\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Pathway Gothic One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Red Hat Display\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Public Sans\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Secular One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Volkhov\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Concert One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Asap Condensed\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Montserrat Alternates\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Ropa Sans\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"sans-serif\"},\"Josefin Slab\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"Poiret One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Passion One\":{\"variants\":[\"regular\",\"700\",\"900\"],\"category\":\"display\"},\"Padauk\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Changa\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Saira Condensed\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Ultra\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Quattrocento\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Arapey\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Vidaloka\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Playfair Display SC\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Cookie\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Chakra Petch\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Istok Web\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Cormorant\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"DM Serif Display\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Neuton\":{\"variants\":[\"200\",\"300\",\"regular\",\"italic\",\"700\",\"800\"],\"category\":\"serif\"},\"Spectral\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"serif\"},\"Sawarabi Mincho\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Lemonada\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"display\"},\"Yellowtail\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Handlee\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Merienda\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Philosopher\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Sanchez\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Hammersmith One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Special Elite\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Economica\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Staatliches\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sriracha\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Hind Vadodara\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Monoton\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ruda\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Advent Pro\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Saira\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Homemade Apple\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Sigmar One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mitr\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Bangers\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Khand\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Faustina\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"Saira Semi Condensed\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Cabin Condensed\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Gudea\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"sans-serif\"},\"Fira Sans Extra Condensed\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"DM Serif Text\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"El Messiri\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Electrolize\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Taviraj\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"PT Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Gentium Basic\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Space Mono\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Alice\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Unica One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ubuntu Mono\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Pragati Narrow\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Noto Serif TC\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"900\"],\"category\":\"serif\"},\"Amaranth\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Karma\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Actor\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Nanum Pen Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Noto Serif SC\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"900\"],\"category\":\"serif\"},\"Tangerine\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Carter One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Neucha\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Unna\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Pontano Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Bai Jamjuree\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Marck Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"BenchNine\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Fugaz One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Yeseva One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Eczar\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"serif\"},\"Bad Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Viga\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Gentium Book Basic\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Jura\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Allura\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Palanquin\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Sawarabi Gothic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rock Salt\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Lusitana\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Alef\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Julius Sans One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Tenor Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Nothing You Could Do\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Cutive Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Khula\":{\"variants\":[\"300\",\"regular\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Adamina\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Playball\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Audiowide\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jaldi\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Black Ops One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Signika Negative\":{\"variants\":[\"300\",\"regular\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Shadows Into Light Two\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Armata\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Mali\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"handwriting\"},\"Antic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Varela\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Berkshire Swash\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Aleo\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Gelasio\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Rufina\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Markazi Text\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Nanum Gothic Coding\":{\"variants\":[\"regular\",\"700\"],\"category\":\"monospace\"},\"Allan\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Noto Serif KR\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"900\"],\"category\":\"serif\"},\"Abhaya Libre\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"serif\"},\"Quantico\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Marcellus\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Sorts Mill Goudy\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Alata\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Knewave\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Alex Brush\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Aclonica\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Gruppo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Damion\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Itim\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Bungee\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gochi Hand\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mr Dafoe\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Freckle Face\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Baloo Chettan 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Trirong\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Kosugi Maru\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rubik Mono One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Fira Mono\":{\"variants\":[\"regular\",\"500\",\"700\"],\"category\":\"monospace\"},\"Cantata One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Suez One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Niconne\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Six Caps\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Miriam Libre\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Sarala\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Sintony\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Titan One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Encode Sans Condensed\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Cousine\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"PT Serif Caption\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Courier Prime\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Overlock\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"display\"},\"Allerta\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Arsenal\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Black Han Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Squada One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lateef\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Arima Madurai\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Ramabhadra\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Covered By Your Grace\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Martel Sans\":{\"variants\":[\"200\",\"300\",\"regular\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Rancho\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Enriqueta\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Syncopate\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Pinyon Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Chewy\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Oleo Script\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Kreon\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Candal\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Spinnaker\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Reem Kufi\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Krub\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Michroma\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Annie Use Your Telescope\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Lilita One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Coda\":{\"variants\":[\"regular\",\"800\"],\"category\":\"display\"},\"Fredericka the Great\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mukta Malar\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Bowlby One SC\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Average\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Londrina Solid\":{\"variants\":[\"100\",\"300\",\"regular\",\"900\"],\"category\":\"display\"},\"New Tegomin\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Glegoo\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Pridi\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Boogaloo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Red Hat Text\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Aldrich\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Basic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Capriola\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Forum\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Reenie Beanie\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Laila\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Alegreya Sans SC\":{\"variants\":[\"100\",\"100italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Share Tech Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Italianno\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Lalezar\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lexend Deca\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Caveat Brush\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Shrikhand\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Creepster\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kameron\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Coda Caption\":{\"variants\":[\"800\"],\"category\":\"sans-serif\"},\"Goudy Bookletter 1911\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Coming Soon\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Saira Extra Condensed\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Yrsa\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Telex\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Bevan\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Voltaire\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Days One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Cabin Sketch\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Norican\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Rambla\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Mukta Vaani\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Average Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Arbutus Slab\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Sansita\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Mada\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"900\"],\"category\":\"sans-serif\"},\"Just Another Hand\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Nobile\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Gilda Display\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"VT323\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Mandali\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Caudex\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Anonymous Pro\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Bentham\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Overpass Mono\":{\"variants\":[\"300\",\"regular\",\"600\",\"700\"],\"category\":\"monospace\"},\"Sen\":{\"variants\":[\"regular\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Kadwa\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Cambay\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Yesteryear\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Molengo\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Nixie One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Scada\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Crimson Pro\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Arizonia\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Racing Sans One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Scheherazade\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Seaweed Script\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Belleza\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Harmattan\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Leckerli One\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Ovo\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Merienda One\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Holtwood One SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Cinzel Decorative\":{\"variants\":[\"regular\",\"700\",\"900\"],\"category\":\"display\"},\"Literata\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Mrs Saint Delafield\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Schoolbell\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Bungee Inline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Herr Von Muellerhoff\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Oranienbaum\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Baloo Tamma 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Sniglet\":{\"variants\":[\"regular\",\"800\"],\"category\":\"display\"},\"Bubblegum Sans\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Rochester\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Judson\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"serif\"},\"Marcellus SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Darker Grotesque\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Changa One\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"display\"},\"Alegreya SC\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Pattaya\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Mallanna\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Share\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Podkova\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"serif\"},\"Allerta Stencil\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Charm\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Niramit\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Halant\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Graduate\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nanum Brush Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Amita\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Rozha One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Kristi\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Biryani\":{\"variants\":[\"200\",\"300\",\"regular\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Lustria\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Delius\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Suranna\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Amethysta\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Contrail One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Averia Serif Libre\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Do Hyeon\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"IBM Plex Sans Condensed\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Marvel\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Rye\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Fauna One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Corben\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Cedarville Cursive\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Jockey One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Libre Caslon Text\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"serif\"},\"Carrois Gothic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Calligraffitti\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Trocchi\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Spectral SC\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"serif\"},\"Coustard\":{\"variants\":[\"regular\",\"900\"],\"category\":\"serif\"},\"Copse\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Athiti\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Carme\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rosario\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"sans-serif\"},\"Limelight\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jua\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Petit Formal Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Love Ya Like A Sister\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"GFS Didot\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Aladin\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Palanquin Dark\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Amiko\":{\"variants\":[\"regular\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Cormorant Infant\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Wallpoet\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Magra\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Grand Hotel\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Sunflower\":{\"variants\":[\"300\",\"500\",\"700\"],\"category\":\"sans-serif\"},\"Big Shoulders Display\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Slabo 13px\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Pangolin\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mr De Haviland\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"K2D\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"sans-serif\"},\"Marmelad\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Thasadith\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"La Belle Aurore\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Hanuman\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Metrophobic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Epilogue\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"sans-serif\"},\"Radley\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Poly\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Commissioner\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Averia Libre\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"IM Fell Double Pica\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Comic Neue\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"handwriting\"},\"Baskervville\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Kelly Slab\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Oxygen Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Maitree\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Buenard\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Duru Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Baloo Da 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Grandstander\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"display\"},\"Balthazar\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"ZCOOL XiaoWei\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Cutive\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Antic Didone\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Waiting for the Sunrise\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"B612 Mono\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"monospace\"},\"Chonburi\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Montaga\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"UnifrakturMaguntia\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kosugi\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Gravitas One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mirza\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\"],\"category\":\"display\"},\"Manjari\":{\"variants\":[\"100\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Alike\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Lekton\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"sans-serif\"},\"Sora\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Gabriela\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Lemon\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Esteban\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Alatsi\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Turret Road\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"700\",\"800\"],\"category\":\"display\"},\"Monsieur La Doulaise\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Pompiere\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Cormorant SC\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Kurale\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Frijole\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Rammetto One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Chelsea Market\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Megrim\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"IM Fell English\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Oregano\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"display\"},\"Andada\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Mate\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Convergence\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rouge Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Bowlby One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Emilys Candy\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Wendy One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Fira Code\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"monospace\"},\"Dawning of a New Day\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Sue Ellen Francisco\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Gurajada\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"David Libre\":{\"variants\":[\"regular\",\"500\",\"700\"],\"category\":\"serif\"},\"Sofia\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Short Stack\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Chau Philomene One\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"sans-serif\"},\"Bellefair\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Belgrano\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Expletus Sans\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Original Surfer\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Doppio One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Be Vietnam\":{\"variants\":[\"100\",\"100italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"sans-serif\"},\"Sail\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Inder\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Give You Glory\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"IM Fell DW Pica\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"McLaren\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Encode Sans Semi Condensed\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Bungee Shade\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Baumans\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Brawler\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Tenali Ramakrishna\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ceviche One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"B612\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Zeyada\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mountains of Christmas\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Sedgwick Ave\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Gugi\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Oleo Script Swash Caps\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Skranji\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Meddon\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"NTR\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Finger Paint\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Blinker\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Fanwood Text\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Grenze Gotisch\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Hepta Slab\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Anaheim\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Major Mono Display\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Quando\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Andika\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Qwigley\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Vast Shadow\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Happy Monkey\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Montez\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Proza Libre\":{\"variants\":[\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\"],\"category\":\"sans-serif\"},\"Homenaje\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ma Shan Zheng\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Loved by the King\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Trade Winds\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Stardos Stencil\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Raleway Dots\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Libre Barcode 39\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Recursive\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Numans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"RocknRoll One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rakkas\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mouse Memoirs\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"BioRhyme\":{\"variants\":[\"200\",\"300\",\"regular\",\"700\",\"800\"],\"category\":\"serif\"},\"Ranchers\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Patrick Hand SC\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Codystar\":{\"variants\":[\"300\",\"regular\"],\"category\":\"display\"},\"Rasa\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Meera Inimai\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Clicker Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"DM Mono\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\"],\"category\":\"monospace\"},\"Gaegu\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"handwriting\"},\"Aguafina Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Unkempt\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Over the Rainbow\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Fondamento\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"handwriting\"},\"Battambang\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Cambo\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Crafty Girls\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Nova Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Tillana\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"handwriting\"},\"Alike Angular\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Kumbh Sans\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Katibeh\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sarpanch\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Antonio\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Mansalva\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Faster One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Federo\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Dokdo\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Hi Melody\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Euphoria Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Orienta\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Space Grotesk\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Galada\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Timmana\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"JetBrains Mono\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\"],\"category\":\"monospace\"},\"Baloo Thambi 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Averia Sans Libre\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"UnifrakturCook\":{\"variants\":[\"700\"],\"category\":\"display\"},\"Tauri\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Share Tech\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Walter Turncoat\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Geo\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"sans-serif\"},\"Atma\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"display\"},\"Almendra\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Jomhuria\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Strait\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Encode Sans Expanded\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Metamorphous\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Iceland\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ledger\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Poller One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Vollkorn SC\":{\"variants\":[\"regular\",\"600\",\"700\",\"900\"],\"category\":\"serif\"},\"Vesper Libre\":{\"variants\":[\"regular\",\"500\",\"700\",\"900\"],\"category\":\"serif\"},\"Aref Ruqaa\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Livvic\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Caladea\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Montserrat Subrayada\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Vampiro One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Farro\":{\"variants\":[\"300\",\"regular\",\"500\",\"700\"],\"category\":\"sans-serif\"},\"New Rocker\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Delius Swash Caps\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Calistoga\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Carrois Gothic SC\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Italiana\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Inknut Antiqua\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Life Savers\":{\"variants\":[\"regular\",\"700\",\"800\"],\"category\":\"display\"},\"Imprima\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Mako\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Lily Script One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bilbo Swash Caps\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"IM Fell English SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Red Rose\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"display\"},\"Shojumaru\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Prosto One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bodoni Moda\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Mukta Mahee\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Bubbler One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"The Girl Next Door\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Artifika\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Cantora One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Scope One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Yusei Magic\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Oxanium\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Tienne\":{\"variants\":[\"regular\",\"700\",\"900\"],\"category\":\"serif\"},\"Salsa\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Flamenco\":{\"variants\":[\"300\",\"regular\"],\"category\":\"display\"},\"Port Lligat Sans\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Denk One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Fontdiner Swanky\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nova Round\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gafata\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Cormorant Upright\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Cherry Cream Soda\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Asul\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Big Shoulders Text\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Voces\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Dynalight\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Peralta\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mina\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Headland One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Medula One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Englebert\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Nova Square\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Delius Unicase\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Sumana\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Bilbo\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Engagement\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"ZCOOL QingKe HuangYou\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Fresca\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ranga\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Orelega One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Zen Dots\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Shippori Mincho\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"serif\"},\"Henny Penny\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Della Respira\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Cherry Swash\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Notable\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Arya\":{\"variants\":[\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Slackey\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Vibur\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Coiny\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lexend Zetta\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Elsie\":{\"variants\":[\"regular\",\"900\"],\"category\":\"display\"},\"Fjord One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Puritan\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Just Me Again Down Here\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Khmer\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Girassol\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bellota Text\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Yatra One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Stalemate\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Wire One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Spicy Rice\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Saira Stencil One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kite One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Port Lligat Slab\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Baloo Bhaina 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Pavanam\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Eater\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Text Me One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ribeye\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Pirata One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Amarante\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Milonga\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Habibi\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Ruslan Display\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Encode Sans Semi Expanded\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Nokora\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Rowdies\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"display\"},\"Kranky\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bigelow Rules\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"League Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Swanky and Moo Moo\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Karantina\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"display\"},\"Lovers Quarrel\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mate SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Manuale\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"Germania One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sura\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Sarina\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Macondo Swash Caps\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kotta One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"IM Fell French Canon SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Julee\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Charmonman\":{\"variants\":[\"regular\",\"700\"],\"category\":\"handwriting\"},\"Shanti\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Gamja Flower\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Averia Gruesa Libre\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Stint Ultra Expanded\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Uncial Antiqua\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mystery Quest\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Goldman\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Paprika\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"IM Fell French Canon\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Prociono\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Kodchasan\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Libre Barcode 39 Text\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Quintessential\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Moul\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Libre Barcode 128\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ramaraja\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Modak\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Song Myung\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"East Sea Dokdo\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Crushed\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Dekko\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Chilanka\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Hanalei Fill\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mogra\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Baloo Tammudu 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Baloo Bhai 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Libre Barcode 39 Extended Text\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Rosarivo\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"KoHo\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Offside\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Reggae One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Syne\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Zilla Slab Highlight\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Donegal One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Bellota\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"display\"},\"Stoke\":{\"variants\":[\"300\",\"regular\"],\"category\":\"serif\"},\"Cormorant Unicase\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"serif\"},\"Cagliostro\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Rationale\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Margarine\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sancreek\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Inria Serif\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"serif\"},\"Overlock SC\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nosifer\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Libre Barcode EAN13 Text\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Yeon Sung\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ruluko\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Simonetta\":{\"variants\":[\"regular\",\"italic\",\"900\",\"900italic\"],\"category\":\"display\"},\"Lakki Reddy\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Baloo Paaji 2\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"display\"},\"Chango\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Galdeano\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Fahkwang\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Elsie Swash Caps\":{\"variants\":[\"regular\",\"900\"],\"category\":\"display\"},\"Buda\":{\"variants\":[\"300\"],\"category\":\"display\"},\"Condiment\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Barrio\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Chicle\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Angkor\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Akronim\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Tomorrow\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"sans-serif\"},\"Sonsie One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kumar One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Autour One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Libre Caslon Display\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Farsan\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Fenix\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Solway\":{\"variants\":[\"300\",\"regular\",\"500\",\"700\",\"800\"],\"category\":\"serif\"},\"Kulim Park\":{\"variants\":[\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"600\",\"600italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Stint Ultra Condensed\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Metal\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Rum Raisin\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Redressed\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Tulpen One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Petrona\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Marko One\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Asar\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Nova Flat\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Koulen\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lexend Exa\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Londrina Outline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Cute Font\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"IM Fell Great Primer\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Junge\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Stylish\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Lexend\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Spirax\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Piazzolla\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Piedra\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ribeye Marrow\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Dorsa\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ibarra Real Nova\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"IM Fell DW Pica SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Wellfleet\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Eagle Lake\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Meie Script\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Goblin One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Flavors\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gotu\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Linden Hill\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Chathura\":{\"variants\":[\"100\",\"300\",\"regular\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Croissant One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jomolhari\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Srisakdi\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Modern Antiqua\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Joti One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kavoon\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sulphur Point\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Castoro\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"serif\"},\"Chela One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Atomic Age\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Maiden Orange\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ruthie\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Bayon\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Potta One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Iceberg\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bigshot One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gorditas\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Sree Krushnadevaraya\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Trykker\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Kufam\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"display\"},\"Diplomata SC\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Poor Story\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sirin Stencil\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kavivanar\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Syne Mono\":{\"variants\":[\"regular\"],\"category\":\"monospace\"},\"Metal Mania\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Arbutus\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Unlock\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"MuseoModerno\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Glass Antiqua\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Miniver\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Griffy\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bokor\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Felipa\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Inika\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Princess Sofia\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Mrs Sheppards\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Monofett\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sahitya\":{\"variants\":[\"regular\",\"700\"],\"category\":\"serif\"},\"Dela Gothic One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Shippori Mincho B1\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"serif\"},\"Beth Ellen\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Lancelot\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Rhodium Libre\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Fraunces\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"Hachi Maru Pop\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Snippet\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Content\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Revalia\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Diplomata\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Libre Barcode 128 Text\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jacques Francois Shadow\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Long Cang\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Caesar Dressing\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Odor Mean Chey\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Jolly Lodger\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Texturina\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\",\"100italic\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\",\"900italic\"],\"category\":\"serif\"},\"DotGothic16\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Ewert\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Romanesco\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Kantumruy\":{\"variants\":[\"300\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Asset\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Odibee Sans\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Emblema One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kdam Thmor\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Dr Sugiyama\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Bahiana\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"GFS Neohellenic\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Oldenburg\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Molle\":{\"variants\":[\"italic\"],\"category\":\"handwriting\"},\"Ravi Prakash\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gayathri\":{\"variants\":[\"100\",\"regular\",\"700\"],\"category\":\"sans-serif\"},\"Almendra SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Varta\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\"],\"category\":\"sans-serif\"},\"Risque\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sansita Swashed\":{\"variants\":[\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Kiwi Maru\":{\"variants\":[\"300\",\"regular\",\"500\"],\"category\":\"serif\"},\"Dangrek\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Devonshire\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Big Shoulders Stencil Text\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Jim Nightshade\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Smythe\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Stick\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Lexend Mega\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Siemreap\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Londrina Shadow\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Train One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"IM Fell Great Primer SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Barriecito\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Underdog\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Stalinist One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Mr Bedfort\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Freehand\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"MedievalSharp\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lexend Giga\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Keania One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Peddana\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Galindo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Fascinate\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Londrina Sketch\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gupter\":{\"variants\":[\"regular\",\"500\",\"700\"],\"category\":\"serif\"},\"Nova Slim\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Snowburst One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"ZCOOL KuaiLe\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Plaster\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Fascinate Inline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Newsreader\":{\"variants\":[\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"200italic\",\"300italic\",\"italic\",\"500italic\",\"600italic\",\"700italic\",\"800italic\"],\"category\":\"serif\"},\"Purple Purse\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sedgwick Ave Display\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Jacques Francois\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Almendra Display\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Irish Grover\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kumar One Outline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Andika New Basic\":{\"variants\":[\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Libre Barcode 39 Extended\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Taprom\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Miss Fajardose\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"IM Fell Double Pica SC\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Macondo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Ruge Boogie\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Sunshiney\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Brygada 1918\":{\"variants\":[\"regular\",\"500\",\"600\",\"700\",\"italic\",\"500italic\",\"600italic\",\"700italic\"],\"category\":\"serif\"},\"Grenze\":{\"variants\":[\"100\",\"100italic\",\"200\",\"200italic\",\"300\",\"300italic\",\"regular\",\"italic\",\"500\",\"500italic\",\"600\",\"600italic\",\"700\",\"700italic\",\"800\",\"800italic\",\"900\",\"900italic\"],\"category\":\"serif\"},\"Erica One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Seymour One\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Supermercado One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Zhi Mang Xing\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Butterfly Kids\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Kirang Haerang\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Federant\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Liu Jian Mao Cao\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Chenla\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Hanalei\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Langar\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Trochut\":{\"variants\":[\"regular\",\"italic\",\"700\"],\"category\":\"display\"},\"Smokum\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Black And White Picture\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Preahvihear\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bungee Outline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Astloch\":{\"variants\":[\"regular\",\"700\"],\"category\":\"display\"},\"Fasthand\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Akaya Telivigala\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Inria Sans\":{\"variants\":[\"300\",\"300italic\",\"regular\",\"italic\",\"700\",\"700italic\"],\"category\":\"sans-serif\"},\"Bonbon\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Combo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nova Script\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sofadi One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Passero One\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Suwannaphum\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Miltonian Tattoo\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Bungee Hairline\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Gidugu\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Geostar Fill\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nerko One\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Lacquer\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Butcherman\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Sevillana\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nova Oval\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Aubrey\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Akaya Kanadaka\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Nova Cut\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Vibes\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Miltonian\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Moulpali\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"BioRhyme Expanded\":{\"variants\":[\"200\",\"300\",\"regular\",\"700\",\"800\"],\"category\":\"serif\"},\"Bahianita\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Suravaram\":{\"variants\":[\"regular\"],\"category\":\"serif\"},\"Fruktur\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Single Day\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Imbue\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"serif\"},\"Lexend Tera\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Big Shoulders Inline Text\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Dhurjati\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Warnes\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Kenia\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Lexend Peta\":{\"variants\":[\"regular\"],\"category\":\"sans-serif\"},\"Big Shoulders Stencil Display\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Geostar\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Big Shoulders Inline Display\":{\"variants\":[\"100\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"display\"},\"Oi\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Xanh Mono\":{\"variants\":[\"regular\",\"italic\"],\"category\":\"monospace\"},\"Viaoda Libre\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Truculenta\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\",\"900\"],\"category\":\"sans-serif\"},\"Syne Tactile\":{\"variants\":[\"regular\"],\"category\":\"display\"},\"Trispace\":{\"variants\":[\"100\",\"200\",\"300\",\"regular\",\"500\",\"600\",\"700\",\"800\"],\"category\":\"sans-serif\"},\"Ballet\":{\"variants\":[\"regular\"],\"category\":\"handwriting\"},\"Benne\":{\"variants\":[\"regular\"],\"category\":\"serif\"}}");

/***/ }),

/***/ "./src/customizer-controls/font-picker/index.js":
/*!******************************************************!*\
  !*** ./src/customizer-controls/font-picker/index.js ***!
  \******************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressFontFamilyControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressFontFamilyControl */ "./src/customizer-controls/font-picker/GeneratePressFontFamilyControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-font-family-control'] = _GeneratePressFontFamilyControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer-controls/range/GeneratePressRangeControl.js":
/*!********************************************************************!*\
  !*** ./src/customizer-controls/range/GeneratePressRangeControl.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressRangeControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressRangeControlForm */ "./src/customizer-controls/range/GeneratePressRangeControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressRangeControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressRangeControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      default: control.params.defaultValue
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        // Move this control into the wrapper.
        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressRangeControl);

/***/ }),

/***/ "./src/customizer-controls/range/GeneratePressRangeControlForm.js":
/*!************************************************************************!*\
  !*** ./src/customizer-controls/range/GeneratePressRangeControlForm.js ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/range/style.scss");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);




var GeneratePressRangeControlForm = function GeneratePressRangeControlForm(props) {
  /**
   * Save the value when changing the control.
   *
   * @param {Object} value - The value.
   * @return {void}
   */
  var handleChangeComplete = function handleChangeComplete(value) {
    wp.customize.control(props.customizerSetting.id).setting.set(value);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), !!props.label && Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "generate-range-control-component-label"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("span", null, props.label)), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "components-gblocks-range-control--wrapper"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "components-gblocks-range-control--range"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["RangeControl"], {
    className: 'gblocks-range-control-range',
    value: props.value || 0 === props.value ? parseFloat(props.value) : '',
    onChange: handleChangeComplete,
    min: props.choices.rangeMin,
    max: props.choices.rangeMax,
    step: props.choices.step,
    withInputField: false,
    initialPosition: props.choices.initialPosition
  })), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "components-gblocks-range-control-input"
  }, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    type: "number",
    placeholder: '' !== props.choices.placeholder ? props.choices.placeholder : '',
    min: props.choices.inputMin,
    max: props.choices.inputMax,
    step: props.choices.step,
    value: props.value || 0 === props.value ? props.value : '',
    onChange: handleChangeComplete,
    onBlur: function onBlur() {
      if (props.value || 0 === props.value) {
        handleChangeComplete(parseFloat(props.value));
      }
    },
    onClick: function onClick(e) {
      // Make sure onBlur fires in Firefox.
      e.currentTarget.focus();
    }
  }))));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressRangeControlForm);

/***/ }),

/***/ "./src/customizer-controls/range/index.js":
/*!************************************************!*\
  !*** ./src/customizer-controls/range/index.js ***!
  \************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressRangeControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressRangeControl */ "./src/customizer-controls/range/GeneratePressRangeControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-range-control'] = _GeneratePressRangeControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer-controls/select/GeneratePressSelectControl.js":
/*!**********************************************************************!*\
  !*** ./src/customizer-controls/select/GeneratePressSelectControl.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressSelectControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressSelectControlForm */ "./src/customizer-controls/select/GeneratePressSelectControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressSelectControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressSelectControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      default: control.params.defaultValue
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        // Move this control into the wrapper.
        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressSelectControl);

/***/ }),

/***/ "./src/customizer-controls/select/GeneratePressSelectControlForm.js":
/*!**************************************************************************!*\
  !*** ./src/customizer-controls/select/GeneratePressSelectControlForm.js ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/select/style.scss");
/* harmony import */ var _utils_get_font_weights__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/get-font-weights */ "./src/utils/get-font-weights/index.js");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);






var GeneratePressSelectControlForm = function GeneratePressSelectControlForm(props) {
  /**
   * Save the value when changing the control.
   *
   * @param {Object} value - The value.
   * @return {void}
   */
  var handleChangeComplete = function handleChangeComplete(value) {
    wp.customize.control(props.customizerSetting.id).setting.set(value);
  };

  var choices = props.choices.options;
  var fontFamily = '';

  if (props.customizerSetting.id.includes('font_weight')) {
    // Get the unique element of our font family control.
    var fontElement = props.customizerSetting.id.split('[').pop();
    fontElement = fontElement.substring(0, fontElement.indexOf('_'));
    var fontFamilyControl = wp.customize.control('generate_settings[' + fontElement + '_font_family]');

    if (fontFamilyControl) {
      fontFamily = fontFamilyControl.setting.get();
    }

    choices = Object(_utils_get_font_weights__WEBPACK_IMPORTED_MODULE_2__["default"])(fontFamily);
  }

  if (props.customizerSetting.id.includes('font_transform')) {
    choices = [{
      value: '',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Default', 'generatepress')
    }, {
      value: 'uppercase',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Uppercase', 'generatepress')
    }, {
      value: 'lowercase',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Lowercase', 'generatepress')
    }, {
      value: 'capitalize',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Capitalize', 'generatepress')
    }, {
      value: 'initial',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__["__"])('Normal', 'generatepress')
    }];
  }

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__["SelectControl"], {
    key: fontFamily,
    label: props.label,
    help: props.description,
    value: props.value,
    options: choices,
    onChange: handleChangeComplete
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressSelectControlForm);

/***/ }),

/***/ "./src/customizer-controls/select/index.js":
/*!*************************************************!*\
  !*** ./src/customizer-controls/select/index.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressSelectControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressSelectControl */ "./src/customizer-controls/select/GeneratePressSelectControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-select-control'] = _GeneratePressSelectControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer-controls/text/GeneratePressTextControl.js":
/*!******************************************************************!*\
  !*** ./src/customizer-controls/text/GeneratePressTextControl.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressTextControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressTextControlForm */ "./src/customizer-controls/text/GeneratePressTextControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressTextControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressTextControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      default: control.params.defaultValue
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        // Move this control into the wrapper.
        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressTextControl);

/***/ }),

/***/ "./src/customizer-controls/text/GeneratePressTextControlForm.js":
/*!**********************************************************************!*\
  !*** ./src/customizer-controls/text/GeneratePressTextControlForm.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/text/style.scss");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);




var GeneratePressTextControlForm = function GeneratePressTextControlForm(props) {
  /**
   * Save the value when changing the control.
   *
   * @param {Object} value - The value.
   * @return {void}
   */
  var handleChangeComplete = function handleChangeComplete(value) {
    wp.customize.control(props.customizerSetting.id).setting.set(value);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["TextControl"], {
    label: props.label,
    help: props.description,
    value: props.value || '',
    onChange: handleChangeComplete
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressTextControlForm);

/***/ }),

/***/ "./src/customizer-controls/text/index.js":
/*!***********************************************!*\
  !*** ./src/customizer-controls/text/index.js ***!
  \***********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressTextControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressTextControl */ "./src/customizer-controls/text/GeneratePressTextControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-text-control'] = _GeneratePressTextControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer-controls/toggle/GeneratePressToggleControl.js":
/*!**********************************************************************!*\
  !*** ./src/customizer-controls/toggle/GeneratePressToggleControl.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/extends.js");
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _GeneratePressToggleControlForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./GeneratePressToggleControlForm */ "./src/customizer-controls/toggle/GeneratePressToggleControlForm.js");




/**
 * GeneratePressColorControl.
 *
 * @class
 * @augments wp.customize.Control
 * @augments wp.customize.Class
 */

var GeneratePressToggleControl = wp.customize.Control.extend({
  /**
   * After control has been first rendered, start re-rendering when setting changes.
   *
   * React is able to be used here instead of the wp.customize.Element abstraction.
   *
   * @return {void}
   */
  ready: function ready() {
    var control = this; // Re-render control when setting changes.

    control.setting.bind(function () {
      control.renderContent();
    });
  },

  /**
   * Embed the control in the document.
   *
   * Overrides the embed() method to embed the control
   * when the section is expanded instead of on load.
   *
   * @since 1.0.0
   * @return {void}
   */
  embed: function embed() {
    var control = this;
    var sectionId = control.section();

    if (!sectionId) {
      return;
    }

    wp.customize.section(sectionId, function (section) {
      section.expanded.bind(function (expanded) {
        if (expanded) {
          control.actuallyEmbed();
        }
      });
    });
  },

  /**
   * Deferred embedding of control.
   *
   * This function is called in Section.onChangeExpanded() so the control
   * will only get embedded when the Section is first expanded.
   *
   * @since 1.0.0
   */
  actuallyEmbed: function actuallyEmbed() {
    var control = this;

    if ('resolved' === control.deferred.embedded.state()) {
      return;
    }

    control.renderContent();
    control.deferred.embedded.resolve(); // Triggers control.ready().
  },

  /**
   * Initialize.
   *
   * @param {string} id - Control ID.
   * @param {Object} params - Control params.
   */
  initialize: function initialize(id, params) {
    var control = this; // Bind functions to this control context for passing as React props.

    control.setNotificationContainer = control.setNotificationContainer.bind(control);
    wp.customize.Control.prototype.initialize.call(control, id, params); // The following should be eliminated with <https://core.trac.wordpress.org/ticket/31334>.

    function onRemoved(removedControl) {
      if (control === removedControl) {
        control.destroy();
        control.container.remove();
        wp.customize.control.unbind('removed', onRemoved);
      }
    }

    wp.customize.control.bind('removed', onRemoved);
  },

  /**
   * Set notification container and render.
   *
   * This is called when the React component is mounted.
   *
   * @param {Element} element - Notification container.
   * @return {void}
   */
  setNotificationContainer: function setNotificationContainer(element) {
    var control = this;
    control.notifications.container = jQuery(element);
    control.notifications.render();
  },

  /**
   * Render the control into the DOM.
   *
   * This is called from the Control#embed() method in the parent class.
   *
   * @return {void}
   */
  renderContent: function renderContent() {
    var control = this;
    var value = control.setting.get();
    var form = Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["createElement"])(_GeneratePressToggleControlForm__WEBPACK_IMPORTED_MODULE_2__["default"], _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0___default()({}, control.params, {
      value: value,
      setNotificationContainer: control.setNotificationContainer,
      customizerSetting: control.setting,
      control: control,
      choices: control.params.choices,
      default: control.params.defaultValue
    }));
    var wrapper = control.container[0];

    if (control.params.choices.wrapper) {
      var wrapperElement = document.getElementById(control.params.choices.wrapper + '--wrapper');

      if (wrapperElement) {
        if (control.id.includes('font_google')) {
          if (value) {
            wrapperElement.parentNode.classList.add('generate-is-google-font');
          } else {
            wrapperElement.parentNode.classList.remove('generate-is-google-font');
          }
        } // Move this control into the wrapper.


        wrapper = wrapperElement; // Hide the original <li> container.

        control.container.hide();
      }
    }

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["render"])(form, wrapper);
  },

  /**
   * Handle removal/de-registration of the control.
   *
   * This is essentially the inverse of the Control#embed() method.
   *
   * @see https://core.trac.wordpress.org/ticket/31334
   * @return {void}
   */
  destroy: function destroy() {
    var control = this; // Garbage collection: undo mounting that was done in the embed/renderContent method.

    Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__["unmountComponentAtNode"])(control.container[0]); // Call destroy method in parent if it exists (as of #31334).

    if (wp.customize.Control.prototype.destroy) {
      wp.customize.Control.prototype.destroy.call(control);
    }
  }
});
/* harmony default export */ __webpack_exports__["default"] = (GeneratePressToggleControl);

/***/ }),

/***/ "./src/customizer-controls/toggle/GeneratePressToggleControlForm.js":
/*!**************************************************************************!*\
  !*** ./src/customizer-controls/toggle/GeneratePressToggleControlForm.js ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/customizer-controls/toggle/style.scss");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);




var GeneratePressToggleControlForm = function GeneratePressToggleControlForm(props) {
  /**
   * Save the value when changing the control.
   *
   * @param {Object} value - The value.
   * @return {void}
   */
  var handleChangeComplete = function handleChangeComplete(value) {
    wp.customize.control(props.customizerSetting.id).setting.set(value);
  };

  return Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", null, Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])("div", {
    className: "customize-control-notifications-container",
    ref: props.setNotificationContainer
  }), Object(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__["createElement"])(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__["ToggleControl"], {
    label: props.label,
    help: props.description,
    checked: !!props.value,
    onChange: handleChangeComplete
  }));
};

/* harmony default export */ __webpack_exports__["default"] = (GeneratePressToggleControlForm);

/***/ }),

/***/ "./src/customizer-controls/toggle/index.js":
/*!*************************************************!*\
  !*** ./src/customizer-controls/toggle/index.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GeneratePressToggleControl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GeneratePressToggleControl */ "./src/customizer-controls/toggle/GeneratePressToggleControl.js");
 // Register control type with Customizer.

wp.customize.controlConstructor['generate-toggle-control'] = _GeneratePressToggleControl__WEBPACK_IMPORTED_MODULE_0__["default"];

/***/ }),

/***/ "./src/customizer.js":
/*!***************************!*\
  !*** ./src/customizer.js ***!
  \***************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./style.scss */ "./src/style.scss");
/* harmony import */ var _customizer_controls_color_picker__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./customizer-controls/color-picker */ "./src/customizer-controls/color-picker/index.js");
/* harmony import */ var _customizer_controls_font_picker__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./customizer-controls/font-picker */ "./src/customizer-controls/font-picker/index.js");
/* harmony import */ var _customizer_controls_toggle__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./customizer-controls/toggle */ "./src/customizer-controls/toggle/index.js");
/* harmony import */ var _customizer_controls_select__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./customizer-controls/select */ "./src/customizer-controls/select/index.js");
/* harmony import */ var _customizer_controls_text__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./customizer-controls/text */ "./src/customizer-controls/text/index.js");
/* harmony import */ var _customizer_controls_range__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./customizer-controls/range */ "./src/customizer-controls/range/index.js");








/***/ }),

/***/ "./src/utils/get-font-weights/index.js":
/*!*********************************************!*\
  !*** ./src/utils/get-font-weights/index.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return getFontWeight; });
/* harmony import */ var _customizer_controls_font_picker_google_fonts_json__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../customizer-controls/font-picker/google-fonts.json */ "./src/customizer-controls/font-picker/google-fonts.json");
var _customizer_controls_font_picker_google_fonts_json__WEBPACK_IMPORTED_MODULE_0___namespace = /*#__PURE__*/__webpack_require__.t(/*! ../../customizer-controls/font-picker/google-fonts.json */ "./src/customizer-controls/font-picker/google-fonts.json", 1);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);


function getFontWeight(fontFamily) {
  var weight = [{
    value: '',
    label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Default', 'generatepress')
  }, {
    value: 'normal',
    label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Normal', 'generatepress')
  }, {
    value: 'bold',
    label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Bold', 'generatepress')
  }, {
    value: '100',
    label: '100'
  }, {
    value: '200',
    label: '200'
  }, {
    value: '300',
    label: '300'
  }, {
    value: '400',
    label: '400'
  }, {
    value: '500',
    label: '500'
  }, {
    value: '600',
    label: '600'
  }, {
    value: '700',
    label: '700'
  }, {
    value: '800',
    label: '800'
  }, {
    value: '900',
    label: '900'
  }];

  if (typeof _customizer_controls_font_picker_google_fonts_json__WEBPACK_IMPORTED_MODULE_0__[fontFamily] !== 'undefined' && typeof _customizer_controls_font_picker_google_fonts_json__WEBPACK_IMPORTED_MODULE_0__[fontFamily].variants !== 'undefined') {
    weight = [{
      value: '',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Default', 'generatepress')
    }, {
      value: 'normal',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Normal', 'generatepress')
    }, {
      value: 'bold',
      label: Object(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__["__"])('Bold', 'generatepress')
    }];
    _customizer_controls_font_picker_google_fonts_json__WEBPACK_IMPORTED_MODULE_0__[fontFamily].variants.filter(function (k) {
      var hasLetters = k.match(/[a-z]/g);
      var hasNumbers = k.match(/[0-9]/g);

      if (hasLetters && hasNumbers || 'italic' === k || 'regular' === k) {
        return false;
      }

      return true;
    }).forEach(function (k) {
      weight.push({
        value: k,
        label: k
      });
    });
  }

  return weight;
}

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["components"]; }());

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["element"]; }());

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function() { module.exports = window["wp"]["i18n"]; }());

/***/ })

/******/ });
//# sourceMappingURL=customizer.js.map