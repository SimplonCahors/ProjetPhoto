<?php
/**
 * Title element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_CustomTitle extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'title_box';
			// element name
			$this->config['name']	 		= __('Custom Title', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Title Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_idcustomtitle">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><sub class="title_text align_right">'.__('Custom Title', 'themedo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$title_data = themedoHelper::avalon_td_create_dropdown_data(1, 6);
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Title', 'themedo-core'),
					  "desc"			=> __('Insert the title text', 'themedo-core'),
					  "id" 				=> "avalon_td_title_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Template', 'themedo-core'),
					  "desc" 			=> '',
					  "id" 				=> "avalon_td_template",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "alpha",
					  "allowedValues" 	=> array(
												'alpha' 	=> __('Alpha', 'themedo-core'),
											   	'beta' 		=> __('Beta', 'themedo-core'),)
					  ),
				array("name" 			=> __('Size', 'themedo-core'),
					  "desc" 			=> '',
					  "id" 				=> "avalon_td_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "size3",
					  "allowedValues" 	=> array(
												'size1' => __('H1', 'themedo-core'),
											   	'size2' => __('H2', 'themedo-core'),
											   	'size3' => __('H3', 'themedo-core'),
											   	'size4' => __('H4', 'themedo-core'),
											   	'size5' => __('H5', 'themedo-core'),
												'size6' => __('H6', 'themedo-core'),)
					  ),
				array("name" 			=> __('Text Transform', 'themedo-core'),
					  "desc" 			=> '',
					  "id" 				=> "avalon_td_transform",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "uppercase",
					  "allowedValues" 	=> array(
												'uppercase' 	=> __('Uppercase', 'themedo-core'),
											   	'lowercase' 	=> __('Lovercase', 'themedo-core'),
											   	'capitalize' 	=> __('Capitalize', 'themedo-core'),)
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
					  
				array("name" 			=> __('Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the background color for custom alert boxes.', 'themedo-core'),
					  "id" 				=> "avalon_td_title_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Top Margin', 'themedo-core'),
					  "desc"			=> __('Spacing above the title. In px or em, e.g. 10px.', 'themedo-core'),
					  "id" 				=> "margin_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Bottom Margin', 'themedo-core'),
					  "desc"			=> __('Spacing below the title. In px or em, e.g. 10px.', 'themedo-core'),
					  "id" 				=> "margin_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
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