<?php
/**
 * Greatives Latest Posts
 * A widget that displays latest posts.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

class Osmosis_Ext_Widget_Latest_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-latest-news',
			'description' => esc_html__( 'A widget that displays latest posts', 'grve-osmosis-vc-extension'),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-latest-posts',
		);
		parent::__construct( 'grve-widget-latest-posts', '(Greatives) ' . esc_html__( 'Latest Posts', 'grve-osmosis-vc-extension' ), $widget_ops, $control_ops );
	}

	function osmosis_ext_widget_latest_posts() {
		$this->__construct();
	}

	function widget( $args, $instance ) {
		$image_size = 'grve-image-extrasmall-square';

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );
		$num_of_posts = grve_array_value( $instance, 'num_of_posts', 5 );
		$show_image = grve_array_value( $instance, 'show_image', 0 );

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$args = array(
			'post_type' => 'post',
			'post_status'=>'publish',
			'paged' => 1,
			'posts_per_page' => $num_of_posts,
		);
		//Loop posts
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
		?>
			<ul>
		<?php
		while ( $query->have_posts() ) : $query->the_post();

			$grve_link = get_permalink();
			$grve_target = '_self';

			if ( 'link' == get_post_format() ) {
				$grve_link = get_post_meta( get_the_ID(), 'grve_post_link_url', true );
				$new_window = get_post_meta( get_the_ID(), 'grve_post_link_new_window', true );
				if( empty( $grve_link ) ) {
					$grve_link = get_permalink();
				}

				if( !empty( $new_window ) ) {
					$grve_target = '_blank';
				}
			}

		?>

				<li <?php post_class(); ?>>
					<?php if( $show_image && '1' == $show_image ) { ?>
						<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>" title="<?php the_title_attribute(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail( $image_size ); ?>
						<?php } else { ?>
							<img width="80" height="80" src="<?php echo get_template_directory_uri() . '/images/empty/grve-image-extrasmall-square.jpg'; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
						<?php } ?>
						</a>
					<?php } ?>
					<div class="grve-news-content">
						<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo $grve_target; ?>" class="grve-title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						<div class="grve-latest-news-date"><?php echo get_the_date(); ?></div>
					</div>
				</li>

		<?php
		endwhile;
		?>
			</ul>
		<?php
		else :
		?>

				<?php esc_html_e( 'No Posts Found!', 'grve-osmosis-vc-extension' ); ?>

		<?php
		endif;

		wp_reset_postdata();
		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_of_posts'] = strip_tags( $new_instance['num_of_posts'] );
		$instance['show_image'] = strip_tags( $new_instance['show_image'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'num_of_posts' => '5',
			'show_image' => '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_posts' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'grve-osmosis-vc-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'num_of_posts' ) ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
				?>
				    <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $instance['num_of_posts'] ); ?>><?php echo esc_html( $i ); ?></option>
				<?php
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php esc_html_e( 'Show Featured Image:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('show_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_image') ); ?>" type="checkbox" value="1" <?php checked( $instance['show_image'], 1 ); ?> />
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
