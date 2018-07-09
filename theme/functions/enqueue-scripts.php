<?php

function site_scripts() {
  global $wp_styles;

  wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/app.min.js', array(), '', true );
  wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all' );

  if ('feature' === get_post_type()) {
  	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array(), '', true);
  }
}

add_action('wp_enqueue_scripts', 'site_scripts', 999);
