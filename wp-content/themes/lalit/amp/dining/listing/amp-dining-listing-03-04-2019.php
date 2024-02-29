<?php 

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

if( $destination_obj->have_posts() ) : 

   	while($destination_obj->have_posts()) : $destination_obj->the_post();

        $dining_object = get_post_meta( $post->ID, "dinings", true);
        if($dining_object)
        {
             $c = 0;
            foreach($dining_object as $dining_id)
            {
                if(get_post_status ( $dining_id ) == 'publish')
                {
                    $dining_type_obj = get_the_terms($dining_id, 'dining-type');
                    if($dining_type_obj)
                    {
                        foreach($dining_type_obj as $dining_type)
                        {
                            $term_id = $dining_type->term_id;
                            $dining_type_ids[] = $term_id;
                        }
                    }
                    $c++;
                }
            }
        }

        $hotel_services = get_post_meta( $post->ID, "hotel_services", true);

        $banner_images = get_post_meta($post->ID, "banner_images", true);

        $dining_offers = get_offers_by_type(2, $post->ID, 2);
        $GLOBALS['listing_offers'] = $dining_offers;

        $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
        $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
        $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
        $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
        $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);


        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

   	endwhile;

endif;

$dining_type_ids = array_unique($dining_type_ids);

$types = get_terms([
          'taxonomy' => 'dining-type',
          'hide_empty' => false,
        ]);
sort($types);

?>

