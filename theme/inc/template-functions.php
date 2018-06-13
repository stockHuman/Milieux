<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package milx
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function milx_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'milx_body_classes' );



// via https://www.advancedcustomfields.com/resources/local-json/
function milx_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/assets/acf-json';

	// return
	return $path;
}
add_filter('acf/settings/save_json', 'milx_acf_json_save_point');

/**
 * via https://codex.wordpress.org/Post_Types
 */

function create_post_type() {
	register_post_type( 'video',
	array(
		'labels' => array(
			'name' => __( 'Videos' ),
			'singular_name' => __( 'Video' )
		),
		'public' => true,
		'hierarchical' => false,
		'has_archive' => true,
		'supports' => ['title', 'thumbnail'],
		'menu_icon' => 'dashicons-video-alt2',
	)
	);
}
add_action( 'init', 'create_post_type' );
