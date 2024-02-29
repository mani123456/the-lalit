<?php
    
    $dining_name = get_post_meta($post->ID, 'name', true);

    $dining_images = get_post_meta( $post->ID, "images", true);
    $dining_images = explode(",", $dining_images);

    $dining_description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta( $post->ID, "description", true)));

    $dining_cuisine =  get_post_meta($post->ID, "cuisine", true);
    $dining_contact = get_post_meta($post->ID, "contact", true);
    $dining_ratings = get_post_meta($post->ID, "ratings", true);
    $dining_seatings = get_post_meta($post->ID, "seatings", true);
    $dining_location = get_post_meta($post->ID, "location", true);
    //$dining_timings = get_post_meta($post->ID, "timings", true);
    $dining_level = get_post_meta($post->ID, "level", true);
    $dining_breakfast_from = get_field("breakfast_from");
    $dining_breakfast_to = get_field("breakfast_to");
    $dining_lunch_from = get_field("lunch_from");
    $dining_lunch_to = get_field("lunch_to");
    $dining_dinner_from = get_field("dinner_from");
    $dining_dinner_to = get_field("dinner_to");
    /*$chef_image_id = get_post_meta( $post->ID, "chef_image", true);
    $chef_image = wp_get_attachment_url($chef_image_id);
    $chef_description = wpautop(get_post_meta( $post->ID, "chef_description", true));
    $chef_name = get_post_meta( $post->ID, "chef_name", true);
    $chef_designation = get_post_meta( $post->ID, "chef_designation", true);*/
    $booking_type = get_post_meta($post->ID, "booking_type", true);
    $no_booking = get_post_meta($post->ID, "no_booking", true);

    $dining_menu = get_field("restaurant_menu");

    $res_types = '';
    if(get_post_status ( $post->ID ) == 'publish')
    {
        $types = get_the_terms($post->ID, 'dining-type');
        foreach($types as $type)
        {
            if($type->parent != 0)
            {
                $res_types .= $type->name.', ';
            }
        }
    }

    $res_types = rtrim($res_types, ', ');

    $rave_view = get_post_meta($post->ID, "rave_review_widget", true);
    $write_view = get_post_meta($post->ID, "write_review_widget", true);

    $restaurant_highlights = get_the_terms($post->ID, 'restaurant-highlight');

    $GLOBALS['detail_offers'] = get_offers_by_dining($GLOBALS['hotel_id'], $post->ID, 2);

    $city_name = $GLOBALS['location'][0]->slug;

    $hotel_title = '';
    $hotel_name = '';
    $hotel_id = '';
    if( $GLOBALS['destination']->have_posts() ) :
        while($GLOBALS['destination']->have_posts()) : $GLOBALS['destination']->the_post();

            $hotel_id = $post->ID;
            $hotel_title = get_the_title($hotel_id);
            $hotel_name = get_post_meta( $hotel_id, "name", true);
            $dinings_object = get_post_meta( $hotel_id, "dinings", true);

            $GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
            $GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
            $GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
            $GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
            $GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);
        
        endwhile;
    endif;

    wp_reset_postdata();

    $types = get_terms([
        'taxonomy' => 'room_type',
        'hide_empty' => false,
    ]);
    $type_array = array();
    foreach($types as $d_type)
    {
        $type_array[] = $d_type->term_id;
    }

    $dining_type_array = array();
    foreach($dinings_object as $dining_id)
    {
        if(get_post_status ( $dining_id ) == 'publish')
        {
            $array = get_the_terms($dining_id, 'dining-type');
            foreach($array as $value)
            {
                if($value->parent == 0)
                {
                    $dining_type_array[] = $value->term_id;
                }
            }
        }
    }

    $dining_type_array = array_unique($dining_type_array);
    asort($dining_type_array);
?>

