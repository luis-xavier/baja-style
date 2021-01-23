<?php
/**
 * Single Promo Shortcode
 */

if( !function_exists( 'grve_promo_shortcode' ) ) {

	function grve_promo_shortcode( $atts, $content ) {

		$output = $button = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image' => '',
					'retina_image' => '',
					'align' => 'left',
					'button_text' => '',
					'button_link' => '',
					'button_type' => 'simple',
					'button_size' => 'medium',
					'button_color' => 'primary-1',
					'button_shape' => 'square',
					'button_class' => '',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		//Button
		$button = grve_osmosis_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_class );
		$image_string = '';

		if ( !empty( $image ) ) {
		
			$image_classes = array();
			$image_classes[] = 'attachment-full';
			$image_classes[] = 'size-full';
			$image_classes[] = 'grve-partner-logo';
			$image_class_string = implode( ' ', $image_classes );

			$id = preg_replace('/[^\d]/', '', $image);
			$img_src = wp_get_attachment_image_src( $id, 'full' );
			$img_url = $img_src[0];
			$image_srcset = '';
			if ( !empty( $retina_image ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = esc_attr( $img_url ) . ' 1x,' . esc_attr( $retina_url ) . ' 2x';
			}

			$image_string = wp_get_attachment_image( $id, 'full' , "", array( 'class' => $image_class_string, 'srcset'=> $image_srcset ) );
		}

		$output .= '<div class="grve-element grve-partner-advanced grve-align-' . esc_attr( $align ) . ' ' . esc_attr( $el_class ) . '">';
		$output .= $image_string;
		$output .= '  <div class="grve-partner-content">';
		$output .= '    <p class="grve-leader-text">' . $content. '</p>';
		$output .= $button;
		$output .= '  </div>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'grve_promo', 'grve_promo_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_promo_shortcode_params' ) ) {
	function grve_osmosis_vce_promo_shortcode_params( $tag ) {
		return array(
			"name" => __( "Advanced Promo", "grve-osmosis-vc-extension" ),
			"description" => __( "Advanced, impressive promotion for whatever you like", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-promo",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __( "Image", "grve-osmosis-vc-extension" ),
					"param_name" => "image",
					"value" => '',
					"description" => __( "Select an image.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "attach_image",
					"heading" => __( "Retina Image", "grve-osmosis-vc-extension" ),
					"param_name" => "retina_image",
					"value" => '',
					"description" => __( "Select a 2x image.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "textarea",
					"heading" => __( "Text", "grve-osmosis-vc-extension" ),
					"param_name" => "content",
					"value" => "Sample Text",
					"description" => __( "Enter your text.", "grve-osmosis-vc-extension" ),
				),
				grve_osmosis_vce_add_align(),
				grve_osmosis_vce_add_button_type(),
				grve_osmosis_vce_add_button_color(),
				grve_osmosis_vce_add_button_text(),
				grve_osmosis_vce_add_button_size(),
				grve_osmosis_vce_add_button_shape(),
				grve_osmosis_vce_add_button_link(),
				grve_osmosis_vce_add_button_class(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_promo', 'grve_osmosis_vce_promo_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_promo_shortcode_params( 'grve_promo' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
