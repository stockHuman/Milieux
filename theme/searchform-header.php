<form id="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search">
	<label for="search" class="search-label screen-reader-text">search</label>
	<input type="search" name="s" id="search" value="<?php the_search_query(); ?>" class="input-search" autocomplete="off" placeholder="Search ..." />
	<svg class="search-icon">
		<use xlink:href="<?= get_stylesheet_directory_uri(); ?>/assets/icons/fa-regular.svg#search"></use>
	</svg>
</form>
