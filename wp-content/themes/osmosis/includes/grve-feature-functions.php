<?php

/*
*	Feature Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Header Feature Section Data
 */

function grve_get_feature_data() {
	global $post;

	$feature_data_fullscreen = 'no';
	$feature_data_overlap = 'no';
	$feature_data_header_position = 'above-feature';
	$feature_header_style = 'default';

	$grve_woo_shop = false;
	$feature_size = '';

	if ( grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		$grve_woo_shop = true;
	}

	if ( is_singular() || $grve_woo_shop  ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );

		if (( $post_type == 'page' && is_singular( 'page' ) ) ||
			( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) ||
			( $post_type == 'post' && is_singular( 'post' ) ) ||
			$grve_woo_shop ) {

			$feature_element = get_post_meta( $post_id, 'grve_page_feature_element', true );
			if ( !empty( $feature_element ) ) {
				$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
				$feature_header_position = get_post_meta( $post_id, 'grve_page_feature_header_position', true );
				if ( 'below' == $feature_header_position ) {
					$feature_data_header_position = 'bellow-feature';
				}
				$feature_header_integration = get_post_meta( $post_id, 'grve_page_feature_header_integration', true );
				if ( empty($feature_size) ) {
					$feature_data_fullscreen = 'yes';
				}
				$feature_data_overlap = !empty( $feature_header_integration ) ? $feature_header_integration : 'no';
				if ( 'slider' == $feature_element ) {
					$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
					if ( !empty( $slider_items ) ) {
						$feature_header_style = isset( $slider_items[0]['header_style'] ) && 'yes' == $feature_data_overlap ? $slider_items[0]['header_style'] : 'default';
					}
				} else {
					$feature_header_style = get_post_meta( $post_id, 'grve_page_feature_header_style', true );
					if ( empty( $feature_header_style ) ) {
						$feature_header_style = 'default';
					}
				}
			}
		}
	}

	$header_styles = array( 'default', 'dark', 'light' );
	if ( !in_array( $feature_header_style, $header_styles ) ) {
		$feature_header_style = 'default';
	}

	return array(
		'data_fullscreen' => $feature_data_fullscreen,
		'data_overlap' => $feature_data_overlap,
		'data_header_position' => $feature_data_header_position,
		'header_style' => 'grve-' . $feature_header_style,
	);

}

/**
 * Prints Header Feature Section Page/Post/Portfolio
 */
function grve_print_header_feature() {
	global $post;

	$grve_woo_shop = false;
	if ( grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		$grve_woo_shop = true;
	}

	if ( is_singular() || $grve_woo_shop  ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}

		$post_type = get_post_type( $post_id );

		if (( $post_type == 'page' && is_singular( 'page' ) ) ||
			( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) ||
			( $post_type == 'post' && is_singular( 'post' ) ) ||
			$grve_woo_shop ) {

			$feature_element = get_post_meta( $post_id, 'grve_page_feature_element', true );
			if ( !empty( $feature_element ) ) {

				switch( $feature_element ) {

					case 'image':
						$image_item = get_post_meta( $post_id, 'grve_page_image_item', true );
						if ( !empty( $image_item ) ) {
							grve_print_header_feature_image( $post_id, $image_item );
						}
						break;
					case 'video':
						$video_item = get_post_meta( $post_id, 'grve_page_video_item', true );
						if ( !empty( $video_item ) ) {
							grve_print_header_feature_video( $post_id, $video_item );
						}
						break;
					case 'slider':
						$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
						if ( !empty( $slider_items ) ) {
							grve_print_header_feature_slider( $post_id, $slider_items );
						}
						break;
					case 'revslider':
						$revslider_alias = get_post_meta( $post_id, 'grve_page_feature_revslider', true );
						if ( !empty( $revslider_alias ) ) {
							grve_print_header_feature_revslider( $post_id, $revslider_alias );
						}
						break;
					case 'title':
						$title_item = get_post_meta( $post_id, 'grve_page_title_item', true );
						if ( !empty( $title_item ) ) {
							grve_print_header_feature_title( $post_id, $title_item );
						}
						break;
					case 'map':
						$map_items = get_post_meta( $post_id, 'grve_page_map_items', true );
						if ( !empty( $map_items ) ) {
							grve_print_header_feature_map( $post_id, $map_items );
						}
						break;
					default:
						break;

				}
			}
		}
	}
}

