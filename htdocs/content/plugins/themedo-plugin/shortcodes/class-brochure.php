<?php
class themedoSC_Brochure {

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_brochures-shortcode', array( $this, 'parent_attr' ) );
		add_filter( 'avalon_td_attr_brochure-shortcode', array( $this, 'child_attr' ) );
		
		
		add_shortcode( 'brochures', array( $this, 'render_parent' ) );
		add_shortcode( 'brochure', array( $this, 'render_child' ) );

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
		

		$html = sprintf( '<ul %s>%s</ul>', themedoCore_Plugin::attributes( 'brochures-shortcode' ), do_shortcode( $content ) );

		return $html;

	}

	function parent_attr() {

		$attr['class'] = 'brochures';

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
				'link'			=> '',
				'icon'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;


		$html = sprintf( '<li><a href="%s"><i class="xcon-file-%s"></i><span class="text_b">%s</span></a></li>', $link, $icon, do_shortcode($content) );

		return $html;

	}

	

}

new themedoSC_Brochure();
