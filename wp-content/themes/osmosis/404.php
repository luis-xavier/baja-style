<?php
if ( grve_visibility( 'page_404_header' ) ) {
	get_header();
} else {
	get_header( 'basic' );
}
?>

	<?php
		$page_title_color = grve_option( 'page_title_color', 'dark' );
		$page_section_class = 'grve-section grve-' . $page_title_color;
	?>
	<div id="grve-main-content" class="grve-error-404">
		<div class="grve-container">
			<div class="<?php echo esc_attr( $page_section_class ); ?>" data-full-height="yes">
				<div class="grve-row">
					<div class="grve-column-1">

						<div class="grve-align-center">

							<div id="grve-content-area">
							<?php
								$grve_404_search_box = grve_option('page_404_search');
								$grve_404_home_button = grve_option('page_404_home_button');
								echo do_shortcode( grve_option( 'page_404_content' ) );
							?>
							</div>

							<br/>

							<?php if ( $grve_404_search_box ) { ?>
							<div class="grve-widget">
								<?php get_search_form(); ?>
							</div>
							<br/>
							<?php } ?>

							<?php if ( $grve_404_home_button ) { ?>
							<div class="grve-element">
								<a class="grve-btn grve-btn-large grve-square grve-bg-primary-1" target="_self" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
								</a>
							</div>
							<?php } ?>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php
if ( grve_visibility( 'page_404_footer' ) ) {
	get_footer();
} else {
	get_footer( 'basic' );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.