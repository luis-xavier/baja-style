jQuery(document).ready(function($) {

	"use strict";

	var grveFeatureSliderFrame;
	var grveFeatureSliderContainer = $( "#grve-feature-slider-container" );
	grveFeatureSliderContainer.sortable();

	$(document).on("click",".grve-feature-slider-item-delete-button",function() {
		$(this).parent().remove();
	});

	$(document).on("click",".grve-upload-feature-slider-button",function() {
		if ( grveFeatureSliderFrame ) {
			grveFeatureSliderFrame.open();
			return;
		}
		grveFeatureSliderFrame = wp.media.frames.grveFeatureSliderFrame = wp.media({
			className: 'media-frame grve-media-feature-slider-frame',
			frame: 'select',
			multiple: 'toggle',
			title: grve_upload_feature_slider_texts.modal_title,
			library: {
				type: 'image'
			},
			button: {
				text:  grve_upload_feature_slider_texts.modal_button_title
			}
		});
		grveFeatureSliderFrame.on('select', function(){
			var selection = grveFeatureSliderFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-feature-slider-button-spinner').show();
			var dataParams = {
				action:'grve_get_admin_feature_slider_media',
				attachment_ids: ids.toString(),
				_grve_nonce: grve_upload_feature_slider_texts.nonce_feature_slider_media
			};
			$.post( grve_upload_feature_slider_texts.ajaxurl, dataParams, function( mediaHtml ) {
				grveFeatureSliderContainer.append(mediaHtml);
				$('#grve-upload-feature-slider-button-spinner').hide();
			}).fail(function(xhr, status, error) {
				$('#grve-upload-feature-slider-button-spinner').hide();
			});
		});
		grveFeatureSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'grve-media-no-sidebar' );
		});
		grveFeatureSliderFrame.open();
	});


});