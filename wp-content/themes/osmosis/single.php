<?php get_header(); ?>

<?php
	$grve_post_area_class = '';
	$post_style = grve_option( 'post_style', 'default' );

	if ( 'simple' == $post_style ) {
		if ( grve_print_header_breadcrumbs_visibility( 'post' )  ) {
			$grve_post_area_class = 'grve-simple-style grve-simple-style-no-padding';
		} else {
			$grve_post_area_class = 'grve-simple-style';
		}
	}
?>
	<div id="grve-main-content" class="<?php echo esc_attr( $grve_post_area_class ); ?>">
		<?php the_post(); ?>

		<?php
			if ( 'simple' != $post_style ) {
				grve_print_post_header_title();
			}
			if ( 'default' == $post_style ) {
		?>

		<!-- Fields Bar -->
		<div id="grve-meta-bar" class="grve-fields-bar">
			<ul class="grve-meta-elements">
				<?php if ( grve_visibility( 'blog_date_visibility', '1' ) ) { ?>
				<li class="grve-field-date"><span class="grve-icon-date"></span><?php echo get_the_date(); ?></li>
				<?php } ?>
				<?php if ( grve_visibility( 'post_author_visibility' ) ) { ?>
				<li><a href="#grve-about-author"><span class="grve-icon-user"></span><?php the_author(); ?></a></li>
				<?php } ?>
				<?php if ( grve_visibility( 'blog_comments_visibility', '1' ) ) { ?>
				<li><a href="#grve-comments"><span class="grve-icon-comment"></span><?php comments_number( __( 'no comments', 'osmosis' ), __( '1 comment', 'osmosis' ), '% ' . __( 'comments', 'osmosis' ) ); ?></a></li>
				<?php } ?>
			</ul>
			<?php grve_print_header_item_navigation(); ?>
		</div>
		<!-- End Fields Bar -->

		<?php
			}
			grve_print_header_breadcrumbs( 'post' );
		?>

		<div class="grve-container <?php echo grve_sidebar_class(); ?>">

			<div id="grve-post-area">


				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php wp_link_pages(); ?>

				<?php if ( 'default' == $post_style ) { ?>
					<div id="grve-meta-social-responsive" class="grve-meta-social-default">
						<?php
							grve_print_header_item_navigation('grve-nav-wrapper-default');
							grve_print_post_meta( 'grve-meta-responsive', 'grve-meta-style-default' );
							grve_print_post_social( 'primary-1', 'grve-social-share-responsive', 'grve-social-style-default' );
						?>
					</div>
				<?php } elseif ( 'simple' == $post_style ) { ?>
						<?php grve_print_header_item_navigation('grve-nav-wrapper-classic'); ?>
				<?php } else { ?>
					<div id="grve-meta-social-responsive" class="grve-meta-social-classic">
						<?php
							grve_print_header_item_navigation('grve-nav-wrapper-classic');
							grve_print_post_meta( 'grve-meta-responsive', 'grve-meta-style-classic' );
							grve_print_post_social( 'primary-1', 'grve-social-share-responsive', 'grve-social-style-classic' );
						?>
					</div>
				<?php } ?>

				<?php grve_print_blog_meta_bar(); ?>

				<?php if ( grve_visibility( 'post_author_visibility' ) ) { ?>
					<!-- About Author -->

					<div id="grve-about-author" class="grve-section">
						<div class="grve-author-image">
						<?php echo get_avatar( get_the_author_meta('ID'), 170 ); ?>
						</div>
						<div class="grve-author-info">
							<span class="grve-subtitle"><?php echo esc_html__( 'Author', 'osmosis' ) . '  '; ?></span>
							<h4><?php the_author_link(); ?></h4>
							<p><?php echo get_the_author_meta( 'user_description' ); ?></p>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="grve-read-more"><?php echo esc_html__( 'All stories by:', 'osmosis' ) . '  '; ?><?php the_author(); ?> </a>
						</div>
					</div>

					<!-- End About Author -->
				<?php } ?>

				<?php if ( grve_visibility( 'post_related_visibility' ) ) { ?>
					<!-- Related Posts -->
					<?php grve_print_related_posts(); ?>
					<!-- End Related Posts -->
				<?php } ?>


				<?php if ( grve_visibility( 'blog_comments_visibility' ) ) { ?>
					<?php comments_template(); ?>
				<?php } ?>

			</div>
			<?php grve_set_current_view( 'post' ); ?>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>