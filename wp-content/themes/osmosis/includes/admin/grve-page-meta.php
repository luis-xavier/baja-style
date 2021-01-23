<?php
/*
*	Greatives Page Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'save_post', 'osmosis_grve_page_options_save_postdata', 10, 2 );

	$grve_page_options = array (
		array(
			'name' => 'Description',
			'id' => 'grve_page_description',
			'html' => true,
		),
		array(
			'name' => 'Page Layout',
			'id' => 'grve_page_layout',
		),
		array(
			'name' => 'Page Sidebar',
			'id' => 'grve_page_sidebar',
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
			'name' => 'Page Navigation Anchor Menu',
			'id' => 'grve_page_navigation_menu',
		),
		array(
			'name' => 'Main Navigation Menu',
			'id' => 'grve_main_navigation_menu',
		),
		array(
			'name' => 'Main Navigation Menu Type',
			'id' => 'grve_main_navigation_menu_type',
		),
		array(
			'name' => 'Go To Section',
			'id' => 'grve_go_to_section',
		),
		array(
			'name' => 'Disable Sticky',
			'id' => 'grve_disable_sticky',
		),
		array(
			'name' => 'Disable Logo',
			'id' => 'grve_disable_logo',
		),
		array(
			'name' => 'Disable Menu',
			'id' => 'grve_disable_menu',
		),
		array(
			'name' => 'Disable Menu Items',
			'id' => 'grve_disable_menu_items',
		),
		array(
			'name' => 'Disable Title',
			'id' => 'grve_disable_title',
		),
		array(
			'name' => 'Disable Safe Button',
			'id' => 'grve_disable_safe_button',
		),
		array(
			'name' => 'Disable Breadcrumbs',
			'id' => 'grve_disable_breadcrumbs',
		),
		array(
			'name' => 'Disable Top Bar',
			'id' => 'grve_disable_top_bar',
		),
		array(
			'name' => 'Disable Content',
			'id' => 'grve_disable_content',
		),
		array(
			'name' => 'Disable Bottom Bar',
			'id' => 'grve_disable_bottom_bar',
		),
		array(
			'name' => 'Disable Footer',
			'id' => 'grve_disable_footer',
		),
		array(
			'name' => 'Disable Copyright',
			'id' => 'grve_disable_copyright',
		),
		//Feature Section
		array(
			'name' => 'Feature Element',
			'id' => 'grve_page_feature_element',
		),
		array(
			'name' => 'Feature Size',
			'id' => 'grve_page_feature_size',
		),
		array(
			'name' => 'Feature Height',
			'id' => 'grve_page_feature_height',
		),
		array(
			'name' => 'Feature Header Integration',
			'id' => 'grve_page_feature_header_integration',
		),
		array(
			'name' => 'Feature Header Position',
			'id' => 'grve_page_feature_header_position',
		),
		array(
			'name' => 'Feature Header Style',
			'id' => 'grve_page_feature_header_style',
		),
		array(
			'name' => 'Feature effect',
			'id' => 'grve_page_feature_effect',
		),
		array(
			'name' => 'Feature go to section',
			'id' => 'grve_page_feature_go_to_section',
		),
		array(
			'name' => 'Feature go to section Size',
			'id' => 'grve_page_feature_go_to_section_size',
		),
		array(
			'name' => 'Feature go to section Shape',
			'id' => 'grve_page_feature_go_to_section_shape',
		),
		array(
			'name' => 'Feature go to section Animation',
			'id' => 'grve_page_feature_go_to_section_animation',
		),
		array(
			'name' => 'Feature Revslider',
			'id' => 'grve_page_feature_revslider',
		),
	);

	function osmosis_grve_page_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_page_save_nonce' );

		$page_description = get_post_meta( $post->ID, 'grve_page_description', true );
		$page_layout = get_post_meta( $post->ID, 'grve_page_layout', true );
		$page_sidebar = get_post_meta( $post->ID, 'grve_page_sidebar', true );
		$fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
		$sidebar_bg_color = get_post_meta( $post->ID, 'grve_sidebar_bg_color', true );

		$page_navigation_menu = get_post_meta( $post->ID, 'grve_page_navigation_menu', true );
		$grve_main_navigation_menu = get_post_meta( $post->ID, 'grve_main_navigation_menu', true );
		$grve_main_navigation_menu_type = get_post_meta( $post->ID, 'grve_main_navigation_menu_type', true );
		$grve_go_to_section = get_post_meta( $post->ID, 'grve_go_to_section', true );

		$grve_disable_sticky = get_post_meta( $post->ID, 'grve_disable_sticky', true );
		$grve_disable_logo = get_post_meta( $post->ID, 'grve_disable_logo', true );
		$grve_disable_menu = get_post_meta( $post->ID, 'grve_disable_menu', true );
		$grve_disable_menu_items = get_post_meta( $post->ID, 'grve_disable_menu_items', true );
		$grve_disable_title = get_post_meta( $post->ID, 'grve_disable_title', true );
		$grve_disable_safe_button = get_post_meta( $post->ID, 'grve_disable_safe_button', true );
		$grve_disable_breadcrumbs = get_post_meta( $post->ID, 'grve_disable_breadcrumbs', true );
		$grve_disable_content = get_post_meta( $post->ID, 'grve_disable_content', true );
		$grve_disable_top_bar= get_post_meta( $post->ID, 'grve_disable_top_bar', true );
		$grve_disable_bottom_bar= get_post_meta( $post->ID, 'grve_disable_bottom_bar', true );
		$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
		$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-page-description">
							<strong><?php esc_html_e( 'Description', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter your page description.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-page-description" class="grve-meta-text" name="grve_page_description" value="<?php echo esc_attr( $page_description ); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-page-layout">
							<strong><?php esc_html_e( 'Layout', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select page content and sidebar alignment.', 'osmosis' ); ?>
								<br/>
								<?php if ( grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) { ?>
								<strong><?php esc_html_e( 'Default: Right Sidebar', 'osmosis' ); ?></strong>
								<?php } else { ?>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Page Options.', 'osmosis' ); ?></strong>
								<?php } ?>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_layout_selection( $page_layout, 'grve-page-layout', 'grve_page_layout' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-page-sidebar">
							<strong><?php esc_html_e( 'Sidebar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select page sidebar.', 'osmosis' ); ?>
								<br/>
								<?php if ( grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) { ?>
								<strong><?php esc_html_e( 'Default: Shop Overview Page', 'osmosis' ); ?></strong>
								<?php } else { ?>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Page Options.', 'osmosis' ); ?></strong>
								<?php } ?>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_sidebar_selection( $page_sidebar, 'grve-page-sidebar', 'grve_page_sidebar' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-sidebar-color">
							<strong><?php esc_html_e( 'Sidebar Background Color', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select sidebar background color.', 'osmosis' ); ?>
								<br/>
								<?php if ( grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) { ?>
								<strong><?php esc_html_e( 'Default: None', 'osmosis' ); ?></strong>
								<?php } else { ?>
								<strong><?php esc_html_e( 'Default is configured in Appearance - Customize - Colors - Sidebars - Page Sidebar Background Color.', 'osmosis' ); ?></strong>
								<?php } ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-sidebar-bg-color" name="grve_sidebar_bg_color">
							<option value="" <?php selected( '', $sidebar_bg_color ); ?>><?php esc_html_e( 'Default', 'osmosis' ); ?></option>
							<option value="none" <?php selected( 'none', $sidebar_bg_color ); ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							<?php grve_print_media_color_selection( $sidebar_bg_color ); ?>
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
						<label for="grve-page-navigation-menu">
							<strong><?php esc_html_e( 'Anchor Navigation Menu', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select page anchor navigation menu.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Only first level will be displayed.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_menu_selection( $page_navigation_menu, 'grve-page-navigation-menu', 'grve_page_navigation_menu' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-main-navigation-menu">
							<strong><?php esc_html_e( 'Main Navigation Menu', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select alternative main navigation menu.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default: Menus - Theme Locations - Header Menu.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_menu_selection( $grve_main_navigation_menu, 'grve-main-navigation-menu', 'grve_main_navigation_menu', 'default' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-main-navigation-menu-type">
							<strong><?php esc_html_e( 'Main Navigation Menu Type', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select main navigation menu type.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Appearance - Customize - Logo Background & Menu Type - Menu Type', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_menu_type_selection( $grve_main_navigation_menu_type, 'grve-main-navigation-menu-type', 'grve_main_navigation_menu_type' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-go-to-section">
							<strong><?php esc_html_e( 'Go To Section', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, all sections with Section ID will be enhanced with navigation.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-go-to-section" name="grve_go_to_section" value="yes" <?php checked( $grve_go_to_section, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-sticky-header">
							<strong><?php esc_html_e( 'Disable Sticky Header', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, sticky header will be disabled.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-sticky-header" name="grve_disable_sticky" value="yes" <?php checked( $grve_disable_sticky, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-logo">
							<strong><?php esc_html_e( 'Disable Logo', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, logo will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-logo" name="grve_disable_logo" value="yes" <?php checked( $grve_disable_logo, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-menu">
							<strong><?php esc_html_e( 'Disable Main Menu', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, main menu will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-menu" name="grve_disable_menu" value="yes" <?php checked( $grve_disable_menu, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-menu-items">
							<strong><?php esc_html_e( 'Disable Main Menu Items', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, main menu items will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-menu-items" name="grve_disable_menu_items" value="yes" <?php checked( $grve_disable_menu_items, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-title">
							<strong><?php esc_html_e( 'Disable Title/Description', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, title and decription will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-title" name="grve_disable_title" value="yes" <?php checked( $grve_disable_title, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-safe-button">
							<strong><?php esc_html_e( 'Disable Safe Button', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, safe button will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-safe-button" name="grve_disable_safe_button" value="yes" <?php checked( $grve_disable_safe_button, 'yes' ); ?>/>
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
						<label for="grve-disable-top-bar">
							<strong><?php esc_html_e( 'Disable Top Bar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, top bar will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-top-bar" name="grve_disable_top_bar" value="yes" <?php checked( $grve_disable_top_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<?php if ( grve_woocommerce_enabled() && $post->ID == wc_get_page_id( 'shop' ) ) { ?>
				<input type="hidden" name="grve_disable_content" value="" />
				<?php } else { ?>
				<tr>
					<th>
						<label for="grve-disable-content">
							<strong><?php esc_html_e( 'Disable Content Area', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, content area will be hidden (including sidebar and comments).', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-content" name="grve_disable_content" value="yes" <?php checked( $grve_disable_content, 'yes' ); ?>/>
					</td>
				</tr>
				<?php } ?>
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
				<tr>
					<th>
						<label for="grve-disable-copyright">
							<strong><?php esc_html_e( 'Disable Footer Copyright', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, footer copyright area will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-copyright" name="grve_disable_copyright" value="yes" <?php checked( $grve_disable_copyright, 'yes' ); ?>/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}

	function osmosis_grve_page_feature_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_page_feature_save_nonce' );

		$post_id = $post->ID;
		grve_admin_get_feature_section( $post_id );

	}

	function osmosis_grve_page_options_save_postdata( $post_id , $post ) {
		global $grve_page_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['grve_page_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_page_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'page' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $grve_page_options as $value ) {
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

		if ( isset( $_POST['grve_page_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_page_feature_save_nonce'], 'grve_nonce_save' ) ) {

			grve_admin_save_feature_section( $post_id );

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
