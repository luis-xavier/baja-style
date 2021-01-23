<?php
/**
 * Single Event Meta (Organizer) Template
 *
 */

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="grve-tribe-events-meta-group grve-tribe-events-meta-group-organizer">
	<h5 class="grve-title"> <?php echo tribe_get_organizer_label_singular(); ?> </h5>
	<ul>
		<?php do_action( 'tribe_events_single_meta_organizer_section_start' ); ?>

		<li class="fn org"> <?php echo tribe_get_organizer() ?> </li>

		<?php if ( ! empty( $phone ) ): ?>
			<li>
				<span> <?php esc_html_e( 'Phone:', 'osmosis' ); ?> </span>
				<div class="tel"> <?php echo wp_kses_post( $phone ); ?> </div>
			</li>
		<?php endif ?>

		<?php if ( ! empty( $email ) ): ?>
			<li>
				<span> <?php esc_html_e( 'Email:', 'osmosis' ); ?> </span>
				<div class="email"> <?php echo wp_kses_post( $email ); ?> </div>
			</li>
		<?php endif ?>

		<?php if ( ! empty( $website ) ): ?>
			<li>
				<span> <?php esc_html_e( 'Website:', 'osmosis' ); ?> </span>
				<div class="url"> <?php echo wp_kses_post( $website ); ?> </div>
			</li>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_organizer_section_end' ); ?>
	</ul>
</div>