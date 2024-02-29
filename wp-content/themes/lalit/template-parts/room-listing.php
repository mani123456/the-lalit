<?php
$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);

$suites_and_rooms_object = '';

$room_type_ids = array();
$features = array();
$bed_baths = array();
$technologies = array();
$services = array();

$curr = '&#8377';

$image_array = array();
$banner_image_array = array();

if ($destination_obj->have_posts()) :
    while ($destination_obj->have_posts()) : $destination_obj->the_post();

        $suites_and_rooms_object = get_post_meta($post->ID, "suites_and_rooms", true);
        $c = 0;
        foreach ($suites_and_rooms_object as $suite_and_room_id) {
            if (get_post_status($suite_and_room_id) == 'publish') {
                $room_type_obj = get_the_terms($suite_and_room_id, 'room_type');
                if ($room_type_obj) {
                    foreach ($room_type_obj as $room_types) {
                        $term_id = $room_types->term_id;
                        $room_type_ids[] = $term_id;
                    }
                }

                $facility = get_the_terms($suite_and_room_id, 'room_facility');
                if ($facility) {
                    foreach ($facility as $facility_id) {
                        $features[$c] = $facility_id->name;

                        $c++;
                    }
                }

                $bed = get_the_terms($suite_and_room_id, 'bed_bath');
                if ($bed) {
                    foreach ($bed as $bed_id) {
                        $bed_baths[$c] = $bed_id->name;

                        $c++;
                    }
                }

                $tech = get_the_terms($suite_and_room_id, 'technology');
                if ($tech) {
                    foreach ($tech as $tech_id) {
                        $technologies[$c] = $tech_id->name;

                        $c++;
                    }
                }

                $service = get_the_terms($suite_and_room_id, 'service');
                if ($service) {
                    foreach ($service as $service_id) {
                        $services[$c] = $service_id->name;

                        $c++;
                    }
                }
            }
        }

        $banner_images = get_post_meta($post->ID, "banner_images", true);

        $room_offers = get_offers_by_type(1, $post->ID, 2);
        $GLOBALS['listing_offers'] = $room_offers;

        $check_in_time = get_post_meta($post->ID, "check_in_time", true);
        $check_out_time = get_post_meta($post->ID, "check_out_time", true);
        $check_in_check_out_policy = wpautop(get_post_meta($post->ID, "check_in_and_check_out_policy", true));
        $child_policy = wpautop(get_post_meta($post->ID, "child_policy", true));
        $pet_policy = wpautop(get_post_meta($post->ID, "pet_policy", true));
        $reservation_policy = wpautop(get_post_meta($post->ID, "reservation_policy", true));
        $cancellation_policy = wpautop(get_post_meta($post->ID, "cancellation_policy", true));
        $food_and_beverage_policy = wpautop(get_post_meta($post->ID, "food_and_beverage_policy", true));
        $alcohol_policy = wpautop(get_post_meta($post->ID, "alcohol_policy", true));
        $visitors_policy = wpautop(get_post_meta($post->ID, "visitors_policy", true));
        $safety_and_security = wpautop(get_post_meta($post->ID, "safety_and_security", true));

        $GLOBALS['address'] = get_post_meta($post->ID, "address", true);
        $GLOBALS['email'] = get_post_meta($post->ID, "email", true);
        $GLOBALS['phone'] = get_post_meta($post->ID, "phone", true);
        $GLOBALS['fax'] = get_post_meta($post->ID, "fax", true);
        $GLOBALS['review_widget'] = get_post_meta($post->ID, "review_widget", true);

        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

        $currency = get_post_meta($post->ID, "currency", true);

        if ($currency == 1) {
            $curr = '&#8377;';
        } else {
            $curr = '&pound;';
        }

    endwhile;
endif;

$room_type_ids = array_unique($room_type_ids);

$features = array_unique($features);
$bed_baths = array_unique($bed_baths);
$technologies = array_unique($technologies);
$services = array_unique($services);


$types = get_terms([
    'taxonomy' => 'room_type',
    'hide_empty' => false,
]);
?>

