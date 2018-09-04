<?php /* 'Event' post type template */ ?>

<?php get_header(); ?>

<div id="content" class="container">

	<div id="inner-content" class="b-target" data-namespace="single-event">

		<main id="main" class="large-8 medium-8 event" role="main">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/content', 'event' ); ?>

		    <?php endwhile; else : ?>

		   		<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>
