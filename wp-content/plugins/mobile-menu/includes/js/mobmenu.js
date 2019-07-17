
  /*
    *
    *   Javascript Functions
    *   ------------------------------------------------
    *   WP Mobile Menu
    *   Copyright WP Mobile Menu 2018 - http://www.wpmobilemenu.com
    *
    */

    "use strict";
    
    jQuery( document ).ready( function($) {

      function mobmenuOpenSubmenus( menu ) {
        var submenu = $(menu).parent().next();
        if ( $(menu).parent().next().hasClass( 'show-sub-menu' )  ) {
          $(menu).find('.show-sub-menu' ).hide();
          $(menu).toggleClass( 'show-sub');
        } else {
          if ( ! $( menu ).parents('.show-sub-menu').prev().hasClass('mob-expand-submenu') && submenu[0] !== $('.show-sub-menu')[0] && $( menu ).parent('.sub-menu').length <= 0 ) {
  
            $(menu).parent().find( '.show-submenu' ).first().hide().toggleClass( 'show-sub-menu' );
            $(menu).toggleClass( 'show-sub');
  
          }
        }

        if ( !$( menu ).parent().next().hasClass( 'show-sub-menu' ) ) {
          submenu.fadeIn( 'slow' );
        } else {  
          submenu.hide();
        }
  
        if ( ! $('body').hasClass('mob-menu-sliding-menus') ) {
          $( menu ).find('.open-icon').toggleClass('hide');
          $( menu ).find('.close-icon').toggleClass('hide');
        }

        submenu.toggleClass( 'show-sub-menu');
        

      }
  

      if ( $( 'body' ).find( '.mobmenu-push-wrap' ).length <= 0 &&  $( 'body' ).hasClass('mob-menu-slideout') ) {

        $( 'body' ).wrapInner( '<div class="mobmenu-push-wrap"></div>' );
        $( '.mobmenu-push-wrap' ).after( $( '.mobmenu-left-alignment' ).detach() );
        $( '.mobmenu-push-wrap' ).after( $( '.mobmenu-right-alignment' ).detach() );
        $( '.mobmenu-push-wrap' ).after( $( '.mob-menu-header-holder' ).detach() ); 
        $( '.mobmenu-push-wrap' ).after( $( '.mobmenu-footer-menu-holder' ).detach() ); 
        $( '.mobmenu-push-wrap' ).after( $( '#wpadminbar' ).detach() );

        if ( $('.mob-menu-header-holder' ).attr( 'data-detach-el' ) != '' ) {
          $( '.mobmenu-push-wrap' ).after( $(   $('.mob-menu-header-holder' ).attr( 'data-detach-el' ) ).detach() );
        }

        // Double Check the the menu display classes where added to the body.
        var menu_display_type = jQuery( '.mob-menu-header-holder' ).attr( 'data-menu-display' );

        if ( menu_display_type != '' && !jQuery( 'body' ).hasClass( menu_display_type ) ) {
          $( 'body' ).addClass( menu_display_type );
        }

        $( 'video' ).each( function(){
          if( 'autoplay' === $( this ).attr('autoplay') ) {
            $( this )[0].play();
          } 
        });

      }
      var submenu_open_icon  = jQuery( '.mob-menu-header-holder' ).attr( 'data-open-icon' );
      var submenu_close_icon = jQuery( '.mob-menu-header-holder' ).attr( 'data-close-icon' );

      $( '.mobmenu-content .sub-menu' ).each( function(){
        $( this ).prev().append('<div class="mob-expand-submenu"><i class="mob-icon-' + submenu_open_icon + ' open-icon"></i><i class="mob-icon-' + submenu_close_icon + ' close-icon hide"></i></div>');

        if ( 0 < $( this ).parents( '.mobmenu-parent-link' ).length  ) {
          $( this ).prev().prev().attr('href', '#');
        }

      });
      
      $( document ).on( 'click', '.mobmenu-parent-link .menu-item-has-children' , function ( e ) {
        
        if ( e.target.parentElement != this) return;
        
        e.preventDefault();
        $(this).find('a').find('.mob-expand-submenu').first().trigger('click');
        e.stopPropagation();
        
      });
      jQuery( document ).on( 'click', '.show-nav-left .mobmenu-push-wrap,  .show-nav-left .mobmenu-overlay', function ( e ) { 
  
        e.preventDefault();
        jQuery( '.mobmenu-left-bt' ).first().trigger( 'click' );
        e.stopPropagation();

      });
      
      $( document ).on( 'click', '.mob-expand-submenu' , function ( e ) {

        // Check if any menu is open and close it.
        if ( 1 == $( '.mob-menu-header-holder' ).attr( 'data-autoclose-submenus' ) && ! $(this).parent().next().hasClass( 'show-sub-menu' ) ) {
          if ( 0 < $( '.mob-expand-submenu.show-sub' ).length &&  $(this).parents('.show-sub-menu').length <= 0 ) {
            mobmenuOpenSubmenus( $( '.mob-expand-submenu.show-sub' ) );
          }
        }
       
        mobmenuOpenSubmenus( $(this) );
        e.preventDefault();
        e.stopPropagation();

      });

      $( document ).on( 'click', '.mobmenu-panel.show-panel .mob-cancel-button, .show-nav-right .mobmenu-overlay, .show-nav-left .mobmenu-overlay', function ( e ) { 

        e.preventDefault();
        mobmenuClosePanel( 'show-panel' );
        if ( jQuery('body').hasClass('mob-menu-sliding-menus') ) {
          jQuery( '.mobmenu-trigger-action .hamburger' ).toggleClass('is-active');
        }

      });

      $( document ).on( 'click', '.mobmenu-trigger-action', function(e){
        e.preventDefault();
        var targetPanel = $( this ).attr( 'data-panel-target' );

        if ( 'mobmenu-filter-panel' !==  targetPanel ) {
          mobmenuOpenPanel( targetPanel );
        }

      });

      $( document ).on( 'click', '.hamburger', function(e){
        var targetPanel = $(this).parent().attr('data-panel-target');
        e.preventDefault();
        e.stopPropagation();
        
        $(this).toggleClass( 'is-active' );
        
        setTimeout(function(){ 
          if ( $( 'body' ).hasClass('show-nav-left') ) {
            if ( jQuery('body').hasClass('mob-menu-sliding-menus') ) {
              jQuery( '.mobmenu-trigger-action .hamburger' ).toggleClass('is-active');
            }
            mobmenuClosePanel( targetPanel );
            
          } else {
            mobmenuOpenPanel( targetPanel );
          }
            
        }, 400);
        

      });
     

      $('.mobmenu a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .on( 'click', function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
          &&
          $(this).parents('.mobmenu_content').length > 0
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            event.stopPropagation();
            $( '.show-nav-left .mobmenu-left-bt').first().click();
            $( '.show-nav-right .mobmenu-right-bt').first().trigger( 'click' );
            $( 'html' ).css( 'overflow', '' );
  
            $('body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });
    });
  
  function mobmenuClosePanel( target ) {
    jQuery( '.' + target ).toggleClass( 'show-panel' );
    jQuery( 'html' ).removeClass( 'show-mobmenu-filter-panel' );
    jQuery( 'body' ).removeClass( 'show-nav-right' );
    jQuery( 'body' ).removeClass( 'show-nav-left' );
    jQuery( 'html' ).removeClass( 'mob-menu-no-scroll' ); 

  }

  function mobmenuOpenPanel( target ) {
    jQuery( '.mobmenu-content' ).scrollTop(0);
    jQuery( 'html' ).addClass( 'mob-menu-no-scroll' ); 

    if ( jQuery('.' + target ).hasClass( 'mobmenu-left-alignment' ) ) {
      jQuery('body').addClass('show-nav-left');
    }
    if ( jQuery('.' + target ).hasClass( 'mobmenu-right-alignment' ) ) {
      jQuery('body').addClass('show-nav-right');
    }

    jQuery('.' + target ).addClass( 'show-panel' );

  }
