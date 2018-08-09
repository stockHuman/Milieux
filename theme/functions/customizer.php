<?php
/**
 * Milieux Theme Customizer
 * Integrates with the theme customizer
 *
 * @package Milieux
 */

/**
 * Adds ACF settings into the customizer
 * @author Jörn Lund
 * @link https://github.com/mcguffin/acf-customizer
 */
if (function_exists('acf_add_customizer_section')) {
	$panel_id = acf_add_customizer_panel( 'Homepage CTA' );

	acf_add_customizer_section( array(

		'storage_type'			=> 'theme_mod',
			// Where to store the ACF field data.
			// Values can be `theme_mod`, `option`, `post` or `term`.
			// . Default: theme_mod.

		'post_id' 				=> 'homepage_theme_mod',
			// (string|int) post_id argument passed to get_field(). Default: sanitized title arg
			// Omit if you choose storage type `post` or `term`

		'priority'				=> 100,
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/

		'panel'					=> $panel_id,
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/

		'capability'			=> 'administrator',
			// Argument passed to `WP_Customize_Manager::add_section()`, `WP_Customize_Manager::add_setting()`, `WP_Customize_Manager::add_control()`,
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_control/
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/

		'title'					=> 'Homepage Layout',
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/

		'description'			=> 'You can edit some options here.',
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/

		'active_callback'		=> 'is_front_page',
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/

		'description_hidden'	=> false,
			// Argument passed to `WP_Customize_Manager::add_section()`
			// See https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	) );
}
