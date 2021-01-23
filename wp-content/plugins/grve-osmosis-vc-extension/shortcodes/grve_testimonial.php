<?php
/**
 * Testimonial Shortcode
 */

if( !function_exists( 'grve_testimonial_shortcode' ) ) {

	function grve_testimonial_shortcode( $attr, $content ) {

		$portfolio_row_start = $allow_filter = $class_fullwidth = $slider_data = $output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'testimonial_type' => 'carousel',
					'testimonial_mode' => 'no-border-mode',
					'columns' => '3',
					'disable_pagination' => '',
					'show_image' => 'no',
					'items_to_show' => '20',
					'order_by' => 'date',
					'order' => 'DESC',
					'margin_bottom' => '',
					'slideshow_speed' => '3000',
					'pagination_speed' => '400',
					'auto_play' => 'yes',
					'navigation_type' => '1',
					'pause_hover' => 'no',
					'auto_height' => 'no',
					'align' => 'left',
					'text_style' => 'none',
					'el_class' => '',
				),
				$attr
			)
		);

		$testimonial_classes = array( 'grve-element' );

		if ( !empty ( $el_class ) ) {
			array_push( $testimonial_classes, $el_class);
		}

		$style = grve_osmosis_vce_build_margin_bottom_style( $margin_bottom );

		$data_string = '';

		switch( $testimonial_type ) {
			case 'masonry':
				$data_string = ' data-gutter="yes" data-type="' . esc_attr( $columns ) . '-columns" data-layout="masonry"';
				if ( 'border-mode' == $testimonial_mode ) {
					array_push( $testimonial_classes, 'grve-border-mode' );
				}
				array_push( $testimonial_classes, 'grve-testimonial-grid' );
				array_push( $testimonial_classes, 'grve-isotope' );
				break;
			case 'grid':
				$data_string = ' data-gutter="yes" data-type="' . esc_attr( $columns ) . '-columns" data-layout="fitRows"';
				if ( 'border-mode' == $testimonial_mode ) {
					array_push( $testimonial_classes, 'grve-border-mode' );
				}
				array_push( $testimonial_classes, 'grve-testimonial-grid' );
				array_push( $testimonial_classes, 'grve-isotope' );
				break;
			case 'carousel':
			default:
				$data_string = ' data-slider-speed="' . esc_attr( $slideshow_speed ) . '" data-pagination-speed="' . esc_attr( $pagination_speed ) . '" data-slider-autoheight="' . esc_attr( $auto_height ) . '" data-navigation-type="' . esc_attr( $navigation_type ) . '" data-slider-pause="' . esc_attr( $pause_hover ) . '" data-slider-autoplay="' . esc_attr( $auto_play ) . '"';
				$disable_pagination = 'yes';
				array_push( $testimonial_classes, 'grve-testimonial' );
				array_push( $testimonial_classes, 'grve-carousel-element' );
				array_push( $testimonial_classes, 'grve-align-' . $align );
				if ( 'none' != $text_style ) {
					array_push( $testimonial_classes, 'grve-' .$text_style);
				}
				break;
		}

		$testimonial_class_string = implode( ' ', $testimonial_classes );

		$testimonial_cat = "";

		if ( !empty( $categories ) ) {
			$testimonial_category_list = explode( ",", $categories );
			foreach ( $testimonial_category_list as $testimonial_list ) {
				$testimonial_term = get_term( $testimonial_list, 'testimonial_category' );
				if ( isset( $testimonial_term ) ) {
					$testimonial_cat = $testimonial_cat.$testimonial_term->slug . ', ';
				}
			}
		}

		$paged = 1;

		if ( 'yes' != $disable_pagination ) {
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}
		}

		$args = array(
			'post_type' => 'testimonial',
			'post_status'=>'publish',
			'paged' => $paged,
			'testimonial_category' => $testimonial_cat,
			'posts_per_page' => $items_to_show,
			'orderby' => $order_by,
			'order' => $order,
		);

		$query = new WP_Query( $args );

		$image_size = 'thumbnail';

		ob_start();

		if ( $query->have_posts() ) :

		?>
			<div class="<?php echo esc_attr( $testimonial_class_string ); ?>" style="<?php echo $style; ?>"<?php echo $data_string; ?>>
			<?php if ( 'carousel' != $testimonial_type ) { ?>
				<div class="grve-isotope-container">
			<?php } ?>

		<?php
		while ( $query->have_posts() ) : $query->the_post();


		$name = get_post_meta( get_the_ID(), 'grve_testimonial_name', true );
		$identity =  get_post_meta( get_the_ID(), 'grve_testimonial_identity', true );

		if ( !empty( $name ) ) {
			$name = '<span>' . $name . '</span>';
		}

		if ( !empty( $name ) && !empty( $identity ) ) {
			$identity = ', ' . $identity;
		}

		if ( 'carousel' == $testimonial_type ) {

		?>
				<div class="grve-testimonial-element">
					<?php if ( 'yes' == $show_image && has_post_thumbnail() ) { ?>
							<div class="grve-testimonial-thumb"><?php the_post_thumbnail( $image_size ); ?></div>
					<?php } ?>
					<?php the_content(); ?>
					<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
					<div class="grve-testimonial-name"><?php echo $name . $identity; ?></div>
					<?php } ?>
				</div>
		<?php
		} else {
		?>
				<div class="grve-isotope-item grve-testimonial-item">
					<div class="grve-isotope-item-inner">
						<div class="grve-testimonial-element">
							<?php the_content(); ?>
							<div class="grve-testimonial-author">
								<?php if ( 'yes' == $show_image && has_post_thumbnail() ) { ?>
										<div class="grve-testimonial-thumb"><?php the_post_thumbnail( $image_size ); ?></div>
								<?php } ?>
								<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
								<div class="grve-small-text grve-testimonial-name"><?php echo $name . $identity; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

		<?php
		}
		endwhile;

		?>
				<?php if ( 'carousel' != $testimonial_type ) { ?>
				</div>
				<?php } ?>