/**
 * Prints Overlay Container
 */
function grve_print_overlay_container( $item ) {

	$pattern_overlay = grve_array_value( $item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $item, 'opacity_overlay', '10' );

	$overlay_classes = array();

	if ( !empty ( $pattern_overlay ) ) {
		array_push( $overlay_classes, 'grve-pattern');
	}
	if ( !empty ( $color_overlay ) ) {
		array_push( $overlay_classes, 'grve-' . $color_overlay . '-overlay');
	}
	if ( !empty ( $opacity_overlay ) ) {
		array_push( $overlay_classes, 'grve-overlay-' . $opacity_overlay );
	}

	$overlay_string = implode( ' ', $overlay_classes );
	if ( !empty ( $overlay_string ) ) {
		echo '<div class="' . esc_attr( $overlay_string ) . '"></div>';
	}
}

/**
 * Prints Background Image Container
 */
function grve_print_bg_image_container( $media_id, $bg_position = 'center-center', $bg_tablet_sm_position = '', $bg_image_size = 'grve-image-fullscreen' ) {

	if( empty( $bg_image_size ) ) {
		$bg_image_size = 'grve-image-fullscreen';
	}
	$full_src = wp_get_attachment_image_src( $media_id, $bg_image_size );
	$image_url = esc_url( $full_src[0] );
	if( !empty( $image_url ) ) {

		$bg_image_classes = array( 'grve-bg-image' );
		$bg_image_classes[] = 'grve-bg-position-' . $bg_position;
		if ( !empty( $bg_tablet_sm_position ) ) {
			$bg_image_classes[] = 'grve-bg-tablet-sm-' . $bg_tablet_sm_position;
		}
		$bg_image_classes_string = implode( ' ', $bg_image_classes );

		echo '<div class="' . esc_attr( $bg_image_classes_string ) . '" style="background-image: url(' . $image_url . ');"></div>';
	}

}

function grve_print_bg_image_url_container( $image_url, $bg_position = 'center-center' ) {

	if( !empty( $image_url ) ) {

		$bg_image_classes = array( 'grve-bg-image' );
		$bg_image_classes[] = 'grve-bg-position-' . $bg_position;
		$bg_image_classes_string = implode( ' ', $bg_image_classes );

		echo '<div class="' . esc_attr( $bg_image_classes_string ) . '" style="background-image: url(' . $image_url . ');"></div>';
	}

}


/**
 * Prints Background Video Container
 */
function grve_print_bg_video_container( $video_item ) {


	$bg_video_webm = grve_array_value( $video_item, 'video_webm' );
	$bg_video_mp4 = grve_array_value( $video_item, 'video_mp4' );
	$bg_video_ogv = grve_array_value( $video_item, 'video_ogv' );
	$image_url = grve_array_value( $video_item, 'video_bg_image' );
	$bg_video_device = grve_array_value( $video_item, 'video_device', 'no' );
	$loop = grve_array_value( $video_item, 'video_loop', 'yes' );
	$muted = grve_array_value( $video_item, 'video_muted', 'yes' );

	$out_video_bg  = '';

	if ( !empty( $image_url ) ) {
		echo grve_print_bg_image_url_container( $image_url );
	}

	$video_poster = $playsinline = '';

	if ( wp_is_mobile() ) {
		if ( 'yes' == $bg_video_device ) {
			if( !empty( $image_url ) ) {
				$video_poster = $image_url;
			}
			$muted = 'yes';
			$playsinline = 'yes';
		} else {
			return;
		}
	}

	if ( osmosis_grve_browser_webkit_check() ) {
		$muted = 'yes';
	}

	$video_settings = array(
		'preload' => 'auto',
		'autoplay' => 'yes',
		'loop' => $loop,
		'muted' => $muted,
		'poster' => $video_poster,
		'playsinline' => $playsinline,
	);
	$video_settings = apply_filters( 'grve_feature_video_settings', $video_settings );

	if ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) {
		echo '<div class="grve-bg-video grve-html5-bg-video" data-video-device="' . esc_attr( $bg_video_device ) . '">';
		echo '<video ' . grve_print_media_video_settings( $video_settings ) . '>';
		if ( !empty ( $bg_video_webm ) ) {
			echo '<source src="' . esc_url( $bg_video_webm ) . '" type="video/webm">';
		}
		if ( !empty ( $bg_video_mp4 ) ) {
			echo '<source src="' . esc_url( $bg_video_mp4 ) . '" type="video/mp4">';
		}
		if ( !empty ( $bg_video_ogv ) ) {
			echo '<source src="' . esc_url( $bg_video_ogv ) . '" type="video/ogg">';
		}
		echo '</video>';
		echo '</div>';
	}

}


