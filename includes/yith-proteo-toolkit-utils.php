<?php
/**
 * Useful functions
 *
 * @package YITH_Proteo_tookit
 */

/**
 * Display a navigation bar in setup wizard box
 *
 * @param string $step Current active step.
 * @return void
 */
function yith_proteo_toolkit_wizard_step_icon( $step = null ) {
	?>
	<div class="yith-proteo-toolkit-wizard-nav">
		<ul class="steps">
			<li class="step <?php echo 'child' === $step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/child-theme.svg" width="30">
			</li>
			<li class="step <?php echo 'skin' === $step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/art.svg" width="30">
			</li>
			<li class="step <?php echo 'plugins' === $step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/plugin.svg" width="30">
			</li>
			<li class="step <?php echo 'content' === $step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/content.svg" width="30">
			</li>
			<li class="step <?php echo 'done' === $step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/done.svg" width="30">
			</li>
		</ul>
	</div>
	<?php
}


/**
 * Module sidebar template
 *
 * @return void
 */
function yith_proteo_toolkit_modules_sidebar_panel() {
	$modules_active                   = get_option( 'yith_proteo_toolkit_modules_active', array() );
	$is_testimonial_module_enabled    = isset( $modules_active['yith-proteo-toolkit-testimonial'] ) ? $modules_active['yith-proteo-toolkit-testimonial'] : true;
	$is_faq_module_enabled            = isset( $modules_active['yith-proteo-toolkit-faq'] ) ? $modules_active['yith-proteo-toolkit-faq'] : true;
	$is_block_patterns_module_enabled = isset( $modules_active['yith-proteo-toolkit-block-patterns'] ) ? $modules_active['yith-proteo-toolkit-block-patterns'] : true;
	?>
	<div class="content">
		<h3>
			<?php esc_html_e( 'Proteo toolkit modules', 'yith-proteo-toolkit' ); ?>
		</h3>
		<ul id="yith-proteo-toolkit-modules">
			<li>
				<span class="module-name">- <?php echo esc_html_x( 'Testimonials', 'Proteo Toolkit module name.', 'yith-proteo' ); ?></span>
				<span class="form-switch <?php echo $is_testimonial_module_enabled ? 'enabled' : ''; ?>"
					data-option_id="yith-proteo-toolkit-testimonial">
				</span>
			</li>
			<li>
				<span class="module-name">- <?php echo esc_html_x( 'FAQ', 'Proteo Toolkit module name.', 'yith-proteo' ); ?></span>
				<span class="form-switch  <?php echo $is_faq_module_enabled ? 'enabled' : ''; ?>"
					data-option_id="yith-proteo-toolkit-faq">
				</span>
			</li>
			<li>
				<span class="module-name">- <?php echo esc_html_x( 'Block patterns', 'Proteo Toolkit module name.', 'yith-proteo' ); ?></span>
				<span class="form-switch  <?php echo $is_block_patterns_module_enabled ? 'enabled' : ''; ?>"
					data-option_id="yith-proteo-toolkit-block-patterns">
				</span>
			</li>
		</ul>
	</div>
	<?php
}

/**
 * Save Toolkit modules state.
 *
 * @return void
 */
function yith_proteo_toolkit_save_module_ajax() {
	$nonce = ( isset( $_REQUEST['nonce'] ) ) ? sanitize_key( $_REQUEST['nonce'] ) : '';

	if ( false === wp_verify_nonce( $nonce, 'yith-proteo-toolkit-modules-nonce' ) ) {
		wp_send_json_error( esc_html_e( 'WordPress Nonce not validated.', 'yith-proteo' ) );
	}

	if ( ! isset( $_REQUEST['action'] ) || 'yith_proteo_toolkit_module_save' !== $_REQUEST['action'] || ! isset( $_REQUEST['id'] ) ) {
		die();
	}

	$id                    = sanitize_text_field( wp_unslash( $_REQUEST['id'] ) );
	$modules_active        = get_option( 'yith_proteo_toolkit_modules_active', array() );
	$modules_active[ $id ] = isset( $modules_active[ $id ] ) ? ! $modules_active[ $id ] : false;

	$success = update_option( 'yith_proteo_toolkit_modules_active', $modules_active );
	wp_send_json(
		array(
			'success' => $success,
		)
	);
}
