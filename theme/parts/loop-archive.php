<article id="post-<?php the_ID(); ?>" <?php post_class('c-card'); ?> role="article">
	<header class="article-header">
		<h2 class="mono-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
	</header>

	<section class="entry-content" itemprop="articleBody">
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a>
		<?php the_excerpt('<button class="tiny">' . __( 'Read more...', 'milieux' ) . '</button>'); ?>
	</section>
</article> <!-- end article -->
