/*
  Navigation
*/

const Navigation = {
	onDOM () {
		const nav = document.getElementById('nav-main')
		let navIsOpen = false

		nav.addEventListener('click', () => {
			if (navIsOpen) {
				nav.classList.replace('nav-main--expanded', 'nav-main--collapsed')
			} else {
				nav.classList.replace('nav-main--collapsed', 'nav-main--expanded')
			}
			navIsOpen = !navIsOpen

		})
	}
}

export default Navigation
