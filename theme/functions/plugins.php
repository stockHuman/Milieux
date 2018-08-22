<?php // Integrations with plugins

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





/**
 * Better REST API Featured Images
 *
 * @package             Better_REST_API_Featured_Images
 * @author              Braad Martin <wordpress@braadmartin.com>
 * @license             GPL-2.0+

 * Plugin URI:          https://wordpress.org/plugins/better-rest-api-featured-images/
 * Description:         Adds a top-level field with featured image data to the post object returned by the REST API.
 * Version:             1.2.1
 * Author:              Braad Martin
 * Author URI:          http://braadmartin.com
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * this plugin has been modified from the original to better integrate with the milieux theme
 */


/**
 * Register our enhanced mlx_featured_image field to all public post types
 * that support post thumbnails.
 *
 * @since  1.0.0
 */
function mlx_rest_api_featured_images_init() {

	$post_types = get_post_types( array( 'public' => true ), 'objects' );

	foreach ( $post_types as $post_type ) {

		$post_type_name     = $post_type->name;
		$show_in_rest       = ( isset( $post_type->show_in_rest ) && $post_type->show_in_rest ) ? true : false;
		$supports_thumbnail = post_type_supports( $post_type_name, 'thumbnail' );

		// Only proceed if the post type is set to be accessible over the REST API
		// and supports featured images.
		if ( $show_in_rest && $supports_thumbnail ) {

			// Compatibility with the REST API v2 beta 9+
			if ( function_exists( 'register_rest_field' ) ) {
				register_rest_field( $post_type_name,
					'mlx_featured_image',
					array(
						'get_callback' => 'mlx_rest_api_featured_images_get_field',
						'schema'       => null,
					)
				);
			} elseif ( function_exists( 'register_api_field' ) ) {
				register_api_field( $post_type_name,
					'mlx_featured_image',
					array(
						'get_callback' => 'mlx_rest_api_featured_images_get_field',
						'schema'       => null,
					)
				);
			}
		}
	}
}

/**
 * Return the mlx_featured_image field.
 *
 * @since   1.0.0
 *
 * @param   object  $object      The response object.
 * @param   string  $field_name  The name of the field to add.
 * @param   object  $request     The WP_REST_Request object.
 *
 * @return  object|null
 */
function mlx_rest_api_featured_images_get_field( $object, $field_name, $request ) {

	// Only proceed if the post has a featured image.
	if ( ! empty( $object['featured_media'] ) ) {
		$image_id = (int)$object['featured_media'];
	} elseif ( ! empty( $object['featured_image'] ) ) {
		// This was added for backwards compatibility with < WP REST API v2 Beta 11.
		$image_id = (int)$object['featured_image'];
	} else {
		return null;
	}

	$image = get_post( $image_id );

	if ( ! $image ) {
		return null;
	}

	// This is taken from WP_REST_Attachments_Controller::prepare_item_for_response().
	$featured_image['id']            = $image_id;
	$featured_image['alt_text']      = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	$featured_image['caption']       = $image->post_excerpt;
	$featured_image['description']   = $image->post_content;
	$featured_image['media_type']    = wp_attachment_is_image( $image_id ) ? 'image' : 'file';
	$featured_image['media_details'] = wp_get_attachment_metadata( $image_id );
	$featured_image['post']          = ! empty( $image->post_parent ) ? (int) $image->post_parent : null;
	$featured_image['source_url']    = wp_get_attachment_url( $image_id );

	if ( empty( $featured_image['media_details'] ) ) {
		$featured_image['media_details'] = new stdClass;
	} elseif ( ! empty( $featured_image['media_details']['sizes'] ) ) {
		$img_url_basename = wp_basename( $featured_image['source_url'] );
		foreach ( $featured_image['media_details']['sizes'] as $size => &$size_data ) {
			$image_src = wp_get_attachment_image_src( $image_id, $size );
			if ( ! $image_src ) {
				continue;
			}
			$size_data['source_url'] = $image_src[0];
		}
	} elseif ( is_string( $featured_image['media_details'] ) ) {
		// This was added to work around conflicts with plugins that cause
		// wp_get_attachment_metadata() to return a string.
		$featured_image['media_details'] = new stdClass();
		$featured_image['media_details']->sizes = new stdClass();
	} else {
		$featured_image['media_details']['sizes'] = new stdClass;
	}

	return apply_filters( 'mlx_rest_api_featured_image', $featured_image, $image_id );
}
add_action( 'init', 'mlx_rest_api_featured_images_init', 12 );
