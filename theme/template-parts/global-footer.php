<footer id="colophon" class="site-footer">
	<div class="wrapper footer-inner">
		<div class="row between-md">
			<div class="col col-md-4">
				<b><?= get_bloginfo( 'description' ); ?></b>
				<nav id="footer-navigation" class="footer-navigation">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-menu',
						) );
					?>
				</nav>
				<div class="social-footer-links">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-3',
							'menu_id'        => 'footer-social-menu',
						) );
					?>
				</div>
			</div>
			<div class="col col-md-4">
				<?php get_search_form( true ) ?>
			</div>
		</div>
	</div>
</footer>
