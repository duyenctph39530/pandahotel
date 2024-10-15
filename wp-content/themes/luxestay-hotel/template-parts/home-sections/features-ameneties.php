<?php
/**
 * Home Section features Template
 *
 * @package Luxestay Hotel
 */

// All section-specific code goes here...


$section_one = get_theme_mod( 'luxestay_hotel_features_enable' );
if ( 'Disable' == $section_one ) {
  return;
} ?>

<section id="amenites" class="amenities-posts">
  <div class="container">
    <div class="section-heading-main">
      <?php if(get_theme_mod('luxestay_hotel_features_title',true) != ''){?>
    <h3><?php echo esc_html(get_theme_mod('luxestay_hotel_features_title')); ?></h3>
    <?php }?>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="feature-box">
            <?php if(get_theme_mod('luxestay_hotel_featureimage1_section')!=''){ ?>
              <img src="<?php echo esc_url(get_theme_mod('luxestay_hotel_featureimage1_section')); ?>">
            <?php } ?>
            <div class="feature-content-box">
              <h3><?php echo esc_html(get_theme_mod('luxestay_hotel_feature1_title')); ?></h3>
              <p><?php echo esc_html(get_theme_mod('luxestay_hotel_feature1_text')); ?></p>
            </div>
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="feature-box">
            <?php if(get_theme_mod('luxestay_hotel_featureimage2_section')!=''){ ?>
              <img src="<?php echo esc_url(get_theme_mod('luxestay_hotel_featureimage2_section')); ?>">
            <?php } ?>
            <div class="feature-content-box">
              <h3><?php echo esc_html(get_theme_mod('luxestay_hotel_feature2_title')); ?></h3>
              <p><?php echo esc_html(get_theme_mod('luxestay_hotel_feature2_text')); ?></p>
            </div>
            
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="feature-box">
            <?php if(get_theme_mod('luxestay_hotel_featureimage3_section')!=''){ ?>
              <img src="<?php echo esc_url(get_theme_mod('luxestay_hotel_featureimage3_section')); ?>">
            <?php } ?>
            <div class="feature-content-box">
              <h3><?php echo esc_html(get_theme_mod('luxestay_hotel_feature3_title')); ?></h3>
              <p><?php echo esc_html(get_theme_mod('luxestay_hotel_feature3_text')); ?></p>
            </div>
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="feature-box">
            <?php if(get_theme_mod('luxestay_hotel_featureimage3_section')!=''){ ?>
              <img src="<?php echo esc_url(get_theme_mod('luxestay_hotel_featureimage4_section')); ?>">
            <?php } ?>
            <div class="feature-content-box">
              <h3><?php echo esc_html(get_theme_mod('luxestay_hotel_feature4_title')); ?></h3>
              <p><?php echo esc_html(get_theme_mod('luxestay_hotel_feature4_text')); ?></p>
            </div>
        </div>
      </div>
       
      </div>
    </div>
</div>
</section>






