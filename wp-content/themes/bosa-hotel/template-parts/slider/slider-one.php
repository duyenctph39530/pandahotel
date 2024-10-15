<?php
$bosa_hotel_width_control = '';
if( get_theme_mod( 'slider_width_controls', 'full' ) == 'boxed' ){
	$bosa_hotel_width_control = 'container boxed';
}

$bosa_hotel_slider_layout = 'slider-layout-one';
$bosa_hotel_posts_per_page_count = get_theme_mod( 'slider_posts_number', 6 );
$bosa_hotel_slider_id = get_theme_mod( 'slider_category', '' );

$bosa_hotel_query = new WP_Query( apply_filters( 'bosa_hotel_blog_args', array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => $bosa_hotel_posts_per_page_count,
	'cat'                 => $bosa_hotel_slider_id,
	'offset'              => 0,
	'ignore_sticky_posts' => 1
)));

$bosa_hotel_posts_array = $bosa_hotel_query->get_posts(); ?>

<div class="main-slider-wrap <?php echo esc_attr( $bosa_hotel_slider_layout ); ?> <?php echo esc_attr( $bosa_hotel_width_control ); ?>">
	<div class="main-slider">
		<?php
			while ( $bosa_hotel_query->have_posts() ) : $bosa_hotel_query->the_post();
			$bosa_hotel_render_slider_image 	= get_theme_mod( 'render_slider_image_size', 'bosa-hotel-1370-550' );
			$bosa_hotel_image 					= get_the_post_thumbnail_url( get_the_ID(), $bosa_hotel_render_slider_image );
		?>
			<div class="slide-item">
				<div class="banner-img" style="background-image: url( <?php echo esc_url( $bosa_hotel_image ); ?> );">
					<?php
					$bosa_hotel_alignmentClass = 'text-center';
					if ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'left' ){
						$bosa_hotel_alignmentClass = 'text-left';
					}elseif ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'right' ){
						$bosa_hotel_alignmentClass = 'text-right';
					}
					?>
					<div class="slide-inner">
						<div class="banner-content <?php echo esc_attr( $bosa_hotel_alignmentClass ); ?>">
						    <div class="entry-content">
						    	<header class="entry-header">
									<?php
									if( !get_theme_mod( 'hide_slider_category', false ) ){
										bosa_hotel_entry_header();
									}
									if ( is_singular() ) :
										the_title( '<h1 class="entry-title">', '</h1>' );
									else :
										if ( !get_theme_mod( 'hide_slider_title', false ) ){
											the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
										}
									endif; 
									
									?>
								</header><!-- .entry-header -->
								<div class="entry-meta">
									<?php
										if( !get_theme_mod( 'hide_slider_date', false ) ): ?>
											<span class="posted-on">
												<a href="<?php echo esc_url( bosa_hotel_get_day_link() ); ?>" >
													<?php echo esc_html(get_the_date('M j, Y')); ?>
												</a>
											</span>
										<?php endif; 
										if( !get_theme_mod( 'hide_slider_author', false ) ): ?>
											<span class="byline">
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
													<?php echo esc_html( get_the_author() ); ?>
												</a>
											</span>
										<?php endif; 
										if( !get_theme_mod( 'hide_slider_comment', false ) ):
											echo '<span class="comments-link">';
											comments_popup_link(
												sprintf(
													wp_kses(
														/* translators: %s: post title */
														__( 'Comment<span class="screen-reader-text"> on %s</span>', 'bosa-hotel' ),
														array(
															'span' => array(
																'class' => array(),
															),
														)
													),
													esc_html( get_the_title() ) 
												)
											);
											echo '</span>';
										endif;
									?>
						        </div><!-- .entry-meta -->
								
								<?php if ( !get_theme_mod( 'hide_slider_excerpt', false ) || !get_theme_mod( 'hide_slider_button', false ) ){ ?>
						        	<div class="entry-text">
										<?php
											if ( !get_theme_mod( 'hide_slider_excerpt', false ) ){
												$bosa_hotel_excerpt_length = get_theme_mod( 'slider_excerpt_length', 25 );
												bosa_hotel_excerpt( $bosa_hotel_excerpt_length , true );
											}
											if( !get_theme_mod( 'hide_slider_button', false ) ){
												$bosa_hotel_slider_btn_defaults = array(
													array(
														'slider_btn_type' 			=> 'button-outline',
														'slider_btn_bg_color' 		=> '#C9A76E',
														'slider_btn_border_color' 	=> '#ffffff',
														'slider_btn_text_color' 	=> '#ffffff',
														'slider_btn_hover_color' 	=> '#E4A853',
														'slider_btn_text' 			=> '',
														'slider_btn_radius' 		=> 0,
													),		
												);
										        $bosa_hotel_slider_button = get_theme_mod( 'main_slider_button_repeater', $bosa_hotel_slider_btn_defaults );
										        
										        if( !empty( $bosa_hotel_slider_button ) && is_array( $bosa_hotel_slider_button ) ){ ?>
										        	<div class="button-container">
										        		<?php
												            $bosa_hotel_count = 0.2;
												            foreach( $bosa_hotel_slider_button as $bosa_hotel_value ){
												            	if( !empty( $bosa_hotel_value['slider_btn_text'] ) ){ ?>
																	<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $bosa_hotel_value['slider_btn_type'] ); ?>">
																		<?php
																			echo esc_html( $bosa_hotel_value['slider_btn_text'] );
																		?>
																	</a>
																	<?php
												                	$bosa_hotel_count = $bosa_hotel_count + 0.2;
												                }
												            }
												        ?>
												    </div>
												    <?php  
												}
											} 
										?>
									</div>
								<?php } ?>
							</div><!-- .entry-content -->
						</div>
					</div>
					<div class="overlay"></div>
				</div>
			</div>
		<?php
		endwhile; 
		wp_reset_postdata();
		?>
	</div>
	<?php if( !get_theme_mod( 'disable_slider_arrows', false ) ) { ?>
		<ul class="slick-control">
	        <li class="main-slider-prev">
	        	<span></span>
	        </li>
	        <li class="main-slider-next">
	        	<span></span>
	        </li>
	    </ul>
	<?php } ?>
	<?php if ( !get_theme_mod( 'disable_slider_dots', false ) ){ ?>
		<div class="main-slider-dots"></div>
	<?php } ?>
</div>