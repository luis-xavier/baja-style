<?php
/**
 * Greatives Latest Combo Posts, Comments
 * A widget that displays latest posts, comments.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

class Osmosis_Ext_Widget_Latest_Combo extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-latest-combo',
			'description' => __( 'A widget that displays latest posts/comments in tabs.', 'grve-osmosis-vc-extension' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-latest-combo',
		);
		parent::__construct( 'grve-widget-latest-combo', '(Greatives) ' . __( 'Latest Combo', 'grve-osmosis-vc-extension' ), $widget_ops, $control_ops );
	}

	function osmosis_ext_widget_latest_combo() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$num_of_post_comments = $instance['num_of_post_comments'];
		$show_avatar = $instance['show_avatar'];


		if ( empty( $num_of_post_comments ) ) {
			$num_of_post_comments = 5;
		}

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="grve-element grve-tab grve-horizontal-tab">
			<ul class="grve-tabs-title">
				<li class="active"><?php esc_html_e( 'Posts', 'grve-osmosis-vc-extension'); ?></li>
				<li><?php esc_html_e( 'Comments', 'grve-osmosis-vc-extension'); ?></li>
			</ul>
			<div class="grve-tabs-wrapper">
				<div class="grve-tab-content active">
					<div class="grve-widget grve-latest-news">

					<?php

					$args = array(
						'post_type' => 'post',
						'post_status'=>'publish',
						'paged' => 1,
						'posts_per_page' => $num_of_post_comments,
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
								<div class="grve-post-format"></div>
								<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo $grve_target; ?>" class="grve-title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								<div class="grve-latest-news-date"><?php echo get_the_date(); ?></div>
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
					?>
					</div>
				</div>

				<div class="grve-tab-content">

					<div class="grve-widget grve-comments">
					<?php
					$comments = get_comments(
						array(
							'number' => $num_of_post_comments,
							'status' =>
							'approve',
							'post_status' => 'publish',
						)
					);
					$avatar = "";
					//Loop comments
					if ( $comments ) {
					?>
						<ul>
					<?php
						foreach ( (array) $comments as $comment ) {
					?>
							<li>
								<?php if( $show_avatar && '1' == $show_avatar ) { ?>
								<?php echo get_avatar( $comment, 30 ); ?>
								<?php } ?>
								<div class="grve-comment-content">
									<div class="grve-author">
										<?php echo sprintf( _x('%1$s on %2$s', 'Author *on* Post Title', 'grve-osmosis-vc-extension'), get_comment_author_link( $comment->comment_ID ), '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>'); ?>
									</div>
									<div class="grve-comment-date"><?php echo get_the_date(); ?></div>

								</div>
							</li>
					<?php

						}
					?>
						</ul>
					<?php
					} else {
						esc_html_e( 'No Comments Found!', 'grve-osmosis-vc-extension' );
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_of_post_comments'] = strip_tags( $new_instance['num_of_post_comments'] );
		$instance['show_avatar'] = strip_tags( $new_instance['show_avatar'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'num_of_post_comments' => '5',
			'show_avatar' => '1',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'num_of_post_comments' ) ); ?>"><?php esc_html_e( 'Number of comments:', 'grve-osmosis-vc-extension' ); ?></label>
			<select  name="<?php echo esc_attr( $this->get_field_name( 'num_of_post_comments' ) ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
				?>
				    <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $instance['num_of_post_comments'] ); ?>><?php echo esc_html( $i ); ?></option>
				<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>"><?php esc_html_e( 'Show Avatar:', 'grve-osmosis-vc-extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id('show_avatar') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_avatar') ); ?>" type="checkbox" value="1" <?php checked( $instance['show_avatar'], 1 ); ?> />
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
