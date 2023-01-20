<?php
function post_type_gossips()
{
	$labels = [
		'name'          => 'Drby', // Plural name
		'singular_name' => 'Drby'   // Singular name
	];

	$supports = [
		'title',
		'author',
		'excerpt',
		'editor',
		//'post-formats',
		'page-attributes',
		'thumbnail',
		'revisions',
		'custom-fields'
	];

	$args = [
		'labels'              => $labels,
		'description'         => 'Filmové plakáty', // Description
		'supports'            => $supports,
		'taxonomies'          => ['post_tag'], // Allowed taxonomies
		'hierarchical'        => FALSE, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
		'public'              => TRUE,  // Makes the post type public
		'show_ui'             => TRUE,  // Displays an interface for this post type
		'show_in_menu'        => TRUE,  // Displays in the Admin Menu (the left panel)
		'show_in_rest'        => TRUE,
		'show_in_nav_menus'   => TRUE,  // Displays in Appearance -> Menus
		'show_in_admin_bar'   => TRUE,  // Displays in the black admin bar
		'menu_position'       => 6,     // The position number in the left menu
		'menu_icon'           => 'dashicons-twitter',  // The URL for the icon used for this post type
		'can_export'          => TRUE,  // Allows content export using Tools -> Export
		'has_archive'         => FALSE,  // Enables post type archive (by month, date, or year)
		'exclude_from_search' => FALSE, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
		'publicly_queryable'  => TRUE,  // Allows queries to be performed on the front-end part if set to true
		'capability_type'     => 'post' // Allows read, edit, delete like “Post”
	];

	register_post_type('gossips', $args); //Create a post type with the slug is ‘product’ and arguments in $args.
}

add_action('init', 'post_type_gossips');