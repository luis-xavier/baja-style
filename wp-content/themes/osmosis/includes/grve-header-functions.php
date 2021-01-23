<?php

/*
*	Header Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

 /**
 * Get Logo Data
 */
function grve_get_logo_data( $logo_id, $retina_logo_id, $fallback_logo_url = '', $fallback_logo_data = array() ) {

	$logo_url = grve_option( $logo_id, '', 'url' );

	$logo_attributes = array();

	if ( empty( $logo_url ) ) {
		$logo_url = $fallback_logo_url;
		$logo_attributes = $fallback_logo_data;
	} else {
		$logo_url = str_replace( array( 'http:', 'https:' ), '', $logo_url );
		$retina_logo = grve_option( $retina_logo_id, '' , 'url' );
		if ( !empty( $retina_logo ) ) {
			$retina_logo = str_replace( array( 'http:', 'https:' ), '', $retina_logo );
			$logo_attributes[] = 'data-at2x="' . esc_attr( $retina_logo ) . '"';
		} else {
			$logo_attributes[] = 'data-no-retina=""';
		}
		$logo_width = grve_option( $logo_id, '', 'width' );
		$logo_height = grve_option( $logo_id, '', 'height' );
		if ( !empty( $logo_width ) && !empty( $logo_height ) ) {
			$logo_attributes[] = 'width="' . esc_attr( $logo_width ) . '"';
			$logo_attributes[] = 'height="' . esc_attr( $logo_height ) . '"';
			$logo_attributes[] = 'style="height:' . esc_attr( $logo_height + 10 ) . 'px;"';
		}
	}

	return array(
		'url' => $logo_url,
		'data' => $logo_attributes,
	);

}

 /**
 * Prints Header Logos
 */
if ( !function_exists('grve_print_header_logo') ) {

	function grve_print_header_logo( $mode = '') {

		$grve_disable_logo = '';
		if ( is_singular() ) {
			$grve_disable_logo = grve_post_meta( 'grve_disable_logo' );
		} else if( grve_is_woo_shop() ) {
			$grve_disable_logo = grve_post_meta_shop( 'grve_disable_logo' );
		}

		if ( 'yes' != $grve_disable_logo ) {

			$logo_custom_link_url = grve_option( 'logo_custom_link_url' );
			$logo_link_url = home_url( '/' );
			if( !empty( $logo_custom_link_url ) ) {
				$logo_link_url = $logo_custom_link_url;
			}

			$logo_extra_class = '';

			if( 'responsive' == $mode ) {
				$logo_extra_class = 'grve-responsive-logo';
			}

			if ( grve_visibility( 'logo_as_text_enabled' ) ) {
	?>
			<div class="grve-logo grve-logo-text <?php echo esc_attr( $logo_extra_class ); ?>">
				<a href="<?php echo esc_url( $logo_link_url ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
			</div>
	<?php
			} else {
	?>
			<div class="grve-logo <?php echo esc_attr( $logo_extra_class ); ?>">
	<?php
				$grve_default_logo = grve_option( 'logo','','url' );
				if ( !empty( $grve_default_logo ) ) {
					$grve_logo = grve_get_logo_data( 'logo', 'retina_logo' );
					$grve_logo_dark = grve_get_logo_data( 'logo_dark', 'retina_logo_dark', $grve_logo['url'], $grve_logo['data'] );
					$grve_logo_light = grve_get_logo_data( 'logo_light', 'retina_logo_light', $grve_logo['url'], $grve_logo['data'] );
					$grve_logo_sticky = grve_get_logo_data( 'logo_sticky', 'retina_logo_sticky', $grve_logo['url'], $grve_logo['data'] );

					$grve_logo = apply_filters( 'grve_header_logo', $grve_logo );
					$grve_logo_dark = apply_filters( 'grve_header_logo_dark', $grve_logo_dark );
					$grve_logo_light = apply_filters( 'grve_header_logo_light', $grve_logo_light );
					$grve_logo_sticky = apply_filters( 'grve_header_logo_sticky', $grve_logo_sticky );
	?>
				<a class="grve-default" href="<?php echo esc_url( $logo_link_url ); ?>"><img src="<?php echo esc_url( $grve_logo['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php echo implode( ' ', $grve_logo['data'] ); ?>></a>
				<a class="grve-dark" href="<?php echo esc_url( $logo_link_url ); ?>"><img src="<?php echo esc_url( $grve_logo_dark['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php echo implode( ' ', $grve_logo_dark['data'] ); ?>></a>
				<a class="grve-light" href="<?php echo esc_url( $logo_link_url ); ?>"><img src="<?php echo esc_url( $grve_logo_light['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php echo implode( ' ', $grve_logo_light['data'] ); ?>></a>
				<a class="grve-sticky" href="<?php echo esc_url( $logo_link_url ); ?>"><img src="<?php echo esc_url( $grve_logo_sticky['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php echo implode( ' ', $grve_logo_sticky['data'] ); ?>></a>
	<?php
				}
	?>
				<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</div>
	<?php
			}
		}
	}
}

 /**
 * Prints correct title/subtitle for all cases
 */
