<?php
/**
 * Single Event Meta (Details) Template
 *
 */
?>

<div class="grve-tribe-events-meta-group grve-tribe-events-meta-group-details">
	<h5 class="grve-title"> <?php esc_html_e( 'Details', 'osmosis' ) ?> </h5>
	<ul>

		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		if ( class_exists( 'Tribe__Date_Utils' ) ) {
			$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
			$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
			$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
		} else if ( class_exists( 'Tribe__Events__Date_Utils' ) ) {
			$time_format = get_option( 'time_format', Tribe__Events__Date_Utils::TIMEFORMAT );
			$start_ts = tribe_get_start_date( null, false, Tribe__Events__Date_Utils::DBDATEFORMAT );
			$end_ts = tribe_get_end_date( null, false, Tribe__Events__Date_Utils::DBDATEFORMAT );
		} else {
			$time_format = get_option( 'time_format', TribeDateUtils::TIMEFORMAT );
			$start_ts = tribe_get_start_date( null, false, TribeDateUtils::DBDATEFORMAT );
			$end_ts = tribe_get_end_date( null, false, TribeDateUtils::DBDATEFORMAT );
		}

		$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );

		$end_datetime = tribe_get_end_date();
		$end_date = tribe_get_end_date( null, false );
		$end_time = tribe_get_end_date( null, false, $time_format );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
		?>
			<li>
				<span> <?php esc_html_e( 'Start:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr updated published" title="<?php echo esc_attr( $start_ts ); ?>"> <?php echo esc_html( $start_date ); ?> </abbr>
			</li>
			<li>
				<span> <?php esc_html_e( 'End:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr" title="<?php echo esc_attr( $end_ts ); ?>"> <?php echo esc_html( $end_date ); ?> </abbr>
			</li>
		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
		?>
			<li>
				<span> <?php esc_html_e( 'Date:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr updated published" title="<?php echo esc_attr( $start_ts ); ?>"> <?php echo esc_html( $start_date ); ?> </abbr>
			</li>
		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
		?>
			<li>
				<span> <?php esc_html_e( 'Start:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr updated published" title="<?php echo esc_attr( $start_ts ); ?>"> <?php echo esc_html( $start_datetime ); ?> </abbr>
			</li>
			<li>
				<span> <?php esc_html_e( 'End:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr" title="<?php echo esc_attr( $end_ts ); ?>"> <?php echo esc_html( $end_datetime ); ?> </abbr>
			</li>
		<?php
		// Single day events
		else :
		?>
			<li>
				<span> <?php esc_html_e( 'Date:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr updated published" title="<?php echo esc_attr( $start_ts ); ?>"> <?php echo esc_html( $start_date ) ?> </abbr>
			</li>
			<li>
				<span> <?php esc_html_e( 'Time:', 'osmosis' ) ?> </span>
				<abbr class="grve-tribe-events-abbr updated published" title="<?php echo esc_attr( $end_ts ); ?>">
				<?php if ( $start_time == $end_time ) {
					echo esc_html( $start_time );
				} else {
					echo esc_html( $start_time . $time_range_separator . $end_time );
				} ?>
				</abbr>
			</li>
		<?php endif ?>

		<?php
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ):
		?>
			<li>
				<span> <?php esc_html_e( 'Cost:', 'osmosis' ) ?> </span>
				<div class="grve-tribe-events-event-cost"> <?php echo tribe_get_formatted_cost(); ?> </div>
			</li>
		<?php endif ?>

		<?php
		echo tribe_get_event_categories(
			get_the_id(), array(
				'before'       => '',
				'sep'          => ', ',
				'after'        => '',
				'label'        => null, // An appropriate plural/singular label will be provided
				'label_before' => '<li><span>',
				'label_after'  => '</span>',
				'wrap_before'  => '<div class="grve-tribe-events-event-categories">',
				'wrap_after'   => '</div></li>'
			)
		);
		?>

		<?php echo grve_tribe_meta_event_tags( __( 'Event Tags:', 'osmosis' ), ', ', false ) ?>

		<?php
		$website = tribe_get_event_website_link();
		if ( ! empty( $website ) ):
			?>
			<li>
				<span> <?php esc_html_e( 'Website:', 'osmosis' ) ?> </span>
				<div class="grve-tribe-events-event-url"> <?php echo wp_kses_post( $website ); ?> </div>
			</li>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</ul>
</div>