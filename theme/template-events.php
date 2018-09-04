<?php
/**
 * Template Name: Events Page
 * Has no content and displays all options via ACF
 * CSS namespace: 'events' - 'event' in the singular refers to individual posts.
 * @package Milieux
 */
?>

<?php get_header(); ?>

<?php
	$hero_enabled = get_field('spl_enable_hero_item');
	if ( $hero_enabled ) {
		$hero = get_field('spl_hero'); // group item, accessed with $hero['prop']
		$type = $hero['type'];
		$hero_event_ID = $hero['featured_post'];
		$custom_banner = $hero['use_custom_banner'];
		if ( $custom_banner == true ) {
			$custom_banner_img = $hero['banner_image'];
		}
		$cta = $hero['cta'];
	}

?>

	<div id="content" class="container">
		<div id="inner-content" class="b-target" data-namespace="events">
			<main id="main" class="<?= ($hero_enabled == true ? 'events events--has-hero' : 'event'); ?>" role="main">

				<header>
					<?php if ( $hero_enabled ) : ?>
					<div class="events__hero">
						<?= milieux_event_featured_image($hero_event_ID); ?>
						<div class="events__hero-details">
							<span class="text-blend"><?= __('Featured', 'milieux') ?></span>
							<h2 class="mono-title"><?= get_the_title($hero_event_ID); ?></h2>
							<p class="text-blend"><?= get_the_excerpt($hero_event_ID); ?></p>
							<div class="date">

								<?php // ID, showAdress & display long month name
									$meta = milieux_event_meta($hero_event_ID, false, true); ?>

								<div class="text-right">
									<div class="text-blend month"><?= $meta['month']; ?></div>
									<div class="ts-number day"><?= $meta['day']; ?></div>
								</div>
							</div>
						</div>
					</div>
					<a class="events__hero-cta" href="<?= $hero['cta_link']; ?>">
						<?= $hero['cta']; ?>
					</a>
					<?php endif; ?>
					<h1><?= the_title(); ?></h1>
				</header>


				<section class="std-grid events__list">
					<?php // List recent events

					$today = date('Ymd');

					$args = array(
						'post_type'				=> 'event',
						'posts_per_page'	=> 8,
						'meta_key'				=> 'event_date',
						'orderby'				=> 'meta_value_num',
						'order'					=> 'ASC',
						'meta_query'			=> array(
							array(
								'key'			=> 'event_date',
								'value'		=> $today,
								'type'		=> 'DATE',
								'compare' => '>='
							)
						)
					);

					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<article id="event-<?= the_ID(); ?>" class="event-item">

							<?= milieux_event_featured_image(get_the_ID(), 'thumbnail', false, 'event-item__image'); ?>
							<div class="event-item__details">
								<h2 class="event-item__title mono-title"><?php the_title(); ?></h2>
								<p class="event-item__desc text-blend"><?= get_the_excerpt(); ?></p>

								<div class="event-item__meta-container">
									<div class="date">
										<?php $meta = milieux_event_meta(get_the_ID(), false, true); ?>
										<div class="">
											<div class="text-blend month"><?= $meta['month']; ?></div>
											<div class="ts-number day"><?= $meta['day']; ?></div>
										</div>
									</div>
									<div class="event-item__link cta">
										<span><a href="<?= the_permalink(get_the_ID()); ?>"><?= __('view the event', 'milieux'); ?></a></span>
									</div>
								</div>

							</div>
						</article>

					<?php endwhile; endif; // events query ?>
				</section>
			</main>
		</div>
	</div>

<?php get_footer(); ?>

