<?php
/**
 * Importer configuration file.
 *
 * @package YITH_Proteo_tookit
 */

if ( ! class_exists( 'YITH_Proteo_Wizard' ) ) {
	return;
}

global $proteo_setup_wizard;


/**
 * Set directory locations, text strings, and settings.
 */
$config = array(
	'directory'            => 'includes/third-party/importer', // Location / directory where YITH_Proteo_Wizard is placed in your theme.
	'wizard_url'           => 'setup-wizard', // The wp-admin page slug where YITH_Proteo_Wizard loads.
	'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
	'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
	'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
	'dev_mode'             => true, // Enable development mode for testing.
	'ready_big_button_url' => get_site_url(), // Link for the big button on the ready step.
	'base_path'            => YITH_PROTEO_TOOLKIT_PATH,
	'base_url'             => YITH_PROTEO_TOOLKIT_URL,
);

$strings = array(
	'admin-menu'               => esc_html__( 'Theme Setup', 'yith-proteo-toolkit' ),

	/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
	'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'yith-proteo-toolkit' ),
	'return-to-dashboard'      => esc_html__( 'Close and return to the dashboard', 'yith-proteo-toolkit' ),
	'ignore'                   => esc_html__( 'Close this wizard', 'yith-proteo-toolkit' ),

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
	'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import demo content. It is optional & should take only a few minutes.', 'yith-proteo-toolkit' ),
	'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'yith-proteo-toolkit' ),

	'child-header'             => esc_html__( 'Create and install Child Theme', 'yith-proteo-toolkit' ),
	'child-header-success'     => esc_html__( 'You\'re good to go!', 'yith-proteo-toolkit' ),
	'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'yith-proteo-toolkit' ),
	'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'yith-proteo-toolkit' ),
	'child-action-link'        => esc_html__( 'Learn about child themes', 'yith-proteo-toolkit' ),
	'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'yith-proteo-toolkit' ),
	'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'yith-proteo-toolkit' ),

	'plugins-header'           => esc_html__( 'Install Plugins', 'yith-proteo-toolkit' ),
	'plugins-header-success'   => esc_html__( 'You\'re ready for demo contents!', 'yith-proteo-toolkit' ),
	'plugins'                  => esc_html__( 'Let\'s install and activate some essential plugins to get your site ready for demo contents.', 'yith-proteo-toolkit' ),
	'plugins-success%s'        => esc_html__( 'The required plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'yith-proteo-toolkit' ),
	'plugins-action-link'      => esc_html__( 'Advanced', 'yith-proteo-toolkit' ),

	'import-header'            => esc_html__( 'Import Content', 'yith-proteo-toolkit' ),
	'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'yith-proteo-toolkit' ),
	'import-action-link'       => esc_html__( 'Advanced', 'yith-proteo-toolkit' ),

	'ready-header'             => esc_html__( 'All done. Have fun!', 'yith-proteo-toolkit' ),

	/* translators: Theme Author */
	'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'yith-proteo-toolkit' ),
	'ready-action-link'        => esc_html__( 'Extras', 'yith-proteo-toolkit' ),
	'ready-big-button'         => esc_html__( 'View your website', 'yith-proteo-toolkit' ),
	'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://docs.yithemes.com/yith-proteo/', esc_html__( 'Read YITH Proteo theme documentation', 'yith-proteo-toolkit' ) ),
	'ready-link-2'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start customizing your theme', 'yith-proteo-toolkit' ) ),
);

$proteo_setup_wizard = new YITH_Proteo_Wizard(
	$config,
	$strings
);

/**
 * Undocumented function
 *
 * @return array()
 */
