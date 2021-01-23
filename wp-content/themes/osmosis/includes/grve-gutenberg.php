<?php

/*
*	Gutenberg functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function osmosis_grve_gutenberg_styles() {
	 wp_enqueue_style( 'osmosis-grve-editor-customizer-styles', get_template_directory_uri() .  '/includes/css/grve-gutenberg-editor.css' , false, '1.0', 'all' );
	 wp_add_inline_style( 'osmosis-grve-editor-customizer-styles', osmosis_grve_custom_colors_css() );
}
add_action( 'enqueue_block_editor_assets', 'osmosis_grve_gutenberg_styles' );



function osmosis_grve_editor_custom_title_colors_css( $post ) {

	$post_id = $post->ID;
	$mode = $post->post_type;

	$image_url = '';
	$css = '';


	if ( 'post' == $post->post_type	) {

		$css .= "
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
				font-family: " . grve_option( 'post_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
				font-weight: " . grve_option( 'post_title', 'normal', 'font-weight'  ) . ";
				font-style: " . grve_option( 'post_title', 'normal', 'font-style'  ) . ";
				font-size: " . grve_option( 'post_title', '60px', 'font-size'  ) . ";
				text-transform: " . grve_option( 'post_title', 'uppercase', 'text-transform'  ) . ";
				" . grve_css_option( 'post_title', '', 'letter-spacing'  ) . "
			}
		";

		$title_style = grve_option( 'post_style' );
		if ( 'simple' != $title_style ) {
			$title_bg_color = grve_option( 'post_title_background_color' );
			$title_color = grve_option( 'post_title_color' );
			$title_color = grve_array_value( osmosis_grve_get_color_array(), $title_color , 'light' );
			$title_align = 'center';

			$css .= "
				.editor-styles-wrapper  .wp-block.editor-post-title__block {
					margin-bottom: 0;
				}
				.editor-styles-wrapper .editor-post-title {
					padding-top: 60px;
					padding-bottom: 60px;
					background-color: " . esc_attr( $title_bg_color ) . ";
				}
				.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
					text-align: " . esc_attr( $title_align ) .";
					color: " . esc_attr( $title_color ) . ";
				}
			";
			$media = grve_option( 'post_title_background', '', 'media' );
			if( isset( $media['id'] ) && !empty( $media['id'] ) ) {
				$media_id = $media['id'];
				$bg_position = grve_option( 'post_title_background', 'center center', 'background-position' );
				$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
				$image_url = esc_url( $full_src[0] );
			}

			if( !empty( $image_url ) ) {
				$css .= "
					.editor-styles-wrapper .editor-post-title {
						background-image: url(" . esc_url( $image_url ) . ");
						background-position: " . esc_attr( $bg_position ) . ";
						background-size: cover;
						background-repeat: no-repeat;
					}
				";
			}
		}

	} else {
		$css .= "
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
				font-family: " . grve_option( 'page_title', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
				font-weight: " . grve_option( 'page_title', 'normal', 'font-weight'  ) . ";
				font-style: " . grve_option( 'page_title', 'normal', 'font-style'  ) . ";
				font-size: " . grve_option( 'page_title', '60px', 'font-size'  ) . ";
				text-transform: " . grve_option( 'page_title', 'uppercase', 'text-transform'  ) . ";
				" . grve_css_option( 'page_title', '', 'letter-spacing'  ) . "
			}
		";

		$title_bg_color = grve_option( 'page_title_background_color' );
		$title_color = grve_option( 'page_title_color' );
		$title_color = grve_array_value( osmosis_grve_get_color_array(), $title_color , 'light' );
		$title_align = grve_option( 'page_title_alignment', 'center' );

		$css .= "
			.editor-styles-wrapper  .wp-block.editor-post-title__block {
				margin-bottom: 0;
			}
			.editor-styles-wrapper .editor-post-title {
				padding-top: 60px;
				padding-bottom: 60px;
				background-color: " . esc_attr( $title_bg_color ) . ";
			}
			.editor-styles-wrapper .editor-post-title__block .editor-post-title__input {
				text-align: " . esc_attr( $title_align ) .";
				color: " . esc_attr( $title_color ) . ";
			}
		";
		
		$media = grve_option( 'page_title_background', '', 'media' );
		if( isset( $media['id'] ) && !empty( $media['id'] ) ) {
			$media_id = $media['id'];
			$bg_position = grve_option( 'page_title_background', 'center center', 'background-position' );
			$full_src = wp_get_attachment_image_src( $media_id, 'grve-image-fullscreen' );
			$image_url = esc_url( $full_src[0] );
		}

		if( !empty( $image_url ) ) {
			$css .= "
				.editor-styles-wrapper .editor-post-title {
					background-image: url(" . esc_url( $image_url ) . ");
					background-position: " . esc_attr( $bg_position ) . ";
					background-size: cover;
					background-repeat: no-repeat;
				}
			";
		}		
	}

	return $css;

}

function osmosis_grve_custom_colors_css() {

	global $post, $pagenow;
	$css = "";

	$css .= "
		.edit-post-visual-editor .editor-block-list__layout {
			background-color: " . grve_option( 'theme_body_background_color' ) . ";
			padding-top: 40px;
			padding-bottom: 40px;
		}
		.edit-post-visual-editor .editor-block-list__block-edit,
		.edit-post-visual-editor {
			color: " . grve_option( 'body_text_color' ) . ";
		}
	";

	/* Link Colors */

	$css .= "
	.editor-styles-wrapper a,
	.editor-styles-wrapper a code,
	.editor-styles-wrapper .wp-block-freeform.block-library-rich-text__tinymce a code {
		color: " . grve_option( 'body_text_link_color' ) . ";

	}
	.editor-styles-wrapper a:hover,
	.editor-styles-wrapper a:hover code {
		color: " . grve_option( 'body_text_link_hover_color' ) . ";
	}
	";

	/* Header Colors */
	$css .= "
	.editor-styles-wrapper h1,
	.editor-styles-wrapper h2,
	.editor-styles-wrapper h3,
	.editor-styles-wrapper h4,
	.editor-styles-wrapper h5,
	.editor-styles-wrapper h6 {
		color: " . grve_option( 'body_heading_color' ) . ";
	}
	";

	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {

		$post_id = $post->ID;
		$mode = $post->post_type;


		$css .= osmosis_grve_editor_custom_title_colors_css( $post );

		$content_width = 1170;

		$css .= "
		.editor-styles-wrapper .wp-block {
			max-width: " . esc_attr( $content_width ) . "px;
		}
		.edit-post-visual-editor .editor-block-list__block-edit,
		.edit-post-visual-editor {
			font-size: " . grve_option( 'body_font', '14px', 'font-size'  ) . ";
			font-family: " . grve_option( 'body_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
			font-weight: " . grve_option( 'body_font', 'normal', 'font-weight'  ) . ";
			" . grve_css_option( 'body_font', '', 'letter-spacing'  ) . "
		}
		";

	}
	$css .= "

	.mce-content-body h1,
	.editor-styles-wrapper h1,
	.editor-styles-wrapper .grve-h1,
	.wp-block-freeform.block-library-rich-text__tinymce h1,
	.wp-block-heading h1.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h1_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h1_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h1_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h1_font', '68px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h1_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h1_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h2,
	.editor-styles-wrapper .grve-h2,
	.wp-block-freeform.block-library-rich-text__tinymce h2,
	.wp-block-heading h2.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h2_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h2_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h2_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h2_font', '50px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h2_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h2_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h3,
	.editor-styles-wrapper .grve-h3,
	.wp-block-freeform.block-library-rich-text__tinymce h3,
	.wp-block-heading h3.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h3_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h3_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h3_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h3_font', '34px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h3_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h3_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h4,
	.editor-styles-wrapper .grve-h4,
	.wp-block-freeform.block-library-rich-text__tinymce h4,
	.wp-block-heading h4.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h4_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h4_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h4_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h4_font', '25px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h4_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h4_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h5,
	.editor-styles-wrapper .grve-h5,
	.wp-block-freeform.block-library-rich-text__tinymce h5,
	.wp-block-heading h5.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h5_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h5_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h5_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h5_font', '18px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h5_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h5_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper h6,
	.editor-styles-wrapper .grve-h6,
	.wp-block-freeform.block-library-rich-text__tinymce h6,
	.wp-block-heading h6.editor-rich-text__tinymce {
		font-family: " . grve_option( 'h6_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'h6_font', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'h6_font', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'h6_font', '14px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'h6_font', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'h6_font', '', 'letter-spacing'  ) . "
	}

	.editor-styles-wrapper blockquote p,
	.editor-styles-wrapper blockquote,
	.wp-block-freeform.block-library-rich-text__tinymce blockquote,
	.wp-block-freeform.block-library-rich-text__tinymce blockquote p {
		font-family: " . grve_option( 'subtitle_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'subtitle_text', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'subtitle_text', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'subtitle_text', '18px', 'font-size'  ) . ";
		text-transform: " . grve_option( 'subtitle_text', 'none', 'text-transform'  ) . ";
		" . grve_css_option( 'subtitle_text', '', 'letter-spacing'  ) . "
	}
	.editor-styles-wrapper blockquote:before {
		font-family: " . grve_option( 'subtitle_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'subtitle_text', 'normal', 'font-weight'  ) . ";
	}
	.editor-styles-wrapper .wp-block-quote::before {
		background-color: " . grve_option( 'body_primary_1_color' ) . ";
		color: #ffffff;
	}
	
	.wp-block-quote cite,
	.wp-block-pullquote cite,
	.wp-block-quote footer,
	.wp-block-pullquote footer,
	.wp-block-quote__citation,
	.wp-block-pullquote__citation {
		font-family: " . grve_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
		font-weight: " . grve_option( 'small_text', 'normal', 'font-weight'  ) . ";
		font-style: " . grve_option( 'small_text', 'normal', 'font-style'  ) . ";
		font-size: " . grve_option( 'small_text', '10px', 'font-size'  ) . " !important;
		text-transform: " . grve_option( 'small_text', 'uppercase', 'text-transform'  ) . ";
		" . grve_css_option( 'small_text', '', 'letter-spacing'  ) . "
	}	
	";

	$css .= "
	.editor-styles-wrapper table,
	.editor-styles-wrapper tr,
	.editor-styles-wrapper td,
	.editor-styles-wrapper th,
	.editor-styles-wrapper form,
	.editor-styles-wrapper form p,
	.editor-styles-wrapper label,
	.editor-styles-wrapper div,
	.editor-styles-wrapper hr {
		border-color: " . grve_option( 'body_border_color' ) . " !important;
	}

	.editor-styles-wrapper hr.is-style-dots:before {
		color: " . grve_option( 'body_border_color' ) . " !important;
	}

	";

	return $css;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
