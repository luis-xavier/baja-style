<?php
/**
 * Icon Box Shortcode
 */

if( !function_exists( 'grve_icon_box_shortcode' ) ) {

	function grve_icon_box_shortcode( $atts, $content ) {

		$output = $link_start = $link_end = $retina_data = $text_style_class = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'title' => '',
					'heading' => 'h5',
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
					'icon_animation' => 'no',
					'icon_char' => 'A',
					'icon_image' => '',
					'retina_icon_image' => '',
					'align' => 'left',
					'text_style' => 'none',
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

		$icon_box_classes = array( 'grve-element' );

		array_push( $icon_box_classes, 'grve-box-icon' );
		array_push( $icon_box_classes, 'grve-align-' . $align );

		if ( !empty( $animation ) ) {
			array_push( $icon_box_classes, 'grve-animated-item' );
			array_push( $icon_box_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}

		if ( 'yes' == $icon_animation ) {
			array_push( $icon_box_classes, 'grve-advanced-hover' );
		}
		if ( !empty ( $el_class ) ) {
			array_push( $icon_box_classes, $el_class);
		}

		$icon_box_class_string = implode( ' ', $icon_box_classes );


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

		if ( 'image' == $icon_type ) {
			array_push( $icon_classes, 'grve-image-icon' );
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

		// Paragraph
		if ( 'none' != $text_style ) {
			$text_style_class = 'grve-' .$text_style;
		}

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$output .= '<div class="' . esc_attr( $icon_box_class_string ) . '" style="' . $style . '"' . $data . '>';

		$output .= $link_start;

		if ( 'image' == $icon_type ) {
			if ( !empty( $icon_image ) ) {
				$img_id = preg_replace('/[^\d]/', '', $icon_image);
				$img_src = wp_get_attachment_image_src( $img_id, 'full' );
				$img_url = $img_src[0];
				$image_srcset = '';
				if ( !empty( $retina_icon_image ) ) {
					$img_retina_id = preg_replace('/[^\d]/', '', $retina_icon_image);
					$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
					$retina_url = $img_retina_src[0];
					$image_srcset = $img_url . ' 1x,' . $retina_url . ' 2x';
				}
				$output .= '<div class="' . esc_attr( $icon_class_string ) . '">';
				$output .= wp_get_attachment_image( $img_id, 'full' , "", array( 'srcset'=> $image_srcset ) );
				$output .= '</div>';
			}
		} else if( 'char' == $icon_type ) {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . '">'. $icon_char. '</div>';
		} else {
			$output .= '  <div class="' . esc_attr( $icon_class_string ) . '"></div>';
		}

		$output .= $link_end;

		$output .= '  <div class="grve-box-content">';
		if ( !empty( $title ) ) {
		$output .= $link_start;
		$output .= '<' . tag_escape( $heading ) . ' class="grve-box-title"><span>' . $title . '</span></' . tag_escape( $heading ) . '>';
		$output .= $link_end;
		}
		if ( !empty( $content ) ) {
		$output .= '    <p class="' . esc_attr( $text_style_class ) . '">' . $content . '</p>';
		}
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_icon_box', 'grve_icon_box_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_icon_box_shortcode_params' ) ) {
	function grve_osmosis_vce_icon_box_shortcode_params( $tag ) {
		return array(
			"name" => __( "Icon Box", "grve-osmosis-vc-extension" ),
			"description" => __( "Add an icon, character or image with title and text", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-icon-box",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __( "Icon type", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_type",
					"value" => array(
						__( "Icon", "grve-osmosis-vc-extension" ) => 'icon',
						__( "Icon ( All Libraries )", "grve-osmosis-vc-extension" ) => 'icon_all',
						__( "Image", "grve-osmosis-vc-extension" ) => 'image',
						__( "Character", "grve-osmosis-vc-extension" ) => 'char',
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
					"type" => "attach_image",
					"heading" => __( "Icon Image", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_image",
					"value" => '',
					"description" => __( "Select an icon image.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "icon_type", 'value' => array( 'image' ) ),
				),
				array(
					"type" => "attach_image",
					"heading" => __( "Retina Icon Image", "grve-osmosis-vc-extension" ),
					"param_name" => "retina_icon_image",
					"value" => '',
					"description" => __( "Select a 2x icon.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "icon_type", 'value' => array( 'image' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Character", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_char",
					"value" => "A",
					"description" => __( "Type a single character.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "icon_type", 'value' => array( 'char' ) ),
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
				grve_osmosis_vce_add_align(),
				array(
					"type" => 'checkbox',
					"heading" => __( "Enable Advanced Hover", "grve-osmosis-vc-extension" ),
					"param_name" => "icon_animation",
					"value" => Array( __( "If selected, you will have advanced hover.", "grve-osmosis-vc-extension" ) => 'yes' ),
					"dependency" => Array( 'element' => "align", 'value' => array( 'center' ) ),
				),
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
					"description" => __( "Color of the icon box.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Title", "grve-osmosis-vc-extension" ),
					"param_name" => "title",
					"value" => "",
					"description" => __( "Enter icon box title.", "grve-osmosis-vc-extension" ),
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
				array(
					"type" => "textarea",
					"heading" => __( "Text", "grve-osmosis-vc-extension" ),
					"param_name" => "content",
					"value" => "",
					"description" => __( "Enter your content.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Text Style", "grve-osmosis-vc-extension" ),
					"param_name" => "text_style",
					"value" => array(
						__( "None", "grve-osmosis-vc-extension" ) => '',
						__( "Leader", "grve-osmosis-vc-extension" ) => 'leader-text',
						__( "Subtitle", "grve-osmosis-vc-extension" ) => 'subtitle',
					),
					"description" => 'Select your text style',
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
	vc_lean_map( 'grve_icon_box', 'grve_osmosis_vce_icon_box_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_icon_box_shortcode_params( 'grve_icon_box' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