function wizard_import_files() {
	return array(
		array(
			'import_file_name'           => 'Classic Shop',
			'import_file_url'            => 'https://update.yithemes.com/proteo-demo-content/classic-shop/proteo-wordpress-export.xml',
			'import_widget_file_url'     => 'https://update.yithemes.com/proteo-demo-content/classic-shop/proteo.yithemes.com-classic-shop-widgets.wie',
			'import_customizer_file_url' => 'https://update.yithemes.com/proteo-demo-content/classic-shop/yith-proteo-export.json',
			'import_preview_image_url'   => 'https://update.yithemes.com/proteo-demo-content/classic-shop/screenshot.png',
			'import_notice'              => __( 'This demo uses the following plugins: WooCommerce, YITH Slider for page builders, CF7, Wishlist, YITH Product slider carousel. Please be sure to enable these plugins prior to proceed.', 'yith-proteo' ),
			'preview_url'                => 'https://proteo.yithemes.com/classic-shop/',
			'state'                      => 'live',
			'front_page_title'           => 'Front Page',
			'blog_page_title'            => 'Blog',
			'primary_menu_name'          => 'Primary',
		),
		array(
			'import_file_name'           => 'Food',
			'import_file_url'            => 'https://update.yithemes.com/proteo-demo-content/food/proteo-food-wordpress-export.xml',
			'import_widget_file_url'     => 'https://update.yithemes.com/proteo-demo-content/food/proteo.yithemes.com-food-widgets.wie',
			'import_customizer_file_url' => 'https://update.yithemes.com/proteo-demo-content/food/yith-proteo-export.json',
			'import_preview_image_url'   => 'https://update.yithemes.com/proteo-demo-content/food/food.jpg',
			'import_notice'              => __( 'This demo uses the following plugins: WooCommerce, YITH Slider for page builders, CF7, EditorsKit, YITH Wishlist, YITH Product slider carousel. Please be sure to enable these plugins prior to proceed.', 'yith-proteo' ),
			'preview_url'                => 'https://proteo.yithemes.com/food/',
			'state'                      => 'live',
			'front_page_title'           => 'Food Home 1',
			'blog_page_title'            => 'Blog',
			'primary_menu_name'          => 'Food Main Menu',
		),
		array(
			'import_file_name'           => 'Desire',
			'import_file_url'            => '',
			'import_widget_file_url'     => '',
			'import_customizer_file_url' => '',
			'import_preview_image_url'   => 'https://update.yithemes.com/proteo-demo-content/desire/desire.jpg',
			'import_notice'              => '',
			'preview_url'                => '',
			'state'                      => 'coming-soon',
			'front_page_title'           => '',
			'blog_page_title'            => '',
			'primary_menu_name'          => '',
		),
	);
}
add_filter( 'wizard_import_files', 'wizard_import_files' );


/**
 * Execute custom code after the whole import has finished.
 *
 * @param int $demo_index The demo index.
 */
function prefix_wizard_after_import_setup( $demo_index ) {
	global $proteo_setup_wizard;

	$demo_configuration_variables = $proteo_setup_wizard->import_files[ $demo_index ];

	if ( empty( $demo_configuration_variables ) ) {
		$demo_configuration_variables = array(
			'front_page_title'  => 'Front Page',
			'blog_page_title'   => 'Blog',
			'primary_menu_name' => 'Primary',
		);
	}

	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', $demo_configuration_variables['primary_menu_name'], 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( $demo_configuration_variables['front_page_title'] );
	$blog_page_id  = get_page_by_title( $demo_configuration_variables['blog_page_title'] );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	if ( function_exists( 'wc' ) ) {
		$shop_page      = get_page_by_path( 'shop' );
		$cart_page      = get_page_by_path( 'cart' );
		$checkout_page  = get_page_by_path( 'checkout' );
		$myaccount_page = get_page_by_path( 'my-account' );

		if ( $shop_page ) {
			update_option( 'woocommerce_shop_page_id', $shop_page->ID );
		}
		if ( $cart_page ) {
			update_option( 'woocommerce_cart_page_id', $cart_page->ID );
		}
		if ( $checkout_page ) {
			update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
		}
		if ( $myaccount_page ) {
			update_option( 'woocommerce_myaccount_page_id', $myaccount_page->ID );
		}
	}

	$myaccount_widgets = get_option( 'widget_yith_proteo_account_widget', array() );
	if ( ! empty( $myaccount_widgets ) ) {
		foreach ( $myaccount_widgets as & $myaccount_widget ) {
			$myaccount_widget['login-url']     = str_replace( 'https://proteo.yithemes.com', untrailingslashit( site_url() ), $myaccount_widget['login-url'] );
			$myaccount_widget['myaccount-url'] = str_replace( 'https://proteo.yithemes.com', untrailingslashit( site_url() ), $myaccount_widget['myaccount-url'] );
		}
		update_option( 'widget_yith_proteo_account_widget', $myaccount_widgets );
	}

}
add_action( 'wizard_after_all_import', 'prefix_wizard_after_import_setup' );


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

		array(
			'name'     => 'EditorsKit',
			'slug'     => 'block-options',
			'required' => false,
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
