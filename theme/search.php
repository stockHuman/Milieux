<?php get_header(); ?>

	<div id="content" class="container">
		<main id="main" class="fc no-header search" role="main">
			<header>
				<h1 class="archive-title"><?php _e( 'Search Results for', 'milieux' ); ?>
					<i><?php echo esc_attr(get_search_query()); ?></i>
				</h1>
			</header>
			<section class="search__results flex">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive' ); ?>

				<?php endwhile; ?>
			</section>


				<?php milieux_page_navi(); ?>

			<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

	    </main> <!-- end #main -->
	</div>

<?php get_footer(); ?>
