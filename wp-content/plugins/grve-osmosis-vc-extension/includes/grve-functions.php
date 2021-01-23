<?php

/*
 *	Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

if ( !function_exists( 'grve_osmosis_vce_array_value' ) ) {
	function grve_osmosis_vce_array_value( $input_array, $id, $fallback = false, $param = false ) {

		if ( $fallback == false ) $fallback = '';
		$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
		if ( !empty($input_array[$id]) && $param ) {
			$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
		}
		return $output;
	}
}

function grve_osmosis_vce_starts_with( $haystack, $needle ) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}


 /**
 * Generates a button
 * Used in shortcodes to display a button
 */
function grve_osmosis_vce_get_button( $button_text, $button_link, $button_type, $button_size, $button_color, $button_shape, $button_extra_class, $style = '' ) {

	$button = "";

	if ( !empty( $button_text ) ) {
		$button_classes = array( 'grve-btn' );

		array_push( $button_classes, 'grve-btn-' . $button_size );
		array_push( $button_classes, 'grve-' . $button_shape );

		if ( grve_osmosis_vce_starts_with( $button_color, 'primary' ) ) {
			array_push( $button_classes, 'grve-bg-' . $button_color );
		} else {
			array_push( $button_classes, 'grve-' . $button_color . '-color' );
		}

		if ( 'outline' == $button_type ) {
			array_push( $button_classes, 'grve-btn-line' );
		}

		if ( !empty( $button_extra_class ) ) {
			array_push( $button_classes, $button_extra_class );
		}

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_link ) ){
			$href = vc_build_link( $button_link );
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

		$button .= '<a class="' . esc_attr( $button_class_string ) . '" href="' . esc_url( $url ) . '" target="' . $target . '" style="' . $style . '">';
		$button .= '<span>';
		$button .= $button_text;
		$button .= '</span>';
		$button .= '</a>';
	}

	return $button;

}

 /**
 * Fetch Go Pricing Tables
 * Used in shortcodes to generate the list of Go Pricing Tables ( back end )
 */

function grve_osmosis_vce_get_go_pricing_list() {

	$pricing_tables_list = array();

	if ( class_exists( 'GW_GoPricing' ) ) {

		if ( class_exists( 'GW_GoPricing_Data' ) ) {
			$pricing_tables = GW_GoPricing_Data::get_tables( '', false, 'title', 'ASC' );

			if ( !empty( $pricing_tables ) ) {
				foreach ( $pricing_tables as $pricing_table ) {
					if ( !empty( $pricing_table['name'] ) && !empty( $pricing_table['id'] ) ) $dropdown_data[$pricing_table['name']] = $pricing_table['id'];
				}
			}
			if ( empty( $dropdown_data ) ) $dropdown_data[0] = __( "No Pricing Tables Found", "grve-osmosis-vc-extension" );

			$pricing_tables_list = $dropdown_data;

		} else {
			$pricing_tables = get_option( 'go_pricing_tables' );
			if ( !empty( $pricing_tables ) ) {
				foreach( $pricing_tables as $pricing_table ) {
					if 	( isset ( $pricing_table['table-id'] ) ) {
						$table_id = $pricing_table['table-id'];
						if 	( isset ( $pricing_table['table-name'] ) && $pricing_table['table-name'] != '' ) {
							$table_name = '( ' . $pricing_table['table-name'] . ' ) ' . $table_id ;
						} else {
							$table_name = $table_id;
						}
						$pricing_tables_list[ $table_name ] = $table_id;
					}
				}
			} else {
				$pricing_tables_list[__( "No Pricing Tables Found", "grve-osmosis-vc-extension" )] = '';
			}
		}

	}

	return $pricing_tables_list;
}

 /**
 * Fetch Portfolio Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_osmosis_vce_get_portfolio_categories() {

	$portfolio_category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$portfolio_cats = get_terms( 'portfolio_category' );
	if ( is_array( $portfolio_cats ) ) {
	  foreach ( $portfolio_cats as $portfolio_cat ) {
		$portfolio_category[$portfolio_cat->name] = $portfolio_cat->term_id;

	  }
	}
	return $portfolio_category;

}

 /**
 * Fetch Portfolio Categories
 * Used in portfolio filter to generate the list of used categories ( front end )
 */
