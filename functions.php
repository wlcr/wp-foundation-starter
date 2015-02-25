<?php
/**
 * wlcr functions and definitions
 *
 * @package wlcr
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wlcr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wlcr_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wlcr, use a find and replace
	 * to change 'wlcr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wlcr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wlcr' ),
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
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wlcr_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wlcr_setup
add_action( 'after_setup_theme', 'wlcr_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wlcr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wlcr' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wlcr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wlcr_scripts() {
	global $wp_styles;
	//wp_register_style('googlefont', 'http://fonts.googleapis.com/css?family=familyname:300,400,700');
	wp_enqueue_style( 'foundation-style', get_template_directory_uri() . '/css/foundation.min.css' );
	wp_enqueue_style( 'wlcr-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'slickslider-style', get_template_directory_uri() . '/css/slick.css' );
	wp_enqueue_style( 'wlcr-ie9', get_stylesheet_directory_uri() . "/css/ie9.css", array( 'wlcr' )  );
    	$wp_styles->add_data( 'wlcr-ie9', 'conditional', 'lte IE 9' );	
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery') );
	wp_enqueue_script( 'fastclick-js', get_template_directory_uri() . '/js/vendor/fastclick.js' );		
	wp_enqueue_script( 'modernizr', "http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js", array('jquery'), '20120206', true );
	wp_enqueue_script( 'wlcr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'slickslider-js', get_template_directory_uri() . '/js/vendor/slick.min.js' );		
	wp_enqueue_script( 'wlcr-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery') );
	wp_enqueue_script( 'wlcr-script', get_template_directory_uri() . '/js/main.js', array('jquery', 'wlcr-plugins', 'slickslider-js', 'foundation-js') );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wlcr_scripts' );


/** 
* Add conditional scripts here
*/
add_action( 'wp_head', function() {
   echo '<!--[if lt IE 9]><script src="//cdn.jsdelivr.net/html5shiv/latest/html5shiv.js"></script><![endif]-->';
} );




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

/**
 * Add slugs to custom menu items
 */
function add_slug_class_to_menu_item($output){
  $ps = get_option('permalink_structure');
  if(!empty($ps)){
    $idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
    foreach($matches[1] as $mid){
      $id = get_post_meta($mid, '_menu_item_object_id', true);
      $slug = basename(get_permalink($id));
      $output = preg_replace('/menu-item-'.$mid.'">/', 'menu-item-'.$mid.' menu-item-'.$slug.'">', $output, 1);
    }
  }
  return $output;
}
add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');


/**
 * Add page slug to body classes
 */
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = 'slug-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Add favicon
function blog_favicon() {
	echo '<link rel="shortcut icon" href="'.get_template_directory_uri().'/favicon.ico">';
}
add_action('wp_head', 'blog_favicon');
