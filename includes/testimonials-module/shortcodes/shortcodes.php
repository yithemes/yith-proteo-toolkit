<?php
/**
 * Testimonials shortcodes
 *
 * @since 1.1.0
 * @package YITH_Proteo_tookit
 */

add_shortcode( 'proteo_testimonials', 'yith_proteo_toolkit_proteo_testimonials_sc' );

/**
 * Shortcode callback
 *
 * @param array $atts Shortcode params.
 *
 * @return mixed
 */
function yith_proteo_toolkit_proteo_testimonials_sc( $atts ) {
	// Attributes.
	$atts = shortcode_atts(
		array(
			'names'    => '',
			'count'    => '-1',
			'layout'   => 'list',
			'elements' => '',
		),
		$atts,
		'proteo_testimonials'
	);

	$args = array(
		'numberposts' => $atts['count'],
		'post_type'   => 'proteo_testimonials',
		'orderby'     => 'date',
		'order'       => 'DESC',
		'post_status' => 'publish',
		'fields'      => 'ids',
	);

	$proteo_testimonials_id_array         = get_posts( $args );
	$proteo_testimonials_layout           = $atts['layout'];
	$proteo_testimonials_elements_to_show = $atts['elements'];

	if ( empty( $proteo_testimonials_id_array ) ) {
		return '';
	}

	$default_path  = YITH_PROTEO_TOOLKIT_TEMPLATE_PATH;
	$theme_path    = 'yith-proteo-toolkit/';
	$template_name = 'proteo-testimonials.php';

	$template = locate_template(
		array(
			trailingslashit( $theme_path ) . $template_name,
			$template_name,
		)
	);

	if ( ! $template ) {
		$template = trailingslashit( $default_path ) . $template_name;
	}

	if ( ! file_exists( $template ) ) {
		return '';
	}

	ob_start();

	include $template;

	return ob_get_clean();

}
