<?php
class themedoSC_Popover {

	private $popover_counter = 1;

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

	add_filter( 'avalon_td_attr_popover-shortcode', array( $this, 'attr' ) );
	add_shortcode('popover', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $sc_content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'animation' 		=> false,
				'content'			=> '',
				'content_bg_color'	=> $avalon_td_option['popover_content_bg_color'],
				'delay'				=> '',
				'placement' 		=> strtolower( $avalon_td_option['popover_placement'] ),
				'title' 			=> '',
				'title_bg_color'	=> $avalon_td_option['popover_heading_bg_color'],
				'bordercolor'		=> $avalon_td_option['popover_border_color'],
				'textcolor'			=> $avalon_td_option['popover_text_color'],
				'trigger'			=> 'click',
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;
		
		if( $placement == 'bottom' ) {
			$arrow_color = $title_bg_color;
		} else {
			$arrow_color = $content_bg_color;
		}
		
		$styles = sprintf( '<style type="text/css">.popover-%s.%s .arrow{border-%s-color:%s;}.popover-%s{border-color:%s;}.popover-%s .popover-title{background-color:%s;color:%s;border-color:%s;}.popover-%s .popover-content{background-color:%s;color:%s;}.popover-%s.%s .arrow:after{border-%s-color:%s;}</style>', 
						   $this->popover_counter, $placement, $placement, $bordercolor, $this->popover_counter, $bordercolor, $this->popover_counter, $title_bg_color, $textcolor, $bordercolor, $this->popover_counter, $content_bg_color, $textcolor, $this->popover_counter, $placement, $placement, $arrow_color );
	
		$html = sprintf( '<span %s>%s%s</span>', themedoCore_Plugin::attributes( 'popover-shortcode' ), $styles, do_shortcode( $sc_content ) );

		$this->popover_counter++;

		return $html;

	}

	function attr() {

		$attr['class'] = sprintf( 'themedo-popover popover-%s', $this->popover_counter );

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		$attr['data-animation'] = self::$args['animation'];
		$attr['data-class'] = sprintf( 'popover-%s', $this->popover_counter );
		$attr['data-container'] = sprintf( 'popover-%s', $this->popover_counter );
		$attr['data-content'] = self::$args['content'];
		$attr['data-delay'] = self::$args['delay'];
		$attr['data-placement'] = strtolower( self::$args['placement'] );
		$attr['data-title'] = self::$args['title'];
		$attr['data-toggle'] = 'popover';
		$attr['data-trigger'] = self::$args['trigger'];

		return $attr;

	}

}

new themedoSC_Popover();