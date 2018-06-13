<?php
function wphead_init() {
	remove_action( 'wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wp_generator');
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'index_rel_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head');
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0);
	remove_action( 'wp_head', 'start_post_rel_link');
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'admin_print_styles');
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
	remove_filter( 'wp_head', 'comment_text_rss' );
}

add_action('after_setup_theme', 'wphead_init' );

function modify_footer_admin () {
  echo 'Developed by <a href="https://michaelhemingway">Michael Hemingway</a> & designed by <a href="https://valeriebourdon.com"> Valerie Bourdon</a> with ❤ in association with OBX labs in Montreal, Canada.';
}
add_filter('admin_footer_text', 'modify_footer_admin');
