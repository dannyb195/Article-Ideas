<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive' ); ?>>
	<h2><?php the_title(); ?></h2>
	<div class="author"><?php the_author(); ?></div>
	<div class="post-content"><?php the_content(); ?></div>
</article>