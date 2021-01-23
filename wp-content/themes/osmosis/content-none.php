<?php
/*
*	Template Content None
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


	$search_not_found_mode = grve_option( 'search_not_found_mode' );
?>
<article <?php post_class(); ?>>
	<div class="grve-post-content">
	
		<?php 
			if ('user_defined' == $search_not_found_mode ) {
				echo do_shortcode( grve_option( 'search_page_not_found_text' ) );
			} else {				
		?>
		<p class="grve-align-center grve-leader-text">
			<?php echo wp_kses_post( "Hey there mate!<br/>Your lost treasure is not found here...", 'osmosis' ); ?>
		</p>	
		<p class="grve-align-center">
			<?php esc_html_e( "Check again your spelling and rewrite the content you are seeking for in the search field.", 'osmosis' ); ?>
		</p>
		<?php	
			}			
		?>
		<div class="grve-widget">
			<?php get_search_form(); ?>
		</div>
	</div>
</article>