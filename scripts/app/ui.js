/*
  UI
*/

const anime = typeof window !== 'undefined' ? require('animejs') : null

const UI = {
	onDOM () {
		let preloader = document.getElementById('preloader')

		preloader.className = 'loaded'
		window.setTimeout( () => { preloader.className = 'hidden' } , 1500)
	}
}

export default UI
