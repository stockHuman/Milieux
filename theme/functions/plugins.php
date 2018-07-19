<?php // Integrations with plugins

/**
 * The Events Calendar (Milieux's preffered events management thing)
 *
 */

// via https://theeventscalendar.com/knowledgebase/removing-the-add-on-upsell/
define('TRIBE_HIDE_UPSELL', true);

function replace_tribe_events_calendar_stylesheet() {
   return; // silence is golden :P
}
add_filter('tribe_events_stylesheet_url', 'replace_tribe_events_calendar_stylesheet');


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

	/**
	 * Provides an opportunity to modify the featured image size.
	 *
	 * @param string $size
	 * @param int    $post_id
	 */
	$size = apply_filters( 'tribe_event_featured_image_size', $size, $post_id );

	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );

	if ( is_array( $featured_image ) ) {
		$featured_image = $featured_image[ 0 ];
	}

	return '<noscript><img= src="' . $featured_image .'"/></noscript>'
				.'<div class="hero-container" style="padding-bottom: '
				. _mlx_get_image_ratio_padding(get_post_thumbnail_id( $post_id ))
				. '%"><img class="featured-image hero lazyload" src="'
				. $featured_image
				. '" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="'
				. ' data-srcset="' . wp_get_attachment_image_srcset(get_post_thumbnail_id( $post_id ))
				. '" data-sizes="auto'
				. '" alt="'. esc_html ( get_the_post_thumbnail_caption(get_post_thumbnail_id( $post_id )) ) . '"></div>';
}
