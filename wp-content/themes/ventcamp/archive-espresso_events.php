<?php
/**
 * Template Name: Event List
 *
 * This template will display a list of your events
 *
 */
get_header();
?>

<div class="container eespresso-container">
    <div class="row">
        <div class="col-md-8 col-sm-12" role="main">
		    <?php espresso_get_template_part( 'loop', 'espresso_events' ); ?>
        </div><!-- #content -->

        <div class="col-md-offset-1 col-md-3 col-sm-12 sidebar">
            <?php get_sidebar(); ?>
        </div><!-- #sidebar -->
    </div>
</div>

<?php
get_footer();