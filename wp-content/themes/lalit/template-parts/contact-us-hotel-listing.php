<div class="content-section small-banner contact-us">
  <!-- slider -->
 <div class="container align-center small-banner-sec js_fade" style="background-image:url('/wp-content/themes/lalit/images/contact-us-banner.jpg')">
      <div class="row">
          <div class="banner-content">
            <h1 class="main-title text-shadow">contact us</h1>
          </div><!-- banner-content -->
      </div><!-- row -->
  </div><!-- container -->

  <div class="container section-space intro-text align-center"><!-- container-->
      <div class="row"> <!-- row-->                 
          <h2 class="sec-title">We remain at your service at The LaLiT</h2>
          <div class="col col8 align-content-center "><!-- col -->  
              <p>Should you require more information about The LaLiT or would like to arrange bookings at any of our luxury hotels, resorts and palaces, please do not hesitate to contact us.</p>
              <div class="btn-block align-center">
                  <a href="#contact-us" class="btn primary-btn margin-top-20 contact-btn fancybox" title="Contact US">contact us</a>
              </div><!-- btn-block -->    
          </div><!-- col -->
      </div><!-- row -->
  </div><!-- container-->

  <?php

    $args = array(
      'post_type'=>'destination',
      'post_status'=>'publish',
      'tax_query' => array(
          array(
            'taxonomy' => 'locations',
            'field'    => 'term_id',
            'terms'    => $GLOBALS['location'][0]->term_id
          )
        ),
      'posts_per_page' => '1'
    );

    $loop = new WP_Query($args);

    if($loop->have_posts())
    {

      while($loop->have_posts())
      {

        $loop->the_post();
        $name = get_post_meta($post->ID,'name',true);
        $address = strip_tags(wpautop(get_post_meta($post->ID,'address',true)));
        $latitude = get_post_meta($post->ID,'latitude',true);
        $longitude = get_post_meta($post->ID,'longitude',true);
        $reservation_contact_type = get_post_meta($post->ID, 'reservation_contact_type', true);
        $reservation_email = get_post_meta($post->ID, 'reservation_contact', true);
        $email = get_post_meta($post->ID,'email',true);
		$general_manager = get_post_meta($post->ID,'general_manager',true);
        $general_manager_email = get_post_meta($post->ID,'general_manager_email',true);
        $pa_to_general_manager = get_post_meta($post->ID,'pa_to_general_manager',true);
        $pa_to_general_manager_email = get_post_meta($post->ID,'pa_to_general_manager_email',true);
        $hotel_manager = get_post_meta($post->ID,'hotel_manager',true);
        $hotel_manager_email = get_post_meta($post->ID,'hotel_manager_email',true);
        $resident_manager = get_post_meta($post->ID,'resident_manager',true);
        $resident_manager_email = get_post_meta($post->ID,'resident_manager_email',true);
		$rooms_division_manager = get_post_meta($post->ID,'rooms_division_manager',true);
        $rooms_division_manager_email = get_post_meta($post->ID,'rooms_division_manager_email',true);  
        $executive_assistant_manager = get_post_meta($post->ID,'executive_assistant_manager',true);
        $executive_assistant_manager_email = get_post_meta($post->ID,'executive_assistant_manager_email',true);
        $front_office_contact_type = get_post_meta($post->ID, 'front_office_contact_type', true);
        $front_office_email = get_post_meta($post->ID,'front_office',true);
        $sales_office_contact_type = get_post_meta($post->ID, 'sales_office_contact_type', true);
        $sales_email = get_post_meta($post->ID,'sales',true);


        $GLOBALS['address'] = $address;
        $GLOBALS['email'] = $email;
        $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
        $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
        $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);


        $reservation_phone = $sales_phone = $front_office_phone = '';

        /*if(strpos($general_manager, '-'))
        {
          $general_manager = explode('-', $general_manager);
          if(strpos($general_manager[1], ','))
          {
            $general_manager[1] = explode(',', $general_manager[1]);
          }
        }
        else if(strpos($general_manager, ','))
        {
          $general_manager = explode(',', $general_manager);
        }

        if(strpos($pa_to_general_manager, '-'))
        {
          $pa_to_general_manager = explode('-', $pa_to_general_manager);
          if(strpos($pa_to_general_manager[1], ','))
          {
            $pa_to_general_manager[1] = explode(',', $pa_to_general_manager[1]);
          }
        }
        else if(strpos($pa_to_general_manager, ','))
        {
          $pa_to_general_manager = explode(',', $pa_to_general_manager);
        }

        if(strpos($hotel_manager, '-'))
        {
          $hotel_manager = explode('-', $hotel_manager);
          if(strpos($hotel_manager[1], ','))
          {
            $hotel_manager[1] = explode(',', $hotel_manager[1]);
          }
        }
        else if(strpos($hotel_manager, ','))
        {
          $hotel_manager = explode(',', $hotel_manager);
        }

        if(strpos($resident_manager, '-'))
        {
          $resident_manager = explode('-', $resident_manager);
          if(strpos($resident_manager[1], ','))
          {
            $resident_manager[1] = explode(',', $resident_manager[1]);
          }
        }
        else if(strpos($resident_manager, ','))
        {
          $resident_manager = explode(',', $resident_manager);
        }

        if(strpos($rooms_division_manager, '-'))
        {
          $rooms_division_manager = explode('-', $rooms_division_manager);
          if(strpos($rooms_division_manager[1], ','))
          {
            $rooms_division_manager[1] = explode(',', $rooms_division_manager[1]);
          }
        }
        else if(strpos($rooms_division_manager, ','))
        {
          $rooms_division_manager = explode(',', $rooms_division_manager);
        }

        if(strpos($executive_assistant_manager, '-'))
        {
          $executive_assistant_manager = explode('-', $executive_assistant_manager);
          if(strpos($executive_assistant_manager[1], ','))
          {
            $executive_assistant_manager[1] = explode(',', $executive_assistant_manager[1]);
          }
        }
        else if(strpos($executive_assistant_manager, ','))
        {
          $executive_assistant_manager = explode(',', $executive_assistant_manager);
        }*/

        $email_subject = "Namaskar! $name welcomes your request.";

        $address_map = '';
        
        if(trim($name) != '' && trim($latitude) != '' && trim($longitude) != '' && trim($address) != '')
        {

          $name_1 = str_replace(' ', '+', $name);
          $address_1 = strip_tags($address);
          $address_1 = str_replace(' ', '+', $address);


          $address_map = "http://www.google.com/maps/dir/''/".$name_1.",+".$address_1."/@".$latitude.",".$longitude.",12z";
          //$address_map = str_replace(' ', '+', $address_map);
        }

        $phone = get_post_meta($post->ID,'phone',true);

        if(trim($phone) != '')
        {
          if(strpos($phone, '/') != false)
          {
            $phone = explode('/', $phone);
          }
        }


        if($reservation_contact_type == 0)
        {
          $reservation_phone = $reservation_email;

          if(strpos($reservation_phone, ','))
          {
            $reservation_phone = explode(',', $reservation_phone);
          }
        }
		  
        if($sales_office_contact_type == 0)
        {
          $sales_phone = $sales_email;
          if(strpos($sales_phone, ','))
          {
            $sales_phone = explode(',', $sales_phone);
          }
        }

        if($front_office_contact_type == 0)
        {
          $front_office_phone = $front_office_email;
          if(strpos($front_office_phone, ','))
          {
            $front_office_phone = explode(',', $front_office_phone);
          }
        }
        ?>
          <div class="container office-details"><!-- container-->
            <div class="row align-center"> <!-- row-->  
              <div class="col col12"><!-- col -->
                <input type="hidden" id="reservation_email" value="<?php if(trim($reservation_email) != ''){ echo $reservation_email; }else{ echo $email; } ?>">
                <input type="hidden" id="email_subject" value="<?php echo $email_subject; ?>"> 
                <input type="hidden" id="flamingo_subject" value="<?php echo "Contact Request From ".$name; ?>">
                <?php
                  if($general_manager)
                  {
                    if($general_manager && trim($general_manager) != '')
                    {
                      ?>
                      <input type="hidden" id="general_manager_name" value="<?php echo trim($general_manager); ?>">
                      <?php
                    }
                    if($general_manager_email && trim($general_manager_email) != '')
                    {
                      ?>
                      <input type="hidden" id="general_manager_email" value="<?php echo trim($general_manager_email); ?>">
                      <?php
                    }
                  }
                  else if($hotel_manager)
                  {
                    if($hotel_manager && trim($hotel_manager) != '')
                    {
                      ?>
                      <input type="hidden" id="general_manager_name" value="<?php echo trim($general_manager); ?>">
                      <?php
                    }
                    if($hotel_manager_email && trim($hotel_manager_email) != '')
                    {
                      ?>
                      <input type="hidden" id="general_manager_email" value="<?php echo trim($hotel_manager_email); ?>">
                      <?php
                    }
                  }
                  else
                  {
                    ?>
                    <input type="hidden" id="general_manager_name" value="Mr. Keshav Suri">
                    <?php
                  }
                ?>
                <h2 class="sec-title">Hotel Contact Information</h2>
                <?php if(trim($name) != '') { ?><h6 class="small-title"><?php echo $name; ?></h6><?php } ?>
                <?php if(trim($address) != '') { ?><address> <?php echo $address; ?> </address><?php } ?>
                <?php
                  if($phone)
                  {
                    ?>
                    <div class="contact-info"> <!-- contact-info-->                               
                      <ul class="unstyled-listing">
                         <?php

                          if(is_array($phone))
                          {

                            ?>
                            <li class="contact-details">
                              <i class="ico-sprite sprite size-24 ico-phone"></i>
                              <p>
                                <?php
                                  for($i=0;$i<count($phone);$i++)
                                  {
                                    if(trim($phone[$i]) != '')
                                    {
                                      $phone[$i] = str_replace('-', ' ', $phone[$i]);
                                      ?>
                                       <a href="tel:<?php echo $phone[$i]; ?>"> <?php echo $phone[$i]; ?></a>
                                       <?php

                                        if($i < count($phone)-1)
                                        {
                                          echo "/";
                                        }
                                      }
                                    }
                                ?>
                              </p>
                            </li>
                            <?php
                          }
                          else
                          {
                            if(trim($phone) != '')
                            {
                              $phone = str_replace('-', ' ', $phone);
                              ?>
                              <li class="contact-details">
                                <i class="ico-sprite sprite size-24 ico-phone"></i>
                                <p><a href="tel:<?php echo $phone; ?>"> <?php echo $phone; ?></a></p>
                              </li>
                              <?php
                            }
                          }
                        ?>                            
                      </ul> 
                    </div> <!-- contact-info-->
                    <?php
                  }
                ?>
                <?php

                  if($pa_to_general_manager || $pa_to_general_manager_email || $general_manager|| $general_manager_email || $hotel_manager || $hotel_manager_email || $resident_manager || $resident_manager_email || $rooms_division_manager || $rooms_division_manager_email || $executive_assistant_manager || $executive_assistant_manager_email)
                  {
                    ?>
                    <div class="single-section fade-border-bottom managers-section">
                      <?php
                        if($general_manager || $general_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>General Manager</h6>
                            <?php
                              if($general_manager)
                              {
                                ?>
                                <span><?php echo trim($general_manager); ?></span>
                                <?php
                              }
                              if(is_email($general_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($general_manager_email); ?>"><?php echo trim($general_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($general_manager_email, ','))
                              {
                                $general_manager_email = explode(',', $general_manager_email);
                                foreach($general_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
                      <?php
                        if($pa_to_general_manager || $pa_to_general_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>PA to General Manager</h6>
                            <?php
                              if($pa_to_general_manager)
                              {
                                ?>
                                <span><?php echo trim($pa_to_general_manager); ?></span>
                                <?php
                              }
                              if(is_email($pa_to_general_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($pa_to_general_manager_email); ?>"><?php echo trim($pa_to_general_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($pa_to_general_manager_email, ','))
                              {
                                $pa_to_general_manager_email = explode(',', $pa_to_general_manager_email);
                                foreach($pa_to_general_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
                      <?php
                        if($hotel_manager || $hotel_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Hotel Manager</h6>
                            <?php
                              if($hotel_manager)
                              {
                                ?>
                                <span><?php echo trim($hotel_manager); ?></span>
                                <?php
                              }
                              if(is_email($hotel_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($hotel_manager_email); ?>"><?php echo trim($hotel_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($hotel_manager_email, ','))
                              {
                                $hotel_manager_email = explode(',', $hotel_manager_email);
                                foreach($hotel_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
                      <?php
                        if($resident_manager || $resident_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Resident Manager</h6>
                            <?php
                              if($resident_manager)
                              {
                                ?>
                                <span><?php echo trim($resident_manager); ?></span>
                                <?php
                              }
                              if(is_email($resident_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($resident_manager_email); ?>"><?php echo trim($resident_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($resident_manager_email, ','))
                              {
                                $resident_manager_email = explode(',', $resident_manager_email);
                                foreach($resident_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
					  <?php
                        if($rooms_division_manager || $rooms_division_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Rooms Division Manager</h6>
                            <?php
                              if($rooms_division_manager)
                              {
                                ?>
                                <span><?php echo trim($rooms_division_manager); ?></span>
                                <?php
                              }
                              if(is_email($rooms_division_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($rooms_division_manager_email); ?>"><?php echo trim($rooms_division_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($rooms_division_manager_email, ','))
                              {
                                $rooms_division_manager_email = explode(',', $rooms_division_manager_email);
                                foreach($rooms_division_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>	
                      <?php
                        if($executive_assistant_manager || $executive_assistant_manager_email)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Executive Assistant Manager</h6>
                            <?php
                              if($executive_assistant_manager)
                              {
                                ?>
                                <span><?php echo trim($executive_assistant_manager); ?></span>
                                <?php
                              }
                              if(is_email($executive_assistant_manager_email))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($executive_assistant_manager_email); ?>"><?php echo trim($executive_assistant_manager_email); ?></a>
                                <?php
                              }
                              else if(strpos($executive_assistant_manager_email, ','))
                              {
                                $executive_assistant_manager_email = explode(',', $executive_assistant_manager_email);
                                foreach($executive_assistant_manager_email as $key => $manager_email){
                                  if(is_email($manager_email))
                                  {
                                    ?>
                                    <a href="mailto:<?php echo trim($manager_email); ?>"><?php echo trim($manager_email); ?></a>
                                    <?php
                                  }
                                }
                              }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
                    </div>
                    <?php
                  }
                  /*if($pa_to_general_manager || $general_manager || $hotel_manager || $resident_manager || $rooms_division_manager || $executive_assistant_manager)
                  {
                    ?>
                    <div class="single-section fade-border-bottom managers-section">
                      <?php

                        if($general_manager)
                        {
                          ?>
                          <span class="span span2">
                            <h6>General Manager</h6>
                            <?php
                            if(is_array($general_manager[1]))
                            {
                              ?>
                              <span><?php echo $general_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($general_manager[1]);$i++)
                              {
                                if(is_email(trim($general_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($general_manager[1][$i]); ?>"><?php echo trim($general_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($general_manager))
                            {
                              for($i=0;$i<count($general_manager);$i++)
                              {
                                if(is_email(trim($general_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($general_manager[$i]); ?>"><?php echo trim($general_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo $general_manager[$i]; ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($general_manager) && trim($general_manager) != '')
                            {
                              if(is_email(trim($general_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($general_manager); ?>"><?php echo trim($general_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo trim($general_manager[$i]); ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }

                        
                        if($pa_to_general_manager)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>PA to General Manager</h6>
                            <?php
                            if(is_array($pa_to_general_manager[1]))
                            {
                              ?>
                              <span><?php echo $pa_to_general_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($pa_to_general_manager[1]);$i++)
                              {
                                if(is_email(trim($pa_to_general_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($pa_to_general_manager[1][$i]); ?>"><?php echo trim($pa_to_general_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($pa_to_general_manager))
                            {
                              for($i=0;$i<count($pa_to_general_manager);$i++)
                              {
                                if(is_email(trim($pa_to_general_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($pa_to_general_manager[$i]); ?>"><?php echo trim($pa_to_general_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo trim($pa_to_general_manager[$i]); ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($pa_to_general_manager) && trim($pa_to_general_manager) != '')
                            {
                              if(is_email(trim($pa_to_general_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($pa_to_general_manager); ?>"><?php echo trim($pa_to_general_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo $pa_to_general_manager[$i]; ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }
                    
                        if($hotel_manager)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Hotel Manager</h6>
                            <?php
                            if(is_array($hotel_manager[1]))
                            {
                              ?>
                              <span><?php echo $hotel_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($hotel_manager[1]);$i++)
                              {
                                if(is_email(trim($hotel_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($hotel_manager[1][$i]); ?>"><?php echo trim($hotel_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($hotel_manager))
                            {
                              for($i=0;$i<count($hotel_manager);$i++)
                              {
                                if(is_email(trim($hotel_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($hotel_manager[$i]); ?>"><?php echo trim($hotel_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo trim($hotel_manager[$i]); ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($hotel_manager) && trim($hotel_manager) != '')
                            {
                              if(is_email(trim($hotel_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($hotel_manager); ?>"><?php echo trim($hotel_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo trim($hotel_manager[$i]); ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }


                        if($resident_manager)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Resident Manager</h6>
                            <?php
                            if(is_array($resident_manager[1]))
                            {
                              ?>
                              <span><?php echo $resident_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($resident_manager[1]);$i++)
                              {
                                if(is_email(trim($resident_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($resident_manager[1][$i]); ?>"><?php echo trim($resident_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($resident_manager))
                            {
                              for($i=0;$i<count($resident_manager);$i++)
                              {
                                if(is_email(trim($resident_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($resident_manager[$i]); ?>"><?php echo trim($resident_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo trim($resident_manager[$i]); ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($resident_manager) && trim($resident_manager) != '')
                            {
                              if(is_email(trim($resident_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($resident_manager); ?>"><?php echo trim($resident_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo trim($resident_manager[$i]); ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }
                        

                        if($rooms_division_manager)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Rooms Division Manager</h6>
                            <?php
                            if(is_array($rooms_division_manager[1]))
                            {
                              ?>
                              <span><?php echo $rooms_division_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($rooms_division_manager[1]);$i++)
                              {
                                if(is_email(trim($rooms_division_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($rooms_division_manager[1][$i]); ?>"><?php echo trim($rooms_division_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($rooms_division_manager))
                            {
                              for($i=0;$i<count($rooms_division_manager);$i++)
                              {
                                if(is_email(trim($rooms_division_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($rooms_division_manager[$i]); ?>"><?php echo trim($rooms_division_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo trim($rooms_division_manager[$i]); ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($rooms_division_manager) && trim($rooms_division_manager) != '')
                            {
                              if(is_email(trim($rooms_division_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($rooms_division_manager); ?>"><?php echo trim($rooms_division_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo trim($rooms_division_manager[$i]); ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }
						
						
						if($executive_assistant_manager)
                        {
                          ?>
                          <span class="span span2 fade-border-left">
                            <h6>Executive Assistant Manager</h6>
                            <?php
                            if(is_array($executive_assistant_manager[1]))
                            {
                              ?>
                              <span><?php echo $executive_assistant_manager[0]; ?></span>
                              <?php
                              
                              for($i=0;$i<count($executive_assistant_manager[1]);$i++)
                              {
                                if(is_email(trim($executive_assistant_manager[1][$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($executive_assistant_manager[1][$i]); ?>"><?php echo trim($executive_assistant_manager[1][$i]); ?></a>
                                  <?php
                                }
                              }
                            }
                            else if(is_array($executive_assistant_manager))
                            {
                              for($i=0;$i<count($executive_assistant_manager);$i++)
                              {
                                if(is_email(trim($executive_assistant_manager[$i])))
                                {
                                  ?>
                                  <a href="mailto:<?php echo trim($executive_assistant_manager[$i]); ?>"><?php echo trim($executive_assistant_manager[$i]); ?></a>
                                  <?php
                                }
                                else
                                {
                                  ?>
                                  <span><?php echo trim($executive_assistant_manager[$i]); ?></span>
                                  <?php
                                }
                              }
                            }
                            else if(!is_array($executive_assistant_manager) && trim($executive_assistant_manager) != '')
                            {
                              if(is_email(trim($executive_assistant_manager)))
                              {
                                ?>
                                <a href="mailto:<?php echo trim($executive_assistant_manager); ?>"><?php echo trim($executive_assistant_manager); ?></a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span><?php echo trim($executive_assistant_manager[$i]); ?></span>
                                <?php
                              }
                            }
                            ?>
                          </span>
                          <?php
                        }
                      ?>
                    </div>
                    <?php
                  }*/ 
                ?>
                <?php

                  if(($reservation_email || $reservation_phone) || ($front_office_email || $front_office_phone) || ($sales_email || $sales_phone))
                  {
                    ?>
                    <div class="single-section">
                      <?php

                        if(trim($reservation_contact_type) == '0')
                        {
                          if(is_array($reservation_phone))
                          {
                            ?>
                            <span class="span span2">
                              <h6>Reservation</h6>
                              <?php

                                for($i=0;$i<count($reservation_phone);$i++)
                                {
                                  if(trim($reservation_phone[$i]) != '')
                                  {
                                    $reservation_phone[$i] = str_replace('-', ' ', $reservation_phone[$i]);
                                    ?>                              
                                    <a href="tel:<?php echo trim($reservation_phone[$i]); ?>"><?php echo trim($reservation_phone[$i]); ?></a>
                                    <?php
                                  }
                                }
                              ?>
                            </span>
                            <?php
                          }
                          else if(trim($reservation_phone) != '')
                          {
                            $reservation_phone = str_replace('-', ' ', $reservation_phone);
                            ?>
                            <span class="span span2">
                              <h6>Reservation</h6>                             
                              <a href="tel:<?php echo trim($reservation_phone); ?>"><?php echo trim($reservation_phone); ?></a>
                            </span>
                            <?php
                          }
                        }
                        else
                        {
                          if(trim($reservation_email) != '')
                          {
                            ?>
                            <span class="span span2">
                              <h6>Reservation</h6>                           
                              <a href="mailto:<?php echo trim($reservation_email); ?>"><?php echo trim($reservation_email); ?></a>
                            </span>
                            <?php
                          }
                        }
                      ?>
                      <?php

                        if(trim($front_office_contact_type) == '0')
                        {
                          if(is_array($front_office_phone))
                          {
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Front Office</h6>
                              <?php

                                for($i=0;$i<count($front_office_phone);$i++)
                                {
                                  if(trim($front_office_phone[$i]) != '')
                                  {
                                    $front_office_phone[$i] = str_replace('-', ' ', $front_office_phone[$i]);
                                    ?>                     
                                    <a href="tel:<?php echo trim($front_office_phone[$i]); ?>"><?php echo trim($front_office_phone[$i]); ?></a>
                                    <?php
                                  }
                                }
                              ?>
                            </span>
                            <?php
                          }
                          else if(trim($front_office_phone) != '')
                          {
                            $front_office_phone = str_replace('-', ' ', $front_office_phone);
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Front Office</h6>                                   
                              <a href="tel:<?php echo trim($front_office_phone); ?>"><?php echo trim($front_office_phone); ?></a>
                            </span>
                            <?php
                          }
                        }
                        else
                        {
                          if(trim($front_office_email) != '')
                          {
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Front Office</h6>                           
                              <a href="mailto:<?php echo trim($front_office_email); ?>"><?php echo trim($front_office_email); ?></a>
                            </span>
                            <?php
                          }
                        }
                      ?>
                      <?php

                        if(trim($sales_office_contact_type) == '0')
                        {
                          if(is_array($sales_phone))
                          {
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Sales Office</h6>
                              <?php

                                for($i=0;$i<count($sales_phone);$i++)
                                {
                                  if(trim($sales_phone[$i]) != '')
                                  {
                                    $sales_phone[$i] = str_replace('-', ' ', $sales_phone[$i]);
                                    ?>                              
                                    <a href="tel:<?php echo trim($sales_phone[$i]); ?>"><?php echo trim($sales_phone[$i]); ?></a>
                                    <?php
                                  }
                                }
                              ?>
                            </span>
                            <?php
                          }
                          else if(trim($sales_phone) != '')
                          {
                            $sales_phone = str_replace('-', ' ', $sales_phone);
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Sales Office</h6>                             
                              <a href="tel:<?php echo trim($sales_phone); ?>"><?php echo trim($sales_phone); ?></a>
                            </span>
                            <?php
                          }
                        }
                        else
                        {
                          if(trim($sales_email) != '')
                          {
                            ?>
                            <span class="span span2 fade-border-left-bottom">
                              <h6>Sales Office</h6>                           
                              <a href="mailto:<?php echo trim($sales_email); ?>"><?php echo trim($sales_email); ?></a>
                            </span>
                            <?php
                          }
                        }
                      ?>
                    </div>
                    <?php
                  }
                ?>
              </div><!-- col -->
              <?php
                if(trim($address_map) != '')
                {
                  ?>
                  <a href="<?php echo $address_map; ?>" class="text-link small-size-link" target='_blank'> Get directions <i class="ico-sprite sprite size-16 ico-red-right-arrow"></i></a>
                  <?php
                }
              ?>
            </div><!-- row -->
          </div><!-- container-->
        </div><!-- content-section -->    
        <?php
      }
    }
    wp_reset_postdata();
  ?>
</div><!-- content-section -->


<div id="contact-us" class="pop-up" style="display: none;">
    <div class="form-header">
        <h2 class="page-title">
          Contact Us
        </h2>
    </div>
    <?php echo do_shortcode('[contact-form-7 id="7207" title="Contact Us Form"]');?>
    <div class="thank-you-sec thank-you-section" style="display:none;">
      <div class="row">
        <div class="thank-you-block align-content-center not-found">
          <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
          <h2 class="sec-title align-center">Thank You</h2>
          <h4 class="intro-sec-title align-center name-section"></h4>
          <div class="office-details">
            <div class="align-content-center">
              <p class="intro-text align-center">We care for our Guests like no other<br/> and will be back to you very soon. In the meantime, stay tuned!</p>
              <h4 class="intro-sec-title align-center">Traditionally Modern, Subtly Luxurious, Distinctly LaLiT</h4>
              <div class="link-block align-center">
                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/suites-and-rooms/" class="text-link small-size-link uppercase" title="Book a Room"> Book a Room</a>

                <ul class="unstyled-listing con-links clearfix">
                  <li><strong class="lbl-find-us">Contact Our</strong></li>
                  <?php if($GLOBALS['location'][0]->slug != 'london' && $GLOBALS['location'][0]->slug != 'mangar') { ?><li><a href="<?php echo site_url(); ?>/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/weddings/" title="">Wedding Planner</a></li><?php } ?>
                  <li><a href="<?php echo site_url(); ?>/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/meetings-and-events/" title="">Event Manager</a></li>
                </ul>
              </div><!-- link-block -->
            </div><!-- align-content-center -->
          </div><!-- office-details --> 

          <div class="motif-img"><img src="/wp-content/themes/lalit/images/404-motif.png" alt=""></div><!-- motif-img --> 
        </div><!-- thank-you-block -->
      </div><!-- row -->  
    </div><!-- thank-you-sec -->  
</div><!-- pop-up -->