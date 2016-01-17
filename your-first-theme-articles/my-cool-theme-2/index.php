<?php
get_header();

if ( have_posts() ) {

	// Start the loop 
	// This is where content that wraps around all of your posts will go
	while ( have_posts() ) {
		
		// WordPress core function to set up post data
		the_post();

		// Our template which we use for each post
		get_template_part( 'template-parts/post', 'loop' );
	}
	// End the loop
	// Close the contet that wraps around all of your posts

} else {
	// if there is no content in the loop, display your "no content" template here
}

get_footer();
?>