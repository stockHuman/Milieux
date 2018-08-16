<?php

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


// Calling all custom dashboard widgets
function milieux_custom_dashboard_widgets() {
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}

// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
add_action('wp_dashboard_setup', 'milieux_custom_dashboard_widgets');

function milieux_modify_footer_admin () {
  echo 'Developed by <a href="https://michaelhemingway">Michael Hemingway</a> with ❤ the Milieux Institute in Montreal, Canada.';
}
add_filter('admin_footer_text', 'milieux_modify_footer_admin');

// Remmove the admin bar, as the single post edit icon is less intrusive and allows for the same
// return to the admin interface
add_filter('show_admin_bar', '__return_false');
