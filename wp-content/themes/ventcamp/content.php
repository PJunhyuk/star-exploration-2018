<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			// Check if title is set
			if ( !$title_content = get_the_title() ) {
				// Title is not set, set title to (Untitled)
				$title_content = _x('(Untitled)', 'Default title for untitled posts', 'ventcamp');
			}

			if ( is_single() ) {
				// Output the title
				echo '<h4 class="entry-title">' . $title_content . '</h4>';
			} else {
				// Wrap title in link
				echo '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title_content . '</a></h4>';
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ventcamp_posted_on(); ?>
		</div>
		<?php
		endif; ?>
	</header>

	<?php ventcamp_post_thumbnail( $post->ID ); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<footer class="entry-footer">
		<?php //ventcamp_entry_footer(); ?>
	</footer>

</article>
