<?php

// Start the loop.
while ( have_posts() ) {
	// WordPress core function to set up post data
	the_post(); ?>

	<h3 class="sidebar-title sidebar-post-title"><?php the_title(); ?></h3>

<?php }
// End the loop.

?>