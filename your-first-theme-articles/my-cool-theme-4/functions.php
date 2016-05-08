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

require_once( 'inc/custom-post-type-employee.php' );

// $posts = get_posts( array(
// 	'post_type' => 'employee',
// ) );

// echo '<pre>';
// print_r($posts);
// echo '</pre>';

// foreach ( $posts as $post ) {
// 	$post->post_type = 'employees';
// 	$test = wp_update_post( $post, true );

// 	// echo $test;
// }
