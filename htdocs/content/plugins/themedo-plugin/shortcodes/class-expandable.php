<?php
class themedoSC_Expandable {

	private $expandable_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_expandable-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'expandable', array( $this, 'render_parent' ) );

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
				'title' 			=> '',
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

		
		$html = sprintf( '<div %s><div class="etitle"><span>%s</span><i class="xcon-angle-down"></i></div><div class="econtent">%s</div></div>', themedoCore_Plugin::attributes( 'expandable-shortcode' ), $title, do_shortcode($content));

		$this->expandable_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_expandable avalon_td_expandable_%s', $this->expandable_counter);


		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
				
		
		return $attr;

	}	

}

new themedoSC_Expandable();