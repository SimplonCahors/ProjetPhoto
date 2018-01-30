<?php
/**
 * CounterBox implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_CounterBox extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'counter_box';
			// element name
			$this->config['name']	 		= __('Counter Box', 'themedo-core');
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
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_counter_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Counter Box', 'themedo-core').'</sub><p>columns = <font class="counter_box_columns">5</font></p></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$no_of_columns 				= themedoHelper::avalon_td_create_dropdown_data(1,6);
			$choices					= themedoHelper::get_shortcode_choices();
			
	  $am_array = array();
	  $am_array[] = array ( 
							array( 		"name"	 	=> __('Counter Value', 'themedo-core'),
										"desc"		=> __('The number to which the counter will animate.', 'themedo-core'),
										"id"		=> "avalon_td_value[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("") 
							),
							
							array( 		"name"	 	=> __('Counter Starting Value', 'themedo-core'),
										"desc"		=> __('The number to which the counter starts.', 'themedo-core'),
										"id"		=> "avalon_td_start[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("0") 
							),
							
							array( 		"name"	 	=> __('Counter Speed', 'themedo-core'),
										"id"		=> "avalon_td_speed[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("2000") 
							),

						  	array( 		"name"	 	=> __('Counter Box Text', 'themedo-core'),
										"desc"		=> __('Insert text for counter box', 'themedo-core'),
										"id"		=> "avalon_td_content[0]",
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
				array(
					"name" 				=> __('Number of Columns', 'themedo-core'),
					"desc" 				=> __('Set the number of columns per row.', 'themedo-core'),
					"id" 				=> "avalon_td_columns",
					"type" 				=> ElementTypeEnum::SELECT,
					"value" 			=> "4",
					"allowedValues" 	=> $no_of_columns 
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