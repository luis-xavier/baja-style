<?php
/**
* Single Image Shortcode
*/

if( !function_exists( 'grve_single_image_shortcode' ) ) {

	function grve_single_image_shortcode( $attr, $content ) {

		$output = $data = $retina_data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'image_mode' => '',
					'image' => '',
					'retina_image' => '',
					'image_type' => 'image',
					'image_popup_title_caption' => 'none',
					'custom_title' => '',
					'custom_caption' => '',
					'zoom_effect' => 'in',
					'overlay_color' => 'dark',
					'overlay_opacity' => '80',
					'link' => '',
					'image_size' => 'no',
					'align' => 'center',
					'video_link' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '',
					'el_class' => '',
				),
				$attr
			)
		);

		if ( !empty( $animation ) ) {
			$animation = 'grve-' .$animation;
		}

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

		$single_image_classes = array( 'grve-element', 'grve-image' );

		if ( !empty( $animation ) ) {
			array_push( $single_image_classes, 'grve-animated-item' );
			array_push( $single_image_classes, $animation);
			$data = ' data-delay="' . esc_attr( $animation_delay ) . '"';
		}
		if ( !empty( $el_class ) ) {
			array_push( $single_image_classes, $el_class);
		}
		if ( 'yes' == $image_size ) {
			array_push( $single_image_classes, 'grve-full-image' );
		}
		array_push( $single_image_classes, 'grve-align-' . $align );
		$single_image_classe_string = implode( ' ', $single_image_classes );


		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$image_mode_size = grve_osmosis_vce_get_image_size( $image_mode );

		$output .= '<div class="' . esc_attr( $single_image_classe_string ) . '" style="' . $style . '"' . $data . '>';

		if ( !empty( $image ) ) {
			$id = preg_replace('/[^\d]/', '', $image);
			$image_link_href =  wp_get_attachment_url( $id );
			$img_src = wp_get_attachment_image_src( $id, $image_mode_size );
			$img_url = $img_src[0];
			$image_srcset = '';
			$full_src = wp_get_attachment_image_src( $id, 'grve-image-fullscreen' );
			$full_url = $full_src[0];
			if ( !empty( $retina_image ) && empty( $image_mode ) ) {
				$img_retina_id = preg_replace('/[^\d]/', '', $retina_image);
				$img_retina_src = wp_get_attachment_image_src( $img_retina_id, 'full' );
				$retina_url = $img_retina_src[0];
				$image_srcset = $img_url . ' 1x,' . $retina_url . ' 2x';
				$image_html = wp_get_attachment_image( $id, 'full' , "", array( 'srcset'=> $image_srcset ) );
			} else {
				$image_html = wp_get_attachment_image( $id, $image_mode_size );
			}

			if ( 'image-popup' == $image_type ) {
				
				$image_title = get_post_field( 'post_title', $id );
				$image_caption = get_post_field( 'post_excerpt', $id );
				$data_img = "";
				if ( !empty( $image_title ) && 'none' != $image_popup_title_caption && 'caption-only' != $image_popup_title_caption ) {
					$data_img .= ' data-title="' . esc_attr( $image_title ) . '"';
				}
				if ( !empty( $image_caption ) && 'none' != $image_popup_title_caption && 'title-only' != $image_popup_title_caption ) {
					$data_img .= ' data-desc="' . esc_attr( $image_caption ) . '"';
				}
				$output .= '<a class="grve-image-popup" href="' . esc_url( $full_url ) . '"' . $data_img . '>';
				$output .= $image_html;
				$output .= '</a>';
			} else if ( 'image-link' == $image_type ) {
				$output .= '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '">';
				$output .= $image_html;
				$output .= '</a>';
			} else if ( 'image-video-popup' == $image_type ) {
				if ( !empty( $video_link ) ) {
					$output .= '<div class="grve-media">';
					$output .= '	<a class="grve-vimeo-popup grve-icon-video" href="' . esc_url( $video_link ) . '">';
					$output .= $image_html;
					$output .= '	</a>';
					$output .= '</div>';
				} else {
					$output .= '<div class="grve-media">';
					$output .= $image_html;
					$output .= '</div>';
				}
			} else if ( 'image-caption' == $image_type ) {
				if ( !empty( $url ) && '#' != $url ) {
				$output .= '<a href="' . esc_url( $url ) . '" target="' . esc_attr( $target ) . '">';
				}
				$output .= '  <figure class="grve-image-hover grve-zoom-' . $zoom_effect . '">';
				$output .= '    <div class="grve-media grve-' . esc_attr( $overlay_color ) . '-overlay grve-opacity-' . esc_attr( $overlay_opacity ) . '">';
				$output .= $image_html;
				$output .= '    </div>';
				$output .= '      <figcaption>';
					if ( !empty( $custom_title ) ) {
						$output .= '<h6 class="grve-title grve-' . esc_attr( $overlay_color ) . '">' . $custom_title . '</h6>';
					}
					if ( !empty( $custom_caption ) ) {
						$output .= '<span class="grve-caption grve-' . esc_attr( $overlay_color ) . '">' . $custom_caption . '</span>';
					}

				$output .= '      </figcaption>';
				$output .= '  </figure>';
				if ( !empty( $url ) && '#' != $url ) {
				$output .= '</a>';
				}
			} else {
				$output .= $image_html;
			}
		}

		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'grve_single_image', 'grve_single_image_shortcode' );

}

/**
* Add shortcode to Page Builder
*/

