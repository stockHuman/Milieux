<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<section id="tribe-events-content" class="event__container">

	<p class="tribe-events-back screen-reader-text">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<?php while ( have_posts() ) :  the_post(); ?>
		<header class="event__header">
			<h2 class="page-type-title">Event</h2>
			<?php the_title( '<h1 class="event__title">', '</h1>' ); ?>
			<div class="event__hero">
				<?= milieux_event_featured_image($event_id, 'full', false) ?>
				<!-- TODO: if still active, show CTA => perhaps ACF? -->
				<div class="event__cta"><?php echo tribe_events_event_schedule_details( $event_id, '<span>', '</span>' ); ?></div>
			</div>
		</header>

		<?php tribe_the_notices() ?>

		<section id="post-<?php the_ID(); ?>" class="event__content">
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</section>
	<?php endwhile; ?>

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-footer -->

</section><!-- #tribe-events-content -->

<!-- TODO: move this -->
<div class="tribe-events-schedule">
	<!-- <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?> -->
	<?php if ( tribe_get_cost() ) : ?>
		<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
	<?php endif; ?>
</div>

<!-- Event header -->
<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
	<!-- Navigation -->
	<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
	</nav>
</div>
