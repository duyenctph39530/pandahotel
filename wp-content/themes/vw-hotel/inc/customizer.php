<?php
/**
 * VW Hotel Theme Customizer
 *
 * @package VW Hotel
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_hotel_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_hotel_custom_controls' );

function vw_hotel_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo .site-title a',
	 	'render_callback' => 'vw_hotel_customize_partial_blogname',
	));

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => 'p.site-description',
		'render_callback' => 'vw_hotel_customize_partial_blogdescription',
	));

	//add home page setting pannel
	$VWHotelParentPanel = new VW_Hotel_WP_Customize_Panel( $wp_customize, 'vw_hotel_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'vw-hotel' ),
		'priority' => 10,
	));

	$wp_customize->add_panel( $VWHotelParentPanel );

	$HomePageParentPanel = new VW_Hotel_WP_Customize_Panel( $wp_customize, 'vw_hotel_homepage_panel', array(
		'title' => __( 'Homepage Settings', 'vw-hotel' ),
		'panel' => 'vw_hotel_panel_id',
	));

	$wp_customize->add_panel( $HomePageParentPanel );

	//Menus Settings
	$wp_customize->add_section( 'vw_hotel_menu_section' , array(
    	'title' => __( 'Menus Settings', 'vw-hotel' ),
		'panel' => 'vw_hotel_homepage_panel'
	) );

	$wp_customize->add_setting('vw_hotel_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_navigation_menu_font_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-hotel'),
        'section' => 'vw_hotel_menu_section',
        'choices' => array(
        	'100' => __('100','vw-hotel'),
            '200' => __('200','vw-hotel'),
            '300' => __('300','vw-hotel'),
            '400' => __('400','vw-hotel'),
            '500' => __('500','vw-hotel'),
            '600' => __('600','vw-hotel'),
            '700' => __('700','vw-hotel'),
            '800' => __('800','vw-hotel'),
            '900' => __('900','vw-hotel'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('vw_hotel_menu_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menu Text Transform','vw-hotel'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-hotel'),
            'Capitalize' => __('Capitalize','vw-hotel'),
            'Lowercase' => __('Lowercase','vw-hotel'),
        ),
		'section'=> 'vw_hotel_menu_section',
	));

	$wp_customize->add_setting('vw_hotel_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_menus_item_style',array(
        'type' => 'select',
        'section' => 'vw_hotel_menu_section',
		'label' => __('Menu Item Hover Style','vw-hotel'),
		'choices' => array(
            'None' => __('None','vw-hotel'),
            'Zoom In' => __('Zoom In','vw-hotel'),
        ),
	) );

	$wp_customize->add_setting('vw_hotel_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-hotel'),
		'section'  => 'vw_hotel_menu_section',
	)));

	$wp_customize->add_setting('vw_hotel_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-hotel'),
		'section'  => 'vw_hotel_menu_section',
	)));

	$wp_customize->add_setting('vw_hotel_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-hotel'),
		'section'  => 'vw_hotel_menu_section',
	)));

	$wp_customize->add_setting('vw_hotel_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-hotel'),
		'section'  => 'vw_hotel_menu_section',
	)));

	//Slider
	$wp_customize->add_section( 'vw_hotel_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-hotel' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/wordpress-hotel-theme">GET PRO</a>','vw-hotel'),
		'priority'   => null,
		'panel' => 'vw_hotel_homepage_panel'
	) );

	$wp_customize->add_setting( 'vw_hotel_slider_hide_show',
       array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_slider_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Slider','vw-hotel' ),
      'section' => 'vw_hotel_slidersettings'
    )));

    $wp_customize->add_setting('vw_hotel_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	) );
	$wp_customize->add_control('vw_hotel_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-hotel'),
        'section' => 'vw_hotel_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-hotel'),
            'Advance slider' => __('Advance slider','vw-hotel'),
        ),
	));

	$wp_customize->add_setting('vw_hotel_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-hotel'),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_advance_slider'
	));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_hotel_slider_hide_show',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_slider_hide_show',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_hotel_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_hotel_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_hotel_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-hotel' ),
			'description' => __('Slider image size (1500 x 665)','vw-hotel'),
			'section'  => 'vw_hotel_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_hotel_default_slider'
		) );
	}

	$wp_customize->add_setting( 'vw_hotel_slider_small_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'vw_hotel_slider_small_title', array(
		'label'    => __( 'Add Slider Small Text', 'vw-hotel' ),
		'input_attrs' => array(
            'placeholder' => __( 'Lorem Ipsum is simply dummy', 'vw-hotel' ),
        ),
		'section'  => 'vw_hotel_slidersettings',
		'type'     => 'text',
		'active_callback' => 'vw_hotel_default_slider'
	) );

	$wp_customize->add_setting('vw_hotel_slider_button_text',array(
		'default'=> 'READ MORE',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-hotel'),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_default_slider'
	));

	$wp_customize->add_setting('vw_hotel_slider_btn_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_hotel_slider_btn_link',array(
		'label'	=> esc_html__('Add Button Link','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'www.example-info.com', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'url'
	));

	//content layout
	$wp_customize->add_setting('vw_hotel_slider_content_option',array(
        'default' => 'Center',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Hotel_Image_Radio_Control($wp_customize, 'vw_hotel_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-hotel'),
        'section' => 'vw_hotel_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/slider-content3.png',
    ),'active_callback' => 'vw_hotel_default_slider'
    )));

    //Slider content padding
    $wp_customize->add_setting('vw_hotel_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','vw-hotel'),
		'description'	=> __('Enter a value in %. Example:20%','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_default_slider'
	));

	$wp_customize->add_setting('vw_hotel_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','vw-hotel'),
		'description'	=> __('Enter a value in %. Example:20%','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_default_slider'
	));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_hotel_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-hotel' ),
		'section'     => 'vw_hotel_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_hotel_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),'active_callback' => 'vw_hotel_default_slider'
	) );

	//Slider height
	$wp_customize->add_setting('vw_hotel_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_slider_height',array(
		'label'	=> __('Slider Height','vw-hotel'),
		'description'	=> __('Specify the slider height (px).','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_default_slider'
	));

	$wp_customize->add_setting( 'vw_hotel_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'vw_hotel_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_hotel_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-hotel'),
		'section' => 'vw_hotel_slidersettings',
		'type'  => 'number',
		'active_callback' => 'vw_hotel_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('vw_hotel_slider_opacity_color',array(
      'default'              => 0.7,
      'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_hotel_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-hotel' ),
	'section'     => 'vw_hotel_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_hotel_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-hotel'),
      '0.1' =>  esc_attr('0.1','vw-hotel'),
      '0.2' =>  esc_attr('0.2','vw-hotel'),
      '0.3' =>  esc_attr('0.3','vw-hotel'),
      '0.4' =>  esc_attr('0.4','vw-hotel'),
      '0.5' =>  esc_attr('0.5','vw-hotel'),
      '0.6' =>  esc_attr('0.6','vw-hotel'),
      '0.7' =>  esc_attr('0.7','vw-hotel'),
      '0.8' =>  esc_attr('0.8','vw-hotel'),
      '0.9' =>  esc_attr('0.9','vw-hotel')
	),'active_callback' => 'vw_hotel_default_slider'
	));

	$wp_customize->add_setting( 'vw_hotel_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_hotel_switch_sanitization'
   ));
   $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_slider_image_overlay',array(
      	'label' => esc_html__( 'Show / Hide Slider Image Overlay','vw-hotel' ),
      	'section' => 'vw_hotel_slidersettings',
      	'active_callback' => 'vw_hotel_default_slider'
   )));

   $wp_customize->add_setting('vw_hotel_slider_image_overlay_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-hotel'),
		'section'  => 'vw_hotel_slidersettings',
		'active_callback' => 'vw_hotel_default_slider'
	)));

	// About
	$wp_customize->add_section('vw_hotel_aboutus_section',array(
		'title'	=> __('About Section','vw-hotel'),
		'description' => __('For more options of about section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/wordpress-hotel-theme">GET PRO</a>','vw-hotel'),
		'panel' => 'vw_hotel_homepage_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_hotel_section_title', array(
		'selector' => '#about-hotel h3 a',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_section_title',
	));

	$wp_customize->add_setting('vw_hotel_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_section_title',array(
		'label'	=> __('Section Title','vw-hotel'),
		'section'=> 'vw_hotel_aboutus_section',
		'setting'=> 'vw_hotel_section_title',
		'type'=> 'text'
	));

	for ( $count = 1; $count <= 1; $count++ ) {
		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_hotel_about_section' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_hotel_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_hotel_about_section' . $count, array(
			'label'    => __( 'Select Page', 'vw-hotel' ),
			'section'  => 'vw_hotel_aboutus_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$pst[]='Select';
	foreach($post_list as $post){
		$pst[$post->post_title] = $post->post_title;
	}
	$wp_customize->add_setting('vw_hotel_offer_image',array(
		'sanitize_callback' => 'vw_hotel_sanitize_choices',
	));
	$wp_customize->add_control('vw_hotel_offer_image',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','vw-hotel'),
		'description' => __('Image size (350 x 400)','vw-hotel'),
		'section' => 'vw_hotel_aboutus_section',
	));

	$wp_customize->add_setting('vw_hotel_about_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_about_button_text',array(
		'label'	=> __('Add About Button Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'LEARN MORE', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_aboutus_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_hotel_service_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_hotel_sanitize_choices',
	));
	$wp_customize->add_control('vw_hotel_service_category',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Services','vw-hotel'),
		'description' => __('Image size (60 x 60)','vw-hotel'),
		'section' => 'vw_hotel_aboutus_section',
	));

	//About excerpt
	$wp_customize->add_setting( 'vw_hotel_about_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_about_excerpt_number', array(
		'label'       => esc_html__( 'About Excerpt length','vw-hotel' ),
		'section'     => 'vw_hotel_aboutus_section',
		'type'        => 'range',
		'settings'    => 'vw_hotel_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Hotel Room Section
	$wp_customize->add_section('vw_hotel_hotel_room', array(
		'title'       => __('Hotel Room Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_hotel_room_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_hotel_room_text',array(
		'description' => __('<p>1. More options for hotel room section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for hotel room section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_hotel_room',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_hotel_room_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_hotel_room_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_hotel_room',
		'type'=> 'hidden'
	));

	//services Section
	$wp_customize->add_section('vw_hotel_services', array(
		'title'       => __('Services Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_services_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_services_text',array(
		'description' => __('<p>1. More options for services section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for services section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_services',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_services_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_services_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_services',
		'type'=> 'hidden'
	));

	// gallery Section
	$wp_customize->add_section('vw_hotel_gallery', array(
		'title'       => __('Gallery Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_gallery_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_gallery_text',array(
		'description' => __('<p>1. More options for gallery section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for gallery section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_gallery',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_gallery_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_gallery_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_gallery',
		'type'=> 'hidden'
	));

	//product Section
	$wp_customize->add_section('vw_hotel_product', array(
		'title'       => __('Product Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_product_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_product_text',array(
		'description' => __('<p>1. More options for product section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for product section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_product',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_product_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_product_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_product',
		'type'=> 'hidden'
	));

	//records Section
	$wp_customize->add_section('vw_hotel_records', array(
		'title'       => __('Records Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_records_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_records_text',array(
		'description' => __('<p>1. More options for records section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for records section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_records',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_records_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_records_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_records',
		'type'=> 'hidden'
	));

	//team Section
	$wp_customize->add_section('vw_hotel_team', array(
		'title'       => __('Team Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_team_text',array(
		'description' => __('<p>1. More options for team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for team section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_team',
		'type'=> 'hidden'
	));

	//video Section
	$wp_customize->add_section('vw_hotel_video', array(
		'title'       => __('Video Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_video_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_video_text',array(
		'description' => __('<p>1. More options for video section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for video section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_video',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_video_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_video_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_video',
		'type'=> 'hidden'
	));

	//testimonials Section
	$wp_customize->add_section('vw_hotel_testimonials', array(
		'title'       => __('Testimonials Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_testimonials_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_testimonials_text',array(
		'description' => __('<p>1. More options for testimonials section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for testimonials section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_testimonials',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_testimonials_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_testimonials_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_testimonials',
		'type'=> 'hidden'
	));

	//latest post Section
	$wp_customize->add_section('vw_hotel_latest_post', array(
		'title'       => __('Latest Post Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_latest_post_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_latest_post_text',array(
		'description' => __('<p>1. More options for latest post section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for latest post section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_latest_post',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_latest_post_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_latest_post_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_latest_post',
		'type'=> 'hidden'
	));

	//newsletter Section
	$wp_customize->add_section('vw_hotel_newsletter', array(
		'title'       => __('Newsletter Section', 'vw-hotel'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-hotel'),
		'priority'    => null,
		'panel'       => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting('vw_hotel_newsletter_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_newsletter_text',array(
		'description' => __('<p>1. More options for newsletter section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for newsletter section.</p>','vw-hotel'),
		'section'=> 'vw_hotel_newsletter',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_hotel_newsletter_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_newsletter_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='". admin_url('themes.php?page=vw_hotel_guide') ." '>More Info</a>",
		'section'=> 'vw_hotel_newsletter',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_hotel_footer',array(
		'title'	=> __('Footer','vw-hotel'),
		'description' => __('For more options of footer section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/wordpress-hotel-theme">GET PRO</a>','vw-hotel'),
		'panel' => 'vw_hotel_homepage_panel',
	));

	$wp_customize->add_setting( 'vw_hotel_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','vw-hotel' ),
      'section' => 'vw_hotel_footer'
    )));

   	// font size
	$wp_customize->add_setting('vw_hotel_button_footer_font_size',array(
		'default'=> 30,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_footer_font_size',array(
		'label'	=> __('Footer Heading Font Size','vw-hotel'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_hotel_footer',
	));

	$wp_customize->add_setting('vw_hotel_button_footer_heading_letter_spacing',array(
		'default'=> 1,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_footer_heading_letter_spacing',array(
		'label'	=> __('Heading Letter Spacing','vw-hotel'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'vw_hotel_footer',
	));

	// text trasform
	$wp_customize->add_setting('vw_hotel_button_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_button_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','vw-hotel'),
		'choices' => array(
      'Uppercase' => __('Uppercase','vw-hotel'),
      'Capitalize' => __('Capitalize','vw-hotel'),
      'Lowercase' => __('Lowercase','vw-hotel'),
    ),
		'section'=> 'vw_hotel_footer',
	));

	$wp_customize->add_setting('vw_hotel_footer_heading_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_footer_heading_weight',array(
        'type' => 'select',
        'label' => __('Heading Font Weight','vw-hotel'),
        'section' => 'vw_hotel_footer',
        'choices' => array(
        	'100' => __('100','vw-hotel'),
            '200' => __('200','vw-hotel'),
            '300' => __('300','vw-hotel'),
            '400' => __('400','vw-hotel'),
            '500' => __('500','vw-hotel'),
            '600' => __('600','vw-hotel'),
            '700' => __('700','vw-hotel'),
            '800' => __('800','vw-hotel'),
            '900' => __('900','vw-hotel'),
        ),
	) );

	$wp_customize->add_setting('vw_hotel_footer_template',array(
	  'default'	=> esc_html('vw_hotel-footer-one'),
	  'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_footer_template',array(
	      'label'	=> esc_html__('Footer style','vw-hotel'),
	      'section'	=> 'vw_hotel_footer',
	      'setting'	=> 'vw_hotel_footer_template',
	      'type' => 'select',
	      'choices' => array(
	          'vw_hotel-footer-one' => esc_html__('Style 1', 'vw-hotel'),
	          'vw_hotel-footer-two' => esc_html__('Style 2', 'vw-hotel'),
	          'vw_hotel-footer-three' => esc_html__('Style 3', 'vw-hotel'),
	          'vw_hotel-footer-four' => esc_html__('Style 4', 'vw-hotel'),
	          'vw_hotel-footer-five' => esc_html__('Style 5', 'vw-hotel'),
	          )
	));

	$wp_customize->add_setting('vw_hotel_footer_background_color', array(
		'default'           => '#212121',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-hotel'),
		'section'  => 'vw_hotel_footer',
	)));

	$wp_customize->add_setting('vw_hotel_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_hotel_footer_background_image',array(
        'label' => __('Footer Background Image','vw-hotel'),
        'section' => 'vw_hotel_footer'
	)));
	 
	$wp_customize->add_setting('vw_hotel_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','vw-hotel'),
		'section' => 'vw_hotel_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-hotel' ),
			'center top'   => esc_html__( 'Top', 'vw-hotel' ),
			'right top'   => esc_html__( 'Top Right', 'vw-hotel' ),
			'left center'   => esc_html__( 'Left', 'vw-hotel' ),
			'center center'   => esc_html__( 'Center', 'vw-hotel' ),
			'right center'   => esc_html__( 'Right', 'vw-hotel' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-hotel' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-hotel' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-hotel' ),
		),
	));

	// Footer
	$wp_customize->add_setting('vw_hotel_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','vw-hotel'),
		'choices' => array(
            'fixed' => __('fixed','vw-hotel'),
            'scroll' => __('scroll','vw-hotel'),
        ),
		'section'=> 'vw_hotel_footer',
	));

	$wp_customize->add_setting('vw_hotel_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-hotel'),
        'section' => 'vw_hotel_footer',
        'choices' => array(
        	'Left' => __('Left','vw-hotel'),
            'Center' => __('Center','vw-hotel'),
            'Right' => __('Right','vw-hotel')
        ),
	) );

	$wp_customize->add_setting('vw_hotel_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-hotel'),
        'section' => 'vw_hotel_footer',
        'choices' => array(
        	'Left' => __('Left','vw-hotel'),
            'Center' => __('Center','vw-hotel'),
            'Right' => __('Right','vw-hotel')
        ),
	) );

	// footer padding
	$wp_customize->add_setting('vw_hotel_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-hotel' ),
    ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

     // footer social icon
  	$wp_customize->add_setting( 'vw_hotel_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_footer_icon',array(
		'label' => esc_html__( 'Show / Hide Footer Social Icon','vw-hotel' ),
		'section' => 'vw_hotel_footer'
    )));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_hotel_footer_text', array(
		'selector' => '.copyright p',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_footer_text',
	));

	$wp_customize->add_setting( 'vw_hotel_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','vw-hotel' ),
      'section' => 'vw_hotel_footer'
    )));

	$wp_customize->add_setting('vw_hotel_copyright_background_color', array(
		'default'           => '#f1b64a',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'vw-hotel'),
		'section'  => 'vw_hotel_footer',
	)));

	$wp_customize->add_setting('vw_hotel_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_footer_text',array(
		'label'	=> __('Copyright Text','vw-hotel'),
		'section'=> 'vw_hotel_footer',
		'setting'=> 'vw_hotel_footer_text',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_copyright_alignment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Hotel_Image_Radio_Control($wp_customize, 'vw_hotel_copyright_alignment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-hotel'),
        'section' => 'vw_hotel_footer',
        'settings' => 'vw_hotel_copyright_alignment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/images/copyright3.png'
    ))));

	$wp_customize->add_setting( 'vw_hotel_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-hotel' ),
      	'section' => 'vw_hotel_footer'
    )));

     //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_hotel_scroll_top_icon', array(
		'selector' => '.scrollup i',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_scroll_top_icon',
	));

    $wp_customize->add_setting('vw_hotel_scroll_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_scroll_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_footer',
		'setting'	=> 'vw_hotel_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_hotel_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-hotel'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_hotel_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Hotel_Image_Radio_Control($wp_customize, 'vw_hotel_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-hotel'),
        'section' => 'vw_hotel_footer',
        'settings' => 'vw_hotel_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/layout3.png'
    ))));

	//Blog Post
	$wp_customize->add_panel( $VWHotelParentPanel );

	$BlogPostParentPanel = new VW_Hotel_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-hotel' ),
		'panel' => 'vw_hotel_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_hotel_post_settings', array(
		'title' => __( 'Post Settings', 'vw-hotel' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Blog layout
    $wp_customize->add_setting('vw_hotel_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Hotel_Image_Radio_Control($wp_customize, 'vw_hotel_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-hotel'),
        'section' => 'vw_hotel_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/images/blog-layout3.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_hotel_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	) );
	$wp_customize->add_control('vw_hotel_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-hotel'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-hotel'),
        'section' => 'vw_hotel_post_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-hotel'),
            'Right Sidebar' => __('Right Sidebar','vw-hotel'),
            'One Column' => __('One Column','vw-hotel'),
            'Three Columns' => __('Three Columns','vw-hotel'),
            'Four Columns' => __('Four Columns','vw-hotel'),
            'Grid Layout' => __('Grid Layout','vw-hotel')
        ),
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_hotel_toggle_postdate', array(
		'selector' => '.post-main-box h2 a',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_toggle_postdate',
	));

  	$wp_customize->add_setting('vw_hotel_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_post_settings',
		'setting'	=> 'vw_hotel_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_hotel_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_toggle_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-hotel' ),
        'section' => 'vw_hotel_post_settings'
    )));

	$wp_customize->add_setting('vw_hotel_toggle_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_post_settings',
		'setting'	=> 'vw_hotel_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-hotel' ),
		'section' => 'vw_hotel_post_settings'
    )));

    $wp_customize->add_setting('vw_hotel_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_post_settings',
		'setting'	=> 'vw_hotel_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-hotel' ),
		'section' => 'vw_hotel_post_settings'
    )));

  	$wp_customize->add_setting('vw_hotel_toggle_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_post_settings',
		'setting'	=> 'vw_hotel_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','vw-hotel' ),
		'section' => 'vw_hotel_post_settings'
    )));

    $wp_customize->add_setting( 'vw_hotel_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-hotel' ),
		'section' => 'vw_hotel_post_settings'
    )));

    $wp_customize->add_setting( 'vw_hotel_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_hotel_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-hotel' ),
		'section'     => 'vw_hotel_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('vw_hotel_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
  	$wp_customize->add_control('vw_hotel_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','vw-hotel'),
		'section'	=> 'vw_hotel_post_settings',
		'choices' => array(
		'default' => __('Default','vw-hotel'),
		'custom' => __('Custom Image Size','vw-hotel'),
      ),
  	));

	$wp_customize->add_setting('vw_hotel_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_hotel_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-hotel' ),),
		'section'=> 'vw_hotel_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_hotel_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'vw-hotel' ),),
		'section'=> 'vw_hotel_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_hotel_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'vw_hotel_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-hotel' ),
		'section'     => 'vw_hotel_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_hotel_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_hotel_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-hotel'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-hotel'),
		'section'=> 'vw_hotel_post_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_hotel_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Posts','vw-hotel'),
        'section' => 'vw_hotel_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-hotel'),
            'Without Blocks' => __('Without Blocks','vw-hotel')
        ),
	) );

    $wp_customize->add_setting('vw_hotel_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-hotel'),
        'section' => 'vw_hotel_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-hotel'),
            'Excerpt' => __('Excerpt','vw-hotel'),
            'No Content' => __('No Content','vw-hotel')
        ),
	) );

	$wp_customize->add_setting('vw_hotel_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-hotel' ),
      'section' => 'vw_hotel_post_settings'
    )));

	$wp_customize->add_setting( 'vw_hotel_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_hotel_blog_pagination_type', array(
        'section' => 'vw_hotel_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-hotel' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-hotel' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-hotel' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_hotel_button_settings', array(
		'title' => __( 'Button Settings', 'vw-hotel' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_hotel_button_text', array(
		'selector' => '.post-main-box .content-bttn a',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_button_text',
	));

	$wp_customize->add_setting('vw_hotel_button_text',array(
		'default'=> esc_html__( 'Read More', 'vw-hotel' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_text',array(
		'label'	=> __('Add Button Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('vw_hotel_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_font_size',array(
		'label'	=> __('Button Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-hotel' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_hotel_button_settings',
	));

	$wp_customize->add_setting( 'vw_hotel_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_hotel_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-hotel' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_hotel_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('vw_hotel_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-hotel'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-hotel'),
            'Capitalize' => __('Capitalize','vw-hotel'),
            'Lowercase' => __('Lowercase','vw-hotel'),
        ),
		'section'=> 'vw_hotel_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_hotel_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-hotel' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_hotel_related_post_title', array(
		'selector' => '.related-post h3',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_related_post_title',
	));

    $wp_customize->add_setting( 'vw_hotel_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_related_post',array(
		'label' => esc_html__( 'Show / Hide Related Post','vw-hotel' ),
		'section' => 'vw_hotel_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_hotel_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_hotel_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'vw_hotel_sanitize_float'
	));
	$wp_customize->add_control('vw_hotel_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_hotel_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-hotel' ),
		'section'     => 'vw_hotel_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_hotel_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	// Single Posts Settings
	$wp_customize->add_section( 'vw_hotel_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-hotel' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_hotel_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_single_blog_settings',
		'setting'	=> 'vw_hotel_single_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_hotel_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_hotel_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_postdate',array(
	    'label' => esc_html__( 'Show / Hide Date','vw-hotel' ),
	   'section' => 'vw_hotel_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_hotel_single_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_single_author_icon',array(
		'label'	=> __('Add Author Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_single_blog_settings',
		'setting'	=> 'vw_hotel_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_hotel_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','vw-hotel' ),
	    'section' => 'vw_hotel_single_blog_settings'
	)));

   	$wp_customize->add_setting('vw_hotel_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_single_blog_settings',
		'setting'	=> 'vw_hotel_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_hotel_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_hotel_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','vw-hotel' ),
	    'section' => 'vw_hotel_single_blog_settings'
	)));

  	$wp_customize->add_setting('vw_hotel_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_single_time_icon',array(
		'label'	=> __('Add Time Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_single_blog_settings',
		'setting'	=> 'vw_hotel_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_hotel_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_hotel_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','vw-hotel' ),
	    'section' => 'vw_hotel_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_hotel_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-hotel'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-hotel'),
		'section'=> 'vw_hotel_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','vw-hotel' ),
		'section' => 'vw_hotel_single_blog_settings'
    )));

   	$wp_customize->add_setting( 'vw_hotel_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Breadcrumb','vw-hotel' ),
		'section' => 'vw_hotel_single_blog_settings'
    )));

    // Single Posts Category
  	$wp_customize->add_setting( 'vw_hotel_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_post_category',array(
		'label' => esc_html__( 'Single Post Category','vw-hotel' ),
		'section' => 'vw_hotel_single_blog_settings'
    )));

	$wp_customize->add_setting( 'vw_hotel_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Show / Hide Post Navigation','vw-hotel' ),
		'section' => 'vw_hotel_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('vw_hotel_single_blog_prev_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_single_blog_next_navigation_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_single_blog_comment_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_single_blog_comment_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_single_blog_settings',
		'type'=> 'text'
	));

	 // Grid layout setting
	$wp_customize->add_section( 'vw_hotel_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-hotel' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_hotel_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_grid_layout_settings',
		'setting'	=> 'vw_hotel_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_hotel_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_grid_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-hotel' ),
        'section' => 'vw_hotel_grid_layout_settings'
    )));

	$wp_customize->add_setting('vw_hotel_grid_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_grid_author_icon',array(
		'label'	=> __('Add Author Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_grid_layout_settings',
		'setting'	=> 'vw_hotel_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-hotel' ),
		'section' => 'vw_hotel_grid_layout_settings'
    )));

   	$wp_customize->add_setting('vw_hotel_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_grid_layout_settings',
		'setting'	=> 'vw_hotel_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_hotel_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-hotel' ),
		'section' => 'vw_hotel_grid_layout_settings'
    )));

 	$wp_customize->add_setting('vw_hotel_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-hotel'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-hotel'),
		'section'=> 'vw_hotel_grid_layout_settings',
		'type'=> 'text'
	));  

  	$wp_customize->add_setting('vw_hotel_display_grid_posts_settings',array(
	    'default' => 'Into Blocks',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_display_grid_posts_settings',array(
	    'type' => 'select',
	    'label' => __('Display Grid Posts','vw-hotel'),
	    'section' => 'vw_hotel_grid_layout_settings',
	    'choices' => array(
	    	'Into Blocks' => __('Into Blocks','vw-hotel'),
	      	'Without Blocks' => __('Without Blocks','vw-hotel')
	    ),
	) );

	$wp_customize->add_setting('vw_hotel_grid_button_text',array(
		'default'=> esc_html__('Read More','vw-hotel'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-hotel'),
		'input_attrs' => array(
        'placeholder' => esc_html__( 'Read More', 'vw-hotel' ),
      ),
		'section'=> 'vw_hotel_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_grid_button_text',array(
		'default'=> esc_html__('Read More','vw-hotel'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-hotel'),
		'input_attrs' => array(
        'placeholder' => esc_html__( 'Read More', 'vw-hotel' ),
      ),
		'section'=> 'vw_hotel_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_grid_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_grid_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Grid Post Content','vw-hotel'),
        'section' => 'vw_hotel_grid_layout_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','vw-hotel'),
            'Excerpt' => esc_html__('Excerpt','vw-hotel'),
            'No Content' => esc_html__('No Content','vw-hotel')
        ),
	) );

   	// other settings
	$OtherParentPanel = new VW_Hotel_WP_Customize_Panel( $wp_customize, 'vw_hotel_other_panel_id', array(
		'title' => __( 'Others Settings', 'vw-hotel' ),
		'panel' => 'vw_hotel_panel_id',
	));

	$wp_customize->add_panel( $OtherParentPanel );

	$wp_customize->add_section( 'vw_hotel_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'vw-hotel' ),
		'panel' => 'vw_hotel_other_panel_id'
	) );

   	// Header Background color
	$wp_customize->add_setting('vw_hotel_header_background_color', array(
		'default'           => '#212121',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_header_background_color', array(
		'label'    => __('Header Background Color', 'vw-hotel'),
		'section'  => 'header_image',
	)));

	$wp_customize->add_setting('vw_hotel_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','vw-hotel'),
		'section' => 'header_image',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-hotel' ),
			'center top'   => esc_html__( 'Top', 'vw-hotel' ),
			'right top'   => esc_html__( 'Top Right', 'vw-hotel' ),
			'left center'   => esc_html__( 'Left', 'vw-hotel' ),
			'center center'   => esc_html__( 'Center', 'vw-hotel' ),
			'right center'   => esc_html__( 'Right', 'vw-hotel' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-hotel' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-hotel' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-hotel' ),
		),
	));

	$wp_customize->add_setting('vw_hotel_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Hotel_Image_Radio_Control($wp_customize, 'vw_hotel_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-hotel'),
        'description' => __('Here you can change the width layout of Website.','vw-hotel'),
        'section' => 'vw_hotel_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_hotel_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-hotel'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-hotel'),
        'section' => 'vw_hotel_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-hotel'),
            'Right Sidebar' => __('Right Sidebar','vw-hotel'),
            'One Column' => __('One Column','vw-hotel')
        ),
	) );

	//Sticky Header
	$wp_customize->add_setting( 'vw_hotel_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_sticky_header',array(
        'label' => esc_html__( 'Show / Hide Sticky Header','vw-hotel' ),
        'section' => 'vw_hotel_left_right'
    )));

    $wp_customize->add_setting('vw_hotel_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_left_right',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_search_hide_show', array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_search_hide_show',
       array(
		'label' => esc_html__( 'Show / Hide Search','vw-hotel' ),
		'section' => 'vw_hotel_left_right'
    )));

    $wp_customize->add_setting('vw_hotel_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_search_icon',array(
		'label'	=> __('Add Search Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_left_right',
		'setting'	=> 'vw_hotel_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_hotel_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_left_right',
		'setting'	=> 'vw_hotel_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('vw_hotel_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_search_font_size',array(
		'label'	=> __('Search Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_left_right',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_search_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_search_padding_top_bottom',array(
		'label'	=> __('Search Padding Top Bottom','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_left_right',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_search_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_search_padding_left_right',array(
		'label'	=> __('Search Padding Left Right','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_left_right',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_search_border_radius', array(
		'default'              => "",
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_search_border_radius', array(
		'label'       => esc_html__( 'Search Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_left_right',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_hotel_single_page_breadcrumb',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_single_page_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','vw-hotel' ),
		'section' => 'vw_hotel_left_right'
    )));

	//Wow Animation
	$wp_customize->add_setting( 'vw_hotel_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_animation',array(
        'label' => esc_html__( 'Show / Hide Animations','vw-hotel' ),
        'description' => __('Here you can disable overall site animation effect','vw-hotel'),
        'section' => 'vw_hotel_left_right'
    )));

    $wp_customize->add_setting('vw_hotel_reset_all_settings',array(
      'sanitize_callback'	=> 'sanitize_text_field',
   	));
   	$wp_customize->add_control(new VW_Hotel_Reset_Custom_Control($wp_customize, 'vw_hotel_reset_all_settings',array(
      'type' => 'reset_control',
      'label' => __('Reset All Settings', 'vw-hotel'),
      'description' => 'vw_hotel_reset_all_settings',
      'section' => 'vw_hotel_left_right'
   	)));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_hotel_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_loader_enable',array(
        'label' => esc_html__( 'Show / Hide Pre-Loader','vw-hotel' ),
        'section' => 'vw_hotel_left_right'
    )));

	$wp_customize->add_setting('vw_hotel_preloader_bg_color', array(
		'default'           => '#f1b64a',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-hotel'),
		'section'  => 'vw_hotel_left_right',
	)));

	$wp_customize->add_setting('vw_hotel_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-hotel'),
		'section'  => 'vw_hotel_left_right',
	)));

	$wp_customize->add_setting('vw_hotel_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_hotel_preloader_bg_img',array(
        'label' => __('Preloader Background Image','vw-hotel'),
        'section' => 'vw_hotel_left_right'
	)));

    //404 Page Setting
	$wp_customize->add_section('vw_hotel_404_page',array(
		'title'	=> __('404 Page Settings','vw-hotel'),
		'panel' => 'vw_hotel_other_panel_id',
	));

	$wp_customize->add_setting('vw_hotel_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_404_page_title',array(
		'label'	=> __('Add Title','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_404_page_content',array(
		'label'	=> __('Add Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('vw_hotel_no_results_page',array(
		'title'	=> __('No Results Page Settings','vw-hotel'),
		'panel' => 'vw_hotel_other_panel_id',
	));

	$wp_customize->add_setting('vw_hotel_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_no_results_page_title',array(
		'label'	=> __('Add Title','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_hotel_no_results_page_content',array(
		'label'	=> __('Add Text','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_hotel_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-hotel'),
		'panel' => 'vw_hotel_other_panel_id',
	));

	$wp_customize->add_setting('vw_hotel_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_social_icon_width',array(
		'label'	=> __('Icon Width','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_social_icon_height',array(
		'label'	=> __('Icon Height','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_hotel_responsive_media',array(
		'title'	=> __('Responsive Media','vw-hotel'),
		'panel' => 'vw_hotel_other_panel_id',
	));

    $wp_customize->add_setting( 'vw_hotel_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_stickyheader_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sticky Header','vw-hotel' ),
      'section' => 'vw_hotel_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_hotel_resp_slider_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-hotel' ),
      'section' => 'vw_hotel_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_hotel_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-hotel' ),
      'section' => 'vw_hotel_responsive_media'
    )));

  	$wp_customize->add_setting( 'vw_hotel_responsive_preloader_hide',array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_responsive_preloader_hide',array(
        'label' => esc_html__( 'Show / Hide Preloader','vw-hotel' ),
        'section' => 'vw_hotel_responsive_media'
    )));
    
    $wp_customize->add_setting( 'vw_hotel_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-hotel' ),
      'section' => 'vw_hotel_responsive_media'
    )));

    $wp_customize->add_setting('vw_hotel_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_hotel_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'vw-hotel'),
		'section'  => 'vw_hotel_responsive_media',
	)));

    $wp_customize->add_setting('vw_hotel_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_responsive_media',
		'setting'	=> 'vw_hotel_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_hotel_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_Hotel_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_hotel_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-hotel'),
		'transport' => 'refresh',
		'section'	=> 'vw_hotel_responsive_media',
		'setting'	=> 'vw_hotel_res_close_menus_icon',
		'type'		=> 'icon'
	)));


    //Woocommerce settings
	$wp_customize->add_section('vw_hotel_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-hotel'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'vw_hotel_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_hotel_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_hotel_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product .sidebar',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_woocommerce_shop_page_sidebar', ) );

	//Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_hotel_woocommerce_shop_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Shop Page Sidebar','vw-hotel' ),
		'section' => 'vw_hotel_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_hotel_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-hotel'),
        'section' => 'vw_hotel_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-hotel'),
            'Right Sidebar' => __('Right Sidebar','vw-hotel'),
        ),
	) );

     //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_hotel_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product .sidebar',
		'render_callback' => 'vw_hotel_customize_partial_vw_hotel_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_hotel_woocommerce_single_product_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Single Product Sidebar','vw-hotel' ),
		'section' => 'vw_hotel_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_hotel_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-hotel'),
        'section' => 'vw_hotel_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-hotel'),
            'Right Sidebar' => __('Right Sidebar','vw-hotel'),
        ),
	) );

    //Products per page
    $wp_customize->add_setting('vw_hotel_products_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'vw_hotel_sanitize_float'
	));
	$wp_customize->add_control('vw_hotel_products_per_page',array(
		'label'	=> __('Products Per Page','vw-hotel'),
		'description' => __('Display on shop page','vw-hotel'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_hotel_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_hotel_products_per_row',array(
		'default'=> 3,
		'sanitize_callback'	=> 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_products_per_row',array(
		'label'	=> __('Products Per Row','vw-hotel'),
		'description' => __('Display on shop page','vw-hotel'),
		'choices' => array(
            2 => 2,
			3 => 3,
			4 => 4,
        ),
		'section'=> 'vw_hotel_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_hotel_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_hotel_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_hotel_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_hotel_products_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_hotel_products_button_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products Sale Badge
	$wp_customize->add_setting('vw_hotel_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'vw_hotel_sanitize_choices'
	));
	$wp_customize->add_control('vw_hotel_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-hotel'),
        'section' => 'vw_hotel_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-hotel'),
            'right' => __('Right','vw-hotel'),
        ),
	) );

	$wp_customize->add_setting('vw_hotel_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_hotel_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-hotel'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-hotel'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-hotel' ),
        ),
		'section'=> 'vw_hotel_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_hotel_woocommerce_sale_border_radius', array(
		'default'              => '100',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_hotel_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_hotel_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','vw-hotel' ),
		'section'     => 'vw_hotel_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

  	// Related Product
    $wp_customize->add_setting( 'vw_hotel_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_hotel_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Hotel_Toggle_Switch_Custom_Control( $wp_customize, 'vw_hotel_related_product_show_hide',array(
        'label' => esc_html__( 'Show / Hide Related product','vw-hotel' ),
        'section' => 'vw_hotel_woocommerce_section'
    )));


    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Hotel_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Hotel_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_hotel_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Hotel_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_hotel_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Hotel_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_hotel_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_hotel_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_hotel_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Hotel_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Hotel_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Hotel_Customize_Section_Pro($manager,'vw_hotel_upgrade_pro_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Hotel Pro Theme', 'vw-hotel' ),
			'pro_text' => esc_html__( 'Upgrade Pro', 'vw-hotel' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/wordpress-hotel-theme'),
		)));

		$manager->add_section(new VW_Hotel_Customize_Section_Pro($manager,'vw_hotel_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Documentation', 'vw-hotel' ),
			'pro_text' => esc_html__( 'Docs', 'vw-hotel' ),
			'pro_url'  => esc_url('https://preview.vwthemesdemo.com/docs/free-vw-hotel/'),
		)));

		$manager->add_section(new VW_Hotel_Customize_Section_Pro($manager,'vw_hotel_get_bundle_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Get 250+ Themes Bundle at $99', 'vw-hotel' ),
			'pro_text' => esc_html__( 'Get Bundle', 'vw-hotel' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/wp-theme-bundle')
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-hotel-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-hotel-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );

		wp_localize_script(
		'vw-hotel-customize-controls',
		'vw_hotel_customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		));
	}
}

// Doing this customizer thang!
VW_Hotel_Customize::get_instance();
