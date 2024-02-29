<?php
/*
  Template Name: Experience-The lalit Landing Template
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Paper_Plane
 * @since PaperPlane 1.0
 */

$page_id = get_the_ID();
$parent_page_id = wp_get_post_parent_id( $page_id );

$location = get_the_terms($parent_page_id, 'locations');
$location_id = '';
foreach($location as $value)
{
  $location_id = $value->term_id;
}

$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;


$position = 1;
$destination_obj = get_destination_by_taxanomy('locations', $location[0]->term_id);
$hotel_name = '';
if($destination_obj->have_posts()){

    while($destination_obj->have_posts()){
        
        $destination_obj->the_post();
        $hotel_name = get_post_meta(get_the_id(), 'name', true);
    }

}
wp_reset_postdata();

$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';


$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = 'Experience '.ucfirst($location[0]->slug);

?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
    <?php
        if(!isMobile())
        {
    ?>
        <link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/animate.min.css" /> 
        <link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/page-scroll-effects.min.css" />
    <?php
        }
    ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
        </script>

    </head>

    <?php
    if(isMobile())
    {
    ?>
        <body  <?php body_class('experience-page local-page'); ?>>
    <?php
    }
    else
    {
    ?>
        <body <?php body_class('experience-page local-page'); ?> data-hijacking="on" data-animation="opacity">
    <?php 
    }
    ?>
        <div class="main-wrap">
            <?php get_header(); ?>
                
                <?php 
                    if(isMobile())
                    {
                        get_template_part( 'template-parts/experience', 'mobile-listing' );
                        get_footer(); 
                    }
                    else
                    {
                        get_template_part( 'template-parts/experience', 'listing' ); 
                    ?> 
                        <!-- Social sharing buttons -->
                        <ul class="unstyled-listing icon-social">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" title="Facebook" target="_blank"><i class="sprite ico-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&via=TheLalitGroup&related=twitterapi%2Ctwitter ?>" title="Twitter" target="_blank" id="twitter"><i class="sprite ico-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/share?url=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" title="Gogle plus" target="_blank"><i class="sprite ico-g-plus"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" title="Linked In" target="_blank"><i class="sprite ico-linkedin"></i></a>
                            </li>
                        </ul><!-- icon-social -->
                        <!-- Social sharing buttons -->  

                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-ui.min.js"></script>
                        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.fancybox.pack.js"></script>
                        
                        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/experience.min.js"></script>

                        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/booking-widget.min.js"></script>
                        
                        <?php
                        wp_footer();
                        
                        if(ENV == 'production')
                        {
                        ?>
                            <!--  Adwords Script -->
                            <script type="text/javascript">
                                /* <![CDATA[ */
                                var google_conversion_id = 1034065160;
                                var google_custom_params = window.google_tag_params;
                                var google_remarketing_only = true;
                                /* ]]> */
                            </script>
                            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
                            </script>
                            <noscript>
                                <div style="display:inline;">
                                    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1034065160/?guid=ON&amp;script=0"/>
                                </div>
                            </noscript>
                            <!--  Adwords Script -->

                            <!-- Digital Marketing script -->
                            <script type="text/javascript" src="https://l2.io/ip.js?var=userip"></script>
                            <script type="text/javascript" src="//www.4caster.net/websites_configs/thelalit.js"></script>
                            <!-- End Digital Marketing script --> 


                            <!-- AFFILIRED MASTER TAG, PLEASE DON'T REMOVE -->
                            <script type="text/javascript">
                            (function() {
                            var sc = document.createElement('script'); sc.type = 'text/javascript'; sc.async = true;
                            sc.src = '//customs.affilired.com/track/?merchant=3895';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
                            })();
                            </script>
                            <!-- END AFFILIRED MASTER TAG PLEASE DON'T REMOVE-->

                            <?php get_template_part('includes/world', 'hotels-tracking-code'); ?>
                            
                        <?php
                        }
                        ?>
                            <!-- Social sharing script -->
                            <script type="text/javascript">
                                jQuery(document).ready(function() {
								   var location = <?php echo json_encode($GLOBALS['location'][0]->slug) ?>;
								   var twt_handle = 'TheLalitGroup';
								   if(location)
								   {
									   if(location == 'london')
									   {
										   twt_handle = 'TheLalitLondon';
									   }
								   }
								   var og_title = jQuery('meta[property="og:title"]').attr('content');
								   if(og_title)
								   {
									   if(og_title.length > 120)
									   {
										   var og_title = og_title.substring(0, 120)+'...';
									   }
									   og_title = encodeURIComponent(og_title);
									   var url = "https://twitter.com/share?url=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&via="+twt_handle+"&related=twitterapi%2Ctwitter&text="+og_title;

									   jQuery(".icon-social").find("#twitter").attr("href", url);
								   }
								   else
								   {
									   var url = "https://twitter.com/share?url=<?php echo 'http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>&via="+twt_handle+"&related=twitterapi%2Ctwitter";

									   jQuery(".icon-social").find("#twitter").attr("href", url);
								   }
							   });

                                jQuery(".icon-social a").click(function() {
                                    var href = jQuery(this).attr("href");
                                    window.open(href, '', 'height=500, width=700');
                                    return false;
                                });

                                jQuery(".book-item .booking-nav-btn").click(function(){
                                    if(jQuery(window).width() > 1024){
                                        jQuery(".v-align-widget").fadeToggle(300);
                                    }
                                });

                                jQuery(".loggedIn").find(".loggedIn-link").on("click", function() {
                                    if(jQuery(this).hasClass("active"))
                                    {
                                        jQuery(this).removeClass("active");
                                        jQuery(this).next().slideUp(400, function() {
                                            jQuery(this).prev().find(".sprite").addClass("ico-gre-down-arrow");
                                            jQuery(this).prev().find(".sprite").removeClass("ico-gre-up-arrow");
                                        });
                                    }
                                    else
                                    {       
                                        jQuery(this).addClass("active");
                                        jQuery(this).next().slideDown(400, function() {
                                            jQuery(this).prev().find(".sprite").removeClass("ico-gre-down-arrow");
                                            jQuery(this).prev().find(".sprite").addClass("ico-gre-up-arrow");
                                        });
                                    }
                                });

                                jQuery("body").on("click", function(event) {
                                    if( jQuery(event.target).is('.sub-menu-login') || jQuery(event.target).is(".sub-menu-login .sub-menu-list-link") || jQuery(event.target).is(".loggedIn-link") )
                                    {
                                        return;
                                    }   
                                    else
                                    {
                                        if(jQuery('.sub-menu-login').is(':visible') && event.target.className !== ".sub-menu-login" && !jQuery(event.target).parents('.sub-menu-login').length )
                                        {
                                            jQuery(".loggedIn .loggedIn-link").trigger("click");
                                        }
                                    }
                                });

                                jQuery("body").on("click", function(e) {
                                    if( jQuery(e.target).is('.v-align-widget') || jQuery(e.target).is('.book-item .btn.primary-btn') || jQuery(e.target).is('.book-item .btn.tertiary-btn') || jQuery(e.target).is('.form_submit_nav_widget') || jQuery(e.target).is('#ui-datepicker-div') || jQuery(e.target).is('#ui-datepicker-div .ui-datepicker-group .ui-datepicker-calendar, #ui-datepicker-div .ui-datepicker-buttonpane, .ui-icon, .ui-datepicker-close') || jQuery(e.target).parents('#ui-datepicker-div').length || jQuery(e.target).parents('.fancybox-wrap').length || jQuery(e.target).is('.fancybox-item.fancybox-close')) 
                                    {
                                        return;
                                    }
                                    else
                                    {
                                        if(jQuery('.v-align-widget').is(':visible') && e.target.className !== ".v-align-widget" && !jQuery(e.target).parents('.v-align-widget').length)
                                        {
                                            if(jQuery(window).width() > 1024){

                                                jQuery(".v-align-widget").fadeOut(300);
                                            }
                                        }
                                    }
                                });

                            </script>
                            <!-- Social sharing script -->

                            <!-- waybeo scripts -->
                            <script type="text/javascript" src="//js.waybeo.com/v0.1-beta2/waybeo.min.js"></script>
                            <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/waybeolib/js/intlTelInput.min.js"></script>
                            <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/waybeolib/js/normalpopup-onclick.js"></script>
                            <!-- waybeo scripts -->
                        <?php
                    }
                ?>
        </div><!-- main-wrap -->
        <?php
        if(!isMobile()){
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
            <?php
        }
        ?>
    </body>
    <script type="text/javascript">
    if(!jQuery('#isHome').val()){

        /* Vertical align booking widget code for desktop to remove disabled sttribute code starts here */

        jQuery(document).ready(function(){

            if(jQuery('.booking-widget.v-align-widget .select.selecthotel').attr('disabled')){

                jQuery('.booking-widget.v-align-widget .select.selecthotel').removeAttr('disabled').removeAttr('style');
            }
        });
    }
    /*** Hamburger Nav menu code starts here ***/

    jQuery(document).ready( function (){

        if(!jQuery('body').hasClass('global-page')){
            jQuery('body').addClass('local-page');
        }

        jQuery("#trigger").on("click", function() {

            if(jQuery(window).width() > 767 && jQuery(window).width() <= 1024)
            {
                if(jQuery(this).hasClass("active"))
                {    
                    jQuery("#trigger").find(".ico-sprite").addClass("ico-humbug");
                    jQuery(".primary-nav .nav").fadeOut(function() {
                        jQuery(".sub-menu-item .sub-menu-links-block").find("a.back-link").trigger("click");
                        jQuery("html, body").removeAttr('style');
                    });
                    jQuery(this).removeClass("active");
                }
                else
                {
                    jQuery("#trigger").find(".ico-sprite").removeClass("ico-humbug");
                    jQuery(this).addClass("active");
                    jQuery(".primary-nav .nav").fadeIn();
                    jQuery("html, body").css("overflow", "hidden");
                }
            }

            return false;
        });

        jQuery(".primary-navigation").find("a.mob-click").on("click", function() {
            jQuery(this).next().animate({
                left: "0px",
            }, '900', 'linear', function(){
                jQuery(".offers, .experience-lalit, .rejuve-lalit, .meetings-events, .weddings, .login-resigter-mob").css('display', 'none');
            });

            jQuery('.find-a-hotel').animate(
                '900', 'linear',
                function(){ 
                    jQuery('.find-a-hotel').css('display', 'none');
                });
            
            return false; 
        });

        jQuery(".sub-menu-item .sub-menu-links-block").find("a.back-link").on("click", function() {

            jQuery(this).closest(".sub-menu-links-block").animate({
                left: "100%",
            }, '900', 'linear');

            jQuery(".offers, .experience-lalit, .rejuve-lalit, .meetings-events, .weddings, .login-resigter-mob, .find-a-hotel").css('display', 'block');

        return false; 
        });

    });

    /*** Hamburger Nav menu code ends here ***/

    $(window).scroll(function () {
	            
                if($(window).scrollTop() > 45) {
                    $('.local-nav').find(".local-city-logo").addClass("sticky-logo");
                }
                if ($(window).scrollTop() < 45) {
                    $('.local-nav').find(".local-city-logo").removeClass("sticky-logo");
                }    
                if($(window).scrollTop() > 100) {
                    if(jQuery('.primary-nav').hasClass('sticy-nav') == false)
                    {
                        $('.nav-bar-fill').addClass('navbar-fixed');
                        //$('.content-section').css("padding-top", "48px");
        
                        /*if($(this).width() <= 992){
        
                            var contentSectionPadding = $('.mobile-sticky').outerHeight();
                            $('.content-section').css('padding-top', contentSectionPadding+'px');
                        }*/
                        if(jQuery(".sidebar-outer").length)
                        {
                            jQuery(".sidebar-outer").addClass("fixed-sidebar"); 	            }
                        if(jQuery(".package-head-sec").length > 0)
                        {
                            jQuery(".package-head-sec").addClass("package-head-bg");
                            jQuery('.content-section').css("padding-top","230px");
                        }
                    }
                }
                if ($(window).scrollTop() < 100) { 
                    if(jQuery('.primary-nav').hasClass('sticy-nav') == false)
                    {
                        $('.nav-bar-fill').removeClass('navbar-fixed');
                        //$('.content-section').css("padding-top", "0");
        
                        /*if($(this).width() <= 992){
                            
                            var contentSectionPadding = $('.mobile-sticky').outerHeight() + $('.nav-bar-fill').height();
                            $('.content-section').css('padding-top', contentSectionPadding+'px');
                        }*/
                        if(jQuery(".sidebar-outer").length)  
                        {
                            jQuery(".sidebar-outer").removeClass("fixed-sidebar");
                        }
                        if(jQuery(".package-head-sec").length > 0)
                        {
                            jQuery(".package-head-sec").removeClass("package-head-bg");
                            jQuery('.content-section').css("padding-top", "0");
                        }
                    }
                }
                if($(window).scrollTop() > 100) {
                    $('.local-nav').find(".local-city-logo").addClass("animate-logo");
                }
                if ($(window).scrollTop() < 100) {
                    $('.local-nav').find(".local-city-logo").removeClass("animate-logo");
                }
        
                var windowBottom = jQuery(this).scrollTop() + jQuery(this).innerHeight();
                jQuery(".js_fade").each(function() {
                  /* Check the location of each desired element */
                  var objectTop = jQuery(this).offset().top + 30;
                  
                  /* If the element is completely within bounds of the window, fade it in */
                  if (objectTop < windowBottom) { //object comes into view (scrolling down)
                    if (jQuery(this).css("opacity")==0) {jQuery(this).fadeTo("600",1);}
                  }
                });
            
            }).scroll();
    </script>
    <?php

    if($GLOBALS['location'][0]->slug == 'london'){

        ?>
        <script>(function(a,b){var c=a.createElement("script");c.src="https://onboard.triptease.io/bootstrap.js?integrationId="+b,c.defer=true,c.async=true,c.type="text/javascript";var d=document.getElementsByTagName("script")[0];d.parentNode.insertBefore(c,d)})(document,"01D5BMNJAWT51AA7FNWNPCAMZF");</script>
        <?php

    }
    ?>
</html>