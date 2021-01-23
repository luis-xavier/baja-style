jQuery(document).ready(function($) {

	"use strict";

	if( 0 === $('.grve-custom-sidebar-normal').length ) {
		$('.grve-custom-sidebar-empty').show();
	}

	$(document).on("click",".grve-custom-sidebar-item-delete-button",function() {
		$(this).parents('.grve-custom-sidebar-item').remove();
		$('.grve-sidebar-changed').show();
		if( 0 === $('.grve-custom-sidebar-normal').length ) {
			$('.grve-custom-sidebar-empty').show();
		}
	});

	$(document).on("click","#grve-add-custom-sidebar-item",function() {

		$('#grve-sidebar-wrap .button').attr('disabled','disabled').addClass('disabled');
		$('.grve-sidebar-notice').hide();
		$('.grve-sidebar-notice-exists').hide();
		$('.grve-sidebar-spinner').show();

		var sidebarName = $('#grve-custom-sidebar-item-name-new').val();

		if ( '' == $.trim(sidebarName) ) {
			$('.grve-sidebar-notice').show();
			$('.grve-sidebar-spinner').hide();
			$('#grve-sidebar-wrap .button').removeAttr('disabled').removeClass('disabled');
		} else {

			var alreadyExists = false;
			$('#grve-sidebar-wrap .grve-custom-sidebar-item-name').each(function () {
				if( $(this).val() == sidebarName ) {
					alreadyExists = true;
					return false;
				}
			});
			if ( alreadyExists ) {
				$('.grve-sidebar-notice-exists').show();
				$('.grve-sidebar-spinner').hide();
				$('#grve-sidebar-wrap .button').removeAttr('disabled').removeClass('disabled');
			} else {
				var dataParams = {
					action:'osmosis_grve_get_custom_sidebar',
					grve_sidebar_name: sidebarName,
					_grve_nonce: grve_custom_sidebar_texts.nonce_custom_sidebar
				};				
				$.post( grve_custom_sidebar_texts.ajaxurl, dataParams, function( sidebarHtml ) {
					$('#grve-custom-sidebar-container').append(sidebarHtml);
					$('#grve-custom-sidebar-item-name-new').val('');
					$('.grve-sidebar-spinner').hide();
					$('.grve-sidebar-changed').show();
					$('#grve-sidebar-wrap .button').removeAttr('disabled').removeClass('disabled');
					if( 0 !== $('.grve-custom-sidebar-normal').length ) {
						$('.grve-custom-sidebar-empty').hide();
					}
				}).fail(function(xhr, status, error) {
					$('.grve-sidebar-spinner').hide();
					$('#grve-sidebar-wrap .button').removeAttr('disabled').removeClass('disabled');
				});
			}
		}
	});

	$( "#grve-custom-sidebar-container" ).sortable();
	$('.grve-sidebar-saved').delay(4000).slideUp();


});