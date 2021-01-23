<?php
	if ( post_password_required() ) {
?>
		<div class="help">
			<p class="no-comments"><?php echo esc_html__( 'This post is password protected. Enter the password to view comments.', 'osmosis' ); ?></p>
		</div>
<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<nav class="grve-comment-nav">
		<ul>
	  		<li><?php previous_comments_link(); ?></li>
	  		<li><?php next_comments_link(); ?></li>
	 	</ul>
	</nav>

	<!-- Comments -->
	<div id="grve-comments" class="grve-section">
		<h5 class="grve-comments-number">
			<?php comments_number( esc_html__( 'no comments', 'osmosis' ), esc_html__( '1 comment', 'osmosis' ), '% ' . esc_html__( 'comments', 'osmosis' ) ); ?>
		</h5>
		<ul>
		<?php wp_list_comments( 'type=comment&callback=grve_comments' ); ?>
		</ul>
	</div>
	<!-- End Comments -->

	<nav class="grve-comment-nav">
		<ul>
	  		<li><?php previous_comments_link(); ?></li>
	  		<li><?php next_comments_link(); ?></li>
		</ul>
	</nav>

<?php endif; ?>


<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'osmosis' ); ?></p>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'grve-comment-submit-button',
			'title_reply'       => __( 'Leave a Reply', 'osmosis' ),
			'title_reply_to'    => __( 'Leave a Reply to', 'osmosis' ) . ' %s',
			'cancel_reply_link' => __( 'Cancel Reply', 'osmosis' ),
			'label_submit'      => __( 'Submit Comment', 'osmosis' ),

			'comment_field' =>
				'<div class="grve-form-textarea">'.
				'<textarea style="resize:none;" id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment Here...', 'osmosis' ) . '" cols="45" rows="15" aria-required="true">' .
				'</textarea></div><div class="clear"></div>',

			'must_log_in' =>
				'<p class="must-log-in">' . esc_html__( 'You must be', 'osmosis' ) .
				'<a href="' .  wp_login_url( get_permalink() ) . '">' . esc_html__( 'logged in', 'osmosis' ) . '</a> ' . esc_html__( 'to post a comment.', 'osmosis' ) . '</p>',

			'logged_in_as' =>
				'<p class="logged-in-as">' .  esc_html__('Logged in as','osmosis') .
				'<a href="' . admin_url( 'profile.php' ) . '"> ' . $user_identity . '</a>. ' .
				'<a href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'osmosis' ) . '"> ' . esc_html__( 'Log out', 'osmosis' ) . '</a></p>',

			'comment_notes_before' =>
				'<p class="comment-notes">' .
				__( 'Your email address will not be published.', 'osmosis' ) .
				'</p>',

			'comment_notes_after' => '' ,

			'fields' => apply_filters(
				'comment_form_default_fields',
				array(
					'author' =>
						'<div class="grve-form-input">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
						' placeholder="' . esc_attr__( 'Name', 'osmosis' ) . ' ' . ( $req ? esc_attr__( '(required)', 'osmosis' ) : '' ) . '" />' .
						'</div>',

					'email' =>
						'<div class="grve-form-input">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
						' placeholder="' . esc_attr__( 'E-mail', 'osmosis' ) . ' ' . ( $req ? esc_attr__( '(required)', 'osmosis' ) : '' ) . '" />' .
						'</div>',

					'url' =>
						'<div class="grve-form-input">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' .
						' placeholder="' . esc_attr__( 'Website', 'osmosis' )  . '" />' .
						'</div>',
					)
				),
		);
?>


			<?php
				//Use comment_form() with no parameters if you want the default form instead.
				comment_form( $args );
			?>


<?php endif;  ?>