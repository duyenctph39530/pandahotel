<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bosa Hotel
 */

get_header();
?>
	<?php
		$bosa_hotel_render_error404_image_size = get_theme_mod( 'render_error404_image_size', 'full' );
		$bosa_hotel_error404_image_id 			= get_theme_mod( 'error404_image', '' );
		$bosa_hotel_get_error404_image_array 	= wp_get_attachment_image_src( $bosa_hotel_error404_image_id, $bosa_hotel_render_error404_image_size );
		if( is_array( $bosa_hotel_get_error404_image_array ) ){
			$bosa_hotel_error404_image = $bosa_hotel_get_error404_image_array[0];
		}else{
			$bosa_hotel_error404_image = get_theme_file_uri( '/assets/images/bosa-hotel-360-200.jpg' );
		}
	?>
	<div id="content" class="site-content">
		<div class="container">
			<section class="error-404 not-found">
				<div class="inner-content">
					<header class="page-header">
						<h1 class="title-404" style="background-image: url( <?php echo esc_url( $bosa_hotel_error404_image ); ?> );"><?php echo esc_html__( '404', 'bosa-hotel' ); ?></h1>
						<h2 class="page-title"><?php echo esc_html__( 'Oops! that page can&rsquo;t be found.', 'bosa-hotel' ); ?></h2>
						<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'bosa-hotel' ); ?></p>
					</header><!-- .page-header -->
					<div class="error-404-form">
						<?php get_search_form(); ?>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- #container -->
	</div><!-- #content -->
<?php
get_footer();
