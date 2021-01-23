<?php
/*
*	Collection of functions for the media items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

$grve_media_align_selection = array(
	'left' => __( 'Left', 'osmosis' ),
	'right' => __( 'Right', 'osmosis' ),
	'center' => __( 'Center', 'osmosis' ),
);

$grve_media_color_selection = array(
	'dark' => __( 'Dark', 'osmosis' ),
	'light' => __( 'Light', 'osmosis' ),
	'primary-1' => __( 'Primary 1', 'osmosis' ),
	'primary-2' => __( 'Primary 2', 'osmosis' ),
	'primary-3' => __( 'Primary 3', 'osmosis' ),
	'primary-4' => __( 'Primary 4', 'osmosis' ),
	'primary-5' => __( 'Primary 5', 'osmosis' ),
);

$grve_media_header_style_selection = array(
	'default' => __( 'Default', 'osmosis' ),
	'dark' => __( 'Dark', 'osmosis' ),
	'light' => __( 'Light', 'osmosis' ),
);

$grve_media_color_overlay_selection = array(
	'' => __( 'None', 'osmosis' ),
	'dark' => __( 'Dark', 'osmosis' ),
	'light' => __( 'Light', 'osmosis' ),
	'primary-1' => __( 'Primary 1', 'osmosis' ),
	'primary-2' => __( 'Primary 2', 'osmosis' ),
	'primary-3' => __( 'Primary 3', 'osmosis' ),
	'primary-4' => __( 'Primary 4', 'osmosis' ),
	'primary-5' => __( 'Primary 5', 'osmosis' ),
);

$grve_media_style_selection = array(
	'default' => __( 'Default', 'osmosis' ),
	'1' => __( 'Style 1', 'osmosis' ),
	'2' => __( 'Style 2', 'osmosis' ),
	'3' => __( 'Style 3', 'osmosis' ),
	'4' => __( 'Style 4', 'osmosis' ),
);

$grve_media_pattern_overlay_selection = array(
	'' => __( 'No', 'osmosis' ),
	'default' => __( 'Yes', 'osmosis' ),
);

$grve_media_text_animation_selection = array(
	'fade-in' => __( 'Default', 'osmosis' ),
	'fade-in-up' => __( 'Fade In Up', 'osmosis' ),
	'fade-in-down' => __( 'Fade In Down', 'osmosis' ),
	'fade-in-left' => __( 'Fade In Left', 'osmosis' ),
	'fade-in-right' => __( 'Fade In Right', 'osmosis' ),
	'zoom-in' => __( 'Zoom In', 'osmosis' ),
	'zoom-out' => __( 'Zoom Out', 'osmosis' ),
	'none' => __( 'None', 'osmosis' ),
);

$grve_media_button_color_selection = array(
	'primary-1' => __( 'Primary 1', 'osmosis' ),
	'primary-2' => __( 'Primary 2', 'osmosis' ),
	'primary-3' => __( 'Primary 3', 'osmosis' ),
	'primary-4' => __( 'Primary 4', 'osmosis' ),
	'primary-5' => __( 'Primary 5', 'osmosis' ),
	'green' => __( 'Green', 'osmosis' ),
	'orange' => __( 'Orange', 'osmosis' ),
	'red' => __( 'Red', 'osmosis' ),
	'blue' => __( 'Blue', 'osmosis' ),
	'aqua' => __( 'Aqua', 'osmosis' ),
	'purple' => __( 'Purple', 'osmosis' ),
	'black' => __( 'Black', 'osmosis' ),
	'grey' => __( 'Grey', 'osmosis' ),
	'white' => __( 'White', 'osmosis' ),
);

$grve_media_button_size_selection = array(
	'extrasmall' => __( 'Extra Small', 'osmosis' ),
	'small' => __( 'Small', 'osmosis' ),
	'medium' => __( 'Medium', 'osmosis' ),
	'large' => __( 'Large', 'osmosis' ),
	'extralarge' => __( 'Extra Large', 'osmosis' ),
);

$grve_media_button_shape_selection = array(
	'square' => __( 'Square', 'osmosis' ),
	'round' => __( 'Round', 'osmosis' ),
	'extra-round' => __( 'Extra Round', 'osmosis' ),
);

$grve_media_button_type_selection = array(
	'' => __( 'Default', 'osmosis' ),
	'outline' => __( 'Outline', 'osmosis' ),
);

$grve_media_button_target_selection = array(
	'_self' => __( 'Same Page', 'osmosis' ),
	'_blank' => __( 'New page', 'osmosis' ),
);

$grve_media_bg_image_size_selection	= array(
	'' => __( 'Default', 'osmosis' ),
	'full' => __( 'Full', 'osmosis' ),
);

$grve_media_bg_position_selection = array(
	'left-top' => __( 'Left Top', 'osmosis' ),
	'left-center' => __( 'Left Center', 'osmosis' ),
	'left-bottom' => __( 'Left Bottom', 'osmosis' ),
	'center-top' => __( 'Center Top', 'osmosis' ),
	'center-center' => __( 'Center Center', 'osmosis' ),
	'center-bottom' => __( 'Center Bottom', 'osmosis' ),
	'right-top' => __( 'Right Top', 'osmosis' ),
	'right-center' => __( 'Right Center', 'osmosis' ),
	'right-bottom' => __( 'Right Bottom', 'osmosis' ),
);

$grve_media_bg_effect_selection = array(
	'none' => __( 'None', 'osmosis' ),
	'zoom' => __( 'Zoom', 'osmosis' ),
);

$grve_media_tag_selection = array(
	'div' => __( 'div', 'osmosis' ),
	'h1' => __( 'h1', 'osmosis' ),
	'h2' => __( 'h2', 'osmosis' ),
	'h3' => __( 'h3', 'osmosis' ),
	'h4' => __( 'h4', 'osmosis' ),
	'h5' => __( 'h5', 'osmosis' ),
	'h6' => __( 'h6', 'osmosis' ),
);

$grve_media_boolean_selection = array(
	'no' => __( 'No', 'osmosis' ),
	'yes' => __( 'Yes', 'osmosis' ),
);


/**
 * Print Media Selector Functions
 */
