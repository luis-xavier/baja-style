<?php

/*
 *	Blog Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Prints excerpt
 */
function grve_print_post_excerpt() {


	$excerpt_more = grve_option( 'blog_excerpt_more' );

	if ( 'large-media' != grve_option( 'blog_style', 'large-media' ) ) {
		$excerpt_length = grve_option( 'blog_excerpt_length_small' );
		$excerpt_auto = '1';
	} else {
		$excerpt_length = grve_option( 'blog_excerpt_length' );
		$excerpt_auto = grve_option( 'blog_auto_excerpt' );
	}

	if ( '1' == $excerpt_auto ) {
		echo grve_excerpt( $excerpt_length, $excerpt_more  );
	} else {
		if ( '1' == $excerpt_more ) {
			the_content( esc_html__( 'read more', 'osmosis' ) );
		} else {
			the_content( '' );
		}
	}

}


function grve_isotope_inner_before() {
	$blog_style = grve_option( 'blog_style', 'large-media' );
	if ( 'large-media' != $blog_style && 'small-media' != $blog_style ) {
		echo '<div class="grve-isotope-item-inner">';
	}
}
function grve_isotope_inner_after() {
	$blog_style = grve_option( 'blog_style', 'large-media' );
	if ( 'large-media' != $blog_style && 'small-media' != $blog_style ) {
		echo '</div>';
	}
}
add_action( 'grve_inner_post_loop_item_before', 'grve_isotope_inner_before' );
add_action( 'grve_inner_post_loop_item_after', 'grve_isotope_inner_after' );

function grve_get_loop_title_heading_tag() {

	$blog_style = grve_option( 'blog_style', 'large-media' );
	$title_tag = 'h5';
	if( 'large-media' == $blog_style || 'small-media' == $blog_style  ) {
		$title_tag = 'h4';
	}
	return $title_tag;
}

function grve_loop_post_title_link() {
	$title_tag = grve_get_loop_title_heading_tag();
	the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><' . tag_escape( $title_tag ) . ' class="grve-post-title" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '></a>' );
}
add_action( 'grve_inner_post_loop_item_title_link', 'grve_loop_post_title_link' );

/**
 * Gets post class
 */
function grve_get_post_class( $extra_class = '' ) {

	$blog_style = grve_option( 'blog_style', 'large-media' );

	$post_classes = array( 'grve-blog-item' );
	if ( !empty( $extra_class ) ){
		array_push( $post_classes, $extra_class );
	}

	switch( $blog_style ) {

		case 'large-media':
			array_push( $post_classes, 'grve-big-post' );
			array_push( $post_classes, 'grve-non-isotope-item' );
			break;

		case 'small-media':
			array_push( $post_classes, 'grve-small-post' );
			array_push( $post_classes, 'grve-non-isotope-item' );
			break;

		case 'masonry':
		case 'grid':
			array_push( $post_classes, 'grve-isotope-item' );
			break;

		default:
			break;

	}

	return implode( ' ', $post_classes );

}

 /**
 * Prints blog class depending on the blog style
 */
function grve_get_blog_class() {

	$blog_style = grve_option( 'blog_style', 'large-media' );
	$blog_mode = grve_option( 'blog_mode', 'no-border-mode' );

	switch( $blog_style ) {

		case 'small-media':
			$grve_blog_style_class = 'grve-blog grve-small-media grve-non-isotope';
			break;
		case 'masonry':
			$grve_blog_style_class = 'grve-blog grve-blog-masonry grve-isotope';
			break;
		case 'grid':
			$grve_blog_style_class = 'grve-blog grve-blog-grid grve-isotope';
			break;
		case 'large-media':
		default:
			$grve_blog_style_class = 'grve-blog grve-large-media grve-non-isotope';
			break;

	}

	if ( 'border-mode' == $blog_mode && ( 'masonry' == $blog_style || 'grid' == $blog_style ) ) {
		$grve_blog_style_class .= ' grve-border-mode';
	}

	return $grve_blog_style_class;

}


 /**
 * Prints blog data depending on the blog style
 */
function grve_print_blog_data() {

	$grve_blog_style = grve_option( 'blog_style', 'large-media' );
	$grve_columns = grve_option( 'blog_columns', 4 );
	$item_spinner = grve_option( 'blog_item_spinner', 'no' );

	switch( $grve_blog_style ) {
		case 'masonry':
			echo 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="masonry" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;

		case 'grid':
			echo 'data-type="' . esc_attr( $grve_columns ) . '-columns" data-layout="fitRows" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;
		default:
			echo '';
			break;
	}

}

 /**
 * Prints feature Image
 */
