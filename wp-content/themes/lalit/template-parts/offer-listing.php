 <?php

  if (have_posts()) :
    while (have_posts()) : the_post();
      $content = get_the_content();
    endwhile;
  endif;

  $GLOBALS['image_array'] = $GLOBALS['offer_images'] = array();
  $destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);

  $hotel_id = '';
  if ($destination_obj->have_posts()) :
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
      $hotel_id = $post->ID;
      $offer_obj = get_offers_by_destination('hotel', $post->ID);
      $banner_images = get_post_meta($post->ID, "banner_images", true);

      $GLOBALS['address'] = get_post_meta($post->ID, "address", true);
      $GLOBALS['email'] = get_post_meta($post->ID, "email", true);
      $GLOBALS['phone'] = get_post_meta($post->ID, "phone", true);
      $GLOBALS['fax'] = get_post_meta($post->ID, "fax", true);
      //$GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);

      $GLOBALS['review_widget'] = get_post_meta($post->ID, "review_widget", true);

      $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

    endwhile;
  endif;

  ?>
 <div class="content-section">
   <?php
    if ($banner_images) {
      $banner_ids = array();
      foreach ($banner_images as $banner_image_id) {
        $banner_ids[] = $banner_image_id;
      }

      $images = get_banner_by_taxonomy($banner_ids, 'offers_listing');

      if ($images->have_posts()) :

        if ($images->post_count != 0) {

    ?>
         <div class="main-banner align-center banner-slider">
           <div id="banner-slider" class="flexslider">
             <ul class="slides">
               <?php
                while ($images->have_posts()) : $images->the_post();

                  if (isMobile()) {
                    $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                    $image = wp_get_attachment_url($image_id);
                  } else {
                    $image_id = get_post_meta($post->ID, 'banner_image', true);
                    $image = wp_get_attachment_url($image_id);
                  }

                  //array_push($GLOBALS['image_array'], $image);
                  $heading = get_post_meta($post->ID, 'banner_heading', true);
                  $description = get_post_meta($post->ID, 'banner_description', true);
                  $url = get_post_meta($post->ID, 'url', true);
                  //$button_text = get_post_meta($post->ID, 'button_text', true);

                  if ($image != '') {
                ?>
                   <li class="banner-image">
                     <?php
                      if ($url && trim($url) != '') {
                      ?>
                       <a href="<?php echo $url; ?>" class="block">
                       <?php
                      }
                        ?>
                       <img src="<?php echo $image; ?>" />
                       <div class="banner-content align-center">
                         <?php
                          if ($heading != '') {
                          ?>
                           <h1 class="main-title text-white text-shadow hide-show" style="display:none;"><?php echo $heading; ?></h1>
                         <?php
                          }
                          ?>

                         <?php
                          if ($description != '') {
                          ?>
                           <p class="banner-intro-text text-shadow text-white hide-show" style="display:none;"><?php echo $description; ?></p>
                         <?php
                          }
                          ?>
                       </div>
                       <?php
                        if ($url && trim($url) != '') {
                        ?>
                       </a>
                     <?php
                        }
                      ?>
                   </li>
               <?php
                  }
                endwhile;
                ?>
             </ul>
           </div>
           <!-- slider -->
         </div>
   <?php
        }

      endif;
    }

    //$nav_array = array('','suites & rooms','restaurants & bar','spa','events');
    $nav_array_display = $nave_array = array();
    ?>

   <?php
    if ($hotel_additional_information) {

      foreach ($hotel_additional_information as $info_id) {
        $offer_title = get_post_meta($info_id, 'offers_title', true);
        $offer_description = wpautop(get_post_meta($info_id, 'offers_description', true));
      }

      if ($offer_title && $offer_description) {

    ?>
       <div class="container section-space intro-text align-center">
         <div class="row">
           <div class="seperator"></div>
           <?php
            if ($offer_title) {
            ?>
             <h4 class="sec-title"><?php echo $offer_title; ?></h4>
           <?php
            }
            ?>

           <?php
            if ($offer_description) {
            ?>
             <div class="col col8 align-content-center">
               <p><?php echo $offer_description; ?></p>
             </div>
           <?php
            }
            ?>
         </div>
       </div>
   <?php

      }
    }
    ?>

   <?php
    if ($offer_obj->have_posts()) {
    ?>
     <div class="container fluid-width section-space offer-tab">
       <div class="row">
         <div class="col col12">
           <?php
            while ($offer_obj->have_posts()) {
              $offer_obj->the_post();
              $nav_array = get_field_object('offer_type');
              $nav_array = $nav_array['choices'];
              $nav_array = array_map('strtolower', $nav_array);
              $nav_array_display[] = get_post_meta($post->ID, 'offer_type', true);
            }

            $nav_array_display = array_unique($nav_array_display);

            asort($nav_array_display);
            ?>

           <?php if (isMobile()) { ?>
             <a class="selected_value filter-item mob-view">Our Offers <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
           <?php } ?>
           <ul class="smooth-scroll unstyled-listing filter-box filter-tab filter-nav" <?php if (isMobile()) {
                                                                                          echo ' style="display:none"';
                                                                                        } ?>>
             <?php
              if (!isMobile()) {
              ?>
               <span class="filter-label">Our Offers:</span>
             <?php
              }
              ?>
             <li class="nav-item active filter-fist-item offer-filter-nav<?php if (isMobile()) {
                                                                            echo ' mobile-offer-filter';
                                                                          } ?>"><a href="javascript:void(0);" class="list-all" data-category-type="list-all">All Offers</a></li>
             <?php
              foreach ($nav_array_display as $nav_menu_item_key) {

                $class_name = str_replace(' ', '-', $nav_array[$nav_menu_item_key]);
                $class_name = str_replace('&', 'and', $class_name);

                if (trim($class_name) != '' && $nav_array[$nav_menu_item_key] != '') {
              ?>
                 <li class="nav-item offer-filter-nav<?php if (isMobile()) {
                                                        echo ' mobile-offer-filter';
                                                      } ?>"><a href="javascript:void(0);" class="<?php echo $class_name; ?>" data-category-type="<?php echo $class_name; ?>"><?php echo ucfirst($nav_array[$nav_menu_item_key]); ?></a></li>
             <?php
                }
              }
              ?>
           </ul>
         </div>
       </div>
     </div>
   <?php
    }
    ?>


   <?php
    if ($offer_obj->have_posts()) {
    ?>
     <div class="container">
       <div class="row three-col-listing-block">
         <?php
          $counter = 0;
          while ($offer_obj->have_posts()) {
            $offer_obj->the_post();
            $offer_name = get_post_meta($post->ID, "name", true);
            $offer_image_id = get_post_meta($post->ID, "image", true);
            $offer_image = wp_get_attachment_url($offer_image_id);

            //$offer_description = get_post_meta($post->ID, "description", true);
            //$offer_description =  substr($offer_description, 0, 10).'...';
            $offer_type_id = get_post_meta($post->ID, 'offer_type', true);
            $class_name = str_replace(' ', '-', $nav_array[$offer_type_id]);
            $class_name = str_replace('&', 'and', $class_name);
            $offer_inclusions = wpautop(get_post_meta($post->ID, "inclusions", true));
            //$validity_from = get_post_meta($post->ID, "validity_from", true);
            //$validity_to = get_post_meta($post->ID, "validity_to", true);
            //$terms_condition = get_post_meta($post->ID, "terms_conditions", true);
            $offer_permalink = get_permalink($post->ID);
            $product_id = get_post_meta($post->ID, 'products', true);
            $offer_summary = get_post_meta($post->ID, "offer_summary", true);
            $offer_from = get_post_meta($post->ID, "validity_from", true);
            $offer_to = get_post_meta($post->ID, "validity_to", true);

            if (strlen($offer_summary) > 115) {
              $offer_summary = substr($offer_summary, 0, 115) . '...';
            }

            if ($offer_from != '' && $offer_to != '') {

              $offer_from = date("Y/m/d", strtotime($offer_from));
              $offer_to = date("Y/m/d", strtotime($offer_to));
              $today = date("Y/m/d");

              if ($today <= $offer_to && $offer_from <= $today) {
                //array_push($GLOBALS['offer_images'], $offer_image);
          ?>
               <div class="col col4 offer-listing-block offers-block buy-now-offer h-product <?php echo $class_name; ?><?php if ($counter % 3 == 0) {
                                                                                                                          echo ' first';
                                                                                                                        } ?>" data-category-type="<?php echo $class_name; ?>">
                 <?php if ($offer_image != '') { ?><a class="offer-listing-block-link" title="<?php echo $offer_name; ?>" href="<?php echo ($product_id) ? get_the_permalink($product_id[0]) : $offer_permalink; ?>"><img class="u-photo" src="<?php echo $offer_image; ?>" height="322" alt="<?php echo $offer_name; ?>" title="<?php echo $offer_name; ?>" /></a><?php } ?>
                 <?php if ($product_id) { ?><span class="buy-now-text">Buy Now!</span><?php } ?>
                 <div class="card-info">
                   <?php
                    if ($product_id) {
                    ?>
                     <input type="hidden" class="permalink" value="<?php the_permalink($product_id[0]); ?>">
                   <?php
                    } else {
                    ?>
                     <input type="hidden" class="permalink" value="<?php echo $offer_permalink; ?>">
                   <?php
                    }
                    ?>
                   <h5 class="card-info-title bdr-bottom"><span class="bdr-bottom-gold p-name"><?php echo $offer_name; ?></span></h5>
                   <p><?php echo $offer_summary; ?></p>
                   <?php

                    if ($product_id) {
                    ?>
                     <a title="<?php echo $offer_name; ?>" href="<?php the_permalink($product_id[0]); ?>" class="text-link u-url">Buy Now <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                   <?php
                    } else {
                    ?>
                     <a title="<?php echo $offer_name; ?>" href="<?php echo $offer_permalink; ?>" class="text-link u-url">Know More <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                   <?php
                    }
                    ?>
                   <!-- <a title="<?php echo $offer_name; ?>" href="#book-a-table" class="text-link u-url fancybox">Book Now<i class="ico-sprite sprite ico-red-right-arrow"></i></a> -->
                 </div><!-- card-info -->
               </div>
               <!--col4-->
             <?php
                $counter++;
              }
            } else {
              //array_push($GLOBALS['offer_images'], $offer_image);
              ?>
             <div class="col col4 offer-listing-block offers-block buy-now-offer h-product  <?php echo $class_name; ?><?php if ($counter % 3 == 0) {
                                                                                                                        echo ' first';
                                                                                                                      } ?>" data-category-type="<?php echo $class_name; ?>">
               <?php if ($offer_image != '') { ?><a class="offer-listing-block-link" title="<?php echo $offer_name; ?>" href="<?php echo ($product_id) ? get_the_permalink($product_id[0]) : $offer_permalink; ?>"><img class="u-photo" src="<?php echo $offer_image; ?>" height="322" alt="<?php echo $offer_name; ?>" title="<?php echo $offer_name; ?>" /></a><?php } ?>
               <?php if ($product_id) { ?><span class="buy-now-text">Buy Now!</span><?php } ?>
               <div class="card-info">
                 <?php
                  if ($product_id) {
                  ?>
                   <input type="hidden" class="permalink" value="<?php the_permalink($product_id[0]); ?>">
                 <?php
                  } else {
                  ?>
                   <input type="hidden" class="permalink" value="<?php echo $offer_permalink; ?>">
                 <?php
                  }
                  ?>
                 <h5 class="card-info-title bdr-bottom"><span class="bdr-bottom-gold p-name"><?php echo $offer_name; ?></span></h5>
                 <p><?php echo $offer_summary; ?></p>
                 <?php

                  if ($product_id) {
                  ?>
                   <a title="<?php echo $offer_name; ?>" href="<?php the_permalink($product_id[0]); ?>" class="text-link u-url">Buy Now <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                 <?php
                  } else {
                  ?>
                   <a title="<?php echo $offer_name; ?>" href="<?php echo $offer_permalink; ?>" class="text-link u-url">Know More <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                 <?php
                  }
                  ?>
                 <!-- <a title="<?php echo $offer_name; ?>" href="#book-a-table" class="text-link u-url fancybox">Book a Table<i class="ico-sprite sprite ico-red-right-arrow"></i></a> -->
               </div><!-- card-info -->
             </div>
             <!--col4-->
         <?php
              $counter++;
            }
          }
          ?>
       </div><!-- row -->
     </div>
   <?php
    }
    ?>
   <div id="book-a-table" class="pop-up" style="display: none;">
     <div class="form-header">
       <h2 class="page-title">
       </h2>
       <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
     </div>
     <?php
      echo do_shortcode('[contact-form-7 id="3370" title="Dining Form"]');
      ?>

     <div class="thank-you-block" style="display:none;">
       <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
       <h2 class="sec-title align-center">Request Sent</h2>
       <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
     </div><!-- thank-you-block -->

   </div><!-- pop-up -->
 </div><!-- content-section -->