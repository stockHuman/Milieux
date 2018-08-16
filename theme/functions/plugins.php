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
