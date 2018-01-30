<?php
class themedoSC_FlowGallery {

	private $gallery_counter = 1;
	private $data_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_flowgallery-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'flowgallery', array( $this, 'render_parent' ) );
		add_shortcode( 'flowimg', array( $this, 'render_child' ) );

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
				'img_title' 		=> '',
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
		
		$my_title = '<div class="flow_gallery_title">
						<h3></h3>
					</div>';
					
		if(self::$parent_args['img_title'] == 'disable'){
			$my_title = '';
		}
					
		$my_controllers = '<div class="flow_gallery_controller">
								<span class="prev"><i class="xcon-left-open-big"></i></span>
								<span class="next"><i class="xcon-right-open-big"></i></span>
							</div>';
		

		$html  = '</div></div></div>';
		$html .= sprintf( '<div %s>%s<ul class="flow_list">%s</ul>%s </div>', themedoCore_Plugin::attributes( 'flowgallery-shortcode' ), $my_controllers, do_shortcode($content),  $my_title );
		
		$html .= '<div class="container"><div class="row"><div class="td-col-12 fix desc">';
		
		$this->gallery_counter++;
		
		$this->data_counter = 1;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_flowgallery_wrap avalon_td_flowgallery_%s', $this->gallery_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
		$attr['id'] = sprintf( 'avalon_td_flowgallery_%s', $this->gallery_counter );
		
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
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$img_url 	= self::$child_args['image'];
		$img_id 	= avalon_td_attachment_id_from_url($img_url);
		$image 		= avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-1000-1000'); //image
		$new_url 	= wp_get_attachment_image_src($img_id, 'avalon_td_thumb-1000-1000');
		$title 		= get_the_title($img_id);
		
		// purchase URL --------------------------
		$button			= '';
		$purchase_url 	= get_post_meta( $img_id, '_image_purchase_url', true );
		if($purchase_url !== ''){
			$button		= "<a href='".$purchase_url."' class='purchase_button overlay'><i class='pe-7s-cart'></i><p><span>".esc_html($avalon_td_option['purchase_btn_text'])."</span></p></a>";
		}
		if(self::$parent_args['purchase_button'] == 'disable'){
			$button			= '';	
		}
		// ---------------------------------------
		
		$html = sprintf("<li class='flow_item flow_item_%s' data-count='%s' data-title='%s'><div class='img_holder'>%s<div class='img_reflection' data-url='%s'></div>%s</div><div class='ref_back'></div></li>", $this->data_counter, $this->data_counter, $title, $image, $new_url[0], $button);
		$this->data_counter++;
		return $html;
	}

}

new themedoSC_FlowGallery();