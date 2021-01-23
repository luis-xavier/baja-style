
(function($) {

	"use strict";
	var Map = {

		init: function() {
			//Map
			this.map();
		},
		map: function(){
			$('.grve-map').each( function() {
				var map = $(this),
					lmapLat = map.attr('data-lat'),
					lmapLng = map.attr('data-lng'),
					dragging = isMobile.any() ? false : true;

				var lmapZoom;
				( parseInt( map.attr('data-zoom') ) ) ? lmapZoom = parseInt( map.attr('data-zoom') ) : lmapZoom = 14 ;

				var lmapClustering;
				map.attr('data-clustering') ? lmapClustering = map.attr('data-clustering') : lmapClustering = 'no' ;

				var lmapLatlng = L.latLng( lmapLat, lmapLng );
				var lmapOptions = {
					center: lmapLatlng,
					zoom: lmapZoom,
					dragging: dragging,
					scrollWheelZoom: false
				};
				var lmap = L.map( map.get(0), lmapOptions );
				var tileOptions = {
					subdomains: grve_maps_data.map_tile_url_subdomains,
					attribution: grve_maps_data.map_tile_attribution
				};
				L.tileLayer( grve_maps_data.map_tile_url, tileOptions ).addTo(lmap);

				var markers = [];
				var cMarkers = [];

				if( 'yes' == lmapClustering ) {
					cMarkers = L.markerClusterGroup();
				}
				map.parent().children('.grve-map-point').each( function(i) {

					var mapPoint = $(this),
					lmapPointMarker = mapPoint.attr('data-point-marker'),
					lmapPointTitle = mapPoint.attr('data-point-title'),
					lmapPointOpen = mapPoint.attr('data-point-open'),
					lmapPointLat = parseFloat( mapPoint.attr('data-point-lat') ),
					lmapPointLng = parseFloat( mapPoint.attr('data-point-lng') );

					var data = mapPoint.html();
					var lmapPointInfo = data.trim();

					var markerIcon = L.icon( {
						className: 'grve-map-auto-anchor',
						iconUrl: lmapPointMarker
					});

					var marker = L.marker([lmapPointLat, lmapPointLng], { icon: markerIcon} );
					if( 'yes' !== lmapClustering ) {
						marker.addTo(lmap);
					}

					if ( lmapPointInfo ) {
						var latlng = marker.getLatLng();
						var markerPopup = L.popup().setLatLng(latlng).setContent( data );
						if ( 'yes' == lmapPointOpen ) {
							markerPopup.openOn(lmap);
						}
						marker.on('click', function(e) {
							markerPopup.openOn(lmap);
						} );
					}

					if( 'yes' == lmapClustering ) {
						cMarkers.addLayer( marker );
					}
					markers.push( [lmapPointLat, lmapPointLng] );

				});

				if ( map.parent().children('.grve-map-point').length > 1 ) {

					if( 'yes' == lmapClustering ) {
						lmap.addLayer(cMarkers);
					}
					$(window).resize(function() {
						lmap.fitBounds(markers);
					});
					lmap.fitBounds(markers);
				} else {
					$(window).resize(function() {
						lmap.panTo(lmapLatlng);
					});
				}

				$('.grve-map').on( "grve_redraw_map", function() {
					lmap.invalidateSize();
					if ( map.parent().children('.grve-map-point').length > 1 ) {
						lmap.fitBounds(markers);
					} else {
						lmap.panTo(lmapLatlng);
					}
				});

				map.css({'opacity':0});
				map.delay(600).animate({'opacity':1});

			});

			setTimeout(function () {
				$('.grve-map .grve-map-auto-anchor').each( function() {
					$(this).css('margin-left', '-' + $(this).width()/2 +'px');
					$(this).css('margin-top', '-' + $(this).height() +'px');
				});
				$('.grve-map').trigger( "grve_redraw_map" );
			},100);

		}
	};

	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// GLOBAL VARIABLES
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	Map.init();

	$(window).on("orientationchange",function(){

		setTimeout(function () {
			$('.grve-map').trigger( "grve_redraw_map" );
		},500);

	});

	$('.grve-tabs-title li').click(function () {
		var tabRel = $(this).attr('data-rel');
		if ( '' != tabRel && $(tabRel + ' .grve-map').length ) {
			setTimeout(function () {
				$('.grve-map').trigger( "grve_redraw_map" );
			},500);
		}
	});

	var $tab = $('.vc_tta-tab a, .vc_tta-panel-title a');
	$tab.on('click', function(){
		var $that = $(this),
			link  = $that.attr('href'),
			$panel = $(link);
		if( $panel.find('.grve-map').length ){
			setTimeout(function () {
				$('.grve-map').trigger( "grve_redraw_map" );
			},500);
		}
	});

	$(window).on('load',function () {

		var userAgent = userAgent || navigator.userAgent;
		var isIE = userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1 || userAgent.indexOf("Edge/") > -1;

		if ( $('#grve-body').hasClass( 'compose-mode' ) || ( $('#grve-feature-section .grve-map').length && isIE ) ) {
			$('.grve-map').trigger( "grve_redraw_map" );
		}

	});

})(jQuery);