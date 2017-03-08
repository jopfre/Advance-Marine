<?php
/**
 * advancemarine functions and definitions
 *
 * @package advancemarine
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'advancemarine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function advancemarine_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on advancemarine, use a find and replace
	 * to change 'advancemarine' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'advancemarine', get_template_directory() . '/languages' );

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
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'advancemarine' ),
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
	add_theme_support( 'custom-background', apply_filters( 'advancemarine_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'post-thumbnails' ); 

	add_filter('show_admin_bar', '__return_false');
	remove_filter( 'the_content', 'wpautop' );
	remove_filter( 'the_excerpt', 'wpautop' );
}
endif; // advancemarine_setup
add_action( 'after_setup_theme', 'advancemarine_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function advancemarine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'advancemarine' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'advancemarine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function advancemarine_scripts() {
	wp_enqueue_style( 'advancemarine-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	// wp_enqueue_script( 'advancemarine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'advancemarine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js", false, null);
	  wp_enqueue_script('jquery');
	}

	// wp_enqueue_script( 'waitforimages', get_template_directory_uri() . '/js/vendor/jquery.waitforimages.min.js', array('jquery'), '20150115');
	
	// wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'waitforimages'), '20150115');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'advancemarine_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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


function get_the_slug() {
	global $post;

	if ( is_single() || is_page() ) {
		return $post->post_name;
	}
	else {
		return "";
	}
}

function get_the_featured_image_url() {
	$page_id = get_queried_object_id();
	if ( has_post_thumbnail( $page_id ) ) :
	    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
	    $feauted_image_url = $image_array[0];
	else :
	    //$feauted_image_url = get_template_directory_uri() . '/images/default-background.jpg';
	endif;

	return $feauted_image_url;
}
	
