<?php

/*
 *	Helper Global functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

/**
 * Get allowed HTML for microdata
 */

function osmosis_ext_print_select_options( $selector_array, $current_value = "" ) {

	foreach ( $selector_array as $value=>$display_value ) {
	?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_value, $value ); ?>><?php echo esc_html( $display_value ); ?></option>
	<?php
	}

}

function osmosis_ext_get_microdata_allowed_html() {
	$allowed_html = array(
		'span' => array(
			'title' => true,
			'class' => true,
			'id' => true,
			'dir' => true,
			'align' => true,
			'lang' => true,
			'xml:lang' => true,
			'aria-hidden' => true,
			'data-icon' => true,
			'itemref' => true,
			'itemid' => true,
			'itemprop' => true,
			'itemscope' => true,
			'itemtype' => true,
			'xmlns:v' => true,
			'typeof' => true,
			'property' => true
		),
		'br' => array(),
	);

	return $allowed_html;
}

/**
 * Get allowed HTML for widget titles
 */
function osmosis_ext_get_widget_allowed_html() {
	$allowed_html = array(
		'div' => array(
			'class' => true,
			'id' => true,
		),
		'h1' => array(
			'class' => true,
		),
		'h2' => array(
			'class' => true,
		),
		'h3' => array(
			'class' => true,
		),
		'h4' => array(
			'class' => true,
		),
		'h5' => array(
			'class' => true,
		),
		'h6' => array(
			'class' => true,
		),
		'br' => array(),
	);

	return $allowed_html;
}

function osmosis_ext_vc_disable_updater() {
	$auto_updater = true;
	if ( function_exists( 'grve_visibility' ) ) {
		$auto_updater = grve_visibility( 'vc_auto_updater' );
		}
	if( !$auto_updater ) {
		global $vc_manager;

		if ( $vc_manager && method_exists( $vc_manager , 'updater' ) ) {
			$updater = $vc_manager->updater();
			remove_filter( 'upgrader_pre_download', array( $updater, 'preUpgradeFilter' ), 10, 4 );
			remove_action( 'wp_ajax_nopriv_vc_check_license_key', array( $updater, 'checkLicenseKeyFromRemote' ) );

			if ( $updater && method_exists( $updater , 'updateManager' ) ) {
				$updatingManager = $updater->updateManager();
				remove_filter( 'pre_set_site_transient_update_plugins', array( $updatingManager, 'check_update' ) );
				remove_filter( 'plugins_api', array( $updatingManager, 'check_info' ), 10, 3 );
				if ( function_exists( 'vc_plugin_name' ) ) {
					remove_action( 'after_plugin_row_' . vc_plugin_name(), 'wp_plugin_update_row', 10, 2 );
					remove_action( 'in_plugin_update_message-' . vc_plugin_name(), array( $updatingManager, 'addUpgradeMessageLink' ) );
				}
			}

		}
		if ( $vc_manager && method_exists( $vc_manager , 'license' ) ) {
			$license = $vc_manager->license();
			remove_action( 'admin_notices', array( $license, 'adminNoticeLicenseActivation' ) );
		}
	}
	if ( function_exists( 'vc_plugin_name' ) && function_exists( 'osmosis_grve_vc_updater_notification' ) ) {
		add_action( 'in_plugin_update_message-' . vc_plugin_name(), 'osmosis_grve_vc_updater_notification', 11 );
	}
}
add_action( 'admin_init', 'osmosis_ext_vc_disable_updater', 99 );

function osmosis_ext_disable_go_pricing_updater() {
	$updater = true;
	if( function_exists( 'grve_visibility' )  ) {
		$updater = grve_visibility( 'go_pricing_updater' );
	}
	if ( !$updater && class_exists( 'GW_GoPricing_Update' ) ) {
		$go_pricing_update = GW_GoPricing_Update::instance();
		remove_filter( 'pre_set_site_transient_update_plugins', array( $go_pricing_update, 'check_update' ) );
		remove_filter( 'plugins_api', array( $go_pricing_update, 'update_info' ), 10, 3 );
		remove_action( 'after_plugin_row_' . 'go_pricing/go_pricing.php', 'wp_plugin_update_row', 10, 2 );
	}
}
add_action( 'admin_init', 'osmosis_ext_disable_go_pricing_updater', 99 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
