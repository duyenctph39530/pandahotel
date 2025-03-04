<?php
/**
 * Theme Functions and Definitions
 *
 * @package Luxestay Hotel
 */

// All Function code and function definitions go here...


add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'video', 'audio', 'link', 'status', 'chat', 'news' ) );


add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-width'  => true,
    'flex-height' => true,
) );

add_theme_support( 'customizer' );


add_theme_support( 'custom-header', array(
    'width'         => 1920,
    'height'        => 300,
    'flex-height'   => true,
    'header-text'   => false,
    'unlink-homepage-logo' => true,
) );



add_theme_support( 'custom-background', array(
    'default-color'      => '',
    'default-image'      => '',
    'default-repeat'     => '',
    'default-position-x' => '',
    'default-attachment' => '',
) );

add_theme_support( 'align-wide' );


// Add support for Translation
load_theme_textdomain( 'luxestay-hotel', get_template_directory() . '/languages' );


//------------------Include Bootstap---------------

function luxestay_hotel_enqueue_styles() {
    wp_enqueue_style( 'luxestay-hotel-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_script( 'luxestay-hotel-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', true );
     wp_enqueue_script( 'luxestay-hotel-custom-js', get_template_directory_uri() . '/menu/menu.js', array( 'jquery' ), '1.0', true );
     wp_enqueue_style( 'luxestay-hotel-custom-css', get_template_directory_uri() . '/menu/menu.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'luxestay-hotel-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto&display=swap' );
    
    wp_enqueue_style( 'luxestay-hotel-custom-style1', get_stylesheet_directory_uri() . '/inc/customizer-button/customizer-custom.css' );

         //---------------Color selector file adding--
    wp_enqueue_style( 'luxestay-hotel-color-selector', get_stylesheet_uri() );
    require get_parent_theme_file_path( '/inc/color-selector.php' );
    wp_add_inline_style( 'luxestay-hotel-color-selector',$custom_css );

}
add_action( 'wp_enqueue_scripts', 'luxestay_hotel_enqueue_styles' );



//-------------------Loading Fonts Locally-----------

function luxestay_hotel_enqueue_assets() {
 
    // Include the file.
    require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
 
    // Load the theme stylesheet.
    wp_enqueue_style(
        'luxestay-hotel',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        '1.0'
    );
 
    // Load the webfont.
    wp_add_inline_style(
        'luxestay-hotel',
        wptt_get_webfont_styles( 'https://fonts.googleapis.com/css2?family=Literata&display=swap' )
    );
}
add_action( 'wp_enqueue_scripts', 'luxestay_hotel_enqueue_assets' );



//-------------------------Header Code--------------------------------


//--------------------My Menu Registration-----

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'primary'   => esc_html__( 'Primary', 'luxestay-hotel' ),
) );



//---------------------------My Menu---------------------------------

if( ! function_exists( 'luxestay_hotel_primary_nagivation' ) ) :
/**
 * Primary Navigation.
*/
function luxestay_hotel_primary_nagivation(){ ?>
    <nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
            <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'luxestay-hotel' ); ?>">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu main-menu-modal',
                        'fallback_cb'    => 'luxestay_hotel_primary_menu_fallback',
                    ) );
                ?>
            </div>
        </div>
        <button class="toggle-button" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
        </button>
    </nav><!-- #site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'luxestay_hotel_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function luxestay_hotel_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'luxestay-hotel' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;


//-----------------------Menu function End--------------

//---------------Include Files----------------------

/* Customizer additions. */

require get_template_directory() . '/inc/custom-customizer.php';
require get_template_directory() . '/inc/customizer.php';


//--------------------------Radio Button Customizer Function--------------

/*Radio Button sanitization*/
function luxestay_hotel_sanitize_choices( $input, $setting ) {
  global $wp_customize;
  $control = $wp_customize->get_control( $setting->id );
  if ( array_key_exists( $input, $control->choices ) ) {
    return $input;
  } else {
    return $setting->default;
  }
}


//-------------------sidebar------------------

