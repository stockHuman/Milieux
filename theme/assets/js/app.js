(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

var _navigation = require('./navigation.js');

var _navigation2 = _interopRequireDefault(_navigation);

var _ui = require('./ui.js');

var _ui2 = _interopRequireDefault(_ui);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

'use strict';

document.addEventListener('DOMContentLoaded', function () {
	_navigation2.default.onDOM();
	ui.onDOM();
});

},{"./navigation.js":2,"./ui.js":3}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
/*
  Navigation
*/

var Navigation = {
  onDOM: function onDOM() {}
};

exports.default = Navigation;

},{}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
/*
  UI
*/

var UI = {
	onDOM: function onDOM() {
		// preloader animation
		var preloader = document.getElementById('preloader').className = 'loaded';
		// transitioner panels here w/ delay
		window.setTimeout(function () {
			preloader.className = 'hidden';
		}, 1500);
	}
};

exports.default = UI;

},{}]},{},[1])

