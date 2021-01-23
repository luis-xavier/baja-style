<?php

/*
*	Admin functions and definitions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Default hidden metaboxes for portfolio
 */
function grve_change_default_hidden( $hidden, $screen ) {
    if ( 'portfolio' == $screen->id ) {
        $hidden = array_flip( $hidden );
        unset( $hidden['portfolio_categorydiv'] ); //show portfolio category box
        $hidden = array_flip( $hidden );
        $hidden[] = 'postexcerpt';
		$hidden[] = 'postcustom';
		$hidden[] = 'commentstatusdiv';
		$hidden[] = 'commentsdiv';
		$hidden[] = 'authordiv';
    }
    return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'grve_change_default_hidden', 10, 2 );


/**
 * Enqueue scripts and styles for the back end.
 */
function grve_backend_scripts( $hook ) {
	global $post;

	wp_register_style( 'osmosis-grve-page-feature-section', get_template_directory_uri() . '/includes/css/grve-page-feature-section.css', array(), time() );
	wp_register_style( 'osmosis-grve-admin-meta', get_template_directory_uri() . '/includes/css/grve-admin-meta.css', array(), time() );
	wp_register_style( 'osmosis-grve-modal', get_template_directory_uri() . '/includes/css/grve-modal.css', array(), time() );
	wp_register_style( 'osmosis-grve-custom-sidebars', get_template_directory_uri() . '/includes/css/grve-custom-sidebars.css', array(), time()  );
	wp_register_style( 'osmosis-grve-status', get_template_directory_uri() . '/includes/css/grve-status.css', array(), time() );
	wp_register_style( 'osmosis-grve-admin-panel', get_template_directory_uri() . '/includes/css/grve-admin-panel.css', array(), time() );
	wp_register_style( 'osmosis-grve-custom-nav-menu', get_template_directory_uri() . '/includes/css/grve-custom-nav-menu.css', array(), time() );


	$grve_upload_slider_texts = array(
		'modal_title' => __( 'Insert Images', 'osmosis' ),
		'modal_button_title' => __( 'Insert Images', 'osmosis' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_feature_slider_media' => wp_create_nonce( 'osmosis-grve-get-feature-slider-media' ),
		'nonce_slider_media' => wp_create_nonce( 'osmosis-grve-get-slider-media' ),
	);

	$grve_upload_image_replace_texts = array(
		'modal_title' => __( 'Replace Image', 'osmosis' ),
		'modal_button_title' => __( 'Replace Image', 'osmosis' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_replace' => wp_create_nonce( 'osmosis-grve-get-replaced-image' ),
	);

	$grve_upload_media_texts = array(
		'modal_title' => __( 'Insert Media', 'osmosis' ),
		'modal_button_title' => __( 'Insert Media', 'osmosis' ),
	);

	$grve_upload_image_texts = array(
		'modal_title' => __( 'Insert Image', 'osmosis' ),
		'modal_button_title' => __( 'Insert Image', 'osmosis' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_image_media' => wp_create_nonce( 'osmosis-grve-get-image-media' ),
	);

	$grve_feature_section_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_map_point' => wp_create_nonce( 'osmosis-grve-get-map-point' ),
	);

	$grve_custom_sidebar_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_custom_sidebar' => wp_create_nonce( 'osmosis-grve-get-custom-sidebar' ),
	);

	$grve_modal_texts = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce_modal' => wp_create_nonce( 'osmosis-grve-get-modal-template-data' ),
	);

	wp_register_script( 'osmosis-grve-status', get_template_directory_uri() . '/includes/js/grve-status.js', array( 'jquery'), time(), false );
	wp_register_script( 'osmosis-grve-custom-sidebars', get_template_directory_uri() . '/includes/js/grve-custom-sidebars.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-custom-sidebars', 'grve_custom_sidebar_texts', $grve_custom_sidebar_texts );

	wp_register_script( 'osmosis-grve-upload-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-slider.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-upload-slider-script', 'grve_upload_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'osmosis-grve-upload-feature-slider-script', get_template_directory_uri() . '/includes/js/grve-upload-feature-slider.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-upload-feature-slider-script', 'grve_upload_feature_slider_texts', $grve_upload_slider_texts );

	wp_register_script( 'osmosis-grve-upload-image-replace-script', get_template_directory_uri() . '/includes/js/grve-upload-image-replace.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-upload-image-replace-script', 'grve_upload_image_replace_texts', $grve_upload_image_replace_texts );

	wp_register_script( 'osmosis-grve-upload-simple-media-script', get_template_directory_uri() . '/includes/js/grve-upload-simple.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-upload-simple-media-script', 'grve_upload_media_texts', $grve_upload_media_texts );

	wp_register_script( 'osmosis-grve-upload-image-script', get_template_directory_uri() . '/includes/js/grve-upload-image.js', array( 'jquery'), time(), false );
	wp_localize_script( 'osmosis-grve-upload-image-script', 'grve_upload_image_texts', $grve_upload_image_texts );

	wp_register_script( 'osmosis-grve-page-feature-section-script', get_template_directory_uri() . '/includes/js/grve-page-feature-section.js', array( 'jquery', 'wp-color-picker' ), time(), false );
	wp_localize_script( 'osmosis-grve-page-feature-section-script', 'grve_feature_section_texts', $grve_feature_section_texts );

	wp_register_script( 'osmosis-grve-post-options-script', get_template_directory_uri() . '/includes/js/grve-post-options.js', array( 'jquery'), time(), false );
	wp_register_script( 'osmosis-grve-portfolio-options-script', get_template_directory_uri() . '/includes/js/grve-portfolio-options.js', array( 'jquery'), time(), false );

	wp_register_script( 'osmosis-grve-modal-script' , get_template_directory_uri() . '/includes/js/grve-modal.js' , array( 'jquery', 'backbone', 'underscore'), time(), false );
	wp_localize_script( 'osmosis-grve-modal-script', 'grve_modal_texts', $grve_modal_texts );

	wp_register_script( 'osmosis-grve-custom-nav-menu-script', get_template_directory_uri().'/includes/js/grve-custom-nav-menu.js', array( 'jquery'), time(), false );
	wp_register_script( 'osmosis-grve-codes-script', get_template_directory_uri().'/includes/js/grve-codes.js', array( 'jquery'), time(), false );


	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

        if ( 'post' === $post->post_type ) {

			wp_enqueue_style( 'osmosis-grve-modal' );
			wp_enqueue_style( 'osmosis-grve-admin-meta' );
            wp_enqueue_style( 'osmosis-grve-page-feature-section' );

			wp_enqueue_script( 'osmosis-grve-modal-script' );
			wp_enqueue_script( 'osmosis-grve-upload-simple-media-script' );
			wp_enqueue_script( 'osmosis-grve-upload-image-script' );
			wp_enqueue_script( 'osmosis-grve-upload-slider-script' );
			wp_enqueue_script( 'osmosis-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'osmosis-grve-upload-image-replace-script' );
			wp_enqueue_script( 'osmosis-grve-page-feature-section-script' );
			wp_enqueue_script( 'osmosis-grve-post-options-script' );

        } else if ( 'page' === $post->post_type || 'portfolio' === $post->post_type) {

			wp_enqueue_style( 'osmosis-grve-modal' );
			wp_enqueue_style( 'osmosis-grve-admin-meta' );
			wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'osmosis-grve-page-feature-section' );

			wp_enqueue_script( 'osmosis-grve-modal-script' );
			wp_enqueue_script( 'osmosis-grve-upload-simple-media-script' );
			wp_enqueue_script( 'osmosis-grve-upload-image-script' );
			wp_enqueue_script( 'osmosis-grve-upload-slider-script' );
			wp_enqueue_script( 'osmosis-grve-upload-feature-slider-script' );
			wp_enqueue_script( 'osmosis-grve-upload-image-replace-script' );
			wp_enqueue_script( 'osmosis-grve-page-feature-section-script' );
			if ( 'portfolio' === $post->post_type) {
				wp_enqueue_script( 'osmosis-grve-portfolio-options-script' );
			}

        } else if ( 'testimonial' === $post->post_type ) {

			wp_enqueue_style( 'osmosis-grve-admin-meta' );

        } else if ( 'product' === $post->post_type ) {

			wp_enqueue_style( 'osmosis-grve-admin-meta' );

		} else if ( 'tribe_events' === $post->post_type ) {

			wp_enqueue_style( 'osmosis-grve-admin-meta' );

		}
    }

	if ( $hook == 'nav-menus.php' ) {
		wp_enqueue_style( 'osmosis-grve-custom-nav-menu' );
		wp_enqueue_script( 'osmosis-grve-custom-nav-menu-script' );
	}

	//Admin Screens
	if ( isset( $_GET['page'] ) && ( 'osmosis' == $_GET['page'] ) ) {
		wp_enqueue_style( 'osmosis-grve-admin-panel' );
	}
	if ( isset( $_GET['page'] ) && ( 'osmosis-sidebars' == $_GET['page'] ) ) {
		wp_enqueue_style( 'osmosis-grve-custom-sidebars' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'osmosis-grve-custom-sidebars' );
	}
	if ( isset( $_GET['page'] ) && ( 'osmosis-status' == $_GET['page'] ) ) {
		wp_enqueue_style( 'osmosis-grve-status' );
		wp_enqueue_script( 'osmosis-grve-status' );
	}
	if ( isset( $_GET['page'] ) && ( 'osmosis-import' == $_GET['page'] ) ) {
		wp_enqueue_style( 'osmosis-grve-admin-panel' );
	}
	if ( isset( $_GET['page'] ) && ( 'osmosis-codes' == $_GET['page'] ) ) {
		wp_enqueue_style( 'osmosis-grve-admin-panel' );
		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
		wp_enqueue_script( 'osmosis-grve-codes-script' );
	}

	wp_register_style(
		'redux-custom-css',
		get_template_directory_uri() . '/includes/css/grve-redux-panel.css',
		array(),
		time(),
		'all'
	);
	wp_enqueue_style( 'redux-custom-css' );

}
add_action( 'admin_enqueue_scripts', 'grve_backend_scripts', 10, 1 );

