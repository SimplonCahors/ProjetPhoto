<?php
class themedoSC_Coverbox {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_coverbox-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'coverbox', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'template'					=> '',
				'skin'						=> '',
				'width'						=> '',
				'position'					=> '',
				'text_align'				=> '',
				'class'						=> '',			
				'id'						=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				
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

		
		
		$html = sprintf( '<div class="avalon_td_cover_box_wrap"><div %s><div class="avalon_td_in"><div>%s</div></div></div></div>', themedoCore_Plugin::attributes( 'coverbox-shortcode' ), do_shortcode($content) );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_cover_box';

		if( self::$args['width'] ) {
			$attr['class'] .= ' ' . self::$args['width']; 
		}
		
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}
		
		$attr['data-temp'] = self::$args['template']; 
		$attr['data-skin'] = self::$args['skin']; 
		$attr['data-x-pos'] = self::$args['position']; 
		$attr['data-text-pos'] = self::$args['text_align']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

	

}

new themedoSC_Coverbox();