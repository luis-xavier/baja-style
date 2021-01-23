<?php
/*
 * Plugin Name: Osmosis Extension
 * Description: This plugin extends Page Builder and adds custom post type capabilities.
 * Author: Greatives Team
 * Author URI: http://greatives.eu
 * Version: 4.2.2
 * Text Domain: grve-osmosis-vc-extension
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'GRVE_OSMOSIS_VC_EXT_VERSION' ) ) {
	define( 'GRVE_OSMOSIS_VC_EXT_VERSION', '4.2.2' );
}
if ( ! defined( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH' ) ) {
	define( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL' ) ) {
	define( 'GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! class_exists( 'GRVE_OSMOSIS_VC_Extension_Plugin' ) ) {

	class GRVE_OSMOSIS_VC_Extension_Plugin {

		/**
		 * @action plugins_loaded
		 * @return GRVE_OSMOSIS_VC_Extension_Plugin
		 * @static
		 */
		public static function init() {

			static $instance = false;

			if ( ! $instance ) {
				load_plugin_textdomain( 'grve-osmosis-vc-extension' , false , dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
				$instance = new GRVE_OSMOSIS_VC_Extension_Plugin;
			}
			return $instance;

		}

		/* Add Page Builder Plugin*/

		private function __construct() {

			if ( is_user_logged_in() ) {
				add_action( 'admin_enqueue_scripts' , $this->marshal( 'grve_vc_extension_add_scripts' ) );
			}
			add_action( 'wp_enqueue_scripts' , $this->marshal( 'grve_vc_extension_add_front_end_scripts' ) );

			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-ext-metaboxes.php';
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-functions.php';
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-add-param.php';
			require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-shortcode-param.php';


			//Shortcodes
			if( function_exists( 'vc_lean_map' ) || function_exists( 'vc_map' ) ) {

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_title.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_divider.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_list.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_button.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_quote.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_dropcap.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_slogan.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_callout.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_progress_bar.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_pricing_table.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_message_box.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_icon.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_icon_box.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_image_text.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_media_box.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_single_image.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_gallery.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_slider.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_video.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_social.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_gmap.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_team.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_blog.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_portfolio.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_testimonial.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_promo.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_counter.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_countdown.php';

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_pie_chart.php';
				if ( class_exists( 'GW_GoPricing' ) && !class_exists( 'GW_GoPricing_VCExtend' ) ) {
					require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_go_pricing.php';
				}

				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_gtracking.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_gmaps.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_gfonts.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_video_embeds.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_required.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_policy_page_link.php';
				require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'shortcodes/grve_privacy_preferences_link.php';
			}

		}

		public function grve_osmosis_vc_extension_plugin() {
			$this->__construct();
		}

		public function grve_vc_extension_add_scripts( $hook ) {
			wp_enqueue_style('grve-vc-elements', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-vc-elements.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-icon-box', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-icon-preview.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-multi-checkbox', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/grve-multi-checkbox.css', array(), time(), 'all');
			wp_enqueue_style('grve-vc-simple-line-icons', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/simple-line-icons.css', array(), '2.2.3', 'all');
		}

		public function grve_vc_extension_add_front_end_scripts() {
			wp_register_style( 'grve-vc-simple-line-icons', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/css/simple-line-icons.css', array(), '2.2.3', 'all' );
		}

		public function marshal( $method_name ) {
			return array( &$this , $method_name );
		}
	}

	/**
	 * Initialize the Page Builder Extension Plugin
	 */
	add_action( 'init' , array( 'GRVE_OSMOSIS_VC_Extension_Plugin' , 'init' ), 12 );

	/**
	 * Initialize Custom Post Types
	 */
	function grve_osmosis_vce_rewrite_flush() {
		grve_osmosis_vce_register_custom_post_init();
		flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'grve_osmosis_vce_rewrite_flush' );

	function grve_osmosis_vce_register_custom_post_init() {
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-portfolio-post-type.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-testimonial-post-type.php';
	}
	add_action( 'init', 'grve_osmosis_vce_register_custom_post_init', 9 );

	function grve_osmosis_vce_body_class( $classes ){
		$ext_ver = 'grve-vce-ver-' . GRVE_OSMOSIS_VC_EXT_VERSION;
		return array_merge( $classes, array( $ext_ver ) );
	}
	add_filter( 'body_class', 'grve_osmosis_vce_body_class' );

	require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/grve-ext-global-functions.php';

	/**
	 * Widgets
	 */
	function grve_osmosis_vce_register_widgets() {
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-latest-combo.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-latest-comments.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-latest-portfolio.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-latest-posts.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-social.php';
		require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'widgets/grve-widget-contact-info.php';
		register_widget( 'Osmosis_Ext_Widget_Latest_Combo' );
		register_widget( 'Osmosis_Ext_Widget_Latest_Comments' );
		register_widget( 'Osmosis_Ext_Widget_Latest_Portfolio' );
		register_widget( 'Osmosis_Ext_Widget_Latest_Posts' );
		register_widget( 'Osmosis_Ext_Widget_Social' );
		register_widget( 'Osmosis_Ext_Widget_Contact_Info' );
	}
	add_action( 'widgets_init', 'grve_osmosis_vce_register_widgets' );

	/**
	 *Admin Menu
	 */
	require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/admin/grve-ext-admin-functions.php';

}

//Omit closing PHP tag to avoid accidental whitespace output errors.