function grve_osmosis_vce_get_portfolio_list() {

	$all_string =  apply_filters( 'grve_vce_portfolio_string_all_categories', __( 'All', 'grve-osmosis-vc-extension' ) );

	$get_portfolio_category = get_categories( array( 'taxonomy' => 'portfolio_category') );
	$portfolio_category_list = array( '0' => $all_string );

	foreach ( $get_portfolio_category as $portfolio_category ) {
		$portfolio_category_list[] = $portfolio_category->cat_name;
	}
	return $portfolio_category_list;

}

 /**
 * Print Portfolio Image
 * Used in portfolio to fetch feature image or link
 */
function grve_osmosis_vce_print_portfolio_image( $image_size , $link = '' ) {
	if( function_exists( 'grve_print_portfolio_image' ) ) {
		grve_print_portfolio_image( $image_size , $link );
	}
}

 /**
 * Fetch Testimonial Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_osmosis_vce_get_testimonial_categories() {
	$testimonial_category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$testimonial_cats = get_terms( 'testimonial_category' );
	if ( is_array( $testimonial_cats ) ) {
	  foreach ( $testimonial_cats as $testimonial_cat ) {
		$testimonial_category[$testimonial_cat->name] = $testimonial_cat->term_id;
	  }
	}
	return $testimonial_category;
}

 /**
 * Fetch Post Categories
 * Used in shortcodes to generate the list of used categories ( back end )
 */
function grve_osmosis_vce_get_post_categories() {
	$category = array( __( "All Categories", "grve-osmosis-vc-extension" ) => "" );

	$cats = get_terms( 'category' );
	if ( is_array( $cats ) ) {
	  foreach ( $cats as $cat ) {
		$category[$cat->name] = $cat->term_id;

	  }
	}
	return $category;
}


 /**
 * Generates dimension string to concat in attribute style
 */
function grve_osmosis_vce_build_dimension( $dimension, $value ) {
	$fixed_dimension = '';

	if( ! empty( $dimension ) &&  ! empty( $value )  ) {
		$fixed_dimension .= $dimension . ': '.(preg_match('/(px|em|\%|pt|cm)$/', $value) ? $value : $value.'px').';';
	}
	return $fixed_dimension;
}

 /**
 * Generates margin-bottom string to concat in attribute style
 */
