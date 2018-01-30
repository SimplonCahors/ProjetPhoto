<?php
class themedoSC_Kenburns {
	
	private $avalon_td_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_kenburns-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'kenburns', array( $this, 'render_parent' ) );
		add_shortcode( 'ken', array( $this, 'render_child' ) );

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
				'purchase_button' 	=> '',
				'title' 			=> '',
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
				'slide_interval' 	=> '',
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

		/*$html = sprintf( '<div %s><div class="avalon_td_big_image"><ul class="slides">%s</ul></div><div class="avalon_td_thumb"><div class="avalon_td_thumb_image"><ul class="slides"></ul></div></div></div>', themedoCore_Plugin::attributes( 'gallery-shortcode' ),  do_shortcode($content) );*/
		
		$child_output = do_shortcode($content);
		$child_output = rtrim($child_output, ',');
		
		
		$html  = '</div></div></div>';
		//$html .= sprintf('<script type="text/javascript">jQuery(function($){jQuery(".avalon_td_kenburns").Kenburns({images: [%s], scale:0.7, duration:8000, fadeSpeed:600, ease3d:\'cubic-bezier(0.9, 0.7, 0.7, 0.9)\'});});</script>',  $child_output, self::$parent_args['slide_interval']);
		$html .= sprintf('<div %s><div class="themedo_overlay" data-gradient="both"></div><div class="avalon_td_title"></div><div class="avalon_td_kenburns" data-interval="%s">%s</div></div>', themedoCore_Plugin::attributes( 'kenburns-shortcode' ), self::$parent_args['slide_interval'], $child_output);
		
		
		$html .= '<div class="container"><div class="row"><div class="td-col-12 fix desc">';
		
		//$this->avalon_td_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_kenburns_wrap avalon_td_kenburns-%s', $this->avalon_td_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
		$attr['id'] = sprintf( 'avalon_td_kenburns_%s', $this->avalon_td_counter );
		
		if( self::$parent_args['id'] ) {
			$attr['id'] .= ' ' .self::$parent_args['id'];
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
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'image'			=> '',
				'title'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		//$image = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-1920-9999'); //image
		//$thumb = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-120-120');   //thumbnail
		
		$image = wp_get_attachment_image_src($img_id, 'avalon_td_thumb-1920-9999');
		$thumb = wp_get_attachment_image_src($img_id, 'avalon_td_thumb-120-120');
		
		
		// purchase URL --------------------------
		$button			= '';
		$purchase_url 	= get_post_meta( $img_id, '_image_purchase_url', true );
		if($purchase_url !== ''){
			$button		= "<a href='".$purchase_url."' class='purchase_button overlay'><i class='pe-7s-cart'></i><span>".esc_html($avalon_td_option['purchase_btn_text'])."</span></a>";
		}
		if(self::$parent_args['purchase_button'] == 'disable'){
			$button			= '';	
		}
		// ---------------------------------------
		

		//$html = sprintf('"%s",', $image[0]);

		//$html = rtrim($html, ','); // removes last comma
		$html = '';
		if($image[0] != ''){
			$html = '<img src="'.$image[0].'" />';
		}
		

		return $html;

	}

}

new themedoSC_Kenburns();