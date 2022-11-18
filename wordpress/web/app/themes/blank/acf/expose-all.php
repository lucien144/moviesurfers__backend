<?php

function acf_to_rest_api($response, $post, $request) {
    if (!function_exists('get_fields')) return $response;

    if (isset($post)) {
        $acf = get_fields($post->id);
        $response->data['acf'] = $acf;
    }
    return $response;
}

add_filter('rest_prepare_post', 'acf_to_rest_api', 10, 3);
add_filter('rest_prepare_page', 'acf_to_rest_api', 10, 3);
add_filter('rest_prepare_development', 'acf_to_rest_api', 10, 3);