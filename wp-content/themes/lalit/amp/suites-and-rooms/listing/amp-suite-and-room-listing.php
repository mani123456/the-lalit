<?php
 $destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);
   
 $suites_and_rooms_object = '';

 $room_type_ids = array();
 $features = array();
 $bed_baths = array();
 $technologies = array();
 $services = array();

 $curr = '&#8377';

 $image_array = array();
 $banner_image_array = array();

 if( $destination_obj->have_posts() ) : 
    while($destination_obj->have_posts()) : $destination_obj->the_post();

       $suites_and_rooms_object = get_post_meta( $post->ID, "suites_and_rooms", true);
       $c = 0;
       foreach($suites_and_rooms_object as $suite_and_room_id)
       {
          if(get_post_status ( $suite_and_room_id ) == 'publish')
          {
              $room_type_obj = get_the_terms($suite_and_room_id, 'room_type');
              if($room_type_obj)
              {  
                 foreach($room_type_obj as $room_types)
                 {
                    $term_id = $room_types->term_id;
                    $room_type_ids[] = $term_id;
                 }
              }

              $facility = get_the_terms($suite_and_room_id, 'room_facility');
              if($facility)
              {
                 foreach($facility as $facility_id)
                 {
                    $features[$c] = $facility_id->name;

                    $c++;
                 }
              }

              $bed = get_the_terms($suite_and_room_id, 'bed_bath');
              if($bed)
              {
                 foreach($bed as $bed_id)
                 {
                    $bed_baths[$c] = $bed_id->name;

                    $c++;
                 }
              }

              $tech = get_the_terms($suite_and_room_id, 'technology');
              if($tech)
              {
                 foreach($tech as $tech_id)
                 {
                    $technologies[$c] = $tech_id->name;

                    $c++;
                 }
              }

              $service = get_the_terms($suite_and_room_id, 'service');
              if($service)
              {
                 foreach($service as $service_id)
                 {
                    $services[$c] = $service_id->name;

                    $c++;
                 }
              }
          }

       }

       $banner_images = get_post_meta($post->ID, "banner_images", true);

       $room_offers = get_offers_by_type(1, $post->ID, 2);
       $GLOBALS['listing_offers'] = $room_offers;

       $check_in_time = get_post_meta( $post->ID, "check_in_time", true);
       $check_out_time = get_post_meta( $post->ID, "check_out_time", true);
       $check_in_check_out_policy = wpautop(get_post_meta( $post->ID, "check_in_and_check_out_policy", true));
       $child_policy = wpautop(get_post_meta( $post->ID, "child_policy", true));
       $pet_policy = wpautop(get_post_meta( $post->ID, "pet_policy", true));
       $reservation_policy = wpautop(get_post_meta( $post->ID, "reservation_policy", true));
       $cancellation_policy = wpautop(get_post_meta( $post->ID, "cancellation_policy", true));
       $alcohol_policy = wpautop(get_post_meta( $post->ID, "alcohol_policy", true));
       $safety_and_security = wpautop(get_post_meta( $post->ID, "safety_and_security", true));

       $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
       $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
       $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
       $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
       $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

       $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

       $currency = get_post_meta($post->ID, "currency", true);

       if($currency == 1)
       {
          $curr = '&#8377;';
       }
       else
       {
          $curr = '&pound;';
       }
       
    endwhile;
 endif;

 $room_type_ids = array_unique($room_type_ids);

 $features = array_unique($features);
 $bed_baths = array_unique($bed_baths);
 $technologies = array_unique($technologies);
 $services = array_unique($services); 


 $types = get_terms([
    'taxonomy' => 'room_type',
    'hide_empty' => false,
 ]);
?>

<div class="content-section room-dining-listing">

<?php
    if($banner_images)
    {
        $banner_ids = array();
        foreach($banner_images as $banner_image_id)
        {
            $banner_ids[] = $banner_image_id;
        }

        $banners = get_banner_by_taxonomy($banner_ids, 'room_listing');
        $image_present_flag = $video_present_flag = false;
        while($banners->have_posts()) : $banners->the_post();
            if( get_post_meta($post->ID, 'mobile_banner_image', true) ) :

                $image_present_flag = true;
                if( get_post_meta($post->ID, 'banner_type', true) != 0 && trim(get_post_meta($post->ID, 'video_url', true)) != '' ) :

                    $video_present_flag = true;
                endif;
            endif;
        endwhile;
        
        $height = 320;
        $width = 760;
        include_once(get_template_directory() . '/amp/includes/amp-leaderboard-banner.php');
    }
    //$nav_array = array('','suites & rooms','restaurants & bar','spa','events');
    $nav_array_display = $nave_array = array();
        
  if($hotel_additional_information)
  {

    foreach($hotel_additional_information as $info_id)
    {
        $title = get_post_meta($info_id, 'stay_title', true);
        $description = wpautop(get_post_meta($info_id, 'stay_description', true));
    }

    if($title || $description)
    {
        include(get_template_directory() . '/amp/includes/amp-title-description.php');
    }

  }
