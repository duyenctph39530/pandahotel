<?php
thim_customizer()->add_section(
	array(
		'id'       => 'styling_rtl',
		'title'    => esc_html__( 'Featured', 'sailing' ),
		'panel'    => 'general',
		'priority' => 5,
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_rtl_support',
		'type'    => 'switch',
		'label'   => esc_html__( 'RTL Support', 'sailing' ),
		'tooltip' => esc_html__( 'Enable/Disable setting.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload',
		'type'    => 'select',
		'label'   => esc_html__( 'Preload Type', 'sailing' ),
		'tooltip' => esc_html__( 'Preload type select.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => 'image',
		'choices' => array(
			true    => esc_html__( 'CSS 3', 'sailing' ),
			'image' => esc_html__( 'Image', 'sailing' ),
			false   => esc_html__( 'No', 'sailing' ),
		)
	)
);
thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload_circle',
		'type'    => 'switch',
		'label'   => esc_html__( 'Preload Type Css Circle', 'sailing' ),
		'tooltip' => esc_html__( 'Select Preload Type Css Circle.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => false,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_preload',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_preload_image',
		'type'    => 'image',
		'label'   => esc_html__( 'Preload Image', 'sailing' ),
		'tooltip' => esc_html__( 'Preload image setting.', 'sailing' ),
		'section' => 'styling_rtl',
		'js_vars' => array(
			array(
				'element'  => '.main-top',
				'function' => 'css',
				'property' => 'background-image',
			),
		),
		'default' => TP_THEME_URI . 'assets/images/preload.gif',
	)
);


thim_customizer()->add_field(
	array(
		'id'        => 'thim_preload_bg_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Preload Background', 'sailing' ),
		'tooltip'   => esc_html__( 'Preload background color setting.', 'sailing' ),
		'section'   => 'styling_rtl',
		'default'   => '#ffffff',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'preload',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


thim_customizer()->add_field(
	array(
		'id'      => 'thim_google_analytics',
		'type'    => 'text',
		'label'   => esc_html__( 'Enter your ID Google Analytics', 'sailing' ),
		'tooltip' => esc_html__( 'Enter your ID Google Analytics.', 'sailing' ),
		'section' => 'styling_rtl',
		'default' => '',
	)
);

// Feature: Body custom class
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_body_custom_class',
		'label'    => esc_html__( 'Body Custom Class', 'sailing' ),
		'tooltip'  => esc_html__( 'Enter body custom class.', 'sailing' ),
		'section'  => 'styling_rtl',
	)
);

// Border Radius
thim_customizer()->add_field(
	array(
		'id'       => 'thim_content_border',
		'type'     => 'switch',
		'label'    => esc_html__( 'Border Radius', 'sailing' ),
		'section'  => 'styling_rtl',
		'default'  => false,
		'choices'  => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'tooltip'  => esc_html__( 'Enable border radius in some places (List Room, Button, Shop, Blog .....)', 'sailing' ),
	)
);

thim_customizer()->add_field(
	array(
		'id'              => 'thim_border_radius',
		'type'            => 'dimensions',
		'label'           => esc_html__( 'Border Radius Size','sailing' ),
		'section'         => 'styling_rtl',
		'default'         => [
			'item'     => '8px',
			'item-big' => '16px',
			'button'     => '200px',
		],
		'choices'         => [
			'labels' => [
				'item'     => esc_html__( 'Global - Default', 'sailing' ),
				'item-big' => esc_html__( 'Global - Big', 'sailing' ),
				'button'   => esc_html__( 'Button', 'sailing' ),
			],
		],
		'active_callback' => array(
			array(
				'setting'  => 'thim_content_border',
				'operator' => '===',
				'value'    => true,
			),
		),
	)
);
