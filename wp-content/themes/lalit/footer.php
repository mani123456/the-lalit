<?php

/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */

//wp_footer();
?>

<!-- scrooling to top-->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DW2X4B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M5J8TVK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


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
    <div class="container foot-top-sec" style="margin-top:60px; display:none;">
        <div class="row">
            <div class="col <?php if (isMobile()) { ?>col12<?php } else { ?>col6<?php } ?>" id="review_widget" style="display:none;">
                <div>
                    <?php
                    if ($GLOBALS['review_widget']) {
                        echo $GLOBALS['review_widget'];
                    }
                    ?>
                </div>
            </div><!-- col -->

            <div class="col <?php if (isMobile()) { ?>col12<?php } else { ?>col6<?php } ?>" style="display:none;">
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
    <?php if (isMobile()) {
    ?>
        <div class="wrap-collabsible"> <input id="collapsible3" name="footer-checkbox" class="toggle" type="checkbox">
            <label for="collapsible3" class="lbl-toggle" tabindex="0">Footer Section</label>
        </div>
    <?php } ?>

    <div class="foot-body-sec hidden" id="footer_body">
        <div class="container">
            <div class="row">
                <?php
                $destination_obj = $GLOBALS['$destinations'];
                if (!$destination_obj->have_posts()) :
                ?>
                    <div class="col col4">
                        <h6>The LaLiT Properties</h6>
                        <div class="row">
                            <ul class="col col6 h-card">
                                <?php
                                $i = 1;
                                while ($destination_obj->have_posts()) : $destination_obj->the_post();

                                    $name = get_post_meta($post->ID, 'name', true);
                                    $location = get_the_terms($post->ID, 'locations');
                                    $city_name = $location[0]->slug;
                                    $permalink = site_url() . '/the-lalit-' . $city_name . '/';
                                ?>
                                    <?php
                                    /* if ($city_name != 'london') { */
                                    ?>
                                    <li>
                                        <a class="p-name u-url" href="<?php echo $permalink; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a>
                                    </li>
                                    <?php
                                    if ($i % 7 == 0) {
                                    ?>
                            </ul>
                            <ul class="col col6 h-card">
                        <?php
                                    }
                                    $i++;

                                endwhile;
                        ?>
                        <!--<li>
                                        <a class="p-name u-url" href="/" title="The Lalit Group">The Lalit Group</a>
                                    </li>-->
                            </ul><!-- col col6 -->
                        </div><!-- row -->
                    </div>
                    <!--col6-->
                <?php
                endif;
                wp_reset_postdata();
                ?>

                <div class="col col5">
                    <h6>The Lalit Suri Hospitality Group</h6>
                    <div class="row">
                        <ul class="col col6">
                            <li>
                                <a href="<?php echo site_url(); ?>/about-us/" title="About Us">About Us</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/management/" title="Management">Management</a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo site_url(); ?>/the-lalit-loyalty/" title="The Lalit Loyalty">The Lalit Loyalty</a>
                            </li> -->
                            <li>
                                <a href="<?php echo site_url(); ?>/careers/" title="Careers">Careers</a>
                            </li>
                            <!-- <li>
                                <a href="<?php echo site_url(); ?>/press-kit/" title="Press Kit">Press Kit</a>
                            </li> -->
                            <!-- <li>
                                <a href="<?php echo site_url(); ?>/media-coverage/" title="Media Coverage">Media Coverage</a>
                            </li> -->
                            <!-- <li>
                                <a href="<?php echo site_url(); ?>/wp-content/uploads/2019/07/Published-Rates.pdf" target="_blank">Published Rates</a>
                            </li> -->
                            <?php
                            $args = array(
                                'post_type' => 'the-lalit-insight',
                                'post_status' => 'publish',
                                'posts_per_page' => '-1',
                            );

                            $loop = new WP_Query($args);
                            if ($loop->post_count > 0) {
                            ?>
                                <li>
                                    <a href="<?php echo site_url(); ?>/the-lalit-insights/">The Lalit Insights</a>
                                </li>
                            <?php
                            }
                            wp_reset_postdata();
                            ?>
                            <li>
                                <a href="<?php echo site_url(); ?>/awards/" title="Awards">Awards</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/wp-content/uploads/2021/09/The-LaLiT-Published-Rates-2020-All-Units.pdf" title="Published Rates">Published Rates</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/investors-relations/" title="Investor Relations">Investor Relations</a>
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
                        </ul>
                        <ul class="col col6">
                            <!-- <li>
                                <a href="<?php echo site_url(); ?>/press-releases/" title="Press Releases">Press Releases</a>
                            </li> -->

                            <!-- <li>
                                <a href="http://blog.thelalit.com" title="Blog" target="_blank">Blog</a>
                            </li> -->
                            <li>
                                <a href="<?php echo site_url(); ?>/we-care-thelalit/" title="We Care">We Care</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/wp-content/uploads/2021/09/Developing-destination-for-website.pdf" title="Developing Destinations">Developing Destinations</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/#" title="Disha">Disha</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/sitemap/" title="site Map">Site Map</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url(); ?>/privacy-policy/" title="Privacy Policy">Privacy Policy</a>
                            </li>
                            <li><a class="p-name u-url" href="http://www.kittysu.com/" title="Kitty Su" target="_blank">Kitty Su</a></li>
                            <li><a class="p-name u-url" href="http://www.tlshs.com/" title="The Lalit Suri Hospitality School" target="_blank">The Lalit Suri Hospitality School</a></li>
                        </ul>
                    </div><!-- row -->
                </div>
                <!--col3-->
                <div class="col col3">
                    <div class="row">
                        <!-- <div class="col col6">
                            <div class="our-brands">
                                <h6>Our Brands</h6>
                                <div class="row">
                                    <ul class="h-card">
                                        <li><a class="p-name u-url" href="http://www.kittysu.com/" title="Kitty Su" target="_blank">Kitty Su</a></li>
                                        <li><a class="p-name u-url" href="http://www.thebaluchi.com/" title="Baluchi" target="_blank">Baluchi</a></li>
                                    <li><a class="p-name u-url" href="http://www.thelalitoko.com/" title="OKO" target="_blank">OKO</a></li>
                                     <li><a class="p-name u-url" href="http://www.thelalitftc.com/" title="The Lalit Food Truck" target="_blank">The Lalit Food Truck Company</a></li> 
                                        <li><a class="p-name u-url" href="http://www.tlshs.com/" title="The Lalit Suri Hospitality School" target="_blank">The Lalit Suri Hospitality School</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                        <div class="col col12">
                            <!--
                                <div class="our-brands">
                                <h6>Learn With The Lalit</h6>
                                <ul class="h-card">
                                    <li>
                                        <a href="<?php echo $GLOBALS['$eLearning-url']; ?>" title="E-Learning">eLearning</a>
                                    </li>
                                </ul>
                            </div>
                            -->
                            <!-- our-brands -->
                            <div class="our-brands">
                                <h6>Managed By The LaLiT</h6>
                                <ul class="h-card">
                                    <li>
                                        <a href="<?php echo site_url(); ?>/the-lalit-london" title="The Lalit London">The LaLiT London</a>
                                    </li>
                                </ul>
                            </div><!-- our-brands -->
                        </div>
                    </div>
                </div>

                <div class="col col4">
                    <div class="row">
                        <div class="col col6">
                            <div class="contact-info h-card">
                                <h6>Get in Touch</h6>
                                <address>
                                    <?php
                                    if ($GLOBALS['address']) {
                                    ?>
                                        <span class="p-adr"><?php echo $GLOBALS['address']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['phone']) {
                                    ?>
                                        <span class="p-tel"><?php echo 'T: ' . $GLOBALS['phone']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['fax']) {
                                    ?>
                                        <span class="p-tel"><?php echo 'F: ' . $GLOBALS['fax']; ?></span>
                                    <?php
                                    }
                                    if ($GLOBALS['email']) {
                                    ?>
                                        <span class="u-email"><?php echo 'E: ' . $GLOBALS['email']; ?></span>
                                    <?php
                                    }
                                    if (!$GLOBALS['location']) {
                                    ?>
                                        <span>India Toll Free: <span class="p-tel">1800 11 77 11</span></span>
                                        <span>Telephone: <span class="p-tel">+91 11 4444 7474</span></span>
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
                                <h6>Subscribe to our Newsletter</h6>
                                <p>Be the first to receive exclusive offers and the latest news across all The LaLit Hotels, Palaces & Resorts directly in your inbox.</p>
                                <?php //echo do_shortcode('[contact-form-7 id="5067" title="Subscription Form"]'); 
                                ?>
                                <!-- <div class="thank-you-response wpcf7-mail-sent-ok"></div> -->
                                <input type="email" class="sign-up-email" placeholder="Email Address">
                                <div class="btn-block newsletter-block">
                                    <a href="#subscribe-pop-up" class="btn primary-btn contact-btn fancybox" title="Subscription Form">Sign Up</a>
                                </div><!-- btn-block -->

                                <div id="subscribe-pop-up" class="pop-up sign-up-pop-up" style="display: none;">
                                    <div class="form-header">
                                        <h2 class="page-title">
                                            Sign Up
                                        </h2>
                                    </div>
									 <?php
									  
                                      if ($GLOBALS['location'][0]->slug == 'london') {  
                                    ?>
                                    <?php echo do_shortcode('[contact-form-7 id="261515" title="Subscription London Only"]'); ?>
									<?php } else { ?>
									 <?php 
									 echo do_shortcode('[contact-form-7 id="5067" title="Subscription Form"]'); 
								    	}
									 ?>
                                    <div class="thank-you-sec thank-you-section subscription-form-response" style="display:none;">
                                        <div class="row">
                                            <div class="thank-you-block align-content-center not-found">
                                                <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                                                <h2 class="sec-title align-center">Thank You</h2>
                                                <h4 class="intro-sec-title align-center name-section"></h4>
                                                <div class="office-details">
                                                    <div class="align-content-center">
                                                        <p class="intro-text align-center">We care for our Guests like no other<br /> and will be back to you very soon. In the meantime, stay tuned!</p>
                                                        <h4 class="intro-sec-title align-center">Traditionally Modern, Subtly Luxurious, Distinctly LaLiT</h4>
                                                    </div><!-- align-content-center -->
                                                </div><!-- office-details -->
                                                <div class="link-block align-center">
                                                    <a href="<?php echo site_url(); ?>/find-a-hotel/" class="text-link small-size-link uppercase" title="Find a Hotel"> Find a Hotel</a>
                                                </div><!-- link-block -->
                                                <div class="motif-img"><img src="/wp-content/themes/lalit/images/404-motif.png" alt=""></div><!-- motif-img -->
                                            </div><!-- thank-you-block -->
                                        </div><!-- row -->
                                    </div><!-- thank-you-sec -->
                                </div><!-- pop-up -->
                                <script type="text/javascript">
                                    document.addEventListener('wpcf7mailsent', function(event) {
                                        console.log(event);
                                        if ('5067' == event.detail.contactFormId) {
                                            /*console.log(123);
                                            jQuery('.newsletter-info').find('form').find('p').fadeOut();
                                            jQuery('.newsletter-info').find('p').fadeOut();
                                            setTimeout(function(){
                                                console.log(963);
                                                jQuery('.thank-you-response').html('Thank You!<br>You have been subscribed.');
                                                jQuery('.thank-you-response').fadeIn();

                                            },500);*/

                                            jQuery('.name-section').text("for your subscription request " + jQuery('#salutation').val() + ". " + jQuery('#first-name').val() + " " + jQuery('#last-name').val());
                                            jQuery('#subscribe-pop-up').find('form').fadeOut();
                                            jQuery(".form-header").fadeOut(function() {
                                                jQuery(".thank-you-section").fadeIn();
                                                jQuery.fancybox.update();

                                                setTimeout(function() {
                                                    jQuery.fancybox.close();
                                                }, 15000);
                                            });
                                        }
                                    }, false);
                                </script>
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
                        <li class="socialLinkHeader"><strong class="lbl-find-us">Find us on</strong></li>
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
                        if ($GLOBALS['linkedin']) {
                        ?>
                            <li>
                                <a href="<?php echo $GLOBALS['linkedin']; ?>" title="LinkedIn" target="_blank"><i class="sprite ico-linkedin"></i></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li><a href="https://www.youtube.com/lalithotels" title="Youtube" target="_blank"><i class="sprite ico-youtube"></i></a></li>
                        <li><a href="http://blog.thelalit.com/" title="Blogger" target="_blank"><i class="sprite ico-blogger"></i></a></li>
                    </ul>
                    <!--unstyled-listing-->
                </div><!-- social-info-block -->
                <span class="foot-motif"></span>
            </div><!-- row -->
        </div>
        <!--container-->
    </div><!-- foot-body-sec -->

    <?php
    $cls = '';
    global $post;
    if (is_cart() || is_checkout() || is_account_page() || $post->post_name == 'terms-conditions') {
        $cls = "hide";
    }
    ?>
    <?php if (!$GLOBALS['home-content-hide-flag']) : ?>
        <!-- Social sharing buttons -->
        <ul class="unstyled-listing icon-social <?php echo $cls; ?>" style="display:none;">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'https://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" title="Facebook" target="_blank"><i class="sprite ico-facebook"></i></a>
            </li>
            <li>
                <a href="https://twitter.com/share?url=<?php echo 'https://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>&via=TheLalitGroup&related=twitterapi%2Ctwitter ?>" title="Twitter" target="_blank" id="twitter"><i class="sprite ico-twitter"></i></a>
            </li>
            <li>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'https://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" title="Linked In" target="_blank"><i class="sprite ico-linkedin"></i></a>
            </li>
        </ul>
    <?php endif; ?>
    <!-- icon-social -->
    <!-- Social sharing buttons -->
    <input type="hidden" id="global-location" value="<?php echo ucwords($GLOBALS['location'][0]->slug); ?>" />
</footer>
<!--Footer-->
<script src='https://www.google.com/recaptcha/api.js?render=6LdfgYYUAAAAACjZEHGLbwLUx1eV0B_wpMlsQsRc'></script>
<script src="https://onboard.triptease.io/bootstrap.js?integrationId=01D5BMNJAWT51AA7FNWNPCAMZF" defer async crossorigin="anonymous" type="text/javascript"></script>
<?php

if (isMobile()) {
?>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lalit-mobile.min.js?ver=1.5"></script>
<?php
} else {
?>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/lalit.min.js?ver=1.5"></script>
<?php
}
?>
<script>
    jQuery(function() {
        jQuery('input[type="checkbox"][name="footer-checkbox"]').on('change', function() {
            jQuery("#footer_body").toggle("slide", {
                direction: "up"
            }, 1000);
        });
    });
</script>


<!-- Woocommerce scripts starts here -->
<?php
//include_once('includes/woocommerce-scripts.php');

wp_footer();
if (is_product()) {
?>
    <script type="text/javascript">
        jQuery(window).load(function() {

            var displayCartButton = setInterval(function() {
                var cartCount = parseInt(jQuery('span.cart-no:visible').text());
                var text = 'There ';
                if (cartCount > 0) {

                    if (cartCount > 1) {
                        text += 'are ';
                    } else {
                        text += 'is ';
                    }
                    text += cartCount;
                    if (cartCount > 1) {
                        text += ' items ';
                    } else {
                        text += ' item ';
                    }
                    text += 'in your cart';
                    jQuery('div.product-view-cart-container p.view-cart-count-description').text(text)
                    jQuery('div.product-view-cart-container').removeClass('hide');
                }
                clearInterval(displayCartButton);
            }, 150)

        });
    </script>
<?php
}
?>
<!-- Woocommerce scripts ends here -->

<!--  Google anaytics and adwords and digital marketing scripts -->
<?php
if (ENV == 'production') {
?>
    <!-- google recaptcha -->
    <!-- <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&amp;render=explicit" async></script> -->
    <!-- <script src='https://www.google.com/recaptcha/api.js?render=6LdfgYYUAAAAACjZEHGLbwLUx1eV0B_wpMlsQsRc'></script> -->
    <!-- google recaptcha -->

    <!--  Adwords Script -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 1034065160;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js" async>
    </script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1034065160/?guid=ON&amp;script=0" />
        </div>
    </noscript>
    <!--  End Adwords Script -->





    <?php get_template_part('includes/world', 'hotels-tracking-code'); ?>

<?php
}
?>
<!--  Google anaytics and adwords and digital marketing scripts -->

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
                'afterShow': function() {
                    jQuery('body').addClass('overlay-fixed');
                    jQuery("#salutation").trigger('focus');
                },
                'beforeShow': function() {
                    jQuery('.sign-up-pop-up .wpcf7-email').val(jQuery('.sign-up-email').val());
                },
                'beforeClose': function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                'afterClose': function() {
                    jQuery('body').removeClass('overlay-fixed');
                    jQuery(this).find('.cf7-custom-message').remove();
                    jQuery.fancybox.update();
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
                width: "605px",
                height: "auto",
                helpers: {
                    overlay: {
                        locked: true
                    }
                },
                'afterShow': function() {
                    jQuery('body').addClass('overlay-fixed');
                    jQuery("#salutation").trigger('focus');
                },
                'beforeShow': function() {
                    jQuery('.sign-up-pop-up .wpcf7-email').val(jQuery('.sign-up-email').val());
                },
                'beforeClose': function() {
                    jQuery('.fancybox-opened form').trigger('reset');
                },
                'afterClose': function() {
                    jQuery('body').removeClass('overlay-fixed');
                    jQuery(this).find('.cf7-custom-message').remove();
                    jQuery.fancybox.update();
                }
            });
        });
    </script>
