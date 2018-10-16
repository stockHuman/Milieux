/*
  Navigation
*/

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

		// Add support nested menus
		nav.subMenuDOMItems = nav.main.querySelectorAll('.menu-item-has-children')
		nav.subMenus = []
		for (let i = 0; i < nav.subMenuDOMItems.length; i++) {
			nav.subMenus[i] = { dom: nav.subMenuDOMItems[i], active: false }
			nav.subMenuDOMItems[i].addEventListener('click', () => {
				this.toggleSubMenu(i)
			})
		}

		// Listen for click events on body and dismiss if clicking outside
		// of the nav when open
		document.body.addEventListener('click', event => {
			if (navIsOpen) {
				if (!nav.main.contains(event.target)) {
				  this.toggleNav()
				}
			}
		})

		window.addEventListener('keydown', (e) => {
			// ESCAPE key pressed
			if (e.keyCode == 27) {
		    if (nav.linestate == 'search') {
	        this.toggleSearch()
	        return
	      }
	      if (navIsOpen) {
	      	this.toggleNav()
	      	return
	      }
			}
		})

		// listen for custom nav toggle event
		document.addEventListener('closeNav', () => {
			if (navIsOpen) { this.toggleNav() }
		}, false)
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

	toggleSubMenu (index) {
		const menu = nav.subMenus[index]
		const menuTitle = menu.dom.firstChild
		const menuContainer = nav.main.querySelector('.nav-main__content')

		menuContainer.classList.toggle('nav-main__content--submenu-open')
		menu.dom.classList.toggle('menu-item--active')

		menu.active = !menu.active
	},

	toggleNav () {
		if (navIsOpen) {
			nav.main.classList.replace('nav-main--expanded', 'nav-main--collapsed')
			document.getElementById('nav-toggle').firstChild.innerHTML = 'open'
		} else {
			nav.main.classList.replace('nav-main--collapsed', 'nav-main--expanded')
			document.getElementById('nav-toggle').firstChild.innerHTML = 'close'
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
