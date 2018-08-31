/*
  Navigation
*/

import anime from 'animejs'

let navIsOpen = false

// scroll vars
let navCloseTolerance = 20
let navToggleTolerance = 70

// navigation state
const nav = {}

const Navigation = {

	onDOM () {
		nav.main = document.getElementById('nav-main')
		nav.line = document.getElementById('nav-line')
		nav.linestate = 'closed'
		nav.search = 'closed'

		this.setLineStyle(nav.linestate)
		document.getElementById('nav-toggle').addEventListener('click', () => {this.toggleNav()})
		document.getElementById('nav-search').addEventListener('click', () => {this.toggleSearch()})

		document.addEventListener('keydown', (e) => {
	    // ESCAPE key pressed
	    if (e.keyCode == 27 && nav.linestate == 'search') {
        this.toggleSearch()
	    }
		})
	},

	onScroll (event) {
		if (navIsOpen) { // kinda silly but it works
			if (navCloseTolerance != 0) {
				navCloseTolerance -= 1;
			} else {
				navCloseTolerance = 20
				this.toggleNav()
			}
		}
	},

	onResize () {
		this.setLineStyle(nav.linestate)
	},

	animateNavOpen () {},
	animateNavClosed () {},
	animateSubMenu () {},

	toggleNav () {
		if (navIsOpen) {
			nav.main.classList.replace('nav-main--expanded', 'nav-main--collapsed')
			document.getElementById('nav-toggle').firstChild.innerHTML = 'open'
			this.animateNavClosed()
		} else {
			nav.main.classList.replace('nav-main--collapsed', 'nav-main--expanded')
			document.getElementById('nav-toggle').firstChild.innerHTML = 'close'
			this.animateNavOpen()
		}
		navIsOpen = !navIsOpen
	},

	toggleSearch () {
		let qb = document.querySelector('.nav-main__quickbar').classList

		if (nav.search == 'closed') {
			nav.search = 'open'

			qb.add('nav-main__quickbar--search-open')
			nav.linestate = 'search'
			document.getElementById('s').focus()
		}

		else {
			nav.search = 'closed'
			document.getElementById('s').blur()
			qb.remove('nav-main__quickbar--search-open')
			nav.linestate = 'closed'
		}

		this.setLineStyle(nav.linestate)
	},

	setLineStyle(state) {
		const ns = scaleFactor => { return 'transform: scaleX(' + scaleFactor + ')' }

		if (state == 'closed') {
			let openW = document.getElementById('nav-toggle').firstChild.offsetWidth
			let navW = nav.main.offsetWidth
			let scale = (openW / navW) + ((openW / navW) * 0.2)

			nav.line.setAttribute('style', ns(scale))
		}

		if (state == 'search') {
			nav.line.setAttribute('style', ns(0.9))
		}
	}
}

export default Navigation
