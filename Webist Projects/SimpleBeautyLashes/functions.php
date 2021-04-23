<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants.
define( 'OCEANWP_THEME_DIR', get_template_directory() );
define( 'OCEANWP_THEME_URI', get_template_directory_uri() );

/**
 * OceanWP theme class
 */
final class OCEANWP_Theme_Class {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		// Define theme constants.
		$this->oceanwp_constants();

		// Load required files.
		$this->oceanwp_has_setup();

		// Load framework classes.
		add_action( 'after_setup_theme', array( 'OCEANWP_Theme_Class', 'classes' ), 4 );

		// Setup theme => add_theme_support, register_nav_menus, load_theme_textdomain, etc.
		add_action( 'after_setup_theme', array( 'OCEANWP_Theme_Class', 'theme_setup' ), 10 );

		// Setup theme => Generate the custom CSS file.
		add_action( 'admin_bar_init', array( 'OCEANWP_Theme_Class', 'save_customizer_css_in_file' ), 9999 );

		// register sidebar widget areas.
		add_action( 'widgets_init', array( 'OCEANWP_Theme_Class', 'register_sidebars' ) );

		// Registers theme_mod strings into Polylang.
		if ( class_exists( 'Polylang' ) ) {
			add_action( 'after_setup_theme', array( 'OCEANWP_Theme_Class', 'polylang_register_string' ) );
		}

		/** Admin only actions */
		if ( is_admin() ) {

			// Load scripts in the WP admin.
			add_action( 'admin_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'admin_scripts' ) );

			// Outputs custom CSS for the admin.
			add_action( 'admin_head', array( 'OCEANWP_Theme_Class', 'admin_inline_css' ) );

			/** Non Admin actions */
		} else {

			// Load theme CSS.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'theme_css' ) );

			// Load his file in last.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'custom_style_css' ), 9999 );

			// Remove Customizer CSS script from Front-end.
			add_action( 'init', array( 'OCEANWP_Theme_Class', 'remove_customizer_custom_css' ) );

			// Load theme js.
			add_action( 'wp_enqueue_scripts', array( 'OCEANWP_Theme_Class', 'theme_js' ) );

			// Add a pingback url auto-discovery header for singularly identifiable articles.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'pingback_header' ), 1 );

			// Add meta viewport tag to header.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'meta_viewport' ), 1 );

			// Add an X-UA-Compatible header.
			add_filter( 'wp_headers', array( 'OCEANWP_Theme_Class', 'x_ua_compatible_headers' ) );

			// Loads html5 shiv script.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'html5_shiv' ) );

			// Outputs custom CSS to the head.
			add_action( 'wp_head', array( 'OCEANWP_Theme_Class', 'custom_css' ), 9999 );

			// Minify the WP custom CSS because WordPress doesn't do it by default.
			add_filter( 'wp_get_custom_css', array( 'OCEANWP_Theme_Class', 'minify_custom_css' ) );

			// Alter the search posts per page.
			add_action( 'pre_get_posts', array( 'OCEANWP_Theme_Class', 'search_posts_per_page' ) );

			// Alter WP categories widget to display count inside a span.
			add_filter( 'wp_list_categories', array( 'OCEANWP_Theme_Class', 'wp_list_categories_args' ) );

			// Add a responsive wrapper to the WordPress oembed output.
			add_filter( 'embed_oembed_html', array( 'OCEANWP_Theme_Class', 'add_responsive_wrap_to_oembeds' ), 99, 4 );

			// Adds classes the post class.
			add_filter( 'post_class', array( 'OCEANWP_Theme_Class', 'post_class' ) );

			// Add schema markup to the authors post link.
			add_filter( 'the_author_posts_link', array( 'OCEANWP_Theme_Class', 'the_author_posts_link' ) );

			// Add support for Elementor Pro locations.
			add_action( 'elementor/theme/register_locations', array( 'OCEANWP_Theme_Class', 'register_elementor_locations' ) );

			// Remove the default lightbox script for the beaver builder plugin.
			add_filter( 'fl_builder_override_lightbox', array( 'OCEANWP_Theme_Class', 'remove_bb_lightbox' ) );

		}

	}

	/**
	 * Define Constants
	 *
	 * @since   1.0.0
	 */
	public static function oceanwp_constants() {

		$version = self::theme_version();

		// Theme version.
		define( 'OCEANWP_THEME_VERSION', $version );

		// Javascript and CSS Paths.
		define( 'OCEANWP_JS_DIR_URI', OCEANWP_THEME_URI . '/assets/js/' );
		define( 'OCEANWP_CSS_DIR_URI', OCEANWP_THEME_URI . '/assets/css/' );

		// Include Paths.
		define( 'OCEANWP_INC_DIR', OCEANWP_THEME_DIR . '/inc/' );
		define( 'OCEANWP_INC_DIR_URI', OCEANWP_THEME_URI . '/inc/' );

		// Check if plugins are active.
		define( 'OCEAN_EXTRA_ACTIVE', class_exists( 'Ocean_Extra' ) );
		define( 'OCEANWP_ELEMENTOR_ACTIVE', class_exists( 'Elementor\Plugin' ) );
		define( 'OCEANWP_BEAVER_BUILDER_ACTIVE', class_exists( 'FLBuilder' ) );
		define( 'OCEANWP_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		define( 'OCEANWP_EDD_ACTIVE', class_exists( 'Easy_Digital_Downloads' ) );
		define( 'OCEANWP_LIFTERLMS_ACTIVE', class_exists( 'LifterLMS' ) );
		define( 'OCEANWP_ALNP_ACTIVE', class_exists( 'Auto_Load_Next_Post' ) );
		define( 'OCEANWP_LEARNDASH_ACTIVE', class_exists( 'SFWD_LMS' ) );
	}

	/**
	 * Load all core theme function files
	 *
	 * @since 1.0.0oceanwp_has_setup
	 */
	public static function oceanwp_has_setup() {

		$dir = OCEANWP_INC_DIR;

		require_once $dir . 'helpers.php';
		require_once $dir . 'header-content.php';
		require_once $dir . 'oceanwp-strings.php';
		require_once $dir . 'oceanwp-theme-icons.php';
		require_once $dir . 'customizer/controls/typography/webfonts.php';
		require_once $dir . 'walker/init.php';
		require_once $dir . 'walker/menu-walker.php';
		require_once $dir . 'third/class-gutenberg.php';
		require_once $dir . 'third/class-elementor.php';
		require_once $dir . 'third/class-beaver-themer.php';
		require_once $dir . 'third/class-bbpress.php';
		require_once $dir . 'third/class-buddypress.php';
		require_once $dir . 'third/class-lifterlms.php';
		require_once $dir . 'third/class-learndash.php';
		require_once $dir . 'third/class-sensei.php';
		require_once $dir . 'third/class-social-login.php';
		require_once $dir . 'third/class-amp.php';
		require_once $dir . 'third/class-pwa.php';

		// WooCommerce.
		if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {
			require_once $dir . 'woocommerce/woocommerce-config.php';
		}

		// Easy Digital Downloads.
		if ( OCEANWP_EDD_ACTIVE ) {
			require_once $dir . 'edd/edd-config.php';
		}

	}

	/**
	 * Returns current theme version
	 *
	 * @since   1.0.0
	 */
	public static function theme_version() {

		// Get theme data.
		$theme = wp_get_theme();

		// Return theme version.
		return $theme->get( 'Version' );

	}

	/**
	 * Compare WordPress version
	 *
	 * @access public
	 * @since 1.8.3
	 * @param  string $version - A WordPress version to compare against current version.
	 * @return boolean
	 */
	public static function is_wp_version( $version = '5.4' ) {

		global $wp_version;

		// WordPress version.
		return version_compare( strtolower( $wp_version ), strtolower( $version ), '>=' );

	}


	/**
	 * Check for AMP endpoint
	 *
	 * @return bool
	 * @since 1.8.7
	 */
	public static function oceanwp_is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}

