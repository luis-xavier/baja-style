<?php

/*
 *	Metabox functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


/**
 * Functions to print global metaboxes
 */
add_action( 'add_meta_boxes', 'osmosis_ext_page_options_add_custom_boxes' );

function osmosis_ext_page_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	//General Page Options
	if ( function_exists( 'osmosis_grve_page_options_box' ) ) {
		add_meta_box(
			'grve-page-options',
			esc_html__( 'Page Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_page_options_box',
			'page'
		);
	}
	if ( function_exists( 'osmosis_grve_page_feature_section_box' ) ) {
		add_meta_box(
			'grve-feature-section-metabox',
			esc_html__( 'Feature Section', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_page_feature_section_box',
			'page'
		);
	}
}

/**
 * Functions to print portfolio metaboxes
 */

add_action( 'add_meta_boxes', 'osmosis_ext_portfolio_options_add_custom_boxes' );

function osmosis_ext_portfolio_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}
	if ( function_exists( 'osmosis_grve_portfolio_options_box' ) ) {	
		add_meta_box(
			'grve-portfolio-options',
			esc_html__( 'Portfolio Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_portfolio_options_box',
			'portfolio'
		);	
	}
	if ( function_exists( 'osmosis_grve_portfolio_link_mode_box' ) ) {	
		add_meta_box(
			'portfolio_link_mode',
			esc_html__( 'Portfolio Link Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_portfolio_link_mode_box',
			'portfolio'
		);	
	}
	if ( function_exists( 'osmosis_grve_portfolio_media_section_box' ) ) {
		add_meta_box(
			'portfolio_media_section',
			esc_html__( 'Portfolio Media', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_portfolio_media_section_box',
			'portfolio'
		);
	}
	if ( function_exists( 'osmosis_grve_portfolio_feature_section_box' ) ) {
		add_meta_box(
			'grve-feature-section-metabox',
			esc_html__( 'Feature Section', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_portfolio_feature_section_box',
			'portfolio'
		);
	}	

}

/**
 * Functions to print post metaboxes
 */
add_action( 'add_meta_boxes', 'osmosis_ext_post_options_add_custom_boxes' );

function osmosis_ext_post_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}
	
	if ( function_exists( 'osmosis_grve_post_options_box' ) ) {	
		add_meta_box(
			'grve-post-options',
			esc_html__( 'Post Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_post_options_box',
			'post'
		);	
	}

	if ( function_exists( 'osmosis_grve_meta_box_post_format_gallery' ) ) {
		add_meta_box(
			'grve-meta-box-post-format-gallery',
			esc_html__( 'Gallery Format Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_meta_box_post_format_gallery',
			'post'
		);
	}
	if ( function_exists( 'osmosis_grve_meta_box_post_format_link' ) ) {
		add_meta_box(
			'grve-meta-box-post-format-link',
			esc_html__( 'Link Format Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_meta_box_post_format_link',
			'post'
		);
	}
	if ( function_exists( 'osmosis_grve_meta_box_post_format_quote' ) ) {
		add_meta_box(
			'grve-meta-box-post-format-quote',
			esc_html__( 'Quote Format Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_meta_box_post_format_quote',
			'post'
		);
	}
	if ( function_exists( 'osmosis_grve_meta_box_post_format_video' ) ) {
		add_meta_box(
			'grve-meta-box-post-format-video',
			esc_html__( 'Video Format Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_meta_box_post_format_video',
			'post'
		);
	}
	if ( function_exists( 'osmosis_grve_meta_box_post_format_audio' ) ) {
		add_meta_box(
			'grve-meta-box-post-format-audio',
			esc_html__( 'Audio Format Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_meta_box_post_format_audio',
			'post'
		);
	}
	if ( function_exists( 'osmosis_grve_post_feature_section_box' ) ) {
		add_meta_box(
			'grve-feature-section-metabox',
			esc_html__( 'Feature Section', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_post_feature_section_box',
			'post'
		);
	}

}

/**
 * Functions to print product metaboxes
 */
add_action( 'add_meta_boxes', 'osmosis_ext_product_options_add_custom_boxes' );

function osmosis_ext_product_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}
	
	if ( function_exists( 'osmosis_grve_product_layout_options_box' ) ) {	
		add_meta_box(
			'grve-product-layout-options',
			esc_html__( 'Product Layout Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_product_layout_options_box',
			'product'
		);
	}

}

/**
 * Functions to print event metaboxes
 */
add_action( 'add_meta_boxes', 'osmosis_ext_event_options_add_custom_boxes' );

function osmosis_ext_event_options_add_custom_boxes() {

	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}
	
	if ( function_exists( 'osmosis_grve_event_layout_options_box' ) ) {	
		add_meta_box(
			'grve-event-layout-options',
			esc_html__( 'Event Layout Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_event_layout_options_box',
			'tribe_events'
		);
	}

}

/**
 * Functions to print testimonial metaboxes
 */

add_action( 'add_meta_boxes', 'osmosis_ext_testimonial_options_add_custom_boxes' );

function osmosis_ext_testimonial_options_add_custom_boxes() {
	
	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
		return;
	}

	if ( function_exists( 'osmosis_grve_testimonial_options_box' ) ) {
		add_meta_box(
			'grve_testimonial_options',
			esc_html__( 'Testimonial Options', 'grve-osmosis-vc-extension' ),
			'osmosis_grve_testimonial_options_box',
			'testimonial'
		);
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
