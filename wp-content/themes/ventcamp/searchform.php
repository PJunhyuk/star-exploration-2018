<?php
/**
 *
 * Search form template
 *
 */
?>
<div class="search-form">
	<form class="search-form" method="get" action="<?php echo esc_url(home_url()); ?>/">
		<input type="text" placeholder="<?php echo  esc_html__("Search...", "ventcamp"); ?>" id="s" name="s" value="<?php esc_attr(get_search_query()); ?>" />
		<button type="submit"><span class='fa fa-search'></span></button>
	</form>
</div>