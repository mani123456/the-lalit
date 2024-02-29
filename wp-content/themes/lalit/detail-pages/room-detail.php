<?php
$room_name = get_post_meta($post->ID,'name',true);
$room_description = wpautop(get_post_meta( $post->ID, "description", true));
$room_id = get_post_meta( $post->ID, 'room_id', true);


$hotel_title = '';
$hotel_name = '';
$thumbs_up_widget = '';

$curr = '&#8377';

if( $GLOBALS['destination']->have_posts() ) : 
    while($GLOBALS['destination']->have_posts()) : $GLOBALS['destination']->the_post();

        $hotel_id = $post->ID;
        $hotel_title = get_the_title($post->ID);
        $hotel_name = get_post_meta( $hotel_id, "name", true); 
        $suites_and_rooms_object = get_post_meta( $hotel_id, "suites_and_rooms", true); 
        $thumbs_up_widget = get_post_meta( $hotel_id, "thumbs_up_widget", true);
        $check_in_time = get_post_meta( $post->ID, "check_in_time", true);
        $check_out_time = get_post_meta( $post->ID, "check_out_time", true);
        $check_in_check_out_policy = wpautop(get_post_meta( $post->ID, "check_in_and_check_out_policy", true));
        $child_policy = wpautop(get_post_meta( $post->ID, "child_policy", true));
        $pet_policy = wpautop(get_post_meta( $post->ID, "pet_policy", true));
        $reservation_policy = wpautop(get_post_meta( $post->ID, "reservation_policy", true));
        $cancellation_policy = wpautop(get_post_meta( $post->ID, "cancellation_policy", true));
        $food_beverage_policy = wpautop(get_post_meta( $post->ID, "food_and_beverage_policy", true));
        $alcohol_policy = wpautop(get_post_meta( $post->ID, "alcohol_policy", true));
        $visitors_policy = wpautop(get_post_meta( $post->ID, "visitors_policy", true));
        $safety_and_security = wpautop(get_post_meta( $post->ID, "safety_and_security", true));
        $booking_engine = get_post_meta( $post->ID, "booking_engine", true);

        $GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
        $GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
        $GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
        $GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
        $GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);

        if($booking_engine == 1)
        {
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_engine_hotel_code = get_post_meta( $hotel_id, "booking_engine_hotel_code", true);
        }
        else if($booking_engine == 2)
        {
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_engine_hotel_id = get_post_meta( $hotel_id, "booking_engine_hotel_id", true);
            $booking_engine_chain_id = get_post_meta( $hotel_id, "booking_engine_chain_id", true);
        }

        $city_name = $GLOBALS['location'][0]->slug;
        
        $offers_obj = get_offers_by_type(1, $hotel_id, 2);
        $GLOBALS['detail_offers'] = $offers_obj;

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
wp_reset_postdata();

$types = get_terms([
    'taxonomy' => 'room_type',
    'hide_empty' => false,
]);
$type_array = array();
foreach($types as $r_type)
{
    $type_array[] = $r_type->term_id;
}

$room_type_array = array();
foreach($suites_and_rooms_object as $suites_and_rooms_id)
{
    if(get_post_status ( $suite_and_room_id ) == 'publish')
    {
        $room_type_array[] = get_the_terms($suites_and_rooms_id, 'room_type')[0]->term_id;
    }
}

$room_type_array = array_unique($room_type_array); 
asort($room_type_array);

$room_images = get_post_meta( $post->ID, "images", true);
$room_images = explode(",", $room_images);
$size_ft = get_post_meta( $post->ID, "size_ft", true);
$size_mt = get_post_meta( $post->ID, "size_mt", true);
$bed_type = get_post_meta( $post->ID, "bed_type", true);
$view = get_post_meta( $post->ID, "view", true);
$room_base_price = get_post_meta( $post->ID, "base_price", true);
$adults = get_post_meta( $post->ID, "adults", true);
$child = get_post_meta( $post->ID, "child", true);
$extra_bed = get_post_meta( $post->ID, "extra_bed", true);
$room_id = get_post_meta( $post->ID, "room_id", true);
$booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);

