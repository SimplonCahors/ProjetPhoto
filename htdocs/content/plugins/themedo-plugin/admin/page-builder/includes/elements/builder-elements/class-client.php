<?php
/**
 * Testimonial element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Client extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'client_box';
			// element name
			$this->config['name']	 		= __('Clients', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Testimonial Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_client">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Clients', 'themedo-core').'</sub><ul class="client_content"><li></li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
		
		$reverse_choices			= themedoHelper::get_reversed_choice_data();

	 	$am_array = array();
	  	$am_array[] = array (
							array(
										"name"  	=> 	__( 'Client Link', 'themedo-core' ),
										"desc"  	=> 	__( 'Set client url', 'themedo-core' ),
										"id"    	=> 	"avalon_td_link[0]",
										"type"  	=> 	ElementTypeEnum::INPUT,
										"value" 	=> 	"",
							),
							array(		"name"		=> 	__('Image', 'themedo-core'),
										"desc"		=> 	__('Insert the image', 'themedo-core'),
										"id"		=> 	"avalon_td_image[0]",
										"type"		=> 	ElementTypeEnum::UPLOAD, 
										"upid"		=> 	1,
									  	"value"	    => 	''
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
				
				array(
					"name"  => __( 'Client Template', 'themedo-core' ),
					//"desc"  => __( '', 'themedo-core' ),
					"id"    => "client_type",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "b",
					"allowedValues" => array(
						'a' 	=> 'A',
						'b'    	=> 'B',
						'c'    	=> 'C',
						'd'    	=> 'D',
						'e'    	=> 'E',
					)
				),
				array(
					"name"  => __( 'Client Columns', 'themedo-core' ),
					//"desc"  => __( '', 'themedo-core' ),
					"id"    => "client_col",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "5",
					"allowedValues" => array(
						'1' 		=> '1',
						'2' 		=> '2',
						'3' 		=> '3',
						'4' 		=> '4',
						'5' 		=> '5',
						'6' 		=> '6',
					)
				),
				array(
					"name"  => __( 'Color', 'themedo-core' ),
					//"desc"  => __( 'In milliseconds, ex: 4000.', 'themedo-core' ),
					"id"    => "client_color",
					"type"  => ElementTypeEnum::COLOR,
					"value" => "#000000",
				),
				array(
					"name"  => __( 'Color Transparency', 'themedo-core' ),
					//"desc"  => __( '', 'themedo-core' ),
					"id"    => "client_opacity",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "0.9",
					"allowedValues" => array(
						'0' 		=> '0',
						'0.1' 		=> '0.1',
						'0.2' 		=> '0.2',
						'0.3' 		=> '0.3',
						'0.4' 		=> '0.4',
						'0.5' 		=> '0.5',
						'0.6' 		=> '0.6',
						'0.7' 		=> '0.7',
						'0.8' 		=> '0.8',
						'0.9' 		=> '0.9',
						'1' 		=> '1',
					)
				),
				
				array(
					"name"  => __( 'Margin Top', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Margin Bottom', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
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
					  "buttonText"		=> __('Add More', 'themedo-core'),
					  "id"				=> "am_avalon_td_gallery",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}