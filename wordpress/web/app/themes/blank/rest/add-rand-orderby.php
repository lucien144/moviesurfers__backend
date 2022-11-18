<?php
add_filter('rest_post_collection_params', 'add_rand_orderby_rest_post_collection_params');

/**
 * Add `rand` as an option for orderby param in REST API.
 * Hook to `rest_{$this->post_type}_collection_params` filter.
 *
 * @param array $query_params Accepted parameters.
 * @return array
 */
function add_rand_orderby_rest_post_collection_params($query_params)
{
	$query_params['orderby']['enum'][] = 'rand';
	return $query_params;
}