function grve_header_title() {
	global $post;
	$page_title = $page_description = $page_reversed = '';

	//Shop
	if( grve_woocommerce_enabled() && is_shop() && !is_search() ) {

		$post_id = wc_get_page_id( 'shop' );
		$page_title   = get_the_title( $post_id );
		$page_description = get_post_meta( $post_id, 'grve_page_description', true );
		return array(
			'title' => $page_title,
			'description' => $page_description,
		);
	}
	//Events Calendar Overview Pages
	if ( grve_events_calendar_is_overview() ) {
		return array(
			'title' => tribe_get_events_title( true ),
			'description' => '',
		);
	}

	//Main Pages
	if ( is_front_page() && is_home() ) {
		// Default homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
		if ( 'custom' === grve_option( 'blog_title' ) ) {
			$page_title = grve_option( 'blog_custom_title' );
			$page_description = grve_option( 'blog_custom_description' );
		}
	} else if ( is_front_page() ) {
		// static homepage
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	} else if ( is_home() ) {
		// blog page
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
		if ( 'custom' === grve_option( 'blog_title' ) ) {
			$page_title = grve_option( 'blog_custom_title' );
			$page_description = grve_option( 'blog_custom_description' );
		}
	} else if( is_search() ) {
		$page_description = __( 'Search Results for :', 'osmosis' );
		$page_title = esc_attr( get_search_query() );
		$page_reversed = 'reversed';
	} else if ( is_singular() ) {
		$post_id = $post->ID;
		$post_type = get_post_type( $post_id );
		//Single Post
		if ( $post_type == 'page' && is_singular( 'page' ) ) {
			$page_title = get_the_title();
			$page_description = get_post_meta( $post_id, 'grve_page_description', true );
		} else if ( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) {
			$page_title = get_the_title();
			$page_description = get_post_meta( $post_id, 'grve_portfolio_description', true );
		} else if ( grve_events_calendar_enabled() && $post_type == 'tribe_events' && is_singular( 'tribe_events' ) ) {
			$page_title = get_the_title();
			$page_description = tribe_events_event_schedule_details( $post_id, '', '' );
			if ( tribe_get_cost() ) {
				$page_description .= '<span class="grve-event-cost grve-bg-primary-1">' . tribe_get_cost( null, true ) . '</span>';
			}
		} else if ( grve_events_calendar_enabled() && $post_type == 'tribe_organizer' && is_singular( 'tribe_organizer' ) ) {
			$page_title = get_the_title();
			$page_description = grve_event_organizer_title_meta();
		} else {
			$page_title = get_the_title();
		}

	} else if ( is_archive() ) {
		//Post Categories
		if ( is_category() ) {
			$page_title = single_cat_title("", false);
			$page_description = category_description();
		} else if ( is_tag() ) {
			$page_description = __( "Posts Tagged :", 'osmosis' );
			$page_title = single_tag_title("", false);
			$page_reversed = 'reversed';
		} else if ( is_tax() ) {
			$page_title = single_term_title("", false);
			$page_description = term_description();
		} else if ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			$page_description = __( "Posts By :", 'osmosis' );
			$page_title = $userdata->display_name;
			$page_reversed = 'reversed';
		} else if ( is_day() ) {
			$page_description = __( "Daily Archives :", 'osmosis' );
			$page_title = get_the_time( 'l, F j, Y' );
			$page_reversed = 'reversed';
		} else if ( is_month() ) {
			$page_description = __( "Monthly Archives :", 'osmosis' );
			$page_title = get_the_time( 'F Y' );
			$page_reversed = 'reversed';
		} else if ( is_year() ) {
			$page_description = __( "Yearly Archives :", 'osmosis' );
			$page_title = get_the_time( 'Y' );
			$page_reversed = 'reversed';
		} else {
			$page_title = __( "Archives", 'osmosis' );
		}
	} else {
		$page_title = get_bloginfo( 'name' );
		$page_description = get_bloginfo( 'description' );
	}

	return array(
		'title' => $page_title,
		'description' => $page_description,
		'reversed' => $page_reversed,
	);


}

 /**
 * Check title visibility
 */
if ( !function_exists( 'grve_check_title_visibility' ) ) {
	function grve_check_title_visibility() {

		$blog_title = grve_option( 'blog_title', 'sitetitle' );

		if ( is_front_page() && is_home() ) {
			// Default homepage
			if ( 'none' == $blog_title ) {
				return false;
			}
		} elseif ( is_front_page() ) {
			// static homepage
			if ( 'yes' == grve_post_meta( 'grve_disable_title' ) ) {
				return false;
			}
		} elseif ( is_home() ) {
			// blog page
			if ( 'none' == $blog_title ) {
				return false;
			}
		} else {
			if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_title' ) ) {
				return false;
			}
			if( grve_woocommerce_enabled() ) {
				// Product / Disabled Title in Shop
				if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_title' ) ) {
					return false;
				} else {
					if ( is_product() ) {
						return grve_visibility( 'product_title_visibility' );
					}
					if( is_product_category() || is_product_tag() ) {
						return grve_visibility( 'product_tax_title_visibility' );
					}
				}
			}
		}

		return true;

	}
}

/**
 * Prints Title Background Image Container
 */
function grve_print_title_bg_image_container( $bg_image, $grve_custom_bg = array() ) {

	$bg_mode = grve_array_value( $grve_custom_bg, 'mode' );
	if ( !empty( $bg_mode ) ) {
		$bg_position = grve_array_value( $grve_custom_bg, 'position', 'center-center' );
		$bg_image = grve_array_value( $grve_custom_bg, 'image' );
	}
	if ( 'featured' == $bg_mode && has_post_thumbnail() ) {
		$media_id = get_post_thumbnail_id();
		$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
		$image_url = esc_url( $full_src[0] );
	} else if ( 'custom' == $bg_mode && !empty( $bg_image ) ) {
		$image_url = $bg_image;
	} else {
		$media = grve_option( $bg_image, '', 'media' );
		if( isset( $media['id'] ) && !empty( $media['id'] ) ) {
			$media_id = $media['id'];
			$bg_position = grve_option( $bg_image, 'center center', 'background-position' );
			$bg_position = str_replace( " ", "-", $bg_position );
			$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
			$image_url = esc_url( $full_src[0] );
		}
	}

	if( !empty( $image_url ) ) {
		echo '<div class="grve-bg-image grve-bg-position-' . esc_attr( $bg_position ) . '" style="background-image: url(' . $image_url . ');"></div>';
	}

}

 /**
 * Prints title/subtitle ( Page )
 */
