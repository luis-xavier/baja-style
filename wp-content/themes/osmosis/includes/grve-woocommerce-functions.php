<?php

/*
*	Woocommerce helper functions and configuration
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Helper function to check if woocommerce is enabled
 */
function grve_woocommerce_enabled() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}

function grve_is_woo_shop() {
	if ( grve_woocommerce_enabled() && is_shop() && !is_search() ) {
		return true;
	}
	return false;
}

//If woocomerce plugin is not enabled return
if ( !grve_woocommerce_enabled() ) {
	return false;
}

//Add Theme support for woocommerce
add_theme_support( 'woocommerce' );

/**
 * Add Meta fields To Products
 */
require_once get_template_directory() . '/includes/admin/grve-product-meta.php';

/**
 * Helper function to get shop custom fields with fallback
 */
function grve_post_meta_shop( $id, $fallback = false ) {
	$post_id = wc_get_page_id( 'shop' );
	if ( $fallback == false ) $fallback = '';
	$post_meta = get_post_meta( $post_id, $id, true );
	$output = ( $post_meta !== '' ) ? $post_meta : $fallback;
	return $output;
}

/**
 * Helper function to skin Product Search
 */
function grve_woo_product_search( $form ) {
	$new_custom_id = uniqid( 'grve_product_search_' );
	$form =  '<form class="grve-search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >';
	$form .= '  <button type="submit" class="grve-search-btn"><i class="grve-icon-search"></i></button>';
	$form .= '  <input type="text" class="grve-search-textfield" id="' . esc_attr( $new_custom_id ) . '" value="' . get_search_query() . '" name="s" placeholder="' . esc_attr__( 'Search for ...', 'osmosis' ) . '" />';
	$form .= '  <input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;
}

/**
 * Helper function to notify about Shop Pages in Admin Pages
 */

/**
 * Helper function to return empty
 */
function grve_woo_empty( $param = '' ) {
	return '';
}

/**
 * Helper function to update cart count on header icon via ajax
 */
function grve_woo_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
?>
	<span class="grve-purchased-items"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
<?php
	$fragments['span.grve-purchased-items'] = ob_get_clean();
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'grve_woo_header_add_to_cart_fragment');

/**
 * Helper function to add cart button on shop overview/ archive / search
 */




function grve_woo_add_to_cart_class( $product ) {

	$ajax_add = '';
	if ( method_exists( 'WC_Product', 'supports' ) ) {
		$ajax_add = $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '';
	}

	$product_get_type = method_exists( $product, 'get_type' ) ? $product->get_type() : $product->product_type;

	return implode( ' ', array_filter( array(
			'grve-add-cart',
			'product_type_' . $product_get_type,
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$ajax_add
	) ) );

}

function grve_woo_add_to_cart() {

	global $product;

	$product_get_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;

	if ( $product->is_purchasable() ) {

		echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product_get_id ),
				esc_attr( $product->get_sku() ),
				esc_attr( grve_woo_add_to_cart_class( $product ) ),
				esc_html( $product->add_to_cart_text() )
			);
	} else {
		echo '';
	}
}

/**
 * Function to add check icon after add to cart
 */
function grve_woo_added_to_cart() {
	echo '<i class="grve-cart-tick grve-icon-check"></i>';
}

/**
 * Function to modify columns number on related products
 */
function grve_woo_output_related_products_args() {

	$columns = 4;
	if( is_product() ) {
		$grve_sidebar_id = grve_post_meta( 'grve_product_sidebar', 'grve-woocommerce-sidebar-product' );
		$grve_sidebar_layout = grve_post_meta( 'grve_product_layout', 'right' );
		if ( 'none' != $grve_sidebar_layout && is_active_sidebar( $grve_sidebar_id ) ) {
			if ( 'left' == $grve_sidebar_layout || 'right' == $grve_sidebar_layout ) {
				$columns = 3;
			}
		}
	}

	$args = array(
		'posts_per_page' => $columns,
		'columns' => $columns,
		'orderby' => 'rand'
	);

	return $args;
}

/**
 * Function to modify columns number on product thumbnails
 */
function grve_woo_product_thumbnails_columns() {
	return 4;
}

/**
 * Function to add before main woocommerce content
 */
function grve_woo_before_main_content() {
	$grve_title_class = '';
	if ( grve_print_header_breadcrumbs_visibility( 'product' )  ) {
		$grve_title_class = 'grve-simple-style-no-padding';
	}
	if( is_product() && grve_visibility( 'product_title_visibility' ) ) {
		$grve_title_class = "grve-default-title";
	} elseif( is_product_taxonomy() && grve_visibility( 'product_tax_title_visibility' ) ) {
		$grve_title_class = "grve-default-title";
	}
?>
	<div id="grve-main-content" class="<?php echo esc_attr( $grve_title_class ); ?>">
		<?php
			if ( is_shop() && !is_search() ) {
				grve_print_header_title();
				grve_print_header_breadcrumbs( 'page' );
				$page_nav_menu = grve_post_meta_shop( 'grve_page_navigation_menu' );
				if ( !empty( $page_nav_menu ) ) {
				$page_nav_menu = apply_filters( 'wpml_object_id', $page_nav_menu, 'nav_menu', TRUE  );
		?>

				<div id="grve-anchor-menu" class="grve-fields-bar">
						<div class="grve-icon-menu"></div>
						<?php
						wp_nav_menu(
							array(
								'menu' => $page_nav_menu, /* menu id */
								'container' => false, /* no container */
								'depth' => '1',
							)
						);
						?>
				</div>

		<?php
				}
			} elseif( is_product() ) {
				grve_print_product_header_title();
				grve_print_header_breadcrumbs( 'product' );
			}  elseif( is_product_taxonomy() ) {
				grve_print_product_header_title( 'taxonomy' );
				grve_print_header_breadcrumbs( 'product' );
			}
		?>
		<div class="grve-container <?php echo grve_sidebar_class( 'shop' ); ?>">
			<div id="grve-content-area">
				<!-- Content -->
				<div id="grve-woocommerce-<?php echo wc_get_page_id('shop'); ?>" <?php post_class(); ?>>
	<?php
}

