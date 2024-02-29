<?php

$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
$city_name = $GLOBALS['location'][0]->slug;
$hotel_id = '';
$hotel_title = '';
$hotel_name = '';

if ($destination_obj->have_posts()) :

  while ($destination_obj->have_posts()) : $destination_obj->the_post();

    $hotel_id = $post->ID;
    $hotel_title = get_the_title($post->ID);
    $hotel_name = get_post_meta($post->ID, "name", true);
    $hotel_features = get_post_meta($post->ID, "facilities", true);
    $hotel_services = get_post_meta($post->ID, "hotel_services", true);

    $banner_images = get_post_meta($post->ID, "banner_images", true);

    $GLOBALS['address'] = get_post_meta($post->ID, "address", true);
    $GLOBALS['email'] = get_post_meta($post->ID, "email", true);
    $GLOBALS['phone'] = get_post_meta($post->ID, "phone", true);
    $GLOBALS['fax'] = get_post_meta($post->ID, "fax", true);

    $GLOBALS['review_widget'] = get_post_meta($post->ID, "review_widget", true);

    $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

    /*****  for wellness form ******/

    $GLOBALS['form_hotel_title'] = $hotel_name;
    $GLOBALS['form_location'] = $GLOBALS['location'][0]->name;

    /*****  for wellness form ******/

    $offers = get_offers_by_spa_events('hotel', $post->ID, 2);
    $GLOBALS['listing_offers'] = $offers;

  endwhile;

endif

?>