<div class="content-section detail-sec">
    <div class="container">
        <div class="row">


            <div class="section-space sidebar-outer">
                <div class="sidebar-inner">
                    <amp-accordion animate>
                        <section>
                            <h5 class="sidebar-head selected_value mob-view">All Venues<i class="ico-sprite sprite ico-gre-down-arrow"></i></h5>
                            <ul class="unstyled-listing sidebar-nav" style="<?php echo $style; ?>">
                                <?php
                                    foreach($dining_type_array as $value)
                                    {
                                        if(in_array($value, $dining_type_array))
                                        {
                                            $name = get_term($value, 'dining-type')->name;
                                ?>          <li class="sideBar-nav-list">
                                                <span class="sideBar-nav-Head">
                                                    <?php echo $name; ?>
                                                </span>

                                                <ul class="unstyled-listing sideBar-nav-info">
                                                    <?php
                                                        foreach($dinings_object as $dining_id)
                                                        {
                                                            if(get_post_status ( $dining_id ) == 'publish')
                                                            {
                                                                $dining_types = get_the_terms($dining_id, 'dining-type');
                                                                $dining_type = '';
                                                                foreach($dining_types as $type)
                                                                {
                                                                    if($type->parent == 0 && $type->term_id == $value)
                                                                    {
                                                                        $dining_type = $type->term_id;
                                                                        break;
                                                                    }
                                                                } 

                                                    
                                                                if($dining_type == $value)
                                                                {
                                                                    $permalink = get_permalink($dining_id);
                                                                    $name = get_post_meta($dining_id, 'name', true);

                                                                    if($post->ID == $dining_id) { $class = 'active'; } else { $class = ''; }
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

                <div class="dining-content-body tab-full-width">
                    <div class="breadcrumb-container-section">
                        <div class="services-dtl-info-block">
                            <div class="detail-breadcrumb-container">
                                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/?amp"><?php echo $hotel_name; ?></a>
                                <span class="breadcrumb-separator"></span>
                                <a class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/eat-and-drink/?amp">Eat &amp; Drink</a>
                                <span class="breadcrumb-separator"></span>
                                <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $dining_name; ?></a>
                            </div>
                                <h2 class="sec-title bdr-bottom"><span class="bdr-bottom-gold"><?php echo $dining_name; ?></span></h2>
<?php
                                if($dining_description != '')
                                {
?>
                                <div class="intro-text">
                                    <?php echo $dining_description; ?>
                                </div>
<?php
                                }
?>
                        </div><!-- services-dtl-info-block -->    
                    </div><!-- col -->
                </div><!-- row -->

                <div class="dining-content-body tab-full-width">
                        <div class="img-block">
<?php

                        if(count($dining_images) > 1)
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
                                foreach($dining_images as $image_id)
                                {
                                    $dining_image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                                    if($dining_image != '') 
                                    { 
?>
                                        <li class="stay-carousel-list">
                                            <amp-img src="<?php echo $dining_image; ?>"
                                                width="768"
                                                height="576"
                                                layout="responsive"
                                                alt="<?php echo $dining_name;?>">
                                            </amp-img>
                                        </li>
<?php 
                                    } 
                                }
?>
                            </amp-carousel>
                            </div><!-- slider -->
<?php
                        }
                        else
                        {
                            foreach($dining_images as $image_id)
                            {
                                $dining_image = wp_get_attachment_image_src($image_id, 'medium_large')[0];
                                if($dining_image != '') 
                                { 
?>
                                    <amp-img src="<?php echo $dining_image; ?>"
                                        width="768"
                                        height="576"
                                        layout="responsive"
                                        alt="<?php echo $dining_name;?>">
                                    </amp-img>
<?php 
                                } 
                            }

                        }

?>
                        </div><!-- img-block -->

                        <div class="room-info">
                            <ul class="unstyled-listing meta-block">
<?php
                                if($dining_cuisine != '')
                                {
?>
                                    <li>
                                        <span class="meta-label">CUISINE</span>
                                        <strong class="meta-value p-category"><?php echo $dining_cuisine; ?></strong>
                                    </li>
<?php
                                }

                                if( ($dining_lunch_from != '' && $dining_lunch_to != '') || ($dining_dinner_from != '' && $dining_dinner_to != '') || ($dining_breakfast_from != '' && $dining_breakfast_to != '') )
                                {
?>
                                    <li>
                                        <span class="meta-label">HOURS</span>
                                        <?php
                                        if($dining_breakfast_from != '' && $dining_breakfast_to != '')
                                        {
                                        ?>
                                            <p class="meta-value-container"><strong class="meta-value">Breakfast:</strong>
                                            <span class="meta-value"><?php echo $dining_breakfast_from; ?> to <?php echo $dining_breakfast_to; ?></span></p>
                                        <?php
                                        }
                                        if($dining_lunch_from != '' && $dining_lunch_to != '')
                                        {
                                        ?>
                                            <p class="meta-value-container"><strong class="meta-value">Lunch:</strong>
                                            <span class="meta-value"><?php echo $dining_lunch_from; ?> to <?php echo $dining_lunch_to; ?></span></p>
                                        <?php
                                        }
                                        if($dining_dinner_from != '' && $dining_dinner_to != '')
                                        {
                                        ?>
                                            <p class="meta-value-container"><strong class="meta-value">Dinner:</strong>
                                            <span class="meta-value p-category"><?php echo $dining_dinner_from; ?> to <?php echo $dining_dinner_to; ?></span></p>
                                        <?php
                                        }
                                        ?>
                                    </li>
<?php
                                }

                                if($dining_seatings != '')
                                {
?>
                                    <li>
                                        <span class="meta-label">SEATINGS</span>
                                        <strong class="meta-value"><?php echo $dining_seatings; ?></strong>
                                    </li>
<?php
                                }

                                if($dining_level != '')
                                {
?>
                                    <li>
                                        <span class="meta-label">LEVEL</span>
                                        <strong class="meta-value"><?php echo $dining_level; ?></strong>
                                    </li>
<?php
                                }

                                if($res_types != '')
                                {
?>
                                    <li>
                                        <span class="meta-label">TYPE</span>
                                        <strong class="meta-value"><?php echo $res_types; ?></strong>
                                    </li>
<?php
                                }

                                if($dining_contact != '')
                                {
?> 
                                    <li>
                                        <span class="meta-label">BOOK A TABLE</span>
                                        <strong class="meta-value p-tel"><?php echo $dining_contact; ?></strong>
                                    </li> 
<?php
                                }

                                if($dining_menu["mime_type"] == 'application/pdf')
                                {
?>

                                    <li>
                                    <a href="<?php echo $dining_menu["url"]; ?>" target="_blank" class="text-link menu-text-link"> <i class="ico-sprite sprite ico-menu menu-pdf"></i><span class="view-menu-link">View Menu <i class="ico-sprite sprite size-32 ico-red-right-arrow"></span></i></a>
                                    </li> 
<?php
                                }
                                if(!$no_booking)
                                {
                                    if($booking_type == 1)
                                    {
?>
                                        <li><a href="<?php echo get_the_permalink(); ?>?booking=true" class="btn secondary-btn reserve-btn fancybox">Book Now</a></li>
<?php
                                    }
                                    else if($booking_type == 2)
                                    {
                                        $external_url = get_post_meta( $post->ID, "website", true);
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $external_url)) 
                                        {
                                          $external_url = "http://" . $external_url;
                                        }
                                        else
                                        {
                                          $external_url = $external_url;
                                        }
?>
                                        <li><a href="<?php echo $external_url; ?>" target="_blank" class="btn secondary-btn reserve-btn fancybox">Book Now</a></li>
<?php
                                    }
                                    else if($booking_type == 3)
                                    {
                                        $zomato_id = get_post_meta($post->ID, "zomato_id", true);
?>
                                        <!-- <script type="text/javascript" src="https://www.zomatobook.com/scripts/1.0/reswidget.min.js"></script>
                                        <link rel="stylesheet" href="https://www.zomatobook.com/content/style.css" />
                                        <li>
                                        <a href="javascript:void(0);" class="btn secondary-btn reserve-btn" onclick="NEXTWIDGET.widget.show('<?php echo $zomato_id; ?>',false);">Book Now</a>
                                        </li> -->

                                        <li><a href="<?php echo get_the_permalink(); ?>?booking=true" class="btn secondary-btn reserve-btn fancybox">Book Now</a></li>
<?php
                                    }
                                }
?>  
                            </ul><!-- unstyled-listing -->

                        </div><!-- services-dtl-info-block -->

                </div><!--row-->

<?php
            /*if(get_post_meta($post->ID, "rave_review_widget", true) || get_post_meta($post->ID, "write_review_widget", true))
            {
?>
                <!-- widget goes here -->
                <div class="row content-body">
                    <h2 class="page-title bdr-bottom">
                        <small>Guests</small>
                        <span class="bdr-bottom-gold">Recommend</span>
                    </h2>  
                </div>
                                
                <div class="row  content-body  recommend-area">
                
                    <div class="col col9">
                        <?php echo get_post_meta($post->ID, "rave_review_widget", true); ?>
                    </div>

                    <div class="col col3">
                        <?php echo get_post_meta($post->ID, "write_review_widget", true); ?>
                    </div>
                
                </div>
<?php
            }*/
?>
                

            <div class="dining-content-body">
<?php
            if($restaurant_highlights)
            {
?>            
                <div class="row" >             
                    <h2 class="restaurant-title bdr-bottom">
                        <small class="restaurant-detail-title">restaurant</small>
                        <span class="restaurant-detail-subtitle bdr-bottom-gold">Highlights</span>
                    </h2>
                </div>

                <div class="row two-col-listing dinning-service highlights">
<?php
                $count = 0;
                foreach($restaurant_highlights as $highlights)
                {
                    $term_id = $highlights->term_id;
                    $highlights_name = trim($highlights->name);
                    if(strpos($highlights_name, '-') != false)
                    {
                        $names = explode('-', $highlights_name);
                        $highlights_name = trim($names[1]);
                    }
                    else
                    {
                        $highlights_name = trim($highlights->name);
                    }
                    $highlights_description = the_lalit_remove_image_tags_amp($highlights->description);
                    $meta_data = get_term_meta($term_id);
                    $highlights_image = $meta_data['wpcf-highlight_image'][0];

?>
                    <div class="span span6">
                        <div class="listing-block">
                            <?php if($highlights_image) { ?>
                            <amp-img src="<?php echo $highlights_image; ?>"
                                width="500"
                                height="200"
                                layout="responsive"
                                alt="<?php echo $highlights_name;?>">
                            </amp-img>
                            <?php } ?>
                            <div class="card-info">
                                <h3 class="card-info-title dining-highlight-offer bdr-bottom">
                                <span class="bdr-bottom-gold"><?php echo $highlights_name; ?></span>
                                </h3>
<?php
                                    if(strlen($highlights_description) > 140)
                                    {
                                        $des = substr($highlights_description, 0,140);
?>
                                        <p class="trunc" [class]="textVisible<?php echo $count; ?> ? 'hide' : 'trunc'"><?php echo $des; ?><span class="ext">...</span></p>
                                        <p class="hide" [class]="textVisible<?php echo $count; ?> ? 'untrunc' : 'hide'"><?php echo $highlights_description; ?></p>

                                        <a class="text-link" [text]="textVisible<?php echo $count; ?> ? 'Show Less' : 'Read More'" on="tap:AMP.setState({textVisible<?php echo $count; ?>: !textVisible<?php echo $count; ?>})">Read More</a>
<?php
                                    }
                                    else
                                    {
?>
                                         <p><?php echo $highlights_description; ?></p>
<?php
                                    }
?>
                                </div><!-- card-info -->

                            </div><!-- listing-block -->
                    </div><!-- col -->
<?php
                    $count++;
                }
?>
            </div><!-- content-body -->
<?php
            }
?>


<?php
$restaurant_id = get_the_id();
$chef_args = array(
    'post_type' => 'chef',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'ASC',
    'meta_key' => 'chefs_name',
    'orderby' => 'meta_value chefs_name',
);

$chef_loop = new WP_Query($chef_args);

if($chef_loop->have_posts()) {

    $restaurants_array = [];
    while($chef_loop->have_posts()) { $chef_loop->the_post();
    
        $restaurants = get_post_meta( get_the_id(), "restaurant", true);
        foreach($restaurants as $restaurant) {

            array_push($restaurants_array, $restaurant);
        }
    }

    if(in_array($restaurant_id, $restaurants_array)){

        ?>
        <div class="row">
            <div class="col col12">                       
                <h2 class="restaurant-title bdr-bottom">
                    <small class="restaurant-detail-title">meet</small>
                    <span class="restaurant-detail-subtitle bdr-bottom-gold">Chef</span>
                </h2>
            </div>
        </div><!--row-->
        <?php
    } ?>

    <div class="chef-section">
    <?php  while($chef_loop->have_posts()) { $chef_loop->the_post();

        $chef_image_id = get_post_meta( get_the_id(), "image", true);
        $chef_image = wp_get_attachment_url($chef_image_id);
        $chef_description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta( get_the_id(), "description", true)));
        $chef_name = get_post_meta( get_the_id(), "chefs_name", true);
        $chef_designation = get_post_meta( get_the_id(), "title_of_the_chef", true);
        $restaurant = get_post_meta( get_the_id(), "restaurant", true);
        
        if(in_array($restaurant_id, $restaurant)) {

            if($chef_description != '' && $chef_image != '' && trim($chef_name) != '' && trim($chef_designation) != '')
            {
    ?>
                <div class="chef-container clearfix">
                    <div class="chef-image-container">
                        <amp-img src="<?php echo $chef_image; ?>"
                            width="350"
                            height="450"
                            layout="responsive"
                            alt="<?php echo $chef_image;?>">
                        </amp-img>
                    </div>
                    <div class="chef-description-container">
                        <h3 class="item-title underline"><?php echo ucfirst($chef_name); ?><span><?php echo ucfirst($chef_designation); ?></span></h3>
                        <div class="chef-description-section">
                            <?php echo $chef_description; ?>
                        </div>
                    </div>
                </div>
    <?php
            }

        }
    } ?>
    </div>
<?php }
wp_reset_postdata();
?>                        
                <?php
                    if( $GLOBALS['detail_offers']->have_posts() ) : 

                        $section_title = "<small>Available</small> Offers";
                        $loop = $GLOBALS['detail_offers'];
                        $city_name = $GLOBALS['location'][0]->slug;
                        $width = 610;
                        $height = 324;
                        $offer_class = '';
                        $class = 'dining-content-body offer-sec';
                        include_once(get_template_directory() . '/amp/includes/amp-available-offers.php');

                    endif;
                ?>

            </div><!-- row -->
            </div><!-- row -->

        </div><!-- row -->  
    </div><!-- container --> 
</div><!-- content-section -->