function grve_osmosis_vce_build_margin_bottom_style( $margin_bottom ) {
	$style = '';
	if( $margin_bottom != '' ) {
		$style .= 'margin-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom .'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Generates padding-top string to concat in attribute style
 */
function grve_osmosis_vce_build_padding_top_style( $padding_top ) {
	$style = '';
	if( $padding_top != '' ) {
		$style .= 'padding-top: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_top) ? $padding_top : $padding_top.'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Generates padding-bottom string to concat in attribute style
 */
function grve_osmosis_vce_build_padding_bottom_style( $padding_bottom ) {
	$style = '';
	if( $padding_bottom != '' ) {
		$style .= 'padding-bottom: '.(preg_match('/(px|em|\%|pt|cm)$/', $padding_bottom) ? $padding_bottom : $padding_bottom.'px').';';
		$style = esc_attr( $style );
	}
	return $style;
}

 /**
 * Prints blog class depending on the blog style
 */
function grve_osmosis_vce_get_blog_class( $grve_blog_style = 'large-media'  ) {

	switch( $grve_blog_style ) {

		case 'small-media':
			$grve_blog_style_class = 'grve-blog grve-small-media grve-non-isotope';
			break;
		case 'masonry':
			$grve_blog_style_class = 'grve-blog grve-blog-masonry grve-isotope';
			break;
		case 'grid':
			$grve_blog_style_class = 'grve-blog grve-blog-grid grve-isotope';
			break;
		case 'carousel':
			$grve_blog_style_class = 'grve-carousel-wrapper';
			break;
		case 'large-media':
		default:
			$grve_blog_style_class = 'grve-blog grve-large-media grve-non-isotope';
			break;

	}

	return $grve_blog_style_class;

}


 /**
 * Prints excerpt depending on the blog style and post format
 */
function grve_osmosis_vce_print_post_title( $blog_style, $post_format ) {
	global $allowedposttags;
	$mytags = $allowedposttags;

	$title_size = '5';
	if( 'large-media' == $blog_style || 'small-media' == $blog_style  ) {
		$title_size = '4';
	}
	if( 'carousel' == $blog_style ) {
		$title_size = '6';
	}

	switch( $post_format ) {
		case 'link':
			if( 'carousel' == $blog_style ) {
				the_title( '<a ' . grve_osmosis_vce_print_post_link( 'link' ) . ' rel="bookmark"><h' . $title_size . ' class="grve-post-title" itemprop="name headline">', '</h' . $title_size . '></a>' );
			} else {
				the_title( '<h4 class="grve-hidden" itemprop="name headline">', '</h4>' );
				unset($mytags['a']);
				unset($mytags['img']);
				$content = wp_kses(get_the_content(), $mytags);
				echo '<a ' . grve_osmosis_vce_print_post_link( 'link' ) . ' rel="bookmark">';
				echo '<div class="grve-post-icon"></div>';
				echo '<p class="grve-subtitle" itemprop="articleBody">' . $content . '</p>';
				echo '</a>';
			}
			break;
		case 'quote':
			if( 'carousel' == $blog_style ) {
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h' . $title_size . ' class="grve-post-title" itemprop="name headline">', '</h' . $title_size . '></a>' );
			} else {
				the_title( '<h4 class="grve-hidden" itemprop="name headline">', '</h4>' );
				unset($mytags['a']);
				unset($mytags['img']);
				unset($mytags['blockquote']);
				$content = wp_kses(get_the_content(), $mytags);

				echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
				grve_osmosis_vce_print_post_date();
				echo '<div class="grve-post-icon"></div>';
				echo '<p class="grve-subtitle" itemprop="articleBody">' . $content . '</p>';
				echo '</a>';
			}
			break;
		default:
			 the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h' . $title_size . ' class="grve-post-title" itemprop="name headline">', '</h' . $title_size . '></a>' );
			break;
	}

}

 /**
 * Prints post link
 */
function grve_osmosis_vce_print_post_link( $post_format = 'standard') {
	global $post;
	$post_id = $post->ID;

	$grve_link = get_permalink();
	$grve_target = '_self';

	if ( 'link' == $post_format ) {
		$grve_link = get_post_meta( $post_id, 'grve_post_link_url', true );
		$new_window = get_post_meta( $post_id, 'grve_post_link_new_window', true );

		if( empty( $grve_link ) ) {
			$grve_link = get_permalink();
		}

		if( !empty( $new_window ) ) {
			$grve_target = '_blank';
		}
	}

	return 'href="' . esc_url( $grve_link ) . '" target="' . $grve_target . '"';

}

/**
 * Prints excerpt depending on the blog style and post format
 */
function grve_osmosis_vce_print_post_excerpt( $blog_style, $post_format, $autoexcerpt = '', $excerpt_length = '55', $excerpt_more = '' ) {

	if ( 'link' == $post_format || 'quote' == $post_format ) {
		return;
	}

	echo '<div itemprop="articleBody">';
	switch( $blog_style ) {
		case 'large-media':
			if ( empty( $autoexcerpt ) ) {
				if ( empty( $excerpt_more ) ) {
					the_content( '' );
				} else {
					global $more;
					$more = 0;
					the_content( grve_osmosis_vce_read_more_string() );
				}
			} else {
				echo grve_osmosis_vce_excerpt( $excerpt_length, $excerpt_more );
			}
			break;
		default:
			echo grve_osmosis_vce_excerpt( $excerpt_length, $excerpt_more );
			break;
	}
	echo '</div>';

}

/**
 * Returns read more link
 */
if ( !function_exists('grve_osmosis_vce_read_more') ) {
	function grve_osmosis_vce_read_more( $post_id = '' ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		$read_more_string =  apply_filters( 'grve_vce_string_read_more', __( 'read more', 'grve-osmosis-vc-extension' ) );
		return '<a class="grve-read-more" href="' . esc_url( get_permalink( $post_id ) ) . '"><span>' . $read_more_string . '</span></a>';
	}
}

/**
 * Returns read more string
 */
function grve_osmosis_vce_read_more_string() {
	$read_more_string =  apply_filters( 'grve_vce_string_read_more', __( 'read more', 'grve-osmosis-vc-extension' ) );
    return $read_more_string;
}

/**
 * Returns excerpt
 */
function grve_osmosis_vce_excerpt( $limit, $more = "" ) {
	global $post;
	$post_id = $post->ID;

	if ( has_excerpt( $post_id ) ) {
		$excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );
		if ( 'yes' == $more ) {
			$excerpt .= grve_osmosis_vce_read_more( $post_id );
		}
	} else {
		$content = get_the_content('');
		$content = do_shortcode( $content );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		if ( 'yes' == $more ) {
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			$excerpt .= grve_osmosis_vce_read_more( $post_id );
		} else{
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
		}
	}
	return	$excerpt;
}

/**
 * Prints feature media depending on the blog style and post format
 */
function grve_osmosis_vce_print_carousel_media( $image_size = 'grve-image-small-rect-horizontal' ) {
	global $post;
	$post_id = $post->ID;
	$image_src = GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/images/empty/' . $image_size . '.jpg';

	$grve_link = get_permalink();
	$grve_target = '_self';
	if ( 'link' == get_post_format() ) {
		$grve_link = get_post_meta( $post_id, 'grve_post_link_url', true );
		$new_window = get_post_meta( $post_id, 'grve_post_link_new_window', true );
		if( empty( $grve_link ) ) {
			$grve_link = get_permalink();
		}
		if( !empty( $new_window ) ) {
			$grve_target = '_blank';
		}
	}
?>
		<div class="grve-media grve-image-hover">
			<?php if ( has_post_thumbnail( $post_id ) ) { ?>
			<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
			<?php } else { ?>
			<a class="grve-no-image" href="<?php echo esc_url( $image_href ); ?>"><img src="<?php echo esc_url( $image_src ); ?>" alt="no image"></a>
			<?php } ?>

		</div>
<?php
}

/**
 * Prints feature media depending on the blog style and post format
 */
function grve_osmosis_vce_print_post_feature_media( $grve_blog_style = 'large-media', $post_format, $blog_image_mode, $blog_image_prio ) {
	global $post, $wp_embed;

	$post_id = $post->ID;

	switch( $grve_blog_style ) {

		case 'small-media':
		case 'grid':
			$image_size = 'grve-image-small-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'large';
			 }
			break;
		case 'carousel':
			$image_size = 'grve-image-small-rect-horizontal';
			break;
		case 'masonry':
			 $image_size  = 'grve-image-small-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size = 'large';
			 }
			break;
		case 'large-media':
		default:
			$image_size = 'grve-image-large-rect-horizontal';
			if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'grve-image-fullscreen';
			}
			break;
	}
	$grve_link = get_permalink();
	$grve_target = '_self';

	if ( ( '' == $post_format || 'image' == $post_format || 'yes' == $blog_image_prio ) &&  has_post_thumbnail( $post_id ) ) {

		if ( 'link' == get_post_format() ) {
			$grve_link = get_post_meta( $post_id, 'grve_post_link_url', true );
			$new_window = get_post_meta( $post_id, 'grve_post_link_new_window', true );
			if( empty( $grve_link ) ) {
				$grve_link = get_permalink();
			}
			if( !empty( $new_window ) ) {
				$grve_target = '_blank';
			}
		}
?>
		<div class="grve-media grve-image-hover">
			<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
		</div>
<?php

	} else if ( 'audio' == $post_format ) {

		$audio_mode = get_post_meta( $post_id, 'grve_post_type_audio_mode', true );
		$audio_mp3 = get_post_meta( $post_id, 'grve_post_audio_mp3', true );
		$audio_ogg = get_post_meta( $post_id, 'grve_post_audio_ogg', true );
		$audio_wav = get_post_meta( $post_id, 'grve_post_audio_wav', true );
		$audio_embed = get_post_meta( $post_id, 'grve_post_audio_embed', true );

		if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
			$audio_output = '';
			$audio_output .= '<div class="grve-media">';
			$audio_output .= $audio_embed;
			$audio_output .= '</div>';
			echo $audio_output;
		} else {

			if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {

				$audio_output = '[audio ';

				if ( !empty( $audio_mp3 ) ) {
					$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
				}
				if ( !empty( $audio_ogg ) ) {
					$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
				}
				if ( !empty( $audio_wav ) ) {
					$audio_output .= 'wav="'. esc_url ( $audio_wav ) .'" ';
				}

				$audio_output .= ']';

				echo '<div class="grve-media">';
				echo  do_shortcode( $audio_output );
				echo '</div>';

			}
		}
	} else if ( 'video' == $post_format ) {

		$video_mode = get_post_meta( $post_id, 'grve_post_type_video_mode', true );
		$video_webm = get_post_meta( $post_id, 'grve_post_video_webm', true );
		$video_mp4 = get_post_meta( $post_id, 'grve_post_video_mp4', true );
		$video_ogv = get_post_meta( $post_id, 'grve_post_video_ogv', true );
		$video_embed = get_post_meta( $post_id, 'grve_post_video_embed', true );

		$video_output = '';

		if( empty( $video_mode ) && !empty( $video_embed ) ) {
			$video_output .= '<div class="grve-media">';
			$video_output .= $wp_embed->run_shortcode( '[embed]' . $video_embed . '[/embed]' );
			$video_output .= '</div>';
		} else {

			if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {

				$video_settings = array(
					'controls' => 'yes',
				);

				$video_settings = apply_filters( 'grve_media_video_settings', $video_settings, 'post' );
				if ( function_exists( 'grve_print_media_video_settings' ) ) {
					$video_attr = grve_print_media_video_settings( $video_settings );
				} else {
					$video_attr = ' controls';
				}

				$video_output .= '<div class="grve-media">';
				$video_output .= '  <video ' . $video_attr . '>';

				if ( !empty( $video_webm ) ) {
					$video_output .= '<source src="' . esc_url( $video_webm ) . '" type="video/webm">';
				}
				if ( !empty( $video_mp4 ) ) {
					$video_output .= '<source src="' . esc_url( $video_mp4 ) . '" type="video/mp4">';
				}
				if ( !empty( $video_ogv ) ) {
					$video_output .= '<source src="' . esc_url( $video_ogv ) . '" type="video/ogg">';
				}
				$video_output .='  </video>';
				$video_output .= '</div>';

			}
		}
		echo  $video_output;
	} else if ( 'gallery' == $post_format ) {

		$slider_items = get_post_meta( $post_id, 'grve_post_slider_items', true );

		$gallery_mode = get_post_meta( $post_id, 'grve_post_type_gallery_mode', true );
		if ( empty( $gallery_mode ) ) {
			$gallery_mode = 'gallery';
		} else {
			$gallery_mode = 'slider';
		}

		if ( !empty( $slider_items ) ) {
			grve_osmosis_vce_print_gallery_slider( $gallery_mode, $slider_items, $image_size  );
		}

	}

}

 /**
 * Prints Gallery or Slider
 */
