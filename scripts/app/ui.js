/*
  UI
*/
import Barba from 'barba.js'

// Set Barba live container and wrapper for pjax page loading
Barba.Pjax.Dom.containerClass = 'b-target'
Barba.Pjax.Dom.wrapperId = 'content'

const hideShowTransition = Barba.BaseTransition.extend({
	start: function () {
		this.newContainerLoading.then(this.finish.bind(this))
		DOM.innie.classList.add('in')
		DOM.outie.classList.add('in')
	},

	finish: function () {
		DOM.innie.classList.remove('in')
		DOM.outie.classList.remove('in')
		window.scrollTo(0, 0)
		this.done()
		document.dispatchEvent(new Event('closeNav')) // close the nav if open
		UI.onLoadedNewDom()
	}
})

const DOM = {}

const UI = {
	backgroundsourceset: null,

	onDOM () {
		// link DOM
		DOM.preloader = document.getElementById('preloader')
		DOM.innie = document.querySelector('.innie')
		DOM.outie = document.querySelector('.outie')

		this.preloaderLoaded()
		this.initAnimatedButtons()

		// Extend default Barba transition
		Barba.Pjax.getTransition = () => {
			return hideShowTransition
		}

		Barba.Pjax.init()
		Barba.Prefetch.init()
	},

	preloaderLoaded () {
		DOM.preloader.className = 'loaded'
		window.setTimeout( () => { preloader.className = 'loaded' } , 1500)
	},

	onLoadedNewDom () {
		if (this.backgroundsourceset) {
			this.backgroundsourceset.init(".dynamic-bg", (a) => {
				a.node.classList.add("loaded")
			})
		}
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
