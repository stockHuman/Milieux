<?php get_header(); ?>

  <div class="container">
    <main id="main" class="frontpage" role="main">

    	<?php get_template_part('parts/frontpage', 'hero'); ?>


      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      	<?php the_content(); ?>

  	<?php endwhile; ?>

  		<?php //milieux_page_navi(); ?>

  	<?php else : ?>

  		<?php get_template_part( 'parts/content', 'missing' ); ?>

  	<?php endif; ?>

    </main> <!-- end #main -->
  </div>

<?php get_footer(); ?>
