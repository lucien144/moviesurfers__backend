<?php

add_filter('wp_get_attachment_url', function ($url) {
	if (is_admin()) {
		return $url;
	}

	return str_replace(getenv('WP_HOME'), getenv('WP_DOCKER'), $url);
});