<?php
/**
 * builtrite Class
 *
 * @author   benluoma
 * @since    1.0
 * @package  builtrite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'builtrite' ) ) :

	/**
	 * The main builtrite class
	 */
	class builtrite {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme',          array( $this, 'setup' ) );
			add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ) );
			add_filter( 'body_class',                 array( $this, 'body_classes' ) );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on components, use a find and replace
			 * to change 'builtrite' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'builtrite', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Add support for core custom logo.
			 */
			add_theme_support( 'custom-logo', array(
				'height'      => 110,
				'width'       => 470,
				'flex-width'  => true,
				'flex-height' => true
			) );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'main-menu'   => __( 'Main Menu', 'builtrite' ),
			) );

			register_nav_menus( array(
				'footer-menu'   => __( 'Footer Menu', 'builtrite' ),
			) );

			register_nav_menus( array(
				'products-menu'   => __( 'Products Menu', 'builtrite' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			) );

			/*
			 * Enable support for Post Formats.
			 * See https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			) );

			// Setup the WordPress core custom background feature.
			/*
			add_theme_support( 'custom-background', apply_filters( 'builtrite_custom_background_args', array(
				'default-color' => apply_filters( 'builtrite_default_background_color', 'ffffff' ),
				'default-image' => '',
			) ) );
			*/

			// Declare WooCommerce support.
			add_theme_support( 'woocommerce' );

			// Support edit shortcuts in Customizer
			add_theme_support( 'customize-selective-refresh-widgets' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			// Add editor stylesheet
			add_editor_style( get_stylesheet_directory_uri() . '/editor-style.css' );

			// Add custom image sizes
			add_image_size( 'fullscreen', 1280, 9999 );

			add_filter( 'image_size_names_choose', 'builtrite_custom_sizes', 1, 5 );

			function builtrite_custom_sizes( $sizes ) {
			    return array_merge( $sizes, array(
			        'fullscreen' => __( 'Full Screen' ),
			    ) );
			}
		}

		/**
		 * Register widget areas.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', 'builtrite' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Right', 'builtrite' ),
				'id'            => 'sidebar-4',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Type Sidebar', 'builtrite' ),
				'id'            => 'sidebar-2',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Industry Sidebar', 'builtrite' ),
				'id'            => 'sidebar-3',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Left', 'builtrite' ),
				'id'            => 'sidebar-5',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $builtrite_version;



			/**
			 * Styles
			 */
			wp_enqueue_style( 'builtrite-style', get_stylesheet_uri(), array( 'dashicons' ) );
			wp_enqueue_script("jquery");

			/**
			 * Scripts
			 */
			 wp_enqueue_script( "main", get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery','jquery-effects-core'), '20151215', true );
 			 //wp_enqueue_script( "bootstrap", get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20151215', true ); //TODO: rename plugins.min.js
 			 if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
 			  	wp_enqueue_script( 'comment-reply' );
 			 }
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */

		public function body_classes( $classes ) {
			// Add a class for header layout
			switch (get_theme_mod('builtrite_header_layout')) {
			    case 'left':
			        $classes[] = 'nav-left';
			        break;
			    case 'center':
			        $classes[] = 'nav-center';
			        break;
			    default:
			        $classes[] = 'nav-right';
			        break;
			}

			// Add a class for header layout
			switch (get_theme_mod('builtrite_mobile_menu_type')) {
			    case 'top':
			        $classes[] = 'mobile-top';
			        break;
			    default:
			        $classes[] = 'mobile-bottom';
			        break;
			}

			// Add a class for a fixed header
			if ( get_theme_mod('builtrite_fixed_header') ) {
				$classes[] = 'fixed-header';
			}

			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( is_singular() && has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}

			// Add a class of no-sidebar when there is no sidebar present
			if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
				$classes[] = 'no-sidebar';
			}

			return $classes;
		}

		/**
		 * Adds custom classes to the header
		 *
		 * @param array $classes Classes for the header element.
		 * @return array
		 */

	}

endif;

return new builtrite();
