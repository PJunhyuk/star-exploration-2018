<?php
/*
Blog Category page template
*/

get_header();

?>

<div class="container">
    <div class="row">
		<div class="content col-md-8 col-sm-12" role="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="heading-alt page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header>

					<?php
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

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