/**
 * Helper function to get modal template
 */
function grve_get_modal_template_data() {
	check_ajax_referer( 'osmosis-grve-get-modal-template-data', '_grve_nonce' );
	include_once get_template_directory() . '/includes/admin/grve-modal-template-data.php';
	die();
}
add_action( 'wp_ajax_grve_get_modal_template_data' , 'grve_get_modal_template_data' );

/**
 * Helper function to get custom fields with fallback
 */
function grve_post_meta( $id, $fallback = false ) {
	global $post;
	$post_id = $post->ID;
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

function grve_admin_post_meta( $post_id, $id, $fallback = false ) {
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to get theme options with fallback
 */
function grve_option( $id, $fallback = false, $param = false ) {
	global $grve_osmosis_options;
	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_osmosis_options[$id]) && $grve_osmosis_options[$id] !== '' ) ? $grve_osmosis_options[$id] : $fallback;
	if ( !empty($grve_osmosis_options[$id]) && $param ) {
		$output = ( isset($grve_osmosis_options[$id][$param]) && $grve_osmosis_options[$id][$param] !== '' ) ? $grve_osmosis_options[$id][$param] : $fallback;
		if ( 'font-family' == $param ) {
			$output = urldecode( $output );
			if ( strpos($output, ' ') && !strpos($output, ',') ) {
				$output = '"' . $output . '"';
			}
		}
	}
	return $output;
}

