<?php
/**
 * Title Shortcode
 */

if( !function_exists( 'grve_title_shortcode' ) ) {

	function grve_title_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading' => 'h3',
					'heading_tag' => '',
					'line_type' => 'no-line',
					'align' => 'left',
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

		if ( empty( $heading_tag ) ) {
			$heading_tag = $heading;
		}

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$title_classes = array( 'grve-element' );

		array_push( $title_classes, 'grve-align-' . $align );
		array_push( $title_classes, 'grve-title-' . $line_type );
		array_push( $title_classes, 'grve-' . $heading );


		if ( !empty( $animation ) ) {
			array_push( $title_classes, 'grve-animated-item' );
			array_push( $title_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty( $el_class ) ) {
			array_push( $title_classes, $el_class );
		}

		$title_class_string = implode( ' ', $title_classes );

		$output .= '<' . tag_escape( $heading_tag ) . ' class="' . esc_attr( $title_class_string ) . '" style="' . $style . '"' . $data . '><span>' . $title . '</span></' . tag_escape( $heading_tag ) . '>';

		return $output;
	}
	add_shortcode( 'grve_title', 'grve_title_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_title_shortcode_params' ) ) {
	function grve_osmosis_vce_title_shortcode_params( $tag ) {
		return array(
			"name" => __( "Title", "grve-osmosis-vc-extension" ),
			"description" => __( "Add a title in many and diverse ways", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-title",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Title", "grve-osmosis-vc-extension" ),
					"param_name" => "title",
					"value" => "Sample Title",
					"description" => __( "Enter your title here.", "grve-osmosis-vc-extension" ),
					"save_always" => true,
					"admin_label" => true,
				),
				grve_osmosis_vce_get_heading('h3'),
				grve_osmosis_vce_get_heading_tag(),
				array(
					"type" => "dropdown",
					"heading" => __( "Line type", "grve-osmosis-vc-extension" ),
					"param_name" => "line_type",
					"value" => array(
						__( "None", "grve-osmosis-vc-extension" ) => 'no-line',
						__( "Simple", "grve-osmosis-vc-extension" ) => 'line',
						__( "Double", "grve-osmosis-vc-extension" ) => 'double-line',
						__( "Double Bottom", "grve-osmosis-vc-extension" ) => 'double-bottom-line',
					),
					"description" => '',
				),
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
	vc_lean_map( 'grve_title', 'grve_osmosis_vce_title_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_title_shortcode_params( 'grve_title' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.