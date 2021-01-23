<?php
/**
 * Single Event Meta (Additional Fields) Template
 *
 */

if ( ! isset( $fields ) || empty( $fields ) || ! is_array( $fields ) ) {
	return;
}
?>

<div class="grve-tribe-events-meta-group grve-tribe-events-meta-group-other">
	<h5 class="grve-title"> <?php esc_html_e( 'Other', 'osmosis' ) ?> </h5>
	<ul>
		<?php foreach ( $fields as $name => $value ): ?>
			<li>
				<span><?php echo wp_kses_post( $name ); ?> </span>
				<?php echo wp_kses_post( $value ); ?>
			</li>
		<?php endforeach ?>
	</ul>
</div>