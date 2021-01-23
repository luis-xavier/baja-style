<?php
/**
 * Callout Shortcode
 */

if( !function_exists( 'grve_callout_shortcode' ) ) {

	function grve_callout_shortcode( $atts, $content ) {

		$output = $button = $data = $class_leader = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading' => 'h5',
					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'btn_position' => 'btn-right',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'leader_text' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		if ( !empty( $animation ) ) {
			$animation = 'grve-' .$animation;
		}

		if ( 'yes' == $leader_text ) {
			$class_leader = 'grve-leader-text';
		}

		//Button
		$button = grve_osmosis_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class );

		$callout_classes = array( 'grve-element', 'grve-callout' );

		if ( !empty( $animation ) ) {
			array_push( $callout_classes, 'grve-animated-item' );
			array_push( $callout_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $callout_classes, $el_class);
		}

		array_push( $callout_classes, 'grve-' . $btn_position );

		$callout_class_string = implode( ' ', $callout_classes );

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $callout_class_string ) . '" style="' . $style . '">';
		$output .= '  <div class="grve-callout-wrapper">';
		if ( !empty( $title ) ) {
		$output .= '<' . tag_escape( $heading ) . ' class="grve-callout-content"><span>' . $title . '</span></' . tag_escape( $heading ) . '>';
		}
		if ( !empty( $content ) ) {
		$output .= '    <p class="'. esc_attr( $class_leader ) . '">' . $content. '</p>';
		}
		$output .= '  </div>';
		$output .= '  <div class="grve-button-wrapper">';
		$output .= $button;
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_callout', 'grve_callout_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_callout_shortcode_params' ) ) {
	function grve_osmosis_vce_callout_shortcode_params( $tag ) {
		return array(
			"name" => __( "Callout", "grve-osmosis-vc-extension" ),
			"description" => __( "Two different styles for interesting callouts", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-callout",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Title", "grve-osmosis-vc-extension" ),
					"param_name" => "title",
					"value" => "",
					"description" => __( "Enter your title.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Heading", "grve-osmosis-vc-extension" ),
					"param_name" => "heading",
					"value" => array( 'h1', 'h2', 'h3', 'h4' , 'h5', 'h6' ),
					"description" => __( "Heading size of the title", "grve-osmosis-vc-extension" ),
					"std" => 'h5',
				),
				array(
					"type" => "textarea",
					"heading" => __( "Text", "grve-osmosis-vc-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => __( "Enter your text.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "callout_style", 'value' => array( '1' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => __( "Leader Text", "grve-osmosis-vc-extension" ),
					"param_name" => "leader_text",
					"description" => __( "If selected, text will be shown as leader", "grve-osmosis-vc-extension" ),
					"value" => Array( __( "Make text leader", "grve-osmosis-vc-extension" ) => 'yes' ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Button Position", "grve-osmosis-vc-extension" ),
					"param_name" => "btn_position",
					"value" => array(
						__( "Right", "grve-osmosis-vc-extension" ) => 'btn-right',
						__( "Bottom", "grve-osmosis-vc-extension" ) => 'btn-bottom',
					),
					"description" => __( "Select the position of the button.", "grve-osmosis-vc-extension" ),
					"group" => __( "Button", "grve-osmosis-vc-extension" ),
				),
				grve_osmosis_vce_add_button_type(),
				grve_osmosis_vce_add_button_color(),
				grve_osmosis_vce_add_button_text(),
				grve_osmosis_vce_add_button_size(),
				grve_osmosis_vce_add_button_shape(),
				grve_osmosis_vce_add_button_link(),
				grve_osmosis_vce_add_button_class(),
				grve_osmosis_vce_add_animation(),
				grve_osmosis_vce_add_animation_delay(),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_callout', 'grve_osmosis_vce_callout_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_callout_shortcode_params( 'grve_callout' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
