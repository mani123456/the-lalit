<?php

  $destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

  $city_name = $GLOBALS['location'][0]->slug;
  $hotel_title = '';
  $wedding_phone='';
  $wedding_email='';
  if( $destination_obj->have_posts() ) : 
    while($destination_obj->have_posts()) : $destination_obj->the_post();
      
      $hotel_title = get_the_title($post->ID);
      $hotel_name = get_post_meta( $post->ID, 'name', true);
      $hotel_venue_object = get_post_meta( $post->ID, 'hotel_venues', true);
      $wedding_services_object = get_post_meta( $post->ID, 'wedding_services', true);
      $banner_images = get_post_meta($post->ID, "banner_images", true);
      $wedding_phone = get_post_meta($post->ID, "meetings_and_weddings_phone", true);
      $wedding_email = get_post_meta($post->ID, "meetings_and_weddings_email", true);
      
      $GLOBALS['venue_phone'] = $wedding_phone;
      $GLOBALS['venue_phone'] = trim($GLOBALS['venue_phone']);
      $GLOBALS['venue_phone'] = rtrim($GLOBALS['venue_phone'], ',');
      $GLOBALS['venue_phone'] = ltrim($GLOBALS['venue_phone'], ',');

      $GLOBALS['venue_email'] = $wedding_email;
      $GLOBALS['venue_email'] = trim($GLOBALS['venue_email']);
      $GLOBALS['venue_email'] = rtrim($GLOBALS['venue_email'], ',');
      $GLOBALS['venue_email'] = ltrim($GLOBALS['venue_email'], ',');

      $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
      $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
      $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
      $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
      //$GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);
      $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

      $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
    endwhile;
  endif;

  $GLOBALS['form_hotel_title'] = $hotel_name;
  $GLOBALS['form_location'] = $GLOBALS['location'][0]->name;

  $GLOBALS['venues_dropdown'] = array();

  $GLOBALS['image_array'] = $GLOBALS['wedding_services_image_array'] = array();
  
