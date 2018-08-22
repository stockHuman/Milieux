<aside id="feature-sidebar" class="sidebar large-4 medium-4 columns" role="complementary">

	<?php if ( is_active_sidebar( 'feature-sidebar' ) ) : ?>

		<?php dynamic_sidebar( 'feature-sidebar' ); ?>

	<?php else : ?>

	<!-- This content shows up if there are no widgets defined in the backend. -->

	<?php endif; ?>

</aside>
