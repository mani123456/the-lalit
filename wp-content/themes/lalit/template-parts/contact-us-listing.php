<div class="content-section small-banner contact-us">
  <!-- slider -->
  <div class="container align-center small-banner-sec js_fade" style="background-image:url('/wp-content/themes/lalit/images/contact-us-banner.jpg')">
    <div class="row">
      <div class="banner-content">
        <h1 class="main-title text-shadow">contact us</h1>
      </div><!-- banner-content -->
    </div><!-- row -->
  </div><!-- container -->

  <div class="container section-space intro-text align-center">
    <!-- container-->
    <div class="row">
      <!-- row-->
      <h2 class="sec-title">We remain at your service at The LaLiT Hotels</h2>
      <div class="col col8 align-content-center ">
        <!-- col -->
        <p>Should you require more information about The LaLiT or would like to arrange bookings at any of our luxury hotels, resorts and palaces, please do not hesitate to contact us.</p>
        <div class="btn-block align-center   fade-border-bottom">
          <a href="#contact-us" class="btn primary-btn margin-top-20 contact-btn fancybox" title="Contact US">contact us</a>
        </div><!-- btn-block -->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- container-->

  <div class="container office-details">
    <!-- container-->
    <div class="row align-center">
      <!-- row-->
      <div class="col col5 align-content-center">
        <!-- col -->
        <h2 class="sec-title">Corporate Office</h2>
        <h6 class="small-title"> Bharat Hotels Limited</h6>
        <address> Barakhamba Avenue, Connaught Place, New Delhi - 110 001, India</address>
        <div class="contact-info">
          <!-- contact-info-->
          <ul class="unstyled-listing">
            <li class="contact-details">

              <i class="ico-sprite sprite size-24 ico-phone"></i>
              <p> <a href="tel:+91 11 4444 7777">+91 11 4444 7777 </a></p>
            </li>
            <li class="contact-details">
              <i class="ico-sprite sprite size-24 ico-email"></i>
              <p><a href="mailto:corporate@thelalit.com">corporate@thelalit.com</a> | <a href="mailto:bookings@thelalit.com">bookings@thelalit.com</a> </p>
            </li>
          </ul>

          <a href="http://www.google.com/maps/dir/''/The+Lalit+New+Delhi,+Barakhamba+Avenue,+Connaught+Place,Near+Modern+School,+New+Delhi,+Delhi+110001,+India/@28.6313,77.2273,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x390cfd32312dee27:0xc40680170b85d192!2m2!1d77.2273338!2d28.6313495" class="text-link small-size-link" target="_blank"> Get directions <i class="ico-sprite sprite size-16 ico-red-right-arrow"></i></a>
        </div> <!-- contact-info-->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- container-->

  <?php


  $args = array(
    'post_type' => 'destination',
    'post_status' => 'publish',
    'posts_per_page' => '-1',
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'name'
  );

  $loop = new WP_Query($args);

  if ($loop->have_posts()) {
  ?>
    <div class="container section-bg hotel-contact-section">
      <!-- container-->
      <h2 class="sec-title align-center">Hotel Contact Information</h2>
      <div class="row four-col-listing">
        <!-- row-->
        <?php

        while ($loop->have_posts()) {

          $loop->the_post();
          $name = get_post_meta($post->ID, 'name', true);
          $address = strip_tags(wpautop(get_post_meta($post->ID, 'address', true)));
          $latitude = get_post_meta($post->ID, 'latitude', true);
          $longitude = get_post_meta($post->ID, 'longitude', true);

          $address_map = '';

          if (trim($name) != '' && trim($latitude) != '' && trim($longitude) != '' && trim($address) != '') {

            $name_1 = str_replace(' ', '+', $name);
            $address_1 = strip_tags($address);
            $address_1 = str_replace(' ', '+', $address);


            $address_map = "http://www.google.com/maps/dir/''/" . $name_1 . ",+" . $address_1 . "/@" . $latitude . "," . $longitude . ",12z";
            //$address_map = str_replace(' ', '+', $address_map);
          }

          $phone = get_post_meta($post->ID, 'phone', true);

          if (trim($phone) != '') {
            if (strpos($phone, '/') != false) {
              $phone = explode('/', $phone);
            }
          }

          $email = get_post_meta($post->ID, 'email', true);

        ?>
          <div class="col col3 contact-global">
            <!-- col -->

            <?php if (trim($name) != '') { ?>
              <h6 class="small-title"><?php echo $name; ?></h6>
              <?php if($name == 'The LaLiT London')
              {
                ?>
                <span class="">(Managed By The LaLiT)</span>
              <?php
               }
              ?>
            <?php } ?>

            <?php if (trim($address) != '') { ?><address><?php echo $address; ?></address><?php } ?>
            <?php

            if (is_array($phone)) {

            ?>
              <p>Tel:
                <?php
                for ($i = 0; $i < count($phone); $i++) {
                  if (trim($phone[$i]) != '') {
                    $phone[$i] = str_replace('-', ' ', $phone[$i]);
                ?>
                    <a href="tel:<?php echo $phone[$i]; ?>"> <?php echo $phone[$i]; ?></a>
                <?php

                    if ($i < count($phone) - 1) {
                      echo "/";
                    }
                  }
                }
                ?>
              </p>
            <?php
            } else if (trim($phone) != '') {
              $phone = str_replace('-', ' ', $phone);
            ?>
              <p>Tel:<a href="tel:<?php echo $phone; ?>"> <?php echo $phone; ?></a></p>
            <?php
            }
            ?>
            <?php if (trim($email) != '') { ?><p>Email:<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p><?php } ?>
            <?php if ($address_map != '') { ?><a href="<?php echo $address_map; ?>" class="text-link small-size-link" target='_blank'> Get directions <i class="ico-sprite sprite size-16 ico-red-right-arrow"></i></a><?php } ?>
          </div><!-- col -->
        <?php
        }

        ?>
      </div><!-- row -->
    </div><!-- container-->
  <?php
  }
  wp_reset_postdata();
  ?>

  <div class="container regional-office-section">
    <!-- container-->
    <h2 class="sec-title align-center">Regional Sales Office</h2>
    <div class="row four-col-listing">
      <!-- row-->
      <div class="col col3 contact-global">
        <!-- col -->
        <h6 class="small-title">Gurgaon</h6>
        <span>Mani Ketan Walia </span>
        <p>Associate Head of Sales</p>
        <!-- <address>C 71 A, 7th Floor, Supermart 1, Sushant Lok Phase 1, DLF Phase 4, Gurgaon.</address> -->
        <p>Tel:
          <!-- <a href="tel:0124-4112 356"> +01 244 112 356</a>, --> <a href="tel:+919971609991"> +91 997 1609 991</a>
        </p>
        <p>Email:<a href="mailto:mani.ketan@thelalit.com">mani.ketan@thelalit.com</a></p>
      </div><!-- col -->

      <div class="col col3 contact-global">
        <!-- col -->
        <h6 class="small-title">Pune</h6>
        <span>Vishal Gosavi</span>
        <p>Head of Sales</p>
        <!-- <address>Regus, Level II, Connaught Place, Bund Garden Road, Pune, 411 001, India.</address> -->
        <p>Tel:<a href="tel:+91 860 0025 011"> +91 860 0025 011</a></p>
        <!-- <p>Fax: <a href="fax:+91 (0) 20 4014 7576"> +91 (0) 20 4014 7576 </a></p> -->
        <p>Email:<a href="mailto:vgosavi@thelalit.com"> vgosavi@thelalit.com</a></p>
      </div><!-- col -->

      <div class="col col3 contact-global">
        <!-- col -->
        <h6 class="small-title">Ahmedabad</h6>
        <span>Sachin Bhola</span>
        <p>Sales Manager (Gujarat Region)</p>
        <!-- <address>16 - 17 National Chambers, Near City Gold, Ashram Road, Ahmedabad 380009.</address> -->
        <p>Tel:<!-- <a href="tel:+91 796 5223 225"> +91 796 5223 225</a>, --> <a href="tel:+919784686000">+91 978 4686 000</a></p>
        <p>Email:<a href="mailto:sbhola@thelalit.com">sbhola@thelalit.com </a></p>
      </div><!-- col -->

      <div class="col col3 contact-global">
        <!-- col -->
        <h6 class="small-title">Hyderabad</h6>
        <span>Vijaya. M</span>
        <p>Sr. Sales Manager</p>
        <!-- <address>Image Business Centre, 8-2-672/S/301, Sufi Chambers, Road No. 1, Banjara Hills, Hyderabad - 34</address> -->
        <p>Tel:<a href="tel:+919901169527"> +91  990 1169 527</a></p>
        <p>Email:<a href="mailto:vijayam@thelalit.com">vijayam@thelalit.com</a></p>
      </div><!-- col -->

      <div class="col col3 contact-global">
        <!-- col -->
        <h6 class="small-title">Chennai</h6>
        <span>Vijaya. M</span>
        <p>Sr. Sales Manager</p>
        <!-- <address>Image Business Centre, 8-2-672/S/301, Sufi Chambers, Road No. 1, Banjara Hills, Hyderabad - 34</address> -->
        <p>Tel:<a href="tel:+919901169527"> +91  990 1169 527</a></p>
        <p>Email:<a href="mailto:vijayam@thelalit.com">vijayam@thelalit.com</a></p>
        
        <!-- <span>Vijaya. M</span>
        <p>Sr. Sales Manager</p> -->
        <!-- <address>1/62E, 13 A Cross Street, Ravi Colony, St. Thomas Mount, Chennai - 600016</address> -->
        <!-- <p>Tel:
          <a href="tel:+91 44 4266 0051"> +91 44 4266 0051</a><a href="tel:+91 9901169527"> +91 990 1169 527</a>
        </p>
        <p>Email:<a href="mailto:vijayam@thelalit.com"> vijayam@thelalit.com</a></p> -->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- container-->