/**
 * Get Feature Section position data
 */

function osmosis_grve_get_feature_position_data( $feature_size, $feature_height , $bg_color = '' ) {

	$feature_data = array();

	if ( !empty($feature_size) ) {
		if ( empty( $feature_height ) ) {
			$feature_height = "550";
		}
		if ( !empty($bg_color) ) {
			$feature_data[] = 'data-height="' . esc_attr( $feature_height ) . '"';
			$feature_data[] = 'style="height:' . esc_attr( $feature_height ) . 'px;background-color: ' . esc_attr( $bg_color ) . ';"';
		} else {
			$feature_data[] = 'data-height="' . esc_attr( $feature_height ) . '"';
			$feature_data[] = 'style="height:' . esc_attr( $feature_height ) . 'px;"';
		}
	} else {
		if ( !empty($bg_color) ) {
			$feature_data[] = 'style="background-color: ' . esc_attr( $bg_color ) . ';"';
		}
	}
	return $feature_data;
}

function osmosis_grve_get_feature_style_height( $feature_size, $feature_height ) {

	$feature_data = array();

	if ( !empty($feature_size) ) {
		if ( empty( $feature_height ) ) {
			$feature_height = "550";
		}
		$feature_data[] = 'style="height:' . esc_attr( $feature_height ) . 'px;"';
	}
	return $feature_data;
}

/**
 * Prints Simple Header Feature Revolution Slider ( Post/Portfolio )
 */
function grve_print_header_feature_revslider( $post_id, $revslider_alias ) {

	$feature_header_style = get_post_meta( $post_id, 'grve_page_feature_header_style', true );
?>
	<div id="grve-feature-section" class="grve-with-revslider">
		<div class="grve-feature-section-inner" data-item="revslider">
			<div class="grve-feature-element grve-revslider">
				<?php echo do_shortcode( '[rev_slider ' . $revslider_alias . ']' ); ?>
				<?php grve_print_feature_go_to_section( $post_id, $feature_header_style, 'revslider' ); ?>
			</div>
		</div>
	</div>
<?php

}

/**
 * Prints Header Section Feature content
 */
function grve_print_header_feature_content( $item  ) {

	$title = grve_array_value( $item, 'title' );
	$caption = grve_array_value( $item, 'caption' );
	$title_color = grve_array_value( $item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $item, 'caption_color', 'dark' );
	$title_tag = grve_array_value( $item, 'title_tag', 'h1' );
	$caption_tag = grve_array_value( $item, 'caption_tag', 'div' );
?>
	<?php if ( !empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> class="grve-title grve-<?php echo esc_attr( $title_color ); ?>"><span><?php echo wp_kses_post( $title ); ?></span></<?php echo esc_attr( $title_tag ); ?>>
	<?php } ?>
	<?php if ( !empty( $caption ) ) { ?>
	<<?php echo esc_attr( $caption_tag ); ?> class="grve-description grve-<?php echo esc_attr( $caption_color ); ?>"><?php echo wp_kses_post( $caption ); ?></<?php echo esc_attr( $caption_tag ); ?>>
	<?php } ?>
<?php
}


/**
 * Prints Header Section Feature Title
 */