?>
         

<?php
if($types && count($room_type_ids) > 1)
{
?>      
      <div class="container">              
           <div class="row">
                <ul class="smooth-scroll align-center unstyled-listing">
                <?php
                 foreach($types as $t)
                 {
                    if(in_array($t->term_id, $room_type_ids))
                    {
                ?>
                      <li><a on="tap:<?php echo $t->slug;?>.scrollTo(duration=600)" >view <?php echo $t->name; ?> </a></li>
                <?php
                    }
                 }
                ?>
               </ul>                
           </div>
      </div>
<?php
}
?>
            
            
<?php
if($types)
{                
    foreach($types as $type)
    {
        $name = $type->name;
        $term_id = $type->term_id;
        $slug = $type->slug;

        if(in_array($term_id, $room_type_ids))
        {    
            $t = $slug;

?>
                           
            <div class="container item-listing" id="<?php echo $t; ?>">
                <h2 class="sec-title align-center"><?php echo ucfirst($name); ?></h2>
                <div class="row">
<?php
                    $room_count = 1;
                    foreach($suites_and_rooms_object as $suite_and_room_id)
                    {
                        if(get_post_status ( $suite_and_room_id ) == 'publish')
                        {
                            $room_term_id = '';
                            $room_type_obj = get_the_terms($suite_and_room_id, 'room_type');
                            if($room_type_obj && count($room_type_obj) > 0)
                            {
                               foreach($room_type_obj as $room_types)
                               {
                                  $room_term_id = $room_types->term_id;
                               }
                            }

                            $room_name = get_post_meta( $suite_and_room_id, "name", true);
                            $room_description = get_post_meta( $suite_and_room_id, "room_summary", true);
                            $room_images = get_post_meta( $suite_and_room_id, "images", true);
                            $room_images = explode(',', $room_images);
                            if(strlen($room_description) > 150)
                            {
                               $room_description = substr($room_description, 0, 150).'...';
                            }

                            $size_ft = get_post_meta( $suite_and_room_id, "size_ft", true);
                            $size_mt = get_post_meta( $suite_and_room_id, "size_mt", true);
                            $bed_type = get_post_meta( $suite_and_room_id, "bed_type", true);
                            $view = get_post_meta( $suite_and_room_id, "view", true);
                            $room_base_price = get_post_meta( $suite_and_room_id, "base_price", true);

                            $permalink = get_permalink($suite_and_room_id);

                            if($room_term_id == $term_id)
                            {    
?>                          
                             <a class="item-block" href="<?php echo $permalink.'amp'; ?>">
                                <div class="card-item stay-room">
                                   <div id="slider">
                                        <amp-carousel id="custom-button"
                                            width="400"
                                            height="300"
                                            layout="responsive"
                                            type="slides"
                                            autoplay
                                            controls>
<?php
                                            if($room_images)
                                            {
                                               foreach($room_images as $room_image_id)
                                               {
                                                  $room_image = wp_get_attachment_image_src($room_image_id, 'box_image')[0];

                                                  if(trim($room_image) != '')
                                                  {
                                                    ?>
                                                    <amp-img src="<?php echo $room_image; ?>"
                                                        width="400"
                                                        height="300"
                                                        layout="responsive"
                                                        alt="<?php echo $room_name; ?>">
                                                    </amp-img>
                                                    <?php   
                                                  }
                                               }
                                            }
?>
                                      </amp-carousel>
                                   </div><!-- slider -->

                                   <div class="card-info">
                                      <input type="hidden" class="permalink" value="<?php echo $permalink; ?>">
                                      <h3 class="card-info-title bdr-bottom">
                                         <span class="bdr-bottom-gold"><?php echo $room_name; ?></span>
                                      </h3>
                                      <p><?php echo $room_description; ?></p>
                                          <ul class="unstyled-listing meta-info meta-inline">
<?php
                                            if($size_ft != '' || $size_mt != '')
                                            {
?>
                                              <li class="meta-item clearfix">
                                                <span class="meta-label">SIZE</span>
                                                <span class="meta-value">
<?php
                                                if($size_ft != '' && $size_mt == '')
                                                {
                                                    echo $size_ft.' ft<sup>2</sup>';
                                                }
                                                else if($size_ft == '' && $size_mt != '')
                                                {
                                                    echo $size_mt.' m<sup>2</sup>';
                                                }
                                                else
                                                {
                                                    echo $size_ft.' ft<sup>2</sup> / '.$size_mt.' m<sup>2</sup>';
                                                }
?>
                                                </span>
                                              </li>
<?php
                                            }
?>

<?php
                                            if($view != '')
                                            {
?>
                                              <li class="meta-item clearfix">
                                                <span class="meta-label">VIEW</span><span class="meta-value"><?php echo ucfirst($view); ?></span>
                                              </li>
<?php
                                            }
?>
                                          </ul><!-- unstyled-listing -->

                                          <ul class="unstyled-listing">

<?php
                                        if($room_base_price != '')
                                        {
?>
                                              <li class="starting-price-section clearfix">
                                                <span class="starting-price-label">Starting at</span>
                                                <strong class="starting-price-value p-price"><?php echo $curr; ?><?php echo number_format($room_base_price); ?></strong>
                                              </li>
<?php
                                        }
?>
                                              <li class="discover-link detail-arrow">
                                                  <span class="text-link uppercase">Discover 
                                                    <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                                  </span>
                                              </li>
                                          </ul> <!-- unstyled-listing -->  
                                   </div><!-- card-info -->
                                                                           
                                </div><!-- card-item-block -->
                            </a>
                                    
<?php
                                $room_count++;
                            }
                        }
                    }
?>
                </div><!-- row -->  
            </div><!-- container -->
<?php
        }
    }
}
?>
              
    <div class="container policy-bg">
