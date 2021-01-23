<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/includes/plugins/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'grve_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function grve_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		'js_composer' => array(
			'name'					=> __( "WPBakery Page Builder", 'osmosis' ),
			'slug'					=> 'js_composer',
			'source'				=> get_template_directory() . '/includes/plugins/js_composer.zip',
			'required'				=> true,
			'version'				=> '6.4.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
		),
		'grve-osmosis-vc-extension' => array(
			'name'					=> __( "Osmosis Extension", 'osmosis' ),
			'slug'					=> 'grve-osmosis-vc-extension',
			'source'				=> get_template_directory() . '/includes/plugins/grve-osmosis-vc-extension.zip',
			'required'				=> true,
			'version'				=> '4.2.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
			'is_callable'			=> '',
		),
 		'grve-osmosis-dummy-importer' => array(
			'name'					=> __( "Osmosis Demo Importer", 'osmosis' ),
			'slug'					=> 'grve-osmosis-dummy-importer',
			'source'				=> get_template_directory() . '/includes/plugins/grve-osmosis-dummy-importer.zip',
			'required'				=> false,
			'version'				=> '4.1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
			'is_callable'			=> '',
		),
		'revslider' => array(
			'name'					=> __( "Revolution Slider", 'osmosis' ),
			'slug'					=> 'revslider',
			'source'				=> get_template_directory() . '/includes/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '6.2.23',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
			'is_callable'			=> '',
		),
		'go_pricing' => array(
			'name'					=> __( "Go Pricing - WordPress Responsive Pricing Tables", 'osmosis' ),
			'slug'					=> 'go_pricing',
			'source'				=> get_template_directory() . '/includes/plugins/go_pricing.zip',
			'required'				=> false,
			'version'				=> '3.3.17',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
			'is_callable'			=> '',
		),
		'envato-market' => array(
			'name'					=> __( "Envato Market", 'osmosis' ),
			'slug'					=> 'envato-market',
			'source'				=> get_template_directory() . '/includes/plugins/envato-market.zip',
			'required'				=> false,
			'version'				=> '2.0.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url'			=> '',
			'is_callable'			=> '',
		),
		'mailchimp-for-wp' => array(
			'name'					=> __( "MailChimp for WordPress", 'osmosis' ),
			'slug'					=> 'mailchimp-for-wp',
			'required'				=> false,
		),
		'contact-form-7' => array(
			'name'				=> __( "Contact Form 7", 'osmosis' ),
			'slug'				=> 'contact-form-7',
			'required'			=> false,
		),
		'woocommerce' => array(
			'name'				=> __( "WooCommerce", 'osmosis' ),
			'slug'				=> 'woocommerce',
			'required'			=> false,
			'force_activation'	=> false,
		),

	);

	$plugins = apply_filters( 'osmosis_grve_recommended_plugins', $plugins );

	/**
	* Array of configuration settings. Amend each line as needed.
	* If you want the default strings to be available under your own theme domain,
	* leave the strings uncommented.
	* Some of the strings are added into a sprintf, so see the comments at the
	* end of each line for what each argument will be.
	*/
	$config = array(
		'id'           => 'osmosis-tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'osmosis-tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'admin.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'nag_type'	=> 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}

/**
 * Add tgmpa to theme menu
 */
function osmosis_grve_admin_menu_args($args) {
    $args['parent_slug'] = 'osmosis';
    return $args;
}
add_filter( 'tgmpa_admin_menu_args', 'osmosis_grve_admin_menu_args' );

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'grve_vc_set_as_theme' );
if ( ! function_exists( 'grve_vc_set_as_theme' ) ) {
	function grve_vc_set_as_theme() {
		vc_set_as_theme();
	}
}

/**
 * Remove Visual Composer Redirect on activation
 */
remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
remove_action( 'init', 'vc_page_welcome_redirect' );

/**
 * Remove Revolution Slider Notices
 */
remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));

//Omit closing PHP tag to avoid accidental whitespace output errors.
