<?php

if ( ! is_active_sidebar( 'main_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'main_sidebar' ); ?>
</aside>
