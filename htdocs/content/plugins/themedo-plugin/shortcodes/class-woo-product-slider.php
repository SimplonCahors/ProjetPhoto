<?php

	class themedoSC_WooProductSlider {

		public static $args;

		/**
		 * Initiate the shortcode
		 */
		public function __construct() {

			add_filter( 'avalon_td_attr_woo-product-slider-shortcode', array( $this, 'attr' ) );
			add_filter( 'avalon_td_attr_woo-product-slider-shortcode-carousel', array( $this, 'carousel_attr' ) );
			add_filter( 'avalon_td_attr_woo-product-slider-shortcode-img-div', array( $this, 'img_div_attr' ) );

			add_shortcode( 'products_slider', array( $this, 'render' ) );

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
			global $woocommerce, $avalon_td_option;

			$defaults = themedoCore_Plugin::set_shortcode_defaults(
				array(
					'class'           	=> '',
					'id'              	=> '',
					'autoplay'        	=> 'no',
					'carousel_layout' 	=> 'title_on_rollover',
					'cat_slug'        	=> '',
					'columns'         	=> '5',
					'column_spacing'  	=> '13',
					'mouse_scroll'    	=> 'no',
					'number_posts'    	=> 10,
					'picture_size'    	=> 'fixed',
					'scroll_items'		=> '',
					'show_buttons'   	=> 'yes',
					'show_cats'       	=> 'yes',
					'show_nav'        	=> 'yes',
					'show_price'      	=> 'yes',
				), $args
			);

			( $defaults['show_cats'] == "yes" ) ? ( $defaults['show_cats'] = 'enable' ) : ( $defaults['show_cats'] = 'disable' );
			( $defaults['show_price'] == "yes" ) ? ( $defaults['show_price'] = true ) : ( $defaults['show_price'] = false );
			( $defaults['show_buttons'] == "yes" ) ? ( $defaults['show_buttons'] = true ) : ( $defaults['show_buttons'] = false );

			extract( $defaults );

			self::$args = $defaults;

			$html    = '';
			$buttons = '';

			if ( class_exists( 'Woocommerce' ) ) {

				$number_posts = (int) $number_posts;

				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $number_posts,
					'meta_query'     => array(
						array(
							'key'     => '_thumbnail_id',
							'compare' => '!=',
							'value'   => null
						)
					)
				);

				if ( $cat_slug ) {
					$cat_id            = explode( '|', $cat_slug );
					$args['tax_query'] =
						array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $cat_id
							)
						);
				}

				if ( $picture_size == 'fixed' ) {
					$featured_image_size = 'related-img';
				} else {
					$featured_image_size = 'full';
				}

				$products         = new WP_Query( $args );
				$product_list = '';

				if ( $products->have_posts() ) {

					while ( $products->have_posts() ) {
						$products->the_post();

						$image = $price_tag = $terms = '';

						// Title on rollover layout
						if ( $carousel_layout == 'title_on_rollover' ) {
							$image = avalon_td_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, $show_price, $show_buttons, $show_cats );
							// Title below image layout
						} else {
							$image = avalon_td_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, $show_buttons, 'disable', 'disable' );

							// Get the post title
							$image .= sprintf( '<h4 %s><a href="%s" target="%s">%s</a></h4>', themedoCore_Plugin::attributes( 'themedo-carousel-title' ), get_permalink( get_the_ID() ), '_self', get_the_title() );

							$image .= '<div class="themedo-carousel-meta">';

							// Get the terms
							if ( $show_cats ) {
								$image .= get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' );
							}

							// Check if we should render the woo product price
							if ( $show_price ) {
								ob_start();
								woocommerce_get_template( 'loop/price.php' );
								$image .= sprintf( '<div class="themedo-carousel-price">%s</div>', ob_get_clean() );
							}

							$image .= '</div>';
						}

						$product_list .= sprintf( '<li %s><div %s>%s</div></li>', themedoCore_Plugin::attributes( 'themedo-carousel-item' ), themedoCore_Plugin::attributes( 'themedo-carousel-item-wrapper' ), $image );
					}
				}

				$html = sprintf( '<div %s>', themedoCore_Plugin::attributes( 'woo-product-slider-shortcode' ) );
				$html .= sprintf( '<div %s>', themedoCore_Plugin::attributes( 'woo-product-slider-shortcode-carousel' ) );
				$html .= sprintf( '<div %s>', themedoCore_Plugin::attributes( 'themedo-carousel-positioner' ) );
				$html .= sprintf( '<ul %s>', themedoCore_Plugin::attributes( 'themedo-carousel-holder' ) );
				$html .= $product_list;
				$html .= '</ul>';
				// Check if navigation should be shown
				if ( $show_nav == 'yes' ) {
					$html .= sprintf( '<div %s><span %s></span><span %s></span></div>', themedoCore_Plugin::attributes( 'themedo-carousel-nav' ),
						themedoCore_Plugin::attributes( 'themedo-nav-prev' ), themedoCore_Plugin::attributes( 'themedo-nav-next' ) );
				}
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}

			return $html;

		}

		function attr() {
			$attr['class'] = 'themedo-woo-product-slider themedo-woo-slider';

			if ( self::$args['class'] ) {
				$attr['class'] .= ' ' . self::$args['class'];
			}

			if ( self::$args['id'] ) {
				$attr['id'] = self::$args['id'];
			}

			return $attr;

		}

		function carousel_attr() {

			$attr['class'] = 'themedo-carousel';

			if ( self::$args['carousel_layout'] == 'title_below_image' ) {
				$attr['class'] .= ' themedo-carousel-title-below-image';

				$attr['data-metacontent'] = 'yes';
			}

			$attr['data-autoplay']    = self::$args['autoplay'];
			$attr['data-columns']     = self::$args['columns'];
			$attr['data-itemmargin']  = self::$args['column_spacing'];
			$attr['data-itemwidth']   = 180;
			$attr['data-touchscroll'] = self::$args['mouse_scroll'];
			$attr['data-imagesize']   = self::$args['picture_size'];
			$attr['data-scrollitems'] = self::$args['scroll_items'];

			return $attr;
		}
	}

	new themedoSC_WooProductSlider();