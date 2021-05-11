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
		'header' => __( 'Header Menu',      'twentyfifteen' ),
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'footer'  => __( 'Footer Menu', 'twentyfifteen' ),
		'side'  => __( 'Sidebar Menu', 'twentyfifteen' ),
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
	wp_enqueue_style( 'font-awosam-4', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.1' );
	wp_enqueue_style( 'number-css', get_template_directory_uri() . '/css/number.css', array(), '1.0' );

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'light-js', get_template_directory_uri() . '/js/lightslider.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'bootstrap-select-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'number-js', get_template_directory_uri() . '/js/number.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '20141010' );
	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );


function im_load_scripts() {
	$site_url = get_bloginfo('url');
	$site_name = get_bloginfo('name');
	$site_name = str_replace(' ', '-', strtolower($site_name));
    wp_localize_script('custom-js', 'im_script_vars', array(
            'siteUrl' => __($site_url, 'im'),
            'siteName' => __($site_name, 'im')
        )
    );
 
}
add_action('wp_enqueue_scripts', 'im_load_scripts');

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

add_filter( 'cmb2_meta_boxes', 'im_metaboxes' );

function im_metaboxes( array $meta_boxes ) {

    
    $prefix = 'im_';

    $meta_boxes['im_business_metabox'] = array(
        'id'            => 'im_business_metabox',
        'title'         => __( 'Slide Information', 'im' ),
        'object_types'  => array( 'business_carousel' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image', 'im' ),
                'id'   => $prefix.'slide_img',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Image 2', 'im' ),
                'id'   => $prefix.'slide_img2',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Slide Long Content', 'im' ),
                'id'   => $prefix.'slide_long_content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea_small',
            ),
            array(
                'name' => __( 'Link', 'im' ),
                'id'   => $prefix.'slide_link',
		        'desc'       => 'Add link', 
        		'type'         => 'text', 
        		'default'         => '#',
            ),
        ),    
    );

    $meta_boxes['im_personal_metabox'] = array(
        'id'            => 'im_personal_metabox',
        'title'         => __( 'Slide Information', 'im' ),
        'object_types'  => array( 'personal_carousel' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image', 'im' ),
                'id'   => $prefix.'slide_img',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Image 2', 'im' ),
                'id'   => $prefix.'slide_img2',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Slide Content', 'im' ),
                'id'   => $prefix.'slide_content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea_small',
            ),
            array(
                'name' => __( 'Slide Link', 'im' ),
                'id'   => $prefix.'slide_link',
		        'desc'       => 'Add link', 
        		'type'         => 'text', 
        		'default'         => '#',
            ),
        ),    
    );

    

    $meta_boxes['im_section1_metabox'] = array(
        'id'            => 'im_section1_metabox',
        'title'         => __( 'Section Information', 'im' ),
        'object_types'  => array( 'home_section_1' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image 1', 'im' ),
                'id'   => $prefix.'section_img1',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Image 2', 'im' ),
                'id'   => $prefix.'section_img2',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Section Link', 'im' ),
                'id'   => $prefix.'section_link1',
		        'desc'       => 'Add link', 
        		'type'         => 'text', 
        		'default'         => '#',
            ),
        ),    
    );

    $meta_boxes['im_section2_metabox'] = array(
        'id'            => 'im_section2_metabox',
        'title'         => __( 'Section Information', 'im' ),
        'object_types'  => array( 'home_section_2' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image 1', 'im' ),
                'id'   => $prefix.'section_img1',
		        'desc'       => 'Add image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Section Content', 'im' ),
                'id'   => $prefix.'section_content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea_small',
            ),
            array(
                'name' => __( 'Section Link', 'im' ),
                'id'   => $prefix.'section_link',
		        'desc'       => 'Add link', 
        		'type'         => 'text', 
        		'default'         => '#',
            ),
        ),    
    );

    $meta_boxes['im_section3_metabox'] = array(
        'id'            => 'im_section3_metabox',
        'title'         => __( 'Section Information', 'im' ),
        'object_types'  => array( 'home_section_3' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Image 1', 'im' ),
                'id'   => $prefix.'section_img1',
		        'desc'       => 'Add Image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Image 2', 'im' ),
                'id'   => $prefix.'section_img2',
		        'desc'       => 'Add Image', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Section Content', 'im' ),
                'id'   => $prefix.'section_content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea_small',
            ),
            array(
                'name' => __( 'Section Link', 'im' ),
                'id'   => $prefix.'section_link',
		        'desc'       => 'Add link', 
        		'type'         => 'text', 
        		'default'         => '#',
            ),
        ),    
    );

	$meta_boxes['im_icons_metabox'] = array(
        'id'            => 'im_icons_metabox',
        'title'         => __( 'Information', 'im' ),
        'object_types'  => array( 'special_offers' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        'fields'        => array(
            array(
                'name' => __( 'Icon', 'im' ),
                'id'   => $prefix.'icon_img',
		        'desc'       => 'Add Icon', 
        		'type'         => 'file',
            ),
            array(
                'name' => __( 'Content', 'im' ),
                'id'   => $prefix.'icon_content',
		        'desc'       => 'Add content', 
        		'type'         => 'textarea',
            ),
            /*array(
                'name' => __( 'Link', 'im' ),
                'id'   => $prefix.'icon_link',
		        'desc'       => 'Add link', 
        		'type'         => 'text',
            ),*/
        ),    
    );

    return $meta_boxes;
}

