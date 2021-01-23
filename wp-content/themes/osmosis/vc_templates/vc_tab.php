<?php

	$output = $el_class = '';
	
	extract(
		shortcode_atts(
			array(
				'el_class' => '',
				'title' => '',
				'tab_id' => '',
			),
			$atts
		)
	);

	echo "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="grve-tab-content ' . $el_class . '">';
	echo wpb_js_remove_wpautop($content);
	echo "\n\t\t\t" . '</div>';

?>