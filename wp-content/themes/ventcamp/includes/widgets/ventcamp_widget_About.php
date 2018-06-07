<?php

class ventcamp_Widget_About extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_about', 'description' =>  esc_html__( "About widget.", "ventcamp") );
		parent::__construct( 'about', _x( 'Ventcamp About', 'About widget', 'ventcamp' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$title_hl = empty($instance['title_hl'] ) ? '' : " <span class='highlight'>" . $instance['title_hl'] . "</span>";
		$text = empty($instance['text'] ) ? '' : $instance['text'];
		$image_uri = empty($instance['image_uri'] ) ? '' : $instance['image_uri'];

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $title_hl . $args['after_title'];
		}
		echo "<p class='text-alt'><small>{$text}</small></p>";
		echo "<img src='{$image_uri}' />";		

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Search widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'title_hl' => '', 'text' => '', 'image_uri' => '') );
		$title = $instance['title'];
		$title_hl = $instance['title_hl'];
		$text = $instance['text'];
		$image_uri = $instance['image_uri'];

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'ventcamp'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('title_hl'); ?>"><?php esc_html_e('Title Highlight:', 'ventcamp'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title_hl'); ?>" name="<?php echo $this->get_field_name('title_hl'); ?>" type="text" value="<?php echo esc_attr($title_hl); ?>" /></label></p>
		<p>
	      <label for="<?php echo $this->get_field_id('text'); ?>">Text</label><br />
	      <textarea name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" class="widefat"><?php echo $text; ?></textarea>
	    </p>
	    <p>
	      <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
	      <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>" />
	      <input type="button" class="select-img" value="Select Image" />
	    </p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '','text' => '', 'image_uri' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['title_hl'] = sanitize_text_field( $new_instance['title_hl'] );
		$instance['text'] = sanitize_text_field( $new_instance['text'] );
		$instance['image_uri'] = sanitize_text_field( $new_instance['image_uri'] );
		return $instance;
	}

}