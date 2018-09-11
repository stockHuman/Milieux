<!doctype html>

<html class="no-js"  <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|Roboto:100,900|Source+Sans+Pro:300,400" rel="stylesheet">

	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		$turi = get_template_directory_uri(); ?>
		<!-- Icons & Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?= $turi ?>/assets/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= $turi ?>/assets/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= $turi ?>/assets/icons/favicon-16x16.png">
		<link rel="manifest" href="<?= $turi ?>/assets/icons/site.webmanifest">
		<link rel="mask-icon" href="<?= $turi ?>/assets/icons/safari-pinned-tab.svg" color="#000000">
		<link rel="shortcut icon" href="<?= $turi ?>/assets/icons/favicon.ico">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-config" content="<?= $turi ?>/assets/icons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
  <?php } ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>

	<!-- Drop Google Analytics here -->
	<!-- end analytics -->

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body <?php body_class(); ?>>
	<div id="preloader" aria-hidden="true"></div>
	<div class="innie" aria-hidden="true"></div>
	<div class="outie" aria-hidden="true"></div>
	<div id="background" aria-hidden="true"></div>
	<noscript><style>#preloader{display: none}</style></noscript>


	<?php get_template_part( 'parts/nav' ); ?>
