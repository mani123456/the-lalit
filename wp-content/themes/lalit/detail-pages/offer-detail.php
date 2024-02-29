<?php
$hotel_id = get_post_meta($post->ID, 'hotel', true);
$hotel_name = get_post_meta($hotel_id, 'name', true);

$GLOBALS['address'] = get_post_meta($hotel_id, "address", true);
$GLOBALS['email'] = get_post_meta($hotel_id, "email", true);
$GLOBALS['phone'] = get_post_meta($hotel_id, "phone", true);
$GLOBALS['fax'] = get_post_meta($hotel_id, "fax", true);
$GLOBALS['dining_object'] = get_post_meta($hotel_id, "dinings", true);

$GLOBALS['offer_image'] = array();

$GLOBALS['review_widget'] = get_post_meta($hotel_id, "review_widget", true);


$offer_name = get_post_meta($post->ID, "name", true);
$offer_description = wpautop(get_post_meta($post->ID, 'description', true));
$offer_terms_and_conditions = wpautop(get_post_meta($post->ID, 'terms_conditions', true));
$offer_inclusions = wpautop(get_post_meta($post->ID, 'inclusions', true));
$offer_price = get_post_meta($post->ID, 'offer_price', true);
$offer_image_ids = get_post_meta($post->ID, "image", true);

if (strpos($offer_image_ids, ',')) {
    $offer_image_ids = explode(',', $offer_image_ids);
    $offer_image = wp_get_attachment_url($offer_image_ids[0]);
} else {
    $offer_image = wp_get_attachment_url($offer_image_ids);
}

$current_offer_id = $post->ID;
$current_city_offers = get_offers_by_destination('hotel', $hotel_id);
$city_offers_array = array();
if ($current_city_offers->have_posts()) {
    $count = 0;
    while ($current_city_offers->have_posts()) {
        $current_city_offers->the_post();
        $offer_id = $post->ID;
        $city_offers_array[$count]['id'] = $offer_id;
        $city_offers_array[$count]['permalink'] = get_permalink($offer_id);
        if ($offer_id == $current_offer_id) {
            $city_offers_array[$count]['current'] = 'true';
        } else {
            $city_offers_array[$count]['current'] = 'false';
        }

        $count++;
    }
}
wp_reset_postdata();
$current_key = array_search($post->ID, array_column($city_offers_array, 'id'));
?>

<style type="text/css">
    .ui-datepicker-trigger {
        display: none;
    }
