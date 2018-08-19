<?php
/**
 * Returns the file modification time to bust cache on update
 * @param  string $file_URL The asset to test
 * @return string           Timestamp string to append as query var
 */
function fmt ( $file_URL ) {
  $fpath = get_template_directory_uri() . '/assets/' . $file_URL;
  if (file_exists($fpath)) {
    $t = filemtime( $fpath );
      if ($t != false) { return $t; }
      else return '';
  } else return '';
}

function site_scripts() {
  global $wp_styles;
  $td_URI = get_template_directory_uri() . '/assets/';

  wp_enqueue_script( 'site-js', $td_URI . 'js/app.min.js', 			array(), fmt('js/app.min.js'), 			true );
  wp_enqueue_script( 'twitter', $td_URI . 'js/twitter.min.js',	array(), fmt('js/twitter.min.js'),	true );

  wp_enqueue_style( 'milieux',  $td_URI . 'css/style.css', 			array(), fmt('css/style.css'), 'all' );

  if ( has_post_thumbnail() || is_page_template( 'template-events.php' )) {
  	wp_enqueue_script( 'lazysizes', $td_URI . 'js/lazysizes.min.js', array(), '4.0.3', true);
  }
}

add_action('wp_enqueue_scripts', 'site_scripts', 999);


function milieux_login_stylesheet() {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'milieux_login_stylesheet' );
