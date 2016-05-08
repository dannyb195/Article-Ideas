<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive' ); ?>>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class=""><?php the_terms( get_the_ID(), 'positions' ); ?></div>
	<div class="post-content"><?php the_excerpt(); ?></div>
</article>
