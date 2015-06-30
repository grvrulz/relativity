<?php
/**
 * Relativity functions and definitions
 *
 * @package Relativity
 */

if ( ! function_exists( 'relativity_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function relativity_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Relativity, use a find and replace
	 * to change 'relativity' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'relativity', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'relativity' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'relativity_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // relativity_setup
add_action( 'after_setup_theme', 'relativity_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function relativity_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'relativity_content_width', 760 );
	if ( ! isset( $content_width ) ) $content_width = 760;
}
add_action( 'after_setup_theme', 'relativity_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
/*
function relativity_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'relativity' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'relativity_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function relativity_scripts() {
	wp_enqueue_style( 'relativity-style', get_stylesheet_uri() );

	wp_enqueue_script( 'relativity-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'relativity-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//wp_enqueue_style( 'relativity-googlefonts', 'http://fonts.googleapis.com/css?family=Vollkorn:400|Open+Sans:300,400,700');
}
add_action( 'wp_enqueue_scripts', 'relativity_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

function relativity_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'relativity_custom_header_args', array(
        'default-image'          => relativity_get_default_header_image(),

    ) ) );
}
add_action( 'after_setup_theme', 'relativity_custom_header_setup' );
function relativity_get_default_header_image() {

    // Get default from Discussion Settings.
    $default = get_option( 'avatar_default', 'mystery' ); // Mystery man default
    if ( 'mystery' == $default )
        $default = 'mm';
    elseif ( 'gravatar_default' == $default )
        $default = '';

    $protocol = ( is_ssl() ) ? 'https://secure.' : 'http://';
    $url = sprintf( '%1$sgravatar.com/avatar/%2$s/', $protocol, md5( get_option( 'admin_email' ) ) );
    $url = add_query_arg( array(
        's' => 120,
        'd' => urlencode( $default ),
    ), $url );

    return esc_url_raw( $url );
} // relativity_get_default_header_image

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';