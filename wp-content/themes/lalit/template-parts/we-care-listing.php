<?php

$destination_obj = get_covid_data();
$we_care_object = array();
$we_care_type_ids = array();

$image_array = array();
$banner_image_array = array();

if ($destination_obj->have_posts()) :
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
        // print_r($post->ID);
        $we_care_object = get_post_meta($post->ID);
        // print_r($we_care_object); //got data here for all courses 
        if ($we_care_object) {
            $c = 0;
            if (get_post_status($post->ID) == 'publish') {
                $we_care_type_obj = get_the_terms($post->ID, 'we-care-type');
                // print_r($we_care_type_obj);
                if ($we_care_type_obj) {
                    foreach ($we_care_type_obj as $we_care_type) {
                        $term_id = $we_care_type->term_id;
                        $we_care_type_ids[] = $term_id;
                    }
                }
                $c++;
            }
        }
        wp_reset_postdata();
    endwhile;

endif;

$current_post = get_post();
// print_r($current_post);
$banner_images = get_post_meta($current_post->ID, "banner_images", true);
// print_r($banner_images);
$we_care_type_ids = array_unique($we_care_type_ids);
// print_r($we_care_type_ids);
$types = get_terms([
    'taxonomy' => 'we-care-type',
    'hide_empty' => false,
]);
// sort($types);
// print_r($types);

