<?php
/**
 * Counter Shortcode
 */

if( !function_exists( 'grve_counter_shortcode' ) ) {

	function grve_counter_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'counter_style' => 'style-1',
					'counter_start_val' => '0',
					'counter_end_val' => '100',
					'counter_prefix' => '',
					'counter_suffix' => '',
					'counter_decimal_points' => '0',
					'counter_decimal_separator' => '.',
					'counter_color' => 'primary-1',
					'counter_thousands_separator_vis' => '',
					'counter_thousands_separator' => ',',
					'title' => '',
					'heading' => 'h5',
					'icon' => 'adjust',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-adjust',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_type' => '',
					'icon_color' => 'primary-1',
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

		$counter_classes = array( 'grve-element' );

		array_push( $counter_classes, 'grve-counter' );
		array_push( $counter_classes, 'grve-align-center' );
		if ( 'style-2' == $counter_style ) {
			array_push( $counter_classes, 'grve-style-2' );
		}

		if ( !empty( $animation ) ) {
			array_push( $counter_classes, 'grve-animated-item' );
			array_push( $counter_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $counter_classes, $el_class);
		}

		$counter_class_string = implode( ' ', $counter_classes );


		$icon_classes = array( 'grve-icon' );

		if ( 'icon' == $icon_type ) {
			array_push( $icon_classes, 'fa fa-' . $icon );
		}

		if ( 'icon_all' == $icon_type ) {
			$icon_class = isset( ${"icon_" . $icon_library} ) ? esc_attr( ${"icon_" . $icon_library} ) : 'fa fa-adjust';
			if ( function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
				vc_icon_element_fonts_enqueue( $icon_library );
			}
			array_push( $icon_classes, $icon_class );
		}

		$icon_class_string = implode( ' ', $icon_classes );


		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );


		$output .= '<div class="' . esc_attr( $counter_class_string ) . '" style="' . $style . '"' . $data . '>';

		if ( 'icon' == $icon_type || 'icon_all' == $icon_type ) {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . ' grve-color-' . esc_attr( $icon_color ) . '"></div>';
		}

		$output .= '  <div class="grve-counter-content">';
		$output .= '    <div class="grve-counter-item grve-color-' . esc_attr( $counter_color ) . '">';
		$output .= '      <span data-thousands-separator-vis="' . esc_attr( $counter_thousands_separator_vis ) . '" data-thousands-separator="' . esc_attr( $counter_thousands_separator ) . '" data-prefix="' . esc_attr( $counter_prefix ) . '" data-suffix="' . esc_attr( $counter_suffix ) . '" data-start-val="' . esc_attr( $counter_start_val ) . '" data-end-val="' . esc_attr( $counter_end_val ) . '" data-decimal-points="' . esc_attr( $counter_decimal_points ) . '" data-decimal-separator="' . esc_attr( $counter_decimal_separator ) . '">' . $counter_start_val. '</span>';
		$output .= '    </div>';
		if ( !empty( $title ) ) {
			$output .= '<' . tag_escape( $heading ) . ' class="grve-counter-title"><span>' . $title . '</span></' . tag_escape( $heading ) . '>';
		}
		$output .= '  </div>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_counter', 'grve_counter_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_counter_shortcode_params' ) ) {
	function grve_osmosis_vce_counter_shortcode_params( $tag ) {
		return array(
			"name" => __( "Counter", "grve-osmosis-vc-extension" ),
			"description" => __( "Add a counter with icon and title", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-counter",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __( "Counter Style", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_style",
					"value" => array(
						__( "Style 1", "grve-osmosis-vc-extension" ) => 'style-1',
						__( "Style 2", "grve-osmosis-vc-extension" ) => 'style-2',
					),
					"description" => __( "Style of the counter.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Start Number", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_start_val",
					"value" => "0",
					"description" => __( "Enter counter start number.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter End Number", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_end_val",
					"value" => "100",
					"description" => __( "Enter counter end number.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => 'checkbox',
					"heading" => __( "Counter Thousands Separator Visiblility", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_thousands_separator_vis",
					"description" => __( "If selected, thousands separator will not be shown.", "grve-osmosis-vc-extension" ),
					"value" => Array( __( "Disable Thousands Separator.", "grve-osmosis-vc-extension" ) => 'yes' ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Thousands Separator", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_thousands_separator",
					"value" => ",",
					"description" => __( "Enter thousands separator.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Decimal Points", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_decimal_points",
					"value" => "0",
					"description" => __( "Number of decimal points.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Decimal Separator", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_decimal_separator",
					"value" => ".",
					"description" => __( "Enter decimal separator.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Prefix", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_prefix",
					"value" => "",
					"description" => __( "Enter counter prefix.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Counter Suffix", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_suffix",
					"value" => "",
					"description" => __( "Enter counter suffix.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Counter Color", "grve-osmosis-vc-extension" ),
					"param_name" => "counter_color",
					"value" => array(
						__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
						__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
						__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
						__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
						__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
						__( "Green", "grve-osmosis-vc-extension" ) => 'green',
						__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
						__( "Red", "grve-osmosis-vc-extension" ) => 'red',
						__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
						__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
						__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
						__( "Black", "grve-osmosis-vc-extension" ) => 'black',
						__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
						__( "White", "grve-osmosis-vc-extension" ) => 'white',
					),
					"description" => __( "Color of the counter.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Icon type", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_type",
					"value" => array(
						__( "No Icon", "grve-osmosis-vc-extension" ) => '',
						__( "Icon", "grve-osmosis-vc-extension" ) => 'icon',
						__( "Icon ( All Libraries )", "grve-osmosis-vc-extension" ) => 'icon_all',
					),
					"description" => '',
					"admin_label" => true,
				),
				array(
					"type" => "grve_icon",
					"heading" => __( 'Icon', "grve-osmosis-vc-extension" ),
					"param_name" => "icon",
					"value" => 'adjust',
					"description" => __( "Select an icon.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'grve-osmosis-vc-extension' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'grve-osmosis-vc-extension' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'grve-osmosis-vc-extension' ) => 'openiconic',
						esc_html__( 'Typicons', 'grve-osmosis-vc-extension' ) => 'typicons',
						esc_html__( 'Entypo', 'grve-osmosis-vc-extension' ) => 'entypo',
						esc_html__( 'Linecons', 'grve-osmosis-vc-extension' ) => 'linecons',
						esc_html__( 'Simple Line Icons', 'grve-osmosis-vc-extension' ) => 'simplelineicons',
					),
					'param_name' => 'icon_library',
					'description' => esc_html__( 'Select icon library.', 'grve-osmosis-vc-extension' ),
					"dependency" => array( 'element' => "icon_type", 'value' => array( 'icon_all' ) ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust',
					'settings' => array(
						'emptyIcon' => false,
						'iconsPerPage' => 200,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'grve-osmosis-vc-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'openiconic',
						'iconsPerPage' => 200,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'grve-osmosis-vc-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'typicons',
						'iconsPerPage' => 200,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'grve-osmosis-vc-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'entypo',
						'iconsPerPage' => 300,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'linecons',
						'iconsPerPage' => 200,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'grve-osmosis-vc-extension' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'grve-osmosis-vc-extension' ),
					'param_name' => 'icon_simplelineicons',
					'value' => 'smp-icon-user',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'simplelineicons',
						'iconsPerPage' => 200,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value' => 'simplelineicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'grve-osmosis-vc-extension' ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Icon Color", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_color",
					"value" => array(
						__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
						__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
						__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
						__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
						__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
						__( "Green", "grve-osmosis-vc-extension" ) => 'green',
						__( "Orange", "grve-osmosis-vc-extension" ) => 'orange',
						__( "Red", "grve-osmosis-vc-extension" ) => 'red',
						__( "Blue", "grve-osmosis-vc-extension" ) => 'blue',
						__( "Aqua", "grve-osmosis-vc-extension" ) => 'aqua',
						__( "Purple", "grve-osmosis-vc-extension" ) => 'purple',
						__( "Black", "grve-osmosis-vc-extension" ) => 'black',
						__( "Grey", "grve-osmosis-vc-extension" ) => 'grey',
						__( "White", "grve-osmosis-vc-extension" ) => 'white',
					),
					"description" => __( "Color of the icon.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "icon_type", 'value' => array( 'icon' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Title", "grve-osmosis-vc-extension" ),
					"param_name" => "title",
					"value" => "",
					"description" => __( "Enter counter title.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Heading", "grve-osmosis-vc-extension" ),
					"param_name" => "heading",
					"value" => array( 'h1', 'h2', 'h3', 'h4' , 'h5', 'h6' ),
					"description" => __( "Heading size of the title", "grve-osmosis-vc-extension" ),
					"std" => 'h5',
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
	vc_lean_map( 'grve_counter', 'grve_osmosis_vce_counter_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_counter_shortcode_params( 'grve_counter' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
