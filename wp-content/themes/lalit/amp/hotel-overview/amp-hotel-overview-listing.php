<?php
$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

$city_name = $GLOBALS['location'][0]->slug;
$city = $GLOBALS['location'][0]->name;
if($GLOBALS['location'][0]->slug == 'london')
{
    $country = 'UK';
}
else
{
    $country = 'India';
}
 
$hotel_id = '';
if( $destination_obj->have_posts() ) : 
    while($destination_obj->have_posts()) : $destination_obj->the_post();

        $hotel_id = $post->ID;

        $GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
        $GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
        $GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
        $GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);

        $GLOBALS['booking_engine'] = get_post_meta( $hotel_id, "booking_engine", true);
        $booking_engine_url = '';
        if($GLOBALS['booking_engine'] == 1)
        {
            $booking_engine_hotel_code = get_post_meta( $post->ID, "booking_engine_hotel_code", true);
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_engine_url = $booking_engine_url.'/?Hotel='.$booking_engine_hotel_code;
        }
        else if($GLOBALS['booking_engine'] == 2)
        {
            $booking_engine_hotel_id = get_post_meta( $post->ID, "booking_engine_hotel_id", true);
            $booking_engine_chain_id = get_post_meta( $post->ID, "booking_engine_chain_id", true);
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_engine_url = $booking_engine_url.'?Hotel='.$booking_engine_hotel_id.'&Chain='.$booking_engine_chain_id;
        }
        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

    endwhile;
endif;

$banner_images = get_post_meta($hotel_id, "banner_images", true);
$hotel_image_id = get_post_meta($hotel_id, "property_image", true);
$GLOBALS['hotel_image'] = wp_get_attachment_image_src($hotel_image_id, 'thumbnail')[0];
$GLOBALS['hotel_name'] = get_post_meta($hotel_id, "name", true);
?>