if ( !function_exists( 'grve_print_header_title' ) ) {
	function grve_print_header_title( $mode = '') {

		if ( grve_check_title_visibility() ) {

			$page_title_extra_class = '';
			$header_data = grve_header_title();

			if ( 'blog' == $mode ) {
				$page_title_height = grve_option( 'blog_title_height', '350' );
				$page_title_alignment = grve_option( 'blog_title_alignment', 'center' );
				$page_title_color = grve_option( 'blog_title_color', 'light' );
				$page_description_color = grve_option( 'blog_description_color', 'light' );
				$page_title_extra_class = 'grve-blog-title';
				$bg_image = 'blog_title_background';

			} elseif ( 'event-tax' == $mode ) {
				$page_title_height = grve_option( 'event_tax_title_height', '350' );
				$page_title_alignment = grve_option( 'event_tax_title_alignment', 'center' );
				$page_title_color = grve_option( 'event_tax_title_color', 'light' );
				$page_description_color = grve_option( 'event_tax_description_color', 'light' );
				$page_title_extra_class = 'grve-event-tax-title';
				$bg_image = 'event_tax_title_background';

			} elseif ( 'event' == $mode ) {
				$page_title_height = grve_option( 'event_title_height', '350' );
				$page_title_alignment = grve_option( 'event_title_alignment', 'center' );
				$page_title_color = grve_option( 'event_title_color', 'light' );
				$page_description_color = grve_option( 'event_description_color', 'light' );
				$page_title_extra_class = 'grve-event-title';
				$bg_image = 'event_title_background';

			} elseif ( 'forum' == $mode ) {
				$page_title_height = grve_option( 'forum_title_height', '350' );
				$page_title_alignment = grve_option( 'forum_title_alignment', 'center' );
				$page_title_color = grve_option( 'forum_title_color', 'light' );
				$page_description_color = grve_option( 'forum_description_color', 'light' );
				$page_title_extra_class = 'grve-forum-title';
				$bg_image = 'forum_title_background';
				$header_data['description'] = '';
				if ( !is_singular() ) {
					$header_data['title'] = __( 'Forums' , 'osmosis' );
				}
				if ( function_exists('bbp_is_single_user_edit') && (bbp_is_single_user_edit() || bbp_is_single_user() ) ) {
					$user_info = get_userdata( bbp_get_displayed_user_id() );
					$header_data['title'] = __("Profile for User:", 'osmosis' ) . " " . $user_info->display_name;
					if ( bbp_is_single_user_edit() ) {
						$header_data['title'] = __("Edit profile for User:", 'osmosis' ) . " " . $user_info->display_name;
					}
				}
			} else {
				$page_title_height = grve_option( 'page_title_height', '350' );
				$page_title_alignment = grve_option( 'page_title_alignment', 'center' );
				$page_title_color = grve_option( 'page_title_color', 'light' );
				$page_description_color = grve_option( 'page_description_color', 'light' );
				$bg_image = 'page_title_background';
			}


			$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';
			$header_description = isset( $header_data['description'] ) ? $header_data['description'] : '';
			$header_reversed = isset( $header_data['reversed'] ) ? $header_data['reversed'] : '';

			$page_title_tag = apply_filters( 'grve_page_title_tag', 'h1' );

	?>
		<!-- Page Title -->
		<div id="grve-page-title" class="grve-page-title grve-align-<?php echo esc_attr( $page_title_alignment ); ?> <?php echo esc_attr( $page_title_extra_class ); ?>" style="height:<?php echo esc_attr( $page_title_height ); ?>px;">
			<div id="grve-page-title-content" class="grve-page-title-content" data-height="<?php echo esc_attr( $page_title_height ); ?>">
				<?php do_action( 'grve_page_title_top' ); ?>
				<div class="grve-container">
					<?php if ( empty( $header_reversed ) ) { ?>
						<<?php echo tag_escape( $page_title_tag ); ?>  class="grve-title grve-<?php echo esc_attr( $page_title_color ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></<?php echo tag_escape( $page_title_tag ); ?>>
						<?php if ( !empty( $header_description ) ) { ?>
						<div class="grve-description grve-<?php echo esc_attr( $page_description_color ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
						<?php } ?>
					<?php } else { ?>
						<?php if ( !empty( $header_description ) ) { ?>
						<div class="grve-description grve-<?php echo esc_attr( $page_description_color ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
						<?php } ?>
						<<?php echo tag_escape( $page_title_tag ); ?> class="grve-title grve-<?php echo esc_attr( $page_title_color ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></<?php echo tag_escape( $page_title_tag ); ?>>
					<?php } ?>
				</div>
				<?php do_action( 'grve_page_title_bottom' ); ?>
			</div>
			<?php grve_print_title_bg_image_container( $bg_image ); ?>
		</div>
		<!-- End Page Title -->
	<?php
		}
	}
}

 /**
 * Prints title/subtitle ( Portfolio )
 */
