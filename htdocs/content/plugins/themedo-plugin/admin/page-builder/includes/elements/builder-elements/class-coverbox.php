<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Coverbox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'coverbox_box';
			// element name
			$this->config['name']	 		= __('Cover Box', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Person Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_idcoverbox">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Cover Box', 'themedo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> __('Template', 'themedo-core'),
					  "desc"  			=> '',
					  "id" 				=> "avalon_td_template",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "alpha",
					  "allowedValues" 	=> array(
												'alpha' 			=> __('Alpha', 'themedo-core'),
												'beta' 				=> __('Beta', 'themedo-core'),
												'gamma' 			=> __('Gamma', 'themedo-core'),
												'delta' 			=> __('Delta', 'themedo-core'),
												'epsilon' 			=> __('Epsilon', 'themedo-core'),
												'zeta' 				=> __('Zeta', 'themedo-core'),
												'eta' 				=> __('Eta', 'themedo-core'),
												'theta' 			=> __('Theta', 'themedo-core'),
												) 
					  ),
				
				array("name" 			=> __('Skin', 'themedo-core'),
					  "desc"  			=> '',
					  "id" 				=> "avalon_td_skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array('light' 			=> __('Light', 'themedo-core'),
												 'dark' 			=> __('Dark', 'themedo-core')) 
					  ),	
				
				array("name" 			=> __('Max Width', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_width",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "max600",
					  "allowedValues" 	=> array(
												'max400' 				=> '400px',
												'max500' 				=> '500px',
												'max600' 				=> '600px',
												'max700' 				=> '700px',
												'max800' 				=> '800px',
												'max900' 				=> '900px',
												'max1000' 				=> '1000px',
											) 
					  ),
				
				array("name" 			=> __('Box Position', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_position",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "center",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'themedo-core'),
												 'right' 			=> __('Right', 'themedo-core'),
												 'center' 			=> __('Center', 'themedo-core')) 
					  ),	  
				array("name" 			=> __('Text Align', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_text_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "center",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'themedo-core'),
												 'right' 			=> __('Right', 'themedo-core'),
												 'center' 			=> __('Center', 'themedo-core')) 
					  ),
				
				array("name" 			=> __('Content', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
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
				);
		}
	}