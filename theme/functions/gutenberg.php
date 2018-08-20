<?php

/**
 * Defines blocks for the new Gutenberg editor, comprised of 'blocks'
 * that work with heavy javascript integration
 *
 * @author 		Michael Hemingway
 * @since  		0.0.3
 * @link 			https://wordpress.org/gutenberg/handbook/language/
 */


/**
 * Filter templates and ID to remove editor
 * @package   Milieux
 * @author    Bill Erickson
 * @since     0.0.3
 * @license   GPL-2.0+
 * @link  		https://www.billerickson.net/disabling-gutenberg-certain-templates/
 */
function milieux_disable_editor( $id = false ) {

	$excluded_templates = array(
		'template-events.php',
		'front-page.php'
	);

	$excluded_ids = array();

	if( empty( $id ) ) {
		return false;
	}

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 * @package      Milieux
 * @author       Bill Erickson
 */
function milieux_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) ) {
		return $can_edit;
	}

	if( milieux_disable_editor( $_GET['post'] ) ) {
		$can_edit = false;
	}

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'milieux_disable_gutenberg', 10, 2 );
