<?php
/**
 * Privacy Required Shortcode
 */

if( !function_exists( 'grve_vce_privacy_required_shortcode' ) ) {

	function grve_vce_privacy_required_shortcode( $atts, $content ) {

		$output = '';
		
		extract(
			shortcode_atts(
				array(
					'value' => 'required',
				),
				$atts
			)
		);		

		if( empty( $content ) ) {
			$content = "write your required title here";
		}

		if ( function_exists( 'grve_get_privacy_required' ) ) {
			$output .= grve_get_privacy_required ( $value , $content );
		}

		return $output;
	}
	add_shortcode( 'grve_privacy_required', 'grve_vce_privacy_required_shortcode' );

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
