<?php

	/**
	 * One 3/4 category implementation, it extends DDElementTemplate like all other elements
	 */
	class avalon_td_GridThreeFourth extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'grid_three_four';
			// element shortcode base
			$this->config['base'] = 'three_fourth';
			// element name
			$this->config['name'] = '3/4';
			// element icon
			$this->config['icon_url'] = "icons/sc-three-forth.png";
			// element icon class
			$this->config['icon_class'] = 'themedo-icon themedo-icon-grid-3-4';
			// css class related to this element
			$this->config['css_class'] = "avalon_td_layout_column grid_three_fourth item-container sort-container ";
			// tooltip that will be displyed upon mouse over the element
			////$this->config['tool_tip']  		= 'Creates a single full (3/4) width column';
			// any special html data attribute (i.e. data-width) needs to be passed
			// width determine the ratio of them element related to its parent element in the editor, 
			// it's only important for layout elements.
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "floated_width" => "0.75", "width" => "3/4", "drop_level" => "3" );
		}

		// override default implemenation for this function as this element doesn't have any content.
		public function create_visual_editor( $params ) {

			$this->config['innerHtml'] = "";
		}

		//this function defines 3/4 sub elements or structure
		function popup_elements() {

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
					"name"  => __( 'Margin Top', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0px",
				),
				array(
					"name"  => __( 'Margin Bottom', 'themedo-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0px",
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