/**
 * Helper function to print css code if not empty
 */
function grve_css_option( $id, $fallback = false, $param = false ) {
	$option = grve_option( $id, $fallback, $param );
	if ( !empty( $option ) && 0 != $option && $param ) {
		return $param . ': ' . $option . ';';
	}
}

/**
 * Helper function to get array value with fallback
 */
function grve_array_value( $input_array, $id, $fallback = false, $param = false ) {

	if ( $fallback == false ) $fallback = '';
	$output = ( isset($input_array[$id]) && $input_array[$id] !== '' ) ? $input_array[$id] : $fallback;
	if ( !empty($input_array[$id]) && $param ) {
		$output = ( isset($input_array[$id][$param]) && $input_array[$id][$param] !== '' ) ? $input_array[$id][$param] : $fallback;
	}
	return $output;
}

/**
 * Helper function to return trimmed css code
 */
function grve_get_css_output( $css ) {
	/* Trim css for speed */
	$css_trim =  preg_replace( '/\s+/', ' ', $css );

	/* Add stylesheet Tag */
	return "<!-- Dynamic css -->\n<style type=\"text/css\">\n" . $css_trim . "\n</style>";
}

/**
 * Helper functions to set/get current template
 */
function grve_set_current_view( $id ) {
	global $grve_osmosis_options;
	$grve_osmosis_options['current_view'] = $id;
}
function grve_get_current_view( $fallback = '' ) {
	global $grve_osmosis_options;
	if ( $fallback == false ) $fallback = '';
	$output = ( isset($grve_osmosis_options['current_view']) && $grve_osmosis_options['current_view'] !== '' ) ? $grve_osmosis_options['current_view'] : $fallback;
	return $output;
}

/**
 * Helper function for strings
 */
function grve_starts_with( $haystack, $needle ) {
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

/**
 * Helper function convert hex to rgb
 */
function grve_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1) );
	} else {
		$r = hexdec( substr( $hex, 0, 2) );
		$g = hexdec( substr( $hex, 2, 2) );
		$b = hexdec( substr( $hex, 4, 2) );
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb);
}

/**
 * Helper function to get theme visibility options
 */
function grve_visibility( $id, $fallback = '' ) {
	$visibility = grve_option( $id, $fallback  );
	if ( '1' == $visibility ) {
		return true;
	}
	return false;
}

