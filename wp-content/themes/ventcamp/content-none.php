<section class="no-results not-found">
	<header class="page-header">
		<h1 class="heading-alt page-title"><?php echo esc_html__( 'Nothing Found', 'ventcamp' ); ?></h1>
	</header>

	<div class="content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( esc_html( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ventcamp' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ventcamp' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ventcamp' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section>
