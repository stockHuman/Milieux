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
		'rest_base'          => 'bylines',
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

	// Test if request is being made via REST API
	// see: https://wordpress.stackexchange.com/questions/221202/
	$isRest = false;
  if ( function_exists( 'rest_url' ) && !empty( $_SERVER[ 'REQUEST_URI' ] ) ) {
    $sRestUrlBase = get_rest_url( get_current_blog_id(), '/' );
		$sRestPath = trim( parse_url( $sRestUrlBase, PHP_URL_PATH ), '/' );
		$sRequestPath = trim( $_SERVER[ 'REQUEST_URI' ], '/' );
    $isRest = ( strpos( $sRequestPath, $sRestPath ) === 0 );
  }

	if (is_object($post)) {
		$author = get_the_term_list($post->ID, 'byline', '', ', ', '');
		if ($author == false) { // loose check for false values
			$author = 'Milieux';
		}
	} else {
		$author = 'Milieux';
	}


	if ($author && !is_admin() && !is_feed()) {
		$name = $author;
		return $name;
	}

	// Preserves native Wordpress author for feeds
	if ($author && is_feed()) {
		$name = get_the_author();
		return $name;
	}

	// if rest...
	if ($isRest) {
		$detailsArray = array();
		$detailsArray['name'] = $author;
		$detailsArray['byline'] = $author;
		$detailsArray['link'] = ($author === 'Milieux') ? null : $author;
		$detailsArray['user_nicename'] = get_the_author_meta('user_nicename');
		$detailsArray['nickname'] = get_user_meta($post_author, 'nickname', true);

		return $detailsArray;
	}
}
add_action( 'init', 'milieux_add_byline_taxonomy', 10 ); // Custom Bylines
add_filter( 'the_author', 'byline' ); // Bylines display
add_filter( 'get_the_author_display_name', 'byline' ); // Bylines setup
