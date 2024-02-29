<?php

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

$city_name = $GLOBALS['location'][0]->slug;

$hotel_id = '';
$hotel_name = '';

if( $destination_obj->have_posts() ) : 

    while($destination_obj->have_posts()) : $destination_obj->the_post();

        $hotel_id = $post->ID;

        $hotel_latitude = get_post_meta( $post->ID, "latitude", true); 
        $hotel_longitude = get_post_meta( $post->ID, "longitude", true); 
        $hotel_title = get_the_title($post->ID);
        $hotel_name = get_post_meta( $post->ID, "name", true); 
        $hotel_address = get_post_meta( $post->ID, "address", true); 
        $hotel_address = preg_replace( '/(^|[^\n\r])[\r\n](?![\n\r])/', '$1 ', $hotel_address );
        $hotel_image_id = get_post_meta( $post->ID, "property_image", true);
        $hotel_image = wp_get_attachment_image_src($hotel_image_id, 'thumbnail')[0];
        $hotel_short_description = the_lalit_remove_image_tags_amp(addslashes(get_post_meta( $post->ID, "short_description", true))); 
        $hotel_short_description = str_replace('\'', '\\\'\\', $hotel_short_description);
        $city_attractions_object = get_post_meta( $post->ID, "city_attractions", true);

        $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
        $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
        $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);

        if(strpos($GLOBALS['phone'], '/') !== false){

          $phone_array = explode('/', $GLOBALS['phone']);
        }
        else if(strpos($GLOBALS['phone'], '|') !== false){

          $phone_array = explode('|', $GLOBALS['phone']);
        }

        $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
        //$GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);

        $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true); 

        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
    
    endwhile;

endif;

$hotel_title = get_the_title($hotel_id);
$hotel_name = get_post_meta($hotel_id, "name", true);
$banner_images = get_post_meta($hotel_id, "banner_images", true);
?>

<div class="content-section">
<?php

if($banner_images)
{
 
  $banner_ids = array();
  foreach($banner_images as $banner_image_id)
  {
      $banner_ids[] = $banner_image_id;
  }

  $banners = get_banner_by_taxonomy($banner_ids, 'location');
  
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
      $location_title = get_post_meta($info_id, 'location_title', true);
      $location_description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($info_id, 'location_description', true)));
  }
}
?>

          <div class="container section-space location-template-section">
              <div class="row">
                  <div class="location-content">
                       
                        <h2 class="location-hotel-name bdr-bottom">
                            <small><?php echo $hotel_name; ?></small>
                          <?php
                          if($location_title)
                          {
                          ?>
                            <span class="bdr-bottom-gold"><?php echo $location_title; ?></span>
                          <?php
                          }
                          ?>
                        </h2>
                      
                  </div>                   
                  <div class="location-address-section">                                                         
                        <div class="contact-info">                            
                            <ul class="unstyled-listing">
                            <?php
                             if($GLOBALS['address'] != '')
                             {
                            ?>
                                <li class="contact-details">
                                     <i class="ico-sprite sprite size-24 ico-navigation"></i>
                                      <p class="address-section"><?php echo $GLOBALS['address']; ?></p>
                                </li> 
                            <?php
                              }
                            ?>

                            <?php
                            if($GLOBALS['email'] != '')
                            {
                            ?>                               
                                <li class="contact-details">
                                      <i class="ico-sprite sprite size-24 ico-email"></i>
                                      <p><a class="u-email" href="mailto: <?php echo $GLOBALS['email']; ?>"><?php echo $GLOBALS['email']; ?></a></p> 
                                </li>
                            <?php
                            }
                            ?>

                            <?php
                            if($GLOBALS['phone'] != '')
                            {
                            ?>                                
                                <li class="contact-details">
                                        <i class="ico-sprite sprite size-24 ico-phone"></i>
                                        <p> Phone : 
                                        <?php if(isset($phone_array) && !empty($phone_array)){

                                          for($i=0;$i<count($phone_array);$i++){
                                            ?>
                                            <a href="tel:<?php echo trim($phone_array[$i]); ?>"><?php echo trim($phone_array[$i]); ?></a>
                                            <?php

                                            if($i != count($phone_array) - 1){
                                              echo " / ";
                                            }
                                          }

                                        } else { ?>
                                          <a href="tel:<?php echo $GLOBALS['phone']; ?>"><?php echo $GLOBALS['phone']; ?></a>
                                       <?php } ?>
                                </li>
                            <?php
                            }
                            ?>

                            <?php
                            if($GLOBALS['fax'] != '')
                            {
                            ?> 
                                <li class="contact-details">
                                       <i class="ico-sprite sprite size-24 ico-print"></i>                                         
                                        <p> Fax: <span><?php echo $GLOBALS['fax']; ?></span></p>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                        </div>
                  </div><!-- col -->
              </div><!-- row -->
          </div><!-- container --> 



<?php

$attraction_array = array();
if($city_attractions_object)
{
    $c = 0;
    foreach($city_attractions_object as $city_attractions_id)
    {
        if(get_post_status ( $city_attractions_id ) == 'publish')
        {
            $name = get_post_meta($city_attractions_id, 'name', true);
            $description = the_lalit_remove_image_tags_amp(get_post_meta($city_attractions_id, 'description', true));
            /*if(strlen($description) > 500)
            {
              $description = substr($description, 0,500).'...';
            }*/
            $image_id = get_post_meta($city_attractions_id, 'image', true);
            $image = wp_get_attachment_image_src($image_id);
            $image = $image[0];
            $distance = get_post_meta($city_attractions_id, 'distance_from_hotel', true);
            $latitude = get_post_meta($city_attractions_id, 'latitude', true);
            $longitude = get_post_meta($city_attractions_id, 'longitude', true);
            $category_ids = get_post_meta( $city_attractions_id, "city_attraction_category", true);
            $category_id = $category_ids[0];
            $map_icon_id = get_post_meta( $category_id, "map_icon", true);
            $map_icon = wp_get_attachment_url($map_icon_id);

            $attraction_array[$c]['name'] = $name;
            $attraction_array[$c]['description'] = addslashes($description);
            //$attraction_array[$c]['description'] = str_replace('\'', '\\\'\\', $attraction_array[$c]['description']);
            $attraction_array[$c]['image'] = $image;
            $attraction_array[$c]['distance'] = $distance;
            $attraction_array[$c]['latitude'] = $latitude;
            $attraction_array[$c]['longitude'] = $longitude;
            $attraction_array[$c]['map_icon'] = $map_icon;

            $c++;
        }
    }
}

$link = '/the-lalit-'.$city_name.'/location';
$width = 600;
$height = 550;
$image_path = get_template_directory_uri() . '/amp/images/' . ucfirst($city_name).'.jpg';


include_once(get_template_directory() . '/amp/includes/amp-map.php');

if($hotel_additional_information)
{
  foreach($hotel_additional_information as $info_id)
  {
      $title = get_post_meta($info_id, 'highlights_title', true);
      $description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($info_id, 'highlights_description', true)));
      $link = '/the-lalit-'.$city_name.'/city-attractions/';
      $link_text = "Discover";
  }
  ?>
  <div class="city-highlights">
    <?php
    if($title || $description)
    {
        include(get_template_directory() . '/amp/includes/amp-title-description.php');
    }
    ?>
  </div>
  <?php
}
?>
</div>