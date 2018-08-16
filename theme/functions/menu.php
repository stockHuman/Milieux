<?php
// Register menus
register_nav_menus(
	array(
		'main' => __( 'Main Menu', 'milieux' ),    // Main nav in header
		'footer' => __( 'Footer Links', 'milieux' ), // Secondary nav in footer
		'clusters' => __( 'Clusters Menu', 'milieux' ),
		'social' => __( 'Social Media Menu', 'milieux' )
	)
);

// The Off Canvas Menu
function milieux_nav() {
	 wp_nav_menu(array(
		'container' => false,
		'menu_class' => 'nav-main__content',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'main',
		'depth' => 2,
		'fallback_cb' => false,
		'walker' => new Off_Canvas_Menu_Walker()
	));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

// The Footer Menu
function milieux_footer_links() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Footer Links', 'milieux' ),
		'menu_class' => 'menu',
		'theme_location' => 'footer',
	  'depth' => 0,
		'fallback_cb' => ''
	));
}

// Clusters Menu, appears in the main nav and in the footer
function milieux_clusters_menu() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Clusters Menu', 'milieux' ),
		'menu_class' => 'menu',
		'theme_location' => 'clusters',
		'depth' => 1,
		'fallback_cb' => ''
	));
}

// Social Menu, appears in various location around the theme as icons
function milieux_social_menu() {
	wp_nav_menu(array(
		'container' => false,
		'menu' => __( 'Social Menu', 'milieux' ),
		'menu_class' => 'menu',
		'theme_location' => 'social',
		'depth' => 1,
		'fallback_cb' => ''
	));
}

// Header Fallback Menu
function milieux_main_nav_fallback() {
		wp_page_menu( array(
			'show_home' => true,
			'menu_class' => '',
			'include'     => '',
			'exclude'     => '',
			'echo'        => true,
		'link_before' => '',
		'link_after' => ''
		)
	);
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
