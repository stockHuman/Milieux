<?php // Integrations with plugins

/**
 * Return the featured image for an event (within the loop automatically will get event ID).
 *
 * Where possible, the image will be returned as a well formed <img> tag contained in a link
 * element and wrapped in a div used for targetting featured images from stylesheet. By setting
 * the two final and optional parameters to false, however, it is possible to retrieve only
 * the image URL itself.
 *
 * @category Events
 *
 * @param int    $post_id
 * @param string $size
 * @param bool   $link
 * @param bool   $wrapper
 *
 * @return string
 */
function milieux_event_featured_image ( $post_id = null, $size = 'full', $link = true) {
	if ( is_null( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );

	if ( is_array( $featured_image ) ) {
		$featured_image = $featured_image[ 0 ];
	}

	return '<noscript><img src="' . $featured_image .'"/></noscript>'
		.'<div class="hero-container" style="padding-bottom: '
		. _mlx_get_image_ratio_padding(get_post_thumbnail_id( $post_id ))
		. '%"><img class="featured-image hero lazyload" src="'
		. $featured_image
		. '" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="'
		. ' data-srcset="' . wp_get_attachment_image_srcset(get_post_thumbnail_id( $post_id ))
		. '" data-sizes="auto'
		. '" alt="'. esc_html ( get_the_post_thumbnail_caption(get_post_thumbnail_id( $post_id )) ) . '"></div>';
}

/**
 * ACF save json folder
 */
function milieux_acf_json_save_point( $path ) {
  return get_stylesheet_directory() . '/assets/acf-json';
}
add_filter( 'acf/settings/save_json', 'milieux_acf_json_save_point', 1 );

/**
 * ACF load json folder
 */
function milieux_acf_json_load_point( $paths ) {
	unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/assets/acf-json';
  return $paths;
}
add_filter( 'acf/settings/load_json', 'milieux_acf_json_load_point', 1 );