<div class="content-section room-dining-listing">
<?php
if($banner_images)
{
    $banner_ids = array();
    foreach($banner_images as $banner_image_id)
    {
        $banner_ids[] = $banner_image_id;
    }

    $banners = get_banner_by_taxonomy($banner_ids, 'restaurant_listing');
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
    
   

<?php
    if($hotel_additional_information)
    {
        foreach($hotel_additional_information as $info_id)
        {
            $title = get_post_meta($info_id, 'dining_title', true);
            $description = wpautop(get_post_meta($info_id, 'dining_description', true));
        }

        if($title && $description)
        {
            include(get_template_directory() . '/amp/includes/amp-title-description.php');
        }

    }
?>

<?php
$type_count = 0;
$heading_types = array();
if($dining_type_ids)
{
    foreach($dining_type_ids as $key=>$id)
    {
        $data = get_term($id);
        if($data->parent == 0)
        {
            $heading_types[$key]['term_id'] = $data->term_id;
            $heading_types[$key]['name'] = $data->name;
            $heading_types[$key]['slug'] = $data->slug;
            $type_count++;
        }
    }
}
?>
    
  
<?php
    if($heading_types && count($heading_types) > 1)
    {
        sort($heading_types);
?>
        <div class="container">
            <div class="row">
                <ul class="smooth-scroll align-center unstyled-listing">
<?php
    
                foreach($heading_types as $heading_type)
                {
                    
?>
                        <li><a on="tap:<?php echo $heading_type['slug'];?>.scrollTo(duration=600)"  class=""><?php echo $heading_type['name']; ?></a></li>
<?php
                }
?>
                </ul>
            </div>
        </div>
<?php
    }

    foreach($types as $type)
    {
        $name = $type->name;
        $term_id = $type->term_id;
        $slug = $type->slug;
        $parent = $type->parent;

        if(in_array($term_id, $dining_type_ids) && $parent == 0)
        {
?>       
            <div class="container item-listing" id="<?php echo $slug; ?>"> 
                <h2 class="sec-title align-center" ><?php echo ucfirst($name); ?></h2>
                <div class="row">
<?php
                if($dining_object)
                {        
                    $count = 1;
                    foreach($dining_object as $dining_id)
                    {
                        if(get_post_status ( $dining_id ) == 'publish')
                        {            
                            $dining_type_term_id = '';
                            $dining_type_obj = get_the_terms($dining_id, 'dining-type');
                            if($dining_type_obj)
                            {   
                                foreach($dining_type_obj as $dining_type)
                                {
                                    if($dining_type->parent == 0 && $dining_type->term_id == $term_id)
                                    {
                                            $dining_type_term_id = $dining_type->term_id;
                                    }
                                }
                            }

                            if($dining_type_term_id == $term_id)
                            {
                                $dining_name = get_post_meta($dining_id, "name", true);
                                $dining_images = get_post_meta($dining_id, "images", true);
                                $dining_images = explode(',', $dining_images);
                                
                                $types = '';
                                if($dining_type_obj)
                                {
                                    foreach($dining_type_obj as $type_id)
                                    {
                                        if($type_id->parent != 0)
                                        {
                                            $types .= $type_id->name.', ';
                                        }
                                    }
                                }

                                $types = rtrim($types, ', ');

                                $permalink = get_permalink($dining_id);
?>
                                <a href="<?php echo $permalink.'amp'; ?>">
                                <div class="card-item stay-room">
                                
<?php                           if(count($dining_images) > 0)
                                {
?> 
                                    <div id="slider" class="flexslider slider">
                                        <amp-carousel id="custom-button"
                                            width="400"
                                            height="300"
                                            layout="responsive"
                                            type="slides"
                                            autoplay
                                            controls>
                                            <?php
                                            foreach($dining_images as $dining_image_id)
                                            {   
                                                $dining_image = wp_get_attachment_image_src($dining_image_id, 'box_image')[0];
                                                ?>
                                                <amp-img src="<?php echo $dining_image; ?>"
                                                    width="400"
                                                    height="300"
                                                    layout="responsive"
                                                    alt="<?php echo $dining_name; ?>">
                                                </amp-img>
                                                <?php
                                            }
                                            ?>
                                        </amp-carousel>
                                    </div><!-- slider -->             
<?php
                                }
?>                    

<?php
                                    $dining_name = get_post_meta($dining_id, "name", true);
                                    $dining_description = get_post_meta($dining_id, "description", true);
                                    $dining_summary = get_post_meta($dining_id, "dining_summary", true);
                                    $dining_cuisine =  get_post_meta($dining_id, "cuisine", true);
                                    $dining_contact = get_post_meta($dining_id, "contact", true);
                                    $dining_ratings = get_post_meta($dining_id, "ratings", true);
                                    $dining_permalink = get_permalink($dining_id);
?>
                                    <div class="card-info h-product">
                                        <input type="hidden" class="permalink" value="<?php echo $dining_permalink; ?>">
                                        <h3 class="card-info-title bdr-bottom">
                                            <span class="bdr-bottom-gold p-name"><?php echo $dining_name; ?></span>
                                        </h3>
                                        <p class="e-description"><?php echo $dining_summary; ?></p>

                                        <div class="row">
                                            <ul class="unstyled-listing meta-info meta-inline">
<?php 
                                            if($dining_cuisine && $dining_cuisine != '') 
                                            {
?>
                                                <li class="meta-item clearfix">
                                                    <span class="meta-label">CUISINE</span>
                                                    <span class="meta-value p-category">
                                                        <?php if($dining_cuisine && $dining_cuisine != '') { echo $dining_cuisine; } else { echo '-'; } ?>  
                                                    </span>
                                                </li>
<?php
                                            }

                                            if($dining_contact && $dining_contact != '') 
                                            {
?>
                                                <li class="meta-item clearfix">
                                                    <span class="meta-label">ENQUIRY</span>
                                                    <span class="meta-value p-tel">
                                                        <?php if($dining_contact && $dining_contact != '') { echo $dining_contact; } else { echo '-'; } ?>
                                                    </span>
                                                </li>
<?php
                                            }

                                            if($types && $types != '')
                                            {
?>
                                                <li class="meta-item clearfix">
                                                    <span class="meta-label">TYPE</span>
                                                    <span class="meta-value">
                                                        <?php if($types && $types != '') { echo $types; } else { echo '-'; } ?>
                                                    </span>
                                                </li>
<?php
                                            }
?>
                                            </ul><!-- unstyled-listing -->

                                            <div class="align-right discover-link">
                                                <span class="text-link single-meta-item">Discover 
                                                    <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                                </span>
                                            </div>
                                        </div><!-- row -->
                                    </div><!-- card-info -->  
                                </div><!-- col -->
                                </a>
                                
<?php
                                $count++;
                            }
                        }
                    }
                }
?>

                </div><!-- row -->
            </div><!-- item-listing -->

<?php
        }
    }
?>

<?php 
    if( $dining_offers->have_posts() ) : 

        $section_title = "Offers";
        $loop = $dining_offers;
        $city_name = $GLOBALS['location'][0]->slug;
        $width = 715;
        $height = 380;
        $class = '';
        include_once(get_template_directory() . '/amp/includes/amp-available-offers.php');


    endif;
?>


<?php
    if($hotel_services)
    {
        $total_c = 0;
        foreach($hotel_services as $service_id)
        {
            if(get_post_status ( $service_id ) == 'publish')
            {
                if(get_post_meta($service_id, 'service_type', true) == 1)
                {
                    $total_c++;
                }
            }
        }

        if($total_c > 0)
        {

            if($total_c == 1)
            {
                $class="row one-item";
            }
            else if($total_c == 2)
            {
                $class="row two-item";
            }
            else
            {
                $class="row";
            }
            
            
            ?>
            <div class="container align-center view-port-detect dining-service-container">
                <h2 class="sec-title align-center">
                    Dining Services
                </h2>
                <div class="row">
                    <div class="main-banner">
                        <div class="flexslider">
                            <amp-carousel class="amp-carousel"
                                    layout="responsive"
                                    height="400"
                                    width="400"
                                    controls
                                    type="slides">
                                <?php
                                    foreach($hotel_services as $service_id)
                                    {
                                        if(get_post_status ( $service_id ) == 'publish')
                                        {
                                            if(get_post_meta($service_id, 'service_type', true) == 1)
                                            {
                                                $name = get_post_meta($service_id, 'name', true);
                                                $images = get_post_meta($service_id, 'image', true);
                                                $image_id = explode(",", $images);
                                                $image = wp_get_attachment_url($image_id[0]);

                                                if($name || $image){
                                                    ?>
                                                    <div class="slide">
                                                        <amp-img src="<?php echo $image; ?>"
                                                        layout="fill"
                                                        alt="<?php echo $name; ?>"></amp-img>
                                                        <?php if(trim($name) != ''){ ?>
                                                            <div class="glance-caption">
                                                                <span class="glance-header"><?php echo $name; ?></span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </amp-carousel>
                        </div><!-- slider -->
                    </div><!-- slider-banner -->
                </div>
            </div>
            <?php
            
            /*<div class="<?php echo $class; ?>">
                    <div class="flexslider" id="carousel">
                    <amp-carousel id="custom-button"
                        width="400"
                        height="400"
                        layout="responsive"
                        type="slides"
                        autoplay
                        controls
                        delay="5000">
<?php
                        foreach($hotel_services as $service_id)
                        {
                            if(get_post_status ( $service_id ) == 'publish')
                            {
                                if(get_post_meta($service_id, 'service_type', true) == 1)
                                {

                                    $name = get_post_meta($service_id, 'name', true);
                                    $description = get_post_meta($service_id, 'description', true);
                                    $images = get_post_meta($service_id, 'image', true);
                                    $image_id = explode(",", $images);
                                    $image = wp_get_attachment_url($image_id[0]);
?>
                                    <div class="listing-block">
                                        <amp-img src="<?php echo $image; ?>"
                                            width="400"
                                            height="400"
                                            layout="responsive"
                                            alt="<?php echo ($heading != '') ? $heading : 'Eat and Drink at The LaLiT '.ucfirst($GLOBALS['location'][0]->slug); ?>">
                                        </amp-img>
                                        <div class="card-info">
                                            <h3 class="card-info-title bdr-bottom">
                                                <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                                            </h3>
<?php
                                            if(strlen($description) > 120)
                                            {
                                                $des = substr($description, 0,120);
?>
                                                <p [class]="textVisible ? 'hide' : 'trunc'" class="trunc"><?php echo $des; ?><span class="ext">...</span></p>
                                                <p [class]="textVisible ? '' : 'hide'" class="hide"><?php echo $description; ?></p>
                                                <a class="text-link read_more" [text]="textVisible ? 'Show Less' : 'Show More'" on="tap:AMP.setState({textVisible: !textVisible})">Show More</a>
<?php
                                            }
                                            else
                                            {
?> 
                                                <p><?php echo $description; ?></p>
<?php
                                            }
?>                                           
                                        </div><!-- card-info -->    
                                    </div>
<?php
                                }
                            }
                        }
?>
                    </amp-carousel>
                    </div>
            </div>*/?>

        </div>
<?php

        }
    }
?>
</div><!-- content-section -->