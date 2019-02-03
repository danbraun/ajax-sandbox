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
	$admin_ajax_php = admin_url( 'admin-ajax.php' );
	wp_enqueue_script( 'plugin-script/js', plugin_dir_url(__FILE__) . 'assets/js/app.js', null, '1.0', true );
	wp_localize_script('plugin-script/js', 'localized_data', array(
		'ajaxurl' => admin_url('admin-ajax.php')
	 ));
}

add_action( 'admin_menu', __NAMESPACE__ . '\\add_admin_menu' );

function add_admin_menu() {
    add_menu_page(
		'AJAX SANDBOX',
		'AJAX SANDBOX',
		'manage_options',
		'ajax-sandbox-admin-menu',
		__NAMESPACE__ . '\\ajax_sandbox_content',
		'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="M1591 1448q56 89 21.5 152.5t-140.5 63.5h-1152q-106 0-140.5-63.5t21.5-152.5l503-793v-399h-64q-26 0-45-19t-19-45 19-45 45-19h512q26 0 45 19t19 45-19 45-45 19h-64v399zm-779-725l-272 429h712l-272-429-20-31v-436h-128v436z"/></svg>'),
		25
	);
}

function ajax_sandbox_content() {
    echo '<div ID="js-content"></div>';
}

add_action( 'wp_ajax_respond_please', __NAMESPACE__ . '\\ajax_callback');
add_action( 'wp_ajax_nopriv_respond_please', __NAMESPACE__ . '\\ajax_callback');
function ajax_callback() {
	$arr = [
		'text_msg' => $_POST['search_query_text']
	];
	wp_send_json( $arr );
}