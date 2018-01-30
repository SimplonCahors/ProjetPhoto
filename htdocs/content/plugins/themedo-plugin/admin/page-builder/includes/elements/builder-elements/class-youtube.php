<?php

	/**
	 * Youtube element implementation, it extends DDElementTemplate like all other elements
	 */
	class avalon_td_Youtube extends DDElementTemplate {
		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'video_youtube';
			// element shortcode base
			$this->config['base'] = 'youtube';
			// element name
			$this->config['name'] = __( 'Youtube', 'themedo-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] = "avalon_td_element_box";
			// element icon class
			$this->config['icon_class'] = 'themedo-icon builder-options-icon themedoa-youtube';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Video Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "4" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="avalon_td_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-youtube"></i><sub class="sub">' . __( 'Youtube', 'themedo-core' ) . '</sub><p class="youtube_url">http://www.youtube.com/LOfeCR7KqUs</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}

		//this function defines TextBlock sub elements or structure
		function popup_elements() {

			$reverse_choices = themedoHelper::get_reversed_choice_data();

			$this->config['subElements'] = array(

				array(
					"name"  => __( 'Video ID', 'themedo-core' ),
					"desc"  => "For example the Video ID for<br>http://www.youtube.com/LOfeCR7KqUs is <br>LOfeCR7KqUs",
					"id"    => "id",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'Width', 'themedo-core' ),
					"desc"  => __( 'In pixels but only enter a number, ex: 600', 'themedo-core' ),
					"id"    => "width",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "600"
				),
				array(
					"name"  => __( 'Height', 'themedo-core' ),
					"desc"  => __( 'In pixels but only enter a number, ex: 350', 'themedo-core' ),
					"id"    => "height",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "350"
				),
				array(
					"name"          => __( 'Autoplay Video', 'themedo-core' ),
					"desc"          => __( 'Set to yes to make video autoplaying', 'themedo-core' ),
					"id"            => "autoplay",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => $reverse_choices
				),
				array(
					"name"  => __( 'AdditionalAPI Parameter', 'themedo-core' ),
					"desc"  => __( 'Use additional API parameter, for example &rel=0 to disable related videos', 'themedo-core' ),
					"id"    => "api_params",
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
			);
		}
	}