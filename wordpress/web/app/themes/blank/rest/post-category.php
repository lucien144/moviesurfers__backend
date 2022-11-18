<?php
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/category/(?P<slug>([a-z-]+))', [
		'methods'  => 'GET',
		'callback' => function ($args) {
			if (!get_category_by_slug($args['slug'])) {
				return [];
			}

			$posts = get_posts([
				'category' => get_category_by_slug($args['slug'])?->term_id,
			]);

			return array_map(fn ($post) => (new \WP_REST_Posts_Controller($post->post_type))?->prepare_item_for_response($post, new \WP_REST_Request())?->data, $posts);
		},
	]);
});
