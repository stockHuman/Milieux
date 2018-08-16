<?php
/**
 *
 */
function milieux_featured_image () {
	return '<noscript><img= src="' . get_the_post_thumbnail_url() . '"/></noscript>'
	.'<div class="hero-container" style="padding-bottom: '
	. _mlx_get_image_ratio_padding(get_post_thumbnail_id())
	. '%"><img class="featured-image hero lazyload" src="'
	. get_the_post_thumbnail_url()
	. '" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="'
	. '" data-srcset="' . wp_get_attachment_image_srcset(get_post_thumbnail_id())
	. '" data-sizes="auto'
	. '" alt="'. esc_html ( get_the_post_thumbnail_caption() ) . '"></div>';
}



/**
 * returns image aspect ratio, so to set padding and eliminate page reflows
 * @param  [type] $ID [description]
 * @return string     integer value representing the % height
 */
function _mlx_get_image_ratio_padding ($ID) {
	$meta = wp_get_attachment_metadata($ID);
	return ($meta['sizes']['medium']['height'] / $meta['sizes']['medium']['width']) * 100;
}



/**
 * Return the featured image for an event (within the loop automatically will get event ID).
 *
 * Where possible, the image will be returned as a well formed <img> tag  used for targetting featured
 * images from stylesheet. By setting the two final and optional parameters to true, however, it is
 * possible to retrieve the tag contained in a link element and wrapped in a div.
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
function milieux_event_featured_image( $post_id = null, $size = 'full', $link = false, $class = 'hero-container') {
  if ( is_null( $post_id ) ) {
    $post_id = get_the_ID();
  }

  $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size, false );

  if ( is_array( $featured_image ) ) {
    $featured_image = $featured_image[ 0 ];
  }

  return '<noscript><img src="' . $featured_image .'"/></noscript>'
    .'<div class="'. $class .'" style="padding-bottom: '
    . _mlx_get_image_ratio_padding(get_post_thumbnail_id( $post_id ))
    . '%"><img class="featured-image hero lazyload" src="'
    . $featured_image
    . '" srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="'
    . ' data-srcset="' . wp_get_attachment_image_srcset(get_post_thumbnail_id( $post_id ))
    . '" data-sizes="auto'
    . '" alt="'. esc_html( get_the_post_thumbnail_caption(get_post_thumbnail_id( $post_id )) ) . '"></div>';
}



/**
 * Modifies the image tag, by prepending a figure tag and adding necessary classes
 *
 * @param $image
 * @param $attachment_id
 * @param $image_size
 *
 * @return mixed|string
 */
function milieux_modify_image_tag( $image, $attachment_id, $image_size ) {
  $image_src = preg_match( '/src="([^"]+)"/', $image, $match_src ) ? $match_src[1] : '';
  list( $image_src ) = explode( '?', $image_src );

  // Return early if we couldn't get the image source.
  if ( ! $image_src ) {  return $image; }

  //Get attachment meta for sizes
  $size_large  = wp_get_attachment_image_src( $attachment_id, 'large' );
  $size_medium = wp_get_attachment_image_src( $attachment_id, 'medium' );

  $size_large  = $size_large ? $size_large[0] : '';
  $size_medium = $size_medium ? $size_medium[0] : '';

  //Check if the image already have a respective attribute
  if ( ! strpos( $image, 'data-large' ) && ! empty( $size_large ) ) {
    $attr = sprintf( ' data-large="%s"', esc_attr( $size_large ) );
  }

  if ( ! strpos( $image, 'data-medium' ) && ! empty( $size_medium ) ) {
    $attr .= sprintf( ' data-medium="%s"', esc_attr( $size_medium ) );
  }

  // Add 'data' attributes
  $image = preg_replace( '/<img ([^>]+?)[\/ ]*>/', '<img $1' . $attr . ' />', $image );

  //Append figure tag
  $r_image = sprintf( '<figure id="image-%d" class="size-%s">', $attachment_id, $image_size );
  $r_image .= $image . '</figure>';

  return $r_image;
}
add_filter( 'the_content', 'milieux_inline_modify_images', 100 );



/**
 * Get all the image tags from content and modify them
 * @link https://wordpress.stackexchange.com/questions/220739/
 * @param $content
 *
 * @return mixed
 */
function milieux_inline_modify_images( $content ) {
  if ( ! preg_match_all( '/<img [^>]+>/', $content, $matches ) ) {
    return $content;
  }

  $selected_images = $attachment_ids = array();

  foreach ( $matches[0] as $image ) {
    if ( preg_match( '/size-([a-z]+)/i', $image, $class_size )
      && preg_match( '/wp-image-([0-9]+)/i', $image, $class_id )
      && $image_size = $class_size[1]
      && $attachment_id = absint( $class_id[1] ) ) {
      /*
       * If exactly the same image tag is used more than once, overwrite it.
       * All identical tags will be replaced later with 'str_replace()'.
       */
      $selected_images[ $image ] = $attachment_id;
      // Overwrite the ID when the same image is included more than once.
      $attachment_ids[ $attachment_id ] = true;
    }
  }

  foreach ( $selected_images as $image => $attachment_id ) {
    $content = str_replace( $image, milieux_modify_image_tag( $image, $attachment_id, $image_size ), $content );
  }

  return $content;
}



/**
 * Customize icons with Font Awesome
 * Currently disabled as google forms is being retired
 */
// function milieux_fa_icons () {
//   if (is_admin()) {
//     wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

//     $style = '
//     <style>
//       .menu-icon-wpgform .dashicons-before:before {
//         font-family: FontAwesome, dashicons; content: "\f1c7"; font-size: 18px;
//       }
//       .menu-icon-wpgform img { display: none}
//     </style>'; // fa-file-audio-o
//     echo $style;
//   }
// }
// add_action( 'admin_head', 'milieux_fa_icons', 10, 1 );

/**
 * Returns an array of template-ready values for event time and place display
 * @param  int     $id           the post ID, for ACF lookup
 * @param  boolean $showAddress  show or hide the address string
 * @param  boolean $longMonth    Display month as M or F (Aug, August)
 * @return array                 String array of requested meta values
 */
function milieux_event_meta ( $id = null, $showAddress = true, $longMonth = false ) {
  if ($id == null) {
    $id = get_the_ID();
  }

  if ($longMonth == true) {
    $monthFormat = 'F'; // August
  } else {
    $monthFormat = 'M'; // Aug
  }

  // grab details from ACF

  $date_type = get_field('event_type', $id);     // single, range, multiple
  $date_string = get_field('event_date', $id);   // YYYYmd or 20180908
  $day_string = '';
  $month_string = DateTime::createFromFormat('!m', substr($date_string, 4, 2))->format($monthFormat);

  if ($showAddress) {
    $addr_string = get_field('event_location', $id);
  } else {
    $addr_string = false;
  }

  if ( $date_type == 'single' ) {
    $day_string = substr($date_string, 6, 2);
  }

  if ( $date_type == 'range' ) {
    $day_string = substr($date_string, 6, 2) . ' - ' . substr(get_field('event_date_end', $id), 6, 2);
  }

  // TODO: multiple dates
  return array(
    'day' => $day_string,
    'month' => $month_string,
    'address' => $addr_string
  );
}
