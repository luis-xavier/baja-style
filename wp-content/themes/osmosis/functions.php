<?php

/*
*	Main theme functions and definitions
*
* 	@version	4.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Theme Definitions
 * Please leave these settings unchanged
 */

define( 'OSMOSIS_GRVE_THEME_SHORT_NAME', 'osmosis' );
define( 'OSMOSIS_GRVE_THEME_NAME', 'Osmosis' );
define( 'OSMOSIS_GRVE_THEME_VERSION', '4.2.4');
define( 'OSMOSIS_GRVE_REDUX_CUSTOM_PANEL', false);

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

/**
 * Include Global helper files
 */
require_once get_template_directory() . '/includes/grve-deprecated.php';
require_once get_template_directory() . '/includes/grve-gutenberg.php';
require_once get_template_directory() . '/includes/grve-global.php';
require_once get_template_directory() . '/includes/grve-meta-tags.php';
require_once get_template_directory() . '/includes/grve-privacy-functions.php';
/**
 * Include WooCommerce helper files
 */
require_once get_template_directory() . '/includes/grve-woocommerce-functions.php';
/**
 * Include Events Calendar helper files
 */
require_once get_template_directory() . '/includes/grve-events-calendar-functions.php';
/**
 * Include bbPress helper files
 */
require_once get_template_directory() . '/includes/grve-bbpress-functions.php';

/**
 * Register Plugins Libraries
 */
if ( is_admin() ) {
	require_once get_template_directory() . '/includes/plugins/tgm-plugin-activation/register-plugins.php';
}

require_once get_template_directory() . '/includes/admin/grve-admin-screens.php';
require_once get_template_directory() . '/includes/admin/grve-admin-custom-sidebars.php';

/**
 * ReduxFramework
 */

require_once get_template_directory() . '/includes/admin/grve-redux-extension-loader.php';

if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/includes/framework/framework.php' ) ) {
    require_once get_template_directory() . '/includes/framework/framework.php';
}


if ( !isset( $redux_demo ) ) {
	require_once get_template_directory() . '/includes/admin/grve-redux-framework-config.php';
}

