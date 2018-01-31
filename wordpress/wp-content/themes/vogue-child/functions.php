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
