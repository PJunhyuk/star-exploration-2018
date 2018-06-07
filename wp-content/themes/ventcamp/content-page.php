<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if ( ventcamp_is_tickera_page() ) : ?>
    <header class="entry-header">
      <h4 class="entry-title"><?php the_title() ?></h4>
    </header>
  <?php endif ?>

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div>

</article>