<div class="content-section">

    <!--  Banners -->
    <?php
    $image_present_flag = false;
    if($banner_images)
    {
        $banner_ids = array();
        foreach($banner_images as $banner_image_id)
        {
            $banner_ids[] = $banner_image_id;
        }
        $banners = get_page_overview_banners($banner_ids);
        unset($banner_ids);

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
    ?>
    <!--  Banners -->
    <div class="motif-blk">
            <div class="booking-widget-sec section-space">
                <div class="booking-widget clearfix h-align-widget">
                    <a href="<?php echo $booking_engine_url; ?>" class="btn mobile-book-stay primary-btn">Book A Stay</a>
                </div>
            </div>
        <!-- Hotel additional information -->
        <?php
        $title = get_post_meta($hotel_id,"hotel_sub_heading",true);
        $description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($hotel_id,"short_description",true)));
        if($title || $description)
        {
            include(get_template_directory() . '/amp/includes/amp-title-description.php');
        }
        ?>
        <!-- Hotel additional information -->

        <!-- Awards -->
        <?php
        $award_obj = get_post_meta($hotel_id,"hotel_awards",true);
        if($award_obj)
        {
        ?>
            <div class="container">
                <div class="row">
                    <ul class="reward-list">
                        <?php        
                        $award_count = 0;
                        foreach($award_obj as $award_id)
                        {
                            if(get_post_status ( $award_id ) == 'publish')
                            {
                                $award_name = get_post_meta($award_id,"name",true);
                                $award_body = get_the_terms($award_id, 'award-body');
                                $awarded_to = get_post_meta($award_id, 'awarded_to', true);

                                $award_logo = '';
                                
                                $term_id = $award_body[0]->term_id;
                                $meta_data = get_term_meta($term_id);
                                foreach($meta_data as $data)
                                {
                                   $award_logo = $data[0];
                                }
                      
                                if($award_logo || $award_name)
                                {
                        ?>
                                    <li class="span">
                                        <div class="reward-item">    
                                          <?php
                                          if($award_logo)
                                          {
                                          ?>
                                              <div class="reward-logo">
                                                <amp-img src="<?php echo $award_logo; ?>"
                                                    width="200"
                                                    height="129"
                                                    layout="responsive"
                                                    alt="">
                                                </amp-img>
                                              </div>
                                          <?php
                                          }
                                          /*
                                          ?>
                                              <div class="reward-meta">
                                                  <?php
                                                  if($awarded_to)
                                                  {
                                                  ?>
                                                      <strong><?php echo $awarded_to; ?></strong>
                                                  <?php
                                                  }
                                                  if($award_name)
                                                  {
                                                  ?>
                                                      <span><?php echo $award_name; ?></span>
                                                  <?php
                                                  }
                                                  ?>  
                                              </div>
                                            <?php
                                            */
                                            ?>      
                                        </div>
                                    </li>
                                    <?php              
                                    $award_count++;
                                }
                          
                                if($award_count == 4)
                                {
                                    break;
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- Awards -->


        <?php
        
            $at_the_hotel_obj = get_post_meta($hotel_id,"at_the_hotel",true);
            if( $at_the_hotel_obj ) :

                $data_array = array();
                $i = 0;
                foreach($at_the_hotel_obj as $at_the_hotel_id)
                {
                    if(get_post_status ( $at_the_hotel_id ) == 'publish')
                    {
                        $data_array[$i]['title'] = get_post_meta($at_the_hotel_id,"name",true);
                        $image_id = get_post_meta($at_the_hotel_id,"image",true);
                        $data_array[$i]['image'] = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                        $i++;
                    }
                }
        
                if(count($data_array) > 0){
                    
                    $height = 256;
                    $width = 820;
                    $section_title = 'At a Glance';
                    include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');
        
                }
        
            endif;
            wp_reset_postdata();
            unset($data_array);
        
        ?>
    
    
        <div class="container">
            <div class="row">
                <div class="bottom-scroll">
                    <a on="tap:suits-rooms.scrollTo(duration=600)">More about the hotel
                        <i class="ico-sprite sprite size-18 ico-blk-down-arrow"></i>
                    </a>
                </div>
            </div>
        </div>

   
        <!-- Suite and Room Image -->  
        <?php
        if($hotel_additional_information)
        {
            foreach($hotel_additional_information as $id)
            {
                $room_image_id = get_post_meta($id, 'room_image', true);
                $room_image = wp_get_attachment_url($room_image_id);
                $suite_image_id = get_post_meta($id, 'suite_image', true);
                $suite_image = wp_get_attachment_url($suite_image_id);
            }
        }
        
        if($room_image != '' || $suite_image != '')
        {
        ?>
            <div class="container" id="suits-rooms">
                <div class="row room-types">
                    <?php
                    if($suite_image != '')
                    {
                        $class = '';
                        if($room_image == '') { $class="align-content-center"; }
                    ?>
                        <div class="col <?php echo $class; ?>"> 
                            <a href="/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/?amp" class="item-blk">                   
                                <div title="Suites" style="background: url('<?php echo $suite_image; ?>') no-repeat center center; background-size: cover; width: 100%; height: 100%;"></div>  
                                <h4 class="item-head">Suites</h4> 
                            </a>
                        </div>
                    <?php
                    }
                
                    if($room_image != '')
                    {
                        $class = '';
                        if($suite_image == '') { $class="align-content-center"; }
                    ?>
                        <div class="col <?php echo $class; ?>"> 
                            <a href="/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/?amp" class="item-blk">       
                                <div title="Rooms" style="background: url('<?php echo $room_image; ?>') no-repeat center center; background-size: cover; width: 100%; height: 100%;"></div> 
                                <h4 class="item-head">Rooms</h4>  
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- Suite and Room Image -->


        <!-- Hotel Attractions -->    
        <?php
        $hotel_attraction_obj = get_post_meta($hotel_id,"hotel_special_services",true);
        if($hotel_attraction_obj)
        {
        ?>
            <div class="container section-space hotel-attractions"> 
                <div class="row">
                    <h2 class="sec-title align-center">Hotel Attractions</h2>
                </div>
            </div>
            <?php 
            $at_count = 1;
            foreach($hotel_attraction_obj as $hotel_attraction_id)
            {
                if(get_post_status ( $hotel_attraction_id ) == 'publish')
                {
                    $name = get_post_meta($hotel_attraction_id,"name",true);
                    $description = wpautop(the_lalit_remove_image_tags_amp(get_post_meta($hotel_attraction_id,"description",true)));
                    $image_id = get_post_meta($hotel_attraction_id,"image",true);
                    $image = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                    ?>
                        <div class="container table-container section-space"> 
                            <div class="row table-sec">  
                                <div class="tablecell">
                                    <div class="tablecell-image">
                                        <amp-img src="<?php echo $image; ?>"
                                            width="820"
                                            height="400"
                                            layout="responsive"
                                            alt="<?php echo $name; ?>">
                                        </amp-img>
                                    </div>   
                                </div>
                                <div class="tablecell intro-text">
                                    <?php
                                    if($name != '')
                                    {    
                                    ?>
                                        <h3 class="item-title"><?php echo $name; ?></h3>
                                    <?php
                                    }  
                                    if($description != '')
                                    {
                                    ?>
                                        <p><?php echo $description; ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>             
                        </div><!-- container -->
                        <?php
                }
            }
        }
        unset($hotel_attraction_obj);
        ?>
        <!-- Hotel Attractions -->


        <!-- Experiences -->
        <?php
        
            $hotel_experience_obj = get_post_meta($hotel_id,"hotel_experiences",true);
            if( $hotel_experience_obj ) :

                $data_array = array();
                $i = 0;
                $exp_category_ids = array();
                foreach($hotel_experience_obj as $hotel_experience_id)
                {
                    if(get_post_status ( $hotel_experience_id ) == 'publish')
                    {
                        $category_id = get_post_meta($hotel_experience_id,"experience_category",true);
                        if($category_id)
                        {
                            $exp_category_ids[] = $category_id;
                        }
                    }
                }

                $exp_category_ids = array_unique($exp_category_ids);
                sort($exp_category_ids);


                foreach($exp_category_ids as $id)
                {
                    $data_array[$i]['title'] = get_post_meta($id,"category_title",true);
                    $image_id = get_post_meta($id,"banner_image",true);
                    $data_array[$i]['image'] = wp_get_attachment_image_src($image_id, 'listing_page_image')[0];
                    $i++;
                }

                if(count($data_array) > 0){
                    
                    $height = 236;
                    $width = 610;
                    $section_title = 'Experience '.ucwords($GLOBALS['location'][0]->name);
                    include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');
        
                }
        
            endif;
            wp_reset_postdata();
            unset($data_array);
        
        ?>
        <!-- Experiences -->

    
        <!-- Property address and map -->
        <?php

        $link = '/the-lalit-'.$city_name.'/location/?amp';
        $width = 600;
        $height = 550;
        $address = $GLOBALS['address'];
        $email = $GLOBALS['email'];
        $phone = $GLOBALS['phone'];
        $fax = $GLOBALS['fax'];
        $hotel_name = $GLOBALS['hotel_name'];
        $image_path = get_template_directory_uri() . '/amp/images/' . ucfirst($city_name).'.jpg';
        $map_hotel_name = str_replace('&', 'and', str_replace(' ', '+', $GLOBALS['hotel_name']));
        $map_hotel_address = str_replace('&', 'and', str_replace(' ', '+', $GLOBALS['address']));

        $getting_here_obj = get_post_meta( $hotel_id, "getting_here", true);


        include_once(get_template_directory() . '/amp/includes/amp-map.php');


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
        ?>
        <!-- Hotel Services -->


        <!-- City Attractions -->
        <?php
        $city_attraction_obj = get_post_meta($hotel_id,"city_attractions",true);
        if($city_attraction_obj)
        {

            $images = get_banner_by_taxonomy($banner_ids, 'city_highlights_overview', 1);

            $city_attraction_banner = '';
            if( $images->have_posts() ) :
                while($images->have_posts()) : $images->the_post();
                    $image_id = get_post_meta($post->ID, 'banner_image', true);
                    $city_attraction_banner = wp_get_attachment_url($image_id);
                endwhile;
            endif;

            /*if($hotel_additional_information)
            {
                foreach($hotel_additional_information as $info_id)
                {
                    $highlights_title = get_post_meta($info_id, 'highlights_title', true);
                    $highlights_description = wpautop(get_post_meta($info_id, 'highlights_description', true));
                }
            } */
            foreach($at_the_hotel_obj as $at_the_hotel_id)
            {
                if(get_post_status ( $at_the_hotel_id ) == 'publish')
                {
                    $data_array[$i]['title'] = get_post_meta($at_the_hotel_id,"name",true);
                    $image_id = get_post_meta($at_the_hotel_id,"image",true);
                    $data_array[$i]['image'] = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
                    $i++;
                }
            }
            
            $attraction_category_ids = array();
            foreach($city_attraction_obj as $city_attraction_id)
            {
                if(get_post_status ( $city_attraction_id ) == 'publish')
                {   
                    $category_ids = get_post_meta($city_attraction_id,"city_attraction_category",true);
                    if($category_ids)
                    {
                        foreach($category_ids as $category_id)
                        {
                            $attraction_category_ids[] = $category_id;
                        }
                    }
                }
            }

            $attraction_category_ids = array_unique($attraction_category_ids);
            sort($attraction_category_ids);

            $data_array = array();
            $i = 0;
            foreach($attraction_category_ids as $id)
            {
                $data_array[$i]['title'] = get_post_meta($id,"category_name",true);
                $image_id = get_post_meta($id,"image",true);
                $data_array[$i]['image'] = wp_get_attachment_url($image_id);
                $i++;
            }

            if(count($data_array) > 0){
                
                $height = 400;
                $width = 400;
                $section_title = 'City Attractions';
                ?>
                <div class="city-attraction-section">
                    <?php include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');
                ?>
                </div>
                <?php

            }
        }
        ?>
        <!-- City Attractions -->


        <!-- Testimonials -->
        <?php
        $testimonial_obj = get_post_meta($hotel_id, "testimonials", true);
        if($testimonial_obj)
        {
        ?>
            <div class="container blockqote-bg js_fade">
                <div class="wrapper blockquote-sec">
                    <?php
                    if(count($testimonial_obj) > 1)
                    {
                    ?>
                        <div  class="flexslider fadeslider">
                            <amp-carousel class="carousel1"
                                layout="responsive"
                                height="375"
                                width="450"
                                type="slides"
                                autoplay
                                delay="5000">
                                <?php
                                foreach($testimonial_obj as $testimonial_id)
                                {
                                    if(get_post_status ( $testimonial_id ) == 'publish')
                                    {
                                        $quote = get_post_meta($testimonial_id, 'quote', true);
                                        $author_name = get_post_meta($testimonial_id, 'author_name', true);
                                        $author_details = get_post_meta($testimonial_id, 'author_details', true);
                                        ?>
                                        <div class="slide-testimonial">
                                            <blockquote>
                                              <i class="ico-sprite sprite size-48 ico-quote"></i>
                                              "<?php echo $quote; ?>"
                                            </blockquote>
                                            <cite>
                                                <span class="name"><?php echo $author_name; ?></span>
                                                <span class="designation"><?php echo $author_details; ?></span>
                                            </cite>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </amp-carousel>
                        </div>
                    <?php
                    }
                    else
                    {
                    ?>
                        <div class="">
                            <ul class="slides">
                                <?php
                                foreach($testimonial_obj as $testimonial_id)
                                {
                                    if(get_post_status ( $testimonial_id ) == 'publish')
                                    {
                                        $quote = get_post_meta($testimonial_id, 'quote', true);
                                        $author_name = get_post_meta($testimonial_id, 'author_name', true);
                                        $author_details = get_post_meta($testimonial_id, 'author_details', true);
                                ?>
                                        <li> 
                                            <blockquote><?php echo $quote; ?></blockquote>
                                            <cite>
                                                <span class="name"><?php echo $author_name; ?></span>
                                                <span class="designation"><?php echo $author_details; ?></span>
                                            </cite>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        unset($testimonial_obj);
        ?>
        <!-- Testimonials -->
    </div><!-- container motif -->

</div><!-- content-section -->