<?php

	/**
	 * 4/5 layout category implementation, it extends DDElementTemplate like all other elements
	 */
	class avalon_td_GridFourFifth extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'grid_four_fifth';
			// element shortcode base
			$this->config['base'] = 'four_fifth';
			// element name
			$this->config['name'] = '4/5';
			// element icon
			$this->config['icon_url'] = "icons/four-fifth.png";
			// element icon class
			$this->config['icon_class'] = 'themedo-icon themedo-icon-grid-4-5';
			// css class related to this element
			$this->config['css_class'] = "avalon_td_layout_column grid_four_fifth item-container sort-container ";
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a single full (1/1) width column';
			// any special html data attribute (i.e. data-width) needs to be passed
			// width determine the ratio of them element related to its parent element in the editor, 
			// it's only important for layout elements.
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "floated_width" => "0.8", "width" => "4/5", "drop_level" => "3" );
		}

		// override default implemenation for this function as this element doesn't have any content.
		public function create_visual_editor( $params ) {

			$this->config['innerHtml'] = "";
		}

		//this function defines 4/5 sub elements or structure
		function popup_elements() {
			$animation_speed     = themedoHelper::get_animation_speed_data();
			$animation_direction = themedoHelper::get_animation_direction_data();
			$animation_type      = themedoHelper::get_animation_type_data();

			$this->config['layout_opt']  = true;
			$this->config['subElements'] = array(

				array(
					"name"          => __( 'Last Column', 'themedo-core' ),
					"desc"          => __( 'Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set.', 'themedo-core' ),
					"id"            => "last",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'themedo-core' ),
						'no'  => __( 'No', 'themedo-core' ),
					)
				),
				array(
					"name"          => __( 'Column Spacing', 'themedo-core' ),
					"desc"          => __( 'Set to "No" to eliminate margin between columns.', 'themedo-core' ),
					"id"            => "spacing",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'themedo-core' ),
						'no'  => __( 'No', 'themedo-core' ),
					)
				),
				array(
					"name"          => __( 'Center Content', 'themedo-core' ),
					"desc"          => __( 'Only works with columns inside a full width container that is set to equal heights. Set to "Yes" to center the content horizontally and vertically.', 'themedo-core' ),
					"id"            => "center_content",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'themedo-core' ),
						'no'  => __( 'No', 'themedo-core' ),
					)
				),
				array(
					"name"          => __( 'Hide on Mobile', 'themedo-core' ),
					"desc"          => __( 'Select "Yes" to hide column on mobile.', 'themedo-core' ),
					"id"            => "hide_on_mobile",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'no'  => __( 'No', 'themedo-core' ),
						'yes' => __( 'Yes', 'themedo-core' ),
					)
				),
				array(
					"name"  => __( 'Background Color', 'themedo-core' ),
					"desc"  => __( 'Controls the background color.', 'themedo-core' ),
					"id"    => "background_color",
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"  => __( 'Background Image', 'themedo-core' ),
					"desc"  => __( 'Upload an image to display in the background', 'themedo-core' ),
					"id"    => "background_image",
					"type"  => ElementTypeEnum::UPLOAD,
					"upid"  => "1",
					"value" => ""
				),
				array(
					"name"          => __( 'Background Repeat', 'themedo-core' ),
					"desc"          => __( 'Choose how the background image repeats.', 'themedo-core' ),
					"id"            => "background_repeat",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no-repeat",
					"allowedValues" => array(
						'no-repeat' => __( 'No Repeat', 'themedo-core' ),
						'repeat'    => __( 'Repeat Vertically and Horizontally', 'themedo-core' ),
						'repeat-x'  => __( 'Repeat Horizontally', 'themedo-core' ),
						'repeat-y'  => __( 'Repeat Vertically', 'themedo-core' )
					)
				),
				array(
					"name"          => __( 'Background Position', 'themedo-core' ),
					"desc"          => __( 'Choose the postion of the background image.', 'themedo-core' ),
					"id"            => "background_position",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "left top",
					"allowedValues" => array(
						'left top'      => __( 'Left Top', 'themedo-core' ),
						'left center'   => __( 'Left Center', 'themedo-core' ),
						'left bottom'   => __( 'Left Bottom', 'themedo-core' ),
						'right top'     => __( 'Right Top', 'themedo-core' ),
						'right center'  => __( 'Right Center', 'themedo-core' ),
						'right bottom'  => __( 'Right Bottom', 'themedo-core' ),
						'center top'    => __( 'Center Top', 'themedo-core' ),
						'center center' => __( 'Center Center', 'themedo-core' ),
						'center bottom' => __( 'Center Bottom', 'themedo-core' )
					)
				),
				array(
					"name"          => __( 'Border Position', 'themedo-core' ),
					"desc"          => __( 'Choose the postion of the border.', 'themedo-core' ),
					"id"            => "border_position",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "all",
					"allowedValues" => array(
						'all' => __('All', 'themedo-core'),
						'top' => __('Top', 'themedo-core'),
						'right' => __('Right', 'themedo-core'),
						'bottom' => __('Bottom', 'themedo-core'),
						'left' => __('Left', 'themedo-core')
					)
				),					
				array(
					"name"  => __( 'Border Size', 'themedo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'themedo-core' ),
					"id"    => "border_size",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0px"
				),
				array(
					"name"  => __( 'Border Color', 'themedo-core' ),
					"desc"  => __( 'Controls the border color.', 'themedo-core' ),
					"id"    => "border_color",
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"          => __( 'Border Style', 'themedo-core' ),
					"desc"          => __( 'Controls the border style.', 'themedo-core' ),
					"id"            => "border_style",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'solid'  => __( 'Solid', 'themedo-core' ),
						'dashed' => __( 'Dashed', 'themedo-core' ),
						'dotted' => __( 'Dotted', 'themedo-core' )
					)
				),
				array(
					"name"  => __( 'Padding', 'themedo-core' ),
					"desc"  => __( 'In pixels (px), ex: 10px.', 'themedo-core' ),
					"id"    => "padding",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "",
				),
				array(
					"name"  => __( 'Margin Top', 'themedo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'themedo-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'Margin Bottom', 'themedo-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'themedo-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"          => __( 'Animation Type', 'themedo-core' ),
					"desc"          => __( 'Select the type on animation to use on the shortcode', 'themedo-core' ),
					"id"            => "animation_type[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array(),
					"allowedValues" => $animation_type
				),
				array(
					"name"          => __( 'Direction of Animation', 'themedo-core' ),
					"desc"          => __( 'Select the incoming direction for the animation', 'themedo-core' ),
					"id"            => "animation_direction[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array(),
					"allowedValues" => $animation_direction
				),
				array(
					"name"          => __( 'Speed of Animation', 'themedo-core' ),
					"desc"          => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
					"id"            => "animation_speed[0]",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => array( '0.1' ),
					"allowedValues" => $animation_speed
				),
				array(
					"name"  => __( 'CSS Class', 'themedo-core' ),
					"desc"  => __( 'Add a class to the wrapping HTML element.', 'themedo-core' ),
					"id"    => "class",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'CSS ID', 'themedo-core' ),
					"desc"  => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' ),
					"id"    => "id",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
			);
		}
	}