</div><!-- content-section -->


<div id="contact-us" class="pop-up" style="display: none;">
  <div class="form-header">
    <h2 class="page-title">
      Contact Us
    </h2>
  </div>
  <?php echo do_shortcode('[contact-form-7 id="7208" title="Contact Us Global Form"]'); ?>
  <div class="thank-you-sec thank-you-section" style="display:none;">
    <div class="row">
      <div class="thank-you-block align-content-center not-found">
        <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
        <h2 class="sec-title align-center">Thank You</h2>
        <h4 class="intro-sec-title align-center name-section"></h4>
        <div class="office-details">
          <div class="align-content-center">
            <p class="intro-text align-center">We care for our Guests like no other<br /> and will be back to you very soon. In the meantime, stay tuned!</p>
            <h4 class="intro-sec-title align-center">Traditionally Modern, Subtly Luxurious, Distinctly LaLiT</h4>
          </div><!-- align-content-center -->
        </div><!-- office-details -->
        <div class="link-block align-center">
          <a href="<?php echo site_url(); ?>/find-a-hotel/" class="text-link small-size-link uppercase" title="Find a Hotel"> Find a Hotel</a>
        </div><!-- link-block -->
        <div class="motif-img"><img src="/wp-content/themes/lalit/images/404-motif.png" alt=""></div><!-- motif-img -->
      </div><!-- thank-you-block -->
    </div><!-- row -->
  </div><!-- thank-you-sec -->
</div><!-- pop-up -->