function grve_remove_redux_demo_link() {
    if ( class_exists('Redux_Framework_Plugin') ) {
		call_user_func( 'remove' . '_filter', 'plugin_row_meta', array( Redux_Framework_Plugin::instance(), 'plugin_metalinks' ), null, 2 );
        remove_action('admin_notices', array( Redux_Framework_Plugin::get_instance(), 'admin_notices' ) );
    }
	if ( class_exists('ReduxFrameworkPlugin') ) {
		call_user_func( 'remove' . '_filter', 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'grve_remove_redux_demo_link');

/**
 * Custom Nav Menus
 */
require_once get_template_directory() . '/includes/custom-menu/grve-custom-nav-menu.php';

/**
 * Visual Composer Extentions
 */
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	function grve_add_vc_extentions() {
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-helper.php';
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-remove.php';
		require_once get_template_directory() . '/vc_extend/grve-shortcodes-vc-add.php';
	}
	add_action( 'init', 'grve_add_vc_extentions', 5 );

}

/**
 * Include helper files
 */
require_once get_template_directory() . '/includes/grve-gopricing-functions.php';

/**
 * Include admin helper files
 */
require_once get_template_directory() . '/includes/admin/grve-admin-functions.php';
require_once get_template_directory() . '/includes/admin/grve-admin-media-functions.php';
require_once get_template_directory() . '/includes/admin/grve-admin-feature-functions.php';

require_once get_template_directory() . '/includes/admin/grve-update-functions.php';
require_once get_template_directory() . '/includes/admin/grve-meta-functions.php';
require_once get_template_directory() . '/includes/admin/grve-page-meta.php';
require_once get_template_directory() . '/includes/admin/grve-post-meta.php';

require_once get_template_directory() . '/includes/admin/grve-portfolio-meta.php';
require_once get_template_directory() . '/includes/admin/grve-testimonial-meta.php';
require_once get_template_directory() . '/includes/grve-wp-gallery.php';

/**
 * Include Dynamic css
 */
require_once get_template_directory() . '/includes/grve-dynamic-css-loader.php';

/**
 * Include helper files
 */
require_once get_template_directory() . '/includes/grve-breadcrumbs.php';
require_once get_template_directory() . '/includes/grve-excerpt.php';
require_once get_template_directory() . '/includes/grve-vce-functions.php';
require_once get_template_directory() . '/includes/grve-header-functions.php';
require_once get_template_directory() . '/includes/grve-feature-functions.php';
require_once get_template_directory() . '/includes/grve-layout-functions.php';
require_once get_template_directory() . '/includes/grve-blog-functions.php';
require_once get_template_directory() . '/includes/grve-media-functions.php';
require_once get_template_directory() . '/includes/grve-portfolio-functions.php';
require_once get_template_directory() . '/includes/grve-footer-functions.php';

add_action( "after_switch_theme", "grve_theme_activate" );
add_action( 'after_setup_theme', 'grve_theme_setup' );
add_action( 'widgets_init', 'grve_register_sidebars' );

/**
 * Theme activation function
 * Used whe activating the theme
 */
function grve_theme_activate() {
	update_option( 'osmosis_grve_theme_version', OSMOSIS_GRVE_THEME_VERSION);
	flush_rewrite_rules();
}

/**
 * Theme setup function
 * Theme translations and support
 */
function grve_theme_setup() {

	load_theme_textdomain( 'osmosis', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
	add_theme_support( 'title-tag' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );

    add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name' => __( 'Primary 1', 'osmosis' ),
				'slug' => 'primary-1',
				'color' => grve_option( 'body_primary_1_color' ),
			),
			array(
				'name' => __( 'Primary 2', 'osmosis' ),
				'slug' => 'primary-2',
				'color' => grve_option( 'body_primary_2_color' ),
			),
			array(
				'name' => __( 'Primary 3', 'osmosis' ),
				'slug' => 'primary-3',
				'color' => grve_option( 'body_primary_3_color' ),
			),
			array(
				'name' => __( 'Primary 4', 'osmosis' ),
				'slug' => 'primary-4',
				'color' => grve_option( 'body_primary_4_color' ),
			),
			array(
				'name' => __( 'Primary 5', 'osmosis' ),
				'slug' => 'primary-5',
				'color' => grve_option( 'body_primary_5_color' ),
			),
		)
	);

	osmosis_grve_image_sizes();

	register_nav_menus(
		array(
			'grve_header_nav' => __( 'Header Menu', 'osmosis' ),
			'grve_top_left_nav' => __( 'Top Left Menu', 'osmosis' ),
			'grve_top_right_nav' => __( 'Top Right Menu', 'osmosis' ),
			'grve_footer_nav' => __( 'Footer Menu', 'osmosis' ),
		)
	);
}

if ( ! function_exists( 'osmosis_grve_image_sizes' ) ) {
	function osmosis_grve_image_sizes() {
		add_image_size( 'grve-image-extrasmall-square', 80, 80, true );
		add_image_size( 'grve-image-large-rect-horizontal', 1170, 658, true );
		add_image_size( 'grve-image-small-square', 560, 560, true );
		add_image_size( 'grve-image-small-rect-horizontal', 560, 315, true );
		add_image_size( 'grve-image-medium-rect-vertical', 560, 1120, true );
		add_image_size( 'grve-image-medium-rect-horizontal', 1120, 560, true );
		add_image_size( 'grve-image-medium-square', 1120, 1120, true );
		add_image_size( 'grve-image-fullscreen', 1920, 1920, false );
	}
}

/**
 * Navigation Menus
 */
