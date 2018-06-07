<div class="container speakers-container">
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!--
	    <header class="entry-header text-center">
	      <h4 class="entry-title"><?php the_title() ?></h4>
	    </header>
	    -->

		<div class="entry-content">

			<div class=" col-md-offset-2 col-md-8 speaker">
				<?php ventcamp_post_thumbnail($post->ID, 350, 350, true); ?>
				<h2><?php echo get_the_title(); ?></h2>	
				<p class="text-alt">
					<a target="_blank" href="<?php the_field('sponsor_website'); ?>"><?php the_field('sponsor_website'); ?></a>	
				</p>
				<?php ventcamp_speakers_links($post->ID); ?>	
				<?php the_field('sponsor_description'); ?>
			</div>

		</div>

	</article>
</div>