<?php
/*
*	Greatives Portfolio Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'save_post', 'osmosis_grve_portfolio_options_save_postdata', 10, 2 );

	$grve_portfolio_options = array (
		array(
			'name' => 'Description',
			'id' => 'grve_portfolio_description',
			'html' => true,
		),
		array(
			'name' => 'Layout',
			'id' => 'grve_portfolio_layout',
		),
		array(
			'name' => 'Sidebar',
			'id' => 'grve_portfolio_sidebar',
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
			'name' => 'Details',
			'id' => 'grve_portfolio_details',
			'html' => true,
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
			'name' => 'Disable Fields Bar',
			'id' => 'grve_disable_portfolio_fields_bar',
		),
		array(
			'name' => 'Disable Recent',
			'id' => 'grve_disable_portfolio_recent',
		),
		array(
			'name' => 'Disable Comments',
			'id' => 'grve_disable_comments',
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
		//Media
		array(
			'name' => 'Media Selection',
			'id' => 'grve_portfolio_media_selection',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => 'grve_portfolio_media_image_mode',
		),
		array(
			'name' => 'Video webm format',
			'id' => 'grve_portfolio_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => 'grve_portfolio_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => 'grve_portfolio_video_ogv',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => 'grve_portfolio_video_embed',
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
		//Link Mode
		array(
			'name' => 'Link Mode',
			'id' => 'grve_portfolio_link_mode',
		),
		array(
			'name' => 'Link URL',
			'id' => 'grve_portfolio_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => 'grve_portfolio_link_new_window',
		),
		array(
			'name' => 'Link Extra Class',
			'id' => 'grve_portfolio_link_extra_class',
		),
	);

	function osmosis_grve_portfolio_link_mode_box( $post ) {

		$link_mode = get_post_meta( $post->ID, 'grve_portfolio_link_mode', true );
		$link_url = get_post_meta( $post->ID, 'grve_portfolio_link_url', true );
		$new_window = get_post_meta( $post->ID, 'grve_portfolio_link_new_window', true );
		$link_class = get_post_meta( $post->ID, 'grve_portfolio_link_extra_class', true );
	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select link mode for Portfolio Overview (Used in Portfolio Element Link Type: Custom Link).', 'osmosis' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-portfolio-link-mode">
							<strong><?php esc_html_e( 'Link Mode', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select Link Mode', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-portfolio-link-mode" name="grve_portfolio_link_mode">
							<option value="" <?php selected( '', $link_mode ); ?>><?php esc_html_e( 'Portfolio Item', 'osmosis' ); ?></option>
							<option value="link" <?php selected( 'link', $link_mode ); ?>><?php esc_html_e( 'Custom Link', 'osmosis' ); ?></option>
							<option value="none" <?php selected( 'none', $link_mode ); ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-portfolio-custom-link-mode" <?php if ( "link" != $link_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-link-url">
							<strong><?php esc_html_e( 'Link URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter the full URL of your link.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-link-url" class="grve-meta-text" name="grve_portfolio_link_url" value="<?php echo esc_attr( $link_url ); ?>" />
					</td>
				</tr>
				<tr class="grve-portfolio-custom-link-mode" <?php if ( "link" != $link_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-link-new-window">
							<strong><?php esc_html_e( 'Open Link in new window', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, link will open in a new window.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-portfolio-link-new-window" name="grve_portfolio_link_new_window" <?php if ( $new_window ) { ?> checked="checked" <?php } ?>/>
					</td>
				</tr>
				<tr class="grve-portfolio-custom-link-mode" <?php if ( "link" != $link_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-link-extra-class">
							<strong><?php esc_html_e( 'Link extra class name', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-link-extra-class" class="grve-meta-text" name="grve_portfolio_link_extra_class" value="<?php echo esc_attr( $link_class ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>


	<?php

	}
	function osmosis_grve_portfolio_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_save_nonce' );

		$portfolio_description = get_post_meta( $post->ID, 'grve_portfolio_description', true );
		$portfolio_details = get_post_meta( $post->ID, 'grve_portfolio_details', true );
		$portfolio_layout = get_post_meta( $post->ID, 'grve_portfolio_layout', true );
		$portfolio_sidebar = get_post_meta( $post->ID, 'grve_portfolio_sidebar', true );
		$fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
		$sidebar_bg_color = get_post_meta( $post->ID, 'grve_sidebar_bg_color', true );

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
		$grve_disable_top_bar = get_post_meta( $post->ID, 'grve_disable_top_bar', true );
		$grve_disable_portfolio_fields_bar = get_post_meta( $post->ID, 'grve_disable_portfolio_fields_bar', true );
		$grve_disable_portfolio_recent = get_post_meta( $post->ID, 'grve_disable_portfolio_recent', true );
		$grve_disable_comments = get_post_meta( $post->ID, 'grve_disable_comments', true );

		$grve_disable_bottom_bar = get_post_meta( $post->ID, 'grve_disable_bottom_bar', true );
		$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
		$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-portfolio-description">
							<strong><?php esc_html_e( 'Description', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter your portfolio description.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-description" class="grve-meta-text" name="grve_portfolio_description" value="<?php echo esc_attr( $portfolio_description ); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-details">
							<strong><?php esc_html_e( 'Project Details', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter your project details.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<textarea id="grve-portfolio-details" name="grve_portfolio_details" cols="40" rows="5"><?php echo esc_textarea( $portfolio_details ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-layout">
							<strong><?php esc_html_e( 'Layout', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select portfolio content and sidebar alignment.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Portfolio Options.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_layout_selection( $portfolio_layout, 'grve-portfolio-layout', 'grve_portfolio_layout' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-sidebar">
							<strong><?php esc_html_e( 'Sidebar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select portfolio sidebar.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Portfolio Options.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_sidebar_selection( $portfolio_sidebar, 'grve-portfolio-sidebar', 'grve_portfolio_sidebar' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-sidebar-color">
							<strong><?php esc_html_e( 'Sidebar Background Color', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select sidebar background color.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Appearance - Customize - Colors - Sidebars - Portfolio Sidebar Background Color', 'osmosis' ); ?></strong>
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
				<tr>
					<th>
						<label for="grve-disable-portfolio-fields-bar">
							<strong><?php esc_html_e( 'Disable Fields Bar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, fields bar will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-portfolio-fields-bar" name="grve_disable_portfolio_fields_bar" value="yes" <?php checked( $grve_disable_portfolio_fields_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-portfolio-recent">
							<strong><?php esc_html_e( 'Disable Recent Entries', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, recent entries will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-portfolio-recent" name="grve_disable_portfolio_recent" value="yes" <?php checked( $grve_disable_portfolio_recent, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-comments">
							<strong><?php esc_html_e( 'Disable Comments', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, comments will be hidden.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-comments" name="grve_disable_comments" value="yes" <?php checked( $grve_disable_comments, 'yes' ); ?>/>
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

	function osmosis_grve_portfolio_media_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_media_save_nonce' );
		$portfolio_media = get_post_meta( $post->ID, 'grve_portfolio_media_selection', true );
		$portfolio_image_mode = get_post_meta( $post->ID, 'grve_portfolio_media_image_mode', true );

		$grve_portfolio_video_webm = get_post_meta( $post->ID, 'grve_portfolio_video_webm', true );
		$grve_portfolio_video_mp4 = get_post_meta( $post->ID, 'grve_portfolio_video_mp4', true );
		$grve_portfolio_video_ogv = get_post_meta( $post->ID, 'grve_portfolio_video_ogv', true );
		$grve_portfolio_video_embed = get_post_meta( $post->ID, 'grve_portfolio_video_embed', true );

		$media_slider_items = get_post_meta( $post->ID, 'grve_portfolio_slider_items', true );
		$media_slider_settings = get_post_meta( $post->ID, 'grve_portfolio_slider_settings', true );
		$media_slider_speed = grve_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = grve_array_value( $media_slider_settings, 'direction_nav', '2' );

	?>
			<table class="form-table grve-metabox">
				<tbody>
					<tr>
						<th>
							<label for="grve-portfolio-media-selection">
								<strong><?php esc_html_e( 'Media Selection', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Choose your portfolio media.', 'osmosis' ); ?>
									<br/>
									<strong><?php esc_html_e( 'In overview only Featured Image is displayed.', 'osmosis' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-selection" name="grve_portfolio_media_selection">
								<option value="" <?php if ( "" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'Featured Image', 'osmosis' ); ?></option>
								<option value="gallery" <?php if ( "gallery" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'Classic Gallery', 'osmosis' ); ?></option>
								<option value="gallery-vertical" <?php if ( "gallery-vertical" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'Vertical Gallery', 'osmosis' ); ?></option>
								<option value="slider" <?php if ( "slider" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'Slider', 'osmosis' ); ?></option>
								<option value="video" <?php if ( "video" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'osmosis' ); ?></option>
								<option value="video-html5" <?php if ( "video-html5" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'HMTL5 Video', 'osmosis' ); ?></option>
								<option value="none" <?php if ( "none" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							</select>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-webm">
								<strong><?php esc_html_e( 'WebM File URL', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .webm video file.', 'osmosis' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'osmosis' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_webm" value="<?php echo esc_attr( $grve_portfolio_video_webm ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-mp4">
								<strong><?php esc_html_e( 'MP4 File URL', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .mp4 video file.', 'osmosis' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'osmosis' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_mp4" value="<?php echo esc_attr( $grve_portfolio_video_mp4 ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-ogv">
								<strong><?php esc_html_e( 'OGV File URL', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .ogv video file (optional).', 'osmosis' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_ogv" value="<?php echo esc_attr( $grve_portfolio_video_ogv ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-embed"<?php if ( "video" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-embed">
								<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'osmosis' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-embed" class="grve-meta-text" name="grve_portfolio_video_embed" value="<?php echo esc_attr( $grve_portfolio_video_embed ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-media-image-mode"<?php if ( "slider" != $portfolio_media || "gallery-vertical" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-media-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'osmosis' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-image-mode" name="grve_portfolio_media_image_mode">
								<option value="" <?php selected( '', $portfolio_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'osmosis' ); ?></option>
								<option value="resize" <?php selected( 'resize', $portfolio_image_mode ); ?>><?php esc_html_e( 'Resize', 'osmosis' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-speed" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'osmosis' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="grve-page-slider-speed" name="grve_portfolio_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-direction-nav" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'osmosis' ); ?></strong>
							</label>
						</th>
						<td>
							<select name="grve_portfolio_slider_settings_direction_nav">
								<option value="1" <?php selected( "1", $media_slider_dir_nav ); ?>>
									<?php esc_html_e( 'Style 1', 'osmosis' ); ?>
								</option>
								<option value="2" <?php selected( "2", $media_slider_dir_nav ); ?>>
									<?php esc_html_e( 'Style 2', 'osmosis' ); ?>
								</option>
								<option value="3" <?php selected( "3", $media_slider_dir_nav ); ?>>
									<?php esc_html_e( 'Style 3', 'osmosis' ); ?>
								</option>
								<option value="4" <?php selected( "4", $media_slider_dir_nav ); ?>>
									<?php esc_html_e( 'Style 4', 'osmosis' ); ?>
								</option>
								<option value="0" <?php selected( "0", $media_slider_dir_nav ); ?>>
									<?php esc_html_e( 'No Navigation', 'osmosis' ); ?>
								</option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label><?php esc_html_e( 'Media Items', 'osmosis' ); ?></label>
						</th>
						<td>
							<input type="button" class="grve-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images', 'osmosis' ); ?>"/>
							<span id="grve-upload-slider-button-spinner" class="grve-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="grve-slider-container" data-mode="minimal" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
				<?php
					if( !empty( $media_slider_items ) ) {
						grve_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>


	<?php
	}

	function osmosis_grve_portfolio_feature_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_feature_save_nonce' );

		$post_id = $post->ID;
		grve_admin_get_feature_section( $post_id );

	}

	function osmosis_grve_portfolio_options_save_postdata( $post_id , $post ) {
		global $grve_portfolio_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['grve_portfolio_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_portfolio_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'portfolio' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $grve_portfolio_options as $value ) {
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

		if ( isset( $_POST['grve_portfolio_media_save_nonce'] ) && wp_verify_nonce( $_POST['grve_portfolio_media_save_nonce'], 'grve_nonce_save' ) ) {


			//Media Slider Items
			$media_slider_items = array();
			if ( isset( $_POST['grve_media_slider_item_id'] ) ) {

				$num_of_images = sizeof( $_POST['grve_media_slider_item_id'] );
				for ( $i=0; $i < $num_of_images; $i++ ) {

					$this_image = array (
						'id' => sanitize_text_field( $_POST['grve_media_slider_item_id'][ $i ] ),
					);
					array_push( $media_slider_items, $this_image );
				}

			}

			if( empty( $media_slider_items ) ) {
				delete_post_meta( $post->ID, 'grve_portfolio_slider_items' );
				delete_post_meta( $post->ID, 'grve_portfolio_slider_settings' );
			} else{
				update_post_meta( $post->ID, 'grve_portfolio_slider_items', $media_slider_items );

				$media_slider_speed = 3500;
				$media_slider_direction_nav = 'yes';
				if ( isset( $_POST['grve_portfolio_slider_settings_speed'] ) ) {
					$media_slider_speed = sanitize_text_field( $_POST['grve_portfolio_slider_settings_speed'] );
				}
				if ( isset( $_POST['grve_portfolio_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = sanitize_text_field( $_POST['grve_portfolio_slider_settings_direction_nav'] );
				}
				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
				);
				update_post_meta( $post->ID, 'grve_portfolio_slider_settings', $media_slider_settings );
			}

		}

		if ( isset( $_POST['grve_portfolio_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_portfolio_feature_save_nonce'], 'grve_nonce_save' ) ) {

			grve_admin_save_feature_section( $post_id );

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
