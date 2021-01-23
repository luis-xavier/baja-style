jQuery(document).ready(function($) {

	"use strict";

	//Feature Element Selector
	$(document).on("change","#grve-page-feature-element",function() {

		$('.grve-feature-section-item').hide();
		$('.grve-feature-section-arrow-item').hide();

		switch($(this).val()) {
			case "title":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-page-feature-go-to-section').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-title-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
			break;
			case "image":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-page-feature-go-to-section').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-image').stop( true, true ).fadeIn(500);
				$('#grve-feature-image-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
			break;
			case "video":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-page-feature-go-to-section').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-video').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-video-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
			break;
			case "slider":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-page-feature-go-to-section').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-effect').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-speed').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-pause').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-direction-nav').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-direction-nav-color').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider-transition').stop( true, true ).fadeIn(500);
				$('#grve-feature-slider-container').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
			break;
			case "revslider":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-page-feature-go-to-section').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-go-to-section').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-revslider').stop( true, true ).fadeIn(500);
			break;
			case "map":
				$('#grve-feature-section-size').stop( true, true ).fadeIn(500);
				$('#grve-page-feature-size').change();
				$('#grve-feature-section-header-position').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-integration').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-header-style').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-map').stop( true, true ).fadeIn(500);
				$('#grve-feature-map-container').stop( true, true ).fadeIn(500);
			break;
			default:
			break;
		}
	});

	$(document).on("change","#grve-page-feature-size",function() {
		if( 'custom' == $(this).val() ) {
			if( 'revslider' == $('#grve-page-feature-element').val() ) {
				$('#grve-feature-section-height').hide();
				$('#grve-feature-section-height-rev').stop( true, true ).fadeIn(500);
			} else {
				$('#grve-feature-section-height-rev').hide();
				$('#grve-feature-section-height').stop( true, true ).fadeIn(500);
			}
		} else {
			$('#grve-feature-section-height').hide();
			$('#grve-feature-section-height-rev').hide();
		}

	});

	$(document).on("change","#grve-page-feature-go-to-section",function() {

		if( $(this).is(":checked") ) {
			$('.grve-feature-section-arrow-item').stop( true, true ).fadeIn(500);
		} else {
			$('.grve-feature-section-arrow-item').hide();
		}

	});

	//Feature Map
	$(document).on("click","#grve-upload-multi-map-point",function() {
		$('#grve-upload-multi-map-point').attr('disabled','disabled').addClass('disabled');
		$('#grve-upload-multi-map-button-spinner').show();

		var dataParams = {
			action:'grve_get_map_point',
			map_mode:'new',
			_grve_nonce: grve_feature_section_texts.nonce_map_point
		};
		$.post( grve_feature_section_texts.ajaxurl, dataParams, function( mediaHtml ) {
			$('#grve-feature-map-container').append(mediaHtml);
			$('#grve-upload-multi-map-point').removeAttr('disabled').removeClass('disabled');
			$('#grve-upload-multi-map-button-spinner').hide();
		}).fail(function(xhr, status, error) {
			$('#grve-upload-multi-map-point').removeAttr('disabled').removeClass('disabled');
			$('#grve-upload-multi-map-button-spinner').hide();
		});
	});
	$(document).on("click",".grve-map-item-delete-button",function() {
		$(this).parent().remove();
	});
	$(document).on("click",".postbox.grve-toggle-new .handlediv",function() {
		var p = $(this).parent('.postbox');
		p.toggleClass('closed');
	});

	// LABEL TITLES
	$(document).on("change",".grve-admin-label-update",function() {
		var itemID = $(this).attr('id') + '_admin_label';
		$('#' + itemID ).html($(this).val());
	});

	$(window).on('load',function () {
		$('#grve-page-feature-element').change();
		$('#grve-page-feature-size').change();
	});

	$('.wp-color-picker-field').wpColorPicker();


});