function grve_print_media_options( $selector_array, $current_value = "" ) {

	foreach ( $selector_array as $value=>$display_value ) {
	?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_value, $value ); ?>><?php echo esc_html( $display_value ); ?></option>
	<?php
	}

}

function grve_print_media_boolean_selection( $current_value = "" ) {
	global $grve_media_boolean_selection;
	grve_print_media_options( $grve_media_boolean_selection, $current_value );
}

function grve_print_media_tag_selection( $current_value = "" ) {
	global $grve_media_tag_selection;
	grve_print_media_options( $grve_media_tag_selection, $current_value );
}

function grve_print_media_button_color_selection( $current_value = "" ) {
	global $grve_media_button_color_selection;
	grve_print_media_options( $grve_media_button_color_selection, $current_value );
}
function grve_print_media_button_size_selection( $current_value = "" ) {
	global $grve_media_button_size_selection;
	grve_print_media_options( $grve_media_button_size_selection, $current_value );
}
function grve_print_media_button_shape_selection( $current_value = "" ) {
	global $grve_media_button_shape_selection;
	grve_print_media_options( $grve_media_button_shape_selection, $current_value );
}
function grve_print_media_button_type_selection( $current_value = "" ) {
	global $grve_media_button_type_selection;
	grve_print_media_options( $grve_media_button_type_selection, $current_value );
}
function grve_print_media_button_target_selection( $current_value = "" ) {
	global $grve_media_button_target_selection;
	grve_print_media_options( $grve_media_button_target_selection, $current_value );
}

function grve_print_media_style_selection( $current_value = "" ) {
	global $grve_media_style_selection;
	grve_print_media_options( $grve_media_style_selection, $current_value );
}
function grve_print_media_color_selection( $current_value = "" ) {
	global $grve_media_color_selection;
	grve_print_media_options( $grve_media_color_selection, $current_value );
}
function grve_print_media_align_selection( $current_value = "" ) {
	global $grve_media_align_selection;
	grve_print_media_options( $grve_media_align_selection, $current_value );
}
function grve_print_media_header_style_selection( $current_value = "" ) {
	global $grve_media_header_style_selection;
	grve_print_media_options( $grve_media_header_style_selection, $current_value );
}

