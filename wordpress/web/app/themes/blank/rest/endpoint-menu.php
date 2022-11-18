<?php

// Allow REST API previews
add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/menus', [
		'methods'  => 'GET',
		'callback' => fn() => [
			'main'         => getMenu('main-menu'),
			'legals'       => getMenu('legals'),
			'developments' => (function () {
				$pages = get_pages(['post_type' => 'development', 'sort_column' => 'menu_order', 'parent' => 0]);
				function getChildren($pages)
				{
					$tree = [];
					foreach ($pages as $page) {
						$parsedUrl = parseUrl(get_permalink($page->ID));
						$node = [
							'id'         => $page->ID,
							'title'      => $page->post_title,
							'slug'       => $page->post_name,
							'url'        => $parsedUrl['url'],
							'isAbsolute' => $parsedUrl['isAbsolute'],
							'target'     => $parsedUrl['isAbsolute'] ? '_blank' : '_self',
						];
						$node['children'] = getChildren(get_pages(['post_type' => 'development', 'sort_column' => 'menu_order', 'parent' => $page->ID]));
						$tree[] = $node;
					}
					return $tree;
				}

				return getChildren($pages);
			})(),
			'footer' => getMenu('footer')
		],
	]);
});

function getMenu($slug): array
{
	$items = wp_get_nav_menu_items($slug) ?: [];
	return buildTree($items);
}

function buildTree(array &$elements, $parentId = 0)
{
	$menu = [];
	foreach ($elements as &$item) {
		if ($item->menu_item_parent == $parentId) {
			$parsedUrl = parseUrl($item->url);

			$children = buildTree($elements, $item->ID);
			$menu[] = [
				'id'         => intval($item->object_id),
				'title'      => $item->title ?? '',
				'url'        => $parsedUrl['url'],
				'target'     => $parsedUrl['isAbsolute'] ? '_blank' : '_self',
				'isAbsolute' => $parsedUrl['isAbsolute'],
				'children'   => $children,
			];
		}
	}
	return $menu;
}

function parseUrl($itemUrl)
{
	$url = str_replace(getenv('WP_HOME'), '', $itemUrl);
	$url = str_replace(getenv('WP_FRONTEND'), '', $url);
	$isAbsolute = preg_match('/^https?:\/\//', $url ?? '') === 1;
	$url = !$isAbsolute && preg_match('/^\//', $url) === 0 ? '/' . $url : $url;

	return [
		'url'        => $url,
		'isAbsolute' => $isAbsolute,
	];
}