function luxestay_hotel_theme_register_sidebars() {
    register_sidebar( array(
        'name' => __( 'Primary Sidebar', 'luxestay-hotel' ),
        'id' => 'primary-sidebar',
        'description' => __( 'Widgets in this area will be shown in the sidebar.', 'luxestay-hotel' ),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'luxestay_hotel_theme_register_sidebars' );

//------------------Credit function---------------


define('LUXESTAY_HOTEL_URL','https://cawpthemes.com/');

function luxestay_hotel_credit_link() {
  echo esc_html__('Powered by WordPress | By ', 'luxestay-hotel') . " <a href=" . esc_url(LUXESTAY_HOTEL_URL) . " target='_blank'>" . esc_html__('CA WP Themes', 'luxestay-hotel') . "</a>";
}



/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function luxestay_hotel_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'luxestay_hotel_skip_link_focus_fix' );


//----------------Get Started--------------


require get_template_directory() . '/inc/getstarted/getstart.php';

//----------------footer---------


// Register Footer Widget Area
function luxestay_hotel_register_footer_widget_area() {
    register_sidebar( array(
        'name'          => __( 'Footer 1 Widget Area', 'luxestay-hotel' ),
        'id'            => 'footer_widget_area1',
        'description'   => __( 'Add widgets here to appear in your footer.', 'luxestay-hotel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2 Widget Area', 'luxestay-hotel' ),
        'id'            => 'footer_widget_area2',
        'description'   => __( 'Add widgets here to appear in your footer.', 'luxestay-hotel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 3 Widget Area', 'luxestay-hotel' ),
        'id'            => 'footer_widget_area3',
        'description'   => __( 'Add widgets here to appear in your footer.', 'luxestay-hotel' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'luxestay_hotel_register_footer_widget_area' );


//-------Extra


function luxestay_hotel_register_block_styles() {
    // Register a block style for the heading block
    wp_register_style(
        'luxestay-hotel-heading-style',
        get_template_directory_uri() . '/css/blocks.css',
        array( 'wp-blocks' ),
        '1.0',
        'all'
    );
    register_block_style(
        'core/heading',
        array(
            'name'         => 'luxestay-hotel-heading',
            'label' => __( 'My Theme Heading', 'luxestay-hotel' ),
            'style_handle' => 'luxestay-hotel-heading-style',
        )
    );
}
add_action( 'init', 'luxestay_hotel_register_block_styles' );


//------Custom Block---------

function luxestay_hotel_register_block_patterns() {
    if ( function_exists( 'register_block_pattern' ) ) {
        register_block_pattern(
            'luxestay-hotel/custom-pattern',
            array(
                'title'       => __( 'My Custom Pattern', 'luxestay-hotel' ),
                'description' => __( 'A custom block pattern for my theme', 'luxestay-hotel' ),
                'categories'  => array( 'text' ),
                'content'     => '<!-- wp:paragraph --><p>This is my custom block pattern</p><!-- /wp:paragraph -->',
            )
        );
    }
}
add_action( 'init', 'luxestay_hotel_register_block_patterns' );


function luxestay_hotel_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'luxestay_hotel_add_editor_styles' );



//------------------------Comments-------------


function luxestay_hotel_enable_threaded_comments() {
    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'luxestay_hotel_enable_threaded_comments');

// ----------------------------Menu navigation keyboard--------------


function luxestay_hotel_add_tabindex_to_menu_items( $atts, $item, $args, $depth ) {
    // Add tabindex="0" to the menu item
    $atts['tabindex'] = '0';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'luxestay_hotel_add_tabindex_to_menu_items', 10, 4 );

//--------------------Define--------------------


define('LUXESTAY_HOTEL_PRO_URL',__('https://cawpthemes.com/luxestay-hotel-premium-wordpress-theme/','luxestay-hotel'));
define('LUXESTAY_HOTEL_PRO_SUPPORT',__('https://cawpthemes.com/support/','luxestay-hotel'));
define('LUXESTAY_HOTEL_PRO_DEMO',__('https://demo.cawpthemes.com/luxestay-hotel-pro/','luxestay-hotel'));
define('LUXESTAY_HOTEL_PRO_DOCUMENTATION',__('https://cawpthemes.com/docs/luxestay-hotel-free-theme-documentation/','luxestay-hotel'));
define('LUXESTAY_HOTEL_FREE_URL',__('https://demo.cawpthemes.com/luxestay-hotel/','luxestay-hotel'));