if ( !function_exists( 'grve_print_portfolio_header_title' ) ) {
	function grve_print_portfolio_header_title( $position = 'top' ) {

		if ( grve_check_title_visibility() ) {

			$portfolio_style = grve_option( 'portfolio_style', 'default' );
			if ( 'simple' == $portfolio_style ) {
	?>
				<!-- Post Title -->
				<h1 class="grve-portfolio-simple-title"><span><?php the_title(); ?></span></h1>
				<!-- End Post Title -->
	<?php
			} else {
				if ( 'content' != $position ) {
					$page_title_height = grve_option( 'portfolio_title_height', '350' );
					$page_title_alignment = grve_option( 'portfolio_title_alignment', 'left' );
					$page_title_color = grve_option( 'portfolio_title_color', 'light' );
					$page_description_color = grve_option( 'portfolio_description_color', 'light' );
					$bg_image = 'portfolio_title_background';

					$header_data = grve_header_title();
					$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';
					$header_description = isset( $header_data['description'] ) ? $header_data['description'] : '';
	?>
				<!-- Portfolio Title -->
				<div id="grve-portfolio-title" class="grve-page-title grve-align-<?php echo esc_attr( $page_title_alignment ); ?>" style="height:<?php echo esc_attr( $page_title_height ); ?>px;">
					<div id="grve-portfolio-title-content" class="grve-page-title-content" data-height="<?php echo esc_attr( $page_title_height ); ?>">
						<?php do_action( 'grve_portfolio_title_top' ); ?>
						<div class="grve-container">
							<h1 class="grve-title grve-<?php echo esc_attr( $page_title_color ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></h1>
							<?php if ( !empty( $header_description ) ) { ?>
							<div class="grve-description grve-<?php echo esc_attr( $page_description_color ); ?>"><?php echo wp_kses_post( $header_description ); ?></div>
							<?php } ?>
						</div>
						<?php do_action( 'grve_portfolio_title_bottom' ); ?>
					</div>
					<?php grve_print_title_bg_image_container( $bg_image ); ?>
				</div>
				<!-- End Portfolio Title -->
	<?php
				}
			}
		}
	}
}

 /**
 * Prints title/subtitle ( Post )
 */
if ( !function_exists( 'grve_print_post_header_title' ) ) {
	function grve_print_post_header_title( $position = 'top' ) {

		if ( grve_check_title_visibility() ) {

			$post_title_height = grve_option( 'post_title_height', '350' );
			$post_title_color = grve_option( 'post_title_color', 'light' );
			$post_style = grve_option( 'post_style', 'default' );
			$bg_image = 'post_title_background';

			if ( 'simple' == $post_style ) {
	?>
				<!-- Post Title -->
				<h1 class="grve-post-simple-title" itemprop="name headline"><span><?php the_title(); ?></span></h1>
				<!-- End Post Title -->
	<?php
			} else {
				if ( 'content' != $position ) {
					global $post;
					$grve_post_title_bg = get_post_meta( $post->ID, 'grve_post_title_bg', true );
					$bg_mode = grve_array_value( $grve_post_title_bg, 'mode' );
					if ( !empty( $bg_mode ) ) {
						$post_title_height = grve_array_value( $grve_post_title_bg, 'height', '350' );
					}
	?>
				<!-- Post Title -->
				<div id="grve-post-title" class="grve-page-title grve-align-center" style="height:<?php echo esc_attr( $post_title_height ); ?>px;">
					<div id="grve-post-title-content" class="grve-page-title-content" data-height="<?php echo esc_attr( $post_title_height ); ?>">
						<?php do_action( 'grve_post_title_top' ); ?>
						<div class="grve-container">
							<h1 class="grve-title grve-<?php echo esc_attr( $post_title_color ); ?>" itemprop="name headline"><span><?php the_title(); ?></span></h1>
							<?php
								if ( 'default' == $post_style ) {
									grve_print_post_social( $post_title_color );
								}
							?>
						</div>
						<?php do_action( 'grve_post_title_bottom' ); ?>
					</div>
					<?php grve_print_title_bg_image_container( $bg_image, $grve_post_title_bg ); ?>
				</div>
				<!-- End Post Title -->
	<?php
				}
			}
		} else {
	?>
			<h2 class="grve-hidden" itemprop="name headline"><span><?php the_title(); ?></span></h2>
	<?php
		}
	}
}

 /**
 * Prints title( WooCommerce Product )
 */
if ( !function_exists( 'grve_print_product_header_title' ) ) {
	function grve_print_product_header_title( $mode = '') {

		$page_title_extra_class = '';

		if ( grve_check_title_visibility() ) {

			if ( 'taxonomy' == $mode ) {
				$page_title_height = grve_option( 'product_tax_title_height', '350' );
				$page_title_alignment = grve_option( 'product_tax_title_alignment', 'center' );
				$page_title_color = grve_option( 'product_tax_title_color', 'light' );
				$page_title_extra_class = 'grve-product-tax-title';
				$bg_image = 'product_tax_title_background';
			} else {
				$page_title_height = grve_option( 'product_title_height', '350' );
				$page_title_alignment = grve_option( 'product_title_alignment', 'center' );
				$page_title_color = grve_option( 'product_title_color', 'light' );
				$bg_image = 'product_title_background';
			}

			$header_data = grve_header_title();
			$header_title = isset( $header_data['title'] ) ? $header_data['title'] : '';

	?>
		<!-- Product Title -->
		<div id="grve-product-title" class="grve-page-title grve-align-<?php echo esc_attr( $page_title_alignment ); ?> <?php echo esc_attr( $page_title_extra_class ); ?>" style="height:<?php echo esc_attr( $page_title_height ); ?>px;">
			<div id="grve-product-title-content" class="grve-page-title-content" data-height="<?php echo esc_attr( $page_title_height ); ?>">
				<?php do_action( 'grve_product_title_top' ); ?>
				<div class="grve-container">
					<h1 class="grve-title grve-<?php echo esc_attr( $page_title_color ); ?>"><span><?php echo wp_kses_post( $header_title ); ?></span></h1>
				</div>
				<?php do_action( 'grve_product_title_bottom' ); ?>
			</div>
			<?php grve_print_title_bg_image_container( $bg_image ); ?>
		</div>
		<!-- End Product Title -->
	<?php
		}
	}
}

/**
 * Prints header top bar text
 */
function grve_print_header_top_bar_text( $text ) {
	if ( !empty( $text ) ) {
?>
		<li class="grve-topbar-item grve-top-bar-text"><p><?php echo do_shortcode( $text ); ?></p></li>
<?php
	}
}

/**
 * Prints header top bar navigation
 */