function grve_print_post_feature_image() {

	$blog_style = grve_option( 'blog_style', 'large' );
	$blog_image_mode = grve_option( 'blog_image_mode', 'auto' );

	switch( $blog_style ) {

		case 'small':
		case 'grid':
			$image_size = 'grve-image-small-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'large';
			 }
			break;
		case 'masonry' :
			$image_size  = 'large';
			break;
		case 'large':
		default:
			$image_size = 'grve-image-large-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'grve-image-fullscreen';
			}
			break;
	}

	$image_href = get_permalink();


	if ( !empty( $image_size ) && has_post_thumbnail() ) {
?>
		<div class="grve-media">
			<a href="<?php echo esc_url( $image_href ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
		</div>
<?php

	}

}


 /**
 * Prints feature media
 */
function grve_print_post_feature_media( $post_type = 'image' ) {

	$blog_image_prio = grve_option( 'blog_image_prio', 'no' );
	$blog_style = grve_option( 'blog_style', 'large-media' );

	if ( 'yes' == $blog_image_prio && has_post_thumbnail() ) {
		grve_print_post_feature_image();
	} else {

		switch( $post_type ) {
			case 'audio':
				grve_print_post_audio();
				break;
			case 'video':
				grve_print_post_video( 'post' );
				break;
			case 'gallery':
				$slider_items = grve_post_meta( 'grve_post_slider_items' );
				$gallery_mode = grve_post_meta( 'grve_post_type_gallery_mode', 'gallery' );
				$gallery_image_mode = grve_post_meta( 'grve_post_type_gallery_image_mode' );
				$image_size_slider = 'grve-image-large-rect-horizontal';
				if ( 'resize' == $gallery_image_mode ) {
					$image_size_slider = 'grve-image-fullscreen';
				}
				if ( !empty( $slider_items ) ) {
					grve_print_gallery_slider( $gallery_mode, $slider_items, $image_size_slider  );
				}
				break;
			default:
				grve_print_post_feature_image();
				break;
		}
	}

}

 /**
 * Prints post author by
 */
function grve_print_post_author_by() {

	if ( grve_visibility( 'blog_author_visibility', '1' ) ) {
?>
	<div class="grve-post-author">
		<span><?php echo esc_html__( 'By:', 'osmosis' ) . ' '; ?></span><span><?php the_author_posts_link(); ?></span>
	</div>
<?php
	}
}

 /**
 * Prints like counter
 */
function grve_print_like_counter() {

	$post_likes = grve_option( 'blog_social', '', 'grve-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
?>
		<div class="grve-like-counter"><span class="grve-icon-heart"></span><?php echo grve_likes( $post_id ); ?></div>
<?php
	}

}

/**
 * Prints post date
 */
function grve_print_post_date() {
	if ( grve_visibility( 'blog_date_visibility', '1' ) ) {
?>
	<time class="grve-post-date" datetime="<?php the_time('c'); ?>">
		<?php echo get_the_date(); ?>
	</time>
<?php
	}
}

/**
 * Prints post date meta
 */
function grve_print_post_date_meta() {
?>
	<meta itemprop="datePublished" content="<?php the_time('c'); ?>"/>
<?php
}

/**
 * Prints post comments
 */
function grve_print_post_comments() {
	if ( grve_visibility( 'blog_comments_visibility', '1' ) ) {
?>
	<div class="grve-post-comments grve-small-text">
		<span class="grve-icon-comment"></span> <?php comments_number( '0' , '1', '%' ); ?>
	</div>
<?php
	}
}

/**
 * Prints author avatar
 */
function grve_print_post_author() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type ||  'portfolio' == $post_type  ) {
		return;
	}
?>
	<div class="grve-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
	</div>
<?php

}

/**
 * Prints post image meta
 */
function grve_print_post_image_meta() {
	//Microdata for image
	$feat_image_url = "";
	if ( has_post_thumbnail() ) {
		$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
	} else {
		$feat_image_url = get_template_directory_uri() . '/images/empty/thumbnail.jpg';
	}
?>
	<meta itemprop="image" content="<?php echo esc_url( $feat_image_url ); ?>"/>
<?php
}

