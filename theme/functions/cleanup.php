<?php

// Fire all our initial functions at the start
add_action('after_setup_theme','arthem_start', 16);

function arthem_start() {

    // launching operation cleanup
    add_action('init', 'arthem_head_cleanup');

    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'arthem_remove_wp_widget_recent_comments_style', 1 );

    // clean up comment styles in the head
    add_action('wp_head', 'arthem_remove_recent_comments_style', 1);

    // clean up gallery output in wp
    add_filter('gallery_style', 'arthem_gallery_style');

    // adding sidebars to Wordpress
    add_action( 'widgets_init', 'arthem_register_sidebars' );

    // cleaning up excerpt
    add_filter('excerpt_more', 'arthem_excerpt_more');

} /* end arthem start */

//The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
function arthem_head_cleanup() {
	// Remove category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Remove post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// Remove EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );
	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );
} /* end arthem head cleanup */

// Remove injected CSS for recent comments widget
function arthem_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// Remove injected CSS from recent comments widget
function arthem_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// Remove injected CSS from gallery
function arthem_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// This removes the annoying […] to a Read More link
function arthem_excerpt_more($more) {
	global $post;
	// edit here if you like
return '<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'arthemwp') . get_the_title($post->ID).'">'. __('... Read more &raquo;', 'arthemwp') .'</a>';
}

// Adding svg support
function arth_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'arth_mime_types');

//  Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
function remove_sticky_class($classes) {
	if(in_array('sticky', $classes)) {
		$classes = array_diff($classes, array("sticky"));
		$classes[] = 'wp-sticky';
	}

	return $classes;
}
add_filter('post_class','remove_sticky_class');

//This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
function arthem_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'arthemwp' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
