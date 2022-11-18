<?php

// Allow REST API previews
add_action('rest_api_init', function () {
	register_rest_route('/wp/v2/preview/', '/(?P<id>\d+)', [
		'methods'  => 'GET',
		'callback' => 'get_preview',
	]);

});

function get_preview($data)
{
	$post = get_post($data['id']);

	if (empty($post)) {
		return wp_send_json_error('Not found.', 404);
	}

	$req = new WP_REST_Request();
	$req['id'] = $data['id'];
	$controller = new \WP_REST_Posts_Controller($post->post_type);
	return $controller->get_item($req);
}