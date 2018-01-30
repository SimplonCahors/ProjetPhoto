<?php
class themedoSC_WorkStep {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_workstep-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'workstep', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'step'						=> '',
				'title'						=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '40px',
				
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
		
		
		
		
		$html = sprintf( '<div %s><div class="step"><h3>%s</h3></div><div class="title_holder"><h3>%s</h3></div><div class="content_holder"><p>%s</p></div></div>', themedoCore_Plugin::attributes( 'workstep-shortcode' ), $step, $title, do_shortcode($content) );
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_workstep';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

	

}

new themedoSC_WorkStep();