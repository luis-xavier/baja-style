<?php
/**
 * Button Shortcode
 */

if( !function_exists( 'grve_button_shortcode' ) ) {

	function grve_button_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'button_text' => 'Button',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'animation' => '',
					'animation_delay' => '200',
					'align' => 'left',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		if ( !empty( $animation ) ) {
			$animation = 'grve-' .$animation;
		}

		$button_classes = array( 'grve-element', 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $button_classes, 'grve-animated-item' );
			array_push( $button_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $button_classes, $el_class);
		}
		$button_class_string = implode( ' ', $button_classes );

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );
		$button = grve_osmosis_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class, $style );

		$output .= '<div class="' . $button_class_string . '"' . $data . '>';
		$output .= $button;
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_button', 'grve_button_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_button_shortcode_params' ) ) {
	function grve_osmosis_vce_button_shortcode_params( $tag ) {
		return array(
			"name" => __( "Button", "grve-osmosis-vc-extension" ),
			"description" => __( "Several styles, sizes and colors for your buttons", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-button",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				grve_osmosis_vce_add_button_type(),
				grve_osmosis_vce_add_button_color(),
				grve_osmosis_vce_add_button_text(),
				grve_osmosis_vce_add_button_size(),
				grve_osmosis_vce_add_button_shape(),
				grve_osmosis_vce_add_button_link(),
				grve_osmosis_vce_add_button_class(),
				grve_osmosis_vce_add_align(),
				grve_osmosis_vce_add_animation(),
				grve_osmosis_vce_add_animation_delay(),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_button', 'grve_osmosis_vce_button_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_button_shortcode_params( 'grve_button' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
