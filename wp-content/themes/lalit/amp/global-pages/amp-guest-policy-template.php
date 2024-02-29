<?php

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

$GLOBALS['destination'] = $destination_obj;



$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';


$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[3]['@type'] = 'ListItem';
$itemList[3]['position'] = $position + 3;
$itemList[3]['item']['@id'] = get_the_permalink();
$itemList[3]['item']['name'] = "Guest Policy";

?>

<!DOCTYPE html>
<html amp>
   <head>
      <?php wp_head(); ?>
      <?php include_once(get_template_directory() . '/amp/includes/amp-css-js.php'); ?>
        <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
        </script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
        <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
        <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
        <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
        <!-- <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script> -->
        <?php
          $css = file_get_contents(get_template_directory()."/stylesheets/css/amp.min.css");

          if($css != '') {
            ?>
            <style amp-custom>
              <?php
                echo $css;
              ?>
            </style>
            <?php
            }
        ?>
   </head>
   <body <?php body_class('local-page'); ?>>
         <?php include_once(get_template_directory() . '/amp/includes/amp-header.php'); ?>

         <div class="amp-content-section">
            <div class="main-banner banner-slider align-center">
                <amp-img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Management.jpg ?>"
                height="500"
                width="1700"
                layout="responsive"
                alt="Guest Policy Banner"></amp-img>               
            </div> 
            <div class="page-con">    
                <div class="container js_fade section-space">                                   
                    <div class="row">
                        <div class="page-heading">
                            <h2 class="sec-title bdr-bottom">
                                <span class="bdr-bottom-gold"><?php the_title(); ?></span>
                            </h2>
                        </div>
                        <?php
            
                            if( $GLOBALS['destination']->have_posts() ) : 
                                while($GLOBALS['destination']->have_posts()) : $GLOBALS['destination']->the_post();

                                    $check_in_time = get_post_meta( $post->ID, "check_in_time", true);
                                    $check_out_time = get_post_meta( $post->ID, "check_out_time", true);
                                    $check_in_check_out_policy = wpautop(get_post_meta( $post->ID, "check_in_and_check_out_policy", true));
                                    $child_policy = wpautop(get_post_meta( $post->ID, "child_policy", true));
                                    $pet_policy = wpautop(get_post_meta( $post->ID, "pet_policy", true));
                                    $reservation_policy = wpautop(get_post_meta( $post->ID, "reservation_policy", true));
                                    $cancellation_policy = wpautop(get_post_meta( $post->ID, "cancellation_policy", true));
                                    $alcohol_policy = wpautop(get_post_meta( $post->ID, "alcohol_policy", true));
                                    $safety_and_security = wpautop(get_post_meta( $post->ID, "safety_and_security", true));
                                
                                    ?>

                                    <div id="policies">
                                        <!-- <div class="page-heading">
                                            <h2 class="sec-title bdr-bottom">
                                                <span class="bdr-bottom-gold">Guest Policy</span>
                                            </h2>
                                        </div> -->
                                        <ul class="unstyled-listing">
                                            <?php if(trim($check_in_time) != '' || trim($check_out_time) != '' || trim($check_in_check_out_policy) != ''){ ?>
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Check-in and Check-out Policy</h6>
                                                    <div class="guest-policy-section">
                                                        <?php if(trim($check_in_time) != '' || trim($check_out_time) != ''){ ?>
                                                            <div class="check-col">
                                                                <?php if(trim($check_in_time) != ''){ ?>
                                                                    <span class="check-time-section">
                                                                        <span class="check-label">Check-in:</span>
                                                                        <span class="check-value"><?php echo $check_in_time; ?></span>
                                                                    </span>
                                                                <?php } ?>
                                                                <?php if(trim($check_out_time) != ''){ ?>
                                                                    <span class="check-time-section">
                                                                        <span class="check-label">Check-out:</span>
                                                                        <span class="check-value"><?php echo $check_out_time; ?></span>
                                                                    </span>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php echo $check_in_check_out_policy; ?>
                                                    </div>
                                                    <!-- guest-policy-section -->     
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($child_policy) != '') { ?>
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Child Policy</h6>
                                                    <div class="guest-policy-section">
                                                        <?php echo $child_policy; ?>
                                                    </div>
                                                    <!-- guest-policy-section -->     
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($pet_policy) != '') { ?>  
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Pet Policy</h6>
                                                    <div class="guest-policy-section">
                                                        <?php
                                                        echo $pet_policy;
                                                        ?>
                                                    </div><!-- guest-policy-section -->  
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($reservation_policy) != '') { ?>  
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Reservation Gaurantee</h6>
                                                    <div class="guest-policy-section">
                                                        <?php
                                                        echo $reservation_policy;
                                                        ?>
                                                    </div><!-- guest-policy-section -->  
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($cancellation_policy) != '') { ?>  
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Cancellation Policy</h6>
                                                    <div class="guest-policy-section">
                                                        <?php
                                                        echo $cancellation_policy;
                                                        ?>
                                                    </div><!-- guest-policy-section -->  
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($alcohol_policy) != '') { ?>  
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Alcohol Policy</h6>
                                                    <div class="guest-policy-section">
                                                        <?php
                                                        echo $alcohol_policy;
                                                        ?> 
                                                    </div><!-- guest-policy-section -->   
                                                </li>
                                            <?php } ?>
                                            <?php if(trim($safety_and_security) != '') { ?>  
                                                <li class="guest-policy-list">
                                                    <h6 class="guest-policy-heading">Safety and Security</h6>
                                                    <div class="guest-policy-section">
                                                        <p>
                                                        <?php
                                                        echo $safety_and_security;
                                                        ?>
                                                        </p>
                                                    </div><!-- guest-policy-section -->
                                                </li>
                                            <?php } ?>
                                        </ul><!-- accordion -->  
                                    </div><!-- pop-up --> 
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div><!--content-section-->

         <?php include_once(get_template_directory() . '/amp/includes/amp-footer.php'); ?>
      </div><!-- main-wrap -->    
   </body>
</html>