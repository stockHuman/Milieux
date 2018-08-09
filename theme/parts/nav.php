<nav id="nav-main" class="nav-main nav-main--collapsed">
	<div class="nav-main__inner">
		<div class="nav-main__header">
			<a href="<?= home_url(); ?>" rel="home">
				<p class="screen-reader-text"><?php bloginfo('name'); ?></p>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.53 80.67"><title>milieux_mask</title><path d="M0,0V80.67H202.53V0ZM52.21,56.44H45.58v-26c-3.35,3.35-6.46,6.54-9.82,9.81-3.35-3.35-6.46-6.54-9.9-10C26,39.2,26,47.82,26,56.52H19.4V23.71L24,19.08c3.83,3.83,7.66,7.74,11.42,11.57,4.07-4.07,7.9-8,11.65-11.65,1.83,1.76,3.35,3.35,5.11,5Zm13.25.08H59V30.26H54.6V23.63h4.16l6.7,6.71Zm22-.08H76.64c-2.24-2.24-4.39-4.39-6.71-6.63V23.63h6.55V49.89H87.41Zm9.9,0H90.85V30.18H86.46V23.63h4.15c2.23,2.23,4.47,4.47,6.7,6.63Zm24.11-26.26H108.49V36.8H117v6.63h-8.54V49.9h12.85v6.54H108.17L101.7,50V30.34c2.24-2.24,4.39-4.4,6.79-6.71h12.93Zm26.35,19.71-6.63,6.63h-9.58l-6.71-6.71V23.63h6.47V49.89h9.9V23.63h6.55ZM183,28.66c-3.67,3.67-7.58,7.5-11.41,11.33L183,51.41v5.11H178c-3.67-3.75-7.58-7.58-11.42-11.5-3.83,3.91-7.74,7.74-11.41,11.5h-5V51.73c3.75-3.83,7.66-7.74,11.49-11.58-3.91-3.91-7.82-7.74-11.57-11.5v-5h4.79c3.75,3.83,7.66,7.66,11.42,11.5l11.5-11.5H183Z" style="fill:#000"/></svg>
			</a>
		</div>

		<?php milieux_nav(); // .nav-main__content ?>

		<div class="nav-main__quickbar">
			<div class="nav-main__logo"></div>
			<div id="nav-main__toggle"><span>open</span></div>
			<div class="nav-main__search">
				<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="s" class="screen-reader-text"><?php _e( 'Search', 'milieux' ); ?></label>
					<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'milieux' ); ?>" />
				</form>
				<svg class="icon search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.15 11.31"><title>search_icon</title><circle cx="4.41" cy="4.41" r="3.91" style="fill:none;stroke:#fff;stroke-miterlimit:10"/><line x1="10.8" y1="10.96" x2="7.13" y2="7.36" style="fill:none;stroke:#fff;stroke-miterlimit:10"/></svg>
			</div>
		</div>

	</div>
</nav>
