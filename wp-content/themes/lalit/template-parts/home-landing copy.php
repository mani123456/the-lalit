<?php
$GLOBALS['at_the_lalit_images'] = array();
$GLOBALS['hotel_service_image'] = array();
$GLOBALS['banner_images'] = array();
/* $GLOBALS['home-content-hide-flag'] = true; */
?>
<style type="text/css" media="screen">
    li {
        list-style: none;
    }

    .container-shadow {
        box-shadow: 0 18px 24px 0 #f1f1ef;
    }

    .container-shadow-bottom {
        box-shadow: 0px 15px 10px -11px #f1f1ef;
    }


    .page-title-home {
        font-size: 2.0em !important;
        text-transform: uppercase !important;
    }

    .card-info h5 {
        font-size: 2.0em !important;
    }

    .rate-guarantee-container.cm-content-blocks {
        display: none !important;
    }

    .book-direct-wrapper {
        background: #fff;
        margin-top: 40px;
    }

    .book-direct-wrapper .book-direct-inner {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 125px;
    }

    .book-direct-wrapper .book-direct-feature ul li a {
        color: #000;
    }

    .book-direct-wrapper .book-direct-inner .book-direct-feature {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 calc(100% - 200px);
        flex: 0 0 calc(100% - 200px);
        max-width: calc(100% - 200px);
        height: 100%;
        width: 100%;
        padding: 10px 0;
    }

    .book-direct-wrapper .book-direct-feature ul {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 12px 20px;
        height: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        border-left: 1px solid #d3d3d3;
    }

    .book-direct-wrapper .book-direct-feature ul li:last-child img {
        max-width: 140px;
    }

    .book-direct-wrapper .book-direct-feature ul li {
        text-align: center;
    }

    .book-direct-wrapper .book-direct-feature ul li span {
        display: block;
    }

    .book-direct-wrapper .book-direct-feature ul li span.custom-image {
        max-width: 60px;
        margin: 0 auto;
    }

    .book-direct-wrapper .book-direct-feature ul li span.custom-image img {
        height: 55px;
    }

    .book-direct-wrapper .book-direct-feature ul li:last-child span.custom-image {
        max-width: 100px;
    }

    .book-direct-wrapper .book-direct-inner .book-direct-title {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 200px;
        flex: 0 0 200px;
        max-width: 200px;
        padding: 0 0 0 20px;
        height: 100%;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        vertical-align: middle;
    }

    .book-direct-wrapper .book-direct-inner .book-direct-title h2 {
        margin: 0;
        color: #906506;
        font-weight: 700;
        font-size: 30px;
        height: 100%;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        vertical-align: baseline;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .book-direct-wrapper .book-direct-feature ul li.o_taj_incirle span.custom-image img {
        height: 70px;
        margin: -8px 0 -8px -12px;
    }

    .book-direct-wrapper .book-direct-feature ul li.o_taj_incirle span.custom-image {
        max-width: 90px;
    }

    @media(max-width:991px) {

        .book-direct-wrapper .book-direct-inner .book-direct-title h2 {
            font-size: 22px;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-image {
            max-width: 50px;
        }

        .book-direct-wrapper .book-direct-feature ul li span {
            font-weight: 700;
        }

        .book-direct-wrapper .book-direct-inner .book-direct-feature {
            -ms-flex: 0 0 calc(100% - 150px);
            flex: 0 0 calc(100% - 150px);
            max-width: calc(100% - 150px);
        }

        .book-direct-wrapper .book-direct-inner .book-direct-title {
            -ms-flex: 0 0 150px;
            flex: 0 0 150px;
            max-width: 150px;
        }

        .card-info h5 {
            font-size: 1.8em !important;
        }
    }

    @media(max-width:991px) and (min-width:768px) {
        .book-direct-wrapper .book-direct-feature ul li {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 16.66%;
            flex: 0 0 16.66%;
            width: 100%;
            max-width: 16.66%;
        }

        .card-info h5 {
            font-size: 1.8em !important;
        }
    }

    @media(max-width: 767px) {
        .book-direct-wrapper .book-direct-inner .book-direct-title {
            -ms-flex: 0 0 100%;
            -webkit-box-flex: 0;
            flex: 0 0 100%;
            max-width: 100%;
            background: none !important;
            padding: 20px;
            display: none;
        }

        .book-direct-wrapper {
            /* max-width: 100%;
            width: 100%; */
            margin-left: 0px;
        }

        .book-direct-wrapper .book-direct-inner {
            height: auto !important;
        }

        .cm-page-container .content-wrapper {
            margin-top: 0 !important;
        }

        .book-direct-wrapper .book-direct-inner .book-direct-title h2 {
            text-align: center;
            color: #000;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: auto !important;
            display: block;
            position: relative;
        }

        .book-direct-wrapper .book-direct-inner .book-direct-title h2::after {
            content: "";
            position: absolute;
            height: 1px;
            width: 100px;
            background-color: var(--primaryColor);
            bottom: -10px;
            left: 50%;
            transform: translate(-50%);
        }

        .book-direct-wrapper .book-direct-inner .book-direct-title h2 br {
            display: none;
        }

        .book-direct-wrapper .book-direct-inner .book-direct-feature {
            -ms-flex: 0 0 100%;
            -webkit-box-flex: 0;
            flex: 0 0 100%;
            max-width: 100%;
            height: auto !important;
            margin-top: 30px;
        }

        .book-direct-wrapper .book-direct-feature ul {
            padding: 15px 10px;
            height: auto !important;
            border-left: none;
        }

        .book-direct-wrapper .book-direct-feature ul li {
            max-width: 33.33%;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 33.33%;
            flex: 0 0 33.33%;
            margin-bottom: 20px;
        }

        .book-direct-wrapper .book-direct-feature ul {
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-text {
            font-size: 14px;
            margin-top: 5px;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-image img[alt="tic rewards"] {
            margin-left: -10px;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-image img {
            height: 45px;
        }

        .book-direct-wrapper .book-direct-feature ul li.o_taj_incirle span.custom-image img {
            margin: -12px 0 -12px -12px;
        }

        .card-info h5 {
            font-size: 1.6em !important;
        }

        .no-padding {
            padding-left: 0px;
            padding-right: 0px;
        }
    }

    @media(max-width:480px) {
        .book-direct-wrapper {
            /* max-width: calc(100% + 00px);
            width: calc(100% + 00px); */
            margin-left: 0;
        }

        .book-direct-wrapper .book-direct-feature ul {
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: end;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-text {
            font-size: 12px;
            font-style: normal;
            font-stretch: normal;
            line-height: 1.17;
            letter-spacing: 0.5px;
            text-align: center;
            color: #000;
            margin: 0;
            font-weight: 400;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-image {
            max-width: 40px;
            margin: 0 auto 10px;
            height: 40px;
        }

        .book-direct-wrapper .book-direct-feature ul li span.custom-image img {
            height: 35px;
        }

        .card-info h5 {
            font-size: 1.6em !important;
        }

        .no-padding {
            padding-left: 0px;
            padding-right: 0px;
        }

    }
</style>
<div class="content-section">

    <?php
    $home_banners = get_page_overview_banners();
    ?>

    <?php
    if ($home_banners->have_posts()) :
    ?>
        <div class="main-banner banner-slider align-center home-page-banner view-port-detect">
            <div id="main-banner-slider" class="flexslider">

                <ul class="slides">
                    <?php
                    $count = 0;
                    while ($home_banners->have_posts()) : $home_banners->the_post();
                        $heading = get_post_meta($post->ID, 'banner_heading', true);
                        $description = get_post_meta($post->ID, 'banner_description', true);
                        $url = trim(get_post_meta($post->ID, 'url', true));
                        //$button_text = get_post_meta($post->ID, 'button_text', true);
                        if (isMobile()) {
                            $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        } else {
                            $image_id = get_post_meta($post->ID, 'banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }
                        $banner_type = get_post_meta($post->ID, 'banner_type', true);
                        $destination = get_destination_by_banner_id($post->ID);
                        $video_url = get_post_meta($post->ID, 'video_url', true);
                        $short_video = get_post_meta($post->ID, 'short_video', true);
                        $exclude_temperature = get_post_meta($post->ID, 'exclude_temperature', true);

                        $city_name = '';
                        $country = '';
                        $city = '';
                        if ($destination->have_posts()) :

                            while ($destination->have_posts()) : $destination->the_post();

                                $location = get_the_terms($post->ID, 'locations');
                                $city_name = $location[0]->slug;
                                $city = $location[0]->name;
                                if ($location[0]->slug == 'london') {
                                    $country = 'UK';
                                } else {
                                    $country = 'India';
                                }

                            endwhile;

                        endif;
                        wp_reset_postdata();
                    ?>
                        <?php
                        if ($banner_type == 0) {
                            if ($image != '') {
                        ?>
                                <li class="<?php if (!$exclude_temperature && $city_name != '' && $country != '') { ?>first_banner<?php } ?>">
                                    <?php if ($url && trim($url) != '') {
                                        echo '<a href="' . $url . '">';
                                    } ?>
                                    <?php
                                    if ($count == 0) {
                                    ?>
                                        <img src="<?php echo $image; ?>">
                                    <?php
                                    } else {
                                        array_push($GLOBALS['banner_images'], $image);
                                    ?>
                                        <img src="" class="banner-images">
                                    <?php
                                    }

                                    if ($url && trim($url) != '') {
                                        echo '</a>';
                                    }
                                    ?>

                                    <?php
                                    if (!$exclude_temperature && $city_name != '' && $country != '') {
                                    ?>
                                        <input type="hidden" class="city" value="<?php echo ucwords($city_name); ?>" />
                                        <input type="hidden" class="country" value="<?php echo $country; ?>" />
                                    <?php
                                    }

                                    if (!$exclude_temperature && $city_name != '' && $country != '') {
                                    ?>
                                        <div class="temp-wrap">
                                            <div id="wxWrap" class="wxWrap text-shadow">
                                                <span id="wxTemp" class="wxTemp"></span><!-- #wxTemp -->
                                                <span id="wxIcon2" class="wxIcon2"></span>
                                                <span id="wxIntro" class="wxIntro"></span><!-- #wxIntro -->
                                            </div><!-- #wxWrap -->
                                        </div><!-- temp-wrap -->
                                    <?php
                                    }

                                    if ($url && trim($url) != '') {
                                        echo '<a href="' . $url . '">';
                                    }
                                    ?>

                                    <div class="banner-content">
                                        <?php
                                        if ($heading != '') {
                                        ?>
                                            <h1 class="main-title text-white text-shadow"><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($description != '') {
                                        ?>
                                            <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div><!-- banner-content -->
                                    <?php if ($url && trim($url) != '') {
                                        echo '</a>';
                                    } ?>
                                </li>
                            <?php
                            }
                        } else {
                            if (($image != '' && trim($video_url) != '') || ($image != '' && wp_get_attachment_url($short_video) != '')) {
                            ?>
                                <li class="<?php if (!$exclude_temperature && $city_name != '' && $country != '') { ?>first_banner<?php } ?>">
                                    <div class="videoBannerWrap">
                                        <div class="bannerVideo">
                                            <?php
                                            if (trim($video_url) != '') {
                                                $video_url = rtrim($video_url, '/');
                                                $video_url .= '?rel=0&autoplay=1';

                                                if ($heading != '') {
                                                    $class = "video-header";
                                                } else {
                                                    $class = "";
                                                }
                                            ?>
                                                <a href="javascript:void(0)" class="video-thumb <?php echo $class; ?>">
                                                    <span class="video-play-btn"><i class="ico-sprite sprite ico-play-in-white"></i></span>
                                                </a>
                                            <?php

                                            }
                                            ?>
                                            <img src="<?php echo $image; ?>" alt="<?php echo $heading; ?>">
                                            <?php

                                            /* if ($short_video && !(isIpad() || isMobile())) { */
                                            if ($short_video) {

                                            ?>
                                                <div id="videoWrap">
                                                    <video id="videoElement3"  <?php if (!isMobile() && !isIPad()) { ?>autoplay<?php } ?> preload="auto" autoplay muted playsinline loop class="videoElement">
                                                        <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/mp4">
                                                        <!-- <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/webm"> -->
                                                    </video>
                                                </div><!-- videoWrap -->
                                                <script>
                                                    var herovide3 = $('#videoElement3');
                                                    herovide3.autoplay = true;
                                                    herovide3.load();
                                                </script>
                                            <?php
                                            }

                                            if (!$exclude_temperature && $city_name != '' && $country != '') {
                                            ?>
                                                <input type="hidden" class="city" value="<?php echo ucwords($city_name); ?>" />
                                                <input type="hidden" class="country" value="<?php echo $country; ?>" />
                                            <?php
                                            }


                                            if (!$exclude_temperature && $city_name != '' && $country != '') {
                                            ?>
                                                <div class="temp-wrap">
                                                    <div id="wxWrap" class="wxWrap text-shadow">
                                                        <span id="wxTemp" class="wxTemp"></span><!-- #wxTemp -->
                                                        <span id="wxIcon2" class="wxIcon2"></span>
                                                        <span id="wxIntro" class="wxIntro"></span><!-- #wxIntro -->
                                                    </div><!-- #wxWrap -->
                                                </div><!-- temp-wrap -->
                                            <?php
                                            }


                                            if ($heading != '') {
                                            ?>
                                                <div class="banner-content align-center video-banner-content">
                                                    <h1 class="main-title text-white text-shadow "><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <?php
                                        if ($video_url != '') {
                                        ?>
                                            <div class="fullVideo" style="display:none;">
                                                <span class="closeVideo fancybox-close"></span>
                                                <div class="fullVideoInn">
                                                    <iframe src="" data="<?php echo $video_url; ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                                                </div>
                                            </div>
                                            <!--fullVideo-->
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                        <?php

                            }
                        }
                        ?>
                    <?php
                        $count++;
                    endwhile;
                    ?>
                </ul>

            </div><!-- flexslider -->
        </div><!-- main-banner -->
    <?php
    endif;
    ?>

    <div class="container">
        <div class="row">
            <div class="booking-widget-sec">
                <div class="booking-widget clearfix h-align-widget">
                    <?php
                    if (isMobile() || isIPad()) {
                    ?>
                        <a href="#mobile-book-widget" class="btn mobile-book-stay primary-btn">Book A Stay</a>
                    <?php
                    } else {
                        get_template_part('includes/booking', 'widget');
                    }
                    ?>
                </div><!-- booking-widget -->
            </div>
        </div>
    </div>

    <div class="container book-direct-wrapper container-shadow-bottom">
        <div class="book-direct-inner row">
            <div class="book-direct-title col2">
                <h2>Book Direct </h2>
            </div>
            <div class="book-direct-feature col10">
                <ul>
                    <li><a href="#"><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/satisfaction.svg" alt="Best Rates"></span><span class="custom-text">Best Rates</span></a></li>
                    <li><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/no.svg" alt="No Hidden Charges"></span><span class="custom-text">No Hidden Charges</span></li>
                    <li><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/money.svg" alt="Pay At Hotel"></span><span class="custom-text">Pay at Hotel </span></li>
                    <li><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/price-tag.svg" alt="Exclusive Offers"></span><span class="custom-text">Exclusive Offers</span></li>
                    <li class=""><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/shield.svg" alt="We Care"></span><span class="custom-text">We Care</span></li>
                    <li><span class="custom-image"><img src="/wp-content/themes/lalit/images/offers-icon/wifi.svg" alt="Wifi"></span><span class="custom-text">Wifi Access</span></li>
                </ul>
            </div>
        </div>
    </div>



    <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
        <div class="container section-space intro-text align-center container-shadow">
            <div class="row">
                <span class="seperator"></span>
                <h2 class="sec-title page-title-home">About The LaLiT</h2>
                <p class="col col8 align-content-center"> We are one of the leading privately-owned domestic hotel brands in India, engaged in the business of operating and managing hotels, palaces and resorts with a focus on the luxury segment. We operate 12 luxury hotels, palaces and resorts under The LaLiT brand and two mid-market segment hotels under The LaLiT Traveller brand across India’s key business and leisure travel destinations, offering 2,261 rooms. Also, we hold the exclusive rights to operate and provide management consultancy services to a hotel in London, The LaLiT London, offering 70 rooms.<br><br>Our luxury hotels operating across India under The LaLiT brand are grouped into the following three categories:<br><br>

                    <strong>City hotels:</strong> The LaLiT New Delhi, The LaLiT Mumbai, The LaLiT Ashok Bangalore, The LaLiT Great Eastern Kolkata, The LaLiT Jaipur and The LaLiT Chandigarh. <br><br>
                    <strong>Palaces:</strong> The LaLiT Laxmi Vilas Palace Udaipur and The LaLiT Grand Palace Srinagar.<br><br>
                    <strong>Resorts:</strong> The LaLiT Golf & Spa Resort Goa, The LaLiT Resort & Spa Bekal (Kerala), The LaLiT Mangar and The LaLiT Temple View Khajuraho. <br><br>
                </p>
            </div><!-- row -->
        </div><!-- container -->
    <?php endif; ?>
    <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
        <?php
        $home_awards = get_home_page_awards();
        ?>

        <?php
        if ($home_awards->have_posts()) :
        ?>
            <div class="container view-port-detect container-shadow" id="awards">
                <div class="row  align-center">
                    <ul class="reward-list">
                        <?php
                        while ($home_awards->have_posts()) : $home_awards->the_post();
                            $award_name = get_post_meta($post->ID, "name", true);
                            $award_body = get_the_terms($post->ID, 'award-body');
                            $awarded_to = get_post_meta($post->ID, "awarded_to", true);

                            $award_logo = '';
                            foreach ($award_body as $award) {
                                $term_id = $award->term_id;
                                $meta_data = get_term_meta($term_id);
                                foreach ($meta_data as $data) {
                                    $award_logo = $data[0];
                                    //array_push($GLOBALS['awards_images'], $award_logo);
                                }
                            }
                            $city_name = '';
                            $destination = get_destination_by_award_id($post->ID);
                            if ($destination->have_posts()) :

                                while ($destination->have_posts()) : $destination->the_post();

                                    $location = get_the_terms($post->ID, 'locations');
                                    $city_name = $location[0]->name;

                                endwhile;

                            endif;
                        ?>
                            <li class="span span3">
                                <div class="reward-item">
                                    <div class="reward-logo">
                                        <img src="" class="image js_image_load image-tag" alt="<?php echo $award_name; ?>" title="<?php echo $award_name; ?>" data-src="<?php echo $award_logo; ?>" />
                                    </div><!-- reward-logo -->
                                    <div class="reward-meta">
                                        <strong class="truncate"><?php echo $awarded_to . '-' . $city_name; ?></strong>
                                        <span class="truncate"><?php echo $award_name; ?></span>
                                    </div><!-- reward-meta -->
                                </div><!-- reward-item -->
                            </li>
                        <?php
                        endwhile
                        ?>
                    </ul>
                </div>
            </div>
        <?php
        endif;
        ?>
    <?php
    endif;
    ?>
    <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
        <div class="container fluid-width section-space clearfix container-shadow">
            <div id="parallax" class="main-banner align-center large-banner-sec branding-sec" style="background: url('/wp-content/themes/lalit/images/corporate-template.jpg') no-repeat center; background-size: cover;" data-paroller-factor="0.085" data-paroller-factor-xs="0.085">
                <div class="row align-center">
                    <div class="banner-content">
                        <h1 class="main-title text-white text-shadow">Traditionally Modern, Subtly Luxurious, Distinctly LaLiT</h1>
                    </div><!-- banner-content -->
                </div><!-- row -->
            </div><!-- parallax-window -->
        </div><!-- container -->
    <?php
    endif;
    ?>

    <?php
    get_template_part('includes/popular', 'offers-home-page-slider');
    ?>

    <?php if (isMobile()) { ?>
        <?php
        get_template_part('includes/pick', 'destination-home-page-slider');
        ?>
    <?php } else { ?>
        <?php
        get_template_part('includes/pick', 'destination-home-page');
        ?>
    <?php } ?>

    <?php if ($GLOBALS['home-content-hide-flag']) : ?>
        <?php
        $home_banners_lalit_deliver = get_lalit_deliver_banners('lalit-delivers');
        // print_r($home_banners);
        ?>
        <?php
        if ($home_banners_lalit_deliver->have_posts()) :
            // print_r($home_banners_lalit_deliver);
        ?>
            <div class="container fluid-width section-space clearfix container-shadow">
                <div class="row clearfix">
                    <h2 class="sec-title align-center page-title-home">The Lalit Delivers</h2>
                    <div id="slider-new" class="flexslider slider-new">
                        <ul class="slides">
                            <?php
                            $count = 0;
                            while ($home_banners_lalit_deliver->have_posts()) : $home_banners_lalit_deliver->the_post();
                                $heading = get_post_meta($post->ID, 'banner_heading', true);
                                $description = get_post_meta($post->ID, 'banner_description', true);
                                $url = trim(get_post_meta($post->ID, 'url', true));
                                //$button_text = get_post_meta($post->ID, 'button_text', true);
                                if (isMobile()) {
                                    $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                                    $image = wp_get_attachment_url($image_id);
                                } else {
                                    $image_id = get_post_meta($post->ID, 'banner_image', true);
                                    $image = wp_get_attachment_url($image_id);
                                }
                                $banner_type = get_post_meta($post->ID, 'banner_type', true);
                                $video_url = get_post_meta($post->ID, 'video_url', true);
                                $short_video = get_post_meta($post->ID, 'short_video', true);
                                wp_reset_postdata();
                            ?>
                                <?php
                                if ($banner_type == 0) {
                                    if ($image != '') {
                                ?>
                                        <li class="">
                                            <?php if ($url && trim($url) != '') {
                                                echo '<a href="' . $url . '">';
                                            } ?>
                                            <?php
                                            if ($count == 0) {
                                            ?>
                                                <img src="<?php echo $image; ?>">
                                            <?php
                                            } else {
                                                // array_push($GLOBALS['banner_images'], $image);
                                            ?>
                                                <!-- <img src="" class="banner-images"> -->
                                                <img src="<?php echo $image; ?>">
                                            <?php
                                            }
                                            ?>

                                            <div class="banner-content">
                                                <?php
                                                if ($heading != '') {
                                                ?>
                                                    <h1 class="main-title text-white text-shadow"><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if ($description != '') {
                                                ?>
                                                    <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                                <?php
                                                }
                                                ?>
                                            </div><!-- banner-content -->
                                            <?php if ($url && trim($url) != '') {
                                                echo '</a>';
                                            } ?>
                                        </li>
                                    <?php
                                    }
                                } else {
                                    if (($image != '' && trim($video_url) != '') || ($image != '' && wp_get_attachment_url($short_video) != '')) {
                                    ?>
                                        <li class="first_banner">
                                            <div class="videoBannerWrap">
                                                <div class="bannerVideo">
                                                    <?php
                                                    if (trim($video_url) != '') {
                                                        $video_url = rtrim($video_url, '/');
                                                        $video_url .= '?rel=0&autoplay=1';

                                                        if ($heading != '') {
                                                            $class = "video-header";
                                                        } else {
                                                            $class = "";
                                                        }
                                                    ?>
                                                        <a href="javascript:void(0)" class="video-thumb <?php echo $class; ?>">
                                                            <span class="video-play-btn"><i class="ico-sprite sprite ico-play-in-white"></i></span>
                                                        </a>
                                                    <?php

                                                    }
                                                    ?>
                                                    <img src="<?php echo $image; ?>" alt="<?php echo $heading; ?>">
                                                    <?php

                                                    /*                                                     if ($short_video && !(isIpad() || isMobile())) { */

                                                    ?>
                                                    <div id="videoWrap">
                                                        <video id="videoElement1" <?php if (!isMobile() && !isIPad()) { ?>autoplay<?php } ?> preload="auto" autoplay muted playsinline loop class="videoElement">
                                                            <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/mp4">
                                                            <!-- <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/webm"> -->
                                                        </video>
                                                    </div><!-- videoWrap -->
                                                    <script>
                                                        var herovide1 = $('#videoElement1');
                                                        herovide1.autoplay = true;
                                                        herovide1.load();
                                                    </script>

                                                    <?php
                                                    /* } */

                                                    if ($heading != '') {
                                                    ?>
                                                        <div class="banner-content align-center video-banner-content">
                                                            <h1 class="main-title text-white text-shadow "><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <?php
                                                if ($video_url != '') {
                                                ?>
                                                    <div class="fullVideo" style="display:none;">
                                                        <span class="closeVideo fancybox-close"></span>
                                                        <div class="fullVideoInn">
                                                            <iframe src="" data="<?php echo $video_url; ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                                                        </div>
                                                    </div>
                                                    <!--fullVideo-->
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </li>
                                <?php

                                    }
                                }
                                ?>
                            <?php
                                $count++;
                            endwhile;
                            ?>
                        </ul>

                    </div><!-- flexslider -->
                </div>
            </div><!-- main-banner -->
    <?php
        endif;
    endif;
    ?>


    <?php
    $with_lalit = get_with_lalit();
    ?>
    <?php
    if ($with_lalit->have_posts()) :
    ?>
        <div class="container fluid-width section-space at-lalit container-shadow" id="at-lalit">
            <div class="row big-carousel">
                <h2 class="sec-title align-center page-title-home">At The LaLiT </h2>
                <div class="owl-carousel owl-theme at-lalit-carousel">
                    <?php
                    while ($with_lalit->have_posts()) : $with_lalit->the_post();
                        $title = get_the_title($post->ID);
                        $image_id = get_post_meta($post->ID, 'image', true);
                        $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                        $description = get_post_meta($post->ID, 'description', true);

                        array_push($GLOBALS['at_the_lalit_images'], $image);
                    ?>
                        <div class="card-item">
                            <div class="card-item-listing background-color">
                                <div class="card-img">
                                    <img src="" class="image" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
                                </div><!-- card-img -->

                                <div class="card-info">
                                    <h3 class="card-info-title">
                                        <span class="bdr-bottom" <?php if (!(isIpad() || isMobile())) { ?>style="color:#fff;" <?php } ?>><?php echo $title; ?></span>
                                    </h3>
                                    <!-- <h3 class="item-title"><?php echo $title; ?></h3> -->
                                    <p><?php echo $description; ?></p>
                                </div><!-- card-info -->
                            </div><!-- card-item-listing -->
                        </div><!-- card-item -->
                    <?php

                    endwhile;
                    ?>
                </div><!-- owl-carousel -->
            </div><!-- row -->
        </div><!-- container -->
    <?php

    endif;
    wp_reset_postdata();
    ?>


    <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
        <?php
        $home_dinings = get_home_page_dinings();
        ?>
        <?php
        if ($home_dinings->have_posts()) :
        ?>
            <div class="container section-space view-port-detect container-shadow" id="dining-section">
                <div class="row ">
                    <div class="col col10 align-center align-content-center">
                        <h2 class="sec-title align-center page-title-home">Gastronomy</h2>
                        <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
                            <p>Combining the finest of traditional Indian cooking with culinary concepts from all over the world, The Lalit offers a host of signature restaurants serving delectable cuisines. Our dining venues are designed to evoke the senses, from enticing flavours and aromas to the brilliance of design and décor. Coupled with an extensive beverage menu and our impeccable service, the restaurants promise an unparalleled dining experience.</p>
                        <?php endif; ?>
                    </div><!-- col -->

                    <div class="gastronomy-sec align-center ">
                        <div class="row gastronomy-listing-sec">
                            <?php
                            $dining_count = 0;
                            while ($home_dinings->have_posts()) : $home_dinings->the_post();

                                $image = '';
                                $name = get_post_meta($post->ID, 'name', true);
                                $image_ids = get_post_meta($post->ID, 'images', true);
                                $image_ids = explode(",", $image_ids);
                                $image = wp_get_attachment_image_src($image_ids[0], 'medium_large')[0];

                                //array_push($GLOBALS['dining_images'], $image);

                                $permalink = get_permalink($post->ID);
                                $city_name = '';
                                $destination = get_destination_by_dining_id($post->ID);

                                if ($destination->have_posts()) :

                                    while ($destination->have_posts()) : $destination->the_post();

                                        $location = get_the_terms($post->ID, 'locations');
                                        $city_name = $location[0]->name;
                                    endwhile;

                                endif;
                                wp_reset_postdata();

                                $style = '';
                                $class = '';
                                if ($dining_count > 2) {
                                    $style = "display:none";
                                    $class = "more";
                                }


                                if ($dining_count % 3 == 0 && $dining_count < $home_dinings->post_count) {
                                    if ($dining_count > 0 && $dining_count < $home_dinings->post_count) {
                            ?>
                        </div><!-- gastronomy-listing -->
                    <?php
                                    }
                                    if ($dining_count % 3 == 0 && $dining_count > 0) {
                    ?>
                    </div>
                    <div class="row gastronomy-listing-sec">
                    <?php
                                    }
                    ?>
                    <div class="gastronomy-listing vcard <?php echo $class; ?>" style="<?php echo $style; ?>">
                    <?php
                                }
                    ?>
                    <a href="<?php echo $permalink; ?>" class="gastronomy-block background-color u-url">
                        <div class="hotel-img img-block dining-images js_image_load background background-color" data-src="background: url('<?php echo $image; ?>') no-repeat center center;" data-url="<?php echo $image; ?>" style=""></div><!-- img-block -->

                        <h3 class="item-title p-name"><?php echo $name; ?>, <span><?php echo $city_name; ?></span></h3>
                    </a>
                    <?php
                                if ($dining_count % 3 == 0 && $dining_count < $home_dinings->post_count) {
                    ?>
                    </div><!-- gastronomy-listing -->
                    <div class="gastronomy-listing vcard<?php echo $class; ?>" style="<?php echo $style; ?>">
                <?php
                                }

                                $dining_count++;

                            endwhile;
                ?>
                    </div>

                    </div>
                    <?php
                    if ($home_dinings->post_count > 3) {
                    ?>
                        <a href="javascript:void(0);" class="btn secondary-btn view_more_dining">View More</a>
                        <a href="javascript:void(0);" class="btn secondary-btn view_less_dining" style="display:none">View Less</a>
                    <?php
                    }
                    ?>

                </div>
            </div>
</div>
<?php

        endif;
        wp_reset_postdata();
?>
<?php
    endif;
?>
<?php if (!$GLOBALS['home-content-hide-flag']) : ?>
    <?php
    $home_service = get_home_page_services();
    ?>
    <?php
    if ($home_service->have_posts()) :
    ?>
        <div class="container section-space award-winning-services container-shadow" id="award-services">
            <div class="row">
                <h2 class="sec-title align-center page-title-home">Best Offers</h2>
                <div class="owl-carousel owl-theme service-carousel">
                    <?php
                    while ($home_service->have_posts()) : $home_service->the_post();

                        $name = get_post_meta($post->ID, 'name', true);
                        $images = get_post_meta($post->ID, 'image', true);
                        $images = explode(',', $images);
                        $image = wp_get_attachment_url($images[0]);
                        array_push($GLOBALS['hotel_service_image'], $image);
                        $timings = get_post_meta($post->ID, 'timings', true);
                        $description = get_post_meta($post->ID, 'description', true);
                    ?>
                        <div class="card-item">
                            <div class="card-img">
                                <img src="" class="image" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                            </div>
                            <div class="card-info">
                                <?php
                                if ($name != '') {
                                ?>
                                    <h3 class="card-info-title">
                                        <span class="bdr-bottom" style="color:#fff;"><?php echo $name; ?></span>
                                    </h3>
                                <?php
                                }
                                ?>

                                <?php
                                if ($timings != '') {
                                ?>
                                    <span class="availability"><?php echo $timings; ?></span>
                                <?php
                                }
                                ?>

                                <?php
                                if ($description != '') {
                                ?>
                                    <p><?php echo $description; ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    <?php

                    endwhile;
                    ?>
                </div><!-- owl-carousel -->
            </div><!-- row -->
        </div><!-- container -->
    <?php endif; ?>
<?php endif; ?>

<?php
if (!$GLOBALS['home-content-hide-flag']) :
    $home_experience = get_home_page_experiences();
?>

    <?php
    if ($home_experience->have_posts()) :
    ?>
        <div class="main-banner banner-slider align-center experience-slider view-port-detect container-shadow" id="experience">
            <div id="banner-slider" class="flexslider">
                <ul class="slides">
                    <?php

                    while ($home_experience->have_posts()) : $home_experience->the_post();

                        $category_title = get_post_meta($post->ID, "category_title", true);
                        $description = get_post_meta($post->ID, "description", true);
                        $image_id = get_post_meta($post->ID, "banner_image", true);
                        if (isMobile()) {
                            $banner_image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                        } else {
                            $banner_image = wp_get_attachment_url($image_id);
                        }
                        $exp = get_experience_by_category($post->ID);

                        $destination = '';
                        if ($exp->have_posts()) :

                            $experience_id = '';
                            while ($exp->have_posts()) : $exp->the_post();

                                $experience_id = $post->ID;

                            endwhile;

                            $destination = get_destination_by_experience_id($experience_id);
                        endif;
                        wp_reset_postdata();


                        $permalink = 'javascript:void(0)';
                        if ($destination->have_posts()) :

                            while ($destination->have_posts()) : $destination->the_post();

                                $location = get_the_terms($post->ID, 'locations');
                                $city_name = $location[0]->slug;
                                $permalink = site_url() . '/the-lalit-' . $city_name . '/experience-the-lalit';

                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                        <li class="large-banner-sec exp-images js_image_load background-image background-color" data-src="url('<?php echo $banner_image; ?>')" style="background-size: cover;" data-url="<?php echo $banner_image; ?>">
                            <div class="banner-content">
                                <h1 class="main-title text-white text-shadow"><?php echo $category_title; ?></h1>
                                <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                <a href="<?php echo $permalink; ?>" class="btn primary-btn" title="discover">Discover</a>
                            </div><!-- banner-content -->
                        </li>
                    <?php

                    endwhile;
                    ?>
                </ul>
            </div><!-- slider -->
        </div><!-- sec-banner -->
<?php
    endif;
endif;
?>

<?php if (!$GLOBALS['home-content-hide-flag']) : ?>
    <div class="container fluid-width section-space cta-section view-port-detect container-shadow" id="loyalty">
        <div class="row">
            <div class="col col12 align-content-center">
                <h2 class="sec-title align-center page-title-home">Save & Earn with Loyalty</h2>
            </div>
        </div>
        <div class="row cta-listing">
            <div class="col col6 cta-listing-block align-content-center">
                <div class="cta-list">
                    <img src="" class="loyalty-image js_image_load image-tag" data-src="/wp-content/themes/lalit/images/loyalty.jpg" alt="Loyalty Program" title="Loyalty Program" />
                    <div class="item-head">
                        <a href="<?php echo site_url(); ?>/the-lalit-loyalty/" class="btn primary-btn">Learn more</a>
                    </div><!-- item-blk -->
                </div>
            </div><!-- col -->
        </div><!-- room-types -->
    </div><!-- container -->
<?php
endif;
?>

<?php if ($GLOBALS['home-content-hide-flag']) : ?>
    <?php
    $home_banners_lalit_deliver = get_we_care_banners('we_care_banner');
    // print_r($home_banners);
    ?>
    <?php
    if ($home_banners_lalit_deliver->have_posts()) :
        // print_r($home_banners_lalit_deliver);
    ?>
        <div class="container fluid-width section-space clearfix container-shadow">
            <div class="row clearfix">
                <h2 class="sec-title align-center page-title-home">We Care</h2>
                <div id="we-care-slider" class="flexslider we-care-slider">
                    <ul class="slides">
                        <?php
                        $count = 0;
                        while ($home_banners_lalit_deliver->have_posts()) : $home_banners_lalit_deliver->the_post();
                            $heading = get_post_meta($post->ID, 'banner_heading', true);
                            $description = get_post_meta($post->ID, 'banner_description', true);
                            $url = trim(get_post_meta($post->ID, 'url', true));
                            //$button_text = get_post_meta($post->ID, 'button_text', true);
                            if (isMobile()) {
                                $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            } else {
                                $image_id = get_post_meta($post->ID, 'banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            }
                            $banner_type = get_post_meta($post->ID, 'banner_type', true);
                            $video_url = get_post_meta($post->ID, 'video_url', true);
                            $short_video = get_post_meta($post->ID, 'short_video', true);
                            wp_reset_postdata();
                        ?>
                            <?php
                            if ($banner_type == 0) {
                                if ($image != '') {
                            ?>
                                    <li class="">
                                        <?php if ($url && trim($url) != '') {
                                            echo '<a href="' . $url . '">';
                                        } ?>
                                        <?php
                                        if ($count == 0) {
                                        ?>
                                            <img src="<?php echo $image; ?>">
                                        <?php
                                        } else {
                                            // array_push($GLOBALS['banner_images'], $image);
                                        ?>
                                            <!-- <img src="" class="banner-images"> -->
                                            <img src="<?php echo $image; ?>">
                                        <?php
                                        }
                                        ?>

                                        <div class="banner-content">
                                            <?php
                                            if ($heading != '') {
                                            ?>
                                                <h1 class="main-title text-white text-shadow"><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if ($description != '') {
                                            ?>
                                                <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div><!-- banner-content -->
                                        <?php if ($url && trim($url) != '') {
                                            echo '</a>';
                                        } ?>
                                    </li>
                                <?php
                                }
                            } else {
                                if (($image != '' && trim($video_url) != '') || ($image != '' && wp_get_attachment_url($short_video) != '')) {
                                ?>
                                    <li class="first_banner">
                                        <div class="videoBannerWrap">
                                            <div class="bannerVideo">
                                                <?php
                                                if (trim($video_url) != '') {
                                                    $video_url = rtrim($video_url, '/');
                                                    $video_url .= '?rel=0&autoplay=1';

                                                    if ($heading != '') {
                                                        $class = "video-header";
                                                    } else {
                                                        $class = "";
                                                    }
                                                ?>
                                                    <a href="javascript:void(0)" class="video-thumb <?php echo $class; ?>">
                                                        <span class="video-play-btn"><i class="ico-sprite sprite ico-play-in-white"></i></span>
                                                    </a>
                                                <?php

                                                }
                                                ?>
                                                <img src="<?php echo $image; ?>" alt="<?php echo $heading; ?>">
                                                <?php

                                                /* if ($short_video && !(isIpad() || isMobile())) { */

                                                ?>
                                                    <div id="videoWrap">
                                                        <video id="videoElement4" <?php if (!isMobile() && !isIPad()) { ?>autoplay<?php } ?> preload="auto" autoplay muted playsinline loop class="videoElement">
                                                            <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/mp4">
                                                            <!-- <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/webm"> -->
                                                        </video>
                                                    </div><!-- videoWrap -->
                                                    <script>
                                                        var herovide4 = $('#videoElement4');
                                                        herovide4.autoplay = true;
                                                        herovide4.load();
                                                    </script>

                                                <?php
                                                /* } */

                                                if ($heading != '') {
                                                ?>
                                                    <div class="banner-content align-center video-banner-content">
                                                        <h1 class="main-title text-white text-shadow "><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            if ($video_url != '') {
                                            ?>
                                                <div class="fullVideo" style="display:none;">
                                                    <span class="closeVideo fancybox-close"></span>
                                                    <div class="fullVideoInn">
                                                        <iframe src="" data="<?php echo $video_url; ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                                                    </div>
                                                </div>
                                                <!--fullVideo-->
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                            <?php

                                }
                            }
                            ?>
                        <?php
                            $count++;
                        endwhile;
                        ?>
                    </ul>

                </div><!-- flexslider -->
            </div>
        </div><!-- main-banner -->
<?php
    endif;
endif;
?>

<?php if ($GLOBALS['home-content-hide-flag']) : ?>
    <?php
    $home_banners_lalit_deliver = get_we_care_banners('lalit_loyalty_banner');
    // print_r($home_banners);
    ?>
    <?php
    if ($home_banners_lalit_deliver->have_posts()) :
        // print_r($home_banners_lalit_deliver);
    ?>
        <div class="container fluid-width section-space clearfix container-shadow">
            <div class="row clearfix">
                <h2 class="sec-title align-center page-title-home">Save & Earn With Loyalty</h2>
                <div id="loyalty-home-slider" class="flexslider loyalty-home-slider">
                    <ul class="slides">
                        <?php
                        $count = 0;
                        while ($home_banners_lalit_deliver->have_posts()) : $home_banners_lalit_deliver->the_post();
                            $heading = get_post_meta($post->ID, 'banner_heading', true);
                            $description = get_post_meta($post->ID, 'banner_description', true);
                            $url = trim(get_post_meta($post->ID, 'url', true));
                            //$button_text = get_post_meta($post->ID, 'button_text', true);
                            if (isMobile()) {
                                $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            } else {
                                $image_id = get_post_meta($post->ID, 'banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            }
                            $banner_type = get_post_meta($post->ID, 'banner_type', true);
                            $video_url = get_post_meta($post->ID, 'video_url', true);
                            $short_video = get_post_meta($post->ID, 'short_video', true);
                            wp_reset_postdata();
                        ?>
                            <?php
                            if ($banner_type == 0) {
                                if ($image != '') {
                            ?>
                                    <li class="">
                                        <?php if ($url && trim($url) != '') {
                                            echo '<a href="' . $url . '">';
                                        } ?>
                                        <?php
                                        if ($count == 0) {
                                        ?>
                                            <img src="<?php echo $image; ?>">
                                        <?php
                                        } else {
                                            // array_push($GLOBALS['banner_images'], $image);
                                        ?>
                                            <!-- <img src="" class="banner-images"> -->
                                            <img src="<?php echo $image; ?>">
                                        <?php
                                        }
                                        ?>

                                        <div class="banner-content">
                                            <?php
                                            if ($heading != '') {
                                            ?>
                                                <h1 class="main-title text-white text-shadow"><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if ($description != '') {
                                            ?>
                                                <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div><!-- banner-content -->
                                        <?php if ($url && trim($url) != '') {
                                            echo '</a>';
                                        } ?>
                                    </li>
                                <?php
                                }
                            } else {
                                if (($image != '' && trim($video_url) != '') || ($image != '' && wp_get_attachment_url($short_video) != '')) {
                                ?>
                                    <li class="first_banner">
                                        <div class="videoBannerWrap">
                                            <div class="bannerVideo">
                                                <?php
                                                if (trim($video_url) != '') {
                                                    $video_url = rtrim($video_url, '/');
                                                    $video_url .= '?rel=0&autoplay=1';

                                                    if ($heading != '') {
                                                        $class = "video-header";
                                                    } else {
                                                        $class = "";
                                                    }
                                                ?>
                                                    <a href="javascript:void(0)" class="video-thumb <?php echo $class; ?>">
                                                        <span class="video-play-btn"><i class="ico-sprite sprite ico-play-in-white"></i></span>
                                                    </a>
                                                <?php

                                                }
                                                ?>
                                                <img src="<?php echo $image; ?>" alt="<?php echo $heading; ?>">
                                                <?php

                                                /* if ($short_video && !(isIpad() || isMobile())) { */

                                                ?>
                                                    <div id="videoWrap">
                                                        <video id="videoElement2" <?php if (!isMobile() && !isIPad()) { ?>autoplay<?php } ?> preload="auto" autoplay muted playsinline loop class="videoElement">
                                                            <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/mp4">
                                                            <!-- <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/webm"> -->
                                                        </video>
                                                    </div><!-- videoWrap -->
                                                    <script>
                                                        var herovide2 = $('#videoElement2');
                                                        herovide2.autoplay = true;
                                                        herovide2.load();
                                                    </script>
                                                <?php
                                                /* } */

                                                if ($heading != '') {
                                                ?>
                                                    <div class="banner-content align-center video-banner-content">
                                                        <h1 class="main-title text-white text-shadow "><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            if ($video_url != '') {
                                            ?>
                                                <div class="fullVideo" style="display:none;">
                                                    <span class="closeVideo fancybox-close"></span>
                                                    <div class="fullVideoInn">
                                                        <iframe src="" data="<?php echo $video_url; ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                                                    </div>
                                                </div>
                                                <!--fullVideo-->
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </li>
                            <?php

                                }
                            }
                            ?>
                        <?php
                            $count++;
                        endwhile;
                        ?>
                    </ul>

                </div><!-- flexslider -->
            </div>
        </div><!-- main-banner -->
<?php
    endif;
endif;
?>


</div><!-- content-section -->