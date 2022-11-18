<?php

// This theme uses wp_nav_menu() in one location.
register_nav_menu('primary', 'Site Menu');

// Turn on featured images
add_theme_support('post-thumbnails');

// ACF
$libs = [
//	'/acf/expose-all.php',
//	'/acf/seo.php',
//	'/acf/custom-locations.php',
//	'/acf/filter-links.php',

	'/filters/custom-permalinks.php',
	'/filters/preview-link.php',
//	'/filters/imgproxy.php',

//	'/actions/posts-to-news.php',

	'/rest/endpoint-menu.php',
	'/rest/endpoint-frontpage.php',
	'/rest/preview-links.php',
	'/rest/get-all-posts.php',
	'/rest/post-category.php',
	'/rest/add-rand-orderby.php',
];

foreach ($libs as $lib) {
	if (file_exists(__DIR__ . $lib)) {
		include_once __DIR__ . $lib;
	}
}
