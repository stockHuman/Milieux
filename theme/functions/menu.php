<?php
// Register menus
register_nav_menus(
	array(
		'nav-main' => __( 'The Main Menu', 'milieux' ),   // Main nav in header
		'footer-links' => __( 'Footer Links', 'milieux' ) // Secondary nav in footer
	)
);

// The Off Canvas Menu
function arthem_nav() {
	 wp_nav_menu(array(
		'container' => false,                           // Remove nav container
		'menu_class' => 'nav-main__content',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'theme_location' => 'nav-main',        			// Where it's located in the theme
		'depth' => 2,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
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
function arthem_footer_links() {
	wp_nav_menu(array(
		'container' => 'false',
		'menu' => __( 'Footer Links', 'milieux' ),
		'menu_class' => 'menu',
		'theme_location' => 'footer-links',
	  'depth' => 0,
		'fallback_cb' => ''
	));
} /* End Footer Menu */

// Header Fallback Menu
function arthem_main_nav_fallback() {
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

// Footer Fallback Menu
function arthem_footer_links_fallback() {
	/* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
