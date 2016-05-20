<?php

/**
 * Creating a Query for employees in a department
 *
 * @param string $department The slug of the department taxonomy you want to display.
 */
function wcmpls_show_department( $department ) {

	$employees = new WP_Query( array(
		'post_type' => 'employees',
		'posts_per_page' => 100,
		'tax_query' => array(
			array(
				'taxonomy' => 'departments',
				'field'    => 'slug',
				'terms'    => $department,
			),
		),
	) );
	if ( $employees->have_posts() ) :
		?>
		<ul>
		<?php
		while( $employees->have_posts() ) :
			$employees->the_post();
			?>
				<li><?php the_title(); ?></li>
			<?php
		endwhile; wp_reset_postdata();
		?>
		</ul>
		<?php
	endif;


}

/**
 * Create a query to show all leads
 */
function wcmpls_show_leads() {

	$leads = new WP_Query( array(
		'post_type' => 'employees',
		'posts_per_page' =>100,
		'tax_query' => array(
			array(
				'taxonomy' => 'positions',
				'field'    => 'slug',
				'terms'    => array( 'developer-lead', 'design-lead', 'support-lead' ),
			),
		),
	) );
	if ( $leads->have_posts() ) :
		?>
		<ul>
			<?php
			while( $leads->have_posts() ) :
				$leads->the_post();
				?>
				<li><?php the_title(); ?> - <?php the_terms( get_the_ID(), 'positions' ); ?></li>
			<?php
			endwhile; wp_reset_postdata();
			?>
		</ul>
	<?php
	endif;

}

/**
 * Display an employee's last 5 blog posts on their employee page
 *
 * $user_id Should be a meta value (custom field) added through the WordPress
 * custom field box or plug-in custom field solution.  Add a field where you
 * can input the number of a WordPress user (or some custom field solutions
 * include fields where you can select from a dropdown of existing users).
 *
 * @param int $user_id The ID of a User to fetch posts for.
 */
function wcmpls_employee_posts( $user_id ) {

	$blog_posts = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'author'         => $user_id,
	) );

	if ( $blog_posts->have_posts() ) : ?>
		<ul>
		<?php
		while ( $blog_posts->have_posts() ) :
			$blog_posts->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php
		endwhile;
		wp_reset_postdata();
	endif;

}

/**
 * Display the employee marked Employee of the Month
 *
 * 'employee-of-the-month' is a meta value (custom field) added through the
 * WordPress custom field box or by the use of a custom coded or plug-in
 * custom field solution.
 */
function wcmpls_employee_of_the_month() {

	$eom = new WP_Query( array(
		'post_type'      => 'employees',
		'posts_per_page' => 1,
		'meta_key'       => 'employee-of-the-month',
		'meta_value'     => 'true',
	) );

	while ( $eom->have_posts() ): $eom->the_post();
		the_post_thumbnail( 'thumbnail' );
	endwhile; wp_reset_postdata();

}






















