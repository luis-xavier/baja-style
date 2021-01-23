<?php
/*
*	Admin Functions
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function osmosis_ext_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
		if ( function_exists( 'osmosis_grve_info') ) {
			add_submenu_page( 'osmosis', esc_html__('Custom Codes','grve-osmosis-vc-extension'), esc_html__('Custom Codes','grve-osmosis-vc-extension'), 'edit_theme_options', 'osmosis-codes', 'osmosis_ext_admin_page_html_codes' );
		} else {
			add_menu_page( 'Osmosis', 'Osmosis', 'edit_theme_options', 'osmosis', 'osmosis_ext_admin_page_html_codes', GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/images/adminmenu/theme.png', 4 );
			add_submenu_page( 'osmosis', esc_html__('Custom Codes','grve-osmosis-vc-extension'), esc_html__('Custom Codes','grve-osmosis-vc-extension'), 'edit_theme_options', 'osmosis-codes', 'osmosis_ext_admin_page_html_codes' );
		}
	}
}
add_action( 'admin_menu', 'osmosis_ext_admin_menu', 11 );


function osmosis_ext_admin_page_html_codes(){
	require_once GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_PATH . 'includes/admin/grve-ext-admin-page-codes.php';
}

function osmosis_ext_admin_links( $active_tab = 'status' ){
?>
	<a href="?page=osmosis-codes" class="nav-tab <?php echo 'codes' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Custom Codes','grve-osmosis-vc-extension'); ?></a>
<?php
}
add_action( 'osmosis_grve_admin_links', 'osmosis_ext_admin_links' );

function osmosis_ext_add_settings() {

	if ( isset( $_POST['_osmosis_ext_options_nonce_save'] ) && wp_verify_nonce( $_POST['_osmosis_ext_options_nonce_save'], 'osmosis_ext_options_nonce_save' ) ) {

		if ( isset( $_POST['osmosis_grve_ext_options'] ) ) {
			$options = get_option('osmosis_grve_ext_options');

			$keys = array_keys( $_POST['osmosis_grve_ext_options'] );
			foreach ( $keys as $key ) {
				if ( isset( $_POST['osmosis_grve_ext_options'][$key] ) ) {
					$options[$key] = $_POST['osmosis_grve_ext_options'][$key];
				}
			}
			if ( empty( $options ) ) {
				delete_option( 'osmosis_grve_ext_options' );
			} else {
				update_option( 'osmosis_grve_ext_options', $options );
			}
		}
		wp_safe_redirect( 'admin.php?page=osmosis-codes&ext-settings=saved' );
	}
}
add_action( 'admin_menu', 'osmosis_ext_add_settings' );


if ( !function_exists('osmosis_ext_print_tracking_code') ) {
	function osmosis_ext_print_tracking_code() {
		$options = get_option('osmosis_grve_ext_options');
		$code = grve_osmosis_vce_array_value( $options, 'tracking_id' );
		if ( !empty( $code ) ) {
?>
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $code ); ?>"></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());
			  gtag('config', '<?php echo esc_attr( $code ); ?>');
			</script>
<?php
		}
	}
}
add_action('wp_head', 'osmosis_ext_print_tracking_code');

if ( !function_exists('osmosis_ext_print_head_code') ) {
	function osmosis_ext_print_head_code() {
		$options = get_option('osmosis_grve_ext_options');
		$code = grve_osmosis_vce_array_value( $options, 'head_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('wp_head', 'osmosis_ext_print_head_code');

if ( !function_exists('osmosis_ext_print_body_code') ) {
	function osmosis_ext_print_body_code() {
		$options = get_option('osmosis_grve_ext_options');
		$code = grve_osmosis_vce_array_value( $options, 'body_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('grve_body_top', 'osmosis_ext_print_body_code');

if ( !function_exists('osmosis_ext_print_footer_code') ) {
	function osmosis_ext_print_footer_code() {
		$options = get_option('osmosis_grve_ext_options');
		$code = grve_osmosis_vce_array_value( $options, 'footer_code' );
		if ( !empty( $code ) ) {
			echo wp_unslash( $code );
		}
	}
}
add_action('wp_footer', 'osmosis_ext_print_footer_code');

//Omit closing PHP tag to avoid accidental whitespace output errors.