<?php
    if($features || $services || $bed_baths || $technologies)
    {
        $i = 0;
?>
       <div class="row">
             <div class="amenities-block">
                <h2 class="sec-title">
                <small>In-Room</small>Amenities &amp; Services</h2>
                <amp-accordion animate expand-single-section>
<?php
                      if($features)
                      {
                        $i++;
?>                      
                        <section <?php if($i==1){ echo "expanded"; }?>>
                            <h4 class="hotel-services-title">
                                <span class="ico-sprite sprite ico-gre-down-arrow"></span>
                                <span class="bdr-bottom-grey">Room Features</span>
                            </h4>
                            <ul class="service-list">
                                <?php
                                    foreach ($features as $feature)
                                    {
                                ?>
                                        <li><span><?php echo $feature; ?></span></li>
                                <?php

                                    }
                                ?>
                            </ul>
                            <!-- bullet-listing -->
                        </section>
<?php                   
                      }
 ?>
<?php
                      if($services)
                      {
                        $i++;
                        ?>                      
                        <section <?php if($i==1){ echo "expanded"; }?>>
                            <h4 class="hotel-services-title">
                                <span class="ico-sprite sprite ico-gre-down-arrow"></span>
                                <span class="bdr-bottom-grey">Services</span>
                            </h4>
                            <ul class="service-list">
                                <?php
                                    foreach ($services as $service)
                                    {
                                ?>
                                    <li><span><?php echo $service; ?></span></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </section> 
<?php
                      }

                      if($bed_baths)
                      {
                        $i++;
                        ?>                      
                        <section <?php if($i==1){ echo "expanded"; }?>>
                            <h4 class="hotel-services-title">
                                <span class="ico-sprite sprite ico-gre-down-arrow"></span>
                                <span class="bdr-bottom-grey">Bed &amp; Bath</span>
                            </h4>
                            <ul class="service-list">
                                <?php
                                    foreach ($bed_baths as $bed_bath)
                                    {
                                ?>
                                    <li><span><?php echo $bed_bath; ?></span></li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <!-- bullet-listing --> 
                        </section>
<?php
                      }
?>


<?php
                    if($technologies)
                      {
                        $i++;
                        ?>                      
                        <section <?php if($i==1){ echo "expanded"; }?>>
                            <h4 class="hotel-services-title">
                                <span class="ico-sprite sprite ico-gre-down-arrow"></span>    
                                <span class="bdr-bottom-grey">Technology</span>
                            </h4>
                            <ul class="service-list">
                                <?php
                                    foreach ($technologies as $technology)
                                    {
                                ?>
                                    <li><span><?php echo $technology; ?></span></li>
                                <?php
                                    }
                                ?>
                            </ul>
                            <!-- bullet-listing --> 
                        </section>
<?php
                    }
?> 
                </amp-accordion><!-- row -->
             </div><!-- amenities-block -->
       </div><!-- row -->
<?php
    }
?>
       <div class="row">
            <div class="guest-policy-listing-section">
                <p>Please review our <a href="<?php echo site_url().'/the-lalit-'.$GLOBALS['location'][0]->slug.'/guest-policy/?amp'; ?>" target="_blank" class="text-link uppercase fancybox"> Guests Policies <i class="ico-sprite sprite ico-red-right-arrow"></i></a></p>
            </div><!-- policies-block -->
       </div>

    </div><!-- container -->

    <?php 
    if( $room_offers->have_posts() ) : 

        $section_title = "Offers";
        $loop = $room_offers;
        $city_name = $GLOBALS['location'][0]->slug;
        $width = 715;
        $height = 380;
        $class1 = 'content-body';
        $class = '';
        include_once(get_template_directory() . '/amp/includes/amp-available-offers.php');

    endif;
    ?>

</div>