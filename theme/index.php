<?php get_header(); ?>

  <div id="content" class="container">
    <div id="inner-content" class="b-target">
      <main id="main" class="" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    		<!-- To see additional archive styles, visit the /parts directory -->
    		<?php get_template_part( 'parts/loop', 'archive' ); ?>

    	<?php endwhile; ?>

    		<?php //milieux_page_navi(); ?>

    	<?php else : ?>

    		<?php get_template_part( 'parts/content', 'missing' ); ?>

    	<?php endif; ?>

      </main> <!-- end #main -->
    </div>
  </div>

<?php get_footer(); ?>
