<?php
/**
 * Panel and Group Typography
 *
 * @package Sailing
 */

thim_customizer()->add_section(
	array(
		'id'       => 'typography',
		'panel'    => 'general',
		'priority' => 9,
		'title'    => esc_html__( 'Typography', 'sailing' ),
	)
);

// Body_Typography_Group
thim_customizer()->add_group( array(
	'id'       => 'body_typography',
	'section'  => 'typography',
	'priority' => 1,
	'groups'   => array(
		array(
			'id'     => 'thim_body_group',
			'label'  => esc_html__( 'Body', 'sailing' ),
			'fields' => array(
				array(
					'id'        => 'thim_font_body',
					'label'     => esc_html__( 'Body Font', 'sailing' ),
					'tooltip'   => esc_html__( 'Allows you to select all font properties of body tag for your site', 'sailing' ),
					'type'      => 'typography',
					'priority'  => 10,
					'default'   => array(
						'font-family'    => 'Roboto',
						'variant'        => '300',
						'font-size'      => '15px',
						'line-height'    => '1.6',
						'color'          => '#5a5a5a'
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'choice'   => 'font-family',
							'element'  => 'body',
							'property' => 'font-family',
						),
						array(
							'choice'   => 'variant',
							'element'  => 'body',
							'property' => 'font-weight',
						),
						array(
							'choice'   => 'font-size',
							'element'  => 'body',
							'property' => 'font-size',
						),
						array(
							'choice'   => 'line-height',
							'element'  => 'body',
							'property' => 'line-height',
						),
						array(
							'choice'   => 'color',
							'element'  => 'body',
							'property' => 'color',
						)
					)
				),
			),
		),
	)
) );

// Button Typography
thim_customizer()->add_field(
	array(
		'section'   => 'typography',
		'id'        => 'thim_font_button',
		'label'     => esc_html__( 'Button Typography', 'sailing' ),
		'tooltip'   => esc_html__( 'Allows you to select all font properties of button for your site', 'sailing' ),
		'type'      => 'typography',
		'priority'  => 5,
		'default'   => array(
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '1.5em',
			'text-transform' => 'uppercase',
		),
		'transport' => 'postMessage',
	)
);