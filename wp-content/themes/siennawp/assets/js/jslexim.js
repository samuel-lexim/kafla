jQuery(function () {
    'use strict';

    jQuery(document).ready(function ($) {
        let body = $('body');

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
        body.delegate('#ic-find', 'click', function () {
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

        // Start - Youtube Video
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: $('#player').attr('data-id'),
                playerVars: {
                    'playsinline': 1
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            event.target.playVideo();
        }

        var done = false;

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
            }
        }

        function stopVideo() {
            player.stopVideo();
        }

        // End - Youtube Video

        body.delegate('#btn-watchvideo', 'click', function () {
            $('.bg-video-home-top').show();
            $('.hero-slider-wrap').hide();
            $('.hero-slick').hide();
            $('.hero-wrap').css({'background-image': 'unset'});
            let video = $('.embed-responsive-item');
            if (video.hasClass('youtube')) {
                onYouTubeIframeAPIReady();
            }
        });


        // Slick slider
        $('.single-image-slick').slick();

        $('.hero-slick').slick({
            vertical: true,
            verticalSwiping: true,
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 3000,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        dots: false,
                        vertical: false,
                        verticalSwiping: false,
                    }
                }
            ]
        });

    });
});



