<?php

// This theme uses wp_nav_menu() in one location.
register_nav_menu('primary', 'Site Menu');

// Turn on featured images
add_theme_support('post-thumbnails');

//add_theme_support( 'post-formats', ['image']);

// ACF
$libs = [
	'/types/posters.type.php',
	'/types/gossips.type.php',

	'/filters/custom-permalinks.php',
	'/filters/preview-link.php',

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
