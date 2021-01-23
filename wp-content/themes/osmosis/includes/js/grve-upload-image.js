jQuery(document).ready(function($) {

	"use strict";

	var grveMediaImageFrame;
	var grveMediaImageContainer = $( "#grve-feature-image-container" );

	$(document).on("click",".grve-image-item-delete-button",function() {
		$(this).parent().remove();
		$('.grve-upload-image-button').removeAttr('disabled').removeClass('disabled');
	});

	$(document).on("click",".grve-upload-image-button",function() {

		if ( grveMediaImageFrame ) {
			grveMediaImageFrame.open();
			return;
		}
		grveMediaImageFrame = wp.media.frames.grveMediaImageFrame = wp.media({
			className: 'media-frame grve-media-frame',
			frame: 'select',
			multiple: false,
			title: grve_upload_image_texts.modal_title,
			library: {
				type: 'image'
			},
			button: {
				text:  grve_upload_image_texts.modal_button_title
			}
		});
		grveMediaImageFrame.on('select', function(){
			var selection = grveMediaImageFrame.state().get('selection');
			var ids = selection.pluck('id');

			$('#grve-upload-image-button-spinner').show();
			$('.grve-upload-image-button').attr('disabled','disabled').addClass('disabled');
			var dataParams = {
				action:'grve_get_image_media',
				attachment_id: ids.toString(),
				_grve_nonce: grve_upload_image_texts.nonce_image_media
			};
			$.post( grve_upload_image_texts.ajaxurl, dataParams, function( mediaHtml ) {
				grveMediaImageContainer.html(mediaHtml);
				$('#grve-upload-image-button-spinner').hide();
			}).fail(function(xhr, status, error) {
				$('#grve-upload-image-button-spinner').hide();
			});

		});

		grveMediaImageFrame.open();
	});


});