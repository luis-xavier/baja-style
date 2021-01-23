<?php
/**
 * Privacy Link
 */

if( !function_exists( 'grve_vce_privacy_preferences_link_shortcode' ) ) {

	function grve_vce_privacy_preferences_link_shortcode( $atts, $content ) {

		$output = '';

		if ( function_exists( 'grve_get_privacy_preferences_link' ) ) {
			$output .= grve_get_privacy_preferences_link ( $content );
		}
		return $output;
	}
	add_shortcode( 'grve_privacy_preferences_link', 'grve_vce_privacy_preferences_link_shortcode' );

}


//Omit closing PHP tag to avoid accidental whitespace output errors.
