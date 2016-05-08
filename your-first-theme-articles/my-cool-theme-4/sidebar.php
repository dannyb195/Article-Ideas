<?php

get_template_part( 'template-parts/sidebar', 'content-custom' );

if ( is_active_sidebar( 'my-cool-sidebar' ) ) {

	dynamic_sidebar( 'my-cool-sidebar' );

}

?>
