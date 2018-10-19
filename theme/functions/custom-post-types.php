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


// Painstakingly documented @ https://acfextras.com/dont-query-repeaters/
// create a function that will convert this repeater during the acf/save_post action
// priority of 20 to run after ACF is done saving the new values
add_filter('save_post', 'convert_event_date_to_standard_wp_meta', 20, 3);

function convert_event_date_to_standard_wp_meta($post_id) {

  // pick a new meta_key to hold the values of the color field
  // I generally name this field by suffixing _wp to the field name
  // as this makes it easy for me to remember this field name
  // also note, that this is not an ACF field and will not
  // appear when editing posts, it is just a db field that we
  // will use for searching
  $meta_key = 'event_date_wp';

  // the next step is to delete any values already stored
  // so that we can update it with new values
  // and we don't need to worry about removing a value
  // when it's deleted from the ACF repeater
  delete_post_meta($post_id, $meta_key);

  // create an array to hold values that are already added
  // this way we won't add the same meta value more than once
  // because having the same value to search and filter by
  // would be pointless
  $saved_values = array();

  // now we'll look at the repeater and save any values
  if (have_rows('event_dates', $post_id)) {
    while (have_rows('event_dates', $post_id)) {
      the_row();

      // get the value of this row
      $date = get_sub_field('event_dates_date');

      // see if this value has already been saved
      // note that I am using isset rather than in_array
      // the reason for this is that isset is faster than in_array
      if (isset($saved_values[$date])) {
        // no need to save this one we already have it
        continue;
      }

      // not already save, so add it using add_post_meta()
      // note that we are using false for the 4th parameter
      // this means that this meta key is not unique
      // and can have more then one value
			if ( ! add_post_meta($post_id, $meta_key, $date, false) ) {
				update_post_meta($post_id, $meta_key, $date, false);
			}

      // add it to the values we've already saved
      $saved_values[$date] = $date;

    } // end while have rows
	} // end if have rows
	else { // test for the event date filed in single and range events
		if (get_field('event_date')) {
			$date = get_field('event_date'); // get the date value

			// same logic as above
			if ( ! add_post_meta($post_id, $meta_key, $date, false) ) {
				update_post_meta($post_id, $meta_key, $date, false);
			}
 			$saved_values[$date] = $date;
		}
	}
} // end function
