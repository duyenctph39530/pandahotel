<?php
$bosa_hotel_blogfolloweroneID = get_theme_mod( 'blog_follower_one','' );
$bosa_hotel_blogfollowertwoID = get_theme_mod( 'blog_follower_two','' );       
$bosa_hotel_blogfollowerthreeID = get_theme_mod( 'blog_follower_three','' );
$bosa_hotel_blogfollowerfourID = get_theme_mod( 'blog_follower_four','' );
$bosa_hotel_blogfollowerfiveID = get_theme_mod( 'blog_follower_five','' );
$bosa_hotel_blogfollowersixID = get_theme_mod( 'blog_follower_six','' );


$bosa_hotel_follower_array = array();
$bosa_hotel_has_follower = false;
if( !empty( $bosa_hotel_blogfolloweroneID ) ){
	$bosa_hotel_blog_follower_one  = wp_get_attachment_image_src( $bosa_hotel_blogfolloweroneID,'bosa-hotel-420-300');
 	if ( is_array(  $bosa_hotel_blog_follower_one ) ){
 		$bosa_hotel_has_follower = true;
   	 	$bosa_hotel_blog_followers_one = $bosa_hotel_blog_follower_one[0];
   	 	$bosa_hotel_follower_array['image_one'] = array(
			'ID' => $bosa_hotel_blog_followers_one,
		);	
  	}
}
if( !empty( $bosa_hotel_blogfollowertwoID ) ){
	$bosa_hotel_blog_follower_two = wp_get_attachment_image_src( $bosa_hotel_blogfollowertwoID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_follower_two ) ){
		$bosa_hotel_has_follower = true;	
        $bosa_hotel_blog_followers_two = $bosa_hotel_blog_follower_two[0];
        $bosa_hotel_follower_array['image_two'] = array(
			'ID' => $bosa_hotel_blog_followers_two,
		);	
  	}
}
if( !empty( $bosa_hotel_blogfollowerthreeID ) ){	
	$bosa_hotel_blog_follower_three = wp_get_attachment_image_src( $bosa_hotel_blogfollowerthreeID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_follower_three ) ){
		$bosa_hotel_has_follower = true;
      	$bosa_hotel_blog_followers_three = $bosa_hotel_blog_follower_three[0];
      	$bosa_hotel_follower_array['image_three'] = array(
			'ID' => $bosa_hotel_blog_followers_three,
		);	
  	}
}
if( !empty( $bosa_hotel_blogfollowerfourID ) ){	
	$bosa_hotel_blog_follower_four = wp_get_attachment_image_src( $bosa_hotel_blogfollowerfourID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_follower_four ) ){
		$bosa_hotel_has_follower = true;
      	$bosa_hotel_blog_followers_four = $bosa_hotel_blog_follower_four[0];
      	$bosa_hotel_follower_array['image_four'] = array(
			'ID' => $bosa_hotel_blog_followers_four,
		);	
  	}
}
if( !empty( $bosa_hotel_blogfollowerfiveID ) ){	
	$bosa_hotel_blog_follower_five = wp_get_attachment_image_src( $bosa_hotel_blogfollowerfiveID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_follower_five ) ){
		$bosa_hotel_has_follower = true;
      	$bosa_hotel_blog_followers_five = $bosa_hotel_blog_follower_five[0];
      	$bosa_hotel_follower_array['image_five'] = array(
			'ID' => $bosa_hotel_blog_followers_five,
		);	
  	}
}
if( !empty( $bosa_hotel_blogfollowersixID ) ){	
	$bosa_hotel_blog_follower_six = wp_get_attachment_image_src( $bosa_hotel_blogfollowersixID,'bosa-hotel-420-300');
	if ( is_array(  $bosa_hotel_blog_follower_six ) ){
		$bosa_hotel_has_follower = true;
      	$bosa_hotel_blog_followers_six = $bosa_hotel_blog_follower_six[0];
      	$bosa_hotel_follower_array['image_six'] = array(
			'ID' => $bosa_hotel_blog_followers_six,
		);	
  	}
}

if( !get_theme_mod( 'disable_followers_section', true ) && ($bosa_hotel_has_follower || !empty( get_theme_mod( 'followers_tagline_title', '' ) ) || !empty( get_theme_mod( 'followers_info_one', '' ) ) || !empty( get_theme_mod( 'followers_info_two', '' ) ) ) ){ ?>
	<section class="section-follower-area">
		<div class="follower-content-wrap">
			<div class="section-title-wrap">
				<?php if (!empty( get_theme_mod( 'followers_tagline_title', '' ) ) ){ ?>
					<h2 class="follower-title section-title">
						<?php echo esc_html( get_theme_mod( 'followers_tagline_title', '' ) ); ?>
					</h2>
				<?php } ?>
				<p class="follower-info">
					<?php echo esc_html( get_theme_mod('followers_info_one', '') ); ?>
				</p>
				<p class="follower-info">
					<?php echo esc_html( get_theme_mod('followers_info_two', '') ); ?>
				</p>
			</div>
			<?php if($bosa_hotel_has_follower) { ?>
			<article class="follower-item">
				<?php foreach( $bosa_hotel_follower_array as $bosa_hotel_each_follower ){ ?>
					<figure class= "featured-image">
						<img src="<?php echo esc_url( $bosa_hotel_each_follower['ID'] ); ?>">
					</figure>
				<?php } ?>
			</article>
		<?php } ?>
		</div>
	</section>
<?php }