import nav from './navigation.js'
import ui from './ui.js'

'use strict';

document.body.parentNode.className = 'js'

document.addEventListener('DOMContentLoaded', () => {
	nav.onDOM()
	ui.onDOM()
})
