<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage  Blogification
 * @since  Blogification 1.0.0
 */

if ( ! function_exists( 'blogification_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blogification_setup() {
        $options = blogification_get_theme_options();
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'blogification' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blogification' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( "responsive-embeds" );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 600, 450, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'blogification' ),
			'social' 	=> esc_html__( 'Social', 'blogification' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blogification_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . blogification_min() . '.css', blogification_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'blogification' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'blogification' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'blogification' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'blogification' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'blogification' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'blogification' ),
		       	'shortName' => esc_html__( 'S', 'blogification' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'blogification' ),
		       	'shortName' => esc_html__( 'M', 'blogification' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'blogification' ),
		       	'shortName' => esc_html__( 'L', 'blogification' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'blogification' ),
		       	'shortName' => esc_html__( 'XL', 'blogification' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'blogification_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogification_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = blogification_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter  Blogification content width of the theme.
	 *
	 * @since  Blogification 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'blogification_content_width', $content_width );
}
add_action( 'template_redirect', 'blogification_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogification_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blogification' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blogification' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Hero Section Sidebar', 'blogification' ),
		'id'            => 'hero-section-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'blogification' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Main Section Sidebar', 'blogification' ),
		'id'            => 'main-section-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'blogification' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s grid-layout">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebars( 4, array(
		'name'          => esc_html__( 'Optional Sidebar %d', 'blogification' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'blogification' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blogification_widgets_init' );


if ( ! function_exists( 'blogification_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function blogification_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';


	/* translators: If there are characters in your language that are not supported by Khand, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'barlow font: on or off', 'blogification' ) ) {
		$fonts[] = 'Barlow:400,500,600,700&display=swap';
	}
    if ( 'off' !== _x( 'on', 'philosopher font: on or off', 'blogification' ) ) {
        $fonts[] = 'Philosopher:400,500,600,700&display=swap';
    }
    if ( 'off' !== _x( 'on', 'lora font: on or off', 'blogification' ) ) {
        $fonts[] = 'Lora:400,500,600,700&display=swap';
    }


	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since  Blogification 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function blogification_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'blogification-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => esc_url('https://fonts.gstatic.com'),			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'blogification_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function blogification_scripts() {
	$options = blogification_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'blogification-fonts', blogification_fonts_url(), array(), null );

	// font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome'. blogification_min() . '.css' );

	// blocks
	wp_enqueue_style( 'blogification-blocks', get_template_directory_uri() . '/assets/css/blocks' . blogification_min() . '.css' );

	wp_enqueue_style( 'blogification-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'blogification-html5', get_template_directory_uri() . '/assets/js/html5' . blogification_min() . '.js', array(), '3.7.3' );

	wp_script_add_data( 'blogification-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'blogification-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . blogification_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'blogification-navigation', get_template_directory_uri() . '/assets/js/navigation' . blogification_min() . '.js', array(), '20151215', true );
	
	$blogification_l10n = array(
		'quote'          => blogification_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'blogification' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'blogification' ),
		'icon'           => blogification_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);
	
	wp_localize_script( 'blogification-navigation', 'blogification_l10n', $blogification_l10n );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'blogification-custom', get_template_directory_uri() . '/assets/js/custom'. blogification_min() .'.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'blogification_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since  Blogification 1.0.0
 */
function blogification_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'blogification-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . blogification_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'blogification-fonts', blogification_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'blogification_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';
