<?php
/**
 * Vogue Child functions and definitions
 */

/**
 * Enqueue parent theme style
 */
function vogue_child_enqueue_styles() {
    wp_enqueue_style( 'vogue-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'vogue_child_enqueue_styles' );
// Hide Product Category Count
add_filter( 'woocommerce_subcategory_count_html', 'prima_hide_subcategory_count' );
function prima_hide_subcategory_count() {
  /* empty - no count */
}
function remove_image_zoom_support() {
  remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );
function sv_remove_product_page_skus( $enabled ) {
  if ( ! is_admin() && is_product() ) {
      return false;
  }

  return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );