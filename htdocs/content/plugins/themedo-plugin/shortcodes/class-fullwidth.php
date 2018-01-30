<?php

	class themedoSC_FullWidth {

		public static $args;
		private $avalon_td_counter = 1;

		/**
		 * Initiate the shortcode
		 */
		public function __construct() {

			add_filter( 'avalon_td_attr_fullwidth-shortcode', array( $this, 'attr' ) );
			add_shortcode( 'fullwidth', array( $this, 'render' ) );

			// Add plugin specific filters and actions here
			add_action( 'wp_head', array( $this, 'ie9Detector' ) );

		}

		public function ie9Detector() {
			echo "<!--[if IE 9]> <script>var _themedoParallaxIE9 = true;</script> <![endif]-->";
		}

		/**
		 * Render the shortcode
		 *
		 * @param  array  $args    Shortcode paramters
		 * @param  string $content Content between shortcode
		 *
		 * @return string          HTML output
		 */
		function render( $args, $content = '' ) {
			global $avalon_td_option;

			$args = $this->deprecated_args( $args );

			$defaults = themedoCore_Plugin::set_shortcode_defaults(
				array(
					'class'                 	=> '',
					'id'                    	=> '',
					'background_color'      	=> '',
					'background_image'      	=> '',
					'background_position'   	=> 'center center',
					'background_repeat'     	=> 'no-repeat',
					'content_layout'       	    => 'contained',
					'min_height'       	    	=> 'disable',
					'content_color'       	    => 'light',
					'video_url'       	    	=> '',
					'menu_anchor'           	=> '',
					'background_color_rate'     => '0.5',
					'opacity'       			=> '100',
					'padding_bottom'        	=> '0px',
					'padding_top'           	=> '0px',
					'margin_bottom'        		=> '0px',
					'margin_top'           		=> '0px',
					'background_type'           => '',
					'bgslide_direction'         => 'hor',
					'bgslide_xaxis'           	=> '0',
					'bgslide_yaxis'           	=> '0',
					'bgslide_rate'           	=> '30',
				), $args
			);

			// check: has "px" or not. if not: add "px"
			if( strpos( $defaults['padding_top'], '%' ) === false && strpos( $defaults['padding_top'], 'px' ) === false ) {
				$defaults['padding_top'] = $defaults['padding_top'] . 'px';
			}

			if( strpos( $defaults['padding_bottom'], '%' ) === false && strpos( $defaults['padding_bottom'], 'px' ) === false ) {
				$defaults['padding_bottom'] = $defaults['padding_bottom'] . 'px';
			}
			if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
				$defaults['margin_top'] = $defaults['margin_top'] . 'px';
			}

			if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
				$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
			}
			
			
			
			self::$args = $defaults;

			extract( $defaults );

			$outer_html = '';


			
			// render "CSS"
            $styles = '';          
			$styles .= '<style type="text/css">';
			$styles .= '.avalon_td_fullwidth_' . $this->avalon_td_counter . '{
					padding-top: ' . self::$args['padding_top'] . ';
					padding-bottom: ' . self::$args['padding_bottom'] . ';
					margin-top: ' . self::$args['margin_top'] . ';
					margin-bottom: ' . self::$args['margin_bottom'] . ';
					background-color: ' . self::$args['background_color'] . ';
					
				}';
			
			// check overlay type
			if(self::$args['background_type'] == 'parallax'){
				$styles .= '.avalon_td_fullwidth_' . $this->avalon_td_counter . ' .avalon_td_overlay_parallax{
					background-image: url('.self::$args['background_image'].');
					background-repeat:'.self::$args['background_repeat'].';
					background-position:'.self::$args['background_position'].';
				}';
			}
			else if(self::$args['background_type'] == 'video'){
				$styles .= '.avalon_td_fullwidth_' . $this->avalon_td_counter . ' .avalon_td_overlay_video{
					background-image: url('.self::$args['background_image'].');
					background-repeat:'.self::$args['background_repeat'].';
					background-position:'.self::$args['background_position'].';
				}';	
			}
			else if(self::$args['background_type'] == 'bgslide'){
				$styles .= '.avalon_td_fullwidth_' . $this->avalon_td_counter . ' .avalon_td_overlay_bgslide{
					background-image: url('.self::$args['background_image'].');
					background-repeat:'.self::$args['background_repeat'].';
					background-position:'.self::$args['background_position'].';
				}';	
			}
			else{
				$styles .= '.avalon_td_fullwidth_' . $this->avalon_td_counter . ' .avalon_td_overlay_image{
					background-image: url('.self::$args['background_image'].');
					background-repeat:'.self::$args['background_repeat'].';
					background-position:'.self::$args['background_position'].';
				}';	
			}
			
			
			$styles .= '</style>';
		



			// render "HTML"
			$html = '</div></div></div>';
			
			// check menu anchor
			if(self::$args['menu_anchor']){
				$html .= '<section class="avalon_td_section" id="'.self::$args['menu_anchor'].'">';
			}
			
			$html .= '<div class="avalon_td_fullwidth '.self::$args['content_color'].' avalon_td_fullwidth_' . $this->avalon_td_counter . ' '.self::$args['class'].'" id="'.self::$args['id'].'" data-navi="'.self::$args['menu_anchor'].'" data-min-height="'.self::$args['min_height'].'"><div class="avalon_td_wrap">';
			
			$html .= $styles;
			
			// add "container"
			if ( self::$args['content_layout'] === 'contained' ) { $html .= '<div class="container">'; }
			
			$html .= do_shortcode( $content );
			
			// close "container"
			if ( self::$args['content_layout'] === 'contained' ) { $html .= '</div>'; }
			
			$html .= '</div><div class="avalon_td_back">';
			
			// bg color
			if(self::$args['background_color']){
				$html .= '<div class="avalon_td_overlay_color" data-color="'.self::$args['background_color'].'" data-transparency="'.self::$args['background_color_rate'].'"></div>';	
			}
			
			// check overlay type
			if ( !empty(self::$args['background_image']) ) {
				if(self::$args['background_type'] == 'parallax'){
					$html .= '<div class="avalon_td_overlay_parallax jarallax"></div>';	
				}
				else if(self::$args['background_type'] == 'bgslide'){
					$html .= '<div class="avalon_td_overlay_bgslide" data-bstype="'.$bgslide_direction.'" data-xaxis="'.$bgslide_xaxis.'" data-yaxis="'.$bgslide_yaxis.'" data-rate="'.$bgslide_rate.'"></div>';	
				}
				else if(self::$args['background_type'] == 'image'){
					$html .= '<div class="avalon_td_overlay_image"></div>';	
				}
			}
			
			// check video url
			if ( !empty(self::$args['video_url']) ) {
				if(self::$args['background_type'] == 'video'){
					$html .= '<div class="avalon_td_overlay_video jarallax" data-jarallax-video="'.self::$args['video_url'].'"></div>';
				}
			}
			
			// data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"
			
			
			$html .= '</div></div>';
			
			// check menu anchor
			if(self::$args['menu_anchor']){
				$html .= '</section>';	
			}
			
			$html .= '<div class="container"><div class="row"><div class="td-col-12 fix desc">';
			

			$this->avalon_td_counter++;

			return $html;

		}

		function attr() {

			$attr['class'] = 'avalon_td_fullwidth avalon_td_fullwidth_' . $this->avalon_td_counter . ' ';
			$attr['style'] = '';

			return $attr;

		}
		
		
		public function deprecated_args( $args ) {

			$param_mapping = array(
				'backgroundposition'    => 'background_position',
				'backgroundattachment'  => 'background_parallax',
				'background_attachment' => 'background_parallax',
				'bordersize'            => 'border_size',
				'bordercolor'           => 'border_color',
				'borderstyle'           => 'border_style',
				'paddingtop'            => 'padding_top',
				'paddingbottom'         => 'padding_bottom',
				'paddingleft'           => 'padding_left',
				'paddingright'          => 'padding_right',
				'backgroundcolor'       => 'background_color',
				'backgroundimage'       => 'background_image',
				'backgroundrepeat'      => 'background_repeat',
				'paddingBottom'         => 'padding_bottom',
				'paddingTop'            => 'padding_top',
			);
			
			if ( ! is_array( $args ) ) {
				$args = array();
			}
			
			if ( ( array_key_exists( 'backgroundattachment', $args ) && $args['backgroundattachment'] == 'scroll' ) ||
				 ( array_key_exists( 'background_attachment', $args ) && $args['background_attachment'] == 'scroll' )
			) {
				$args['backgroundattachment'] = $args['background_attachment'] = 'none';
			}
			
			foreach ( $param_mapping as $old => $new ) {
				if ( ! isset( $args[ $new ] ) && isset( $args[ $old ] ) ) {
					$args[ $new ] = $args[ $old ];
					unset( $args[ $old ] );
				}
			}

			return $args;
		}
		

	}

	new themedoSC_FullWidth();
