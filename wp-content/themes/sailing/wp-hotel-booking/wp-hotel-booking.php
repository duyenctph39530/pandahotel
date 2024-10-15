<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('hotel_booking_rooms_guests','thim_style_rooms_guests');

function thim_style_rooms_guests(){
	?>
	<div class="meta-data-guests">
		<?php
		if ( get_theme_mod( 'thim_adults_show' ) == true ) {
			?>
			<div class="adults-data">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 8C9.06087 8 10.0783 7.57857 10.8284 6.82843C11.5786 6.07828 12 5.06087 12 4C12 2.93913 11.5786 1.92172 10.8284 1.17157C10.0783 0.421427 9.06087 0 8 0C6.93913 0 5.92172 0.421427 5.17157 1.17157C4.42143 1.92172 4 2.93913 4 4C4 5.06087 4.42143 6.07828 5.17157 6.82843C5.92172 7.57857 6.93913 8 8 8ZM10.6667 4C10.6667 4.70724 10.3857 5.38552 9.88562 5.88562C9.38552 6.38572 8.70724 6.66667 8 6.66667C7.29276 6.66667 6.61448 6.38572 6.11438 5.88562C5.61428 5.38552 5.33333 4.70724 5.33333 4C5.33333 3.29276 5.61428 2.61448 6.11438 2.11438C6.61448 1.61428 7.29276 1.33333 8 1.33333C8.70724 1.33333 9.38552 1.61428 9.88562 2.11438C10.3857 2.61448 10.6667 3.29276 10.6667 4ZM16 14.6667C16 16 14.6667 16 14.6667 16H1.33333C1.33333 16 0 16 0 14.6667C0 13.3333 1.33333 9.33333 8 9.33333C14.6667 9.33333 16 13.3333 16 14.6667ZM14.6667 14.6613C14.6653 14.3333 14.4613 13.3467 13.5573 12.4427C12.688 11.5733 11.052 10.6667 8 10.6667C4.94667 10.6667 3.312 11.5733 2.44267 12.4427C1.53867 13.3467 1.336 14.3333 1.33333 14.6613H14.6667Z" fill="#7E7E7E"/>
				</svg>
				<span>
				<?php printf( esc_html( _n( '%s Adult', '%s Adults', get_post_meta( get_the_ID(),'_hb_room_capacity_adult', true ), 'sailing' ) ), get_post_meta( get_the_ID(),'_hb_room_capacity_adult', true ) ); ?>
				</span>
			</div>
			<?php
		}
		if ( get_theme_mod( 'thim_children_show' ) == true ) {
			?>
			<div class="children-data">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="#656565">
					<path d="M9.88,2.87C9.9,3,9.92,3.13,9.95,3.26c0.19,0.79,0.86,1.31,1.71,1.31c0.01,0,0.01,0,0.02,0c0.04,0,0.08,0,0.12,0
							c0.93,0,1.85,0.1,2.75,0.4c2.57,0.88,4.33,2.6,5.28,5.15c0.04,0.12,0.09,0.18,0.22,0.23c1.06,0.31,1.7,1.01,1.92,2.09
							c0.01,0.04,0.02,0.07,0.03,0.12v0.62c-0.01,0.03-0.03,0.06-0.03,0.08c-0.21,1.1-0.85,1.8-1.92,2.11
							c-0.13,0.04-0.18,0.12-0.23,0.23c-1.16,3.33-4.29,5.54-7.74,5.54c-0.39,0-0.78-0.03-1.17-0.08c-3.29-0.48-5.53-2.35-6.73-5.46
							c-0.05-0.13-0.11-0.2-0.25-0.23C3,15.1,2.39,14.49,2.1,13.57C2.06,13.43,2.03,13.3,2,13.18v-0.62c0.03-0.13,0.06-0.27,0.1-0.4
							c0.29-0.94,0.92-1.54,1.87-1.83c0.07-0.02,0.16-0.08,0.18-0.15c0.7-1.97,1.95-3.47,3.74-4.52c0.02-0.01,0.04-0.03,0.07-0.04
							c0-0.01,0-0.02,0.01-0.03C6.77,5.09,6.11,4.2,6.03,2.88H7.2c0.03,0.57,0.27,1.05,0.76,1.39c0.32,0.22,0.68,0.3,1.08,0.3
							c0.08,0,0.16,0,0.24-0.01C8.93,4.04,8.73,3.49,8.73,2.87H9.88 M9.88,1.37H8.73c-0.28,0-0.54,0.08-0.77,0.21
							c-0.22-0.13-0.48-0.2-0.76-0.2H6.03c-0.41,0-0.81,0.17-1.09,0.47c-0.28,0.3-0.43,0.71-0.4,1.12c0.06,1.01,0.39,1.89,0.95,2.59
							C4.38,6.53,3.54,7.72,2.96,9.1c-1.13,0.5-1.91,1.39-2.29,2.61c-0.04,0.12-0.07,0.25-0.1,0.38l-0.02,0.1
							c-0.03,0.12-0.04,0.24-0.04,0.36v0.62c0,0.13,0.02,0.26,0.05,0.39l0.03,0.1c0.03,0.11,0.06,0.23,0.09,0.35
							c0.39,1.24,1.18,2.13,2.31,2.6c1.45,3.35,4.11,5.39,7.71,5.92c0.46,0.07,0.92,0.1,1.39,0.1c3.93,0,7.47-2.41,8.96-6.04
							c1.23-0.53,2.07-1.54,2.37-2.92c0-0.01,0.01-0.03,0.01-0.04c0.05-0.15,0.08-0.31,0.08-0.47v-0.62c0-0.1-0.01-0.2-0.03-0.29
							c-0.01-0.07-0.03-0.13-0.05-0.19c-0.3-1.39-1.14-2.42-2.39-2.96c-1.16-2.72-3.17-4.58-6.01-5.56c-0.97-0.33-2-0.48-3.24-0.48
							l-0.13,0c0,0,0,0,0,0c-0.22,0-0.24-0.11-0.25-0.16c-0.02-0.07-0.02-0.12-0.03-0.16l-0.03-0.15C11.22,1.88,10.6,1.37,9.88,1.37
							L9.88,1.37z"/>
					<path  d="M9.5,15.3c1.23,1.89,3.79,1.85,5,0" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
					<path  d="M10.14,12.43c-0.3-1.01-0.76-1.44-1.51-1.44C7.87,11,7.42,11.43,7.14,12.42" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
					<path  d="M16.86,12.42c-0.05-0.51-0.26-1-0.76-1.24c-0.27-0.13-0.61-0.2-0.91-0.18c-0.72,0.04-1.17,0.55-1.33,1.44" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
				</svg>
				<span>
				<?php printf( esc_html( _n( '%s Child', '%s Children', get_post_meta( get_the_ID(),'_hb_max_child_per_room', true ), 'sailing' ) ), get_post_meta( get_the_ID(),'_hb_max_child_per_room', true ) ); ?>
				</span>
			</div>
			<?php
		}
		/**
		 * hotel_booking_loop_room_price hook
		 */
		do_action( 'hotel_booking_loop_room_price' );
		?>
	</div>
	<?php
}

