<?php // plugins



function social_icons_nav_menu_link_attributes( $atts, $item, $args ) {

	// default changed from css to svg because I don't have time to improve this: see FA documentation on 
	// SVG sprites
	$icon_type = isset($args->social_icon_type) ? $args->social_icon_type : "svg"; 
	$icon_prefix = isset($args->social_icon_prefix) ? $args->social_icon_prefix : (($icon_type === 'svg') ? "" : "fab fa-");
	$menu_name = is_string($args->menu) ? $args->menu : $args->menu->name;
	$is_social_menu = (strpos(trim(strtolower($menu_name)), 'social') !== false);

	if ( $is_social_menu ) {
		$title = trim($item->title);
		$icon_name = strtolower(
			preg_replace(
				["/([A-Z]+)/", "/_([A-Z]+)([A-Z][a-z])/"],
				["_$1", "_$1_$2"],
				lcfirst($title)
			)
		);
		$icon_prefixed_name = $icon_prefix . $icon_name;
		$atts['title'] = $title;
		if ($icon_type === 'svg') {
			$item->title = '<svg><use xlink:href="'.get_stylesheet_directory_uri().'/assets/icons/fa-brands.svg#'.$icon_prefixed_name.'"/></svg>';
		} else {
			$item->title = "<i class=\"$icon_prefixed_name \"></i>";
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'social_icons_nav_menu_link_attributes', 10, 3 );
