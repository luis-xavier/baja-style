<!doctype html>
<html class="no-js grve-responsive" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
		<?php
			if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
				$grve_favicon = grve_option('favicon','','url');
				if ( ! empty( $grve_favicon ) ) {
					$grve_favicon = str_replace( array( 'http:', 'https:' ), '', $grve_favicon );
		?>
		<link href="<?php echo esc_url( $grve_favicon ); ?>" rel="icon" type="image/x-icon">
		<?php
				}
			}
		?>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
		<!-- allow pinned sites -->
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php } ?>
		<?php wp_head(); ?>
	</head>

	<body id="grve-body" <?php body_class(); ?>>

		<!-- Theme Wrapper -->
		<div id="grve-theme-wrapper">