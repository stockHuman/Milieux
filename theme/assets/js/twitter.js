(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

document.addEventListener('DOMContentLoaded', function () {
  var elem = document.createElement('div');
  elem.id = 'twitter-toggle';
  document.body.appendChild(elem);
  elem.addEventListener('click', function () {
    document.getElementById('twitter-panel').classList.toggle('--active');
  });
});

// Customize twitter feed
var hideTwitterAttempts = 0;
function modifyTwitterStyles() {
  setTimeout(function () {
    var list = document.getElementsByTagName('iframe');
    if (list.length) {
      Array.prototype.forEach.call(list, function (element) {});
    }
    hideTwitterAttempts++;
    if (hideTwitterAttempts < 3) {
      modifyTwitterStyles();
    }
  }, 1500);
}
modifyTwitterStyles();

},{}]},{},[1])

