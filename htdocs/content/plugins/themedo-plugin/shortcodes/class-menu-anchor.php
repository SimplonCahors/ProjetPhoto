<?php
class themedoSC_MenuAnchor {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_menu-anchor-shortcode', array( $this, 'attr' ) );
		
		add_shortcode('menu_anchor', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '' ) {

		$defaults = shortcode_atts(
			array(
				'class' 			=> '',
				'name'				=> '',
			), $args
		);
		
		extract( $defaults );

		self::$args = $defaults ;		

		$html = sprintf( '<div %s></div>', themedoCore_Plugin::attributes( 'menu-anchor-shortcode' ) );

		return $html;

	}

	function attr() {

		$attr = array();
		$options = array();

		$attr['class'] = 'themedo-menu-anchor';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' .  self::$args['class'];
		}

		$attr['id'] = self::$args['name'];
		
		return $attr;

	}

}

new themedoSC_MenuAnchor();