$floor_plan = get_post_meta( $post->ID, "floor_plan", true);
$dining_menu = get_post_meta( $post->ID, "dining_menu", true);
$pillow_menu = get_post_meta( $post->ID, "pillow_menu", true);

$room_features = get_the_terms($post->ID, 'room_facility');
$bed_baths = get_the_terms($post->ID, 'bed_bath');
$technologies = get_the_terms($post->ID, 'technology');
$services = get_the_terms($post->ID, 'service');
$inclusions = get_the_terms($post->ID, 'room_inclusion');

$image_array = array();
?>

<div class="content-section detail-sec">
<?php
if($booking_engine == 1)
{
?>
    <input type='hidden' id='booking_engine' value='<?php echo $booking_engine; ?>'>
    <input type='hidden' id='booking_engine_url' value='<?php echo $booking_engine_url; ?>'>
    <input type='hidden' id='booking_engine_hotel_code' value='<?php echo $booking_engine_hotel_code; ?>'>
    <input type='hidden' id='room_id' value='<?php echo $room_id; ?>'>
<?php
}
else if($booking_engine == 2)
{
?>
    <input type='hidden' id='booking_engine' value='<?php echo $booking_engine; ?>'>
    <input type='hidden' id='booking_engine_url' value='<?php echo $booking_engine_url; ?>'>
    <input type='hidden' id='booking_engine_hotel_id' value='<?php echo $booking_engine_hotel_id; ?>'>
    <input type='hidden' id='booking_engine_chain_id' value='<?php echo $booking_engine_chain_id; ?>'>
    <input type='hidden' id='room_id' value='<?php echo $room_id; ?>'>
<?php
}
?>

    <div class="container">

        <div class="row">

            
            <div class="col col2 section-space sidebar-outer">
                <div class="sidebar-inner">
                    <?php
                    $style = '';
                    if(isMobile())
                    {
                        $style="display:none";
                    ?>
                        <a class="sidebar-head selected_value mob-view">All Suites &amp; Rooms<i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                    <?php
                    }
                    else
                    {
                    ?>
                        <a class="sidebar-head" href="/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/"> <strong> <i class="ico-sprite sprite size-12 ico-gre-left-arrow"></i>All Suites &amp; Rooms</strong></a>
                    <?php
                    }
                    ?>   
                        <ul class="unstyled-listing sidebar-nav" style="<?php echo $style; ?>">
                        <?php
                            foreach($type_array as $value)
                            {
                                if(in_array($value, $room_type_array))
                                {
                                    $name = get_term($value, 'room_type')->name;
                        ?>          <li class="sideBar-nav-list">
                                        <span class="sideBar-nav-Head">
                                            <?php echo $name; ?>
                                        </span>

                                        <ul class="unstyled-listing sideBar-nav-info">
                                    <?php
                                        foreach($suites_and_rooms_object as $suites_and_rooms_id)
                                        {
                                            if(get_post_status ( $suites_and_rooms_id ) == 'publish')
                                            {
                                                $room_type = get_the_terms($suites_and_rooms_id, 'room_type');
                                                $room_type = $room_type[0]->term_id;

                                                if($room_type == $value)
                                                {
                                                    $permalink = get_permalink($suites_and_rooms_id);
                                                    $name = get_post_meta($suites_and_rooms_id, 'name', true);

                                                    if($post->ID == $suites_and_rooms_id) { $class = 'active'; } else { $class = ''; }
                                ?>
                                                    <li class="<?php echo $class; ?>">
                                                        <a href="<?php echo $permalink; ?>"><?php echo $name; ?></a>
                                                    </li> 
                                <?php
                                            }
                                        }
                                    }
                                ?>
                                        </ul><!--unstyled-listing-->
                                    </li>
                        <?php
                                }
                            }
                        ?>
                        </ul><!--filter-list-->     
                </div><!-- sidebar-inner -->        
            </div><!-- col -->
            

            <div class="col col10 marL0 sidebar-rcol">
                    <div class="row content-body">
                        <div class="col col9 tab-full-width">
                            <div class="services-dtl-info-block">
                                <div class="detail-breadcrumb-container">
                                    <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/"><?php echo $hotel_name; ?></a>
                                    <span class="breadcrumb-separator"></span>
                                    <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/suites-and-rooms/">Stay</a>
                                    <span class="breadcrumb-separator"></span>
                                    <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $room_name; ?></a>
                                </div>
                                <h2 class="page-title bdr-bottom">
                                    <span class="bdr-bottom-gold"><?php echo $room_name; ?></span>
                                </h2>
                                <?php
                                    if($room_description != '')
                                    {
                                ?>
                                    <div class="intro-text">
                                        <?php echo $room_description; ?>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div><!-- services-dtl-info-block -->    
                        </div><!-- col -->
                    </div><!-- row -->

                    <div class="row  content-body tab-full-width">
                        <div class="col col9">
                            <div class="img-block">
                        <?php

                            if(count($room_images) > 1)
                            {

                        ?>
                                <div id="slider" class="flexslider slider">
                                    <ul class="slides">
                                <?php
                                    foreach($room_images as $image_id)
                                    {
                                        $image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                                        array_push($image_array, $image);
                                ?>
                                        <?php if($image != '') { ?>
                                        <li>
                                            <img src="" class="image" alt="<?php echo $room_name;?>" title="<?php echo $room_name;?>" />
                                        </li>
                                        <?php } ?>
                                        
                                <?php
                                    }
                                ?>
                                    </ul>
                                </div><!-- slider -->
                        <?php

                            }
                            else
                            {
                                foreach($room_images as $image_id)
                                {
                                    $image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                                    array_push($image_array, $image);
                        ?>
                                        <?php if($image != '') { ?><img src="" class="image" alt="<?php echo $room_name;?>" title="<?php echo $room_name;?>" /><?php } ?>
                        <?php
                                }

                            }

                        ?>
                            </div><!-- img-block -->
                        </div><!--col col9-->

                        <div class="col col3 ">
                            <div class="room-info">
                                <ul class="unstyled-listing h-product vcard">

                                    <?php
                                    if($size_ft != '' || $size_mt != '')
                                    {
                                    ?>
                                        <li class="meta-block u-identifier">
                                            <span class="meta-label">Size</span>
                                    <?php    
                                            if($size_ft != '' && $size_mt == '')
                                            {
                                    ?>
                                                <strong class="meta-value"><?php echo $size_ft; ?> ft<sup>2</sup></strong>
                                    <?php
                                            }
                                            else if($size_ft == '' && $size_mt != '')
                                            {
                                    ?>
                                                <strong class="meta-value"><?php echo $size_mt; ?> m<sup>2</sup></strong>
                                    <?php
                                            }
                                            else
                                            {
                                    ?>
                                                <strong class="meta-value"><?php echo $size_ft; ?> ft<sup>2</sup> / <?php echo $size_mt; ?> m<sup>2</sup></strong>
                                    <?php
                                            }
                                    ?>
                                        
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($view != '')
                                    {
                                    ?>
                                        <li class="meta-block u-identifier">
                                            <span class="meta-label">View</span>
                                            <strong class="meta-value"><?php if($view != '') { echo $view; } else { echo '-'; } ?></strong>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($adults != '' || $child != '')
                                    {
                                    ?>

                                        <li class="meta-block u-identifier">
                                            <span class="meta-label">Occupancy</span>
                                        <?php
                                        if($adults != '' && $child == '')
                                        {
                                            if($adults == 1) { $txt1 = 'Adult'; } else { $txt1 = 'Adults'; }
                                        ?>
                                            <strong class="meta-value"><?php echo $adults; ?> <?php echo $txt1; ?></strong>
                                        <?php
                                        }
                                        else if($adults == '' && $child != '')
                                        {
                                            if($child == 1) { $txt2 = 'Child'; } else { $txt2 = 'Children'; }
                                        ?>
                                            <strong class="meta-value"><?php echo $child; ?> <?php echo $txt2; ?></strong>
                                        <?php
                                        }
                                        else
                                        {
                                            if($adults == 1) { $txt1 = 'Adult'; } else { $txt1 = 'Adults'; }
                                            if($child == 1) { $txt2 = 'Child'; } else { $txt2 = 'Children'; }
                                        ?>
                                            <strong class="meta-value"><?php echo $adults; ?> <?php echo $txt1; ?>, <?php echo $child; ?> <?php echo $txt2; ?></strong>
                                        <?php
                                        }
                                        ?>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($bed_type != '')
                                    {
                                    ?>
                                        <li class="meta-block u-identifier">
                                            <span class="meta-label">Bed Type</span>
                                            <strong class="meta-value p-category"><?php echo $bed_type; ?></strong> 
                                        </li>
                                    <?php
                                    }
                                    ?>

                                        <li class="meta-block u-identifier">
                                            <span class="meta-label">Extra Bed</span>
                                            <strong class="meta-value"><?php if($extra_bed) { echo 'Allowed'; } else { echo 'Not Allowed'; } ?></strong>
                                        </li>

                                    <?php
                                    if($room_base_price != '')
                                    {
                                    ?>
                                        <li class="price-block meta-inline">
                                            <span class="meta-label">Starting at</span>
                                            <strong class="meta-value p-price"><?php echo $curr; ?><?php if($room_base_price != '') { echo number_format($room_base_price); } else { echo '-'; } ?></strong>      
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <?php  if(!empty($booking_engine_url)) { ?>
                                     <li><a href="<?php echo $booking_engine_url; ?>" class="reserve-btn"  target="_blank" style="    border: 0;    border-radius: 0;    color: #fff;">Reserve</a></li>
									<?php } else { ?>									
                                    <li><button type="button" class="btn secondary-btn reserve-btn">Reserve</button></li>
									<?php } ?>
                                   
                                </ul><!-- unstyled-listing -->  
                            </div><!-- services-dtl-info-block -->
                             
                        </div><!-- col -->

                    </div><!--row-->

                    <div class="row  content-body">

                <?php
                    if($inclusions)
                    {
                ?>   
                        <div class="col col9">
                            <div class="inclusions-block">
                                 
                                <h2 class="sec-title"> <small>Stay</small>    Inclusions</h2>
                                <ul class="inclusions unstyled-listing">
                            <?php
                                foreach($inclusions as $inclusion)
                                {
                            ?>      
                                    <li class="span span4">
                                                                            
                                          <span><?php echo $inclusion->name; ?></span>
                                      
                                    </li>
                            <?php   
                                }
                            ?> 
                                </ul><!-- inclusions -->
                            </div><!-- inclusions-block -->
                        </div><!-- col9 -->
                <?php
                    }
                ?>
                
                <?php
                    if($thumbs_up_widget != '')
                    {
                ?>
                        <div class="col col3">
                            <?php echo $thumbs_up_widget; ?>
                        </div><!-- col3 -->
                <?php
                    }
                ?>

                    </div><!-- row -->
                    <div class="row section-bg content-body">
                        <?php
                        if($room_features || $services || $bed_baths || $technologies)
                        {
                        ?>  
                            <h2 class="sec-title">  <small>In-Room</small> Amenities &amp; Services</h2>                      
                                <div class="col col12 marL0">
                                    <?php
                                            if($room_features)
                                            {
                                    ?>
                                                <div class="col col3">
                                                    <div class="sub-section">
                                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Room Features</span></h4>
                                                        <ul class="service-list">
                                                    <?php
                                                        $f = 1;
                                                        foreach($room_features as $feature)
                                                        {
                                                            if($f > 10)
                                                            {
                                                                $style1 = "display:none";
                                                                $class1 = "hiddeble";
                                                            }
                                                    ?>
                                                            <li style="<?php echo $style1; ?>" class="<?php echo $class1; ?>"><?php echo $feature->name; ?></li>
                                                    <?php
                                                            $f++;
                                                        }
                                                    ?> 
                                                        </ul><!-- bullet-listing -->
                                                        <?php
                                                        if(count($room_features) > 10)
                                                        {
                                                        ?>
                                                        <a href="javascript:void(0)" class="text-link read_more">Read More</a>                                 
                                                        <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                                        <?php
                                                        }
                                                        ?>       
                                                    </div><!-- sub-section -->
                                                </div>
                                    <?php
                                            }

                                            if($bed_baths)
                                            {
                                    ?>
                                                <div class="col col3">
                                                    <div class="sub-section ">
                                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Bed &amp; Bath</span></h4>
                                                            <ul class="service-list">
                                                    <?php
                                                        $b = 1;
                                                        foreach($bed_baths as $bath)
                                                        {
                                                            if($b > 10)
                                                            {
                                                                $style3 = "display:none";
                                                                $class3 = "hiddeble";
                                                            }
                                                    ?>
                                                            <li style="<?php echo $style3; ?>" class="<?php echo $class3; ?>"><?php echo $bath->name; ?></li>
                                                    <?php
                                                            $b++;
                                                        }
                                                    ?>
                                                            </ul><!-- bullet-listing -->
                                                            <?php
                                                            if(count($bed_baths) > 10)
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>                                 
                                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                                            <?php
                                                            }
                                                            ?>      
                                                    </div><!-- sub-section -->
                                                </div>
                                    <?php
                                            }
                                
                                            if($technologies)
                                            {
                                    ?>
                                                <div class="col col3">
                                                    <div class="sub-section">
                                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Technology</span></h4>
                                                            <ul class="service-list">
                                                    <?php
                                                        $t = 1;
                                                        foreach($technologies as $technology)
                                                        {
                                                            if($t > 10)
                                                            {
                                                                $style4 = "display:none";
                                                                $class4 = "hiddeble";
                                                            }
                                                    ?>
                                                            <li style="<?php echo $style4; ?>" class="<?php echo $class4; ?>"><?php echo $technology->name; ?></li>
                                                    <?php
                                                            $t++;
                                                        }
                                                    ?>
                                                            </ul><!-- bullet-listing -->
                                                            <?php
                                                            if(count($technologies) > 10)
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>                                 
                                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                                            <?php
                                                            }
                                                            ?>     
                                                    </div><!-- sub-section -->
                                                </div>
                                    <?php
                                            }


                                            if($services)
                                            {
                                    ?>
                                                <div class="col col3">
                                                    <div class="sub-section">
                                                        <h4 class="hotel-services-title"><span class="bdr-bottom-grey">Services</span></h4>
                                                            <ul class="service-list">
                                                    <?php
                                                        $s = 1;
                                                        foreach($services as $service)
                                                        {
                                                            if($s > 10)
                                                            {
                                                                $style2 = "display:none";
                                                                $class2 = "hiddeble";
                                                            }
                                                    ?>
                                                            <li style="<?php echo $style2; ?>" class="<?php echo $class2; ?>"><?php echo $service->name; ?></li>
                                                    <?php
                                                            $s++;
                                                        }
                                                    ?> 
                                                            </ul><!-- bullet-listing -->
                                                            <?php
                                                            if(count($services) > 10)
                                                            {
                                                            ?>
                                                            <a href="javascript:void(0)" class="text-link read_more">Read More</a>                                 
                                                            <a href="javascript:void(0)" class="text-link read_less">show less</a>
                                                            <?php
                                                            }
                                                            ?>      
                                                    </div><!-- sub-section -->
                                                </div>
                                    <?php
                                            }
                                    ?>
                                    
                                </div>
                        <?php
                        }
                        ?>
                            
                        <div class="col col3 marL0">
                            <ul class="unstyled-listing services-nav align-left">
                            <?php
                            if($floor_plan || $dining_menu || $pillow_menu)
                            {
                            ?>
                                <?php if($floor_plan != '') { ?><li><a href="<?php echo wp_get_attachment_url($floor_plan); ?>" class="text-link" target="_blank">Floor Plan <i class="ico-sprite sprite ico-red-right-arrow"></i></a></li><?php } ?>
                                <?php if($dining_menu!= '') { ?><li><a href="<?php echo wp_get_attachment_url($dining_menu); ?>" class="text-link" target="_blank">IN ROOM DINING MENU <i class="ico-sprite sprite ico-red-right-arrow"></i></a></li><?php } ?>
                                <?php if($pillow_menu != '') { ?><li><a href="<?php echo wp_get_attachment_url($pillow_menu); ?>" class="text-link" target="_blank">PILLOW MENU <i class="ico-sprite sprite ico-red-right-arrow"></i></a></li><?php } ?>
                            <?php
                            }
                            ?>
                                <li>
                                    <a href="#policies" class="text-link uppercase fancybox"> Guests Policies <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                                </li>
                            </ul>    
                        </div><!-- col -->

                    </div><!-- row -->

                    <?php 
                        if( $GLOBALS['detail_offers']->have_posts() ) :
                            $GLOBALS['type'] = 'suites-and-rooms';
                    ?>
                    <div class="row content-body offer-sec">  
                    <?php 

                            get_template_part( 'includes/available', 'offers-detail' );
                    ?>
                     </div>
                    <?php

                        endif;
                    ?>
                    
            </div><!-- col -->

        </div><!-- row -->

    </div><!-- container -->    

</div><!-- content-section --> 

<div id="policies" class="pop-up" style="display: none;">
    <h2 class="sec-title">Guest Policies</h2>
        <ul class="accordion  unstyled-listing">
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                <span>
                  <h6 class="accordion-heading">Check-in and Check-out Policy</h6>
                </span>
                <span class="sprite  size-16 ico-gre-down-arrow"></span>
                <span class="sprite  size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <div class="check-col">
                    <span class="span span4">
                        <span class="meta-label">Check-in:</span>
                        <span class="meta-value"><?php echo $check_in_time; ?></span>
                    </span>
                    <span class="span span4">
                        <span class="meta-label">Check-out:</span>
                        <span class="meta-value"><?php echo $check_out_time; ?></span>
                    </span>
                 </div>
              
                    <?php echo $check_in_check_out_policy; ?>
             
              </div>
              <!--collapse-data-->     
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Child Policy</h6>
                 </span>
                  <span class="sprite  size-16 ico-gre-down-arrow"></span>
                   <span class="sprite  size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <?php echo $child_policy; ?>
              </div>
              <!--collapse-data-->     
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Pet Policy</h6>
                 </span>
                  <span class="sprite  size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $pet_policy;
                 ?>
              </div><!--collapse-data-->  
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Reservation Gaurantee</h6>
                 </span>
                  <span class="sprite  size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $reservation_policy;
                 ?>
              </div><!--collapse-data-->  
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Cancellation Policy</h6>
                 </span>
                   <span class="sprite size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a> 
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $cancellation_policy;
                 ?>
              </div><!--collapse-data-->  
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Food and Beverage Policy</h6>
                 </span>
                   <span class="sprite size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a> 
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $food_beverage_policy;
                 ?>
              </div><!--collapse-data-->  
            </li>
			<li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Alcohol Policy</h6>
                 </span>
                 <span class="sprite size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $alcohol_policy;
                 ?> 
              </div><!--collapse-data-->   
            </li>
            <li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Visitors Policy</h6>
                 </span>
                   <span class="sprite size-16 ico-gre-down-arrow"></span>
                   <span class="sprite size-16 ico-gre-up-arrow"></span>
              </a> 
              <div class="collapse-data" style="display:none;">
                 <?php
                    echo $visitors_policy;
                 ?>
              </div><!--collapse-data-->  
            </li>
			<li>
              <a href="javascript:void(0)" class="accordion-head collapse">
                 <span>
                    <h6 class="accordion-heading">Safety and Security</h6>
                 </span>
                  <span class="sprite  size-16 ico-gre-down-arrow"></span>
                   <span class="sprite  size-16 ico-gre-up-arrow"></span>
              </a>
              <div class="collapse-data" style="display:none;">
                 <p>
                 <?php
                    echo $safety_and_security;
                 ?>
                 </p>
              </div><!--collapse-data-->
            </li> 
        </ul><!-- accordion -->  
</div><!-- pop-up --> 

<?php
    $GLOBALS['image_array'] = $image_array;
?>
