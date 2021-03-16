<?php
/**
 *
 * Add a custom filed in the categoy
 *
 * @package YITH Proteo Toolkit
 */

add_action( 'init', 'wpm_product_cat_register_meta' );

/**
 * Register details product_cat meta.
 *
 * Register the details metabox for WooCommerce product categories.
 *
 */
function wpm_product_cat_register_meta() {
	register_meta( 'term', 'details', 'wpm_sanitize_details' );
}
/**
 * Sanitize the details custom meta field.
 *
 * @param  string $details The existing details field.
 * @return string          The sanitized details field
 */
function wpm_sanitize_details( $details ) {
	return wp_kses_post( $details );
}

add_action( 'product_cat_add_form_fields', 'wpm_product_cat_add_details_meta' );
/**
 * Add a details metabox to the Add New Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * creating new product categories in WooCommerce.
 *
 */
function wpm_product_cat_add_details_meta() {
	wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' );
	?>
	<div class="form-field">
		<label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label>
		<textarea name="wpm-product-cat-details" id="wpm-product-cat-details" rows="5" cols="40"></textarea>
		<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list', 'wpm' ); ?></p>
	</div>
	<?php
}
add_action( 'product_cat_edit_form_fields', 'wpm_product_cat_edit_details_meta' );
/**
 * Add a details metabox to the Edit Product Category page.
 *
 * For adding a details metabox to the WordPress admin when
 * editing an existing product category in WooCommerce.
 *
 * @param  object $term The existing term object.
 */
function wpm_product_cat_edit_details_meta( $term ) {
	$product_cat_details = get_term_meta( $term->term_id, 'details', true );
	if ( ! $product_cat_details ) {
		$product_cat_details = '';
	}
	$settings = array( 'textarea_name' => 'wpm-product-cat-details' );
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="wpm-product-cat-details"><?php esc_html_e( 'Details', 'wpm' ); ?></label></th>
		<td>
			<?php wp_nonce_field( basename( __FILE__ ), 'wpm_product_cat_details_nonce' ); ?>
			<?php wp_editor( wpm_sanitize_details( $product_cat_details ), 'product_cat_details', $settings ); ?>
			<p class="description"><?php esc_html_e( 'Detailed category info to appear below the product list','wpm' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'create_product_cat', 'wpm_product_cat_details_meta_save' );
add_action( 'edit_product_cat', 'wpm_product_cat_details_meta_save' );
/**
 * Save Product Category details meta.
 *
 * Save the product_cat details meta POSTed from the
 * edit product_cat page or the add product_cat page.
 *
 * @param  int $term_id The term ID of the term to update.
 */
function wpm_product_cat_details_meta_save( $term_id ) {
	if ( ! isset( $_POST['wpm_product_cat_details_nonce'] ) || ! wp_verify_nonce( $_POST['wpm_product_cat_details_nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	$old_details = get_term_meta( $term_id, 'details', true );
	$new_details = isset( $_POST['wpm-product-cat-details'] ) ? $_POST['wpm-product-cat-details'] : '';
	if ( $old_details && '' === $new_details ) {
		delete_term_meta( $term_id, 'details' );
	} else if ( $old_details !== $new_details ) {
		update_term_meta(
			$term_id,
			'details',
			wpm_sanitize_details( $new_details )
		);
	}
}
add_action( 'woocommerce_after_shop_loop', 'wpm_product_cat_display_details_meta' );
/**
 * Display details meta on Product Category archives.
 *
 */
function wpm_product_cat_display_details_meta() {
	if ( ! is_tax( 'product_cat' ) ) {
		return;
	}
	$t_id = get_queried_object()->term_id;
	$details = get_term_meta( $t_id, 'details', true );
	if ( '' !== $details ) {
		?>
		<div class="col-md-12">
		<div class="product-cat-details">
			<?php echo apply_filters( 'the_content', wp_kses_post( $details ) ); ?>
		</div>
		</div>
		<?php
	}
}
