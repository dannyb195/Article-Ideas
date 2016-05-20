<?php

/**
 * Registers a new post type
 *
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function register_employee_cpt() {

	register_post_type( 'employees', array(
		'labels'                   => array(
			'name'                => __( 'Employees', 'text-domain' ),
			'singular_name'       => __( 'Employee', 'text-domain' ),
			'add_new'             => __( 'Add New Employee', 'text-domain' ),
			'add_new_item'        => __( 'Add New Employee', 'text-domain' ),
			'edit_item'           => __( 'Edit Employee', 'text-domain' ),
			'new_item'            => __( 'New Employee', 'text-domain' ),
			'view_item'           => __( 'View Employee', 'text-domain' ),
			'search_items'        => __( 'Search Employees', 'text-domain' ),
			'not_found'           => __( 'No Employees found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Employees found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent Employee:', 'text-domain' ),
			'menu_name'           => __( 'Employees', 'text-domain' ),
		),
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-smiley', // See https://developer.wordpress.org/resource/dashicons/#album
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'comments',
			'revisions',
			'page-attributes',
			),
	) );

}

add_action( 'init', 'register_employee_cpt' );

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function register_positions_taxonomy() {
register_taxonomy( 'positions', array( 'employees' ), array(
	'labels'            => array(
		'name'                  => __( 'Positions', 'text-domain' ),
		'singular_name'         => __( 'Position', 'text-domain' ),
		'search_items'          => __( 'Search Positions', 'text-domain' ),
		'popular_items'         => __( 'Popular Positions', 'text-domain' ),
		'all_items'             => __( 'All Positions', 'text-domain' ),
		'parent_item'           => __( 'Parent Position', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Position', 'text-domain' ),
		'edit_item'             => __( 'Edit Position', 'text-domain' ),
		'update_item'           => __( 'Update Position', 'text-domain' ),
		'add_new_item'          => __( 'Add New Position', 'text-domain' ),
		'new_item_name'         => __( 'New Position Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Positions', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used text-domain', 'text-domain' ),
		'menu_name'             => __( 'Positions', 'text-domain' ),
	),
	'public'            => true,
	'show_in_nav_menus' => true,
	'show_admin_column' => true,
	'hierarchical'      => true,
	'show_tagcloud'     => true,
	'show_ui'           => true,
	'query_var'         => true,
	'rewrite'           => true,
	'query_var'         => true,
	'capabilities'      => array(),
	) );
}
add_action( 'init', 'register_positions_taxonomy' );

/**
 * Create another taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function register_departments_taxonomy() {
	register_taxonomy( 'departments', array( 'employees' ), array(
		'labels'            => array(
			'name'                  => __( 'Departments', 'text-domain' ),
			'singular_name'         => __( 'Department', 'text-domain' ),
			'search_items'          => __( 'Search Departments', 'text-domain' ),
			'popular_items'         => __( 'Popular Departments', 'text-domain' ),
			'all_items'             => __( 'All Departments', 'text-domain' ),
			'parent_item'           => __( 'Parent Department', 'text-domain' ),
			'parent_item_colon'     => __( 'Parent Department', 'text-domain' ),
			'edit_item'             => __( 'Edit Department', 'text-domain' ),
			'update_item'           => __( 'Update Department', 'text-domain' ),
			'add_new_item'          => __( 'Add New Department', 'text-domain' ),
			'new_item_name'         => __( 'New Department Name', 'text-domain' ),
			'add_or_remove_items'   => __( 'Add or remove Departments', 'text-domain' ),
			'choose_from_most_used' => __( 'Choose from most used text-domain', 'text-domain' ),
			'menu_name'             => __( 'Departments', 'text-domain' ),
		),
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	) );
}
add_action( 'init', 'register_departments_taxonomy' );