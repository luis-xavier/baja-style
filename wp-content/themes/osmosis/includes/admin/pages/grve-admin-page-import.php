<?php
/*
*	Admin Page Import
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'GRVE_Osmosis_Importer' ) ) {
	$import_url = admin_url( 'admin.php?import=osmosis-demo-importer' );
} else {
	$import_url = admin_url( 'admin.php?page=osmosis-tgmpa-install-plugins' );
}

?>
	<div id="grve-import-wrap" class="wrap">
		<h2><?php esc_html_e( "Import Demos", 'osmosis' ); ?></h2>
		<?php osmosis_grve_print_admin_links('import'); ?>
		<div id="grve-import-panel" class="grve-admin-panel">
			<div class="grve-admin-panel-content">
				<h2><?php esc_html_e( "The Easiest Ways to Import Osmosis Demo Content", 'osmosis' ); ?></h2>
				<p class="about-description"><?php esc_html_e( "Osmosis offers you two options to import the content of our theme. With the first one, the Import on Demand, you can import specific pages, posts, portfolios. With the second one, the Full Import Demo, you can import any of the available demos. It's up to you!", 'osmosis' ); ?></p>
				<?php if ( class_exists( 'GRVE_Osmosis_Importer' ) ) { ?>
				<a href="<?php echo esc_url( $import_url ); ?>" class="grve-admin-panel-btn"><?php esc_html_e( "Import Demos", 'osmosis' ); ?></a>
				<?php } else { ?>
				<a href="<?php echo esc_url( $import_url ); ?>" class="grve-admin-panel-btn"><?php esc_html_e( "Install/Activate Demo Importer", 'osmosis' ); ?></a>
				<?php } ?>
				<div class="grve-admin-panel-container">
					<div class="grve-admin-panel-row">
						<div class="grve-admin-panel-column grve-admin-panel-column-1-2">
							<div class="grve-admin-panel-column-content">
								<iframe width="100%" height="290" src="https://www.youtube-nocookie.com/embed/0kdqX5fcJpM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								<h3><?php esc_html_e( "Import on Demand", 'osmosis' ); ?></h3>
								<p><?php esc_html_e( "Do you just need specific pages or portfolios, posts, products of our demo content to create your site? Select the ones you prefer via the available multi selectors under Osmosis Demos.", 'osmosis' ); ?></p>
							</div>
						</div>
						<div class="grve-admin-panel-column grve-admin-panel-column-1-2">
							<div class="grve-admin-panel-column-content">
								<iframe width="100%" height="290" src="https://www.youtube-nocookie.com/embed/2FmcibGg6qw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
								<h3><?php esc_html_e( "Full Import", 'osmosis' ); ?></h3>
								<p><?php esc_html_e( "Of course, you can still import the whole dummy content. With Osmosis you have the possibility to import any of the demos with just ONE click.", 'osmosis' ); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

//Omit closing PHP tag to avoid accidental whitespace output errors.
