<?php
/**
 * Quote Shortcode
 */

if( !function_exists( 'grve_quote_shortcode' ) ) {

	function grve_quote_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
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

		$quote_classes = array( 'grve-element' );

		if ( !empty( $animation ) ) {
			array_push( $quote_classes, 'grve-animated-item' );
			array_push( $quote_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty( $el_class ) ) {
			array_push( $quote_classes, $el_class);
		}

		$quote_class_string = implode( ' ', $quote_classes );


		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<blockquote class="' . esc_attr( $quote_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '<p>' . $content . '</p>';
		$output .= '</blockquote>';


		return $output;
	}
	add_shortcode( 'grve_quote', 'grve_quote_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_quote_shortcode_params' ) ) {
	function grve_osmosis_vce_quote_shortcode_params( $tag ) {
		return array(
			"name" => __( "Quote", "grve-osmosis-vc-extension" ),
			"description" => __( "Easily create your Quote Text", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-quote",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textarea",
					"heading" => __( "Text", "grve-osmosis-vc-extension" ),
					"param_name" => "content",
					"value" => "Sample Quote",
					"description" => __( "Type your quote.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				grve_osmosis_vce_add_animation(),
				grve_osmosis_vce_add_animation_delay(),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_quote', 'grve_osmosis_vce_quote_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_quote_shortcode_params( 'grve_quote' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
