	<?php /* Template Name: Section Overview Template */ ?>

	<?php get_header("overview"); ?>

		<div id="primary" class="content-area">
			<main id="main" <?php post_class('site-main'); ?>>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page-overview' );

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php
	get_footer("page");
