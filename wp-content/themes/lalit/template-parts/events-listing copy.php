<?php
  $hotel_title = '';
  $meetings_phone='';
  $meetings_email='';
  $destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);
  if( $destination_obj->have_posts() ) : 
    while($destination_obj->have_posts()) : $destination_obj->the_post();
      
      $hotel_name = get_post_meta( $post->ID, 'name', true);
      $hotel_title = get_the_title($post->ID);
      $hotel_venue_object = get_post_meta( $post->ID, 'hotel_venues', true);
      $wedding_services_object = get_post_meta( $post->ID, 'wedding_services', true);
      $banner_images = get_post_meta($post->ID, "banner_images", true);
      $meetings_phone = get_post_meta($post->ID, "meetings_and_weddings_phone", true);
      $meetings_email = get_post_meta($post->ID, "meetings_and_weddings_email", true);
      
      $GLOBALS['venue_phone'] = $meetings_phone;
      $GLOBALS['venue_phone'] = trim($GLOBALS['venue_phone']);
      $GLOBALS['venue_phone'] = rtrim($GLOBALS['venue_phone'], ',');
      $GLOBALS['venue_phone'] = ltrim($GLOBALS['venue_phone'], ',');

      $GLOBALS['venue_email'] = $meetings_email;
      $GLOBALS['venue_email'] = trim($GLOBALS['venue_email']);
      $GLOBALS['venue_email'] = rtrim($GLOBALS['venue_email'], ',');
      $GLOBALS['venue_email'] = ltrim($GLOBALS['venue_email'], ',');

      $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
      $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
      $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
      $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
      $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

      $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
    endwhile;
  endif;

  $GLOBALS['form_hotel_title'] = $hotel_name;
  $GLOBALS['form_location'] = $GLOBALS['location'][0]->name;

  $GLOBALS['venues_dropdown'] = array();

  $GLOBALS['image_array'] = array();
  
?>
<div class="content-section">
<?php
   if($banner_images)
   {
      $banner_ids = array();
      foreach($banner_images as $banner_image_id)
      {
         $banner_ids[] = $banner_image_id;
      }

      $images = get_banner_by_taxonomy($banner_ids, 'meetings_events');

      if( $images->have_posts() ) : 

         ?>
            <div class="banner-slider align-center large-banner-sec">
               <div id="banner-slider" class="flexslider">
                  <ul class="slides">
                     <?php

                        while($images->have_posts()) : $images->the_post();

                           $image_id = get_post_meta($post->ID, 'banner_image', true);
                           if(isMobile())
                           {
                              $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                           }
                           else
                           {
                              $image = wp_get_attachment_url($image_id);
                           }
                           /*$heading = get_post_meta($post->ID, 'banner_heading', true);
                           $description = get_post_meta($post->ID, 'banner_description', true);
                           $url = get_post_meta($post->ID, 'url', true);*/

                           array_push($GLOBALS['image_array'], $image);
                           ?>
                              <li class="large-banner-sec banner-list"></li>
                           <?php
                           
                        endwhile;
                     ?>
                  </ul>
               </div>
               <!-- slider -->
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
          $events_title = get_post_meta($info_id, 'events_title', true);
          $events_description = wpautop(get_post_meta($info_id, 'events_description', true));
      }

  }
?>
    <div class="container intro-text section-space">
      <div class="row">
        <div class="col col9">
          <h2 class="page-title bdr-bottom">
            <small><?php echo $hotel_title; ?></small>
            <span class="bdr-bottom-gold"><?php echo $events_title; ?></span>
          </h2>
          <?php
          if($events_description)
          {
          ?>
            <p><?php echo $events_description; ?></p>
          <?php
          }
          ?>
        </div>

       <div class="col col3">
        
          
        <div class="contact-info"> 
          <p>For any queries, please don’t hesitate to contact us:</p>           
          <ul class="unstyled-listing h-card">

            <?php
            if($meetings_phone)
            {
                $meetings_phone = trim($meetings_phone);
                $meetings_phone = rtrim($meetings_phone, ',');
                $meetings_phone = ltrim($meetings_phone, ',');
                $phone_html = '';
                if(stripos($meetings_phone, ',') != FALSE)
                {
                    
                    $arr = explode(',', $meetings_phone);
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
                    $phone_html = '<a class="p-tel" href="tel:'.$meetings_phone.'">'.$meetings_phone.'</a>';
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
            if($meetings_email)
            {
                $meetings_email = trim($meetings_email);
                $meetings_email = rtrim($meetings_email, ',');
                $meetings_email = ltrim($meetings_email, ',');
                $email_html = '';
                if(stripos($meetings_email, ',') != FALSE)
                {
                    
                    $arr = explode(',', $meetings_email);
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
                    $email_html = '<a class="u-email" href="mailto:'.$meetings_email.'">'.$meetings_email.'</a>';
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
                <a href="#book-a-table" class="btn secondary-btn reserve-btn fancybox">contact our event specialist</a>
              </li> 
                                             
          </ul>
        </div>
            
        </div>
      <!-- col -->
      </div>
    <!-- row -->
    </div>
    <!-- container -->
<?php
  
  if($hotel_venue_object)
  {
    ?>
    <div class="container section-space venue-blk js_fade"> 
      <div class="row">
        <h2 class="sec-title align-center">Our Venues</h2>
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

          //echo "<pre>";print_r($wedding_taxonomies);exit;
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
                  if($wedding_taxonomy->slug == 'meetings_events')
                  {
                      array_push($GLOBALS['venues_dropdown'], $wedding_name);

                        if(isMobile())
                        {
                        ?>
                              <div class="container table-container section-space js_fade"> 
                                    <div class="row table-sec js_fade">
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
                                            <a href="#book-a-table" subject="Meeting Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue
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
                                <div class="container table-container section-space js_fade"> 
                                    <div class="row table-sec js_fade">
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
                                            <a href="#book-a-table" subject="Meeting Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue
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
                                <div class="container table-container section-space js_fade"> 
                                    <div class="row table-sec js_fade">
                                        <div class="col col4 tablecell">
                                           <?php if($wedding_name){ ?><h3 class="item-title underline"><?php echo $wedding_name; ?></h3><?php } ?>
                                           <?php if(trim($wedding_description) != ''){ ?><p><?php echo $wedding_description; ?></p><?php } ?>
                                            <?php if(trim($wedding_virtual_tour) != '' || $wedding_floor_plan != ''){ ?>
                                            <ul class="unstyled-listing underline-list">
                                                <?php if(trim($wedding_virtual_tour) != ''){ ?><li><a href="<?php echo $wedding_virtual_tour; ?>" class="text-link">Virtual tour <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i></a></li><?php } ?>
                                                <?php if(trim($wedding_floor_plan) != ''){ ?><li><a href="<?php echo wp_get_attachment_url($wedding_floor_plan); ?>" class="text-link">Floor plan <i class="ico-sprite sprite size-12 ico-red-right-arrow"></i> </a></li><?php } ?>
                                            </ul>
                                            <?php } ?>

                                              <a href="#book-a-table" subject="Meeting Enquiry for <?php echo $wedding_name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" class="text-link uppercase fancybox res-btn book-btn" data-id="<?php echo $wedding_name; ?>">Book this Venue
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
                                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $wedding_name; ?>" title="<?php echo $wedding_name; ?>"/>
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
?>
</div>