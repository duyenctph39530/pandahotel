<?php
/**
 * The template for displaying all single posts.
 *
 * @package thim
 */

get_header();
/**
 * thim_wrapper_loop_start hook
 *
 * @hooked thim_wrapper_loop_end - 1
 * @hooked thim_heading_top - 5
 * @hooked thim_wrapper_loop_start - 30
 */

do_action( 'thim_wrapper_loop_start' );

?>

<div class="single-content archive-content">
	<?php
	while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'single' ); ?>
		<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
		?>
	<?php endwhile; // end of the loop. ?>
</div>


<?php
/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer(); ?>