/**
 * Prints audio shortcode of post format audio
 */
function grve_print_post_audio() {
	global $wp_embed;

	$audio_mode = grve_post_meta( 'grve_post_type_audio_mode' );
	$audio_mp3 = grve_post_meta( 'grve_post_audio_mp3' );
	$audio_ogg = grve_post_meta( 'grve_post_audio_ogg' );
	$audio_wav = grve_post_meta( 'grve_post_audio_wav' );
	$audio_embed = grve_post_meta( 'grve_post_audio_embed' );

	if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
		echo '<div class="grve-media">' . $audio_embed . '</div>';
	} else {
		if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {
			$audio_output = '';
			$audio_output .= '[audio ';

			if ( !empty( $audio_mp3 ) ) {
				$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
			}
			if ( !empty( $audio_ogg ) ) {
				$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
			}
			if ( !empty( $audio_wav ) ) {
				$audio_output .= 'wav="'. esc_url( $audio_wav ) .'" ';
			}

			$audio_output .= ']';

			echo '<div class="grve-media">' . do_shortcode( $audio_output ) . '</div>';
		}
	}

}

/**
 * Prints video of the video post format
 */
function grve_print_post_video( $type = 'post') {

	$video_mode = grve_post_meta( 'grve_post_type_video_mode' );
	$video_webm = grve_post_meta( 'grve_post_video_webm' );
	$video_mp4 = grve_post_meta( 'grve_post_video_mp4' );
	$video_ogv = grve_post_meta( 'grve_post_video_ogv' );
	$video_embed = grve_post_meta( 'grve_post_video_embed' );

	grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $type );
}

/**
 * Prints a bar with tags and categories ( Single Post Only )
 */
function grve_print_blog_meta_bar() {
	global $post;
	$post_id = $post->ID;
?>
	<?php if ( grve_visibility( 'post_tag_visibility', '1' ) || grve_visibility( 'post_category_visibility', '1' ) ) { ?>
	<div id="grve-tags-categories">
		<div class="grve-row">

			<div class="grve-column-1-2">
				<?php if ( grve_visibility( 'post_tag_visibility', '1' ) ) { ?>
				<div class="grve-tags">
					<?php the_tags('<ul><li>' . esc_html__( 'Post Tags:', 'osmosis' ) . '</li><li>','</li><li>','</li></ul>'); ?>
				</div>
				<?php } ?>
			</div>

			<div class="grve-column-1-2">
				<?php if ( grve_visibility( 'post_category_visibility', '1' ) ) { ?>
				<div class="grve-categories">
				 <?php
					$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
					if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
						$term_ids = implode( ',' , $post_terms );
						echo '<ul>';
						echo '<li>' . esc_html__( 'Posted In:', 'osmosis' ) . '</li>';
						echo wp_list_categories( 'title_li=&style=list&echo=0&hierarchical=0&taxonomy=category&include=' . $term_ids );
						echo '</ul>';
					}
					?>
				</div>
				<?php } ?>
			</div>

		</div>
	</div>
	<?php } ?>

<?php
}

/**
 * Prints related posts ( Single Post )
 */
function grve_print_related_posts() {

	$grve_tag_ids = array();
	$grve_max_related = 3;

	$grve_tags_list = get_the_tags();
	if ( ! empty( $grve_tags_list ) ) {

		foreach ( $grve_tags_list as $tag ) {
			array_push( $grve_tag_ids, $tag->term_id );
		}

	}

	$exclude_ids = array( get_the_ID() );
	$tag_found = false;

	$query = array();
	if ( ! empty( $grve_tag_ids ) ) {
		$args = array(
			'tag__in' => $grve_tag_ids,
			'post__not_in' => $exclude_ids,
			'posts_per_page' => $grve_max_related,
			'paged' => 1,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$tag_found = true;
		}
	}

	if ( $tag_found ) {
?>

	<div class="grve-related-post">
		<h5 class="grve-related-title"><?php esc_html_e( 'You might also like', 'osmosis' ); ?></h5>
		<ul>
			<?php grve_print_loop_related( $query ); ?>
		</ul>

	</div>
<?php
	}
}

/**
 * Prints single related item ( used in related posts )
 */
