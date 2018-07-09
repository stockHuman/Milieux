<?php

/**
	@author: Matt Dulin
	Author URI: http://mattdulin.com
	License: GPL2
*/

function plant_add_byline_taxonomy () {
	// Add new "bylines" taxonomy to Posts
	register_taxonomy('byline', array('feature', 'post'), array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		'show_admin_column' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' 											 => __('Bylines', 'milieux') ,
			'singular_name' 						 => __('Byline', 'milieux') ,
			'search_items'							 => __('Search Bylines') ,
			'popular_items'							 => __('Popular Bylines') ,
			'all_items'									 => __('All Bylines') ,
			'edit_item'									 => __('Edit Byline') ,
			'update_item'								 => __('Update Byline') ,
			'separate_items_with_commas' => __('Separate bylines with commas') ,
			'add_new_item'							 => __('Add New Byline') ,
			'add_or_remove_items'				 => __('Add or remove bylines') ,
			'choose_from_most_used'			 => __('Choose from most used bylines') ,
			'new_item_name'							 => __('New Byline Name') ,
			'menu_name'									 => __('Bylines')
		) ,
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'byline', // This controls the base slug that will display before each term
			'with_front' => true, // Don't display the category base before "/bylines/"
			'show_tagcloud' => false, // We don't want to make prominent authors *too* prominent.
			'show_ui' => true
			// This will allow URL's like "/bylines/boston/cambridge/"
		) ,
	));
}
// Display the byline by replacing instances of the_author throughout most areas of the site
function byline($name)
{
	global $post;
	$author = get_the_term_list($post->ID, 'byline', '', ', ', '');
	if ($author && !is_admin() && !is_feed())
		$name = $author;
	return $name;

	if ($author && is_feed()) //Preserves native Wordpress author for feeds
		$name = get_the_author();
	return $name;
}
add_action('init', 'plant_add_byline_taxonomy', 0); // Custom Bylines
add_filter('the_author', 'byline'); // Bylines display
add_filter('get_the_author_display_name', 'byline'); // Bylines setup
