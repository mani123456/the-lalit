<!DOCTYPE html>
<html>
    <head>
        <title><?php the_title(); ?> | The Lalit</title>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
    </head>
    <?php
    global $post;
    $body_class = '';
    if($post->post_name == 'terms-conditions')
    {
        $body_class="terms-conditions";
    }
    ?>
    <body <?php body_class('global-page '.$body_class); ?>>
        <div class="main-wrap">
            <?php get_header(); ?>            
                 <?php while ( have_posts() ) : the_post(); ?>
                    <div class="content-section small-banner">
                        
                            <?php
                            $page_title = get_the_title();

                            if($page_title != 'Privacy Policy' && $post->post_name != 'terms-conditions')
                            {
                                ?>
                                <div class="main-banner banner-slider align-center">
                                    <div id="banner-slider" class="flexslider">
                                        <ul class="slides">
                                            <?php

                                                if($post->ID=='5704'){
                                                    ?>
                                                    <li>
                                                    	<img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Management.jpg" />  
                                                    </li>
                                                    <?php
                                                }
                                                else if($post->ID=='5705'){
                                                    ?>
                                                    <li>
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Developing-Destinations-1.jpg" />  
                                                    </li>
                                                    <li>
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Developing-Destinations-2.jpg" />  
                                                    </li>
                                                    <li>
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Developing-Destinations-3.jpg" />  
                                                    </li>
                                                    <li>
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Developing-Destinations-4.jpg" />  
                                                    </li>
                                                    <?php
                                                }
                                                else if($post->ID=='4233'){
                                                    ?>
                                                    <li>
                                                        <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/the-lalit-loyalty.jpg" />  
                                                    </li>
                                                    <?php
                                                }
                                                else if($post->ID=='445'){
                                                    ?>
                                                    <li class="small-banner-sec banner-image" style="background-image: url('<?php echo site_url(); ?>/wp-content/themes/lalit/images/Investor-Relations.jpg')">
                                                    </li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                    </div>                 
                                </div> 
                                <?php
                            }
                            ?>     
                         
                            <div class="page-con">    
                                <div class="container js_fade section-space">                                   
                                    <div class="row">
                                        <div class="page-heading">
                                            <h2 class="card-info-title bdr-bottom">
                                                <span class="bdr-bottom-gold"><?php the_title(); ?></span>
                                            </h2>
                                         </div>
                                        <?php the_content(); ?>
                                        <?php
                                        if($post->ID=='4233')
                                        {
                                            $des = get_destination_object_loyalty();
                                            $GLOBALS['hotels'] = array();
                                            $c = 0;
                                            while($des->have_posts()) : $des->the_post();
                                                $name =  get_post_meta($post->ID,"name",true);
                                                $GLOBALS['hotels'][$c]['name'] = $name;
                                                $GLOBALS['hotels'][$c]['id'] = $post->ID;
                                                $hotel_location = get_the_terms($post->ID, 'locations');
                                                $location_slug = '';
                                                foreach($hotel_location as $value)
                                                {
                                                  $location_slug = $value->slug;
                                                }
                                                $hotel_id_array[$c]['name'] = $name;
                                                $hotel_id_array[$c]['location_slug'] = $location_slug;
                                                $c++;
                                            endwhile;
                                        ?>
                                                    <a href="#book-a-table" class="btn secondary-btn reserve-btn fancybox">Become a Member</a>
                                        <?php
                                        }
                                        ?>  
                                    </div>
                                </div>
                            </div>
                    </div><!--content-section-->
                <?php endwhile; ?>          
            <?php get_footer(); ?>
        </div><!-- main-wrap -->
        
        <?php
    if($post->ID=='4233')
    {
    ?>
        <div id="book-a-table" class="pop-up" style="display: none;">
            <div class="form-header">
                <h2 class="page-title">
                      Loyalty Program
                </h2>
                <p class="form-group-sub-text">Unbelievable privileges and discounts on stay, food, and beverages across ten destinations</p>
            </div>
            <?php
                echo do_shortcode( '[contact-form-7 id="6443" title="Loyalty Program Form"]' );
            ?>

            <div class="thank-you-block" style="display:none;">
                <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                <h2 class="sec-title align-center">Request Sent</h2>
                <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
            </div><!-- thank-you-block -->
        </div><!-- pop-up --> 
    <?php
    }
    ?>

    <?php
    if(isMobile())
    {
    ?>
        <script type="text/javascript">
            jQuery(document).ready( function () {
                jQuery('.fancybox').fancybox({
                    autoSize : false,
                    width : "100%",
                    height : "auto",
                    afterClose: function() {
                        jQuery("body").removeClass("overlay-on");
                    }
                });
            });
        </script>
    <?php
    }
    else
    {
    ?>
        <script type="text/javascript">
            jQuery(document).ready( function () {
                jQuery('.fancybox').fancybox({
                    autoSize : false,
                    width : "550px",
                    height : "auto",
                    afterClose: function() {
                        jQuery("body").removeClass("overlay-on");
                    }
                });
            });
        </script>
    <?php
    }
    ?>
    <script type="text/javascript">
        var hotel_array = <?php echo json_encode($hotel_id_array); ?>;
        var environment = <?php echo json_encode(ENV); ?>;

        jQuery(".reserve-btn").on("click", function() {
            jQuery(".thank-you-block").fadeOut();
            jQuery(".wpcf7, .form-header").fadeIn();
            jQuery("#book-a-table").find(".wpcf7-response-output").remove();

            jQuery("#book-a-table").find(".wpcf7-not-valid-tip").remove();
            jQuery("#book-a-table").find(".wpcf7-response-output").html("");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
            jQuery("#book-a-table").find(".input-text").val("");

            jQuery("body").addClass("overlay-on");

            jQuery("#hotel").trigger("change");
            
        });

        function successfull_subscription()
        {    
            jQuery(".wpcf7, .form-header").fadeOut(function() {
                jQuery(".thank-you-block").fadeIn();
                jQuery.fancybox.update();

                setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                }, 5000);
            });
        }

        jQuery("#hotel").change(function() {
            if(environment == 'production')
            {
                var value = jQuery(this).val();
                for( i = 0; i < hotel_array.length; i++ )
                {
                    var email = 'lalitloyaltysupport@thelalit.com';
                    if(hotel_array[i].name == value)
                    {
                        if(hotel_array[i].location_slug == 'delhi')
                        {
                            email = 'dellalitloyalty@thelalit.com';
                        }
                        else if(hotel_array[i].location_slug == 'mumbai')
                        {
                            email = 'mumlalitloyalty@thelalit.com';
                        }
                        else if(hotel_array[i].location_slug == 'bangalore')
                        {
                             email = 'banglalitloyalty@thelalit.com';
                        }
                        else if(hotel_array[i].location_slug == 'jaipur')
                        {
                             email = 'jprlalitloyalty@thelalit.com';
                        }
                        else if(hotel_array[i].location_slug == 'kolkata')
                        {
                             email = 'kollalitloyalty@thelalit.com';
                        }
                        else if(hotel_array[i].location_slug == 'chandigarh')
                        {
                             email = 'chdlalitloyalty@thelalit.com';
                        }
                        else
                        {
                             email = 'lalitloyaltysupport@thelalit.com';
                        }
                        jQuery("#book-a-table").find("#admin-email").val(email);
                    }
                }
            }
            else
            {
                jQuery("#book-a-table").find("#admin-email").val("ecampaign@thelalit.com");
            } 
        });
    </script>
        
    </body>
</html>