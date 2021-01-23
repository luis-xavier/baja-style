<?php get_header(); ?>

<?php the_post(); ?>

<?php
	if ( 'yes' == grve_post_meta( 'grve_disable_content' ) ) {
		get_footer();
	} else {
?>

		<div id="grve-main-content">

			<?php grve_print_header_title(); ?>
			<?php grve_print_header_breadcrumbs( 'page' ); ?>

			<?php
				$page_nav_menu = grve_post_meta( 'grve_page_navigation_menu' );
				if ( !empty($page_nav_menu) ) {
					$page_nav_menu = apply_filters( 'wpml_object_id', $page_nav_menu, 'nav_menu', TRUE  );
					$grve_anchor_current_link = grve_option('page_anchor_menu_highlight_current');
					$grve_anchor_incontainer = grve_option('page_anchor_menu_incontainer');
					$grve_anchor_center = grve_option('page_anchor_menu_center');
					$grve_anchor_class = 'grve-fields-bar';
					if ( '1' == $grve_anchor_current_link ) {
						$grve_anchor_class .= ' grve-current-link';
					}
					if ( '1' == $grve_anchor_incontainer ) {
						$grve_anchor_class .= ' grve-incontainer';
					}
					if ( '1' == $grve_anchor_center ) {
						$grve_anchor_class .= ' grve-center-anchor-menu';
					}
			?>
			<div id="grve-anchor-menu" class="<?php echo esc_attr( $grve_anchor_class ); ?>">
					<div class="grve-icon-menu"></div>
					<?php
					wp_nav_menu(
						array(
							'menu' => $page_nav_menu, /* menu id */
							'container' => false, /* no container */
						)
					);
					?>
			</div>
			<?php
				}
			?>
			<div class="grve-container <?php echo grve_sidebar_class(); ?>">

				<!-- Content Area -->
				<div id="grve-content-area">

					<!-- Content -->
					<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</div>
					<!-- End Content -->

					<?php if ( grve_visibility( 'page_comments_visibility' ) ) { ?>
						<?php comments_template(); ?>
					<?php } ?>

				</div>
				<?php grve_set_current_view( 'page' ); ?>
				<?php get_sidebar(); ?>

			</div>

		</div>

	<?php get_footer(); ?>

<?php
	}
?>