<?php
/**
 * Module starter file
 *
 * @package YITH_Proteo_tookit
 */

// Define module name and params.
$module_params = array(
	'module_name'     => esc_html__( 'Testimonials', 'yith-proteo-toolkit' ),
	'module_slug'     => 'testimonials', // should be the same of the folder.
	'post_type'       => 'proteo-testimonials', // the post type to be registered, if any.
	'taxonomy'        => 'proteo-testimonials-tax', // the custom taxonomy to be registered, if any.
	'can_be_disabled' => true,
);

if ( array_key_exists( 'post_type', $module_params ) && '' !== $module_params['post_type'] ) {
	require_once YITH_PROTEO_TOOLKIT_PATH . 'includes/testimonials-module/post-types/testimonials.php';
}

/**
 * Manage Testimonial metaboxes
 */
require_once YITH_PROTEO_TOOLKIT_PATH . 'includes/testimonials-module/post-types/class-proteo-testimonials-metabox.php';
