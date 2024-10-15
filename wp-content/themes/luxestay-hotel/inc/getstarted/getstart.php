<?php
//about theme info
add_action( 'admin_menu', 'luxestay_hotel_gettingstarted_page' );
function luxestay_hotel_gettingstarted_page() {      
    add_theme_page( esc_html__('Luxestay Hotel', 'luxestay-hotel'), esc_html__('All About Luxestay Hotel', 'luxestay-hotel'), 'edit_theme_options', 'luxestay_hotel_mainpage', 'luxestay_hotel_content_main');   
}


function luxestay_hotel_notice() {
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {?>
    <div class="notice getting_started">
        <div class="notice-content">
            <p><?php esc_html_e( 'Thanks For Choosing CA WP Themes', 'luxestay-hotel' ); ?></p>
            <h2><?php esc_html_e( 'Thanks for installing Luxestay Hotel Free Theme!', 'luxestay-hotel' ) ?> </h2>
            <p><?php esc_html_e( "Please Click on the link below to Check The Full Theme Edit Documentation", 'luxestay-hotel' ) ?></p>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_DOCUMENTATION ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'luxestay-hotel' ); ?></a>
            </div>
            <h2><?php esc_html_e( 'Now the Premium Version is only at $39.99 with Lifetime Access!Grab the deal now!', 'luxestay-hotel' ) ?> </h2>
            <h2><?php esc_html_e( 'Check The Pro Version: Luxestay Hotel Premium for Amazing Features for Unlimited Site', 'luxestay-hotel' ); ?></h2>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_URL ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'luxestay-hotel' ); ?></a>
            </div>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_DEMO ); ?>" target="_blank"> <?php esc_html_e( 'Premium Demo', 'luxestay-hotel' ); ?></a>
            </div>
        </div>
    </div>
    <?php }
}

add_action( 'admin_notices', 'luxestay_hotel_notice' );


// Add a Custom CSS file to WP Admin Area
function luxestay_hotel_admin_page_theme_style() {
   wp_enqueue_style('luxestay-hotel-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstarted/getstarted.css');
}
add_action('admin_enqueue_scripts', 'luxestay_hotel_admin_page_theme_style');

//About Theme Info
function luxestay_hotel_content_main() { 

    //custom function about theme customizer

    $return = add_query_arg( array()) ;
    $theme = wp_get_theme( 'luxestay-hotel' );
?>

<div class="admin-main-box">
    <div class="admin-left-box">
        <h2><?php esc_html_e( 'Welcome to Luxestay Hotel Theme', 'luxestay-hotel' ); ?> <span class="version"><?php $theme_info = wp_get_theme();
echo $theme_info->get( 'Version' );?></span></h2>
        <p><?php esc_html_e('CA WP Themes is a premium WordPress theme development company that provides high-quality themes for various types of websites. They specialize in creating themes for businesses, eCommerce, portfolios, blogs, and many more. Their themes are easy to use and customize, making them perfect for those who want to create a professional-looking website without any coding skills.','luxestay-hotel'); ?></p>
        <p><?php esc_html_e('CA WP Themes offers a wide range of themes that are designed to be responsive and compatible with the latest versions of WordPress. Our themes are also SEO optimized, ensuring that your website will rank well on search engines. They come with a variety of features such as customizable widgets, social media integration, and custom page templates.','luxestay-hotel'); ?></p>
        <p><?php esc_html_e('One of the unique things about CA WP Themes is their focus on providing excellent customer support. They have a dedicated team of support staff who are available 24/7 to help customers with any issues they may encounter. Their support team is knowledgeable and friendly, ensuring that customers receive the best possible experience.','luxestay-hotel'); ?></p>
    </div>
    <div class="admin-right-box">
        <div class="admin_text-btn">
            <h4><?php esc_html_e('Buy Luxestay Hotel Premium Theme','luxestay-hotel'); ?></h4>
            <p><?php esc_html_e('Now the Premium Version is only at $39.99 with Lifetime Access!Grab the deal now!', 'luxestay-hotel'); ?></p>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_URL ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'luxestay-hotel' ); ?></a>
            </div>
        </div>
        <hr>
        <div class="admin_text-btn">
            <h4><?php esc_html_e('Premium Theme Demo','luxestay-hotel'); ?></h4>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_DEMO ); ?>" target="_blank"> <?php esc_html_e( 'Demo', 'luxestay-hotel' ); ?></a>
            </div>
        </div>
        <hr>
        <div class="admin_text-btn">
            <h4><?php esc_html_e('Need Support? / Contact Us','luxestay-hotel'); ?></h4>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Contact Us', 'luxestay-hotel' ); ?></a>
            </div>
        </div>
        <hr>
        <div class="admin_text-btn">
            <h4><?php esc_html_e('Documentation','luxestay-hotel'); ?></h4>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_PRO_DOCUMENTATION ); ?>" target="_blank"> <?php esc_html_e( 'Docs', 'luxestay-hotel' ); ?></a>
            </div>
        </div>
        <hr>
        <div class="admin_text-btn">
            <h4><?php esc_html_e('Free Theme','luxestay-hotel'); ?></h4>
            <div class="info-link">
                <a href="<?php echo esc_url( LUXESTAY_HOTEL_FREE_URL ); ?>" target="_blank"> <?php esc_html_e( 'Demo', 'luxestay-hotel' ); ?></a>
            </div>
        </div>

    </div>
</div>

<?php } ?>