<?php

/*
*	Admin screen functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

function osmosis_grve_admin_menu(){
	if ( current_user_can( 'edit_theme_options' ) ) {
		add_menu_page( 'Osmosis', 'Osmosis', 'edit_theme_options', 'osmosis', 'osmosis_grve_admin_page_welcome', get_template_directory_uri() .'/includes/images/adminmenu/theme.png', 4 );
		add_submenu_page( 'osmosis', esc_html__('Welcome','osmosis'), esc_html__('Welcome','osmosis'), 'edit_theme_options', 'osmosis', 'osmosis_grve_admin_page_welcome' );
		add_submenu_page( 'osmosis', esc_html__('Status','osmosis'), esc_html__('Status','osmosis'), 'edit_theme_options', 'osmosis-status', 'osmosis_grve_admin_page_status' );
		add_submenu_page( 'osmosis', esc_html__( 'Custom Sidebars', 'osmosis' ), esc_html__( 'Custom Sidebars', 'osmosis' ), 'edit_theme_options','osmosis-sidebars','osmosis_grve_admin_page_sidebars');
		add_submenu_page( 'osmosis', esc_html__( 'Import Demos', 'osmosis' ), esc_html__( 'Import Demos', 'osmosis' ), 'edit_theme_options','osmosis-import','osmosis_grve_admin_page_import');
	}
}

add_action( 'admin_menu', 'osmosis_grve_admin_menu' );


function osmosis_grve_tgmpa_plugins_links(){
	osmosis_grve_print_admin_links('plugins');
}
add_action( 'osmosis_grve_before_tgmpa_plugins', 'osmosis_grve_tgmpa_plugins_links' );

function osmosis_grve_admin_page_welcome(){
	require_once get_template_directory() . '/includes/admin/pages/grve-admin-page-welcome.php';
}
function osmosis_grve_admin_page_status(){
	require_once get_template_directory() . '/includes/admin/pages/grve-admin-page-status.php';
}
function osmosis_grve_admin_page_sidebars(){
	require_once get_template_directory() . '/includes/admin/pages/grve-admin-page-sidebars.php';
}
function osmosis_grve_admin_page_import(){
	require_once get_template_directory() . '/includes/admin/pages/grve-admin-page-import.php';
}

function osmosis_grve_print_admin_links( $active_tab = 'status' ) {
?>
<h2 class="nav-tab-wrapper">
	<a href="?page=osmosis" class="nav-tab <?php echo 'welcome' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Welcome','osmosis'); ?></a>
	<a href="?page=osmosis-status" class="nav-tab <?php echo 'status' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Status','osmosis'); ?></a>
	<a href="?page=osmosis-sidebars" class="nav-tab <?php echo 'sidebars' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Custom Sidebars','osmosis'); ?></a>
	<a href="?page=osmosis-import" class="nav-tab <?php echo 'import' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Import Demos','osmosis'); ?></a>
	<a href="?page=osmosis-tgmpa-install-plugins" class="nav-tab <?php echo 'plugins' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__('Theme Plugins','osmosis'); ?></a>
	<?php do_action( 'osmosis_grve_admin_links', $active_tab ); ?>
</h2>
<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
