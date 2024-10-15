<?php
/**
 * The template for displaying 404 pages (not found).
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

$image 	= !empty(get_theme_mod('thim_404_image')) ? get_theme_mod('thim_404_image') : get_template_directory_uri() . '/assets/images/404.png' ;
$text 	= !empty(get_theme_mod('thim_404_custom_text')) ? get_theme_mod('thim_404_custom_text') : 'Sorry, we couldn\'t find the page you\'re looking for.' ;
?>
<section class="error-404 not-found">
	<div class="page-content">
		<img src="<?php echo esc_url($image ); ?>" alt="404 Page" />
		<h3> <?php echo esc_html__($text, 'sailing'); ?> </h3>
 	</div>
	<!-- .page-content -->
</section>

<?php
/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer(); ?>