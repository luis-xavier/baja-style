<?php
/*
Template Name: Content Only
*/
?>
<?php get_header( 'basic' ); ?>

<?php the_post(); ?>

	<div id="grve-main-content">
		<div class="grve-container">

			<!-- Content Area -->
			<div id="grve-content-area">

				<!-- PAGE CONTENT -->
				<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</div>
				<!-- END PAGE CONTENT -->

			</div>

		</div>
	</div>

<?php get_footer( 'basic' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