add_filter('hb_pagination_args','thim_hb_pagination_args');

function thim_hb_pagination_args( $array ){
	if( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ){
		$array['prev_text'] = '<i class="tk tk-arrow-left"></i>' . esc_html__( 'Prev', 'sailing' );
		$array['next_text'] = esc_html__( 'Next', 'sailing' ) . '<i class="tk tk-arrow-right"></i>';
	}

	return $array;
}

add_action( 'hotel_booking_price_single_room', 'hotel_booking_price_single_room_function' );  

function hotel_booking_price_single_room_function(){
	global $hb_settings;
	$price_display = apply_filters('hotel_booking_loop_room_price_display_style', $hb_settings->get('price_display'));
	$prices        = hb_room_get_selected_plan(get_the_ID());
	$prices        = isset($prices->prices) ? $prices->prices : array();

    ?>
    <div class="footer-content-room price-single">
			<?php if ($prices) {
				$min_price = is_numeric(min($prices)) ? min($prices) : 0;
				$max_price = is_numeric(max($prices)) ? max($prices) : 0;
				$min       = $min_price + (hb_price_including_tax() ? ($min_price * hb_get_tax_settings()) : 0);
				$max       = $max_price + (hb_price_including_tax() ? ($max_price * hb_get_tax_settings()) : 0);
			?>
				<?php if (get_theme_mod('thim_hb_single_show_book_email') == true) { ?>
					<div class="thim-button-register-room">
						<a class="thim-enroll-room-button hb_button hb_primary" href="#"><?php esc_html_e('Register', 'sailing'); ?></a>
					</div>
				<?php } ?>

				<div class="price">

					<span class="title-price"><?php _e('Price:', 'sailing'); ?></span>

					<?php if ($price_display === 'max') { ?>
						<span class="price_value price_max"><?php echo hb_format_price($max) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } elseif ($price_display === 'min_to_max' && $min !== $max) { ?>
						<span class="price_value price_min_to_max"><?php echo hb_format_price($min) ?> - <?php echo hb_format_price($max) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } else { ?>
						<span class="price_value price_min"><?php echo hb_format_price($min) ?>
							<span class="unit"><?php _e('night', 'sailing'); ?></span></span>
					<?php } ?>

				</div>

			<?php } ?>

		</div>
    <?php
}

