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
        background-color: #ffffff; 
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


    .exp-btn-box a {
        background-image: none !important;
        padding: 0px 15px 0px 0px;
        margin-right: 15px;
        text-decoration: none;
        text-transform: uppercase;
        position: relative;
        font-weight: 400;
        font-size: 1.5em;
        -webkit-transition: 0.5s all ease-in-out;
        -ms-transition: 0.5s all ease-in-out;
        -o-transition: 0.5s all ease-in-out;
        transition: 0.5s all ease-in-out;
    }

    .exp-btn-box a.style1:after {
        content: " ";
        border-bottom: 2px solid #da2630;
        border-right: 2px solid #da2630;
        top: 50%;
        margin-top: -5px;
        height: 10px;
        right: 0px;
        position: absolute;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
        width: 10px;
        z-index: 2;
    }

    .exp-btn-box a.book-now-a:after {
        content: " ";
        border-bottom: 2px solid #da2630;
        border-right: 2px solid #da2630;
        top: 50%;
        margin-top: -5px;
        height: 10px;
        right: 0px;
        position: absolute;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
        width: 10px;
        z-index: 2;
    }

    .exp-btn-box a.book-now-a {
        color: #da2630;
    }

    .exp-btn-box a.style1 {
        color: #da2630;
        display: inline-block;
    }
</style>
<?php
$wedding_at_lalit_banners = get_wedding_at_lalit_banners();
?>

<?php
if ($wedding_at_lalit_banners->have_posts()) :

?>
    <div class="container fluid-width section-space clearfix container-shadow" id="popular-dest-4">
        <div class="row clearfix">
            <h2 class="sec-title align-center page-title-home">Weddings At The LaLiT</h2>
            <div class="owl-carousel owl-theme owl-carousel-wed-offers">
                <?php
                $count = 0;
                while ($wedding_at_lalit_banners->have_posts()) : $wedding_at_lalit_banners->the_post();
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
                    $weddings_destinations_available = get_post_meta($post->ID, 'destinations_available', true);
                    $link_by_booking_engine = get_post_meta($post->ID, 'link_by_booking_engine', true);

                    $video_url = get_post_meta($post->ID, 'video_url', true);
                    $short_video = get_post_meta($post->ID, 'short_video', true);
                    $exclude_temperature = get_post_meta($post->ID, 'exclude_temperature', true);
                    wp_reset_postdata();
                ?>

                    <div class="card-item">
                        <div class="card-img">
                            <a class="hotels-block fancybox" href="#weddings_destinations_available<?php echo $count; ?>">
                                <img src="<?php echo $image; ?>" class="image" alt="<?php echo $image; ?>" title="<?php echo $image; ?>" />
                            </a>
                        </div>
                        <div class="card-info" style="padding-bottom:0px !important">
                            <div class="row">
                                <?php
                                if ($heading != '') {
                                ?>
                                    <!-- <h3 class="card-info-title bdr-bottom">
                                    <span class="bdr-bottom-gold"><?php echo $heading; ?></span>
                                </h3> -->
                                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-left no-padding "> -->
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 align-left no-padding ">
                                        <h5 class="card-info-title-2">
                                            <span class="p-name"><?php echo $heading; ?></span>
                                        </h5>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 align-right">
                                        <!-- <a class="pick-restra-btn fancybox" href="#weddings_destinations_available<?php echo $count; ?>">Book Now
                                        </a> -->
                                        <div class="exp-btn-box">
                                            <a href="#weddings_destinations_available<?php echo $count; ?>" class="book-now-a fancybox noMarginRight" tabindex="0">Explore</a>
                                        </div>
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
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-left no-padding ">
                                    <div class="exp-btn-box"> <a href="/special-offers/" class="explore-now-a" tabindex="0">Explore</a>
                                        <a href="javascript:;" onclick="open()" class="book-now-a noMarginRight" tabindex="0">Book now</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <?php if ($weddings_destinations_available) { ?>
                            <div id="weddings_destinations_available<?php echo $count; ?>" class="pop-up" style="display: none;">
                                <div class="form-header">
                                    <div class="itemss">
                                        <div class="page-title items-head">
                                            <p> <?php echo $heading; ?></p>
                                            <hr>
                                        </div>
                                        <div class="items-body">
                                            <?php
                                            foreach ($weddings_destinations_available as $destId) {
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
        jQuery(".owl-carousel-wed-offers")
            .owlCarousel({
                //stagePadding: 100,
                margin: 20,
                autoplay: !1,
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
                        items: 3
                    },
                }
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