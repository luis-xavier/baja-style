<?php
	$output = $el_class = '';

	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'title' => '',
			),
			$atts
		)
	);

	echo '<li class="' . esc_attr( $el_class ) . '">';
	echo '<div class="grve-title"> ' . esc_html( $title ) . '</div>';
	echo '<div class="grve-content">' . wpb_js_remove_wpautop( $content ) . '</div>';
	echo'</li>';

?>