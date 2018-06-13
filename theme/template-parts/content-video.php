

<?php // Make a tiny image
	$image = wp_get_attachment_image_url(get_post_thumbnail_id(), array(40,22));
	if ($image) {
		$ext = pathinfo($image, PATHINFO_EXTENSION);
		$b64img = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($image));

		// Use widely supported SVG blur filters to inline the image
		// Via https://css-tricks.com/the-blur-up-technique-for-loading-background-images/
		$svgwrapper = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='160' height='90' viewBox='0 0 160 90'%3E %3Cfilter id='blur' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'%3E %3CfeGaussianBlur stdDeviation='20 20' edgeMode='duplicate' /%3E %3CfeComponentTransfer%3E %3CfeFuncA type='discrete' tableValues='1 1' /%3E %3C/feComponentTransfer%3E %3C/filter%3E %3Cimage filter='url(%23blur)' xlink:href='". $b64img ."' x='0' y='0' height='100%25' width='100%25'/%3E %3C/svg%3E";
		?>
		<style>
			.player__thumbnail {
				background-size: cover;
				background-image: url("<?= $svgwrapper ?>");
				/* filter: blur(20px); */
				height: 100%;
				width: 100%;
				z-index: -1;
			}
		</style>
<?php } ?>

<article class="post video">

	<section class="player">
		<div class="player__thumbnail">
			<div class="player__play-button"></div>
			<div class="player__video">
				<!-- video here -->
			</div>
		</div>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php if ( get_field( 'participants' ) ) : ?>
				<div class="video__participants">
					<?= get_field('participants') ?>
				</div>
			<?php endif; ?>
		</header>
	</section>

	<section class="entry-content wrapper">
		<?php if ( get_field( 'transcript' ) || get_field( 'external_link' ) ) : ?>
		<div class="video__meta">
			<?php if ( get_field( 'transcript' ) ) : ?>
				<a href="<?= get_field( 'transcript' ) ?>" download>
					<svg><use xlink:href="<?= get_stylesheet_directory_uri(); ?>/assets/icons/fa-regular.svg#save"></use></svg>
					<p>Transcript</p>
				</a>
			<?php endif; ?>

			<?php if ( get_field( 'external_link' ) ) : ?>
				<a href="<?= get_field( 'external_link' ) ?>">
					<svg><use xlink:href="<?= get_stylesheet_directory_uri(); ?>/assets/icons/fa-regular.svg#compass"></use></svg>
					<p>External Link</p>
				</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="video__description">
			<?php if ( get_field( 'video_description' ) ) { echo get_field( 'video_description' ); } ?>
		</div>
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
