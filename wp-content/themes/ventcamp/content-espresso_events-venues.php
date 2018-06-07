<?php
if (
	( is_single() && espresso_display_venue_in_event_details() )
	|| ( is_archive() && espresso_display_venue_in_event_list() )
) :
	global $post;
	do_action( 'AHEE_event_details_before_venue_details', $post );
	$venue_name = espresso_venue_name( 0, 'details', FALSE );
	if ( empty( $venue_name ) && espresso_is_venue_private() ) {
		do_action( 'AHEE_event_details_after_venue_details', $post );
		return '';
	}
	?>

	<div class="espresso-venue-dv<?php echo espresso_is_venue_private() ? ' espresso-private-venue-dv' : ''; ?>">
		<h4><strong><?php _e( 'Venue:', 'event_espresso' ); ?> <?php echo $venue_name; ?></strong></h4>
		<p><span class="tags-links"><?php echo espresso_venue_categories(); ?></span></p>
		<?php  if ( $venue_phone = espresso_venue_phone( $post->ID, FALSE )) : ?>
			<div class="venue-phone">
				<strong><?php _e( 'Venue Phone:', 'event_espresso' ); ?></strong> <?php echo $venue_phone; ?>
			</div>
		<?php endif;  ?>
		<?php if ( $venue_website = espresso_venue_website( $post->ID, FALSE )) : ?>
			<div class="venue-website">
				<strong><?php _e( 'Venue Website:', 'event_espresso' ); ?></strong> <?php echo $venue_website; ?>
			</div>
		<?php endif; ?>

        <hr>

		<?php  if ( espresso_venue_has_address( $post->ID )) : ?>
			<strong><span class="dashicons dashicons-location-alt"></span><?php _e( 'Address:', 'event_espresso' ); ?></strong>
			<?php espresso_venue_address( 'inline' ); ?>
			<?php espresso_venue_gmap( $post->ID ); ?>
			<div class="clear"><br/></div>
		<?php endif;  ?>

		<?php $VNU_ID = espresso_venue_id( $post->ID ); ?>
		<?php if ( is_single() ) : ?>
			<?php $venue_description = espresso_venue_description( $VNU_ID, FALSE ); ?>
			<?php if ( $venue_description ) : ?>
				<div class="entry-content">
					<strong><?php _e( 'Description:', 'event_espresso' ); ?></strong><br/>
					<?php echo do_shortcode( $venue_description ); ?>
				</div>
			<?php endif;  ?>
		<?php else : ?>
			<?php $venue_excerpt = espresso_venue_excerpt( $VNU_ID, FALSE ); ?>
			<?php if ( $venue_excerpt ) : ?>
				<div class="entry-content">
					<strong><?php _e( 'Description:', 'event_espresso' ); ?></strong><br/>
					<?php echo $venue_excerpt; ?>
				</div>
			<?php endif;  ?>
		<?php endif;  ?>
	</div>
	<!-- .espresso-venue-dv -->
	<?php
	do_action( 'AHEE_event_details_after_venue_details', $post );
else :
	if ( espresso_venue_is_password_protected() ) :
		?>
		<div class="espresso-venue-dv  espresso-password-protected-venue-dv" >
			<h3 class="event-venues-h3 ee-event-h3">
				<?php _e( 'Location', 'event_espresso' );?>
			</h3>
			<?php echo espresso_password_protected_venue_form(); ?>
		</div>
		<?php
	endif;
endif;
?>