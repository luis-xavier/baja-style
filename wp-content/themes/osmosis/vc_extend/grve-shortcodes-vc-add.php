<?php
/*
 *	Greatives Visual Composer Shortcode Extentions
 *
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


if ( function_exists( 'vc_add_param' ) ) {

	//Generic css aniation for elements

	$grve_add_animation = array(
		"type" => "dropdown",
		"heading" => esc_html__("CSS Animation", 'osmosis' ),
		"param_name" => "animation",
		"admin_label" => true,
		"value" => array(
			esc_html__( "No", 'osmosis' ) => '',
			esc_html__( "Fade In", 'osmosis' ) => "fadeIn",
			esc_html__( "Fade In Up", 'osmosis' ) => "fadeInUp",
			esc_html__( "Fade In Down", 'osmosis' ) => "fadeInDown",
			esc_html__( "Fade In Left", 'osmosis' ) => "fadeInLeft",
			esc_html__( "Fade In Right", 'osmosis' ) => "fadeInRight",
			esc_html__( "Zoom In", 'osmosis' ) => "zoomIn",
		),
		"description" => esc_html__("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'osmosis' ),
	);

	$grve_add_animation_delay = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Css Animation Delay', 'osmosis' ),
		"param_name" => "animation_delay",
		"value" => '200',
		"description" => esc_html__( "Add delay in milliseconds.", 'osmosis' ),
	);

	$grve_add_margin_bottom = array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'osmosis' ),
		"param_name" => "margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'osmosis' ),
	);

	$grve_add_el_class = array(
		"type" => "textfield",
		"heading" => esc_html__("Extra class name", 'osmosis' ),
		"param_name" => "el_class",
		"description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'osmosis' ),
	);

	$grve_column_width_list = array(
		esc_html__('1 column - 1/12', 'osmosis' ) => '1/12',
		esc_html__('2 columns - 1/6', 'osmosis' ) => '1/6',
		esc_html__('3 columns - 1/4', 'osmosis' ) => '1/4',
		esc_html__('4 columns - 1/3', 'osmosis' ) => '1/3',
		esc_html__('5 columns - 5/12', 'osmosis' ) => '5/12',
		esc_html__('6 columns - 1/2', 'osmosis' ) => '1/2',
		esc_html__('7 columns - 7/12', 'osmosis' ) => '7/12',
		esc_html__('8 columns - 2/3', 'osmosis' ) => '2/3',
		esc_html__('9 columns - 3/4', 'osmosis' ) => '3/4',
		esc_html__('10 columns - 5/6', 'osmosis' ) => '5/6',
		esc_html__('11 columns - 11/12', 'osmosis' ) => '11/12',
		esc_html__('12 columns - 1/1', 'osmosis' ) => '1/1'
	);

	$grve_column_desktop_hide_list = array(
		esc_html__('Default value from width attribute', 'osmosis') => '',
		esc_html__( 'Hide', 'osmosis' ) => 'hide',
	);

	$grve_column_width_tablet_list = array(
		esc_html__('Default value from width attribute', 'osmosis') => '',
		esc_html__( 'Hide', 'osmosis' ) => 'hide',
		esc_html__( '1 column - 1/12', 'osmosis' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'osmosis' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'osmosis' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'osmosis' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'osmosis' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'osmosis' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'osmosis' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'osmosis' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'osmosis' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'osmosis' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'osmosis' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'osmosis' ) => '1',
	);

	$grve_column_width_tablet_sm_list = array(
		esc_html__('Inherit from Tablet Landscape', 'osmosis') => '',
		esc_html__( 'Hide', 'osmosis' ) => 'hide',
		esc_html__( '1 column - 1/12', 'osmosis' ) => '1-12',
		esc_html__( '2 columns - 1/6', 'osmosis' ) => '1-6',
		esc_html__( '3 columns - 1/4', 'osmosis' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'osmosis' ) => '1-3',
		esc_html__( '5 columns - 5/12', 'osmosis' ) => '5-12',
		esc_html__( '6 columns - 1/2', 'osmosis' ) => '1-2',
		esc_html__( '7 columns - 7/12', 'osmosis' ) => '7-12',
		esc_html__( '8 columns - 2/3', 'osmosis' ) => '2-3',
		esc_html__( '9 columns - 3/4', 'osmosis' ) => '3-4',
		esc_html__( '10 columns - 5/6', 'osmosis' ) => '5-6',
		esc_html__( '11 columns - 11/12', 'osmosis' ) => '11-12',
		esc_html__( '12 columns - 1/1', 'osmosis' ) => '1',
	);
	$grve_column_mobile_width_list = array(
		esc_html__( '12 columns - 1/1', 'osmosis' ) => '',
		esc_html__( 'Hide', 'osmosis' ) => 'hide',
		esc_html__( '3 columns - 1/4', 'osmosis' ) => '1-4',
		esc_html__( '4 columns - 1/3', 'osmosis' ) => '1-3',
		esc_html__( '6 columns - 1/2', 'osmosis' ) => '1-2',
		esc_html__( '12 columns - 1/1', 'osmosis' ) => '1',		
	);

	//Add additional column options for Page Builder 5.5
	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '5.5', '>=' ) ) {
		$grve_extra_list = array(
			esc_html__( '20% - 1/5', 'osmosis' ) => '1/5',
			esc_html__( '40% - 2/5', 'osmosis' ) => '2/5',
			esc_html__( '60% - 3/5', 'osmosis' ) => '3/5',
			esc_html__( '80% - 4/5', 'osmosis' ) => '4/5',
		);
		$grve_column_width_list = array_merge( $grve_column_width_list, $grve_extra_list );

		$grve_extra_list_simplified = array(
			esc_html__( '20% - 1/5', 'osmosis' ) => '1-5',
			esc_html__( '40% - 2/5', 'osmosis' ) => '2-5',
			esc_html__( '60% - 3/5', 'osmosis' ) => '3-5',
			esc_html__( '80% - 4/5', 'osmosis' ) => '4-5',
		);
		$grve_column_width_tablet_list = array_merge( $grve_column_width_tablet_list, $grve_extra_list_simplified );
		$grve_column_width_tablet_sm_list = array_merge( $grve_column_width_tablet_sm_list, $grve_extra_list_simplified );
		$grve_column_mobile_width_list = array_merge( $grve_column_mobile_width_list, $grve_extra_list_simplified );
	}

	$grve_column_gap_list = array(
		esc_html__( 'Default', 'osmosis' ) => '',
		esc_html__( 'No Gap', 'osmosis' ) => 'none',
		esc_html__( '5px', 'osmosis' ) => '5',
		esc_html__( '10px', 'osmosis' ) => '10',
		esc_html__( '15px', 'osmosis' ) => '15',
		esc_html__( '20px', 'osmosis' ) => '20',
		esc_html__( '25px', 'osmosis' ) => '25',
		esc_html__( '30px', 'osmosis' ) => '30',
		esc_html__( '35px', 'osmosis' ) => '35',
		esc_html__( '40px', 'osmosis' ) => '40',
		esc_html__( '45px', 'osmosis' ) => '45',
		esc_html__( '50px', 'osmosis' ) => '50',
		esc_html__( '55px', 'osmosis' ) => '55',
		esc_html__( '60px', 'osmosis' ) => '60',
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Section ID', 'osmosis' ),
			"param_name" => "section_id",
			"description" => esc_html__("If you wish you can type an id to use it as bookmark.", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__('Section Title', 'osmosis' ),
			"param_name" => "section_title",
			"description" => esc_html__("If you wish you can type a title for the side dot navigation.", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__('Font Color', 'osmosis' ),
			"param_name" => "font_color",
			"description" => esc_html__("Select font color", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Heading Color", 'osmosis' ),
			"param_name" => "heading_color",
			"value" => array(
				esc_html__( "Default", 'osmosis' ) => '',
				esc_html__( "Dark", 'osmosis' ) => 'dark',
				esc_html__( "Light", 'osmosis' ) => 'light',
				esc_html__( "Primary 1", 'osmosis' ) => 'primary-1',
				esc_html__( "Primary 2", 'osmosis' ) => 'primary-2',
				esc_html__( "Primary 3", 'osmosis' ) => 'primary-3',
				esc_html__( "Primary 4", 'osmosis' ) => 'primary-4',
				esc_html__( "Primary 5", 'osmosis' ) => 'primary-5',
			),
			"description" => esc_html__( "Select heading color", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row", $grve_add_el_class );


	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Section Type", 'osmosis' ),
			"param_name" => "section_type",
			"value" => array(
				esc_html__( "Full Width Background", 'osmosis' ) => 'fullwidth-background',
				esc_html__( "In Container", 'osmosis' ) => 'in-container',
				esc_html__( "Full Width Element", 'osmosis' ) => 'fullwidth-element',
			),
			"description" => esc_html__( "Select section type", 'osmosis' ),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Flex Column Height", 'osmosis'),
			"param_name" => "flex_height",
			"description" => esc_html__( "If selected columns will have equal height. Recommended for multiple columns with different background colors.", 'osmosis' ),
			"value" => Array(esc_html__( "Flex column height", 'osmosis' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Middle Column Content", 'osmosis'),
			"param_name" => "middle_content",
			"description" => esc_html__( "If selected column content will be centered vertically.", 'osmosis' ),
			"value" => Array(esc_html__( "Middle Content", 'osmosis' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Section Window Height", 'osmosis' ),
			"param_name" => "section_full_height",
			"value" => array(
				esc_html__( "No", 'osmosis' ) => 'no',
				esc_html__( "Yes", 'osmosis' ) => 'yes',
			),
			"description" => esc_html__( "Select if you want your section height to be equal with the window height", 'osmosis' ),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'dropdown',
			"heading" => esc_html__( "Background Type", 'osmosis' ),
			"param_name" => "bg_type",
			"description" => esc_html__( "Select Background type", 'osmosis' ),
			"value" => array(
				esc_html__("None", 'osmosis' ) => '',
				esc_html__("Color", 'osmosis' ) => 'color',
				esc_html__("Image", 'osmosis' ) => 'image',
				esc_html__("Hosted Video", 'osmosis' ) => 'hosted_video',
				esc_html__( "YouTube Video", 'osmosis' ) => 'video',
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'YouTube link', 'osmosis' ),
			'param_name' => 'bg_video_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => esc_html__( 'Add YouTube link.', 'osmosis' ),
			'dependency' => array(
				'element' => 'bg_type',
				'value' => 'video',
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Custom Background Color", 'osmosis' ),
			"param_name" => "bg_color",
			"description" => esc_html__( "Select background color for your row", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'color' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => "attach_image",
			"heading" => esc_html__('Background Image', 'osmosis' ),
			"param_name" => "bg_image",
			"description" => esc_html__("Select background image for your row. Used also as fallback for video.", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video', 'video' )
			),
			"value" => '',
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Background Image Type", 'osmosis' ),
			"param_name" => "bg_image_type",
			"value" => array(
				esc_html__("Default", 'osmosis' ) => '',
				esc_html__("Fixed", 'osmosis' ) => 'fixed-bg',
				esc_html__("Parallax", 'osmosis' ) => 'parallax',
				esc_html__("Animated", 'osmosis' ) => 'animated'
			),
			"description" => esc_html__( "Select how a background image will be displayed", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Background Video Type", 'osmosis' ),
			"param_name" => "bg_video_type",
			"value" => array(
				esc_html__("Parallax", 'osmosis' ) => 'parallax',
				esc_html__("Normal", 'osmosis' ) => 'normal'
			),
			"description" => esc_html__( "Select how a background video will be displayed", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__("WebM File URL", 'osmosis'),
			"param_name" => "bg_video_webm",
			"description" => esc_html__( "Fill WebM and mp4 format for browser compatibility", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "MP4 File URL", 'osmosis' ),
			"param_name" => "bg_video_mp4",
			"description" => esc_html__( "Fill mp4 format URL", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "OGV File URL", 'osmosis' ),
			"param_name" => "bg_video_ogv",
			"description" => esc_html__( "Fill OGV format URL ( optional )", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Loop", 'osmosis' ),
			"param_name" => "bg_video_loop",
			"value" => array(
				esc_html__( "Yes", 'osmosis' ) => 'yes',
				esc_html__( "No", 'osmosis' ) => 'no',
			),
			"std" => 'yes',
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Allow on devices", 'osmosis' ),
			"param_name" => "bg_video_device",
			"value" => array(
				esc_html__( "No", 'osmosis' ) => 'no',
				esc_html__( "Yes", 'osmosis' ) => 'yes',

			),
			"std" => 'no',
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'hosted_video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Pattern overlay", 'osmosis'),
			"param_name" => "pattern_overlay",
			"description" => esc_html__( "If selected, a pattern will be added.", 'osmosis' ),
			"value" => Array(esc_html__( "Add pattern", 'osmosis' ) => 'yes'),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video', 'video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color overlay", 'osmosis' ),
			"param_name" => "color_overlay",
			"value" => array(
				esc_html__( "None", 'osmosis' ) => '',
				esc_html__( "Dark", 'osmosis' ) => 'dark',
				esc_html__( "Light", 'osmosis' ) => 'light',
				esc_html__( "Primary 1", 'osmosis' ) => 'primary-1',
				esc_html__( "Primary 2", 'osmosis' ) => 'primary-2',
				esc_html__( "Primary 3", 'osmosis' ) => 'primary-3',
				esc_html__( "Primary 4", 'osmosis' ) => 'primary-4',
				esc_html__( "Primary 5", 'osmosis' ) => 'primary-5',
			),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video', 'video'  )
			),
			"description" => esc_html__( "A color overlay for the media", 'osmosis' ),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Opacity overlay", 'osmosis' ),
			"param_name" => "opacity_overlay",
			"value" => array(
				esc_html__( "10%", 'osmosis' ) => '10',
				esc_html__( "20%", 'osmosis' ) => '20',
				esc_html__( "30%", 'osmosis' ) => '30',
				esc_html__( "40%", 'osmosis' ) => '40',
				esc_html__( "50%", 'osmosis' ) => '50',
				esc_html__( "60%", 'osmosis' ) => '60',
				esc_html__( "70%", 'osmosis' ) => '70',
				esc_html__( "80%", 'osmosis' ) => '80',
				esc_html__( "90%", 'osmosis' ) => '90',
			),
			"description" => esc_html__( "Opacity of the overlay", 'osmosis' ),
			"dependency" => array(
				'element' => 'bg_type',
				'value' => array( 'image', 'hosted_video', 'video' )
			),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Top padding", 'osmosis' ),
			"param_name" => "padding_top",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'osmosis' ),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Bottom padding", 'osmosis' ),
			"param_name" => "padding_bottom",
			"dependency" => array(
				'element' => 'section_full_height',
				'value' => array( 'no' )
			),
			"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'osmosis' ),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
		"type" => "textfield",
		"heading" => esc_html__( 'Bottom margin', 'osmosis' ),
		"param_name" => "margin_bottom",
		"description" => esc_html__( "You can use px, em, %, etc. or enter just number and it will use pixels.", 'osmosis' ),
		"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Header Section", 'osmosis' ),
			"param_name" => "header_feature",
			"description" => esc_html__( "Use this option if first section ( no gap from header )", 'osmosis' ),
			"value" => Array(esc_html__( "Header section", 'osmosis' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Footer Section", 'osmosis' ),
			"param_name" => "footer_feature",
			"description" => esc_html__( "Use this option if last section ( no gap from footer )", 'osmosis' ),
			"value" => Array(esc_html__( "Footer section", 'osmosis' ) => 'yes'),
			"group" => esc_html__( "Section Options", 'osmosis' ),
		)
	);

	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Desktop Visibility", 'osmosis'),
			"param_name" => "desktop_visibility",
			"description" => esc_html__( "If selected, row will be hidden on desktops/laptops.", 'osmosis' ),
			"value" => Array(esc_html__( "Hide", 'osmosis' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Landscape Visibility", 'osmosis'),
			"param_name" => "tablet_visibility",
			"description" => esc_html__( "If selected, row will be hidden on tablet devices with landscape orientation.", 'osmosis' ),
			"value" => Array(esc_html__( "Hide", 'osmosis' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Tablet Portrait Visibility", 'osmosis'),
			"param_name" => "tablet_sm_visibility",
			"description" => esc_html__( "If selected, row will be hidden on tablet devices with portrait orientation.", 'osmosis' ),
			"value" => Array(esc_html__( "Hide", 'osmosis' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'osmosis' ),
		)
	);
	vc_add_param( "vc_row",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Mobile Visibility", 'osmosis'),
			"param_name" => "mobile_visibility",
			"description" => esc_html__( "If selected, row will be hidden on mobile devices.", 'osmosis' ),
			"value" => Array(esc_html__( "Hide", 'osmosis' ) => 'hide'),
			'group' => esc_html__( "Responsiveness", 'osmosis' ),
		)
	);

	vc_add_param( "vc_column",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Width", 'osmosis' ),
			'param_name' => 'width',
			'value' => $grve_column_width_list,
			'group' => esc_html__( "Width & Responsiveness", 'osmosis' ),
			'description' => esc_html__( "Select column width.", 'osmosis' ),
			'std' => '1/1'
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'osmosis' ),
			"param_name" => "desktop_hide",
			"value" => $grve_column_desktop_hide_list,
			"description" => esc_html__( "Responsive column on desktops/laptops.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'osmosis' ),
			"param_name" => "tablet_width",
			"value" => $grve_column_width_tablet_list,
			"description" => esc_html__( "Responsive column on tablet devices with landscape orientation.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'osmosis' ),
			"param_name" => "tablet_sm_width",
			"value" => $grve_column_width_tablet_sm_list,
			"description" => esc_html__( "Responsive column on tablet devices with portrait orientation.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'osmosis' ),
			"param_name" => "mobile_width",
			"value" => $grve_column_mobile_width_list,
			"description" => esc_html__( "Responsive column on mobile devices.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);

	vc_add_param( "vc_column_inner",
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Width", 'osmosis' ),
			'param_name' => 'width',
			'value' => $grve_column_width_list,
			'group' => esc_html__( "Width & Responsiveness", 'osmosis' ),
			'description' => esc_html__( "Select column width.", 'osmosis' ),
			'std' => '1/1'
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Desktop", 'osmosis' ),
			"param_name" => "desktop_hide",
			"value" => $grve_column_desktop_hide_list,
			"description" => esc_html__( "Responsive column on desktops/laptops.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Landscape", 'osmosis' ),
			"param_name" => "tablet_width",
			"value" => $grve_column_width_tablet_list,
			"description" => esc_html__( "Responsive column on tablet devices with landscape orientation.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tablet Portrait", 'osmosis' ),
			"param_name" => "tablet_sm_width",
			"value" => $grve_column_width_tablet_sm_list,
			"description" => esc_html__( "Responsive column on tablet devices with portrait orientation.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);
	vc_add_param( "vc_column_inner",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Mobile", 'osmosis' ),
			"param_name" => "mobile_width",
			"value" => $grve_column_mobile_width_list,
			"description" => esc_html__( "Responsive column on mobile devices.", 'osmosis' ),
			'group' => esc_html__( 'Width & Responsiveness', 'osmosis' ),
		)
	);

	vc_add_param( "vc_tabs",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Tab Type", 'osmosis' ),
			"param_name" => "tab_type",
			"value" => array(
				esc_html__( "Horizontal", 'osmosis' ) => 'horizontal',
				esc_html__( "Vertical", 'osmosis' ) => 'vertical',
			),
			"description" => esc_html__( "Select tab type", 'osmosis' ),
		)
	);

	vc_add_param( "vc_tabs", $grve_add_margin_bottom );

	vc_add_param( "vc_accordion",
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( "Toggle", 'osmosis'),
			"param_name" => "toggle",
			"description" => esc_html__( "If selected, accordion will be displayed as toggle.", 'osmosis' ),
			"value" => Array(esc_html__( "Convert to toggle.", 'osmosis' ) => 'yes'),
		)
	);

	vc_add_param( "vc_accordion",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Initial State", 'osmosis' ),
			"param_name" => "initial_state",
			"admin_label" => true,
			"value" => array(
				esc_html__( "First Open", 'osmosis' ) => 'first',
				esc_html__( "All Closed", 'osmosis' ) => 'none',
			),
			"description" => esc_html__( "Accordion Initial State", 'osmosis' ),
		)
	);

	vc_add_param( "vc_accordion", $grve_add_margin_bottom );
	vc_add_param( "vc_accordion", $grve_add_el_class );

	vc_add_param( "vc_column_text",
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Text Style", 'osmosis' ),
			"param_name" => "text_style",
			"value" => array(
				esc_html__( "None", 'osmosis' ) => '',
				esc_html__( "Leader", 'osmosis' ) => 'leader-text',
				esc_html__( "Subtitle", 'osmosis' ) => 'subtitle',
			),
			"description" => esc_html__( "Select your text style", 'osmosis' ),
		)
	);
	vc_add_param( "vc_column_text", $grve_add_animation );
	vc_add_param( "vc_column_text", $grve_add_animation_delay );

	vc_add_param( "vc_widget_sidebar",
		array(
			'type' => 'hidden',
			'param_name' => 'title',
			'value' => '',
		)
	);

	if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.6', '>=') ) {

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tabs",
			array(
				'type' => 'hidden',
				'param_name' => 'tab_position',
				'value' => 'top',
			)
		);

		vc_add_param( "vc_tta_accordion",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill',
				'value' => '',
			)
		);

		vc_add_param( "vc_tta_tour",
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'value' => '',
			)
		);
	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
