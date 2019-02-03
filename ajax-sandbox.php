<?php
/**
 Plugin Name: Ajax Sandbox
 Description: Ajax testing
 Author: Daniel Braun
 Version: 1.0
 */
namespace AJAXSANDBOX;
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'plugins_loaded', __NAMESPACE__ . "\\enqueue_plugin_scripts" );

function enqueue_plugin_scripts() {
    wp_enqueue_script( 'plugin-script/js', plugin_dir_url(__FILE__) . 'assets/js/app.js', null, '1.0', true );
}