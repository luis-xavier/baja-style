<?php
/*
*	Greatives Post Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'save_post', 'osmosis_grve_post_options_save_postdata', 10, 2 );

	$grve_post_options = array (

		array(
			'name' => 'Post Layout',
			'id' => 'grve_post_layout',
		),
		array(
			'name' => 'Post Sidebar',
			'id' => 'grve_post_sidebar',
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
			'name' => 'Disable Media Area',
			'id' => 'grve_disable_media',
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

		//Gallery Format
		array(
			'name' => 'Media Mode',
			'id' => 'grve_post_type_gallery_mode',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => 'grve_post_type_gallery_image_mode',
		),
		//Link Format
		array(
			'name' => 'Link URL',
			'id' => 'grve_post_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => 'grve_post_link_new_window',
		),
		//Audio Format
		array(
			'name' => 'Audio Mode',
			'id' => 'grve_post_type_audio_mode',
		),
		array(
			'name' => 'Audio mp3 format',
			'id' => 'grve_post_audio_mp3',
		),
		array(
			'name' => 'Audio ogg format',
			'id' => 'grve_post_audio_ogg',
		),
		array(
			'name' => 'Audio wav format',
			'id' => 'grve_post_audio_wav',
		),
		array(
			'name' => 'Audio embed',
			'id' => 'grve_post_audio_embed',
			'html' => true,
		),
		//Video Format
		array(
			'name' => 'Video Mode',
			'id' => 'grve_post_type_video_mode',
		),
		array(
			'name' => 'Video webm format',
			'id' => 'grve_post_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => 'grve_post_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => 'grve_post_video_ogv',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => 'grve_post_video_embed',
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

	function osmosis_grve_post_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_post_save_nonce' );

		$post_layout = get_post_meta( $post->ID, 'grve_post_layout', true );
		$post_sidebar = get_post_meta( $post->ID, 'grve_post_sidebar', true );
		$fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
		$sidebar_bg_color = get_post_meta( $post->ID, 'grve_sidebar_bg_color', true );
		$grve_disable_title = get_post_meta( $post->ID, 'grve_disable_title', true );
		$grve_disable_safe_button = get_post_meta( $post->ID, 'grve_disable_safe_button', true );
		$grve_disable_breadcrumbs = get_post_meta( $post->ID, 'grve_disable_breadcrumbs', true );
		$grve_disable_top_bar= get_post_meta( $post->ID, 'grve_disable_top_bar', true );
		$grve_disable_media = get_post_meta( $post->ID, 'grve_disable_media', true );
		$grve_disable_bottom_bar= get_post_meta( $post->ID, 'grve_disable_bottom_bar', true );
		$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
		$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );

		$grve_post_title_bg = get_post_meta( $post->ID, 'grve_post_title_bg', true );
		$grve_post_title_bg_mode = grve_array_value( $grve_post_title_bg, 'mode' );
		$grve_post_title_bg_image = grve_array_value( $grve_post_title_bg, 'image' );
		$grve_post_title_bg_position = grve_array_value( $grve_post_title_bg, 'position', 'center-center' );
		$grve_post_title_bg_height = grve_array_value( $grve_post_title_bg, 'height', '350' );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<th>
						<label for="grve-post-layout">
							<strong><?php esc_html_e( 'Layout', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select post content and sidebar alignment.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Blog Options - Single Post.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_layout_selection( $post_layout, 'grve-post-layout', 'grve_post_layout' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-post-sidebar">
							<strong><?php esc_html_e( 'Sidebar', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select post sidebar.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Theme Options - Blog Options - Single Post.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_sidebar_selection( $post_sidebar, 'grve-post-sidebar', 'grve_post_sidebar' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-sidebar-color">
							<strong><?php esc_html_e( 'Sidebar Background Color', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select sidebar background color.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Default is configured in Appearance - Customize - Colors - Sidebars - Post Sidebar Background Color', 'osmosis' ); ?></strong>
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
						<label for="grve-disable-title">
							<strong><?php esc_html_e( 'Disable Title', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, title will be hidden.', 'osmosis' ); ?>
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
						<label for="grve-disable-media">
							<strong><?php esc_html_e( 'Disable Media Area', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, media area will be hidden in single post.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-media" name="grve_disable_media" value="yes" <?php checked( $grve_disable_media, 'yes' ); ?>/>
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
				<tr>
					<th>
						<label for="grve-post-title-bg-mode">
							<strong><?php esc_html_e( 'Title Background Image', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select title background mage.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'Note: Featured/Custom title is not available for simple style.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-title-bg-mode" name="grve_post_title_bg_mode">
							<option value="" <?php selected( '', $grve_post_title_bg_mode ); ?>><?php esc_html_e( 'Default', 'osmosis' ); ?></option>
							<option value="featured" <?php selected( 'featured', $grve_post_title_bg_mode ); ?>><?php esc_html_e( 'Featured', 'osmosis' ); ?></option>
							<option value="custom" <?php selected( 'custom', $grve_post_title_bg_mode ); ?>><?php esc_html_e( 'Custom', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-post-title-bg grve-post-title-bg-position"<?php if ( "" == $grve_post_title_bg_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-title-bg-position">
							<strong><?php esc_html_e( 'Title Background Image Position', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select the background position.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-title-bg-position" name="grve_post_title_bg_position">
							<?php grve_print_media_bg_position_selection( $grve_post_title_bg_position ); ?>
						</select>
					</td>
				</tr>
				<tr class="grve-post-title-bg grve-post-title-bg-height"<?php if ( "" == $grve_post_title_bg_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-title-bg-height">
							<strong><?php esc_html_e( 'Title Height', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select height of title. Default is 350.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-title-bg-height" name="grve_post_title_bg_height" value="<?php echo esc_attr( $grve_post_title_bg_height ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-title-bg grve-post-title-bg-image"<?php if ( "custom" != $grve_post_title_bg_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-title-bg-image">
							<strong><?php esc_html_e( 'Title Bakcground image URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the background image.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-title-bg-image" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_title_bg_image" value="<?php echo esc_attr( $grve_post_title_bg_image ); ?>"/>
						<input type="button" data-media-type="image" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Image', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}


	function osmosis_grve_meta_box_post_format_gallery( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_post_format_gallery_save_nonce' );
		$gallery_mode = get_post_meta( $post->ID, 'grve_post_type_gallery_mode', true );
		$gallery_image_mode = get_post_meta( $post->ID, 'grve_post_type_gallery_image_mode', true );

		$slider_items = get_post_meta( $post->ID, 'grve_post_slider_items', true );
		$media_slider_settings = get_post_meta( $post->ID, 'grve_post_slider_settings', true );
		$media_slider_speed = grve_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = grve_array_value( $media_slider_settings, 'direction_nav', '2' );
		$format = get_post_format( $post->ID );
		if ( !$format ) {
			$format = 'standard';
		}
	?>

			<table class="form-table grve-metabox">
				<tbody>
					<tr class="grve-border-bottom">
						<th>
							<label for="grve-post-gallery-mode">
								<strong><?php esc_html_e( 'Gallery Mode', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select Gallery mode.', 'osmosis' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-post-gallery-mode" name="grve_post_type_gallery_mode">
								<option value="" <?php selected( '', $gallery_mode ); ?>><?php esc_html_e( 'Gallery', 'osmosis' ); ?></option>
								<option value="slider" <?php selected( 'slider', $gallery_mode ); ?>><?php esc_html_e( 'Slider', 'osmosis' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-post-gallery-image-mode-section" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-gallery-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'osmosis' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'osmosis' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-post-gallery-image-mode" name="grve_post_type_gallery_image_mode">
								<option value="" <?php selected( '', $gallery_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'osmosis' ); ?></option>
								<option value="resize" <?php selected( 'resize', $gallery_image_mode ); ?>><?php esc_html_e( 'Resize', 'osmosis' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-post-media-slider-speed" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'osmosis' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="grve-post-slider-speed" name="grve_post_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="grve-post-media-slider-direction-nav" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'osmosis' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="grve-post-slider-direction-nav" name="grve_post_slider_settings_direction_nav">
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
					<tr>
						<th>
							<label><?php esc_html_e( 'Images', 'osmosis' ); ?></label>
						</th>
						<td>
							<input type="button" class="grve-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Gallery/Slider', 'osmosis' ); ?>"/>
							<span id="grve-upload-slider-button-spinner" class="grve-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="grve-slider-container" class="grve-slider-container-minimal" data-mode="minimal">
				<?php
					if( !empty( $slider_items ) ) {
						grve_print_admin_media_slider_items( $slider_items );
					}
				?>
			</div>
	<?php
	}


	function osmosis_grve_meta_box_post_format_link( $post ) {
		$link_url = get_post_meta( $post->ID, 'grve_post_link_url', true );
		$new_window = get_post_meta( $post->ID, 'grve_post_link_new_window', true );
	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Add your text in the content area. The text will be wrapped with a link.', 'osmosis' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-post-link-url">
							<strong><?php esc_html_e( 'Link URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter the full URL of your link.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-link-url" class="grve-meta-text" name="grve_post_link_url" value="<?php echo esc_attr( $link_url ); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-post-link-new-window">
							<strong><?php esc_html_e( 'Open Link in new window', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'If selected, link will open in a new window.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-post-link-new-window" name="grve_post_link_new_window" <?php if ( $new_window ) { ?> checked="checked" <?php } ?>/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}

	function osmosis_grve_meta_box_post_format_quote( $post ) {
	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Simply add some text in the content area. This text will automatically displayed as quote.', 'osmosis' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function osmosis_grve_meta_box_post_format_video( $post ) {

		$video_mode = get_post_meta( $post->ID, 'grve_post_type_video_mode', true );
		$grve_post_video_webm = get_post_meta( $post->ID, 'grve_post_video_webm', true );
		$grve_post_video_mp4 = get_post_meta( $post->ID, 'grve_post_video_mp4', true );
		$grve_post_video_ogv = get_post_meta( $post->ID, 'grve_post_video_ogv', true );
		$grve_post_video_embed = get_post_meta( $post->ID, 'grve_post_video_embed', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured video.', 'osmosis' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-post-type-video-mode">
							<strong><?php esc_html_e( 'Video Mode', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Video Mode', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-type-video-mode" name="grve_post_type_video_mode">
							<option value="" <?php if ( "" == $video_mode ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'osmosis' ); ?></option>
							<option value="html5" <?php if ( "html5" == $video_mode ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'HTML5 Video', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-webm">
							<strong><?php esc_html_e( 'WebM File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .webm video file.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_webm" value="<?php echo esc_attr( $grve_post_video_webm ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-mp4">
							<strong><?php esc_html_e( 'MP4 File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp4 video file.', 'osmosis' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'osmosis' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_mp4" value="<?php echo esc_attr( $grve_post_video_mp4 ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-ogv">
							<strong><?php esc_html_e( 'OGV File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogv video file (optional).', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_ogv" value="<?php echo esc_attr( $grve_post_video_ogv ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-embed"<?php if ( "html5" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-embed">
							<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-embed" class="grve-meta-text" name="grve_post_video_embed" value="<?php echo esc_attr( $grve_post_video_embed ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function osmosis_grve_meta_box_post_format_audio( $post ) {

		$audio_mode = get_post_meta( $post->ID, 'grve_post_type_audio_mode', true );
		$grve_post_audio_mp3 = get_post_meta( $post->ID, 'grve_post_audio_mp3', true );
		$grve_post_audio_ogg = get_post_meta( $post->ID, 'grve_post_audio_ogg', true );
		$grve_post_audio_wav = get_post_meta( $post->ID, 'grve_post_audio_wav', true );
		$grve_post_audio_embed = get_post_meta( $post->ID, 'grve_post_audio_embed', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured audio.', 'osmosis' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-post-type-audio-mode">
							<strong><?php esc_html_e( 'Audio Mode', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Audio Mode', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-type-audio-mode" name="grve_post_type_audio_mode">
							<option value="" <?php if ( "" == $audio_mode ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'Embed Audio', 'osmosis' ); ?></option>
							<option value="html5" <?php if ( "html5" == $audio_mode ) { ?> selected="selected" <?php } ?>><?php esc_html_e( 'HTML5 Audio', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-mp3">
							<strong><?php esc_html_e( 'MP3 File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp3 audio file.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-mp3" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_mp3" value="<?php echo esc_attr( $grve_post_audio_mp3 ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-ogg">
							<strong><?php esc_html_e( 'OGG File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogg audio file.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-ogg" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_ogg" value="<?php echo esc_attr( $grve_post_audio_ogg ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-wav">
							<strong><?php esc_html_e( 'WAV File URL', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .wav audio file (optional).', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-wav" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_wav" value="<?php echo esc_attr( $grve_post_audio_wav ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-embed"<?php if ( "html5" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-embed">
							<strong><?php esc_html_e( 'Audio embed code', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type your audio embed code.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<textarea id="grve-post-audio-embed" name="grve_post_audio_embed" cols="40" rows="5"><?php echo esc_textarea( $grve_post_audio_embed ); ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function osmosis_grve_post_feature_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_post_feature_save_nonce' );

		$post_id = $post->ID;
		grve_admin_get_feature_section( $post_id );

	}

	function osmosis_grve_post_options_save_postdata( $post_id , $post ) {
		global $grve_post_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['grve_post_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_post_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'post' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		foreach ( $grve_post_options as $value ) {
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

		//Backgroound Image Title
		if ( isset( $_POST['grve_post_title_bg_mode'] ) ) {

			$bg_item = array (
				'mode' => sanitize_text_field( $_POST['grve_post_title_bg_mode'] ),
				'image' => sanitize_text_field( $_POST['grve_post_title_bg_image'] ),
				'position' => sanitize_text_field( $_POST['grve_post_title_bg_position'] ),
				'height' => sanitize_text_field( $_POST['grve_post_title_bg_height'] ),
			);
			update_post_meta( $post_id, 'grve_post_title_bg', $bg_item );

		} else {
			delete_post_meta( $post_id, 'grve_post_title_bg' );
		}

		if ( isset( $_POST['grve_post_format_gallery_save_nonce'] ) && wp_verify_nonce( $_POST['grve_post_format_gallery_save_nonce'], 'grve_nonce_save' ) ) {


			//Feature Slider Items
			$slider_items = array();
			if ( isset( $_POST['grve_media_slider_item_id'] ) ) {

				$num_of_images = sizeof( $_POST['grve_media_slider_item_id'] );
				for ( $i=0; $i < $num_of_images; $i++ ) {

					$this_image = array (
						'id' => sanitize_text_field( $_POST['grve_media_slider_item_id'][ $i ] ),
					);
					array_push( $slider_items, $this_image );
				}

			}

			if( empty( $slider_items ) ) {
				delete_post_meta( $post->ID, 'grve_post_slider_items' );
				delete_post_meta( $post->ID, 'grve_post_slider_settings' );
			} else{
				update_post_meta( $post->ID, 'grve_post_slider_items', $slider_items );
				$media_slider_speed = 3500;
				$media_slider_direction_nav = '1';
				if ( isset( $_POST['grve_post_slider_settings_speed'] ) ) {
					$media_slider_speed = sanitize_text_field( $_POST['grve_post_slider_settings_speed'] );
				}
				if ( isset( $_POST['grve_post_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = sanitize_text_field( $_POST['grve_post_slider_settings_direction_nav'] );
				}
				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
				);
				update_post_meta( $post->ID, 'grve_post_slider_settings', $media_slider_settings );
			}

		}

		if ( isset( $_POST['grve_post_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_post_feature_save_nonce'], 'grve_nonce_save' ) ) {

			grve_admin_save_feature_section( $post_id );

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
