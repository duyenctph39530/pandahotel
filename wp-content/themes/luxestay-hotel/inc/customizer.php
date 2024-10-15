<?php
/**
 * Add custom settings and controls to the WordPress Customizer
 */


//---------------------Code to add the Upgrade to Pro button in the Customizer----------

function luxestay_hotel_customize_register_btn( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    get_template_part('inc/customizer-button/upsell-section');

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'luxestay_hotel_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'luxestay_hotel_customize_partial_blogdescription',
        ) );
    }

    $wp_customize->register_section_type( 'Luxestay_Hotel_Customize_Upsell_Section' );

    // Register section.
    $wp_customize->add_section(
        new Luxestay_Hotel_Customize_Upsell_Section(
            $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'Luxestay Hotel Pro', 'luxestay-hotel' ),
                'pro_text' => esc_html__( 'Upgrade To Pro', 'luxestay-hotel' ),
                'pro_url'  => 'https://cawpthemes.com/luxestay-hotel-premium-wordpress-theme/',
                'priority' => 1,
            )
        )
    );
}
add_action( 'customize_register', 'luxestay_hotel_customize_register_btn' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function luxestay_hotel_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function luxestay_hotel_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function luxestay_hotel_customize_preview_js() {
    wp_enqueue_script( 'luxestay-hotel-customizer', get_template_directory_uri() . '/inc/customizer-button/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'luxestay_hotel_customize_preview_js' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.0
 */
function luxestay_hotel_customizer_control_scripts() {

    wp_enqueue_style( 'luxestay-hotel-customize-controls', get_template_directory_uri() . '/inc/customizer-button/customize-controls.css', '', '1.0.0' );

    wp_enqueue_script( 'luxestay-hotel-customize-controls', get_template_directory_uri() . '/inc/customizer-button/customize-controls.js', array( 'customize-controls' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'luxestay_hotel_customizer_control_scripts', 0 );


//---------------------Code to add the Upgrade to Pro button in the Customizer End----------


//------------------Theme Information--------------------


function luxestay_hotel_customize_register( $wp_customize ) {


      // Add a custom setting for the Site Identity color
  $wp_customize->add_setting( 'luxestay_hotel_site_identity_color', array(
    'default' => '#b56953',
    'sanitize_callback' => 'sanitize_hex_color',
  ) );

  // Add a custom control for the primary color
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luxestay_hotel_site_identity_color', array(
    'label' => __( 'Site Identity Color', 'luxestay-hotel' ),
    'section' => 'title_tagline',
    'settings' => 'luxestay_hotel_site_identity_color',
  ) ) );


  // Add a custom setting for the Site Identity color
  $wp_customize->add_setting( 'luxestay_hotel_site_identity_tagline_color', array(
    'default' => '#000',
    'sanitize_callback' => 'sanitize_hex_color',
  ) );

  // Add a custom control for the primary color
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luxestay_hotel_site_identity_tagline_color', array(
    'label' => __( 'Tagline Color', 'luxestay-hotel' ),
    'section' => 'title_tagline',
    'settings' => 'luxestay_hotel_site_identity_tagline_color',
  ) ) );

