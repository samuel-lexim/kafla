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
                                        <img alt="<?= $img['image']['alt'] ?>" src="<?= $img['image']['url'] ?>"/>
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
                        <a href="javascript:void(0)" id="btn-watchvideo" class="btn btn-link" role="button">Watch video</a>
                    </div>
                </div>

                <?php
                $video_link = get_field('home_video_link', 'option');
                $video_link = generateVideoEmbedUrl($video_link);
                $youtubeVideoId = explode('/embed/', $video_link);
                $youtubeVideoId = end($youtubeVideoId);
                $video_file = get_field('home_video_file', 'option');
                ?>
                <div class="bg-video-home-top" style="display: none;">
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php if ($video_link) { // Video Link ?>
                            <script src="https://www.youtube.com/iframe_api"></script>
                            <div class="embed-responsive-item youtube" id="player" data-id="<?= $youtubeVideoId ?>"></div>

                        <?php } else {
                        if ($video_file) { // Or Video File ?>
                            <video autoplay loop muted playsinline controls width='100%' height='100%' class="embed-responsive-item">
                                <source src="<?= $video_file ?>" type="video/mp4">
                            </video>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="about-kafla-content">
            <div class="about-kafla-content-child home-1col">
                <div class="empowerment-anchor-box">
                    <div class="_item">
                        <a href="/community-empowerment/">
                            <div class="empowerment-box">
                                <div class="empowerment-box-child">
                                    <div id="ic-community"></div>
                                    <div class="empowerment-titles">Community<br>Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="_item">
                        <a href="/political-empowerment/">
                            <div class="empowerment-box">
                                <div class="empowerment-box-child">
                                    <div id="ic-political"></div>
                                    <div class="empowerment-titles">Political<br>Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="_item">
                        <a href="/economic-empowerment/">
                            <div class="empowerment-box">
                                <div class="empowerment-box-child">
                                    <div id="ic-economic"></div>
                                    <div class="empowerment-titles">Economic<br>Empowerment</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="news-box">
                    <?php $newsArticlesImg = get_field('news_articles_img', 'option');
                    if ($newsArticlesImg && isset($newsArticlesImg['url'])) { ?>
                        <div class="col-xs-12 col-md-12">
                            <a href="/ournews/">
                                <div id="news-korean" class="check-active-overlay1" style="background-image: url(<?= $newsArticlesImg['url'] ?>)">
                                    <div class="korean-news-titles">NEWS ARTICLES</div>
                                    <div class="korean-news-descript">[Korea Times] KAFLA Hosts 72nd <br> Korean
                                        Independence Day Ceremony
                                    </div>
                                    <div class="hover-overlay-effect active"></div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                    <?php
                    $photoGalleryImg = get_field('photo_gallery_img', 'option');
                    $videoGalleryImg = get_field('video_gallery_img', 'option');
                    ?>

                    <div class="col-xs-12 col-md-12">
                        <?php if ($photoGalleryImg && isset($photoGalleryImg['url'])) { ?>
                            <a href="/photos/">
                                <div id="news-gallery" class="check-active-overlay" style="background-image: url(<?= $photoGalleryImg['url'] ?>)">
                                    <div class="news-titles">PHOTO GALLERY</div>
                                    <div class="news-descript">Sebastian Ridley-Thomas visited KAFLA</div>
                                    <div class="hover-overlay-effect active"></div>
                                </div>
                            </a>
                        <?php } ?>

                        <?php if ($videoGalleryImg && isset($videoGalleryImg['url'])) { ?>
                            <a href="/videos/">
                                <div id="news-video" class="check-active-overlay" style="background-image: url(<?= $videoGalleryImg['url'] ?>)">
                                    <div class="news-titles">VIDEO GALLERY</div>
                                    <div class="news-descript">Korean American Federation of Los Angeles Introduction</div>
                                    <div class="hover-overlay-effect active"></div>
                                </div>
                            </a>
                        <?php } ?>
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

        <div class="detailing-content ">
            <?php
            $aboutUsImg = get_field('about_us_img', 'option');
            ?>
            <div class="detailing-content-child home-1col">
                <div class="col-xs-12 col-sm-12 col-md-6 nopadding">
                    <div class="detailing-content-left">
                        <div class="detailing-content-left-child">
                            <div class="visible-xs visible-sm">
                                <div id="decor-hand"></div>
                            </div>
                            <div class="detailing-content-titles">
                                The Korean American Federation of Los Angeles (KAFLA)
                            </div>
                            <div class="visible-xs visible-sm">
                                <?php if ($aboutUsImg && isset($aboutUsImg['url'])) { ?>
                                    <div id="img-hand-mobi" style="background-image: url(<?= $aboutUsImg['url'] ?>)"></div>
                                <?php } ?>
                            </div>
                            <div class="detailing-descript">
                                The Korean American Federation of Los Angeles (KAFLA) is a registered 501(c)(3)
                                non-profit organization that serves the Korean American community in Greater Los
                                Angeles.
                            </div>
                            <div class="btn-read-more">
                                <a href="/about-us/" id="btn-read-more" class="btn btn-link" role="button">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-6 nopadding">
                    <?php if ($aboutUsImg && isset($aboutUsImg['url'])) { ?>
                        <div id="img-hand" style="background-image: url(<?= $aboutUsImg['url'] ?>)"></div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="brand-content">
            <div class="brand-content-child home-1col">
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