jQuery(document).ready(function($) {

	"use strict";

	$(document).on("change","#grve-post-type-video-mode",function() {

		$( '.grve-post-video-embed' ).hide();
		$( '.grve-post-video-html5' ).hide();

		if( 'html5' == $(this).val() ) {
			$( '.grve-post-video-html5' ).stop( true, true ).fadeIn(500);
		} else {
			$( '.grve-post-video-embed' ).stop( true, true ).fadeIn(500);
		}

    });

	$(document).on("change","#grve-post-type-audio-mode",function() {

		$( '.grve-post-audio-embed' ).hide();
		$( '.grve-post-audio-html5' ).hide();

		if( 'html5' == $(this).val() ) {
			$( '.grve-post-audio-html5' ).stop( true, true ).fadeIn(500);
		} else {
			$( '.grve-post-audio-embed' ).stop( true, true ).fadeIn(500);
		}

    });

	$(document).on("change",".editor-post-format select",function() {
		var format = $(this).val();
		$( '#wpbody-content div[id^=grve-meta-box-post-format-]' ).hide();
		$( '#wpbody-content #grve-meta-box-post-format-' + format ).stop( true, true ).fadeIn(500);

	});

	$(document).on("change","#post-formats-select input",function() {
		var format = $('#post-formats-select input:checked').attr('value');
		if(typeof format != 'undefined') {

			if( '0' == format || 'image' == 'format' ) {
				format = 'standard';
			}

			$( '#post-body div[id^=grve-meta-box-post-format-]' ).hide();
			$( '#post-body #grve-meta-box-post-format-' + format ).stop( true, true ).fadeIn(500);

		}
	});

	$(document).on("change","#grve-post-title-bg-mode",function() {

		$( '.grve-post-title-bg' ).hide();

		if ( 'featured' == $(this).val() ) {
			$( '.grve-post-title-bg-position' ).stop( true, true ).fadeIn(500);
			$( '.grve-post-title-bg-height' ).stop( true, true ).fadeIn(500);
		} else if ( 'custom' == $(this).val() ) {
			$( '.grve-post-title-bg-position' ).stop( true, true ).fadeIn(500);
			$( '.grve-post-title-bg-height' ).stop( true, true ).fadeIn(500);
			$( '.grve-post-title-bg-image' ).stop( true, true ).fadeIn(500);
		}

    });

	$(document).on("change","#grve-post-gallery-mode",function() {

		$( '.grve-post-media-item' ).hide();

		if ( 'slider' == $(this).val() ) {
			$( '#grve-post-gallery-image-mode-section' ).stop( true, true ).fadeIn(500);
			$( '#grve-post-media-slider-speed' ).stop( true, true ).fadeIn(500);
			$( '#grve-post-media-slider-direction-nav' ).stop( true, true ).fadeIn(500);
		}

    });

	$(window).on('load',function () {
		$('#grve-post-type-video-mode').change();
		$('#grve-post-type-audio-mode').change();
		$('.editor-post-format select').change();
		$('#post-formats-select input').change();
		$('#grve-post-title-bg-mode').change();
		$('#grve-post-gallery-mode').change();
	});

	if ( $( '#wpbody-content #grve-meta-box-post-format-standard').length ) {
		var format = $('#grve-post-format-value').val();
		$( '#wpbody-content div[id^=grve-meta-box-post-format-]' ).hide();
		$( '#wpbody-content #grve-meta-box-post-format-' + format ).stop( true, true ).fadeIn(500);
	}

});