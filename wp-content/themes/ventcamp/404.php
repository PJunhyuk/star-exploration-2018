<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="content col-md-12 col-sm-12" role="main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="heading-alt page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'ventcamp' ); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'ventcamp' ); ?></p>

                    <?php
                    get_search_form();
                    ?>

                </div>
            </section>

        </div>
    </div>
</div>

<?php get_footer();
