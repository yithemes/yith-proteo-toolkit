<?php
/**
 * Metabox handling class
 *
 * @package YITH_Proteo_tookit
 */

/**
 * Class Proteo_Testimonials_Metabox
 *
 * @author Francesco Grasso <francgrasso@yithemes.com>
 */
class Proteo_Testimonials_Metabox {

	/**
	 * Post type
	 *
	 * @var array $custom_post_types
	 */
	private $custom_post_types = array(
		'proteo_testimonials',
	);

	/**
	 * Fields
	 *
	 * @var array $fields
	 */
	private $fields = array(
		array(
			'label' => 'Review',
			'id'    => 'proteo_testimonial_review',
			'type'  => 'editor',
			'class' => '',
		),
		array(
			'label' => 'Small quote',
			'id'    => 'proteo_testimonial_small_quote',
			'type'  => 'textarea',
			'class' => '',
		),
		array(
			'label'   => 'Rating',
			'id'      => 'proteo_testimonial_rating',
			'type'    => 'select',
			'class'   => '',
			'options' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
		),
		array(
			'label' => 'Website',
			'id'    => 'proteo_testimonial_website',
			'type'  => 'url',
			'class' => '',
		),
		array(
			'label' => 'Facebook',
			'id'    => 'proteo_testimonial_website',
			'type'  => 'url',
			'class' => '',
		),
		array(
			'label' => 'Twitter',
			'id'    => 'proteo_testimonial_social_twitter',
			'type'  => 'url',
			'class' => '',
		),
		array(
			'label' => 'Youtube',
			'id'    => 'proteo_testimonial_social_youtube',
			'type'  => 'url',
			'class' => '',
		),
		array(
			'label' => 'Instagram',
			'id'    => 'proteo_testimonial_social_instagram',
			'type'  => 'url',
			'class' => '',
		),
		array(
			'label' => 'TikTok',
			'id'    => 'proteo_testimonial_social_tiktok',
			'type'  => 'url',
			'class' => '',
		),
	);

	/**
	 * Retrieve filtered meta fields array
	 *
	 * @return array
	 */
	public function get_fields() {
		return apply_filters( 'proteo_testimonial_meta_fields', $this->fields );
	}

	/**
	 * Metabox constructor method.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}

	/**
	 * Add metabox to post
	 *
	 * @return void
	 */
	public function add_meta_boxes() {
		foreach ( $this->custom_post_types as $custom_post_type ) {
			add_meta_box(
				'proteo_testimonial_meta',
				__( 'Testimonial review', 'yith-proteo-toolkit' ),
				array( $this, 'meta_box_callback' ),
				$custom_post_type,
				'normal',
				'default'
			);
		}
	}

	/**
	 * Callback to print metabox controls
	 *
	 * @param object $post Post.
	 * @return void
	 */
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'proteo_testimonial_meta_data', 'proteo_testimonial_meta_nonce' );
		$this->field_generator( $post );
	}

	/**
	 * Echo metabox controls.
	 *
	 * @param object $post Post.
	 * @return void
	 */
	public function field_generator( $post ) {

		$review = get_post_meta( $post->ID, 'proteo_testimonial_review', true );

		wp_editor(
			$review,
			'proteo_testimonial_review',
			array(
				'wpautop'       => true,
				'media_buttons' => false,
				'textarea_name' => 'proteo_testimonial_review',
				'textarea_rows' => 20,
				'teeny'         => true,
			)
		);

		$output = '';
		foreach ( $this->get_fields() as $field ) {
			switch ( $field['type'] ) {
				case 'select':
					$meta_value = get_post_meta( $post->ID, $field['id'], true );
					$label      = '<label for="' . $field['id'] . '">' . esc_html( $field['label'] ) . '</label>';
					$input      = sprintf(
						'<select id="%s" name="%s">',
						esc_attr( $field['id'] ),
						esc_attr( $field['id'] )
					);
					foreach ( $field['options'] as $key => $value ) {
						$field_value = ! is_numeric( $key ) ? $key : $value;
						$input      .= sprintf(
							'<option %s value="%s">%s</option>',
							$meta_value === $field_value ? 'selected' : '',
							esc_attr( $field_value ),
							esc_html( $value )
						);
					}
					$input .= '</select>';
					break;
				case 'editor':
					$label = '';
					$input = '';
					break;
				case 'textarea':
					$meta_value = get_post_meta( $post->ID, $field['id'], true );
					$label      = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
					$input      = sprintf(
						'<textarea id="%s" name="%s" rows="5">%s</textarea>',
						esc_attr( $field['id'] ),
						esc_attr( $field['id'] ),
						esc_html( $meta_value )
					);
					break;
				case 'url':
					$meta_value = get_post_meta( $post->ID, $field['id'], true );
					$label      = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
					$input      = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						'color' !== $field['type'] ? 'style="width: 100%"' : '',
						esc_attr( $field['id'] ),
						esc_attr( $field['id'] ),
						esc_attr( $field['type'] ),
						esc_url( $meta_value )
					);
					break;
				default:
					$meta_value = get_post_meta( $post->ID, $field['id'], true );
					$label      = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
					$input      = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						'color' !== $field['type'] ? 'style="width: 100%"' : '',
						esc_attr( $field['id'] ),
						esc_attr( $field['id'] ),
						esc_attr( $field['type'] ),
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );

		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Prettify metabox controls
	 *
	 * @param mixed $label meta control label element.
	 * @param mixed $input meta control html element.
	 * @return string
	 */
	public function format_rows( $label, $input ) {
		return '<div style="margin-top: 10px;"><strong>' . $label . '</strong></div><div>' . $input . '</div>';
	}

	/**
	 * Hooks into WordPress' save_post function
	 *
	 * @param int $post_id Slider post ID.
	 *
	 * @return int|void
	 */
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['proteo_testimonial_meta_nonce'] ) ) {
			return $post_id;
		}
		$nonce = sanitize_text_field( wp_unslash( $_POST['proteo_testimonial_meta_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'proteo_testimonial_meta_data' ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		foreach ( $this->get_fields() as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( wp_unslash( $_POST[ $field['id'] ] ) );
						break;
					case 'url':
						$_POST[ $field['id'] ] = esc_url_raw( wp_unslash( $_POST[ $field['id'] ] ) );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( wp_unslash( $_POST[ $field['id'] ] ) );
						break;
				}
				update_post_meta( $post_id, $field['id'], wp_kses_post( wp_unslash( $_POST[ $field['id'] ] ) ) );
			} elseif ( 'checkbox' === $field['type'] ) {
				update_post_meta( $post_id, $field['id'], '0' );
			}
		}
	}

}

if ( class_exists( 'Proteo_Testimonials_Metabox' ) ) {
	new Proteo_Testimonials_Metabox();
};
