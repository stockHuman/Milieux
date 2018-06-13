// Uses ES6 syntax

(function () {
	'use strict';

	const w = window;
	const pagenav = document.querySelectorAll('.site-header')[0];

	if (pagenav) {
		w.addEventListener('scroll', () => {
			let scrollTop = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop)
			let scrollpos = Math.round(scrollTop)
			
			if (scrollpos > 50) {
				pagenav.classList = 'site-header scrolled'
			} else {
				pagenav.classList = 'site-header'
			}

			// hide search on scroll
			if (searchField.classList.contains('active')) {
				searchField.classList.remove('active');
			}
		})
	}


	// Header Search
	const searchField = document.querySelectorAll('.search')[0];
	const searchInput = document.querySelectorAll("input[type='search']")[0];

	var checkSearch = function () {
		var contents = searchInput.value;
		if (contents.length !== 0) {
			searchField.classList.add('full');
		} else {
			searchField.classList.remove('full');
		}
	};

	searchInput.addEventListener("focus" , function () {
		searchField.classList.add('active');
	})

	searchInput.addEventListener("blur", function () {
		searchField.classList.remove('active');
		checkSearch();
	})

	// Click on search icon
	document.querySelectorAll('.search-icon')[0].addEventListener('click', function () {
		searchInput.focus();
	})

	// Smoothscroll plugin
	const scroll = new SmoothScroll('a[href*="#"]', {header: '.site-header', speed: 1000});

}());

