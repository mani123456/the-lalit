<?php

/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>

<!-- scrooling to top-->

<a href="#" class="scrollup">
    <i class="ico-sprite sprite size-18 ico-gre-up-arrow"></i>
</a>

<?php
$class = '';
if (is_single()) {
    $class = "detail-page";
}
?>
<!-- Normal popup form -->
<div class="wbf-screen">
    <div class="wbf-container theme-peter-river">
        <div class="wbf-header">
            <div class="wbf-mainheader">Speak to Us</div>
            <div class="wbf-availability available">
                <div class="wbf-availability-icon"></div>
                <div class="wbf-availability-msg ">Available</div>
            </div>
            <div class="wbf-clear"></div>
        </div>
        <!--End wbf-header-->
        <div class="wbf-form">
            <div class="wbf-window">
                <div class="wbf-status">
                    <div class="wbf-message wbf-centered">Please select your country and enter your phone number</div>
                </div>
                <input type="phone" class="wbf-numberinput" size="15" name="mobile" id="mobile" placeholder="Enter Phone Number">
                <select class="wbf-input" id="location">
                    <option value="">Select</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Bekal">Bekal</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Goa">Goa</option>
                    <option value="Jaipur">Jaipur</option>
                    <option value="Khajuraho">Khajuraho</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Srinagar">Srinagar</option>
                    <option value="Udaipur">Udaipur</option>
                </select>
                <select class="wbf-input" id="services" style="display:none;"></select>
                <div class="wbf-privacy">
                    *We respect your privacy. Your Information is safe with us.
                </div>
                <div class="wbf-submit">
                    <input type="button" value="Talk to our guest relations" id="normalMakeCall">
                </div>
            </div>
            <div class="wbf-livestatus">
                <div class="wbf-livemsg-connecting">
                    Connecting now...
                </div>
                <div class="wbf-livemsg-connected">
                    Connection Established.
                </div>
                <div class="wbf-livemsg-verifying">
                    Please verify your number using the code below.
                    <div class="wbf-verificationcode">
                        11001
                    </div>
                </div>
                <div class="wbf-livemsg-verification-success">
                    Number verification successful
                </div>
                <div class="wbf-livemsg-verification-failed">
                    Number verification failed.
                </div>
                <div class="wbf-livemsg-in-progress">
                    Call in progress.
                </div>
                <div class="wbf-livemsg-completed">
                    Call Completed Successfully.
                </div>
                <div class="wbf-livemsg-ended">
                    Call ended.
                </div>
                <div class="wbf-livemsg-agent-busy">
                    Agent busy.
                </div>
                <div class="wbf-livemsg-oops">
                    Oops! Something went wrong.
                </div>
                <div class="wbf-livemsg-timer" id="timer">
                    00:00:00
                </div>
            </div>
        </div>
        <!--End wbf-form-->
        <div class="wbf-footer">
            <div class="wbf-poweredby"><img src="<?php echo get_stylesheet_directory_uri(); ?>/waybeolib/img/waybeo-horizontal.png"></div>
            <div class="wbf-close">Close</div>
            <div class="wbf-clear"></div>
        </div>
        <!--End wbf-footer-->
    </div>
    <!--End wbf-container-->
