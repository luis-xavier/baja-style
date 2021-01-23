<?php

/*
 *	Media functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


/**
 * Generic function that prints a slider or gallery
 */
function grve_print_gallery_slider( $gallery_mode, $slider_items , $image_size_slider = 'grve-image-large-rect-horizontal', $extra_class = "") {

	if ( empty( $slider_items ) ) {
		return;
	}
	$image_size_gallery_thumb = 'grve-image-small-square';
	if( 'gallery-vertical' == $gallery_mode ) {
		$image_size_gallery_thumb = $image_size_slider;
	}

	$start_block = $end_block = $item_class = '';


	if ( 'gallery' == $gallery_mode || '' == $gallery_mode || 'gallery-vertical' == $gallery_mode ) {

		$gallery_index = 0;

?>
		<div class="grve-media">
			<ul class="grve-post-gallery grve-post-gallery-popup <?php echo esc_attr( $extra_class ); ?>">
<?php

		foreach ( $slider_items as $slider_item ) {

			$media_id = $slider_item['id'];
			$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
			$image_full_url = $full_src[0];
			$caption = get_post_field( 'post_excerpt', $media_id );
			$figcaption = '';

			if	( !empty( $caption ) ) {
				$figcaption = wptexturize( $caption );
			}

			echo '<li class="grve-image-hover">';
			echo '<a data-title="' . esc_attr( $figcaption ) . '" href="' . esc_url( $image_full_url ) . '">';
			echo wp_get_attachment_image( $media_id, $image_size_gallery_thumb );
			echo '</a>';
			echo '</li>';
		}
?>
			</ul>
		</div>
<?php

	} else {

		$slider_settings = array();
		if ( is_singular( 'post' ) || is_singular( 'portfolio' ) ) {
			if ( is_singular( 'post' ) ) {
				$slider_settings = grve_post_meta( 'grve_post_slider_settings' );
			} else {
				$slider_settings = grve_post_meta( 'grve_portfolio_slider_settings' );
			}
		}
		$slider_speed = grve_array_value( $slider_settings, 'slideshow_speed', '2500' );
		$slider_dir_nav = grve_array_value( $slider_settings, 'direction_nav', '2' );
?>
		<div class="grve-media">
			<div class="grve-carousel-wrapper">
				<div class="grve-carousel-navigation grve-dark" data-navigation-type="<?php echo esc_attr( $slider_dir_nav ); ?>">
					<div class="grve-carousel-buttons">
						<div class="grve-carousel-prev grve-icon-nav-left"></div>
						<div class="grve-carousel-next grve-icon-nav-right"></div>
					</div>
				</div>
				<div class="grve-slider grve-carousel-element " data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-slider-pause="yes" data-slider-autoheight="no">
<?php
				foreach ( $slider_items as $slider_item ) {
					$media_id = $slider_item['id'];
					echo '<div class="grve-slider-item">';
					echo wp_get_attachment_image( $media_id, $image_size_slider );
					echo '</div>';
				}
?>
				</div>
			</div>
		</div>
<?php
	}
}

/**
 * Generic function that prints video settings ( HTML5 )
 */

if ( !function_exists( 'grve_print_media_video_settings' ) ) {
	function grve_print_media_video_settings( $video_settings ) {
		$video_attr = '';

		if ( !empty( $video_settings ) ) {

			$video_poster = grve_array_value( $video_settings, 'poster' );
			$video_preload = grve_array_value( $video_settings, 'preload', 'metadata' );

			if( 'yes' == grve_array_value( $video_settings, 'controls' ) ) {
				$video_attr .= ' controls';
			}
			if( 'yes' == grve_array_value( $video_settings, 'loop' ) ) {
				$video_attr .= ' loop="loop"';
			}
			if( 'yes' ==  grve_array_value( $video_settings, 'muted' ) ) {
				$video_attr .= ' muted="muted"';
			}
			if( 'yes' == grve_array_value( $video_settings, 'autoplay' ) ) {
				$video_attr .= ' autoplay="autoplay"';
			}
			if( 'yes' == grve_array_value( $video_settings, 'playsinline' ) ) {
				$video_attr .= ' playsinline';
			}
			if( !empty( $video_poster ) ) {
				$video_attr .= ' poster="' . esc_url( $video_poster ) . '"';
			}
			$video_attr .= ' preload="' . $video_preload . '"';

		}
		return $video_attr;
	}
}

/**
 * Generic function that prints a video ( Embed or HTML5 )
 */
if ( !function_exists('grve_print_media_video') ) {

	function grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $type = 'post' ) {
		global $wp_embed;
		$video_output = '';

		if( empty( $video_mode ) && !empty( $video_embed ) ) {
			echo '<div class="grve-media">' . $wp_embed->run_shortcode( '[embed]' . $video_embed . '[/embed]' ) . '</div>';
		} else {

			if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {

				$video_settings = array(
					'controls' => 'yes',
				);
				$video_settings = apply_filters( 'grve_media_video_settings', $video_settings, $type );
				$video_attr = grve_print_media_video_settings( $video_settings );

				echo '<div class="grve-media">';
				echo ' <video ' . $video_attr . '>';

				if ( !empty( $video_webm ) ) {
					echo '<source src="' . $video_webm . '" type="video/webm">';
				}
				if ( !empty( $video_mp4 ) ) {
					echo '<source src="' . $video_mp4 . '" type="video/mp4">';
				}
				if ( !empty( $video_ogv ) ) {
					echo '<source src="' . $video_ogv . '" type="video/ogg">';
				}
				echo ' </video>';
				echo '</div>';

			}
		}
	}
}

/**
 * Generic function to add attributes to image
 */
if ( !function_exists( 'grve_img_attributes' ) ) {
	function grve_img_attributes( $attr ) {
		$attr['itemprop'] = 'image';
		return $attr;
	}
}
//add_filter('wp_get_attachment_image_attributes', 'grve_img_attributes', 10, 2);

//Omit closing PHP tag to avoid accidental whitespace output errors.
