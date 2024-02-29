<div class="content-section">
  <?php

    $destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

    $hotel_id = '';
    if( $destination_obj->have_posts() ) : 
      while($destination_obj->have_posts()) : $destination_obj->the_post();

        $hotel_id = $post->ID;
        $hotel_title = get_the_title($post->ID);
        $hotel_name = get_post_meta( $post->ID, "name", true);
        $hotel_features = get_post_meta( $post->ID, "facilities", true);
        $hotel_services = get_post_meta( $post->ID, "hotel_services", true);
    
        $banner_images = get_post_meta($post->ID, "banner_images", true);
    
        $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
        $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
        $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
        $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
    
        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
    
        $offers = get_offers_by_spa_events('hotel', $post->ID, 2);
        
      endwhile;
    endif;


    if($banner_images)
    {
      $banner_ids = array();
      foreach($banner_images as $banner_image_id)
      {
        $banner_ids[] = $banner_image_id;
      }

      $banners = get_banner_by_taxonomy($banner_ids, 'relax_and_unwind');
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

    
    
    
    
    if($hotel_additional_information)
    {

      foreach($hotel_additional_information as $info_id)
      {
        $title = get_post_meta($info_id, 'relax_title', true);
        $description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($info_id, 'relax_description', true)));
      }

      if($title || $description)
      {
        include(get_template_directory() . '/amp/includes/amp-title-description.php');
      }

    }

    
    
    if($hotel_features){

      $feature_count = 1;
      foreach($hotel_features as $hotel_feature_id)
      {
        
        if(get_post_status ( $hotel_feature_id ) == 'publish')
        {
          $name = get_post_meta($hotel_feature_id, 'name', true);
          $images = get_post_meta($hotel_feature_id, 'images', true);
          $images = explode(',', $images);

          $description = wpautop(get_post_meta($hotel_feature_id, 'description', true));
          $timings = get_post_meta($hotel_feature_id, 'timings', true);
          $contact = get_post_meta($hotel_feature_id, 'contact', true);
          $is_bookable = get_post_meta($hotel_feature_id, 'is_bookable', true);
          
        }

        ?>
        <div class="container table-container section-space js_fade">
          <div class="row table-sec">
            <?php
              if($images && count($images) > 0)
              {

                ?>
                <div class="tablecell">
                  <div id="slider" class="">
                    <amp-carousel id="custom-button" class="amp-carousel"
                      width="820"
                      height="420"
                      layout="responsive"
                      type="slides"
                      autoplay
                      controls
                      delay="8000">
                      <?php
                      foreach($images as $image_id)
                      {
                        $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                        ?>
                        <amp-img src="<?php echo $image; ?>"
                          layout="responsive"
                          width="820"
                          height="420"
                          alt="<?php echo $name; ?>">
                        </amp-img>
                        <?php
                      }
                      ?>
                    </amp-carousel>
                  </div><!-- slider -->
                </div><!--col col9-->
                <?php
              }
      
              if($description != '' || $timings != '' || $contact != '' || $name != '')
              {
              ?>

                <div class="tablecell intro-text">
                  <?php
                    if($name != '')
                    {
                    ?>
                      <h3 class="item-title underline"><?php echo $name; ?></h3>
                    <?php
                    }
                  ?>

                  <?php
                    if($description != '')
                    {
                    ?>
                      <p><?php echo the_lalit_remove_image_tags_amp($description); ?></p>
                    <?php
                    }
                  ?>

                  <?php
                    if($timings != '' || $contact != '')
                    {
                    ?>
                      <ul class="unstyled-listing relax-description-listing">
                        <?php
                          if($timings != '')
                          {
                            ?>
                            <li>
                              <strong class="uppercase relax-type">Hours</strong>
                              <p class="relax-description-container"><?php echo $timings; ?></p>
                            </li>
                            <?php
                          }
                        ?>

                        <?php
                          if($contact != '')
                          {
                            ?>
                            <li>
                              <strong class="uppercase relax-type">Get-in-touch</strong>
                                <p class="relax-description-container"><a class="relax-contact"><?php echo $contact; ?></a></p>
                            </li>
                            <?php
                          }
                        ?>

                        <?php
                          if($is_bookable)
                          {
                            ?>
                            <li>
                              <a href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/relax-and-unwind/?book-a-table=<?php echo $feature_count; ?>" class="text-link uppercase fancybox res-btn book-btn fancybox" data-count="<?php echo $feature_count; ?>">Book <?php echo $name; ?> 
                                <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                              </a>
                            </li>
                            <?php
                          }
                        ?>
                      </ul>
                    <?php
                    }
                  ?>
                </div>

              <?php
            }
            ?>

          </div>
        </div> <!-- container -->
        <?php

        $feature_count++;
      }
    }
    
    
    
    
    $hotel_services = get_post_meta($hotel_id,"hotel_services",true);
    if($hotel_services)
    {

      $data_array = array();
      $i = 0;
      foreach($hotel_services as $hotel_servixe_id)
      {
          if(get_post_status ( $hotel_servixe_id ) == 'publish')
          {
              $data_array[$i]['title'] = get_post_meta($hotel_servixe_id, 'name', true);
              $images = get_post_meta($hotel_servixe_id, 'image', true);
              $images = explode(',', $images);
              $data_array[$i]['image'] = wp_get_attachment_url($images[0]);
              $i++;
          }
      }

      if(count($data_array) > 0){
          
          $height = 400;
          $width = 400;
          $section_title = 'Taking Care of your Needs';
          include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');

      }
      unset($data_array);

    }
    unset($hotel_services);


    
    
    
    
    if( $offers->have_posts() ) : 

      $section_title = "Offers";
      $loop = $offers;
      $city_name = $GLOBALS['location'][0]->slug;
      $width = 715;
      $height = 380;
      $class1 = 'content-body';
      $class = '';
      include_once(get_template_directory() . '/amp/includes/amp-available-offers.php');

    endif;
  ?>
</div>