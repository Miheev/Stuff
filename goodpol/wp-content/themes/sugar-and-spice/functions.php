<?php
/**
 * Sugar & Spice functions and definitions
 *
 * @package Sugar & Spice
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */

/** 
 * Adjust $content_width it depending on the temaplte used 
 */
function sugarspice_content_width() {
	global $content_width;
    
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'full-width-page.php' ) )
		$content_width = 940;
}
add_action( 'template_redirect', 'sugarspice_content_width' );    
    
    
if ( ! function_exists( 'sugarspice_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function sugarspice_setup() {

	load_theme_textdomain( 'sugarspice', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 210, 210, true );
    add_image_size( 'mini-thumb', 60, 60, true );
    
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sugarspice' ),
		'footer' => __( 'Footer Menu', 'sugarspice' )
	) );

	add_theme_support( 'custom-background', apply_filters( 'sugarspice_custom_background_args', array(
		'default-color' => '',
		'default-image' => get_template_directory_uri() . '/images/bg.png',
	) ) );
    
    add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // sugarspice_setup
add_action( 'after_setup_theme', 'sugarspice_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function sugarspice_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sugarspice' ),
		'id'            => 'sidebar-1',
        'description'   => 'Main widget area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
	register_sidebar( array(
		'name'          => __( 'Prefooter Area One', 'sugarspice' ),
		'id'            => 'prefooter-1',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );    

	register_sidebar( array(
		'name'          => __( 'Prefooter Area Two', 'sugarspice' ),
		'id'            => 'prefooter-2',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );    

	register_sidebar( array(
		'name'          => __( 'Prefooter Area Three', 'sugarspice' ),
		'id'            => 'prefooter-3',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );      
    
    register_widget( 'sugarspice_contact_widget' );
    register_widget( 'sugarspice_about_widget' );
    register_widget( 'sugarspice_archives_widget' );
    register_widget( 'sugarspice_social_widget' );
}
add_action( 'widgets_init', 'sugarspice_widgets_init' );

include( get_template_directory() . '/inc/widgets/contact-widget.php' );
include( get_template_directory() . '/inc/widgets/about-widget.php' );
include( get_template_directory() . '/inc/widgets/archives-widget.php' );
include( get_template_directory() . '/inc/widgets/social-widget.php' );

function sugarspice_prefooter_class() {
	$count = 0;

	if ( is_active_sidebar( 'prefooter-1' ) )
		$count++;

	if ( is_active_sidebar( 'prefooter-2' ) )
		$count++;

	if ( is_active_sidebar( 'prefooter-3' ) )
		$count++;
		
	$class = '';

    if ( $count == 2 ) {
        $class = 'one-half';
    } else if ( $count == 3 ) {
        $class = 'one-third';
	}
    
	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Enqueue scripts and styles
 */
function sugarspice_scripts() {
	
    wp_enqueue_script( 'sugarspice-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array(), '2.6.2', true); 
    wp_enqueue_script('modernizr');
    
    wp_register_script('tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array(), '1.1', true); 
    wp_enqueue_script('tinynav');
        
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'sugarspice-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.2.0', true );
    
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'sugarspice-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'sugarspice_scripts' );

/**
 * Returns the Google font stylesheet URL, if available.
 */
function sugarspice_fonts_url() {
	$fonts_url = '';

	$niconne = _x( 'on', 'Niconne font: on or off', 'sugarspice' );

	$ptserif = _x( 'on', 'PT Serif font: on or off', 'sugarspice' );

    $raleway = _x( 'on', 'Raleway font: on or off', 'sugarspice' );
    
	if ( 'off' !== $niconne || 'off' !== $ptserif || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $niconne )
			$font_families[] = 'Niconne';

		if ( 'off' !== $ptserif )
			$font_families[] = 'PT+Serif:400,700';

        if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,600';    
            
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

function sugarspice_css() {
    
	wp_enqueue_style( 'sugarspice-fonts', sugarspice_fonts_url() );

	wp_enqueue_style( 'sugarspice-style', get_stylesheet_uri() );
	
	if ( of_get_option( 'responsive' ) == 0 ) 
	wp_enqueue_style( 'sugarspice-responsive', get_template_directory_uri() . '/responsive.css' );

    wp_register_style('sugarspice-icofont', get_template_directory_uri() . '/fonts/icofont.css');
    wp_enqueue_style('sugarspice-icofont');
    
}
add_action( 'wp_enqueue_scripts', 'sugarspice_css' );

if (!function_exists('sugarspice_footer_js')) {
	function sugarspice_footer_js() {
    ?>
        <script>     
       
        jQuery(document).ready(function($) {   
            $('.widget-title').each(function() {
                var $this = $(this);
                $this.html($this.html().replace(/(\S+)\s*$/, '<em>$1</em>'));
            });
            $('#reply-title').addClass('section-title').wrapInner('<span></span>');
            
            if( $('.flexslider').length ) {
                $('.flexslider').flexslider({ directionNav: false, pauseOnAction: false, });
                $('.flex-control-nav').each(function(){
                    var $this = $(this);                
                    var width = '-'+ ($this.width() / 2) +'px';
                    console.log($this.width());
                    $this.css('margin-left', width);
                }); 
            }
            
            $("#nav").tinyNav({header: '<?php _e( "Menu", "sugarspice" ); ?>'});
        });
        </script>
    <?php
	}
}
add_action( 'wp_footer', 'sugarspice_footer_js', 20, 1 );    

/**
 * Excerpt config. Can be overriden in child theme
 */
if (!function_exists('sugarspice_excerpt_length')) {
    function sugarspice_excerpt_length( $length ) {
        return 40;
    }
}    
add_filter( 'excerpt_length', 'sugarspice_excerpt_length', 999 );

if (!function_exists('sugarspice_excerpt_more')) {
    function sugarspice_excerpt_more( $more ) {
        return '...';
    }
}    
add_filter('excerpt_more', 'sugarspice_excerpt_more');


/**
 * Options Framework
 */
if ( ! function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
}

// Theme Options sidebar
add_action( 'optionsframework_after','sugarspice_options_display_sidebar' );

function sugarspice_options_display_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			<div class="postbox">
				<h3><?php _e('Support','sugarspice') ?></h3>
					<div class="inside">
                        <p><?php _e('The best way to contact me with <b>support questions</b> and <b>bug reports</b> is via the','sugarspice') ?> <a href="http://wordpress.org/support/theme/sugar-and-spice"><?php _e('WordPress support forums','corpo') ?></a>.</p>
                        <p><?php _e('If you like this theme, I\'d appreciate if you could ','sugarspice') ?>
                        <a href="http://wordpress.org/support/view/theme-reviews/sugar-and-spice"><?php _e('rate Sugar & Spice at WordPress.org','sugarspice') ?></a><br /><b><?php _e('Thanks!','sugarspice'); ?></b></p>
					</div>
			</div>
		</div>
	</div>
<?php }

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

function create_my_taxonomies() {

    register_taxonomy('actors', 'post', array(

        'hierarchical' => false, 'label' => 'Actors',

        'query_var' => true, 'rewrite' => true));

    register_taxonomy('producers', 'post', array(

        'hierarchical' => false, 'label' => 'Producers',

        'query_var' => true, 'rewrite' => true));
}
add_action('init', 'create_my_taxonomies', 0);
