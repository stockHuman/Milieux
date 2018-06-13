<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package milx
 */

?>

<section class="no-results not-found">
	<div class="video-container">
		<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/g3iFJpGJiug?autoplay=1&loop=1&rel=0&showinfo=0&controls=0&autohide=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	</div>

	<div class="page-content wrapper">
			<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( "Ain't nothin' 'ere", 'milx' ); ?></h1>
	</header><!-- .page-header -->
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'milx' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'milx' ); ?></p>


			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'milx' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