/**
 * Backend Theme Activation Actions
 */
function grve_backend_theme_activation() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow  ) {

		$catalog = array(
			'width' => '560',	// px
			'height'	=> '560',	// px
			'crop'	=> 1 // true
		);

		$single = array(
			'width' => '560',	// px
			'height'	=> '560',	// px
			'crop'	=> 1 // false
		);

		$thumbnail = array(
			'width' => '120',	// px
			'height'	=> '120',	// px
			'crop'	=> 1 // true
		);

		update_option( 'shop_catalog_image_size', $catalog );
		update_option( 'shop_single_image_size', $single );
		update_option( 'shop_thumbnail_image_size', $thumbnail );
		update_option( 'woocommerce_enable_lightbox', 'no' );

		//Redirect to Welcome
		header( 'Location: ' . esc_url( admin_url() ) . 'admin.php?page=osmosis' ) ;
	}
}

add_action('admin_init','grve_backend_theme_activation');

/**
 * Check if Revolution slider is active
 */
function grve_is_revslider_active() {

	if ( class_exists('RevSlider') ) {
		return true;
	}
	return false;
}

/**
 * Check if to replace Backend Logo
 */
function grve_admin_login_logo() {

	$replace_logo = grve_option( 'replace_admin_logo' );
	if ( $replace_logo ) {
		$admin_logo = grve_option( 'admin_logo','','url' );
		$admin_logo_height = grve_option( 'admin_logo_height','84');
		$admin_logo_height = preg_match('/(px|em|\%|pt|cm)$/', $admin_logo_height) ? $admin_logo_height : $admin_logo_height . 'px';
		if( empty( $admin_logo ) ) {
			$admin_logo = grve_option( 'logo','','url' );
		}
		if ( !empty( $admin_logo ) ) {
			$admin_logo = str_replace( array( 'http:', 'https:' ), '', $admin_logo );
			echo "
			<style>
			.login h1 a {
				background-image: url('" . esc_url( $admin_logo ) . "');
				width: 100%;
				max-width: 300px;
				background-size: auto " . esc_attr( $admin_logo_height ) . ";
				height: " . esc_attr( $admin_logo_height ) . ";
			}
			</style>
			";
		}
	}
}
add_action( 'login_head', 'grve_admin_login_logo' );

function grve_admin_login_headerurl( $url ){
	return esc_url( home_url( '/' ) );
}

function grve_admin_login_headertitle( $title ) {
	return esc_attr( get_bloginfo( 'name' ) );
}

$replace_logo = grve_option( 'replace_admin_logo' );
if ( $replace_logo ) {
	add_filter('login_headertext', 'grve_admin_login_headertitle' );
	add_filter('login_headerurl', 'grve_admin_login_headerurl');
}


/**
 * Disable SEO Page Analysis
 */
function grve_disable_page_analysis( $bool ) {
	if( '1' == grve_option( 'disable_seo_page_analysis', '0' ) ) {
		return false;
	}
	return $bool;
}
add_filter( 'wpseo_use_page_analysis', 'grve_disable_page_analysis' );

/**
 * Browser Webkit Check
 */
function osmosis_grve_browser_webkit_check() {
	if ( function_exists( 'osmosis_ext_browser_webkit_check' ) ) {
		return osmosis_ext_browser_webkit_check();
	} else {
		return false;
	}
}

/**
 * Add Hooks for Page Redirect ( Coming Soon )
 */

if ( ! function_exists( 'grve_redirect_page_template' ) ) {
	function grve_redirect_page_template( $template ) {
		if ( grve_visibility('coming_soon_enabled' )  && !is_user_logged_in() ) {
			$redirect_page = grve_option( 'coming_soon_page' );
			$redirect_template = grve_option( 'coming_soon_template' );
			if ( !empty( $redirect_page ) && 'content' == $redirect_template ) {
				$new_template = locate_template( array( 'page-templates/template-content-only.php' ) );
				if ( '' != $new_template ) {
					return $new_template ;
				}
			}
		}
		return $template;
	}
}
add_filter( 'template_include', 'grve_redirect_page_template', 99 );

if ( ! function_exists( 'grve_redirect' ) ) {
	function grve_redirect() {
		if ( grve_visibility('coming_soon_enabled' ) && !is_user_logged_in() ) {
			$redirect_page = grve_option( 'coming_soon_page' );
			if ( !empty( $redirect_page )
				&& !in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') )
				&& !is_admin()
				&& !is_page( $redirect_page ) ) {
				wp_redirect( get_permalink( $redirect_page ) );
				exit();
			}
		}
		return false;
	}
}
add_filter( 'template_redirect', 'grve_redirect' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
