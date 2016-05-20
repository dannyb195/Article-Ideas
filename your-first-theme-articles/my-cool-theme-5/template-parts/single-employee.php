<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive' ); ?>>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="photo"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
	<div class="">Position: <?php the_terms( get_the_ID(), 'positions' ); ?></div>
	<div class="">Department: <?php the_terms( get_the_ID(), 'departments' ); ?></div>
	<div class="post-content"><?php the_content(); ?></div>

	<h2>Employee Blog Posts</h2>
	<div class="blog-posts">
		<!-- Insert employee posts template tag here. -->
		<?php
		/**
		 * Gets the last 3 blog posts by the WP User tied to this employee page.
		 * To tie a user to this employee page, add a custom field where you can
		 * input or select a User from WordPress. This could be as simple as using
		 * the built-in WP custom fields and adding the ID of a user, adding a text
		 * field to input a user ID, or implementing a drop-down of WP Users.
		 *
		 * See:
		 */
		wcmpls_employee_posts( get_post_meta( get_the_ID(), 'employee-user-id', true ) );
		?>
	</div>
</article>
