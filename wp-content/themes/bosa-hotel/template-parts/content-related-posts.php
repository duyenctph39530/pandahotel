<?php
/**
 * Template part for displaying related posts in single.php
 *
 * @since Bosa Hotel 1.0.0
 */

?>

<?php
	$bosa_hotel_post_ids[] = get_the_ID();
	$bosa_hotel_posts_count = get_theme_mod( 'related_posts_count', 4 );
	$bosa_hotel_args = bosa_hotel_get_related_posts( array( 'category', 'post_tag' ), $bosa_hotel_posts_count, true  );
	$bosa_hotel_query = new WP_Query( apply_filters( 'bosa_hotel_related_posts_args', $bosa_hotel_args ) );
	if( $bosa_hotel_query->have_posts() ) {
		while ( $bosa_hotel_query->have_posts() ){
			$bosa_hotel_query->the_post();
			array_push( $bosa_hotel_post_ids, get_the_ID() );		
			?>
			<div class="col-12 col-md-6 col-lg-3">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
				        <figure class="featured-image">
				            <a href="<?php the_permalink(); ?>">
				                <?php 
				                $bosa_hotel_render_related_post_image_size = get_theme_mod( 'render_related_post_image_size', 'bosa-hotel-420-300' );
				                bosa_hotel_image_size( $bosa_hotel_render_related_post_image_size ); ?>
				            </a>
				        </figure>
				   <?php endif; ?>
				    <div class="entry-content">
						<header class="entry-header">
							<?php
								the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
							?>
						</header><!-- .entry-header -->
					</div><!-- .entry-content -->
				</article><!-- #post-->
			</div>
		<?php
		}
		wp_reset_postdata();
	}
	else {
		echo '<div class="col-12">';
		echo '<p class="not-found">';
		esc_html_e( 'No Related Post', 'bosa-hotel' );
		echo '</p>';
		echo '</div>';
	}
?>