</style>
<div class="content-section">

    <div class="container offer-details h-product">
        <div class="row">
            <div class="detail-breadcrumb-container">
                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/"><?php echo $hotel_name; ?></a>
                <span class="breadcrumb-separator"></span>
                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers/">Offers</a>
                <span class="breadcrumb-separator"></span>
                <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $offer_name; ?></a>
            </div>

            <?php if (trim($offer_name) != '') { ?>
                <h2 class="sec-title p-name"><?php echo $offer_name; ?></h2>
            <?php } ?>
        </div>
    </div>


    <div class="container offer-inner">
        <div class="row">
            <div class="col col5">
                <?php if (trim($offer_description) != '') {
                ?>
                    <p class="marB20"><?php echo $offer_description; ?></p>
                <?php
                }
                ?>

                <?php
                if (trim($offer_inclusions) != '') {
                ?>
                    <div class="sub-section">
                        <h4 class="item-title">Inclusions</h4>
                        <?php echo $offer_inclusions; ?>
                    </div><!-- sub-section -->
                <?php
                }
                ?>

                <?php
                if (trim($offer_terms_and_conditions) != '') {
                ?>
                    <div class="sub-section">
                        <h4 class="item-title">Terms &amp; Conditions</h4>
                        <?php echo $offer_terms_and_conditions; ?>
                    </div><!-- sub-section -->
                <?php
                }
                ?>

                <?php
                if ($GLOBALS['location'][0]->slug != '' && trim($hotel_name) != '') {
                ?>
                    <!-- <a href="<?php echo get_home_url() . '/the-lalit-' . $GLOBALS['location'][0]->slug . '/offers/'; ?>" class="text-link offer-text-link">View all offers at <?php echo $hotel_name; ?> <i class="ico-sprite sprite ico-red-right-arrow"></i></a> -->
                <?php
                }
                ?>
            </div><!-- col -->
            <div class="col col7">
                <?php
                if ($offer_image != '') {
                    array_push($GLOBALS['offer_image'], $offer_image);
                ?>
                    <div id="slider" class="flexslider slider offer-image">
                        <ul class="slides">
                            <li>
                                <img src="" alt="<?php echo $offer_name; ?>" title="<?php echo $offer_name; ?>" />
                            </li>
                        </ul>
                    </div><!-- slider -->
                <?php
                }
                if (trim($offer_price) != '') {
                ?>
                    <div class="btn-block offer-starting-price-container">
                        <div class="row">
                            <div class="col col6 align-right lbl-block offer-starting-price">
                                <span class="label">Offer Starting at</span>
                                <strong class="label offer-detail-price-show"><span class="woocommerce-Price-currencySymbol">₹</span><?php echo $offer_price; ?></strong>
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- btn-block -->
                <?php
                }
                ?>
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
    <div class="container offer-details-arrows">
        <div class="row">
            <?php
            if ($city_offers_array[$current_key - 1]['permalink']) {
            ?>
                <div class="prev-arrow-container">
                    <a class="offer-arrows offer-prev btn tertiary-btn" href="<?php echo $city_offers_array[$current_key - 1]['permalink']; ?>"><i class="ico-sprite sprite ico-offer-left-arrow"></i></i><span class="offer-text prev-offer-text">Previous Offer</a>
                </div>
            <?php
            }
            ?>

            <?php
            if ($city_offers_array[$current_key + 1]['permalink']) {
            ?>
                <div class="next-arrow-container">
                    <a class="offer-arrows offer-next btn tertiary-btn" href="<?php echo $city_offers_array[$current_key + 1]['permalink']; ?>"><span class="offer-text next-offer-text">Next Offer</span><i class="ico-sprite sprite ico-offer-right-arrow"></i></a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div><!-- content-section -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div id="book-a-table" class="pop-up" style="display: none;">

    <div class="form-header">
        <h2 class="page-title">
            <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
            <?php echo $GLOBALS['form_dining_name']; ?>
        </h2>
        <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
    </div>
    <?php
    echo do_shortcode('[contact-form-7 id="3370" title="Dining Form"]');
    ?>

    <div class="thank-you-block" style="display:none;">
        <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
        <h2 class="sec-title align-center">Request Sent</h2>
        <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
    </div><!-- thank-you-block -->

</div><!-- pop-up -->

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
                afterClose: function() {
                    jQuery("body").removeClass("overlay-on overlay-fixed");
                },
                afterShow: function() {
                    jQuery(".date-field").focus();
                },
                beforeClose: function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                beforeShow: function() {
                    jQuery("body").addClass("overlay-fixed");
                }
            });
        });

        jQuery(".mob-view").on("click", function() {
            jQuery(this).next().slideToggle(400);
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
                afterClose: function() {
                    jQuery("body").removeClass("overlay-on overlay-fixed");
                },
                afterShow: function() {
                    jQuery(".date-field").focus();
                },
                beforeClose: function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                beforeShow: function() {
                    jQuery("body").addClass("overlay-fixed");
                }
            });
        });
    </script>
<?php
}
?>

