<?php
/**
 * Greatives Social Networking
 * A widget that displays social networking links.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

class Osmosis_Ext_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-social',
			'description' => esc_html__( 'A widget that displays social networking links', 'grve-osmosis-vc-extension' ),
		);
		$control_ops = array(
			'width' => 400,
			'height' => 600,
			'id_base' => 'grve-widget-social',
		);
		parent::__construct( 'grve-widget-social', '(Greatives) ' . esc_html__( 'Social Networking', 'grve-osmosis-vc-extension' ), $widget_ops, $control_ops );
	}

	function osmosis_ext_widget_social() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		global $grve_social_list_extended;
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );
		$target = grve_array_value( $instance, 'target', '_blank' );


		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
	?>

		<ul>
		<?php
		foreach ( $grve_social_list_extended as $social_item ) {

			$social_item_url = grve_array_value( $instance, $social_item['url'] );
			if ( ! empty( $social_item_url ) ) {

				if ( 'skype' == $social_item['class'] ) {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url, array( 'skype', 'http', 'https' ) ); ?>" class="<?php echo esc_attr( $social_item['class'] ); ?>"></a>
					</li>
		<?php
				} else {
		?>
					<li>
						<a href="<?php echo esc_url( $social_item_url ); ?>" class="<?php echo esc_attr( $social_item['class'] ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
					</li>
		<?php
				}
			}
		}
		?>
		</ul>


	<?php

		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {

		global $grve_social_list_extended;

		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['target'] = strip_tags( $new_instance['target'] );

		foreach ( $grve_social_list_extended as $social_item ) {
			$instance[ $social_item['url'] ] = strip_tags( $new_instance[ $social_item['url'] ] );
		}

		return $instance;
	}


	function form( $instance ) {
		global $grve_social_list_extended;

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'target' => '_blank',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		$target = esc_attr($instance['target']);

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
				<em><?php echo esc_html__( 'Note: Make sure you include the full URL (i.e. http://www.samplesite.com)', 'grve-osmosis-vc-extension' ); ?></em>
				<br>
				 <?php echo esc_html__( 'If you do not want a social to be visible, simply delete the supplied URL.', 'grve-osmosis-vc-extension' ); ?>
		</p>

		<?php
		foreach ( $grve_social_list_extended as $social_item ) {

			$social_item_url = grve_array_value( $instance, $social_item['url'] );
		?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>"><?php echo esc_html( $social_item['title'] ); ?>:</label>
					<input style="width: 100%;" id="<?php echo esc_attr( $this->get_field_id( $social_item['url'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $social_item['url'] ) ); ?>" value="<?php echo esc_attr( $social_item_url ); ?>" />
				</p>

		<?php
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Link Target:', 'grve-osmosis-vc-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('target') ); ?>" name="<?php echo esc_attr( $this->get_field_name('target') ); ?>" style="width:100%;">
				<option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e( 'New Page', 'grve-osmosis-vc-extension' ); ?></option>
				<option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e( 'Same Page', 'grve-osmosis-vc-extension' ); ?></option>
			</select>
		</p>
	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
