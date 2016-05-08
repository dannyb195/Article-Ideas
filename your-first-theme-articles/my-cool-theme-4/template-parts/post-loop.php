<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive' ); ?>>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="author"><?php the_author(); ?></div>
	<div class="post-content"><?php the_excerpt(); ?></div>
</article>
