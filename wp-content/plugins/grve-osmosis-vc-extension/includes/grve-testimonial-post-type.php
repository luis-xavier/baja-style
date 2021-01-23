<?php
/*
*	Testimonial Post Type Registration
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! class_exists( 'GRVE_Testimonial_Post_Type' ) ) {
	class GRVE_Testimonial_Post_Type {

		function __construct() {

			// Adds the testimonial post type and taxonomies
			$this->grve_testimonial_init();

			// Manage Columns for testimonial overview
			add_filter( 'manage_edit-testimonial_columns',  array( &$this, 'grve_testimonial_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'grve_testimonial_custom_columns' ), 10, 2 );

		}

		function grve_testimonial_init() {


			$labels = array(
				'name' => _x( 'Testimonial Items', 'Testimonial General Name', 'grve-osmosis-vc-extension' ),
				'singular_name' => _x( 'Testimonial Item', 'Testimonial Singular Name', 'grve-osmosis-vc-extension' ),
				'add_new' => __( 'Add New', 'grve-osmosis-vc-extension' ),
				'add_new_item' => __( 'Add New Testimonial Item', 'grve-osmosis-vc-extension' ),
				'edit_item' => __( 'Edit Testimonial Item', 'grve-osmosis-vc-extension' ),
				'new_item' => __( 'New Testimonial Item', 'grve-osmosis-vc-extension' ),
				'view_item' => __( 'View Testimonial Item', 'grve-osmosis-vc-extension' ),
				'search_items' => __( 'Search Testimonial Items', 'grve-osmosis-vc-extension' ),
				'not_found' =>  __( 'No Testimonial Items found', 'grve-osmosis-vc-extension' ),
				'not_found_in_trash' => __( 'No Testimonial Items found in Trash', 'grve-osmosis-vc-extension' ),
				'parent_item_colon' => '',
			);

			$category_labels = array(
				'name' => __( 'Testimonial Categories', 'grve-osmosis-vc-extension' ),
				'singular_name' => __( 'Testimonial Category', 'grve-osmosis-vc-extension' ),
				'search_items' => __( 'Search Testimonial Categories', 'grve-osmosis-vc-extension' ),
				'all_items' => __( 'All Testimonial Categories', 'grve-osmosis-vc-extension' ),
				'parent_item' => __( 'Parent Testimonial Category', 'grve-osmosis-vc-extension' ),
				'parent_item_colon' => __( 'Parent Testimonial Category:', 'grve-osmosis-vc-extension' ),
				'edit_item' => __( 'Edit Testimonial Category', 'grve-osmosis-vc-extension' ),
				'update_item' => __( 'Update Testimonial Category', 'grve-osmosis-vc-extension' ),
				'add_new_item' => __( 'Add New Testimonial Category', 'grve-osmosis-vc-extension' ),
				'new_item_name' => __( 'New Testimonial Category Name', 'grve-osmosis-vc-extension' ),
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
				'menu_icon' => 'dashicons-testimonial',
				'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
				'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
			  );

			register_post_type( 'testimonial' , $args );

			register_taxonomy(
				'testimonial_category',
				array( 'testimonial' ),
				array(
					'hierarchical' => true,
					'label' => __( 'Testimonial Categories', 'grve-osmosis-vc-extension' ),
					'labels' => $category_labels,
					'show_in_nav_menus' => false,
					'show_tagcloud' => false,
					'rewrite' => true,
				)
			);
			register_taxonomy_for_object_type( 'testimonial_category', 'testimonial' );

		}

		function grve_testimonial_edit_columns( $columns ) {

			$columns['cb'] = "<input type=\"checkbox\" />";
			$columns['title'] = __( 'Title', 'grve-osmosis-vc-extension' );
			$columns['author'] = __( 'Author', 'grve-osmosis-vc-extension' );
			$columns['testimonial_category'] = __( 'Testimonial Categories', 'grve-osmosis-vc-extension' );
			$columns['date'] = __( 'Date', 'grve-osmosis-vc-extension' );

			return $columns;
		}

		function grve_testimonial_custom_columns( $column, $post_id ) {

			switch ( $column ) {
				case 'testimonial_category':
					echo get_the_term_list( $post_id, 'testimonial_category', '', ', ','' );
				break;
			}
		}

	}
	new GRVE_Testimonial_Post_Type;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.

