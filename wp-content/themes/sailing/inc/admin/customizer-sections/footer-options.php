<?php

thim_customizer()->add_section(
	array(
		'id'       => 'display_footer',
		'title'    => esc_html__( 'Setting', 'sailing' ),
		'panel'    => 'footer',
		'priority' => 10,
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'thim_desc_footer_tpl',
		'type'          => 'tp_notice',
		'description'   => sprintf( __( 'This Footer is built by Thim Elementor Kit, you can edit and configure it in %s.', 'sailing' ), '<a href="' . admin_url( 'edit.php?post_type=thim_elementor_kit&thim_elementor_type=footer' ) . '" target="_blank">' . __( 'Thim Elementor Kit', 'sailing' ) .'</a>' ),
		'section'       => 'display_footer',
		'wrapper_attrs' => array(
			'class' => '{default_class} hide' . thim_customizer_extral_class( 'footer' )
		)
	)
);


thim_customizer()->add_field(
	array(
		'id'        => 'thim_footer_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Footer Background Color', 'sailing' ),
		'tooltip'   => esc_html__( 'Footer Background Color', 'sailing' ),
		'section'   => 'display_footer',
		'default'   => '#edf1f4',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => 'footer#colophon',
				'property' => 'background-color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class}' . thim_customizer_extral_class( 'footer' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'type'    => 'image',
		'id'      => 'thim_footer_background_img',
		'label'   => esc_html__( 'Background footer images', 'sailing' ),
		'tooltip' => esc_html__( 'Upload your background footer.', 'sailing' ),
		'section' => 'display_footer',
		'default' => '',
		'wrapper_attrs' => array(
			'class' => '{default_class}' . thim_customizer_extral_class( 'footer' )
		)
	)
);

// Footer Text Color
thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'thim_footer_color',
		'label'     => esc_html__( 'Colors Footer Settings', 'sailing' ),
		'section'   => 'display_footer',
		'priority'  => 50,
		'choices'   => array(
			'text' => esc_html__( 'Text', 'sailing' ),
			'link' => esc_html__( 'Link', 'sailing' ),
			'line' => esc_html__( 'Line', 'sailing' ),
		),
		'default'   => array(
			'text' => '#2a2a2a',
			'link' => '#2a2a2a',
			'line' => '#eeeeee',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'text',
				'element'  => 'footer#colophon .footer .thim-footer-location, footer#colophon .footer .thim-footer-location p, footer#colophon .footer p',
				'property' => 'color',
			),
			array(
				'choice'   => 'link',
				'element'  => 'footer#colophon a',
				'property' => 'color',
			),
			array(
				'choice'   => 'line',
				'element'  => 'footer#colophon .text-copyright.border-copyright',
				'property' => 'border-top-color',
			),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class}' . thim_customizer_extral_class( 'footer' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_footer_style',
		'type'    => 'switch',
		'label'   => esc_html__( 'Footer Style New', 'sailing' ),
		'tooltip' => esc_html__( 'Turn On/Off Footer style new.', 'sailing' ),
		'section' => 'display_footer',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class}' . thim_customizer_extral_class( 'footer' )
		)
	)
);