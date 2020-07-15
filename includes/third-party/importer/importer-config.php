<?php
/**
 * Importer configuration file.
 *
 * @package YITH_Proteo_tookit
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard      = new YITH_Proteo_Wizard(
	$config  = array(
		'directory'            => 'includes/third-party/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'setup-wizard', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'ready_big_button_url' => get_site_url(), // Link for the big button on the ready step.
		'base_path'            => YITH_PROTEO_TOOLKIT_PATH,
		'base_url'             => YITH_PROTEO_TOOLKIT_URL,
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'yith-proteo-toolkit' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'yith-proteo-toolkit' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'yith-proteo-toolkit' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'yith-proteo-toolkit' ),

		'btn-skip'                 => esc_html__( 'Skip', 'yith-proteo-toolkit' ),
		'btn-next'                 => esc_html__( 'Next', 'yith-proteo-toolkit' ),
		'btn-start'                => esc_html__( 'Start', 'yith-proteo-toolkit' ),
		'btn-no'                   => esc_html__( 'Cancel', 'yith-proteo-toolkit' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'yith-proteo-toolkit' ),
		'btn-child-install'        => esc_html__( 'Install', 'yith-proteo-toolkit' ),
		'btn-content-install'      => esc_html__( 'Install', 'yith-proteo-toolkit' ),
		'btn-import'               => esc_html__( 'Import', 'yith-proteo-toolkit' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'yith-proteo-toolkit' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'yith-proteo-toolkit' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'yith-proteo-toolkit' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'yith-proteo-toolkit' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'yith-proteo-toolkit' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'yith-proteo-toolkit' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'yith-proteo-toolkit' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'yith-proteo-toolkit' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'yith-proteo-toolkit' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'yith-proteo-toolkit' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'yith-proteo-toolkit' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'yith-proteo-toolkit' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'yith-proteo-toolkit' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'yith-proteo-toolkit' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'yith-proteo-toolkit' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'yith-proteo-toolkit' ),

		'import-header'            => esc_html__( 'Import Content', 'yith-proteo-toolkit' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'yith-proteo-toolkit' ),
		'import-action-link'       => esc_html__( 'Advanced', 'yith-proteo-toolkit' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'yith-proteo-toolkit' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'yith-proteo-toolkit' ),
		'ready-action-link'        => esc_html__( 'Extras', 'yith-proteo-toolkit' ),
		'ready-big-button'         => esc_html__( 'View your website', 'yith-proteo-toolkit' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://docs.yithemes.com/yith-proteo/', esc_html__( 'Read the documentation', 'yith-proteo-toolkit' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start customizing Proteo', 'yith-proteo-toolkit' ) ),
	)
);

/**
 * Undocumented function
 *
 * @return array()
 */
function merlin_import_files() {
	return array(
		array(
			'import_file_name'           => 'Classic Shop',
			'import_file_url'            => 'https://proteo.yithemes.com/demo-content/classic-shop/proteo-wordpress-export.xml',
			'import_widget_file_url'     => 'https://proteo.yithemes.com/demo-content/classic-shop/proteo.yithemes.com-classic-shop-widgets.wie',
			'import_customizer_file_url' => 'https://proteo.yithemes.com/demo-content/classic-shop/yith-proteo-export.dat',
			'import_preview_image_url'   => 'https://proteo.yithemes.com/demo-content/classic-shop/screenshot.png',
			'import_notice'              => __( 'This demo uses the following plugins: WooCommerce, YITH Slider for page builders, CF7, Wishlist, YITH Product slider carousel. Please be sure to enable these plugins prior to proceed.', 'yith-proteo' ),
			'preview_url'                => 'https://proteo.yithemes.com/classic-shop/',
			'state'                      => 'live',
		),
		array(
			'import_file_name'           => 'Food',
			'import_file_url'            => '',
			'import_widget_file_url'     => '',
			'import_customizer_file_url' => '',
			'import_preview_image_url'   => 'https://proteo.yithemes.com/demo-content/food/food.jpg',
			'import_notice'              => '',
			'preview_url'                => '',
			'state'                      => 'coming-soon',
		),
		array(
			'import_file_name'           => 'Desire',
			'import_file_url'            => '',
			'import_widget_file_url'     => '',
			'import_customizer_file_url' => '',
			'import_preview_image_url'   => 'https://proteo.yithemes.com/demo-content/desire/desire.jpg',
			'import_notice'              => '',
			'preview_url'                => '',
			'state'                      => 'coming-soon',
		),
	);
}
add_filter( 'merlin_import_files', 'merlin_import_files' );


/**
 * Execute custom code after the whole import has finished.
 */
function prefix_merlin_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Front Page' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'merlin_after_all_import', 'prefix_merlin_after_import_setup' );


add_action( 'tgmpa_register', 'yith_proteo_toolkit_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function yith_proteo_toolkit_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'        => 'YITH WooCommerce Wishlist',
			'slug'        => 'yith-woocommerce-wishlist',
			'required'    => false,
			'is_callable' => 'YITH_WCWL_Premium',
		),

		array(
			'name'        => 'YITH WooCommerce Product Slider Carousel',
			'slug'        => 'yith-woocommerce-product-slider-carousel',
			'required'    => false,
			'is_callable' => 'YITH_WooCommerce_Product_Slider_Premium',
		),

		array(
			'name'     => 'YITH Slider for page builders',
			'slug'     => 'yith-slider-for-page-builders',
			'required' => false,
		),

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),

		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => true,
		),

	);

	$config = array(
		'id'           => 'yith-proteo-toolkit',   // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
