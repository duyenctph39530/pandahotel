<?php

namespace Elementor;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Gallery_Image_Element extends Widget_Base {

	public function get_name() {
		return 'thim-gallery-image';
	}

	public function get_title() {
		return esc_html__( 'Thim: Gallery Image', 'sailing' );
	}

	public function get_icon() {
		return 'thim-widget-icon thim-widget-icon-multiple-images';
	}
	protected function get_html_wrapper_class() {
		return 'thim-widget-gallery-images';
	} 

	public function get_categories() {
		return [ 'thim-elements' ];
	}

	public function get_script_depends() {
		return [ 'magnific-popup' ];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'gallery_image_settings',
			[
				'label' => esc_html__( 'Gallery Image Settings', 'sailing' )
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Column Post', 'sailing' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'base'    => esc_attr__( 'Gallery Slider', 'sailing' ),
					'style_2' => esc_attr__( 'Gallery Column', 'sailing' )
				],
				'default' => 'base',
			]
		);

		$this->add_control(
			'popup_style',
			array(
				'label'     => esc_html__( 'Popup Style', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off'          => esc_html__( 'Off', 'thim-elementor-kit' ),
				'label_on'           => esc_html__( 'On', 'thim-elementor-kit' ),
				'render_type'        => 'none',
				'frontend_available' => true,
				'default'   => 'no',
				'condition'      => array(
					'style' => 'style_2',
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => esc_html__( 'Columns', 'thim-elementor-kit' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'selectors'          => array(
					'{{WRAPPER}}' => '--thim-gallery-image-columns: repeat({{VALUE}}, 1fr)',
				),
				'condition'      => array(
					'style' 		=> 'style_2',
					'popup_style' 	=> 'yes'
				),
			)
		);

		$this->add_control(
			'image',
			[
				'label'      => __( 'Add Images', 'sailing' ),
				'type'       => Controls_Manager::GALLERY,
				'show_label' => false
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'exclude'   => [ 'custom' ],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_link',
			[
				'label'       => esc_html__( 'Image Link', 'sailing' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'sailing' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'Add your links here', 'sailing' )
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'       => esc_html__( 'Link Target', 'sailing' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'_self'  => [
						'title' => esc_html__( 'Same window', 'sailing' ),
						'icon'  => 'fa fa-window-maximize',
					],
					'_blank' => [
						'title' => esc_html__( 'New window', 'sailing' ),
						'icon'  => 'fa fa-window-restore',
					],
				],
				'default'     => '_self',
				'toggle'      => false,
				'label_block' => false
			]
		);

		$this->add_control(
			'text_show',
			[
				'label'       => esc_html__( 'Show Text Gallery', 'sailing' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add your text here', 'sailing' ),
				'label_block' => true,
				'default'     => ' Voted "Top 100 Hotels in the World 2017" by Travel & Leisure',
				'condition'   => [
					'style' => [ 'style_2' ]
				]
			]
		);

		

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Map variables between Elementor and SiteOrigin
		$instance = array(
			'style'         => $settings['style'],
			'popup_style' 	=> $settings['popup_style'],
			'image'         => array_map( function ( $ar ) {
				return $ar['id'];
			}, $settings['image'] ),
			'image_size'    => $settings['image_size'],
			'image_link'    => $settings['image_link'],
			'link_target'   => $settings['link_target'],
			'text_show'     => $settings['text_show'],
			// 'columns'		=> $settings['columns']
			
		);

		thim_get_widget_template( $this->get_base(), array( 'instance' => $instance ), $settings['style'] );
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Thim_Gallery_Image_Element() );
