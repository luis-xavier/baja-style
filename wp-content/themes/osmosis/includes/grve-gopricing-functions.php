<?php

/*
*	Go Pricing helper functions and configuration
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Helper function to check if GoPricing is enabled
 */
function grve_go_pricing_enabled() {
	if ( class_exists( 'GW_GoPricing' ) ) {
		return true;
	}
	return false;
}

//If GoPricing plugin is not enabled return
if ( !grve_go_pricing_enabled() ) {
	return false;
}

function grve_vc_remove_go_pricing_update_page() {
	$updater = grve_visibility( 'go_pricing_updater' );
	if( !$updater ) {
		remove_submenu_page( 'go-pricing', 'go-pricing-update' );
	}
}
add_action( 'admin_menu', 'grve_vc_remove_go_pricing_update_page', 999 );

//Omit closing PHP tag to avoid accidental whitespace output errors.