function grve_print_header_feature_title( $post_id, $title_item  ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );
	$text_align = grve_array_value( $title_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $title_item, 'text_animation', 'fade-in' );
	$title = grve_array_value( $title_item, 'title' );
	$caption = grve_array_value( $title_item, 'caption' );
	$title_color = grve_array_value( $title_item, 'title_color', '#ffffff' );
	$caption_color = grve_array_value( $title_item, 'caption_color', '#ffffff' );
	$title_tag = grve_array_value( $title_item, 'title_tag', 'h1' );
	$caption_tag = grve_array_value( $title_item, 'caption_tag', 'div' );
	$bg_color = grve_array_value( $title_item, 'bg_color', '#303030' );

	$style = grve_array_value( $title_item, 'style', 'default' );
	$el_class = grve_array_value( $title_item, 'el_class' );

	$feature_height_data = osmosis_grve_get_feature_style_height( $feature_size, $feature_height );
	$feature_position_data = osmosis_grve_get_feature_position_data( $feature_size, $feature_height, $bg_color );

	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="grve-with-title <?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo implode( ' ', $feature_height_data ); ?>>

		<div class="grve-feature-section-inner" data-item="title" <?php echo implode( ' ', $feature_position_data ); ?>>

			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php if ( !empty( $title ) ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="grve-title" style="color:<?php echo esc_attr( $title_color ); ?>"><span><?php echo wp_kses_post( $title ); ?></span></<?php echo esc_attr( $title_tag ); ?>>
					<?php } ?>
					<?php if ( !empty( $caption ) ) { ?>
					<<?php echo esc_attr( $caption_tag ); ?> class="grve-description" style="color:<?php echo esc_attr( $caption_color ); ?>"><?php echo wp_kses_post( $caption ); ?></<?php echo esc_attr( $caption_tag ); ?>>
					<?php } ?>
				</div>
			</div>
			<!-- End Custom Title -->
			<?php grve_print_feature_go_to_section( $post_id, $title_color, 'title' ); ?>
		</div>

	</div>
<?php
}

/**
 * Prints Header Section Feature Video
 */
function grve_print_header_feature_video( $post_id, $video_item  ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$text_align = grve_array_value( $video_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $video_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $video_item, 'title_color', 'dark' );

	$style = grve_array_value( $video_item, 'style', 'default' );
	$el_class = grve_array_value( $video_item, 'el_class' );

	$feature_height_data = osmosis_grve_get_feature_style_height( $feature_size, $feature_height );
	$feature_position_data = osmosis_grve_get_feature_position_data( $feature_size, $feature_height );
	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="grve-with-video <?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo implode( ' ', $feature_height_data ); ?>>

		<div class="grve-feature-section-inner" data-item="video" <?php echo implode( ' ', $feature_position_data ); ?>>
			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php grve_print_header_feature_content( $video_item  ); ?>
					<?php grve_print_feature_buttons( $video_item ); ?>
				</div>
			</div>
			<?php
				grve_print_overlay_container( $video_item );
				grve_print_bg_video_container( $video_item );
				grve_print_feature_go_to_section( $post_id, $title_color, 'video' );
			?>
		</div>

	</div>
<?php
}

/**
 * Prints Header Section Feature Image ( Page / Portfolio )
 */
function grve_print_header_feature_image( $post_id, $image_item ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$media_id = $image_item['id'];

	$text_align = grve_array_value( $image_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $image_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $image_item, 'title_color', 'dark' );

	$bg_image_size = grve_array_value( $image_item, 'bg_image_size' );
	$bg_position = grve_array_value( $image_item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = grve_array_value( $image_item, 'bg_tablet_sm_position', '' );
	$bg_effect = grve_array_value( $image_item, 'bg_effect', 'none' );
	$style = grve_array_value( $image_item, 'style', 'default' );
	$el_class = grve_array_value( $image_item, 'el_class' );

	$feature_height_data = osmosis_grve_get_feature_style_height( $feature_size, $feature_height );
	$feature_position_data = osmosis_grve_get_feature_position_data( $feature_size, $feature_height );

	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}
?>
	<div id="grve-feature-section" class="grve-with-image <?php echo esc_attr( $el_class ); ?>" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo implode( ' ', $feature_height_data ); ?>>

		<div class="grve-feature-section-inner" data-bg-effect="<?php echo esc_attr( $bg_effect ); ?>"  data-item="image" <?php echo implode( ' ', $feature_position_data ); ?>>
			<!-- Custom Title -->
			<div id="grve-feature-title" class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
				<div class="grve-container">
					<?php grve_print_header_feature_content( $image_item  ); ?>
					<?php grve_print_feature_buttons( $image_item ); ?>
				</div>
			</div>
			<!-- End Custom Title -->
			<?php
				grve_print_overlay_container( $image_item );
				grve_print_bg_image_container( $media_id, $bg_position, $bg_tablet_sm_position, $bg_image_size );
			?>
			<?php grve_print_feature_go_to_section( $post_id, $title_color, 'image' ); ?>
		</div>

	</div>
<?php
}

/**
 * Get slider settings data ( Page / Portfolio )
 */
