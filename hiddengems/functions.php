<?php
/**
 * HiddenGems functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HiddenGems
 */

if ( ! function_exists( 'hiddengems_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hiddengems_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on HiddenGems, use a find and replace
		 * to change 'hiddengems' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hiddengems', get_template_directory() . '/languages' );

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
			'primary' => esc_html__( 'Primary', 'hiddengems' ),
			'secondary' => esc_html__( 'Secondary', 'hiddengems' ),
			'social' => esc_html__( 'Social', 'hiddengems' ),
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
		add_theme_support( 'custom-background', apply_filters( 'hiddengems_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	//Add theme support for custom logo.
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       =>90,
		'flex-width'  => true,
		'flex-height' => true,
	) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );


	}
endif;
add_action( 'after_setup_theme', 'hiddengems_setup' );
//
// **
//  * Register custom fonts.
//  */
function hiddengems_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Source sans pro and PT serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$Source_sans_pro = _x( 'on', 'Roboto font: on or off', 'hiddengems' );
	$PT_serif = _x( 'on', 'PT Serif font: on or off', 'hiddengems' );
		$font_families = array();

if ( 'off' !== $Roboto ){
		$font_families[]='Roboto:400,400i,500,700,700i';
}
if ( 'off' !== $PT_serif ){
		$font_families[]='PT Serif:400,400i,700,700i';
}
	if ( in_array('on',array($Roboto, $PT_serif ))) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since hiddengems 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function hiddengems_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'hiddengems-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'hiddengems_resource_hints', 10, 2 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hiddengems_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hiddengems_content_width', 640 );
}
add_action( 'after_setup_theme', 'hiddengems_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hiddengems_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hiddengems' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hiddengems' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer-1', 'hiddengems' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer widgets here.', 'hiddengems' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer-2', 'hiddengems' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add footer widgets here.', 'hiddengems' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer-3', 'hiddengems' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add footer widgets here.', 'hiddengems' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'hiddengems_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

 /* Enque google fonts:source sans pro and PT serif*/
 wp_enqueue_style('hiddengems-fonts',hiddengems_fonts_url());
function hiddengems_scripts() {
	wp_enqueue_style( 'hiddengems-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hiddengems-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
wp_localize_script('hiddengems-navigation','hiddengemsScreenReaderText',array(
	'expand'=>__( 'Expand child menu', 'hiddengems' ),
	'collapse'=>__( 'Collapse child menu', 'hiddengems' ),
));
	wp_enqueue_script( 'hiddengems-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hiddengems_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';

}

// Add inline style to set body background via "myprefix_background_image" custom field
function hiddengems_custom_field_background() {
	if ( $background = get_post_meta( get_the_ID(), 'hiddengems_background_image', true ) ) { ?>
		<style type="text/css">
			body { background-image: url( "<?php echo esc_url( $background ); ?>" ); }
		</style>
	<?php }
add_action( 'wp_head', 'hiddengems_custom_field_background' );

}
