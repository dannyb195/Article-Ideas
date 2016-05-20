<?php get_header(); ?>
index
<section class="content-left">

	<?php if ( have_posts() ) {

		// Start the loop.
		while ( have_posts() ) {
			// WordPress core function to set up post data
			the_post();

			// Our template which we use for each post
			get_template_part( 'template-parts/post', 'loop' );
		}
		// End the loop.
} else {
	// if there is no content in the loop, display your "no content" template here
} ?>

</section>
<aside class="content-right">

	<div class="employees">
		<h2>Employees</h2>
		<!-- Basic custom WP_Query loop -->
		<ul>
		<?php
		/**
		 * Output a basic WP_Query witha  few parameters on our custom
		 * employee post type.
		 *
		 * See for more info on WP_Query: https://codex.wordpress.org/Class_Reference/WP_Query
		 */
		$employees = new WP_Query( array(
			'post_type'      => 'employees',
			'posts_per_page' => 3,
			'orderby'        => 'title',
			'order'          => 'ASC',
		) );

		while ( $employees->have_posts() ) :
			$employees->the_post(); ?>
			<li><?php the_title(); ?></li>
		<?php
		endwhile; wp_reset_postdata();
		?>
		</ul>
	</div>


	<h2>Developers RULE!</h2>
	<!-- Show all employees within an department here -->
	<?php
	/**
	 * Display a listing of all employees in the 'departments' taxonomy. Pass in
	 * the slug of the department taxonomy term to get results.
	 */
	wcmpls_show_department( 'developers' );
	?>

	<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>

