function grve_print_header_top_bar_nav( $position = 'left' ) {
?>
	<li class="grve-topbar-item">
		<nav class="grve-top-bar-menu grve-small-text">
			<?php
				if( 'left' == $position ) {
					grve_top_left_nav();
				} else {
					grve_top_right_nav();
				}
			?>
		</nav>
	</li>
<?php
}

/**
 * Prints header top bar options
 */
function grve_print_header_top_bar_options( $options ) {

	if ( !empty( $options ) ) {
?>
		<li class="grve-topbar-item">
			<ul class="grve-options">
				<?php if ( isset( $options['search'] ) && 1 == $options['search'] ) { ?>
				<li><a href="#grve-search-modal" class="grve-icon-search grve-open-popup-link"></a></li>
				<?php } ?>
				<?php if ( isset( $options['newsletter'] ) && 1 == $options['newsletter'] ) { ?>
				<li><a href="#grve-newsletter-modal" class="grve-icon-envelope grve-open-popup-link"></a></li>
				<?php } ?>
			</ul>
		</li>
<?php
	}

}
/**
 * Prints header top bar socials
 */
function grve_print_header_top_bar_socials( $options ) {

	$social_options = grve_option('social_options');
	if ( !empty( $options ) && !empty( $social_options ) ) {
		?>
			<li class="grve-topbar-item">
				<ul class="grve-social">
		<?php
		foreach ( $social_options as $key => $value ) {
			if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
				if ( 'skype' == $key ) {
					echo '<li><a href="' . $value . '" class="grve-icon-' . esc_attr( $key ) . '"></a></li>';
				} else {
					echo '<li><a href="' . esc_url( $value ) . '" target="_blank" rel="noopener noreferrer" class="grve-icon-' . esc_attr( $key ) . '"></a></li>';
				}
			}
		}
		?>
				</ul>
			</li>
		<?php
	}

}

/**
 * Prints header top bar language selector
 */
function grve_print_header_top_bar_language_selector() {

	//start language selector output buffer
    ob_start();


	$skip_missing = grve_option('language_switcher_skip_missing', '0' );
	$skip_missing = intval( $skip_missing );

	$languages = '';

	//Polylang
	if( function_exists( 'pll_the_languages' ) ) {
		$languages = pll_the_languages( array( 'raw'=>1, 'hide_if_no_translation' => $skip_missing ) );

		$lang_option_current = $lang_options = '';

		foreach ( $languages as $l ) {

			if ( !$l['current_lang'] ) {
				$lang_options .= '<li>';
				$lang_options .= '<a href="' . $l['url'] . '" class="grve-language-item">';
				$lang_options .= '<img src="' . $l['flag'] . '" alt="' . $l['name'] . '"/>';
				$lang_options .= $l['name'];
				$lang_options .= '</a>';
				$lang_options .= '</li>';
			} else {
				$lang_option_current .= '<a href="#" class="grve-language-item">';
				$lang_option_current .= '<img src="' . $l['flag'] . '" alt="' . $l['name'] . '"/>';
				$lang_option_current .= $l['name'];
				$lang_option_current .= '</a>';
			}
		}

	}

	//WPML
	if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {

		$languages = icl_get_languages( 'skip_missing=' . $skip_missing );
		if ( ! empty( $languages ) ) {

			$lang_option_current = $lang_options = '';

			foreach ( $languages as $l ) {

				if ( !$l['active'] ) {
					$lang_options .= '<li>';
					$lang_options .= '<a href="' . $l['url'] . '" class="grve-language-item">';
					$lang_options .= '<img src="' . $l['country_flag_url'] . '" alt="' . $l['language_code'] . '"/>';
					$lang_options .= $l['native_name'];
					$lang_options .= '</a>';
					$lang_options .= '</li>';
				} else {
					$lang_option_current .= '<a href="#" class="grve-language-item">';
					$lang_option_current .= '<img src="' . $l['country_flag_url'] . '" alt="' . $l['language_code'] . '"/>';
					$lang_option_current .= $l['native_name'];
					$lang_option_current .= '</a>';
				}
			}
		}
	}
	if ( ! empty( $languages ) ) {

?>
	<li class=" grve-topbar-item">
		<ul class="grve-language">
			<li>
				<?php echo wp_kses_post( $lang_option_current ); ?>
				<ul>
					<?php echo wp_kses_post( $lang_options ); ?>
				</ul>
			</li>
		</ul>
	</li>
<?php
	}
	//store the language selector buffer and clean
	$grve_lang_selector_out = ob_get_clean();
	echo apply_filters( 'grve_header_top_bar_language_selector', $grve_lang_selector_out );
}


/**
 * Prints header top bar
 */
function grve_print_header_top_bar() {

	if ( grve_visibility( 'top_bar_enabled' ) ) {
		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_top_bar' ) ) {
			return;
		}
		if( grve_woocommerce_enabled() ) {
			// Disabled top Bar in Shop
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_top_bar' ) ) {
				return false;
			}
		}