<div class="content-section room-dining-listing">

    <?php

    if ($banner_images) {

        $banner_ids = array();
        foreach ($banner_images as $banner_image_id) {
            $banner_ids[] = $banner_image_id;
        }

        $images_videos = get_banner_by_taxonomy($banner_ids, 'room_listing');

        if ($images_videos->have_posts()) :

    ?>
            <div class="main-banner fluid-width banner-slider align-center">
                <div id="banner-slider" class="flexslider">
                    <ul class="slides">
                        <?php
                        while ($images_videos->have_posts()) : $images_videos->the_post();

                            if (isMobile()) {
                                $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            } else {
                                $image_id = get_post_meta($post->ID, 'banner_image', true);
                                $image = wp_get_attachment_url($image_id);
                            }
                            $heading = get_post_meta($post->ID, 'banner_heading', true);
                            $description = get_post_meta($post->ID, 'banner_description', true);
                            $url = get_post_meta($post->ID, 'url', true);
                            $button_text = get_post_meta($post->ID, 'button_text', true);

                            if ($image != '') {
                        ?>
                                <li class="banner-image">
                                    <?php
                                    if ($url && trim($url) != '') {
                                    ?>
                                        <a href="<?php echo $url; ?>" class="block">
                                        <?php
                                    }
                                        ?>
                                        <img src="<?php echo $image; ?>" />
                                        <div class="banner-content align-center">
                                            <?php
                                            if ($heading != '') {
                                            ?>
                                                <h1 class="main-title text-shadow"><?php echo $heading; ?></h1>
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
                                        ?>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </li>
                        <?php
                            }
                        endwhile;
                        ?>
                    </ul>
                </div> <!-- slider -->
            </div>
    <?php

        endif;
    }

    ?>


    <?php

    if ($hotel_additional_information) {

        foreach ($hotel_additional_information as $info_id) {
            $stay_title = get_post_meta($info_id, 'stay_title', true);
            $stay_description = wpautop(get_post_meta($info_id, 'stay_description', true));
        }

        if ($stay_title && $stay_description) {

    ?>
            <div class="container section-space intro-text align-center">
                <div class="row">
                    <div class="seperator"></div>
                    <?php
                    if ($stay_title) {
                    ?>
                        <h4 class="sec-title"><?php echo $stay_title; ?></h4>
                    <?php
                    }
                    ?>

                    <?php
                    if ($stay_description) {
                    ?>
                        <div class="col col10 align-content-center "><?php echo $stay_description; ?></div>
                    <?php
                    }
                    ?>
                </div>
            </div>
    <?php

        }
    }
    ?>


    <?php
    if ($types && count($room_type_ids) > 1) {
    ?>
        <div class="container  scroll-container scroll-to js_fade">
            <div class="row">
                <ul class="smooth-scroll unstyled-listing">
                    <?php
                    foreach ($types as $t) {
                        if (in_array($t->term_id, $room_type_ids)) {
                    ?>
                            <li class="nav-item rooms"><a href="#<?php echo $t->slug; ?>">view <?php echo $t->name; ?> </a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>


    <?php
    if ($types) {
        foreach ($types as $type) {
            $name = $type->name;
            $term_id = $type->term_id;
            $slug = $type->slug;

            if (in_array($term_id, $room_type_ids)) {
                $t = $slug;

                if (isIPad()) {
                    $cls1 = 'two-col-listing';
                    $cls2 = 'col6';
                } else {
                    $cls1 = 'three-col-listing';
                    $cls2 = 'col4';
                }
    ?>

                <div class="container item-listing js_fade" id="<?php echo $t; ?>">
                    <h2 class="sec-title align-center"><?php echo ucfirst($name); ?></h2>
                    <div class="row <?php echo $cls1; ?>">
                        <?php
                        $room_count = 1;
                        foreach ($suites_and_rooms_object as $suite_and_room_id) {
                            if (get_post_status($suite_and_room_id) == 'publish') {
                                $room_term_id = '';
                                $room_type_obj = get_the_terms($suite_and_room_id, 'room_type');
                                if ($room_type_obj && count($room_type_obj) > 0) {
                                    foreach ($room_type_obj as $room_types) {
                                        $room_term_id = $room_types->term_id;
                                    }
                                }

                                $room_name = get_post_meta($suite_and_room_id, "name", true);
                                $room_description = get_post_meta($suite_and_room_id, "room_summary", true);
                                $room_images = get_post_meta($suite_and_room_id, "images", true);
                                $room_images = explode(',', $room_images);
                                if (strlen($room_description) > 150) {
                                    $room_description = substr($room_description, 0, 150) . '...';
                                }

                                $size_ft = get_post_meta($suite_and_room_id, "size_ft", true);
                                $size_mt = get_post_meta($suite_and_room_id, "size_mt", true);
                                $bed_type = get_post_meta($suite_and_room_id, "bed_type", true);
                                $view = get_post_meta($suite_and_room_id, "view", true);
                                $room_base_price = get_post_meta($suite_and_room_id, "base_price", true);

                                $permalink = get_permalink($suite_and_room_id);

                                if ($room_term_id == $term_id) {
                        ?>
                                    <div class="col <?php echo $cls2; ?> card-item js_fade stay-room">
                                        <div id="slider" class="flexslider slider">
                                            <ul class="slides h-card">
                                                <?php
                                                if ($room_images) {
                                                    foreach ($room_images as $room_image_id) {
                                                        $room_image = wp_get_attachment_image_src($room_image_id, 'box_image')[0];

                                                        if (trim($room_image) != '') {
                                                            array_push($image_array, $room_image);
                                                ?>
                                                            <li class="photoMaskVer unstyled-listing">
                                                                <img src="" class="image u-photo" alt="<?php echo $room_name; ?>" title="<?php echo $room_name; ?>" />
                                                            </li>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div><!-- slider -->

                                        <div class="card-info h-product">
                                            <input type="hidden" class="permalink" value="<?php echo $permalink; ?>">
                                            <h3 class="card-info-title bdr-bottom">
                                                <span class="bdr-bottom-gold p-name"><?php echo $room_name; ?></span>
                                            </h3>
                                            <p><?php echo $room_description; ?></p>
                                            <div class="row">
                                                <ul class="col col7 unstyled-listing meta-info meta-inline">
                                                    <?php
                                                    if ($size_ft != '' || $size_mt != '') {
                                                    ?>
                                                        <li class="meta-item u-identifier">
                                                            <span class="meta-label">SIZE</span>
                                                            <span class="meta-value">
                                                                <?php
                                                                if ($size_ft != '' && $size_mt == '') {
                                                                    echo $size_ft . ' ft<sup>2</sup>';
                                                                } else if ($size_ft == '' && $size_mt != '') {
                                                                    echo $size_mt . ' m<sup>2</sup>';
                                                                } else {
                                                                    echo $size_ft . ' ft<sup>2</sup> / ' . $size_mt . ' m<sup>2</sup>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($view != '') {
                                                    ?>
                                                        <li class="meta-item u-identifier">
                                                            <span class="meta-label">VIEW</span><span class="meta-value"><?php echo ucfirst($view); ?></span>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul><!-- unstyled-listing -->

                                                <ul class="col col5 unstyled-listing price-block align-right meta-inline">

                                                    <?php
                                                    if ($room_base_price != '') {
                                                    ?>
                                                        <li class="meta-item clearfix">
                                                            <span class="meta-label">Starting at</span>
                                                            <strong class="meta-value p-price"><?php echo $curr; ?><?php echo number_format($room_base_price); ?></strong>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li class="meta-item detail-arrow">
                                                        <a href="<?php echo $permalink; ?>" class="text-link uppercase">Discover
                                                            <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                                        </a>
                                                    </li>
                                                </ul> <!-- unstyled-listing -->
                                            </div><!-- row -->
                                        </div><!-- card-info -->
                                    </div><!-- card-item-block -->

                        <?php
                                    $room_count++;
                                }
                            }
                        }
                        ?>
                    </div><!-- row -->
                </div><!-- container -->
    <?php
            }
        }
    }
    ?>

    <div class="container policy-bg js_fade">
        <?php
        if ($features || $services || $bed_baths || $technologies) {
        ?>
            <div class="row">
                <div class="col col12">
                    <div class="amenities-block">
                        <h2 class="sec-title">
                            <small>In-Room</small>Amenities &amp; Services</h2>
                        <div class="row">
                            <?php
                            if ($features) {
                            ?>
                                <div class="col col3">
                                    <div class="sub-section">
                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Room Features</span></h4>
                                        <ul class="service-list">
                                            <?php
                                            $f = 1;
                                            foreach ($features as $feature) {
                                                if ($f > 10) {
                                                    $style1 = "display:none";
                                                    $class1 = "hiddeble";
                                                }
                                            ?>
                                                <li style="<?php echo $style1; ?>" class="<?php echo $class1; ?>"><span><?php echo $feature; ?></span></li>
                                            <?php
                                                $f++;
                                            }
                                            ?>
                                        </ul>
                                        <!-- bullet-listing -->
                                        <?php
                                        if (count($features) > 10) {
                                        ?>
                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>
                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- col col3 -->
                            <?php
                            }
                            ?>


                            <?php
                            if ($services) {
                            ?>
                                <div class="col col3">
                                    <div class="sub-section">
                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Services</span></h4>
                                        <ul class="service-list">
                                            <?php
                                            $s = 1;
                                            foreach ($services as $service) {
                                                if ($s > 10) {
                                                    $style2 = "display:none";
                                                    $class2 = "hiddeble";
                                                }
                                            ?>
                                                <li style="<?php echo $style2; ?>" class="<?php echo $class2; ?>"><span><?php echo $service; ?></span></li>
                                            <?php
                                                $s++;
                                            }
                                            ?>
                                        </ul>
                                        <!-- bullet-listing -->
                                        <?php
                                        if (count($services) > 10) {
                                        ?>
                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>
                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- col col3 -->
                            <?php
                            }

                            if ($bed_baths) {
                            ?>
                                <div class="col col3">
                                    <div class="sub-section">
                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Bed &amp; Bath</span></h4>
                                        <ul class="service-list">
                                            <?php
                                            $b = 1;
                                            foreach ($bed_baths as $bed_bath) {
                                                if ($b > 10) {
                                                    $style3 = "display:none";
                                                    $class3 = "hiddeble";
                                                }
                                            ?>
                                                <li style="<?php echo $style3; ?>" class="<?php echo $class3; ?>"><span><?php echo $bed_bath; ?></span></li>
                                            <?php
                                                $b++;
                                            }
                                            ?>
                                        </ul>
                                        <!-- bullet-listing -->
                                        <?php
                                        if (count($bed_baths) > 10) {
                                        ?>
                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>
                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- col col3 -->
                            <?php
                            }
                            ?>


                            <?php
                            if ($technologies) {
                            ?>
                                <div class="col col3">
                                    <div class="sub-section">
                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Technology</span></h4>
                                        <ul class="service-list">
                                            <?php
                                            $t = 1;
                                            foreach ($technologies as $technology) {
                                                if ($t > 10) {
                                                    $style4 = "display:none";
                                                    $class4 = "hiddeble";
                                                }
                                            ?>
                                                <li style="<?php echo $style4; ?>" class="<?php echo $class4; ?>"><span><?php echo $technology; ?></span></li>
                                            <?php
                                                $t++;
                                            }
                                            ?>
                                        </ul>
                                        <!-- bullet-listing -->
                                        <?php
                                        if (count($technologies) > 10) {
                                        ?>
                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>
                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- col -->
                            <?php
                            }
                            ?>
                        </div><!-- row -->
                    </div><!-- amenities-block -->
                </div><!-- col -->
            </div><!-- row -->
        <?php
        }
        ?>
        <div class="row">
            <div class="col col12">
                <div class="accordion-block">
                    <p><strong>Please review our</strong> <a href="#policies" class="text-link uppercase fancybox"> Guests Policies <i class="ico-sprite sprite ico-red-right-arrow"></i></a></p>
                </div>
                <!-- policies-block -->
            </div><!-- col -->
        </div>

    </div><!-- container -->


    <div id="policies" class="pop-up" style="display: none;">
        <h2 class="sec-title">Guest Policies</h2>
        <ul class="accordion  unstyled-listing">
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Check-in and Check-out Policy</h6>
                    </span>
                    <span class="sprite size-16 ico-gre-down-arrow"></span>
                    <span class="sprite size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <div class="check-col">
                        <span class="span span4">
                            <span class="meta-label">Check-in:</span>
                            <span class="meta-value"><?php echo $check_in_time; ?></span>
                        </span>
                        <span class="span span4">
                            <span class="meta-label">Check-out:</span>
                            <span class="meta-value"><?php echo $check_out_time; ?></span>
                        </span>
                    </div>
                    <?php echo $check_in_check_out_policy; ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Child Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite  size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php echo $child_policy; ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Pet Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $pet_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Reservation Guarantee/Payments</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite  size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $reservation_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Cancellation Policy/No-Show Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite  size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $cancellation_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Food and Beverage Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $food_and_beverage_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Alcohol Policy/Drug Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $alcohol_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Visitors Policy</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $visitors_policy;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
            <li>
                <a href="javascript:void(0)" class="accordion-head collapse">
                    <span>
                        <h6 class="accordion-heading">Safety and Security</h6>
                    </span>
                    <span class="sprite  size-16 ico-gre-down-arrow"></span>
                    <span class="sprite  size-16 ico-gre-up-arrow"></span>
                </a>
                <div class="collapse-data" style="display:none;">
                    <?php
                    echo $safety_and_security;
                    ?>
                </div>
                <!--collapse-data-->
            </li>
        </ul><!-- accordion -->
    </div><!-- pop-up -->

    <?php
    if ($room_offers->have_posts()) :

        $GLOBALS['type'] = 'suites-and-rooms';
        get_template_part('includes/available', 'offers-listing');

    endif;
    ?>

</div>

<?php
$GLOBALS['image_array'] = $image_array;
$GLOBALS['banner_image_array'] = $banner_image_array;
?>