<?php 

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);
 
$dining_object = array();
$dining_type_ids = array();
$dining_offers = array();

$image_array = array();
$banner_image_array = array();

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

    $images_videos = get_banner_by_taxonomy($banner_ids, 'restaurant_listing');

    if( $images_videos->have_posts() ) :
?>
          <div class="main-banner fluid-width banner-slider align-center">
              <div id="banner-slider" class="flexslider">
                  <ul class="slides">
<?php
                    while($images_videos->have_posts()) : $images_videos->the_post();
                        
                        if(isMobile())
                        {
                            $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }
                        else
                        {
                            $image_id = get_post_meta($post->ID, 'banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }     
                        $heading = get_post_meta($post->ID, 'banner_heading', true);
                        $description = get_post_meta($post->ID, 'banner_description', true);
                        $url = get_post_meta($post->ID, 'url', true);
                        //$button_text = get_post_meta($post->ID, 'button_text', true);

                        if($image != ''){
?>
                        <li class="banner-image">
                            <?php
                            if($url && trim($url) != ''){
                                ?>
                                <a href="<?php echo $url; ?>" class="block">
                                <?php
                            }
                            ?>
                            <img src="<?php echo $image;?>" />
                            <div class="banner-content align-center">
                            <?php
                            if($heading != '')
                            {
                            ?>
                                <h1 class="main-title text-shadow"><?php echo $heading; ?></h1>
                            <?php
                            }

                            if($description != '')
                            {
                            ?>
                                <p class="banner-intro-text text-shadow text-white"><?php echo $description; ?></p>
                            <?php
                            }
                            ?>     
                            </div>
                            <?php
                            if($url && trim($url) != ''){
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
              </div> <!-- slider -->
          </div>
<?php
    endif;
}

?>
    
   

<?php
    if($hotel_additional_information)
    {
        foreach($hotel_additional_information as $info_id)
        {
            $dining_title = get_post_meta($info_id, 'dining_title', true);
            $dining_description = wpautop(get_post_meta($info_id, 'dining_description', true));
        }

        if($dining_title && $dining_description)
        {
?>
            <div class="container section-space intro-text align-center js_fade">
                <div class="row">
                    <div class="seperator"></div>
<?php
                    if($dining_title)
                    {
?>
                        <h4 class="sec-title"><?php echo $dining_title; ?></h4>
<?php
                    }

                    if($dining_description)
                    {
?>
                        <div class="col col10 align-content-center "><?php echo $dining_description; ?></div>
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
        <div class="container  scroll-container scroll-to js_fade">
            <div class="row">
                <ul class="smooth-scroll unstyled-listing">
<?php
                foreach($heading_types as $heading_type)
                {
                    
?>
                        <li class="nav-item"><a href="#<?php echo $heading_type['term_id'];?>" class=""><?php echo $heading_type['name']; ?></a></li>
<?php
                }
?>
                </ul>
            </div>
        </div>
<?php
    }
?>
    
    

<?php
    foreach($types as $type)
    {
        $name = $type->name;
        $term_id = $type->term_id;
        $slug = $type->slug;
        $parent = $type->parent;

        if(in_array($term_id, $dining_type_ids) && $parent == 0)
        {
            if(isIPad()) {
                $cls1 = 'two-col-listing';
                $cls2 = 'col6';
            }
            else {
               $cls1 = 'three-col-listing';
               $cls2 = 'col4'; 
            }
?>       
            <div class="container item-listing js_fade drinks-sec dining-listing-section" id="<?php echo $term_id; ?>"> 
                <h2 class="page-title align-center" ><?php echo ucfirst($name); ?></h2>

                <div class="row <?php echo $cls1; ?>">
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

                               
?>
                                <div class="col <?php echo $cls2; ?> card-item js_fade">

<?php                           if(count($dining_images) > 0)
                                {
?> 
                                    <div id="slider" class="flexslider slider">
                                        <ul class="slides unstyled-listing">
<?php
                                        foreach($dining_images as $dining_image_id)
                                        {   
                                            $dining_image = wp_get_attachment_image_src($dining_image_id, 'box_image')[0];
                                            array_push($image_array, $dining_image);
?>
                                            <li class="photoMaskVer">
                                                <img src="" class="image" alt="<?php echo $dining_name; ?>" title="<?php echo $dining_name; ?>"/>
                                            </li>
<?php
                                        }
?>
                                        </ul>
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
                                    <div class="card-info h-product vcard">
                                        <input type="hidden" class="permalink" value="<?php echo $dining_permalink; ?>">
                                        <h3 class="card-info-title bdr-bottom">
                                            <span class="bdr-bottom-gold p-name"><?php echo $dining_name; ?></span>
                                        </h3>
                                        <p class="e-description"><?php echo $dining_summary; ?></p>

                                        <div class="row">
                                            <ul class="col col8 unstyled-listing meta-info meta-inline">
<?php 
                                            if($dining_cuisine && $dining_cuisine != '') 
                                            {
?>
                                                <li class="meta-item">
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
                                                <li class="meta-item">
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
                                                <li class="meta-item">
                                                    <span class="meta-label">TYPE</span>
                                                    <span class="meta-value u-identifier">
                                                        <?php if($types && $types != '') { echo $types; } else { echo '-'; } ?>
                                                    </span>
                                                </li>
<?php
                                            }
?>
                                            </ul><!-- unstyled-listing -->

                                            <div class="col col4 align-right discover-link">
                                                <a href="<?php echo $dining_permalink; ?>" class="text-link single-meta-item">Discover 
                                                    <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                                                </a>
                                            </div>
                                        </div><!-- row -->
                                    </div><!-- card-info --> 

                                </div><!-- col -->
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

        $GLOBALS['type'] = 'restaurants-and-bar';
        get_template_part( 'includes/available', 'offers-listing' );

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
            <div class="container section-space dinning-service js_fade">
                <h2 class="page-title align-center">Dining Services</h2>

                <div class="<?php echo $class; ?>">
                    <div class="flexslider" id="carousel">
                        <ul class="slides">
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
                                    array_push($image_array, $image);
?>
                                    <li>
                                        <div class="listing-block">
                                            <img src="" class="image" alt="<?php echo $name; ?>" title="<?php echo $name; ?>"/>
                                            <div class="card-info">
                                                <h3 class="card-info-title bdr-bottom">
                                                    <span class="bdr-bottom-gold"><?php echo $name; ?></span>
                                                </h3>
<?php
                                                if(strlen($description) > 120)
                                                {
                                                    $des = substr($description, 0,120);
?>
                                                    <p class="trunc"><?php echo $des; ?><span class="ext">...</span></p>
                                                    <p class="untrunc" style="display:none;"><?php echo $description; ?></p>
                                                    <a href="javascript:void(0)" class="text-link read_more">show More</a>                                 
                                                    <a href="javascript:void(0)" class="text-link read_less">show less</a>
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
                                    </li>
<?php
                                }
                            }
                        }
?>
                        </ul>
                    </div>
            </div>
        </div>
<?php

        }
    }
?>
</div><!-- content-section -->

<?php
    $GLOBALS['image_array'] = $image_array;
    $GLOBALS['banner_image_array'] = $banner_image_array;
?>