?>
		<!-- Top Bar -->
		<div id="grve-top-bar">

			<div class="grve-container">

				<?php
				if ( grve_visibility( 'top_bar_left_enabled' ) ) {
				?>
				<ul class="grve-bar-content grve-left-side">
					<?php

						//Top Left First Item Hook
						do_action( 'grve_header_top_bar_left_first_item' );

						//Top Left Text
						$grve_left_text = grve_option('top_bar_left_text');
						grve_print_header_top_bar_text( $grve_left_text );

						//Top Left Options
						$top_bar_left_options = grve_option('top_bar_left_options');
						if ( isset( $top_bar_left_options['menu'] ) && 1 == $top_bar_left_options['menu'] ) {
							grve_print_header_top_bar_nav( 'left' );
						}
						grve_print_header_top_bar_options( $top_bar_left_options );

						//Top Left Language selector
						if ( isset( $top_bar_left_options['language'] ) && 1 == $top_bar_left_options['language'] ) {
							grve_print_header_top_bar_language_selector();
						}

						//Top Left Social
						if ( grve_visibility( 'top_bar_left_social_visibility' ) ) {
							$top_bar_left_social_options = grve_option('top_bar_left_social_options');
							grve_print_header_top_bar_socials( $top_bar_left_social_options );
						}

						//Top Left Last Item Hook
						do_action( 'grve_header_top_bar_left_last_item' );

					?>
				</ul>
				<?php
					}
				?>

				<?php
				if ( grve_visibility( 'top_bar_right_enabled' ) ) {
				?>
				<ul class="grve-bar-content grve-right-side">
					<?php

						//Top Right First Item Hook
						do_action( 'grve_header_top_bar_right_first_item' );

						//Top Right Text
						$grve_right_text = grve_option('top_bar_right_text');
						grve_print_header_top_bar_text( $grve_right_text );

						//Top Right Options
						$top_bar_right_options = grve_option('top_bar_right_options');
						if ( isset( $top_bar_right_options['menu'] ) && 1 == $top_bar_right_options['menu'] ) {
							grve_print_header_top_bar_nav( 'right' );
						}
						grve_print_header_top_bar_options( $top_bar_right_options );

						//Top Right Language selector
						if ( isset( $top_bar_right_options['language'] ) && 1 == $top_bar_right_options['language'] ) {
							grve_print_header_top_bar_language_selector();
						}
						//Top Right Social
						if ( grve_visibility( 'top_bar_right_social_visibility' ) ) {
							$top_bar_right_social_options = grve_option('top_bar_right_social_options');
							grve_print_header_top_bar_socials( $top_bar_right_social_options );
						}

						//Top Right Last Item Hook
						do_action( 'grve_header_top_bar_right_last_item' );

					?>


				</ul>
				<?php
					}
				?>
			</div>

		</div>
		<!-- End Top Bar -->
<?php

	}
}

/**
 * Prints header safe buttons e.g: social, language selector, search
 */
function grve_print_header_safe_options() {

	if ( grve_visibility( 'safe_button_enabled' ) ) {
		$safe_button_options = grve_option('safe_button_options');

		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_safe_button' ) ) {
			return false;
		}
		if( grve_woocommerce_enabled() ) {
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_safe_button' ) ) {
				return false;
			}
		}
?>
		<!-- Safe Options -->
		<ul id="grve-header-options">
			<li>
				<a class="grve-open-button grve-icon-safebutton" href="#"></a>
				<nav class="grve-options-wrapper">
					<ul class="grve-options">
<?php

						//Safe Button First Item Hook
						do_action( 'grve_header_safebutton_first_item' );

						if ( !empty( $safe_button_options ) ) {
							foreach ( $safe_button_options as $key => $value ) {
								if( !empty( $value ) ) {
									if ( 'search' == $key ) {
									?>
										<li><a href="#grve-search-modal" class="grve-open-popup-link"><i class="grve-icon grve-icon-search"></i><span><?php echo grve_option( 'safe_button_option_search_text', '&nbsp;' ); ?></span></a></li>
									<?php
									} else if ( 'language' == $key ) {
									?>
										<li><a href="#grve-language-modal" class="grve-open-popup-link"><i class="grve-icon grve-icon-globe "></i><span><?php echo grve_option( 'safe_button_option_language_text', '&nbsp;' ); ?></span></a></li>
									<?php
									} else if ( 'newsletter' == $key ) {
									?>
										<li><a href="#grve-newsletter-modal" class="grve-open-popup-link"><i class="grve-icon grve-icon-envelope"></i><span><?php echo grve_option( 'safe_button_option_newsletter_text', '&nbsp;' ); ?></span></a></li>
									<?php
									}
								}
							}
						}

						if ( grve_visibility( 'safe_button_social_visibility' ) ) {
						?>
							<li><a href="#grve-share-modal" class="grve-open-popup-link"><i class="grve-icon grve-icon-socials"></i><span><?php echo grve_option( 'safe_button_option_social_text', '&nbsp;' ); ?></span></a></li>
						<?php
						}

						//Safe Button Last Item Hook
						do_action( 'grve_header_safebutton_last_item' );
?>
					</ul>
				</nav>
			</li>
		</ul>
		<!-- End Safe Options -->
<?php
	}

}

/**
 * Prints header safe buttons e.g: social, language selector, search
 */
function grve_print_header_menu_options() {

	if ( grve_visibility( 'header_menu_options_enabled' ) ) {

		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_menu_items' ) ) {
			return false;
		}
		if( grve_woocommerce_enabled() ) {
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_menu_items' ) ) {
				return false;
			}
		}

		$header_menu_options = grve_option('header_menu_options');

?>
		<!-- Menu Options -->
		<ul class="grve-menu-options">
