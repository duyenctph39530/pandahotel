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
/*
* thim_before_archive_loop hook
*/
do_action( 'thim_before_archive_loop' );

if ( have_posts() ) :?>
	<div class="archive-content">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();
			get_template_part( 'content' );
		endwhile;
		thim_paging_nav();
		?>
	</div>
	<?php
else :
	get_template_part( 'content', 'none' );
endif;

/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer(); ?>