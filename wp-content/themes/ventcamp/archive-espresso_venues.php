<?php
/**
 * Template Name: Venue List
 *
 * This is template will display a list of your event venues
 *
 * Event Registration and Management Plugin for WordPress
 *
 */
get_header();
?>

<div class="container eespresso-container">
    <div class="row">
        <div class="col-md-8 col-sm-12" role="main">
	        <?php espresso_get_template_part( 'loop', 'espresso_venues' ); ?>
        </div><!-- #content -->

        <div class="col-md-offset-1 col-md-3 col-sm-12 sidebar">
		    <?php get_sidebar(); ?>
        </div><!-- #sidebar -->
    </div>
</div>

<?php
get_footer();