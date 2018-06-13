<article class="page">
	<section class="page masthead">
		<div class="page-section__content">
			<div class="text">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>
				<?php
					if (get_field('above_the_fold_content')) {
						echo get_field('above_the_fold_content');
					}
				?>
			</div>
			<div class="media">
				<?php milx_post_thumbnail(); ?>
			</div>
		</div>
	</section>
	<section class="entry-content wrapper">
		<?= the_content(); ?>
	</section>
</article>

<?php if ( get_edit_post_link() ) : ?>
	<footer class="entry-footer">
		<?php
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'milx' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer>
<?php endif; ?>
