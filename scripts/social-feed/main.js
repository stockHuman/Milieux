'use strict';

document.addEventListener('DOMContentLoaded', () => {
	let elem = document.createElement('div')
	elem.id = 'twitter-toggle'
	document.body.appendChild(elem)
	elem.addEventListener('click', () => {
		document.getElementById('twitter-panel').classList.toggle('--active')
	})
})

// Customize twitter feed
var hideTwitterAttempts = 0;
function modifyTwitterStyles () {
  setTimeout( function() {
    var list = document.getElementsByTagName('iframe');
    if (list.length ) {
      Array.prototype.forEach.call( list, element => {})
    }
    hideTwitterAttempts++;
    if ( hideTwitterAttempts < 3 ) {
     modifyTwitterStyles()
    }
  }, 1500);
}
modifyTwitterStyles()
