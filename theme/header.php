<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|Roboto:900|Source+Sans+Pro:300,400" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'milx' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php the_custom_logo(); ?>
		</div>

		<?php get_template_part( 'searchform', 'header' ); ?>

		<div id="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<p>menu</p>
			<span></span>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav>
	</header>

	<div id="content" class="site-content">
