<?php
/*
*	Plugin name: Newsletter Subscribe
*	Plugin URI: http://www.iodevllc.com
*	Description: Add newsletter functionality to your website
* 	Version: 0.1 beta
*	Author:	Mher Margaryan
*	Author URI: iodevllc.com
*/

if (!defined('ABSPATH')) {
	exit('You are not allowed to be here.');
}

// Require scripts
require_once(plugin_dir_path(__FILE__) . '/includes/newsletter-subscriber-scripts.php');

// Require class
require_once(plugin_dir_path(__FILE__) . '/includes/newsletter-subscriber-class.php');

// Register widget
function register_nws_widget()
{
	register_widget('NWS_Widget');
}
add_action('widgets_init', 'register_nws_widget');