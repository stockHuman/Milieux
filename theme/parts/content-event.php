<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 */
?>

<section class="event__container">
	<header class="event__header">
		<h2 class="page-type-title">Event</h2>

		<?php the_title( '<h1 class="event__title mono-title">', '</h1>' ); ?>

		<div class="event__hero">
			<?= milieux_event_featured_image(get_the_ID(), 'full', false); ?>
		</div>

		<?php $cta =  get_field('event_cta');
		if ( $cta['enable'] == true ) : ?>
			<div class="event__cta btn--material-highlight">
				<?php $cta_link = $cta['link'];
				if ( $cta_link != '' ) { ?>
					<a href="<?= $cta_link; ?>"><?= $cta['text']; ?></a>
				<?php } else { ?>
					<span><?php $cta['text']; ?></span>
				<?php } ?>
			</div>
		<?php endif; ?>
	</header>

	<section id="post-<?php the_ID(); ?>" class="event__content">
		<article class="event__content-inner">
			<?php the_content(); ?>
		</article>
		<aside class="event__sidebar">
			<div class="event__sidebar-details flex">
			  <div class="text-right">
			    <div class="text-blend address"><?= get_field('event_location'); ?></div>
			  </div>
				<?php if (get_field('event_type') != 'multi') { ?>
			  <div class="">
			    <div class="text-blend month"><?= get_field('event_date'); ?></div>
			    <div class="ts-number day"><?= get_field('address'); ?></div>
			  </div>
				<?php } else { ?>
			  <div class="">
			    <div class="text-blend month"><?php //get_field('event_dates'); ?></div>
			    <div class="ts-number day"><?= get_field('address'); // TODO: replace with actual values ?></div>
			  </div>
				<?php } ?>
			</div>
		</aside>
	</section>

</section>
