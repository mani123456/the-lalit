<?php
/**
 * This file contains the footer code and is included in the template files.
 */

//wp_footer();
?>

<!-- scrooling to top
  We use 2 `amp-animation` elements to trigger the visibility of the button.
  The first one is for making the button visible...
-->
<amp-animation id="showAnim" layout="nodisplay">
    <script type="application/json">
      {
        "duration": "200ms",
         "fill": "both",
         "iterations": "1",
         "direction": "alternate",
         "animations": [
           {
             "selector": "#scrollToTopButton",
             "keyframes": [
               { "opacity": "1", "visibility": "visible" }
             ]
           }
         ]
      }
    </script>
</amp-animation>
<!-- ... and the second one is for adding the button.-->
<amp-animation id="hideAnim" layout="nodisplay">
    <script type="application/json">
     {
       "duration": "200ms",
         "fill": "both",
         "iterations": "1",
         "direction": "alternate",
         "animations": [
           {
             "selector": "#scrollToTopButton",
             "keyframes": [
               { "opacity": "0", "visibility": "hidden" }
             ]
           }
         ]
     }
    </script>
</amp-animation>
<!-- We use `amp-position-observer` to start the animation when the user starts to scroll. -->
<div id="marker">
    <amp-position-observer
        on="enter:hideAnim.start; exit:showAnim.start"
        layout="nodisplay">
    </amp-position-observer>
</div>
<a id="scrollToTopButton" class="scrollup" on="tap:main-wrap-container.scrollTo(duration=600)">
    <i class="ico-sprite sprite size-18 ico-gre-up-arrow"></i>
</a>

<?php

$class = '';
if(is_single())
{
    $class = "detail-page";
}
wp_reset_postdata();
?>
<div class="amp-social-share-container">
    <amp-social-share class="social-share-round"
    type="facebook"
    data-param-app_id="966242223397117"
    width="20"
    height="20"
    data-param-href="<?php echo get_the_permalink(); ?>?amp">
    </amp-social-share>
    <amp-social-share class="social-share-round"
    type="twitter"
    width="20"
    height="20"
    data-param-url="<?php echo get_the_permalink(); ?>?amp">
    </amp-social-share>
    <amp-social-share class="social-share-round"
    type="gplus"
    width="20"
    height="20"
    data-param-url="<?php echo get_the_permalink(); ?>?amp">
    </amp-social-share>
    <amp-social-share class="social-share-round"
    type="linkedin"
    width="20"
    height="20"
    data-param-url="<?php echo get_the_permalink(); ?>?amp">
    </amp-social-share>
