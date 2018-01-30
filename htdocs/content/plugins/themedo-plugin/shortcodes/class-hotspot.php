<?php
class themedoSC_Hotspot {

	public static $parent_args;
	public static $child_args;
	private $hotspot_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_hotspots-shortcode', array( $this, 'parent_attr' ) );
		add_filter( 'avalon_td_attr_hotspot-shortcode', array( $this, 'child_attr' ) );
		
		
		add_shortcode( 'hotspots', array( $this, 'render_parent' ) );
		add_shortcode( 'hotspot', array( $this, 'render_child' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '' ) {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'				=> '',			
				'id'				=> '',
				'image'				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}
		
		extract( $defaults );
 
		self::$parent_args = $defaults;
		
		
		// image
		$img_url 	= self::$parent_args['image'];
		$image 	= '<img src="'.$img_url.'" alt="hotspot" />';
		
		
		
		$html = sprintf( '<div %s><div class="avalon_td_hotspot_container">%s %s</div><div class="avalon_td_hotspot_desc"><ul></ul></div></div>', themedoCore_Plugin::attributes( 'hotspots-shortcode' ), do_shortcode( $content ), $image);

		return $html;

	}

	function parent_attr() {

		$attr['class'] = 'avalon_td_hotspot_container_wrap';

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );

		return $attr;

	}



	/**
	 * Render the child shortcode
	 * 
	 * @param  array  $args	 Shortcode paramters
	 * @param  string $content  Content between shortcode
	 * @return string		   HTML output
	 */
	function render_child( $args, $content = '' ) {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'top'			=> '',
				'left'			=> '',
				'skin'			=> '',
				'rounded'		=> '',
				'tooltip'		=> '',
				'position'		=> '',
				'title'			=> '',
			), $args
		);
		
		// check: has "%" or not. if not: add "%"
		if( strpos( $defaults['top'], '%' ) === false) {$defaults['top'] = $defaults['top'] . '%';}
		if( strpos( $defaults['left'], '%' ) === false) {$defaults['left'] = $defaults['left'] . '%';}

		extract( $defaults );

		self::$child_args = $defaults;


		$html = sprintf( '<div %s><span>%s</span></div>', themedoCore_Plugin::attributes( 'hotspot-shortcode' ), $this->hotspot_counter );
		
		$this->hotspot_counter++;

		return $html;

	}
	
	function child_attr() {

		$attr['class'] = 'avalon_td_hotspot';

		$attr['data-top'] = self::$child_args['top'];
		$attr['data-left'] = self::$child_args['left'];
		$attr['data-hs-skin'] = self::$child_args['skin'];
		$attr['data-round'] = self::$child_args['rounded'];
		$attr['data-hs-tooltip'] = self::$child_args['tooltip'];
		$attr['data-hs-tooltip-pos'] = self::$child_args['position'];
		$attr['title'] = self::$child_args['title'];

		return $attr;

	}

}

new themedoSC_Hotspot();