function grve_get_slider_settings_data( $slider_settings ) {
	$slider_data = '';

	if ( !empty( $slider_settings ) ) {

		$slider_speed = grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
		$slider_pause = grve_array_value( $slider_settings, 'slider_pause', 'no' );
		$slider_transition = grve_array_value( $slider_settings, 'transition', 'slide' );

		$slider_data .= ' data-slider-speed="' . esc_attr( $slider_speed ) . '"';
		$slider_data .= ' data-slider-pause="' . esc_attr( $slider_pause ) . '"';
		$slider_data .= ' data-slider-transition="' . esc_attr( $slider_transition ) . '"';

	}
	return $slider_data;
}

/**
 * Prints Advanced Header Feature Slider ( Page / Portfolio / Post )
 */
function grve_print_header_feature_slider( $post_id, $slider_items ) {

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );
	$slider_settings = get_post_meta( $post_id, 'grve_page_slider_settings', true );

	$feature_height_data = osmosis_grve_get_feature_style_height( $feature_size, $feature_height );
	$feature_position_data = osmosis_grve_get_feature_position_data( $feature_size, $feature_height );

	$slider_dir_nav = grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_nav_advanced = grve_array_value( $slider_settings, 'nav_advanced' );


	$feature_effect = get_post_meta( $post_id, 'grve_page_feature_effect', true );
	if ( empty( $feature_effect ) ) {
		$feature_effect = "none";
	}

?>
	<div id="grve-feature-section" class="grve-with-slider" data-effect="<?php echo esc_attr( $feature_effect ); ?>" <?php echo implode( ' ', $feature_height_data ); ?>>
		<div class="grve-feature-section-inner grve-carousel-wrapper" data-item="slider" <?php echo implode( ' ', $feature_position_data ); ?>>

<?php
		if ( 0 != $slider_dir_nav ) {
?>
			<div class="grve-carousel-navigation grve-<?php echo esc_attr( $slider_dir_nav_color ); ?>" data-navigation-type="<?php echo esc_attr( $slider_dir_nav ); ?>">
				<div class="grve-carousel-buttons">
					<div class="grve-carousel-prev grve-icon-nav-left"></div>
					<div class="grve-carousel-next grve-icon-nav-right"></div>
				</div>
			</div>
<?php
		}
?>
			<div id="grve-feature-slider" class="grve-slider" <?php echo grve_get_slider_settings_data( $slider_settings ); ?>>

<?php
			foreach ( $slider_items as $slider_item ) {
				$media_id = $slider_item['id'];

				$text_align = grve_array_value( $slider_item, 'text_align', 'left' );
				$text_animation = grve_array_value( $slider_item, 'text_animation', 'fade-in' );
				$title_color = grve_array_value( $slider_item, 'title_color', 'dark' );

				$bg_image_size = grve_array_value( $slider_item, 'bg_image_size' );
				$bg_position = grve_array_value( $slider_item, 'bg_position', 'center-center' );
				$bg_tablet_sm_position = grve_array_value( $slider_item, 'bg_tablet_sm_position', '' );
				$style = grve_array_value( $slider_item, 'style', 'default' );
				$header_style = grve_array_value( $slider_item, 'header_style', 'default' );
				$el_class = grve_array_value( $slider_item, 'el_class' );

				$header_styles = array( 'default', 'dark', 'light' );
				if ( !in_array( $header_style, $header_styles ) ) {
					$header_style = 'default';
				}

?>
				<div class="grve-slider-item <?php echo esc_attr( $el_class ); ?>" data-style="<?php echo esc_attr( $header_style ); ?>" data-title-color="<?php echo esc_attr( $title_color ); ?>">
					<div class="grve-feature-content grve-align-<?php echo esc_attr( $text_align ); ?> grve-style-<?php echo esc_attr( $style ); ?> grve-<?php echo esc_attr( $text_animation ); ?>">
						<div class="grve-container">
							<?php grve_print_header_feature_content( $slider_item  ); ?>
							<?php grve_print_feature_buttons( $slider_item ); ?>
						</div>
					</div>
					<?php
						grve_print_overlay_container( $slider_item );
						grve_print_bg_image_container( $media_id, $bg_position, $bg_tablet_sm_position, $bg_image_size );
					?>
				</div>
<?php
			}
