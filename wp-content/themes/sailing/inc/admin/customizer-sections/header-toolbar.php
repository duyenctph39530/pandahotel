<?php
thim_customizer()->add_section(
	array(
		'id'       => 'display_top_header',
		'title'    => esc_html__( 'Toolbar', 'sailing' ),
		'panel'    => 'header',
		'priority' => 3,
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'thim_desc_header_toolbar_tpl',
		'type'          => 'tp_notice',
 		'description'   => sprintf( __( 'This header is built by Thim Elementor Kit, you can edit and configure it in %s.', 'sailing' ), '<a href="' . admin_url( 'edit.php?post_type=thim_elementor_kit&thim_elementor_type=header' ) . '" target="_blank">' . __( 'Thim Elementor Kit', 'sailing' ) . '</a>' ),
		'section'       => 'display_top_header',
		'priority'      => 11,
		'wrapper_attrs' => array(
			'class' => '{default_class} hide' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_topbar_show',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Toolbar', 'sailing' ),
		'tooltip' => esc_html__( 'Turn On toolbar header.', 'sailing' ),
		'section' => 'display_top_header',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_font_size_top_header',
		'label'     => esc_html__( 'Font size', 'sailing' ),
		'tooltip'   => esc_html__( 'Input font size toolbar.', 'sailing' ),
		'type'      => 'typography',
		'section'   => 'display_top_header',
		'default'   => array(
			'font-size' => '13px'
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-size',
				'element'  => '.top-header',
				'property' => 'font-size',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_toolbar_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Toolbar color', 'sailing' ),
		'tooltip'   => esc_html__( 'Color for toolbar header no sticky.', 'sailing' ),
		'section'   => 'display_top_header',
		'default'   => '#ffffff',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top-header b, .top-header aside, .top-header, .top-header p',
				'property' => 'color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_toolbar_color_hover',
		'type'      => 'color',
		'label'     => esc_html__( 'Toolbar color hover', 'sailing' ),
		'tooltip'   => esc_html__( 'Color hover for toolbar header no sticky.', 'sailing' ),
		'section'   => 'display_top_header',
		'default'   => '#4e9db5',
		'choices'   => array( 'alpha' => true ),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.top-header a:hover, .thim-select-language .language ul li a:hover',
				'property' => 'color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);