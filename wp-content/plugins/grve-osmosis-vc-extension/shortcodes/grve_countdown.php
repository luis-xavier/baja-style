<?php
/**
 * CountDown Shortcode
 */

if( !function_exists( 'grve_countdown_shortcode' ) ) {

	function grve_countdown_shortcode( $atts, $content ) {

		$output = $el_class = $data = '';

		extract(
			shortcode_atts(
				array(
					'final_date' => '',
					'countdown_format' => 'D|H|M|S',
					'countdown_style' => '1',
					'numbers_size' => 'h3',
					'text_size' => 'small-text',
					'numbers_color' => 'black',
					'text_color' => 'black',
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

		$countdown_classes = array( 'grve-element' , 'grve-countdown' );

		array_push( $countdown_classes, 'grve-style-' . $countdown_style );

		if ( !empty( $animation ) ) {
			array_push( $countdown_classes, 'grve-animated-item' );
			array_push( $countdown_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $countdown_classes, $el_class);
		}

		$countdown_class_string = implode( ' ', $countdown_classes );


		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<div class="' . esc_attr( $countdown_class_string ) . '" style="' . $style . '" data-countdown="' . esc_attr( $final_date ) . '" data-countdown-format="' . esc_attr( $countdown_format ) . '" data-numbers-size="' . esc_attr( $numbers_size ) . '" data-text-size="' . esc_attr( $text_size ) . '" data-numbers-color="' . esc_attr( $numbers_color ) . '" data-text-color="' . esc_attr( $text_color ) . '"' . $data . '></div>';


		return $output;
	}
	add_shortcode( 'grve_countdown', 'grve_countdown_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_countdown_shortcode_params' ) ) {
	function grve_osmosis_vce_countdown_shortcode_params( $tag ) {
		return array(
			"name" => esc_html__( "Countdown", "grve-osmosis-vc-extension" ),
			"description" => esc_html__( "Add a countdown element", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-countdown",
			"category" => esc_html__( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Final Date", "grve-osmosis-vc-extension" ),
					"param_name" => "final_date",
					"value" => "",
					"description" => esc_html__( "Accepted formats: YYYY/MM/DD , MM/DD/YYYY , YYYY/MM/DD hh:mm:ss , MM/DD/YYYY hh:mm:ss ( e.g: 2018/12/30 )", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Countdown Display", "grve-osmosis-vc-extension" ),
					"param_name" => "countdown_format",
					"value" => array(
						esc_html__( "Days Hours Minutes Seconds", "grve-osmosis-vc-extension" ) => 'D|H|M|S',
						esc_html__( "Weeks Days Hours Minutes Seconds", "grve-osmosis-vc-extension" ) => 'w|d|H|M|S',
					),
					'std' => 'D|H|M|S',
					"description" => esc_html__( "Select the countdown display.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Countdown Style", "grve-osmosis-vc-extension" ),
					"param_name" => "countdown_style",
					"value" => array(
						esc_html__( "Style 1", "grve-osmosis-vc-extension" ) => '1',
						esc_html__( "Style 2", "grve-osmosis-vc-extension" ) => '2',
						esc_html__( "Style 3", "grve-osmosis-vc-extension" ) => '3',
					),
					'std' => '1',
					"description" => esc_html__( "Select the countdown style.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Numbers size", "grve-osmosis-vc-extension" ),
					"param_name" => "numbers_size",
					"value" => array(
						esc_html__( "h1", "grve-osmosis-vc-extension" ) => 'h1',
						esc_html__( "h2", "grve-osmosis-vc-extension" ) => 'h2',
						esc_html__( "h3", "grve-osmosis-vc-extension" ) => 'h3',
						esc_html__( "h4", "grve-osmosis-vc-extension" ) => 'h4',
						esc_html__( "h5", "grve-osmosis-vc-extension" ) => 'h5',
						esc_html__( "h6", "grve-osmosis-vc-extension" ) => 'h6',
						esc_html__( "Subtitle Text", "grve-osmosis-vc-extension" ) => 'subtitle-text',
						esc_html__( "Small Text", "grve-osmosis-vc-extension" ) => 'small-text',
					),
					"description" => esc_html__( "Numbers size and typography", "grve-osmosis-vc-extension" ),
					"std" => 'h3',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text size", "grve-osmosis-vc-extension" ),
					"param_name" => "text_size",
					"value" => array(
						esc_html__( "h1", "grve-osmosis-vc-extension" ) => 'h1',
						esc_html__( "h2", "grve-osmosis-vc-extension" ) => 'h2',
						esc_html__( "h3", "grve-osmosis-vc-extension" ) => 'h3',
						esc_html__( "h4", "grve-osmosis-vc-extension" ) => 'h4',
						esc_html__( "h5", "grve-osmosis-vc-extension" ) => 'h5',
						esc_html__( "h6", "grve-osmosis-vc-extension" ) => 'h6',
						esc_html__( "Subtitle Text", "grve-osmosis-vc-extension" ) => 'subtitle-text',
						esc_html__( "Small Text", "grve-osmosis-vc-extension" ) => 'small-text',
					),
					"description" => esc_html__( "Text size and typography", "grve-osmosis-vc-extension" ),
					"std" => 'small-text',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Numbers Color", "grve-osmosis-vc-extension" ),
					"param_name" => "numbers_color",
					"value" => array(
						esc_html__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
						esc_html__( "Green", "grve-osmosis-vc-extension" ) => 'green',
						esc_html__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
						esc_html__( "Red", "grve-osmosis-vc-extension" ) => 'red',
						esc_html__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
						esc_html__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
						esc_html__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
						esc_html__( "Black", "grve-osmosis-vc-extension" ) => 'black',
						esc_html__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
						esc_html__( "White", "grve-osmosis-vc-extension" ) => 'white',
					),
					'std' => 'black',
					"description" => esc_html__( "Color of the numbers.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Text Color", "grve-osmosis-vc-extension" ),
					"param_name" => "text_color",
					"value" => array(
						esc_html__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
						esc_html__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
						esc_html__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
						esc_html__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
						esc_html__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
						esc_html__( "Green", "grve-osmosis-vc-extension" ) => 'green',
						esc_html__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
						esc_html__( "Red", "grve-osmosis-vc-extension" ) => 'red',
						esc_html__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
						esc_html__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
						esc_html__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
						esc_html__( "Black", "grve-osmosis-vc-extension" ) => 'black',
						esc_html__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
						esc_html__( "White", "grve-osmosis-vc-extension" ) => 'white',
					),
					'std' => 'black',
					"description" => esc_html__( "Color of the text.", "grve-osmosis-vc-extension" ),
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
	vc_lean_map( 'grve_countdown', 'grve_osmosis_vce_countdown_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_countdown_shortcode_params( 'grve_countdown' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
