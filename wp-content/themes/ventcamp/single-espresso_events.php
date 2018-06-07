<?php
/**
 * Template Name: Event Details
 *
 * This is template will display all of your event's details
 */

get_header();
?>

<div class="container eespresso-container">
    <div id="primary" class="row" role="main">

        <div id="espresso-event-details-wrap-dv" class="content">
            <div id="espresso-event-details-dv">
                <?php
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        //  Include the post TYPE-specific template for the content.
                        espresso_get_template_part( 'content', 'espresso_events' );
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    endwhile;
                ?>
            </div>
        </div>

    </div><!-- #primary -->
</div>

<?php
get_footer();
