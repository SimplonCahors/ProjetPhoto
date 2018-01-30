<?php
class themedoSC_Highlight {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_highlight-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'highlight', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'		=> '',			
				'id'		=> '',
				'color'		=> $avalon_td_option['primary_color'],
				'rounded'	=> 'no',
			), $args 
		);

		extract( $defaults );

		self::$args = $defaults;
		
		$html = sprintf( '<span %s>%s</span>', themedoCore_Plugin::attributes( 'highlight-shortcode' ), do_shortcode($content) );

		return $html;

	}

	function attr() {
	
		$attr = array();

		$attr['class'] = 'themedo-highlight';

		$brightness_level = themedoCore_Plugin::calc_color_brightness( self::$args['color'] );

		if( $brightness_level > 140 ) {
			$attr['class'] .= ' light';
		} else {
			$attr['class'] .= ' dark';
		}

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
		
		if( self::$args['rounded'] == 'yes' ) {
			$attr['class'] .= ' rounded'; 
		}		

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}

		if( self::$args['color'] == 'black') {
			$attr['class'] .= ' highlight2';
		} else {
			$attr['class'] .= ' highlight1';
		}
		
	   $attr['style'] = sprintf( 'background-color:%s;', self::$args['color'] );

		return $attr;

	}

}

new themedoSC_Highlight();