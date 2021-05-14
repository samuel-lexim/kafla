<?php
/*
Template Name: Home Page Origin
*/
?>

<?php $sidebar = sienna_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
    <div class="mkdf-container">

        <?php
        $heroImages = get_field('images_list', 'option');
        ?>

        <?php if ($heroImages) { ?>
        <div class="hero-wrap">
            <div class="hero-slider-wrap">
                <div class="hero-slick vertical-dots">
                    <?php if (is_array($heroImages)) {
                        foreach ($heroImages as $img) {
                            if (isset($img['image']['url'])) { ?>
                    <div class="hero-home-item">
                        <img alt="<?= $img['image']['alt'] ?>" src="<?= $img['image']['url'] ?>" />
                    </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="social-hero">
                    <a class="hidden-xs" href="https://www.youtube.com/channel/UC0eC11Hw5AYxaZkfcwPdmVQ"
                       target="_blank">
                        <div id="ic-you"></div>
                    </a>
                    <a class="hidden-xs" href="https://www.instagram.com/kafla1962/" target="_blank">
                        <div id="ic-in"></div>
                    </a>
                    <a class="hidden-xs" href="https://twitter.com/kafla1962" target="_blank">
                        <div id="ic-tw"></div>
                    </a>
                    <a class="hidden-xs" href="https://www.facebook.com/kafla1962/" target="_blank">
                        <div id="ic-fb"></div>
                    </a>
                    <div class="hidden-xs" id="follow-us-text"></div>
                    <div class="hidden-xs" id="decor-top-left"></div>

                    <!-- <div class="titles-top-home">25 years after racial tensions erupted, black and Korean communities reflect on L.A.</div> -->

                </div>

                <div class="watch-hero">
                    <a href="#videos" id="btn-watchvideo" class="btn btn-link" role="button">Watch video</a>
                </div>
            </div>
            <div class="bg-video-home-top" style="display: none;">
                <div class="embed-responsive embed-responsive-16by9">
                    <video autoplay loop muted playsinline controls width='100%' height='100%' class="embed-responsive-item">
                        <source src="/wp-content/themes/siennawp/assets/css/images/KAFLA.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="about-kafla-content parent-position">
            <div class="about-kafla-content-child child-position">
                <div class="empowerment-anchor-box">
                    <div class="col-xs-4 col-md-4">
                        <a href="/community-empowerment/">
                            <div class="empowerment-box parent-position">
                                <div class="empowerment-box-child child-position">
                                    <div id="ic-community"></div>
                                    <div class="empowerment-titles">Community Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <a href="/political-empowerment/">
                            <div class="empowerment-box parent-position">
                                <div class="empowerment-box-child child-position">
                                    <div id="ic-political"></div>
                                    <div class="empowerment-titles">Political Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <a href="/economic-empowerment/">
                            <div class="empowerment-box parent-position">
                                <div class="empowerment-box-child child-position">
                                    <div id="ic-economic"></div>
                                    <div class="empowerment-titles">Economic Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="news-box">
                    <div class="col-xs-12 col-md-12">
                        <a href="/ournews/">
                            <div id="news-korean" class="check-active-overlay">
                                <div class="korean-news-titles">NEWS ARTICLES</div>
                                <div class="korean-news-descript">[Korea Times] KAFLA Hosts 72nd <br> Korean
                                    Independence Day Ceremony
                                </div>
                                <div class="hover-overlay-effect active"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <a href="/photos/">
                            <div id="news-gallery" class="check-active-overlay">
                                <div class="news-titles">PHOTO GALLERY</div>
                                <div class="news-descript">Sebastian Ridley-Thomas visited KAFLA</div>
                                <div class="hover-overlay-effect active"></div>
                            </div>
                        </a>
                        <a href="/videos/">
                            <div id="news-video" class="check-active-overlay">
                                <div class="news-titles">VIDEO GALLERY</div>
                                <div class="news-descript">Korean American Federation of Los Angeles Introduction</div>
                                <div class="hover-overlay-effect active"></div>
                            </div>
                        </a>
                    </div>

                    <!--
                    <div class="col-xs-12 col-md-6 events">
                        <a href="/events/">
                            <div id="news-event" class="check-active-overlay">
                                <div class="news-titles">UPCOMING EVENTS</div>
                                <div class="news-descript"></div>
                                <div class="hover-overlay-effect active"></div>
                            </div>
                        </a>
                    </div>
                    -->
                </div>

            </div>
        </div>

        <div class="detailing-content parent-position">
            <div class="detailing-content-child child-position">
                <div class="col-xs-12 col-md-6 nopadding">
                    <div class="detailing-content-left parent-position">
                        <div class="detailing-content-left-child child-position">
                            <div class="visible-xs">
                                <div id="decor-hand"></div>
                            </div>
                            <div class="detailing-content-titles">
                                The Korean American Federation of Los Angeles (KAFLA)
                            </div>
                            <div class="visible-xs">
                                <div id="img-hand-mobi"></div>
                            </div>
                            <div class="detailing-descript">
                                The Korean American Federation of Los Angeles (KAFLA) is a registered 501(c)(3)
                                non-profit organization that serves the Korean American community in Greater Los
                                Angeles.
                            </div>
                            <div class="btn-read-more"><a href="/about-us/" id="btn-read-more" class="btn btn-link"
                                                          role="button">Read more</a></div>
                        </div>
                    </div>
                </div>
                <div class="hidden-xs col-md-6 nopadding">
                    <div id="img-hand"></div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

        <div class="brand-content parent-position">
            <div class="brand-content-child child-position">
                <div class="brand-titles">2019-2020 Heritage Night Sponsors</div>

                <div class="col-xs-6 col-md-6">
                    <a href="https://joseon.kr/" style="cursor: pointer;" target="_blank">
                        <div id="ic-joseon"></div>
                    </a>
                </div>
                <div class="col-xs-6 col-md-6">
                    <div id="ic-bank-of-hope"></div>
                </div>

                <div class="clearfix"></div>

                <div class="col-xs-4 col-md-4">
                    <div id="ic-korean-war"></div>
                </div>
                <div class="col-xs-4 col-md-4">
                    <div id="ic-hanmi-bank"></div>
                </div>
                <div class="col-xs-4 col-md-4">
                    <div id="ic-korean-text"></div>
                </div>
                <div class="clearfix"></div>
                <div class="btn-show-more"><a href="/sponsors/" id="btn-show-more" class="btn btn-link" role="button">Show
                        more</a></div>
            </div>
        </div>

    </div>


<?php get_footer(); ?>