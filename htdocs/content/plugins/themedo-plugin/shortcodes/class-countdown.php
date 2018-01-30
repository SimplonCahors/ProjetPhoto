<?php
class themedoSC_Countdown {


	public static $parent_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_countdown-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'countdown', array( $this, 'render_parent' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'time' 				=> '09:59',
				'date' 				=> 'April 1 2017',
				'skin' 				=> 'dark',
				'size' 				=> 'big',
				'class' 			=> '',
				'id' 				=> '',
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

		
		$html = sprintf( '<div %s></div>', themedoCore_Plugin::attributes( 'countdown-shortcode' ));

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_countdown';


		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		$attr['data-date'] = self::$parent_args['time']." ".self::$parent_args['date'];
		
		$attr['data-skin'] = self::$parent_args['skin'];
		
		$attr['data-size'] = self::$parent_args['size'];
		
		return $attr;

	}	

}

new themedoSC_Countdown();