function grve_get_header_nav() {

	$grve_main_menu = '';

	if ( 'default' == grve_option( 'menu_header_integration', 'default' ) ) {

		if ( is_singular() ) {
			if ( 'yes' == grve_post_meta( 'grve_disable_menu' ) ) {
				return 'disabled';
			} else {
				$grve_main_menu	= grve_post_meta( 'grve_main_navigation_menu' );
				if ( !empty( $grve_main_menu ) ) {
					$grve_main_menu = apply_filters( 'wpml_object_id', $grve_main_menu, 'nav_menu', TRUE  );
				}
			}
		}
		if( grve_woocommerce_enabled() && is_shop() && !is_search()  ) {
			if ( 'yes' == grve_post_meta_shop( 'grve_disable_menu' ) ) {
				return 'disabled';
			} else {
				$grve_main_menu	= grve_post_meta_shop( 'grve_main_navigation_menu' );
				if ( !empty( $grve_main_menu ) ) {
					$grve_main_menu = apply_filters( 'wpml_object_id', $grve_main_menu, 'nav_menu', TRUE  );
				}
			}
		}
	} else {
		$grve_main_menu = 'disabled';
	}

	$grve_main_menu = apply_filters( 'grve_custom_header_nav', $grve_main_menu );

	return $grve_main_menu;
}

function grve_header_nav( $grve_main_menu = '') {

	if ( empty( $grve_main_menu ) ) {
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'theme_location' => 'grve_header_nav', /* where in the theme it's assigned */
				'container' => false,
				'fallback_cb' => 'grve_fallback_menu',
				'link_before' => '<span class="grve-item">',
				'link_after' => '</span>',
				'walker' => new Grve_Main_Navigation_Walker(),
			)
		);
	} else {
		//Custom Alternative Menu
		wp_nav_menu(
			array(
				'menu_class' => 'grve-menu', /* menu class */
				'menu' => $grve_main_menu, /* menu name */
				'container' => false,
				'fallback_cb' => 'grve_fallback_menu',
				'link_before' => '<span class="grve-item">',
				'link_after' => '</span>',
				'walker' => new Grve_Main_Navigation_Walker(),
			)
		);
	}
}

if ( ! function_exists( 'grve_header_ubermenu_nav' ) ) {
	function grve_header_ubermenu_nav( $grve_main_menu = '') {

		if ( is_singular() ) {
			if ( 'yes' == grve_post_meta( 'grve_disable_menu' ) ) {
				return;
			} else {
				$grve_main_menu	= grve_post_meta( 'grve_main_navigation_menu' );
				if ( !empty( $grve_main_menu ) ) {
					$grve_main_menu = apply_filters( 'wpml_object_id', $grve_main_menu, 'nav_menu', TRUE  );
				}
			}
		}
		if( grve_woocommerce_enabled() && is_shop() && !is_search()  ) {
			if ( 'yes' == grve_post_meta_shop( 'grve_disable_menu' ) ) {
				return;
			} else {
				$grve_main_menu	= grve_post_meta_shop( 'grve_main_navigation_menu' );
				if ( !empty( $grve_main_menu ) ) {
					$grve_main_menu = apply_filters( 'wpml_object_id', $grve_main_menu, 'nav_menu', TRUE  );
				}
			}
		}
		if ( empty( $grve_main_menu ) ) {
			if ( function_exists( 'uberMenu_direct' ) ) {
				uberMenu_direct( 'grve_header_nav' );
			}
		} else {
			if ( function_exists( 'ubermenu' ) ) {
				ubermenu( 'main' , array( 'menu' => $grve_main_menu ) );
			}
		}

	}
}

function grve_top_left_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_top_left_nav',
			'container' => false, /* no container */
			'depth' => '1',
			'fallback_cb' => false,
		)
	);

}

function grve_top_right_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_top_right_nav',
			'container' => false, /* no container */
			'depth' => '1',
			'fallback_cb' => false,
		)
	);

}

function grve_footer_nav() {

	wp_nav_menu(
		array(
			'theme_location' => 'grve_footer_nav',
			'container' => false, /* no container */
			'depth' => '1',
			'fallback_cb' => false,
		)
	);

}

/**
 * Sidebars & Widgetized Areas
 */
