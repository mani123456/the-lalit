<?php

if (have_posts()) : 
    while (have_posts()) : the_post();
        $content = get_the_content();
    endwhile;
endif;

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);
 
$hotel_id = '';
if( $destination_obj->have_posts() ) : 
      while($destination_obj->have_posts()) : $destination_obj->the_post();
        $hotel_id = $post->ID;
        $offer_obj = get_offers_by_destination('hotel', $post->ID);
        $banner_images = get_post_meta($post->ID, "banner_images", true);

        $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
        $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
        $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
        $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
        //$GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);

        $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

        $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
        
      endwhile;
endif;

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

          $banners = get_banner_by_taxonomy($banner_ids, 'offers_listing');
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

       //$nav_array = array('','suites & rooms','restaurants & bar','spa','events');
       $nav_array_display = $nave_array = array();
    ?>

    <?php
        if($hotel_additional_information)
        {

            foreach($hotel_additional_information as $info_id)
            {
                $title = get_post_meta($info_id, 'offers_title', true);
                $description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($info_id, 'offers_description', true)));
            }

            if($title || $description)
            {
                include(get_template_directory() . '/amp/includes/amp-title-description.php');
            }

        }
    ?>

    <?php
    if($offer_obj->have_posts())
    {   
        ?>
        <amp-accordion animate id="offer-filter-accordion">
            <section class="section-space offer-tab">
                <h4 class="filter-item">Our Offers <i class="ico-sprite sprite ico-gre-down-arrow"></i></h4>
                <?php   
                    while($offer_obj->have_posts())
                    {
                        $offer_obj->the_post();
                        $nav_array = get_field_object('offer_type');
                        $nav_array = $nav_array['choices'];
                        $nav_array = array_map('strtolower', $nav_array);
                        $nav_array_display[] = get_post_meta($post->ID, 'offer_type', true);
                    }

                    $nav_array_display = array_unique($nav_array_display);//echo "<pre>";var_dump($nav_array_display);exit;

                    asort($nav_array_display);
                    ?>
                    <ul class="filter-nav">
                        <?php
                        foreach ($nav_array_display as $nav_menu_item_key) 
                        {
                        
                            $class_name = str_replace(' ', '-', $nav_array[$nav_menu_item_key]);
                            $class_name = str_replace('&', 'and', $class_name);

                            if(trim($class_name) != '' && $nav_array[$nav_menu_item_key] != '')
                            {
                                ?>
                                <li class="nav-item"><a on="tap:<?php echo $class_name; ?>.scrollTo(duration=600),AMP.setState({visited_<?php echo $nav_menu_item_key; ?>: !visited_<?php echo $nav_menu_item_key; ?>})" [class]="(visited_<?php echo $nav_menu_item_key; ?> && <?php echo $class_name; ?>) ? 'active filter-links' : 'filter-links'" class="<?php echo $class_name; ?>"><?php echo ucwords($nav_array[$nav_menu_item_key]); ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
            </section>
        </amp-accordion>
        <?php
    }
    if($offer_obj->have_posts())
    {
        ?>
        <div class="container">
            <div class="row">
            <?php
            $array_length = count($nav_array_display);
            $array_counter = 1;
            foreach ($nav_array_display as $nav_menu_item_key) 
            {
                $class_name_seperator = str_replace(' ', '-', $nav_array[$nav_menu_item_key+1]);
                $class_name_seperator = str_replace('&', 'and', $class_name_seperator);

                $class_name = str_replace(' ', '-', $nav_array[$nav_menu_item_key]);
                $class_name = str_replace('&', 'and', $class_name);
                ?>
                <div>
                    <?php
                        if($array_counter == 1){
                            ?>
                            <span class="offer-separator first" id="<?php echo $class_name; ?>"></span>
                            <?php 
                        }
                    ?>
                    <?php
                        if($nav_array[$nav_menu_item_key] != ''){
                        ?>
                            <h2 class="sec-title align-center"><?php echo ucwords($nav_array[$nav_menu_item_key]); ?></h2>
                        <?php
                        }
                        while($offer_obj->have_posts())
                        {
                            $offer_obj->the_post();

                            $offer_type_id = get_post_meta($post->ID, 'offer_type',true);

                            if($offer_type_id == $nav_menu_item_key){

                               
                                $offer_name = get_post_meta($post->ID, "name", true);
                                $offer_image_id = get_post_meta($post->ID, "image", true);
                                $offer_image = wp_get_attachment_url($offer_image_id);
                                $class_name = str_replace(' ', '-', $nav_array[$offer_type_id]);
                                $class_name = str_replace('&', 'and', $class_name);

                                $offer_permalink = get_permalink($post->ID);
                                $product_id = get_post_meta($post->ID,'products', true);
                                $offer_summary = get_post_meta($post->ID, "offer_summary", true);

                                if(strlen($offer_summary) > 115)
                                {
                                    $offer_summary = substr($offer_summary, 0, 115) . '...';
                                }
                                ?>
                                <div class="col col4 offer-listing-block h-product  <?php echo $class_name; ?><?php if($counter % 3 == 0){ echo ' first'; } ?>" data-category-type="<?php echo $class_name; ?>">
                                    <?php if($offer_image != ''){ ?>
                                        <a class="offer-listing-block-link" href="<?php echo ($product_id) ? get_the_permalink($product_id[0]) : $offer_permalink."/amp"; ?>">
                                            <amp-img src="<?php echo $offer_image; ?>"
                                                width="715"
                                                height="380"
                                                layout="responsive"
                                                alt="<?php echo $offer_name; ?>">
                                            </amp-img>
                                        </a>
                                    <?php } ?>
                                    <?php if($product_id){ ?><span class="buy-now-text">Buy Now!</span><?php } ?>
                                    <div class="card-info">
                                        <?php
                                            if($product_id){
                                                ?>
                                                <input type="hidden" class="permalink" value="<?php the_permalink($product_id[0]); ?>">
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <input type="hidden" class="permalink" value="<?php echo $offer_permalink; ?>/amp">
                                                <?php
                                            }
                                        ?>
                                        <h5 class="card-info-title bdr-bottom"><span class="bdr-bottom-gold p-name"><?php echo $offer_name; ?></span></h5>
                                        <p><?php echo $offer_summary; ?></p>
                                        <?php

                                            if($product_id){
                                                ?>
                                                <a href="<?php the_permalink($product_id[0]); ?>" class="text-link u-url">Buy Now <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <a href="<?php echo $offer_permalink; ?>/amp" class="text-link u-url">Know More <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                                                <?php
                                            }
                                        ?>
                                    </div><!-- card-info -->   
                                </div><!--col4-->
                                <?php
                            }
                        }
                    ?>
                    <?php if($array_length != $array_counter) {?><span class="offer-separator" id="<?php echo $class_name_seperator; ?>"></span><?php } ?>
                </div>
                <?php
                $array_counter++;
            }
            ?>
            </div>
        </div>
        <?php
    }
    ?>
</div><!-- content-section -->