<?php

function customPostPermalink( $permalink, $post ) {
	return str_replace(home_url(), \Env\env('WP_FRONTEND') . '/resources',  $permalink);
};

function customPagePermalink( $permalink, $post ) {
	return str_replace(home_url(), \Env\env('WP_FRONTEND'),  $permalink);
};

add_filter('page_link', 'customPagePermalink', 10, 2);
add_filter('post_link', 'customPostPermalink', 10, 2);