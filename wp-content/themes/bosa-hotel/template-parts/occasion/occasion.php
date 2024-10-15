<?php
$bosa_hotel_page_one 	= get_theme_mod( 'blog_occasion_page_one', '' );
$bosa_hotel_page_two 	= get_theme_mod( 'blog_occasion_page_two', '' );
$bosa_hotel_page_three = get_theme_mod( 'blog_occasion_page_three', '' );
$bosa_hotel_page_four  = get_theme_mod( 'blog_occasion_page_four', '' );
$bosa_hotel_page_five  = get_theme_mod( 'blog_occasion_page_five', '');

$bosa_hotel_page_array = array();
$bosa_hotel_has_array = false;
$bosa_hotel_has_page = false;
if( !empty( $bosa_hotel_page_one ) ){
	$bosa_hotel_has_page = true;	
}
if( !empty( $bosa_hotel_page_two ) ){
	$bosa_hotel_has_page = true;
	$bosa_hotel_has_array = true;
	$bosa_hotel_page_array['page_two'] = array(
		'ID' => $bosa_hotel_page_two,
	);
}
if( !empty( $bosa_hotel_page_three ) ){
	$bosa_hotel_has_page = true;
	$bosa_hotel_has_array = true;
	$bosa_hotel_page_array['page_three'] = array(
		'ID' => $bosa_hotel_page_three,
	);
}
if( !empty( $bosa_hotel_page_four ) ){
	$bosa_hotel_has_page = true;
	$bosa_hotel_has_array = true;
	$bosa_hotel_page_array['page_four'] = array(
		'ID' => $bosa_hotel_page_four,
	);
}
if( !empty( $bosa_hotel_page_five ) ){
	$bosa_hotel_has_page = true;
	$bosa_hotel_has_array = true;
	$bosa_hotel_page_array['page_five'] = array(
		'ID' => $bosa_hotel_page_five,
	);
}

if( !get_theme_mod( 'disable_occasion_section', true ) && $bosa_hotel_has_page ){ ?>
	<section class="section-occasion-area">
		<?php if( !empty( $bosa_hotel_page_one ) ){ ?>
			<div class="section-title-wrap col-lg-6 col-md-8 offset-lg-3 offset-md-2 text-center">
				<h2 class="section-title">
					<a href="<?php echo esc_url( get_permalink( $bosa_hotel_page_one ) ); ?>">
						<?php echo esc_html( get_the_title( $bosa_hotel_page_one ) ); ?>
					</a>
				</h2>
				<p>
					<?php 
					$bosa_hotel_excerpt = get_the_excerpt( $bosa_hotel_page_one );
					$bosa_hotel_result  = wp_trim_words( $bosa_hotel_excerpt, 10, '' );
					echo esc_html( $bosa_hotel_result );?>	
				</p>
			</div>
		<?php }
		if ( $bosa_hotel_has_array ){ ?>
			<div class="row">
				<?php foreach( $bosa_hotel_page_array as $bosa_hotel_each_page ){ ?>
					<div class="col-md-6 column">
						<article class="occasion-iconbox">
							<div class="occasion-icon">
								<i class="fas fa-calendar-day"></i>
							</div>
							<div class="entry-content">
								<h3 class="entry-title">
									<a href="<?php echo esc_url( get_permalink( $bosa_hotel_each_page[ 'ID' ] ) ); ?>">
										<?php echo esc_html( get_the_title( $bosa_hotel_each_page[ 'ID' ] ) ); ?>
									</a>
								</h3>
								<div class="entry-text">
									<?php 
									$bosa_hotel_excerpt = get_the_excerpt( $bosa_hotel_each_page[ 'ID' ] );
									$bosa_hotel_result  = wp_trim_words( $bosa_hotel_excerpt, 10, '' );
									echo esc_html( $bosa_hotel_result );
									?>
								</div>
							</div>
						</article>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</section>	
<?php }