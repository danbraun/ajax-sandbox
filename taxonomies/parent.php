<?php

function parent_init() {
	register_taxonomy( 'parent', array( 'child' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Parents', 'ajax-sandbox' ),
			'singular_name'              => _x( 'Parent', 'taxonomy general name', 'ajax-sandbox' ),
			'search_items'               => __( 'Search parents', 'ajax-sandbox' ),
			'popular_items'              => __( 'Popular parents', 'ajax-sandbox' ),
			'all_items'                  => __( 'All parents', 'ajax-sandbox' ),
			'parent_item'                => __( 'Parent parent', 'ajax-sandbox' ),
			'parent_item_colon'          => __( 'Parent parent:', 'ajax-sandbox' ),
			'edit_item'                  => __( 'Edit parent', 'ajax-sandbox' ),
			'update_item'                => __( 'Update parent', 'ajax-sandbox' ),
			'add_new_item'               => __( 'New parent', 'ajax-sandbox' ),
			'new_item_name'              => __( 'New parent', 'ajax-sandbox' ),
			'separate_items_with_commas' => __( 'Separate parents with commas', 'ajax-sandbox' ),
			'add_or_remove_items'        => __( 'Add or remove parents', 'ajax-sandbox' ),
			'choose_from_most_used'      => __( 'Choose from the most used parents', 'ajax-sandbox' ),
			'not_found'                  => __( 'No parents found.', 'ajax-sandbox' ),
			'menu_name'                  => __( 'Parents', 'ajax-sandbox' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'parent',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'parent_init' );