<?php
			if ( 'yes' != $disable_pagination ) {
				$total = $query->max_num_pages;
				$big = 999999999; // need an unlikely integer
				if( $total > 1 )  {
					 echo '<div class="grve-pagination">';

					 if( get_option('permalink_structure') ) {
						 $format = 'page/%#%/';
					 } else {
						 $format = '&paged=%#%';
					 }
					 echo paginate_links(array(
						'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'		=> $format,
						'current'		=> max( 1, $paged ),
						'total'			=> $total,
						'mid_size'		=> 2,
						'type'			=> 'list',
						'prev_text'	=> '<i class="grve-icon-nav-left"></i>',
						'next_text'	=> '<i class="grve-icon-nav-right"></i>',
						'add_args' => false,
					 ));
					 echo '</div>';
				}
			}
?>
			</div>

		<?php
		else :
		endif;
		wp_reset_postdata();

		return ob_get_clean();

	}
	add_shortcode( 'grve_testimonial', 'grve_testimonial_shortcode' );

}

/**
 * Add shortcode to Page Builder
 */

if( !function_exists( 'grve_osmosis_vce_testimonial_shortcode_params' ) ) {
	function grve_osmosis_vce_testimonial_shortcode_params( $tag ) {
		return array(
			"name" => __( "Testimonial", "grve-osmosis-vc-extension" ),
			"description" => __( "Add a captivating testimonial slider", "grve-osmosis-vc-extension" ),
			"base" => $tag,
			"class" => "",
			"icon"      => "icon-wpb-grve-testimonial",
			"category" => __( "Content", "js_composer" ),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Testimonial type", "grve-osmosis-vc-extension" ),
					"param_name" => "testimonial_type",
					"value" => array(
						esc_html__( "Carousel", "grve-osmosis-vc-extension" ) => 'carousel',
						esc_html__( "Grid", "grve-osmosis-vc-extension" ) => 'grid',
						esc_html__( "Masonry", "grve-osmosis-vc-extension" ) => 'masonry',
					),
					"description" => esc_html__( "Select your testimonial type.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Mode", "grve-osmosis-vc-extension" ),
					"param_name" => "testimonial_mode",
					"admin_label" => true,
					'value' => array(
						__( 'Without Borders', 'grve-osmosis-vc-extension' ) => 'no-border-mode',
						__( 'With Borders', 'grve-osmosis-vc-extension' ) => 'border-mode',
					),
					"description" => esc_html__( "Select your testimonial Mode.", "grve-osmosis-vc-extension" ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Columns", "grve-osmosis-vc-extension" ),
					"param_name" => "columns",
					"value" => array( '2', '3', '4', '5' ),
					"std" => '3',
					"description" => esc_html__( "Select number of columns.", "grve-osmosis-vc-extension" ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Items to show", "grve-osmosis-vc-extension" ),
					"param_name" => "items_to_show",
					"value" => '20',
					"description" => __( "Maximum Testimonial Items to Show", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Autoplay", "grve-osmosis-vc-extension" ),
					"param_name" => "auto_play",
					"value" => array(
						__( "Yes", "grve-osmosis-vc-extension" ) => 'yes',
						__( "No", "grve-osmosis-vc-extension" ) => 'no',
					),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Slideshow Speed", "grve-osmosis-vc-extension" ),
					"param_name" => "slideshow_speed",
					"value" => '3000',
					"description" => esc_html__( "Slideshow Speed in ms.", "grve-osmosis-vc-extension" ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Pause on Hover", "grve-osmosis-vc-extension" ),
					"param_name" => "pause_hover",
					"value" => array( esc_html__( "If selected, testimonial will be paused on hover", "grve-osmosis-vc-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Auto Height", "grve-osmosis-vc-extension" ),
					"param_name" => "auto_height",
					"value" => array( esc_html__( "Select if you want smooth auto height", "grve-osmosis-vc-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Navigation Type", "grve-osmosis-vc-extension" ),
					"param_name" => "navigation_type",
					'value' => array(
						__( 'Style 1' , 'grve-osmosis-vc-extension' ) => '1',
						__( 'Style 2' , 'grve-osmosis-vc-extension' ) => '2',
						__( 'Style 3' , 'grve-osmosis-vc-extension' ) => '3',
						__( 'Style 4' , 'grve-osmosis-vc-extension' ) => '4',
						__( 'No Navigation' , 'grve-osmosis-vc-extension' ) => '0',
					),
					"description" => __( "Select your Navigation type.", "grve-osmosis-vc-extension" ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Text Style", "grve-osmosis-vc-extension" ),
					"param_name" => "text_style",
					"value" => array(
						__( "None", "grve-osmosis-vc-extension" ) => '',
						__( "Leader", "grve-osmosis-vc-extension" ) => 'leader-text',
						__( "Subtitle", "grve-osmosis-vc-extension" ) => 'subtitle',
					),
					"description" => 'Select your text style',
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => __( "Alignment", "grve-osmosis-vc-extension" ),
					"param_name" => "align",
					"value" => array(
						__( "Left", "grve-osmosis-vc-extension" ) => 'left',
						__( "Right", "grve-osmosis-vc-extension" ) => 'right',
						__( "Center", "grve-osmosis-vc-extension" ) => 'center',
					),
					"description" => '',
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'carousel' ) ),
				),
				array(
					"type" => "grve_multi_checkbox",
					"heading" => __("Testimonial Categories", "grve-osmosis-vc-extension" ),
					"param_name" => "categories",
					"value" => grve_osmosis_vce_get_testimonial_categories(),
					"description" => __( "Select all or multiple categories.", "grve-osmosis-vc-extension" ),
					"admin_label" => true,
					"group" => __( "Categories", "grve-osmosis-vc-extension" ),
				),
				array(
					"type" => 'checkbox',
					"heading" => esc_html__( "Disable Pagination", "grve-osmosis-vc-extension" ),
					"param_name" => "disable_pagination",
					"description" => esc_html__( "If selected, pagination will not be shown.", "grve-osmosis-vc-extension" ),
					"value" => array( esc_html__( "Disable Pagination.", "grve-osmosis-vc-extension" ) => 'yes' ),
					"dependency" => array( 'element' => "testimonial_type", 'value' => array( 'grid', 'masonry' ) ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Show Featured Image", "grve-osmosis-vc-extension" ),
					"param_name" => "show_image",
					"value" => array(
						esc_html__( "No", "grve-osmosis-vc-extension" ) => 'no',
						esc_html__( "Yes", "grve-osmosis-vc-extension" ) => 'yes',
					),
					"std" => 'no',
				),
				grve_osmosis_vce_add_order_by(),
				grve_osmosis_vce_add_order(),
				grve_osmosis_vce_add_margin_bottom(),
				grve_osmosis_vce_add_el_class(),
			),
		);
	}
}

if( function_exists( 'vc_lean_map' ) ) {
	vc_lean_map( 'grve_testimonial', 'grve_osmosis_vce_testimonial_shortcode_params' );
} else if( function_exists( 'vc_map' ) ) {
	$attributes = grve_osmosis_vce_testimonial_shortcode_params( 'grve_testimonial' );
	vc_map( $attributes );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