/**
 * Function to add after main woocommerce content
 */
function grve_woo_after_main_content() {
?>
				</div>
			</div>
			<!-- End Content -->
			<?php grve_set_current_view( 'shop' ); ?>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php
}

/**
 * Function to add before shop loop item
 */
function grve_woo_before_shop_loop_item() {
?>
	<div class="grve-product-item">
		<div class="grve-product-media">
<?php
}

/**
 * Function to add after shop loop item
 */
function grve_woo_after_shop_loop_item() {
?>
			<div class="grve-product-options">
				<?php woocommerce_template_loop_rating(); ?>
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div>
		<div class="grve-product-content">
			<span class="grve-product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
			<span class="grve-product-price"><?php woocommerce_template_loop_price(); ?></span>
		</div>
	</div>
<?php
}

/**
 * Function to add before single product images
 */
function grve_woo_before_product_images() {

	if ( version_compare( WC_VERSION, '2.7', '<' ) ) {
		$lighbox_enabled = get_option( 'woocommerce_enable_lightbox', '' );
	} else {
		$lighbox_enabled = 'no';
	}

	if ( 'yes' != $lighbox_enabled && 'popup' == grve_option( 'product_gallery_mode', 'popup' ) ) {
?>
		<div class="grve-gallery-popup">
<?php
	}

}

/**
 * Function to add after single product images
 */
function grve_woo_after_product_images() {

	if ( version_compare( WC_VERSION, '2.7', '<' ) ) {
		$lighbox_enabled = get_option( 'woocommerce_enable_lightbox', '' );
	} else {
		$lighbox_enabled = 'no';
	}

	if ( 'yes' != $lighbox_enabled && 'popup' == grve_option( 'product_gallery_mode', 'popup' ) ) {
?>
	</div>
<?php
	}

}

/**
 * Function to show product thumbnails
 */
function grve_woo_product_thumbnails() {
	global $post, $product, $woocommerce;

	if ( method_exists( $product, 'get_gallery_image_ids' ) ) {
		$attachment_ids = $product->get_gallery_image_ids();
	} else {
		$attachment_ids = $product->get_gallery_attachment_ids();
	}

	//Classes
	$product_gallery_classes = array( 'thumbnails' );
	if ( $attachment_ids ) {
		$loop 		= 0;
		$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		$product_gallery_classes[] = 'columns-' . $columns;
		$product_gallery_class_string = implode( ' ', $product_gallery_classes );
		?><div class="<?php echo esc_attr( $product_gallery_class_string ); ?>"><?php
			foreach ( $attachment_ids as $attachment_id ) {
				$classes = array( 'zoom' );
				if ( $loop === 0 || $loop % $columns === 0 ) {
					$classes[] = 'first';
				}
				if ( ( $loop + 1 ) % $columns === 0 ) {
					$classes[] = 'last';
				}
				$image_link = wp_get_attachment_url( $attachment_id );
				if ( ! $image_link ) {
					continue;
				}
				$image_title 	= esc_attr( get_the_title( $attachment_id ) );
				$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
				$loop++;
			}

		?></div><?php
	}
}

function grve_woo_theme_setup() {

	$product_gallery_mode = grve_option( 'product_gallery_mode', 'popup' );
	if( 'woo' == $product_gallery_mode ) {
		if( grve_visibility( 'product_gallery_woo_zoom' ) ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		if( grve_visibility( 'product_gallery_woo_lightbox' ) ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
		if( grve_visibility( 'product_gallery_woo_slider' ) ) {
			add_theme_support( 'wc-product-gallery-slider' );
		}
	} else if( 'popup' == $product_gallery_mode ) {
		//Product Thumbnails
		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		add_action( 'woocommerce_product_thumbnails', 'grve_woo_product_thumbnails', 20 );
	}

}
add_action( 'after_setup_theme', 'grve_woo_theme_setup' );


/**
 * De-register WooCommerce styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Unhook WooCommerce actions
 */

//Remove Content Wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

//Remove Breadcrubs
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);

//Remove Shop Actions

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//Remove Single Product Images
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

/**
 * Overwrite the WooCommerce actions and filters
 */
add_action('woocommerce_before_main_content', 'grve_woo_before_main_content', 10);
add_action('woocommerce_after_main_content', 'grve_woo_after_main_content', 10);

add_action('woocommerce_before_shop_loop_item', 'grve_woo_before_shop_loop_item', 10);
add_action('woocommerce_after_shop_loop_item', 'grve_woo_after_shop_loop_item', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'grve_woo_added_to_cart' );

add_action( 'woocommerce_before_single_product_summary', 'grve_woo_before_product_images', 9 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
add_action( 'woocommerce_before_single_product_summary', 'grve_woo_after_product_images', 21 );

add_filter( 'get_product_search_form', 'grve_woo_product_search' );

add_filter( 'woocommerce_output_related_products_args', 'grve_woo_output_related_products_args' );
add_filter( 'woocommerce_loop_add_to_cart_link', 'grve_woo_add_to_cart' );
add_filter( 'woocommerce_product_thumbnails_columns', 'grve_woo_product_thumbnails_columns' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
