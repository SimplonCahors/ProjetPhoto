<?php
/**
 * Flip Boxes implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_FlipBoxes extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'flip_boxes';
			// element name
			$this->config['name']	 		= __('Flip Boxes', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-loop-alt2';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Elastic Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_flip_boxs">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-loop-alt2"></i><sub class="sub">'.__('Flip Boxes', 'themedo-core').'</sub><p>columns = <font class="flip_boxes_columns">5</font></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$no_of_columns 				= themedoHelper::avalon_td_create_dropdown_data( 1 , 6 );
			$border_size 				= themedoHelper::avalon_td_create_dropdown_data( 0, 10 );
			$reverse_choices			= themedoHelper::get_reversed_choice_data();
			$animation_speed 			= themedoHelper::get_animation_speed_data();
			$animation_direction 		= themedoHelper::get_animation_direction_data();
			$animation_type 			= themedoHelper::get_animation_type_data();
			$choices					= themedoHelper::get_shortcode_choices();

			$am_array = array();

			$am_array[] = array ( 
													array("name" 			=> __('Flip Box Frontside Heading', 'themedo-core'),
					  								"desc" 					=> __('Add a heading for the frontside of the flip box.', 'themedo-core'),
					  								"id" 					=> "avalon_td_titlefront[0]",
					  								"type" 					=> ElementTypeEnum::INPUT,
					  								"value" 				=> array ("Your Content Goes Here")
					  								),
													array("name" 			=> __('Flip Box Backside Heading', 'themedo-core'),
					  								"desc" 					=> __('Add a heading for the backside of the flip box.', 'themedo-core'),
					  								"id" 					=> "avalon_td_titleback[0]",
					  								"type" 					=> ElementTypeEnum::INPUT,
					  								"value" 				=> array ("Your Content Goes Here")
					  								),
													array( "name" 			=> __('Flip Box Frontside Content', 'themedo-core'),
					  							  	"desc"					=> __('Add content for the frontside of the flip box.', 'themedo-core'),
					  							  	"id" 					=> "avalon_td_text_front[0]",
					  							  	"type" 					=> ElementTypeEnum::INPUT,
					  							  	"value" 				=> array("Your Content Goes Here") 
					  								),
													array( "name" 			=> __('Flip Box Backside Content', 'themedo-core'),
					  							  	"desc"					=> __('Add content for the backside of the flip box.', 'themedo-core'),
					  							  	"id" 					=> "avalon_td_content_wp[0]",
					  							  	"type" 					=> ElementTypeEnum::HTML_EDITOR,
					  							  	"value" 				=> array("Your Content Goes Here") 
					  								),
													array("name" 			=> __('Background Color Frontside', 'themedo-core'),
					  								"desc" 					=> __('Controls the background color of the frontside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'themedo-core'),
					  								"id" 					=> "avalon_td_backgroundcolorfront[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Heading Color Frontside', 'themedo-core'),
					  								"desc" 					=> __('Controls the heading color of the frontside. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_titlecolorfront[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Text Color Frontside', 'themedo-core'),
					  								"desc" 					=> __('Controls the text color of the frontside. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_textcolorfront[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Background Color Backside', 'themedo-core'),
					  								"desc" 					=> __('Controls the background color of the backside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'themedo-core'),
					  								"id" 					=> "avalon_td_backgroundcolorback[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Heading Color Backside', 'themedo-core'),
					  								"desc" 					=> __('Controls the heading color of the backside. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_titlecolorback[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Text Color Backside', 'themedo-core'),
					  								"desc" 					=> __('Controls the text color of the backside. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_textcolorback[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ()
					  								),
													array("name" 			=> __('Border Size', 'themedo-core'),
													"desc" 					=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core'),
													"id" 					=> "avalon_td_bordersize[0]",
													"type" 					=> ElementTypeEnum::INPUT,
													"value" 				=> array("1px"),
													),
													array("name" 			=> __('Border Color', 'themedo-core'),
					  								"desc" 					=> __('Controls the border color. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_bordercolor[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ("")
					  								),
													array("name" 			=> __('Border Radius', 'themedo-core'),
					  								"desc" 					=> __('Controls the flip box border radius. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_borderradius[0]",
					  								"type" 					=> ElementTypeEnum::INPUT,
					  								"value" 				=> array ("4px")
					  								),
													array("name" 			=> __('Icon', 'themedo-core'),
					  								"desc" 					=> __('Click an icon to select, click again to deselect.', 'themedo-core'),
					  								"id" 					=> "avalon_td_icon[0]",
					  								"type" 					=> ElementTypeEnum::ICON_BOX,
					  								"value" 				=> array (""),
					  								"list"					=> themedoHelper::GET_ICONS_LIST()
					  								),
													array("name" 			=> __('Icon Color', 'themedo-core'),
					  								"desc" 					=> __('Controls the color of the icon. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_iconcolor[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ("")
					  								),
													array("name" 			=> __('Icon Circle', 'themedo-core'),
													  "desc" 				=> __('Choose to use a circled background on the icon.', 'themedo-core'),
													  "id" 					=> "avalon_td_circle[0]",
													  "type" 				=> ElementTypeEnum::SELECT,
													  "value" 				=> array( "yes"),
													  "allowedValues" 		=> $choices 
													  ),
													array("name" 			=> __('Icon Circle Background Color', 'themedo-core'),
					  								"desc" 					=> __('Controls the color of the circle. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_circlecolor[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ("")
					  								),
													
													array("name" 			=> __('Icon Circle Border Color', 'themedo-core'),
					  								"desc" 					=> __('Controls the color of the circle border. Leave blank for theme option selection.', 'themedo-core'),
					  								"id" 					=> "avalon_td_circlebordercolor[0]",
					  								"type" 					=> ElementTypeEnum::COLOR,
					  								"value" 				=> array ("")
					  								),
													array("name" 			=> __('Rotate Icon', 'themedo-core'),
													"desc" 					=> __('Choose to rotate the icon.', 'themedo-core'),
													"id" 					=> "avalon_td_rotate[0]",
													"type" 					=> ElementTypeEnum::SELECT,
													"value" 				=> "",
													"allowedValues" 		=> array('' 			=>'None',
																					'90' 			=>'90',
																					'180' 			=> '180',
																					'270'			=> '270')
													),
													array("name" 			=> __('Spinning Icon', 'themedo-core'),
													  "desc" 				=> __('Choose to let the icon spin.', 'themedo-core'),
													  "id" 					=> "avalon_td_iconspin[0]",
													  "type" 				=> ElementTypeEnum::SELECT,
													  "value" 				=> array( "no" ),
													  "allowedValues" 		=> $reverse_choices 
													  ),
													  array("name" 			=> __('Icon Image', 'themedo-core'),
					  									"desc" 				=> __('To upload your own icon image, deselect the icon above and then upload your icon image.', 'themedo-core'),
					  									"id" 				=> "avalon_td_image[0]",
					  									"type" 				=> ElementTypeEnum::UPLOAD,
					  									"upid" 				=> array(1),
					  									"value" 			=> array("")
					  								),
													array("name" 			=> __('Icon Image Width', 'themedo-core'),
					  									"desc" 				=> __('If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'themedo-core'),
					  									"id" 				=> "avalon_td_image_width[0]",
					  									"type" 				=> ElementTypeEnum::INPUT,
					  									"value" 			=> array ("35")
					  								),
													array("name" 			=> __('Icon Image Height', 'themedo-core'),
					  									"desc" 				=> __('If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'themedo-core'),
					  									"id" 				=> "avalon_td_image_height[0]",
					  									"type" 				=> ElementTypeEnum::INPUT,
					  									"value" 			=> array ("35")
					  								),
													array("name" 			=> __('Animation Type', 'themedo-core'),
													"desc" 					=> __('Select the type of animation to use on the shortcode.', 'themedo-core'),
													"id" 					=> "avalon_td_animation_type[0]",
													"type" 					=> ElementTypeEnum::SELECT,
													"value" 				=> array(""),
													"allowedValues" 		=> $animation_type
													),
													array("name" 			=> __('Direction of Animation', 'themedo-core'),
													"desc" 					=> __('Select the incoming direction for the animation.', 'themedo-core'),
													"id" 					=> "avalon_td_animation_direction[0]",
													"type" 					=> ElementTypeEnum::SELECT,
													"value" 				=> array(""),
													"allowedValues" 		=> $animation_direction
													),
													array("name" 			=> __('Speed of Animation', 'themedo-core'),
													"desc" 					=> __('Type in speed of animation in seconds (0.1 - 1).', 'themedo-core'),
													"id" 					=> "avalon_td_animation_speed[0]",
													"type" 					=> ElementTypeEnum::SELECT,
													"value" 				=> array(""),
													"allowedValues" 		=> $animation_speed
													),
													
											);

			$this->config['defaults'] = $am_array[0];

			if($am_elements) {
			  $am_array_copy = $am_array[0];
			  $am_array = array();
			  foreach($am_elements as $key => $am_element) {
				$build_am = $am_array_copy;
				foreach($build_am as $build_am_key => $build_am_element) {
				  $build_am[$build_am_key]['value'] = $am_elements[$key][$build_am_key];
				  $build_am[$build_am_key]['id'] = str_replace('[0]', '[' . $key . ']', $build_am_element['id']);
				}
				$am_array[] = $build_am;
			  }
			}

			$this->config['subElements'] = array(
			
				array("name" 			=> __('Number of Columns', 'themedo-core'),
					  "desc" 			=> __('Set the number of columns per row.', 'themedo-core'),
					  "id" 				=> "avalon_td_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "1",
					  "allowedValues" 	=> $no_of_columns
					  ),
					  
				array("name" 			=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS ID', 'themedo-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("type" 			=> ElementTypeEnum::ADDMORE,
					  "buttonText"		=> __('Add New Flip Box', 'themedo-core'),
					  "id"				=> "am_avalon_td_content",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}