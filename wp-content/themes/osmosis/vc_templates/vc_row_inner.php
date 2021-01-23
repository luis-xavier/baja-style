<?php

	$output = $el_class = $el_id_string = '';

	extract(
		shortcode_atts(
			array(
				'el_class'        => '',
				'el_id'        => '',
				'css' => '',
			),
			$atts
		)
	);

	$css_custom = grve_vc_shortcode_custom_css_class( $css, '' );
	$row_classes = array( 'grve-row', 'grve-bookmark' );
	if ( !empty( $css_custom ) ) {
		array_push( $row_classes, $css_custom );
	}
	if ( !empty ( $el_class ) ) {
		array_push( $row_classes, $el_class );
	}
	$row_css_string = implode( ' ', $row_classes );

	$wrapper_attributes = array();
	if ( !empty ( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	$wrapper_attributes[] = 'class="' . esc_attr( $row_css_string ) . '"';

	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>' . do_shortcode( $content ) . '</div>';

//Omit closing PHP tag to avoid accidental whitespace output errors.
