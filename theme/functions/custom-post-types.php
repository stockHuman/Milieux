<?php
/*
	milieux Custom Post Type Example
*/


// let's create the function for the custom type
// function custom_post_example() {
// 	// creating (registering) the custom type
// 	register_post_type( 'custom_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// 	 	// let's now add all the options for this post type
// 		array('labels' => array(
// 			'name' => __('Custom Types', 'milieux'), /* This is the Title of the Group */
// 			'singular_name' => __('Custom Post', 'milieux'), /* This is the individual type */
// 			'all_items' => __('All Custom Posts', 'milieux'), /* the all items menu item */
// 			'add_new' => __('Add New', 'milieux'), /* The add new menu item */
// 			'add_new_item' => __('Add New Custom Type', 'milieux'), /* Add New Display Title */
// 			'edit' => __( 'Edit', 'milieux' ), /* Edit Dialog */
// 			'edit_item' => __('Edit Post Types', 'milieux'), /* Edit Display Title */
// 			'new_item' => __('New Post Type', 'milieux'), /* New Display Title */
// 			'view_item' => __('View Post Type', 'milieux'), /* View Display Title */
// 			'search_items' => __('Search Post Type', 'milieux'), /* Search Custom Type Title */
// 			'not_found' =>  __('Nothing found in the Database.', 'milieux'), /* This displays if there are no entries yet */
// 			'not_found_in_trash' => __('Nothing found in Trash', 'milieux'), /* This displays if there is nothing in the trash */
// 			'parent_item_colon' => ''
// 			), /* end of arrays */
// 			'description' => __( 'This is the example custom post type', 'milieux' ), /* Custom Type Description */
// 			'public' => true,
// 			'publicly_queryable' => true,
// 			'exclude_from_search' => false,
// 			'show_ui' => true,
// 			'query_var' => true,
// 			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
// 			'menu_icon' => 'dashicons-book', /* the icon for the custom post type menu. uses built-in dashicons (CSS class name) */
// 			'rewrite'	=> array( 'slug' => 'custom_type', 'with_front' => false ), /* you can specify its url slug */
// 			'has_archive' => 'custom_type', /* you can rename the slug here */
// 			'capability_type' => 'post',
// 			'hierarchical' => false,
// 			/* the next one is important, it tells what's enabled in the post editor */
// 			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
// 	 	) /* end of options */
// 	); /* end of register post type */

// 	/* this adds your post categories to your custom post type */
// 	register_taxonomy_for_object_type('category', 'custom_type');
// 	/* this adds your post tags to your custom post type */
// 	register_taxonomy_for_object_type('post_tag', 'custom_type');
// }

// adding the function to the Wordpress init
// add_action( 'init', 'custom_post_example');

/*
for more information on taxonomies, go here:
http://codex.wordpress.org/Function_Reference/register_taxonomy
*/

// now let's add custom categories (these act like categories)
// register_taxonomy( 'custom_cat',
// 	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
// 		'labels' => array(
// 			'name' => __( 'Custom Categories', 'milieux' ), /* name of the custom taxonomy */
// 			'singular_name' => __( 'Custom Category', 'milieux' ), /* single taxonomy name */
// 			'search_items' =>  __( 'Search Custom Categories', 'milieux' ), /* search title for taxomony */
// 			'all_items' => __( 'All Custom Categories', 'milieux' ), /* all title for taxonomies */
// 			'parent_item' => __( 'Parent Custom Category', 'milieux' ), /* parent title for taxonomy */
// 			'parent_item_colon' => __( 'Parent Custom Category:', 'milieux' ), /* parent taxonomy title */
// 			'edit_item' => __( 'Edit Custom Category', 'milieux' ), /* edit custom taxonomy title */
// 			'update_item' => __( 'Update Custom Category', 'milieux' ), /* update title for taxonomy */
// 			'add_new_item' => __( 'Add New Custom Category', 'milieux' ), /* add new title for taxonomy */
// 			'new_item_name' => __( 'New Custom Category Name', 'milieux' ) /* name title for taxonomy */
// 		),
// 		'show_admin_column' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 		'rewrite' => array( 'slug' => 'custom-slug' ),
// 	)
// );

// // now let's add custom tags (these act like categories)
// register_taxonomy( 'custom_tag',
// 	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
// 	array('hierarchical' => false,    /* if this is false, it acts like tags */
// 		'labels' => array(
// 			'name' => __( 'Custom Tags', 'milieux' ), /* name of the custom taxonomy */
// 			'singular_name' => __( 'Custom Tag', 'milieux' ), /* single taxonomy name */
// 			'search_items' =>  __( 'Search Custom Tags', 'milieux' ), /* search title for taxomony */
// 			'all_items' => __( 'All Custom Tags', 'milieux' ), /* all title for taxonomies */
// 			'parent_item' => __( 'Parent Custom Tag', 'milieux' ), /* parent title for taxonomy */
// 			'parent_item_colon' => __( 'Parent Custom Tag:', 'milieux' ), /* parent taxonomy title */
// 			'edit_item' => __( 'Edit Custom Tag', 'milieux' ), /* edit custom taxonomy title */
// 			'update_item' => __( 'Update Custom Tag', 'milieux' ), /* update title for taxonomy */
// 			'add_new_item' => __( 'Add New Custom Tag', 'milieux' ), /* add new title for taxonomy */
// 			'new_item_name' => __( 'New Custom Tag Name', 'milieux' ) /* name title for taxonomy */
// 		),
// 		'show_admin_column' => true,
// 		'show_ui' => true,
// 		'query_var' => true,
// 	)
// );

/*
	looking for custom meta boxes?
	check out this fantastic tool:
	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
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
