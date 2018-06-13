<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package milx
 */

/**
 * Shortcode for page intros
 * Usage: [page-intro]xxxx[/page-intro]
 */
add_shortcode('page-intro', 'introShortcode');
function introShortcode($attr, $content = null) {
	return
	'<section class="page__section-intro" />
		<header class="entry-header"><h1 class="entry-title">'
		. get_the_title()
		. '</h1></header>'
		. get_the_post_thumbnail()
		. $content
		. '<div class="scroll-arrow"><span></span><span></span><span></span></div>'
		. '</section>';
}

/**
 * Shortcode for page section
 * Usage: [page-section]xxxx[/page-section]
 */
add_shortcode('page-section', 'sectionShortcode');
function sectionShortcode($attr, $content = null) {
	return '<section class="page__section-theme">' . $content . '</section>';
}


/**
 * Shortcode for blockquotes
 * Usage: [blockquote]xxxx[/blockquote]
 */
add_shortcode('blockquote', 'blockqShortcode');
function blockqShortcode($attr, $content = null) {
	return '<blockquote>' . $content . '</blockquote>';
}


/**
 * Shortcode for file links
 * Usage: [file link="link.url"]xxxx[/file]
 */
add_shortcode('file', 'fileShortcode');
function fileShortcode($attr = [], $content = null, $tag = 'file') {
	// no link provided, error and return early
	if ( !array_key_exists( 'link', $attr) ) {
		$retval = '<h3 style="color:red">NO LINK PROVIDED: use shortcode like so</h3><br/><p>[file link="your link here]link title[/file]</p>';
		return $retval;
	}

	$a = shortcode_atts( array(
		'link' => 'example.com',
	), $attr );

	$retval = '<div class="file-link"><a download href="';
	$retval .= $a['link'];
	$retval .= '"><svg><use xlink:href="' . get_stylesheet_directory_uri() .'/assets/icons/fa-regular.svg#save"></use></svg>';
	$retval .= do_shortcode($content); // recursively check for shortcodes
	$retval .= '</a></div>';
	return $retval;
}

