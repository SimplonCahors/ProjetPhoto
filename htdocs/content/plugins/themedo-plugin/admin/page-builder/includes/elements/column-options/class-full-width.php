<?php

	/**
	 * FullWidthContainer implementation, it extends DDElementTemplate like all other elements
	 */
	class avalon_td_FullWidthContainer extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		public function deprecated_args( $args ) {


			$toChange = array(
				'backgroundposition'    => 'background_position',
				'backgroundcolor'       => 'background_color',
				'backgroundattachment'  => 'background_parallax',
				'background_attachment' => 'background_parallax',
				'paddingtop'            => 'padding_top',
				'paddingbottom'         => 'padding_bottom',
				'backgroundcolor'       => 'background_color',
				'backgroundimage'       => 'background_image',
				'backgroundrepeat'      => 'background_repeat',
			);
			foreach ( $toChange as $old => $new ) {
				if ( isset( $args[ $old ] ) && ! empty( $args[ $old ] ) ) {
					if ( ! isset( $args[ $new ] ) || ( isset( $args[ $new ] ) && empty( $args[ $new ] ) && ! empty( $args[ $old ] ) ) ) {
						$args[ $new ] = $args[ $old ];
						unset( $args[ $old ] );
					}
				}
			}

			return $args;
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'full_width_container';
			// element shortcode base
			$this->config['base'] = 'fullwidth';
			// element name
			$this->config['name'] = __( 'Full Width Container', 'themedo-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-icon_box.png";
			// css class related to this element
			$this->config['css_class'] = "item-wrapper avalon_td_full_width sortable-element drag-element avalon_td_layout_column avalon_td_full_width item-container sort-container ui-draggable";
			// element icon class
			$this->config['icon_class'] = 'themedo-icon builder-options-icon xcon-th';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates a Full Width Container';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "2" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="avalon_td_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="icon-move-horizontal"></i><sub class="sub">Full Width Container</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = '';
		}

		//this function defines FullWidth sub elements or structure
		function popup_elements() {
			$this->config['layout_opt'] = true;
			$border_size                = themedoHelper::avalon_td_create_dropdown_data( 1, 10 );
			$padding_data               = themedoHelper::avalon_td_create_dropdown_data( 1, 100 );
			$rate               		= themedoHelper::avalon_td_create_dropdown_data( 1, 100 );
			$rate2               		= themedoHelper::avalon_td_create_dropdown_data( 0, 1 );
			$number_rate 				= array(
											'0'   => '0',
											'0.1' => '0.1',
											'0.2' => '0.2',
											'0.3' => '0.3',
											'0.4' => '0.4',
											'0.5' => '0.5',
											'0.6' => '0.6',
											'0.7' => '0.7',
											'0.8' => '0.8',
											'0.9' => '0.9',
											'1'   => '1' 
										);
			
			
			

			$this->config['subElements'] = array(
				array(
					"name"          => __( 'Content Min Height', 'themedo-core' ),
					"desc"          => __( '', 'themedo-core' ),
					"id"            => "min_height",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "disable",
					"allowedValues" => array(
						'enable' 	=> __( 'Full Screen', 'themedo-core' ),
						'disable'  	=> __( 'Auto', 'themedo-core' ),
						'h100'  	=> 100,
						'h200'  	=> 200,
						'h300'  	=> 300,
						'h400'  	=> 400,
						'h500'  	=> 500,
						'h600'  	=> 600,
						'h700'  	=> 700,
						'h800'  	=> 800,
						'h900'  	=> 900,
						'h1000'  	=> 1000,
					)
				),
				array(
					"name"          => __( 'Content Layout', 'themedo-core' ),
					"desc"          => __( '', 'themedo-core' ),
					"id"            => "content_layout",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "contained",
					"allowedValues" => array(
						'contained' => __( 'Contained', 'themedo-core' ),
						'full'  	=> __( 'Full', 'themedo-core' ),
					)
				),
				array(
					"name"          => __( 'Content Color', 'themedo-core' ),
					"desc"          => __( '', 'themedo-core' ),
					"id"            => "content_color",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "light",
					"allowedValues" => array(
						'light' => __( 'Light', 'themedo-core' ),
						'dark'  => __( 'Dark', 'themedo-core' ),
					)
				),
				array(
					"name"  => __( 'Background Color', 'themedo-core' ),
					"desc"  => __( 'Controls the background color. Leave blank for theme option selection.', 'themedo-core' ),
					"id"    => "background_color",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"  => __( 'Background Color Transparency', 'themedo-core' ),
					"desc"  => __( 'Value should be between 0.1 and 1.0.', 'themedo-core' ),
					"id"    => "background_color_rate",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"allowedValues" => $number_rate,
					"value" => "0.4"
				),
				array(
					"name"          => __( 'Background Type', 'themedo-core' ),
					"desc"  		=> __( '', 'themedo-core' ),
					"id"            => "background_type",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'themedo-core' ),
					"value"         => "parallax",
					"allowedValues" => array(
						'parallax'      => __( 'Parallax', 'themedo-core' ),
						'video'   		=> __( 'Video', 'themedo-core' ),
						'bgslide'   	=> __( 'BG Slide', 'themedo-core' ),
						'image'   		=> __( 'Image', 'themedo-core' ),
					)
				),
				array(
					"name"  => __( 'Background Image', 'themedo-core' ),
					"desc"  => __( 'Upload an image to display in the background', 'themedo-core' ),
					"id"    => "background_image",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::UPLOAD,
					"data"  => array(
						"replace" => "themedo-hidden-img"
					),
					"upid"  => "1",
					"value" => ""
				),			
				array(
					"name"          => __( 'Background Repeat', 'themedo-core' ),
					"desc"          => __( 'Choose how the background image repeats.', 'themedo-core' ),
					"id"            => "background_repeat",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'themedo-core' ),
					"value"         => "repeat",
					"allowedValues" => array(
						'no-repeat' => __( 'No Repeat', 'themedo-core' ),
						'repeat'    => __( 'Repeat Vertically and Horizontally', 'themedo-core' ),
						'repeat-x'  => __( 'Repeat Horizontally', 'themedo-core' ),
						'repeat-y'  => __( 'Repeat Vertically', 'themedo-core' )
					)
				),
				array(
					"name"          => __( 'Background Position', 'themedo-core' ),
					"desc"          => __( 'Choose the postion of the background image', 'themedo-core' ),
					"id"            => "background_position",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'themedo-core' ),
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
					"name"  => __( 'Video Url', 'themedo-core' ),
					"desc"  => '',
					"id"    => "video_url",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "",
				),
				
				array(
					"name"  => __( 'BG Slide Direction', 'themedo-core' ),
					"desc"  => __( '', 'themedo-core' ),
					"id"    => "bgslide_direction",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "hor",
					"allowedValues" => array(
											'hor' => __('Horizontal', 'themedo-core'),
											'ver' => __('Vertical', 'themedo-core'),
											'both' => __('Both Direction', 'themedo-core'),
										),
				),
				array(
					"name"  => __( 'BG Slide: Reverse X axis', 'themedo-core' ),
					"desc"  => __( '', 'themedo-core' ),
					"id"    => "bgslide_xaxis",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "0",
					"allowedValues" => $rate2,
				),
				array(
					"name"  => __( 'BG Slide: Reverse Y axis', 'themedo-core' ),
					"desc"  => __( '', 'themedo-core' ),
					"id"    => "bgslide_yaxis",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "0",
					"allowedValues" => $rate2,
			    ),
				
				array(
					"name"  => __( 'BG Slide Rate', 'themedo-core' ),
					"desc"  => __( '', 'themedo-core' ),
					"id"    => "bgslide_rate",
					"group" => __( 'Background', 'themedo-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "30",
					"allowedValues" => $rate,
			    ),
				array(
					"name"  => __( 'Margin Top', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_top",
					"group" => __( 'Design', 'themedo-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Margin Bottom', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_bottom",
					"group" => __( 'Design', 'themedo-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Padding Top', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "padding_top",
					"group" => __( 'Design', 'themedo-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "150px",
				),
				array(
					"name"  => __( 'Padding Bottom', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "padding_bottom",
					"group" => __( 'Design', 'themedo-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "150px",
				),
				array(
					"name"  => __( 'Menu Anchor', 'themedo-core' ),
					"desc"  => __( 'Just insert unique text(id)', 'themedo-core' ),
					"id"    => "menu_anchor",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
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