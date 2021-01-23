<?php
/**
 * Icon Shortcode
 */

if( !function_exists( 'grve_icon_shortcode' ) ) {

	function grve_icon_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'icon' => 'adjust',
					'icon_type' => 'icon',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-adjust',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'icon_size' => 'medium',
					'icon_shape' => 'no-shape',
					'shape_type' => 'simple',
					'icon_color' => 'primary-1',
					'align' => 'center',
					'link' => '',
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

		$icon_element_classes = array( 'grve-element' );

		array_push( $icon_element_classes, 'grve-box-icon' );
		array_push( $icon_element_classes, 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $icon_element_classes, 'grve-animated-item' );
			array_push( $icon_element_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $icon_element_classes, $el_class);
		}

		$icon_element_class_string = implode( ' ', $icon_element_classes );

		$icon_classes = array( 'grve-icon' );

		array_push( $icon_classes, 'grve-' . $icon_size );
		array_push( $icon_classes, 'grve-' . $shape_type );
		array_push( $icon_classes, 'grve-' . $icon_shape );

		if ( 'no-shape' != $icon_shape && 'outline' != $shape_type ) {
			array_push( $icon_classes, 'grve-bg-' . $icon_color );
		} else {
			array_push( $icon_classes, 'grve-color-' . $icon_color );
		}

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


		if ( !empty( $link ) ){
			$href = vc_build_link( $link );
			$url = $href['url'];
			if ( !empty( $href['target'] ) ){
				$target = $href['target'];
			} else {
				$target= "_self";
			}
		} else {
			$url = "#";
			$target= "_self";
		}
		$target = trim( $target );

		if ( !empty( $url ) && '#' != $url ) {
			$link_start = '<a href="' . esc_url( $url ) . '" target="' . $target . '">';
			$link_end = '</a>';
		}

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $icon_element_class_string ) . '" style="' . $style . '"' . $data . '>';

		$output .= $link_start;
		$output .= '  <div class="' . esc_attr( $icon_class_string ) . '"></div>';
		$output .= $link_end;

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_icon', 'grve_icon_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_icon_shortcode_params' ) ) {
	function grve_osmosis_vce_icon_shortcode_params( $tag ) {
		return array(
			"name" => __( "Icon", "grve-osmosis-vc-extension" ),
			"description" => __( "Add an icon", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-icon",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __( "Icon type", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_type",
					"value" => array(
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
					"heading" => __( "Icon size", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_size",
					"value" => array(
						__( "Large", "grve-osmosis-vc-extension" ) => 'large',
						__( "Medium", "grve-osmosis-vc-extension" ) => 'medium',
						__( "Small", "grve-osmosis-vc-extension" ) => 'small',
					),
					"std" => 'medium',
					"description" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Icon shape", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_shape",
					"value" => array(
						__( "None", "grve-osmosis-vc-extension" ) => 'no-shape',
						__( "Square", "grve-osmosis-vc-extension" ) => 'square',
						__( "Round", "grve-osmosis-vc-extension" ) => 'round',
						__( "Circle", "grve-osmosis-vc-extension" ) => 'circle',
					),
					"description" => '',
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Shape type", "grve-osmosis-vc-extension" ),
					"param_name" => "shape_type",
					"value" => array(
						__( "Simple", "grve-osmosis-vc-extension" ) => 'simple',
						__( "Outline", "grve-osmosis-vc-extension" ) => 'outline',
					),
					"description" => __( "Select shape type.", "grve-osmosis-vc-extension" ),
				),
				grve_osmosis_vce_add_align( 'center' ),
				array(
					"type" => "dropdown",
					"heading" => __( "Box Color", "grve-osmosis-vc-extension" ),
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
				),
				array(
					"type" => "vc_link",
					"heading" => __( "Link", "grve-osmosis-vc-extension" ),
					"param_name" => "link",
					"value" => "",
					"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
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
	vc_lean_map( 'grve_icon', 'grve_osmosis_vce_icon_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_icon_shortcode_params( 'grve_icon' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
