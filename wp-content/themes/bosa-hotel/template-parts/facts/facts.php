<?php
$bosa_hotel_fact_one_title 	= get_theme_mod( 'fact_one_title', '' );
$bosa_hotel_fact_one_content   = get_theme_mod( 'fact_one_content', '' );

$bosa_hotel_fact_two_title 	= get_theme_mod( 'fact_two_title', '' );
$bosa_hotel_fact_two_content   = get_theme_mod( 'fact_two_content', '' );

$bosa_hotel_fact_three_title   = get_theme_mod( 'fact_three_title', '' );
$bosa_hotel_fact_three_content = get_theme_mod( 'fact_three_content', '' );

$bosa_hotel_fact_four_title    = get_theme_mod( 'fact_four_title', '' );
$bosa_hotel_fact_four_content  = get_theme_mod( 'fact_four_content', '' );


$bosa_hotel_fact_array = array();
$bosa_hotel_has_fact = false;
if( !empty( $bosa_hotel_fact_one_title) || !empty($bosa_hotel_fact_one_content ) ){
	$bosa_hotel_has_fact = true;
	$bosa_hotel_fact_array['fact_one'] = array(
		'title' => $bosa_hotel_fact_one_title,
		'content' => $bosa_hotel_fact_one_content,
	);
}
if( !empty($bosa_hotel_fact_two_title) || !empty($bosa_hotel_fact_two_content ) ){
	$bosa_hotel_has_fact = true;
	$bosa_hotel_fact_array['fact_two'] = array(
		'title' => $bosa_hotel_fact_two_title,
		'content' => $bosa_hotel_fact_two_content,
	);
}
if( !empty( $bosa_hotel_fact_three_title) || !empty($bosa_hotel_fact_three_content) ){
	$bosa_hotel_has_fact = true;
	$bosa_hotel_fact_array['fact_three'] = array(
		'title' => $bosa_hotel_fact_three_title,
		'content' => $bosa_hotel_fact_three_content,
	);
}
if( !empty( $bosa_hotel_fact_four_title) || !empty($bosa_hotel_fact_four_content) ){
	$bosa_hotel_has_fact = true;
	$bosa_hotel_fact_array['fact_four'] = array(
		'title' => $bosa_hotel_fact_four_title,
		'content' => $bosa_hotel_fact_four_content,
	);
}

if( !get_theme_mod( 'disable_facts_section', true ) && $bosa_hotel_has_fact ){ ?>
	<section class="section-facts-area">
		<div class="row justify-content-center flex-row-container align-items-start">
			<?php foreach( $bosa_hotel_fact_array as $bosa_hotel_each_fact ){ ?>
				<div class="col-sm-6 col-md-4 col-lg-3 flex-grow-1 flex-col-container">
					<article class="info-content-wrap">					
						<div class="entry-content">
							<header class="entry-header">
								<h3 class="entry-title">
									<?php echo esc_html( $bosa_hotel_each_fact['title'] ); ?>
								</h3>
								<p>
								<?php echo esc_html( $bosa_hotel_each_fact['content'] ); ?>
								</p>
							</header>
						</div>
					</article>
				</div>
			<?php } ?>
		</div>
	</section>
<?php }