<?php
			do_action( 'grve_header_menu_options_first_item' );

			if ( !empty( $header_menu_options ) ) {
				foreach ( $header_menu_options as $key => $value ) {
					if( !empty( $value ) ) {
						if ( 'cart' == $key && grve_woocommerce_enabled() ) {
							global $woocommerce;
						?>
							<li><a href="#grve-shop-modal" class="grve-icon-shopping-cart grve-open-popup-link"><span class="grve-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span></a></li>
						<?php
						} else if ( 'search' == $key ) {
						?>
							<li><a href="#grve-search-modal" class="grve-icon-search grve-open-popup-link"></a></li>
						<?php
						} else if ( 'language' == $key ) {
						?>
							<li><a href="#grve-language-modal" class="grve-icon-globe grve-open-popup-link"></a></li>
						<?php
						} else if ( 'newsletter' == $key ) {
						?>
							<li><a href="#grve-newsletter-modal" class="grve-icon-envelope grve-open-popup-link"></a></li>
						<?php
						}
					}
				}
			}

			if ( grve_visibility( 'header_menu_social_visibility' ) ) {
				$header_social_options = grve_option('header_menu_social_options');
				$social_options = grve_option('social_options');
				if ( !empty( $header_social_options ) && !empty( $social_options ) ) {

					foreach ( $social_options as $key => $value ) {
						if ( isset( $header_social_options[$key] ) && 1 == $header_social_options[$key] && $value ) {
							if ( 'skype' == $key ) {
								echo '<li><a href="' . $value . '" class="grve-icon-' . esc_attr( $key ) . '"></a></li>';
							} else {
								echo '<li><a href="' . esc_url( $value ) . '" target="_blank" rel="noopener noreferrer" class="grve-icon-' . esc_attr( $key ) . '"></a></li>';
							}
						}
					}

				}
			}

			do_action( 'grve_header_menu_options_last_item' );
?>
		</ul>
		<!-- End Menu Options -->
<?php

	}

}

/**
 * Prints Header Newsletter modal
 */
if ( !function_exists('grve_print_header_newsletter_modal') ) {
	function grve_print_header_newsletter_modal() {
	?>
			<div id="grve-newsletter-modal" class="grve-modal">
				<div class="grve-modal-content">
					<a href="#" class="grve-close-modal grve-icon-close"></a>
					<div class="grve-newsletter">
						<?php
						if ( class_exists( 'MC4WP_Lite' ) ) {
							echo do_shortcode('[mc4wp_form]');
						} else {
							if( defined( 'MC4WP_VERSION' ) ) {
								$grve_mc4wp_form_id = grve_option('mc4wp_form');
								if ( !empty( $grve_mc4wp_form_id ) ) {
									echo do_shortcode('[mc4wp_form id="' .esc_attr( $grve_mc4wp_form_id ) . '"]');
								}
							}
						}
						?>
					</div>
				</div>
			</div>
	<?php
	}
}

/**
 * Prints Header Search modal
 */
if ( !function_exists('grve_print_header_search_modal') ) {
	function grve_print_header_search_modal() {
			$form = '';
	?>
			<div id="grve-search-modal" class="grve-modal">
				<div class="grve-modal-content">
					<a href="#" class="grve-close-modal grve-icon-close"></a>
					<?php get_search_form(); ?>
				</div>
			</div>
	<?php
	}
}

/**
 * Prints Header Social modal
 */
function grve_print_header_social_modal() {

	if ( grve_visibility('safe_button_social_visibility') ) {
		global $grve_social_list;
		$options = grve_option('safe_button_social_options');
		$social_options = grve_option('social_options');

		echo '<div id="grve-share-modal" class="grve-modal">';
			echo '<div class="grve-modal-content">';
			echo '<a href="#" class="grve-close-modal grve-icon-close"></a>';
			if ( !empty( $options ) && !empty( $social_options ) ) {
				echo '<ul class="grve-social">';
				foreach ( $social_options as $key => $value ) {
					if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
						if ( 'skype' == $key ) {
							echo '<li><a href="' . $value . '">' . $grve_social_list[$key] . '</a></li>';
						} else {
							echo '<li><a href="' . esc_url( $value ) . '" target="_blank" rel="noopener noreferrer">' . $grve_social_list[$key] . '</a></li>';
						}
					}
				}
				echo '</ul>';
			}
			echo '</div>';
		echo '</div>';
	}
}

/**
 * Prints Shop modal
 */
function grve_print_header_shop_modal() {

	if ( grve_woocommerce_enabled() ) {
?>

	<div id="grve-shop-modal" class="grve-modal">
		<div class="grve-modal-content">
			<a href="#" class="grve-close-modal grve-icon-close"></a>
			<div class="grve-cart-popup">
				<div class="widget_shopping_cart_content"></div>
			</div>
		</div>
	</div>

<?php
	}
}

/**
 * Prints header language selector
 * WPML is required
 * Can be used to add custom php code for other translation flags.
 */
