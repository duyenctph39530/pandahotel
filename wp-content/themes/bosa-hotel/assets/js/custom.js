;(function( $ ){

/**
* Setting up functionality for slick navigation
*/
function bosa_hotel_slickNavHeight (){
  var headerHeight = $( '.site-header-primary .main-header' ).outerHeight();
  var headerHeight = $( '.site-header-two' ).outerHeight();
  $('.slicknav_nav').css( 'top', headerHeight );
}

/**
* Setting up functionality for alternative menu
*/
function bosa_hotel_wpMenuAccordion( selector ){

  var $ele = selector + ' .header-navigation .menu-item-has-children > a';
  $( $ele ).each( function(){
    var text = $( this ).text();
    text = text + '<button class="fas fa-plus triangle"></button>';
    $( this ).html( text );
  });

  jQuery( document ).on( 'click', $ele + ' .triangle', function( e ){
    e.preventDefault();
    e.stopPropagation();

    $parentLi = $( this ).parent().parent( 'li' );
    $childLi = $parentLi.find( 'li' );

    if( $parentLi.hasClass( 'open' ) ){
      /**
      * Closing all the ul inside and 
      * removing open class for all the li's
      */
      $parentLi.removeClass( 'open' );
      $childLi.removeClass( 'open' );

      $( this ).parent( 'a' ).next().slideUp();
      $( this ).parent( 'a' ).next().find( 'ul' ).slideUp();
    }else{

      $parentLi.addClass( 'open' );
      $( this ).parent( 'a' ).next().slideDown();
    }
  });
};

/**
* Setting up functionality for fixed header
*/

$mastheadHeight = $( '#masthead.site-header' ).height();
$stickymastheadHeight = $( '#masthead .overlay-header' ).height();

function bosa_hotel_fixed_header(){
  $notificationHight = $( '.notification-bar' ).height();
  $logo_selector = document.getElementById( 'headerLogo' );
  var width = $( window ).width();

  if ( $logo_selector && BOSAHOTEL.fixed_nav && BOSAHOTEL.fixed_header_logo ) { 
    if ( $mastheadHeight < $(window).scrollTop()){
      if ( BOSAHOTEL.separate_logo == '' ){
        if ( BOSAHOTEL.the_custom_logo !== '' ){
          $logo_selector.src = BOSAHOTEL.the_custom_logo;
        }
      }else{
        $( '.site-header .site-branding img' ).css( 'display' , 'block' );
        if( !BOSAHOTEL.mobile_fixed_nav_off || width >= 782 ){
          $logo_selector.src = BOSAHOTEL.separate_logo;
        }
      }
    }else{
      if ( BOSAHOTEL.header_two_logo !== '' && ( BOSAHOTEL.is_front_page || BOSAHOTEL.overlay_post || BOSAHOTEL.overlay_page ) && BOSAHOTEL.is_header_two ){
         $logo_selector.src = BOSAHOTEL.header_two_logo;
      }else if ( BOSAHOTEL.the_custom_logo !== '' ) {
          $logo_selector.src = BOSAHOTEL.the_custom_logo;
      }else if ( BOSAHOTEL.separate_logo !== '' ){
        $( '.site-header .site-branding img' ).css( 'display' , 'none' );
      }
    }
  }
  if ( $mastheadHeight > $( window ).scrollTop() || $( window ).scrollTop() == 0 ) {
      if ( BOSAHOTEL.fixed_nav && $( '#masthead.site-header' ).hasClass( 'sticky-header' )){
          $( '#masthead.site-header' ).removeClass( 'sticky-header' );
          // Fixed header in admin bar
          if( BOSAHOTEL.is_admin_bar_showing && width >= 782 ){
            $( '.fixed-header' ).css( 'marginTop', 0 );
          }
          if( BOSAHOTEL.is_admin_bar_showing && width <= 781 ){
            $( '.fixed-header' ).css( 'marginTop', 0 );
          }
      }
  }else if ( BOSAHOTEL.fixed_nav && !$( '#masthead.site-header' ).hasClass( 'sticky-header' )){
    if( !BOSAHOTEL.mobile_fixed_nav_off || width >= 782 ){
      $( '#masthead.site-header' ).addClass( 'sticky-header' ).fadeIn();
    }
      // Fixed header in admin bar
      if( BOSAHOTEL.is_admin_bar_showing && width >= 782 ){
        $( '.fixed-header' ).css( 'marginTop', 32 );
      }
      if( BOSAHOTEL.is_admin_bar_showing && width <= 781 ){
        $( '.fixed-header' ).css( 'marginTop', 46 );
      }
      if( BOSAHOTEL.is_admin_bar_showing && width <= 600 ){
        $( '.fixed-header' ).css( 'marginTop', 0 );
      }
      if( BOSAHOTEL.mobile_fixed_nav_off && width <= 781 ){
        $( '.fixed-header' ).css( 'marginTop', 0 );
    }
  }
}

/**
* Setting up functionality for header two - transparent header
*/
function bosa_hotel_header_two_postion() {
  var width = $( window ).width();

  if ( BOSAHOTEL.is_header_two ) {
    if( BOSAHOTEL.is_admin_bar_showing && width >= 782 ){
      $( '.overlay-header' ).css( 'top' , 32 );
    }
    if( BOSAHOTEL.is_admin_bar_showing && width <= 781 ){
      $( '.overlay-header' ).css( 'top' , 46 );
    }
  }
}

/**
* Setting up call functions
*/
// Document ready
jQuery( document ).ready( function() {
  bosa_hotel_slickNavHeight();
  bosa_hotel_wpMenuAccordion( '#offcanvas-menu' );
  bosa_hotel_header_two_postion();

  /**
  * Offcanvas Menu
  */
  $( document ).on( 'click', '.offcanvas-menu-toggler, .close-offcanvas-menu button, .offcanvas-overlay', function( e ){
    e.preventDefault();
    $( 'body' ).toggleClass( 'offcanvas-slide-open' );
    setTimeout(function(){
      $( '.close-offcanvas-menu button' ).focus();
    }, 40);
  });
  $( '.close-offcanvas-menu button' ).click( function(){
    setTimeout(function(){
      $( '.offcanvas-menu-toggler' ).focus();
    }, 50);
  });

  jQuery( 'body' ).append( '<div class="offcanvas-overlay"></div>' );

  /**
  * Desktop Hamburger Nav on focus out event
  */
   jQuery( '.offcanvas-menu-wrap .offcanvas-menu-inner' ).on( 'focusout', function () {
     var $elem = jQuery( this );
     // let the browser set focus on the newly clicked elem before check
     setTimeout(function () {
       if ( ! $elem.find( ':focus' ).length ) {
         jQuery( '.offcanvas-menu-toggler' ).trigger( 'click' );
         $( '.offcanvas-menu-toggler' ).focus();
       }
     }, 0);
   });

  /**
   * Header Search from
  */
  jQuery( document ).on( 'click','.search-icon, .close-button', function(){
    $( '.header-search' ).toggleClass("search-in");
    $( '.header-search input' ).focus();
  });

  // search toggle on focus out event
  jQuery( '.header-search form' ).on( 'focusout', function () {
    var $elem = jQuery(this);
      // let the browser set focus on the newly clicked elem before check
      setTimeout(function () {
          if ( ! $elem.find( ':focus' ).length ) {
            jQuery( '.search-icon' ).trigger( 'click' );
            $( '.search-icon' ).focus();
          }
      }, 0);
  });

  /**
  * Header image slider
  */
  $( '.header-image-slider' ).slick({
      dots: true,
      arrows: true,
      adaptiveHeight: false,
      fade: BOSAHOTEL.header_image_slider.fade,
      speed: parseInt( BOSAHOTEL.header_image_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: BOSAHOTEL.header_image_slider.autoplay,
      autoplaySpeed: BOSAHOTEL.header_image_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $( '.header-slider-prev' ),
      nextArrow: $( '.header-slider-next' ),
      rows: 0,
      appendDots: $( '.header-slider-dots' ),
    });
  $( '.header-image-slider' ).attr( 'dir', 'ltr' );

  /**
  * Slick navigation
  */
  $( '#primary-menu' ).slicknav({
      duration: 500,
      closedSymbol: '<i class="fa fa-plus"></i>',
      openedSymbol: '<i class="fa fa-minus"></i>',
      appendTo: '.mobile-menu-container',
      allowParentLinks: true,
      nestedParentLinks : false,
      label: BOSAHOTEL.responsive_header_menu_text,
      closeOnClick: true, // Close menu when a link is clicked.
  });
  
  /**
  * Slick navigation mobile on focus out event
  */
  jQuery( '.slicknav_menu .slicknav_nav' ).on( 'focusout', function () {
    var $elem = jQuery(this);
    // let the browser set focus on the newly clicked elem before check
    setTimeout(function () {
      if ( ! $elem.find( ':focus' ).length ) {
        jQuery( '.slicknav_open' ).trigger( 'click' );
      }
    }, 0);
  });

  /**
  * Header two & header ten banner content
  */
  if ( $( '.site-header' ).hasClass( 'header-two' ) ) {
    $( '.home .section-banner .banner-content' ).css( 'marginTop' , $stickymastheadHeight );
  }

  /**
  * Main posts slider
  */
  $( '.main-slider' ).slick({
      dots: true,
      arrows: true,
      adaptiveHeight: false,
      fade: BOSAHOTEL.main_slider.fade,
      speed: parseInt( BOSAHOTEL.main_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: BOSAHOTEL.main_slider.autoplay,
      autoplaySpeed: BOSAHOTEL.main_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $( '.main-slider-prev' ),
      nextArrow: $( '.main-slider-next' ),
      rows: 0,
      appendDots: $( '.main-slider-dots' ),
    });
  $( '.main-slider' ).attr( 'dir', 'ltr' );

  /**
   * Highlight posts slider
   */
  $( '.highlight-post-slider' ).slick({
      arrows: true,
      dots: true,
      slidesToShow: BOSAHOTEL.home_highlight_posts.slidesToShow,
      slidesToScroll: 1,
      adaptiveHeight: false,
      autoplay: BOSAHOTEL.home_highlight_posts.autoplay,
      autoplaySpeed: BOSAHOTEL.home_highlight_posts.autoplaySpeed,
      infinite: false,
      rows: 0,
      prevArrow: $( '.highlight-posts-prev' ),
      nextArrow: $( '.highlight-posts-next' ),
      appendDots: $( '.highlight-posts-dots' ),
      responsive: [
        {
          breakpoint: 1023,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  $( '.highlight-post-slider' ).attr( 'dir', 'ltr' );

  /**
  * Sticky sidebar
  */
  if( BOSAHOTEL.sticky_sidebar ){
    $( '.content-area, .left-sidebar, .right-sidebar' ).theiaStickySidebar({
      // Settings
      additionalMarginTop: 30,
    });
  }

  /**
  * Back to top
  */
  jQuery( document ).on( 'click', '#back-to-top a', function() {
      $( 'html, body' ).animate({ scrollTop: 0 }, 800);
      return false;
  });

}); // closing document ready

// Window resize
jQuery( window ).on( 'resize', function(){
  bosa_hotel_slickNavHeight();
  bosa_hotel_fixed_header();
  bosa_hotel_header_two_postion();
});

// Window load
jQuery( window ).on( 'load', function(){

  /**
  * Site Preloader
  */
  $( '#site-preloader' ).fadeOut( 500 );

  /**
  * Back to top
  */
  if( BOSAHOTEL.enable_scroll_top == true && $(window).scrollTop() > 200 ){
    $( '#back-to-top' ).fadeIn( 200 );
  } else{
    $( '#back-to-top' ).fadeOut( 200 );
  }

  /**
  * Masonry wrapper
  */
  if( jQuery( '.masonry-wrapper' ).length > 0 ){
    $grid = jQuery( '.masonry-wrapper' ).masonry({
      itemSelector: '.grid-post',
      // percentPosition: true,
      isAnimated: true,
    }); 
  }

  /**
  * Jetpack's infinite scroll on masonry layout
  */
  infinite_count = 0;
    $( document.body ).on( 'post-load', function () {

    infinite_count = infinite_count + 1;
    var container = '#infinite-view-' + infinite_count;
    $( container ).hide();

    $( $( container + ' .grid-post' ) ).each( function(){
      $items = $( this );
        $grid.append( $items ).masonry( 'appended', $items );
    });

    setTimeout( function(){
      $grid.masonry( 'layout' );
    },500);
    });

}); // closing window load

// Window scroll
jQuery( window ).on( 'scroll', function(){
  bosa_hotel_fixed_header();

  /**
  * Back to top
  */
  if( BOSAHOTEL.disable_scroll_top == false && $(window).scrollTop() > 200 ){
    $( '#back-to-top' ).fadeIn( 200 );
  } else{
    $( '#back-to-top' ).fadeOut( 200 );
  }
}); // closing window scroll

})( jQuery );