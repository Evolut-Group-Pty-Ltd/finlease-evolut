<?php
if ( ! function_exists( 'finlease_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function finlease_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Finlease, use a find and replace
		 * to change 'finlease' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'finlease', get_template_directory() . '/languages' );

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
            'menu-primary' => esc_html__( 'Primary', 'finlease' ),
            'menu-mega' => esc_html__( 'Mega Menu', 'finlease' ),
			'menu-footer' => esc_html__( 'Footer', 'finlease' ),
			'menu-banner' => esc_html__( 'Banner', 'finlease' ),
			// 'menu-form' => esc_html__( 'Form', 'finlease' ),
		) );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'finlease_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'finlease_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function finlease_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'finlease_content_width', 640 );
}
add_action( 'after_setup_theme', 'finlease_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function finlease_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'finlease' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'finlease' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget', 'finlease' ),
		'id'            => 'fl-footer-widget',
		'description'   => esc_html__( 'Add Footer widgets here.', 'finlease' ),
		'before_widget' => '<div class="footer-menu-item col-lg-2">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'finlease_widgets_init' );

/**
 * Add Custom Image sizes for Finlease Site
 *
 * @return void
 */
function finlease_custom_add_image_sizes() {

	add_image_size( 'finlease-image-blog-listing', 360, 240, true );
	add_image_size( 'finlease-inner-banner', 552, 484, true );
	add_image_size( 'finlease-multiple-content', 552, 328, true );
	add_image_size( 'finlease-cta-block', 554, 328, true );
	add_image_size( 'finlease-text-block', 552, 328, true );
	add_image_size( 'finlease-pages-block', 360, 232, true );
	add_image_size( 'finlease-broker-slider', 271, 167, true );
	add_image_size( 'finlease-featured-blog', 1128, 534, true );
	add_image_size( 'finlease-blog-single', 1440, 591, true );
	add_image_size( 'finlease-broker-single', 80, 80, true );

}

add_action( 'after_setup_theme', 'finlease_custom_add_image_sizes' );