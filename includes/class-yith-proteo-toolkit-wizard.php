<?php
/**
 * YITH Proteo Toolkit Wizard class
 *
 * @package YITH_Proteo_tookit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'YITH_Proteo_Toolkit_Wizard' ) ) {
	/**
	 * Proteo Toolkit Wizard class.
	 *
	 * @access private
	 */
	class YITH_Proteo_Toolkit_Wizard {
		/**
		 * Constructor
		 */
		public function __construct() {

			// Load setup wizard.
			add_action( 'init', array( $this, 'load_tookit_wizard' ) );

			add_action( 'admin_init', array( $this, 'run_first_setup' ), 5 );

			register_activation_hook( __FILE__, array( $this, 'run_first_setup' ) );

			add_action( 'admin_init', array( $this, 'run_setup' ), 10 );

			add_filter( 'wizard_regenerate_thumbnails_in_content_import', '__return_false' );

			add_action( 'get_template_part_wizard/assets/images/spinner', array( $this, 'loading_spinner_icon_fix' ) );

			add_action( 'init', array( $this, 'remove_elementor_splash' ) );

			// Disable WooCommerce spash screen when activating.
			add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );
		}

		/**
		 * Load setup wizard
		 *
		 * @return void
		 */
		public function load_tookit_wizard() {

			if ( ! yith_proteo_toolkit_can_be_enabled() ) {
				add_action( 'admin_notices', 'yith_proteo_toolkit_admin_notice' );
				add_action( 'admin_init', 'yith_proteo_toolkit_disable' );
				return;
			}

			add_action( 'load-setup-wizard', 'set_current_screen' );

			require_once YITH_PROTEO_TOOLKIT_PATH . 'includes/third-party/importer/vendor/autoload.php';
			require_once YITH_PROTEO_TOOLKIT_PATH . 'includes/third-party/importer/class-yith-proteo-wizard.php';
			require_once YITH_PROTEO_TOOLKIT_PATH . 'includes/third-party/importer/importer-config.php';
		}

		/**
		 * Check setup wizard status
		 *
		 * @return void
		 */
		public function run_first_setup() {
			global $pagenow;

			if ( ! yith_proteo_toolkit_can_be_enabled() || ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Read-only routing check; mutating options requires manage_options above.
			$current_query_string = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			if ( 'themes.php' === $pagenow && 'setup-wizard' === $current_query_string && ! get_option( 'yith_proteo_toolkit_first_setup_run' ) ) {
				update_option( 'yith_proteo_toolkit_first_setup_run', time() );
			}

			if ( get_option( 'yith_proteo_toolkit_first_setup_run' ) || ( 'themes.php' === $pagenow && 'setup-wizard' === $current_query_string ) ) {
				return;
			}

			update_option( 'yith_proteo_toolkit_run_setup', time() );
		}

		/**
		 * Redirect to setup wizard on first run
		 *
		 * @return void
		 */
		public function run_setup() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			if ( get_option( 'yith_proteo_toolkit_run_setup' ) ) {
				delete_option( 'yith_proteo_toolkit_run_setup' );
				wp_safe_redirect( admin_url( 'themes.php?page=setup-wizard' ) );
				exit;
			}
		}

		/**
		 * Spinner Icon change
		 */
		public function loading_spinner_icon_fix() {
			require_once 'includes/third-party/importer/assets/images/spinner.php';
		}


		/**
		 * Disable Elementor spash screen when activating
		 *
		 * @return void
		 */
		public function remove_elementor_splash() {
			if ( ! yith_proteo_toolkit_can_be_enabled() ) {
				delete_transient( 'elementor_activation_redirect' );
			}
		}
	}

}
new YITH_Proteo_Toolkit_Wizard();
