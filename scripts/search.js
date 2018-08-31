/**
 * Search page JS
 */
(function () {
	'use strict';
	// easy out
	if (!document.body.classList.contains('search-results')) return;

	const container = document.querySelector('.container');

	const cards = document.querySelectorAll('.c-card');

	cards.forEach(card => {

		let img = card.querySelector('.wp-post-image')
		if (img) {

			card.addEventListener('mouseover', () => {
				container.style = 'background-image: url(' + img.src +');'
			})
			card.addEventListener('mouseleave', () => {
				container.style = 'background-image: #fff'
			})
		}

	})

}());
