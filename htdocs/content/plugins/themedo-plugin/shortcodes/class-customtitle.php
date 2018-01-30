<?php
class themedoSC_CustomTitle {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_customtitle-shortcode', array( $this, 'attr' ) );
		add_filter( 'avalon_td_attr_h3-shortcode', array( $this, 'h3_attr' ) );
		add_shortcode('customtitle', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'margin_top'	=> '',
				'margin_bottom'	=> '',
				'template' 		=> '',
				'size' 			=> '',
				'color' 		=> '',
				'text_align' 	=> '',
				'text_transform'=> '',
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

		self::$args = $defaults;

		
		$html = sprintf( '<div %s><h3 %s><span>%s</span></h3></div>', themedoCore_Plugin::attributes( 'customtitle-shortcode' ), themedoCore_Plugin::attributes( 'h3-shortcode' ), do_shortcode( $content ));		
		

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_custom_title';
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );	

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}
		
		$attr['data-temp'] = self::$args['template']; 
		$attr['data-size'] = self::$args['size']; 
		$attr['data-text-pos'] = self::$args['text_align']; 
		$attr['data-text-transform'] = self::$args['text_transform']; 
		$attr['data-color'] = self::$args['color']; 

		return $attr;

	}
	
	function h3_attr() {

		$attr = array();

		$attr['class'] = 'custom_title';
		
		$attr['style'] = sprintf( 'color:%s', self::$args['color'] );

		return $attr;

	}

}

new themedoSC_CustomTitle();