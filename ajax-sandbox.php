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

/**
 * Post types and taxonomies
 */
include_once('post-types/child.php');
include_once('taxonomies/parent.php');
include_once('taxonomies/school.php');

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . "\\enqueue_plugin_scripts" );

function enqueue_plugin_scripts( $hook ) {

	if( $hook != 'toplevel_page_ajax-sandbox-admin-menu' ) {
		return;
	}
	$admin_ajax_php = admin_url( 'admin-ajax.php' );
	wp_enqueue_style( 'bulma/css', plugin_dir_url(__FILE__) . 'assets/css/bulma.min.css', null, '0.7.2', 'all' );
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
   ?>
	<div id="js-content" class="container is-fluid">
	<h1 class="title">AJAX SANDBOX</h1>
	<div class="columns">
	<section class="column">
		<form>
			<div class="field">
				<label class="label">Enter Search:</label>
				<div class="control">
					<input class="search-box is-medium input" type="text">
				</div>
			</div>
			<div class="field">
					<div class="control">
						<button class="button submit-search">Submit Search</button>
					</div>
				</div>
		</form>
	</section>
	<section class="column is-two-thirds">
		<div class="return-text notification is-hidden"></div>
	</section>
	</div>
	</div>	
   <?php
}

add_action( 'wp_ajax_respond_please', __NAMESPACE__ . '\\ajax_callback');
add_action( 'wp_ajax_nopriv_respond_please', __NAMESPACE__ . '\\ajax_callback');
function ajax_callback() {
	$posts = new \WP_Query( array(
		'post-type' => 'child',
		'posts-per-page' => -1,
		's' => $_POST['search_query_text']
	));
	$arr = [
		'posts' => $posts
		];
	wp_send_json( $arr );
}

/**
 * Column editing
 * @link https://www.smashingmagazine.com/2017/12/customizing-admin-columns-wordpress/
 */
add_filter( 'manage_child_posts_columns', __NAMESPACE__ . '\\daniel_filter_posts_columns' );
function daniel_filter_posts_columns( $columns ) {
	$columns = array(
		'cb' => $columns['cb'],
		'title' => __( 'Title' ),
		'school' => __( 'School' ),
	  );
  return $columns;
}

add_action( 'manage_child_posts_custom_column', __NAMESPACE__ . '\\daniel_child_column', 10, 2);
function daniel_child_column( $column, $post_id ) {
  // School column
  if ( 'school' === $column ) {
	// make sure that ACF tax field is set to return object not id
	$term_obj = get_field( 'school' );
    echo $term_obj->name;
  }
}
/**
 * Sorting for school
 */
add_filter( 'manage_edit-child_sortable_columns', __NAMESPACE__ . '\\daniel_child_sortable_columns');
function daniel_child_sortable_columns( $columns ) {
  $columns['school'] = 'school_being_attended';
  return $columns;
}
add_action( 'pre_get_posts', __NAMESPACE__ . '\\daniel_posts_orderby' );
function daniel_posts_orderby( $query ) {
  if( ! is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( 'school_being_attended' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'school_being_attended' );
    $query->set( 'meta_type', 'alpha' );
  }
}