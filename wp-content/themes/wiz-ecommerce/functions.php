<?php
/**
 * Wiz eCommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wiz eCommerce
 */
if ( ! function_exists( 'wiz_ecommerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wiz_ecommerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wiz_ecommerce, use a find and replace
		 * to change 'wiz-ecommerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wiz-ecommerce', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'wiz-primary-nav' => esc_html__( 'Main menu', 'wiz-ecommerce' ),
			'wiz-store-nav' => esc_html__( 'Menu for Woocommerce pages', 'wiz-ecommerce' ),
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'css/style-editor.css' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// custom image size for slider
		add_image_size( 'wiz-slide', 1920, 800, true );

		//theme's cotent width
		if ( ! isset( $content_width ) ) $content_width = 900;


		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wiz_ecommerce_custom_background_args', array(
			'default-color' => 'f4f4f4',
			'default-image' => '',
		) ) );

		$wiz_ecommerce_header_args = array(
			'default-image'          => get_template_directory_uri().'/img/slide-placeholder.jpg',
			'default-text-color' => '000000',
			'width'                  => 1920,
			'height'                 => 450,
			'uploads'                => true,
			'random-default'         => false,
		);
		add_theme_support( 'custom-header', $wiz_ecommerce_header_args );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for woocomerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 350,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wiz_ecommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wiz_ecommerce_content_width() {
	$GLOBALS['wiz_ecommerce_content_width'] = apply_filters( 'wiz_ecommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'wiz_ecommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wiz_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wiz-ecommerce' ),
		'id'            => 'wiz-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'wiz-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="mb-4 widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="font-weight-bold text-uppercase">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Sidebar', 'wiz-ecommerce' ),
		'id'            => 'wiz-woo-sidebar',
		'description'   => esc_html__( 'Widget Area for Woocommerce Pages', 'wiz-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="mb-4 widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="font-weight-bold text-uppercase">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'wiz-ecommerce' ),
		'id'            => 'wiz-footer',
		'description'   => esc_html__( 'Add Footer widgets here.', 'wiz-ecommerce' ),
		'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 footer-widget %2$s""><div class="footer-section">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="mb-3">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wiz_ecommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wiz_ecommerce_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );
	wp_enqueue_style( 'wiz_ecommerce-theme-font', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700|Raleway:100,200,300,400,500,600,700,800,900' );
	wp_enqueue_style( 'sm-simple', get_template_directory_uri().'/css/sm-simple.css' );
	wp_enqueue_style( 'sm-core-css', get_template_directory_uri().'/css/sm-core-css.css' );
	wp_enqueue_style( 'wiz_ecommerce-theme-style', get_template_directory_uri().'/css/style.css' );
	wp_enqueue_style( 'wiz_ecommerce-style', get_stylesheet_uri() );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/css/owl.carousel.css' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.min.js');
	wp_enqueue_script( 'wiz_ecommerce-tabcollapse', get_template_directory_uri() . '/js/tab.js','','', true);
	wp_enqueue_script( 'wiz_ecommerce-script', get_template_directory_uri() . '/js/theme-script.js');
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js');
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wiz_ecommerce_scripts' );

//Customize
require get_template_directory() . '/inc/customizer.php';

// hooks and functions for woocommerce
require( get_template_directory() . '/inc/wc-functions.php' );

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

//comment list function
require get_template_directory() . '/inc/comment-function.php';

// breadcrumbs class
require( get_template_directory() . '/inc/breadcrumbs.php' );
