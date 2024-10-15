<?php
/**
 * Home Section 1 Template
 *
 * @package Luxestay Hotel
 */

// All section-specific code goes here...


$section_one = get_theme_mod('luxestay_hotel_section_banner');
if ('Disable' == $section_one) {
    return;
}
?>

<section id="banner-section-first">
        <div class="main-banner-main">
            <?php if(get_theme_mod('luxestay_hotel_section_bannerimage_section')!=''){ ?>
                    <img src="<?php echo esc_url(get_theme_mod('luxestay_hotel_section_bannerimage_section')); ?>" alt="Image">
                <div class="text-box">
                    <h2><?php echo esc_html(get_theme_mod('luxestay_hotel_section_bannerimage_section_title')); ?></h2>
                    <p><?php echo esc_html(get_theme_mod('luxestay_hotel_section_bannerimage_section_text')); ?></p>


                    <?php if(get_theme_mod('luxestay_hotel_banner_btn_text')!=''){ ?>
                        <div class="theme-btn">
                          <a href="<?php echo esc_html(get_theme_mod('luxestay_hotel_banner_btn_text_url')); ?>"><?php echo esc_html(get_theme_mod('luxestay_hotel_banner_btn_text')); ?></a>
                        </div>
                  <?php } ?>
                </div>
            <?php } ?>
        </div>
</section>
