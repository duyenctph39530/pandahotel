<?php
/**
 * Template Single Event post type
 */
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
 * tp_event_before_main_content hook
 */
do_action( 'tp_event_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php wpems_get_template_part( 'content', 'single-event' ); ?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * tp_event_after_main_content hook
 *
 * @hooked tp_event_after_main_content - 10 (outputs closing divs for the content)
 */
do_action( 'tp_event_after_main_content' );
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