<script type="text/javascript">
    var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
    jQuery(document).ready(function() {

        var dateFormat = "dd M yy";
        var dateFormat = "dd M yy";
        var currentyear = new Date().getFullYear();
        var nextYear = new Date().getFullYear() + 1;
        var yearRange = currentyear + ":" + nextYear;

        $(".date-field").datepicker({
            dateFormat: dateFormat,
            yearRange: yearRange,
            changeMonth: false,
            numberOfMonths: 1,
            showOn: "button",
            buttonImageOnly: true,
            showButtonPanel: true,
            closeText: "Close",
            dayNamesShort: ["S", "M", "T", "W", "T", "F", "S"],
            dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
            onClose: function() {
                jQuery('.date-field').focus();
            }
        });
        var currentDate = new Date();
        jQuery(".date-field").datepicker("setDate", currentDate);
        jQuery(".date-field").datepicker('option', 'minDate', currentDate);
        jQuery('.date-field').on('click', function() {

            jQuery('.date-field').datepicker('show');
        });

        jQuery(".reserve-btn").on("click", function() {

            jQuery(".thank-you-block").fadeOut();
            jQuery(".wpcf7, .form-header").fadeIn();

            jQuery("#book-a-table").find(".wpcf7-response-output").remove();

            jQuery("#book-a-table").find(".wpcf7-not-valid-tip").remove();
            jQuery("#book-a-table").find(".wpcf7-response-output").html("");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
            jQuery("#book-a-table").find(".input-text").val("");

            var currentDate = new Date();
            jQuery("#book-a-table").find(".date-field").datepicker("setDate", currentDate);
            jQuery("#book-a-table").find(".date-field").datepicker('option', 'minDate', currentDate);

            jQuery("body").addClass("overlay-on");

        });


        jQuery(".content-section").find("img.image").each(function(index) {
            jQuery(this).attr("src", image_array[index]);
        });

    });

    /*function successfull_form_submission()
    {    
        jQuery("#book-a-table").find(".wpcf7, .form-header").fadeOut(function() {
            jQuery("#book-a-table").find(".thank-you-block").fadeIn();
            jQuery.fancybox.update();

            setTimeout(function() {
              jQuery.fancybox.close();
              jQuery("body").removeClass("overlay-on");
            }, 5000);
        });
    }*/
    document.addEventListener('wpcf7mailsent', function(event) {
        console.log(event);
        if ('3370' == event.detail.contactFormId) {
            jQuery("#book-a-table").find(".wpcf7, .form-header").fadeOut(function() {
                jQuery("#book-a-table").find(".thank-you-block").fadeIn();
                jQuery.fancybox.update();

                setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                }, 5000);
            });
        }
    }, false);

    jQuery('.card-info a').click(function() {
        jQuery(this).parent('.card-info').toggleClass('expand');
    });

    jQuery(".read_more").on("click", function() {
        jQuery(this).closest(".card-info").find(".trunc").hide();
        jQuery(this).closest(".card-info").find(".untrunc").show();
    });

    jQuery(".read_less").on("click", function() {
        jQuery(this).closest(".card-info").find(".untrunc").hide();
        jQuery(this).closest(".card-info").find(".trunc").show();
    });

    jQuery(window).scroll(function() {
        var fixSidebar = jQuery('.primary-nav').innerHeight();
        var contentHeight = jQuery('.sidebar-rcol').innerHeight();
        var sidebarHeight = jQuery('.sidebar-outer').height();
        var sidebarBottomPos = contentHeight - sidebarHeight;
        var trigger = jQuery(window).scrollTop() - fixSidebar;

        if (jQuery(window).scrollTop() >= fixSidebar) {
            //$('.side-navigation').addClass('fixed-sidebar');
        } else {
            jQuery('.sidebar-outer').removeClass('fixed-sidebar');
        }

        if (trigger >= sidebarBottomPos - 40) {
            jQuery('.sidebar-outer').addClass('sidebar-bottom');
        } else {
            jQuery('.sidebar-outer').removeClass('sidebar-bottom');
        }
    });

    jQuery(window).load(function() {

        var url_string = window.location.href;
        var url = new URL(url_string);
        var booking = url.searchParams.get("booking");
        if (booking) {

            jQuery('.btn.secondary-btn.reserve-btn').trigger('click');
        }
    });
</script>