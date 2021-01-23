<?php
/*
*	Collection of functions for admin feature section
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Feature Single Image with ajax
 */
function grve_get_image_media() {

	check_ajax_referer( 'osmosis-grve-get-image-media', '_grve_nonce' );

	if( isset( $_POST['attachment_id'] ) ) {

		$media_id  = sanitize_text_field( $_POST['attachment_id'] );

		if( !empty( $media_id  ) ) {

			$image_item = array (
				'id' => $media_id,
			);

			grve_print_admin_feature_image_item( $image_item, "new" );

		}
	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_image_media', 'grve_get_image_media' );

/**
 * Get Replaced Image with ajax
 */
function grve_get_replaced_image() {

	check_ajax_referer( 'osmosis-grve-get-replaced-image', '_grve_nonce' );

	if( isset( $_POST['attachment_id'] ) ) {

		if ( isset( $_POST['attachment_mode'] ) && !empty( $_POST['attachment_mode'] ) ) {
			$mode = sanitize_text_field( $_POST['attachment_mode'] );
			switch( $mode ) {
				case 'image':
					$input_name = 'grve_image_item_id';
				break;
				case 'full-slider':
				default:
					$input_name = 'grve_slider_item_id[]';
				break;
			}
		} else {
			$input_name = 'grve_slider_item_id[]';
		}

		$media_id = sanitize_text_field( $_POST['attachment_id'] );
		$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
		$thumbnail_url = $thumb_src[0];
		$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
		$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';
?>
		<input type="hidden" value="<?php echo esc_attr( $media_id ); ?>" name="<?php echo esc_attr( $input_name ); ?>">
		<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
<?php

	}

	if( isset( $_POST['attachment_id'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_replaced_image', 'grve_get_replaced_image' );

/**
 * Get Single Feature Slider Media with ajax
 */
function grve_get_admin_feature_slider_media() {


	check_ajax_referer( 'osmosis-grve-get-feature-slider-media', '_grve_nonce' );

	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = sanitize_text_field( $_POST['attachment_ids'] );

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'id' => $media_id,
				);

				grve_print_admin_feature_slider_item( $slider_item, "new" );
			}
		}
	}

	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_admin_feature_slider_media', 'grve_get_admin_feature_slider_media' );

/**
 * Get Single Feature Map Point with ajax
 */
function grve_get_map_point() {

	check_ajax_referer( 'osmosis-grve-get-map-point', '_grve_nonce' );
	if( isset( $_POST['map_mode'] ) ) {
		$mode = sanitize_text_field( $_POST['map_mode'] );
		grve_print_admin_feature_map_point( array(), $mode );
	}
	if( isset( $_POST['map_mode'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_map_point', 'grve_get_map_point' );

/**
 * Prints Feature Map Points
 */
function grve_print_admin_feature_map_items( $map_items ) {

	if( !empty($map_items) ) {
		foreach ( $map_items as $map_item ) {
			grve_print_admin_feature_map_point( $map_item );
		}
	}

}

/**
 * Gets Admin Feature Setting Mode
 */
function grve_get_admin_feature_setting_mode() {

	$grve_setting_mode = grve_option( 'settings_mode','modal' );
	return $grve_setting_mode;

}

/**
 * Prints Admin Feature Setting
 */
function grve_print_admin_feature_setting( $item_type, $item_label, $item_name = '', $item_value = '', $item_meta_id = '', $item_meta_class = '' ) {

	$setting_class = 'grve-setting';
	if ( 'label' == $item_type ) {
		$setting_class = 'grve-setting grve-setting-label';
	}
	if( !empty( $item_meta_id ) ) {
		$item_meta_id = 'id="' . esc_attr( $item_meta_id ) . '"';
	}

	$item_attributes = array();
	if( !empty( $item_meta_class ) ) {
		$item_attributes[] = 'class="' . esc_attr( $item_meta_class ) . '"';
	}
	if( !empty( $item_meta_id ) ) {
		$item_attributes[] = 'id="' . esc_attr( $item_meta_id ) . '"';
	}
?>
	<li>
		<div class="<?php echo esc_attr( $setting_class ); ?>">
			<label><?php echo esc_html( $item_label ); ?></label>
			<?php if ( 'textfield' == $item_type ) { ?>

			<input type="text" name="<?php echo esc_attr( $item_name ); ?>" value="<?php echo esc_attr( $item_value ); ?>" <?php echo implode( ' ', $item_attributes ); ?>/>

			<?php } elseif ( 'textarea' == $item_type ) { ?>

				<textarea name="<?php echo esc_attr( $item_name ); ?>" cols="40" rows="3"><?php echo esc_textarea( $item_value ); ?></textarea>

			<?php } elseif ( 'select-boolean' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_boolean_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-color' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_color_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-tag' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_tag_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-style' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_style_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-header-style' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_header_style_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-align' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_align_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-text-animation' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_text_animation_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-button-target' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_button_target_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-button-color' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_button_color_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-button-size' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_button_size_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-button-shape' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_button_shape_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-button-type' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_button_type_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-pattern-overlay' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_pattern_overlay_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-color-overlay' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_color_overlay_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-opacity-overlay' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_opacity_overlay_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-bg-position' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_bg_position_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-bg-position-inherit' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_bg_position_inherit_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-bg-effect' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_bg_effect_selection( $item_value ); ?>
				</select>

			<?php } elseif ( 'select-bg-image-size' == $item_type ) { ?>

				<select name="<?php echo esc_attr( $item_name ); ?>" class="grve-modal-select">
					<?php grve_print_media_bg_image_size_selection( $item_value ); ?>
				</select>

			<?php } ?>
		</div>
	</li>
<?php
}

/**
 * Prints Feature Single Map Point
 */
function grve_print_admin_feature_map_point( $map_item, $mode = '' ) {


	$map_item_id = uniqid('grve_map_point_');
	$map_id = grve_array_value( $map_item, 'id', $map_item_id );

	$map_lat = grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = grve_array_value( $map_item, 'marker' );

	$map_title = grve_array_value( $map_item, 'title' );
	$map_infotext = grve_array_value( $map_item, 'info_text','' );
	$map_infotext_open = grve_array_value( $map_item, 'info_text_open','no' );

	$button_text = grve_array_value( $map_item, 'button_text' );
	$button_url = grve_array_value( $map_item, 'button_url' );
	$button_target = grve_array_value( $map_item, 'button_target', '_self' );
	$button_color = grve_array_value( $map_item, 'button_color', 'primary-1' );
	$button_class = grve_array_value( $map_item, 'button_class' );

	$grve_item_new = '';
	if( "new" == $mode ) {
		$grve_item_new = " grve-item-new";
	}
	$grve_settings_mode = grve_get_admin_feature_setting_mode();

?>
	<div class="grve-map-item postbox">
		<input class="grve-map-item-delete-button button<?php echo esc_attr( $grve_item_new ); ?>" type="button" value="<?php esc_attr_e( 'Delete', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php if( 'modal' == $grve_settings_mode ) { ?>
		<input class="grve-open-map-modal button-primary<?php echo esc_attr( $grve_item_new ); ?>" type="button" value="<?php esc_attr_e( 'Edit Settings', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php } ?>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-title">
			<span><?php esc_html_e( 'Map Point', 'osmosis' ); ?>: </span><span id="grve_map_item_point_title<?php echo esc_attr($map_id); ?>_admin_label"><?php if ( !empty ($map_title) ) { echo esc_html( $map_title ); } ?></span>
		</h3>
		<div class="inside">
			<input type="hidden" name="grve_map_item_point_id[]" value="<?php echo esc_attr( $map_id ); ?>"/>
			<ul class="grve-map-setting">
				<li>
					<div class="grve-setting">
						<label><?php esc_html_e( 'Latitude', 'osmosis' ); ?></label>
						<input type="text" name="grve_map_item_point_lat[]" value="<?php echo esc_attr( $map_lat ); ?>"/>
					</div>
				</li>
				<li>
					<div class="grve-setting">
						<label><?php esc_html_e( 'Longitude', 'osmosis' ); ?></label>
						<input type="text" name="grve_map_item_point_lng[]" value="<?php echo esc_attr( $map_lng ); ?>"/>
					</div>
				</li>
				<li>
					<div class="grve-setting">
						<label><?php esc_html_e( 'Marker', 'osmosis' ); ?></label>
						<input type="text" name="grve_map_item_point_marker[]" class="grve-upload-simple-media-field" value="<?php echo esc_attr( $map_marker ); ?>"/>
						<label></label>
						<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary<?php echo esc_attr( $grve_item_new ); ?>" value="<?php esc_attr_e( 'Insert Marker', 'osmosis' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button<?php echo esc_attr( $grve_item_new ); ?>" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
					</div>
				</li>
				<?php
					if( 'simple' == $grve_settings_mode ) {
						grve_print_admin_feature_setting( 'label', __( 'Title / Info Text', 'osmosis' ) );
						$grve_map_item_point_title_id = 'grve_map_item_point_title' . $map_id;
						grve_print_admin_feature_setting( 'textfield', __( 'Title', 'osmosis' ), 'grve_map_item_point_title[]', $map_title, $grve_map_item_point_title_id, 'grve-admin-label-update' );
						grve_print_admin_feature_setting( 'textarea', __( 'Info Text', 'osmosis' ), 'grve_map_item_point_infotext[]', $map_infotext );
						grve_print_admin_feature_setting( 'select-boolean', __( 'Open Info Text Onload', 'osmosis' ), 'grve_map_item_point_infotext_open[]', $map_infotext_open );
						grve_print_admin_feature_setting( 'label', __( 'Button', 'osmosis' ) );
						grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_map_item_point_button_text[]', $button_text );
						grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_map_item_point_button_url[]', $button_url );
						grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_map_item_point_button_target[]', $button_target );
						grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_map_item_point_button_color[]', $button_color );
						grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_map_item_point_button_class[]', $button_class );

					}
				?>
			</ul>
			<?php if( 'modal' == $grve_settings_mode ) { ?>
			<div class="grve-map-data-container">
				<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Title / Info Text', 'osmosis' ); ?>" data-meta-desc="">
				<input type="hidden" id="grve_map_item_point_title<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $map_title ); ?>" name="grve_map_item_point_title[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Title', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the title.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_infotext<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $map_infotext ); ?>" name="grve_map_item_point_infotext[]" data-meta-template="#grve-textarea-template" data-meta-title="<?php esc_attr_e( 'Info Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the info text.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_infotext_open<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $map_infotext_open ); ?>" name="grve_map_item_point_infotext_open[]" data-meta-template="#grve-select-boolean-template" data-meta-title="<?php esc_attr_e( 'Open Info Text onload', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select if you want to open the infotext by default.', 'osmosis' ); ?>">
				<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Button', 'osmosis' ); ?>" data-meta-desc="">
				<input type="hidden" id="grve_map_item_point_button_text<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_map_item_point_button_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_button_url<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_map_item_point_button_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_button_target<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_map_item_point_button_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_button_color<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_map_item_point_button_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
				<input type="hidden" id="grve_map_item_point_button_class<?php echo esc_attr( $map_id ); ?>" value="<?php echo esc_attr( $button_class ); ?>" name="grve_map_item_point_button_class[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">
				</div>
			<?php } ?>
		</div>
	</div>
<?php
}

/**
 * Prints Feature Single Image Item
 */
function grve_print_admin_feature_image_item( $image_item, $mode = "" ) {

	global $grve_media_color_overlay_selection;

	$media_id = $image_item['id'];

	$title = grve_array_value( $image_item, 'title' );
	$caption = grve_array_value( $image_item, 'caption' );
	$text_align = grve_array_value( $image_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $image_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $image_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $image_item, 'caption_color', 'dark' );
	$title_tag = grve_array_value( $image_item, 'title_tag', 'h1' );
	$caption_tag = grve_array_value( $image_item, 'caption_tag', 'div' );

	$bg_image_size = grve_array_value( $image_item, 'bg_image_size' );
	$bg_position = grve_array_value( $image_item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = grve_array_value( $image_item, 'bg_tablet_sm_position' );
	$bg_effect = grve_array_value( $image_item, 'bg_effect', 'none' );
	$style = grve_array_value( $image_item, 'style', 'default' );
	$el_class = grve_array_value( $image_item, 'el_class' );

	$pattern_overlay = grve_array_value( $image_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $image_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $image_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $image_item, 'button_text' );
	$button_url = grve_array_value( $image_item, 'button_url' );
	$button_type = grve_array_value( $image_item, 'button_type', '' );
	$button_size = grve_array_value( $image_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $image_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $image_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $image_item, 'button_target', '_self' );
	$button_class = grve_array_value( $image_item, 'button_class' );

	$button_text2 = grve_array_value( $image_item, 'button_text2' );
	$button_url2 = grve_array_value( $image_item, 'button_url2' );
	$button_type2 = grve_array_value( $image_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $image_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $image_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $image_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $image_item, 'button_target2', '_self' );
	$button_class2 = grve_array_value( $image_item, 'button_class2' );

	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-image-item-delete-button";
	$grve_open_modal_class = "grve-open-image-modal";
	$grve_replace_image_class = "grve-upload-replace-image";
	if( "new" == $mode ) {
		$grve_button_class = "grve-image-item-delete-button grve-item-new";
		$grve_replace_image_class = "grve-upload-replace-image grve-item-new";
		$grve_open_modal_class = "grve-open-image-modal grve-item-new";
	}
	$image_item_id = uniqid('_');
	$grve_settings_mode = grve_get_admin_feature_setting_mode();
?>

	<div class="grve-image-item postbox">
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php if( 'modal' == $grve_settings_mode ) { ?>
		<input class="<?php echo esc_attr( $grve_open_modal_class ); ?> button-primary" type="button" value="<?php esc_attr_e( 'Edit Settings', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php } ?>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-title">
			<span><?php esc_html_e( 'Image', 'osmosis' ); ?></span>
		</h3>
		<div class="inside">
			<div class="grve-thumb-container" data-mode="image">
				<input type="hidden" value="<?php echo esc_attr( $media_id ); ?>" name="grve_image_item_id">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" title="' . esc_attr( $title ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
			</div>
			<div class="<?php echo esc_attr( $grve_replace_image_class ); ?>"></div>
			<div class="grve-image-settings"></div>
			<div class="clear"></div>

			<?php
				if( 'simple' == $grve_settings_mode ) {
			?>
				<ul class="grve-image-setting">
			<?php
				grve_print_admin_feature_setting( 'label', __( 'Title / Caption', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Title', 'osmosis' ), 'grve_image_item_title', $title );
				grve_print_admin_feature_setting( 'textfield', __( 'Caption', 'osmosis' ), 'grve_image_item_caption', $caption );
				grve_print_admin_feature_setting( 'select-color', __( 'Title Color', 'osmosis' ), 'grve_image_item_title_color', $title_color );
				grve_print_admin_feature_setting( 'select-color', __( 'Caption Color', 'osmosis' ), 'grve_image_item_caption_color', $caption_color );
				grve_print_admin_feature_setting( 'select-tag', __( 'Title Tag', 'osmosis' ), 'grve_image_item_title_tag', $title_tag );
				grve_print_admin_feature_setting( 'select-tag', __( 'Caption Tag', 'osmosis' ), 'grve_image_item_caption_tag', $caption_tag );
				grve_print_admin_feature_setting( 'select-style', __( 'Title / Caption Style', 'osmosis' ), 'grve_image_item_style', $style );
				grve_print_admin_feature_setting( 'select-align', __( 'Alignment', 'osmosis' ), 'grve_image_item_text_align', $text_align );
				grve_print_admin_feature_setting( 'select-text-animation', __( 'Animation', 'osmosis' ), 'grve_image_item_text_animation', $text_animation );

				grve_print_admin_feature_setting( 'label', __( 'Background', 'osmosis' ) );
				grve_print_admin_feature_setting( 'select-bg-image-size', __( 'Background Image Size', 'osmosis' ), 'grve_image_item_bg_image_size', $bg_image_size );
				grve_print_admin_feature_setting( 'select-bg-position', __( 'Background Position', 'osmosis' ), 'grve_image_item_bg_position', $bg_position );
				grve_print_admin_feature_setting( 'select-bg-position-inherit', __( 'Background Position ( Tablet Portrait )', 'osmosis' ), 'grve_image_item_bg_tablet_sm_position', $bg_tablet_sm_position );
				grve_print_admin_feature_setting( 'select-bg-effect', __( 'Background Effect', 'osmosis' ), 'grve_image_item_bg_effect', $bg_effect );

				grve_print_admin_feature_setting( 'label', __( 'Overlay', 'osmosis' ) );
				grve_print_admin_feature_setting( 'select-pattern-overlay', __( 'Pattern Overlay', 'osmosis' ), 'grve_image_item_pattern_overlay', $pattern_overlay );
				grve_print_admin_feature_setting( 'select-color-overlay', __( 'Color Overlay', 'osmosis' ), 'grve_image_item_color_overlay', $color_overlay );
				grve_print_admin_feature_setting( 'select-opacity-overlay', __( 'Opacity Overlay', 'osmosis' ), 'grve_image_item_opacity_overlay', $opacity_overlay );

				grve_print_admin_feature_setting( 'label', __( 'First Button', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_image_item_button_text', $button_text );
				grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_image_item_button_url', $button_url );
				grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_image_item_button_target', $button_target );
				grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_image_item_button_color', $button_color );
				grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_image_item_button_size', $button_size );
				grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_image_item_button_shape', $button_shape );
				grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_image_item_button_type', $button_type );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_image_item_button_class', $button_class );

				grve_print_admin_feature_setting( 'label', __( 'Second Button', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_image_item_button2_text', $button_text2 );
				grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_image_item_button2_url', $button_url2 );
				grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_image_item_button2_target', $button_target2 );
				grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_image_item_button2_color', $button_color2 );
				grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_image_item_button2_size', $button_size2 );
				grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_image_item_button2_shape', $button_shape2 );
				grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_image_item_button2_type', $button_type2 );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_image_item_button2_class', $button_class );

				grve_print_admin_feature_setting( 'label', __( 'Extras', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Extra Class', 'osmosis' ), 'grve_image_item_el_class', $el_class );
			?>
				</ul>
			<?php
				} else {
			?>
				<div class="grve-image-data-container">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Title / Caption', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_title<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_image_item_title" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Title', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the image title.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_caption<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_image_item_caption" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Caption', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the image caption.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_title_color<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_image_item_title_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Title Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_caption_color<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_image_item_caption_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Caption Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_title_tag<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $title_tag ); ?>" name="grve_image_item_title_tag" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Title Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title tag.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_caption_tag<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $caption_tag ); ?>" name="grve_image_item_caption_tag" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Caption Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption tag.', 'osmosis' ); ?>">

					<input type="hidden" id="grve_image_item_style<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_image_item_style" data-meta-template="#grve-select-style-template" data-meta-title="<?php esc_attr_e( 'Title / Caption Style', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption style.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_text_align<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_image_item_text_align" data-meta-template="#grve-select-align-template" data-meta-title="<?php esc_attr_e( 'Alignment', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the content alignment.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_text_animation<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_image_item_text_animation" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php esc_attr_e( 'Animation', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption animation.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Background', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_bg_image_size<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $bg_image_size ); ?>" name="grve_image_item_bg_image_size" data-meta-template="#grve-select-bg-image-size-template" data-meta-title="<?php esc_attr_e( 'Background Image Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the size of the image.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_bg_position<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $bg_position ); ?>" name="grve_image_item_bg_position" data-meta-template="#grve-select-bg-position-template" data-meta-title="<?php esc_attr_e( 'Background Position', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the background position of the image.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_bg_tablet_sm_position<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $bg_tablet_sm_position ); ?>" name="grve_image_item_bg_tablet_sm_position" data-meta-template="#grve-select-bg-position-inherit-template" data-meta-title="<?php esc_attr_e( 'Background Position ( Tablet Portrait )', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Tablet devices with portrait orientation and below.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_bg_effect<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $bg_effect ); ?>" name="grve_image_item_bg_effect" data-meta-template="#grve-select-bg-effect-template" data-meta-title="<?php esc_attr_e( 'Background Effect', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the background effect of the image.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Overlay', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_pattern_overlay<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_image_item_pattern_overlay" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php esc_attr_e( 'Pattern Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the pattern overlay.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_color_overlay<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_image_item_color_overlay" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php esc_attr_e( 'Color Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the color overlay.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_opacity_overlay<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_image_item_opacity_overlay" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php esc_attr_e( 'Opacity Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the opacity overlay.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'First Button', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_button_text<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_image_item_button_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_url<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_image_item_button_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_target<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_image_item_button_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_color<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_image_item_button_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_size<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_image_item_button_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_shape<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_image_item_button_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_type<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_image_item_button_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button_class<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_class ); ?>" name="grve_image_item_button_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Second Button', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_button2_text<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_image_item_button2_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_url<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_image_item_button2_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_target<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_image_item_button2_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_color<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_image_item_button2_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_size<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_image_item_button2_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_shape<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_image_item_button2_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_type<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_image_item_button2_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_button2_class<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $button_class2 ); ?>" name="grve_image_item_button2_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Extras', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_image_item_el_class<?php echo esc_attr( $image_item_id ); ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_image_item_el_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Extra Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type class name.', 'osmosis' ); ?>">

				</div>
			<?php
				}
			?>

		</div>

	</div>
<?php
}

/**
 * Prints Section Slider items
 */
function grve_print_admin_feature_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		grve_print_admin_feature_slider_item( $slider_item, '' );
	}

}

/**
* Prints Single Feature Slider Item
*/
function grve_print_admin_feature_slider_item( $slider_item, $new = "" ) {

	global $grve_media_align_selection, $grve_media_color_selection, $grve_media_color_overlay_selection;

	$media_id = $slider_item['id'];

	$title = grve_array_value( $slider_item, 'title' );
	$caption = grve_array_value( $slider_item, 'caption' );
	$text_align = grve_array_value( $slider_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $slider_item, 'text_animation', 'fade-in' );
	$title_color = grve_array_value( $slider_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $slider_item, 'caption_color', 'dark' );
	$title_tag = grve_array_value( $slider_item, 'title_tag', 'h1' );
	$caption_tag = grve_array_value( $slider_item, 'caption_tag', 'div' );

	$bg_image_size = grve_array_value( $slider_item, 'bg_image_size' );
	$bg_position = grve_array_value( $slider_item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = grve_array_value( $slider_item, 'bg_tablet_sm_position' );
	$style = grve_array_value( $slider_item, 'style', 'default' );
	$header_style = grve_array_value( $slider_item, 'header_style', 'default' );
	$el_class = grve_array_value( $slider_item, 'el_class' );

	$pattern_overlay = grve_array_value( $slider_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $slider_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $slider_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $slider_item, 'button_text' );
	$button_url = grve_array_value( $slider_item, 'button_url' );
	$button_type = grve_array_value( $slider_item, 'button_type', '' );
	$button_size = grve_array_value( $slider_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $slider_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $slider_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $slider_item, 'button_target', '_self' );
	$button_class = grve_array_value( $slider_item, 'button_class' );

	$button_text2 = grve_array_value( $slider_item, 'button_text2' );
	$button_url2 = grve_array_value( $slider_item, 'button_url2' );
	$button_type2 = grve_array_value( $slider_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $slider_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $slider_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $slider_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $slider_item, 'button_target2', '_self' );
	$button_class2 = grve_array_value( $slider_item, 'button_class2' );


	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-feature-slider-item-delete-button";
	$grve_replace_image_class = "grve-upload-replace-image";
	$grve_open_modal_class = "grve-open-slider-modal";
	$grve_closed_class = '';

	$grve_settings_mode = grve_get_admin_feature_setting_mode();
	if( 'simple' == $grve_settings_mode ) {
		$grve_closed_class = 'closed';
	}
	if( "new" == $new ) {
		$grve_button_class = "grve-feature-slider-item-delete-button grve-item-new";
		$grve_replace_image_class = "grve-upload-replace-image grve-item-new";
		$grve_open_modal_class = "grve-open-slider-modal grve-item-new";
		$grve_closed_class = "grve-item-new grve-toggle-new";
	}

	$slider_item_id = uniqid('_');

?>

	<div class="grve-slider-item postbox <?php echo esc_attr( $grve_closed_class ); ?>">
		<button class="handlediv button-link" type="button">
			<span class="screen-reader-text"><?php esc_attr_e( 'Toggle panel: Feature Section Map Point', 'osmosis' ); ?></span>
			<span class="toggle-indicator"></span>
		</button>
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php if( 'modal' == $grve_settings_mode ) { ?>
		<input class="<?php echo esc_attr( $grve_open_modal_class ); ?> button-primary" type="button" value="<?php esc_attr_e( 'Edit Settings', 'osmosis' ); ?>">
		<span class="grve-button-spacer">&nbsp;</span>
		<?php } ?>
		<span class="grve-modal-spinner"></span>
		<h3 class="grve-movable grve-title">
			<span><?php esc_html_e( 'Slide', 'osmosis' ); ?>: </span><span id="grve_slider_item_title<?php echo esc_attr( $slider_item_id ); ?>_admin_label"><?php if ( !empty ($title) ) { echo esc_html( $title ); } ?></span>
		</h3>
		<div class="inside">
			<div class="grve-thumb-container" data-mode="slider-full">
				<input type="hidden" value="<?php echo esc_attr( $media_id ); ?>" name="grve_slider_item_id[]">
				<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" title="' . esc_attr( $title ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
			</div>
			<div class="<?php echo esc_attr( $grve_replace_image_class ); ?>"></div>
			<div class="grve-slider-settings"></div>
			<div class="clear"></div>

			<?php
				if( 'simple' == $grve_settings_mode ) {
			?>
				<ul class="grve-slide-setting">
			<?php
				grve_print_admin_feature_setting( 'label', __( 'Title / Caption', 'osmosis' ) );
				$grve_slider_item_title_id = 'grve_slider_item_title' . $slider_item_id;
				grve_print_admin_feature_setting( 'textfield', __( 'Title', 'osmosis' ), 'grve_slider_item_title[]', $title, $grve_slider_item_title_id, 'grve-admin-label-update' );
				grve_print_admin_feature_setting( 'textfield', __( 'Caption', 'osmosis' ), 'grve_slider_item_caption[]', $caption );
				grve_print_admin_feature_setting( 'select-color', __( 'Title Color', 'osmosis' ), 'grve_slider_item_title_color[]', $title_color );
				grve_print_admin_feature_setting( 'select-color', __( 'Caption Color', 'osmosis' ), 'grve_slider_item_caption_color[]', $caption_color );
				grve_print_admin_feature_setting( 'select-tag', __( 'Title Tag', 'osmosis' ), 'grve_slider_item_title_tag[]', $title_tag );
				grve_print_admin_feature_setting( 'select-tag', __( 'Caption Tag', 'osmosis' ), 'grve_slider_item_caption_tag[]', $caption_tag );
				grve_print_admin_feature_setting( 'select-style', __( 'Title / Caption Style', 'osmosis' ), 'grve_slider_item_style[]', $style );
				grve_print_admin_feature_setting( 'select-align', __( 'Alignment', 'osmosis' ), 'grve_slider_item_text_align[]', $text_align );
				grve_print_admin_feature_setting( 'select-text-animation', __( 'Animation', 'osmosis' ), 'grve_slider_item_text_animation[]', $text_animation );

				grve_print_admin_feature_setting( 'label', __( 'Header / Background Position', 'osmosis' ) );
				grve_print_admin_feature_setting( 'select-bg-image-size', __( 'Background Image Size', 'osmosis' ), 'grve_slider_item_bg_image_size[]', $bg_image_size );
				grve_print_admin_feature_setting( 'select-bg-position', __( 'Background Position', 'osmosis' ), 'grve_slider_item_bg_position[]', $bg_position );
				grve_print_admin_feature_setting( 'select-bg-position-inherit', __( 'Background Position ( Tablet Portrait )', 'osmosis' ), 'grve_slider_item_bg_tablet_sm_position[]', $bg_tablet_sm_position );
				grve_print_admin_feature_setting( 'select-header-style', __( 'Header Style', 'osmosis' ), 'grve_slider_item_header_style[]', $header_style );

				grve_print_admin_feature_setting( 'label', __( 'Overlay', 'osmosis' ) );
				grve_print_admin_feature_setting( 'select-pattern-overlay', __( 'Pattern Overlay', 'osmosis' ), 'grve_slider_item_pattern_overlay[]', $pattern_overlay );
				grve_print_admin_feature_setting( 'select-color-overlay', __( 'Color Overlay', 'osmosis' ), 'grve_slider_item_color_overlay[]', $color_overlay );
				grve_print_admin_feature_setting( 'select-opacity-overlay', __( 'Opacity Overlay', 'osmosis' ), 'grve_slider_item_opacity_overlay[]', $opacity_overlay );

				grve_print_admin_feature_setting( 'label', __( 'First Button', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_slider_item_button_text[]', $button_text );
				grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_slider_item_button_url[]', $button_url );
				grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_slider_item_button_target[]', $button_target );
				grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_slider_item_button_color[]', $button_color );
				grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_slider_item_button_size[]', $button_size );
				grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_slider_item_button_shape[]', $button_shape );
				grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_slider_item_button_type[]', $button_type );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_slider_item_button_class[]', $button_class );

				grve_print_admin_feature_setting( 'label', __( 'Second Button', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_slider_item_button2_text[]', $button_text2 );
				grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_slider_item_button2_url[]', $button_url2 );
				grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_slider_item_button2_target[]', $button_target2 );
				grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_slider_item_button2_color[]', $button_color2 );
				grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_slider_item_button2_size[]', $button_size2 );
				grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_slider_item_button2_shape[]', $button_shape2 );
				grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_slider_item_button2_type[]', $button_type2 );
				grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_slider_item_button2_class[]', $button_class2 );

				grve_print_admin_feature_setting( 'label', __( 'Extras', 'osmosis' ) );
				grve_print_admin_feature_setting( 'textfield', __( 'Extra Class', 'osmosis' ), 'grve_slider_item_el_class[]', $el_class );
			?>
				</ul>
			<?php
				} else {
			?>
				<div class="grve-slider-data-container">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Title / Caption', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_title<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_slider_item_title[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Title', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the title.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_caption<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_slider_item_caption[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Caption', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the caption.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_title_color<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_slider_item_title_color[]" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Title Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_caption_color<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_slider_item_caption_color[]" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Caption Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_title_tag<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $title_tag ); ?>" name="grve_slider_item_title_tag[]" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Title Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title tag.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_image_item_caption_tag<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $caption_tag ); ?>" name="grve_slider_item_caption_tag[]" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Caption Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption tag.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_style<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_slider_item_style[]" data-meta-template="#grve-select-style-template" data-meta-title="<?php esc_attr_e( 'Title / Caption Style', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption style.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_text_align<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_slider_item_text_align[]" data-meta-template="#grve-select-align-template" data-meta-title="<?php esc_attr_e( 'Alignment', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the content alignment.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_text_animation<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_slider_item_text_animation[]" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php esc_attr_e( 'Animation', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption animation.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Header / Background Position', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_bg_image_size<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $bg_image_size ); ?>" name="grve_slider_item_bg_image_size[]" data-meta-template="#grve-select-bg-image-size-template" data-meta-title="<?php esc_attr_e( 'Background Image Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the size of the image.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_bg_position<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $bg_position ); ?>" name="grve_slider_item_bg_position[]" data-meta-template="#grve-select-bg-position-template" data-meta-title="<?php esc_attr_e( 'Background Position', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the background position of the image.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_bg_tablet_sm_position<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $bg_tablet_sm_position ); ?>" name="grve_slider_item_bg_tablet_sm_position[]" data-meta-template="#grve-select-bg-position-inherit-template" data-meta-title="<?php esc_attr_e( 'Background Position ( Tablet Portrait )', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Tablet devices with portrait orientation and below.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_header_style<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $header_style ); ?>" name="grve_slider_item_header_style[]" data-meta-template="#grve-select-header-style-template" data-meta-title="<?php esc_attr_e( 'Header Style', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'With this option you can change the coloring of your header.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Overlay', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_pattern_overlay<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_slider_item_pattern_overlay[]" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php esc_attr_e( 'Pattern Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the pattern overlay.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_color_overlay<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_slider_item_color_overlay[]" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php esc_attr_e( 'Color Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the color overlay.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_opacity_overlay<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_slider_item_opacity_overlay[]" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php esc_attr_e( 'Opacity Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the opacity overlay.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'First Button', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_button_text<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_slider_item_button_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_url<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_slider_item_button_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_target<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_slider_item_button_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_color<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_slider_item_button_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_size<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_slider_item_button_size[]" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_shape<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_slider_item_button_shape[]" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_type<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_slider_item_button_type[]" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button_class<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_class ); ?>" name="grve_slider_item_button_class[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Second Button', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_button2_text<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_slider_item_button2_text[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_url<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_slider_item_button2_url[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_target<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_slider_item_button2_target[]" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_color<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_slider_item_button2_color[]" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_size<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_slider_item_button2_size[]" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_shape<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_slider_item_button2_shape[]" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_type<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_slider_item_button2_type[]" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
					<input type="hidden" id="grve_slider_item_button2_class<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $button_class2 ); ?>" name="grve_slider_item_button2_class[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

					<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Extras', 'osmosis' ); ?>" data-meta-desc="">
					<input type="hidden" id="grve_slider_item_el_class<?php echo esc_attr( $slider_item_id ); ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_slider_item_el_class[]" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Extra Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type class name.', 'osmosis' ); ?>">

				</div>
			<?php
				}
			?>
		</div>

	</div>
<?php

}

/**
* Prints Single Feature Viedo Item
*/
function grve_print_admin_feature_video_item( $video_item ) {

	$video_item_id = uniqid('_');

	$title = grve_array_value( $video_item, 'title' );
	$caption = grve_array_value( $video_item, 'caption' );
	$text_align = grve_array_value( $video_item, 'text_align', 'left' );
	$text_animation = grve_array_value( $video_item, 'text_animation', 'fade-in' );

	$title_color = grve_array_value( $video_item, 'title_color', 'dark' );
	$caption_color = grve_array_value( $video_item, 'caption_color', 'dark' );
	$title_tag = grve_array_value( $video_item, 'title_tag', 'h1' );
	$caption_tag = grve_array_value( $video_item, 'caption_tag', 'div' );

	$style = grve_array_value( $video_item, 'style', 'default' );
	$el_class = grve_array_value( $video_item, 'el_class' );

	$pattern_overlay = grve_array_value( $video_item, 'pattern_overlay' );
	$color_overlay = grve_array_value( $video_item, 'color_overlay' );
	$opacity_overlay = grve_array_value( $video_item, 'opacity_overlay', '10' );

	$button_text = grve_array_value( $video_item, 'button_text' );
	$button_url = grve_array_value( $video_item, 'button_url' );
	$button_type = grve_array_value( $video_item, 'button_type', '' );
	$button_size = grve_array_value( $video_item, 'button_size', 'medium' );
	$button_color = grve_array_value( $video_item, 'button_color', 'primary-1' );
	$button_shape = grve_array_value( $video_item, 'button_shape', 'square' );
	$button_target = grve_array_value( $video_item, 'button_target', '_self' );
	$button_class = grve_array_value( $video_item, 'button_class' );

	$button_text2 = grve_array_value( $video_item, 'button_text2' );
	$button_url2 = grve_array_value( $video_item, 'button_url2' );
	$button_type2 = grve_array_value( $video_item, 'button_type2', '' );
	$button_size2 = grve_array_value( $video_item, 'button_size2', 'medium' );
	$button_color2 = grve_array_value( $video_item, 'button_color2', 'primary-1' );
	$button_shape2 = grve_array_value( $video_item, 'button_shape2', 'square' );
	$button_target2 = grve_array_value( $video_item, 'button_target2', '_self' );
	$button_class2 = grve_array_value( $video_item, 'button_class2' );

	$grve_settings_mode = grve_get_admin_feature_setting_mode();

	if( 'simple' == $grve_settings_mode ) {
?>
	<ul class="grve-video-setting">
<?php
		grve_print_admin_feature_setting( 'label', __( 'Title / Caption', 'osmosis' ) );
		grve_print_admin_feature_setting( 'textfield', __( 'Title', 'osmosis' ), 'grve_video_item_title', $title );
		grve_print_admin_feature_setting( 'textfield', __( 'Caption', 'osmosis' ), 'grve_video_item_caption', $caption );
		grve_print_admin_feature_setting( 'select-color', __( 'Title Color', 'osmosis' ), 'grve_video_item_title_color', $title_color );
		grve_print_admin_feature_setting( 'select-color', __( 'Caption Color', 'osmosis' ), 'grve_video_item_caption_color', $caption_color );
		grve_print_admin_feature_setting( 'select-tag', __( 'Title Tag', 'osmosis' ), 'grve_video_item_title_tag', $title_tag );
		grve_print_admin_feature_setting( 'select-tag', __( 'Caption Tag', 'osmosis' ), 'grve_video_item_caption_tag', $caption_tag );
		grve_print_admin_feature_setting( 'select-style', __( 'Title / Caption Style', 'osmosis' ), 'grve_video_item_style', $style );
		grve_print_admin_feature_setting( 'select-align', __( 'Alignment', 'osmosis' ), 'grve_video_item_text_align', $text_align );
		grve_print_admin_feature_setting( 'select-text-animation', __( 'Animation', 'osmosis' ), 'grve_video_item_text_animation', $text_animation );

		grve_print_admin_feature_setting( 'label', __( 'Overlay', 'osmosis' ) );
		grve_print_admin_feature_setting( 'select-pattern-overlay', __( 'Pattern Overlay', 'osmosis' ), 'grve_video_item_pattern_overlay', $pattern_overlay );
		grve_print_admin_feature_setting( 'select-color-overlay', __( 'Color Overlay', 'osmosis' ), 'grve_video_item_color_overlay', $color_overlay );
		grve_print_admin_feature_setting( 'select-opacity-overlay', __( 'Opacity Overlay', 'osmosis' ), 'grve_video_item_opacity_overlay', $opacity_overlay );

		grve_print_admin_feature_setting( 'label', __( 'First Button', 'osmosis' ) );
		grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_video_item_button_text', $button_text );
		grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_video_item_button_url', $button_url );
		grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_video_item_button_target', $button_target );
		grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_video_item_button_color', $button_color );
		grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_video_item_button_size', $button_size );
		grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_video_item_button_shape', $button_shape );
		grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_video_item_button_type', $button_type );
		grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_video_item_button_class', $button_class );

		grve_print_admin_feature_setting( 'label', __( 'Second Button', 'osmosis' ) );
		grve_print_admin_feature_setting( 'textfield', __( 'Button Text', 'osmosis' ), 'grve_video_item_button2_text', $button_text2 );
		grve_print_admin_feature_setting( 'textfield', __( 'Button URL', 'osmosis' ), 'grve_video_item_button2_url', $button_url2 );
		grve_print_admin_feature_setting( 'select-button-target', __( 'Button Target', 'osmosis' ), 'grve_video_item_button2_target', $button_target2 );
		grve_print_admin_feature_setting( 'select-button-color', __( 'Button Color', 'osmosis' ), 'grve_video_item_button2_color', $button_color2 );
		grve_print_admin_feature_setting( 'select-button-size', __( 'Button Size', 'osmosis' ), 'grve_video_item_button2_size', $button_size2 );
		grve_print_admin_feature_setting( 'select-button-shape', __( 'Button Shape', 'osmosis' ), 'grve_video_item_button2_shape', $button_shape2 );
		grve_print_admin_feature_setting( 'select-button-type', __( 'Button Type', 'osmosis' ), 'grve_video_item_button2_type', $button_type2 );
		grve_print_admin_feature_setting( 'textfield', __( 'Button Class', 'osmosis' ), 'grve_video_item_button2_class', $button_class2 );

		grve_print_admin_feature_setting( 'label', __( 'Extras', 'osmosis' ) );
		grve_print_admin_feature_setting( 'textfield', __( 'Extra Class', 'osmosis' ), 'grve_video_item_el_class', $el_class );

?>
	</ul>
<?php
	} else {
?>
	<div class="grve-video-data-container">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Title / Caption', 'osmosis' ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_title<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $title ); ?>" name="grve_video_item_title" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Title', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the title.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_caption<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $caption ); ?>" name="grve_video_item_caption" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Caption', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the caption.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_title_color<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $title_color ); ?>" name="grve_video_item_title_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Title Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title color.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_caption_color<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $caption_color ); ?>" name="grve_video_item_caption_color" data-meta-template="#grve-select-color-template" data-meta-title="<?php esc_attr_e( 'Caption Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption color.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_title_tag<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $title_tag ); ?>" name="grve_video_item_title_tag" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Title Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title tag.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_caption_tag<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $caption_tag ); ?>" name="grve_video_item_caption_tag" data-meta-template="#grve-select-tag-template" data-meta-title="<?php esc_attr_e( 'Caption Tag', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the caption tag.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_style<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $style ); ?>" name="grve_video_item_style" data-meta-template="#grve-select-style-template" data-meta-title="<?php esc_attr_e( 'Title / Caption Style', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption style', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_text_align<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $text_align ); ?>" name="grve_video_item_text_align" data-meta-template="#grve-select-align-template" data-meta-title="<?php esc_attr_e( 'Alignment', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the content alignment', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_text_animation<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $text_animation ); ?>" name="grve_video_item_text_animation" data-meta-template="#grve-select-text-animation-template" data-meta-title="<?php esc_attr_e( 'Animation', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the title / caption animation', 'osmosis' ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Overlay', 'osmosis' ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_pattern_overlay<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $pattern_overlay ); ?>" name="grve_video_item_pattern_overlay" data-meta-template="#grve-select-pattern-overlay-template" data-meta-title="<?php esc_attr_e( 'Pattern Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the pattern overlay.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_color_overlay<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $color_overlay ); ?>" name="grve_video_item_color_overlay" data-meta-template="#grve-select-color-overlay-template" data-meta-title="<?php esc_attr_e( 'Color Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the color overlay.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_opacity_overlay<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $opacity_overlay ); ?>" name="grve_video_item_opacity_overlay" data-meta-template="#grve-select-opacity-overlay-template" data-meta-title="<?php esc_attr_e( 'Opacity Overlay', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the opacity overlay.', 'osmosis' ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'First Button', 'osmosis' ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_button_text<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_text ); ?>" name="grve_video_item_button_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_url<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_url ); ?>" name="grve_video_item_button_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_target<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_target ); ?>" name="grve_video_item_button_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_color<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_color ); ?>" name="grve_video_item_button_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_size<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_size ); ?>" name="grve_video_item_button_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_shape<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_shape ); ?>" name="grve_video_item_button_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_type<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_type ); ?>" name="grve_video_item_button_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button_class<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_class ); ?>" name="grve_video_item_button_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Second Button', 'osmosis' ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_button2_text<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_text2 ); ?>" name="grve_video_item_button2_text" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Text', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button text.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_url<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_url2 ); ?>" name="grve_video_item_button2_url" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button URL', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type the button URL.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_target<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_target2 ); ?>" name="grve_video_item_button2_target" data-meta-template="#grve-select-button-target-template" data-meta-title="<?php esc_attr_e( 'Button Target', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button target.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_color<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_color2 ); ?>" name="grve_video_item_button2_color" data-meta-template="#grve-select-button-color-template" data-meta-title="<?php esc_attr_e( 'Button Color', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button color.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_size<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_size2 ); ?>" name="grve_video_item_button2_size" data-meta-template="#grve-select-button-size-template" data-meta-title="<?php esc_attr_e( 'Button Size', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button size.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_shape<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_shape2 ); ?>" name="grve_video_item_button2_shape" data-meta-template="#grve-select-button-shape-template" data-meta-title="<?php esc_attr_e( 'Button Shape', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button shape.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_type<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_type2 ); ?>" name="grve_video_item_button2_type" data-meta-template="#grve-select-button-type-template" data-meta-title="<?php esc_attr_e( 'Button Type', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Select the button type.', 'osmosis' ); ?>">
		<input type="hidden" id="grve_video_item_button2_class<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $button_class2 ); ?>" name="grve_video_item_button2_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Button Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type button class name.', 'osmosis' ); ?>">

		<input type="hidden" data-meta-template="#grve-label-template" data-meta-title="<?php esc_attr_e( 'Extras', 'osmosis' ); ?>" data-meta-desc="">
		<input type="hidden" id="grve_video_item_el_class<?php echo esc_attr( $video_item_id ); ?>" value="<?php echo esc_attr( $el_class ); ?>" name="grve_video_item_el_class" data-meta-template="#grve-textfield-template" data-meta-title="<?php esc_attr_e( 'Extra Class', 'osmosis' ); ?>" data-meta-desc="<?php esc_attr_e( 'Type class name.', 'osmosis' ); ?>">

	</div>
<?php
	}
}

/**
 * Function to print revolution selector
 */
function grve_print_revolution_selection( $revslider_alias, $id, $name ) {

	if ( grve_is_revslider_active() ) {
	?>
		<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" class="grve-feature-section-item">
	<?php
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		if ( $arrSliders ) {
	?>
			<option value="" <?php selected( '', $revslider_alias ); ?>>
				<?php echo esc_html__( 'None', 'osmosis' ); ?>
			</option>
	<?php
			foreach ( $arrSliders as $slider ) {
	?>
			<option value="<?php echo esc_attr( $slider->getAlias() ); ?>" <?php selected( $slider->getAlias(), $revslider_alias ); ?>>
				<?php echo esc_html( $slider->getTitle() ); ?>
			</option>
	<?php
			}

		} else {
	?>
			<option value="" <?php selected( '', $revslider_alias ); ?>>
				<?php echo esc_html__( 'No sliders found', 'osmosis' ); ?>
			</option>
	<?php
		}
	?>
		</select>
	<?php
	} else{
	?>
		<span id="<?php echo esc_attr( $id ); ?>" class="grve-feature-section-item">
			<?php echo esc_html__( 'Revolution Slider is not activated!', 'osmosis' ); ?>
			<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value=""/>
		</span>
	<?php
	}

}

function grve_admin_get_feature_section( $post_id ) {

	//Feature Settings
	$feature_element = grve_admin_post_meta( $post_id, 'grve_page_feature_element' );
	$feature_size = grve_admin_post_meta( $post_id, 'grve_page_feature_size' );
	$feature_height = grve_admin_post_meta( $post_id, 'grve_page_feature_height', '550' );
	$feature_header_position = grve_admin_post_meta( $post_id, 'grve_page_feature_header_position', 'above' );
	$feature_header_integration = grve_admin_post_meta( $post_id, 'grve_page_feature_header_integration', 'no' );
	$feature_effect = grve_admin_post_meta( $post_id, 'grve_page_feature_effect' );
	$feature_go_to_section = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section' );
	$feature_go_to_section_size = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_size', 'medium' );
	$feature_go_to_section_shape = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_shape', 'none' );
	$feature_go_to_section_animation = grve_admin_post_meta( $post_id, 'grve_page_feature_go_to_section_animation', 'bounce' );

	$feature_header_style = grve_admin_post_meta( $post_id, 'grve_page_feature_header_style', 'default' );

	//Image Item
	$image_item = get_post_meta( $post_id, 'grve_page_image_item', true );

	//Title Item
	$title_item = get_post_meta( $post_id, 'grve_page_title_item', true );

	//Slider Item
	$slider_items = get_post_meta( $post_id, 'grve_page_slider_items', true );
	$slider_settings = get_post_meta( $post_id, 'grve_page_slider_settings', true );
	$slider_speed = grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = grve_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_dir_nav = grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_dir_nav_color = grve_array_value( $slider_settings, 'direction_nav_color', 'light' );
	$slider_transition = grve_array_value( $slider_settings, 'transition', 'slide' );

	//Revolution Slider Item
	$revslider_alias = get_post_meta( $post_id, 'grve_page_feature_revslider', true );

	//Map Item
	$map_items = get_post_meta( $post_id, 'grve_page_map_items', true );
	$map_settings = get_post_meta( $post_id, 'grve_page_map_settings', true );
	$map_zoom = grve_array_value( $map_settings, 'zoom', 14 );
	$map_marker = grve_array_value( $map_settings, 'marker' );
	$map_single_popup = grve_array_value( $map_settings, 'single_popup', 'no' );
	$map_clustering = grve_array_value( $map_settings, 'clustering', 'no' );


	//Video Item
	$video_item = get_post_meta( $post_id, 'grve_page_video_item', true );
	$video_webm = grve_array_value( $video_item, 'video_webm' );
	$video_mp4 = grve_array_value( $video_item, 'video_mp4' );
	$video_ogv = grve_array_value( $video_item, 'video_ogv' );
	$video_bg_image = grve_array_value( $video_item, 'video_bg_image' );
	$video_device = grve_array_value( $video_item, 'video_device' );
	$video_loop = grve_array_value( $video_item, 'video_loop', 'yes' );
	$video_muted = grve_array_value( $video_item, 'video_muted', 'yes' );

	$grve_settings_mode = grve_get_admin_feature_setting_mode();

?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-page-feature-element">
							<strong><?php esc_html_e( 'Feature Element', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select feature section element.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-element" name="grve_page_feature_element">
							<option value="" <?php selected( "", $feature_element ); ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							<option value="title" <?php selected( "title", $feature_element ); ?>><?php esc_html_e( 'Title', 'osmosis' ); ?></option>
							<option value="image" <?php selected( "image", $feature_element ); ?>><?php esc_html_e( 'Image', 'osmosis' ); ?></option>
							<option value="video" <?php selected( "video", $feature_element ); ?>><?php esc_html_e( 'Video', 'osmosis' ); ?></option>
							<option value="slider" <?php selected( "slider", $feature_element ); ?>><?php esc_html_e( 'Slider', 'osmosis' ); ?></option>
							<option value="revslider" <?php selected( "revslider", $feature_element ); ?>><?php esc_html_e( 'Revolution Slider', 'osmosis' ); ?></option>
							<option value="map" <?php selected( "map", $feature_element ); ?>><?php esc_html_e( 'Map', 'osmosis' ); ?></option>
						</select>
						<?php grve_print_revolution_selection( $revslider_alias, 'grve-page-feature-revslider', 'grve_page_feature_revslider' ); ?>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-speed" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-speed">
							<strong><?php esc_html_e( 'Slideshow Speed', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<input type="text" id="grve-page-slider-speed" name="grve_page_slider_settings_speed" value="<?php echo esc_attr( $slider_speed ); ?>" /> ms
					</td>
				</tr>
				<tr id="grve-feature-section-slider-pause" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-pause">
							<strong><?php esc_html_e( 'Pause On Hover', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select id="grve-page-slider-pause" name="grve_page_slider_settings_pause">
							<option value="yes" <?php selected( 'yes', $slider_pause ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
							<option value="no" <?php selected( 'no', $slider_pause ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-direction-nav" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-direction-nav">
							<strong><?php esc_html_e( 'Navigation Buttons', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select name="grve_page_slider_settings_direction_nav" id="grve-page-slider-direction-nav">
							<option value="1" <?php selected( "1", $slider_dir_nav ); ?>><?php esc_html_e( 'Style 1', 'osmosis' ); ?></option>
							<option value="2" <?php selected( "2", $slider_dir_nav ); ?>><?php esc_html_e( 'Style 2', 'osmosis' ); ?></option>
							<option value="3" <?php selected( "3", $slider_dir_nav ); ?>><?php esc_html_e( 'Style 3', 'osmosis' ); ?></option>
							<option value="4" <?php selected( "4", $slider_dir_nav ); ?>><?php esc_html_e( 'Style 4', 'osmosis' ); ?></option>
							<option value="0" <?php selected( "0", $slider_dir_nav ); ?>><?php esc_html_e( 'No Navigation', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-direction-nav-color" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-direction-nav-color">
							<strong><?php esc_html_e( 'Navigation color', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select name="grve_page_slider_settings_direction_nav_color" id="grve-page-slider-direction-nav-color">
							<option value="light" <?php selected( "light", $slider_dir_nav_color ); ?>><?php esc_html_e( 'Light', 'osmosis' ); ?></option>
							<option value="dark" <?php selected( "dark", $slider_dir_nav_color ); ?>><?php esc_html_e( 'Dark', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-slider-transition" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-slider-transition">
							<strong><?php esc_html_e( 'Transition', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select id="grve-page-slider-transition" name="grve_page_slider_settings_transition">
							<option value="slide" <?php selected( "slide", $slider_transition ); ?>><?php esc_html_e( 'Slide', 'osmosis' ); ?></option>
							<option value="fade" <?php selected( "fade", $slider_transition ); ?>><?php esc_html_e( 'Fade', 'osmosis' ); ?></option>
							<option value="backSlide" <?php selected( "backSlide", $slider_transition ); ?>><?php esc_html_e( 'Back Slide', 'osmosis' ); ?></option>
							<option value="goDown" <?php selected( "goDown", $slider_transition ); ?>><?php esc_html_e( 'Go Down', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-size" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-size">
							<strong><?php esc_html_e( 'Feature Size', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'With Custom Size option you can select the feature height.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-size" name="grve_page_feature_size">
							<option value="" <?php selected( "", $feature_size ); ?>><?php esc_html_e( 'Full Screen', 'osmosis' ); ?></option>
							<option value="custom" <?php selected( "custom", $feature_size ); ?>><?php esc_html_e( 'Custom Size', 'osmosis' ); ?></option>
						</select>
						<span id="grve-feature-section-height" class="grve-inner-field" <?php if ( "" == $feature_size ) { ?> style="display:none;" <?php } ?>>
							<label><?php esc_html_e( 'Height', 'osmosis' ); ?></label>
							<input type="text" id="grve-page-feature-height" name="grve_page_feature_height" value="<?php echo esc_attr( $feature_height ); ?>" class="small-text" /> px
						</span>
						<span id="grve-feature-section-height-rev" class="grve-inner-field" style="display:none;">
							<label><?php esc_html_e( 'Height is configured from Revolution Slider Settings', 'osmosis' ); ?></label>
						</span>
					</td>
				</tr>
				<tr id="grve-feature-section-header-position" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-position">
							<strong><?php esc_html_e( 'Feature/Header Position', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'With this option header will be shown above or below feature section.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_position" id="grve-page-feature-header-position">
							<option value="above" <?php selected( "above", $feature_header_position ); ?>><?php esc_html_e( 'Header above Feature', 'osmosis' ); ?></option>
							<option value="below" <?php selected( "below", $feature_header_position ); ?>><?php esc_html_e( 'Header below Feature', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-header-integration" class="grve-feature-section-item" <?php if ( "" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-integration">
							<strong><?php esc_html_e( 'Header Integration', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'With this option feature section will be integrated into the header.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_integration" id="grve-page-feature-header-integration">
							<option value="no" <?php selected( 'no', $feature_header_integration ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
							<option value="yes" <?php selected( 'yes', $feature_header_integration ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-header-style" class="grve-feature-section-item" <?php if ( "" == $feature_element || "slider" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-header-integration">
							<strong><?php esc_html_e( 'Header Style', 'osmosis' ); ?></strong>
							<span>
								<?php esc_html_e( 'With this option you can change the coloring of your header.', 'osmosis' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select name="grve_page_feature_header_style" id="grve-page-feature-header-style">
							<?php grve_print_media_header_style_selection($feature_header_style); ?>
						</select>
					</td>
				</tr>
				<tr id="grve-feature-section-effect" class="grve-feature-section-item" <?php if ( "" == $feature_element || "map" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-effect">
							<strong><?php esc_html_e( 'Enable Title Parallax Effect', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-page-feature-effect" name="grve_page_feature_effect" value="parallax" <?php checked( $feature_effect, 'parallax' ); ?>/>
					</td>
				</tr>
				<tr id="grve-feature-section-go-to-section" class="grve-feature-section-item" <?php if ( "" == $feature_element || "map" == $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-go-to-section">
							<strong><?php esc_html_e( 'Enable Bottom Arrow', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-page-feature-go-to-section" name="grve_page_feature_go_to_section" value="yes" <?php checked( $feature_go_to_section, 'yes' ); ?>/>
					</td>
				</tr>
				<tr class="grve-feature-section-arrow-item" <?php if ( empty( $feature_go_to_section ) ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-go-to-section-size">
							<strong><?php esc_html_e( 'Arrow Size', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-go-to-section-size" name="grve_page_feature_go_to_section_size">
							<option value="small " <?php selected( "small", $feature_go_to_section_size ); ?>><?php esc_html_e( 'Small', 'osmosis' ); ?></option>
							<option value="medium" <?php selected( "medium", $feature_go_to_section_size ); ?>><?php esc_html_e( 'Medium', 'osmosis' ); ?></option>
							<option value="large" <?php selected( "large", $feature_go_to_section_size ); ?>><?php esc_html_e( 'Large', 'osmosis' ); ?></option>
							<option value="extra-large" <?php selected( "extra-large", $feature_go_to_section_size ); ?>><?php esc_html_e( 'Extra Large', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-feature-section-arrow-item" <?php if ( empty( $feature_go_to_section ) ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-go-to-section-shape">
							<strong><?php esc_html_e( 'Arrow Shape', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-go-to-section-shape" name="grve_page_feature_go_to_section_shape">
							<option value="none" <?php selected( "none", $feature_go_to_section_shape ); ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							<option value="square" <?php selected( "square", $feature_go_to_section_shape ); ?>><?php esc_html_e( 'Square', 'osmosis' ); ?></option>
							<option value="round" <?php selected( "round", $feature_go_to_section_shape ); ?>><?php esc_html_e( 'Round', 'osmosis' ); ?></option>
							<option value="circle" <?php selected( "circle", $feature_go_to_section_shape ); ?>><?php esc_html_e( 'Circle', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-feature-section-arrow-item" <?php if ( empty( $feature_go_to_section ) ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-page-feature-go-to-section-animation">
							<strong><?php esc_html_e( 'Arrow Animation', 'osmosis' ); ?></strong>
						</label>
					</th>
					<td>
						<select id="grve-page-feature-go-to-section-animation" name="grve_page_feature_go_to_section_animation">
							<option value="none" <?php selected( "none", $feature_go_to_section_animation ); ?>><?php esc_html_e( 'None', 'osmosis' ); ?></option>
							<option value="bounce" <?php selected( "bounce", $feature_go_to_section_animation ); ?>><?php esc_html_e( 'Bounce', 'osmosis' ); ?></option>
							<option value="fade" <?php selected( "fade", $feature_go_to_section_animation ); ?>><?php esc_html_e( 'Fade', 'osmosis' ); ?></option>
							<option value="scale" <?php selected( "scale", $feature_go_to_section_animation ); ?>><?php esc_html_e( 'Scale', 'osmosis' ); ?></option>
						</select>
					</td>
				</tr>

				<tr id="grve-feature-section-image" class="grve-feature-section-item" <?php if ( "image" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php esc_html_e( 'Feature Image', 'osmosis' ); ?></label>
					</th>
					<td>

						<?php if( empty( $image_item ) ) { ?>
						<input type="button" class="grve-upload-image-button button-primary" value="<?php esc_html_e( 'Insert Image', 'osmosis' ); ?>"/>
						<?php } else { ?>
						<input type="button" disabled="disabled" class="grve-upload-image-button button-primary disabled" value="<?php esc_html_e( 'Insert Image', 'osmosis' ); ?>"/>
						<?php } ?>
						<span id="grve-upload-image-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
				<tr id="grve-feature-section-slider" class="grve-feature-section-item" <?php if ( "slider" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php esc_html_e( 'Feature Slider', 'osmosis' ); ?></label>
					</th>
					<td>
						<input type="button" class="grve-upload-feature-slider-button button-primary" value="<?php esc_html_e( 'Insert Images to Slider', 'osmosis' ); ?>"/>
						<span id="grve-upload-feature-slider-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
				<tr id="grve-feature-section-video" class="grve-feature-section-item" <?php if ( "video" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php esc_html_e( 'Feature Video', 'osmosis' ); ?></label>
					</th>
					<td>
					</td>
				</tr>
				<tr id="grve-feature-section-map" class="grve-feature-section-item" <?php if ( "map" != $feature_element ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label><?php esc_html_e( 'Feature Map', 'osmosis' ); ?></label>
					</th>
					<td>
						<input type="button" id="grve-upload-multi-map-point" class="grve-upload-multi-map-point button-primary" value="<?php esc_html_e( 'Insert Point to Map', 'osmosis' ); ?>"/>
						<span id="grve-upload-multi-map-button-spinner" class="grve-action-spinner"></span>
					</td>
				</tr>
			</tbody>
		</table>
		<div id="grve-feature-image-container" data-mode="image" class="grve-feature-section-item" <?php if ( 'image' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $image_item ) ) {
					grve_print_admin_feature_image_item( $image_item );
				}
			?>
		</div>
		<div id="grve-feature-slider-container" data-mode="slider-full" class="grve-feature-section-item" <?php if ( 'slider' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<?php
				if( !empty( $slider_items ) ) {
					grve_print_admin_feature_slider_items( $slider_items );
				}
			?>
		</div>

		<div id="grve-feature-title-container" class="grve-feature-section-item" <?php if ( 'title' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-title-item postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Title', 'osmosis' ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-title-setting">
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Title', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_title" value="<?php echo esc_attr( grve_array_value( $title_item, 'title' ) ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Caption', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_caption" value="<?php echo esc_attr( grve_array_value( $title_item, 'caption' ) ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Title Color', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_title_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'title_color',"#ffffff" ); ?>" data-default-color="#ffffff"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Caption Color', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_caption_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'caption_color',"#ffffff" ); ?>" data-default-color="#ffffff"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Title Tag', 'osmosis' ); ?></label>
								<select name="grve_title_item_title_tag">
									<?php
										$title_tag = grve_array_value( $title_item, 'title_tag', 'h1' );
										grve_print_media_tag_selection( $title_tag );
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Caption Tag', 'osmosis' ); ?></label>
								<select name="grve_title_item_caption_tag">
									<?php
										$caption_tag = grve_array_value( $title_item, 'caption_tag', 'div' );
										grve_print_media_tag_selection( $caption_tag );
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Background Color', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_bg_color" class="wp-color-picker-field" value="<?php echo grve_array_value( $title_item, 'bg_color',"#303030" ); ?>" data-default-color="#303030"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Style', 'osmosis' ); ?></label>
								<select name="grve_title_item_style">
									<?php
										$title_style = grve_array_value( $title_item, 'style', '' );
										grve_print_media_style_selection($title_style);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Alignment', 'osmosis' ); ?></label>
								<select name="grve_title_item_text_align">
									<?php
										$title_text_align = grve_array_value( $title_item, 'text_align', 'left' );
										grve_print_media_align_selection($title_text_align);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Animation', 'osmosis' ); ?></label>
								<select name="grve_title_item_text_animation">
									<?php
										$title_text_animation = grve_array_value( $title_item, 'text_animation', 'fade-in' );
										grve_print_media_text_animation_selection($title_text_animation);
									?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Extra Class', 'osmosis' ); ?></label>
								<input type="text" name="grve_title_item_el_class" value="<?php echo grve_array_value( $title_item, 'el_class' ); ?>"/>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="grve-feature-map-container" class="grve-feature-section-item" <?php if ( 'map' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-map-item postbox">
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Map', 'osmosis' ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-map-setting">
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Single Point Zoom', 'osmosis' ); ?></label>
								<select id="grve-page-feature-map-zoom" name="grve_page_feature_map_zoom">
									<?php for ( $i=1; $i < 20; $i++ ) { ?>
										<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $map_zoom ); ?>><?php echo esc_html( $i ); ?></option>
									<?php } ?>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Global Marker', 'osmosis' ); ?></label>
								<input type="text" class="grve-upload-simple-media-field" id="grve-page-feature-map-marker" name="grve_page_feature_map_marker" value="<?php echo esc_attr( $map_marker ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Insert Marker', 'osmosis' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label>
									<?php esc_html_e( 'Single Popup Open', 'osmosis' ); ?>
								</label>
								<select name="grve_page_feature_map_single_popup">
									<option value="no" <?php selected( 'no', $map_single_popup ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
									<option value="yes" <?php selected( 'yes', $map_single_popup ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label>
									<?php esc_html_e( 'Clustering', 'osmosis' ); ?>
								</label>
								<select name="grve_page_feature_map_clustering">
									<option value="no" <?php selected( 'no', $map_clustering ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
									<option value="yes" <?php selected( 'yes', $map_clustering ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
								</select>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<?php grve_print_admin_feature_map_items( $map_items ); ?>
		</div>
		<div id="grve-feature-video-container" class="grve-feature-section-item" <?php if ( 'video' != $feature_element ) { ?> style="display:none;" <?php } ?>>
			<div class="grve-video-item postbox">
				<?php if( 'modal' == $grve_settings_mode ) { ?>
				<input class="grve-open-video-modal button-primary" type="button" value="<?php esc_attr_e( 'Edit Settings', 'osmosis' ); ?>">
				<span class="grve-button-spacer">&nbsp;</span>
				<?php } ?>
				<span class="grve-modal-spinner"></span>
				<h3 class="grve-title">
					<span><?php esc_html_e( 'Video', 'osmosis' ); ?></span>
				</h3>
				<div class="inside">
					<ul class="grve-video-setting">
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'WebM File URL', 'osmosis' ); ?></label>
								<input type="text" id="grve-page-feature-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_webm" value="<?php echo esc_attr( $video_webm ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'MP4 File URL', 'osmosis' ); ?></label>
								<input type="text" id="grve-page-feature-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_mp4" value="<?php echo esc_attr( $video_mp4 ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'OGV File URL', 'osmosis' ); ?></label>
								<input type="text" id="grve-page-feature-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_video_item_ogv" value="<?php echo esc_attr( $video_ogv ); ?>"/>
								<label></label>
								<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'osmosis' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Fallback Image', 'osmosis' ); ?></label>
								<input type="text" id="grve-page-feature-video-bg-image" class="grve-upload-simple-media-field"  name="grve_video_item_bg_image" value="<?php echo esc_attr( $video_bg_image ); ?>"/>
								<label></label>
								<input type="button" data-media-type="image" class="grve-upload-simple-media-button button-primary" value="<?php esc_attr_e( 'Upload Image', 'osmosis' ); ?>"/>
								<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'osmosis' ); ?>"/>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Show video on devices', 'osmosis' ); ?></label>
								<select name="grve_video_item_video_device">
									<option value="no" <?php selected( 'no', $video_device ); ?>><?php esc_attr_e( 'No', 'osmosis' ); ?></option>
									<option value="yes" <?php selected( 'yes', $video_device ); ?>><?php esc_attr_e( 'Yes', 'osmosis' ); ?></option>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Loop', 'osmosis' ); ?></label>
								<select name="grve_video_item_loop">
									<option value="yes" <?php selected( 'yes', $video_loop ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
									<option value="no" <?php selected( 'no', $video_loop ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
								</select>
							</div>
						</li>
						<li>
							<div class="grve-setting">
								<label><?php esc_html_e( 'Muted', 'osmosis' ); ?></label>
								<select name="grve_video_item_muted">
									<option value="yes" <?php selected( 'yes', $video_muted ); ?>><?php esc_html_e( 'Yes', 'osmosis' ); ?></option>
									<option value="no" <?php selected( 'no', $video_muted ); ?>><?php esc_html_e( 'No', 'osmosis' ); ?></option>
								</select>
								<label><?php echo esc_html__( 'Note: Due to new browser/device restrictions, videos with sound are no longer allowed to autoplay in Chrome, Safari and mobile devices. In these cases videos will be automatically muted.', 'osmosis' ); ?></label>
							</div>
						</li>
					</ul>
					<?php grve_print_admin_feature_video_item( $video_item ); ?>
				</div>
			</div>
		</div>

<?php
}

function grve_admin_save_feature_section( $post_id ) {

	//Feature Slider Items
	$slider_items = array();
	if ( isset( $_POST['grve_slider_item_id'] ) ) {

		$num_of_images = sizeof( $_POST['grve_slider_item_id'] );
		for ( $i=0; $i < $num_of_images; $i++ ) {

			$this_image = array (
				'id' => sanitize_text_field( $_POST['grve_slider_item_id'][ $i ] ),
				'title' => wp_filter_post_kses( $_POST['grve_slider_item_title'][ $i ] ),
				'caption' => wp_filter_post_kses( $_POST['grve_slider_item_caption'][ $i ] ),
				'text_align' => sanitize_text_field( $_POST['grve_slider_item_text_align'][ $i ] ),
				'text_animation' => sanitize_text_field( $_POST['grve_slider_item_text_animation'][ $i ] ),
				'bg_image_size' => sanitize_text_field( $_POST['grve_slider_item_bg_image_size'][ $i ] ),
				'bg_position' => sanitize_text_field( $_POST['grve_slider_item_bg_position'][ $i ] ),
				'bg_tablet_sm_position' => sanitize_text_field( $_POST['grve_slider_item_bg_tablet_sm_position'][ $i ] ),
				'style' => sanitize_text_field( $_POST['grve_slider_item_style'][ $i ] ),
				'title_color' => sanitize_text_field( $_POST['grve_slider_item_title_color'][ $i ] ),
				'caption_color' => sanitize_text_field( $_POST['grve_slider_item_caption_color'][ $i ] ),
				'title_tag' => sanitize_text_field( $_POST['grve_slider_item_title_tag'][ $i ] ),
				'caption_tag' => sanitize_text_field( $_POST['grve_slider_item_caption_tag'][ $i ] ),
				'pattern_overlay' => sanitize_text_field( $_POST['grve_slider_item_pattern_overlay'][ $i ] ),
				'color_overlay' => sanitize_text_field( $_POST['grve_slider_item_color_overlay'][ $i ] ),
				'opacity_overlay' => sanitize_text_field( $_POST['grve_slider_item_opacity_overlay'][ $i ] ),
				'header_style' => sanitize_text_field( $_POST['grve_slider_item_header_style'][ $i ] ),
				'el_class' => sanitize_text_field( $_POST['grve_slider_item_el_class'][ $i ] ),
				'button_text' => sanitize_text_field( $_POST['grve_slider_item_button_text'][ $i ] ),
				'button_url' => sanitize_text_field( $_POST['grve_slider_item_button_url'][ $i ] ),
				'button_target' => sanitize_text_field( $_POST['grve_slider_item_button_target'][ $i ] ),
				'button_color' => sanitize_text_field( $_POST['grve_slider_item_button_color'][ $i ] ),
				'button_size' => sanitize_text_field( $_POST['grve_slider_item_button_size'][ $i ] ),
				'button_shape' => sanitize_text_field( $_POST['grve_slider_item_button_shape'][ $i ] ),
				'button_type' => sanitize_text_field( $_POST['grve_slider_item_button_type'][ $i ] ),
				'button_class' => sanitize_text_field( $_POST['grve_slider_item_button_class'][ $i ] ),
				'button_text2' => sanitize_text_field( $_POST['grve_slider_item_button2_text'][ $i ] ),
				'button_url2' => sanitize_text_field( $_POST['grve_slider_item_button2_url'][ $i ] ),
				'button_target2' => sanitize_text_field( $_POST['grve_slider_item_button2_target'][ $i ] ),
				'button_color2' => sanitize_text_field( $_POST['grve_slider_item_button2_color'][ $i ] ),
				'button_size2' => sanitize_text_field( $_POST['grve_slider_item_button2_size'][ $i ] ),
				'button_shape2' => sanitize_text_field( $_POST['grve_slider_item_button2_shape'][ $i ] ),
				'button_type2' => sanitize_text_field( $_POST['grve_slider_item_button2_type'][ $i ] ),
				'button_class2' => sanitize_text_field( $_POST['grve_slider_item_button2_class'][ $i ] ),
			);
			array_push( $slider_items, $this_image );
		}

	}

	if( empty( $slider_items ) ) {
		delete_post_meta( $post_id, 'grve_page_slider_items' );
		delete_post_meta( $post_id, 'grve_page_slider_settings' );
	} else{
		update_post_meta( $post_id, 'grve_page_slider_items', $slider_items );

		$slider_settings = array (
			'slideshow_speed' => sanitize_text_field( $_POST['grve_page_slider_settings_speed'] ),
			'direction_nav' => sanitize_text_field( $_POST['grve_page_slider_settings_direction_nav'] ),
			'direction_nav_color' => sanitize_text_field( $_POST['grve_page_slider_settings_direction_nav_color'] ),
			'slider_pause' => sanitize_text_field( $_POST['grve_page_slider_settings_pause'] ),
			'transition' => sanitize_text_field( $_POST['grve_page_slider_settings_transition'] ),
		);
		update_post_meta( $post_id, 'grve_page_slider_settings', $slider_settings );
	}

	//Feature Map Items
	$map_items = array();
	if ( isset( $_POST['grve_map_item_point_id'] ) ) {

		$num_of_map_points = sizeof( $_POST['grve_map_item_point_id'] );
		for ( $i=0; $i < $num_of_map_points; $i++ ) {

			$this_point = array (
				'id' => sanitize_text_field( $_POST['grve_map_item_point_id'][ $i ] ),
				'lat' => sanitize_text_field( $_POST['grve_map_item_point_lat'][ $i ] ),
				'lng' => sanitize_text_field( $_POST['grve_map_item_point_lng'][ $i ] ),
				'marker' => sanitize_text_field( $_POST['grve_map_item_point_marker'][ $i ] ),
				'title' => sanitize_text_field( $_POST['grve_map_item_point_title'][ $i ] ),
				'info_text' => wp_filter_post_kses( $_POST['grve_map_item_point_infotext'][ $i ] ),
				'info_text_open' => sanitize_text_field( $_POST['grve_map_item_point_infotext_open'][ $i ] ),
				'button_text' => sanitize_text_field( $_POST['grve_map_item_point_button_text'][ $i ] ),
				'button_url' => sanitize_text_field( $_POST['grve_map_item_point_button_url'][ $i ] ),
				'button_target' => sanitize_text_field( $_POST['grve_map_item_point_button_target'][ $i ] ),
				'button_color' => sanitize_text_field( $_POST['grve_map_item_point_button_color'][ $i ] ),
				'button_class' => sanitize_text_field( $_POST['grve_map_item_point_button_class'][ $i ] ),
			);
			array_push( $map_items, $this_point );
		}

	}

	if( empty( $map_items ) ) {
		delete_post_meta( $post_id, 'grve_page_map_items' );
		delete_post_meta( $post_id, 'grve_page_map_settings' );
	} else{
		update_post_meta( $post_id, 'grve_page_map_items', $map_items );
		$map_settings = array (
			'zoom' => sanitize_text_field( $_POST['grve_page_feature_map_zoom'] ),
			'marker' => sanitize_text_field( $_POST['grve_page_feature_map_marker'] ),
			'single_popup' => sanitize_text_field( $_POST['grve_page_feature_map_single_popup'] ),
			'clustering' => sanitize_text_field( $_POST['grve_page_feature_map_clustering'] ),
		);
		update_post_meta( $post_id, 'grve_page_map_settings', $map_settings );
	}


	//Feature Image Item
	if ( isset( $_POST['grve_image_item_id'] ) ) {

		$image_item = array (
			'id' => sanitize_text_field( $_POST['grve_image_item_id'] ),
			'title' => wp_filter_post_kses( $_POST['grve_image_item_title'] ),
			'caption' => wp_filter_post_kses( $_POST['grve_image_item_caption'] ),
			'text_align' => sanitize_text_field( $_POST['grve_image_item_text_align'] ),
			'text_animation' => sanitize_text_field( $_POST['grve_image_item_text_animation'] ),
			'bg_effect' => sanitize_text_field( $_POST['grve_image_item_bg_effect'] ),
			'bg_image_size' => sanitize_text_field( $_POST['grve_image_item_bg_image_size'] ),
			'bg_position' => sanitize_text_field( $_POST['grve_image_item_bg_position'] ),
			'bg_tablet_sm_position' => sanitize_text_field( $_POST['grve_image_item_bg_tablet_sm_position'] ),
			'style' => sanitize_text_field( $_POST['grve_image_item_style'] ),
			'title_color' => sanitize_text_field( $_POST['grve_image_item_title_color'] ),
			'caption_color' => sanitize_text_field( $_POST['grve_image_item_caption_color'] ),
			'title_tag' => sanitize_text_field( $_POST['grve_image_item_title_tag'] ),
			'caption_tag' => sanitize_text_field( $_POST['grve_image_item_caption_tag'] ),
			'pattern_overlay' => sanitize_text_field( $_POST['grve_image_item_pattern_overlay'] ),
			'color_overlay' => sanitize_text_field( $_POST['grve_image_item_color_overlay'] ),
			'opacity_overlay' => sanitize_text_field( $_POST['grve_image_item_opacity_overlay'] ),
			'el_class' => sanitize_text_field( $_POST['grve_image_item_el_class'] ),
			'button_text' => sanitize_text_field( $_POST['grve_image_item_button_text'] ),
			'button_url' => sanitize_text_field( $_POST['grve_image_item_button_url'] ),
			'button_target' => sanitize_text_field( $_POST['grve_image_item_button_target'] ),
			'button_color' => sanitize_text_field( $_POST['grve_image_item_button_color'] ),
			'button_size' => sanitize_text_field( $_POST['grve_image_item_button_size'] ),
			'button_shape' => sanitize_text_field( $_POST['grve_image_item_button_shape'] ),
			'button_type' => sanitize_text_field( $_POST['grve_image_item_button_type'] ),
			'button_class' => sanitize_text_field( $_POST['grve_image_item_button_class'] ),
			'button_text2' => sanitize_text_field( $_POST['grve_image_item_button2_text'] ),
			'button_url2' => sanitize_text_field( $_POST['grve_image_item_button2_url'] ),
			'button_target2' => sanitize_text_field( $_POST['grve_image_item_button2_target'] ),
			'button_color2' => sanitize_text_field( $_POST['grve_image_item_button2_color'] ),
			'button_size2' => sanitize_text_field( $_POST['grve_image_item_button2_size'] ),
			'button_shape2' => sanitize_text_field( $_POST['grve_image_item_button2_shape'] ),
			'button_type2' => sanitize_text_field( $_POST['grve_image_item_button2_type'] ),
			'button_class2' => sanitize_text_field( $_POST['grve_image_item_button2_class'] ),
		);
		update_post_meta( $post_id, 'grve_page_image_item', $image_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_image_item' );
	}

	//Feature Title Item
	if ( isset( $_POST['grve_title_item_title'] ) ) {

		$text_item = array (
			'title' => wp_filter_post_kses( $_POST['grve_title_item_title'] ),
			'caption' => wp_filter_post_kses( $_POST['grve_title_item_caption'] ),
			'style' => sanitize_text_field( $_POST['grve_title_item_style'] ),
			'text_align' => sanitize_text_field( $_POST['grve_title_item_text_align'] ),
			'text_animation' => sanitize_text_field( $_POST['grve_title_item_text_animation'] ),
			'bg_color' => sanitize_text_field( $_POST['grve_title_item_bg_color'] ),
			'title_color' => sanitize_text_field( $_POST['grve_title_item_title_color'] ),
			'caption_color' => sanitize_text_field( $_POST['grve_title_item_caption_color'] ),
			'title_tag' => sanitize_text_field( $_POST['grve_title_item_title_tag'] ),
			'caption_tag' => sanitize_text_field( $_POST['grve_title_item_caption_tag'] ),
			'el_class' => sanitize_text_field( $_POST['grve_title_item_el_class'] ),
		);
		update_post_meta( $post_id, 'grve_page_title_item', $text_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_title_item' );
	}

	//Feature Video Item
	if ( isset( $_POST['grve_video_item_title'] ) ) {

		$video_item = array (
			'title' => wp_filter_post_kses( $_POST['grve_video_item_title'] ),
			'caption' => wp_filter_post_kses( $_POST['grve_video_item_caption'] ),
			'text_align' => sanitize_text_field( $_POST['grve_video_item_text_align'] ),
			'text_animation' => sanitize_text_field( $_POST['grve_video_item_text_animation'] ),
			'style' => sanitize_text_field( $_POST['grve_video_item_style'] ),
			'title_color' => sanitize_text_field( $_POST['grve_video_item_title_color'] ),
			'caption_color' => sanitize_text_field( $_POST['grve_video_item_caption_color'] ),
			'title_tag' => sanitize_text_field( $_POST['grve_video_item_title_tag'] ),
			'caption_tag' => sanitize_text_field( $_POST['grve_video_item_caption_tag'] ),
			'pattern_overlay' => sanitize_text_field( $_POST['grve_video_item_pattern_overlay'] ),
			'color_overlay' => sanitize_text_field( $_POST['grve_video_item_color_overlay'] ),
			'opacity_overlay' => sanitize_text_field( $_POST['grve_video_item_opacity_overlay'] ),
			'video_webm' => sanitize_text_field( $_POST['grve_video_item_webm'] ),
			'video_mp4' => sanitize_text_field( $_POST['grve_video_item_mp4'] ),
			'video_ogv' => sanitize_text_field( $_POST['grve_video_item_ogv'] ),
			'video_bg_image' => sanitize_text_field( $_POST['grve_video_item_bg_image'] ),
			'video_device' => sanitize_text_field( $_POST['grve_video_item_video_device'] ),
			'video_loop' => sanitize_text_field( $_POST['grve_video_item_loop'] ),
			'video_muted' => sanitize_text_field( $_POST['grve_video_item_muted'] ),
			'el_class' => sanitize_text_field( $_POST['grve_video_item_el_class'] ),
			'button_text' => sanitize_text_field( $_POST['grve_video_item_button_text'] ),
			'button_url' => sanitize_text_field( $_POST['grve_video_item_button_url'] ),
			'button_target' => sanitize_text_field( $_POST['grve_video_item_button_target'] ),
			'button_color' => sanitize_text_field( $_POST['grve_video_item_button_color'] ),
			'button_size' => sanitize_text_field( $_POST['grve_video_item_button_size'] ),
			'button_shape' => sanitize_text_field( $_POST['grve_video_item_button_shape'] ),
			'button_type' => sanitize_text_field( $_POST['grve_video_item_button_type'] ),
			'button_class' => sanitize_text_field( $_POST['grve_video_item_button_class'] ),
			'button_text2' => sanitize_text_field( $_POST['grve_video_item_button2_text'] ),
			'button_url2' => sanitize_text_field( $_POST['grve_video_item_button2_url'] ),
			'button_target2' => sanitize_text_field( $_POST['grve_video_item_button2_target'] ),
			'button_color2' => sanitize_text_field( $_POST['grve_video_item_button2_color'] ),
			'button_size2' => sanitize_text_field( $_POST['grve_video_item_button2_size'] ),
			'button_shape2' => sanitize_text_field( $_POST['grve_video_item_button2_shape'] ),
			'button_type2' => sanitize_text_field( $_POST['grve_video_item_button2_type'] ),
			'button_class2' => sanitize_text_field( $_POST['grve_video_item_button2_class'] ),
		);
		update_post_meta( $post_id, 'grve_page_video_item', $video_item );

	} else {
		delete_post_meta( $post_id, 'grve_page_video_item' );
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
