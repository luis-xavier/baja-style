jQuery(document).ready(function($) {

	"use strict";

	var grveMediaSliderFrame;
	var grveMediaSliderContainer = $( "#grve-slider-container" );
	grveMediaSliderContainer.sortable();

	$(document).on("click",".grve-slider-item-delete-button",function() {
		$(this).parent().remove();
	});

	$(document).on("click",".grve-upload-slider-button",function() {

		if ( grveMediaSliderFrame ) {
			grveMediaSliderFrame.open();
			return;
		}

		grveMediaSliderFrame = wp.media.frames.grveMediaSliderFrame = wp.media({
			className: 'media-frame grve-media-slider-frame',
			frame: 'select',
			multiple: 'toggle',
			title: grve_upload_slider_texts.modal_title,
			library: {
				type: 'image'
			},
			button: {
				text:  grve_upload_slider_texts.modal_button_title
			}
		});
		grveMediaSliderFrame.on('select', function(){
			var selection = grveMediaSliderFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-slider-button-spinner').show();
			var dataParams = {
				action:'grve_get_slider_media',
				attachment_ids: ids.toString(),
				_grve_nonce: grve_upload_slider_texts.nonce_slider_media
			};
			$.post( grve_upload_slider_texts.ajaxurl, dataParams, function( mediaHtml ) {
				grveMediaSliderContainer.append(mediaHtml);
				$('#grve-upload-slider-button-spinner').hide();
			}).fail(function(xhr, status, error) {
				$('#grve-upload-slider-button-spinner').hide();
			});
		});
		grveMediaSliderFrame.on('ready', function(){
			$( '.media-modal' ).addClass( 'grve-media-no-sidebar' );
		});

		grveMediaSliderFrame.open();
	});

});