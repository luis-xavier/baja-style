<?php get_header(); ?>

<div id="grve-main-content">

	<?php grve_print_header_title( 'blog' ); ?>
	<?php grve_print_header_breadcrumbs( 'post' ); ?>

	<div class="grve-container <?php echo grve_sidebar_class(); ?>">
		<!-- Content -->
		<div id="grve-content-area">

			<div class="grve-section" data-section-type="in-container" data-parallax="no">
				<div class="grve-row">
					<div class="grve-column-1">

						<?php
							$blog_style = grve_option( 'blog_style' );
							$grve_blog_style_class = grve_get_blog_class();
						?>
						<div class="grve-element <?php echo esc_attr( $grve_blog_style_class ); ?>" <?php grve_print_blog_data(); ?>>

							<?php
							if ( have_posts() ) :
								if ( 'large-media' == $blog_style || 'small-media' == $blog_style ) {
							?>
							<div class="grve-standard-container">
							<?php
								} else {
							?>
							<div class="grve-isotope-container">
							<?php								
								}

							// Start the Loop.
							while ( have_posts() ) : the_post();
								//Get post template
								get_template_part( 'content', get_post_format() );
							endwhile;

							?>
							</div>
							<?php
								// Previous/next post navigation.
								grve_pagination();
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'content', 'none' );
							endif;
							?>

						</div>
						<!-- End Element Blog -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
		<?php
			grve_set_current_view( 'blog' );
			if ( is_front_page() ) {
				grve_set_current_view( 'frontpage' );
			}
		?>
		<?php get_sidebar(); ?>

	</div>
</div>
<?php get_footer(); ?>