//------------------Site Identity Ends---------------------

  
  // Add a custom setting for the primary color
  $wp_customize->add_setting( 'luxestay_hotel_primary_color', array(
    'default' => '#0073aa',
    'sanitize_callback' => 'sanitize_hex_color',
  ) );

  // Add a custom control for the primary color
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'luxestay_hotel_primary_color', array(
    'label' => __( 'Primary Color', 'luxestay-hotel' ),
    'section' => 'colors',
    'settings' => 'luxestay_hotel_primary_color',
  ) ) );

  //-----------------------------------Home Front Page-------------------------------

  $wp_customize->add_panel( 'luxestay_hotel_panel', array(
    'title'    => __( 'Front Page Settings', 'luxestay-hotel' ),
    'priority' => 100,
  ) );


  //-------------------------------------Banner Image Section--------------

      $wp_customize->add_section( 'luxestay_hotel_section_banner', array(
        'title'    => __( 'Home First Section', 'luxestay-hotel' ),
        'priority' => 8,
        'panel'    => 'luxestay_hotel_panel',
    ) );


  //-----------------Enable Option banner-------------

  $wp_customize->add_setting('luxestay_hotel_section_banner',array(
      'default' => 'Enable',
      'sanitize_callback' => 'luxestay_hotel_sanitize_choices'
  ));
  $wp_customize->add_control('luxestay_hotel_section_banner',array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'luxestay-hotel'),
        'section' => 'luxestay_hotel_section_banner',
        'choices' => array(
            'Enable' => __('Enable', 'luxestay-hotel'),
            'Disable' => __('Disable', 'luxestay-hotel')
  )));

  $wp_customize->add_setting('luxestay_hotel_section_bannerimage_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_section_bannerimage_section',array(
    'label' => __('Section Background Image','luxestay-hotel'),
    'description' => __('Dimention 1600 * 800','luxestay-hotel'),
    'section' => 'luxestay_hotel_section_banner',
    'settings' => 'luxestay_hotel_section_bannerimage_section'
  )));

    $wp_customize->add_setting('luxestay_hotel_section_bannerimage_section_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_section_bannerimage_section_title',array(
      'label' => __('Banner Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_section_banner',
      'setting' => 'luxestay_hotel_section_bannerimage_section_title',
      'type'    => 'text'
    )
  ); 

      $wp_customize->add_setting('luxestay_hotel_section_bannerimage_section_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_section_bannerimage_section_text',array(
      'label' => __('Banner Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_section_banner',
      'setting' => 'luxestay_hotel_section_bannerimage_section_text',
      'type'    => 'text'
    )
  );

    $wp_customize->add_setting('luxestay_hotel_banner_btn_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_banner_btn_text',array(
      'label' => __('Button Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_section_banner',
      'setting' => 'luxestay_hotel_banner_btn_text',
      'type'    => 'text'
    )
  );


    $wp_customize->add_setting('luxestay_hotel_banner_btn_text_url',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_banner_btn_text_url',array(
      'label' => __('Button URL','luxestay-hotel'),
      'section' => 'luxestay_hotel_section_banner',
      'setting' => 'luxestay_hotel_banner_btn_text_url',
      'type'    => 'text'
    )
  );


  //----------------------------------About Section----------------------------



    $wp_customize->add_section( 'luxestay_hotel_about', array(
        'title'    => __( 'About Section', 'luxestay-hotel' ),
        'priority' => 10,
        'panel'    => 'luxestay_hotel_panel',
    ) );

  //-----------------Enable Option Section about-------------

  $wp_customize->add_setting('luxestay_hotel_about_enable',array(
      'default' => 'Enable',
      'sanitize_callback' => 'luxestay_hotel_sanitize_choices'
  ));
  $wp_customize->add_control('luxestay_hotel_about_enable',array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'luxestay-hotel'),
        'section' => 'luxestay_hotel_about',
        'choices' => array(
            'Enable' => __('Enable', 'luxestay-hotel'),
            'Disable' => __('Disable', 'luxestay-hotel')
  )));

    //--------------About Title-----------------------

    $wp_customize->add_setting('luxestay_hotel_about_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_title',array(
      'label' => __('Section Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_title',
      'type'    => 'text'
    )
  ); 


  //-----------------------------About Image-----------

  $wp_customize->add_setting('luxestay_hotel_aboutimage1_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_aboutimage1_section',array(
    'label' => __('About Side Image','luxestay-hotel'),
    'description' => __('Dimention 500 * 750','luxestay-hotel'),
    'section' => 'luxestay_hotel_about',
    'settings' => 'luxestay_hotel_aboutimage1_section'
  )));


    $wp_customize->add_setting('luxestay_hotel_about_name',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_name',array(
      'label' => __('Main Heading','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_name',
      'type'    => 'text'
    )
  );


    $wp_customize->add_setting('luxestay_hotel_about_title_second',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_title_second',array(
      'label' => __('Paragraph 1','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_title_second',
      'type'    => 'textarea'
    )
  );


    $wp_customize->add_setting('luxestay_hotel_about_para',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_para',array(
      'label' => __('Paragraph 2','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_para',
      'type'    => 'textarea'
    )
  );

    $wp_customize->add_setting('luxestay_hotel_about_btn_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_btn_text',array(
      'label' => __('Button Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_btn_text',
      'type'    => 'text'
    )
  );


    $wp_customize->add_setting('luxestay_hotel_about_btn_text_url',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_about_btn_text_url',array(
      'label' => __('Button URL','luxestay-hotel'),
      'section' => 'luxestay_hotel_about',
      'setting' => 'luxestay_hotel_about_btn_text_url',
      'type'    => 'text'
    )
  );

  //------------Features---------------------

  $wp_customize->add_section( 'luxestay_hotel_features_amenities', array(
        'title'    => __( 'Features/Amenities', 'luxestay-hotel' ),
        'priority' => 10,
        'panel'    => 'luxestay_hotel_panel',
    ) );


  //-----------------Enable Option Section One-------------

  $wp_customize->add_setting('luxestay_hotel_features_enable',array(
      'default' => 'Enable',
      'sanitize_callback' => 'luxestay_hotel_sanitize_choices'
  ));
  $wp_customize->add_control('luxestay_hotel_features_enable',array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'luxestay-hotel'),
        'section' => 'luxestay_hotel_features_amenities',
        'choices' => array(
            'Enable' => __('Enable', 'luxestay-hotel'),
            'Disable' => __('Disable', 'luxestay-hotel')
  )));

    //--------------Section One Title-----------------------

    $wp_customize->add_setting('luxestay_hotel_features_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_features_title',array(
      'label' => __('Section Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_features_title',
      'type'    => 'text'
    )
  ); 

  //-----------------------------Feature Image 1-----------

  $wp_customize->add_setting('luxestay_hotel_featureimage1_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_featureimage1_section',array(
    'label' => __('Feature 1 Image','luxestay-hotel'),
    'description' => __('Dimention 100 * 100','luxestay-hotel'),
    'section' => 'luxestay_hotel_features_amenities',
    'settings' => 'luxestay_hotel_featureimage1_section'
  )));


    $wp_customize->add_setting('luxestay_hotel_feature1_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature1_title',array(
      'label' => __('Feature 1 Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature1_title',
      'type'    => 'text'
    )
  ); 


    $wp_customize->add_setting('luxestay_hotel_feature1_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature1_text',array(
      'label' => __('Feature 1 Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature1_text',
      'type'    => 'textarea'
    )
  ); 



  //-----------------------------Feature Image 2-----------

  $wp_customize->add_setting('luxestay_hotel_featureimage2_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_featureimage2_section',array(
    'label' => __('Feature 2 Image','luxestay-hotel'),
    'description' => __('Dimention 100 * 100','luxestay-hotel'),
    'section' => 'luxestay_hotel_features_amenities',
    'settings' => 'luxestay_hotel_featureimage2_section'
  )));


    $wp_customize->add_setting('luxestay_hotel_feature2_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature2_title',array(
      'label' => __('Feature 2 Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature2_title',
      'type'    => 'text'
    )
  ); 


    $wp_customize->add_setting('luxestay_hotel_feature2_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature2_text',array(
      'label' => __('Feature 2 Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature2_text',
      'type'    => 'textarea'
    )
  ); 


  //-----------------------------Feature Image 3-----------

  $wp_customize->add_setting('luxestay_hotel_featureimage3_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_featureimage3_section',array(
    'label' => __('Feature 3 Image','luxestay-hotel'),
    'description' => __('Dimention 100 * 100','luxestay-hotel'),
    'section' => 'luxestay_hotel_features_amenities',
    'settings' => 'luxestay_hotel_featureimage3_section'
  )));


    $wp_customize->add_setting('luxestay_hotel_feature3_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature3_title',array(
      'label' => __('Feature 3 Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature3_title',
      'type'    => 'text'
    )
  ); 


    $wp_customize->add_setting('luxestay_hotel_feature3_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature3_text',array(
      'label' => __('Feature 3 Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature3_text',
      'type'    => 'textarea'
    )
  ); 



  //-----------------------------Feature Image 4-----------

  $wp_customize->add_setting('luxestay_hotel_featureimage4_section',array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
  ));
  $wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'luxestay_hotel_featureimage4_section',array(
    'label' => __('Feature 4 Image','luxestay-hotel'),
    'description' => __('Dimention 100 * 100','luxestay-hotel'),
    'section' => 'luxestay_hotel_features_amenities',
    'settings' => 'luxestay_hotel_featureimage4_section'
  )));


    $wp_customize->add_setting('luxestay_hotel_feature4_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature4_title',array(
      'label' => __('Feature 4 Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature4_title',
      'type'    => 'text'
    )
  ); 


    $wp_customize->add_setting('luxestay_hotel_feature4_text',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_feature4_text',array(
      'label' => __('Feature 4 Text','luxestay-hotel'),
      'section' => 'luxestay_hotel_features_amenities',
      'setting' => 'luxestay_hotel_feature3_text',
      'type'    => 'textarea'
    )
  );






  //------------Section One (Featured Post)---------------------

  $wp_customize->add_section( 'luxestay_hotel_section1', array(
        'title'    => __( 'Latest Post', 'luxestay-hotel' ),
        'priority' => 10,
        'panel'    => 'luxestay_hotel_panel',
    ) );


  //-----------------Enable Option Section One-------------

  $wp_customize->add_setting('luxestay_hotel_section1_enable',array(
      'default' => 'Enable',
      'sanitize_callback' => 'luxestay_hotel_sanitize_choices'
  ));
  $wp_customize->add_control('luxestay_hotel_section1_enable',array(
        'type' => 'radio',
        'label' => __('Do you want this section', 'luxestay-hotel'),
        'section' => 'luxestay_hotel_section1',
        'choices' => array(
            'Enable' => __('Enable', 'luxestay-hotel'),
            'Disable' => __('Disable', 'luxestay-hotel')
  )));

    //--------------Section One Title-----------------------

    $wp_customize->add_setting('luxestay_hotel_section1_title',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control('luxestay_hotel_section1_title',array(
      'label' => __('Section Title','luxestay-hotel'),
      'section' => 'luxestay_hotel_section1',
      'setting' => 'luxestay_hotel_section1_title',
      'type'    => 'text'
    )
  ); 

  //-----------Category------------

  $categories = get_categories();
  $cats = array();
  $i = 0;
  foreach($categories as $category){
    if($i==0){
      $default = $category->name;
      $i++;
    }
    $cats[$category->name] = $category->name;
  }

  $wp_customize->add_setting('luxestay_hotel_section1_category',array(
  'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('luxestay_hotel_section1_category',array(
    'type'    => 'select',
    'choices' => $cats,
    'label' => __('Select Category to Display Post','luxestay-hotel'),
    'section' => 'luxestay_hotel_section1',
    'sanitize_callback' => 'sanitize_text_field',
  ));



    $wp_customize->add_setting('luxestay_hotel_section1_category_number_of_posts_setting',array(
    'default' => '8',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('luxestay_hotel_section1_category_number_of_posts_setting',array(
    'label' => __('Number of Posts','luxestay-hotel'),
    'section' => 'luxestay_hotel_section1',
    'setting' => 'luxestay_hotel_section1_category_number_of_posts_setting',
    'type'    => 'number'
  )); 



  //-------------------------Footer Settings------------------------------


    $wp_customize->add_section( 'luxestay_hotel_footer', array(
        'title'    => __( 'Footer Settings', 'luxestay-hotel' ),
        'priority' => 10,
        'panel'    => 'luxestay_hotel_panel',
    ) );


  // Add a custom setting for the footer text
  $wp_customize->add_setting( 'luxestay_hotel_footer_text', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ) );

  // Add a custom control for the footer text
  $wp_customize->add_control( 'luxestay_hotel_footer_text', array(
    'label' => __( 'Footer Text', 'luxestay-hotel' ),
    'section' => 'luxestay_hotel_footer',
    'type' => 'text',
  ) );


//--------------------------------------General Settings------------------------------------------

  $wp_customize->add_section( 'luxestay_hotel_general', array(
        'title'    => __( 'General Settings', 'luxestay-hotel' ),
        'panel'    => 'luxestay_hotel_panel',
    ) );

    $wp_customize->add_setting( 'luxestay_hotel_post_meta_toggle_switch_control', array(
        'default'   => true,
        'sanitize_callback' => 'sanitize_text_field', // Use a suitable sanitization function based on your needs
        'transport' => 'refresh', // or 'postMessage' for instant preview without page refresh
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxestay_hotel_post_meta_toggle_switch_control', array(
        'label'    => __( 'Display Time/Author', 'luxestay-hotel' ),
        'section'  => 'luxestay_hotel_general',
        'settings' => 'luxestay_hotel_post_meta_toggle_switch_control',
        'type'     => 'checkbox',
    ) ) );

    $wp_customize->add_setting( 'luxestay_hotel_post_readdmore_toggle_switch_control', array(
        'default'   => true,
        'sanitize_callback' => 'sanitize_text_field', // Use a suitable sanitization function based on your needs
        'transport' => 'refresh', // or 'postMessage' for instant preview without page refresh
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'luxestay_hotel_post_readdmore_toggle_switch_control', array(
        'label'    => __( 'Display Read More Link', 'luxestay-hotel' ),
        'section'  => 'luxestay_hotel_general',
        'settings' => 'luxestay_hotel_post_readdmore_toggle_switch_control',
        'type'     => 'checkbox',
    ) ) );


}
add_action( 'customize_register', 'luxestay_hotel_customize_register' );



