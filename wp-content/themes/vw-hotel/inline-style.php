<?php

	/*-----------------------First highlight color-------------------*/

	$vw_hotel_first_color = get_theme_mod('vw_hotel_first_color');

	$vw_hotel_custom_css = '';

	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='.search-box i, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, .more-btn a, .overlay-bttn a, input[type="submit"], .footer .tagcloud a:hover, .footer-2, .scrollup i, .sidebar input[type="submit"], .sidebar .tagcloud a:hover, .blogbutton-small, .pagination span, .pagination a, nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce span.onsale, #comments a.comment-reply-link, .toggle-nav i, a.button, .sidebar .widget_price_filter .ui-slider .ui-slider-range, .sidebar .widget_price_filter .ui-slider .ui-slider-handle, .sidebar .woocommerce-product-search button, .footer .widget_price_filter .ui-slider .ui-slider-range, .footer .widget_price_filter .ui-slider .ui-slider-handle, .footer .woocommerce-product-search button, .footer a.custom_read_more, .sidebar a.custom_read_more, .footer .custom-social-icons i:hover, .sidebar .custom-social-icons i:hover, .nav-previous a, .nav-next a, .woocommerce nav.woocommerce-pagination ul li a, #preloader, .footer .wp-block-search .wp-block-search__button, .sidebar .wp-block-search .wp-block-search__button,.bradcrumbs a:hover, .bradcrumbs span,.post-categories li a, nav.navigation.posts-navigation .nav-previous a, nav.navigation.posts-navigation .nav-next a, .sidebar label.wp-block-search__label, .sidebar .wp-block-heading, .wp-block-tag-cloud a:hover, .wp-block-button__link{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_first_color).';';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='#comments input[type="submit"].submit, .sidebar ul li::before, .sidebar ul.cart_list li::before, .sidebar ul.product_list_widget li::before,.wp-block-woocommerce-cart .wc-block-cart__submit-button, .wc-block-components-checkout-place-order-button, .wc-block-components-totals-coupon__button,.wc-block-components-order-summary-item__quantity{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_first_color).'!important;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='a, .more-btn a:hover, .overlay-bttn a:hover, .footer h3, .post-info i, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .woocommerce-info::before,.logo h1 a,p.site-description,.footer li a:hover, .sidebar ul li a:hover, .main-navigation ul.sub-menu a:hover, .main-navigation a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .logo h1 a, .logo p.site-title a, .footer .custom-social-icons i, .sidebar .custom-social-icons i, .post-main-box:hover h2 a, .post-main-box:hover .post-info a, .single-post .post-info:hover a, .about-category h4 a:hover, #about-hotel h3 a:hover, #slider .inner_carousel h1 a:hover, .footer .wp-block-search .wp-block-search__label{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_first_color).';';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='.footer .custom-social-icons i, .sidebar .custom-social-icons i, .footer .custom-social-icons i:hover, .sidebar .custom-social-icons i:hover{';
			$vw_hotel_custom_css .='border-color: '.esc_attr($vw_hotel_first_color).';';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='hr.hrclass, .woocommerce-info, .main-navigation ul ul{';
			$vw_hotel_custom_css .='border-top-color: '.esc_attr($vw_hotel_first_color).';';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='.main-navigation ul ul, .header-fixed{';
			$vw_hotel_custom_css .='border-bottom-color: '.esc_attr($vw_hotel_first_color).';';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_first_color != false){
		$vw_hotel_custom_css .='.post-main-box:hover{
		box-shadow: 0 0 10px 1px '.esc_attr($vw_hotel_first_color).';
		}';
	}

	/*---------------- Width Layout -------------------*/

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_width_option','Full Width');
    if($vw_hotel_theme_lay == 'Boxed'){
		$vw_hotel_custom_css .='body{';
			$vw_hotel_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='right: 100px;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.scrollup.left i{';
			$vw_hotel_custom_css .='left: 100px;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Wide Width'){
		$vw_hotel_custom_css .='body{';
			$vw_hotel_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='right: 30px;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.scrollup.left i{';
			$vw_hotel_custom_css .='left: 30px;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Full Width'){
		$vw_hotel_custom_css .='body{';
			$vw_hotel_custom_css .='max-width: 100%;';
		$vw_hotel_custom_css .='}';
	}

	/*--------------- Slider Opacity -------------------*/

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_slider_opacity_color','0.7');
	if($vw_hotel_theme_lay == '0'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.1'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.1';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.2'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.2';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.3'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.3';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.4'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.4';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.5'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.5';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.6'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.6';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.7'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.7';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.8'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.8';
		$vw_hotel_custom_css .='}';
		}else if($vw_hotel_theme_lay == '0.9'){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:0.9';
		$vw_hotel_custom_css .='}';
		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$vw_hotel_slider_image_overlay = get_theme_mod('vw_hotel_slider_image_overlay', true);
	if($vw_hotel_slider_image_overlay == false){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='opacity:1;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_slider_image_overlay_color = get_theme_mod('vw_hotel_slider_image_overlay_color', true);
	if($vw_hotel_slider_image_overlay_color != false){
		$vw_hotel_custom_css .='#slider{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_slider_image_overlay_color).';';
		$vw_hotel_custom_css .='}';
	}

	/*------------------Slider Content Layout -------------------*/

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_slider_content_option','Center');
    if($vw_hotel_theme_lay == 'Left'){
		$vw_hotel_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_hotel_custom_css .='text-align:left; left:15%; right:45%;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Center'){
		$vw_hotel_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_hotel_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Right'){
		$vw_hotel_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_hotel_custom_css .='text-align:right; left:45%; right:15%;';
		$vw_hotel_custom_css .='}';
	}

	/*------------- Slider Content Padding Settings ------------------*/

	$vw_hotel_slider_content_padding_top_bottom = get_theme_mod('vw_hotel_slider_content_padding_top_bottom');
	$vw_hotel_slider_content_padding_left_right = get_theme_mod('vw_hotel_slider_content_padding_left_right');
	if($vw_hotel_slider_content_padding_top_bottom != false || $vw_hotel_slider_content_padding_left_right != false){
		$vw_hotel_custom_css .='#slider .carousel-caption{';
			$vw_hotel_custom_css .='top: '.esc_attr($vw_hotel_slider_content_padding_top_bottom).'; bottom: '.esc_attr($vw_hotel_slider_content_padding_top_bottom).';left: '.esc_attr($vw_hotel_slider_content_padding_left_right).';right: '.esc_attr($vw_hotel_slider_content_padding_left_right).';';
		$vw_hotel_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_hotel_slider_height = get_theme_mod('vw_hotel_slider_height');
	if($vw_hotel_slider_height != false){
		$vw_hotel_custom_css .='#slider img{';
			$vw_hotel_custom_css .='height: '.esc_attr($vw_hotel_slider_height).';';
		$vw_hotel_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_hotel_slider = get_theme_mod('vw_hotel_slider_hide_show');
	if($vw_hotel_slider == false){
		$vw_hotel_custom_css .='.page-template-custom-home-page .home-page-header{';
			$vw_hotel_custom_css .='margin-bottom: 20px; position: static; background: #212121;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='#about-hotel{';
			$vw_hotel_custom_css .='margin-top: 5em;';
		$vw_hotel_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_blog_layout_option','Default');
    if($vw_hotel_theme_lay == 'Default'){
		$vw_hotel_custom_css .='.post-main-box{';
			$vw_hotel_custom_css .='';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Center'){
		$vw_hotel_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$vw_hotel_custom_css .='text-align:center;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.post-info{';
			$vw_hotel_custom_css .='margin-top:10px;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_theme_lay == 'Left'){
		$vw_hotel_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p{';
			$vw_hotel_custom_css .='text-align:Left;';
		$vw_hotel_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$vw_hotel_blog_page_posts_settings = get_theme_mod( 'vw_hotel_blog_page_posts_settings','Into Blocks');
		if($vw_hotel_blog_page_posts_settings == 'Without Blocks'){
		$vw_hotel_custom_css .='.post-main-box{';
			$vw_hotel_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_hotel_custom_css .='}';
	}

	/*--------------------- Grid Posts -------------------*/

	$vw_hotel_display_grid_posts_settings = get_theme_mod( 'vw_hotel_display_grid_posts_settings','Into Blocks');
    if($vw_hotel_display_grid_posts_settings == 'Without Blocks'){
		$vw_hotel_custom_css .='.grid-post-main-box{';
			$vw_hotel_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_hotel_custom_css .='}';
	}

	/*-----------------Responsive Media -----------------------*/

	$vw_hotel_resp_stickyheader = get_theme_mod( 'vw_hotel_stickyheader_hide_show',false);
	if($vw_hotel_resp_stickyheader == true && get_theme_mod( 'vw_hotel_sticky_header',false) != true){
    	$vw_hotel_custom_css .='.header-fixed{';
			$vw_hotel_custom_css .='position:static;';
		$vw_hotel_custom_css .='} ';
	}
    if($vw_hotel_resp_stickyheader == true){
    	$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='.header-fixed{';
			$vw_hotel_custom_css .='position:fixed;';
		$vw_hotel_custom_css .='} }';
	}else if($vw_hotel_resp_stickyheader == false){
		$vw_hotel_custom_css .='@media screen and (max-width:575px){';
		$vw_hotel_custom_css .='.header-fixed{';
			$vw_hotel_custom_css .='position:static;';
		$vw_hotel_custom_css .='} }';
	}

	$vw_hotel_resp_slider = get_theme_mod( 'vw_hotel_resp_slider_hide_show',true);
	if($vw_hotel_resp_slider == true && get_theme_mod( 'vw_hotel_slider_hide_show', false) == false){
    	$vw_hotel_custom_css .='#slider{';
			$vw_hotel_custom_css .='display:none;';
		$vw_hotel_custom_css .='} ';
	}
    if($vw_hotel_resp_slider == true){
    	$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='#slider{';
			$vw_hotel_custom_css .='display:block;';
		$vw_hotel_custom_css .='} }';
	}else if($vw_hotel_resp_slider == false){
		$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='#slider{';
			$vw_hotel_custom_css .='display:none;';
		$vw_hotel_custom_css .='} }';
	}

	$vw_hotel_resp_sidebar = get_theme_mod( 'vw_hotel_sidebar_hide_show',true);
    if($vw_hotel_resp_sidebar == true){
    	$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='.sidebar{';
			$vw_hotel_custom_css .='display:block;';
		$vw_hotel_custom_css .='} }';
	}else if($vw_hotel_resp_sidebar == false){
		$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='.sidebar{';
			$vw_hotel_custom_css .='display:none;';
		$vw_hotel_custom_css .='} }';
	}

	$vw_hotel_resp_scroll_top = get_theme_mod( 'vw_hotel_resp_scroll_top_hide_show',true);
	if($vw_hotel_resp_scroll_top == true && get_theme_mod( 'vw_hotel_hide_show_scroll',true) != true){
    	$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='visibility:hidden !important;';
		$vw_hotel_custom_css .='} ';
	}
    if($vw_hotel_resp_scroll_top == true){
    	$vw_hotel_custom_css .='@media screen and (max-width:575px) {';
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='visibility:visible !important;';
		$vw_hotel_custom_css .='} }';
	}else if($vw_hotel_resp_scroll_top == false){
		$vw_hotel_custom_css .='@media screen and (max-width:575px){';
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='visibility:hidden !important;';
		$vw_hotel_custom_css .='} }';
	}

	$vw_hotel_resp_menu_toggle_btn_bg_color = get_theme_mod('vw_hotel_resp_menu_toggle_btn_bg_color');
	if($vw_hotel_resp_menu_toggle_btn_bg_color != false){
		$vw_hotel_custom_css .='.toggle-nav i{';
			$vw_hotel_custom_css .='background: '.esc_attr($vw_hotel_resp_menu_toggle_btn_bg_color).';';
		$vw_hotel_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_hotel_sticky_header_padding = get_theme_mod('vw_hotel_sticky_header_padding');
	if($vw_hotel_sticky_header_padding != false){
		$vw_hotel_custom_css .='.header-fixed{';
			$vw_hotel_custom_css .='padding: '.esc_attr($vw_hotel_sticky_header_padding).';';
		$vw_hotel_custom_css .='}';
	}

	/*-------------- Menus Settings ----------------*/

	$vw_hotel_navigation_menu_font_size = get_theme_mod('vw_hotel_navigation_menu_font_size');
	if($vw_hotel_navigation_menu_font_size != false){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_navigation_menu_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_navigation_menu_font_weight = get_theme_mod('vw_hotel_navigation_menu_font_weight','600');
	if($vw_hotel_navigation_menu_font_weight != false){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='font-weight: '.esc_attr($vw_hotel_navigation_menu_font_weight).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_menu_text_transform','Capitalize');
	if($vw_hotel_theme_lay == 'Capitalize'){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='text-transform:Capitalize;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Lowercase'){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='text-transform:Lowercase;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Uppercase'){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='text-transform:Uppercase;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_header_menus_color = get_theme_mod('vw_hotel_header_menus_color');
	if($vw_hotel_header_menus_color != false){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_header_menus_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_header_menus_hover_color = get_theme_mod('vw_hotel_header_menus_hover_color');
	if($vw_hotel_header_menus_hover_color != false){
		$vw_hotel_custom_css .='.main-navigation a:hover{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_header_menus_hover_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_header_submenus_color = get_theme_mod('vw_hotel_header_submenus_color');
	if($vw_hotel_header_submenus_color != false){
		$vw_hotel_custom_css .='.main-navigation ul ul a{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_header_submenus_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_header_submenus_hover_color = get_theme_mod('vw_hotel_header_submenus_hover_color');
	if($vw_hotel_header_submenus_hover_color != false){
		$vw_hotel_custom_css .='.main-navigation ul.sub-menu a:hover{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_header_submenus_hover_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_menus_item = get_theme_mod( 'vw_hotel_menus_item_style','None');
    if($vw_hotel_menus_item == 'None'){
		$vw_hotel_custom_css .='.main-navigation a{';
			$vw_hotel_custom_css .='';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_menus_item == 'Zoom In'){
		$vw_hotel_custom_css .='.main-navigation a:hover{';
			$vw_hotel_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #f1b64a;';
		$vw_hotel_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/

	$vw_hotel_search_padding_top_bottom = get_theme_mod('vw_hotel_search_padding_top_bottom');
	$vw_hotel_search_padding_left_right = get_theme_mod('vw_hotel_search_padding_left_right');
	$vw_hotel_search_font_size = get_theme_mod('vw_hotel_search_font_size');
	$vw_hotel_search_border_radius = get_theme_mod('vw_hotel_search_border_radius');
	if($vw_hotel_search_padding_top_bottom != false || $vw_hotel_search_padding_left_right != false || $vw_hotel_search_font_size != false || $vw_hotel_search_border_radius != false){
		$vw_hotel_custom_css .='.search-box i{';
			$vw_hotel_custom_css .='padding-top: '.esc_attr($vw_hotel_search_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_hotel_search_padding_top_bottom).';padding-left: '.esc_attr($vw_hotel_search_padding_left_right).';padding-right: '.esc_attr($vw_hotel_search_padding_left_right).';font-size: '.esc_attr($vw_hotel_search_font_size).';border-radius: '.esc_attr($vw_hotel_search_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_hotel_button_padding_top_bottom = get_theme_mod('vw_hotel_button_padding_top_bottom');
	$vw_hotel_button_padding_left_right = get_theme_mod('vw_hotel_button_padding_left_right');
	if($vw_hotel_button_padding_top_bottom != false || $vw_hotel_button_padding_left_right != false){
		$vw_hotel_custom_css .='.blogbutton-small{';
			$vw_hotel_custom_css .='padding-top: '.esc_attr($vw_hotel_button_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_hotel_button_padding_top_bottom).';padding-left: '.esc_attr($vw_hotel_button_padding_left_right).';padding-right: '.esc_attr($vw_hotel_button_padding_left_right).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_button_border_radius = get_theme_mod('vw_hotel_button_border_radius');
	if($vw_hotel_button_border_radius != false){
		$vw_hotel_custom_css .='.blogbutton-small, .hvr-sweep-to-right:before{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_button_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_button_font_size = get_theme_mod('vw_hotel_button_font_size',14);
	$vw_hotel_custom_css .='.blogbutton-small{';
		$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_button_font_size).';';
	$vw_hotel_custom_css .='}';

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_button_text_transform','Uppercase');
	if($vw_hotel_theme_lay == 'Capitalize'){
		$vw_hotel_custom_css .='.blogbutton-small{';
			$vw_hotel_custom_css .='text-transform:Capitalize;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Lowercase'){
		$vw_hotel_custom_css .='.blogbutton-small{';
			$vw_hotel_custom_css .='text-transform:Lowercase;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Uppercase'){
		$vw_hotel_custom_css .='.blogbutton-small{';
			$vw_hotel_custom_css .='text-transform:Uppercase;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_button_letter_spacing = get_theme_mod('vw_hotel_button_letter_spacing',14);
	$vw_hotel_custom_css .='.blogbutton-small{';
		$vw_hotel_custom_css .='letter-spacing: '.esc_attr($vw_hotel_button_letter_spacing).';';
	$vw_hotel_custom_css .='}';

	/*------------- Single Blog Page------------------*/

	$vw_hotel_featured_image_border_radius = get_theme_mod('vw_hotel_featured_image_border_radius', 0);
	if($vw_hotel_featured_image_border_radius != false){
		$vw_hotel_custom_css .='.service-image img, .feature-box img{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_featured_image_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_featured_image_box_shadow = get_theme_mod('vw_hotel_featured_image_box_shadow',0);
	if($vw_hotel_featured_image_box_shadow != false){
		$vw_hotel_custom_css .='.service-image img, .feature-box img, #content-vw img{';
			$vw_hotel_custom_css .='box-shadow: '.esc_attr($vw_hotel_featured_image_box_shadow).'px '.esc_attr($vw_hotel_featured_image_box_shadow).'px '.esc_attr($vw_hotel_featured_image_box_shadow).'px #cccccc;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_single_blog_post_navigation_show_hide = get_theme_mod('vw_hotel_single_blog_post_navigation_show_hide',true);
	if($vw_hotel_single_blog_post_navigation_show_hide != true){
		$vw_hotel_custom_css .='.post-navigation{';
			$vw_hotel_custom_css .='display: none;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_single_blog_comment_title = get_theme_mod('vw_hotel_single_blog_comment_title', 'Leave a Reply');
	if($vw_hotel_single_blog_comment_title == ''){
		$vw_hotel_custom_css .='#comments h2#reply-title {';
			$vw_hotel_custom_css .='display: none;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_single_blog_comment_button_text = get_theme_mod('vw_hotel_single_blog_comment_button_text', 'Post Comment');
	if($vw_hotel_single_blog_comment_button_text == ''){
		$vw_hotel_custom_css .='#comments p.form-submit {';
			$vw_hotel_custom_css .='display: none;';
		$vw_hotel_custom_css .='}';
	}

	// featured image dimention
	$vw_hotel_blog_post_featured_image_dimension = get_theme_mod('vw_hotel_blog_post_featured_image_dimension', 'default');
	$vw_hotel_blog_post_featured_image_custom_width = get_theme_mod('vw_hotel_blog_post_featured_image_custom_width',250);
	$vw_hotel_blog_post_featured_image_custom_height = get_theme_mod('vw_hotel_blog_post_featured_image_custom_height',250);
	if($vw_hotel_blog_post_featured_image_dimension == 'custom'){
		$vw_hotel_custom_css .='.service-image img{';
			$vw_hotel_custom_css .='width: '.esc_attr($vw_hotel_blog_post_featured_image_custom_width).'; height: '.esc_attr($vw_hotel_blog_post_featured_image_custom_height).';';
		$vw_hotel_custom_css .='}';
	}


	/*-------------- Copyright Alignment ----------------*/

	$vw_hotel_copyright_background_color = get_theme_mod('vw_hotel_copyright_background_color');
	if($vw_hotel_copyright_background_color != false){
		$vw_hotel_custom_css .='.footer-2{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_copyright_background_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_widgets_heading = get_theme_mod( 'vw_hotel_footer_widgets_heading','Left');
    if($vw_hotel_footer_widgets_heading == 'Left'){
		$vw_hotel_custom_css .='.footer h3, .footer .wp-block-search .wp-block-search__label{';
		$vw_hotel_custom_css .='text-align: left;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_footer_widgets_heading == 'Center'){
		$vw_hotel_custom_css .='.footer h3, .footer .wp-block-search .wp-block-search__label{';
			$vw_hotel_custom_css .='text-align: center;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_footer_widgets_heading == 'Right'){
		$vw_hotel_custom_css .='.footer h3, .footer .wp-block-search .wp-block-search__label{';
			$vw_hotel_custom_css .='text-align: right;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_widgets_content = get_theme_mod( 'vw_hotel_footer_widgets_content','Left');
    if($vw_hotel_footer_widgets_content == 'Left'){
		$vw_hotel_custom_css .='.footer .widget{';
		$vw_hotel_custom_css .='text-align: left;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_footer_widgets_content == 'Center'){
		$vw_hotel_custom_css .='.footer .widget{';
			$vw_hotel_custom_css .='text-align: center;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_footer_widgets_content == 'Right'){
		$vw_hotel_custom_css .='.footer .widget{';
			$vw_hotel_custom_css .='text-align: right;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_background_color = get_theme_mod('vw_hotel_footer_background_color');
	if($vw_hotel_footer_background_color != false){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_footer_background_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_copyright_font_size = get_theme_mod('vw_hotel_copyright_font_size');
	if($vw_hotel_copyright_font_size != false){
		$vw_hotel_custom_css .='.copyright p{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_copyright_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_copyright_padding_top_bottom = get_theme_mod('vw_hotel_copyright_padding_top_bottom');
	if($vw_hotel_copyright_padding_top_bottom != false){
		$vw_hotel_custom_css .='.footer-2{';
			$vw_hotel_custom_css .='padding-top: '.esc_attr($vw_hotel_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_hotel_copyright_padding_top_bottom).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_copyright_alignment = get_theme_mod('vw_hotel_copyright_alignment');
	if($vw_hotel_copyright_alignment != false){
		$vw_hotel_custom_css .='.copyright p,#footer-2 p{';
			$vw_hotel_custom_css .='text-align: '.esc_attr($vw_hotel_copyright_alignment).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_padding = get_theme_mod('vw_hotel_footer_padding');
	if($vw_hotel_footer_padding != false){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='padding: '.esc_attr($vw_hotel_footer_padding).' 0;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_icon = get_theme_mod('vw_hotel_footer_icon');
	if($vw_hotel_footer_icon == false){
		$vw_hotel_custom_css .='.copyright p{';
			$vw_hotel_custom_css .='width:100%; text-align:center; float:none;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_background_image = get_theme_mod('vw_hotel_footer_background_image');
	if($vw_hotel_footer_background_image != false){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background: url('.esc_attr($vw_hotel_footer_background_image).');';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_img_footer','scroll');
	if($vw_hotel_theme_lay == 'fixed'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background-attachment: fixed !important;';
		$vw_hotel_custom_css .='}';
	}elseif ($vw_hotel_theme_lay == 'scroll'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background-attachment: scroll !important;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_img_position = get_theme_mod('vw_hotel_footer_img_position','center center');
	if($vw_hotel_footer_img_position != false){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background-position: '.esc_attr($vw_hotel_footer_img_position).'!important;';
		$vw_hotel_custom_css .='}';
	}  

	/*----------------Sroll to top Settings ------------------*/

	$vw_hotel_scroll_to_top_font_size = get_theme_mod('vw_hotel_scroll_to_top_font_size');
	if($vw_hotel_scroll_to_top_font_size != false){
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_scroll_to_top_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_scroll_to_top_padding = get_theme_mod('vw_hotel_scroll_to_top_padding');
	$vw_hotel_scroll_to_top_padding = get_theme_mod('vw_hotel_scroll_to_top_padding');
	if($vw_hotel_scroll_to_top_padding != false){
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='padding-top: '.esc_attr($vw_hotel_scroll_to_top_padding).';padding-bottom: '.esc_attr($vw_hotel_scroll_to_top_padding).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_scroll_to_top_width = get_theme_mod('vw_hotel_scroll_to_top_width');
	if($vw_hotel_scroll_to_top_width != false){
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='width: '.esc_attr($vw_hotel_scroll_to_top_width).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_scroll_to_top_height = get_theme_mod('vw_hotel_scroll_to_top_height');
	if($vw_hotel_scroll_to_top_height != false){
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='height: '.esc_attr($vw_hotel_scroll_to_top_height).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_scroll_to_top_border_radius = get_theme_mod('vw_hotel_scroll_to_top_border_radius');
	if($vw_hotel_scroll_to_top_border_radius != false){
		$vw_hotel_custom_css .='.scrollup i{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_scroll_to_top_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_hotel_social_icon_font_size = get_theme_mod('vw_hotel_social_icon_font_size');
	if($vw_hotel_social_icon_font_size != false){
		$vw_hotel_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_social_icon_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_social_icon_padding = get_theme_mod('vw_hotel_social_icon_padding');
	if($vw_hotel_social_icon_padding != false){
		$vw_hotel_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_hotel_custom_css .='padding: '.esc_attr($vw_hotel_social_icon_padding).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_social_icon_width = get_theme_mod('vw_hotel_social_icon_width');
	if($vw_hotel_social_icon_width != false){
		$vw_hotel_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_hotel_custom_css .='width: '.esc_attr($vw_hotel_social_icon_width).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_social_icon_height = get_theme_mod('vw_hotel_social_icon_height');
	if($vw_hotel_social_icon_height != false){
		$vw_hotel_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_hotel_custom_css .='height: '.esc_attr($vw_hotel_social_icon_height).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_social_icon_border_radius = get_theme_mod('vw_hotel_social_icon_border_radius');
	if($vw_hotel_social_icon_border_radius != false){
		$vw_hotel_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_social_icon_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_hotel_related_product_show_hide = get_theme_mod('vw_hotel_related_product_show_hide',true);
	if($vw_hotel_related_product_show_hide != true){
		$vw_hotel_custom_css .='.related.products{';
			$vw_hotel_custom_css .='display: none;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_products_padding_top_bottom = get_theme_mod('vw_hotel_products_padding_top_bottom');
	if($vw_hotel_products_padding_top_bottom != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_hotel_custom_css .='padding-top: '.esc_attr($vw_hotel_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($vw_hotel_products_padding_top_bottom).'!important;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_products_padding_left_right = get_theme_mod('vw_hotel_products_padding_left_right');
	if($vw_hotel_products_padding_left_right != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_hotel_custom_css .='padding-left: '.esc_attr($vw_hotel_products_padding_left_right).'!important; padding-right: '.esc_attr($vw_hotel_products_padding_left_right).'!important;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_products_box_shadow = get_theme_mod('vw_hotel_products_box_shadow');
	if($vw_hotel_products_box_shadow != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_hotel_custom_css .='box-shadow: '.esc_attr($vw_hotel_products_box_shadow).'px '.esc_attr($vw_hotel_products_box_shadow).'px '.esc_attr($vw_hotel_products_box_shadow).'px #ddd;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_products_border_radius = get_theme_mod('vw_hotel_products_border_radius', 0);
	if($vw_hotel_products_border_radius != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_products_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_products_button_border_radius = get_theme_mod('vw_hotel_products_button_border_radius', 0);
	if($vw_hotel_products_button_border_radius != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product .button, a.checkout-button.button.alt.wc-forward,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_products_button_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_woocommerce_sale_position = get_theme_mod( 'vw_hotel_woocommerce_sale_position','right');
    if($vw_hotel_woocommerce_sale_position == 'left'){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_hotel_custom_css .='left: -10px; right: auto;';
		$vw_hotel_custom_css .='}';
	}else if($vw_hotel_woocommerce_sale_position == 'right'){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_hotel_custom_css .='left: auto; right: 0;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_woocommerce_sale_font_size = get_theme_mod('vw_hotel_woocommerce_sale_font_size');
	if($vw_hotel_woocommerce_sale_font_size != false){
		$vw_hotel_custom_css .='.woocommerce span.onsale{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_woocommerce_sale_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_woocommerce_sale_border_radius = get_theme_mod('vw_hotel_woocommerce_sale_border_radius', 100);
	if($vw_hotel_woocommerce_sale_border_radius != false){
		$vw_hotel_custom_css .='.woocommerce span.onsale{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_woocommerce_sale_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	/*------------------ Logo  -------------------*/

	$vw_hotel_logo_padding = get_theme_mod('vw_hotel_logo_padding');
	if($vw_hotel_logo_padding != false){
		$vw_hotel_custom_css .='.logo{';
			$vw_hotel_custom_css .='padding: '.esc_attr($vw_hotel_logo_padding).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_logo_margin = get_theme_mod('vw_hotel_logo_margin');
	if($vw_hotel_logo_margin != false){
		$vw_hotel_custom_css .='.logo{';
			$vw_hotel_custom_css .='margin: '.esc_attr($vw_hotel_logo_margin).';';
		$vw_hotel_custom_css .='}';
	}

	// Site title Font Size
	$vw_hotel_site_title_font_size = get_theme_mod('vw_hotel_site_title_font_size');
	if($vw_hotel_site_title_font_size != false){
		$vw_hotel_custom_css .='.logo h1 a, .logo p.site-title a{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_site_title_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	// Site tagline Font Size
	$vw_hotel_site_tagline_font_size = get_theme_mod('vw_hotel_site_tagline_font_size');
	if($vw_hotel_site_tagline_font_size != false){
		$vw_hotel_custom_css .='.logo p.site-description{';
			$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_site_tagline_font_size).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_site_title_color = get_theme_mod('vw_hotel_site_title_color');
	if($vw_hotel_site_title_color != false){
		$vw_hotel_custom_css .='p.site-title a{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_site_title_color).'!important;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_site_tagline_color = get_theme_mod('vw_hotel_site_tagline_color');
	if($vw_hotel_site_tagline_color != false){
		$vw_hotel_custom_css .='.logo p.site-description{';
			$vw_hotel_custom_css .='color: '.esc_attr($vw_hotel_site_tagline_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_logo_width = get_theme_mod('vw_hotel_logo_width');
	if($vw_hotel_logo_width != false){
		$vw_hotel_custom_css .='.logo img{';
			$vw_hotel_custom_css .='width: '.esc_attr($vw_hotel_logo_width).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_logo_height = get_theme_mod('vw_hotel_logo_height');
	if($vw_hotel_logo_height != false){
		$vw_hotel_custom_css .='.logo img{';
			$vw_hotel_custom_css .='height: '.esc_attr($vw_hotel_logo_height).';';
		$vw_hotel_custom_css .='}';
	}

	// Woocommerce img

	$vw_hotel_shop_featured_image_border_radius = get_theme_mod('vw_hotel_shop_featured_image_border_radius', 0);
	if($vw_hotel_shop_featured_image_border_radius != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product a img{';
			$vw_hotel_custom_css .='border-radius: '.esc_attr($vw_hotel_shop_featured_image_border_radius).'px;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_shop_featured_image_box_shadow = get_theme_mod('vw_hotel_shop_featured_image_box_shadow');
	if($vw_hotel_shop_featured_image_box_shadow != false){
		$vw_hotel_custom_css .='.woocommerce ul.products li.product a img{';
				$vw_hotel_custom_css .='box-shadow: '.esc_attr($vw_hotel_shop_featured_image_box_shadow).'px '.esc_attr($vw_hotel_shop_featured_image_box_shadow).'px '.esc_attr($vw_hotel_shop_featured_image_box_shadow).'px #ddd;';
		$vw_hotel_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$vw_hotel_preloader_bg_color = get_theme_mod('vw_hotel_preloader_bg_color');
	if($vw_hotel_preloader_bg_color != false){
		$vw_hotel_custom_css .='#preloader{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_preloader_bg_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_preloader_border_color = get_theme_mod('vw_hotel_preloader_border_color');
	if($vw_hotel_preloader_border_color != false){
		$vw_hotel_custom_css .='.loader-line{';
			$vw_hotel_custom_css .='border-color: '.esc_attr($vw_hotel_preloader_border_color).'!important;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_preloader_bg_img = get_theme_mod('vw_hotel_preloader_bg_img');
	if($vw_hotel_preloader_bg_img != false){
		$vw_hotel_custom_css .='#preloader{';
			$vw_hotel_custom_css .='background: url('.esc_attr($vw_hotel_preloader_bg_img).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$vw_hotel_custom_css .='}';
	}

	// Header Background Color
	$vw_hotel_header_background_color = get_theme_mod('vw_hotel_header_background_color');
	if($vw_hotel_header_background_color != false){
		$vw_hotel_custom_css .='.home-page-header{';
			$vw_hotel_custom_css .='background-color: '.esc_attr($vw_hotel_header_background_color).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_header_img_position = get_theme_mod('vw_hotel_header_img_position','center top');
	if($vw_hotel_header_img_position != false){
		$vw_hotel_custom_css .='.home-page-header{';
			$vw_hotel_custom_css .='background-position: '.esc_attr($vw_hotel_header_img_position).'!important;';
		$vw_hotel_custom_css .='}';
	}

	/*---------------------------Footer Style -------------------*/

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_footer_template','vw_hotel-footer-one');
    if($vw_hotel_theme_lay == 'vw_hotel-footer-one'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='';
		$vw_hotel_custom_css .='}';

	}else if($vw_hotel_theme_lay == 'vw_hotel-footer-two'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background: linear-gradient(to right, #f9f8ff, #dedafa);';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer p, .footer li a, .footer, .footer h3, .footer a.rsswidget, .footer #wp-calendar a, .copyright a, .footer .custom_details, .footer ins span, .footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, .footer ul li a, .footer table, .footer th, .footer td, .footer caption, #sidebar caption,.footer nav.wp-calendar-nav a,.footer .search-form .search-field{';
			$vw_hotel_custom_css .='color:#000;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer ul li::before{';
			$vw_hotel_custom_css .='background:#000;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer table, .footer th, .footer td,.footer .search-form .search-field,.footer .tagcloud a{';
			$vw_hotel_custom_css .='border: 1px solid #000;';
		$vw_hotel_custom_css .='}';

	}else if($vw_hotel_theme_lay == 'vw_hotel-footer-three'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background: #232524;';
		$vw_hotel_custom_css .='}';
	}
	else if($vw_hotel_theme_lay == 'vw_hotel-footer-four'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background: #f7f7f7;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer p, .footer li a, .footer, .footer h3, .footer a.rsswidget, .footer #wp-calendar a, .copyright a, .footer .custom_details, .footer ins span, .footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, .footer ul li a, .footer table, .footer th, .footer td, .footer caption, #sidebar caption,.footer nav.wp-calendar-nav a,.footer .search-form .search-field{';
			$vw_hotel_custom_css .='color:#000;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer ul li::before{';
			$vw_hotel_custom_css .='background:#000;';
		$vw_hotel_custom_css .='}';
		$vw_hotel_custom_css .='.footer table, .footer th, .footer td,.footer .search-form .search-field,.footer .tagcloud a{';
			$vw_hotel_custom_css .='border: 1px solid #000;';
		$vw_hotel_custom_css .='}';
	}
	else if($vw_hotel_theme_lay == 'vw_hotel-footer-five'){
		$vw_hotel_custom_css .='.footer{';
			$vw_hotel_custom_css .='background: linear-gradient(to right, #01093a, #2d0b00);';
		$vw_hotel_custom_css .='}';
	}

	/*---------------- Footer Settings ------------------*/

	$vw_hotel_button_footer_heading_letter_spacing = get_theme_mod('vw_hotel_button_footer_heading_letter_spacing',1);
	$vw_hotel_custom_css .='.footer h3, a.rsswidget.rss-widget-title{';
		$vw_hotel_custom_css .='letter-spacing: '.esc_attr($vw_hotel_button_footer_heading_letter_spacing).'px;';
	$vw_hotel_custom_css .='}';

	$vw_hotel_button_footer_font_size = get_theme_mod('vw_hotel_button_footer_font_size','30');
	$vw_hotel_custom_css .='.footer h3, a.rsswidget.rss-widget-title{';
		$vw_hotel_custom_css .='font-size: '.esc_attr($vw_hotel_button_footer_font_size).'px;';
	$vw_hotel_custom_css .='}';

	$vw_hotel_theme_lay = get_theme_mod( 'vw_hotel_button_footer_text_transform','Capitalize');
	if($vw_hotel_theme_lay == 'Capitalize'){
		$vw_hotel_custom_css .='.footer h3{';
			$vw_hotel_custom_css .='text-transform:Capitalize;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Lowercase'){
		$vw_hotel_custom_css .='.footer h3, a.rsswidget.rss-widget-title{';
			$vw_hotel_custom_css .='text-transform:Lowercase;';
		$vw_hotel_custom_css .='}';
	}
	if($vw_hotel_theme_lay == 'Uppercase'){
		$vw_hotel_custom_css .='.footer h3, a.rsswidget.rss-widget-title{';
			$vw_hotel_custom_css .='text-transform:Uppercase;';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_footer_heading_weight = get_theme_mod('vw_hotel_footer_heading_weight','600');
	if($vw_hotel_footer_heading_weight != false){
		$vw_hotel_custom_css .='.footer h3, a.rsswidget.rss-widget-title{';
			$vw_hotel_custom_css .='font-weight: '.esc_attr($vw_hotel_footer_heading_weight).';';
		$vw_hotel_custom_css .='}';
	}

	$vw_hotel_responsive_preloader_hide = get_theme_mod('vw_hotel_responsive_preloader_hide',false);
	if($vw_hotel_responsive_preloader_hide == true && get_theme_mod('vw_hotel_loader_enable',false) == false){
		$vw_hotel_custom_css .='@media screen and (min-width:575px){
			#preloader{';
			$vw_hotel_custom_css .='display:none !important;';
		$vw_hotel_custom_css .='} }';
	}

	if($vw_hotel_responsive_preloader_hide == false){
		$vw_hotel_custom_css .='@media screen and (max-width:575px){
			#preloader{';
			$vw_hotel_custom_css .='display:none !important;';
		$vw_hotel_custom_css .='} }';
	}
