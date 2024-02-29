<?php

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

if( $destination_obj->have_posts() ) : 

   	while($destination_obj->have_posts()) : $destination_obj->the_post();

   		$city_attractions_object = get_post_meta( $post->ID, "city_attractions", true);

   		$banner_images = get_post_meta($post->ID, "banner_images", true);

      $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
      $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
      $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
      $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
      $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

      $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
	   	
   	endwhile;

endif; 

$image_array = array();
?>


<div class="content-section">

<?php
$categories = array();
$city_attraction_ids = array();

if($banner_images)
{

  	$banner_ids = array();
    foreach($banner_images as $banner_image_id)
    {
        $banner_ids[] = $banner_image_id;
    }

    $images = get_banner_by_taxonomy($banner_ids, 'city_highlights_overview');

    if( $images->have_posts() ) :
?>
  			<div class="main-banner banner-slider align-center">
            <div id="banner-slider" class="flexslider">
                <ul class="slides">
                    <?php
                  		while($images->have_posts()) : $images->the_post();
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
                                <img src="<?php echo $image; ?>"/>
                                <div class="banner-content align-center">
                                    <?php
                                    if($heading && $heading != '')
                                    {
                                    ?>
                                        <h1 class="main-title text-shadow"><?php echo $heading; ?></h1>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($description && $description != '')
                                    {
                                    ?>
                                        <p class="banner-intro-text text-white text-shadow"><?php echo $description; ?></p>
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
            </div><!-- flexslider -->
        </div><!-- banner-slider -->
<?php
    endif;
}
?>



<?php
  if($hotel_additional_information)
  {
      foreach($hotel_additional_information as $info_id)
      {
          $highlights_title = get_post_meta($info_id, 'highlights_title', true);
          $highlights_description = wpautop(get_post_meta($info_id, 'highlights_description', true));
      }

      if($highlights_title && $highlights_description)
      {
?>
          <div class="container section-space intro-text align-center">
              <div class="row">
                <div class="seperator"></div>
                <?php
                if($highlights_title)
                {
                ?>
                    <h4 class="sec-title"><?php echo $highlights_title; ?></h4>
                <?php
                }
                ?>

                <?php
                if($highlights_description)
                {
                ?>
                    <p class="col col8 align-content-center "><?php echo $highlights_description; ?></p>
                <?php
                }
                ?>      
              </div> 
          </div>
<?php
      }
  }
?>

  
    <div class="container section-space city-attraction-sec">
        <div class="row">
            <div class="col col12">
            <?php
            if($city_attractions_object)
            {
                $temp1 = array();
                $categories1 = array();
                $b = 0;
                foreach($city_attractions_object as $a_id)
                {  
                    if(get_post_status ( $a_id ) == 'publish')
                    {
                        $category_ids = get_post_meta( $a_id, "city_attraction_category", true);
                        foreach($category_ids as $category_id)
                        {
                            if(!in_array($category_id, $temp1))
                            {
                                $category_name = get_post_meta( $category_id, "category_name", true);
                                //$categories1[$b]['id'] = $category_id;
                                $categories1[$category_id]['name'] = $category_name;
                                $b++;
                                array_push($temp1, $category_id);
                            }
                        }
                    }
                }
            }
            ?>

            <?php
            if($categories1 && count($categories1) > 1)
            {
                asort($categories1);
            ?>
                  <div class="container  scroll-container scroll-to">
                      <div class="row">
                          <ul class="smooth-scroll unstyled-listing">
                          <?php
                          foreach($categories1 as $key=>$cat)
                          {
                          ?>
                                <li class="nav-item"><a href="#<?php echo $key;?>" class=""><?php echo $cat['name']; ?></a></li>
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
            if($city_attractions_object)
            { 	
            	  if($categories1)
            	  {               
                    foreach($categories1 as $key=>$value)
              		  {             			
                			   $attractions = get_city_attractions_by_category($city_attraction_ids, $key);

                			   $category_name = $value['name'];
            ?>
                        <?php if($category_name != ''){ ?><h2 class="sec-title align-center section-space" id="<?php echo $key; ?>"><?php echo $category_name; ?></h2><?php } ?>
                          <div class="row tab-two-col">
                            <?php
                          			if( $attractions->have_posts() ) :
                          				while($attractions->have_posts()) : $attractions->the_post();

                          					$name = get_post_meta($post->ID, 'name', true);
                          					$description = wpautop(get_post_meta($post->ID, 'description', true));
                          					$image_id = get_post_meta($post->ID, 'image', true);
                          					$image = wp_get_attachment_url($image_id);

                                    array_push($image_array, $image);

                                    $permalink = get_permalink($post->ID);
                                    if($image != '' || $name != '' || $description != '')
                                    {
                            ?>
                                      <div class="col col4"> 
                                          <div class="item-blk">                                             
                                              <?php if($image != ''){ ?>
                                              <div class="photoMaskVer">
                                                <img src="" class="image" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" />
                                              </div>
                                              <?php } ?>                                   
                                              <?php if($name != '' ){ ?><div class="item-head item-head-small"><h4><?php echo $name; ?></h4></div><?php } ?>
                                              <?php if($name != '' || $description != ''){ ?>                              
                                              <div class="item-overlay">
                                                  <div class="overlay-inner">
                                                    <div class="text">
                                                      <h4 class="align-center"><?php echo $name;?></h4>
                                                        <div class=" mCustomScrollbar scroll-content">
                                                            <p><?php echo $description; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="line"></div>
                                                  </div>
                                              </div>
                                              <?php } ?>
                                          </div><!-- item-blk -->                                    
                                      </div><!-- col -->
                              <?php
                                    }
                          				endwhile;
                          			endif;
                            ?>
                          </div>
            <?php
              	    }
                }
            }
            ?>
            </div>
        </div>
    </div>

</div><!-- content-section -->

<?php
  $GLOBALS['image_array'] = $image_array;
?>