<?php
/**
 * Greatives Contact Info
 * A widget that displays Contact Info e.g: Address, Phone number.etc.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

class Osmosis_Ext_Widget_Contact_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-contact-info',
			'description' => esc_html__( 'A widget that displays contact info', 'grve-osmosis-vc-extension' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-contact-info',
		);
		parent::__construct( 'grve-widget-contact-info', '(Greatives) ' . esc_html__( 'Contact Info', 'grve-osmosis-vc-extension' ), $widget_ops, $control_ops );
	}

	function osmosis_ext_widget_contact_info() {
		$this->__construct();
	}

	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$name = $instance['name'];
		$address = $instance['address'];
		$phone = $instance['phone'];
		$mobile = $instance['mobile'];
		$fax = $instance['fax'];
		$mail = $instance['mail'];
		$web = $instance['web'];

		$microdata = grve_array_value( $instance, 'microdata' );

		echo $before_widget;

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$microdata_name = $microdata_address = $microdata_phone = $microdata_fax = $microdata_email = $microdata_url = '';
		if ( !empty( $microdata ) ) {
			echo '<div itemscope itemtype="http://schema.org/' . esc_attr( $microdata ) . '">';
		}
		?>

		<ul>

		<?php
			if ( ! empty( $name ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-user" itemprop="name">' . esc_html( $name ) . '</li>';
				} else {
					echo '<li class="grve-user">' . esc_html( $name ) . '</li>';
				}
			}
			if ( ! empty( $address ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . wp_kses_post( $address ) . '</li>';
				} else {
					echo '<li class="grve-address">' . wp_kses_post( $address ) . '</li>';
				}
			}
			if ( ! empty( $phone ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-phone" itemprop="telephone">' . esc_html( $phone ) . '</li>';
				} else {
					echo '<li class="grve-phone">' . esc_html( $phone ) . '</li>';
				}
			}
			if ( ! empty( $mobile ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-mobile-number" itemprop="telephone">' . esc_html( $mobile ) . '</li>';
				} else {
					echo '<li class="grve-mobile-number">' . esc_html( $mobile ) . '</li>';
				}
			}
			if ( ! empty( $fax ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-fax" itemprop="faxNumber">' . esc_html( $fax ) . '</li>';
				} else {
					echo '<li class="grve-fax">' . esc_html( $fax ) . '</li>';
				}
			}
			if ( ! empty( $mail ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-email" itemprop="email"><a href="mailto:' . antispambot( $mail ) . '">' . antispambot( $mail ) . '</a></li>';
				} else {
					echo '<li class="grve-email"><a href="mailto:' . antispambot( $mail ) . '">' . antispambot( $mail ) . '</a></li>';
				}
			}
			if ( ! empty( $web ) ) {
				if ( !empty( $microdata ) ) {
					echo '<li class="grve-web"><a href="' . esc_url( $web ) . '" target="_blank" rel="noopener noreferrer" itemprop="url">' . esc_html( $web ) . '</a></li>';
				} else {
					echo '<li class="grve-web"><a href="' . esc_url( $web ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $web ) . '</a></li>';
				}
			}
		?>
		</ul>


		<?php

		if ( !empty( $microdata ) ) {
			echo '</div>';
		}
		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['mobile'] = strip_tags( $new_instance['mobile'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['web'] = strip_tags( $new_instance['web'] );
		$instance['microdata'] = strip_tags( $new_instance['microdata'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'name' => '',
			'address' => '',
			'phone' => '',
			'mobile' => '',
			'fax' => '',
			'mail' => '',
			'web' => '',
			'microdata' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'grve-osmosis-vc-extension' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" style="width:100%;"><?php echo esc_attr( $instance['address'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>"><?php esc_html_e( 'Mobile Phone:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mobile' ) ); ?>" value="<?php echo esc_attr( $instance['mobile'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'Fax:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" value="<?php echo esc_attr( $instance['fax'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>"><?php esc_html_e( 'Mail:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>" name="<?php echo $this->get_field_name( 'mail' ); ?>" value="<?php echo esc_attr( $instance['mail'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>"><?php esc_html_e( 'Website:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'web' ) ); ?>" value="<?php echo esc_attr( $instance['web'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'microdata' ) ); ?>"><?php esc_html_e( 'Microdata ( Schema.org ):', 'grve-osmosis-vc-extension' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('microdata') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'microdata' ) ); ?>" style="width:100%;">
				<?php $microdata = $instance['microdata']; ?>
				<option value="" <?php selected( '', $microdata ); ?>><?php esc_html_e( 'None', 'grve-osmosis-vc-extension' ); ?></option>
				<option value="Person" <?php selected( 'Person', $microdata ); ?>>Person</option>
				<option value="Organization" <?php selected( 'Organization', $microdata ); ?>>Organization</option>
				<option value="Corporation" <?php selected( 'Corporation', $microdata ); ?>>Corporation</option>
				<option value="EducationalOrganization" <?php selected( 'EducationalOrganization', $microdata ); ?>>School</option>
				<option value="GovernmentOrganization" <?php selected( 'GovernmentOrganization', $microdata ); ?>>Government</option>
				<option value="LocalBusiness" <?php selected( 'LocalBusiness', $microdata ); ?>>Local Business</option>
				<option value="NGO" <?php selected( 'NGO', $microdata ); ?>>NGO</option>
				<option value="PerformingGroup" <?php selected( 'PerformingGroup', $microdata ); ?>>Performing Group</option>
				<option value="SportsTeam" <?php selected( 'SportsTeam', $microdata ); ?>>Sports Team</option>
			</select>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
