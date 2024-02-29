<?php
                    $destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
                    $city_name = $GLOBALS['location'][0]->slug;
$experience_id = $post->ID;

$experience_name = get_post_meta($experience_id, 'name', true);
$start_time = get_post_meta($experience_id, 'start_time', true);
$duration = get_post_meta($experience_id, 'duration', true);
$stops = get_post_meta($experience_id, 'number_of_stops', true);
$price_single = get_post_meta($experience_id, 'single_price', true);
$price_couple = get_post_meta($experience_id, 'couple_price', true);

$curr = $GLOBALS['curr'];
?>
<div class="content-section" id="exp_details">

    <div class="package-popup bg-popup">
        <div class="packages-bg-sec">

            <div class="package-head-sec">
                <div class="container">
                    <div class="row">
                        <div class="col col12 align-content-center">
                            <small class="align-center">Tour Experience</small>
                            <?php
                            if ($experience_name != '') {
                            ?>
                                <h2 class="sec-title align-center uppercase"><?php echo $experience_name; ?></h2>
                            <?php
                            }
                            ?>

                            <ul class="unstyled-listing meta-block clearfix marB20">
                                <?php
                                if ($start_time != '') {
                                ?>
                                    <li class="span">
                                        <span class="meta-label uppercase">Start:</span>
                                        <span class="meta-value"><?php echo $start_time; ?></span>
                                    </li>
                                <?php
                                }
                                ?>

                                <?php
                                if ($duration != '') {
                                ?>
                                    <li class="span">
                                        <span class="meta-label uppercase">Duration:</span>
                                        <span class="meta-value"><?php echo $duration; ?></span>
                                    </li>
                                <?php
                                }
                                ?>

                                <?php
                                if ($stops != '') {
                                ?>
                                    <li class="span">
                                        <span class="meta-label uppercase">Route:</span>
                                        <span class="meta-value"><?php echo $stops; ?></span>
                                    </li>
                                <?php
                                }
                                ?>

                                <?php
                                if ($price_single != '' || $price_couple != '') {
                                ?>
                                    <li class="span">
                                        <span class="meta-label uppercase">Price:</span>
                                        <?php
                                        if ($price_single != '') {
                                        ?>
                                            <span class="meta-value"><?php echo $curr; ?> <?php echo $price_single; ?></span>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($price_couple != '') {
                                        ?>
                                            <span class="meta-value"><?php echo $curr; ?> <?php echo $price_couple; ?></span>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <!--unstyled-listing-->
                            <span class="down-arrow-img">&nbsp;</span>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->
            </div>
            <!--package-head-sec-->

            <?php
            $inclusions = get_post_meta($experience_id, 'slider_images', true);

            if ($inclusions) {

                if (isMobile()) {
            ?>
                    <small class="slider-inclusions-text">Tour Inclusions</small>
                <?php
                }
                ?>
                <div id="banner-slider" class="flexslider large-banner-sec">
                    <?php
                    if (!isMobile()) {
                    ?>
                        <small class="slider-inclusions-text">Tour Inclusions</small>
                    <?php
                    }
                    ?>
                    <ul class="slides align-center">
                        <?php
                        $c = 1;
                        foreach ($inclusions as $inclusion) {
                            $inclusion_title = $inclusion['inclusion_title'];
                            if (isMobile()) {
                                $inclusion_image = wp_get_attachment_image_src($inclusion['image']['id'], 'detail_page_image')[0];
                            } else {
                                $inclusion_image = $inclusion['image']['url'];
                            }
                            $inclusion_description = $inclusion['inclusion_description'];
                            /* <h2 class="sec-title align-center uppercase"><?php echo $c; ?>. <?php echo $inclusion_title; ?></h2> */
                        ?>
                            <li class="large-banner-sec" style="background: url('<?php echo $inclusion_image; ?>') no-repeat left top;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col12 align-content-center slidr-content">
                                            <h2 class="sec-title align-center uppercase"><?php echo $inclusion_title; ?></h2>
                                            <p><?php echo $inclusion_description; ?></p>
                                        </div><!-- col -->
                                    </div><!-- row -->
                                </div><!-- container -->
                            </li>
                        <?php
                            $c++;
                        }
                        ?>
                    </ul><!-- slides -->
                </div><!-- flexslider -->

            <?php
            }
            ?>
            <div class="package-foot-sec">
                <div class="container">
                    <div class="row">
                        <div class="col col8 align-content-center align-center">
                            <?php
                            $good_to_know = get_post_meta($experience_id, 'good_to_know', true);
                            if ($good_to_know) {
                            ?>
                                <small><i class="ico-sprite sprite size-24 ico-white-info"></i>Good to Know</small>
                                <p><?php echo $good_to_know; ?></p>
                            <?php
                            }
                            ?>
                            <?php if ($city_name != 'london') : ?>
                                <a href="#pkg-enquiry-form" class="btn primary-btn book_package" title="Contact our concierge uppercase">Book this Experience</a>
                            <?php endif; ?>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->
            </div><!-- package-foot-sec -->

        </div><!-- packages-bg-sec -->
        <?php if ($city_name != 'london') : ?>                        
        <div id="pkg-enquiry-form" class="container white-bg packages-enquiry-form" style="display: block;">
            <div class="row">
                <div class="col col8 align-content-center">

                    <div class="form-header">
                        <h3 class="item-title">Book this Experience</h3>
                        <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
                    </div>
                    <!--form-header-->

                    <?php
                    $exp_subject = 'Enquiry for Experience -' . ucfirst($GLOBALS['location_slug']) . ' ' . $experience_name . ' - ' . $GLOBALS['form_location'];
                    $exp_name = $experience_name;
                    $GLOBALS['exp_subject'] = $exp_subject;
                    $GLOBALS['exp_name'] = $exp_name;

                    echo do_shortcode('[contact-form-7 id="1963" title="Experience"]');
                    ?>

                    <div class="thank-you-block" style="display:none;">
                        <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                        <h2 class="sec-title align-center">Request Sent</h2>
                        <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
                    </div><!-- thank-you-block -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
        <?php endif; ?>    
    </div><!-- popup -->
</div><!-- content-section -->0