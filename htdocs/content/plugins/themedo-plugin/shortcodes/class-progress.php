<?php
class themedoSC_Progressbar {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_progressbar-shortcode', array( $this, 'attr' ) );
		add_filter( 'avalon_td_attr_progressbar-shortcode-content', array( $this, 'content_attr' ) );
		
		add_shortcode('progress', array( $this, 'render' ) );

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
				'class'					=> '',
				'id'					=> '',
				'striped'					=> 'off',
				'size'					=> '',
				'rounded'					=> 'off',
				'filledcolor' 			=> '',
				'value'					=> '70',
				'margin_top' 			=> '',
				'margin_bottom' 		=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}
		
		if( strpos( $defaults['value'], '%' ) === false) {
			$defaults['value'] = $defaults['value'] . '%';
		}

		extract( $defaults );

		self::$args = $defaults;
		
		$avalon_td_extra = '<div class="avalon_td_bar_bg"><div class="avalon_td_bar_wrap"><div class="avalon_td_bar"></div></div></div>';

		
		$html = sprintf( '<div %s><div %s><span><span class="label">%s</span><span class="number">%s</span></span>%s</div></div>', themedoCore_Plugin::attributes( 'progressbar-shortcode' ), themedoCore_Plugin::attributes( 'progressbar-shortcode-content' ), $content, $value, $avalon_td_extra );

		return $html;

	}

	function attr() {
	
		$attr = array();

		$attr['class'] = 'avalon_td_progress_wrap';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		$attr['data-round'] = self::$args['rounded'];
		
		$attr['data-strip'] = self::$args['striped'];
		
		$attr['data-size'] = self::$args['size'];

		return $attr;

	}

	function content_attr() {
	
		$attr = array();

		$attr['class'] = 'avalon_td_progress';
		
		$attr['data-color'] = self::$args['filledcolor'];

		$attr['data-value'] = self::$args['value'];

		return $attr;

	}
	

}

new themedoSC_Progressbar();