<?php

add_action( 'wp_enqueue_scripts', 'my_cool_theme_scripts' );

// Enqueue styles and scripts
function my_cool_theme_scripts() {
	 wp_enqueue_style( 'your-cool-theme-styles', get_stylesheet_uri() );
}

if ( ! function_exists( 'my_cool_theme_sidebar' ) ) {

	// Register Sidebars
	function my_cool_theme_sidebar() {

		$args = array(
		'name'          => __( 'My Cool Sidebar', 'my_cool_theme' ),
		'id'			=> 'my-cool-sidebar',
		'class'         => 'sidebar',
		'before_title'  => '<h3 class="sidebar-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		);
		register_sidebar( $args );

	}

	add_action( 'widgets_init', 'my_cool_theme_sidebar' );

}

add_theme_support( 'post-thumbnails' );



require_once( 'inc/custom-post-type-employee.php' );
require_once( 'inc/employee-template-tags.php' );


/**
 * Re-order the posts on the Employee archive page.
 */
function wcmpls_reorder_employees( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'employees' ) ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}

}
add_action( 'pre_get_posts', 'wcmpls_reorder_employees' );










