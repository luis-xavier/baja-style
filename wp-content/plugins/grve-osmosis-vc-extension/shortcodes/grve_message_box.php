<?php
/**
 * Message Box Shortcode
 */

if( !function_exists( 'grve_message_box_shortcode' ) ) {

	function grve_message_box_shortcode( $atts, $content ) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'icon_type' => 'icon',
					'icon' => 'exclamation-circle',
					'icon_library' => 'fontawesome',
					'icon_fontawesome' => 'fa fa-exclamation-circle',
					'icon_openiconic' => 'vc-oi vc-oi-dial',
					'icon_typicons' => 'typcn typcn-adjust-brightness',
					'icon_entypo' => 'entypo-icon entypo-icon-note',
					'icon_linecons' => 'vc_li vc_li-heart',
					'icon_simplelineicons' => 'smp-icon-user',
					'bg_color' => 'green',
					'remove_close' => '',
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

		$message_box_classes = array( 'grve-element', 'grve-message' );

		array_push( $message_box_classes, 'grve-bg-' . $bg_color );

		if ( !empty( $animation ) ) {
			array_push( $message_box_classes, 'grve-animated-item' );
			array_push( $message_box_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( !empty ( $el_class ) ) {
			array_push( $message_box_classes, $el_class);
		}

		$message_box_class_string = implode( ' ', $message_box_classes );

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

		$output .= '<div class="' . esc_attr( $message_box_class_string ) . '" style="' . $style . '"' . $data . '>';
		$output .= '  <i class="' . esc_attr( $icon_class_string ) . '"></i>';
		$output .= '  <p>' . do_shortcode( $content ) . '</p>';
		if ( 'yes' != $remove_close ) {
			$output .= '  <i class="grve-close grve-icon-close"></i>';
		}
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_message_box', 'grve_message_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_message_box_shortcode_params' ) ) {
	function grve_osmosis_vce_message_box_shortcode_params( $tag ) {
		return array(
			"name" => __( "Message Box", "grve-osmosis-vc-extension" ),
			"description" => __( "Info text with icons", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-message-box",
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
				),
				array(
					"type" => "grve_icon",
					"heading" => __( 'Icon', "grve-osmosis-vc-extension" ),
					"param_name" => "icon",
					"value" => 'exclamation-circle',
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
					'value' => 'fa fa-exclamation-circle',
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
					"type" => "textarea",
					"heading" => __( "Text", "grve-osmosis-vc-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => __( "Enter your content.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Background Color", "grve-osmosis-vc-extension" ),
					"param_name" => "bg_color",
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
					"description" => __( "Background color of the box.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => 'checkbox',
					"heading" => __( "Remove Close Button", "grve-osmosis-vc-extension" ),
					"param_name" => "remove_close",
					"value" => Array( __( "If selected, close button will be removed ", "grve-osmosis-vc-extension" ) => 'yes' ),
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
	vc_lean_map( 'grve_message_box', 'grve_osmosis_vce_message_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_message_box_shortcode_params( 'grve_message_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
