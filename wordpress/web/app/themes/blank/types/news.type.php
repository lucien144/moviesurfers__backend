<?php
function post_type_news()
{
	$labels = [
		'name'          => 'Aktuálně', // Plural name
		'singular_name' => 'Aktualita'   // Singular name
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
		'description'         => 'Novinky z Hollywoodu', // Description
		'supports'            => $supports,
		//'taxonomies'          => ['topics'], // Allowed taxonomies
		'hierarchical'        => FALSE, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
		'public'              => TRUE,  // Makes the post type public
		'show_ui'             => TRUE,  // Displays an interface for this post type
		'show_in_menu'        => TRUE,  // Displays in the Admin Menu (the left panel)
		'show_in_rest'        => TRUE,
		'show_in_nav_menus'   => TRUE,  // Displays in Appearance -> Menus
		'show_in_admin_bar'   => TRUE,  // Displays in the black admin bar
		'menu_position'       => 6,     // The position number in the left menu
		'menu_icon'           => 'dashicons-clock',  // The URL for the icon used for this post type
		'can_export'          => TRUE,  // Allows content export using Tools -> Export
		'has_archive'         => FALSE,  // Enables post type archive (by month, date, or year)
		'exclude_from_search' => FALSE, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
		'publicly_queryable'  => TRUE,  // Allows queries to be performed on the front-end part if set to true
		'capability_type'     => 'post' // Allows read, edit, delete like “Post”
	];

	register_post_type('news', $args); //Create a post type with the slug is ‘product’ and arguments in $args.

    register_taxonomy( 'categories', ['news'], [
            'hierarchical' => true,
            'label' => 'Categories',
            'singular_label' => 'Category',
            'show_in_rest' => true,
        ]
    );
}

add_action('init', 'post_type_news');