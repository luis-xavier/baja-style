<?php
/*
*	Portfolio Post Type Registration
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! class_exists( 'GRVE_Osmosis_Portfolio_Post_Type' ) ) {
	class GRVE_Osmosis_Portfolio_Post_Type {

		function __construct() {

			// Adds the portfolio post type and taxonomies
			$this->grve_portfolio_init();

			// Manage Columns for portfolio overview
			add_filter( 'manage_edit-portfolio_columns',  array( &$this, 'grve_portfolio_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'grve_portfolio_custom_columns' ), 10, 2 );

		}

		function grve_portfolio_init() {

			$portfolio_base_slug = 'portfolio';
			if ( function_exists( 'grve_option' ) ) {
				$portfolio_base_slug = grve_option( 'portfolio_slug', 'portfolio' );
			}

			$labels = array(
				'name' => _x( 'Portfolio Items', 'Portfolio General Name', 'grve-osmosis-vc-extension' ),
				'singular_name' => _x( 'Portfolio Item', 'Portfolio Singular Name', 'grve-osmosis-vc-extension' ),
				'add_new' => __( 'Add New', 'grve-osmosis-vc-extension' ),
				'add_new_item' => __( 'Add New Portfolio Item', 'grve-osmosis-vc-extension' ),
				'edit_item' => __( 'Edit Portfolio Item', 'grve-osmosis-vc-extension' ),
				'new_item' => __( 'New Portfolio Item', 'grve-osmosis-vc-extension' ),
				'view_item' => __( 'View Portfolio Item', 'grve-osmosis-vc-extension' ),
				'search_items' => __( 'Search Portfolio Items', 'grve-osmosis-vc-extension' ),
				'not_found' =>  __( 'No Portfolio Items found', 'grve-osmosis-vc-extension' ),
				'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'grve-osmosis-vc-extension' ),
				'parent_item_colon' => '',
			);

			$category_labels = array(
				'name' => __( 'Portfolio Categories', 'grve-osmosis-vc-extension' ),
				'singular_name' => __( 'Portfolio Category', 'grve-osmosis-vc-extension' ),
				'search_items' => __( 'Search Portfolio Categories', 'grve-osmosis-vc-extension' ),
				'all_items' => __( 'All Portfolio Categories', 'grve-osmosis-vc-extension' ),
				'parent_item' => __( 'Parent Portfolio Category', 'grve-osmosis-vc-extension' ),
				'parent_item_colon' => __( 'Parent Portfolio Category:', 'grve-osmosis-vc-extension' ),
				'edit_item' => __( 'Edit Portfolio Category', 'grve-osmosis-vc-extension' ),
				'update_item' => __( 'Update Portfolio Category', 'grve-osmosis-vc-extension' ),
				'add_new_item' => __( 'Add New Portfolio Category', 'grve-osmosis-vc-extension' ),
				'new_item_name' => __( 'New Portfolio Category Name', 'grve-osmosis-vc-extension' ),
			);

			$field_labels = array(
				'name' => __( 'Portfolio Fields', 'grve-osmosis-vc-extension' ),
				'singular_name' => __( 'Portfolio Field', 'grve-osmosis-vc-extension' ),
				'search_items' => __( 'Search Portfolio Fields', 'grve-osmosis-vc-extension' ),
				'all_items' => __( 'All Portfolio Fields', 'grve-osmosis-vc-extension' ),
				'parent_item' => __( 'Parent Portfolio Field', 'grve-osmosis-vc-extension' ),
				'parent_item_colon' => __( 'Parent Portfolio Field:', 'grve-osmosis-vc-extension' ),
				'edit_item' => __( 'Edit Portfolio Field', 'grve-osmosis-vc-extension' ),
				'update_item' => __( 'Update Portfolio Field', 'grve-osmosis-vc-extension' ),
				'add_new_item' => __( 'Add New Portfolio Field', 'grve-osmosis-vc-extension' ),
				'new_item_name' => __( 'New Portfolio Field Name', 'grve-osmosis-vc-extension' ),
			);

			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-format-gallery',
				'supports' => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'custom-fields', 'comments' ),
				'rewrite' => array( 'slug' => $portfolio_base_slug, 'with_front' => false ),
			);

			register_post_type( 'portfolio' , $args );

			register_taxonomy(
				'portfolio_category',
				array( 'portfolio' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Portfolio Categories', 'grve-osmosis-vc-extension' ),
					'labels' => $category_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'portfolio_category', 'portfolio' );

			register_taxonomy(
				'portfolio_field',
				array( 'portfolio' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Portfolio Fields', 'grve-osmosis-vc-extension' ),
					'labels' => $field_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'portfolio_field', 'portfolio' );

		}

		function grve_portfolio_edit_columns( $columns ) {

			$columns['cb'] = "<input type=\"checkbox\" />";
			$columns['title'] = __( 'Title', 'grve-osmosis-vc-extension' );
			$columns['portfolio_thumbnail'] = __( 'Featured Image', 'grve-osmosis-vc-extension' );
			$columns['author'] = __( 'Author', 'grve-osmosis-vc-extension' );
			$columns['portfolio_category'] = __( 'Portfolio Categories', 'grve-osmosis-vc-extension' );
			$columns['portfolio_field'] = __( 'Portfolio Fields', 'grve-osmosis-vc-extension' );
			$columns['date'] = __( 'Date', 'grve-osmosis-vc-extension' );

			return $columns;
		}

		function grve_portfolio_custom_columns( $column, $post_id ) {

			switch ( $column ) {
				case "portfolio_thumbnail":
					if ( has_post_thumbnail( $post_id ) ) {
						$thumbnail_id = get_post_thumbnail_id( $post_id );
						$attachment_src = wp_get_attachment_image_src( $thumbnail_id, array( 80, 80 ) );
						$thumb = $attachment_src[0];
					} else {
						$thumb = GRVE_OSMOSIS_VC_EXT_PLUGIN_DIR_URL .'assets/images/no-image.jpg';
					}
					echo '<img class="attachment-80x80" width="80" height="80" alt="portfolio image" src="' . esc_url( $thumb ) . '">';
					break;
				case 'portfolio_category':
					echo get_the_term_list( $post_id, 'portfolio_category', '', ', ','' );
				break;
				case 'portfolio_field':
					echo get_the_term_list( $post_id, 'portfolio_field', '', ', ','' );
				break;
			}
		}

	}
	new GRVE_Osmosis_Portfolio_Post_Type;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