if( !function_exists( 'grve_osmosis_vce_single_image_shortcode_params' ) ) {
	function grve_osmosis_vce_single_image_shortcode_params( $tag ) {
		return array(
			"name" => __( "Single Image", "grve-osmosis-vc-extension" ),
			"description" => __( "Image or Video popup in various uses", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-single-image",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __( "Type", "grve-osmosis-vc-extension" ),
					"param_name" => "image_type",
					"value" => array(
						__( "Image", "grve-osmosis-vc-extension" ) => 'image',
						__( "Image Link", "grve-osmosis-vc-extension" ) => 'image-link',
						__( "Image Popup", "grve-osmosis-vc-extension" ) => 'image-popup',
						__( "Image Video Popup", "grve-osmosis-vc-extension" ) => 'image-video-popup',
						__( "Image With Caption", "grve-osmosis-vc-extension" ) => 'image-caption',
					),
					"description" => __( "Select your image type.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Mode", "grve-osmosis-vc-extension" ),
					"param_name" => "image_mode",
					'value' => array(
						__( 'Full ( Custom )', 'grve-osmosis-vc-extension' ) => '',
						__( 'Thumbnail', 'grve-osmosis-vc-extension' ) => 'thumbnail',
						__( 'Medium ( Resize )', 'grve-osmosis-vc-extension' ) => 'medium',
						__( 'Large ( Resize )', 'grve-osmosis-vc-extension' ) => 'large',
						__( 'Square ( Crop )', 'grve-osmosis-vc-extension' ) => 'square',
						__( 'Landscape ( Crop )', 'grve-osmosis-vc-extension' ) => 'landscape',
					),
					'std' => '',
					"description" => __( "Select your Image Mode.", "grve-osmosis-vc-extension" ),
				),
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
					"dependency" => array( 'element' => "image_mode", 'value' => array( '' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => __( "Image Size", "grve-osmosis-vc-extension" ),
					"param_name" => "image_size",
					"value" => Array( __( "If selected, image will fill the column space", "grve-osmosis-vc-extension" ) => 'yes' ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image', 'image-link', 'image-popup', 'image-video-popup') ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Image Popup Title & Caption Visibility", "grve-osmosis-vc-extension" ),
					"param_name" => "image_popup_title_caption",
					'value' => array(
						esc_html__( 'None' , 'grve-osmosis-vc-extension' ) => 'none',
						esc_html__( 'Title and Caption' , 'grve-osmosis-vc-extension' ) => 'title-caption',
						esc_html__( 'Title Only' , 'grve-osmosis-vc-extension' ) => 'title-only',
						esc_html__( 'Caption Only' , 'grve-osmosis-vc-extension' ) => 'caption-only',
					),
					"dependency" => array( 'element' => "image_type", 'value' => array( 'image-popup' ) ),
					"description" => esc_html__( "Define the visibility for your popup image title - caption.", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Alignment", "grve-osmosis-vc-extension" ),
					"param_name" => "align",
					"value" => array(
						__( "Left", "grve-osmosis-vc-extension" ) => 'left',
						__( "Right", "grve-osmosis-vc-extension" ) => 'right',
						__( "Center", "grve-osmosis-vc-extension" ) => 'center',
					),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image', 'image-link', 'image-popup', 'image-video-popup') ),
					"std" => 'center',
				),
				array(
					"type" => "textfield",
					"heading" => __( "Title", "grve-osmosis-vc-extension" ),
					"param_name" => "custom_title",
					"value" => "",
					"description" => __( "Enter your title.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-caption' ) ),
				),
				array(
					"type" => "textarea",
					"heading" => __( "Caption", "grve-osmosis-vc-extension" ),
					"param_name" => "custom_caption",
					"value" => "",
					"description" => __( "Enter your caption.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-caption' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Image Zoom Effect", "grve-osmosis-vc-extension" ),
					"param_name" => "zoom_effect",
					"value" => array(
						__( "Zoom In", "grve-osmosis-vc-extension" ) => 'in',
						__( "Zoom Out", "grve-osmosis-vc-extension" ) => 'out',
						__( "None", "grve-osmosis-vc-extension" ) => 'none',
					),
					"description" => __( "Choose the image zoom effect.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-caption' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Overlay Color", "grve-osmosis-vc-extension" ),
					"param_name" => "overlay_color",
					"value" => array(
						__( "Dark", "grve-osmosis-vc-extension" ) => 'dark',
						__( "Light", "grve-osmosis-vc-extension" ) => 'light',
						__( "Primary 1", "grve-osmosis-vc-extension" ) => 'primary-1',
						__( "Primary 2", "grve-osmosis-vc-extension" ) => 'primary-2',
						__( "Primary 3", "grve-osmosis-vc-extension" ) => 'primary-3',
						__( "Primary 4", "grve-osmosis-vc-extension" ) => 'primary-4',
						__( "Primary 5", "grve-osmosis-vc-extension" ) => 'primary-5',
					),
					"description" => __( "Choose the image color overlay.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-caption' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Overlay Opacity", "grve-osmosis-vc-extension" ),
					"param_name" => "overlay_opacity",
					"value" => array( '0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100' ),
					"std" => '80',
					"description" => __( "Choose the opacity for the overlay.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-caption' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Video Link", "grve-osmosis-vc-extension" ),
					"param_name" => "video_link",
					"value" => "",
					"description" => __( "Type video URL e.g Vimeo/YouTube.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-video-popup') ),
				),
				array(
					"type" => "vc_link",
					"heading" => __( "Link", "grve-osmosis-vc-extension" ),
					"param_name" => "link",
					"value" => "",
					"description" => __( "Enter link.", "grve-osmosis-vc-extension" ),
					"dependency" => Array( 'element' => "image_type", 'value' => array( 'image-link', 'image-caption' ) ),
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
	vc_lean_map( 'grve_single_image', 'grve_osmosis_vce_single_image_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_single_image_shortcode_params( 'grve_single_image' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
