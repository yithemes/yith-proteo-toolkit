<?php
/**
 * Useful functions
 *
 * @package YITH_Proteo_tookit
 */

/**
 * Get the setup wizard logo URL.
 *
 * @return string
 */
function yith_proteo_toolkit_get_wizard_logo_url() {
	$plugin_logo = YITH_PROTEO_TOOLKIT_PATH . 'assets/img/proteo-logo.png';

	if ( file_exists( $plugin_logo ) ) {
		return YITH_PROTEO_TOOLKIT_URL . 'assets/img/proteo-logo.png';
	}

	if ( defined( 'YITH_PROTEO_VERSION' ) ) {
		$theme_logo = get_template_directory() . '/img/proteo-logo.png';
		if ( file_exists( $theme_logo ) ) {
			return get_template_directory_uri() . '/img/proteo-logo.png';
		}
	}

	return YITH_PROTEO_TOOLKIT_URL . 'assets/img/child-theme.svg';
}

/**
 * Display a navigation bar in setup wizard box
 *
 * @param string $step Current active step.
 * @return void
 */
function yith_proteo_toolkit_wizard_step_icon( $step = null ) {
	$allowed_steps = array( 'child', 'skin', 'plugins', 'content', 'done' );
	$active_step   = in_array( $step, $allowed_steps, true ) ? $step : '';
	?>
	<div class="yith-proteo-toolkit-wizard-nav">
		<ul class="steps">
			<li class="step <?php echo 'child' === $active_step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/child-theme.svg" width="30" alt="">
			</li>
			<li class="step <?php echo 'skin' === $active_step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/art.svg" width="30" alt="">
			</li>
			<li class="step <?php echo 'plugins' === $active_step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/plugin.svg" width="30" alt="">
			</li>
			<li class="step <?php echo 'content' === $active_step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/content.svg" width="30" alt="">
			</li>
			<li class="step <?php echo 'done' === $active_step ? 'active' : ''; ?>">
				<img src="<?php echo esc_url( YITH_PROTEO_TOOLKIT_URL ); ?>assets/img/done.svg" width="30" alt="">
			</li>
		</ul>
	</div>
	<?php
}

/**
 * Disable plugin
 *
 * @return void
 */
function yith_proteo_toolkit_disable() {
	deactivate_plugins( plugin_basename( YITH_PROTEO_TOOLKIT_PATH . 'yith-proteo-toolkit.php' ) );
}

/**
 * Check if plugin may be enabled
 */
function yith_proteo_toolkit_can_be_enabled() {
	return defined( 'YITH_PROTEO_VERSION' );
}

/**
 * Show admin notice when Proteo theme is not enabled
 *
 * @return void
 */
function yith_proteo_toolkit_admin_notice() {
	?>
	<div class="error">
		<?php /* translators: %1$1s: plugin name; %2$2s: theme name; */ ?>
		<p><?php printf( esc_html__( '%1$1s is meant to be used with %2$2s theme.', 'yith-proteo-toolkit' ), '<b>YITH Proteo Toolkit</b>', '<b>YITH Proteo</b>' ); ?></p>
	</div>
	<?php
}
