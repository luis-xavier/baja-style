<?php

/*
*	Theme update functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Display theme update notices in the admin area
 */
function osmosis_grve_admin_notices() {

	$message = '';
	if ( is_super_admin() ) {

		if ( ( defined( 'GRVE_OSMOSIS_VC_EXT_VERSION' ) && version_compare( '4.0', GRVE_OSMOSIS_VC_EXT_VERSION, '>' ) ) && !get_user_meta( get_current_user_id(), 'osmosis_grve_dismissed_notice_update_plugins', true ) ) {

			$plugins_link = 'admin.php?page=osmosis-tgmpa-install-plugins';
			$message = esc_html__( "Note: Osmosis v4 is a major theme release so be sure to update the required plugins, especially Osmosis Extension, to avoid any compatibility issues.", 'osmosis' ) .
						" <a href='" . esc_url( admin_url() . $plugins_link ) . "'>" . esc_html__( "Theme Plugins", 'osmosis' ) . "</a>";
			$message .=  '<br/><span><a href="' .esc_url( wp_nonce_url( add_query_arg( 'osmosis-grve-dismiss', 'dismiss_update_plugins_notice' ), 'osmosis-grve-dismiss-' . get_current_user_id() ) ) . '" class="dismiss-notice" target="_parent">' . esc_html__( "Dismiss this notice", 'osmosis' ) . '</a><span>';
			add_settings_error(
				'grve-theme-update-message',
				'plugins_update_required',
				$message,
				'updated'
			);
			if ( 'options-general' !== $GLOBALS['current_screen']->parent_base ) {
				settings_errors( 'grve-theme-update-message' );
			}

		}

		if ( !class_exists( 'Envato_Market' ) && !get_user_meta( get_current_user_id(), 'osmosis_grve_dismissed_notice_envato_market', true ) ) {

			$envato_market_link = 'admin.php?page=osmosis-tgmpa-install-plugins';
			$message = esc_html__( "Note:", "osmosis" ) . " " . esc_html__( "Envato official solution is recommended for theme updates using the new Envato Market API.", 'osmosis' ) .
					"<br/>" . esc_html__( "You can now update the theme using the", 'osmosis' ) . " " . "<a href='" . esc_url( admin_url() . $envato_market_link ) . "'>" . esc_html__( "Envato Market", 'osmosis' ) . "</a>" . " ". esc_html__( "plugin", 'osmosis' ) . "." .
					" " . esc_html__( "For more information read the related article in our", 'osmosis' ) . " " . "<a href='//docs.greatives.eu/tutorials/envato-market-wordpress-plugin-for-theme-updates/' target='_blank'>" . esc_html__( "documentation", 'osmosis' ) . "</a>.";

			$message .=  '<br/><span><a href="' .esc_url( wp_nonce_url( add_query_arg( 'osmosis-grve-dismiss', 'dismiss_envato_market_notice' ), 'osmosis-grve-dismiss-' . get_current_user_id() ) ) . '" class="dismiss-notice" target="_parent">' . esc_html__( "Dismiss this notice", 'osmosis' ) . '</a><span>';

			add_settings_error(
				'grve-envato-market-message',
				'plugins_update_required',
				$message,
				'updated'
			);
			if ( 'options-general' !== $GLOBALS['current_screen']->parent_base ) {
				settings_errors( 'grve-envato-market-message' );
			}

		}

	}

}
add_action( 'admin_notices', 'osmosis_grve_admin_notices' );

/**
 * Dismiss notices and update user meta data
 */
function osmosis_grve_notice_dismiss() {
	if ( isset( $_GET['osmosis-grve-dismiss'] ) && check_admin_referer( 'osmosis-grve-dismiss-' . get_current_user_id() ) ) {
		$dismiss = $_GET['osmosis-grve-dismiss'];
		if ( 'dismiss_envato_market_notice' == $dismiss ) {
			update_user_meta( get_current_user_id(), 'osmosis_grve_dismissed_notice_envato_market' , 1 );
		} else if ( 'dismiss_update_plugins_notice' == $dismiss ) {
			update_user_meta( get_current_user_id(), 'osmosis_grve_dismissed_notice_update_plugins' , 1 );
		}
	}
}
add_action( 'admin_head', 'osmosis_grve_notice_dismiss' );

/**
 * Delete metadata for admin notices when switching themes
 */
function osmosis_grve_update_dismiss() {
	delete_metadata( 'user', null, 'osmosis_grve_dismissed_notice_envato_market', null, true );
	delete_metadata( 'user', null, 'osmosis_grve_dismissed_notice_update_plugins', null, true );
}
add_action( 'switch_theme', 'osmosis_grve_update_dismiss' );


//Omit closing PHP tag to avoid accidental whitespace output errors.
