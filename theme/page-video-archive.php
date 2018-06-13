	<?php /* Template Name: Video Archive */ ?>

	<?php get_header(); // TODO: add menu -> get parent page and create nav as in overview template ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="wrapper">
					<div class="row">
						<div class="col col-md-2">
							<h1>Archive:<br/><?php the_title(); ?></h1>
						</div>
						<div class="col col-md-6">
							<?php
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content', 'archive' );
								endwhile; // End of the loop.
							?>
						</div>
					</div>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->

	<?php
	get_footer("page");
