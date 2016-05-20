<?php
// accessible from http://test.me.dev/employees/
get_header(); ?>
<section class="content-left">
	<h1>Our Team</h1>
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

	<div class="employee-of-the-month">
		<!-- Add Employee of the Month Template Tag Here -->
		<h2>Employee of the Month</h2>
		<?php wcmpls_employee_of_the_month(); ?>
	</div>


	<div class="team-leads">
		<!-- Add Team Lead template tag here -->
		<h2>Team Leads</h2>
		<?php wcmpls_show_leads(); ?>
	</div>

	<?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>









