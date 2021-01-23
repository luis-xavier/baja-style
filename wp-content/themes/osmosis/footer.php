
			<?php grve_print_bottom_bar(); ?>
			<?php $grve_sticky_footer = grve_visibility( 'sticky_footer' ) ? 'yes' : 'no'; ?>

			<footer id="grve-footer" data-sticky-footer="<?php echo esc_attr( $grve_sticky_footer ); ?>">

				<div class="grve-container">

				<?php grve_print_footer_widgets(); ?>
				<?php grve_print_footer_bar(); ?>

				</div>
				<?php grve_print_title_bg_image_container( 'footer_background' ); ?>
			</footer>

		</div> <!-- end #grve-theme-wrapper -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>