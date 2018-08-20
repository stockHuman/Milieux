<article id="post-<?php the_ID(); ?>" <?php post_class('c-card'); ?> role="article">
	<header class="article-header">
		<h2 class="mono-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
	</header> <!-- end article header -->

	<section class="entry-content" itemprop="articleBody">
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium'); ?></a>
		<?php the_excerpt('<button class="tiny">' . __( 'Read more...', 'milieux' ) . '</button>'); ?>
	</section> <!-- end article section -->

	<footer class="article-footer">
    	<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'milieuxtheme') . '</span> ', ', ', ''); ?></p>
	</footer> <!-- end article footer -->
</article> <!-- end article -->
