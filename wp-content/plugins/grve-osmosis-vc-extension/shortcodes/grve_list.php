<?php
/**
 * List Shortcode
 */

if( !function_exists( 'grve_list_shortcode' ) ) {

	function grve_list_shortcode( $atts, $content ) {

		$el_class = '';

		extract(
			shortcode_atts(
				array(
					'icon' => 'check',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );
		$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");
		return '<div class="grve-element grve-list grve-list-' . esc_attr( $icon ) . ' ' . esc_attr( $el_class ) . '" style="' . $style . '">' . $content . '</div>';
	}
	add_shortcode( 'grve_list', 'grve_list_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_list_shortcode_params' ) ) {
	function grve_osmosis_vce_list_shortcode_params( $tag ) {
		return array(
			"name" => __( "List", "grve-osmosis-vc-extension" ),
			"description" => __( "Select among several different styles", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-list",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "grve_icon",
					"heading" => __( "Icon", "grve-osmosis-vc-extension" ),
					"param_name" => "icon",
					"param_subset" => "list",
					"value" => 'check',
					"description" => __( "Select an icon.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type"			=> "textarea_html",
					"heading"		=> __( "List", "grve-osmosis-vc-extension" ),
					"param_name"	=> "content",
					"value"			=> "<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>",
					"description"	=> __( "Insert your unordered list here.", "grve-osmosis-vc-extension" ),
				),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_list', 'grve_osmosis_vce_list_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_list_shortcode_params( 'grve_list' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
