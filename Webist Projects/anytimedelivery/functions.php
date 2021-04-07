<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'sidebar' => __( 'Sidebar Menu',      'twentyfifteen' ),
		'footer'  => __( 'Footer', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'inc/theme-options.php' ); 
include_once( 'aq_resizer.php' ); 
require_once('wp_bootstrap_navwalker.php');
require_once 'im/init.php';
require_once( 'im/fontawosam/cmb2-fontawesome-picker.php' );
if ( ! function_exists( 'cmb2_attached_posts_fields_render' ) ) {
	require_once 'im/attached/cmb2-attached-posts-field.php';
}


if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 140, 120 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
add_image_size( 'homepage-thumb', 140, 120, true ); //(cropped)
}

add_action( 'init', 'section_a' );
function section_a() {

    $labels = array(
        'name'                => _x( 'Box', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Box', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section A', 'im' ),
        'parent_item_colon'   => __( 'Parent Box:', 'im' ),
        'all_iteim'           => __( 'All Boxes', 'im' ),
        'view_item'           => __( 'View Box', 'im' ),
        'add_new_item'        => __( 'Add New Box', 'im' ),
        'add_new'             => __( 'Add New Box', 'im' ),
        'edit_item'           => __( 'Edit Box', 'im' ),
        'update_item'         => __( 'Update Box', 'im' ),
        'search_iteim'        => __( 'Search Box', 'im' ),
        'not_found'           => __( 'No Box found', 'im' ),
        'not_found_in_trash'  => __( 'No Box found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Box', 'im' ),
        'description'         => __( 'Box information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-format-gallery',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'section_a',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'section_a', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'section_b' );
function section_b() {

    $labels = array(
        'name'                => _x( 'Box', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Box', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section B', 'im' ),
        'parent_item_colon'   => __( 'Parent Box:', 'im' ),
        'all_iteim'           => __( 'All Boxes', 'im' ),
        'view_item'           => __( 'View Box', 'im' ),
        'add_new_item'        => __( 'Add New Box', 'im' ),
        'add_new'             => __( 'Add New Box', 'im' ),
        'edit_item'           => __( 'Edit Box', 'im' ),
        'update_item'         => __( 'Update Box', 'im' ),
        'search_iteim'        => __( 'Search Box', 'im' ),
        'not_found'           => __( 'No Box found', 'im' ),
        'not_found_in_trash'  => __( 'No Box found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Box', 'im' ),
        'description'         => __( 'Box information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-format-gallery',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'section_b',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'section_b', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'section_c' );
function section_c() {

    $labels = array(
        'name'                => _x( 'Box', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Box', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section C', 'im' ),
        'parent_item_colon'   => __( 'Parent Box:', 'im' ),
        'all_iteim'           => __( 'All Boxes', 'im' ),
        'view_item'           => __( 'View Box', 'im' ),
        'add_new_item'        => __( 'Add New Box', 'im' ),
        'add_new'             => __( 'Add New Box', 'im' ),
        'edit_item'           => __( 'Edit Box', 'im' ),
        'update_item'         => __( 'Update Box', 'im' ),
        'search_iteim'        => __( 'Search Box', 'im' ),
        'not_found'           => __( 'No Box found', 'im' ),
        'not_found_in_trash'  => __( 'No Box found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Box', 'im' ),
        'description'         => __( 'Box information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-format-gallery',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'section_c',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'section_c', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'im_orders' );
function im_orders() {

    $labels = array(
        'name'                => _x( 'Order', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Order', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Orders', 'im' ),
        'parent_item_colon'   => __( 'Parent Order:', 'im' ),
        'all_iteim'           => __( 'All Orders', 'im' ),
        'view_item'           => __( 'View Order', 'im' ),
        'add_new_item'        => __( 'Add New Order', 'im' ),
        'add_new'             => __( 'Add New Order', 'im' ),
        'edit_item'           => __( 'Edit Order', 'im' ),
        'update_item'         => __( 'Update Order', 'im' ),
        'search_iteim'        => __( 'Search Order', 'im' ),
        'not_found'           => __( 'No Order found', 'im' ),
        'not_found_in_trash'  => __( 'No Order found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Order', 'im' ),
        'description'         => __( 'Order information pages', 'im' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'revisions'),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-clipboard',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'order',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'im_orders', $args );
    flush_rewrite_rules();
}

add_filter( 'cmb2_meta_boxes', 'im_metaboxes' );

function im_metaboxes( array $meta_boxes ) {

    
    $prefix = 'im_';

    $meta_boxes['im_section_ab_metabox'] = array(
        'id'            => 'im_section_ab_metabox',
        'title'         => __( 'Box Information', 'im' ),
        'object_types'  => array( 'section_a', 'section_b' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Content', 'im' ),
                'id'   => $prefix.'content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea_small',
            ),
            array(
                'name' => __( 'Image', 'im' ),
                'id'   => $prefix.'image',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Link', 'im' ),
                'id'   => $prefix.'link',
		        'desc'       => 'Add link', 
        		'type'         => 'text',
        		'default' => '#',
            ),
        ),    
    );

    $meta_boxes['im_section_c_metabox'] = array(
        'id'            => 'im_section_c_metabox',
        'title'         => __( 'Box Information', 'im' ),
        'object_types'  => array( 'section_c' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image', 'im' ),
                'id'   => $prefix.'image',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Link', 'im' ),
                'id'   => $prefix.'link',
		        'desc'       => 'Add link', 
        		'type'         => 'text',
        		'default' => '#',
            ),
        ),    
    );

    $meta_boxes['im_page_second_metabox'] = array(
        'id'            => 'im_page_second_metabox',
        'title'         => __( 'Page Extra Information', 'im' ),
        'object_types' => array( 'page' ), // post type
		'show_on'      => array( 'key' => 'page-template', 'value' => 'split-page.php' ),
		'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Page Right Side Content', 'im' ),
                'id'   => $prefix.'page_content',
		        'desc'       => 'Add content', 
        		'type'         => 'wysiwyg',
            ),
        ),    
    );

    return $meta_boxes;
}


function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="sub-dropdown" /',$menu);        
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 

function _get_quote_form(){
	ob_start();
?>
	<div class="contact-form-holder">
		<div id="quote_form217066940" class="qoute-form quote-form-full">
        	<?php echo do_shortcode('[contact-form-7 id="100" title="Quote Form"]'); ?>
        </div>
    </div>
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'QUOTEFORM', '_get_quote_form' );

// In your theme's functions.php
function customize_add_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => 'Add Another Unit',
  ) );
}
add_filter( 'wpcf7_field_group_add_button_atts', 'customize_add_button_atts' );