</div>
<!-- End Normal popup form -->
<footer class="footer <?php echo $class; ?>">
    <div class="container foot-top-sec">
        <div class="row">
            <div class="col col6" id="review_widget" style="display:none;">
                <?php
                if ($GLOBALS['review_widget']) {
                    echo $GLOBALS['review_widget'];
                }
                ?>
            </div><!-- col -->

            <div class="col col6">
                <div class="btn-block">
                    <div class="align-right lbl-block">
                        <?php
                        if ($GLOBALS['location'][0]->slug != 'london' && $GLOBALS['location'][0]->slug != 'mangar') {
                        ?>
                            <span class="label">Can we help you?</span>
                            <button type="button" class="btn secondary-btn clickme">Speak To Guest Relations</button>
                        <?php
                        }
                        ?>
                    </div><!-- col -->
                </div><!-- btn-block -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
    <div class="foot-body-sec">
        <div class="container">
            <div class="row">
                <?php
                $destination_obj = $GLOBALS['$destinations'];
                if ($destination_obj->have_posts()) :
                ?>
                    <div class="col col4">
                        <h6>The LaLiT Properties</h6>
                        <div class="row">
                            <ul class="col col6">
                                <?php
                                $i = 1;
                                while ($destination_obj->have_posts()) : $destination_obj->the_post();

                                    $name = get_post_meta($post->ID, 'name', true);
                                    $location = get_the_terms($post->ID, 'locations');
                                    $city_name = $location[0]->slug;
                                    $permalink = site_url() . '/the-lalit-' . $city_name . '/';
                                ?>
                                    <li>
                                        <a href="<?php echo $permalink; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a>
                                    </li>
                                    <?php
                                    if ($i % 7 == 0) {
                                    ?>
                            </ul>
                            <ul class="col col6">
                        <?php
                                    }
                                    $i++;

                                endwhile;
                        ?>
                            </ul><!-- col col6 -->
                        </div><!-- row -->
                    </div>
                    <!--col6-->
                <?php
                endif;
                wp_reset_postdata();
                ?>

                <div class="col col4">
                    <h6>The Lalit Suri Hospitality Group</h6>
                    <div class="row">
                        <ul class="col col6">
                            <li>
                                <a href="<?php echo site_url(); ?>/about-us/" title="About Us">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/management/" title="Management">Management</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/developing-destinations/" title="Developing Destinations">Developing Destinations</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/the-lalit-loyalty/" title="The Lalit Loyalty">The Lalit Loyalty</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/careers/" title="Careers">Careers</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/press-kit/" title="Press Kit">Press Kit</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/media-coverage/" title="Media Coverage">Media Coverage</a>
                            </li>
                        </ul>
                        <ul class="col col6">
                            <li>
                                <a href="<?php echo site_url(); ?>/press-releases/" title="Press Releases">Press Releases</a>
                            </li>
                            <li>
                                <a href="http://blog.thelalit.com" title="Blog" target="_blank">Blog</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/privacy-policy/" title="Privacy Policy">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/investors-relations/" title="Investor Relations">Investors Relations</a>
                            </li>
                            <li>
                                <?php
                                if ($GLOBALS['location'][0]->slug) {
                                ?>
                                    <a href="<?php echo site_url() . '/the-lalit-' . $GLOBALS['location'][0]->slug; ?>/contact-us/" title="Contact Us">Contact Us</a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?php echo site_url(); ?>/contact-us/" title="Contact Us">Contact Us</a>
                                <?php
                                }
                                ?>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/site-map/" title="site Map">Site Map</a>
                            </li>
                        </ul>
                    </div><!-- row -->
                </div>
                <!--col3-->

                <div class="col col4">
                    <div class="row">
                        <div class="col col6">
                            <div class="our-brands">
                                <h6>Our Brands</h6>
                                <ul>
                                    <li><a href="http://www.kittysu.com/" title="Kitty Su" target="_blank">Kitty Su</a></li>
                                    <li><a href="http://www.thebaluchi.com/" title="Baluchi" target="_blank">Baluchi</a></li>
                                    <li><a href="http://www.thelalitftc.com/" title="The Lalit Food Truck" target="_blank">The Lalit Food Truck Company</a></li>
                                    <li><a href="http://www.tlshs.com/" title="The Lalit Suri Hospitality School" target="_blank">The Lalit Suri Hospitality School</a></li>
                                </ul>
                            </div><!-- our-brands -->

                            <div class="contact-info">
                                <h6>Get in Touch</h6>
                                <address>
                                    <?php
                                    if ($GLOBALS['address']) {
                                    ?>
                                        <span><?php echo $GLOBALS['address']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['phone']) {
                                    ?>
                                        <span><?php echo 'T: ' . $GLOBALS['phone']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['fax']) {
                                    ?>
                                        <span><?php echo 'F: ' . $GLOBALS['fax']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['email']) {
                                    ?>
                                        <span><?php echo 'E: ' . $GLOBALS['email']; ?></span>
                                    <?php
                                    }
                                    if (!$GLOBALS['location']) {
                                    ?>
                                        <span>India Toll Free: 1800 11 77 11</span>
                                        <span>Telephone: +91 11 4444 7474</span>
                                    <?php
                                    }
                                    ?>
                                </address>
                                <!--address-->
                            </div>
                            <!--contact-info-->
                        </div><!-- col -->

                        <div class="col col6">
                            <div class="newsletter-info">
                                <h6>Newsletter Sign Up</h6>
                                <p>Sign up to our newsletter and stay up to date with offer and promotions across all The Lalit Hotels.</p>
                                <?php echo do_shortcode('[contact-form-7 id="5067" title="Subscription Form"]'); ?>
                                <div class="thank-you-response wpcf7-mail-sent-ok"></div>
                            </div><!-- newsletter-info -->
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- col col4 -->
            </div>
            <!--row-->
        </div><!-- container -->

        <div class="container foot-copyright-sec">
            <div class="row">

                <div class="col col6">
                    <div class="footer-info">
                        <p>&copy; The LaLiT <?php echo date('Y'); ?>, All rights reserved by Bharat Hotels Ltd.</p>
                    </div>
                </div><!-- col -->

                <div class="col col6 social-info-block">
                    <ul class="unstyled-listing social-info clearfix">
                        <li><strong class="lbl-find-us">Find us on</strong></li>
                        <?php
                        if ($GLOBALS['facebook']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['facebook']; ?>" title="Facebook" target="_blank"><i class="sprite ico-facebook"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($GLOBALS['twitter']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['twitter']; ?>" title="Twitter" target="_blank"><i class="sprite ico-twitter"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($GLOBALS['instagram']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['instagram']; ?>" title="Instagram" target="_blank"><i class="sprite ico-instagram"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($GLOBALS['google']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['google']; ?>" title="G Plus" target="_blank"><i class="sprite ico-g-plus"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($GLOBALS['linkedin']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['linkedin']; ?>" title="LinkedIn" target="_blank"><i class="sprite ico-linkedin"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li><a href="http://www.youtube.com/lalithotels" title="Youtube" target="_blank"><i class="sprite ico-youtube"></i></a></li>
                        <li><a href="http://blog.thelalit.com/" title="Blogger" target="_blank"><i class="sprite ico-blogger"></i></a></li>
                    </ul>
                    <!--unstyled-listing-->
                </div><!-- social-info-block -->
                <span class="foot-motif"></span>
            </div><!-- row -->
        </div>
        <!--container-->
    </div><!-- foot-body-sec -->

    <!-- Social sharing buttons -->
    <ul class="unstyled-listing icon-social" style="display:none;">
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" title="Facebook" target="_blank"><i class="sprite ico-facebook"></i></a>
        </li>
        <li>
            <a href="https://twitter.com/share?url=<?php echo 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>&via=TheLalitGroup&related=twitterapi%2Ctwitter ?>" title="Twitter" target="_blank" id="twitter"><i class="sprite ico-twitter"></i></a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url=<?php echo 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" title="Gogle plus" target="_blank"><i class="sprite ico-g-plus"></i></a>
        </li>
        <li>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'http://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" title="Linked In" target="_blank"><i class="sprite ico-linkedin"></i></a>
        </li>
    </ul><!-- icon-social -->
    <!-- Social sharing buttons -->
    <input type="hidden" id="global-location" value="<?php echo json_encode($GLOBALS['location'][0]->slug) ?>" />
</footer>
<!--Footer-->

<?php
if (isMobile()) {
?>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lalit-mobile.min.js?ver=1.1" defer="defer"></script>
<?php
} else {
?>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lalit.min.js?ver=1.1" defer="defer"></script>
<?php
}
?>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&amp;render=explicit" defer="defer"></script>

<!--  Google anaytics and adwords and digital marketing scripts -->
<?php
if (ENV == 'production') {
?>
    <!--  Adwords Script -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 1034065160;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js" defer="defer" async>
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1034065160/?guid=ON&amp;script=0" />
        </div>
    </noscript>
    <!--  End Adwords Script -->

    <!-- Digital Marketing script -->
    <script type="text/javascript" src="https://l2.io/ip.js?var=userip" defer="defer" async></script>
    <script type="text/javascript" src="http://www.4caster.net/websites_configs/thelalit.js" defer="defer"></script>
    <!-- End Digital Marketing script -->


    <!-- AFFILIRED MASTER TAG, PLEASE DON'T REMOVE -->
    <script type="text/javascript">
        (function() {
            var sc = document.createElement('script');
            sc.type = 'text/javascript';
            sc.async = true;
            sc.src = '//customs.affilired.com/track/?merchant=3895';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(sc, s);
        })();
    </script>
    <!-- END AFFILIRED MASTER TAG PLEASE DON'T REMOVE-->

    <?php get_template_part('includes/world', 'hotels-tracking-code'); ?>

<?php
}
?>
<!--  Google anaytics and adwords and digital marketing scripts -->