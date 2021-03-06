<div id="post-not-found" class="hentry">

	<?php if ( is_search() ) : ?>

		<header class="article-header">
			<h1><?php _e( 'Sorry, No Results.', 'milieux' );?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Try your search again.', 'milieux' );?></p>
		</section>

		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->
	<?php else: ?>

		<header class="article-header">
			<h1><?php _e( 'Oops, Post Not Found!', 'milieux' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'milieux' ); ?></p>
		</section>

		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->

	<?php endif; ?>

</div>
