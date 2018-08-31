<nav id="nav-main" class="nav-main nav-main--collapsed">

	<div class="nav-main__inner">

		<div class="nav-main__header">
			<a href="<?= home_url(); ?>" rel="home">
				<p class="screen-reader-text"><?php bloginfo('name'); ?></p>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202 80" style="background:white"><title>milieux_mask</title><path d="M0,0V80.67H202.53V0ZM52.21,56.44H45.58v-26c-3.35,3.35-6.46,6.54-9.82,9.81-3.35-3.35-6.46-6.54-9.9-10C26,39.2,26,47.82,26,56.52H19.4V23.71L24,19.08c3.83,3.83,7.66,7.74,11.42,11.57,4.07-4.07,7.9-8,11.65-11.65,1.83,1.76,3.35,3.35,5.11,5Zm13.25.08H59V30.26H54.6V23.63h4.16l6.7,6.71Zm22-.08H76.64c-2.24-2.24-4.39-4.39-6.71-6.63V23.63h6.55V49.89H87.41Zm9.9,0H90.85V30.18H86.46V23.63h4.15c2.23,2.23,4.47,4.47,6.7,6.63Zm24.11-26.26H108.49V36.8H117v6.63h-8.54V49.9h12.85v6.54H108.17L101.7,50V30.34c2.24-2.24,4.39-4.4,6.79-6.71h12.93Zm26.35,19.71-6.63,6.63h-9.58l-6.71-6.71V23.63h6.47V49.89h9.9V23.63h6.55ZM183,28.66c-3.67,3.67-7.58,7.5-11.41,11.33L183,51.41v5.11H178c-3.67-3.75-7.58-7.58-11.42-11.5-3.83,3.91-7.74,7.74-11.41,11.5h-5V51.73c3.75-3.83,7.66-7.74,11.49-11.58-3.91-3.91-7.82-7.74-11.57-11.5v-5h4.79c3.75,3.83,7.66,7.66,11.42,11.5l11.5-11.5H183Z" style="fill:#000"/></svg>
			</a>
		</div>

		<?php milieux_nav(); // .nav-main__content ?>

	</div>

	<div class="nav-main__quickbar">
		<div class="nav-main__logo">
			<a href="<?= home_url(); ?>" rel="home">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.022 19.022">
				  <g transform="translate(0 0)">
				    <path d="M18.7,30.6l-2.1,2.1V37.64h2.1Z" transform="translate(-16.6 -18.617)"/>
				    <path d="M32.312,24.2l-4.493,4.493L23.4,24.2V36.033l4.419-4.493,4.493,4.493Z" transform="translate(-18.307 -17.01)"/>
				    <path d="M39.3,37.665h2.022V32.722L39.3,30.7Z" transform="translate(-22.3 -18.642)"/>
				    <path d="M30.68,14.6l-4.568,4.568L21.618,14.6H16.6v5.018l2.1,2.022V18.794l2.1-2.172,5.317,5.392L31.5,16.622l2.1,2.172h0V21.64l2.022-2.022V14.6Z" transform="translate(-16.6 -14.6)"/>
				  </g>
				</svg>
			</a>
		</div>
		<div class="nav-main__toggle" id="nav-toggle"><span><?= __('open', 'milieux'); ?></span></div>
		<div class="nav-main__search" >
			<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label for="s" class="screen-reader-text"><?php _e( 'Search', 'milieux' ); ?></label>
				<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'milieux' ); ?>" />
			</form>
			<svg id="nav-search" class="icon search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.30 11.30">
				<g class="mag">
					<circle cx="4.41" cy="4.41" r="3.91" style="fill:none; stroke:#fff;"/>
					<line x1="10.8" y1="10.96" x2="7.13" y2="7.36" style="fill:none; stroke:#fff;"/>
				</g>
				<g class="cross">
					<line x1="0" y1="0" x2="11.30" y2="11.30" style="stroke:#fff;" />
					<line x1="0" y1="11.30" x2="11.30" y2="0" style="stroke:#fff;" />
				</g>
			</svg>
		</div>
		<div class="nav-main__line" id="nav-line">
		</div>
	</div>
</nav>