function grve_print_loop_related( $query, $filter = ''  ) {

	$image_size = 'grve-image-small-rect-horizontal';
	$image_src = get_template_directory_uri() . '/images/empty/' . $image_size . '.jpg';

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

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

		$media_class = "";
		if ( 'yes' == grve_option( 'post_related_hover', 'yes' ) ) {
			$media_class = "grve-image-hover";
		}


?>
		<li>
			<article id="grve-related-post-<?php the_ID(); ?>" <?php post_class( 'grve-related-item' ); ?> itemscope itemType="http://schema.org/BlogPosting">
				<div class="grve-media <?php echo esc_attr( $media_class ); ?>">
					<?php


					if ( 'yes' == grve_option( 'post_related_image', 'yes' ) ) {
						if ( has_post_thumbnail() ) {
					?>
						<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
							<?php the_post_thumbnail( $image_size ); ?>
						</a>
					<?php
						} else {
					?>
						<a class="grve-no-image" href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
							<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
					<?php
						}
					}
					?>
				</div>
				<div class="grve-content">
					<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
						<h6 class="grve-title" itemprop="name headline"><?php the_title(); ?></h6>
						<?php osmosis_grve_print_post_structured_data(); ?>
					</a>
					<div class="grve-caption"><?php grve_print_post_date(); ?></div>
				</div>
			</article>
		</li>
<?php

	endwhile;
	else :
	endif;

	wp_reset_postdata();

}

/**
 * Likes ajax callback ( used in Single Post )
 */
function grve_likes_callback( $post_id ) {
	
	check_ajax_referer( 'osmosis-grve-likes', '_grve_nonce' );

	if ( isset( $_POST['grve_likes_id'] ) ) {
		$post_id = sanitize_text_field( $_POST['grve_likes_id'] );
		echo grve_likes( $post_id, 'update' );
	} else {
		echo 0;
	}
	exit;
}

add_action( 'wp_ajax_grve_likes_callback', 'grve_likes_callback' );
add_action( 'wp_ajax_nopriv_grve_likes_callback', 'grve_likes_callback' );

function grve_likes( $post_id, $action = 'get' ) {

	if( !is_numeric( $post_id ) ) return 0;

	$likes = get_post_meta( $post_id, 'grve_likes', true );

	if( !$likes || !is_numeric( $likes ) ) {
		$likes = 0;
	}

	if ( 'update' == $action ) {
		if ( isset( $_COOKIE['grve_likes_' . $post_id] ) ) {
			return $likes;
		}
		$likes++;
		update_post_meta( $post_id, 'grve_likes', $likes );
		setcookie('grve_likes_' . $post_id, $post_id, time()*20, '/');
	}

	return $likes;
}

 /**
 * Prints social icons ( Post )
 */
function grve_print_post_social( $post_title_color = "light", $element_id = 'grve-social-share', $element_class = 'grve-social-style-default' ) {
	global $post;
	$post_id = $post->ID;

	$post_socials = grve_option( 'blog_social' );

	if ( is_array( $post_socials ) ) {
		$post_socials = array_filter( $post_socials );
	} else {
		$post_socials = '';
	}

	if ( !empty( $post_socials ) ) {

		$post_email = grve_option( 'blog_social', '', 'email' );
		$post_facebook = grve_option( 'blog_social', '', 'facebook' );
		$post_twitter = grve_option( 'blog_social', '', 'twitter' );
		$post_linkedin = grve_option( 'blog_social', '', 'linkedin' );
		$post_googleplus = grve_option( 'blog_social', '', 'google-plus' );
		$post_likes = grve_option( 'blog_social', '', 'grve-likes' );
		$grve_permalink = get_permalink( $post_id );
		$grve_title = get_the_title( $post_id );

		$post_email_string = 'mailto:?subject=' . $grve_title . '&body=' . $grve_title . ': ' . $grve_permalink;

?>
	<!-- Socials -->
	<div id="<?php echo esc_attr( $element_id ); ?>" class="<?php echo esc_attr( $element_class ); ?> grve-<?php echo esc_attr( $post_title_color ); ?>">
		<ul>
			<?php if ( !empty( $post_email  ) ) { ?>
			<li><a href="<?php echo esc_url( $post_email_string ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-email grve-icon-envelope"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_facebook  ) ) { ?>
			<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-facebook grve-icon-facebook"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_twitter  ) ) { ?>
			<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-twitter grve-icon-twitter"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_linkedin  ) ) { ?>
			<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-linkedin grve-icon-linkedin"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_googleplus  ) ) { ?>
			<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-googleplus grve-icon-google-plus"></a></li>
			<?php } ?>
			<?php if ( !empty( $post_likes  ) ) { ?>
			<li><a href="#" class="grve-like-counter-link grve-icon-heart" data-post-id="<?php echo esc_attr( $post_id ); ?>"></a><span class="grve-like-counter"><?php echo grve_likes( $post_id ); ?></span></li>
			<?php } ?>
		</ul>
	</div>
<?php
	}
}

 /**
 * Prints Meta fields ( Post )
 */
