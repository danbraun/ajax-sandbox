<?php

function child_init() {
	register_post_type( 'child', array(
		'labels'            => array(
			'name'                => __( 'Children', 'ajax-sandbox' ),
			'singular_name'       => __( 'Child', 'ajax-sandbox' ),
			'all_items'           => __( 'All Children', 'ajax-sandbox' ),
			'new_item'            => __( 'New child', 'ajax-sandbox' ),
			'add_new'             => __( 'Add New', 'ajax-sandbox' ),
			'add_new_item'        => __( 'Add New child', 'ajax-sandbox' ),
			'edit_item'           => __( 'Edit child', 'ajax-sandbox' ),
			'view_item'           => __( 'View child', 'ajax-sandbox' ),
			'search_items'        => __( 'Search children', 'ajax-sandbox' ),
			'not_found'           => __( 'No children found', 'ajax-sandbox' ),
			'not_found_in_trash'  => __( 'No children found in trash', 'ajax-sandbox' ),
			'parent_item_colon'   => __( 'Parent child', 'ajax-sandbox' ),
			'menu_name'           => __( 'Children', 'ajax-sandbox' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'child',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'child_init' );

function child_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['child'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Child updated. <a target="_blank" href="%s">View child</a>', 'ajax-sandbox'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'ajax-sandbox'),
		3 => __('Custom field deleted.', 'ajax-sandbox'),
		4 => __('Child updated.', 'ajax-sandbox'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Child restored to revision from %s', 'ajax-sandbox'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Child published. <a href="%s">View child</a>', 'ajax-sandbox'), esc_url( $permalink ) ),
		7 => __('Child saved.', 'ajax-sandbox'),
		8 => sprintf( __('Child submitted. <a target="_blank" href="%s">Preview child</a>', 'ajax-sandbox'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Child scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview child</a>', 'ajax-sandbox'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Child draft updated. <a target="_blank" href="%s">Preview child</a>', 'ajax-sandbox'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'child_updated_messages' );