function grve_register_sidebars() {

	$sidebar_heading_tag = grve_option( 'sidebar_heading_tag', 'h5' );
	$footer_heading_tag = grve_option( 'footer_heading_tag', 'h5' );

	register_sidebar( array(
		'id' => 'grve-default-sidebar',
		'name' => __( 'Main Sidebar', 'osmosis' ),
		'description' => __( 'Main Sidebar Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	register_sidebar( array(
		'id' => 'grve-single-portfolio-sidebar',
		'name' => __( 'Single Portfolio', 'osmosis' ),
		'description' => __( 'Single Portfolio Sidebar Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
	));

	if ( grve_woocommerce_enabled() ) {

		register_sidebar( array(
			'id' => 'grve-woocommerce-sidebar-shop',
			'name' => __( 'Shop Overview Page', 'osmosis' ),
			'description' => __( 'Shop Overview Widget Area', 'osmosis' ),
			'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
			'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
		));
		register_sidebar( array(
			'id' => 'grve-woocommerce-sidebar-product',
			'name' => __( 'Shop Product Pages', 'osmosis' ),
			'description' => __( 'Shop Product Widget Area', 'osmosis' ),
			'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
			'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
		));
	}

	register_sidebar( array(
		'id' => 'grve-footer-1-sidebar',
		'name' => __( 'Footer 1', 'osmosis' ),
		'description' => __( 'Footer 1 Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-2-sidebar',
		'name' => __( 'Footer 2', 'osmosis' ),
		'description' => __( 'Footer 2 Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-3-sidebar',
		'name' => __( 'Footer 3', 'osmosis' ),
		'description' => __( 'Footer 3 Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));
	register_sidebar( array(
		'id' => 'grve-footer-4-sidebar',
		'name' => __( 'Footer 4', 'osmosis' ),
		'description' => __( 'Footer 4 Widget Area', 'osmosis' ),
		'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<' . tag_escape( $footer_heading_tag ) . ' class="grve-widget-title">',
		'after_title' => '</' . tag_escape( $footer_heading_tag ) . '>',
	));

	$grve_custom_sidebars = get_option( 'grve-osmosis-custom-sidebars' );
	if ( ! empty( $grve_custom_sidebars ) ) {
		foreach ( $grve_custom_sidebars as $grve_custom_sidebar ) {
			register_sidebar( array(
				'id' => $grve_custom_sidebar['id'],
				'name' => __( 'Custom Sidebar', 'osmosis' ) . ': ' . $grve_custom_sidebar['name'],
				'description' => '',
				'before_widget' => '<div id="%1$s" class="grve-widget widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<' . tag_escape( $sidebar_heading_tag ) . ' class="grve-widget-title">',
				'after_title' => '</' . tag_escape( $sidebar_heading_tag ) . '>',
			));
		}
	}

}

/**
 * Custom Search Form
 */
function grve_wpsearch( $form ) {
	$new_custom_id = uniqid( 'grve_search_' );
	$form =  '<form class="grve-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" id="' . esc_attr( $new_custom_id ) . '" value="' . get_search_query() . '" name="s" placeholder="' . esc_html__( 'Search for ...', 'osmosis' ) . '" />';
	$form .= '</form>';
	return $form;
}
//add_filter( 'get_search_form', 'grve_wpsearch' );

/**
 * Enqueue scripts and styles for the front end.
 */
function grve_frontend_scripts() {

	$template_dir_uri = get_template_directory_uri();
	$child_theme_dir_uri = get_stylesheet_directory_uri();

	$grve_ver = OSMOSIS_GRVE_THEME_VERSION;

	wp_register_style( 'grve-style', $child_theme_dir_uri."/style.css", array(), esc_attr( $grve_ver ), 'all' );
	wp_enqueue_style( 'grve-awesome-fonts', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );


	wp_enqueue_style( 'grve-basic', get_template_directory_uri() . '/css/basic.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'grve-grid', get_template_directory_uri() . '/css/grid.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'grve-theme-style', get_template_directory_uri() . '/css/theme-style.css', array(), esc_attr( $grve_ver ) );
	wp_enqueue_style( 'grve-elements', get_template_directory_uri() . '/css/elements.css', array(), esc_attr( $grve_ver ) );

	if ( 'openstreetmap' == grve_option( 'map_api_mode', 'google-maps' ) ) {
		wp_enqueue_style(  'leaflet', '//unpkg.com/leaflet@1.3.1/dist/leaflet.css', array(), '1.3.1', 'all' );
		wp_enqueue_style(  'leaflet-marker-cluster', get_template_directory_uri() . '/css/leaflet.markercluster.css', array(), esc_attr( $grve_ver ) );
	}

	if ( grve_woocommerce_enabled() ) {
		wp_enqueue_style( 'grve-woocommerce-layout', get_template_directory_uri() . '/css/woocommerce-layout.css', array(), esc_attr( $grve_ver ), 'all' );
		wp_enqueue_style( 'grve-woocommerce-smallscreen', get_template_directory_uri() . '/css/woocommerce-smallscreen.css', array( 'grve-woocommerce-layout' ), esc_attr( $grve_ver ), 'only screen and (max-width: 959px)' );
		wp_enqueue_style( 'grve-woocommerce-extrasmallscreen', get_template_directory_uri() . '/css/woocommerce-extrasmallscreen.css', array( 'grve-woocommerce-layout' ), esc_attr( $grve_ver ), 'only screen and (max-width: 767px)' );
		wp_enqueue_style( 'grve-woocommerce-general', get_template_directory_uri() . '/css/woocommerce.css', array(), esc_attr( $grve_ver ), 'all' );
	}

	if ( grve_events_calendar_enabled() ) {
		wp_enqueue_style( 'grve-events-calendar', get_template_directory_uri() . '/css/events-calendar.css', array(), esc_attr( $grve_ver ), 'all' );
	}

	if ( $child_theme_dir_uri !=  $template_dir_uri ) {
		wp_enqueue_style( 'grve-style');
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'grve-responsive', get_template_directory_uri() . '/css/responsive.css', array(), esc_attr( $grve_ver ) );


	wp_register_script( 'youtube-iframe-api', '//www.youtube.com/iframe_api', array(), esc_attr( $grve_ver ), true );

	if ( grve_is_privacy_key_enabled( 'gmaps' ) ) {
		$gmap_api_key = grve_option( 'gmap_api_key' );

		if ( !empty( $gmap_api_key ) ) {
			wp_register_script( 'grve-googleapi-script', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $gmap_api_key ), NULL, NULL, true );
		} else {
			wp_register_script( 'grve-googleapi-script', '//maps.googleapis.com/maps/api/js?v=3', NULL, NULL, true );
		}

		wp_register_script( 'leaflet-maps-api', '//unpkg.com/leaflet@1.3.1/dist/leaflet.js', array(), '1.3.1', true );


		if ( 'openstreetmap' == grve_option( 'map_api_mode', 'google-maps' ) ) {
			wp_register_script( 'grve-markerclusterer-script', get_template_directory_uri() . '/js/leaflet.markercluster.js', array( 'jquery', 'leaflet-maps-api' ), esc_attr( $grve_ver ), true );
			wp_register_script( 'grve-maps-script', get_template_directory_uri() . '/js/leaflet-maps.js', array( 'jquery', 'leaflet-maps-api' ), esc_attr( $grve_ver ), true );
			$grve_maps_data = array(
				'map_tile_url' => grve_option( 'map_tile_url', 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png' ),
				'map_tile_url_subdomains' => grve_option( 'map_tile_url_subdomains', 'abc' ),
				'map_tile_attribution' => grve_option( 'map_tile_attribution' ),
			);
			wp_localize_script( 'grve-maps-script', 'grve_maps_data', $grve_maps_data );
		} else {

			wp_register_script( 'grve-markerclusterer-script', get_template_directory_uri() . '/js/markerclusterer_compiled.js', array( 'jquery', 'grve-googleapi-script' ), esc_attr( $grve_ver ), true );
			wp_register_script( 'grve-maps-script', get_template_directory_uri() . '/js/maps.js', array( 'jquery', 'grve-googleapi-script' ), esc_attr( $grve_ver ), true );
			$grve_maps_data = array(
				'hue_enabled' => grve_option( 'gmap_hue_enabled', '0' ) ,
				'hue' => grve_option( 'gmap_hue', '#ffffff' ) ,
				'saturation' => grve_option( 'gmap_saturation', '0' ) ,
				'lightness' => grve_option( 'gmap_hue', '0' ) ,
				'gamma' => grve_option( 'gmap_gamma', '0.1' ) ,
			);
			wp_localize_script( 'grve-maps-script', 'grve_maps_data', $grve_maps_data );
			$grve_markerclusterer_data = array(
				'theme_uri' => get_template_directory_uri() ,
			);
			wp_localize_script( 'grve-markerclusterer-script', 'grve_markerclusterer_data', $grve_markerclusterer_data );

		}
	}
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '2.8.3', false );
	$smooth_scroll = grve_option( 'smooth_scroll_enabled', '1' );
	if ( osmosis_grve_browser_webkit_check() && '1' == $smooth_scroll ) {
		wp_enqueue_script( 'grve-smoothscrolling-script', get_template_directory_uri() . '/js/smoothscrolling.js', array( 'jquery' ), '1.4.9', true );
	}

	$grve_retina_data = array(
		'retina_support' => grve_option( 'retina_support', 'default' ),
	);

	if ( '1' == grve_option( 'combine_js', '1' ) ) {
		wp_enqueue_script( 'grve-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), esc_attr( $grve_ver ), true );

		wp_localize_script( 'grve-plugins', 'grve_retina_data', $grve_retina_data );
	} else {
		wp_enqueue_script( 'osmosis-grve-libs', get_template_directory_uri() . '/js/plugins/grve.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/plugins/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'jquery.transit', get_template_directory_uri() . '/js/plugins/jquery.transit.min.js', array( 'jquery' ), '0.9.9', true );
		wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/plugins/retina.min.js', array( 'jquery' ), '1.3.0', true );
		wp_enqueue_script( 'countup', get_template_directory_uri() . '/js/plugins/countUp.min.js', array( 'jquery' ), '1.3.1', true );
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/plugins/fitvids.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/js/plugins/jquery.appear.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/js/plugins/owl.carousel.min.js', array( 'jquery' ), '1.3.3', true );
		wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/plugins/stellar.min.js', array( 'jquery' ), '0.6.2', true );
		wp_enqueue_script( 'hoverdir', get_template_directory_uri() . '/js/plugins/hoverdir.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-easypiechart', get_template_directory_uri() . '/js/plugins/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.6', true );
		wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/js/plugins/jquery.countdown.min.js', array( 'jquery' ), '2.1.0', true );

		wp_localize_script( 'retina', 'grve_retina_data', $grve_retina_data );
	}

	wp_enqueue_script( 'grve-smartresize-script', get_template_directory_uri() . '/js/smartresize.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'grve-isotope-script', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'grve-packery-mode-script', get_template_directory_uri() . '/js/packery-mode.pkgd.min.js', array( 'jquery' ), '0.1.0', true );
	wp_enqueue_script( 'grve-main-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), esc_attr( $grve_ver ), true );
	$grve_row_stellar_auto = apply_filters( 'grve_row_stellar_auto', '1' );
	$grve_main_data = array(
		'siteurl' => get_template_directory_uri() ,
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'grve_wp_gallery_popup' => grve_option( 'wp_gallery_popup', '0' ),
		'grve_row_stellar_auto' => $grve_row_stellar_auto,
		'grve_string_weeks' => esc_html__( 'Weeks', 'osmosis' ),
		'grve_string_days' => esc_html__( 'Days', 'osmosis' ),
		'grve_string_hours' => esc_html__( 'Hours', 'osmosis' ),
		'grve_string_minutes' => esc_html__( 'Min', 'osmosis' ),
		'grve_string_seconds' => esc_html__( 'Sec', 'osmosis' ),
		'nonce_likes' => wp_create_nonce( 'osmosis-grve-likes' ),
	);
	wp_localize_script( 'grve-main-script', 'grve_main_data', $grve_main_data );
	if ( function_exists( 'wp_add_inline_script' ) ) {
		wp_add_inline_script( 'grve-main-script', grve_get_privacy_cookie_script() );
	}

}
add_action( 'wp_enqueue_scripts', 'grve_frontend_scripts' );

/**
 * Pagination functions
 */
function grve_paginate_links() {
?>
	<div class="grve-pagination">
	<?php
		global $wp_query;
		$big = 999999999;
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'prev_text'    => "<i class='grve-icon-nav-left'></i>",
			'next_text'    => "<i class='grve-icon-nav-right'></i>",
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'add_args' => false,
		) );
	?>
	</div>
<?php
}

function grve_wp_link_pages() {
?>
	<?php
		$args = array(
			'before'           => '<p>',
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => "<i class='grve-icon-nav-right'></i>",
			'previouspagelink' => "<i class='grve-icon-nav-left'></i>",
			'pagelink'         => '%',
			'echo'             => 1
		);
	?>
	<div class="grve-pagination">
	<?php wp_link_pages( $args ); ?>
	</div>
<?php
}

function grve_pagination( $pages = '', $range = 2 ) {

	global $wp_query;

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	$total = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if( $total > 1 )  {
		 echo '<div class="grve-pagination">';

		 if( get_option('permalink_structure') ) {
			 $format = 'page/%#%/';
		 } else {
			 $format = '&paged=%#%';
		 }
		 echo paginate_links(array(
			'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'		=> $format,
			'current'		=> max( 1, $paged ),
			'total'			=> $total,
			'mid_size'		=> 2,
			'type'			=> 'list',
			'prev_text'    => "<i class='grve-icon-nav-left'></i>",
			'next_text'    => "<i class='grve-icon-nav-right'></i>",
			'add_args' => false,
		 ));
		 echo '</div>';
	}
}

/**
 * Comments
 */
function grve_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li class="grve-comment-item">
		<!-- Comment -->
		<article id="comment-<?php comment_ID(); ?>"  <?php comment_class(); ?>>
			<?php echo get_avatar( $comment, 50 ); ?>
			<div class="grve-comment-content">

				<h6 class="grve-author">
					<a href="<?php comment_author_url( $comment->comment_ID ); ?>"><?php comment_author(); ?></a>
				</h6>
				<div class="grve-comment-date">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( ' %1$s ' . esc_html__( 'at', 'osmosis' ) . ' %2$s', get_comment_date(),  get_comment_time() ); ?></a>
				</div>
				<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_attr__( 'REPLY', 'osmosis' ) ) ) ); ?>
				<?php edit_comment_link( esc_html__( 'EDIT', 'osmosis' ), '  ', '' ); ?>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'osmosis' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
		</article>

	<!-- </li> is added by WordPress automatically -->
<?php
}

/**
 * Avatar additional Class
 */
function grve_add_gravatar_class( $class ) {
    $class = str_replace( "class='avatar", "class='avatar grve-circle", $class );
    return $class;
}
add_filter('get_avatar','grve_add_gravatar_class');

/**
 * Navigation links for prev/next in comments
 */
function grve_replace_reply_link_class( $output ) {
	$class = 'grve-btn grve-primary grve-btn-extrasmall grve-comment-reply';
	return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $class, $output, 1 );
}
add_filter('comment_reply_link', 'grve_replace_reply_link_class');

function grve_replace_edit_link_class( $output ) {
	$class = 'grve-btn grve-primary grve-btn-extrasmall grve-comment-edit';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $class, $output, 1 );
}
add_filter('edit_comment_link', 'grve_replace_edit_link_class');

/**
 * Main Navigation FallBack Menu
 */
function grve_fallback_menu(){

	echo '<ul class="grve-menu">';
	wp_list_pages('title_li=&sort_column=menu_order');
	echo '</ul>';
}

/**
 * Title Render Fallback before WordPress 4.1
 */
 if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function grve_theme_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'grve_theme_render_title' );
}

