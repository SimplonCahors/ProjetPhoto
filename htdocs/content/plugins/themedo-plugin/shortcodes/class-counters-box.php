<?php
class themedoSC_CountersBox {

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_counters-box-shortcode', array( $this, 'parent_attr' ) );
		add_filter( 'avalon_td_attr_counter-box-shortcode', array( $this, 'child_attr' ) );
		
		
		add_shortcode( 'counters_box', array( $this, 'render_parent' ) );
		add_shortcode( 'counter_box', array( $this, 'render_child' ) );

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
				'columns' 			=> '',
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
		
		if( self::$parent_args['columns'] > 6 ) {
			self::$parent_args['columns'] = 6;
		}			
		
		$this->set_num_of_columns( $content );

		$html = sprintf( '<div %s><ul class="avalon_td_counter_list">%s</ul></div><div class="clearfix"></div>', themedoCore_Plugin::attributes( 'counters-box-shortcode' ), do_shortcode( $content ) );

		return $html;

	}

	function parent_attr() {

		$attr['class'] = 'avalon_td_counter_wrap';

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['data-col'] = self::$parent_args['columns'];	
		
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
				'start'			=> '0',
				'value'			=> '777',
				'speed'			=> '2000',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;


		$html = sprintf( '<li><h3 %s>0</h3><span>%s</span></li>', themedoCore_Plugin::attributes( 'counter-box-shortcode' ), do_shortcode($content) );

		return $html;

	}

	function child_attr() {

		$attr['class'] = 'avalon_td_counter';
		
		$attr['data-from'] = self::$child_args['start'];	
		
		$attr['data-to'] = self::$child_args['value'];	
		
		$attr['data-speed'] = self::$child_args['speed'];	

		return $attr;

	}

	
	/**
	 * Calculate the number of columns automatically
	 * @param  string $content Content to be parsed
	 */	
	function set_num_of_columns( $content ) {
		if( ! self::$parent_args['columns'] ) {
			preg_match_all( '/(\[counter_box (.*?)\](.*?)\[\/counter_box\])/s', $content, $matches );
			if( is_array( $matches ) && 
				! empty( $matches ) 
			) {
				self::$parent_args['columns'] = count( $matches[0] );
				if( self::$parent_args['columns'] > 6 ) {
					self::$parent_args['columns'] = 6;
				}			
			} else {
				self::$parent_args['columns'] = 1;
			}
		} elseif( self::$parent_args['columns'] > 6 ) {
			self::$parent_args['columns'] = 6;
		}
	}	

}

new themedoSC_CountersBox();
