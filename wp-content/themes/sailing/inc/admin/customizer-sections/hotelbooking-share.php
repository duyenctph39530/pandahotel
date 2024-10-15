<?php
thim_customizer()->add_section(
	array(
		'id'       => 'hb_share',
		'title'    => esc_html__( 'Sharing', 'sailing' ),
		'panel'    => 'hotel-booking',
		'priority' => 3,
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'thim_desc_hb_share_tpl',
		'type'          => 'tp_notice',
		'description'   => sprintf( __( 'This page is built by Thim Elementor Kit, you can edit and configure it in %s.', 'sailing' ), '<a href="' . admin_url( 'edit.php?post_type=thim_elementor_kit&thim_elementor_type=single-room' ) . '" target="_blank">' . __( 'Thim Elementor Kit', 'sailing' ) . '</a>' ),
		'section'       => 'hb_share',
		'priority'      => 11,
		'wrapper_attrs' => array(
			'class' => '{default_class} hide' . thim_customizer_extral_class( 'single-room' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_share_facebook',
		'type'    => 'switch',
		'label'   => esc_html__( 'Facebook', 'sailing' ),
		'tooltip' => esc_html__( 'Show the facebook sharing option in hotel.', 'sailing' ),
		'section' => 'hb_share',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-room' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_share_twitter',
		'type'    => 'switch',
		'label'   => esc_html__( 'Twitter', 'sailing' ),
		'tooltip' => esc_html__( 'Show the Twitter sharing option in hotel.', 'sailing' ),
		'section' => 'hb_share',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-room' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_share_google',
		'type'    => 'switch',
		'label'   => esc_html__( 'Google Plus', 'sailing' ),
		'tooltip' => esc_html__( 'Show the Google sharing option in hotel.', 'sailing' ),
		'section' => 'hb_share',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-room' )
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'      => 'thim_hb_share_pinterest',
		'type'    => 'switch',
		'label'   => esc_html__( 'Pinterest', 'sailing' ),
		'tooltip' => esc_html__( 'Show the Pinterest sharing option in hotel.', 'sailing' ),
		'section' => 'hb_share',
		'default' => true,
		'choices' => array(
			true  => esc_html__( 'On', 'sailing' ),
			false => esc_html__( 'Off', 'sailing' ),
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} ' . thim_customizer_extral_class( 'single-room' )
		)
	)
);

