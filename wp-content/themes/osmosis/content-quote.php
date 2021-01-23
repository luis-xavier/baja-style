<?php
/**
 * The Quote Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post grve-post-quote' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<div id="grve-post-content">
			<?php grve_print_post_header_title( 'content' ); ?>
			<?php osmosis_grve_print_post_structured_data(); ?>
			<?php grve_print_post_single_meta(); ?>
			<div itemprop="articleBody">
				<?php the_content(); ?>
			</div>
		</div>
	</article>

<?php
} else {
	$grve_post_class = grve_get_post_class( 'grve-label-post' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'grve_inner_post_loop_item_before' ); ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<div class="grve-post-meta">
				<?php grve_print_post_date(); ?>
			</div>
			<div class="grve-post-icon"></div>
			<?php the_title( '<h4 class="grve-hidden" itemprop="name headline">', '</h4>' ); ?>
			<?php osmosis_grve_print_post_structured_data(); ?>
			<p class="grve-subtitle" itemprop="articleBody">
			<?php
				global $allowedposttags;
				$mytags = $allowedposttags;
				unset($mytags['a']);
				unset($mytags['img']);
				unset($mytags['blockquote']);
				echo wp_kses( get_the_content(), $mytags );
			?>
			</p>
		</a>
		<?php do_action( 'grve_inner_post_loop_item_after' ); ?>
	</article>

<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
