<?php
add_filter('rest_prepare_post', 'get_all_posts', 10, 3);
function get_all_posts($data, $singlePost, $context)
{
	$_data = $data->data;

	// Remove rendered prop
	$_data['title'] = html_entity_decode($data->data['title']['rendered']);
	$_data['title_share'] = urlencode(html_entity_decode($data->data['title']['rendered']));
	$_data['content'] = $data->data['content']['rendered'];
	$_data['excerpt'] = strip_tags($data->data['excerpt']['rendered']);

	if ($data->data['featured_media']) {
		$media = get_post($data->data['featured_media']);
		if ($media instanceof WP_Post) {
			$_data['featured_media'] = $media->guid;
		} else {
			$_data['featured_media'] = NULL;
		}
	}

	// Load categories
	foreach ($data->data['categories'] as $categoryId) {
		$category = get_term($categoryId);
		$categories[] = [
			'id' => $categoryId,
			'title' => $category->name,
			'slug'  => $category->slug,
		];
	}
	$_data['categories'] = $categories;

	// Load attachments
	$attachments = array_values(get_attached_media('image', $data->data['id']));
	$attachments = array_map(function (WP_Post $attachment) {
		return [
			'url' => $attachment->guid,
		];
	}, $attachments);
	$_data['attachments'] = $attachments;

	// Load author data
	$author = get_userdata($data->data['author'])->data;
	$_data['author'] = ['name' => $author->display_name];

	// Cleanup
	$_data = array_filter($_data, function ($key) {
		return !in_array($key, [
			'tags',
			'guid',
			'modified',
			'modified_gmt',
			'status',
			'type',
			'link',
			'comment_status',
			'ping_status',
			'sticky',
			'template',
			'format',
			'meta',
		]);
	}, ARRAY_FILTER_USE_KEY);

	$data->data = $_data;
	return $data;
}