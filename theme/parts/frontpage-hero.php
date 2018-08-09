<section id="fp-cta" class="block fp-cta">
<?php $hero_img_ID = get_field( 'fp_cta_hero_image', 'homepage_theme_mod' ); ?>
	<img src="<?= wp_get_attachment_image_url($hero_img_ID); ?>" srcset="<?= esc_attr(wp_get_attachment_image_srcset($hero_img_ID)); ?>">
</section>
