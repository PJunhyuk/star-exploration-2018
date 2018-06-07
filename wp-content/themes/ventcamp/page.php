<?php
/*
Default page template
*/

get_header();

// Start of the wrapper
ventcamp_page_wrapper_start();

	while ( have_posts() ) : the_post();

		get_template_part( 'content', 'page' );

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile;

// End of the wrapper
ventcamp_page_wrapper_end();

get_footer();
