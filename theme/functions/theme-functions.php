<?php

function milieux_featured_image () {
	return '<img class="featured-image hero" src="' . get_the_post_thumbnail_url() . '" srcset="' . wp_get_attachment_image_srcset(get_post_thumbnail_id()) . '" alt="'. esc_html ( get_the_post_thumbnail_caption() ) . '">';
}
