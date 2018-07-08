/*
  UI
*/

const anime = typeof window !== 'undefined' ? require('animejs') : null

const UI = {
	onDOM () {
		// preloader animation
		let preloader = document.getElementById('preloader').className = 'loaded'
		// transitioner panels here w/ delay
		window.setTimeout( function () { preloader.className = 'hidden' } , 1500)
	}
}

export default UI