/**
 * Theme identifier function
 * Used to get theme information
 */
function osmosis_grve_info() {

	$grve_info = array (
		"version" => OSMOSIS_GRVE_THEME_VERSION,
		"short_name" => OSMOSIS_GRVE_THEME_SHORT_NAME,
	);

	return $grve_info;
}

/**
 * Add max srcset
 */
if ( ! function_exists( 'grve_max_srcset_image_width' ) ) {
	function grve_max_srcset_image_width( $max_image_width, $size_array ) {
		return 1920;
	}
}
add_filter( 'max_srcset_image_width', 'grve_max_srcset_image_width', 10 , 2 );

/**
 * VC Control Fix
 */
if ( ! function_exists( 'grve_vc_control_scripts' ) ) {
	function grve_vc_control_scripts() {
?>
	<script type="text/javascript">
	jQuery(document).on('click','.vc_ui-button[data-vc-ui-element="button-save"]', function(e){
		if ( vc !== undefined && vc.edit_form_callbacks !== undefined ) { vc.edit_form_callbacks=[]; }
	});
	jQuery(document).on('click','.vc_ui-button[data-vc-ui-element="button-close"]', function(e){
		if ( vc !== undefined && vc.edit_form_callbacks !== undefined ) { vc.edit_form_callbacks=[]; }
	});
	jQuery(document).on('click','.vc_ui-control-button[data-vc-ui-element="button-close"]', function(e){
		if ( vc !== undefined && vc.edit_form_callbacks !== undefined ) { vc.edit_form_callbacks=[]; }
	});
	</script>
<?php
	}
}
add_action('admin_print_footer_scripts', 'grve_vc_control_scripts');


