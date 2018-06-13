	</div>

		<?php // load up the teal storyteller. Depends on ACF.
	if (get_field( "storyteller_toggle" ) == "Show") { ?>
		<section class="storyteller">
			<a href="<?php echo get_permalink(get_field("storyteller_link")->ID); ?>">
				<?php // user has elected to display a custom quote
				if (get_field("storyteller_quote_toggle")) {
					echo '<h2 class="storyteller-link">“' . get_field("storyteller_quote") . '”</h2>';
					if (!empty(get_field("storyteller_cta"))) {
						echo '<p class="storyteller-cta">' . get_field("storyteller_cta") . '</p>';
					}
				} elseif (!empty(get_field("storyteller_cta"))) {
					echo '<h2 class="storyteller-link">' . get_field("storyteller_cta") . '</h2>';
				} else {
					echo '<h2 class="storyteller-link">' . get_the_title(get_field("storyteller_link")->ID) . '</h2>';
				}
				?>
			</a>
		</section>
	<?php } ?>

	<?php get_template_part( 'template-parts/global-footer' ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
