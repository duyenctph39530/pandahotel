<?php
thim_customizer()->add_section(
	array(
		'id'       => 'woo_single',
		'panel'    => 'woocommerce',
		'title'    => esc_html__( 'Single Product', 'sailing' ),
		'priority' => 12,
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'thim_desc_woo_single_tpl',
		'type'          => 'tp_notice',
 		'description'   => sprintf( __( 'This page is built by Thim Elementor Kit, you can edit and configure it in %s.', 'sailing' ), '<a href="' . admin_url( 'edit.php?post_type=thim_elementor_kit&thim_elementor_type=single-product' ) . '" target="_blank">' . __( 'Thim Elementor Kit', 'sailing' ) . '</a>' ),
		'section'       => 'woo_single',
		'priority'      => 11,
		'wrapper_attrs' => array(
			'class' => '{default_class} hide' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_single_layout',
		'label'   => esc_html__( 'Single Product Layout', 'sailing' ),
		'section' => 'woo_single',
		'type'    => 'radio-image',
		'choices' => array(
			'full-content'  => TP_THEME_URI . 'assets/images/admin/layout/body-full.png',
			'sidebar-left'  => TP_THEME_URI . 'assets/images/admin/layout/sidebar-left.png',
			'sidebar-right' => TP_THEME_URI . 'assets/images/admin/layout/sidebar-right.png'
		),
		'default' => 'full-content',
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-col-3' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_single_hide_title',
		'type'    => 'switch',
		'label'   => esc_html__( 'Hide Title', 'sailing' ),
		'tooltip' => esc_html__( 'Hide/show title.', 'sailing' ),
		'section' => 'woo_single',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_single_top_image',
		'type'     => 'image',
		'label'    => esc_html__( 'Top Image', 'sailing' ),
		'tooltip'  => esc_html__( 'Select Image top header for single shop page.', 'sailing' ),
		'section'  => 'woo_single',
		'default'  => TP_THEME_URI . 'assets/images/bg-blog.jpg',
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout',
				'operator' => '==',
				'value'    => 'layout-1',
			),
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_woo_single_heading_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Heading Background Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Heading background color.', 'sailing' ),
		'section'   => 'woo_single',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main',
				'property' => 'background-color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_woo_single_heading_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Color Heading', 'sailing' ),
		'tooltip'   => esc_html__( 'Background color for heading.', 'sailing' ),
		'section'   => 'woo_single',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top_site_main .page-title-wrapper .banner-wrapper .heading__secondary',
				'property' => 'color',
		)
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_single_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Product Title', 'sailing' ),
		'tooltip' => esc_html__( 'Product Title', 'sailing' ),
		'section' => 'woo_single',
		'default' => '',
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_woo_single_sub_title',
		'type'    => 'text',
		'label'   => esc_html__( 'Product Sub Title', 'sailing' ),
		'tooltip' => esc_html__( 'Product Sub Title', 'sailing' ),
		'section' => 'woo_single',
		'default' => '',
		'active_callback' => array(
			array(
				'setting'  => 'thim_top_site_main_layout_custom',
				'operator' => '!=',
				'value'  => 'elementor',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-product' )
		)
	)
);
