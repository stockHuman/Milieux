<section class="overview masthead">
	<div class="overview-section__content">
		<div class="text">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<?php the_content(); ?>
			<div class="read-more-link">
				<a href="#scroll" data-scroll>read more</a>
			</div>
			<div class="scroll-down-arrow" aria-hidden="true">
			</div>
		</div>
		<div class="overview-gallery media" aria-hidden="true">
			<?php the_post_thumbnail(); ?>
		</div>
	</div>
</section>

<?php if( have_rows('overview_preview_sections') ):
	$count = count(get_field('overview_preview_sections'));
	$index = $count;

	while( have_rows('overview_preview_sections') ): the_row();

		$index -= 1;
		if ($index % 2 == 0) {
			$overview_class = 'even';
		} else {
			$overview_class = 'odd';
		}

		// vars
		$use_gallery = get_sub_field('overview_use_custom_gallery');
		$content = get_sub_field('overview_preview_text');
		$link = get_permalink(get_sub_field('overview_preview_link'));
		if ($use_gallery)
			$gallery = get_sub_field('overview_custom_gallery');

		?>

<section class="overview <?= $overview_class ?>" id="scroll">
	<div class="overview-section__content">
		<div class="text">
			<?= $content; ?>
			<?php if( $link ): ?>
				<div class="read-more-link">
					<a href="<?= $link; ?>" class="read-more-link">Read more</a>
				</div>
			<?php endif; ?>
		</div>
		<div class="media">
			<?php if ($use_gallery): ?>
			<div class="overview-section__gallery">
				<?php foreach ($gallery as $image) {
					echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] .'"/>'; // TODO: srcset
				}?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

	<?php endwhile; ?>
<?php endif; ?>

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
