<?php
class themedoSC_Tooltip {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_tooltip-shortcode', array( $this, 'attr' ) );
		add_shortcode('tooltip', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 	=> '',
				'id' 		=> '',
				'animation' => false,
				'delay'		=> 0,
				'placement' => 'top',
				'title' 	=> 'none',
				'trigger'	=> 'hover',
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$html = sprintf( '<span %s>%s</span>', themedoCore_Plugin::attributes( 'tooltip-shortcode' ), do_shortcode( $content ) );

		return $html;

	}

	function attr() {

		$attr['class'] = 'themedo-tooltip tooltip-shortcode';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}
		
		$attr['data-animation'] = self::$args['animation'];
		$attr['data-delay'] = self::$args['delay'];
		$attr['data-placement'] = self::$args['placement'];
		$attr['data-title'] = self::$args['title'];
		$attr['data-toggle'] = 'tooltip';
		$attr['data-trigger'] = self::$args['trigger'];

		return $attr;

	}

}

new themedoSC_Tooltip();