if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 140, 120 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
add_image_size( 'homepage-thumb', 140, 120, true ); //(cropped)
}

add_action( 'init', 'business_carousel' );
function business_carousel() {

    $labels = array(
        'name'                => _x( 'Slide', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section A', 'im' ),
        'parent_item_colon'   => __( 'Parent Slide:', 'im' ),
        'all_iteim'           => __( 'All Slides', 'im' ),
        'view_item'           => __( 'View Slide', 'im' ),
        'add_new_item'        => __( 'Add New Slide', 'im' ),
        'add_new'             => __( 'Add New Slide', 'im' ),
        'edit_item'           => __( 'Edit Slide', 'im' ),
        'update_item'         => __( 'Update Slide', 'im' ),
        'search_iteim'        => __( 'Search Slide', 'im' ),
        'not_found'           => __( 'No Slide found', 'im' ),
        'not_found_in_trash'  => __( 'No Slide found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Slide', 'im' ),
        'description'         => __( 'Slide information pages', 'im' ),
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
	      	'slug' => 'loan-carousel',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'business_carousel', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'personal_carousel' );
function personal_carousel() {

    $labels = array(
        'name'                => _x( 'Slide', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section B', 'im' ),
        'parent_item_colon'   => __( 'Parent Slide:', 'im' ),
        'all_iteim'           => __( 'All Slides', 'im' ),
        'view_item'           => __( 'View Slide', 'im' ),
        'add_new_item'        => __( 'Add New Slide', 'im' ),
        'add_new'             => __( 'Add New Slide', 'im' ),
        'edit_item'           => __( 'Edit Slide', 'im' ),
        'update_item'         => __( 'Update Slide', 'im' ),
        'search_iteim'        => __( 'Search Slide', 'im' ),
        'not_found'           => __( 'No Slide found', 'im' ),
        'not_found_in_trash'  => __( 'No Slide found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Slide', 'im' ),
        'description'         => __( 'Slide information pages', 'im' ),
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
        'menu_icon'           => 'dashicons-images-alt',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'finance-carousel',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'personal_carousel', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'home_section_1' );
function home_section_1() {

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
        'menu_icon'           => 'dashicons-schedule',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'homesection1',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'home_section_1', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'home_section_3' );
function home_section_3() {

    $labels = array(
        'name'                => _x( 'Box', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Box', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Home Section D', 'im' ),
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
        'menu_icon'           => 'dashicons-schedule',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'homesection3',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'home_section_3', $args );
    flush_rewrite_rules();
}

add_action( 'init', 'special_offers' );
function special_offers() {

    $labels = array(
        'name'                => _x( 'Offer', 'Post Type General Name', 'im' ),
        'singular_name'       => _x( 'Offer', 'Post Type Singular Name', 'im' ),
        'menu_name'           => __( 'Special Offers ', 'im' ),
        'parent_item_colon'   => __( 'Parent Offer:', 'im' ),
        'all_iteim'           => __( 'All Offers', 'im' ),
        'view_item'           => __( 'View Offer', 'im' ),
        'add_new_item'        => __( 'Add New Offer', 'im' ),
        'add_new'             => __( 'Add New Offer', 'im' ),
        'edit_item'           => __( 'Edit Offer', 'im' ),
        'update_item'         => __( 'Update Offer', 'im' ),
        'search_iteim'        => __( 'Search Offer', 'im' ),
        'not_found'           => __( 'No Offer found', 'im' ),
        'not_found_in_trash'  => __( 'No Offer found in Trash', 'im' ),
    );
    $args = array(
        'label'               => __( 'Offer', 'im' ),
        'description'         => __( 'Offer information pages', 'im' ),
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
        'menu_icon'           => 'dashicons-heart',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'rewrite' => array(
	      	'slug' => 'special_offers',
		    'with_front' => false,
	    ) ,
    );
    register_post_type( 'special_offers', $args );
    flush_rewrite_rules();
}