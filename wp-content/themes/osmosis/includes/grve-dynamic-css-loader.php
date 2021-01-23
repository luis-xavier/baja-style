<?php
/**
 *  Add Dynamic css to header
 *  @version	1.0
 *  @author		Greatives Team
 *  @URI		http://greatives.eu
 */


add_action('wp_head', 'grve_load_dynamic_css');

if ( !function_exists( 'grve_load_dynamic_css' ) ) {

	function grve_load_dynamic_css() {
		include_once get_template_directory() . '/includes/grve-dynamic-typography-css.php';
		include_once get_template_directory() . '/includes/grve-dynamic-css.php';
		if ( grve_events_calendar_enabled() ) {
			include_once get_template_directory() . '/includes/grve-dynamic-event-css.php';
		}
		if ( grve_bbpress_enabled() ) {
			include_once get_template_directory() . '/includes/grve-dynamic-bbpress-css.php';
		}
		$custom_css_code = grve_option( 'css_code' );
		if ( !empty( $custom_css_code ) ) {
			echo grve_get_css_output( $custom_css_code );
		}
	}
}

 /**
 * Get color array used in theme from theme options and predefined colors
 */
 
if ( !function_exists( 'osmosis_grve_get_color_array' ) ) { 
	function osmosis_grve_get_color_array() {
		return array(
			'primary-1' => grve_option( 'body_primary_1_color' ),
			'primary-2' => grve_option( 'body_primary_2_color' ),
			'primary-3' => grve_option( 'body_primary_3_color' ),
			'primary-4' => grve_option( 'body_primary_4_color' ),
			'primary-5' => grve_option( 'body_primary_5_color' ),
			'dark' => '#000000',
			'light' => '#ffffff',
		);
	}
}

?>
