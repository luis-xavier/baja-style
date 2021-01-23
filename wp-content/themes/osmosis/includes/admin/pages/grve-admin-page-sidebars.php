<?php
/*
*	Admin Custom Sidebars
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$osmosis_grve_custom_sidebars = get_option( 'grve-osmosis-custom-sidebars' );
?>
	<div id="grve-sidebar-wrap" class="wrap">
		<h2><?php esc_html_e( "Sidebars", 'osmosis' ); ?></h2>
		<?php osmosis_grve_print_admin_links('sidebars'); ?>
		<br/>
		<?php if( isset( $_GET['sidebar-settings'] ) ) { ?>
		<div class="grve-sidebar-saved updated inline grve-notice-green">
			<p><strong><?php esc_html_e('Settings Saved!', 'osmosis' ); ?></strong></p>
		</div>
		<?php } ?>
		<div class="grve-sidebar-changed updated inline grve-notice-green">
			<p><strong><?php esc_html_e('Settings have changed, you should save them!', 'osmosis' ); ?></strong></p>
		</div>
		<form method="post" action="admin.php?page=osmosis-sidebars">
			<table class="grve-sidebar-table widefat" cellspacing="0">
				<thead>
					<tr>
						<th>
							<input type="button" id="grve-add-custom-sidebar-item" class="button button-primary" value="<?php esc_html_e('Add Sidebar', 'osmosis' ); ?>"/>
							<span class="grve-sidebar-spinner"></span>
						</th>
						<th>
							<input type="text" class="grve-sidebar-text" id="grve-custom-sidebar-item-name-new" value=""/>
							<div class="grve-sidebar-notice grve-notice-red" style="display:none;">
								<strong><?php esc_html_e('Field must not be empty!', 'osmosis' ); ?></strong>
							</div>
							<div class="grve-sidebar-notice-exists grve-notice-red" style="display:none;">
								<strong><?php esc_html_e('Sidebar with this name already exists!', 'osmosis' ); ?></strong>
							</div>
						</th>
					</tr>
				</thead>
				<tbody id="grve-custom-sidebar-container">
					<?php osmosis_grve_print_admin_custom_sidebars( $osmosis_grve_custom_sidebars ); ?>
				</tbody>
				<tfoot>
					<tr>
						<td><?php submit_button(); ?></td>
						<td>&nbsp;</td>
					</tr>
				</tfoot>
			</table>
			<?php wp_nonce_field( 'osmosis_grve_nonce_sidebar_save', '_osmosis_grve_nonce_sidebar_save' ); ?>

		</form>
	</div>
<?php


//Omit closing PHP tag to avoid accidental whitespace output errors.