function grve_print_post_meta( $element_id = 'grve-meta-responsive', $element_class = 'grve-meta-style-default' ) {
?>
	<div id="<?php echo esc_attr( $element_id ); ?>" class="<?php echo esc_attr( $element_class ); ?>">
		<ul class="grve-meta-elements">
			<?php if ( grve_visibility( 'blog_date_visibility', '1' ) ) { ?>
			<li class="grve-field-date"><span class="grve-icon-date"></span><time datetime="<?php the_time('c'); ?>"><?php echo get_the_date(); ?></time></li>
			<?php } ?>
			<?php if ( grve_visibility( 'post_author_visibility' ) ) { ?>
			<li><a href="#grve-about-author"><span class="grve-icon-user"></span><i><?php the_author(); ?></i></a></li>
			<?php } ?>
			<?php if ( grve_visibility( 'blog_comments_visibility' ) ) { ?>
			<li><a href="#grve-comments"><span class="grve-icon-comment"></span><?php comments_number( __( 'no comments', 'osmosis' ), __( '1 comment', 'osmosis' ), '% ' . __( 'comments', 'osmosis' ) ); ?></a></li>
			<?php } ?>
		</ul>
	</div>
<?php
}

 /**
 * Prints Single Template Meta fields ( Post )
 */
function grve_print_post_single_meta() {
	$post_style = grve_option( 'post_style', 'default' );
		if ( 'simple' == $post_style ) {
?>
	<div id="grve-meta-simple-style">
		<?php
			grve_print_post_meta( 'grve-meta-responsive', 'grve-meta-style-classic' );
			grve_print_post_social( 'primary-1', 'grve-social-share-responsive', 'grve-social-style-classic' );
		?>
	</div>
<?php
	}
}

/**
 * Prints post structured data
 */
if ( !function_exists( 'osmosis_grve_print_post_structured_data' ) ) {
	function osmosis_grve_print_post_structured_data( $args = array() ) {

		if ( has_post_thumbnail() ) {
			$url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large') ;
			$image_url = $url[0];
			$image_width = $url[1];
			$image_height = $url[2];

		} else {
			$image_url = get_template_directory_uri() . '/images/empty/thumbnail.jpg';
			$image_width = 150;
			$image_height = 150;
		}
	?>
		<span class="grve-hidden">
			<span class="grve-structured-data" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			   <span itemprop='url' ><?php echo esc_url( $image_url ); ?></span>
			   <span itemprop='height' ><?php echo esc_html( $image_width ); ?></span>
			   <span itemprop='width' ><?php echo esc_html( $image_height ); ?></span>
			</span>
			<?php if ( grve_visibility( 'blog_author_visibility', '1' ) ) { ?>
			<span class="grve-structured-data" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<span itemprop="name"><?php the_author(); ?></span>
			</span>
			<span class="grve-structured-data" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<span itemprop='name'><?php the_author(); ?></span>
				<span itemprop='logo' itemscope itemtype='http://schema.org/ImageObject'>
					<span itemprop='url'><?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?></span>
				</span>
			</span>
			<?php } else { ?>
			<span class="grve-structured-data" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<span itemprop="name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</span>
			<span class="grve-structured-data" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<span itemprop='name'><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<span itemprop='logo' itemscope itemtype='http://schema.org/ImageObject'>
					<span itemprop='url'><?php echo esc_url( $image_url ); ?></span>
				</span>
			</span>
			<?php } ?>
			<time class="grve-structured-data" itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
			<time class="grve-structured-data" itemprop="dateModified"  datetime="<?php echo get_the_modified_time('c'); ?>"><?php echo get_the_modified_date(); ?></time>
			<span class="grve-structured-data" itemprop="mainEntityOfPage" itemscope itemtype="http://schema.org/WebPage" itemid="<?php echo esc_url( get_permalink() ); ?>"></span>
		</span>
	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
