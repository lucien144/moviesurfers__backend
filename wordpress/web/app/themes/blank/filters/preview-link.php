<?php

/**
 * Customize the preview button in the WordPress admin to point to the headless client.
 *
 * @param str $link The WordPress preview link.
 * @return string The headless WordPress preview link.
 */
function set_headless_preview_link($link)
{
	return \Env\env('WP_FRONTEND') . '/resources/__preview/?id=' . get_the_ID();
}

add_filter('preview_post_link', 'set_headless_preview_link');