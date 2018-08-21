<?php get_header(); ?>

	<div class="container">
		<main id="main" class="no-header fc" role="main">

			<article id="content-not-found">

				<header class="article-header">
					<h1><?php _e( '404', 'milieux' ); ?></h1>
					<span class="text-mono">There ain't nothing here, son</span>
				</header> <!-- end article header -->

				<section class="search">
				    <p><?php get_search_form(); ?></p>
				</section> <!-- end search section -->

			</article> <!-- end article -->

		</main> <!-- end #main -->
	</div>

<?php get_footer(); ?>
