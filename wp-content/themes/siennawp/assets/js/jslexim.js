jQuery(function () {
    'use strict';

    jQuery(document).ready(function ($) {

        // hover on area KOREAN NEWS,PHOTO GALLERY,VIDEO STORY,UP COMING EVENT active for hover
        $('.check-active-overlay').hover(function () {
            $(this).find('.hover-overlay-effect').removeClass('active');
        }, function () {
            $('.hover-overlay-effect').addClass('active');
        });

        // change text chooser language item
        $('li.language-chooser-item-en a').html('EN');
        $('li.language-chooser-item-ko a').html('한');

        // hover on menu top show sub menu.
        $('#menu-main-home-top>ul>li').hover(function () {
            if ($(this).hasClass('menu-item-has-children')) {
                $(this).find('div.second').addClass('mkdf-drop-down-start');
            }
        }, function () {
            $('#menu-main-home-top>ul>li>div').removeClass('mkdf-drop-down-start');
        });

        // func click icon find at home, show or hide form search.
        $('body').delegate('#ic-find', 'click', function () {
            $('.form-search-home-top').toggle();
        });

        // add placeholder Search... in textbox search
        $('.form-search-home-top #s').attr('placeholder', 'Search...');

        // START - sticky menu on pc and mobile
        function checkSticky() {
            let currentTop = jQuery(window).scrollTop();
            if (currentTop >= 100) {
                $('.bg-header').addClass('sticky');
            } else {
                $('.bg-header').removeClass('sticky');
            }
        }

        $(window).scroll(function () {
            checkSticky();
        });

        checkSticky();
        // END - sticky menu on pc and mobile


        //  func click show video and hide background slider
        $('body').delegate('#btn-watchvideo', 'click', function () {
            $('.content-top-home .bg-video-home-top').show();
            $('.content-top-home .content-top-child-home').hide();
            $('.content-top-home .home-banner-slider').hide();
            $('.content-top-home').css({'background-image': 'unset'});
        });


        // Slick slider
        $('.single-image-slick').slick();

    });
});



