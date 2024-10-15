<?php
/**
 * The template for displaying single room page.
 *
 * This template can be overridden by copying it to yourtheme/wp-hotel-booking/single-room.php.
 *
 * @author  ThimPress, leehld
 * @package WP-Hotel-Booking/Templates
 * @version 1.6
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php

get_header();
/**
 * thim_wrapper_loop_start hook
 *
 * @hooked thim_wrapper_loop_end - 1
 * @hooked thim_heading_top - 5
 * @hooked thim_wrapper_loop_start - 30
 */

do_action( 'thim_wrapper_loop_start' );

/**
 * hotel_booking_before_main_content hook
 */
do_action( 'hotel_booking_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php 
	if( get_theme_mod( 'thim_hb_single_style', 'layout-1') == 'layout-2' ){
		hb_get_template_part( 'content', 'single-room-v2' );
	}else {
		hb_get_template_part( 'content', 'single-room' );
	}
	?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'hotel_booking_after_main_content' );
?>

<?php
/**
 * hotel_booking_sidebar hook
 *
 * @hooked hotel_booking_sidebar - 10
 */
do_action( 'hotel_booking_sidebar' );
?>

<?php
/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer(); ?>