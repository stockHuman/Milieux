<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="home-showcase">
				<div class="showcase-inner">
					<div class="showcase-hero">
						<?php
							$img = get_field("hero_image");
							$img_src = wp_get_attachment_image_url( $img, 'medium' );
							$img_srcset = wp_get_attachment_image_srcset( $img, 'medium' );

							if (!empty(get_field("hero_text"))) {
								echo '<h1 class="hero-text">'. get_field("hero_text") . '</h1>';
							}
						?>

						<img src="<?php echo esc_url( $img_src ); ?>"
							   	srcset="<?php echo esc_attr( $img_srcset ); ?>"
							    sizes="(max-width: 50em) 87vw, 680px" alt="A rad wolf">
					</div>
					<?php if (get_field("hero_link_1") && get_field("hero_link_2") && get_field("hero_link_3")) { ?>
						<div class="hero-sub-container">
							<?php for ($i=1; $i < 4; $i++) {
								$id_string = "hero_link_" . $i;
								$id = get_field($id_string)->ID;
							?>

							<a class="hero-sub-item" href="<?= get_permalink($id) ?>">
								<h3><?= get_the_title( $id ); ?></h3>
								<?php	$img = get_post_thumbnail_id($id);
											$img_src = wp_get_attachment_image_url( $img, 'medium' );
											$img_srcset = wp_get_attachment_image_srcset( $img, 'medium' );
								?>
								<img src="<?php echo esc_url( $img_src ); ?>"
							   	srcset="<?php echo esc_attr( $img_srcset ); ?>"
							    sizes="(max-width: 50em) 87vw, 680px" alt="<?php get_post_meta( $id, '_wp_attachment_image_alt', true); // broken? ?>">
							</a>
							<?php } // end loop ?>

						</div>

					<?php } // end if ?>
					
				</div>
				<div class="scroll-arrow"></div>
			</section>
			<section id="homepage-content">
				<div class="wrapper">
					<div class="row">
						<div class="col col-md-5 col-md-offset-1">
						<?php
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								the_content();
								endwhile;
							endif;
						?>
						</div>
					</div>
				</div>
			</section>

			<section class="home-cta">
				<div class="wrapper">
					<div class="cta-container">
					<?php for ($i=1; $i < 4; $i++) {
						$page_id = get_field(("home_page_cta_link_" . $i))->ID;
						$page_title = get_the_title($page_id);
						$page_img = get_field(("home_page_cta_img_" . $i));
						?>

						<div class="cta-item">
							<a href="<?= get_permalink($page_id); ?>">
								<div class="cta-img">
									<img src="<?= $page_img; ?>">
								</div>
								<h4><?= $page_title; ?></h4>
								<p><?= get_field(("home_page_cta_desc_" . $i)); ?></p>
							</a>
						</div>
					
					<?php } ?>
					</div>
				</div>
			</section>

		</main>
	</div>
<?php
get_footer("page");
