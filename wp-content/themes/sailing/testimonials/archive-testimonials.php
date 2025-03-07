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

if ( have_posts() ) {

	while ( have_posts() ) : the_post();
		$link    = get_post_meta( get_the_ID(), 'website_url', true );
		$regency = get_post_meta( get_the_ID(), 'regency', true );
		$author  = get_post_meta( get_the_ID(), 'author', true );
		?>
		<div class="testimonial-item-archive" id="post-<?php the_ID(); ?>">
			<div class="side-left">
				<div class="testimonial-thumbnail">
					<?php echo thim_get_thumbnail( get_the_ID(), '170x170', 'post', false ); ?>
				</div>
				<div class="testimonial-info">
					<?php
					if ( $author <> '' ) {
						echo '<div class="author">' . $author . '</div>';
					}
					?>
					<div class="regency"><?php echo esc_attr( $regency ) ?></div>
				</div>
			</div>
			<div class="side-right">
				<div class="blockquote"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
				<div class="description"><?php echo the_content(); ?></div>
			</div>
		</div>
	<?php
	endwhile;
	thim_paging_nav();
}

/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer(); ?>