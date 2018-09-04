<?php
/*
Template Name: Cluster
*/
?>

<?php get_header(); ?>

	<div id="content" class="container">
			<div id="inner-content" class="b-target">
			<main id="main" class="" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part( 'parts/loop', 'page' ); ?>

				<?php endwhile; endif; ?>

			</main> <!-- end #main -->
		</div>
	</div>

<?php get_footer(); ?>
