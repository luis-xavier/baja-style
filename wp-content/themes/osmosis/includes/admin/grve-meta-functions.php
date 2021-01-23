<?php
/*
*	Helper Functions for meta options ( Post / Page)
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Function to print menu selector
 */
function grve_print_menu_selection( $menu_id, $id, $name, $default = 'none' ) {

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $menu_id ); ?>>
			<?php
				if ( 'none' == $default ){
					esc_html_e( 'None', 'osmosis' );
				} else {
					esc_html_e( 'Default', 'osmosis' );
				}
			?>
		</option>
	<?php
		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $item ) {
	?>
				<option value="<?php echo esc_attr( $item->term_id ); ?>" <?php selected( $item->term_id, $menu_id ); ?>>
					<?php echo esc_html( $item->name ); ?>
				</option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print menu type selector
 */
function grve_print_menu_type_selection( $menu_type, $id, $name, $default = '' ) {

	$menu_types = array(
		'' => __( 'Default', 'osmosis' ),
		'simply' => __( 'Simple', 'osmosis' ),
		'button' => __( 'Button', 'osmosis' ),
		'box' => __( 'Box', 'osmosis' ),
		'hidden' => __( 'Hidden', 'osmosis' ),
	);

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
	<?php
		foreach ( $menu_types as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $menu_type ); ?>><?php echo esc_html( $value ); ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print layout selector
 */
function grve_print_layout_selection( $layout, $id, $name ) {

	$layouts = array(
		'' => __( 'Default', 'osmosis' ),
		'none' => __( 'Full Width', 'osmosis' ),
		'left' => __( 'Left Sidebar', 'osmosis' ),
		'right' => __( 'Right Sidebar', 'osmosis' ),
	);

	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
	<?php
		foreach ( $layouts as $key => $value ) {
			if ( $value ) {
	?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $layout ); ?>><?php echo esc_html( $value ); ?></option>
	<?php
			}
		}
	?>
	</select>
	<?php
}

/**
 * Function to print sidebar selector
 */
function grve_print_sidebar_selection( $sidebar, $id, $name ) {
	global $wp_registered_sidebars;


	?>
	<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>">
		<option value="" <?php selected( '', $sidebar ); ?>><?php echo esc_html__( 'Default', 'osmosis' ); ?></option>
	<?php
	foreach ( $wp_registered_sidebars as $key => $value ) {
		?>
		<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $sidebar ); ?>><?php echo esc_html( $value['name'] ); ?></option>
		<?php
	}
	?>
	</select>
	<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
