<?php
$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);

$city_name = $GLOBALS['location'][0]->slug;
$city = $GLOBALS['location'][0]->name;
if ($GLOBALS['location'][0]->slug == 'london') {
    $country = 'UK';
} else {
    $country = 'India';
}

$hotel_id = '';
if ($destination_obj->have_posts()) :
    while ($destination_obj->have_posts()) : $destination_obj->the_post();

        $hotel_id = $post->ID;

        $GLOBALS['address'] = get_post_meta($hotel_id, "address", true);
        $GLOBALS['email'] = get_post_meta($hotel_id, "email", true);
        $GLOBALS['phone'] = get_post_meta($hotel_id, "phone", true);
        $GLOBALS['fax'] = get_post_meta($hotel_id, "fax", true);
        $GLOBALS['review_widget'] = get_post_meta($hotel_id, "review_widget", true);

        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

    endwhile;
endif;

$banner_images = get_post_meta($hotel_id, "banner_images", true);
$hotel_image_id = get_post_meta($hotel_id, "property_image", true);
$GLOBALS['hotel_image'] = wp_get_attachment_image_src($hotel_image_id, 'thumbnail')[0];
$GLOBALS['hotel_name'] = get_post_meta($hotel_id, "name", true);


$GLOBALS['banner_images'] = array();
$GLOBALS['hotel_service_image'] = array();
?>

