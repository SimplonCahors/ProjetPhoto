<?php
/**
 * CounterBox implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Hotspot extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'hotspot';
			// element name
			$this->config['name']	 		= __('Hotspot', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Counter Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_hotspot">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Hotspot', 'themedo-core').'</sub><ul class="list_elements"><li>List</li></ul></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$no_of_columns 				= themedoHelper::avalon_td_create_dropdown_data(1,6);
			$choices					= themedoHelper::get_shortcode_choices();
			
	  $am_array = array();
	  $am_array[] = array ( 
							array( 		"name"	 	=> __('Top Spacing', 'themedo-core'),
										"desc"		=> __('Insert space in percent. Make sure it isn\'t higher than 100%', 'themedo-core'),
										"id"		=> "avalon_td_top[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("0%") 
							),
							array( 		"name"	 	=> __('Left Spacing', 'themedo-core'),
										"desc"		=> __('Insert space in percent. Make sure it isn\'t higher than 100%', 'themedo-core'),
										"id"		=> "avalon_td_left[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("0%") 
							),
							array( 		"name"	 	=> __('Skin', 'themedo-core'),
										"desc"		=> __('', 'themedo-core'),
										"id"		=> "avalon_td_skin[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("light"),
										"allowedValues"   => array( 'light'		=> "Light",
												 					'dark'	 	=> "Dark",
																  ) 
							),
							array( 		"name"	 	=> __('Rounded', 'themedo-core'),
										"desc"		=> __('', 'themedo-core'),
										"id"		=> "avalon_td_rounded[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("off"),
										"allowedValues"   => array( 'a'		=> "A",
												 					'b'	 	=> "B",
																	'off'	=> "Off",
																  ) 
							),
							array( 		"name"	 	=> __('Tooltip', 'themedo-core'),
										"desc"		=> __('', 'themedo-core'),
										"id"		=> "avalon_td_tooltip[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("open"),
										"allowedValues"   => array( 'open'		=> "Open",
												 					'hover'	 	=> "on Hover",
																	'click'	 	=> "on Click",
																  ) 
							),
							array( 		"name"	 	=> __('Position', 'themedo-core'),
										"desc"		=> __('', 'themedo-core'),
										"id"		=> "avalon_td_position[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("w"),
										"allowedValues"   => array( 'n'			=> "North",
												 					's'	 		=> "South",
																	'e'	 		=> "East",
																	'w'	 		=> "West",
																	'nw'	 	=> "North-West",
																	'ne'	 	=> "North-East",
																	'sw'	 	=> "South-West",
																	'se'	 	=> "South-East",
																  ) 
							),
						  	array( 		"name"	 	=> __('Title', 'themedo-core'),
										"desc"		=> __('', 'themedo-core'),
										"id"		=> "avalon_td_title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("Text") 
							)
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
				array("name" 			=> __('Hotspot Image', 'themedo-core'),
					  "desc" 			=> __('', 'themedo-core'),
					  "id" 				=> "avalon_td_image",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
				),
				array(
					"name"  			=> __( 'Margin Top', 'themedo-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> __( 'Margin Bottom', 'themedo-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
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
					  "buttonText"		=> __('Add New Counter Box', 'themedo-core'),
					  "id"				=> "cb_avalon_td_box",
					  "elements" 		=> $am_array
											
					  )
				);
		}
	}