?>

			</div>

		</div>
		<?php grve_print_feature_go_to_section( $post_id, $title_color, 'slider' ); ?>
	</div>
<?php

}

/**
 * Prints Header Feature Map ( Page / Portfolio )
 */
function grve_print_header_feature_map( $post_id, $map_items ) {

	wp_enqueue_script( 'grve-googleapi-script');
	wp_enqueue_script( 'grve-markerclusterer-script');
	wp_enqueue_script( 'grve-maps-script');

	$feature_size = get_post_meta( $post_id, 'grve_page_feature_size', true );
	$feature_height = get_post_meta( $post_id, 'grve_page_feature_height', true );

	$map_settings = get_post_meta( $post_id, 'grve_page_map_settings', true );
	$map_marker = grve_array_value( $map_settings, 'marker', get_template_directory_uri() . '/images/markers/markers.png' );
	$map_zoom = grve_array_value( $map_settings, 'zoom', 14 );
	$map_single_popup = grve_array_value( $map_settings, 'single_popup', 'no' );
	$map_clustering = grve_array_value( $map_settings, 'clustering', 'no' );

	$map_lat = grve_array_value( $map_items[0], 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_items[0], 'lng', '-0.136986' );

	$feature_height_data = osmosis_grve_get_feature_style_height( $feature_size, $feature_height );
	$feature_position_data = osmosis_grve_get_feature_position_data( $feature_size, $feature_height );

?>
	<div id="grve-feature-section" class="grve-with-map" <?php echo implode( ' ', $feature_height_data ); ?>>
		<div class="grve-feature-section-inner" data-item="map" <?php echo implode( ' ', $feature_position_data ); ?>>
			<div class="grve-map" <?php echo implode( ' ', $feature_height_data ); ?> data-lat="<?php echo esc_attr( $map_lat ); ?>" data-lng="<?php echo esc_attr( $map_lng ); ?>" data-zoom="<?php echo esc_attr( $map_zoom ); ?>" data-single-popup="<?php echo esc_attr( $map_single_popup ); ?>" data-clustering="<?php echo esc_attr( $map_clustering ); ?>"><?php echo apply_filters( 'grve_privacy_gmap_fallback', '', $map_lat, $map_lng ); ?></div>
			<?php
				foreach ( $map_items as $map_item ) {
					grve_print_feature_map_point( $map_item, $map_marker );
				}
			?>
			</div>
	</div>
<?php
}