<div class="content-section">

    <?php

    if ($banner_images) {
        $banner_ids = array();
        foreach ($banner_images as $banner_image_id) {
            $banner_ids[] = $banner_image_id;
        }

        //$images_videos = get_banner_by_taxonomy($banner_ids, 'property_overview');
        $images_videos = get_page_overview_banners($banner_ids);

        if ($images_videos->have_posts()) :
    ?>
            <div class="main-banner align-center overview-banner banner-slider view-port-detect">
                <input type="hidden" class="city" value="<?php echo ucwords($city); ?>" />
                <input type="hidden" class="country" value="<?php echo $country; ?>" />
                <div id="banner-slider" class="flexslider">
                    <ul class="slides">
                        <?php
                        $count = 0;
                        while ($images_videos->have_posts()) : $images_videos->the_post();
                            $banner_type = get_post_meta($post->ID, 'banner_type', true);
                            $exclude_temperature = get_post_meta($post->ID, 'exclude_temperature', true);
                            $url = trim(get_post_meta($post->ID, 'url', true));
                            if (isMobile()) {
                                $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            } else {
                                $image_id = get_post_meta($post->ID, 'banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            }

                            $heading = get_post_meta($post->ID, 'banner_heading', true);
                            $description = get_post_meta($post->ID, 'banner_description', true);
                        ?>
                            <?php
                            if ($banner_type == 0) {

                                if ($image != '') {
                            ?>
                                    <li>
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

                                        if (!$exclude_temperature) {
                                        ?>
                                            <div class="temp-wrap">
                                                <div id="wxWrap" class="wxWrap text-shadow">
                                                    <a class="yahoo" target="_blank">
                                                        <span id="wxTemp" class="wxTemp"></span><!-- #wxTemp -->
                                                        <span id="wxIcon2" class="wxIcon2"></span>
                                                        <span id="wxIntro" class="wxIntro"></span><!-- #wxIntro -->
                                                    </a><!-- #wxIcon2 -->
                                                </div><!-- #wxWrap -->
                                            </div><!-- temp-wrap -->
                                        <?php
                                        }

                                        if ($url && trim($url) != '') {
                                            echo '<a href="' . $url . '">';
                                        }
                                        ?>
                                        <div class="banner-content align-center">
                                            <?php
                                            if ($heading != '') {
                                            ?>
                                                <h1 class="main-title text-white text-shadow "><span class="pos-rel"><?php echo $heading; ?><i class="back-shadow"></i></span></h1>
                                            <?php
                                            }
                                            if ($description != '') {
                                            ?>
                                                <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ($url && trim($url) != '') {
                                            echo '</a>';
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                            } else {
                                $video_url = get_post_meta($post->ID, 'video_url', true);
                                $short_video = get_post_meta($post->ID, 'short_video', true);
                                if (($image != '' && trim($video_url) != '') || ($image != '' && wp_get_attachment_url($short_video) != '')) {
                                ?>
                                    <li>
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

                                                if (!$exclude_temperature) {
                                                ?>
                                                    <div class="temp-wrap">
                                                        <div id="wxWrap" class="wxWrap text-shadow">
                                                            <a class="yahoo" target="_blank">
                                                                <span id="wxTemp" class="wxTemp"></span><!-- #wxTemp -->
                                                                <span id="wxIcon2" class="wxIcon2"></span>
                                                                <span id="wxIntro" class="wxIntro"></span><!-- #wxIntro -->
                                                            </a><!-- #wxIcon2 -->
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
                            $count++;
                        endwhile;
                        ?>
                    </ul>
                </div> <!-- slider -->
            </div>
    <?php
        endif;
    }
    ?>
    <!--  Banners -->


    <!-- booking widget -->
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
    <!-- booking widget -->

    <!-- Hotel additional information -->
    <?php
    $hotel_sub_heading = get_post_meta($hotel_id, "hotel_sub_heading", true);
    $short_description = wpautop(get_post_meta($hotel_id, "short_description", true));
    ?>
    <div class="container section-space intro-text align-center">
        <!-- seperator-->
        <div class="row">
            <span class="seperator"></span>
            <?php
            if ($hotel_sub_heading != '') {
            ?>
                <h2 class="sec-title"><?php echo $hotel_sub_heading; ?></h2>
            <?php
            }
            if ($short_description != '') {
            ?>
                <div class="col col10 align-content-center "><?php echo $short_description; ?></div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Hotel additional information -->

    <!-- Awards -->
    <?php
    $award_obj = get_post_meta($hotel_id, "hotel_awards", true);
    if ($award_obj) {
    ?>
        <div class="container js_fade view-port-detect">
            <div class="row align-center awardsSlider">
                <ul class="reward-list slides">
                    <?php
                    $award_count = 0;
                    foreach ($award_obj as $award_id) {
                        if (get_post_status($award_id) == 'publish') {
                            $award_name = get_post_meta($award_id, "name", true);
                            $award_body = get_the_terms($award_id, 'award-body');
                            $awarded_to = get_post_meta($award_id, 'awarded_to', true);

                            $award_logo = '';

                            $term_id = $award_body[0]->term_id;
                            $meta_data = get_term_meta($term_id);
                            foreach ($meta_data as $data) {
                                $award_logo = $data[0];
                            }

                            if ($award_logo || $award_name) {
                    ?>
                                <li class="span span3">
                                    <div class="reward-item">
                                        <?php
                                        if ($award_logo) {
                                        ?>
                                            <div class="reward-logo">
                                                <img src="" class="image js_image_load image-tag" alt="<?php echo $award_name; ?>" title="<?php echo $award_name; ?>" data-src="<?php echo $award_logo; ?>" />
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="reward-meta">
                                            <?php
                                            if ($awarded_to) {
                                            ?>
                                                <strong><?php echo $awarded_to; ?></strong>
                                            <?php
                                            }
                                            if ($award_name) {
                                            ?>
                                                <span><?php echo $award_name; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </li>
                    <?php
                                $award_count++;
                            }

                            /*if($award_count == 4)
                                {
                                    break;
                                }*/
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Awards -->


    <!-- At a Glance (At the Hotel) -->
    <?php
    $at_the_hotel_obj = get_post_meta($hotel_id, "at_the_hotel", true);

    if ($at_the_hotel_obj) {
        $slider_controls = array();
    ?>
        <div class="container fluid-width section-space js_fade view-port-detect">
            <div class="row">
                <h2 class="sec-title align-center">At a Glance</h2>
                <div class="thumb-slider main-banner background-color">
                    <div id="thumb-slider" class="flexslider">
                        <ul class="slides">
                            <?php
                            $at_count = 0;
                            foreach ($at_the_hotel_obj as $at_the_hotel_id) {
                                if (get_post_status($at_the_hotel_id) == 'publish') {
                                    $name = get_post_meta($at_the_hotel_id, "name", true);
                                    $image_id = get_post_meta($at_the_hotel_id, "image", true);
                                    if (isMobile()) {
                                        $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                                    } else {
                                        $image = wp_get_attachment_url($image_id);
                                    }
                                    $image_caption = get_post_meta($at_the_hotel_id, "image_caption", true);
                                    $slider_controls[$at_count]['name'] = $name;
                                    $slider_controls[$at_count]['image'] = wp_get_attachment_image_src($image_id, 'thumbnail', true)[0];

                                    if (isMobile()) {
                            ?>
                                        <li class="large-banner-sec" style="background-image:url('<?php echo $image; ?>');">
                                        <?php
                                    } else {
                                        ?>
                                        <li class="background-color">
                                            <img src="" class="image js_image_load image-tag" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" data-src="<?php echo $image; ?>" />
                                        <?php
                                    }
                                        ?>
                                        <div class="banner-content align-center">
                                            <?php
                                            if ($image_caption != '') {
                                            ?>
                                                <p class="banner-intro-text text-shadow text-white hide-show"><?php echo $image_caption; ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        </li>
                                <?php
                                    $at_count++;
                                }
                            }
                                ?>
                        </ul>

                        <div class="flexslider-controls">
                            <ul class="flex-control-nav">
                                <?php
                                $c = 0;
                                foreach ($slider_controls as $controls) {
                                    $class = '';
                                    if ($c == 0) {
                                        $class = 'flex-active';
                                    }

                                ?>
                                    <li class="<?php echo $class; ?>">
                                        <span class="thumbimg">
                                            <img src="" class="image js_image_load image-tag" alt="<?php echo $controls['name']; ?>" title="<?php echo $controls['name']; ?>" data-src="<?php echo $controls['image']; ?>" />
                                        </span>
                                        <span class="text-shadow"><?php echo $controls['name']; ?></span>
                                    </li>
                                <?php
                                    $c++;
                                }
                                ?>
                            </ul>
                        </div><!-- flexslider-controls -->
                    </div><!-- slider -->
                </div><!-- slider-banner -->
            </div>
        </div>
    <?php
    }
    ?>
    <!-- At a Glance (At the Hotel) -->


    <div class="container js_fade smooth-scroll">
        <div class="row">
            <div class="bottom-scroll">
                <a href="#suits-rooms">More about the hotel
                    <i class="ico-sprite sprite size-18 ico-blk-down-arrow"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Suite and Room Image -->
    <?php
    if ($hotel_additional_information) {
        foreach ($hotel_additional_information as $id) {
            $room_image_id = get_post_meta($id, 'room_image', true);
            $room_image = wp_get_attachment_url($room_image_id);
            $suite_image_id = get_post_meta($id, 'suite_image', true);
            $suite_image = wp_get_attachment_url($suite_image_id);
        }
    }

    if ($room_image != '' || $suite_image != '') {
    ?>
        <div class="container suits-rooms js_fade view-port-detect" id="suits-rooms">
            <div class="row room-types">
                <?php
                if ($city_name == 'bekal' || $city_name == 'goa') {
                    $room_image='';
                }
                if ($suite_image != '') {
                    $class = '';
                    if ($room_image == '') {
                        $class = "align-content-center";
                    }
                ?>
                    <div class="col col6 h-product <?php echo $class; ?>">
                        <a href="/the-lalit-<?php echo $city_name; ?>/suites-and-rooms?type=lalit_suites" class="item-blk item-head-large u-url photoMaskHor background-color">
                            <div style="" title="Suites" class="bg-image js_image_load background" data-src="background: url('<?php echo $suite_image; ?>') no-repeat center center; background-size: cover; width: 100%; height: 100%;" data-url="<?php echo $suite_image; ?>"></div>
                            <h4 class="item-head p-name">Suites</h4>
                        </a>
                    </div>
                <?php
                }
                if ($room_image != '') {
                    $class = '';
                    if ($suite_image == '') {
                        $class = "align-content-center";
                    }
                ?>
                    <div class="col col6 h-product <?php echo $class; ?>">
                        <a href="/the-lalit-<?php echo $city_name; ?>/suites-and-rooms?type=rooms" class="item-blk item-head-large u-url photoMaskHor background-color">
                            <div style="" title="Rooms" class="bg-image js_image_load background" data-src="background: url('<?php echo $room_image; ?>') no-repeat center center; background-size: cover; width: 100%; height: 100%;" data-url="<?php echo $room_image; ?>"></div>
                            <h4 class="item-head p-name">Rooms</h4>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Suite and Room Image -->


    <!-- Hotel Attractions -->
    <?php
    $hotel_attraction_obj = get_post_meta($hotel_id, "hotel_special_services", true);
    if ($hotel_attraction_obj) {
    ?>
        <div class="container section-space js_fade hotel-attractions">
            <div class="row">
                <h2 class="sec-title align-center">Hotel Attractions</h2>
            </div>
        </div>
        <?php
        $at_count = 1;
        foreach ($hotel_attraction_obj as $hotel_attraction_id) {
            if (get_post_status($hotel_attraction_id) == 'publish') {
                $name = get_post_meta($hotel_attraction_id, "name", true);
                $description = wpautop(get_post_meta($hotel_attraction_id, "description", true));
                $image_id = get_post_meta($hotel_attraction_id, "image", true);
                $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];

                if (isMobile()) {
        ?>
                    <div class="container table-container js_fade section-space view-port-detect">
                        <div class="row table-sec vcard">
                            <div class="col col8 tablecell">
                                <div class="tablecell-image background-color">
                                    <img src="" class="image js_image_load image-tag u-photo" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" data-src="<?php echo $image; ?>" />
                                </div>
                            </div>
                            <div class="col col4 tablecell">
                                <?php
                                if ($name != '') {
                                ?>
                                    <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                                <?php
                                }
                                if ($description != '') {
                                ?>
                                    <p><?php echo $description; ?></p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- container -->
                    <?php
                } else {
                    if ($at_count % 2 != 0) {
                    ?>
                        <div class="container table-container js_fade section-space view-port-detect">
                            <div class="row table-sec vcard">
                                <div class="col col8 tablecell">
                                    <div class="tablecell-image background-color">
                                        <img src="" class="image js_image_load image-tag u-photo" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" data-src="<?php echo $image; ?>" />
                                    </div>
                                </div>
                                <div class="col col4 tablecell table-right-content">
                                    <?php
                                    if ($name != '') {
                                    ?>
                                        <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                                    <?php
                                    }
                                    if ($description != '') {
                                    ?>
                                        <p><?php echo $description; ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!-- container -->
                    <?php
                    } else {
                    ?>
                        <div class="container table-container js_fade section-space view-port-detect">
                            <div class="row table-sec vcard">
                                <div class="col col4 tablecell table-left-content">
                                    <?php
                                    if ($name != '') {
                                    ?>
                                        <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                                    <?php
                                    }
                                    if ($description != '') {
                                    ?>
                                        <p><?php echo $description; ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="col col8 tablecell">
                                    <div class="tablecell-image background-color">
                                        <img src="" class="image js_image_load image-tag u-photo" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" data-src="<?php echo $image; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div><!-- container -->
    <?php
                    }
                    $at_count++;
                }
            }
        }
    }
    ?>
    <!-- Hotel Attractions -->


    <!-- Experiences -->
    <?php
    $hotel_experience_obj = get_post_meta($hotel_id, "hotel_experiences", true);
    if ($hotel_experience_obj) {
        $exp_category_ids = array();
        foreach ($hotel_experience_obj as $hotel_experience_id) {
            if (get_post_status($hotel_experience_id) == 'publish') {
                $category_id = get_post_meta($hotel_experience_id, "experience_category", true);
                if ($category_id) {
                    $exp_category_ids[] = $category_id;
                }
            }
        }

        $exp_category_ids = array_unique($exp_category_ids);
        sort($exp_category_ids);
        if ($exp_category_ids) {
            if (isMobile()) {
    ?>
                <div class="container align-center mobile-experince view-port-detect">
                    <h2 class="sec-title align-center">
                        Experience <?php echo ucwords($GLOBALS['location'][0]->name); ?>
                    </h2>
                    <div class="row">
                        <?php
                        if (count($exp_category_ids) > 0) {
                        ?>
                            <div class="flexslider slider">
                                <ul class="slides">
                                    <?php
                                    foreach ($exp_category_ids as $id) {
                                        $category_title = get_post_meta($id, "category_title", true);
                                        $description = wpautop(get_post_meta($id, "description", true));
                                        $image_id = get_post_meta($id, "banner_image", true);
                                        $banner_image = wp_get_attachment_image_src($image_id, 'listing_page_image')[0];
                                    ?>
                                        <li>
                                            <div class="col-desc">
                                                <img src="" class="image js_image_load image-tag" draggable="false" alt="<?php echo $category_title; ?>" title="<?php echo $category_title; ?>" data-src="<?php echo $banner_image; ?>" />

                                                <?php
                                                if ($category_title != '') {
                                                ?>
                                                    <h3 class="item-title"><?php echo $category_title; ?></h3>
                                                <?php
                                                }
                                                if ($description != '') {
                                                    if (strlen($description) > 200) {
                                                        $description = substr($description, 0, 200) . '...';
                                                    }
                                                ?>
                                                    <p><?php echo $description; ?></p>
                                                <?php
                                                }
                                                ?>
                                                <a href="/the-lalit-<?php echo $city_name; ?>/experience-the-lalit" class="btn primary-btn" title="More">More</a>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="container blk-desc section-space js_fade view-port-detect">
                    <h2 class="sec-title align-center">Experience <?php echo ucwords($GLOBALS['location'][0]->name); ?></h2>

                    <div class="row  desktop-view">
                        <?php
                        if (count($exp_category_ids) > 1) {
                        ?>
                            <div class="flexslider slider">
                                <ul class="slides">
                                    <?php
                                    foreach ($exp_category_ids as $id) {
                                        $category_title = get_post_meta($id, "category_title", true);
                                        $description = wpautop(get_post_meta($id, "description", true));
                                        $image_id = get_post_meta($id, "banner_image", true);
                                        $banner_image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                                    ?>
                                        <li class="table-sec">
                                            <div class="col col4 tablecell col-desc">
                                                <?php
                                                if ($category_title != '') {
                                                ?>
                                                    <h3 class="item-title"><?php echo $category_title; ?></h3>
                                                <?php
                                                }
                                                if ($description != '') {
                                                    if (strlen($description) > 200) {
                                                        $description = substr($description, 0, 200) . '...';
                                                    }
                                                ?>
                                                    <p><?php echo $description; ?></p>
                                                <?php
                                                }
                                                ?>
                                                <a href="/the-lalit-<?php echo $city_name; ?>/experience-the-lalit" class="btn primary-btn" title="More">More</a>
                                            </div>

                                            <div class="col col8 tablecell">
                                                <div class="slider-cell-image background-color">
                                                    <img src="" class="image js_image_load image-tag" draggable="false" alt="<?php echo $category_title; ?>" title="<?php echo $category_title; ?>" data-src="<?php echo $banner_image; ?>" />
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                    foreach ($exp_category_ids as $id) {
                                        $category_title = get_post_meta($id, "category_title", true);
                                        $description = wpautop(get_post_meta($id, "description", true));
                                        $image_id = get_post_meta($id, "banner_image", true);
                                        $banner_image = wp_get_attachment_url($image_id);
                                    ?>
                                        <li class="table-sec">
                                            <div class="col col4 tablecell col-desc">
                                                <?php
                                                if ($category_title != '') {
                                                ?>
                                                    <h3 class="item-title"><?php echo $category_title; ?></h3>
                                                <?php
                                                }
                                                if ($description != '') {
                                                    if (strlen($description) > 200) {
                                                        $description = substr($description, 0, 200) . '...';
                                                    }
                                                ?>
                                                    <p><?php echo $description; ?></p>
                                                <?php
                                                }
                                                ?>
                                                <a href="/the-lalit-<?php echo $city_name; ?>/experience-the-lalit" class="btn primary-btn" title="More">More</a>
                                            </div>

                                            <div class="col col8 tablecell">
                                                <div class="slider-cell-image background-color">
                                                    <img src="" class="image js_image_load image-tag" draggable="false" alt="<?php echo $category_title; ?>" title="<?php echo $category_title; ?>" data-src="<?php echo $banner_image; ?>" />
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
    <!-- Experiences -->
<style>
.mymap{position:relative;}
.mymap::before {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgb(0,0,0,.7) 0%, rgb(0,0,0,.7) 70%);
}
</style> 

    <!-- Property address and map -->
    <?php
    $address = $GLOBALS['address'];
    $email = $GLOBALS['email'];
    $phone = $GLOBALS['phone'];
    $fax = $GLOBALS['fax'];
    $lat = get_post_meta($hotel_id, "latitude", true);
    $lng = get_post_meta($hotel_id, "longitude", true);
    $getting_here_obj = get_post_meta($hotel_id, "getting_here", true);
    ?>
    <div class="container map-sec section-space js_fade">
        <input type="hidden" id="latitude" value="<?php echo $lat; ?>" />
        <input type="hidden" id="longitude" value="<?php echo $lng; ?>" />

        <!--div id="map" style="border:0; height:515px; width:100%;">
        </div-->
		<?php

		$address = $address;

		echo '<div class="mymap"><iframe style="width: 100%; height: 515px;" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe></div>';
		?>
		
        <div class="map-sec-inner">
            <div class="row">
                <div class="address-block">
                    <div class="address-block-inner">
                        <div class="arrow-design-blk">
                            <?php
                            if ($address != '') {
                            ?>
                                <h6>Location</h6>
                                <address><?php echo $address; ?></address>
                            <?php
                            }
                            if ($getting_here_obj) {
                            ?>
                                <ul class="unstyled-listing">
                                    <?php
                                    foreach ($getting_here_obj as $getting_here) {
                                        $heading = $getting_here['heading'];
                                        $value = $getting_here['value'];

                                        if ($heading != '' || $value != '') {
                                    ?>
                                            <li>
                                                <span class="span span6 place-name"><?php echo $heading; ?></span>
                                                <span class="distance"><?php echo $value; ?></span>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            <?php
                            }
                            ?>
                            <a class="btn tertiary-btn" href="/the-lalit-<?php echo $city_name; ?>/location">MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property address and map -->

    <?php if ($city_name != 'london')  : ?>
        <!-- Hotel Services -->
        <?php
        $hotel_services = get_post_meta($hotel_id, "hotel_services", true);
        if ($hotel_services) {
        ?>
            <div class="container section-space js_fade" style="display:none;">
                <div class="row">
                    <h2 class="sec-title align-center">Taking Care of your Needs</h2>
                </div>
            </div>
            <?php
            if (count($hotel_services) > 1) {
                if (count($hotel_services) == 2) {
                    $class = "two-item";
                }
            ?>
                <div class="container js_fade" id="award-services1">
                    <div class="row <?php echo $class; ?>">
                        <div class="owl-carousel owl-theme service-carousel">
                            <?php
                            foreach ($hotel_services as $hotel_servixe_id) {
                                if (get_post_status($hotel_servixe_id) == 'publish') {
                                    $name = get_post_meta($hotel_servixe_id, 'name', true);
                                    $images = get_post_meta($hotel_servixe_id, 'image', true);
                                    $images = explode(',', $images);
                                    $image = wp_get_attachment_url($images[0]);
                                    $timings = get_post_meta($hotel_servixe_id, 'timings', true);
                                    $description = get_post_meta($hotel_servixe_id, 'description', true);

                                    array_push($GLOBALS['hotel_service_image'], $image);
                            ?>
                                    <div class="card-item">
                                        <div class="card-img">
                                            <img src="" class="image" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                                        </div>
                                        <?php
                                        if ($name != '' || $description != '') {
                                        ?>
                                            <div class="card-info">
                                                <?php
                                                if ($name != '') {
                                                ?>
                                                    <h3 class="card-info-title bdr-bottom">
                                                        <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                                                    </h3>
                                                <?php
                                                }
                                                if ($timings != '') {
                                                ?>
                                                    <span class="availability"><?php echo $timings; ?></span>
                                                <?php
                                                }
                                                if ($description != '') {
                                                ?>
                                                    <p><?php echo $description; ?></p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <div class="container js_fade" id="award-services">
                    <div class="row one-item">
                        <div class="owl-carousel owl-theme service-carousel">
                            <?php
                            foreach ($hotel_services as $hotel_service_id) {
                                if (get_post_status($hotel_service_id) == 'publish') {
                                    $name = get_post_meta($hotel_service_id, 'name', true);
                                    $images = get_post_meta($hotel_service_id, 'image', true);
                                    $images = explode(',', $images);
                                    $image = wp_get_attachment_url($images[0]);
                                    $description = get_post_meta($hotel_service_id, 'description', true);

                                    array_push($GLOBALS['hotel_service_image'], $image);
                            ?>
                                    <div class="card-item">
                                        <div class="card-img">
                                            <img src="" class="image" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                                        </div>
                                        <?php
                                        if ($name != '' || $description != '') {
                                        ?>
                                            <div class="card-info">
                                                <?php
                                                if ($name != '') {
                                                ?>
                                                    <h3 class="card-info-title bdr-bottom">
                                                        <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                                                    </h3>
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
                                        <?php
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <!-- Hotel Services -->
    <?php
    endif;
    ?>

    <?php if ($city_name != 'london')  : ?>
    <!-- City Attractions -->
    <?php
    $city_attraction_obj = get_post_meta($hotel_id, "city_attractions", true);
    if ($city_attraction_obj) {
        $images = get_banner_by_taxonomy($banner_ids, 'city_highlights_overview', 1);

        $city_attraction_banner = '';
        if ($images->have_posts()) :
            while ($images->have_posts()) : $images->the_post();
                $image_id = get_post_meta($post->ID, 'banner_image', true);
                $city_attraction_banner = wp_get_attachment_url($image_id);
            endwhile;
        endif;

        if ($hotel_additional_information) {
            foreach ($hotel_additional_information as $info_id) {
                $highlights_title = get_post_meta($info_id, 'highlights_title', true);
                $highlights_description = wpautop(get_post_meta($info_id, 'highlights_description', true));
            }
        }
    ?>
        <div class="view-port-detect">
            <div class="container attraction-bg js_fade js_image_load background-image background-color" data-src="background-image:url('<?php echo $city_attraction_banner; ?>')" data-url="<?php echo $city_attraction_banner; ?>">
                <div class="wrapper">
                    <h4 class="sec-title  align-center text-white">City Attractions</h4>
                    <?php
                    if ($highlights_description) {
                    ?>
                        <p class="align-center split"><?php echo $highlights_description; ?></p>
                    <?php
                    }

                    $attraction_category_ids = array();
                    foreach ($city_attraction_obj as $city_attraction_id) {
                        if (get_post_status($city_attraction_id) == 'publish') {
                            $category_ids = get_post_meta($city_attraction_id, "city_attraction_category", true);
                            if ($category_ids) {
                                foreach ($category_ids as $category_id) {
                                    $attraction_category_ids[] = $category_id;
                                }
                            }
                        }
                    }

                    $attraction_category_ids = array_unique($attraction_category_ids);
                    sort($attraction_category_ids);

                    if ($attraction_category_ids) {
                    ?>
                        <div class="flexslider slider">
                            <ul class="slides">
                                <?php
                                foreach ($attraction_category_ids as $id) {
                                    $category_name = get_post_meta($id, "category_name", true);
                                    $image_id = get_post_meta($id, "image", true);
                                    $image = wp_get_attachment_url($image_id);
                                    $description = get_post_meta($id, "description", true);
                                ?>
                                    <li class="wrap-single table-sec">
                                        <div class="wrap-img tablecell background-color">
                                            <?php
                                            if ($image != '') {
                                            ?>
                                                <img src="" class="image js_image_load image-tag" alt="<?php echo $category_name; ?>" title="<?php echo $category_name; ?>" data-src="<?php echo $image; ?>" />
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="wrap-desc tablecell">
                                            <?php
                                            if ($category_name != '') {
                                            ?>
                                                <h3 class="item-title underline"><?php echo $category_name; ?></h3>
                                            <?php
                                            }

                                            if ($description != '') {
                                                if (strlen($description) > 150) {
                                                    $description = substr($description, 0, 150) . '...';
                                                }
                                            ?>
                                                <p><?php echo $description; ?></p>
                                            <?php
                                            }
                                            ?>
                                            <a href="/the-lalit-<?php echo $city_name; ?>/city-attractions" class="btn primary-btn" title="view all">View All</a>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- City Attractions -->
<?php endif; ?>

    <!-- Testimonials -->
    <?php
    $testimonial_obj = get_post_meta($hotel_id, "testimonials", true);
    if ($testimonial_obj) {
    ?>
        <div class="container blockqote-bg js_fade">
            <div class="wrapper blockquote-sec">
                <?php
                if (count($testimonial_obj) > 1) {
                ?>
                    <div class="flexslider fadeslider">
                        <ul class="slides">
                            <?php
                            foreach ($testimonial_obj as $testimonial_id) {
                                if (get_post_status($testimonial_id) == 'publish') {
                                    $quote = get_post_meta($testimonial_id, 'quote', true);
                                    $author_name = get_post_meta($testimonial_id, 'author_name', true);
                                    $author_details = get_post_meta($testimonial_id, 'author_details', true);
                            ?>
                                    <li>
                                        <blockquote>
                                            <i class="ico-sprite sprite size-48 ico-qote"></i>
                                            "<?php echo $quote; ?>"
                                        </blockquote>
                                        <cite>
                                            <span class="name"><?php echo $author_name; ?></span>
                                            <span class="designation"><?php echo $author_details; ?></span>
                                        </cite>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                } else {
                ?>
                    <div class="">
                        <ul class="slides">
                            <?php
                            foreach ($testimonial_obj as $testimonial_id) {
                                if (get_post_status($testimonial_id) == 'publish') {
                                    $quote = get_post_meta($testimonial_id, 'quote', true);
                                    $author_name = get_post_meta($testimonial_id, 'author_name', true);
                                    $author_details = get_post_meta($testimonial_id, 'author_details', true);
                            ?>
                                    <li>
                                        <blockquote><?php echo $quote; ?></blockquote>
                                        <cite>
                                            <span class="name"><?php echo $author_name; ?></span>
                                            <span class="designation"><?php echo $author_details; ?></span>
                                        </cite>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Testimonials -->

</div><!-- content-section -->