<div class="content-section">

  <?php

  $GLOBALS['image_array'] = $GLOBALS['spa_images'] = $GLOBALS['needs_array'] = array();

  if ($banner_images) {
    $banner_ids = array();
    foreach ($banner_images as $banner_image_id) {
      $banner_ids[] = $banner_image_id;
    }

    $images = get_banner_by_taxonomy($banner_ids, 'relax_and_unwind');

    if ($images->have_posts()) :
  ?>
      <div class="main-banner banner-slider align-center">
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
              $heading = get_post_meta($post->ID, 'banner_heading', true);
              $description = get_post_meta($post->ID, 'banner_description', true);
              $url = get_post_meta($post->ID, 'url', true);
              //$button_text = get_post_meta($post->ID, 'button_text', true);

              if ($image != '') {
            ?>
                <li class="banner-list">
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
                      if ($heading && trim($heading) != '') {
                      ?>
                        <h1 class="main-title text-shadow hide-show" style="display:none;"><?php echo $heading; ?></h1>
                      <?php
                      }
                      ?>
                      <?php
                      if ($description && trim($description) != '') {
                      ?>
                        <p class="banner-intro-text text-white text-shadow hide-show" style="display:none;"><?php echo $description; ?></p>
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
        </div><!-- flexslider -->
      </div><!-- banner-slider -->
  <?php
    endif;
  }

  ?>



  <?php
  if ($hotel_additional_information) {

    foreach ($hotel_additional_information as $info_id) {
      $relax_title = get_post_meta($info_id, 'relax_title', true);
      $relax_description = wpautop(get_post_meta($info_id, 'relax_description', true));
    }

  ?>
    <div class="container section-space intro-text align-center">
      <div class="row">
        <div class="seperator"></div>
        <?php
        if ($relax_title) {
        ?>
          <h4 class="sec-title"><?php echo $relax_title; ?></h4>
        <?php
        }
        ?>

        <?php
        if ($relax_description) {
        ?>
          <div class="col col10 align-content-center "><?php echo $relax_description; ?></div>
        <?php
        }
        ?>
      </div>
    </div>
  <?php

  }
  ?>


  <?php

  if ($hotel_features) {

    $feature_count = 1;
    foreach ($hotel_features as $hotel_feature_id) {

      if (get_post_status($hotel_feature_id) == 'publish') {
        $name = get_post_meta($hotel_feature_id, 'name', true);
        $images = get_post_meta($hotel_feature_id, 'images', true);
        $images = explode(',', $images);

        $description = wpautop(get_post_meta($hotel_feature_id, 'description', true));
        $timings = get_post_meta($hotel_feature_id, 'timings', true);
        $contact = get_post_meta($hotel_feature_id, 'contact', true);
        $is_bookable = get_post_meta($hotel_feature_id, 'is_bookable', true);


        if (isMobile()) {
  ?>
          <div class="container table-container section-space js_fade">
            <div class="row table-sec">
              <?php
              if ($images && count($images) > 0) {

                if (count($images) > 1) {
              ?>
                  <div class="col col8 tablecell">
                    <div id="slider" class="flexslider slider">
                      <ul class="slides">
                        <?php
                        foreach ($images as $image_id) {
                          $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                          array_push($GLOBALS['spa_images'], $image);
                        ?>
                          <li class="spa_images h-product">
                            <img class="u-photo" src="<?php //echo $image; 
                                                      ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                          </li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div><!-- slider -->
                  </div>
                  <!--col col9-->
                <?php
                } else {
                ?>
                  <div class="col col8 tablecell">
                    <div id="slider" class="">
                      <ul class="slides">
                        <?php
                        foreach ($images as $image_id) {
                          $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                          array_push($GLOBALS['spa_images'], $image);
                        ?>
                          <li class="spa_images h-product">
                            <img class="u-photo" src="<?php //echo $image; 
                                                      ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                          </li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div><!-- slider -->
                  </div>
                  <!--col col9-->
              <?php
                }
              }
              ?>

              <?php
              if ($description != '' || $timings != '' || $contact != '' || $name != '') {
              ?>

                <div class="col col4 tablecell h-product">
                  <?php
                  if ($name != '') {
                  ?>
                    <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                  <?php
                  }
                  ?>

                  <?php
                  if ($description != '') {
                  ?>
                    <p><?php echo $description; ?></p>
                  <?php
                  }
                  ?>

                  <?php
                  if ($timings != '' || $contact != '') {
                  ?>
                    <ul class="unstyled-listing">
                      <?php
                      if ($timings != '') {
                      ?>
                        <li>
                          <strong class="uppercase">Hours</strong>
                          <p><?php echo $timings; ?></p>
                        </li>
                      <?php
                      }
                      ?>

                      <?php
                      if ($contact != '') {
                      ?>
                        <li>
                          <strong class="uppercase">Get-in-touch</strong>
                          <p><a class="p-tel" href="tel:<?php echo $contact; ?>"><?php echo $contact; ?></a></p>
                        </li>
                      <?php
                      }
                      ?>

                      <?php
                      if ($is_bookable) {
                      ?>
                        <li>

                          <a href="#book-a-table-<?php echo $feature_count; ?>" class="text-link uppercase fancybox res-btn book-btn fancybox" data-count="<?php echo $feature_count; ?>">Book <?php echo $name; ?>
                            <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                          </a>

                          <input type="hidden" id="subject-<?php echo $feature_count; ?>" value="Enquiry for <?php echo $name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" />

                          <input type="hidden" id="wellness-name-<?php echo $feature_count; ?>" value="<?php echo $name; ?>" />

                          <input type="hidden" id="hotel-name-<?php echo $feature_count; ?>" value="<?php echo $hotel_title; ?>" />

                          <input type="hidden" id="location-<?php echo $feature_count; ?>" value="<?php echo $GLOBALS['location'][0]->name; ?>" />

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
          if ($is_bookable) {
          ?>
            <div id="book-a-table-<?php echo $feature_count; ?>" class="pop-up" style="display: none;">
              <div class="form-header">
                <h2 class="page-title">
                  <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                  <?php echo $name; ?>
                </h2>
                <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
              </div>
              <?php
              echo do_shortcode('[contact-form-7 id="3372" title="Wellness form"] ');
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

        } else {

          if ($feature_count % 2 != 0) {
          ?>
            <div class="container table-container section-space js_fade unwind">
              <div class="row table-sec">
                <?php
                if ($images && count($images) > 0) {

                  if (count($images) > 1) {
                ?>
                    <div class="col col8 tablecell">
                      <div id="slider" class="flexslider slider">
                        <ul class="slides">
                          <?php
                          foreach ($images as $image_id) {
                            $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                            array_push($GLOBALS['spa_images'], $image);
                          ?>
                            <li class="spa_images h-product">
                              <img class="u-photo" src="<?php //echo $image; 
                                                        ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div><!-- slider -->
                    </div>
                    <!--col col9-->
                  <?php
                  } else {
                  ?>
                    <div class="col col8 tablecell">
                      <div id="slider" class="">
                        <ul class="slides">
                          <?php
                          foreach ($images as $image_id) {
                            $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                            array_push($GLOBALS['spa_images'], $image);
                          ?>
                            <li class="spa_images h-product">
                              <img class="u-photo" src="<?php //echo $image; 
                                                        ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div><!-- slider -->
                    </div>
                    <!--col col9-->
                <?php
                  }
                }
                ?>

                <?php
                if ($description != '' || $timings != '' || $contact != '' || $name != '') {
                ?>

                  <div class="col col4 tablecell h-product">
                    <?php
                    if ($name != '') {
                    ?>
                      <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                    <?php
                    }
                    ?>

                    <?php
                    if ($description != '') {
                    ?>
                      <p><?php echo $description; ?></p>
                    <?php
                    }
                    ?>

                    <?php
                    if ($timings != '' || $contact != '') {
                    ?>
                      <ul class="unstyled-listing">
                        <?php
                        if ($timings != '') {
                        ?>
                          <li>
                            <strong class="uppercase">Hours</strong>
                            <p><?php echo $timings; ?></p>
                          </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($contact != '') {
                        ?>
                          <li>
                            <strong class="uppercase">Get-in-touch</strong>
                            <p><a class="p-tel" href="tel:<?php echo $contact; ?>"><?php echo $contact; ?></a></p>
                          </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($is_bookable) {
                        ?>
                          <li>

                            <a href="#book-a-table-<?php echo $feature_count; ?>" class="text-link uppercase fancybox res-btn book-btn fancybox" data-count="<?php echo $feature_count; ?>">Book <?php echo $name; ?>
                              <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                            </a>

                            <input type="hidden" id="subject-<?php echo $feature_count; ?>" value="Enquiry for <?php echo $name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" />

                            <input type="hidden" id="wellness-name-<?php echo $feature_count; ?>" value="<?php echo $name; ?>" />

                            <input type="hidden" id="hotel-name-<?php echo $feature_count; ?>" value="<?php echo $hotel_title; ?>" />

                            <input type="hidden" id="location-<?php echo $feature_count; ?>" value="<?php echo $GLOBALS['location'][0]->name; ?>" />

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
            if ($is_bookable) {
            ?>
              <div id="book-a-table-<?php echo $feature_count; ?>" class="pop-up" style="display: none;">
                <div class="form-header">
                  <h2 class="page-title">
                    <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                    <?php echo $name; ?>
                  </h2>
                  <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
                </div>
                <?php
                echo do_shortcode('[contact-form-7 id="3372" title="Wellness form"] ');
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
          } else {
          ?>
            <div class="container table-container js_fade">
              <div class="row table-sec section-space">

                <?php
                if ($description != '' || $timings != '' || $contact != '' || $name != '') {
                ?>

                  <div class="col col4 tablecell h-product">
                    <?php
                    if ($name != '') {
                    ?>
                      <h3 class="item-title underline p-name"><?php echo $name; ?></h3>
                    <?php
                    }
                    ?>

                    <?php
                    if ($description != '') {
                    ?>
                      <p><?php echo $description; ?></p>
                    <?php
                    }
                    ?>

                    <?php
                    if ($timings != '' || $contact != '') {
                    ?>
                      <ul class="unstyled-listing">
                        <?php
                        if ($timings != '') {
                        ?>
                          <li>
                            <strong class="uppercase">Hours</strong>
                            <p><?php echo $timings; ?></p>
                          </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($contact != '') {
                        ?>
                          <li>
                            <strong class="uppercase">Get-in-touch</strong>
                            <p class="p-tel"><?php echo $contact; ?></p>
                          </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($is_bookable) {
                        ?>
                          <li>
                            <a href="#book-a-table-<?php echo $feature_count; ?>" class="text-link uppercase fancybox res-btn book-btn fancybox" data-count="<?php echo $feature_count; ?>">Book <?php echo $name; ?>
                              <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                            </a>

                            <input type="hidden" id="subject-<?php echo $feature_count; ?>" value="Enquiry for <?php echo $name; ?> - <?php echo $GLOBALS['location'][0]->name; ?>" />

                            <input type="hidden" id="wellness-name-<?php echo $feature_count; ?>" value="<?php echo $name; ?>" />

                            <input type="hidden" id="hotel-name-<?php echo $feature_count; ?>" value="<?php echo $hotel_title; ?>" />

                            <input type="hidden" id="location-<?php echo $feature_count; ?>" value="<?php echo $GLOBALS['location'][0]->name; ?>" />
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


                <?php
                if ($images && count($images) > 0) {

                  if (count($images) > 1) {
                ?>
                    <div class="col col8 tablecell">
                      <div id="slider" class="flexslider slider">
                        <ul class="slides">
                          <?php
                          foreach ($images as $image_id) {
                            $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                            //$image = wp_get_attachment_url($image_id);
                            array_push($GLOBALS['spa_images'], $image);
                          ?>
                            <li class="spa_images h-product">
                              <img class="u-photo" src="" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div><!-- slider -->
                    </div>
                    <!--col col9-->
                  <?php
                  } else {
                  ?>
                    <div class="col col8 tablecell">
                      <div id="slider" class="">
                        <ul class="slides">
                          <?php
                          foreach ($images as $image_id) {
                            $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                            //$image = wp_get_attachment_url($image_id);
                            array_push($GLOBALS['spa_images'], $image);
                          ?>
                            <li class="spa_images h-product">
                              <img class="u-photo" src="" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div><!-- slider -->
                    </div>
                    <!--col col9-->
                <?php
                  }
                }
                ?>



              </div>
            </div> <!-- container -->

            <?php
            if ($is_bookable) {
            ?>
              <div id="book-a-table-<?php echo $feature_count; ?>" class="pop-up" style="display: none;">
                <div class="form-header">
                  <h2 class="page-title">
                    <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                    <?php echo $name; ?>
                  </h2>
                  <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
                </div>
                <?php
                echo do_shortcode('[contact-form-7 id="3372" title="Wellness form"] ');
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
          }
        }

        $feature_count++;
      }
    }
  }

  ?>
<?php if ($city_name != 'london')  : ?>
  <?php

  if ($hotel_services) {

  ?>
    <div class="container section-space js_fade" style="display:none;">
      <div class="row">
        <h2 class="sec-title align-center">Taking Care of your Needs</h2>
      </div>
    </div>

    <?php
    if (count($hotel_services) > 1) {
    ?>
      <div class="container js_fade">
        <div class="row">
          <div class="owl-carousel owl-theme">
            <?php
            foreach ($hotel_services as $hotel_servixe_id) {

              if (get_post_status($hotel_servixe_id) == 'publish') {
                $name = get_post_meta($hotel_servixe_id, 'name', true);
                $images = get_post_meta($hotel_servixe_id, 'image', true);
                $images = explode(',', $images);

                foreach ($images as $image_id) {
                  //$image = wp_get_attachment_image_src($image_id, 'box_image')[0];
                  $image = wp_get_attachment_url($image_id);
                }
                array_push($GLOBALS['needs_array'], $image);
                $description = get_post_meta($hotel_servixe_id, 'description', true);
                $timings = get_post_meta($hotel_servixe_id, 'timings', true);
            ?>
                <div class="card-item">

                  <div class="card-img needs-section">
                    <img src="<?php //echo $image; 
                              ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                  </div>

                  <?php
                  if ($name != '' || $description != '') {
                  ?>
                    <div class="card-info">
                      <?php
                      if ($name != '') {
                      ?>
                        <h3 class="card-info-title bdr-bottom">
                          <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                        </h3>
                      <?php
                      }
                      ?>

                      <?php
                      if ($description != '') {
                      ?>
                        <p><?php echo $description; ?></p>
                      <?php
                      }
                      ?>
                    </div>
                  <?php
                  }
                  ?>

                </div>

            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>

    <?php
    } else {
    ?>
      <div class="container js_fade">
        <div class="row">
          <div class="owl-theme">
            <?php
            foreach ($hotel_services as $hotel_service_id) {
              if (get_post_status($hotel_servixe_id) == 'publish') {
                $name = get_post_meta($hotel_service_id, 'name', true);
                $images = get_post_meta($hotel_service_id, 'image', true);

                $images = explode(',', $images);

                foreach ($images as $image_id) {
                  //$image = wp_get_attachment_image_src($image_id, 'box_image')[0];
                  $image = wp_get_attachment_url($image_id);
                }
                array_push($GLOBALS['needs_array'], $image);
                $description = get_post_meta($hotel_service_id, 'description', true);
                $timings = get_post_meta($hotel_service_id, 'timings', true);
            ?>
                <div class="card-item">

                  <div class="card-img needs-section">
                    <img src="<?php //echo $image; 
                              ?>" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                  </div>

                  <?php
                  if ($name != '' || $description != '') {
                  ?>
                    <div class="card-info">
                      <?php
                      if ($name != '') {
                      ?>
                        <h3 class="card-info-title bdr-bottom">
                          <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                        </h3>
                      <?php
                      }
                      ?>

                      <?php
                      if ($description != '') {
                      ?>
                        <p><?php echo $description; ?></p>
                      <?php
                      }
                      ?>
                    </div>
                  <?php
                  }
                  ?>

                </div>

            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    <?php

    }
    ?>

</div>
</div>
<?php

  }
endif;
?>

<?php
if ($offers->have_posts()) :

  get_template_part('includes/available', 'offers-listing');

endif;
?>

</div>