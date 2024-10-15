<?php
thim_customizer()->add_section(
	array(
		'id'       => 'woo_setting',
		'title'    => esc_html__( 'Setting', 'sailing' ),
		'panel'    => 'woocommerce',
		'priority' => 1,
	)
);

thim_customizer()->add_field(
    array(
        'id' => 'thim_desc_woo_setting_tpl',
        'type' => 'tp_notice',
        'description' => sprintf(__('This page is built by Thim Elementor Kit, you can edit and configure it in %s.',
            'sailing'),
            '<a href="' . admin_url('edit.php?post_type=thim_elementor_kit&thim_elementor_type=archive-product') . '" target="_blank">' . __('Thim Elementor Kit',
                'sailing') . '</a>'),
        'section' => 'woo_setting',
        'priority' => 11,
        'wrapper_attrs' => array(
            'class' => '{default_class} hide' . thim_customizer_extral_class('archive-product')
        )
    )
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_woo_product_column',
		'label'    => esc_html__( 'Grid Columns', 'sailing' ),
		'tooltip'  => esc_html__( 'Choose the number grid columns for product.', 'sailing' ),
		'default'  => '4',
		'priority' => 10,
		'multiple' => 0,
		'section'  => 'woo_setting',
		'choices'  => array(
			'2' => esc_html__( '2', 'sailing' ),
			'3' => esc_html__( '3', 'sailing' ),
			'4' => esc_html__( '4', 'sailing' ),
			'5' => esc_html__( '5', 'sailing' ),
			'6' => esc_html__( '6', 'sailing' ),
		),
		'wrapper_attrs' => array(
            'class' => '{default_class} ' . thim_customizer_extral_class('archive-product')
        )
	)
);

// Product per page
thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_product_per_page',
		'type'     => 'slider',
		'label'    => esc_html__( 'Products Per Page', 'sailing' ),
		'tooltip'  => esc_html__( 'Choose the number of products per page.', 'sailing' ),
		'priority' => 30,
		'default'  => 8,
		'section'  => 'woo_setting',
		'choices'  => array(
			'min'  => '4',
			'max'  => '100',
			'step' => '1',
		),
		'wrapper_attrs' => array(
            'class' => '{default_class} ' . thim_customizer_extral_class('archive-product')
        )
	)
);

// Enable or disable quick view
thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_set_show_qv',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Quick View', 'sailing' ),
		'tooltip'  => esc_html__( 'Allows you to enable or disable quick view.', 'sailing' ),
		'section'  => 'woo_setting',
		'default'  => true,
		'priority' => 40,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
            'class' => '{default_class} ' . thim_customizer_extral_class('archive-product')
        )
	)
);