
<div class="content-section">
<?php

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

if( $destination_obj->have_posts() ) : 
        while($destination_obj->have_posts()) : $destination_obj->the_post();

            $hotel_experiences = get_post_meta( $post->ID, "hotel_experiences", true);

            $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
            $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
            $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
            $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
            $GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);

        endwhile;
endif;

?>

    
   <div class="experience-blk">
<?php
    if($hotel_experiences)
    {
        foreach($hotel_experiences as $experience_id)
        {
            if(get_post_status ( $experience_id ) == 'publish')
            {
                $experience_category_ids[] = get_post_meta($experience_id, "experience_category", true);
            }
        }

        $experience_category_ids = array_unique($experience_category_ids);

        foreach ($experience_category_ids as $experience_category_id)
        {
            $experience_category_title = get_post_meta($experience_category_id,"category_title",true);
            $experience_category_description = wpautop(get_post_meta($experience_category_id, "description", true));
            $experience_category_banner_image_id = get_post_meta($experience_category_id, "banner_image", true);
            $experience_category_banner_image = wp_get_attachment_image_src($experience_category_banner_image_id, 'detail_page_image')[0];

            $experience_category_types = get_the_terms($experience_category_id, 'experience-category-type');
            $category_type = $experience_category_types[0]->name;
            if(strlen($experience_category_title) > 60)
            {
                $experience_category_title = substr($experience_category_title, 0,60).'...';
            }

?>
             
                    <div class="section-space"> 
                        <div class="col-img">
                            <img src="<?php echo $experience_category_banner_image; ?>" alt="<?php echo $experience_category_title; ?>" title="<?php echo $experience_category_title; ?>"> 
                            <h2 class="page-title"><small><?php echo $category_type; ?></small> 
                                <?php echo $experience_category_title; ?>
                            </h2>
                        </div>
                    <?php
                            $type_array = explode(" ", $category_type);
                    ?>
                    
                        <div class="exp-description">
                            <p><?php echo $experience_category_description; ?></p>
                            <span class="sm-head"> Explore our <?php echo ucfirst($type_array[2]); ?> Packages:</span>       

                        </div>
                           <ul class="unstyled-listing list-with-arrow">
                        <?php
                            foreach($hotel_experiences as $experience_id)
                            {
                                if(get_post_status ( $experience_id ) == 'publish')
                                {
                                    $exp_cat_id = get_post_meta($experience_id, 'experience_category', true);

                                    if($exp_cat_id == $experience_category_id)
                                    {
                                        $experience_name = get_post_meta($experience_id,'name',true);
                                        $experience_link = get_permalink($experience_id);
                                        $start_time = get_post_meta($experience_id, 'start_time', true);
                                        $duration = get_post_meta($experience_id, 'duration', true);
                                        $stops = get_post_meta($experience_id, 'number_of_stops', true);
                                        $price_single = get_post_meta($experience_id, 'single_price', true);
                                        $price_couple = get_post_meta($experience_id, 'couple_price', true);
                                        $inclusions = get_post_meta($experience_id, 'slider_images', true);
                                        $good_to_know = get_post_meta($experience_id, 'good_to_know', true);
                        ?>
                                        <li>
                                            <a href="<?php echo $experience_link; ?>"><?php echo $experience_name; ?>  <i class="ico-sprite sprite size-32 ico-gre-right-arrow"></i></a>
                                        </li>
                                
                        <?php
                                    }
                                }
                            }
                        ?>

                            </ul>
                    </div>
               
<?php
        }
?>

<?php
    }
?>
 </div>
</div>
