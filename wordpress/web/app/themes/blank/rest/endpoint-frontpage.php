<?php

add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/frontpage', [
		'methods'  => 'GET',
		'callback' => function () {
			$controller = new \WP_REST_Posts_Controller('page');
			$req = new \WP_REST_Request();
			$req['id'] = (int) get_option('page_on_front');
			return $controller->get_item($req);
		},
	]);
});