<?php
if ($GLOBALS['$destinations']) {
    $destination_obj = $GLOBALS['$destinations'];
} else {
    $destination_obj = get_destination_object();
}

?>
<style>
    .items {
        width: 300px;
        box-shadow: 0 3px 6px rgba(black, 0.16), 0 3px 6px rgba(black, 0.23);
    }

    .items-head p {
        padding: 5px 20px;
        margin: 10px;
        color: #0a0905;
        font-weight: bold;
        font-size: 16px;
    }

    .items-head hr {
        width: 20%;
        margin: 0px 30px;
        /* border: 1px solid #0B5AA2; */
    }

    .items-body {
        padding: 10px;
        margin: 10px;
        display: grid;
        grid-gap: 10px;
    }

    .items-body-content {
        padding: 2px;
        padding-right: 0px;
        display: grid;
        grid-template-columns: 10fr 1fr;
        font-size: 16px;
        grid-gap: 4px;
        border: 1px solid transparent;
        cursor: pointer;

    }

    .items-body-content a {
        font-size: 14px !important;
        border: 1px solid transparent;
        cursor: pointer;
        text-transform: uppercase;
    }


    .items-body-content:hover {
        border-radius: 10px;
        border: 1px solid #976107;
    }

    .items-body-content i {
        align-self: center;
        font-size: 14px;
        color: #0B5AA2;
        font-weight: bold;
        animation: icon 1.5s infinite forwards;
    }

    @keyframes icon {

        0%,
        100% {
            transform: translate(0px);
        }

        50% {
            transform: translate(3px);
        }
    }

    /* .owl-carousel.owl-drag .owl-item {
        box-shadow: 0 2px 14px 0 #e5e3e3;
    } */

    @media (max-device-width: 767px) {
        .book-direct-wrapper .owl-carousel .owl-stage-outer {
            height: 325px;
        }
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
<?php
$home_banners = get_popular_offers_banners();
?>

<?php
if ($home_banners->have_posts()) :

?>

    <div class="container fluid-width section-space clearfix container-shadow" style="padding-top:45px;" id="popular-dest2">
        <div class="row clearfix">
            <h2 class="sec-title align-center page-title-home">Special Offers</h2>
            <div class="owl-carousel owl-theme owl-carousel-offers">
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
                    $destinations_available = get_post_meta($post->ID, 'destinations_available', true);
                    $link_by_booking_engine = get_post_meta($post->ID, 'link_by_booking_engine', true);

                    $video_url = get_post_meta($post->ID, 'video_url', true);
                    $short_video = get_post_meta($post->ID, 'short_video', true);
                    $exclude_temperature = get_post_meta($post->ID, 'exclude_temperature', true);
                    wp_reset_postdata();
                ?>

                    <div class="card-item">
                        <div class="card-img">
                            <a class="hotels-block fancybox" href="#book-a-table<?php echo $count; ?>">
                                <img src="<?php echo $image; ?>" class="image" alt="<?php echo $image; ?>" title="<?php echo $image; ?>" />
                            </a>
                        </div>
                        <div class="card-info">
                            <div class="row">
                                <?php
                                if ($heading != '') {
                                ?>
                                    <!-- <h3 class="card-info-title bdr-bottom">
                                    <span class="bdr-bottom-gold"><?php echo $heading; ?></span>
                                </h3> -->

                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 align-left no-padding ">
                                        <h5 class="card-info-title ">
                                            <span class="bdr-bottom-gold p-name"><?php echo $heading; ?></span>
                                        </h5>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 align-right no-padding">
                                        <a class="pick-restra-btn fancybox" href="#book-a-table<?php echo $count; ?>">Book Now
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                if ($description != '') {
                                ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-left no-padding ">
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                    </div>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php if ($destinations_available) { ?>
                            <div id="book-a-table<?php echo $count; ?>" class="pop-up" style="display: none;">
                                <div class="form-header">
                                    <div class="items">
                                        <div class="page-title items-head">
                                            <p> <?php echo $heading; ?></p>
                                            <hr>
                                        </div>
                                        <div class="items-body">
                                            <?php
                                            foreach ($destinations_available as $destId) {
                                                $title = get_the_title($destId);
                                                // print_r($title);
                                                $location = get_the_terms($destId, 'locations');
                                                // print_r($location);
                                                $city_name = $location[0]->slug;
                                                $permalink = site_url() . '/the-lalit-' . $city_name . $url;
                                                $booking_engine = get_post_meta($destId, "booking_engine", true);
                                                $booking_engine_url = get_post_meta($destId, "booking_engine_url", true);
                                                // echo $booking_engine_url;

                                                //$url = '';
                                                if ($link_by_booking_engine == 1) {
                                                    if ($booking_engine == 1) {
                                                        $booking_engine_hotel_code = get_post_meta($destId, "booking_engine_hotel_code", true);
                                                        $booking_engine_url = get_post_meta($destId, "booking_engine_url", true);
                                                        $booking_engine_url = rtrim($booking_engine_url, '/');

                                                        $url = $booking_engine_url . '/?Hotel=' . $booking_engine_hotel_code;
                                                    } else if ($booking_engine == 2) {
                                                        $booking_engine_hotel_id = get_post_meta($destId, "booking_engine_hotel_id", true);
                                                        $booking_engine_chain_id = get_post_meta($destId, "booking_engine_chain_id", true);
                                                        $booking_engine_url = get_post_meta($destId, "booking_engine_url", true);
                                                        $booking_engine_url = rtrim($booking_engine_url, '/');

                                                        $url = $booking_engine_url . '?Hotel=' . $booking_engine_hotel_id . '&Chain=' . $booking_engine_chain_id . '&template=RBE&shell=RBE';
                                                    }
                                                }

                                                /* while ($destination_obj->have_posts()) : $destination_obj->the_post();
                                            $location = get_the_terms($post->ID, 'locations');
                                            $city_name = $location[0]->slug;
                                            $permalink = site_url() . '/the-lalit-' . $city_name . $url; */
                                            ?>
                                                <div class="items-body-content ">
                                                    <span>
                                                        <a class="fancybox sec-title align-center" href="<?php if ($link_by_booking_engine == 1) {
                                                                                                                echo $url;
                                                                                                            } else {
                                                                                                                echo $permalink;
                                                                                                            } ?>"><?php echo $city_name ?>
                                                        </a>
                                                    </span>
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                    $count++;
                endwhile;
                ?>
                </ul>
            </div>
        </div>
    </div>
<?php
endif;
?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>
    jQuery(document).ready(function() {
        jQuery(".owl-carousel-offers")
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
        /* jQuery('.owl-carousel-offers').owlCarousel({
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            loop: true,
            margin: 50,
            responsiveClass: true,
            nav: true,
            loop: true,
            stagePadding: 100,
            responsive: {
                0: {
                    items: 1
                },
                568: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        }); */
        /* $('.owl-carousel-offers').on('click', '.owl-item', function() {
            alert("click");
        }); */
    });
</script>

<?php
if (isMobile()) {
?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.fancybox').fancybox({
                autoSize: false,
                width: "100%",
                height: "auto",
                helpers: {
                    overlay: {
                        locked: true
                    }
                },
                beforeClose: function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                afterClose: function() {
                    jQuery("body").removeClass("overlay-on overlay-fixed");
                },
                afterShow: function() {
                    jQuery('.fancybox-opened form select:first').focus();
                },
                beforeShow: function() {
                    jQuery('body').addClass('overlay-fixed');
                }
            });
        });
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.fancybox').fancybox({
                autoSize: false,
                width: "550px",
                height: "auto",
                helpers: {
                    overlay: {
                        locked: true
                    }
                },
                beforeClose: function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                afterClose: function() {
                    jQuery("body").removeClass("overlay-on overlay-fixed");
                    //jQuery('.main-wrap').removeClass('main-wrap-fixed');
                },
                afterShow: function() {
                    jQuery('.fancybox-opened form select:first').focus();
                    //jQuery('.main-wrap').addClass('main-wrap-fixed');
                },
                beforeShow: function() {
                    jQuery('body').addClass('overlay-fixed');
                }
            });
        });
    </script>
<?php
}
?>

<?php
wp_reset_postdata();
?>