<?php
if ($GLOBALS['$destinations']) {
    $destination_obj = $GLOBALS['$destinations'];
} else {
    $destination_obj = get_destination_object();
}

$des_images = array();

$hotel_types = array();
$hotel_interests = array();

if ($destination_obj->have_posts()) :

    $c = 0;
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
        $types = get_the_terms($post->ID, 'types');
        if ($types) {
            foreach ($types as $type) {
                $hotel_types[$c]['id'] = $type->term_id;
                $hotel_types[$c]['name'] = $type->name;
                $hotel_types[$c]['slug'] = $type->slug;
                $c++;
            }
        }
    endwhile;

    $c1 = 0;
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
        $interests = get_the_terms($post->ID, 'interests');
        if ($interests) {
            foreach ($interests as $interest) {
                $hotel_interests[$c1]['id'] = $interest->term_id;
                $hotel_interests[$c1]['name'] = $interest->name;
                $hotel_interests[$c1]['slug'] = $interest->slug;
                $c1++;
            }
        }
    endwhile;

    $filter_list = array();
    $hotel_types  = array_unique($hotel_types, SORT_REGULAR);
    $hotel_interests  = array_unique($hotel_interests, SORT_REGULAR);

    $filter_list = array_merge($hotel_types, $hotel_interests);
?>

    <style>
        .owl-carousel.owl-drag .owl-item {
            box-shadow: 0 2px 14px 0 #e5e3e3;
            /* background-color: #ffffff; */
        }

        .active a {
            text-decoration: none;
            background-image: linear-gradient(to top, #a10813, #a10813 7%, #d9252f 12%, #d9252f);
            color: #fff;
        }

        .pick-restra-btn {
            background-image: linear-gradient(to top, #a10813, #a10813 7%, #d9252f 12%, #d9252f);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 1.1px;
            line-height: 18px;
            padding: 8px;
            text-align: center;
            text-transform: uppercase;
            display: inline-block;
        }
    </style>
    <div class="container container-shadow" style="padding-top:20px" id="popular-dest1">
        <div class="row clearfix">
            <h2 class="sec-title align-center page-title-home">Popular Destinations</h2>
            <div class="owl-carousel-dest owl-carousel owl-theme service-carousel">
                <?php
                while ($destination_obj->have_posts()) : $destination_obj->the_post();

                    $title = get_the_title($post->ID);
                    $image_id = get_post_meta($post->ID, 'property_image', true);
                    if (isMobile()) {
                        $image = wp_get_attachment_image_src($image_id, 'box_image')[0];
                    } else {
                        $image = wp_get_attachment_url($image_id);
                    }
                    //$image = wp_get_attachment_url($image_id);
                    $location = get_the_terms($post->ID, 'locations');
                    $city_name = $location[0]->slug;
                    $permalink = site_url() . '/the-lalit-' . $city_name . '/';

                    $class = '';
                    $destination_type = get_the_terms($post->ID, 'types');
                    if ($destination_type) {
                        foreach ($destination_type as $type) {
                            $class .= $type->slug . ' ';
                        }
                    }
                    $destination_interest = get_the_terms($post->ID, 'interests');
                    if ($destination_interest) {
                        foreach ($destination_interest as $interest) {
                            $class .= $interest->slug . ' ';
                        }
                    }

                    $class = rtrim($class, ' ');
                ?>
                    <?php
                    if ($city_name != 'london') {
                    ?>
                        <div class="card-item">

                            <div class="card-img">
                                <a href="<?php echo $permalink; ?>" class="hotels-block <?php echo $class; ?>">
                                    <img src="<?php echo $image; ?>" class="image" alt="<?php echo $image; ?>" title="<?php echo $image; ?>" />
                                </a>
                            </div>
                            <div class="card-info">
                                <div class="row">
                                    <?php
                                    if ($location[0]->name != '') {
                                    ?>
                                        <!-- <h3 class="card-info-title bdr-bottom">
                                    <span class="bdr-bottom-gold"><?php echo $location[0]->name; ?></span>
                                </h3> -->

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-left no-padding">
                                            <h5 class="card-info-title ">
                                                <span class="bdr-bottom-gold p-name"><?php echo $location[0]->name; ?></span>
                                            </h5>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 align-right no-padding">
                                            <a href="<?php echo $permalink; ?>" class="pick-restra-btn">Book Now
                                            </a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                endwhile;
                ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".owl-carousel-dest")
                .owlCarousel({
                    autoplay: !1,
                    center: !0,
                    loop: !0,
                    nav: !0,
                    dots: !0,
                    responsiveClass: !0,
                    responsive: {
                        0: {
                            items: 1,
                            nav: !0,
                        },
                        768: {
                            items: 3,
                            nav: !1,
                        },
                    },
                });
        });
    </script>
<?php

endif;
wp_reset_postdata();
?>