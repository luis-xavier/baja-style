<?php
/**
 * Video Shortcode
 */

if( !function_exists( 'grve_video_shortcode' ) ) {

	function grve_video_shortcode( $atts, $content ) {
		global $wp_embed;
		$output = $class_fullwidth = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'video_link' => '',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$video_classes = array( 'grve-element', 'grve-video' );

		if ( !empty( $el_class ) ) {
			array_push( $video_classes, $el_class);
		}
		$video_class_string = implode( ' ', $video_classes );


		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		if ( !empty( $video_link ) ) {
			$output .= '<div class="' . esc_attr( $video_class_string ) . '" style="' . $style . '">';
			$output .= $wp_embed->run_shortcode( '[embed]' . $video_link . '[/embed]' );
			$output .= '</div>';
		}

		return $output;
	}
	add_shortcode( 'grve_video', 'grve_video_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_video_shortcode_params' ) ) {
	function grve_osmosis_vce_video_shortcode_params( $tag ) {
		return array(
			"name" => __( "Video", "grve-osmosis-vc-extension" ),
			"description" => __( "Embed YouTube/Vimeo player", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-video",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Video Link", "grve-osmosis-vc-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => __( "Type Vimeo/YouTube URL.", "grve-osmosis-vc-extension" ),
				),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_video', 'grve_osmosis_vce_video_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_video_shortcode_params( 'grve_video' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.