<?php
}
?>
<script type="text/javascript">
    jQuery('.contact-btn').on('click', function() {

        jQuery(".subscription-form-response").fadeOut();
        jQuery('#subscribe-pop-up').find('form').fadeIn();
        jQuery(".form-header").fadeIn(function() {
            jQuery('.fancybox-title.fancybox-title-float-wrap').hide();
        });


        jQuery('div.wpcf7-response-output').remove();
        jQuery('.fancybox-title.fancybox-title-float-wrap').hide();

        jQuery("#subscribe-pop-up").find(".wpcf7-response-output").remove();

        jQuery("#subscribe-pop-up").find(".wpcf7-not-valid-tip").remove();
        jQuery("#subscribe-pop-up").find(".wpcf7-response-output").html("");
        jQuery("#subscribe-pop-up").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
        jQuery("#subscribe-pop-up").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
        jQuery("#subscribe-pop-up").find(".input-text").val("");

        jQuery("#subscribe-pop-up").find('.wpcf7-validation-errors,.fancybox-title').remove();
        //jQuery("#subscribe-pop-up").find('.ajax-loader').remove();

    });
</script>

<script type="text/javascript">
    /********* Displaying messages on contact form submission starts here *********/
    jQuery(document).ready(function() {
        jQuery('.wpcf7-form .wpcf7-submit').on('click', function() {

            jQuery(this).closest('.form-row').append('<span class="cf7-custom-message recaptcha-validation-message">Validating reCAPTCHA…</span>');
        });

        document.addEventListener('wpcf7spam', function(event) {

            jQuery('.cf7-custom-message').text('Oops! Something broke. Please try again.');
        }, false);
    });
    /********* Displaying messages on contact form submission ends here *********/
</script>

<?php

if ($GLOBALS['location'][0]->slug == 'london') {

?>
    <script>
        (function(a, b) {
            var c = a.createElement("script");
            c.src = "https://onboard.triptease.io/bootstrap.js?integrationId=" + b, c.defer = true, c.async = true, c.type = "text/javascript";
            var d = document.getElementsByTagName("script")[0];
            d.parentNode.insertBefore(c, d)
        })(document, "01D5BMNJAWT51AA7FNWNPCAMZF");
    </script>
<?php

}
?>


<?php

if ($GLOBALS['location'][0]->slug == 'london') {

?>


<?php

}
?>