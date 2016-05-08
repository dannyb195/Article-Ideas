<?php
// accessible from http://test.me.dev/employees/
get_header(); ?>
<section class="content-left">

	<?php if ( have_posts() ) {

		// Start the loop.
		while ( have_posts() ) {
			// WordPress core function to set up post data
			the_post();

			// Our template which we use for each post
			get_template_part( 'template-parts/post', 'employee' );
		}
		// End the loop.
} else {
	// if there is no content in the loop, display your "no content" template here
} ?>

</section>
<aside class="content-right">
	<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>