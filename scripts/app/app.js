import nav from './navigation.js'
import ui from './ui.js'
import BGsrcset, { dynamicSort } from './home.js'

'use strict';

document.body.parentNode.className = 'js'

var scheduledAnimationFrame = false
var requestResize = false
var requestScroll = false

const scroll = { lastY : null }
const click = { last : null }
const touch = { last : null }

const bgss = new BGsrcset()
bgss.callonce = false
ui.backgroundsourceset = bgss

document.addEventListener('DOMContentLoaded', () => {
	nav.onDOM()
	ui.onDOM()

	bgss.init(".dynamic-bg", (a) => {
		a.node.classList.add("loaded")
	})

	document.addEventListener('scroll', scrollHandler, {
		// https://alligator.io/js/speed-up-scroll-events/
		capture: true,
		passive: true
	})
	window.addEventListener('resize', resizeHandler)
})

document.addEventListener('touchend', event => {
  if (scheduledAnimationFrame) return;

  scheduledAnimationFrame = true
  touch.last = event.touches
  requestAnimationFrame(update)
})

document.addEventListener('click', event => {
  if (scheduledAnimationFrame) return;

  scheduledAnimationFrame = true
  click.last = {x: event.clientX, y: event.clientY}
  requestAnimationFrame(update)
})


function scrollHandler (event) {
	scroll.lastY = window.scrollY
	if (scheduledAnimationFrame) return;

	scheduledAnimationFrame = true
	scroll.event = event
	requestScroll = true
	requestAnimationFrame(update)
}


function resizeHandler () {
	scheduledAnimationFrame = true
	requestResize = true
	requestAnimationFrame(update)
}


function update () {
	if (requestResize) {
		requestResize = false
		// place resize event fns here

		nav.onResize()
	}

	if (requestScroll) {
		requestScroll = false

		// place scroll event fns here
		nav.onScroll(scroll.lastY)
	}
	scheduledAnimationFrame = false
}