?>
<div class="content-section wedding-list">
<?php
  if($banner_images)
  {
      $banner_ids = array();
      foreach($banner_images as $banner_image_id)
      {
         $banner_ids[] = $banner_image_id;
      }

      $images = get_banner_by_taxonomy($banner_ids, 'wedding');

      if( $images->have_posts() ) : 
?>
          <div class="main-banner banner-slider align-center">
             <div id="banner-slider" class="flexslider">
                <ul class="slides">
                   <?php
                    while($images->have_posts()) : $images->the_post();

                        if(isMobile())
                        {
                            $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }
                        else
                        {
                            $image_id = get_post_meta($post->ID, 'banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }    
                    ?>
                        <li class="banner-image">
                          <img src="<?php echo $image; ?>" />
                        </li>
                    <?php  
                    endwhile;
                    ?>
                </ul>
             </div><!-- slider -->
          </div>
<?php
        endif;
  }
?>

<?php
  if($hotel_additional_information)
  {

      foreach($hotel_additional_information as $info_id)
      {
          $wedding_title = get_post_meta($info_id, 'wedding_title', true);
          $wedding_description = wpautop(get_post_meta($info_id, 'wedding_description', true));
      }

  }
?>
    <div class="container intro-text section-space">
      <div class="row">
        <div class="col col9">
          <h2 class="page-title bdr-bottom">
            <small><?php echo $hotel_title; ?></small>
            <span class="bdr-bottom-gold"><?php echo $wedding_title; ?></span>
          </h2>
          <?php
          if($wedding_description)
          {
          ?>
            <p><?php echo $wedding_description; ?></p>
          <?php
          }
          ?>
        </div>

        <div class="col col3">
        
            
        <div class="contact-info"> 
          <p>For any queries, please don’t hesitate to contact us:</p>           
          <ul class="unstyled-listing h-card">

          <?php
            if($wedding_phone)
            {
                $wedding_phone = trim($wedding_phone);
                $wedding_phone = rtrim($wedding_phone, ',');
                $wedding_phone = ltrim($wedding_phone, ',');
                $phone_html = '';
                if(stripos($wedding_phone, ',') != FALSE)
                {
                    
                    $arr = explode(',', $wedding_phone);
                    for($i=0;$i<=count($arr);$i++)
                    {
                          $phone_html .= '<a class="p-tel" href="tel:'.trim($arr[$i]).'">'.trim($arr[$i]).'</a>';
                          if($arr[$i+1])
                          {
                              $phone_html .= ' / ';
                          }
                    }
                }
                else
                {
                    $phone_html = '<a class="p-tel" href="tel:'.$wedding_phone.'">'.$wedding_phone.'</a>';
                }
          ?>
              <li class="contact-details">
                  <i class="ico-sprite sprite size-24 ico-phone"></i>
                  <p><?php echo $phone_html; ?></p>
              </li>
          <?php
            }
          ?>

          <?php
            if($wedding_email)
            {
                $wedding_email = trim($wedding_email);
                $wedding_email = rtrim($wedding_email, ',');
                $wedding_email = ltrim($wedding_email, ',');
                $email_html = '';
                if(stripos($wedding_email, ',') != FALSE)
                {
                    
                    $arr = explode(',', $wedding_email);
                    for($i=0;$i<=count($arr);$i++)
                    {
                          $email_html .= '<a class="u-email" href="mailto:'.trim($arr[$i]).'">'.trim($arr[$i]).'</a>';
                          if($arr[$i+1])
                          {
                              $email_html .= ' / ';
                          }
                    }
                }
                else
                {
                    $email_html = '<a class="u-email" href="mailto:'.$wedding_email.'">'.$wedding_email.'</a>';
                }
            ?>  
                <li class="contact-details">
                <i class="ico-sprite sprite size-24 ico-email"></i>
                <p><?php echo $email_html; ?></p> 
              </li>
            <?php
            }
            ?>

              <li>
                <a href="#book-a-table" class="btn secondary-btn reserve-btn fancybox">contact our wedding specialist</a>
              </li>                            

          </ul>
          <!--<button type="button" class="btn secondary-btn">contact our wedding specialist</button>-->
        </div>
            
        </div>
      <!-- col -->
      </div>
    <!-- row -->
    </div>
    <!-- container -->

    <?php
    if($hotel_venue_object && $wedding_services_object)
    {
    ?>
    <div class="container section-space js_fade">              
      <div class="row">
          <ul class="smooth-scroll unstyled-listing">
              <?php if($hotel_venue_object){ ?><li><a href="#scroll1">Our Venues</a></li><?php } ?>
              <?php if($wedding_services_object) { ?><li><a href="#scroll2">Wedding Services</a></li><?php } ?>
          </ul>                
      </div>
    </div>
    <?php
    }
    ?>


  <?php
  if($hotel_venue_object)
  {
  ?>
    <div class="container section-space"> 
      <div class="row" id="scroll1">
          <h2 class="sec-title align-center venue-blk">Our Venues</h2>
      </div>
    </div>

    <?php

      $align_count = 1;
      foreach($hotel_venue_object as $hotel_venue_id)
      {
        if(get_post_status ( $hotel_venue_id ) == 'publish')
        {
          $wedding_taxonomies = get_the_terms($hotel_venue_id,'event-type');
          $wedding_type = get_post_meta( $hotel_venue_id, "venue_type", true );
          $wedding_name = get_post_meta( $hotel_venue_id, "name", true );
          $wedding_images = get_post_meta( $hotel_venue_id, "images", true );
          $wedding_virtual_tour = get_post_meta( $hotel_venue_id, "virtual_tour_link", true );
          $wedding_floor_plan = get_post_meta( $hotel_venue_id, "floor_plan", true );

          if($wedding_images != '')
          {
            if(strpos($wedding_images, ','))
            {
              $wedding_images = explode(",", $wedding_images);
            }
          }
          $wedding_description = wpautop(get_post_meta( $hotel_venue_id, "description", true ));

          if($wedding_taxonomies && !is_wp_error($wedding_taxonomies))
          {
                foreach ($wedding_taxonomies as $wedding_taxonomy)
                {
                      if($wedding_taxonomy->slug == 'wedding')
                      {
                          array_push($GLOBALS['venues_dropdown'], $wedding_name);

                          if(isMobile())
                          {
                          ?>
                                  <div class="container table-container venue-row"> 
                                      <div class="row table-sec">
                                          <div class="col col8 tablecell">
                                              <div  class="flexslider slider">
                                                <?php
                                                  if(is_array($wedding_images) && count($wedding_images) > 0)
                                                  {
                                                  ?>
                                                  <ul class="slides">
                                                      <?php
                                                        foreach ($wedding_images as $wedding_image)
                                                        {
                                                          if($wedding_image != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_image);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        }
                                                      ?>
                                                  </ul>
                                                  <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <ul class="slides">
                                                        <?php
                                                          if($wedding_images != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_images);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                  }
                                                ?>
                                              </div><!-- slider -->
                                          </div><!--col col9-->
                                          <div class="col col4 tablecell">
                                             <?php if($wedding_name){ ?><h3 class="item-title underline"><?php echo $wedding_name; ?></h3><?php } ?>
                                             <?php if(trim($wedding_description) != ''){ ?><p><?php echo $wedding_description; ?></p><?php } ?>
                                              <?php if(trim($wedding_virtual_tour) != '' || $wedding_floor_plan != ''){ ?>
                                              <ul class="unstyled-listing underline-list">
                                                  <?php if(trim($wedding_virtual_tour) != ''){ ?><li><a href="<?php echo $wedding_virtual_tour; ?>" class="text-link">Virtual tour <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i></a></li><?php } ?>
                                                  <?php if(trim($wedding_floor_plan) != ''){ ?><li><a href="<?php echo wp_get_attachment_url($wedding_floor_plan); ?>" class="text-link">Floor plan <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i> </a></li><?php } ?>
                                              </ul>
                                              <?php } ?>
                                              
                                              <a href="#book-a-table" subject="Wedding Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue 
                                                      <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                              </a>
                                          </div>
                                      </div>             
                                  </div>  <!-- container -->
                          <?php
                              $align_count++;
                          }
                          else
                          {

                                if($align_count % 2 != 0)
                                {
                                  
                                ?>
                                  <div class="container table-container venue-row"> 
                                      <div class="row table-sec">
                                          <div class="col col8 tablecell">
                                              <div  class="flexslider slider">
                                                <?php
                                                  if(is_array($wedding_images) && count($wedding_images) > 0)
                                                  {
                                                  ?>
                                                  <ul class="slides">
                                                      <?php
                                                        foreach ($wedding_images as $wedding_image)
                                                        {
                                                          if($wedding_image != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_image);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        }
                                                      ?>
                                                  </ul>
                                                  <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <ul class="slides">
                                                        <?php
                                                          if($wedding_images != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_images);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                  }
                                                ?>
                                              </div><!-- slider -->
                                          </div><!--col col9-->
                                          <div class="col col4 tablecell">
                                             <?php if($wedding_name){ ?><h3 class="item-title underline"><?php echo $wedding_name; ?></h3><?php } ?>
                                             <?php if(trim($wedding_description) != ''){ ?><p><?php echo $wedding_description; ?></p><?php } ?>
                                              <?php if(trim($wedding_virtual_tour) != '' || $wedding_floor_plan != ''){ ?>
                                              <ul class="unstyled-listing underline-list">
                                                  <?php if(trim($wedding_virtual_tour) != ''){ ?><li><a href="<?php echo $wedding_virtual_tour; ?>" class="text-link">Virtual tour <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i></a></li><?php } ?>
                                                  <?php if(trim($wedding_floor_plan) != ''){ ?><li><a href="<?php echo wp_get_attachment_url($wedding_floor_plan); ?>" class="text-link">Floor plan <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i> </a></li><?php } ?>
                                              </ul>
                                              <?php } ?>
                                              
                                              <a href="#book-a-table" subject="Wedding Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue 
                                                      <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                              </a>
                                          </div>
                                      </div>             
                                  </div>  <!-- container -->
                                <?php
                                   $align_count++;
                                }
                                else
                                {
                                ?>
                                  <div class="container table-container venue-row js_fade"> 
                                      <div class="row table-sec">
                                          <div class="col col4 tablecell">
                                             <?php if($wedding_name){ ?><h3 class="item-title underline"><?php echo $wedding_name; ?></h3><?php } ?>
                                             <?php if(trim($wedding_description) != ''){ ?><p><?php echo $wedding_description; ?></p><?php } ?>
                                              <?php if(trim($wedding_virtual_tour) != '' || $wedding_floor_plan != ''){ ?>
                                              <ul class="unstyled-listing underline-list">
                                                  <?php if(trim($wedding_virtual_tour) != ''){ ?><li><a href="<?php echo $wedding_virtual_tour; ?>" class="text-link">Virtual tour <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i></a></li><?php } ?>
                                                  <?php if(trim($wedding_floor_plan) != ''){ ?><li><a href="<?php echo wp_get_attachment_url($wedding_floor_plan); ?>" class="text-link">Floor plan <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i> </a></li><?php } ?>
                                              </ul>
                                              <?php } ?>
                                              
                                              <a href="#book-a-table" subject="Wedding Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue 
                                                      <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                              </a>
                                          </div>
                                          <div class="col col8 tablecell">
                                              <div  class="flexslider slider">
                                                <?php
                                                  if(is_array($wedding_images) && count($wedding_images) > 0)
                                                  {
                                                  ?>
                                                  <ul class="slides">
                                                      <?php
                                                        foreach ($wedding_images as $wedding_image)
                                                        {
                                                          if($wedding_image != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_image);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        }
                                                      ?>
                                                  </ul>
                                                  <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <ul class="slides">
                                                        <?php
                                                          if($wedding_images != '')
                                                          {
                                                            $image_url = wp_get_attachment_url($wedding_images);
                                                            ?>
                                                            <li>
                                                              <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>" />
                                                            </li>
                                                            <?php
                                                          }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                  }
                                                ?>
                                              </div><!-- slider -->
                                          </div><!--col col9-->
                                      </div>             
                                  </div>  <!-- container -->
                                <?php
                                   $align_count++;
                                }

                          }
                      }
                }
          }

        }

      }
  }

 if($wedding_services_object)
  {
    //echo "<pre>";print_r($wedding_services_object);exit;
    ?>
    <div class="container section-space wedding-service js_fade tab-two-col" >  
      <h2 class="sec-title align-center venue-blk" id="scroll2">Wedding Services</h2>
      <div class="row"> 
      <?php
        foreach ($wedding_services_object as $wedding_service_id)
        {
          $service_name = get_post_meta($wedding_service_id,'name',true);
          $service_image_id = get_post_meta($wedding_service_id,'image',true);
          $service_description = get_post_meta($wedding_service_id,'description',true);
          ?>
          <div class="col col4 service-block wedding-services-block">
              <input type="hidden" class="service_subject" value="Enquiry for Wedding service - <?php echo $service_name; ?> - <?php echo $GLOBALS['form_location']; ?>">
              <input type="hidden" class="service_name" value="<?php echo $service_name; ?>">
              <div class="item-blk">          
                  <?php if($service_image_id != '')
                    {
                      array_push($GLOBALS['wedding_services_image_array'],wp_get_attachment_url($service_image_id));
                      ?>
                      <div class="photoMaskVer img-div">  
                        <img src="<?php //echo wp_get_attachment_url($service_image_id); ?>" alt="<?php echo $service_name; ?>" title="<?php echo $service_name; ?>">
                      </div>
                      <?php 
                    } 
                  ?>
                  <?php if(trim($service_name) != ''){ ?>
                    <div class="item-head item-head-small hide-show">
                        <h4><?php echo $service_name;?></h4>
                    </div>
                  <?php } ?>
                  <?php if(trim($service_name) != '' && trim($service_description) != ''){ ?>
                        <div class="item-overlay hide-show">
                          <div class="overlay-inner">
                            <div class="text">
                              <h4 class="align-center"><?php echo $service_name;?></h4>
                                <div class=" mCustomScrollbar scroll-content">
                                  <p><?php echo $service_description; ?></p>
                                </div>
                                <a  href="#book-a-table2" class="fancybox"> <button type="button" class="btn primary-btn booking-nav-btn">Contact Us</button></a>
                            </div>
                            <div class="line"></div>
                          </div>
                        </div>
                  <?php } ?>
              </div>

           </div>
          <?php
        }
      ?>
      </div><!--container-->
    </div><!--row-->
    <?php
  }
?>
</div>