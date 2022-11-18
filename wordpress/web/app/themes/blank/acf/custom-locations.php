<?php

class InvisibleLocation extends ACF_Location
{

	function initialize()
	{
		$this->category = 'Others';
		$this->name = 'invisible';
		$this->label = __('Invisible');
	}


	function match($rule, $screen, $field_group)
	{
		return FALSE;
	}
}

acf_register_location_type('InvisibleLocation');

class DevelopmentLocation extends ACF_Location
{

	function initialize()
	{
		$this->category = 'Others';
		$this->name = 'development';
		$this->label = __('Development');
	}


	function match($rule, $screen, $field_group)
	{
		$post = get_post($screen['post_id'] ?? 0);
		return $post && $post->post_parent === 0 && $post->post_type === 'development';
	}
}

acf_register_location_type('DevelopmentLocation');