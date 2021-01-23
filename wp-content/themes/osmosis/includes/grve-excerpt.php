<?php

/*
 *	Excerpt functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Custom excerpt
 */
function grve_excerpt( $limit, $more = '0' ) {
	global $post;
	$post_id = $post->ID;

	if ( has_excerpt( $post_id ) ) {
		$excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );
		if ( '1' == $more ) {
			$excerpt .= grve_read_more( $post_id );
		}
	} else {
		$content = get_the_content('');
		$content = do_shortcode( $content );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		if ( '1' == $more ) {
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			$excerpt .= grve_read_more( $post_id );
		} else{
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
		}
	}
	return	$excerpt;
}

 /**
 * Custom read more
 */
if ( !function_exists('grve_read_more') ) {
	function grve_read_more( $post_id = "" ) {
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		return '<a class="grve-read-more" href="' . esc_url( get_permalink( $post_id ) ) . '"><span>' . esc_html__( 'read more', 'osmosis' ) . '</span></a>';
	}
}

 /**
 * Add filters for excerpt length
 */

function grve_new_excerpt_more( $more ) {
	if ( grve_events_calendar_is_overview() ) {
		return $more;
	}
	return grve_read_more();
}
//add_filter('excerpt_more', 'grve_new_excerpt_more');

//Omit closing PHP tag to avoid accidental whitespace output errors.