function grve_print_header_language_selector_modal() {

	$skip_missing = grve_option('language_switcher_skip_missing', '0' );
	$skip_missing = intval( $skip_missing );

?>
		<div id="grve-language-modal" class="grve-modal">
<?php
		//start language selector output buffer
		ob_start();


?>
			<div class="grve-modal-content">
				<a href="#" class="grve-close-modal grve-icon-close"></a>
				<ul class="grve-language">


<?php
			//Polylang
			if( function_exists( 'pll_the_languages' ) ) {
				$languages = pll_the_languages( array( 'raw'=>1, 'hide_if_no_translation' => $skip_missing ) );
				if ( ! empty( $languages ) ) {
					foreach ( $languages as $l ) {
						echo '<li>';
						if ( !$l['current_lang'] ) {
							echo '<a href="' . esc_url( $l['url'] ) . '">';
						} else {
							echo '<a href="#" class="active">';
						}
						echo esc_html( $l['name'] );

						echo '</a></li>';
					}
				}
			}

			//WPML
			if ( defined( 'ICL_SITEPRESS_VERSION' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
				$languages = icl_get_languages( 'skip_missing=' . $skip_missing );
				if ( ! empty( $languages ) ) {
					foreach ( $languages as $l ) {
						echo '<li>';
						if ( !$l['active'] ) {
							echo '<a href="' . esc_url( $l['url'] ) . '">';
						} else {
							echo '<a href="#" class="active">';
						}
						echo esc_html( $l['native_name'] );

						echo '</a></li>';
					}
				}
			}
?>
				</ul>
			</div>
<?php

		//store the language selector buffer and clean
		$grve_lang_selector_out = ob_get_clean();
		echo apply_filters( 'grve_header_language_selector', $grve_lang_selector_out );
?>
		</div>
<?php

}

/**
 * Prints Header navigation for articles ( Posts / Portfolio Items )
 */
function grve_print_header_item_navigation( $element_class = "grve-nav-wrapper") {
	global $post;

	if ( is_singular() ) {
		$post_id = $post->ID;
		$post_type = get_post_type( $post_id );

		if ( ( $post_type == 'post' && is_singular( 'post' ) && grve_visibility( 'post_nav_visibility', '1' ) ) ||
			( $post_type == 'portfolio' && is_singular( 'portfolio' ) ) ||
			( $post_type == 'testimonial' && is_singular( 'testimonial' ) ) ) {

			$grve_in_same_term = false;
			$grve_backlink = '';

			if ( $post_type == 'portfolio' ) {
				$grve_in_same_term = grve_visibility( 'portfolio_nav_same_term', '0' );
				$grve_nav_invert = grve_option( 'portfolio_nav_invert', 'no' );
				if( 'no' == $grve_nav_invert ) {
					$prev_post = get_adjacent_post( $grve_in_same_term, '', true, 'portfolio_category');
					$next_post = get_adjacent_post( $grve_in_same_term, '', false, 'portfolio_category');
				} else {
					$next_post = get_adjacent_post( $grve_in_same_term, '', true, 'portfolio_category');
					$prev_post = get_adjacent_post( $grve_in_same_term, '', false, 'portfolio_category');
				}
				$grve_backlink = grve_option( 'portfolio_backlink' );
				if ( !empty( $grve_backlink ) ) {
					$grve_backlink = apply_filters( 'wpml_object_id', $grve_backlink, 'page', TRUE  );
				}
				
			} elseif ( $post_type == 'post' ) {
				$grve_in_same_term = grve_visibility( 'post_nav_same_term', '0' );
				$grve_nav_invert = grve_option( 'post_nav_invert', 'no' );
				if( 'no' == $grve_nav_invert ) {
					$prev_post = get_adjacent_post( $grve_in_same_term, '', true);
					$next_post = get_adjacent_post( $grve_in_same_term, '', false);
				} else {
					$next_post = get_adjacent_post( $grve_in_same_term, '', true);
					$prev_post = get_adjacent_post( $grve_in_same_term, '', false);
				}
			} else {
				$prev_post = get_adjacent_post( $grve_in_same_term, '', true);
				$next_post = get_adjacent_post( $grve_in_same_term, '', false);
			}
			echo '<div class="' . $element_class . '">';
			if ( $prev_post || $next_post || !empty( $grve_backlink ) ) {
				echo '<ul class="grve-post-nav">';
				if ( $next_post ) {
					grve_print_item_nav_link( $next_post->ID, 'next' );
				}

				if ( $post_type == 'portfolio' ) {
					if ( !empty( $grve_backlink ) ) {
						$portfolio_backlink_url = get_permalink( $grve_backlink );
					?>
						<li><a href="<?php echo esc_url( $portfolio_backlink_url ); ?>" class="grve-icon-th-large grve-backlink"></a></li>
					<?php
					}
				}

				if ( $prev_post ) {
					grve_print_item_nav_link( $prev_post->ID, 'prev' );
				}
				echo '</ul>';
			}
			echo '</div>';

		}
	}
}

function grve_print_item_nav_link( $post_id,  $direction, $title = '' ) {

	$icon_class = 'nav-right';
	if ( 'prev' == $direction ) {
		$icon_class = 'nav-left';
	}
?>
	<li><a href="<?php echo get_permalink( $post_id ); ?>" class="grve-icon-<?php echo esc_attr( $icon_class ); ?>" title="<?php echo esc_attr( $title ); ?>"></a></li>
<?php
}

 /**
 * Prints header breadcrumbs
 */
function grve_print_header_breadcrumbs_visibility( $mode = 'page') {

	$grve_disable_breadcrumbs = 'yes';

	if( grve_visibility( $mode . '_breadcrumbs_enabled' ) ) {
		$grve_disable_breadcrumbs = 'no';
		if ( is_singular() ) {
			$grve_disable_breadcrumbs = grve_post_meta( 'grve_disable_breadcrumbs', $grve_disable_breadcrumbs );
		} else if( grve_is_woo_shop() ) {
			$grve_disable_breadcrumbs = grve_post_meta_shop( 'grve_disable_breadcrumbs', $grve_disable_breadcrumbs );
		}
	}

	if ( 'yes' != $grve_disable_breadcrumbs  ) {
		return true;
	} else {
		return false;
	}
}
 /**
 * Prints header breadcrumbs
 */
function grve_print_header_breadcrumbs( $mode = 'page') {

	if ( grve_print_header_breadcrumbs_visibility( $mode )  ) {

		$item_type = str_replace ( '_' , '-', $mode );
		$grve_breadcrumbs_id = 'grve-' . $item_type  . '-breadcrumbs';
		$grve_breadcrumbs_fullwidth = grve_option( $mode . '_breadcrumbs_fullwidth' );
		$grve_breadcrumbs_alignment = grve_option( $mode . '_breadcrumbs_alignment', 'left' );

		$grve_breadcrumbs_classes = array( 'grve-breadcrumbs', 'clearfix' );
		if ( '1' == $grve_breadcrumbs_fullwidth ) {
			$grve_breadcrumbs_classes[] = ' grve-fullwidth';
		}
		$grve_breadcrumbs_classes[] = 'grve-align-' . $grve_breadcrumbs_alignment ;
		$grve_breadcrumbs_classes = implode( ' ', $grve_breadcrumbs_classes );
?>
	<div id="<?php echo esc_attr( $grve_breadcrumbs_id ); ?>" class="<?php echo esc_attr( $grve_breadcrumbs_classes ); ?>">
		<div class="grve-breadcrumbs-wrapper">
			<div class="grve-container">
				<?php grve_print_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
