<?php
/*
*	Greatives Woo Product Meta
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'save_post', 'osmosis_grve_product_options_save_postdata', 10, 2 );

	$grve_product_options = array (

		array(
			'name' => 'Product Layout',
			'id' => 'grve_product_layout',
		),
		array(
			'name' => 'Product Sidebar',
			'id' => 'grve_product_sidebar',
		),
		array(
			'name' => 'Sidebar Background Color',
			'id' => 'grve_sidebar_bg_color',
		),
		array(
			'name' => 'Fixed Sidebar',
			'id' => 'grve_fixed_sidebar',
		),
		array(
			'name' => 'Disable Breadcrumbs',
			'id' => 'grve_disable_breadcrumbs',
		),
		array(
			'name' => 'Disable Bottom Bar',
			'id' => 'grve_disable_bottom_bar',
		),
		array(
			'name' => 'Disable Footer',
			'id' => 'grve_disable_footer',
		),

	);

	function osmosis_grve_product_layout_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_product_save_nonce' );

		$product_layout = get_post_meta( $post->ID, 'grve_product_layout', true );
		$product_sidebar = get_post_meta( $post->ID, 'grve_product_sidebar', true );
		$fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
		$sidebar_bg_color = get_post_meta( $post->ID, 'grve_sidebar_bg_color', true );
		$grve_disable_breadcrumbs = get_post_meta( $post->ID, 'grve_disable_breadcrumbs', true );
		$grve_disable_bottom_bar= get_post_meta( $post->ID, 'grve_disable_bottom_bar', true );
		$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<th>
						<label for="grve-product-layout">
							<strong><?php esc_html_e( 'Layout', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select product content and sidebar alignment.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default: Right Sidebar', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_layout_selection( $product_layout, 'grve-product-layout', 'grve_product_layout' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-product-sidebar">
							<strong><?php esc_html_e( 'Sidebar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select product sidebar.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default: Shop Product Pages', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_sidebar_selection( $product_sidebar, 'grve-product-sidebar', 'grve_product_sidebar' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-sidebar-color">
							<strong><?php esc_html_e( 'Sidebar Background Color', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select sidebar background color.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default: None', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-sidebar-bg-color" name="grve_sidebar_bg_color">
							<option value=""><?php esc_html_e( 'Default', 'osmosis' ); ?></option>
							<option value="none"><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							<?php grve_print_media_color_selection($sidebar_bg_color); ?>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-fixed-sidebar">
							<strong><?php esc_html_e( 'Fixed Sidebar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, sidebar will be fixed.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-fixed-sidebar" name="grve_fixed_sidebar" value="yes" <?php checked( $fixed_sidebar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-breadcrumbs">
							<strong><?php esc_html_e( 'Disable Breadcrumbs', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, breadcrumbs will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-breadcrumbs" name="grve_disable_breadcrumbs" value="yes" <?php checked( $grve_disable_breadcrumbs, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-bottom-bar">
							<strong><?php esc_html_e( 'Disable Bottom Bar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, bottom bar will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-bottom-bar" name="grve_disable_bottom_bar" value="yes" <?php checked( $grve_disable_bottom_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-footer">
							<strong><?php esc_html_e( 'Disable Footer Widgets', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, footer widgets will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-footer" name="grve_disable_footer" value="yes" <?php checked( $grve_disable_footer, 'yes' ); ?>/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}

	function osmosis_grve_product_options_save_postdata( $post_id , $post ) {
		global $grve_product_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['grve_product_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_product_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'product' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $grve_product_options as $value ) {
			$allow_html = ( isset( $value['html'] ) ? $value['html'] : false );
			if( $allow_html ) {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? wp_filter_post_kses( $_POST[$value['id']] ) : '' );
			} else {
				$new_meta_value = ( isset( $_POST[$value['id']] ) ? sanitize_text_field( $_POST[$value['id']] ) : '' );
			}
			$meta_key = $value['id'];


			$meta_value = get_post_meta( $post_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
