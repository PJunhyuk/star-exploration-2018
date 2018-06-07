<?php
/**
 * Template Name: Venue Details
 *
 * This is template will display all of your Venue's details
 */

get_header();
?>

<div class="container eespresso-container">
    <div id="primary" class="row" role="main">

        <div id="espresso-venue-details-wrap-dv" class="">
            <div id="espresso-venue-details-dv" class="" >
				<?php
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        //  Include the post TYPE-specific template for the content.
                        espresso_get_template_part( 'content', 'espresso_venues' );
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
