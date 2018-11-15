<?php
/**
 *
 */
function milieux_featured_image () {
  if (!has_post_thumbnail()) {
    return;
  }
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
  if (!$meta) return 0;
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
  $date_string = get_field('event_date', $id);   // YYYYmd => 20180908
  $day_string = '';
  $days_string = '';

  if (!($date_type == 'multi')) { // multiple dates are handled differently
    $month_string = DateTime::createFromFormat('!m', substr($date_string, 4, 2))->format($monthFormat);
  } else {
    $month_string = ''; // TODO: migrate logic from milieux_get_events()
  }

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

  if ( $date_type == 'multi') {
    $dates = get_field('event_dates');
    foreach ($dates as $date) {
      $days_string .= substr($date['event_dates_date'], 6, 2) . ', ';
    }
    $days_string = substr($days_string, 0, -2); // remove last comma
  }

  if (!($date_type == 'multi')) {
    return array(
      'day' => $day_string,
      'month' => $month_string,
      'address' => $addr_string
    );
  } else {
    return array(
      'days' => $days_string,
      'month' => $month_string,
      'address' => $addr_string
    );
  }
}

/**
 * Makes two requests and sorts all event types into one coherent list
 * @return array of normalised events, sorted by date
 */
function milieux_get_events () {
  $today = date('Ymd');
  $events = array();

  $events_single_and_range = get_posts(array(
    'post_type' => 'event',
    'posts_per_page' => 10,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'event_date',
        'value' => $today,
        'compare' => '>=' // truncate results older than today
      ),
      array(
        'key' => 'event_type',
        'value' => 'multi',
        'compare' => '!=' // exclude multi events
      )
    ),
    'meta_key' => 'event_date', // name of custom field
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
  ));


  if ($events_single_and_range) {
    // sort through posts for range events and determine what date to send back
    foreach ($events_single_and_range as $event) {
      $e_meta = get_post_meta($event->ID);

      $formatted_event = array(
        'ID' => $event->ID,
        'event_author' => $event->post_author,
        'event_content' => $event->post_content,
        'event_title' => $event->post_title,
        'event_name' => $event->post_name,
        'event_excerpt' => $event->post_excerpt,
        'event_date' => $e_meta['event_date'][0], // just in case
        'event_type' => $e_meta['event_type'][0],
        'order' => $e_meta['event_date'][0], // we're changing this
        'event_meta' => array(
          'location' => $e_meta['event_location'][0],
          'cta_link' => $e_meta['event_cta_link'][0],
          'cta_text' => $e_meta['event_cta_text'][0],
          'time_start' => $e_meta['event_time'][0],
          'time_end' => $e_meta['event_time_end'][0],
        ),
      );

      // handle edge case where ranged event could be in the middle of happening
      if ($e_meta['event_type'] == 'range') {
        if ($e_meta['event_date_end'] >= $today && $today >= $e_meta['event_date']) {
          $formatted_event['order'] = $today;
        } // else leave as is, event = start date
      }
      array_push($events, $formatted_event);
    }
  }

  $events_multi = get_posts(array(
    'post_type' => 'event',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'meta_query' => array(
      array(
        'key' => 'event_type',
        'value' => 'multi',
        'compare' => '==' // exclude multi events
      )
    ),
  ));

  if ($events_multi) {
    foreach ($events_multi as $event) {
      $e_meta = get_post_meta($event->ID);
      $numdates = $e_meta['event_dates'][0];

      // add dates to array (formatted as Ymd) from acf generated keys
      if ($numdates > 0) {
        $dates = array();
        $isCurrent = false;
        for ($i = 0; $i < $numdates; $i++) {
          $dates[$i] = $e_meta['event_dates_' . $i . '_event_dates_date'][0];
          if ($dates[$i] >= $today) { // at least one event exists that is either current or in the future
            $isCurrent = true;
          }
        }

        if ($isCurrent) { // at least one date is either present or in future
          $formatted_event = array(
            'ID' => $event->ID,
            'event_author' => $event->post_author,
            'event_content' => $event->post_content,
            'event_title' => $event->post_title,
            'event_name' => $event->post_name,
            'event_excerpt' => $event->post_excerpt,
            'event_date' => $dates[0], // default to first date
            'event_type' => 'multi',
            'order' => $dates[0], // default to first date
            'event_meta' => array(
              'dates' => $dates
            ),
          );

          // iterate over dates to determine nearest date
          for ($i = count($dates); $i > 0; $i--) {
            if ($dates[$i - 1] >= $today) {
              $formatted_event['order'] = $dates[$i - 1];
            }
          }

          array_push($events, $formatted_event);
        }
      }
    }
  }

  // sort all posts by order field, returns in ascending order,
  // nearest to furthest into the future
  // Note PHP 7 'spaceship' operator syntax
  usort($events, function($a, $b) {
    return $a['order'] <=> $b['order'];
  });

  return $events;
}


function milieux_get_event( $id = null ) {
  error_reporting(0); // ignore notices of undefined indeces
  if (!isset($id)) { return; }
  $today = date('Ymd');
  $event = get_post($id);
  $meta = get_post_meta($id);
  $type = $meta['event_type'];


  if ($type != 'multi') {
    $formatted_event = array(
      'ID' => $event->ID,
      'event_author' => $event->post_author,
      'event_content' => $event->post_content,
      'event_title' => $event->post_title,
      'event_name' => $event->post_name,
      'event_excerpt' => $event->post_excerpt,
      'event_date' => $meta['event_date'][0], // just in case
      'event_type' => $meta['event_type'][0],
      'order' => $meta['event_date'][0], // we're changing this
      'event_meta' => array(
        'location' => $meta['event_location'][0],
        'cta_link' => $meta['event_cta_link'][0],
        'cta_text' => $meta['event_cta_text'][0],
      ),
    );

    // handle edge case where ranged event could be in the middle of happening
    if ($meta['event_type'] == 'range') {
      if ($meta['event_date_end'] >= $today && $today >= $meta['event_date']) {
        $formatted_event['order'] = $today;
      } // else leave as is, event = start date
    } else {
      $formatted_event['event_meta']['time_start'] = $meta['event_time'][0];
      $formatted_event['event_meta']['time_end'] = $meta['event_time_end'][0];
    }
    error_reporting(E_ALL);
    return $formatted_event;

  } else {
    $numdates = $meta['event_dates'][0];

    // add dates to array (formatted as Ymd) from acf generated keys
    if ($numdates > 0) {
      $dates = array();
      $isCurrent = false;
      for ($i = 0; $i < $numdates; $i++) {
        $dates[$i] = $meta['event_dates_' . $i . '_event_dates_date'][0];
        if ($dates[$i] >= $today) { // at least one event exists that is either current or in the future
          $isCurrent = true;
        }
      }

      if ($isCurrent) { // at least one date is either present or in future
        $formatted_event = array(
          'ID' => $event->ID,
          'event_author' => $event->post_author,
          'event_content' => $event->post_content,
          'event_title' => $event->post_title,
          'event_name' => $event->post_name,
          'event_excerpt' => $event->post_excerpt,
          'event_date' => $dates[0], // default to first date
          'event_type' => 'multi',
          'order' => $dates[0], // default to first date
          'event_meta' => array(
            'dates' => $dates
          ),
        );

        // iterate over dates to determine nearest date
        for ($i = count($dates); $i > 0; $i--) {
          if ($dates[$i - 1] >= $today) {
            $formatted_event['order'] = $dates[$i - 1];
          }
        }
        error_reporting(E_ALL);
        return $formatted_event;
      }
    }
  }
}