function customize_remove_button_atts( $attributes ) {
  return array_merge( $attributes, array(
    'text' => 'Remove Unit',
  ) );
}
add_filter( 'wpcf7_field_group_remove_button_atts', 'customize_remove_button_atts' );

function im_get_trackcode(){
	ob_start();

	if(isset($_POST['order_track'])){
		$tracking_code = $_POST['tracking_code'];
		if($tracking_code != ''){
			$query = new WP_Query( array( 
				'post_type'     => 'metform-entry', 
				'post_status'   => 'publish',  
				'posts_per_page'  => 1,
				'order'  =>  'ASC',
				'meta_key'   => 'sq_no', 
				'meta_value' => $tracking_code,
			));
			$query_count = $query->found_posts;
			if($query_count == 1){				
				while ( $query->have_posts() ) : $query->the_post();
					// Send email to admin
		            $site_name =  get_bloginfo('name');
		            $primary_color = '#5B9144';
		            $mailadmin = get_bloginfo('admin_email');
		            $subject = get_bloginfo('name').' Need Order Status';
		            $headers_admin  = 'MIME-Version: 1.0' . "\r\n";
			        $user_data = get_post_meta(get_the_ID(), 'metform_entries__form_data', true);
		            $headers_admin .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
		            $headers_admin .= 'From: '.$site_name.' <noreply@domain.com>' . "\r\n";
		            
		            $message_admin = '<html>';
		            $message_admin .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';
		            $message_admin .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';

		            $message_admin .= '<tr><td bgcolor="'.$primary_color.'" colspan="4" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
		            $message_admin .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2"color="#FFFFFF">Order No.: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$tracking_code.'</td></tr>';
		            $message_admin .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2"color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$user_data['name'].'</td></tr>';
		            $message_admin .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2"color="#FFFFFF">Email: </font></td><td bgcolor="#CCCCCC" width="400" colspan="3"><font face="arial" size="2"color="#000000">'.$user_data['email'].'</td></tr>';
		            $message_admin .= '</table>';
		            $message_admin .= '</body>';
		            $message_admin .= '</html>';
		            wp_mail( $mailadmin, $subject, $message_admin, $headers_admin );
		            echo '<p style="text-align: center; color: #fff;">Thank You. Your request is submitted.</p>';

				endwhile; wp_reset_query();
	        }
		}
	}

?>
	<div class="contact-form-holder track-form">
		<form action="#" method="post">
			<input type="text" required name="tracking_code" placeholder="Enter Tracking code">
			<input type="submit" name="order_track" value="Track Parcel">
		</form>
    </div>
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'TRACKCODE', 'im_get_trackcode' );