function grve_print_media_color_overlay_selection( $current_value = "" ) {
	global $grve_media_color_overlay_selection;
	grve_print_media_options( $grve_media_color_overlay_selection, $current_value );
}
function grve_print_media_pattern_overlay_selection( $current_value = "" ) {
	global $grve_media_pattern_overlay_selection;
	grve_print_media_options( $grve_media_pattern_overlay_selection, $current_value );
}
function grve_print_media_opacity_overlay_selection( $current_value = "" ) {

	for ( $i = 1; $i <= 9; $i++ ) {
		$value = $i*10 ;
?>
	<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_value, $value ); ?>>
		<?php echo esc_html( $value ); ?>
	</option>
<?php
	}
}

function grve_print_media_text_animation_selection( $current_value = "" ) {
	global $grve_media_text_animation_selection;
	grve_print_media_options( $grve_media_text_animation_selection, $current_value );
}

function grve_print_media_bg_position_selection( $current_value = "center-center" ) {
	global $grve_media_bg_position_selection;
	grve_print_media_options( $grve_media_bg_position_selection, $current_value );
}

function grve_print_media_bg_position_inherit_selection( $current_value = "" ) {
	global $grve_media_bg_position_selection;
	?>
	<option value="" <?php selected( "", $current_value ); ?>><?php esc_html_e( 'Inherit from above', 'osmosis' ); ?></option>
	<?php
	grve_print_media_options( $grve_media_bg_position_selection, $current_value );
}

function grve_print_media_bg_effect_selection( $current_value = "" ) {
	global $grve_media_bg_effect_selection;
	grve_print_media_options( $grve_media_bg_effect_selection, $current_value );
}

function grve_print_media_bg_image_size_selection( $current_value = "" ) {
	global $grve_media_bg_image_size_selection;
	grve_print_media_options( $grve_media_bg_image_size_selection, $current_value );
}

/**
 * Prints Media Slider items
 */
function grve_print_admin_media_slider_items( $slider_items ) {

	foreach ( $slider_items as $slider_item ) {
		grve_print_admin_media_slider_item( $slider_item, '' );
	}

}

/**
 * Get Single Slider Media with ajax
 */
function grve_get_slider_media() {

	check_ajax_referer( 'osmosis-grve-get-slider-media', '_grve_nonce' );

	if( isset( $_POST['attachment_ids'] ) ) {

		$attachment_ids = sanitize_text_field( $_POST['attachment_ids'] );

		if( !empty( $attachment_ids ) ) {

			$media_ids = explode(",", $attachment_ids);

			foreach ( $media_ids as $media_id ) {
				$slider_item = array (
					'id' => $media_id,
				);
				grve_print_admin_media_slider_item( $slider_item, "new" );
			}
		}
	}
	if( isset( $_POST['attachment_ids'] ) ) { die(); }
}
add_action( 'wp_ajax_grve_get_slider_media', 'grve_get_slider_media' );


/**
 * Prints Single Slider Media  Item
 */
function grve_print_admin_media_slider_item( $slider_item, $new = "" ) {
	$media_id = $slider_item['id'];

	$title = '';

	$thumb_src = wp_get_attachment_image_src( $media_id, 'thumbnail' );
	$thumbnail_url = $thumb_src[0];
	$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
	$alt = ! empty( $alt ) ? esc_attr( $alt ) : '';

	$grve_button_class = "grve-slider-item-delete-button";

	if( $new = "new" ) {
		$grve_button_class = "grve-slider-item-delete-button grve-item-new";
	}

?>
	<div class="grve-slider-item-minimal">
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e( 'Delete', 'osmosis' ); ?>">
		<h3 class="hndle grve-title">
			<span><?php esc_html_e( 'Image', 'osmosis' ); ?></span>
		</h3>
		<div class="inside">
			<input type="hidden" value="<?php echo esc_attr( $media_id ); ?>" name="grve_media_slider_item_id[]">
			<?php echo '<img class="grve-thumb" src="' . esc_url( $thumbnail_url ) . '" title="' . esc_attr( $title ) . '" attid="' . esc_attr( $media_id ) . '" alt="' . esc_attr( $alt ) . '" width="120" height="120"/>'; ?>
		</div>
	</div>
<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