function grve_osmosis_vce_print_gallery_slider( $gallery_mode, $slider_items, $image_size_slider ) {

	$image_size_gallery_thumb = 'grve-image-small-square';

	if ( $gallery_mode == 'gallery' ) {

?>
	<div class="grve-media">
		<ul class="grve-post-gallery grve-post-gallery-popup">
<?php
	foreach ( $slider_items as $slider_item ) {

		$media_id = $slider_item['id'];
		$full_src = wp_get_attachment_image_src( $media_id, 'full' );
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
?>
		<div class="grve-media">
			<div class="grve-element grve-carousel-wrapper">
				<div class="grve-carousel-navigation grve-dark" data-navigation-type="2">
					<div class="grve-carousel-buttons">
						<div class="grve-carousel-prev grve-icon-nav-left"></div>
						<div class="grve-carousel-next grve-icon-nav-right"></div>
					</div>
				</div>
				<div class="grve-slider grve-carousel-element " data-slider-speed="2500" data-slider-pause="yes" data-slider-autoheight="no">
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
 * Prints post categories depending on the blog style
 */
function grve_osmosis_vce_print_post_categories( $grve_blog_style = 'large-media' ) {

	$show_categories = false;
	if ( is_singular() ) {
		$show_categories = true;
	} else {
		switch( $grve_blog_style ) {

			case 'small-media':
			case 'large-media':
			default:
				$show_categories = true;
				break;
		}
	}

	if ( $show_categories ) {
		$in_categories_string =  apply_filters( 'grve_vce_blog_string_categories_in', __( 'in', 'grve-osmosis-vc-extension' ) );
?>
		<span class="grve-post-categories">
			<?php echo $in_categories_string . ' '; ?><?php the_category(', '); ?>
		</span>
<?php

	}

}

 /**
 * Prints post date
 */
function grve_osmosis_vce_print_post_date() {
?>
	<time class="grve-post-date" datetime="<?php the_time('c'); ?>">
		<?php echo get_the_date(); ?>
	</time>
<?php
}

 /**
 * Prints post date meta
 */
function grve_osmosis_vce_print_post_date_meta() {
?>
	<meta itemprop="datePublished" content="<?php the_time('c'); ?>"/>
<?php
}

 /**
 * Prints post comments
 */
function grve_osmosis_vce_print_post_comments() {
?>
	<div class="grve-post-comments grve-small-text">
		<span class="grve-icon-comment"></span> <?php comments_number( '0' , '1', '%' ); ?>
	</div>
<?php
}

 /**
 * Prints post author avatar
 */
function grve_osmosis_vce_print_post_author( $grve_blog_style, $post_format ) {
	if ( 'large-media' == $grve_blog_style ) {
		if ( 'quote' != $post_format && 'link' != $post_format ) {
?>
	<div class="grve-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
	</div>
<?php
		}
	}
}

 /**
 * Prints post author by depending on the blog style
 */
function grve_osmosis_vce_print_post_author_by( $grve_blog_style = 'large-media' ) {

	switch( $grve_blog_style ) {

		case 'small-media':
		case 'large-media':
		case 'masonry':
		case 'grid':
			$show_author_by = true;
			break;
		default:
			$show_author_by = false;
			break;
	}
	if( function_exists( 'grve_visibility' ) && !grve_visibility( 'blog_author_visibility', '1' ) ) {
		$show_author_by = false;
	}


	if ( $show_author_by ) {
		$author_by_string =  apply_filters( 'grve_vce_blog_string_by_author', __( 'By', 'grve-osmosis-vc-extension' ) );
?>
		<div class="grve-post-author">
			<span><?php echo $author_by_string . ' '; ?></span><span><?php the_author_posts_link(); ?></span>
		</div>
<?php

	}

}

 /**
 * Prints blog data depending on the blog style
 */
function grve_osmosis_vce_print_blog_data( $grve_blog_style, $grve_columns = "4", $item_spinner = 'no' ) {
	$data = '';

	switch( $grve_blog_style ) {

		case 'masonry':
			$data .= 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="masonry" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;

		case 'grid':
			$data .= 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="fitRows" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;

		case 'large-media':
		case 'small-media':
		default:
			$data .= '';
			break;
	}

	echo $data;

}

/**
 * Gets post class depending on the blog style
 */
function grve_osmosis_vce_get_post_class( $grve_blog_style = 'large-media', $extra_class = '' ) {

	$post_classes = array( 'grve-blog-item' );
	if ( !empty( $extra_class ) ){
		array_push( $post_classes, $extra_class );
	}

	switch( $grve_blog_style ) {

		case 'large-media':
			array_push( $post_classes, 'grve-big-post' );
			array_push( $post_classes, 'grve-non-isotope-item' );
			break;

		case 'small-media':
			array_push( $post_classes, 'grve-small-post' );
			array_push( $post_classes, 'grve-non-isotope-item' );
			break;

		case 'masonry':
		case 'grid':
			array_push( $post_classes, 'grve-isotope-item' );
			break;

		default:
			break;

	}

	return implode( ' ', $post_classes );

}

function grve_osmosis_vce_get_image_size( $image_mode ) {

	switch( $image_mode ) {
		case 'thumbnail':
			$image_size = 'thumbnail';
		break;
		case 'medium':
			$image_size = 'medium';
		break;
		case 'medium_large':
			$image_size = 'medium_large';
		break;
		case 'large':
			$image_size = 'large';
		break;
		case 'square':
			$image_size = 'grve-image-small-square';
		break;
		case 'landscape':
			$image_size = 'grve-image-small-rect-horizontal';
		break;
		case 'landscape-medium':
			$image_size = 'grve-image-medium-rect-horizontal';
		break;
		case 'square-medium':
			$image_size = 'grve-image-medium-square';
		break;
		case 'portrait-medium':
			$image_size = 'grve-image-medium-rect-vertical';
		break;
		case 'landscape-large-wide':
			$image_size = 'grve-image-large-rect-horizontal';
		break;
		case 'fullscreen':
		case 'extra-extra-large':
			$image_size = 'grve-image-fullscreen';
		break;
		default:
			$image_size = 'full';
		break;
	}

	return $image_size;

}

function grve_osmosis_vce_get_packery_data( $index, $columns ) {

	$image_size_class = "grve-packery-image";
	$image_size = 'grve-image-small-square';

	if( '2' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 6  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
	}

	if( '3' == $columns ) {

		if ( $index % 3  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}
		if ( $index % 12  == 0 ) {
			$image_size_class = "grve-packery-image";
			$image_size = 'grve-image-small-square';
		}
	}

	else if( '4' == $columns ) {

		if ( $index % 8  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 9  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}

	}

	else if( '5' == $columns ) {

		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}

		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}
		if ( $index % 3  == 0 ) {
			$image_size_class = "grve-packery-h2-w2";
			$image_size = 'grve-image-medium-square';
		}

		if ( $index % 7  == 0 ) {
			$image_size_class = "grve-packery-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}

		if ( $index % 8  == 0 ) {
			$image_size_class = "grve-packery-w2";
			$image_size = 'grve-image-medium-rect-horizontal';
		}

	}

	return array(
		'class' => $image_size_class,
		'image_size' => $image_size,
	);
}

function grve_osmosis_vce_get_masonry_data( $index, $columns ) {

	$image_size_class = "grve-masonry-image";
	$image_size = 'grve-image-small-square';

	if( '2' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
	}

	if( '3' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-image";
			$image_size = 'grve-image-small-square';
		}
		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}
	}

	if( '4' == $columns ) {

		if ( $index % 2  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}

	}

	if( '5' == $columns ) {

		if ( $index % 4  == 0 ) {
			$image_size_class = "grve-masonry-w2";
			$image_size = 'grve-image-small-rect-horizontal';
		}

		if ( $index % 5  == 0 ) {
			$image_size_class = "grve-masonry-h2";
			$image_size = 'grve-image-medium-rect-vertical';
		}
	}

	return array(
		'class' => $image_size_class,
		'image_size' => $image_size,
	);
}

/**
 * Prints post structured data
 */
function osmosis_ext_vce_print_structured_data() {
	if( function_exists( 'osmosis_grve_print_post_structured_data' ) ) {
		osmosis_grve_print_post_structured_data();
	}
}


function osmosis_ext_browser_webkit_check() {

	if ( empty($_SERVER['HTTP_USER_AGENT'] ) ) {
		return false;
	}

	$u_agent = $_SERVER['HTTP_USER_AGENT'];

	if (
		( preg_match( '!linux!i', $u_agent ) || preg_match( '!windows|win32!i', $u_agent ) ) && preg_match( '!webkit!i', $u_agent )
	) {
		return true;
	}

	return false;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
