<?php
/*
Blog Search page template
*/

get_header();

?>
<div class="container">
    <div class="row">
		<div class="content col-md-8 col-sm-12" role="main">
			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h3 class="heading-alt page-title"><?php printf( esc_html__( 'Search Results for: %s', 'ventcamp' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
				</header>

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'search' );

				endwhile;

				// Init our pagination class
				$pagination = new Pagination();
				// Output the resulted links
				$pagination->get_links();

			else :

				get_template_part( 'content', 'none' );

			endif; ?>
		</div>

		<div class="col-md-offset-1 col-md-3 col-sm-12 sidebar">
			<?php get_sidebar(); ?>
		</div>
    </div>
</div>

<?php
// get_sidebar();
get_footer();
