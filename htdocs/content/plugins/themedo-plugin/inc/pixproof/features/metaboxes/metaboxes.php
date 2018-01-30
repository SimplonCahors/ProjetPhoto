<?php
/**
 * Include and setup custom metaboxes and fields.
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'pixproof_meta_boxes', 'pixproof_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 *
 * @return array
 */
function pixproof_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$plugin_config = get_option( 'pixproof_settings' );

	$prefix = '_pixproof_';

	$meta_boxes[ 'test_metabox' ] = array(
		'id'         => 'pixroof_gallery',
		'title'      => esc_html__( 'Proofing Gallery', 'themedo-core' ),
		'pages'      => array( 'avalon_td_proofing', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'pixproof_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name'       => esc_html__( 'Gallery', 'themedo-core' ),
				'id'         => $prefix . 'main_gallery',
				'type'       => 'gallery',
				'show_names' => false,
			),
			array(
				'name' => esc_html__( 'Client Name', 'themedo-core' ),
				//				'desc' => esc_html__( 'field description (optional)', 'themedo-core' ),
				'id'   => $prefix . 'client_name',
				'type' => 'text',
			),
			array(
				'name' => esc_html__( 'Date', 'themedo-core' ),
				'id'   => $prefix . 'event_date',
				'type' => 'text_date',
			),
			array(
				'name'    => esc_html__( 'Photos Display Name', 'themedo-core' ),
				'desc'    => esc_html__( 'How would you like to identify each photo?', 'themedo-core' ),
				'id'      => $prefix . 'photo_display_name',
				'type'    => 'select',
				'options' => array(
					array(
						'name'  => esc_html__( 'Unique IDs', 'themedo-core' ),
						'value' => 'unique_ids'
					),
					array(
						'name'  => esc_html__( 'Consecutive IDs', 'themedo-core' ),
						'value' => 'consecutive_ids'
					),
					array(
						'name'  => esc_html__( 'File Name', 'themedo-core' ),
						'value' => 'file_name'
					),
					array(
						'name'  => esc_html__( 'Unique IDs and Photo Title', 'themedo-core' ),
						'value' => 'unique_ids_photo_title'
					),
					array(
						'name'  => esc_html__( 'Consecutive IDs and Photo Title', 'themedo-core' ),
						'value' => 'consecutive_ids_photo_title'
					),
				),
				'std'     => 'fullwidth',
			),

		),
	);

	if ( ( $plugin_config[ 'enable_archive_zip_download' ] ) && ( ! isset( $plugin_config[ 'zip_archive_generation' ] ) || $plugin_config[ 'zip_archive_generation' ] == 'manual' ) ) {
		array_push( $meta_boxes[ 'test_metabox' ][ 'fields' ], array(
			'name' => esc_html__( 'Client .zip archive', 'themedo-core' ),
			'desc' => esc_html__( 'Upload a .zip archive so the client can download it via the Download link. Leave it empty to hide the link.', 'themedo-core' ),
			'id'   => $prefix . 'file',
			'type' => 'file',
		) );
	}

	if ( ( $plugin_config[ 'enable_archive_zip_download' ] ) && ( ! isset( $plugin_config[ 'zip_archive_generation' ] ) || $plugin_config[ 'zip_archive_generation' ] !== 'manual' ) ) {
		array_push( $meta_boxes[ 'test_metabox' ][ 'fields' ], 	array(
			'name' => esc_html__( 'Disable Archive Download', 'themedo-core' ),
			'desc' => esc_html__( 'You can remove the ability to download the zip archive for this gallery', 'themedo-core' ),
			'id'   => $prefix . 'disable_archive_download',
			'type' => 'checkbox',
		) );
	}

	// Add other metaboxes as needed
	return $meta_boxes;
}

add_action( 'init', 'pixproof_initialize_pixproof_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function pixproof_initialize_pixproof_meta_boxes() {

	if ( ! class_exists( 'pixproof_Meta_Box' ) ) {
		require_once 'init.php';
	}

}