</div>
<!-- Normal popup form -->
<footer class="footer <?php echo $class; ?>">
    <div class="foot-body-sec">
        <div class="container">
            <div class="row">
                <?php
                    $destination_obj = $GLOBALS['$destinations'];
                    if( $destination_obj->have_posts() ) :  
                ?>
                        <div class="lalit-properties-section">
                            <h6>The LaLiT Properties</h6>
                            <ul class="unstyled-listing">
                                <?php
                                    $i = 1;
                                    while($destination_obj->have_posts()) : $destination_obj->the_post();
                                        
                                        $name = get_post_meta($post->ID, 'name', true);
                                        $location = get_the_terms($post->ID, 'locations');
                                        $city_name = $location[0]->slug;
                                        $permalink = site_url().'/the-lalit-'.$city_name.'/';
                                ?>
                                        <li>
                                            <a href="<?php echo $permalink; ?>?amp" title="<?php echo $name; ?>"><?php echo $name; ?></a>
                                        </li>
                                <?php
                                if($i % 7 == 0)
                                {
                                ?>
                                    </ul>
                                    <ul class="unstyled-listing">
                                <?php
                                }
                                        $i++;

                                    endwhile;
                                ?>     
                            </ul><!-- unstyled-listing -->
                        </div><!-- footer-padding -->
                <?php
                    endif;
                    wp_reset_postdata();
                ?>
                
                <div class="footer-padding">
                    <h6>The Lalit Suri Hospitality Group</h6>
                    <ul class="unstyled-listing">
                        <li>
                            <a href="<?php echo site_url(); ?>/about-us/" title="About Us">About Us</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/management/" title="Management">Management</a>
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
                        <li>
                            <a href="<?php echo site_url(); ?>/wp-content/uploads/2017/07/thelalit-published-rates-july-2017.pdf" target="_blank" >Published Rates</a>
                        </li>
                        <?php
                        $args = array(
                            'post_type'=>'the-lalit-insight',
                            'post_status'=>'publish',
                            'posts_per_page'=>'-1',
                        );

                        $loop = new WP_Query($args);
                        if($loop->post_count > 0){
                        ?>
                        <li>
                            <a href="<?php echo site_url(); ?>/the-lalit-insights/">The Lalit Insights</a>
                        </li>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </ul><!-- unstyled-listing -->
                    <ul class="unstyled-listing">  
                        <li>
                            <a href="<?php echo site_url(); ?>/press-releases/" title="Press Releases">Press Releases</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/awards/" title="Awards">Awards</a>
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
                        if($GLOBALS['location'][0]->slug)
                        { 
                        ?>
                            <a href="<?php echo site_url().'/the-lalit-'.$GLOBALS['location'][0]->slug; ?>/contact-us/" title="Contact Us">Contact Us</a>
                        <?php 
                        }
                        else
                        { 
                        ?>
                            <a href="<?php echo site_url(); ?>/contact-us/" title="Contact Us">Contact Us</a>
                        <?php 
                        } 
                        ?>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/site-map/" title="site Map">Site Map</a>
                        </li>
                    </ul><!-- unstyled-listing -->
                </div><!-- footer-padding -->

                <div class="footer-padding">
                    <div class="unstyled-listing">
                        <div class="our-brands">
                            <h6>Our Brands</h6>
                            <ul>
                                <li><a href="http://www.kittysu.com/" title="Kitty Su" target="_blank">Kitty Su</a></li>
                                <li><a href="http://www.thebaluchi.com/"  title="Baluchi" target="_blank">Baluchi</a></li>
                                <li><a href="http://www.thelalitftc.com/" title="The Lalit Food Truck" target="_blank">The Lalit Food Truck Company</a></li>
                                <li><a href="http://www.tlshs.com/" title="The Lalit Suri Hospitality School" target="_blank">The Lalit Suri Hospitality School</a></li>
                            </ul>
                        </div><!-- our-brands --> 

                        <div class="contact-info">
                            <h6>Get in Touch</h6> 
                            <address>
                            <?php
                                if($GLOBALS['address'])
                                {
                            ?>
                                    <span><?php echo $GLOBALS['address']; ?></span>
                            <?php
                                }
                                if($GLOBALS['phone'])
                                {
                            ?>
                                    <span><?php echo 'T: <a href="tel: '.$GLOBALS['phone'].'">'.$GLOBALS['phone'].'</a>'; ?></span>
                            <?php
                                }
                                if($GLOBALS['fax'])
                                {
                            ?>
                                    <span><?php echo 'F: '.$GLOBALS['fax']; ?></span>
                            <?php
                                }
                                if($GLOBALS['email'])
                                {
                            ?>
                                    <span><?php echo 'E: <a href="mailto:'.$GLOBALS['email'].'">'.$GLOBALS['email'].'</a>' ?></span>
                            <?php
                                }
                                if(!$GLOBALS['location'])
                                {
                            ?>
                                    <span>India Toll Free: 1800 11 77 11</span>
                                    <span>Telephone: +91 11 4444 7474</span>
                            <?php
                                }
                            ?>
                            </address><!--address-->
                        </div><!--contact-info-->               
                    </div><!-- unstyled-listing -->
                </div><!-- footer-padding -->
            </div><!--row-->
        </div><!-- container -->  
        
        <div class="foot-copyright-sec">  
            <div class="align-center footer-info">
                <p>&copy; The LaLiT <?php echo date('Y'); ?>, All rights reserved by Bharat Hotels Ltd.</p>
            </div>

            <div class="social-info-block">
                <ul class="unstyled-listing align-center social-info">
                    <li><strong class="lbl-find-us">Find us on</strong></li>
                    <?php
                    if($GLOBALS['facebook'])
                    {
                    ?> 
                        <li>
                            <a href="<?php echo $GLOBALS['facebook']; ?>" title="Facebook" target="_blank"><i class="sprite ico-facebook"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($GLOBALS['twitter'])
                    {
                    ?>
                        <li>
                            <a href="<?php echo $GLOBALS['twitter']; ?>" title="Twitter" target="_blank"><i class="sprite ico-twitter"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($GLOBALS['instagram'])
                    {
                    ?>
                        <li>
                            <a href="<?php echo $GLOBALS['instagram']; ?>" title="Instagram" target="_blank"><i class="sprite ico-instagram"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($GLOBALS['google'])
                    {
                    ?>
                        <li>
                            <a href="<?php echo $GLOBALS['google']; ?>" title="G Plus" target="_blank"><i class="sprite ico-g-plus"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if($GLOBALS['linkedin'])
                    {
                    ?>
                        <li>
                            <a href="<?php echo $GLOBALS['linkedin']; ?>" title="LinkedIn" target="_blank"><i class="sprite ico-linkedin"></i></a>
                        </li>
                    <?php
                    }
                    ?>
                    <li><a href="https://www.youtube.com/lalithotels" title="Youtube" target="_blank"><i class="sprite ico-youtube"></i></a></li>
                    <li><a href="http://blog.thelalit.com/" title="Blogger" target="_blank"><i class="sprite ico-blogger"></i></a></li>
                </ul><!--unstyled-listing-->        
            </div><!-- social-info-block -->
            <span class="foot-motif"></span>  
        </div><!--container-->
    </div><!-- foot-body-sec -->
    <input type="hidden" id="global-location" value="<?php echo ucwords($GLOBALS['location'][0]->slug); ?>" />
</footer><!--Footer-->

<!--  Google anaytics and adwords and digital marketing scripts -->
<?php
if(ENV == 'production')
{
?>
    <!--  Adwords Script -->
    <!-- <script type="text/javascript">
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
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1034065160/?guid=ON&amp;script=0"/>
        </div>
    </noscript> -->

    <!-- <amp-analytics type="googleadwords">
        <script type="application/json">
        {
            "triggers": {
                "onVisible": {
                    "on": "visible",
                    "request": "conversion"
                }
            },
            "vars": {
                "googleConversionId": "1034065160",
                "googleConversionLanguage": "en",
                "googleConversionFormat": "",
                "googleConversionLabel": "",
                "googleRemarketingOnly": "true"
            }
        }
        </script>
    </amp-analytics> -->
    <!--  End Adwords Script --> 

    <!-- Digital Marketing script -->
    <!-- <script type="text/javascript" src="https://l2.io/ip.js?var=userip" async></script> -->
    <!-- <amp-analytics>
        <script type="application/json">
        {
            "requests": {
                "pageview": "https://l2.io/ip.js?var=userip"
            },
            "triggers": {
                "trackPageview": {
                    "on": "visible",
                    "request": "pageview"
                }
            }
        }
        </script>
    </amp-analytics> -->
    <?php
    if(!is_checkout())
    {
    ?>
        <!-- <script type="text/javascript" src="//www.4caster.net/websites_configs/thelalit.js" async></script> -->
        <amp-analytics>
            <script type="application/json">
            {
                "requests": {
                    "pageview": "//www.4caster.net/websites_configs/thelalit.js"
                },
                "triggers": {
                    "trackPageview": {
                        "on": "visible",
                        "request": "pageview"
                    }
                }
            }
            </script>
        </amp-analytics>
    <?php
    }
    ?>
    <!-- End Digital Marketing script --> 


    <!-- AFFILIRED MASTER TAG, PLEASE DON'T REMOVE -->
    <!-- <script type="text/javascript">
    (function() {
    var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
    sc.src = '//customs.affilired.com/track/?merchant=3895';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
    })();
    </script> -->

    <!-- <amp-analytics>
        <script type="application/json">
        {
            "requests": {
                "pageview": "//customs.affilired.com/track/?merchant=3895"
            },
            "triggers": {
                "trackPageview": {
                    "on": "visible",
                    "request": "pageview"
                }
            }
        }
        </script>
    </amp-analytics> -->
    <!-- END AFFILIRED MASTER TAG PLEASE DON'T REMOVE-->
    
    <?php //get_template_part('includes/world', 'hotels-tracking-code'); ?>

    <?php
        if($GLOBALS['location'])
        {
            if($GLOBALS['location'][0]->slug == 'bangalore' || $GLOBALS['location'][0]->slug == 'mumbai' || $GLOBALS['location'][0]->slug == 'kolkata' || $GLOBALS['location'][0]->slug == 'delhi')
            {
    ?>
                <!-- Lalit India Analytics Pixel: -->
                <!-- <script type="text/javascript" src="https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"></script> -->
                <!-- <amp-analytics>
                    <script type="application/json">
                    {
                        "requests": {
                            "pageview": "https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"
                        },
                        "triggers": {
                            "trackPageview": {
                                "on": "visible",
                                "request": "pageview"
                            }
                        }
                    }
                    </script>
                </amp-analytics> -->
    <?php
            }
        }
        if(is_front_page())
        {
    ?>
                <!-- Lalit India Analytics Pixel: -->
                <!-- <script type="text/javascript" src="https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"></script> -->
                <!-- <amp-analytics>
                    <script type="application/json">
                    {
                        "requests": {
                            "pageview": "https://tag.yieldoptimizer.com/ps/ps?t=s&p=3767&lltap=Lalit%20Analytics%20Pixel"
                        },
                        "triggers": {
                            "trackPageview": {
                                "on": "visible",
                                "request": "pageview"
                            }
                        }
                    }
                    </script>
                </amp-analytics> -->
    <?php
        }
    ?>
    <!--  Google anaytics and adwords and digital marketing scripts -->
    
<?php
}
?>