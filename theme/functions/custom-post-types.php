<?php
/*
	milieux Custom Post Type Example
*/

function milieux_register_article_post_type () {

	$labels = array(
		'name' => __('Features', 'milieux'),
		'singular_name' => __('Feature', 'milieux'),
		'all_items' => __('All Features', 'milieux'),
		'add_new' => __('New Feature', 'milieux'),
		'add_new_item' => __('Publish a new Feature', 'milieux'), /* Add New Display Title */
		'edit' => __( 'Edit', 'milieux' ), /* Edit Dialog */
		'edit_item' => __('Edit Features', 'milieux'), /* Edit Display Title */
		'new_item' => __('New Feature', 'milieux'), /* New Display Title */
		'view_item' => __('View Feature', 'milieux'), /* View Display Title */
		'search_items' => __('Search Features', 'milieux'), /* Search Custom Type Title */
		'parent_item_colon' => ''
	);

	register_post_type( 'feature',
		array(
			'labels' => $labels,
			'description' => __( 'This is the example custom post type', 'milieux' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-format-aside',
			'show_in_rest' => true,
			'rest_base' => 'features',
			'rewrite'	=> array(
				'slug' => 'feature',
				'with_front' => false
			),
			'has_archive' => 'features',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'comments',
				'revisions',
				'sticky'
			)
	 	)
	);

	// /* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type('category', 'custom_type');
	// /* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type('post_tag', 'custom_type');
}
add_action( 'init', 'milieux_register_article_post_type');


function milieux_register_event_post_type () {

	$labels = array(
		'name' => __('Events', 'milieux'),
		'singular_name' => __('Event', 'milieux'),
		'all_items' => __('All Events', 'milieux'),
		'add_new' => __('New Event', 'milieux'),
		'add_new_item' => __('Publish a new Event', 'milieux'), /* Add New Display Title */
		'edit' => __( 'Edit', 'milieux' ), /* Edit Dialog */
		'edit_item' => __('Edit Events', 'milieux'), /* Edit Display Title */
		'new_item' => __('New Event', 'milieux'), /* New Display Title */
		'view_item' => __('View Event', 'milieux'), /* View Display Title */
		'search_items' => __('Search Events', 'milieux'), /* Search Custom Type Title */
		'parent_item_colon' => ''
	);

	register_post_type( 'event',
		array(
			'labels' => $labels,
			'description' => __( 'This is the event post type', 'milieux' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-calendar',
			'show_in_rest' => true,
			'rest_base' => 'events',
			'rewrite'	=> array(
				'slug' => 'event',
				'with_front' => false
			),
			'has_archive' => 'Events',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'comments',
				'revisions',
				'sticky'
			)
	 	)
	);
}
add_action( 'init', 'milieux_register_event_post_type');
