/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 304);
/******/ })
/************************************************************************/
/******/ ({

/***/ 214:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var baseUrl = window.Exclamo.url + "/api";

function filterNumericals(fromString) {
	return fromString.replace(/\D/g, '');
}

function getCaseIdFromUrl() {
	var urlSegments = window.location.href.split("/");
	return Number(filterNumericals(urlSegments[urlSegments.length - 1]));
}

var ReportedCase = function () {
	function ReportedCase(caseId) {
		_classCallCheck(this, ReportedCase);

		this.caseId = caseId || getCaseIdFromUrl();
	}

	_createClass(ReportedCase, [{
		key: "edit",
		value: function edit(options, successFunction, errorFunction) {
			axios.put(baseUrl + "/cases/" + this.caseId, options).then(function (response) {
				console.log(response);
				successFunction(response);
			}).catch(function (error) {
				console.log(error);
				errorFunction(error);
			});
			return this;
		}
	}, {
		key: "setAnonymous",
		value: function setAnonymous(anonymous) {
			return this.edit({ anonymous: anonymous });
		}
	}, {
		key: "setSolved",
		value: function setSolved(solved) {
			return this.edit({ solved: solved });
		}
	}, {
		key: "setMentors",
		value: function setMentors(mentors) {
			return this.edit({ mentors: mentors });
		}
	}], [{
		key: "create",
		value: function create(options, successFunction, errorFunction) {
			axios.post(baseUrl + "/cases", options).then(function (response) {
				console.log(response);
				successFunction(response);
			}).catch(function (error) {
				console.log(error);
				errorFunction(error);
			});
			return this;
		}
	}]);

	return ReportedCase;
}();

/* harmony default export */ __webpack_exports__["a"] = ({
	getCaseIdFromUrl: getCaseIdFromUrl,
	ReportedCase: ReportedCase
});

/***/ }),

/***/ 304:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(305);


/***/ }),

/***/ 305:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__api__ = __webpack_require__(214);


var caseId = __WEBPACK_IMPORTED_MODULE_0__api__["a" /* default */].getCaseIdFromUrl();

window.Echo.private('cases.' + caseId).listen('MessageSent', function (e) {
    console.log(e);
});

/***/ })

/******/ });