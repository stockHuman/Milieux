/*
  UI
*/

const anime = typeof window !== 'undefined' ? require('animejs') : null

const UI = {
	onDOM () {
		let preloader = document.getElementById('preloader')

		preloader.className = 'loaded'
		window.setTimeout( () => { preloader.className = 'hidden' } , 1500)

		// via https://blog.prototypr.io/stunning-hover-effects-with-css-variables-f855e7b95330
		// Set css variables for a cool hover effect on select buttons
		document.querySelector('.btn--material-highlight').onmousemove = (e) => {
			e.stopPropagation()

		  const x = e.pageX - e.target.offsetLeft
		  const y = e.pageY - e.target.offsetTop

		  e.target.style.setProperty('--x', `${ x }px`)
		  e.target.style.setProperty('--y', `${ y }px`)

		}
	}
}

export default UI
