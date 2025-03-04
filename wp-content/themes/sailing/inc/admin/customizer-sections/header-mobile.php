<?php

// main menu
thim_customizer()->add_section(
	array(
		'id'       => 'display_mobile_menu',
		'title'    => esc_html__( 'Mobile Menu', 'sailing' ),
		'panel'    => 'header',
		'priority' => 15,
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'thim_desc_header_mobile_tpl',
		'type'          => 'tp_notice',
 		'description'   => sprintf( __( 'This header is built by Thim Elementor Kit, you can edit and configure it in %s.', 'sailing' ), '<a href="' . admin_url( 'edit.php?post_type=thim_elementor_kit&thim_elementor_type=header' ) . '" target="_blank">' . __( 'Thim Elementor Kit', 'sailing' ) . '</a>' ),
		'section'       => 'display_mobile_menu',
		'priority'      => 11,
		'wrapper_attrs' => array(
			'class' => '{default_class} hide' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_icon_mobile_menu_color_background',
		'type'      => 'color',
		'label'     => __( 'Color Mobile Menu Icon', 'sailing' ),
		'tooltip'   => 'Pick A Color Mobile Menu Icon',
		'default'   => '#ffffff',
		'section'   => 'display_mobile_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.menu-mobile-effect span',
				'property' => 'background-color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_bg_mobile_menu_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Background color mobile menu', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a background color for mobile menu', 'sailing' ),
		'section'   => 'display_mobile_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'default'   => '#222222',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.width-navigation',
				'property' => 'background-color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'thim_mobile_menu_text_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text color', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a text color for mobile menu', 'sailing' ),
		'default'   => '#d8d8d8',
		'section'   => 'display_mobile_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '.width-navigation ul li a, .width-navigation ul li span',
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
		'id'        => 'thim_mobile_menu_text_hover_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Text Hover color', 'sailing' ),
		'tooltip'   => esc_html__( 'Pick a text hover color for mobile menu', 'sailing' ),
		'default'   => '#2eb0d1',
		'section'   => 'display_mobile_menu',
		'alpha'     => true,
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'color',
				'element'  => '
					.site-header .navbar-nav li:hover > a,
					.site-header .navbar-nav li.current_page_item > a,
					.site-header .navbar-nav li.current-menu-ancestor > a,
					.site-header .navbar-nav li:hover > a > span,
					.site-header .navbar-nav li.current_page_item > a > span,
					.site-header .navbar-nav li.current-menu-ancestor > a > span',
				'property' => 'color',
			)
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'header' )
		)
	)
);