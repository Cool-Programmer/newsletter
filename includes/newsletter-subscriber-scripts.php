<?php
	function nws_enqueue_scripts()
	{
		wp_enqueue_style('nws-main-stylesheet', plugins_url() . '/newsletter-subscriber/css/style.css');
		wp_enqueue_script('nws-main-javascript', plugins_url() . '/newsletter-subscriber/js/main.js', ['jquery']);
	}
	add_action('wp_enqueue_scripts', 'nws_enqueue_scripts');