add_action( 'hotel_booking_single_shortcode_book_email', 'hotel_booking_single_shortcode_book_email_function' );  

function hotel_booking_single_shortcode_book_email_function(){
    ?>
    <div id="contact-form-registration">
		<?php
		$short_code = get_theme_mod('thim_hb_single_shortcode_book_email');
		if (!empty($short_code)) {
			echo do_shortcode('[contact-form-7 id="' . $short_code . '" title="Book Online"]');
		}
		?>
	</div>
    <?php
}

if ( get_theme_mod( 'thim_hb_cate_style_layout', 'base' ) == 'layout-1' ) {
	add_filter('wphb/filter/room-meta', function($sections){

		return [
			'search/v2/loop-v2/room-info/room-meta/price.php',
			'search/v2/loop-v2/room-info/room-meta/quanity.php',
			'search/v2/loop-v2/room-info/room-meta/add-to-cart.php'
		];
	});

	add_action('wphb/loop-v2/room-meta', function($room){
	?>
	<li class="hb_search_capacity">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M8 8C9.06087 8 10.0783 7.57857 10.8284 6.82843C11.5786 6.07828 12 5.06087 12 4C12 2.93913 11.5786 1.92172 10.8284 1.17157C10.0783 0.421427 9.06087 0 8 0C6.93913 0 5.92172 0.421427 5.17157 1.17157C4.42143 1.92172 4 2.93913 4 4C4 5.06087 4.42143 6.07828 5.17157 6.82843C5.92172 7.57857 6.93913 8 8 8ZM10.6667 4C10.6667 4.70724 10.3857 5.38552 9.88562 5.88562C9.38552 6.38572 8.70724 6.66667 8 6.66667C7.29276 6.66667 6.61448 6.38572 6.11438 5.88562C5.61428 5.38552 5.33333 4.70724 5.33333 4C5.33333 3.29276 5.61428 2.61448 6.11438 2.11438C6.61448 1.61428 7.29276 1.33333 8 1.33333C8.70724 1.33333 9.38552 1.61428 9.88562 2.11438C10.3857 2.61448 10.6667 3.29276 10.6667 4ZM16 14.6667C16 16 14.6667 16 14.6667 16H1.33333C1.33333 16 0 16 0 14.6667C0 13.3333 1.33333 9.33333 8 9.33333C14.6667 9.33333 16 13.3333 16 14.6667ZM14.6667 14.6613C14.6653 14.3333 14.4613 13.3467 13.5573 12.4427C12.688 11.5733 11.052 10.6667 8 10.6667C4.94667 10.6667 3.312 11.5733 2.44267 12.4427C1.53867 13.3467 1.336 14.3333 1.33333 14.6613H14.6667Z" fill="#7E7E7E"></path>
		</svg>
		<span><?php printf( esc_html( _n( '%s Adult', '%s Adults', $room->capacity, 'sailing' ) ), $room->capacity ); ?></span>
	</li>

	<li class="hb_search_max_child">
		<svg width="18" height="18" viewBox="0 0 24 24" fill="#656565">
			<path d="M9.88,2.87C9.9,3,9.92,3.13,9.95,3.26c0.19,0.79,0.86,1.31,1.71,1.31c0.01,0,0.01,0,0.02,0c0.04,0,0.08,0,0.12,0
					c0.93,0,1.85,0.1,2.75,0.4c2.57,0.88,4.33,2.6,5.28,5.15c0.04,0.12,0.09,0.18,0.22,0.23c1.06,0.31,1.7,1.01,1.92,2.09
					c0.01,0.04,0.02,0.07,0.03,0.12v0.62c-0.01,0.03-0.03,0.06-0.03,0.08c-0.21,1.1-0.85,1.8-1.92,2.11
					c-0.13,0.04-0.18,0.12-0.23,0.23c-1.16,3.33-4.29,5.54-7.74,5.54c-0.39,0-0.78-0.03-1.17-0.08c-3.29-0.48-5.53-2.35-6.73-5.46
					c-0.05-0.13-0.11-0.2-0.25-0.23C3,15.1,2.39,14.49,2.1,13.57C2.06,13.43,2.03,13.3,2,13.18v-0.62c0.03-0.13,0.06-0.27,0.1-0.4
					c0.29-0.94,0.92-1.54,1.87-1.83c0.07-0.02,0.16-0.08,0.18-0.15c0.7-1.97,1.95-3.47,3.74-4.52c0.02-0.01,0.04-0.03,0.07-0.04
					c0-0.01,0-0.02,0.01-0.03C6.77,5.09,6.11,4.2,6.03,2.88H7.2c0.03,0.57,0.27,1.05,0.76,1.39c0.32,0.22,0.68,0.3,1.08,0.3
					c0.08,0,0.16,0,0.24-0.01C8.93,4.04,8.73,3.49,8.73,2.87H9.88 M9.88,1.37H8.73c-0.28,0-0.54,0.08-0.77,0.21
					c-0.22-0.13-0.48-0.2-0.76-0.2H6.03c-0.41,0-0.81,0.17-1.09,0.47c-0.28,0.3-0.43,0.71-0.4,1.12c0.06,1.01,0.39,1.89,0.95,2.59
					C4.38,6.53,3.54,7.72,2.96,9.1c-1.13,0.5-1.91,1.39-2.29,2.61c-0.04,0.12-0.07,0.25-0.1,0.38l-0.02,0.1
					c-0.03,0.12-0.04,0.24-0.04,0.36v0.62c0,0.13,0.02,0.26,0.05,0.39l0.03,0.1c0.03,0.11,0.06,0.23,0.09,0.35
					c0.39,1.24,1.18,2.13,2.31,2.6c1.45,3.35,4.11,5.39,7.71,5.92c0.46,0.07,0.92,0.1,1.39,0.1c3.93,0,7.47-2.41,8.96-6.04
					c1.23-0.53,2.07-1.54,2.37-2.92c0-0.01,0.01-0.03,0.01-0.04c0.05-0.15,0.08-0.31,0.08-0.47v-0.62c0-0.1-0.01-0.2-0.03-0.29
					c-0.01-0.07-0.03-0.13-0.05-0.19c-0.3-1.39-1.14-2.42-2.39-2.96c-1.16-2.72-3.17-4.58-6.01-5.56c-0.97-0.33-2-0.48-3.24-0.48
					l-0.13,0c0,0,0,0,0,0c-0.22,0-0.24-0.11-0.25-0.16c-0.02-0.07-0.02-0.12-0.03-0.16l-0.03-0.15C11.22,1.88,10.6,1.37,9.88,1.37
					L9.88,1.37z"/>
			<path  d="M9.5,15.3c1.23,1.89,3.79,1.85,5,0" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
			<path  d="M10.14,12.43c-0.3-1.01-0.76-1.44-1.51-1.44C7.87,11,7.42,11.43,7.14,12.42" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
			<path  d="M16.86,12.42c-0.05-0.51-0.26-1-0.76-1.24c-0.27-0.13-0.61-0.2-0.91-0.18c-0.72,0.04-1.17,0.55-1.33,1.44" fill="none" stroke="#656565" stroke-width="1.5" stroke-linecap="round"/>
		</svg>
		<span><?php printf( esc_html( _n( '%s Child', '%s Children', $room->max_child, 'sailing' ) ), $room->max_child ); ?></span>
	</li>
	<?php
	}, 3, 1);
}