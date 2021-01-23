<?php

/*
*	Osmosis Greatives Visual Composer Extension Plugin Hooks
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Translation function returning the theme translations
 */

/* All */
function grve_theme_vce_get_string_all() {
    return esc_html__( 'All', 'osmosis' );
}
/* Read more */
function grve_theme_vce_get_string_read_more() {
    return esc_html__( 'read more', 'osmosis' );
}
/* In Categories */
function grve_theme_vce_get_string_categories_in() {
    return esc_html__( 'in', 'osmosis' );
}
/* No comments */
function grve_theme_vce_get_string_no_comments() {
    return esc_html__( 'no comments', 'osmosis' );
}
/* One comment */
function grve_theme_vce_get_string_one_comment() {
    return esc_html__( '1 comment', 'osmosis' );
}
/* Comments */
function grve_theme_vce_get_string_comments() {
    return esc_html__( 'comments', 'osmosis' );
}
/* Author By */
function grve_theme_vce_get_string_by_author() {
    return esc_html__( 'By:', 'osmosis' );
}

/**
 * Hooks for portfolio translations
 */

add_filter( 'grve_vce_portfolio_string_all_categories', 'grve_theme_vce_get_string_all' );

 /**
 * Hooks for blog translations
 */

add_filter( 'grve_vce_string_read_more', 'grve_theme_vce_get_string_read_more' );
add_filter( 'grve_vce_blog_string_all_categories', 'grve_theme_vce_get_string_all' );
add_filter( 'grve_vce_blog_string_categories_in', 'grve_theme_vce_get_string_categories_in' );
add_filter( 'grve_vce_blog_string_no_comments', 'grve_theme_vce_get_string_no_comments' );
add_filter( 'grve_vce_blog_string_one_comment', 'grve_theme_vce_get_string_one_comment' );
add_filter( 'grve_vce_blog_string_comments', 'grve_theme_vce_get_string_comments' );
add_filter( 'grve_vce_blog_string_by_author', 'grve_theme_vce_get_string_by_author' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
