<?php
/*
Template Name: Sidebar Right
*/

get_header();

?>

<div class="container">
    <div class="row">
        <div class="content col-md-8 col-sm-12" role="main">
		    <?php
		    while ( have_posts() ) : the_post();

			    get_template_part( 'content', 'page' );

			    if ( comments_open() || get_comments_number() ) :
				    comments_template();
			    endif;

		    endwhile;
		    ?>
        </div>

        <div class="col-md-offset-1 col-md-3 col-sm-12 sidebar">
		    <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
