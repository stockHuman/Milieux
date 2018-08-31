<?php

/**
 * Add new "bylines" taxonomy to Features
 * @author Matt Dulin <http://mattdulin.com>
 * @license GPL2
 */
function milieux_add_byline_taxonomy () {

	$labels = array(
		'name' 					=> _x('Bylines', 'taxonomy general name', 'milieux') ,
		'singular_name' => _x('Byline', 'taxonomy singular name', 'milieux') ,
		'search_items'	=> __('Search Bylines', 'milieux') ,
		'popular_items' => __('Popular Bylines', 'milieux') ,
		'all_items' 		=> __('All Bylines', 'milieux') ,
		'edit_item' 		=> __('Edit Byline', 'milieux') ,
		'update_item' 	=> __('Update Byline', 'milieux') ,
		'add_new_item' 	=> __('Add New Byline', 'milieux') ,
		'new_item_name' => __('New Byline Name', 'milieux') ,
		'menu_name' 		=> __('Bylines', 'milieux'),
		'add_or_remove_items' => __('Add or remove bylines', 'milieux') ,
		'choose_from_most_used' => __('Choose from most used bylines', 'milieux') ,
		'separate_items_with_commas' => __('Separate bylines with commas', 'milieux') ,
	);

	register_taxonomy('byline', array('feature', 'post'), array(
		'hierarchical'			 => false,
		'show_admin_column'	 => true,
		'show_in_rest'       => true, // new!
		'rest_base'          => 'byline',
		'publicly_queryable' => true,
		'labels' => $labels,
		'rewrite' => array(
			'slug' => 'byline', // This controls the base slug that will display before each term
			'with_front' => true, // Don't display the category base before "/bylines/"
			'show_tagcloud' => false, // We don't want to make prominent authors *too* prominent.
			'show_ui' => true
			// This will allow URL's like "/bylines/boston/cambridge/"
		)
	));
}

// Display the byline by replacing instances of the_author throughout most areas of the site
function byline ( $name ) {
	global $post;
	$author = get_the_term_list($post->ID, 'byline', '', ', ', '');

	if ($author && !is_admin() && !is_feed()) {
		$name = $author;
		return $name;
	}

	// Preserves native Wordpress author for feeds
	if ($author && is_feed()) {
		$name = get_the_author();
		return $name;
	}
}
add_action( 'init', 'milieux_add_byline_taxonomy', 10 ); // Custom Bylines
add_filter( 'the_author', 'byline' ); // Bylines display
add_filter( 'get_the_author_display_name', 'byline' ); // Bylines setup
