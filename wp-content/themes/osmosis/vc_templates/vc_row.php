<?php

	$output = $img_class = $el_class = $section_id_string = $out_overlay = $out_image_bg = $out_video_bg = '';

	extract(
		shortcode_atts(
			array(
				'section_id'      => '',
				'font_color'      => '',
				'heading_color' => '',
				'section_title' => '',
				'section_type'      => 'fullwidth-background',
				'section_full_height' => 'no',
				'flex_height' => '',
				'middle_content' => '',
				'desktop_visibility' => '',
				'tablet_visibility' => '',
				'tablet_sm_visibility' => '',
				'mobile_visibility' => '',
				'bg_color'        => '',
				'bg_type'        => '',
				'bg_image'        => '',
				'bg_image_type' => 'none',
				'pattern_overlay' => '',
				'color_overlay' => '',
				'opacity_overlay' => '',
				'bg_video_type' => 'parallax',
				'bg_video_webm' => '',
				'bg_video_mp4' => '',
				'bg_video_ogv' => '',
				'bg_video_loop' => 'yes',
				'bg_video_device' => 'no',
				'bg_video_url' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
				'padding_top' => '',
				'padding_bottom' => '',
				'margin_bottom' => '',
				'header_feature' => '',
				'footer_feature' => '',
				'el_class'        => '',
				'el_id'        => '',
				'css' => '',
			),
			$atts
		)
	);

	//Section Style
	$style = grve_build_shortcode_style( $bg_color, $font_color, $padding_top, $padding_bottom, $margin_bottom );

	//Section Classses
	$section_classes = array( 'grve-section' );

	if ( !empty ( $heading_color ) ) {
		array_push( $section_classes, 'grve-' . $heading_color );
	}
	if ( !empty ( $header_feature ) ) {
		array_push( $section_classes, 'grve-feature-header');
	}
	if ( !empty ( $footer_feature ) ) {
		array_push( $section_classes, 'grve-feature-footer');
	}
	if ( !empty ( $flex_height ) ) {
		array_push( $section_classes, 'grve-flex-row');
	}

	if ( !empty ( $middle_content ) ) {
		array_push( $section_classes, 'grve-middle-content');
	}

	if ( !empty ( $el_class ) ) {
		array_push( $section_classes, $el_class);
	}

	if( vc_settings()->get( 'not_responsive_css' ) != '1') {
		if ( !empty( $desktop_visibility ) ) {
			array_push( $section_classes, 'grve-desktop-row-hide' );
		}
		if ( !empty( $tablet_visibility ) ) {
			array_push( $section_classes, 'grve-tablet-row-hide' );
		}
		if ( !empty( $tablet_sm_visibility ) ) {
			array_push( $section_classes, 'grve-tablet-sm-row-hide' );
		}
		if ( !empty( $mobile_visibility ) ) {
			array_push( $section_classes, 'grve-mobile-row-hide' );
		}
	}

	$section_string = implode( ' ', $section_classes );

	//Overlay Classes
	$overlay_classes = array();
	if ( !empty ( $pattern_overlay ) ) {
		array_push( $overlay_classes, 'grve-pattern');
	}
	if ( !empty ( $color_overlay ) ) {
		array_push( $overlay_classes, 'grve-' . $color_overlay . '-overlay');
		if ( !empty ( $opacity_overlay ) ) {
			array_push( $overlay_classes, 'grve-overlay-' . $opacity_overlay );
		}
	}
	$overlay_string = implode( ' ', $overlay_classes );

	if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type || 'video' == $bg_type ) && !empty ( $overlay_classes ) ) {
		$out_overlay .= '  <div class="' . esc_attr( $overlay_string ) .'"></div>';
	}


	//Background Image
	$img_style = grve_build_shortcode_img_style( $bg_image ,$bg_image_type );
	$grve_stellar_ratio = apply_filters( 'grve_row_stellar_ratio', '0.5' );

	if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type || 'video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' !== $bg_image_type ) ) {
		$out_image_bg .= '  <div class="grve-bg-image"  ' . $img_style . '></div>';
	}

	if ( ( 'image' == $bg_type || 'hosted_video' == $bg_type || 'video' == $bg_type ) && !empty ( $bg_image ) && ('parallax' == $bg_image_type ) ) {
		$out_image_bg .= '  <div class="grve-bg-image" data-stellar-ratio="' . esc_attr( $grve_stellar_ratio ) . '" ' . $img_style . '></div>';
	}

	//Background Video
	if ( 'hosted_video' == $bg_type && ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) ) {

		$has_video_bg = true;
		$video_poster = $playsinline = '';
		$muted = 'yes';
		if ( wp_is_mobile() ) {
			if ( 'yes' == $bg_video_device ) {
				$video_poster = grve_vc_shortcode_img_url( $bg_image );
				$muted = 'yes';
				$playsinline = 'yes';
			} else {
				$has_video_bg = false;
			}
		}

		if ( $has_video_bg ) {
			$video_settings = array(
				'preload' => 'auto',
				'autoplay' => 'yes',
				'loop' => $bg_video_loop,
				'muted' => $muted,
				'poster' => $video_poster,
				'playsinline' => $playsinline,
			);

			if ( wp_is_mobile() ) {
				$bg_video_type = 'normal';
			}

			if( 'normal' == $bg_video_type ) {
				$out_video_bg .= '<div class="grve-bg-video grve-html5-bg-video grve-bg-no-parallax" data-video-device="' . esc_attr( $bg_video_device ) .'">';
			} else {
				$out_video_bg .= '<div class="grve-bg-video grve-html5-bg-video" data-video-device="' . esc_attr( $bg_video_device ) .'" data-stellar-ratio="' . esc_attr( $grve_stellar_ratio ) . '">';
			}
			$out_video_bg .=  '<video ' . grve_print_media_video_settings( $video_settings ) . '>';

			if ( !empty ( $bg_video_webm ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_webm ) . '" type="video/webm">';
			}
			if ( !empty ( $bg_video_mp4 ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty ( $bg_video_ogv ) ) {
				$out_video_bg .=  '<source src="' . esc_url( $bg_video_ogv ) . '" type="video/ogg">';
			}
			$out_video_bg .=  '</video>';
			$out_video_bg .= '</div>';
		}
	}

	//YouTube Video
	$out_video_bg_url = '';
	$has_video_bg = ( 'video' == $bg_type && ! empty( $bg_video_url ) && grve_extract_youtube_id( $bg_video_url ) );
	if ( $has_video_bg ) {
		wp_enqueue_script( 'youtube-iframe-api' );
		$out_video_bg_url .= '<div class="grve-bg-video grve-yt-bg-video" data-video-bg-url="' . esc_attr( $bg_video_url ) . '"></div>';
	}

	$row_classes = array( 'grve-row', 'grve-bookmark' );
	$row_css_string = implode( ' ', $row_classes );


	$wrapper_attributes = array();
	if ( !empty ( $section_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $section_id ) . '"';
	}
	$wrapper_attributes[] = 'class="' . esc_attr( $section_string ) . '"';
	$wrapper_attributes[] = 'data-section-title="' . esc_attr( $section_title ) . '"';
	$wrapper_attributes[] = 'data-section-type="' . esc_attr( $section_type ) . '"';
	$wrapper_attributes[] = 'data-image-type="' . esc_attr( $bg_image_type ) . '"';
	$wrapper_attributes[] = 'data-full-height="' . esc_attr( $section_full_height ) . '"';
	if ( !empty ( $style ) ) {
		$wrapper_attributes[] = $style;
	}

	//Section Output
	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>';
		echo '<div class="' . esc_attr( $row_css_string ) . '">' . do_shortcode( $content ) . ' </div>';
	if ( !empty ( $out_video_bg_url ) ) {
		echo '<div class="grve-background-wrapper">' . $out_video_bg_url . $out_overlay . $out_image_bg . '</div>';
	} else {
		echo '<div class="grve-background-wrapper">' . $out_overlay . $out_image_bg . $out_video_bg . '</div>';
	}
	echo '</div>';

//Omit closing PHP tag to avoid accidental whitespace output errors.