/**
 * Theme Migration
 */
if ( ! function_exists( 'osmosis_grve_theme_migration' ) ) {
	function osmosis_grve_theme_migration() {
		$osmosis_grve_theme_migration = get_option( 'osmosis_grve_theme_migration' );
		$change = false;
		if ( empty( $osmosis_grve_theme_migration ) || version_compare( $osmosis_grve_theme_migration, '4.0', '<' ) ) {
			$ext_options = get_option( 'osmosis_grve_ext_options' );
			if ( empty( $ext_options ) ) {
				$ext_options = array();
			}
			$head_code = grve_array_value( $ext_options, 'head_code' );
			$old_code = grve_option( 'tracking_code_custom' );
			if ( !empty( $old_code ) && empty( $head_code ) ) {
				$ext_options['head_code'] = $old_code;
				$change = true;
			}
			$id = grve_array_value( $ext_options, 'tracking_id' );
			$old_id = grve_option( 'tracking_code' );
			if ( !empty( $old_id ) && empty( $id ) ) {
				$ext_options['tracking_id'] = $old_id;
				$change = true;
			}
			if ( $change ) {
				update_option( 'osmosis_grve_ext_options', $ext_options );
			}
			update_option( 'osmosis_grve_theme_migration', '4.0' );
		}
	}
} 
//Omit closing PHP tag to avoid accidental whitespace output errors.


//Decripciòn de producto
/*add_action( 'woocommerce_after_shop_loop_item_title', 'dcms_show_description_item_product', 10, 0 );

function dcms_show_description_item_product() { 
	global $product;
	$chars_quantity = 100; //cantidad de caracteres a mostrar
	
	//Obtenemos la información del producto
	$product_details = $product->get_data();
	$short_description = $product_details['short_description'];

	//limpieza
	$short_description = strip_shortcodes($short_description);
	$short_description = wp_strip_all_tags($short_description);

	//recorte caracteres
	$short_description = substr($short_description, 0, $chars_quantity);
	$short_description = substr($short_description, 0, strripos($short_description, ' '));

	//mostrar descripción
	echo "<div class='dcms-item-description'>".$short_description."...</div>";
}*/