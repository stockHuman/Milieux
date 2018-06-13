	<?php /* Template Name: Fully custom */ ?>

	<?php get_header(); ?>

		<div id="primary" class="content-area">
			<main id="main" <?php post_class('site-main'); ?>>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page-custom' );

			endwhile; // End of the loop.
			?>

			</main>
		</div>

	<?php
	get_footer("page");