function im_parcel_form(){
	// if(is_user_logged_in()){
	// $current_user_id = get_current_user_id();
	?>
	<section class="parcel-folrm-holder">
		<?php 
			if(isset($_POST['send_quote'])){
				//print_r($_POST); //ahsan comment it
				$full_name = sanitize_text_field($_POST['sender_name']);
				$email_address = sanitize_text_field($_POST['sender_email']);
				$contact = sanitize_text_field($_POST['sender_contact']);
				$mobile = sanitize_text_field($_POST['sender_mobile']);
				$receiver_name = sanitize_text_field($_POST['receiver_name']);
				$receiver_email = sanitize_text_field($_POST['receiver_email']);
				$receiver_contact = sanitize_text_field($_POST['receiver_contact']);
				$receiver_mobile = sanitize_text_field($_POST['receiver_mobile']);
				$receiver_country = sanitize_text_field($_POST['to']);
				$receiver_city = sanitize_text_field($_POST['receiver_city']);
				$receiver_address = sanitize_text_field($_POST['receiver_address']);
				$type = sanitize_text_field($_POST['type']);
				if($type == 'air'){
					$type_str = 'Air Cargo';
				}
				if($type == 'sea'){
					$type_str = 'Sea Cargo';
				} 
				$from = sanitize_text_field($_POST['from']);
				$from_postcode = sanitize_text_field($_POST['from_postcode']);
				$to = sanitize_text_field($_POST['to']);
				$city = sanitize_text_field($_POST['city']);
				$address = sanitize_text_field($_POST['sender_address']);
				$courier_service = sanitize_text_field($_POST['courier_service']);
				if($courier_service == 'collected'){
					$courier_service_str = 'The parcel will be collected by Courier Company from Sender Address';
				} else {
					$courier_service_str = 'The parcel will be delivered to Courier Company Office';
				}
				$weight = $_POST['weight'];
				$width = $_POST['width'];
				$height = $_POST['height'];
				$lenght = $_POST['lenght'];
				$fee = 0;
				$total_fee=0;
				$order_data_row=""; //ahsan add it
				if($type == 'sea' && $to == 'india' || empty($weight)){
					echo '<p>Unable to proceed. Please try again.</p>';
				} else{
					if(!empty($weight)){
						$count = 0;
						$total_boxes = 0;
						foreach($weight as $wght){
							if($type == 'air' && $to == 'india'){
								$fee = '6.50';
							} else if($type == 'air' && $to == 'pakistan'){
								$fee = '5.00';
							} else if($type == 'sea' && $to == 'pakistan'){
								$fee = '1.50';
							}
							$fee = $fee*$wght;
							$total_fee+=$fee;
							$box = ceil($wght / 20);
							$total_boxes = $total_boxes + $box;
							if($box == 1){
								$box_str = 'Box';
							} else {
								$box_str = 'Boxes';
							}
							$order_data_row .= '<tr><td>'.$wght.'kg</td><td>'.$lenght[$count].'cm</td><td>'.$width[$count].'cm</td><td>'.$height[$count].'cm</td><td>Use '.$box.' x 20 kg '.$box_str.'</td><td>&pound;'.$fee.'</td></tr>';
						$count++;
						}
	
						$order_table_header = '<table class="table" width="700">';
						$order_row_heading = '<tr><th style="text-align: left;">Weight</th><th style="text-align: left;">Length</th><th style="text-align: left;">Width</th><th style="text-align: left;">Height</th><th style="text-align: left;">Box(es)</th><th style="text-align: left;">Cost</th></tr>';
						$order_table_footer = '</table>';
						// $total_fee_str='<h2 class="text-right text-white p-2" style="color: white !important; padding-right: 15px;">Total Amount: &pound;'.$total_fee.' </h2>';

						$order_data_row .='<tr><td></td><td></td><td></td><td></td><td><b>Total Amount: </b></td><td><b>&pound;'.$total_fee.'</b></td></tr>';
						$order_table = $order_table_header.$order_row_heading.$order_data_row.$order_table_footer;
						
						$user_table_header = '<table class="table" width="700">';
						$user_row_heading = '<tr><th>Name</th><th>Contact</th><th>Email</th></tr>';
						$user_data_row = '<tr><td>'.$full_name.'</td><td>'.$contact.'</td><td>'.$email_address.'</td></tr>';
						$user_table_footer = '</table>';
						$user_table = $user_table_header.$user_row_heading.$user_data_row.$user_table_footer;
	
						$content = '<div class="table-responsive">'.$user_table.$order_table.'</table>';
						$wp_error=""; //ahsan add it
	
						//email part ahsan
						$my_post = array(
							'post_title'    => '',
							'post_content'    => $content,
							'post_status'   => 'publish',
							'post_type' => 'im_orders',
	//                         'author' => $current_user_id, //ahsan comment
						);
						$post_id = wp_insert_post( $my_post, $wp_error );
						$booking_id = 'AT-'.$post_id;
						add_post_meta($post_id, 'im_booking_id', $booking_id, true);
						add_post_meta($post_id, 'im_customer', $full_name, true);
						add_post_meta($post_id, 'im_email', $email_address, true);
						add_post_meta($post_id, 'im_contact', $contact, true);
						add_post_meta($post_id, 'im_mobile', $mobile, true);
						add_post_meta($post_id, 'im_receiver_name', $receiver_name, true);
						add_post_meta($post_id, 'im_receiver_email', $receiver_email, true);
						add_post_meta($post_id, 'im_receiver_country', $to, true);
						add_post_meta($post_id, 'im_receiver_city', $receiver_city, true);
						add_post_meta($post_id, 'im_receiver_contact', $receiver_contact, true);
						add_post_meta($post_id, 'im_receiver_mobile', $receiver_mobile, true);
						add_post_meta($post_id, 'im_receiver_address', $receiver_address, true);
						add_post_meta($post_id, 'im_type', $type, true);
						add_post_meta($post_id, 'im_from', $from, true);
						add_post_meta($post_id, 'im_from_postcode', $from_postcode, true);
						add_post_meta($post_id, 'im_to', $to, true);
						add_post_meta($post_id, 'im_city', $city, true);
						add_post_meta($post_id, 'im_address', $address, true);
						add_post_meta($post_id, 'im_weight', $weight, true);
						add_post_meta($post_id, 'im_lenght', $lenght, true);
						add_post_meta($post_id, 'im_width', $width, true);
						add_post_meta($post_id, 'im_height', $height, true);
						add_post_meta($post_id, 'im_fee', $fee, true);
						add_post_meta($post_id, 'im_box', $total_boxes, true);
						add_post_meta($post_id, 'im_courier_service', $courier_service, true);
	
						// Update post title
						$update_booking = get_post($post_id);
						$update_booking->post_title = $booking_id;
						wp_update_post( $update_booking );
	
						$site_name =  get_bloginfo('name');
						$primary_color = '#5B9144';
						$mailadmin = get_bloginfo('admin_email');
						$subject = get_bloginfo('name').' New Order Booking';
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";     
						$headers .= 'From: '.$site_name.' <noreply@domain.com>' . "\r\n";
						
						$message = '<html>';
						$message .= '<body bgcolor="#FFFFFF" marginwidth="10" marginheight="10" topmargin="10" leftmargin="10">';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
	
						$message .= '<tr><td bgcolor="'.$primary_color.'" colspan="2" align="center"><font face="arial" size="7" color="#FFFFFF">'.$site_name.'</td></tr>';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="2" align="center"><font face="arial" size="5" color="#000000">SENDER DETAILS</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$full_name.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$email_address.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Contact: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$contact.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Mobile: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$mobile.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Country: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$from.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Postcode: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$from_postcode.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$address.'</td></tr>';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="6" align="center"><font face="arial" size="5" color="#000000">RECEIVER DETAILS</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Full Name: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_name.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Email Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_email.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Contact: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_contact.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Mobile: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_mobile.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Country: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$to.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">City: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_city.'</td></tr>';
						$message .= '<tr><td bgcolor="'.$primary_color.'" width="200"><font face="arial" size="2" color="#FFFFFF">Address: </font></td><td bgcolor="#CCCCCC" width="400"><font face="arial" size="2" color="#000000">'.$receiver_address.'</td></tr>';
						$message .= '</table>';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
						$message .= '<tr><td bgcolor="#eeeeee" colspan="6" align="center"><font face="arial" size="4" color="#000000">Order Details</td></tr>';
						$message .= $order_row_heading;
						$message .= $order_data_row;
						$message .= '</table>';
						$message .= '<table cellpadding="10" cellspacing="10" border="0" width="700">';
						$message .= '<tr><td><font face="arial" size="2" color="#000000">Type: </font></td><td width="400"><font face="arial" size="2" color="#000000">'.$type_str.'</td></tr>';
						$message .= '<tr><td><font face="arial" size="2" color="#000000">Courier Service: </font></td><td width="400"><font face="arial" size="2" color="#000000">'.$courier_service_str.'</td></tr>';
						$message .= '</table>';
						$message .= '</body>';
						$message .= '</html>';
						
						wp_mail( $mailadmin, $subject, $message, $headers );
						wp_mail( $email_address, $subject, $message, $headers );
						
						// echo submit message ahsan
						echo '<script>alert("Your order has been received and our representative will contact you shortly. The order details has been emailed to provided Sender’s email address. Thank you for visiting our website. Anytime Delivery")</script>';
						// alert("Your message has been sent successfully."); 
						?>
	
		<!-- <div class="alert alert-success alert-dismissible text-center">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Your message has been sent successfully.
		</div> -->
	
		<?php
					}
				}
			}
			?>
		<form action="" method="post" class="w-100" id="purchase-order-create">
			<div class="mx-auto">
				<div class="col-xs-12">
					<div class="main-row">
						<h2>GET FREE QUOTE</h2>
					</div>
				</div>
	
				<!-- pricing details ahsan -->
				<div id="show_price1" class="hidden123">
					<h3 class="order21">Order Details</h3>
					<div id="show_pricing">
					
					</div>
				</div>
				



				<div id="hide_parcel_desc">
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL DESCRIPTION</h3>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="border-box">
							<div class="main-row">
								<div>
									<div class="custom-select-main position-relative">
										<div class="row parcel-full-width">
											<div class="col-xs-4 col-sm-4 col-md-4 labeling">
												Parcel Type
											</div>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="radio-holder">
													<input required checked type="radio" name="type" value="air">
													<span>Air Carogo</span>
												</div>
											</div>
											<div class="col-xs-4 col-sm-4 col-md-4">
												<div class="radio-holder">
													<input required type="radio" name="type" value="sea">
													<span>Sea Cargo</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
	
							<div class="table-responsive">
								<div class="table rowfy" id="customFields">
									<div class="tbody">
										<div class="tr-row">
											<div class="p-0"><input required type="number" min="1" name="weight[]"
													id="weight" class="form-control rounded" placeholder="weight"><label
													for="kg">kg</label>
											</div>
											<div class="p-0"><input required type="number" min="1" name="lenght[]"
													id="lenght" class="form-control rounded" placeholder="length"></div>
											<div class="p-0"><input required type="number" min="1" name="width[]"
													id="width" class="form-control rounded" placeholder="width"></div>
											<div class="p-0"><input required type="number" min="1" name="height[]"
													id="height" class="form-control rounded" placeholder="height"><label
													for="kg">cm</label>
											</div>
											<div class="p-0">
												<div class="p-0 rowfy-addrow">+</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- <div class="text-center finish-btn">
										<a href="#">FINISH</a>
									</div> -->
								<div class="courier-service">
									<div class="radio-holder">
										<input type="radio" checked name="courier_service" value="collected">
										<span>The parcel will be collected by Courier Company from Sender Address</span>
									</div>
									<div class="radio-holder">
										<input type="radio" name="courier_service" value="delivered">
										<span>The parcel will be delivered to Courier Company Office</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hide-formi">
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL SENDER INFORMATION</h3>
						</div>
					</div>
					<div class="col-xs-12 mx-auto">
						<div class="main-row">
							<div class="city-input">
								<div class="custom-select-main position-relative">
									<select required name="from" id="from" class="form-control sources"
										placeholder="UK Mainland">
										<option selected value="UK Mainland">UK Mainland</option>
									</select>
								</div>
							</div>
							<div>
								<input required name="from_postcode" type="text"
									class="form-control font rounded w-100 input-height" placeholder="Postcode">
							</div>
						</div>
					</div>
					<div id="hide_sender" style="display:none;">
	
	
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="sender_address"
										class="form-control font rounded w-100 input-height" placeholder="Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="sender_name"
										class="form-control font rounded w-100 input-height" placeholder="Full Name">
								</div>
								<div class="city-input">
									<input required type="email" name="sender_email"
										class="form-control font rounded w-100 input-height" placeholder="Email Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input type="tel" name="sender_contact"
										class="form-control font rounded w-100 input-height" placeholder="Landline Number">
								</div>
								<div class="city-input">
									<input required type="tel" name="sender_mobile"
										class="form-control font rounded w-100 input-height" placeholder="Mobile Number">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="main-row">
							<h3>PARCEL RECEIVER INFORMATION</h3>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="main-row">
							<div class="city-input">
								<div class="custom-select-main position-relative">
									<select required name="to" id="to" class="city-input form-control sources"
										placeholder="Select Country">
										<option value="india">India</option>
										<option value="pakistan">Pakistan</option>
									</select>
								</div>
							</div>
							<div>
								<input required type="text" name="receiver_city"
									class="form-control font rounded w-100 input-height" placeholder="City">
							</div>
						</div>
					</div>
					<div id="hide_receiver" style="display:none;">
	
	
						<div class="col-xs-12">
							<div class="main-row">
								<div>
									<div class="custom-select-main position-relative">
										<input required type="text" name="receiver_address"
											class="form-control font rounded w-100 input-height" placeholder="Address">
									</div>
								</div>
							</div>
						</div>
	
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input required type="text" name="receiver_name"
										class="form-control font rounded w-100 input-height" placeholder="Full Name">
								</div>
								<div class="city-input">
									<input required type="email" name="receiver_email"
										class="form-control font rounded w-100 input-height" placeholder="Email Address">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="city-input">
									<input type="tel" name="receiver_contact"
										class="form-control font rounded w-100 input-height" placeholder="Landline Number">
								</div>
								<div class="city-input">
									<input required type="tel" name="receiver_mobile"
										class="form-control font rounded w-100 input-height" placeholder="Mobile Number">
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="main-row table rowfy">
								<div class="submit-holder">
									<button type="submit" name="send_quote">Submit</button>
								</div>
							</div>
						</div>
	
					</div>
					<div class="text-center hide_gen_q">
						<br/><br/>
						<button type="button" class="btn btn-success btn-lg fag_btn" id="generate_quote" name="generate_quote">Generate Quote</button>
						<br/><br/>
					</div>
				</div>
			</div>
		</form>
		
<!-- 		<div id="dialog21" title="Basic dialog" style="display:none">
				<p class="text-center">Your order has been received and our representative will contact you shortly. The order details has been emailed to provided Sender’s email address. Thank you for visiting our website. <br/><b>Anytime Delivery</b></p>
		</div> -->
	</section>
	
	
	<?php 
	// } 
	// 	else {
	//         	echo do_shortcode('[xoo_el_inline_form active="login"]');
	//         	} 
	?>
	<?php
	}
	add_shortcode( 'PARCELFORM', 'im_parcel_form' );