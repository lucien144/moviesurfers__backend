<?php

add_filter('acf/format_value/type=link', function($field) {
	if (isset($field['url'])) {
		$url = str_replace(getenv('WP_FRONTEND'), '', $field['url']);
		$url = str_replace(getenv('WP_HOME'), '', $url);
		$field['url'] = $url;
	}
	return $field;
});