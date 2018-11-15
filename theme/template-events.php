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
					<a href="<?= the_permalink($hero_event_ID); ?>" class="events__hero">
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
					</a>
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




<?php // DEBUG

	$events = get_posts(array(
		'post_type' => 'event',
		'posts_per_page' => 10,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'event_date',
				'value' => $today,
				'compare' => '>=' // truncate results older than today
			),
			array(
				'key' => 'event_type',
				'value' => 'multi',
				'compare' => '!=' // exclude multi events
			)
		),
		'meta_key' => 'event_date', // name of custom field
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	));

	if ($events) {
		echo '<article class="feature__content">';
		foreach ($events as $post) {
			setup_postdata($post);
			$printdate = DateTime::createFromFormat('Ymd', get_post_meta($post->ID, 'event_date', 'true'));

			echo '<p style="line-height: 1.25; margin-bottom: 1em"><em>type : '. get_post_meta($post->ID, 'event_type', 'true') .'</em><br>';
		//	echo 'title: '. get_the_title() . '</br>';
			the_date('', 'date: ', '<br>', true);
			print_r('ACF date: ' .$printdate->format('M d, Y'));
			echo '</p>';
		}
		echo '</article>';

		wp_reset_postdata();
	}

	// multi events
	echo '<h3>Multi events</h3>';
	$multievents = get_posts(array(
		'post_type' => 'event',
		'posts_per_page' => -1,
		'meta_key' => 'event_dates', // name of custom field
		'order' => 'DESC'
	));

	if ($multievents) {
		echo '<article class="feature__content">';
		foreach ($multievents as $post) {
			setup_postdata($post);
			$meta = get_post_meta($post->ID);
			$numdates = $meta['event_dates'][0];

			if ($numdates > 0) {
				$dates = array();
				for ($i=0; $i < $numdates; $i++) {
					$dates[$i] = $meta['event_dates_' . $i . '_event_dates_date'][0];
				}
			}


			$datesstring = '';
			if ($dates) {
				foreach ($dates as $date) {
					$datesstring .= DateTime::createFromFormat('Ymd', $date)->format('M d, Y') . '<br>';
				}
			}


			echo '<p style="line-height: 1.25; margin-bottom: 1em"><em>type : '. get_post_meta($post->ID, 'event_type', 'true') .'</em><br>';
			the_date('', 'date: ', '<br>', true);
			print_r('ACF dates:<br>' . $datesstring);
			echo '</p>';
		}
		echo '</article>';

		wp_reset_postdata();
	}

	// merge two requests into one and sort as per function
	// returns a modified object with a normalised event date
	function milieux_sort_events() {
		$today = date('Ymd');
		$events = array();

		$events_single_and_range = get_posts(array(
			'post_type' => 'event',
			'posts_per_page' => 10,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'event_date',
					'value' => $today,
					'compare' => '>=' // truncate results older than today
				),
				array(
					'key' => 'event_type',
					'value' => 'multi',
					'compare' => '!=' // exclude multi events
				)
			),
			'meta_key' => 'event_date', // name of custom field
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		));


		if ($events_single_and_range) {
			// sort through posts for range events and determine what date to send back
			foreach ($events_single_and_range as $event) {
				$e_meta = get_post_meta($event->ID);

				$formatted_event = array(
					'ID' => $event->ID,
					'event_author' => $event->post_author,
					'event_content' => $event->post_content,
					'event_title' => $event->post_title,
					'event_name' => $event->post_name,
					'event_excerpt' => $event->post_excerpt,
					'event_date' => $e_meta['event_date'][0], // just in case
					'event_type' => $e_meta['event_type'][0],
					'order' => $e_meta['event_date'][0], // we're changing this
					'event_meta' => array(
						'location' => $e_meta['event_location'][0],
						'cta_link' => $e_meta['event_cta_link'][0],
						'cta_text' => $e_meta['event_cta_text'][0],
						'time_start' => $e_meta['event_time'][0],
						'time_end' => $e_meta['event_time_end'][0],
					),
				);

				// handle edge case where ranged event could be in the middle of happening
				if ($e_meta['event_type'] == 'range') {
					if ($e_meta['event_date_end'] >= $today && $today >= $e_meta['event_date']) {
						$formatted_event['order'] = $today;
					} // else leave as is, event = start date
				}
				array_push($events, $formatted_event);
			}
		}

		$events_multi = get_posts(array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'order' => 'DESC',
			'meta_query' => array(
				array(
					'key' => 'event_type',
					'value' => 'multi',
					'compare' => '==' // exclude multi events
				)
			),
		));

		if ($events_multi) {
			foreach ($events_multi as $event) {
				$e_meta = get_post_meta($event->ID);
				$numdates = $e_meta['event_dates'][0];

				// add dates to array (formatted as Ymd) from acf generated keys
				if ($numdates > 0) {
					$dates = array();
					$isCurrent = false;
					for ($i = 0; $i < $numdates; $i++) {
						$dates[$i] = $e_meta['event_dates_' . $i . '_event_dates_date'][0];
						if ($dates[$i] >= $today) { // at least one event exists that is either current or in the future
							$isCurrent = true;
						}
					}

					if ($isCurrent) { // at least one date is either present or in future
						$formatted_event = array(
							'ID' => $event->ID,
							'event_author' => $event->post_author,
							'event_content' => $event->post_content,
							'event_title' => $event->post_title,
							'event_name' => $event->post_name,
							'event_excerpt' => $event->post_excerpt,
							'event_date' => $dates[0], // default to first date
							'event_type' => 'multi',
							'order' => $dates[0], // default to first date
							'event_meta' => array(
								'dates' => $dates
							),
						);

						// iterate over dates to determine nearest date
						for ($i = count($dates); $i > 0; $i--) {
							if ($dates[$i - 1] >= $today) {
								$formatted_event['order'] = $dates[$i - 1];
							}
						}

						array_push($events, $formatted_event);
					}
				}
			}
		}

		return $events;
	}
	echo '<article class="feature__content"><pre>';
	print_r(milieux_sort_events());
	echo'</pre></article>';
?>












			</main>
		</div>
	</div>

<?php get_footer(); ?>

