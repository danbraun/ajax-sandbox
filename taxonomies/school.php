<?php

function school_init() {
	register_taxonomy( 'school', array( 'child' ), array(
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
			'name'                       => __( 'Schools', 'ajax-sandbox' ),
			'singular_name'              => _x( 'School', 'taxonomy general name', 'ajax-sandbox' ),
			'search_items'               => __( 'Search Schools', 'ajax-sandbox' ),
			'popular_items'              => __( 'Popular Schools', 'ajax-sandbox' ),
			'all_items'                  => __( 'All Schools', 'ajax-sandbox' ),
			'parent_item'                => __( 'Parent School', 'ajax-sandbox' ),
			'parent_item_colon'          => __( 'Parent School:', 'ajax-sandbox' ),
			'edit_item'                  => __( 'Edit School', 'ajax-sandbox' ),
			'update_item'                => __( 'Update School', 'ajax-sandbox' ),
			'add_new_item'               => __( 'New School', 'ajax-sandbox' ),
			'new_item_name'              => __( 'New School', 'ajax-sandbox' ),
			'separate_items_with_commas' => __( 'Separate Schools with commas', 'ajax-sandbox' ),
			'add_or_remove_items'        => __( 'Add or remove Schools', 'ajax-sandbox' ),
			'choose_from_most_used'      => __( 'Choose from the most used Schools', 'ajax-sandbox' ),
			'not_found'                  => __( 'No Schools found.', 'ajax-sandbox' ),
			'menu_name'                  => __( 'Schools', 'ajax-sandbox' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'school',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'school_init' );