?>
<style type="text/css">
    .owl-item:before {
        position: absolute;
        bottom: 0;
        left: 0;
        content: "";
        z-index: 10;
        width: 100%;
        height: 100%;
        background: #f0f8ff00;
    }

    .owl-stage-outer {
        padding-top: 32px !important;
        padding-bottom: 70px !important;
    }

    @media (max-device-width: 767px) {
        .owl-stage-outer {
            padding-top: 12px !important;
            padding-bottom: 50px !important;
        }
    }

    /*** 

====================================================================
	Courses Section
====================================================================

***/
    .scrolling-wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        scrollbar-face-color: #367CD2;
        scrollbar-shadow-color: #FFFFFF;
        scrollbar-highlight-color: #FFFFFF;
        scrollbar-3dlight-color: #FFFFFF;
        scrollbar-darkshadow-color: #FFFFFF;
        scrollbar-track-color: #FFFFFF;
        scrollbar-arrow-color: #FFFFFF;
    }

    .scrolling-wrapper li {
        display: inline-block;
    }

    /*  .scrolling-wrapper::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    } */

    /*   .scrolling-wrapper::-webkit-scrollbar {
        width: 1px;
        background-color: #F5F5F5;
    } */

    .scrolling-wrapper::-webkit-scrollbar-thumb {
        background-color: #000000;
    }

    /* Let's get this party started */
    .scrolling-wrapper::-webkit-scrollbar {
        width: 6px;
    }

    /* Track */
    .scrolling-wrapper::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    /* Handle */
    .scrolling-wrapper::-webkit-scrollbar-thumb {
        -webkit-border-radius: 4px;
        border-radius: 4px;
        background: rgba(255, 0, 0, 0.8);
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
    }


    .courses-section {
        position: relative;
        padding-bottom: 40px;
    }

    .course-block {
        z-index: 1000;
        display: block;
        /* width: 295px; */
        position: relative;
        /* margin-bottom: 30px; */
    }

    .course-block .inner-box {
        position: relative;
        border-radius: 0px;
        padding: 0px 0px 0px;
        background-color: #ffffff;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        /* box-shadow: 0px 10px 10px rgb(144, 135, 135); */
        box-shadow: inset 0px 0px 2px 0px rgba(74, 74, 74, 0.20);
    }

    .course-block .inner-box:hover {
        /* box-shadow: 0px 10px 10px rgb(134, 97, 97); */
        box-shadow: 0px 10px 10px #8f8f8f;
    }

    /* .course-block .inner-box .image-owl {
		position: relative;
    background-color: #da2128;
    display: block;
	}

	.course-block .inner-box .image-owl img {
		position: relative;
		width: 100%;
		display: block;
		-webkit-transition: all 600ms ease;
		-moz-transition: all 600ms ease;
		-ms-transition: all 600ms ease;
		-o-transition: all 600ms ease;
		transition: all 600ms ease;
	} 

	.course-block .inner-box:hover .image-owl img {
		opacity: 0.5;
	}*/
    .course-block .inner-box .image-owl {
        /* min-height: 188px; */
    }

    .course-block .inner-box .image-owl .time {
        position: absolute;
        right: 17px;
        bottom: 130px;
        color: #0f0e2d;
        font-size: 12px;
        /* font-weight: 400; */
        padding: 5px 14px;
        border-radius: 50px;
        display: inline-block;
        background-color: #f5fbff;
        font-family: 'Roboto', sans-serif;
    }

    .course-block .inner-box .lower-content {
        position: relative;
        padding-top: 20px;
        min-height: 100px;
    }

    .course-block .inner-box .lower-content h6 {
        position: relative;
        font-weight: 500;
        font-size: 14px;
        min-height: 34px;
    }

    .course-block .inner-box .lower-content h6 a {
        position: relative;
        color: #0f0e2d;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }

    .course-block .inner-box .lower-content h6 a:hover {
        color: #da2128;
    }

    .course-block .inner-box .lower-content .post-meta {
        position: relative;
        margin-top: 7px;
        margin-bottom: 8px;
    }

    .course-block .inner-box .lower-content .post-meta li {
        position: relative;
        color: #71718a;
        font-size: 12px;
        font-weight: 500;
        line-height: 1.2em;
        padding-right: 12px;
        margin-right: 10px;
        display: inline-block;
        border-right: 1px solid #71718a;
    }

    .course-block .inner-box .lower-content .post-meta li:last-child {
        border-right: 0px;
        padding-right: 0px;
        margin-right: 0px;
    }

    .course-block .inner-box .lower-content .author {
        position: relative;
        color: #71718a;
        font-size: 12px;
        font-weight: 600;
    }

    .course-block .inner-box .lower-content .author span {
        position: relative;
        color: #da2128;
    }

    .course-block .inner-box .lower-content .price {
        position: relative;
        color: #0f0e2d;
        font-size: 14px;
        font-weight: 700;
        font-family: 'Roboto', sans-serif;
    }

    /* Video Box */

    .video-box {
        position: relative;
        overflow: hidden;
        border-radius: 3px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
    }

    .video-box .video-image {
        position: relative;
        margin: 0px;
    }

    .video-box .video-image img {
        position: relative;
        width: 100%;
        z-index: 3;
    }

    .video-box .overlay-box {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        text-align: center;
        overflow: hidden;
        line-height: 45px;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }

    .video-box .overlay-box:before {
        position: absolute;
        content: '';
        left: 0px;
        top: 0px;
        right: 0px;
        bottom: 0px;
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.02);
    }

    .video-box .overlay-box span {
        position: absolute;
        width: 80px;
        height: 80px;
        left: 50%;
        top: 50%;
        z-index: 10;
        color: #ffffff;
        font-weight: 400;
        font-size: 20px;
        text-align: center;
        border-radius: 50%;
        padding-left: 4px;
        display: inline-block;
        margin-top: -40px;
        margin-left: -40px;
        line-height: 80px;
        transition: all 900ms ease;
        -moz-transition: all 900ms ease;
        -webkit-transition: all 900ms ease;
        -ms-transition: all 900ms ease;
        -o-transition: all 900ms ease;
        background-color: #da2128;
    }

    .video-box .ripple,
    .video-box .ripple:before,
    .video-box .ripple:after {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80px;
        height: 80px;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 0 0 rgba(255, 87, 115, .6);
        -moz-box-shadow: 0 0 0 0 rgba(255, 87, 115, .6);
        -ms-box-shadow: 0 0 0 0 rgba(255, 87, 115, .6);
        -o-box-shadow: 0 0 0 0 rgba(255, 87, 115, .6);
        box-shadow: 0 0 0 0 rgba(255, 87, 115, .6);
        -webkit-animation: ripple 3s infinite;
        -moz-animation: ripple 3s infinite;
        -ms-animation: ripple 3s infinite;
        -o-animation: ripple 3s infinite;
        animation: ripple 3s infinite;
    }

    .video-box .ripple:before {
        -webkit-animation-delay: .9s;
        -moz-animation-delay: .9s;
        -ms-animation-delay: .9s;
        -o-animation-delay: .9s;
        animation-delay: .9s;
        content: "";
        position: absolute;
    }

    .video-box .ripple:after {
        -webkit-animation-delay: .6s;
        -moz-animation-delay: .6s;
        -ms-animation-delay: .6s;
        -o-animation-delay: .6s;
        animation-delay: .6s;
        content: "";
        position: absolute;
    }

    .video-info-boxed {
        position: relative;
        padding-top: 25px;
        margin-bottom: 25px;
    }

    .video-info-boxed h6 {
        position: relative;
        color: #0f0e2d;
        font-weight: 500;
        line-height: 1.3em;
        margin-bottom: 10px;
    }

    .video-info-boxed .author {
        position: relative;
        color: #71718a;
        font-size: 14px;
        font-weight: 600;
        padding-top: 2px;
        padding-left: 35px;
        display: inline-block;
    }

    .video-info-boxed .author .user-image {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 26px;
        height: 26px;
        overflow: hidden;
        display: inline-block;
        border-radius: 50px;
        border: 2px solid #ffffff;
    }

    .video-info-boxed .follow {
        position: relative;
        margin-left: 16px;
        top: 1px;
        display: inline-block;
    }

    .video-info-boxed .follow a {
        position: relative;
        color: #0e7bfe;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }

    .video-info-boxed .follow a:hover {
        color: #da2128;
    }

    .video-info-boxed .social-box {
        position: relative;
    }

    .video-info-boxed .social-box .share {
        position: relative;
        color: #71718a;
        font-size: 14px;
        font-weight: 600;
        display: block;
        margin-bottom: 10px;
    }

    .video-info-boxed .social-box li {
        position: relative;
        margin: 0px 4px;
        display: inline-block;
    }

    .video-info-boxed .social-box li a {
        position: relative;
        width: 30px;
        height: 30px;
        color: #3b5998;
        font-size: 13px;
        text-align: center;
        line-height: 30px;
        border-radius: 5px;
        background-color: #eff4ff;
    }

    .video-info-boxed .social-box li.google a {
        background-color: #ffeded;
        color: #db3236;
    }

    .video-info-boxed .social-box li.twitter a {
        background-color: #ecfaff;
        color: #00acee;
    }


    /*** 

====================================================================
	Category Page Section
====================================================================

***/

    .category-page-container {
        position: relative;
        /* padding: 0px 0px 0px; */
    }

    .category-page-container.style-two {
        padding-bottom: 0px;
    }

    .category-page-container .owl-dots {
        display: none;
    }

    .category-page-container .owl-nav {
        position: absolute;
        right: 0px;
        top: -45px;
    }

    .category-page-container .owl-nav .owl-prev,
    .category-page-container .owl-nav .owl-next {
        position: initial;
        margin-top: 0px;
        width: 25px;
        height: 18px;
        color: #929292;
        font-size: 10px;
        line-height: 15px;
        text-align: center;
        margin-left: 6px;
        display: inline-block;
        border: 2px solid #9a6e2485;
        padding: 17px;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }

    .category-page-container .owl-nav .owl-prev:hover,
    .category-page-container .owl-nav .owl-next:hover {
        color: #ffffff;
        border-color: #a7731bdb;
        /* background-color: #da2128; */
    }

    .theme-btn {
        display: inline-block;
        transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
    }

    .btn-style-two {
        position: relative;
        display: inline-block;
        font-size: 14px;
        line-height: 30px;
        color: #ff5773;
        padding: 6px 40px;
        font-weight: 400;
        overflow: hidden;
        border-radius: 50px;
        overflow: hidden;
        text-transform: capitalize;
        border: 1px solid #da2128;
    }

    .btn-style-one {
        position: relative;
        display: inline-block;
        font-size: 14px;
        line-height: 30px;
        color: #ffffff;
        padding: 7px 40px;
        font-weight: 400;
        overflow: hidden;
        border-radius: 50px;
        overflow: hidden;
        text-transform: capitalize;
        background-color: #da2128;
        box-shadow: 0px 10px 15px rgba(255, 87, 115, 0.10);
    }

    .btn-style-two-sm {
        font-size: 12px;
        line-height: 15px;
        color: #ff5773;
        padding: 6px 30px;
    }

    .btn-style-two-xs {
        font-size: 12px;
        line-height: 15px;
        color: #ff5773;
        padding: 6px 13px;
    }

    .btn-style-one-sm {
        font-size: 14px;
        line-height: 15px;
        padding: 7px 30px;
    }

    .btn-style-one-xs {
        font-size: 14px;
        line-height: 15px;
        padding: 7px 13px;
    }

    .listing-item-btn .active a {
        background: #db2128;
    }

    .course-detail-section .upper-content .right-column .buttons-box {
        position: relative;
        font-size: 14px;
        color: #777777;
        line-height: 1.7em;
        font-weight: 400;
        margin-top: 20px;
    }

    .course-detail-section .upper-content .right-column .buttons-box .theme-btn {
        position: relative;
        width: 100%;
        text-align: center;
        margin-right: 20px;
        max-width: 170px;
        margin-bottom: 10px;
    }

    .review-widget .buttons-box .theme-btn {
        width: 100%;
        margin-bottom: 10px;
    }

    .course-detail-section .lower-content {
        position: relative;
        margin-top: 1px;
        padding: 15px 15px;
    }

    .mb-40 {
        margin-bottom: 40px !important;
    }

    @media (max-device-width: 767px) {

        /*     .owl-carousel .owl-nav .owl-prev,
        .owl-carousel .owl-nav .owl-next {
            display: none !important;
        }
 */
        .zero-padding {
            padding: 0 !important;
        }

        .card-item {
            height: auto !important;
            margin-bottom: 20px !important;
        }

        .mb-40 {
            margin-bottom: 0px !important;
        }

        .category-page-container .owl-nav {
            position: initial;
            right: auto;
            top: auto;
        }

        .category-page-container .owl-nav .owl-prev,
        .category-page-container .owl-nav .owl-next {
            text-decoration: none;
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 18%;
            z-index: 2;
            overflow: hidden;
            border: none;
        }
    }

    .card-info {
        cursor: initial !important;
    }
</style>
<div class="content-section">
    <?php
    $home_banners = get_page_banners_by_taxomany('we_care_list_banner');
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

                                            if ($short_video && !(isIpad() || isMobile())) {

                                            ?>
                                                <div id="videoWrap">
                                                    <video id="videoElement" <?php if (!isMobile() && !isIPad()) { ?>autoplay<?php } ?> loop preload muted>
                                                        <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/mp4">
                                                        <source src="<?php echo wp_get_attachment_url($short_video); ?>" type="video/webm">
                                                    </video>
                                                </div><!-- videoWrap -->
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

    <?php
    // $banner_images = get_post_meta($current_post->ID, "banner_images");
    $we_care_title = get_post_field('post_title', $current_post->ID);
    $we_care_description = wpautop(get_post_field('post_content', $current_post->ID));

    if ($we_care_title && $we_care_description) {
    ?>
        <div class="container js_fade">
            <div class=" page-con">
                <div class="container js_fade section-space">
                    <div class="row">
                        <div class="page-heading">
                            <h2 class="card-info-title bdr-bottom ">
                                <span class="bdr-bottom-gold"><?php echo $we_care_title; ?>
                                </span>
                            </h2>
                        </div>
                        <?php echo $we_care_description; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>


    <div class="room-training_course-listing">
        <?php
        /* if ($heading_types && count($heading_types) > 1) {
        ?>
            <div class="container  scroll-container scroll-to js_fade">
                <div class="row">
                    <ul class="smooth-scroll unstyled-listing scrolling-wrapper">
                        <?php
                        foreach ($types as $heading_type) {
                            $name = $heading_type->name;
                            $term_id = $heading_type->term_id;
                        ?>
                            <li class="nav-item"><a href="#<?php echo $term_id; ?>" class=""><?php echo $name; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        <?php
        } */
        ?>


        <!-- <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"> -->
        <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
        <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>



        <?php
        foreach ($types as $type) {
            $name = $type->name;
            $term_id = $type->term_id;
            $slug = $type->slug;
            $parent = $type->parent;

            $banner_type = get_the_terms($term_id, 'banner_type');
            $banner_type = get_field('banner_type', $type);

            if (in_array($term_id, $we_care_type_ids) && $parent == 0) {
        ?>
                <div class="category-page-container container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 zero-padding">
                            <!-- Sec Title -->
                            <div class="sec-title js_fade drinks-sec training_course-listing-section mb-40" id="<?php echo $term_id; ?>">
                                <h2 class="page-title align-center" style="font-size:1em;"><?php echo ucfirst($name); ?></h4>
                            </div>
                            <div class="row">
                                <?php if ($banner_type == 'Slider' || $banner_type == '') { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 zero-padding">
                                        <div class="three-item-carousel owl-carousel owl-theme">
                                            <?php
                                            if ($destination_obj->have_posts()) :
                                                while ($destination_obj->have_posts()) : $destination_obj->the_post();
                                                    $count = 1;
                                                    $we_care_id = $post->ID;
                                                    if (get_post_status($post->ID) == 'publish') {
                                                        $we_care_type_term_id = '';
                                                        $we_care_type_obj = get_the_terms($post->ID, 'we-care-type');
                                                        if ($we_care_type_obj) {
                                                            foreach ($we_care_type_obj as $we_care_type) {
                                                                if ($we_care_type->parent == 0 && $we_care_type->term_id == $term_id) {
                                                                    $we_care_type_term_id = $we_care_type->term_id;
                                                                }
                                                            }
                                                        }
                                                        if ($we_care_type_term_id == $term_id) {
                                                            $we_care_name = get_post_meta($we_care_id, "sub_title", true);
                                                            $we_care_main_banner_id = get_post_meta($we_care_id, "main_banner_image", true);

                                                            $we_care_main_banner = wp_get_attachment_url($we_care_main_banner_id);
                                                            // print_r($we_care_main_banner);

                                                            $we_care_permalink = get_permalink($we_care_id);
                                                            $we_care_description = get_post_meta($we_care_id, "description", true);
                                                            $we_care_url = get_post_meta($we_care_id, "url", true);
                                                            if ($we_care_url != '') {
                                                                $we_care_permalink = $we_care_url;
                                                            }

                                                            $we_care_images = get_post_meta($we_care_id, "images", true);
                                                            $we_care_images = explode(',', $we_care_images);
                                                            $types = '';
                                                            if ($we_care_type_obj) {
                                                                foreach ($we_care_type_obj as $type_id) {
                                                                    if ($type_id->parent != 0) {
                                                                        $types .= $type_id->name . ', ';
                                                                    }
                                                                }
                                                            }

                                                            $types = rtrim($types, ', ');
                                            ?>
                                                            <div class="item align-center mt10" <?php if ($we_care_main_banner == '') { ?> style="background-color: #da2128; color: #fff; border-radius:50px;" <?php } ?>>
                                                                <?php if ($we_care_main_banner != '') { ?>
                                                                    <div class="course-block col col12">
                                                                        <div class="inner-box">
                                                                            <?php if ($we_care_main_banner != '') { ?>
                                                                                <div class="image-owl">
                                                                                    <a href="<?php echo $we_care_permalink; ?>">
                                                                                        <?php if ($we_care_main_banner != '') { ?>
                                                                                            <img src="<?php echo $we_care_main_banner; ?>" alt="<?php echo $we_care_name; ?>">
                                                                                        <?php } ?>
                                                                                    </a>
                                                                                </div>
                                                                            <?php }
                                                                            if ($we_care_name != ''  || $we_care_description != '') { ?>
                                                                                <div class="lower-content">
                                                                                    <?php if ($we_care_name != '') { ?>
                                                                                        <h6><a href="<?php echo $we_care_permalink; ?>"><?php echo $we_care_name; ?></a></h6>
                                                                                    <?php } ?>
                                                                                    <?php if ($we_care_description != '') { ?>
                                                                                        <div style="padding-bottom:12px; height: 100px;">
                                                                                            <?php echo wpautop($we_care_description); ?>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php if ($we_care_main_banner == '') { ?>
                                                                    <div class="row">
                                                                        <div class="col col12 h-product ">
                                                                            <div style="padding: 20px; font-size: 14px; color: #ffffff;"><?php echo $we_care_name; ?></a></strong></div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                            <?php
                                                            $count++;
                                                        }
                                                    }
                                                // }
                                                // }
                                                endwhile;
                                            endif;
                                            ?>
                                        </div><!-- col -->
                                    </div><!-- row -->
                                <?php
                                } else if ($banner_type == 'Grid') {
                                ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 zero-padding">
                                        <?php
                                        if ($destination_obj->have_posts()) :
                                            while ($destination_obj->have_posts()) : $destination_obj->the_post();
                                                $count = 1;
                                                $we_care_id = $post->ID;
                                                if (get_post_status($post->ID) == 'publish') {
                                                    $we_care_type_term_id = '';
                                                    $we_care_type_obj = get_the_terms($post->ID, 'we-care-type');
                                                    if ($we_care_type_obj) {
                                                        foreach ($we_care_type_obj as $we_care_type) {
                                                            if ($we_care_type->parent == 0 && $we_care_type->term_id == $term_id) {
                                                                $we_care_type_term_id = $we_care_type->term_id;
                                                            }
                                                        }
                                                    }
                                                    if ($we_care_type_term_id == $term_id) {
                                                        $we_care_name = get_post_meta($we_care_id, "sub_title", true);
                                                        $we_care_main_banner_id = get_post_meta($we_care_id, "main_banner_image", true);

                                                        $we_care_main_banner = wp_get_attachment_url($we_care_main_banner_id);
                                                        // print_r($we_care_main_banner);

                                                        $we_care_permalink = get_permalink($we_care_id);
                                                        $we_care_description = get_post_meta($we_care_id, "description", true);
                                                        $we_care_url = get_post_meta($we_care_id, "url", true);
                                                        if ($we_care_url != '') {
                                                            $we_care_permalink = $we_care_url;
                                                        } else {
                                                            $we_care_permalink = '#';
                                                        }
                                                        $we_care_images = get_post_meta($we_care_id, "images", true);
                                                        $we_care_images = explode(',', $we_care_images);
                                                        $types = '';
                                                        if ($we_care_type_obj) {
                                                            foreach ($we_care_type_obj as $type_id) {
                                                                if ($type_id->parent != 0) {
                                                                    $types .= $type_id->name . ', ';
                                                                }
                                                            }
                                                        }

                                                        $types = rtrim($types, ', ');
                                                        // print_r($we_care_images);

                                        ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 zero-padding">
                                                            <div class="card-item js_fade mt101" style="opacity: 1;">
                                                                <?php if (count($we_care_images) > 0) {
                                                                ?>
                                                                    <div id="slider" class="flexslider slider">
                                                                        <ul class="slides unstyled-listing">
                                                                            <!-- <?php if ($image) { ?>
                                                                                <li class="photoMaskVer">
                                                                                    <img src="<?php echo $image; ?>" class="image" alt="<?php echo $image; ?>" title="<?php echo $dining_name; ?>" />
                                                                                </li>
                                                                            <?php } ?> -->
                                                                            <?php
                                                                            foreach ($we_care_images as $dining_image_id) {
                                                                                $dining_image = wp_get_attachment_image_src($dining_image_id, 'box_image')[0];
                                                                                array_push($image_array, $dining_image);
                                                                                // print_r($we_care_images);
                                                                            ?>
                                                                                <li class="photoMaskVer">
                                                                                    <img src="<?php echo $dining_image; ?>" class="image" alt="<?php echo $dining_name; ?>" title="<?php echo $dining_name; ?>" />
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div><!-- slider -->
                                                                <?php
                                                                }
                                                                ?>
                                                                <!--  <img data-src="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="" class="des-images js_image_load image-tag u-photo" /> -->
                                                                <div class="card-info h-product vcard">
                                                                    <div class="row">
                                                                        <?php
                                                                        if ($we_care_name != ''  || $we_care_description != '') { ?>
                                                                            <div class="lower-content">
                                                                                <?php if ($we_care_name != '') { ?>
                                                                                    <h6><a href="<?php echo $we_care_permalink; ?>"><?php echo $we_care_name; ?></a></h6>
                                                                                <?php } ?>
                                                                                <?php if ($we_care_description != '') { ?>
                                                                                    <div style="padding-bottom:12px; height: 100px;">
                                                                                        <?php echo wpautop($we_care_description); ?>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <?php
                                                        $count++;
                                                    }
                                                }
                                            // }
                                            // }
                                            endwhile;
                                        endif;
                                        ?>
                                    <?php } else if ($banner_type == 'Video') {
                                    ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 zero-padding">
                                            <?php
                                            if ($destination_obj->have_posts()) :
                                                while ($destination_obj->have_posts()) : $destination_obj->the_post();
                                                    $count = 1;
                                                    $we_care_id = $post->ID;
                                                    if (get_post_status($post->ID) == 'publish') {
                                                        $we_care_type_term_id = '';
                                                        $we_care_type_obj = get_the_terms($post->ID, 'we-care-type');
                                                        if ($we_care_type_obj) {
                                                            foreach ($we_care_type_obj as $we_care_type) {
                                                                if ($we_care_type->parent == 0 && $we_care_type->term_id == $term_id) {
                                                                    $we_care_type_term_id = $we_care_type->term_id;
                                                                }
                                                            }
                                                        }
                                                        if ($we_care_type_term_id == $term_id) {
                                                            $we_care_name = get_post_meta($we_care_id, "sub_title", true);
                                                            $we_care_main_banner_id = get_post_meta($we_care_id, "main_banner_image", true);

                                                            $we_care_video = get_post_meta($we_care_id, "video", true);

                                                            $we_care_main_banner = wp_get_attachment_url($we_care_main_banner_id);
                                                            // print_r($we_care_main_banner);

                                                            $we_care_permalink = get_permalink($we_care_id);
                                                            $we_care_description = get_post_meta($we_care_id, "description", true);
                                                            if ($we_care_url != '') {
                                                                $we_care_permalink = $we_care_url;
                                                            } else {
                                                                $we_care_permalink = '#';
                                                            }

                                                            $we_care_images = get_post_meta($we_care_id, "images", true);
                                                            $we_care_images = explode(',', $we_care_images);
                                                            $types = '';
                                                            if ($we_care_type_obj) {
                                                                foreach ($we_care_type_obj as $type_id) {
                                                                    if ($type_id->parent != 0) {
                                                                        $types .= $type_id->name . ', ';
                                                                    }
                                                                }
                                                            }
                                                            $types = rtrim($types, ', ');
                                            ?>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 zero-padding">
                                                                <div class="card-item js_fade mt101" style="opacity: 1;">
                                                                    <div class="row room-types">
                                                                        <div><iframe src="<?php echo $we_care_video; ?>" width="100%" height="300" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                                                                    </div>
                                                                    <?php if ($we_care_name != '' || $we_care_description != '') { ?>
                                                                        <div class="card-info h-product vcard">
                                                                            <div class="row">
                                                                                <div class="lower-content">
                                                                                    <?php if ($we_care_name != '') { ?>
                                                                                        <h6><a href="<?php echo $we_care_permalink; ?>"><?php echo $we_care_name; ?></a></h6>
                                                                                    <?php } ?>
                                                                                    <?php if ($we_care_description != '') { ?>
                                                                                        <div style="padding-bottom:12px;">
                                                                                            <?php echo wpautop($we_care_description); ?>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                            <?php
                                                            $count++;
                                                        }
                                                    }
                                                // }
                                                // }
                                                endwhile;
                                            endif;
                                            ?>
                                        </div>
                                    <?php  }
                                    ?>
                                    </div><!-- item-listing -->
                            </div>
                        </div>
                    </div><!-- container -->
                </div>

        <?php
            }
        }
        ?>

        <style type="text/css">
            .card-item {
                -webkit-box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
                -moz-box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
                box-shadow: 0 0 5px 0 rgba(0, 0, 0, .2);
                min-height: 300px;
                margin-bottom: 55px;
                background: #fff;
                height: auto;
            }
            }
        </style>


    </div><!-- content-section -->
</div>
<script>
    if ($('.three-item-carousel').length) {
        $('.three-item-carousel').owlCarousel({
            loop: false,
            margin: 30,
            nav: true,
            smartSpeed: 500,
            // autoplay: 6000,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 2
                },
                1200: {
                    items: 2
                },
                1500: {
                    items: 2
                }
            }
        });
    }
</script>

<?php
$GLOBALS['image_array'] = $image_array;
$GLOBALS['banner_image_array'] = $banner_image_array;
?>