function grve_print_feature_map_point( $map_item, $default_marker ) {

	$map_lat = grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = grve_array_value( $map_item, 'marker', $default_marker );

	$map_title = grve_array_value( $map_item, 'title' );
	$map_infotext = grve_array_value( $map_item, 'info_text', '' );
	$map_infotext_open = grve_array_value( $map_item, 'info_text_open', 'no' );

	$button_text = grve_array_value( $map_item, 'button_text' );
	$button_url = grve_array_value( $map_item, 'button_url' );
	$button_url = esc_url( $button_url );
	$button_type = grve_array_value( $map_item, 'button_type', '' );
	$button_size = grve_array_value( $map_item, 'button_size', 'extrasmall' );
	$button_color = grve_array_value( $map_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $map_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $map_item, 'button_target', '_self' );
	$button_target = esc_attr( $button_target );
	$button_class = grve_array_value( $map_item, 'button_class' );

?>
	<div style="display:none" class="grve-map-point" data-point-lat="<?php echo esc_attr( $map_lat ); ?>" data-point-lng="<?php echo esc_attr( $map_lng ); ?>" data-point-marker="<?php echo esc_attr( $map_marker ); ?>" data-point-title="<?php echo esc_attr( $map_title ); ?>" data-point-open="<?php echo esc_attr( $map_infotext_open ); ?>">
		<?php if ( !empty( $map_title ) || !empty( $map_infotext ) || !empty( $button_text ) ) { ?>
		<div class="grve-map-infotext">
			<?php if ( !empty( $map_title ) ) { ?>
			<h6 class="grve-infotext-title"><?php echo esc_html( $map_title ); ?></h6>
			<?php } ?>
			<?php if ( !empty( $map_infotext ) ) { ?>
			<p class="grve-infotext-description"><?php echo wp_kses_post( $map_infotext ); ?></p>
			<?php } ?>
			<?php if ( !empty( $button_text ) ) { ?>
			<a class="grve-infotext-link <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_text ); ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
<?php

}

/**
 * Prints Header Feature Go to Section ( Bottom Arrow )
 */
function grve_print_feature_go_to_section( $post_id, $title_color, $item_type = 'default' ) {

	$feature_go_to_section = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section' );

	if( !empty( $feature_go_to_section ) ) {

		$feature_go_to_section_size = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_size', 'medium' );
		$feature_go_to_section_shape = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_shape', 'none' );
		$feature_go_to_section_animation = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_animation', 'bounce' );

		$go_to_section_classes = array( 'grve-goto-section', 'grve-icon-nav-down ');
		$go_to_section_classes[] = 'grve-' . $feature_go_to_section_size;

		if ( 'none' != $feature_go_to_section_shape ) {
			$go_to_section_classes[] = 'grve-' . $feature_go_to_section_shape;
		} else {
			$go_to_section_classes[] = 'grve-no-shape';
		}

		if (  'none' != $feature_go_to_section_animation  ) {
			$go_to_section_classes[] = 'grve-goto-' . $feature_go_to_section_animation;
		} else {
			$go_to_section_classes[] = 'grve-goto-no-animation';
		}

		if ( 'title' == $item_type ) {
			$go_to_section_classes[] = 'grve-custom-color';
		} else {
			$go_to_section_classes[] = 'grve-' . $title_color ;
		}

		$go_to_section_class_string = implode( ' ', $go_to_section_classes );


		if ( 'title' == $item_type ) {
?>
		<div id="grve-feature-goto" class="<?php echo esc_attr( $go_to_section_class_string ); ?>" data-custom-color="<?php echo esc_attr( $title_color ); ?>"></div>

<?php
		} else {
?>
		<div id="grve-feature-goto" class="<?php echo esc_attr( $go_to_section_class_string ); ?>"></div>
<?php
		}
	}

}

/**
 * Prints Header Feature Button
 */

function grve_print_feature_buttons( $item ) {

	$button_text = grve_array_value( $item, 'button_text' );
	$button_url = grve_array_value( $item, 'button_url' );
	$button_type = grve_array_value( $item, 'button_type', '' );
	$button_size = grve_array_value( $item, 'button_size', 'medium' );
	$button_color = grve_array_value( $item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $item, 'button_shape', 'square' );
	$button_target = grve_array_value( $item, 'button_target', '_self' );
	$button_class = grve_array_value( $item, 'button_class' );

	$button_text2 = grve_array_value( $item, 'button_text2' );
	$button_url2 = grve_array_value( $item, 'button_url2' );
	$button_type2 = grve_array_value( $item, 'button_type2', '' );
	$button_size2 = grve_array_value( $item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $item, 'button_target2', '_self' );
	$button_class2 = grve_array_value( $item, 'button_class2' );

	if( !empty( $button_text ) || !empty( $button_text2 ) ) {
		echo '<div class="grve-button-wrapper">';
		grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target, $button_class );
		grve_print_feature_button( $button_text2, $button_url2, $button_type2, $button_size2, $button_color2, $button_shape2, $button_target2, $button_class2 );
		echo '</div>';
	}

}

function grve_print_feature_button( $button_text, $button_url, $button_type, $button_size, $button_color, $button_shape, $button_target, $button_class ) {

	if ( !empty( $button_text ) ) {
		$button_classes = array( 'grve-btn' );

		array_push( $button_classes, 'grve-btn-' . $button_size );
		array_push( $button_classes, 'grve-' . $button_shape );

		if ( grve_starts_with( $button_color, 'primary' ) ) {
			array_push( $button_classes, 'grve-bg-' . $button_color );
		} else {
			array_push( $button_classes, 'grve-' . $button_color . '-color' );
		}

		if ( 'outline' == $button_type ) {
			array_push( $button_classes, 'grve-btn-line' );
		}
		if ( !empty( $button_class ) ) {
			array_push( $button_classes, $button_class );
		}

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_url ) ) {
			$url = $button_url;
			$target = $button_target;
		} else {
			$url = "#";
			$target= "_self";
		}

		echo '<a class="' . esc_attr( $button_class_string ) . '" href="' . esc_url( $url ) . '"  target="' . esc_attr( $target ) . '">';
		echo '<span>' . esc_html( $button_text ) . '</span>';
		echo '</a>';
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.

