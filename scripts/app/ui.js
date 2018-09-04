/*
  UI
*/

import Barba from 'barba.js'
// import Navigation from './navigation.js'

Barba.Pjax.Dom.containerClass = 'b-target'
Barba.Pjax.Dom.wrapperId = 'content'

const UI = {
	onDOM () {
		this.preloaderLoaded()
		this.initAnimatedButtons()

		Barba.Pjax.init();
		Barba.Prefetch.init();
	},

	preloaderLoaded () {
		let preloader = document.getElementById('preloader')

		preloader.className = 'loaded'
		window.setTimeout( () => { preloader.className = 'hidden' } , 1500)
	},

	initAnimatedButtons() {
		// via https://blog.prototypr.io/stunning-hover-effects-with-css-variables-f855e7b95330
		// Set css variables for a cool hover effect on select buttons
		const animatedButtons = document.querySelector('.btn--material-highlight')

		if (animatedButtons) {
			animatedButtons.onmousemove = (e) => {
				e.stopPropagation()

			  const x = e.pageX - e.target.offsetLeft
			  const y = e.pageY - e.target.offsetTop

			  e.target.style.setProperty('--x', `${ x }px`)
			  e.target.style.setProperty('--y', `${ y }px`)

			}
		}
	}
}

export default UI
