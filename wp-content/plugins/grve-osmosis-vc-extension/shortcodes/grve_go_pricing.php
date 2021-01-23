<?php
/**
 * Go Pricing Shortcode
 */


/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_go_pricing_shortcode_params' ) ) {
	function grve_osmosis_vce_go_pricing_shortcode_params( $tag ) {
		return array(
			"name" => __( "Go Pricing", "grve-osmosis-vc-extension" ),
			"description" => __( "Go Pricing Table", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-go-pricing",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __( "Table ID", "grve-osmosis-vc-extension" ),
					"param_name" => "id",
					"admin_label" => true,
					"value" => grve_osmosis_vce_get_go_pricing_list(),
					"description" => __( "Select Pricing Table.", "grve-osmosis-vc-extension" ),
				),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'go_pricing', 'grve_osmosis_vce_go_pricing_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_go_pricing_shortcode_params( 'go_pricing' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
