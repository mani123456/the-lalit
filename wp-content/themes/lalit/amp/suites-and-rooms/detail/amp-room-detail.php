<?php
$room_name = get_post_meta($post->ID,'name',true);
$room_description = wpautop(get_post_meta( $post->ID, "description", true));
$room_id = get_post_meta( $post->ID, 'room_id', true);
$booking_link = '';


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
        $alcohol_policy = wpautop(get_post_meta( $post->ID, "alcohol_policy", true));
        $safety_and_security = wpautop(get_post_meta( $post->ID, "safety_and_security", true));
        $booking_engine = get_post_meta( $post->ID, "booking_engine", true);

        $GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
        $GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
        $GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
        $GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
        $GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);


        if($booking_engine == 1)
        {
            $booking_engine_hotel_code = get_post_meta( $post->ID, "booking_engine_hotel_code", true);
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_link = $booking_engine_url.'/?Hotel='.$booking_engine_hotel_code;
            if(trim($room_id) != ''){

                $booking_link .= '?room='.$room_id;
            }
        }
        else if($booking_engine == 2)
        {
            $booking_engine_hotel_id = get_post_meta( $post->ID, "booking_engine_hotel_id", true);
            $booking_engine_chain_id = get_post_meta( $post->ID, "booking_engine_chain_id", true);
            $booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
            $booking_engine_url = rtrim($booking_engine_url, '/');
            $booking_link = $booking_engine_url.'?Hotel='.$booking_engine_hotel_id.'&Chain='.$booking_engine_chain_id;

            if(trim($room_id) != ''){
                $booking_link .= '&Room='.$room_id;
            }
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
    <input type='hidden' id='booking_engine_hotel_code' value='<?php echo $booking_engine_hotel_code; ?>'>
    <input type='hidden' id='room_id' value='<?php echo $room_id; ?>'>
<?php
}
else if($booking_engine == 2)
{
?>
    <input type='hidden' id='booking_engine' value='<?php echo $booking_engine; ?>'>
    <input type='hidden' id='booking_engine_hotel_id' value='<?php echo $booking_engine_hotel_id; ?>'>
    <input type='hidden' id='booking_engine_chain_id' value='<?php echo $booking_engine_chain_id; ?>'>
    <input type='hidden' id='room_id' value='<?php echo $room_id; ?>'>
<?php
}
?>

    <div class="container">
        <div class="row">
            <div class="section-space sidebar-outer">
                <div class="sidebar-inner">
                    <amp-accordion animate>
                        <section>
                            <h5 class="sidebar-head selected_value mob-view">All Suites &amp; Rooms<i class="ico-sprite sprite ico-gre-down-arrow"></i></h5>
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
                                                                        <a href="<?php echo $permalink.'amp'; ?>"><?php echo $name; ?></a>
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
                        </section>
                    </amp-accordion>    
                </div><!-- sidebar-inner -->    
            </div><!-- col -->
            <div class="sidebar-rcol">
                <div class="row room-section-space">
                    <div class="breadcrumb-container-section">
                        <div class="services-dtl-info-block">
                            <div class="detail-breadcrumb-container">
                                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/?amp"><?php echo $hotel_name; ?></a>
                                <span class="breadcrumb-separator"></span>
                                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/suites-and-rooms/?amp">Stay</a>
                                <span class="breadcrumb-separator"></span>
                                <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $room_name; ?></a>
                            </div>
                            <h2 class="sec-title bdr-bottom">
                                <span class="bdr-bottom-gold"><?php echo $room_name; ?></span>
                            </h2>
                            <?php
                                if($room_description != '')
                                {
                            ?>
                                <div class="intro-text">
                                    <?php echo the_lalit_remove_image_tags_amp($room_description); ?>
                                </div>
                            <?php
                                }
                            ?>
                        </div><!-- services-dtl-info-block -->    
                    </div><!-- col -->
                </div><!-- row -->

                <div class="row room-section-space">
                    <div class="img-block">
                        <?php

                            if(count($room_images) > 1)
                            {

                        ?>
                                <div id="slider" class="flexslider slider">
                                    <amp-carousel id="custom-button"
                                        width="768"
                                        height="576"
                                        layout="responsive"
                                        type="slides"
                                        autoplay
                                        controls>
                                        <?php
                                            foreach($room_images as $image_id)
                                            {
                                                $image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                                        ?>
                                                <?php if($image != '') { ?>
                                                <li class="stay-carousel-list">
                                                    <amp-img src="<?php echo $image; ?>"
                                                        width="768"
                                                        height="576"
                                                        layout="responsive"
                                                        alt="<?php echo $room_name;?>">
                                                    </amp-img>
                                                </li>
                                                <?php } ?>
                                                
                                        <?php
                                            }
                                        ?>
                                    </amp-carousel>
                                </div><!-- slider -->
                        <?php

                            }
                            else
                            {
                                foreach($room_images as $image_id)
                                {
                                    $image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                        ?>
                                        <?php if($image != '') { ?>
                                            <amp-img src="<?php echo $image; ?>"
                                                width="768"
                                                height="576"
                                                layout="responsive"
                                                alt="<?php echo $room_name;?>">
                                            </amp-img>
                                        <?php } ?>
                        <?php
                                }

                            }

                        ?>
                    </div><!-- img-block -->

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
                                <li class="starting-price-section clearfix">
                                    <span class="starting-price-label">Starting at</span>
                                    <strong class="starting-price-value p-price"><?php echo $curr; ?><?php if($room_base_price != '') { echo number_format($room_base_price); } else { echo '-'; } ?></strong>      
                                </li>
                            <?php
                            }
                            ?>

                            <?php if($booking_link != ''){ ?><li><a href="<?php echo $booking_link; ?>" class="btn secondary-btn reserve-btn">Reserve</a></li><?php } ?>
                            
                        </ul><!-- unstyled-listing -->  
                    </div><!-- room-info -->

                </div><!--row-->

                <div class="row room-section-space">
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
                        /*if($thumbs_up_widget != '')
                        {
                    ?>
                            <div class="col col3">
                                <?php echo $thumbs_up_widget; ?>
                            </div><!-- col3 -->
                    <?php
                        }*/
                    ?>
                </div><!-- row -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container --> 

    <div class="policy-bg">
        <div class="row amenities-block">
            <?php
            if($room_features || $services || $bed_baths || $technologies)
            {
                $i=0;
            ?>  
                <h2 class="sec-title">  <small>In-Room</small> Amenities &amp; Services</h2>                      
                    <amp-accordion animate expand-single-section>
                        <?php
                                if($room_features)
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
                                            foreach($room_features as $feature)
                                            {
                                        ?>
                                                <li style="<?php echo $style1; ?>" class="<?php echo $class1; ?>"><?php echo $feature->name; ?></li>
                                        <?php
                                            }
                                        ?> 
                                            </ul><!-- bullet-listing -->
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
                                            foreach($bed_baths as $bath)
                                            {
                                        ?>
                                                <li style="<?php echo $style3; ?>" class="<?php echo $class3; ?>"><?php echo $bath->name; ?></li>
                                        <?php
                                            }
                                        ?>
                                            </ul><!-- bullet-listing -->
                                    </section>
                        <?php
                                }
                    
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
                                            foreach($technologies as $technology)
                                            {
                                        ?>
                                                <li style="<?php echo $style4; ?>" class="<?php echo $class4; ?>"><?php echo $technology->name; ?></li>
                                        <?php
                                            }
                                        ?>
                                            </ul><!-- bullet-listing -->
                                    </section>
                        <?php
                                }


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

                                            foreach($services as $service)
                                            {
                                        ?>
                                                <li style="<?php echo $style2; ?>" class="<?php echo $class2; ?>"><?php echo $service->name; ?></li>
                                        <?php
                                            }
                                        ?> 
                                            </ul><!-- bullet-listing -->
                                    </section>
                        <?php
                                }
                        ?>
                        
                    </amp-accordion>
            <?php
            }
            ?>
                
            <div class="col col3 marL0">
                <ul class="services-nav align-left">
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
                        <a href="<?php echo site_url().'/the-lalit-'.$GLOBALS['location'][0]->slug.'/guest-policy/?amp'; ?>" target="_blank" class="text-link uppercase fancybox"> Guests Policies <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                    </li>
                </ul>    
            </div><!-- col -->

        </div><!-- row -->
    </div>
    <?php 
        if( $GLOBALS['detail_offers']->have_posts() ) :

            $section_title = "<small>Available</small> Offers";
            $loop = $GLOBALS['detail_offers'];
            $city_name = $GLOBALS['location'][0]->slug;
            $width = 610;
            $height = 324;
            $class1 = 'content-body';
            $class = 'offer-sec';
            include_once(get_template_directory() . '/amp/includes/amp-available-offers.php');

        endif;
    ?>         
</div><!-- content-section --> 