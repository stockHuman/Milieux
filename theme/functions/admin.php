<?php

/**
 * Improvements and customisations to the WP Admin
 */

// Disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// Remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// Removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
}
add_action('admin_menu', 'disable_default_dashboard_widgets');


// Calling all custom dashboard widgets
function milieux_custom_dashboard_widgets() {}
add_action('wp_dashboard_setup', 'milieux_custom_dashboard_widgets');


/**
 * Adds a cute custom footer to the wordpress Admin
 */
function milieux_modify_footer_admin () {
  echo 'Developed by <a href="https://michaelhemingway">Michael Hemingway</a> with ❤ the Milieux Institute in Montreal, Canada.';
}
add_filter('admin_footer_text', 'milieux_modify_footer_admin');


// Remove the admin bar, as the single post edit icon is less intrusive and allows for the same
// return to the admin interface
add_filter('show_admin_bar', '__return_false');


/**
 * Changes plugins display order in the admin, showing active plugins first.
 * @author Sergey Biryukov http://profiles.wordpress.org/sergeybiryukov/
 */
function milieux_sort_plugins_by_status() {
	global $wp_list_table, $status;

	if ( ! in_array( $status, array( 'inactive', 'recently_activated', 'mustuse' ) ) ) {
		uksort( $wp_list_table->items, '_milieux_order_callback' );
	}
}

function _milieux_order_callback( $a, $b ) {
	global $wp_list_table;

	$a_active = is_plugin_active( $a );
	$b_active = is_plugin_active( $b );

	if ( $a_active && $b_active ) {
		return strcasecmp( $wp_list_table->items[ $a ]['Name'], $wp_list_table->items[ $b ]['Name'] );
	} elseif ( $a_active && ! $b_active ) {
		return -1;
	} elseif ( ! $a_active && $b_active ) {
		return 1;
	} else {
		return strcasecmp( $wp_list_table->items[ $a ]['Name'], $wp_list_table->items[ $b ]['Name'] );
	}
}
add_action( 'admin_head-plugins.php', 'milieux_sort_plugins_by_status' );


function load_custom_wp_admin_style() {
  wp_register_style( 'custom_wp_admin', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
