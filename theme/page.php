<?php get_header('sub'); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php post_class('site-main'); ?>>

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile;
		?>

		</main>
	</div>
<?php
get_footer("page");
