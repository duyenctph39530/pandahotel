<?php


//-----------------------------Site Identity Color----------------

	$luxestay_hotel_site_identity_color = get_theme_mod('luxestay_hotel_site_identity_color');
	$luxestay_hotel_site_identity_tagline_color = get_theme_mod('luxestay_hotel_site_identity_tagline_color');

	


//=====================Whole CSS===================================


	$custom_css ='.display_only h1 a,.display_only p{';
	
	$custom_css .='}';





//==============Main Setting Section===========================================


// ----------------Site Identity Color--------------------

	if($luxestay_hotel_site_identity_color != false){
		$custom_css .='.display_only h1 a{';
			if($luxestay_hotel_site_identity_color != false)
		    	$custom_css .='color: '.esc_html($luxestay_hotel_site_identity_color).'!important;';
		$custom_css .='}';
	}

	if($luxestay_hotel_site_identity_tagline_color != false){
		$custom_css .='.display_only p{';
			if($luxestay_hotel_site_identity_tagline_color != false)
		    	$custom_css .='color: '.esc_html($luxestay_hotel_site_identity_tagline_color).'!important;';
		$custom_css .='}';
	}



?>