<?php
/**
 * Bosa Hotel Theme Customizer
 *
 * @package Bosa Hotel
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bosa_hotel_customize_register( $wp_customize ) {

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	// Register custom section types.
	$wp_customize->register_section_type( 'Bosa_Hotel_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Bosa_Hotel_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Bosa Pro', 'bosa-hotel' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'bosa-hotel' ),
				'pro_url'  => 'https://bosathemes.com/bosa-pro',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'bosa_hotel_customize_register' );

/**
 * Restructures WooCommerce product catalog customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bosa_hotel_woocommerce_customizer_structure( $wp_customize ) {

	if ( class_exists( 'WooCommerce') ) {
		$wp_customize->get_control( 'woocommerce_shop_page_display' )->priority  = '600';
		$wp_customize->get_control( 'woocommerce_category_archive_display' )->priority  = '610';
		$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->priority  = '620';
	}
}
add_action( 'customize_register', 'bosa_hotel_woocommerce_customizer_structure', 15 );

/**
 * Enqueue style for custom customize control.
 */
add_action( 'customize_controls_enqueue_scripts', 'bosa_hotel_custom_customize_enqueue' );
function bosa_hotel_custom_customize_enqueue() {
	wp_enqueue_style( 'bosa-hotel-customize-controls', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bosa_hotel_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bosa_hotel_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bosa_hotel_customize_preview_js() {
	wp_enqueue_script( 'bosa-hotel-customizer', get_template_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bosa_hotel_customize_preview_js' );

function bosa_hotel_customize_getting_js() {
	wp_enqueue_script( 'bosa-hotel-customizer-getting-started', get_template_directory_uri() . '/inc/getting-started/getting-started.js', array( 'customize-controls', 'jquery' ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'bosa_hotel_customize_getting_js' );


/**
 * Sanitize checkboxes
 */

function bosa_hotel_sanitize_checkbox( $input ){
	if ( $input === true ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Sanitize Selects
 */
function bosa_hotel_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/**
 * Promotion section callback
 */
function bosa_hotel_is_enable_promotions_section() {
	$value = get_theme_mod( 'disable_promotions_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	}  
}

/**
 * Occasions section callback
 */
function bosa_hotel_is_enable_occasions_section() {
	$value = get_theme_mod( 'disable_occasion_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	}  
}

/**
 * Facts section callback
 */
function bosa_hotel_is_enable_facts_section() {
	$value = get_theme_mod( 'disable_facts_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

/**
 * Followers section callback
 */
function bosa_hotel_is_enable_followers_section() {
	$value = get_theme_mod( 'disable_followers_section', true );

	if ( $value ) {
		return false;
	} else {
		return true;
	} 
}

function bosa_hotel_customizer_structure( $wp_customize ) {

	// Blog Homepage Options
	$wp_customize->add_panel( 'blog_homepage_options', array(
	    'title' 	 => __( 'Blog Homepage', 'bosa-hotel' ),
	    'priority'	 => 120,
	    'capability' => 'edit_theme_options',
	) );

	// Responsive
	$wp_customize->add_section( 'blog_page_responsive', array(
	    'title'		 => __( 'Responsive', 'bosa-hotel' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-hotel' ),
	    'panel' 	 => 'blog_homepage_options',
	    'priority'	 => 50,
	    'capability' => 'edit_theme_options',
	) );

	// Blog Promotion
	$wp_customize->add_section( 'blog_promotions', array(
	    'title'          => esc_html__( 'Promotions', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 26,	
	) );

	$wp_customize->add_setting( 'disable_promotions_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_promotions_section', array(
	    'label' 	=> __( 'Disable Promotions Section', 'bosa-hotel' ),
	    'type' 		=> 'checkbox',
	    'priority'	=> 10,
	    'section' 	=> 'blog_promotions', 
	) );

	$wp_customize->add_setting( 'blog_promotions_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_promotions_one',
			array(
				'label'        => esc_html__( 'Promotions 1', 'bosa-hotel' ),
				'section'         => 'blog_promotions',
				'mime_type'       => 'image',
				'priority'	      => 20,
			)
		)
	);

	$wp_customize->add_setting('blog_advert_one_label', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('blog_advert_one_label', array(
		'label'     => esc_html__( 'Discount 1 Label', 'bosa-hotel' ),
		'section'	=> 'blog_promotions',
		'type'		=> 'text',
		'priority'	=> 30,
	));

	$wp_customize->add_setting( 'blog_promotions_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_promotions_two',
			array(
				'label'        => esc_html__( 'Promotions 2', 'bosa-hotel' ),
				'section'         => 'blog_promotions',
				'mime_type'       => 'image',
				'priority'	      => 40,
			)
		)
	);

	$wp_customize->add_setting('blog_advert_two_label', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));
	
	$wp_customize->add_control('blog_advert_two_label', array(
		'label'     => esc_html__( 'Discount 2 Label', 'bosa-hotel' ),
		'section'	=> 'blog_promotions',
		'type'		=> 'text',
		'priority'	=> 50,
	));

	$wp_customize->add_setting( 'blog_promotions_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_promotions_three',
			array(
				'label'        => esc_html__( 'Promotions 3', 'bosa-hotel' ),
				'section'         => 'blog_promotions',
				'mime_type'       => 'image',
				'priority'	      => 60,
			)
		)
	);

	$wp_customize->add_setting('blog_advert_three_label', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));
	
	$wp_customize->add_control('blog_advert_three_label', array(
		'label'     => esc_html__( 'Discount 3 Label', 'bosa-hotel' ),
		'section'	=> 'blog_promotions',
		'type'		=> 'text',
		'priority'	=> 70,
	));

	$wp_customize->add_setting( 'disable_mobile_promotions', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_promotions', array(
	    'label'        => esc_html__( 'Disable Promotions', 'bosa-hotel' ),
	    'type' => 'checkbox',
	    'priority' => 26,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_hotel_is_enable_promotions_section',
	) );

	//Blog Occasion
	$wp_customize->add_section( 'blog_occasion', array(
	    'title'          => esc_html__( 'Occasion', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 27,
	) );

	$wp_customize->add_setting( 'disable_occasion_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_occasion_section', array(
	    'label'        => esc_html__( 'Disable Occasion Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'section'      => 'blog_occasion',
		'priority'	   => 10, 
	) );

	$wp_customize->add_setting( 'blog_occasion_page_one', array(
		'sanitize_callback' => 'bosa_hotel_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_occasion_page_one', array(
		'label'       => esc_html__( 'Page 1', 'bosa-hotel' ),
		'type'        => 'select',
		'section'     => 'blog_occasion',
		'placeholder' => esc_html__( 'Select Page 1', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_pages(),
		'priority'	  => 20,
	) );


	$wp_customize->add_setting( 'blog_occasion_page_two', array(
		'sanitize_callback' => 'bosa_hotel_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_occasion_page_two', array(
		'label'       => esc_html__( 'Page 2', 'bosa-hotel' ),
		'type'        => 'select',
		'section'     => 'blog_occasion',
		'placeholder' => esc_html__( 'Select Page 2', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_pages(),
		'priority'	  => 30,
	) );

	$wp_customize->add_setting( 'blog_occasion_page_three', array(
		'sanitize_callback' => 'bosa_hotel_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_occasion_page_three', array(
		'label'       => esc_html__( 'Page 3', 'bosa-hotel' ),
		'type'        => 'select',
		'section'     => 'blog_occasion',
		'placeholder' => esc_html__( 'Select Page 3', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_pages(),
		'priority'	  => 40,
	) );

	$wp_customize->add_setting( 'blog_occasion_page_four', array(
		'sanitize_callback' => 'bosa_hotel_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_occasion_page_four', array(
		'label'       => esc_html__( 'Page 4', 'bosa-hotel' ),
		'type'        => 'select',
		'section'     => 'blog_occasion',
		'placeholder' => esc_html__( 'Select Page 4', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_pages(),
		'priority'	  => 50,
	) );

	$wp_customize->add_setting( 'blog_occasion_page_five', array(
		'sanitize_callback' => 'bosa_hotel_sanitize_select',
		'default' 			=> '',
	) );

	$wp_customize->add_control( 'blog_occasion_page_five', array(
		'label'       => esc_html__( 'Page 5', 'bosa-hotel' ),
		'type'        => 'select',
		'section'     => 'blog_occasion',
		'placeholder' => esc_html__( 'Select Page 5', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_pages(),
		'priority'	  => 60,
	) );

	$wp_customize->add_setting( 'disable_mobile_occasion', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_occasion', array(
	    'label'        => esc_html__( 'Disable Occasion', 'bosa-hotel' ),
	    'type' => 'checkbox',
	    'priority' => 27,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_hotel_is_enable_occasions_section',
	) );

	// Blog Facts
	$wp_customize->add_section( 'blog_facts', array(
	    'title'          => esc_html__( 'Facts', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 28,
	) );

	$wp_customize->add_setting( 'disable_facts_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_facts_section', array(
	    'label'        => esc_html__( 'Disable Facts Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'section'      => 'blog_facts',
		'priority'	   => 10, 
	) );

	$wp_customize->add_setting('fact_one_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_one_title', array(
		'label'       => esc_html__( 'Fact one', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 20,
	));

	$wp_customize->add_setting('fact_one_content', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_one_content', array(
		'label'       => esc_html__( 'Fact One Content', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 30,
	));

	$wp_customize->add_setting('fact_two_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_two_title', array(
		'label'       => esc_html__( 'Fact two', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 40,
	));

	$wp_customize->add_setting('fact_two_content', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_two_content', array(
		'label'       => esc_html__( 'Fact two Content', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 50,
	));

	$wp_customize->add_setting('fact_three_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_three_title', array(
		'label'       => esc_html__( 'Fact three', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 60,
	));

	$wp_customize->add_setting('fact_three_content', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_three_content', array(
		'label'       => esc_html__( 'Fact three Content', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 70,
	));

	$wp_customize->add_setting('fact_four_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_four_title', array(
		'label'       => esc_html__( 'Fact four', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 80,
	));

	$wp_customize->add_setting('fact_four_content', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('fact_four_content', array(
		'label'       => esc_html__( 'Fact four Content', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_facts',
		'priority'	   => 90,
	));

	$wp_customize->add_setting( 'disable_mobile_facts', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_facts', array(
	    'label'        => esc_html__( 'Disable facts', 'bosa-hotel' ),
	    'type' => 'checkbox',
	    'priority' => 28,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_hotel_is_enable_facts_section',
	) );

	// Blog Followers
	$wp_customize->add_section( 'blog_followers', array(
	    'title'          => esc_html__( 'Followers', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 29,
	) );

	$wp_customize->add_setting( 'disable_followers_section', array(
	    'default' 			=> true,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_followers_section', array(
	    'label'        => esc_html__( 'Disable Followers Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'section'      => 'blog_followers',
		'priority'	   => 10, 
	) );

	$wp_customize->add_setting('followers_tagline_title', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('followers_tagline_title', array(
		'label'       => esc_html__( 'Tagline', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_followers',
		'priority'	   => 20,
	));

	$wp_customize->add_setting('followers_info_one', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('followers_info_one', array(
		'label'       => esc_html__( 'Info One', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_followers',
		'priority'	   => 30,
	));

	$wp_customize->add_setting('followers_info_two', array(
		'default'=>'',
		'sanitize_callback'=>'sanitize_text_field',
	));

	$wp_customize->add_control('followers_info_two', array(
		'label'       => esc_html__( 'Info Two', 'bosa-hotel' ),
		'type'        => 'text',
		'section'     => 'blog_followers',
		'priority'	   => 40,
	));

	$wp_customize->add_setting( 'blog_follower_one', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_one',
			array(
				'label'        => esc_html__( 'Follower One', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 50,
			)
		)
	);

	$wp_customize->add_setting( 'blog_follower_two', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_two',
			array(
				'label'        => esc_html__( 'Follower two', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 60,
			)
		)
	);

	$wp_customize->add_setting( 'blog_follower_three', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_three',
			array(
				'label'        => esc_html__( 'Follower three', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 70,
			)
		)
	);

	$wp_customize->add_setting( 'blog_follower_four', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_four',
			array(
				'label'        => esc_html__( 'Follower four', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 80,
			)
		)
	);

	$wp_customize->add_setting( 'blog_follower_five', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_five',
			array(
				'label'        => esc_html__( 'Follower five', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 90,
			)
		)
	);

	$wp_customize->add_setting( 'blog_follower_six', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Media_Control( 
			$wp_customize, 
			'blog_follower_six',
			array(
				'label'        => esc_html__( 'Follower six', 'bosa-hotel' ),
				'section'         => 'blog_followers',
				'mime_type'       => 'image',
				'priority'	      => 100,
			)
		)
	);

	$wp_customize->add_setting( 'disable_mobile_followers', array(
	    'default' => false,
	    'sanitize_callback' => 'bosa_hotel_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_mobile_followers', array(
	    'label'        => esc_html__( 'Disable Follower', 'bosa-hotel' ),
	    'type' => 'checkbox',
	    'priority' => 29,
	    'section' => 'blog_page_responsive',
	    'active_callback' => 'bosa_hotel_is_enable_followers_section',
	) );
}
add_action( 'customize_register', 'bosa_hotel_customizer_structure', 15 );


/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'bosa_hotel_kirki_fields', 999, 1 );

function bosa_hotel_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'bosa-hotel', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	) );

	// Site Identity - Title & Tagline
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Logo Image Width', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'logo_width',
		'section'      => 'title_tagline',
		'transport'    => 'postMessage',
		'priority'     => '8',
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Site Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_title',
		'section'      => 'title_tagline',
		'priority'     => '10',
		'default'      => false,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Site Tagline', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_tagline',
		'section'      => 'title_tagline',
		'priority'     => '20',
		'default'      => false,
	) );

	// Colors Options
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Body Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_body_text_color',
		'section'      => 'colors',
		'default'      => '#333333',
		'priority'     => '20',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'General Heading Text Color (H1 - H6)', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_heading_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => '30',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'General Link Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_general_link_color',
		'section'      => 'colors',
		'default'      => '#a6a6a6',
		'priority'     => '35',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Page and Single Post Title', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'header_textcolor',
		'section'      => 'colors',
		'default'      => '#101010',
		'priority'     => '40',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Primary Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_primary_color',
		'section'      => 'colors',
		'default'      => '#C9A76E',
		'priority'     => '50',
	) );
	
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_hover_color',
		'section'      => 'colors',
		'default'     => '#E4A853',
		'priority'    => '60',
	) );

	// Header Options
	Kirki::add_panel( 'header_options', array(
	    'title' => esc_html__( 'Header', 'bosa-hotel' ),
	    'priority' => '10',
	) );

	// Header Style Options
	Kirki::add_section( 'header_style_options', array(
	    'title'      => esc_html__( 'Style', 'bosa-hotel' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Header Layouts', 'bosa-hotel' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'header_layout',
		'section'     => 'header_style_options',
		'default'     => 'header_fourteen',
		'priority'	  => '40',
		'choices'     => apply_filters( 'bosa_hotel_header_layout_filter', array(
			'header_one'    => get_template_directory_uri() . '/assets/images/header-layout-1.png',
			'header_two'    => get_template_directory_uri() . '/assets/images/header-layout-2.png',
			'header_three'  => get_template_directory_uri() . '/assets/images/header-layout-3.png',
			'header_fourteen'   => get_stylesheet_directory_uri() . '/assets/images/header-layout-14.png'
		) ),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Top Header Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_top_header_section',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '50',
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'header_two_home_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Transparent Header Options', 'bosa-hotel' ),
	    'priority'	  => '60',
	    'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	// Header two 
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Site Logo', 'bosa-hotel' ),
		'description'  => esc_html__( 'Fully white or light color with image dimensions 320 by 120 pixels is recommended.', 'bosa-hotel' ),
		'type'         => 'image',
		'settings'     => 'header_separate_logo',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	  =>  '70',
		'choices'     => array(
			'save_as' => 'id',
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Site Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_title_color_transparent_header',
		'section'      => 'header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '80',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Site Tagline Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_tagline_color_transparent_header',
		'section'      => 'header_style_options',
		'default'      => '#e6e6e6',
		'priority'	   => '90',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Top Header Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'transparent_header_top_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '100',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Top Header Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'transparent_header_top_header_color',
		'section'      => 'header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '110',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Top Header Text Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_hover_color_transparent_header',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	   => '120',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Bottom Header Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'transparent_header_bottom_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '130',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Menu Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'content_color_transparent_header',
		'section'      => 'header_style_options',
		'default'      => '#ffffff',
		'priority'	   => '140',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Bottom Header Text Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'content_hover_color_transparent_header',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	   => '150',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'header_two_general_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Non Transparent Header Options', 'bosa-hotel' ),
	    'priority'	  => '160',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Header Site Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_title_color',
		'section'      => 'header_style_options',
		'default'      => '#030303',
		'priority'	   => '170',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Header Site Tagline Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_tagline_color',
		'section'      => 'header_style_options',
		'default'      => '#767676',
		'priority'	   => '180',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Top Header Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_header_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '190',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Top Header Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_header_text_color',
		'section'      => 'header_style_options',
		'default'      => '#333333',
		'priority'	   => '200',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Top Header Text Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_header_text_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	  =>  '210',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Top Header Section Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_top_header_border',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '220',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Mid Header Background Color', 'bosa-hotel' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'mid_header_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '230',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Mid Header Text Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'mid_header_text_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	   => '240',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Mid Header Section Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mid_header_border',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '250',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	  =>  '260',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_text_color',
		'section'      => 'header_style_options',
		'default'      => '#333333',
		'priority'	   => '270',
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Non Transparent Bottom Header Text Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_text_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	   =>  '280',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Sub Menu Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'sub_menu_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#E4A853',
		'priority'	   =>  '290',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Header Height (in px)', 'bosa-hotel' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'header_image_height',
		'section'     => 'header_style_options',
		'transport'   => 'postMessage',
		'default'     => 80,
		'priority'	  => '300',
		'choices'     => array(
			'min'  => 50,
			'max'  => 1200,
			'step' => 10,
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'contact_details_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Contact Details Options', 'bosa-hotel' ),
	    'priority'	  => '310',
	    'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

    // Contact Detail Options
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Contact Details', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_contact_detail',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '320',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header contact labels for header 14
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Contact Detail Icon color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'header_icon_color',
		'section'      => 'header_style_options',
		'default'      => '#B7B7B7',
		'priority'	   => '330',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Phone Number Label', 'bosa-hotel' ),
		'type'         => 'text',
		'settings'     => 'header_phone_label',
		'section'      => 'header_style_options',
		'default'      => "",
		'priority'	   => '340',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Phone Number', 'bosa-hotel' ),
		'type'         => 'text',
		'settings'     => 'contact_phone',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '350',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Email', 'bosa-hotel' ),
		'type'         => 'text',
		'settings'     => 'contact_email',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '360',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Address', 'bosa-hotel' ),
		'type'         => 'text',
		'settings'     => 'contact_address',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => '370',
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Header Button Options', 'bosa-hotel' ),
	    'priority'	  => '380',
	    'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header button
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Header Buttons', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_button',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => '390',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Header Buttons', 'bosa-hotel' ),
		'type'         => 'repeater',
		'settings'     => 'header_button_repeater',
		'section'      => 'header_style_options',
		'priority'	   => '400',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-hotel' ),
		),
		'default' => array(
			array(
				'header_btn_type' 			=> 'button-outline',
				'header_btn_bg_color'		=> '#C9A76E',
				'header_btn_border_color'	=> '#1a1a1a',
				'header_btn_text_color'		=> '#1a1a1a',
				'header_btn_hover_color'	=> '#E4A853',
				'header_btn_text' 			=> '',
				'header_btn_link' 			=> '',
				'header_btn_target'			=> true,
				'header_btn_radius'			=> 0,
			),		
		),
		'fields' => array(
			'header_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-hotel' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  	  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-hotel' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-hotel' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-hotel' ),
				),
			),
			'header_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Background Color', 'bosa-hotel' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#C9A76E',
			),
			'header_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Non Transparent Header Button Border Color', 'bosa-hotel' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'       		 	=> 'color',
				'default'     			=> '#1a1a1a',
			),
			'header_btn_text_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Text Color', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#1a1a1a',
			),
			'header_btn_hover_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Hover Color', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#E4A853',
			),
			'header_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-hotel' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'header_btn_link' => array(
				'label'       => esc_html__( 'Button Link', 'bosa-hotel' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'header_btn_target' => array(
				'label'       	=> esc_html__( 'Open Link in New Window', 'bosa-hotel' ),	
				'type'        	=> 'checkbox',
				'default'	  	=> true,
			),
			'header_btn_radius' => array(
				'label'       	=> esc_html__( 'Button Radius (px)', 'bosa-hotel' ),
				'type'        	=> 'number',
				'default'	  	=> 0,
				'choices'     	=> array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 2,
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Buttons', 'bosa-hotel' ),
		'type'         => 'repeater',
		'settings'     => 'transparent_header_button_repeater',
		'section'      => 'header_style_options',
		'priority'	   => '410',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-hotel' ),
		),
		'default' => array(
			array(
				'transparent_header_btn_type' 				=> 'button-outline',
				'transparent_header_home_btn_bg_color'		=> '#C9A76E',
				'transparent_header_home_btn_border_color'	=> '#ffffff',
				'transparent_header_home_btn_text_color'	=> '#ffffff',
				'transparent_header_btn_bg_color'			=> '#C9A76E',
				'transparent_header_btn_border_color'		=> '#1a1a1a',
				'transparent_header_btn_text_color'			=> '#1a1a1a',
				'transparent_header_btn_hover_color'		=> '#E4A853',
				'transparent_header_btn_text' 				=> '',
				'transparent_header_btn_link' 				=> '',
				'transparent_header_btn_target'				=> true,
				'transparent_header_btn_radius'				=> 0,
			),		
		),
		'fields' => array(
			'transparent_header_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-hotel' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  	  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-hotel' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-hotel' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-hotel' ),
				),
			),
			'transparent_header_home_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Transparent Header Button Background Color', 'bosa-hotel' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#C9A76E',
			),
			'transparent_header_home_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Transparent Header Button Border Color', 'bosa-hotel' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'       		 	=> 'color',
				'default'     			=> '#ffffff',
			),
			'transparent_header_home_btn_text_color' => array(
				'label'       		=> esc_html__( 'Transparent Header Button Text Color', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#ffffff',
			),
			'transparent_header_btn_bg_color' 	=> array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Background Color', 'bosa-hotel' ),
				'description' 		=> esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#C9A76E',
			),
			'transparent_header_btn_border_color' 	=> array(
				'label'      	 		=> esc_html__( 'Non Transparent Header Button Border Color', 'bosa-hotel' ),
				'description' 			=> esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'       		 	=> 'color',
				'default'     			=> '#1a1a1a',
			),
			'transparent_header_btn_text_color' => array(
				'label'       		=> esc_html__( 'Non Transparent Header Button Text Color', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#1a1a1a',
			),
			'transparent_header_btn_hover_color' => array(
				'label'       		=> esc_html__( 'Button Hover Color', 'bosa-hotel' ),
				'type'        		=> 'color',
				'default'     		=> '#E4A853',
			),
			'transparent_header_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-hotel' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'transparent_header_btn_link' => array(
				'label'       => esc_html__( 'Button Link', 'bosa-hotel' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'transparent_header_btn_target' => array(
				'label'       	=> esc_html__( 'Open Link in New Window', 'bosa-hotel' ),	
				'type'        	=> 'checkbox',
				'default'	  	=> true,
			),
			'transparent_header_btn_radius' => array(
				'label'       	=> esc_html__( 'Button Radius (px)', 'bosa-hotel' ),
				'type'        	=> 'number',
				'default'	  	=> 0,
				'choices'     	=> array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Search', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_search_icon',
		'section'     => 'header_style_options',
		'default'     => false,
		'priority'	  => '420',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Hamburger Widget Menu Icon', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_hamburger_menu_icon',
		'section'     => 'header_style_options',
		'default'     => false,
		'priority'	  =>  '430',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Header Buttons Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'header_buttons_font_control',
		'section'      => 'header_style_options',
		'priority'	   => '440',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '600',
			'font-size'      => '14px',
			'text-transform' => 'none',
			'line-height'    => '1',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .header-btn a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
		),
	) );

	// Header contact labels typography for header 14

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Contact Label Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'contact_label_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '13px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => '450',
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-fourteen .bottom-contact a span' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Contact Content Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'contact_content_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	  => '460',
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.header-fourteen .bottom-contact a' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_fourteen' ),
			),
		),
	) );

	// Header Media Options
	Kirki::add_section( 'header_wrap_media_options', array(
	    'title'      => esc_html__( 'Media', 'bosa-hotel' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Header Image Slider', 'bosa-hotel' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel. Add only one image to make header banner.', 'bosa-hotel' ),
		'type'        => 'repeater',
		'section'     => 'header_wrap_media_options',
		'row_label' => array(
			'type'  => 'text',
		),
		'button_label' => esc_html__('Add New Image', 'bosa-hotel' ),
		'settings'     => 'header_image_slider',
		'default'      => array(
				array(
					'slider_item' 	=> '',
					)			
		),
		'fields' => array(
			'slider_item' => array(
				'label'       => esc_html__( 'Image', 'bosa-hotel' ),
				'type'        => 'image',
				'default'     => '',
				'choices'     => array(
					'save_as' => 'id',
				),
			)
		),
		'choices' => array(
			'limit' => 2,
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_header_image_size',
		'section'     => 'header_wrap_media_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'header_image_size',
		'section'      => 'header_wrap_media_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	  =>  30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Slide Effect', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'header_slider_effect',
		'section'     => 'header_wrap_media_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'bosa-hotel' ),
			'horizontal-slide' => esc_html__( 'Slide', 'bosa-hotel' ),
		),
		'priority'	  =>  40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'slider_header_fade_control',
		'section'      => 'header_wrap_media_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'header_slider_effect',
				'operator' => '==',
				'value'    => 'fade',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_arrows',
		'section'      => 'header_wrap_media_options',
		'default'      => false,
		'priority'	  =>  60,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_dots',
		'section'      => 'header_wrap_media_options',
		'default'      => false,
		'priority'	  =>  70,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Auto Play', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_slider_autoplay',
		'section'      => 'header_wrap_media_options',
		'default'      => true,
		'priority'	  =>  80,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'slider_header_autoplay_speed',
		'section'      => 'header_wrap_media_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_slider_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_parallax_scrolling',
		'section'     => 'header_wrap_media_options',
		'default'     => true,
		'priority'	  =>  100,
	) );

	// Header Elements Options
	Kirki::add_section( 'header_elements_options', array(
	    'title'      => esc_html__( 'Elements', 'bosa-hotel' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_separator',
	    'section'     => 'header_elements_options',
	    'default'     => esc_html__( 'Fixed Header Options', 'bosa-hotel' ),
	    'priority'	  =>  10,
	) );
	
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_fixed_header',
		'section'     => 'header_elements_options',
		'default'     => true,
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Logo', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_fixed_header_logo',
		'section'      => 'header_elements_options',
		'default'      => false,
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Separate Logo for Fixed Header', 'bosa-hotel' ),
		'description'  => esc_html__( 'Image dimensions 320 by 120 pixels is recommended. It will change in fixed header only.', 'bosa-hotel' ),
		'type'         => 'image',
		'settings'     => 'fixed_header_separate_logo',
		'section'      => 'header_elements_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header_logo',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),

	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Logo Image Width', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'fixed_header_logo_width',
		'section'      => 'header_elements_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header_logo',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Site Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_fixed_header_site_title',
		'section'      => 'header_elements_options',
		'default'      => false,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
			array(
				'setting'  => 'disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Site Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_title_color_fixed_header',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header_site_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Site Tagline', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_fixed_header_site_tagline',
		'section'      => 'header_elements_options',
		'default'      => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' ),
			),
			array(
				'setting'  => 'disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Site Tagline Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'site_tagline_color_fixed_header',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_site_tagline',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bg_color_fixed_header',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  100,	
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'text_color_fixed_header',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Text Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'text_hover_color_fixed_header',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Background Color', 'bosa-hotel' ),
		'description'  => esc_html__( 'For background button type only.', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_background_color',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Border Color', 'bosa-hotel' ),
		'description'  => esc_html__( 'For border button type only.', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_border_color',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Fixed Header Button Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_text_color',
		'section'      => 'header_elements_options',
		'default'      => '',
		'priority'	  =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Responsive
	Kirki::add_section( 'header_responsive', array(
	    'title'      => esc_html__( 'Responsive', 'bosa-hotel' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-hotel' ),
	    'capability' => 'edit_theme_options',
	    'priority'   => '80',
	    'panel'      => 'header_options',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Top Header Menu Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_top_header',
		'section'      => 'header_responsive',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(	
		'label'       => esc_html__( 'Top Header Bar Name', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'top_bar_name',
		'section'     => 'header_responsive',
		'default'     => esc_html__( 'TOP MENU', 'bosa-hotel' ),
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Header Menu Text', 'bosa-hotel' ),
		'type'         => 'text',
		'settings'     => 'responsive_header_menu_text',
		'section'      => 'header_responsive',
		'default'      => esc_html__( 'MENU', 'bosa-hotel' ),
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Top Header Section Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_top_header_border',
		'section'      => 'header_responsive',
		'default'      => false,
		'priority'	   =>  40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Mid Header Section Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_mid_header_border',
		'section'      => 'header_responsive',
		'default'      => false,
		'priority'	   =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_fourteen' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Fixed Header', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_fixed_header',
		'section'     => 'header_responsive',
		'default'     => true,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_fixed_header',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Header Secondary Menu', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_secondary_menu',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_three' ),
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Header Contact Details', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_contact_details',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'disable_contact_detail',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two', 'header_fourteen' ),
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Header Search', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_search_icon',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'disable_search_icon',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Header Buttons', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_header_buttons',
		'section'     => 'header_responsive',
		'default'     => false,
		'priority'	  =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_button',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_two' , 'header_fourteen'),
			),
			array(
				'setting'  => 'disable_mobile_top_header',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );


	// Theme Skin Options
	Kirki::add_section( 'skins_options', array(
	    'title'      => esc_html__( 'Site Skins', 'bosa-hotel' ),
	    'description' => esc_html__( 'All color options except primary color will be overridden by the theme in dark and B&W skin.', 'bosa-hotel' ),
	    'capability' => 'edit_theme_options',
	    'priority'   => '80',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Select Theme Skin', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'skin_select',
		'section'     => 'skins_options',
		'default'     => 'default',
		'priority'	  =>  10,
		'choices'  => array(
			'default'    => esc_html__( 'Default', 'bosa-hotel' ),
			'dark'       => esc_html__( 'Dark', 'bosa-hotel' ),
			'blackwhite' => esc_html__( 'Black & White', 'bosa-hotel' ),
		)
	) );

	// Social Media Options
	Kirki::add_panel( 'social_media_options', array(
	    'title'          => esc_html__( 'Social Media', 'bosa-hotel' ),
	    'priority'       => '96',
	) );

	Kirki::add_section( 'social_media_elements_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	    'panel'			 => 'social_media_options',		
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable from Header', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_header_social_links',
		'section'      => 'social_media_elements_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable from Footer', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_social_links',
		'section'      => 'social_media_elements_options',
		'default'      => false,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Footer Social Icons Size', 'bosa-hotel' ),
		'description' => esc_html__( 'Only applicable to the footer social icons.', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'social_icons_size',
		'section'     => 'social_media_elements_options',
		'transport'   => 'postMessage',
		'default'     => 15,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Social Links', 'bosa-hotel' ),
		'type'        => 'repeater',
		'description' => esc_html__( 'By default, Social Icons will appear in both header and footer section.', 'bosa-hotel' ),
		'section'     => 'social_media_elements_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Social Link', 'bosa-hotel' ),
		),
		'settings' => 'social_media_links',
		'default' => array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
				),		
		),
		'fields' => array(
			'icon' => array(
				'label'       => esc_html__( 'Fontawesome Icon', 'bosa-hotel' ),
				'type'        => 'text',
				'description' => esc_html__( 'Input Icon name. For Example:- fab fa-facebook For more icons https://fontawesome.com/icons?d=gallery&m=free', 'bosa-hotel' ),
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'bosa-hotel' ),
				'type'        => 'text',
			),
			'target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'bosa-hotel' ),
				'type'        => 'checkbox',
				'default' 	  => true,
			),			
		),
		'choices' => array(
			'limit' => 20,
		),
		'priority' =>  40,
	) );

	// Responsive
	Kirki::add_section( 'social_responsive', array(
	    'title'          => esc_html__( 'Responsive', 'bosa-hotel' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	    'panel'			 => 'social_media_options',		
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Social Icons from Header', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_social_icons_header',
		'section'     => 'social_responsive',
		'default'     => false,
		'priority'	  =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'disable_header_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Social Icons from Footer', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_social_icons_footer',
		'section'     => 'social_responsive',
		'default'     => false,
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_social_links',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	//Typography Options
	Kirki::add_section( 'typography', array(
	    'title'          => esc_html__( 'Typography', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '95',
	    'reset'          => 'typography',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Site Title', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'site_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '22px',
			'text-transform' => 'none',
		),
		'priority'	  =>  10,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .site-branding .site-title',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Site Description', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'site_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'text-transform' => 'none',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.site-header .site-branding .site-description',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Main Menu', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '15px',
			'text-transform' => 'uppercase',
			'variant'        => '600',
			'line-height'    => '1.5',
		),
		'priority'	  =>  30,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation ul.menu li a', '.slicknav_menu .slicknav_nav li a' )
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'main_menu_description_info',
	    'section'     => 'typography',
	    'default'     => esc_html__( 'Below Main Menu Description setting will work after enabling description section in the menu. Please check https://bosathemes.com/docs/bosa/how-to-setup/how-to-setup-menu-description Documentation for more information.', 'bosa-hotel' ),
	    'priority'	  =>  40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Main Menu Description', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_description_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'font-size'      => '11px',
			'text-transform' => 'none',
			'variant'        => 'regular',
			'line-height'    => '1.3',
		),
		'priority'	  =>  50,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation .menu-description, .slicknav_menu .menu-description' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Body', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'body_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '15px',
		),
		'priority'	  =>  60,
		'transport'   => 'auto',
		'output' => array( 
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'General Title (H1 - H6)', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'general_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'text-transform' => 'none',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
			),
		),	
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Page & Single Post Title', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'page_title_font_control',
		'section'      => 'typography',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '48px',
			'text-transform' => 'none',
		),
		'priority'	  =>  80,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.page-title' ),
			),
		),
	) );

	// Site Layouts Options
	Kirki::add_panel( 'site_layout_options', array(
	    'title' => esc_html__( 'Site Layouts', 'bosa-hotel' ),
	    'priority' => '90',
	) );

	Kirki::add_section( 'site_layout_style_options', array(
	    'title'          => esc_html__( 'Style', 'bosa-hotel' ),
	    'panel'          => 'site_layout_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Site Layouts', 'bosa-hotel' ),
		'description' => esc_html__( 'Default / Box / Frame / Full / Extend', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'site_layout',
		'section'     => 'site_layout_style_options',
		'default'     => 'default',
		'choices'  => array(
			'default' => get_template_directory_uri() . '/assets/images/default-layout.png',
			'box'     => get_template_directory_uri() . '/assets/images/box-layout.png',
			'frame'   => get_template_directory_uri() . '/assets/images/frame-layout.png',
			'full'    => get_template_directory_uri() . '/assets/images/full-layout.png',
			'extend'  => get_template_directory_uri() . '/assets/images/extend-layout.png',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'box_frame_background_color',
		'section'      => 'site_layout_style_options',
		'default'      => '',
		'priority'	   =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image', 'bosa-hotel' ),
		'type'         => 'image',
		'settings'     => 'box_frame_background_image',
		'section'      => 'site_layout_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'box_frame_image_size',
		'section'      => 'site_layout_style_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	   =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_section( 'site_layout_elements_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-hotel' ),
	    'panel'          => 'site_layout_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Site Layouts (Box & Frame) Shadow', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_site_layout_shadow',
		'section'      => 'site_layout_elements_options',
		'default'      => false,
		'priority'	   =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	// Sidebar Options
	Kirki::add_section( 'sidebar_options', array(
	    'title'          => esc_html__( 'Sidebar', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '98',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Sidebar Layouts', 'bosa-hotel' ),
		'description' => esc_html__( 'Right / Left / Both / None', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'sidebar_settings',
		'section'     => 'sidebar_options',
		'default'     => 'right',
		'choices'  => array(
			'right'      => get_template_directory_uri() . '/assets/images/right-sidebar.png',
			'left'       => get_template_directory_uri() . '/assets/images/left-sidebar.png',
			'right-left' => get_template_directory_uri() . '/assets/images/right-left-sidebar.png',
			'no-sidebar' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'sidebar_widget_title_font_control',
		'section'      => 'sidebar_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '16px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  20,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.sidebar .widget .widget-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Sidebar Widget Title Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_sidebar_widget_title_border',
		'section'      => 'sidebar_options',
		'default'      => false,
		'priority'	   =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Sticky Position', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_sticky_sidebar',
		'section'      => 'sidebar_options',
		'default'      => false,
		'priority'	   =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in Blog Page', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_blog_page',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in Single Post', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_single_post',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in Page', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_page',
		'section'     => 'sidebar_options',
		'default'     => true,
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_woocommerce_page',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce Shop', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_woocommerce_shop',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
			array(
				'setting'  => 'disable_sidebar_woocommerce_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Sidebar in WooCommerce Single Product', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_sidebar_woocommerce_single',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
			array(
				'setting'  => 'disable_sidebar_woocommerce_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Footer Options
	Kirki::add_panel( 'footer_options', array(
	    'title' => esc_html__( 'Footer', 'bosa-hotel' ),
	    'priority' => '110',
	) );

	// Footer Widgets Options
	Kirki::add_section( 'footer_widgets_options', array(
	    'title'          => esc_html__( 'Footer Widgets', 'bosa-hotel' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Footer Widget Area', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget',
		'section'      => 'footer_widgets_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Footer Widget Title Border', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget_title_border',
		'section'      => 'footer_widgets_options',
		'default'      => false,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Footer Widget Item List Border ', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_widget_list_item_border',
		'section'      => 'footer_widgets_options',
		'default'      => false,
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Widget Columns Layouts', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_widget_layout',
		'section'     => 'footer_widgets_options',
		'default'     => 'footer_widget_layout_one',
		'choices'  => array(
			'footer_widget_layout_one'    => get_template_directory_uri() . '/assets/images/widget-layout-1.png',
			'footer_widget_layout_two'    => get_template_directory_uri() . '/assets/images/widget-layout-2.png',
			'footer_widget_layout_three'    => get_template_directory_uri() . '/assets/images/widget-layout-3.png',
			'footer_widget_layout_four' => get_template_directory_uri() . '/assets/images/widget-layout-4.png',
		),
		'priority'	   =>  40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Footer Widget Area Top Padding(in px)', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'footer_widget_area_top_padding',
		'section'      => 'footer_widgets_options',
		'default'      => 0,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Footer Widget Area Bottom Padding(in px)', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'footer_widget_area_bottom_padding',
		'section'      => 'footer_widgets_options',
		'default'      => 50,
		'priority'	   =>  60,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Background Color', 'bosa-hotel' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_footer_background_color',
		'section'      => 'footer_widgets_options',
		'default'      => '',
		'priority'	   =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widget Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_title_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#030303',
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widgets Link Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_link_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#656565',
		'priority'	   =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widgets Content Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_content_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#656565',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widgets Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_link_hover_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#E4A853',
		'priority'	   =>  110,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Widget Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'footer_widget_title_font_control',
		'section'      => 'footer_widgets_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  =>  120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-footer .widget .widget-title',
			),
		),
	) );

	// Footer Style Options
	Kirki::add_section( 'footer_style_options', array(
	    'title'          => esc_html__( 'Style', 'bosa-hotel' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Bottom Footer Area', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_bottom_footer',
		'section'      => 'footer_style_options',
		'default'      => false,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Footer Layouts', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_layout',
		'section'     => 'footer_style_options',
		'default'     => 'footer_three',
		'choices'  	  => apply_filters( 'bosa_hotel_footer_layout_filter', array(
			'footer_one'   => get_template_directory_uri() . '/assets/images/footer-layout-1.png',
			'footer_two'   => get_template_directory_uri() . '/assets/images/footer-layout-2.png',
			'footer_three' => get_template_directory_uri() . '/assets/images/footer-layout-3.png',
		) ),
		'priority'	   => 20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Bottom Footer Area Top Padding(in px)', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'bottom_footer_area_top_padding',
		'section'      => 'footer_style_options',
		'default'      => 30,
		'priority'	   => 30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Bottom Footer Area Bottom Padding(in px)', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'bottom_footer_area_bottom_padding',
		'section'      => 'footer_style_options',
		'default'      => 30,
		'priority'	   => 40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Color', 'bosa-hotel' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_background_color',
		'section'      => 'footer_style_options',
		'default'      => '',
		'priority'	   => 50,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_color',
		'section'      => 'footer_style_options',
		'default'      => '#656565',
		'priority'	   => 60,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Text Link Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_link_color',
		'section'      => 'footer_style_options',
		'default'      => '#383838',
		'priority'	   => 70,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Text Link Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_link_hover_color',
		'section'      => 'footer_style_options',
		'default'      => '#E4A853',
		'priority'	   => 80,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Bottom Footer Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'footer_style_font_control',
		'section'      => 'footer_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '14px',
			'text-transform' => 'none',
			'line-height'    => '1.6',
		),
		'priority'	   => 90,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.site-footer .site-info', '.site-footer .footer-menu ul li a' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Select Image', 'bosa-hotel' ),
		'type'         => 'image',
		'settings'     => 'bottom_footer_image',
		'section'      => 'footer_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 100,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'    => esc_html__( 'Image Link', 'bosa-hotel' ),
		'type'     => 'link',
		'settings' => 'bottom_footer_image_link',
		'section'  => 'footer_style_options',
		'default'  => '',
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'    => esc_html__( 'Image Target', 'bosa-hotel' ),
		'description' => esc_html__( 'If enabled, the page will be open in an another browser tab.', 'bosa-hotel' ),
		'type'     => 'checkbox',
		'settings' => 'bottom_footer_image_target',
		'section'  => 'footer_style_options',
		'default'  => true,
		'priority'	   => 120,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Image Width', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'bottom_footer_image_width',
		'section'      => 'footer_style_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 10,
			'max'  => 1140,
			'step' => 5,
		),
		'priority'	   => 130,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_bottom_footer_image_size',
		'section'     => 'footer_style_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	   => 140,
		'active_callback' => array(
			array(
				'setting'  => 'footer_layout',
				'operator' => 'contains',
				'value'    => array( 'footer_one', 'footer_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Footer Menu', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_footer_menu',
		'section'      => 'footer_style_options',
		'default'      => false,
		'priority'	   => 150,
	) );

	// Media Footer Options
	Kirki::add_section( 'media_footer_options', array(
	    'title'          => esc_html__( 'Media', 'bosa-hotel' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Select Background Image', 'bosa-hotel' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel.', 'bosa-hotel' ),
		'type'        => 'image',
		'settings'    => 'footer_image',
		'section'     => 'media_footer_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_footer_image_size',
		'section'     => 'media_footer_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'footer_image_size',
		'section'      => 'media_footer_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	   =>  30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Parallax Scrolling', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_footer_parallax_scrolling',
		'section'     => 'media_footer_options',
		'default'     => true,
		'priority'	  =>  40,
	) );

	// Footer Elements Options
	Kirki::add_section( 'elements_footer_options', array(
	    'title'          => esc_html__( 'Elements', 'bosa-hotel' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority' 		 => 40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Scroll to Top', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_scroll_top',
		'section'     => 'elements_footer_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	// Responsive
	Kirki::add_section( 'footer_responsive', array(
	    'title'          => esc_html__( 'Responsive', 'bosa-hotel' ),
	    'description'    => esc_html__( 'These options will only apply to Tablet and Mobile devices. Please
	    	click on below Tablet or Mobile Icons to see changes.', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'footer_options',
	    'priority' 		 => 50,		
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Footer Widget Area', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_responsive_footer_widget',
		'section'     => 'footer_responsive',
		'default'     => false,
		'priority'	  =>  10,
		'active_callback' => array(
			array(
				'setting'  => 'disable_footer_widget',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Scroll Top', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_scroll_top',
		'section'     => 'footer_responsive',
		'default'     => true,
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'disable_scroll_top',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	// Blog Homepage Options

	// Main Banner / Post Slider 
	Kirki::add_section( 'main_slider_options', array(
	    'title'          => esc_html__( 'Banner / Post Slider', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Section', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_main_slider',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Slider / Banner', 'bosa-hotel' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_slider_controls',
		'section'     => 'main_slider_options',
		'default'     => 'slider',
		'choices'  => array(
			'slider' => esc_html__( 'Slider', 'bosa-hotel' ),
			'banner' => esc_html__( 'Banner', 'bosa-hotel' ),

		),
		'priority'	  =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Height (in px)', 'bosa-hotel' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'main_slider_height',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 550,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'	  =>  30,
	) );

	// Slider settings
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_slider_image_size',
		'section'     => 'main_slider_options',
		'default'     => 'bosa-hotel-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  40,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-hotel' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen. Recommended posts containing feature images size with 1920x940 pixel.', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'slider_category',
		'section'     => 'main_slider_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_post_categories(),
		'priority'	  =>  50,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Slider Layout', 'bosa-hotel' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'main_slider_layout',
		'section'     => 'main_slider_options',
		'default'     => 'main_slider_one',
		'choices'     => apply_filters( 'bosa_hotel_slider_layout_filter', array(
			'main_slider_one'    => get_template_directory_uri() . '/assets/images/slider-layout-1.png',
		) ),
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Slider Background Color', 'bosa-hotel' ),
		'settings'    => 'background_color_main_slider',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  =>  70,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'slider_post_title_color',
		'section'      => 'main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_slider_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'slider_post_category_color',
		'section'      => 'main_slider_options',
		'default'      => '#ebebeb',
		'priority'	   =>  90,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_slider_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'slider_post_meta_color',
		'section'      => 'main_slider_options',
		'default'      => '#ebebeb',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_slider_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_slider_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_slider_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'slider_post_meta_icon_color',
		'section'      => 'main_slider_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_slider_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_slider_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_slider_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'slider_post_text_color',
		'section'      => 'main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Hover Color', 'bosa-hotel' ),
		'settings'    => 'separate_hover_color_for_main_slider',
		'section'     => 'main_slider_options',
		'default'     => '#E4A853',
		'priority'	  =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'main_slider_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Width Controls', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'slider_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'bosa-hotel' ),
			'boxed'  => esc_html__( 'Boxed', 'bosa-hotel' ),
		),
		'priority'	  =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Slide Effect', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'main_slider_effect',
		'section'     => 'main_slider_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'bosa-hotel' ),
			'horizontal-slide' => esc_html__( 'Slide', 'bosa-hotel' ),
		),
		'priority'	  =>  160,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'slider_fade_control',
		'section'      => 'main_slider_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   =>  170,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'main_slider_effect',
				'operator' => '==',
				'value'    => 'fade',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Content Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'main_slider_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'bosa-hotel' ),
			'left'   => esc_html__( 'Left', 'bosa-hotel' ),
			'right'  => esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	  =>  180,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Display Slider on', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'display_main_slider_on',
		'section'     => 'main_slider_options',
		'default'     => 'below_header',
		'choices'  => array(
			'below_header'            => esc_html__( 'Below Header', 'bosa-hotel' ),
			'below_featured_posts' => esc_html__( 'Below Featured Posts', 'bosa-hotel' ),
		),
		'priority'	  =>  190,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_arrows',
		'section'      => 'main_slider_options',
		'default'      => false,
		'priority'	   =>  200,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_dots',
		'section'      => 'main_slider_options',
		'default'      => false,
		'priority'	   =>  210,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Auto Play', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_slider_autoplay',
		'section'      => 'main_slider_options',
		'default'      => true,
		'priority'	   =>  220,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'slider_autoplay_speed',
		'section'      => 'main_slider_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   =>  230,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'disable_slider_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post View Number', 'bosa-hotel' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'slider_posts_number',
		'section'      => 'main_slider_options',
		'default'      => 6,
		'choices' => array(
				'min' => '1',
				'max' => '20',
				'step' => '1',
		),
		'priority'	   =>  240,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Title', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_title',
		'section'     => 'main_slider_options',
		'default'     => false,	
		'priority'	  =>  250,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_title_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '50px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  260,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable category', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_category',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  270,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );	

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Category Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_cat_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.6',
		),
		'priority'	  =>  280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_category',
				'operator' => '==',
				'value'    => false,
				),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_date',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  290,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_author',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  300,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_comment',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  310,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Meta Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_meta_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  320,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				array(
				'setting'  => 'hide_slider_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_slider_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_slider_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Excerpt', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_excerpt',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  330,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Excerpt Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_excerpt_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'	  =>  340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Excerpt Length', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'slider_excerpt_length',
		'section'     => 'main_slider_options',
		'default'     => 25,
		'choices' => array(
			'min' => '5',
			'max' => '100',
			'step' => '5',
		),
		'priority'	  =>  350,
		'active_callback' => array(
			array(
				'setting'  => 'hide_slider_excerpt',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Slider Button', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_slider_button',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  360,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Slider Button', 'bosa-hotel' ),
		'type'        => 'repeater',
		'settings'    => 'main_slider_button_repeater',
		'section'     => 'main_slider_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-hotel' ),
		),
		'default' => array(
			array(
				'slider_btn_type' 			=> 'button-outline',
				'slider_btn_bg_color' 		=> '#C9A76E',
				'slider_btn_border_color' 	=> '#ffffff',
				'slider_btn_text_color' 	=> '#ffffff',
				'slider_btn_hover_color' 	=> '#E4A853',
				'slider_btn_text' 			=> '',
				'slider_btn_radius' 		=> 0,
			),		
		),
		'fields' => array(
			'slider_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-hotel' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-hotel' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-hotel' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-hotel' ),
				),
			),
			'slider_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#C9A76E',
			),
			'slider_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'slider_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'slider_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#E4A853',
			),
			'slider_btn_text' => array(
				'label'       => esc_html__( 'Text', 'bosa-hotel' ),
				'type'        => 'text',
				'default'	  => '',
			),
			'slider_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-hotel' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),
		),
		'choices' => array(
			'limit' => 1,
		),
		'priority'	  =>  370,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Slider Button Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_button_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '500',
			'font-size'      => '15px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  380,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .slide-inner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hide_slider_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Banner settings
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_banner_image_size',
		'section'     => 'main_slider_options',
		'default'     => 'bosa-hotel-1920-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  390,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'type'        => 'color',
		'label'       => esc_html__( 'Banner Background Color', 'bosa-hotel' ),
		'settings'    => 'background_color_main_banner',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  =>  400,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'banner_title_color',
		'section'	   => 'main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  410,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Subtitle Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'banner_subtitle_color',
		'section'      => 'main_slider_options',
		'default'      => '#ffffff',
		'priority'	   =>  420,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Select Image', 'bosa-hotel' ),
		'description' => esc_html__( 'Recommended image size 1920x940 pixel.', 'bosa-hotel' ),
		'type'        => 'image',
		'settings'    => 'banner_image',
		'section'     => 'main_slider_options',
		'default'	  => '',
		'priority'	  =>  430,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'main_banner_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	   =>  440,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Width Controls', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'banner_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'bosa-hotel' ),
			'boxed'  => esc_html__( 'Boxed', 'bosa-hotel' ),
		),
		'priority'	  =>  450,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Content Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'main_banner_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'center' => esc_html__( 'Center', 'bosa-hotel' ),
			'left'   => esc_html__( 'Left', 'bosa-hotel' ),
			'right'  => esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	  =>  460,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Display Banner on', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'display_banner_on',
		'section'     => 'main_slider_options',
		'default'     => 'below_header',
		'choices'  => array(
			'below_header'            => esc_html__( 'Below Header', 'bosa-hotel' ),
			'below_featured_posts' => esc_html__( 'Below Featured Posts', 'bosa-hotel' ),
		),
		'priority'	  =>  470,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Title', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_banner_title',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  480,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'banner_title',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  =>  490,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
		),
		'partial_refresh' => array(
			'banner_title' => array(
				'selector'        => '.banner_title',
				'render_callback' => 'bosa_hotel_get_banner_title',
			)
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'banner_title_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '50px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  500,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Subtitle', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_banner_subtitle',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  510,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Subtitle', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'banner_subtitle',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  =>  520,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
		),
		'partial_refresh' => array(
			'banner_subtitle' => array(
				'selector'        => '.banner_subtitle',
				'render_callback' => 'bosa_hotel_get_banner_subtitle',
			)
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Subtitle Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_banner_subtitle_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'	  =>  530,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-subtitle',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_subtitle',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Banner Buttons', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_banner_buttons',
		'section'     => 'main_slider_options',
		'default'     => false,
		'priority'	  =>  540,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Banner Buttons', 'bosa-hotel' ),
		'type'        => 'repeater',
		'settings'    => 'main_banner_buttons_repeater',
		'section'     => 'main_slider_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-hotel' ),
		),
		'default' => array(
			array(
				'banner_btn_type' 			=> 'button-outline',
				'banner_btn_bg_color' 		=> '#C9A76E',
				'banner_btn_border_color' 	=> '#ffffff',
				'banner_btn_text_color' 	=> '#ffffff',
				'banner_btn_hover_color' 	=> '#E4A853',
				'banner_btn_text' 			=> '',
				'banner_btn_link' 			=> '',
				'banner_btn_target'			=> true,
				'banner_btn_radius' 		=> 0,
			),		
		),
		'fields' => array(
			'banner_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-hotel' ),
				'type'        => 'select',
				'default'     => 'button-outline',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-hotel' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-hotel' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-hotel' ),
				),
			),
			'banner_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#C9A76E',
			),
			'banner_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'banner_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#ffffff',
			),
			'banner_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#E4A853',
			),
			'banner_btn_text' => array(
				'label'       => esc_html__( 'Text', 'bosa-hotel' ),
				'type'        => 'text',
				'default'	  => '',
			),
			'banner_btn_link' => array(
				'label'       => esc_html__( 'Link', 'bosa-hotel' ),
				'type'        => 'text',
				'default'	  => '',	
			),
			'banner_btn_target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'bosa-hotel' ),
				'type'        => 'checkbox',
				'default'	  => true,	
			),
			'banner_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-hotel' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),
		),
		'choices' => array(
			'limit' => 1,
		),
		'priority'	  =>  550,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_buttons',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Banner Button Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'main_banner_button_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '500',
			'font-size'      => '15px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  560,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'disable_banner_buttons',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Featured Posts Options
	Kirki::add_section( 'feature_posts_options', array(
	    'title'          => esc_html__( 'Featured Posts', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '20',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Featured Posts Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section',
		'section'      => 'feature_posts_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section_title',
		'section'      => 'feature_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_title',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_section_title_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_feature_posts_section_description',
		'section'      => 'feature_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Description', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'feature_posts_section_description',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_section_description_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-feature-posts-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_section_title_desc_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-hotel' ),
			'center'  	=> esc_html__( 'Center', 'bosa-hotel' ),   
			'right'		=> esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	  	  =>  80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_feature_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'disable_feature_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Layout', 'bosa-hotel' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'feature_posts_section_layouts',
		'section'     => 'feature_posts_options',
		'default'     => 'feature_one',
		'choices'     => apply_filters( 'bosa_hotel_feature_posts_section_layouts_filter', array(
			'feature_one'    => get_template_directory_uri() . '/assets/images/feature-post-layout-1.png',
		) ),
		'priority'	  =>  90,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_title_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  100,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_category_bgcolor',
		'section'      => 'feature_posts_options',
		'default'      => '#C9A76E',
		'priority'	   =>  110,
		'active_callback' => array(
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_category_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_meta_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_meta_icon_color',
		'section'      => 'feature_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_featured_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_featured_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'featured_post_hover_color',
		'section'      => 'feature_posts_options',
		'default'      => '#E4A853',
		'priority'	   =>  150,
	) );


	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Columns', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_columns',
		'section'     => 'feature_posts_options',
		'default'     => 'three_columns',
		'placeholder' => esc_attr__( 'Select category', 'bosa-hotel' ),
		'choices'  => array(
			'one_column'    => esc_html__( '1 Column', 'bosa-hotel' ),
			'two_columns'   => esc_html__( '2 Columns', 'bosa-hotel' ),
			'three_columns' => esc_html__( '3 Columns', 'bosa-hotel' ),
			'four_columns'  => esc_html__( '4 Columns', 'bosa-hotel' ),
		),
		'priority'	   =>  160,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-hotel' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-hotel' ), 
		'choices'     => bosa_hotel_get_post_categories(),
		'priority'	   =>  170,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Featured Posts Overlay Opacity', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'feature_posts_overlay_opacity',
		'section'     => 'feature_posts_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'	   =>  180,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post View Number', 'bosa-hotel' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'feature_posts_posts_number',
		'section'      => 'feature_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '48',
			'step' => '1',
		),
		'priority'	   =>  190,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Height (in px)', 'bosa-hotel' ),
		'description'  => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'feature_posts_height',
		'section'      => 'feature_posts_options',
		'transport'    => 'postMessage',
		'default'      => 250,
		'choices' => array(
			'min' => '100',
			'max' => '1200',
			'step' => '10',
		),
		'priority'	   =>  200,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_feature_post_image_size',
		'section'     => 'feature_posts_options',
		'default'     => 'bosa-hotel-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  210,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Background Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'feature_posts_image_size',
		'section'      => 'feature_posts_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'	   =>  220,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'feature_posts_radius',
		'section'     => 'feature_posts_options',
		'transport'	  => 'postMessage', 
		'default'     =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   =>  230,
	) );

		Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Post Text Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_text_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'text-left',
		'choices'     => array(
			'text-left'	 	=> esc_html__( 'Left', 'bosa-hotel' ),
			'text-center'  	=> esc_html__( 'Center', 'bosa-hotel' ),   
			'text-right'	=> esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	   =>  240,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Post Content Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'feature_posts_title_alignment',
		'section'     => 'feature_posts_options',
		'default'     => 'align-bottom',
		'choices'     => array(
			'align-top'	 	=> esc_html__( 'Top', 'bosa-hotel' ),
			'align-center'  => esc_html__( 'Center', 'bosa-hotel' ),   
			'align-bottom'  => esc_html__( 'Bottom', 'bosa-hotel' ),
		),
		'priority'	   =>  250,
	) ); 

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_feature_posts_title',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  260,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'feature_posts_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.4',
		),
		'priority'	  =>  270,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .feature-posts-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Title Divider', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_feature_title_divider',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  280,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'disable_feature_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Posts category', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_category',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  290,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'featured_posts_cat_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  =>  300,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_featured_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Date', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_date',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  310,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Author', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_author',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  320,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Comment', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_featured_posts_comment',
		'section'     => 'feature_posts_options',
		'default'     => false,
		'priority'	  =>  330,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'featured_posts_meta_font_control',
		'section'      => 'feature_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  =>  340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.post .feature-posts-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_featured_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_featured_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_featured_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	// Latest Posts Options
	Kirki::add_section( 'latest_posts_options', array(
	    'title'          => esc_html__( 'Latest Posts', 'bosa-hotel' ),
	    'description'    => esc_html__( 'More options are available in Blog Page Section.', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '30',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Latest Posts Section From Homepage', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_latest_posts_section',
		'section'     => 'latest_posts_options',
		'default'     => false,
		'priority'	  =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_latest_posts_section_title',
		'section'      => 'latest_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'latest_posts_section_title',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_title_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_latest_posts_section_description',
		'section'      => 'latest_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Description', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'latest_posts_section_description',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_description_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'latest_posts_section_title_desc_alignment',
		'section'     => 'latest_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-hotel' ),
			'center'  	=> esc_html__( 'Center', 'bosa-hotel' ),   
			'right'		=> esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	   =>  80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_latest_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'disable_latest_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-hotel' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'latest_posts_category',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-hotel' ), 
		'choices'     => bosa_hotel_get_post_categories(),
		'priority'	  =>  90,
	) );

	// Highlighted Posts Options
	Kirki::add_section( 'highlight_posts_options', array(
	    'title'          => esc_html__( 'Highlighted Posts', 'bosa-hotel' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '40',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Highlighted Posts Section', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_section',
		'section'      => 'highlight_posts_options',
		'default'      => false,
		'priority'	   =>  10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_section_title',
		'section'      => 'highlight_posts_options',
		'default'      => true,
		'priority'	   =>  20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'highlight_posts_section_title',
		'section'     => 'highlight_posts_options',
		'default'     => '',
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_section_title_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'font-size'      => '24px',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'priority'	  =>  40,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Section Description', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_section_description',
		'section'      => 'highlight_posts_options',
		'default'      => true,
		'priority'	   =>  50,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Description', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'highlight_posts_section_description',
		'section'     => 'highlight_posts_options',
		'default'     => '',
		'priority'	  =>  60,
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Section Description Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_section_description_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'line-height'    => '1.8',
		),
		'priority'	  =>  70,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-highlight-post .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section_description',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Title and Description Alignment', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'highlight_posts_section_title_desc_alignment',
		'section'     => 'highlight_posts_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'bosa-hotel' ),
			'center'  	=> esc_html__( 'Center', 'bosa-hotel' ),   
			'right'		=> esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'	   => 80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_highlight_posts_section_title',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'disable_highlight_posts_section_description',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Section Layout', 'bosa-hotel' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'highlight_posts_section_layouts',
		'section'     => 'highlight_posts_options',
		'default'     => 'highlighted_one',
		'choices'     => array(
			'highlighted_one'    => get_template_directory_uri() . '/assets/images/highlight-layout-1.png',
			'highlighted_two'    => get_template_directory_uri() . '/assets/images/highlight-layout-2.png',
		),
		'priority'	   =>  90,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Category', 'bosa-hotel' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'highlight_posts_category',
		'section'     => 'highlight_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_post_categories(),
		'priority'	  =>  100,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_highlight_post_image_size',
		'section'     => 'highlight_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'	  =>  110,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_title_color',
		'section'      => 'highlight_posts_options',
		'default'      => '#030303',
		'priority'	   =>  120,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );
	
	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_category_bgcolor',
		'section'      => 'highlight_posts_options',
		'default'      => '#1f1f1f',
		'priority'	   =>  130,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_category_color',
		'section'      => 'highlight_posts_options',
		'default'      => '#FFFFFF',
		'priority'	   =>  140,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_meta_color',
		'section'      => 'highlight_posts_options',
		'default'      => '#7a7a7a',
		'priority'	   =>  150,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_highlight_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_highlight_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_highlight_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_meta_icon_color',
		'section'      => 'highlight_posts_options',
		'default'      => '#C9A76E',
		'priority'	   =>  160,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'hide_highlight_posts_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_highlight_posts_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_highlight_posts_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),

	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'highlight_post_hover_color',
		'section'      => 'highlight_posts_options',
		'default'      => '#E4A853',
		'priority'	   =>  170,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Post Border Radius (px)', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'     => 'highlight_posts_radius',
		'section'     => 'highlight_posts_options',
		'transport'   => 'postMessage',
		'default'      =>  0,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   =>  180,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Slider Columns', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'highlight_posts_slides_show',
 		'section'      => 'highlight_posts_options',
		'default'      => 3,
		'priority'	   => 190,
		'choices' => array(
			'min' => '2',
			'max' => '4',
			'step'=> '1',
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Arrows', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_arrows',
		'section'      => 'highlight_posts_options',
		'default'      => false,
		'priority'	   => 200,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Dots', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_dots',
		'section'      => 'highlight_posts_options',
		'default'      => false,
		'priority'	   => 210,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Slider Auto Play', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_highlight_posts_autoplay',
		'section'      => 'highlight_posts_options',
		'default'      => true,
		'priority'	   => 220,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Slider Auto Play Timeout ( in sec )', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'highlight_posts_autoplay_speed',
 		'section'      => 'highlight_posts_options',
		'default'      => 4,
		'choices' => array(
			'min' => '1',
			'max' => '60',
			'step'=> '1',
		),
		'priority'	   => 230,
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_autoplay',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Slider Post View Number', 'bosa-hotel' ),
		'description'  => esc_html__( 'Number of posts to show.', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'highlight_posts_posts_number',
		'section'      => 'highlight_posts_options',
		'default'      => 6,
		'choices' => array(
			'min' => '1',
			'max' => '20',
			'step' => '1',
		),
		'priority'	   => 240,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post category', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_category',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 250,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_cat_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1',
		),
		'priority'	  => 260,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_highlight_posts_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_title',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 270,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_title_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '18px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'	  => 280,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_highlight_posts_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Date', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_date',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 290,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Author', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_author',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 300,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Comment', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_comment',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 310,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'highlight_posts_meta_font_control',
		'section'      => 'highlight_posts_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'	  => 320,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.highlight-post-slider .post .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_highlight_posts_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_highlight_posts_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_highlight_posts_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Image', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_highlight_posts_image',
		'section'     => 'highlight_posts_options',
		'default'     => false,
		'priority'	  => 330,
	) );

	// Responsive
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Main Slider / Banner', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_mobile_main_slider',
		'section'     => 'blog_page_responsive',
		'default'     => false,
		'priority'	  => 10,
		'active_callback' => array(
			array(
				'setting'  => 'disable_main_slider',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Featured Posts', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_feature_posts',
		'section'      => 'blog_page_responsive',
		'default'      => false,
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'disable_feature_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Latest Posts', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_latest_posts',
		'section'      => 'blog_page_responsive',
		'default'      => false,
		'priority'	   => 30,
		'active_callback' => array(
			array(
				'setting'  => 'disable_latest_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Highlighted Posts', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_mobile_highlight_posts',
		'section'      => 'blog_page_responsive',
		'default'      => false,
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'disable_highlight_posts_section',
				'operator' => '=',
				'value'    => false,
			),
		),
	) );


	// Blog Page Options
    Kirki::add_panel( 'blog_page_options', array(
	    'title'          => esc_html__( 'Blog Page', 'bosa-hotel' ),
	    'priority'       => '130',
	) );

    // Blog Page Style Options
	Kirki::add_section( 'blog_page_style_options', array(
	    'title'      => esc_html__( 'Style', 'bosa-hotel' ),
	    'panel'      => 'blog_page_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '10',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Post Layouts', 'bosa-hotel' ),
		'description' => esc_html__( 'Grid / List / Single', 'bosa-hotel' ),
		'type'        => 'radio-image',
		'settings'    => 'archive_post_layout',
		'section'     => 'blog_page_style_options',
		'default'     => 'single',
		'choices'  	  => apply_filters( 'bosa_hotel_archive_post_layout_filter', array(
			'grid'           => get_template_directory_uri() . '/assets/images/grid-layout.png',
			'list'           => get_template_directory_uri() . '/assets/images/list-layout.png',
			'single'         => get_template_directory_uri() . '/assets/images/single-layout.png',
		) ),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Post View Number', 'bosa-hotel' ),
		'description' => esc_html__( 'Number of posts to show.', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'archive_post_per_page',
		'section'     => 'blog_page_style_options',
		'default'     => 10,
		'choices'  => array(
			'min' => '0',
			'max' => '20',
			'step' => '1',
		),
		'priority'    => 20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_post_image_size',
		'section'     => 'blog_page_style_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'    => 30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'latest_posts_radius',
		'section'     => 'blog_page_style_options',
		'default'     =>  0,
		'transport'   => 'postMessage',
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_title_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#101010',
		'priority'     => 50,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_post_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_category_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#C9A76E',
		'priority'     => 60,
		'active_callback' => array(
			array(
				'setting'  => 'hide_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_meta_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#7a7a7a',
		'priority'     => 70,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				array(
					'setting'  => 'hide_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Icon Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_meta_icon_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#C9A76E',
		'priority'     => 80,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'hide_date',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_author',
					'operator' => '==',
					'value'    => false,
				),
				array(
					'setting'  => 'hide_comment',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_text_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#333333',
		'priority'     => 90,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Hover Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'blog_post_hover_color',
		'section'      => 'blog_page_style_options',
		'default'      => '#E4A853',
		'priority'     => 100,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Title', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_post_title',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 110,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_title_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '500',
			'font-size'      => '21px',
			'text-transform' => 'none',
			'line-height'    => '1.4',
		),
		'priority'    => 120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary article .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_title',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Category', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_category',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 130,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Category Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_cat_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'uppercase',
			'line-height'    => '1.6',
		),
		'priority'    => 140,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_category',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_date',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 150,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_author',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 160,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_comment',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 170,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Meta Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_meta_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Poppins',
			'variant'        => '400',
			'font-size'      => '13px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'    => 180,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-meta',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'hide_date',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_author',
				'operator' => '==',
				'value'    => false,
				),
				array(
				'setting'  => 'hide_comment',
				'operator' => '==',
				'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Excerpt', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_blog_page_excerpt',
		'section'     => 'blog_page_style_options',
		'default'     => false,
		'priority'    => 190,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Excerpt Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_excerpt_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '400',
			'font-size'      => '15px',
			'text-transform' => 'initial',
			'line-height'    => '1.8',
		),
		'priority'    => 200,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Excerpt Length', 'bosa-hotel' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'post_excerpt_length',
		'section'     => 'blog_page_style_options',
		'default'     => 15,
		'choices' => array(
			'min'  => '5',
			'max'  => '60',
			'step' => '5',
		),
		'priority'    => 210,
		'active_callback' => array(
			array(
				'setting'  => 'hide_blog_page_excerpt',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Post Button', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_post_button',
		'section'     => 'blog_page_style_options',
		'default'     => true,
		'priority'    => 220,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Button', 'bosa-hotel' ),
		'type'         => 'repeater',
		'settings'     => 'blog_page_button_repeater',
		'section'      => 'blog_page_style_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Button', 'bosa-hotel' ),
		),
		'default' => array(
			array(
				'blog_btn_type' 		=> 'button-text',
				'blog_btn_bg_color'		=> '#C9A76E',
				'blog_btn_border_color'	=> '#1a1a1a',
				'blog_btn_text_color'	=> '#1a1a1a',
				'blog_btn_hover_color'	=> '#E4A853',
				'blog_btn_text' 		=> '',
				'blog_btn_radius'		=> 0,
			),		
		),
		'priority'    => 230,
		'fields' => array(
			'blog_btn_type' => array(
				'label'       => esc_html__( 'Button Type', 'bosa-hotel' ),
				'type'        => 'select',
				'default'     => 'button-text',
				'choices'  => array(
					'button-primary' => esc_html__( 'Background Button', 'bosa-hotel' ),
					'button-outline' => esc_html__( 'Border Button', 'bosa-hotel' ),
					'button-text'    => esc_html__( 'Text Only Button', 'bosa-hotel' ),
				),
			),
			'blog_btn_bg_color' => array(
				'label'       => esc_html__( 'Button Background Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For background button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#C9A76E',
			),
			'blog_btn_border_color' => array(
				'label'       => esc_html__( 'Button Border Color', 'bosa-hotel' ),
				'description' => esc_html__( 'For border button type only.', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#1a1a1a',
			),
			'blog_btn_text_color' => array(
				'label'       => esc_html__( 'Button Text Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#1a1a1a',
			),
			'blog_btn_hover_color' => array(
				'label'       => esc_html__( 'Button Hover Color', 'bosa-hotel' ),
				'type'        => 'color',
				'default'     => '#E4A853',
			),
			'blog_btn_text' => array(
				'label'       => esc_html__( 'Button Text', 'bosa-hotel' ),
				'type'        => 'text',
				'default' 	  => '',
			),
			'blog_btn_radius' => array(
				'label'       => esc_html__( 'Button Radius (px)', 'bosa-hotel' ),
				'type'        => 'number',
				'default'	  => 0,
				'choices'     => array(
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				),
			),	
		),
		'choices' => array(
			'limit' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Post Button Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_button_font_control',
		'section'      => 'blog_page_style_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => '600',
			'font-size'      => '14px',
			'text-transform' => 'capitalize',
			'line-height'    => '1.6',
		),
		'priority'    => 240,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-text .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hide_post_button',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Blog Page Elements Options
	Kirki::add_section( 'blog_page_elements_options', array(
	    'title'      => esc_html__( 'Elements', 'bosa-hotel' ),
	    'panel'      => 'blog_page_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '20',
	) );

	Kirki::add_field( 'bosa-hotel',  array(
		'label'       => esc_html__( 'Blog Archive Pages Title', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'disable_blog_page_title',
		'section'     => 'blog_page_elements_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'  => esc_html__( 'Enable in all', 'bosa-hotel' ),
			'disable_all_pages' => esc_html__( 'Disable from all', 'bosa-hotel' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Pagination', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_pagination',
		'section'     => 'blog_page_elements_options',
		'default'     => false,
		'priority'    => 20,
	) );

	// Single Post Options
	Kirki::add_section( 'single_post_options', array(
	    'title'          => esc_html__( 'Single Post', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '140',
	) );

	Kirki::add_field( 'bosa-hotel',  array(
		'label'       => esc_html__( 'Post Title', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'disable_single_post_title',
		'section'     => 'single_post_options',
		'default'     => 'enable_all_pages',
		'choices'     => array(
			'enable_all_pages'    => esc_html__( 'Enable in all', 'bosa-hotel' ),
			'disable_all_pages'   => esc_html__( 'Disable from all', 'bosa-hotel' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-hotel',  array(
		'label'       => esc_html__( 'Post Title Position', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'post_title_position',
		'section'     => 'single_post_options',
		'default'     => 'above_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'bosa-hotel' ),
			'above_feature_image' => esc_html__( 'Top of the Page', 'bosa-hotel' ),
		),
		'priority'    => 20,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_transparent_header_post',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Feature Image', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'single_feature_image',
		'section'     => 'single_post_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'bosa-hotel' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'bosa-hotel' ),
		),
		'priority'    => 30,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_transparent_header_post',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_single_post_image_size',
		'section'     => 'single_post_options',
		'default'     => 'bosa-hotel-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'    => 40,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'single_feature_image',
					'operator' => '==',
					'value'    => 'show_in_all_pages',
				),
				array(
					'setting'  => 'disable_transparent_header_post',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Transparent Header', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_transparent_header_post',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'    => 50,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Transparent Header Banner Height (in px)', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'transparent_header_banner_post_height',
		'section'     => 'single_post_options',
		'transport'   => 'postMessage',
		'default'     => 400,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'    => 60,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Banner Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'transparent_header_banner_post_size',
		'section'      => 'single_post_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'    => 70,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Transparent Header Banner Overlay Opacity', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'transparent_header_banner_post_opacity',
		'section'     => 'single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_post',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Date', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_date',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 90,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Comments Link', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_comment',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 100,
	) );
	
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable category', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_category',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 110,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Tag Links', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_tag_links',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 120,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Author', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_single_post_author',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 130,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Author Section Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'single_post_author_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'About the Author', 'bosa-hotel' ),
		'priority'    => 140,
		'active_callback' => array(
			array(
				'setting'  => 'hide_single_post_author',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Related Posts', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'hide_related_posts',
		'section'     => 'single_post_options',
		'default'     => false,
		'priority'    => 150,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Related Posts Section Title', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'related_posts_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'You may also like these', 'bosa-hotel' ),
		'priority'    => 160,
		'active_callback' => array(
			array(
				'setting'  => 'hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'description' => esc_html__( 'For related posts.', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_related_post_image_size',
		'section'     => 'single_post_options',
		'default'     => 'bosa-hotel-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'    => 170,
		'active_callback' => array(
			array(
				'setting'  => 'hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Related Posts Items', 'bosa-hotel' ),
		'description' => esc_html__( 'Total number of related posts to show.', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'related_posts_count',
		'section'     => 'single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '1',
			'max' => '12',
			'step' => '1',
		),
		'priority'    => 180,
		'active_callback' => array(
			array(
				'setting'  => 'hide_related_posts',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// Pages Options
	Kirki::add_section( 'pages_options', array(
	    'title'          => esc_html__( 'Pages', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '150',
	) );

	Kirki::add_field( 'bosa-hotel',  array(
		'label'       => esc_html__( 'Page Title', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'disable_page_title',
		'section'     => 'pages_options',
		'default'     => 'disable_front_page',
		'choices'     => array(
			'disable_all_pages'   => esc_html__( 'Disable from all', 'bosa-hotel' ),
			'enable_all_pages'    => esc_html__( 'Enable in all', 'bosa-hotel' ),
			'disable_front_page'  => esc_html__( 'Disable from frontpage only', 'bosa-hotel' ),
		),
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-hotel',  array(
		'label'       => esc_html__( 'Page Title Position', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'page_title_position',
		'section'     => 'pages_options',
		'default'     => 'above_feature_image',
		'choices'     => array(
			'below_feature_image' => esc_html__( 'Below Feature Image', 'bosa-hotel' ),
			'above_feature_image' => esc_html__( 'Top of the Page', 'bosa-hotel' ),
		),
		'priority'    => 20,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_transparent_header_page',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );
	
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Feature Image', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'page_feature_image',
		'section'     => 'pages_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'bosa-hotel' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'bosa-hotel' ),
			'disable_in_frontpage' => esc_html__( 'Disable in Frontpage only', 'bosa-hotel' ),
			'show_in_frontpage'    => esc_html__( 'Show in Frontpage only', 'bosa-hotel' ),
		),
		'priority'    => 30,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'disable_transparent_header_page',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'header_two',
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_pages_image_size',
		'section'     => 'pages_options',
		'default'     => 'bosa-hotel-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'    => 40,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'page_feature_image',
					'operator' => 'contains',
					'value'    => array( 'show_in_all_pages', 'show_in_frontpage', 'disable_in_frontpage' ),
				),
				array(
					'setting'  => 'disable_transparent_header_page',
					'operator' => '==',
					'value'    => false,
				),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Transparent Header', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_transparent_header_page',
		'section'     => 'pages_options',
		'default'     => true,
		'priority'    => 50,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Transparent Header Banner Height (in px)', 'bosa-hotel' ),
		'type'        => 'slider',
		'settings'    => 'transparent_header_banner_page_height',
		'section'     => 'pages_options',
		'transport'   => 'postMessage',
		'default'     => 400,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'    => 60,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Transparent Header Banner Image Size', 'bosa-hotel' ),
		'type'         => 'radio',
		'settings'     => 'transparent_header_banner_page_size',
		'section'      => 'pages_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'bosa-hotel' ),
			'pattern'  => esc_html__( 'Pattern / Repeat', 'bosa-hotel' ),
			'norepeat' => esc_html__( 'No Repeat', 'bosa-hotel' ),
		),
		'priority'    => 70,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Transparent Header Banner Overlay Opacity', 'bosa-hotel' ),
		'type'        => 'number',
		'settings'    => 'transparent_header_banner_page_opacity',
		'section'     => 'pages_options',
		'default'     => 4,
		'choices' => array(
			'min' => '0',
			'max' => '9',
			'step' => '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'header_two',
			),
			array(
				'setting'  => 'disable_transparent_header_page',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// 404 Error Page
	Kirki::add_section( 'error404_options', array(
	    'title'          => esc_html__( '404 Page', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '160',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Image', 'bosa-hotel' ),
		'description' => esc_html__( 'Recommended image size 360x200 pixel.', 'bosa-hotel' ),
		'type'        => 'image',
		'settings'    => 'error404_image',
		'section'     => 'error404_options',
		'default'     => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'    => 10,
	) );
	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Choose Image Size', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'render_error404_image_size',
		'section'     => 'error404_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'bosa-hotel' ),
		'choices'     => bosa_hotel_get_intermediate_image_sizes(),
		'priority'    => 20,
	) );

	// Preloader Options
	Kirki::add_section( 'preloader_options', array(
	    'title'          => esc_html__( 'Preloader', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '170',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Disable Preloading', 'bosa-hotel' ),
		'type'        => 'checkbox',
		'settings'    => 'disable_preloader',
		'section'     => 'preloader_options',
		'default'     => false,
		'priority'    => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Preloading Animations', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'preloader_animation',
		'section'     => 'preloader_options',
		'default'     => 'animation_one',
		'choices'  => array(
			'animation_one'       => esc_html__( 'Animation One', 'bosa-hotel' ),
			'animation_two'       => esc_html__( 'Animation Two', 'bosa-hotel' ),
			'animation_three'     => esc_html__( 'Animation Three', 'bosa-hotel' ),
			'animation_four'      => esc_html__( 'Animation Four', 'bosa-hotel' ),
			'animation_five'      => esc_html__( 'Animation Five', 'bosa-hotel' ),
		),
		'priority'    => 20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Image Width', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'preloader_custom_image_width',
		'section'      => 'preloader_options',
		'transport'    => 'postMessage',
		'default'      => 40,
		'choices'      => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 30,
	) );


	// Breadcrumbs
	Kirki::add_section( 'breadcrumbs_options', array(
	    'title'          => esc_html__( 'Breadcrumbs', 'bosa-hotel' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => '180',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Breadcrumbs', 'bosa-hotel' ),
		'type'        => 'select',
		'settings'    => 'breadcrumbs_controls',
		'section'     => 'breadcrumbs_options',
		'default'     => 'show_in_all_page_post',
		'choices'  => array(
			'disable_in_all_pages'     => esc_html__( 'Disable in all Pages Only', 'bosa-hotel' ),
			'disable_in_all_page_post' => esc_html__( 'Disable in all Pages & Posts', 'bosa-hotel' ),
			'show_in_all_page_post'    => esc_html__( 'Show in all Pages & Posts', 'bosa-hotel' ),
		),
		'priority'    => 10,
	) );

	// WooCommerce

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'General / Style', 'bosa-hotel' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'woocommerce_product_catalog_tabs',
		'section'     => 'woocommerce_product_catalog',
		'default'     => 'product_catalog_general_tab',
		'choices'  => array(
			'product_catalog_general_tab'     => esc_html__( 'General', 'bosa-hotel' ),
			'product_catalog_style_tab'     => esc_html__( 'Style', 'bosa-hotel' ),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Shop Page Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_shop_page_title',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 10,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'product_card_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'bosa-hotel' ),
	    'priority'    => 20,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Product Layout Type', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_product_layout_type',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'product_layout_grid',
		'choices'		=> array(
			'product_layout_grid'		=> get_template_directory_uri() . '/assets/images/product-layout-type-one.png',
			'product_layout_list'		=> get_template_directory_uri() . '/assets/images/product-layout-type-two.png',
		),
		'priority'      => 30,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Product Card Layout', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_product_card_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'product_layout_one',
		'choices'		=> array(
			'product_layout_one'		=> get_template_directory_uri() . '/assets/images/product-card-layout-one.png',
			'product_layout_two'		=> get_template_directory_uri() . '/assets/images/product-card-layout-two.png',
		),
		'priority'      => 40,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Text Alignment', 'bosa-hotel' ),
		'type'			=> 'select',
		'settings'		=> 'woocommerce_product_card_text_alignment',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'text-center',
		'choices'		=> array(
			'text-left'		=> esc_html__( 'Left', 'bosa-hotel' ),
			'text-center'	=> esc_html__( 'Center', 'bosa-hotel' ),
			'text-right'	=> esc_html__( 'Right', 'bosa-hotel' ),
		),
		'priority'       => 50,
		'transport'		 => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Products Per Row', 'bosa-hotel' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'woocommerce_shop_product_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 3,
		'choices' => array(
			'min' => '1',
			'max' => '4',
			'step'=> '1',
		),
		'priority'     => 60,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_grid',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Products Per Row', 'bosa-hotel' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'woocommerce_shop_list_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 2,
		'choices' => array(
			'min' => '1',
			'max' => '3',
			'step'=> '1',
		),
		'priority'     => 70,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_list',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Product Display Per Page', 'bosa-hotel' ),
		'type'         => 'number',
		'settings'     => 'woocommerce_product_per_page',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 9,
		'choices' => array(
			'min' => '1',
			'max' => '60',
			'step'=> '1',
		),
		'priority'    => 80,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Rating', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_shop_page_rating',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 85,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'add_to_cart_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'bosa-hotel' ),
	    'priority'    => 90,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Add To Cart Button Layout', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_add_to_cart_button',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'cart_button_two',
		'choices'		=> array(
			'cart_button_one'		=> get_template_directory_uri() . '/assets/images/cart-button-one.png',
			'cart_button_two'		=> get_template_directory_uri() . '/assets/images/cart-button-two.png',
			'cart_button_three'		=> get_template_directory_uri() . '/assets/images/cart-button-three.png',
			'cart_button_four'		=> get_template_directory_uri() . '/assets/images/cart-button-four.png',
		),
		'priority'      => 100,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'icon_group_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Icon Group Options', 'bosa-hotel' ),
	    'priority'    => 110,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Icon Group Layout', 'bosa-hotel' ),
		'description'	=> esc_html__( 'Yith WooCommerce Compare, Wishlist and Quick View are grouped together. Install these plugins to use this option.', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'icon_group_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'group_layout_one',
		'choices'		=> array(
			'group_layout_one'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-one.png',
			'group_layout_two'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-two.png',
			'group_layout_three'	=> get_template_directory_uri() . '/assets/images/iconbox-layout-three.png',
			'group_layout_four'		=> get_template_directory_uri() . '/assets/images/iconbox-layout-four.png',
		),
		'priority'      => 120,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'sale_tag_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'bosa-hotel' ),
	    'priority'    => 130,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Sale Tag Layout', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_sale_tag_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'sale_tag_layout_one',
		'choices'		=> array(
			'sale_tag_layout_one'		=> get_template_directory_uri() . '/assets/images/product-badge-style-one.png',
			'sale_tag_layout_two'		=> get_template_directory_uri() . '/assets/images/product-badge-style-two.png',
		),
		'priority'      => 140,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '!=',
				'value'    => 'group_layout_four',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Sale Badge Text', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'woocommerce_sale_badge_text',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( 'Sale!', 'bosa-hotel' ),
		'priority'    => 150,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Enable Sale Badge Percentage', 'bosa-hotel' ),
		'description' => esc_html__( 'Replaces sale badge text with sale percent.', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'enable_sale_badge_percent',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'     => 160,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'       => esc_html__( 'Sale Badge Percentage Text', 'bosa-hotel' ),
		'description' => esc_html__( 'Input text to accompany with percentage {value} tag. Example: {value}% OFF!', 'bosa-hotel' ),
		'type'        => 'text',
		'settings'    => 'woocommerce_sale_badge_percent',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( '-{value}%', 'bosa-hotel' ),
		'priority'    => 170,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'enable_sale_badge_percent',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'product_card_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'bosa-hotel' ),
	    'priority'    => 210,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'			=> esc_html__( 'Product Card Style', 'bosa-hotel' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_product_card_style',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'card_style_one',
		'choices'		=> array(
			'card_style_one'		=> get_template_directory_uri() . '/assets/images/product-card-style-one.png',
			'card_style_two'		=> get_template_directory_uri() . '/assets/images/product-card-style-two.png',
			'card_style_three'		=> get_template_directory_uri() . '/assets/images/product-card-style-three.png',
		),
		'priority'    => 220,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Product Image Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'shop_product_image_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 230,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Product Card Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'shop_product_card_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'    => 240,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_product_card_style',
				'operator' => 'contains',
				'value'    => array( 'card_style_two', 'card_style_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'add_to_cart_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'bosa-hotel' ),
	    'priority'    => 250,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'add_to_cart_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'    => 260,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'add_to_cart_white_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 260,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'add_to_cart_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 270,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'add_to_cart_black_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'    => 270,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_three' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'cart_four_black_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#333333',
		'priority'     => 270,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'add_cart_button_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 280,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_two', 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Spacing', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'cart_four_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 10,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 290,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'icon_group_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Icon Group Options', 'bosa-hotel' ),
	    'priority'    => 300,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'icon_group_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 303,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'icon_group_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#383838',
		'priority'    => 305,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'icon_group_one_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 100,
		'choices'      => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_one',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'icon_group_two_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_two',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'icon_group_three_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_three',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'icon_group_four_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 100,
		'choices'      => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'priority'    => 310,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '==',
				'value'    => 'group_layout_four',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Icon Group Spacing', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'icon_group_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 10,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 320,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => 'contains',
				'value'    => array( 'group_layout_three', 'group_layout_four' ),
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
	    'type'        => 'custom',
	    'settings'    => 'sale_tag_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'bosa-hotel' ),
	    'priority'    => 330,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Sale Tag Background Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'sale_tag_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#C9A76E',
		'priority'    => 340,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Sale Tag Text Color', 'bosa-hotel' ),
		'type'         => 'color',
		'settings'     => 'sale_tag_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'    => 350,
		'active_callback' => array(
			array(
				'setting'  => 'skin_select',
				'operator' => 'contains',
				'value'    => array( 'default', 'blackwhite' ),
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Sale Button Border Radius', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'sale_button_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 360,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Sale Button Spacing', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'sale_button_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 8,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'    => 370,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Product Title Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_title_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Poppins',
			'variant'         => '400',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'text-transform'  => 'none',
			'line-height'     => '1.4',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '#030303',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce ul.products li.product .woocommerce-loop-product__title',
			),
		),
		'priority'    => 380,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Product Price Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_price_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Open Sans',
			'variant'         => '700',
			'font-style'      => 'normal',
			'font-size'       => '16px',
			'text-transform'  => 'none',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'color'			  => '#E4A853',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce ul.products li.product .price .amount',
			),
		),
		'priority'    => 390,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Add to Cart Button Typography', 'bosa-hotel' ),
		'type'         => 'typography',
		'settings'     => 'shop_cart_button_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Poppins',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '14px',
			'text-transform'  => 'none',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
		),
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.woocommerce .product-inner .button, .woocommerce .product-inner .added_to_cart',
			),
		),
		'priority'    => 400,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => '!=',
				'value'    => array( 'cart_button_four' ),
			),
		),
	) );

	Kirki::add_section( 'woocommerce_single_product', array(
	    'title'      => esc_html__( 'Single Products', 'bosa-hotel' ),
	    'panel'      => 'woocommerce',	   
	    'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Image Zoom / Magnification', 'bosa-hotel' ),
		'description'  => esc_html__( 'Every slider step changes 10% zoom to the previous zoom level. For example: 1.1 zoom level is now 110% zoom.', 'bosa-hotel' ),
		'type'         => 'slider',
		'settings'     => 'single_product_iamge_magnify',
		'section'      => 'woocommerce_single_product',
		'default'      => 1,
		'choices'      => array(
			'min'  => 0,
			'max'  => 3,
			'step' => 0.1,
		),
		'priority'     => 10,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Single Product Page Title', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_title',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'     => 20,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Breadcrumbs', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_breadcrumbs',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 30,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable SKU', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_sku',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 40,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Category', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_category',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 50,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Tags', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_tags',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 60,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Product Tabs', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_tabs',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 70,
	) );

	Kirki::add_field( 'bosa-hotel', array(
		'label'        => esc_html__( 'Disable Related Products', 'bosa-hotel' ),
		'type'         => 'checkbox',
		'settings'     => 'disable_single_product_related_products',
		'section'      => 'woocommerce_single_product',
		'default'      => false,
		'priority'     => 80,
	) );
}