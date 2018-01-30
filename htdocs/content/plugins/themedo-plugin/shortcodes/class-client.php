<?php
class themedoSC_Client {

	private $client_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_client-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'clients', array( $this, 'render_parent' ) );
		add_shortcode( 'client', array( $this, 'render_child' ) );

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
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
				'client_type' 		=> '',
				'client_col' 		=> '',
				'client_color' 		=> '',
				'client_opacity' 	=> '',
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

		$html = sprintf( '<div %s><ul>%s</ul></div>', themedoCore_Plugin::attributes( 'client-shortcode' ),  do_shortcode($content) );
		
		$this->client_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_clients_list avalon_td_client_list_%s', $this->client_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
		$attr['id'] = sprintf( 'avalon_td_clients_%s', $this->client_counter );
		
		if( self::$parent_args['id'] ) {
			$attr['id'] .= ' ' .self::$parent_args['id'];
		}
		
		if( self::$parent_args['client_type'] ) {
			$attr['data-temp'] = self::$parent_args['client_type'];
		}else{
			$attr['data-temp'] = 'b';
		}
		
		if( self::$parent_args['client_col'] ) {
			$attr['data-col'] = self::$parent_args['client_col'];
		}else{
			$attr['data-col'] = '5';
		}
		
		
		if( self::$parent_args['client_color'] ) {
			$attr['data-color'] = self::$parent_args['client_color'];
		}else{
			$attr['data-color'] = '#000000';
		}
		
		if( self::$parent_args['client_opacity'] ) {
			$attr['data-transparency'] = self::$parent_args['client_opacity'];
		}else{
			$attr['data-transparency'] = '0.9';
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		return $attr;

	}	

	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'image'			=> '',
				'link'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		$image = avalon_td_get_image_from_id($img_id, 'full'); //image
		$thumb = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-134-74');   //thumbnail
		

		$html = sprintf("<li><a href='%s' target='_blank'>%s</a></li>", $link, $image);

		return $html;

	}

}

new themedoSC_Client();