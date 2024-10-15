<?php
$bosa_hotel_blogAdvertoneID = get_theme_mod( 'blog_promotions_one','');
$bosa_hotel_blogDiscountoneLabel = get_theme_mod( 'blog_advert_one_label', '');
$bosa_hotel_blogAdverttwoID = get_theme_mod( 'blog_promotions_two','');       
$bosa_hotel_blogDiscounttwoLabel = get_theme_mod( 'blog_advert_two_label', '');
$bosa_hotel_blogAdvertthreeID = get_theme_mod( 'blog_promotions_three','');
$bosa_hotel_blogDiscountthreeLabel = get_theme_mod( 'blog_advert_three_label', '');

$bosa_hotel_Advert_array = array();
$bosa_hotel_has_Advert = false;
$bosa_hotel_has_label = false;
if( !empty( $bosa_hotel_blogAdvertoneID ) || !empty( $bosa_hotel_blogDiscountoneLabel ) ){
	$bosa_hotel_blog_promotions_one  = wp_get_attachment_image_src( $bosa_hotel_blogAdvertoneID,'bosa-hotel-420-300');
 	if ( is_array(  $bosa_hotel_blog_promotions_one ) ){
 		$bosa_hotel_has_Advert = true;
 		$bosa_hotel_has_label = true;
   	 	$bosa_hotel_blog_promotionss_one = $bosa_hotel_blog_promotions_one[0];
   	 	$bosa_hotel_Advert_array['image_one'] = array(
			'ID' => $bosa_hotel_blog_promotionss_one,
			'discount_label' => $bosa_hotel_blogDiscountoneLabel,
		);	
  	}
}
if( !empty( $bosa_hotel_blogAdverttwoID  ) || !empty( $bosa_hotel_blogDiscounttwoLabel ) ){
	$bosa_hotel_blog_promotions_two = wp_get_attachment_image_src( $bosa_hotel_blogAdverttwoID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_promotions_two ) ){
		$bosa_hotel_has_Advert = true;
		$bosa_hotel_has_label = true;	
        $bosa_hotel_blog_promotionss_two = $bosa_hotel_blog_promotions_two[0];
        $bosa_hotel_Advert_array['image_two'] = array(
			'ID' => $bosa_hotel_blog_promotionss_two,
			'discount_label' => $bosa_hotel_blogDiscounttwoLabel,
		);	
  	}
}
if( !empty( $bosa_hotel_blogAdvertthreeID ) || !empty( $bosa_hotel_blogDiscountthreeLabel )){	
	$bosa_hotel_blog_promotions_three = wp_get_attachment_image_src( $bosa_hotel_blogAdvertthreeID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_promotions_three ) ){
		$bosa_hotel_has_Advert = true;
		$bosa_hotel_has_label = true;
      	$bosa_hotel_blog_promotionss_three = $bosa_hotel_blog_promotions_three[0];
      	$bosa_hotel_Advert_array['image_three'] = array(
			'ID' => $bosa_hotel_blog_promotionss_three,
			'discount_label' => $bosa_hotel_blogDiscountthreeLabel,
		);	
  	}
}

if( !get_theme_mod( 'disable_promotions_section', true ) && $bosa_hotel_has_Advert && $bosa_hotel_has_label ){ ?>
	<section class="section-promotions-area">
		<div class="content-wrap">
			<div class="row justify-content-center">
				<?php foreach( $bosa_hotel_Advert_array as $bosa_hotel_each_Advert ){ ?>
					<div class="col-sm-6 col-md-4">
						<article class="promotions-content-wrap">
							<figure class= "featured-image">
								<?php if( !empty( $bosa_hotel_each_Advert['discount_label'] ) ) { ?>
									<span class="overlay-txt">
										<?php echo esc_html( $bosa_hotel_each_Advert['discount_label'] ); ?>
									</span>
								<?php } ?>
								<img src="<?php echo esc_url( $bosa_hotel_each_Advert['ID'] ); ?>">
							</figure>
						</article>
					</div>
				<?php } ?>
			</div>	
		</div>
	</section>
<?php } 