	/**
	 * Load theme classes
	 *
	 * @since   1.0.0
	 */
	public static function classes() {

		// Admin only classes.
		if ( is_admin() ) {

			// Recommend plugins.
			require_once OCEANWP_INC_DIR . 'plugins/class-tgm-plugin-activation.php';
			require_once OCEANWP_INC_DIR . 'plugins/tgm-plugin-activation.php';

			// Front-end classes.
		} else {

			// Breadcrumbs class.
			require_once OCEANWP_INC_DIR . 'breadcrumbs.php';

		}

		// Customizer class.
		require_once OCEANWP_INC_DIR . 'customizer/customizer.php';

	}

	/**
	 * Theme Setup
	 *
	 * @since   1.0.0
	 */
	public static function theme_setup() {

		// Load text domain.
		load_theme_textdomain( 'oceanwp', OCEANWP_THEME_DIR . '/languages' );

		// Get globals.
		global $content_width;

		// Set content width based on theme's default design.
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		// Register navigation menus.
		register_nav_menus(
			array(
				'topbar_menu' => esc_html__( 'Top Bar', 'oceanwp' ),
				'main_menu'   => esc_html__( 'Main', 'oceanwp' ),
				'footer_menu' => esc_html__( 'Footer', 'oceanwp' ),
				'mobile_menu' => esc_html__( 'Mobile (optional)', 'oceanwp' ),
			)
		);

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

		// Enable support for <title> tag.
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for header image
		 */
		add_theme_support(
			'custom-header',
			apply_filters(
				'ocean_custom_header_args',
				array(
					'width'       => 2000,
					'height'      => 1200,
					'flex-height' => true,
					'video'       => true,
				)
			)
		);

		/**
		 * Enable support for site logo
		 */
		add_theme_support(
			'custom-logo',
			apply_filters(
				'ocean_custom_logo_args',
				array(
					'height'      => 45,
					'width'       => 164,
					'flex-height' => true,
					'flex-width'  => true,
				)
			)
		);

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			)
		);

		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add editor style.
		add_editor_style( 'assets/css/editor-style.min.css' );

		// Declare support for selective refreshing of widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.1.0
	 */
	public static function pingback_header() {

		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}

	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.0.0
	 */
	public static function meta_viewport() {

		// Meta viewport.
		$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';

		// Apply filters for child theme tweaking.
		echo apply_filters( 'ocean_meta_viewport', $viewport ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}

	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0.0
	 */
	public static function admin_scripts() {
		global $pagenow;
		if ( 'nav-menus.php' === $pagenow ) {
			wp_enqueue_style( 'oceanwp-menus', OCEANWP_INC_DIR_URI . 'walker/assets/menus.css', false, OCEANWP_THEME_VERSION );
		}
	}

	/**
	 * Load front-end scripts
	 *
	 * @since   1.0.0
	 */
	public static function theme_css() {

		// Define dir.
		$dir           = OCEANWP_CSS_DIR_URI;
		$theme_version = OCEANWP_THEME_VERSION;

		// Remove font awesome style from plugins.
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );

		// Load font awesome style.
		wp_enqueue_style( 'font-awesome', OCEANWP_THEME_URI . '/assets/fonts/fontawesome/css/all.min.css', false, '5.15.1' );

		// Register simple line icons style.
		wp_enqueue_style( 'simple-line-icons', $dir . 'third/simple-line-icons.min.css', false, '2.4.0' );

		// Register the lightbox style.
		wp_enqueue_style( 'magnific-popup', $dir . 'third/magnific-popup.min.css', false, '1.0.0' );

		// Register the slick style.
		wp_enqueue_style( 'slick', $dir . 'third/slick.min.css', false, '1.6.0' );

		// Main Style.css File.
		wp_enqueue_style( 'oceanwp-style', $dir . 'style.min.css', false, $theme_version );

		// Register hamburgers buttons to easily use them.
		wp_register_style( 'oceanwp-hamburgers', $dir . 'third/hamburgers/hamburgers.min.css', false, $theme_version );

		// Register hamburgers buttons styles.
		$hamburgers = oceanwp_hamburgers_styles();
		foreach ( $hamburgers as $class => $name ) {
			wp_register_style( 'oceanwp-' . $class . '', $dir . 'third/hamburgers/types/' . $class . '.css', false, $theme_version );
		}

		// Get mobile menu icon style.
		$mobileMenu = get_theme_mod( 'ocean_mobile_menu_open_hamburger', 'default' );

		// Enqueue mobile menu icon style.
		if ( ! empty( $mobileMenu ) && 'default' !== $mobileMenu ) {
			wp_enqueue_style( 'oceanwp-hamburgers' );
			wp_enqueue_style( 'oceanwp-' . $mobileMenu . '' );
		}

		// If Vertical header style.
		if ( 'vertical' === oceanwp_header_style() ) {
			wp_enqueue_style( 'oceanwp-hamburgers' );
			wp_enqueue_style( 'oceanwp-spin' );
		}

	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since 1.0.0
	 */
	public static function theme_js() {

		if ( self::oceanwp_is_amp() ) {
			return;
		}

		// Get js directory uri.
		$dir = OCEANWP_JS_DIR_URI;

		// Get current theme version.
		$theme_version = OCEANWP_THEME_VERSION;

		// Get localized array.
		$localize_array = self::localize_array();

		// Comment reply.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Add images loaded.
		wp_enqueue_script( 'imagesloaded' );

		// Register nicescroll script to use it in some extensions.
		wp_register_script( 'nicescroll', $dir . 'third/nicescroll.min.js', array( 'jquery' ), $theme_version, true );

		// Enqueue nicescroll script if vertical header style.
		if ( 'vertical' === oceanwp_header_style() ) {
			wp_enqueue_script( 'nicescroll' );
		}

		// Register Infinite Scroll script.
		wp_register_script( 'infinitescroll', $dir . 'third/infinitescroll.min.js', array( 'jquery' ), $theme_version, true );

		// WooCommerce scripts.
		if ( OCEANWP_WOOCOMMERCE_ACTIVE
			&& 'yes' !== get_theme_mod( 'ocean_woo_remove_custom_features', 'no' ) ) {
			wp_enqueue_script( 'oceanwp-woocommerce', $dir . 'third/woo/woo-scripts.min.js', array( 'jquery' ), $theme_version, true );
		}

		// Load the lightbox scripts.
		wp_enqueue_script( 'magnific-popup', $dir . 'third/magnific-popup.min.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'oceanwp-lightbox', $dir . 'third/lightbox.min.js', array( 'jquery' ), $theme_version, true );

		// Load minified js.
		wp_enqueue_script( 'oceanwp-main', $dir . 'main.min.js', array( 'jquery' ), $theme_version, true );

		// Localize array.
		wp_localize_script( 'oceanwp-main', 'oceanwpLocalize', $localize_array );

	}

	/**
	 * Functions.js localize array
	 *
	 * @since 1.0.0
	 */
	public static function localize_array() {

		// Create array.
		$sidr_side   = get_theme_mod( 'ocean_mobile_menu_sidr_direction', 'left' );
		$sidr_side   = $sidr_side ? $sidr_side : 'left';
		$sidr_target = get_theme_mod( 'ocean_mobile_menu_sidr_dropdown_target', 'link' );
		$sidr_target = $sidr_target ? $sidr_target : 'link';
		$vh_target   = get_theme_mod( 'ocean_vertical_header_dropdown_target', 'link' );
		$vh_target   = $vh_target ? $vh_target : 'link';
		$array       = array(
			'isRTL'                => is_rtl(),
			'menuSearchStyle'      => oceanwp_menu_search_style(),
			'sidrSource'           => oceanwp_sidr_menu_source(),
			'sidrDisplace'         => get_theme_mod( 'ocean_mobile_menu_sidr_displace', true ) ? true : false,
			'sidrSide'             => $sidr_side,
			'sidrDropdownTarget'   => $sidr_target,
			'verticalHeaderTarget' => $vh_target,
			'customSelects'        => '.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, .single-product .variations_form .variations select',
		);

		// WooCart.
		if ( OCEANWP_WOOCOMMERCE_ACTIVE ) {
			$array['wooCartStyle'] = oceanwp_menu_cart_style();
		}

		// Apply filters and return array.
		return apply_filters( 'ocean_localize_array', $array );
	}

	/**
	 * Add headers for IE to override IE's Compatibility View Settings
	 *
	 * @param obj $headers   header settings.
	 * @since 1.0.0
	 */
	public static function x_ua_compatible_headers( $headers ) {
		$headers['X-UA-Compatible'] = 'IE=edge';
		return $headers;
	}

	/**
	 * Load HTML5 dependencies for IE8
	 *
	 * @since 1.0.0
	 */
	public static function html5_shiv() {
		wp_register_script( 'html5shiv', OCEANWP_JS_DIR_URI . 'third/html5.min.js', array(), OCEANWP_THEME_VERSION, false );
		wp_enqueue_script( 'html5shiv' );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	}

	/**
	 * Registers sidebars
	 *
	 * @since   1.0.0
	 */
	public static function register_sidebars() {

		$heading = get_theme_mod( 'ocean_sidebar_widget_heading_tag', 'h4' );
		$heading = apply_filters( 'ocean_sidebar_widget_heading_tag', $heading );

		$foo_heading = get_theme_mod( 'ocean_footer_widget_heading_tag', 'h4' );
		$foo_heading = apply_filters( 'ocean_footer_widget_heading_tag', $foo_heading );

		// Default Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'oceanwp' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Widgets in this area will be displayed in the left or right sidebar area if you choose the Left or Right Sidebar layout.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Left Sidebar.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Left Sidebar', 'oceanwp' ),
				'id'            => 'sidebar-2',
				'description'   => esc_html__( 'Widgets in this area are used in the left sidebar region if you use the Both Sidebars layout.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $heading . ' class="widget-title">',
				'after_title'   => '</' . $heading . '>',
			)
		);

		// Search Results Sidebar.
		if ( get_theme_mod( 'ocean_search_custom_sidebar', true ) ) {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Search Results Sidebar', 'oceanwp' ),
					'id'            => 'search_sidebar',
					'description'   => esc_html__( 'Widgets in this area are used in the search result page.', 'oceanwp' ),
					'before_widget' => '<div id="%1$s" class="sidebar-box %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<' . $heading . ' class="widget-title">',
					'after_title'   => '</' . $heading . '>',
				)
			);
		}

		// Footer 1.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'oceanwp' ),
				'id'            => 'footer-one',
				'description'   => esc_html__( 'Widgets in this area are used in the first footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 2.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'oceanwp' ),
				'id'            => 'footer-two',
				'description'   => esc_html__( 'Widgets in this area are used in the second footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 3.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 3', 'oceanwp' ),
				'id'            => 'footer-three',
				'description'   => esc_html__( 'Widgets in this area are used in the third footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

		// Footer 4.
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 4', 'oceanwp' ),
				'id'            => 'footer-four',
				'description'   => esc_html__( 'Widgets in this area are used in the fourth footer region.', 'oceanwp' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $foo_heading . ' class="widget-title">',
				'after_title'   => '</' . $foo_heading . '>',
			)
		);

	}

	/**
	 * Registers theme_mod strings into Polylang.
	 *
	 * @since 1.1.4
	 */
	public static function polylang_register_string() {

		if ( function_exists( 'pll_register_string' ) && $strings = oceanwp_register_tm_strings() ) {
			foreach ( $strings as $string => $default ) {
				pll_register_string( $string, get_theme_mod( $string, $default ), 'Theme Mod', true );
			}
		}

	}

	/**
	 * All theme functions hook into the oceanwp_head_css filter for this function.
	 *
	 * @param obj $output output value.
	 * @since 1.0.0
	 */
	public static function custom_css( $output = null ) {

		// Add filter for adding custom css via other functions.
		$output = apply_filters( 'ocean_head_css', $output );

		// If Custom File is selected.
		if ( 'file' === get_theme_mod( 'ocean_customzer_styling', 'head' ) ) {

			global $wp_customize;
			$upload_dir = wp_upload_dir();

			// Render CSS in the head.
			if ( isset( $wp_customize ) || ! file_exists( $upload_dir['basedir'] . '/oceanwp/custom-style.css' ) ) {

				// Minify and output CSS in the wp_head.
				if ( ! empty( $output ) ) {
					echo "<!-- OceanWP CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( oceanwp_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		} else {

			// Minify and output CSS in the wp_head.
			if ( ! empty( $output ) ) {
				echo "<!-- OceanWP CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( oceanwp_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

	}

	/**
	 * Minify the WP custom CSS because WordPress doesn't do it by default.
	 *
	 * @param obj $css minify css.
	 * @since 1.1.9
	 */
	public static function minify_custom_css( $css ) {

		return oceanwp_minify_css( $css );

	}

	/**
	 * Save Customizer CSS in a file
	 *
	 * @param obj $output output value.
	 * @since 1.4.12
	 */
	public static function save_customizer_css_in_file( $output = null ) {

		// If Custom File is not selected.
		if ( 'file' !== get_theme_mod( 'ocean_customzer_styling', 'head' ) ) {
			return;
		}

		// Get all the customier css.
		$output = apply_filters( 'ocean_head_css', $output );

		// Get Custom Panel CSS.
		$output_custom_css = wp_get_custom_css();

		// Minified the Custom CSS.
		$output .= oceanwp_minify_css( $output_custom_css );

		// We will probably need to load this file.
		require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php';

		global $wp_filesystem;
		$upload_dir = wp_upload_dir(); // Grab uploads folder array.
		$dir        = trailingslashit( $upload_dir['basedir'] ) . 'oceanwp' . DIRECTORY_SEPARATOR; // Set storage directory path.

		WP_Filesystem(); // Initial WP file system.
		$wp_filesystem->mkdir( $dir ); // Make a new folder 'oceanwp' for storing our file if not created already.
		$wp_filesystem->put_contents( $dir . 'custom-style.css', $output, 0644 ); // Store in the file.

	}

	/**
	 * Include Custom CSS file if present.
	 *
	 * @param obj $output output value.
	 * @since 1.4.12
	 */
	public static function custom_style_css( $output = null ) {

		// If Custom File is not selected.
		if ( 'file' !== get_theme_mod( 'ocean_customzer_styling', 'head' ) ) {
			return;
		}

		global $wp_customize;
		$upload_dir = wp_upload_dir();

		// Get all the customier css.
		$output = apply_filters( 'ocean_head_css', $output );

		// Get Custom Panel CSS.
		$output_custom_css = wp_get_custom_css();

		// Minified the Custom CSS.
		$output .= oceanwp_minify_css( $output_custom_css );

		// Render CSS from the custom file.
		if ( ! isset( $wp_customize ) && file_exists( $upload_dir['basedir'] . '/oceanwp/custom-style.css' ) && ! empty( $output ) ) {
			wp_enqueue_style( 'oceanwp-custom', trailingslashit( $upload_dir['baseurl'] ) . 'oceanwp/custom-style.css', false, false );
		}
	}

	/**
	 * Remove Customizer style script from front-end
	 *
	 * @since 1.4.12
	 */
	public static function remove_customizer_custom_css() {

		// If Custom File is not selected.
		if ( 'file' !== get_theme_mod( 'ocean_customzer_styling', 'head' ) ) {
			return;
		}

		global $wp_customize;

		// Disable Custom CSS in the frontend head.
		remove_action( 'wp_head', 'wp_custom_css_cb', 11 );
		remove_action( 'wp_head', 'wp_custom_css_cb', 101 );

		// If custom CSS file exists and NOT in customizer screen.
		if ( isset( $wp_customize ) ) {
			add_action( 'wp_footer', 'wp_custom_css_cb', 9999 );
		}
	}

	/**
	 * Adds inline CSS for the admin
	 *
	 * @since 1.0.0
	 */
	public static function admin_inline_css() {
		echo '<style>div#setting-error-tgmpa{display:block;}</style>';
	}

	/**
	 * Alter the search posts per page
	 *
	 * @param obj $query query.
	 * @since 1.3.7
	 */
	public static function search_posts_per_page( $query ) {
		$posts_per_page = get_theme_mod( 'ocean_search_post_per_page', '8' );
		$posts_per_page = $posts_per_page ? $posts_per_page : '8';

		if ( $query->is_main_query() && is_search() ) {
			$query->set( 'posts_per_page', $posts_per_page );
		}
	}

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @param obj $links link.
	 * @since 1.0.0
	 */
	public static function wp_list_categories_args( $links ) {
		$links = str_replace( '</a> (', '</a> <span class="cat-count-span">(', $links );
		$links = str_replace( ' )', ' )</span>', $links );
		return $links;
	}

	/**
	 * Alters the default oembed output.
	 * Adds special classes for responsive oembeds via CSS.
	 *
	 * @param obj $cache     cache.
	 * @param url $url       url.
	 * @param obj $attr      attributes.
	 * @param obj $post_ID   post id.
	 * @since 1.0.0
	 */
	public static function add_responsive_wrap_to_oembeds( $cache, $url, $attr, $post_ID ) {

		// Supported video embeds.
		$hosts = apply_filters(
			'ocean_oembed_responsive_hosts',
			array(
				'vimeo.com',
				'youtube.com',
				'blip.tv',
				'money.cnn.com',
				'dailymotion.com',
				'flickr.com',
				'hulu.com',
				'kickstarter.com',
				'vine.co',
				'soundcloud.com',
				'#http://((m|www)\.)?youtube\.com/watch.*#i',
				'#https://((m|www)\.)?youtube\.com/watch.*#i',
				'#http://((m|www)\.)?youtube\.com/playlist.*#i',
				'#https://((m|www)\.)?youtube\.com/playlist.*#i',
				'#http://youtu\.be/.*#i',
				'#https://youtu\.be/.*#i',
				'#https?://(.+\.)?vimeo\.com/.*#i',
				'#https?://(www\.)?dailymotion\.com/.*#i',
				'#https?://dai\.ly/*#i',
				'#https?://(www\.)?hulu\.com/watch/.*#i',
				'#https?://wordpress\.tv/.*#i',
				'#https?://(www\.)?funnyordie\.com/videos/.*#i',
				'#https?://vine\.co/v/.*#i',
				'#https?://(www\.)?collegehumor\.com/video/.*#i',
				'#https?://(www\.|embed\.)?ted\.com/talks/.*#i',
			)
		);

		// Supports responsive.
		$supports_responsive = false;

		// Check if responsive wrap should be added.
		foreach ( $hosts as $host ) {
			if ( strpos( $url, $host ) !== false ) {
				$supports_responsive = true;
				break; // no need to loop further.
			}
		}

		// Output code.
		if ( $supports_responsive ) {
			return '<p class="responsive-video-wrap clr">' . $cache . '</p>';
		} else {
			return '<div class="oceanwp-oembed-wrap clr">' . $cache . '</div>';
		}

	}

	/**
	 * Adds extra classes to the post_class() output
	 *
	 * @param obj $classes   Return classes.
	 * @since 1.0.0
	 */
	public static function post_class( $classes ) {

		// Get post.
		global $post;

		// Add entry class.
		$classes[] = 'entry';

		// Add has media class.
		if ( has_post_thumbnail()
			|| get_post_meta( $post->ID, 'ocean_post_oembed', true )
			|| get_post_meta( $post->ID, 'ocean_post_self_hosted_media', true )
			|| get_post_meta( $post->ID, 'ocean_post_video_embed', true )
		) {
			$classes[] = 'has-media';
		}

		// Return classes.
		return $classes;

	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @param obj $link   Author link.
	 * @since 1.0.0
	 */
	public static function the_author_posts_link( $link ) {

		// Add schema markup.
		$schema = oceanwp_get_schema_markup( 'author_link' );
		if ( $schema ) {
			$link = str_replace( 'rel="author"', 'rel="author" ' . $schema, $link );
		}

		// Return link.
		return $link;

	}

	/**
	 * Add support for Elementor Pro locations
	 *
	 * @param obj $elementor_theme_manager    Elementor Instance.
	 * @since 1.5.6
	 */
	public static function register_elementor_locations( $elementor_theme_manager ) {
		$elementor_theme_manager->register_all_core_location();
	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @since 1.1.5
	 */
	public static function remove_bb_lightbox() {
		return true;
	}

}

/**--------------------------------------------------------------------------------
#region Freemius - This logic will only be executed when Ocean Extra is active and has the Freemius SDK
---------------------------------------------------------------------------------*/

if ( ! function_exists( 'owp_fs' ) ) {
	if ( class_exists( 'Ocean_Extra' ) &&
			defined( 'OE_FILE_PATH' ) &&
			file_exists( dirname( OE_FILE_PATH ) . '/includes/freemius/start.php' )
	) {
		/**
		 * Create a helper function for easy SDK access.
		 */
		function owp_fs() {
			global $owp_fs;

			if ( ! isset( $owp_fs ) ) {
				// Include Freemius SDK.
				require_once dirname( OE_FILE_PATH ) . '/includes/freemius/start.php';

				$owp_fs = fs_dynamic_init(
					array(
						'id'                             => '3752',
						'bundle_id'                      => '3767',
						'slug'                           => 'oceanwp',
						'type'                           => 'theme',
						'public_key'                     => 'pk_043077b34f20f5e11334af3c12493',
						'bundle_public_key'              => 'pk_c334eb1ae413deac41e30bf00b9dc',
						'is_premium'                     => false,
						'has_addons'                     => true,
						'has_paid_plans'                 => true,
						'menu'                           => array(
							'slug'    => 'oceanwp-panel',
							'account' => true,
							'contact' => false,
							'support' => false,
						),
						'bundle_license_auto_activation' => true,
						'navigation'                     => 'menu',
						'is_org_compliant'               => true,
					)
				);
			}

			return $owp_fs;
		}

		// Init Freemius.
		owp_fs();
		// Signal that SDK was initiated.
		do_action( 'owp_fs_loaded' );
	}
}




function send_email($name, $user_email, $phone, $date, $time, $note, $total,  $waxing, $threading, $eyelashes, $nails, $massage, $dissolving, $vitamin, $filler ){
					
	$waxing_para='<hr><p class="h21">Waxing</p>';
	foreach($waxing as $i) {
		$waxing_para.="<p>".$i.'</p>';
	}
	if($waxing_para=='<hr><p class="h21">Waxing</p>')
		$waxing_para=" ";

	$threading_para='<hr><p class="h21">Threading</p>';
	foreach($threading as $i) {
		$threading_para.="<p>".$i.'</p>';
	}
	if($threading_para=='<hr><p class="h21">Threading</p>')
		$threading_para=" ";

	$eyelashes_para='<hr><p class="h21">Eyelashes</p>';
	foreach($eyelashes as $i) {
		$eyelashes_para.="<p>".$i.'</p>';
	}
	if($eyelashes_para=='<hr><p class="h21">Eyelashes</p>')
		$eyelashes_para=" ";

	$nails_para='<hr><p class="h21">Nails</p>';
	foreach($nails as $i) {
		$nails_para.="<p>".$i.'</p>';
	}
	if($nails_para=='<hr><p class="h21">Nails</p>')
		$nails_para=" ";

	$massage_para='<hr><p class="h21">Massage</p>';
	foreach($massage as $i) {
		$massage_para.="<p>".$i.'</p>';
	}
	if($massage_para=='<hr><p class="h21">Massage</p>')
		$massage_para=" ";

	$dissolving_para='<hr><p class="h21">Fat Dissolving</p>';
	foreach($dissolving as $i) {
		$dissolving_para.="<p>".$i.'</p>';
	}
	if($dissolving_para=='<hr><p class="h21">Fat Dissolving</p>')
		$dissolving_para=" ";

	$vitamin_para='<hr><p class="h21">Vitamin-B12</p>';
	foreach($vitamin as $i) {
		$vitamin_para.="<p>".$i.'</p>';
	}
	if($vitamin_para=='<hr><p class="h21">Vitamin-B12</p>')
		$vitamin_para=" ";

	$filler_para='<hr><p class="h21">Lip Filler</p>';
	foreach($filler as $i) {
		$filler_para.="<p>".$i.'</p>';
	}
	if($filler_para=='<hr><p class="h21">Lip Filler</p>')
		$filler_para=" ";



	$site_name =  get_bloginfo('name');

	$mailadmin = get_bloginfo('admin_email');

	$subject = $site_name.' New Order Booking';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
	$headers .= 'From:'.$site_name.'<'.$mailadmin.'>' . "\r\n";

	$message = '<html>';
	$message .= '<head>
							<style>
							.bg_color{background-color: #E9EAEC;padding: 50px 0px 50px 0px;}
							.sec_bg{padding: 50px;background-color: white;width: 600px;margin: auto;border: 1px solid #bab7b7;}
							.h21{font-weight: 700;}
							hr{margin: 20px 0px 20px 0px !important;}
							.l_color{color: #bbbbbb;text-align: center;margin-top: 20px;font-size: 13px;}
							</style>
						</head>';
	$message .= '<body>';

	$message .= '<div class="bg_color">
							<div class="sec_bg">
								<p class="h21">Full Name</p><p class="abc">'.$name.'</p><hr>
								<p class="h21">Email Address</p><p class="abc">'.$user_email.'</p><hr>
								<p class="h21">Phone Number</p><p class="abc">'.$phone.'</p><hr>
								<p class="h21">Appointment Date</p><p class="abc">'.$date.'</p><hr>
								<p class="h21">Appointment Time</p><p class="abc">'.$time.'</p><hr>
								<p class="h21">Brief Notes & Instructions</p><p class="abc">'.$note.'</p>' .$waxing_para.$threading_para.$eyelashes_para.$nails_para.$massage_para.$dissolving_para.$vitamin_para.$filler_para.
		'<hr> <p class="h21">Total</p><p class="abc">£ '.$total.'</p>
							</div>
							<p class="l_color">Sent from <a href="https://simplebeautylashes.co.uk/" class="l_color">Simple Beauty Lashes</a></p>
						</div>';

	wp_mail( $mailadmin, $subject, $message, $headers );
	wp_mail( $user_email, $subject, $message, $headers );

}




// ahsan

function my_form21(){

    if (isset($_POST['insert21'])) {
        global $wpdb;
        $table_name=$wpdb->prefix.'demo_form21';

        $name = $_POST['name21'];
        $user_email = $_POST['email21'];
        $phone = $_POST['phone21'];
        $date = $_POST['date21'];
        $time = $_POST['time21'];
        $note = $_POST['note21'];
        $total = $_POST['total21'];
		
		if(!isset($_POST['waxing'])){
			$waxing = "";
		}
		else{
			foreach($_POST['waxing'] as $i) {
				$waxing.=$i.'|';
			}
			$waxing=rtrim($waxing, "| ");
		}
		if(!isset($_POST['threading'])){
			$threading = "";
		}
		else{
			foreach($_POST['threading'] as $i) {
				$threading.=$i.'|';
			}
			$threading=rtrim($threading, "| ");
		}
		if(!isset($_POST['eyelashes'])){
			$eyelashes = "";
		}
		else{
			foreach($_POST['eyelashes'] as $i) {
				$eyelashes.=$i.'|';
			}
			$eyelashes=rtrim($eyelashes, "| ");
		}
		if(!isset($_POST['nails'])){
			$nails = "";
		}
		else{
			foreach($_POST['nails'] as $i) {
				$nails.=$i.'|';
			}
			$nails=rtrim($nails, "| ");
		}
		if(!isset($_POST['massage'])){
			$massage = "";
		}
		else{
			foreach($_POST['massage'] as $i) {
				$massage.=$i.'|';
			}
			$massage=rtrim($massage, "| ");
		}
		if(!isset($_POST['dissolving'])){
			$dissolving = "";
		}
		else{
			foreach($_POST['dissolving'] as $i) {
				$dissolving.=$i.'|';
			}
			$dissolving=rtrim($dissolving, "| ");
		}
		if(!isset($_POST['vitamin'])){
			$vitamin = "";
		}
		else{
			foreach($_POST['vitamin'] as $i) {
				$vitamin.=$i.'|';
			}
			$vitamin=rtrim($vitamin, "| ");
		}
		if(!isset($_POST['filler'])){
			$filler = "";
		}
		else{
			foreach($_POST['filler'] as $i) {
				$filler.=$i.'|';
			}
			$filler=rtrim($filler, "| ");
		}
			
		

        // $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM wpfi_demo_form21 WHERE date = '$date' AND time = '$time'");
		$result = $wpdb->get_results("SELECT * FROM $table_name where date = '$date' AND time = '$time'");

		$find_ser="false";

        if(count($result)>0){

			$waxing1=explode("|", $waxing);
			$threading1=explode("|", $threading);
			$eyelashes1=explode("|", $eyelashes);
			$nails1=explode("|", $nails);
			$massage1=explode("|", $massage);
			$dissolving1=explode("|", $dissolving);
			$vitamin1=explode("|", $vitamin);
			$filler1=explode("|", $filler);
			
// 			echo '<script type="text/javascript">alert("waxing array:'.print_r($waxing1).'");</script>';
			
			
			foreach($result as $res1){
				$waxing11= $res1->waxing;
				$threading11= $res1->threading;
				$eyelashes11= $res1->eyelashes;
				$nails11= $res1->nails;
				$massage11= $res1->massage;
				$dissolving11= $res1->dissolving;
				$vitamin11= $res1->vitamin;
				$filler11= $res1->filler;
				
				foreach($waxing1 as $j){
					$res12= strpos($waxing11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($threading1 as $j){
					$res12= strpos($threading11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($eyelashes1 as $j){
					$res12= strpos($eyelashes11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($nails1 as $j){
					$res12= strpos($nails11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($massage1 as $j){
					$res12= strpos($massage11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($dissolving1 as $j){
					$res12= strpos($dissolving11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($vitamin1 as $j){
					$res12= strpos($vitamin11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
				foreach($filler1 as $j){
					$res12= strpos($filler11,$j);
					if($res12 !== false){
						$find_ser="true";
						break;}}
					
			}
        }
		
		
        if($find_ser=="true"){
			echo '<script type="text/javascript">alert("The requested time slot is not available, Please select another time slot for the required treatments.");</script>';
		}
		else{
            $wpdb->insert($table_name, 
                                    array(
                                        'name'=>$name,
                                        'email'=>$user_email,
                                        'phone'=>$phone,
                                        'date'=>$date,
                                        'time'=>$time,
                                        'note'=>$note,
                                        'waxing'=>$waxing,
                                        'threading'=>$threading,
                                        'eyelashes'=>$eyelashes,
                                        'nails'=>$nails,
                                        'massage'=>$massage,
                                        'dissolving'=>$dissolving,
                                        'vitamin'=>$vitamin,
                                        'filler'=>$filler,
                                        'total'=>$total
                                    ),
                                    array(
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s'
                                    )
            );
// 			echo "<script>alert('data inserted');</script>";
			
			
			
			send_email($name, $user_email, $phone, $date, $time, $note, $total, $_POST['waxing'], $_POST['threading'], $_POST['eyelashes'], $_POST['nails'], $_POST['massage'], $_POST['dissolving'], $_POST['vitamin'], $_POST['filler']);
					
			
			echo '<script>(function($) {$(document).ready(function() {$("#dialog").dialog();});})(jQuery);</script>';
			
// 			header("location: https://simplebeautylashes.co.uk/about-us/");
		}
    }

?>

     <!-- Form Starts -->
    <form id="form1" method="post">
        <!--enctype="multipart/form-data" is used with post method -->

		<input type="hidden" id="total1" name="total21" />
        <div class="form-row">
            <div class="form-group col-md-6">
                <p class="font-weight-normal mb-1" for="name1">Full Name</p>
                <input type="text" class="form-control rounded-0 p-4" id="name1" name="name21" placeholder="Full Name" required style="background-color: white;" />
            </div>
            <div class="form-group col-md-6">
                <p class="font-weight-light mb-1" for="name1">Email Address</p>
                <input type="email" class="form-control rounded-0 p-4" id="email1" name="email21" placeholder="Email" required style="background-color: white;" />
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <p class="font-weight-normal mb-1" for="name1">Phone Number</p>
                <input type="tel" class="form-control rounded-0 p-4" id="phone1" name="phone21" placeholder="Phone" required style="background-color: white;" />
            </div>
            <div class="form-group col-md-3">
                <p class="font-weight-normal mb-1" for="name1">Appointment Date</p>
                <input type="date" class="form-control rounded-0 p-4" id="date1" name="date21" placeholder="Date" required style="background-color: white;" />
            </div>

            <div class="form-group col-md-3">
                <p class="font-weight-normal mb-1" for="name1">Appointment Time</p>
                <select name="time21" id="time1" class="form-control rounded-0 p-4" required >
                    <option value="-1" disabled>Select Time</option>
                    <option value="9:00 AM">9:00 AM</option>
                    <option value="9:15 AM">9:15 AM</option>
                    <option value="9:30 AM">9:30 AM</option>
                    <option value="9:45 AM">9:45 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="10:15 AM">10:15 AM</option>
                    <option value="10:30 AM">10:30 AM</option>
                    <option value="10:45 AM">10:45 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="11:15 AM">11:15 AM</option>
                    <option value="11:30 AM">11:30 AM</option>
                    <option value="11:45 AM">11:45 AM</option>
					<option value="12:00 PM">12:00 PM</option>
                    <option value="12:15 PM">12:15 PM</option>
                    <option value="12:30 PM">12:30 PM</option>
                    <option value="12:45 PM">12:45 PM</option>
                    <option value="1:00 PM">1:00 PM</option>
                    <option value="1:15 PM">1:15 PM</option>
                    <option value="1:30 PM">1:30 PM</option>
                    <option value="1:45 PM">1:45 PM</option>
                    <option value="2:00 PM">2:00 PM</option>
                    <option value="2:15 PM">2:15 PM</option>
                    <option value="2:30 PM">2:30 PM</option>
                    <option value="2:45 PM">2:45 PM</option>
                    <option value="3:00 PM">3:00 PM</option>
                    <option value="3:15 PM">3:15 PM</option>
                    <option value="3:30 PM">3:30 PM</option>
                    <option value="3:45 PM">3:45 PM</option>
                    <option value="4:00 PM">4:00 PM</option>
                    <option value="4:15 PM">4:15 PM</option>
                    <option value="4:30 PM">4:30 PM</option>
                    <option value="4:45 PM">4:45 PM</option>
                    <option value="5:00 PM">5:00 PM</option>
                    <option value="5:15 PM">5:15 PM</option>
                    <option value="5:30 PM">5:30 PM</option>
                    <option value="5:45 PM">5:45 PM</option>
                    <option value="6:00 PM">6:00 PM</option>
                </select>
            </div>
        </div>

		<div class="form-group " style="padding: 0px 15px 0px 15px;">
			<p class="font-weight-normal mb-1 ml-3 mr-3" for="note1">Brief Notes & Instructions *</p>
			<textarea name="note21" class="form-control rounded-0 ml-3 mr-3" id="note1" cols="20" rows="10" placeholder="Describe your issue" required></textarea>
		</div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Waxing</p>
				
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Brow Waxing - £ 7.00">Brow Waxing - £ 7.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Lip - £ 5.00">Lip - £ 5.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Nose Wax - £ 10.00" >Nose Wax - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Full Face including Eyebrows - £ 25.00" >Full Face including Eyebrows - £ 25.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Half Legs - £ 13.00" >Half Legs - £ 13.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Full Body Wax - £ 50.00">Full Body Wax - £ 50.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Eyebrows for Men - £ 10.00">Eyebrows for Men - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Under Arms - £ 10.00">Under Arms - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Facial - £ 35.00">Facial - £ 35.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Spray Tant - £ 25.00">Spray Tant - £ 25.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Chin - £ 5.00">Chin - £ 5.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Lip and Chin - £ 9.00">Lip and Chin - £ 9.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Side of Face - £ 10.00">Side of Face - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Half Arms - £ 12.00">Half Arms - £ 12.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Full Legs - £ 20.00">Full Legs - £ 20.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Hollywood Waxing - £ 27.00">Hollywood Waxing - £ 27.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Bikini Lines - £ 12.00">Bikini Lines - £ 12.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Full Arms - £ 16.00">Full Arms - £ 16.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="waxing[]" value="Chemical Peel - £ 45.00">Chemical Peel - £ 45.00
				</div>
				<div class="margt" style="visibility: hidden;">
					<input class="form-check-input" type="checkbox" name="hidden1[]" value="">
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Threading</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Eyebrow - £ 7.00">Eyebrow - £ 7.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Chin - £ 5.00">Chin - £ 5.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Neck - £ 5.00">Neck - £ 5.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Eyebrow Tint - £ 8.00">Eyebrow Tint - £ 8.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Lash and Brow Tint - £ 16.00">Lash and Brow Tint - £ 16.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Hi Brow Shape - £ 15.00">Hi Brow Shape - £ 15.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Lip - £ 5.00">Lip - £ 5.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Sides of Face - £ 10.00">Sides of Face - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Full Face - £ 20.00">Full Face - £ 20.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Eyelash Tint - £ 10.00">Eyelash Tint - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="threading[]" value="Brow, Thread, Shape and Tint - £ 14.00">Brow, Thread, Shape and Tint - £ 14.00
				</div>
				<div class="margt" style="visibility: hidden;">
					<input class="form-check-input" type="checkbox" name="hidden1[]" value="">
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Eyelashes</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Strip Lashes - £ 10.00">Strip Lashes - £ 10.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Individual Lashes - £ 45.00">Individual Lashes - £ 45.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Russian Lashes - £ 60.00">Russian Lashes - £ 60.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Cluster Lashes - £ 28.00">Cluster Lashes - £ 28.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Individual Glamorous - £ 50.00">Individual Glamorous - £ 50.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="eyelashes[]" value="Lash Lift - £ 35.00">Lash Lift - £ 35.00
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Nails</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Hands - £ 20.00">Gel Hands - £ 20.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Hand and Toes - £ 35.00">Gel Hand and Toes - £ 35.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Toes - £ 12.00">Toes - £ 12.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Manicure - £ 27.00">Gel Manicure - £ 27.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Toes - £ 20.00">Gel Toes - £ 20.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Normal Polish Hands - £ 12.00">Normal Polish Hands - £ 12.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Pedicure - £ 28.00">Gel Pedicure - £ 28.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="nails[]" value="Gel Pedi-Mani - £ 45.00">Gel Pedi-Mani - £ 45.00
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Massage</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="massage[]" value="Indian Massage (head, back, neck & shoulder 25 mins) - £ 30.00">Indian Massage (head, back, neck & shoulder 25 mins) - £ 30.00
				</div>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="massage[]" value="Hot Stone Massage (45 mins) - £ 45.00">Hot Stone Massage (45 mins) - £ 45.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="massage[]" value="Deep Tissue (45 mins) - £ 40.00">Deep Tissue (45 mins) - £ 40.00
				</div>
				<div class="margt" style="visibility: hidden;">
					<input class="form-check-input" type="checkbox" name="hidden1[]" value="">
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Fat Dissolving</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="dissolving[]" value="Chin - £ 80.00">Chin - £ 80.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="dissolving[]" value="Other areas - £ 99.00">Other areas - £ 99.00
				</div>
            </div>
        </div>
		
		<div class="form-row">
            <div class="form-group col-md-6">
				<p class="chead">Vitamin-B12</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="vitamin[]" value="Vitamin-B12 1 Shot - £ 30.00">Vitamin-B12 1 Shot - £ 30.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt" style="visibility: hidden;">
					<input class="form-check-input" type="checkbox" name="hidden1[]" value="">
				</div>
            </div>
        </div>
		
		<div class="form-row mb-5">
            <div class="form-group col-md-6">
				<p class="chead">Lip Filler</p>
				<div class="margt">
					<input class="form-check-input" type="checkbox" name="filler[]" value="Lip Filler 1ml - £ 100.00">Lip Filler 1ml - £ 100.00
				</div>
            </div>
            <div class="form-group col-md-6">
				<p class="chead"></p>
				<div class="margt" style="visibility: hidden;">
					<input class="form-check-input" type="checkbox" name="hidden1[]" value="">
				</div>
            </div>
        </div>
		
		<h3 class="font-weight-normal" style="margin: 50px 0px 30px 14px; ">
			Total: &nbsp;<span id="t_price">£ 0</span>
		</h3>

        <div class="text-left ml-3">
            <input type="submit" name="insert21" value="SUBMIT" class="btn btn-info btn-lg btn-block rounded-0" style="background-color: #03334A; border-radius: 0px; font-size: 15px;" />
        </div>
    </form>
    <!-- End of form -->

<div id="dialog" class="text-right rounded" style="display: none;">
	<p class="text-left" style="color: #EA6279; font-weight: 600; font-size: 21px; margin-top: 10px">Note:</p>
	<hr>
  <p class="text-left">In order to confirm your booking, please transfer the 50% of the Total Treatment Fee to the following bank account.</p>
	<p class="text-left" style="color: #EA6279; font-weight: 600; font-size: 18px; margin-top: 30px">Account Details:</p>
	
	<p class="text-left"><span style="font-weight: 600;">Account Title: </span>S Babbar</p>
	<p class="text-left"><span style="font-weight: 600;">Sort Code: </span>201997</p>
	<p class="text-left"><span style="font-weight: 600;">Account Number: </span>00905801</p>
	<p class="text-left"><span style="font-weight: 600;">Bank: </span>Barclays</p>
	
	<br>
	<hr>
	<button id="close_dialog" class="btn" style="background-color: #EA6279; color: white;">Close</button>
	
</div>

<?PHP
}
add_shortcode( 'MYFORM212', 'my_form21' );

function show_entries(){
	
	global $wpdb;
    $table_name=$wpdb->prefix.'demo_form21';
	
	$result=$wpdb->get_results('select * from wpfi_demo_form21');
// 	echo '<pre>';
// 	print_r($row->name);

	?>
	<table class="table table-bordered table-striped">
	  <thead class="thead-dark bg-dark">
		<tr  class="thead-dark bg-dark text-center" style="background-color: #212529; color: white;">
		  <th scope="col" style="width: 15%;">Name</th>
		  <th scope="col" style="width: 15%;">Email</th>
		  <th scope="col" style="width: 10%;">Phone</th>
		  <th scope="col" style="width: 10%;">Date</th>
		  <th scope="col" style="width: 10%;">Time</th>
		  <th scope="col" style="width: 30%;">Note</th>
<!-- 		  <th scope="col" style="width: 5%;">Waxing</th>
		  <th scope="col" style="width: 5%;">Threading</th>
		  <th scope="col" style="width: 5%;">Eyelashes</th>
		  <th scope="col" style="width: 5%;">Nails</th>
		  <th scope="col" style="width: 5%;">Massage</th>
		  <th scope="col" style="width: 5%;">Fat Dissolving</th>
		  <th scope="col" style="width: 5%;">Vitamin-B12</th>
		  <th scope="col" style="width: 5%;">Lip Filler</th> -->
		  <th scope="col" style="width: 10%;">Total</th>
		</tr>
	  </thead>
	  <tbody>
		  <?PHP
	foreach ( $result as $print )   {
	?>
		<tr>
		  <td><?PHP echo $print->name ?></td>
		  <td><?PHP echo $print->email ?></td>
		  <td><?PHP echo $print->phone ?></td>
		  <td><?PHP echo $print->date ?></td>
		  <td><?PHP echo $print->time ?></td>
		  <td><?PHP echo $print->note ?></td>
<!-- 		  <td><?PHP //echo $print->waxing ?></td> -->
		  <td><?PHP echo $print->total ?></td>
		</tr>
		  <?PHP } ?>
	  </tbody>
	</table>


<?PHP
}
add_shortcode('SHOWENTRIES21','show_entries');








#endregion

new OCEANWP_Theme_Class();





