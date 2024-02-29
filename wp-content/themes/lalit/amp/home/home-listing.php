<?php

    $GLOBALS['at_the_lalit_images'] = array();
    $GLOBALS['lalit_loyalty_new_images'] = array();
    $GLOBALS['hotel_service_image'] = array();
    $GLOBALS['banner_images'] = array();
    ?>
    <div class="amp-global-contatiner">
        <?php
        $banners = get_page_overview_banners();
        if( $banners->have_posts() ) :

            $image_present_flag = $video_present_flag = false;
            while($banners->have_posts()) : $banners->the_post();
                if( get_post_meta($post->ID, 'mobile_banner_image', true) ) :

                    $image_present_flag = true;
                    if( get_post_meta($post->ID, 'banner_type', true) != 0 && trim(get_post_meta($post->ID, 'video_url', true)) != '' ) :

                        $video_present_flag = true;
                    endif;
                endif;
            endwhile;
        endif;

        if($image_present_flag){

            $height = 320;
            $width = 760;
            include_once(get_template_directory() . '/amp/includes/amp-leaderboard-banner.php');
        }
        //  In addition, we also hold the exclusive management rights to operate hotel in London offering 70 rooms.
        $title = "About The LaLiT";
        $description = "<p> We are one of the leading hospitality chains in India, engaged in the business of operating and managing hotels, palaces, and resorts, with a focus on the luxury segment. We operate 12 luxury hotels, palaces and resorts under The LaLiT brand and two mid-market segment hotels under The LaLiT Traveller brand across India's key business and leisure travel destinations, offering 2,261 rooms.
        </p>
        <p>Our luxury hotels operating across India under The Lalit brand our grouped into the following three categories:</p>
        <p><strong>City hotels:</strong> The LaLiT New Delhi, The LaLiT Mumbai, The LaLiT Ashok Bangalore, The LaLiT Great Eastern Kolkata, The LaLiT Jaipur and The LaLiT Chandigarh.</p>
        <p><strong>Palaces:</strong> The LaLiT Laxmi Vilas Palace Udaipur and The LaLiT Grand Palace Srinagar.</p>
        <p><strong>Resorts:</strong> The LaLiT Golf & Spa Resort Goa, The LaLiT Resort & Spa Bekal (Kerala), The LaLiT Mangar and The LaLiT Temple View Khajuraho. </p>
        <p>We also operate two hotels in the mid-market segment under The LaLiT Traveller brand, which are The LaLiT Traveller Jaipur and The LaLiT Traveller Khajuraho.</p>";

        include(get_template_directory() . '/amp/includes/amp-title-description.php');
        ?>
        <?php
            $home_awards = get_home_page_awards();
            if( $home_awards->have_posts() ) :
                /*while($home_awards->have_posts()) : $home_awards->the_post();

                    $award_name = get_post_meta($post->ID,"name",true);
                    $award_body = get_the_terms($post->ID, 'award-body');
                    $awarded_to = get_post_meta($post->ID,"awarded_to",true);
                    foreach($award_body as $award)
                    {
                        $term_id = $award->term_id;
                        $meta_data = get_term_meta($term_id);
                        foreach($meta_data as $data)
                        {
                            $award_logo = $data[0];
                            $award_logo_flag = true;
                            break;
                        }
                        if($award_logo_flag){
                            break;
                        }
                    }
                    if($award_logo_flag){
                        break;
                    }
                endwhile;

                if($award_logo_flag){*/
                    ?>
                    <div class="container view-port-detect" id="awards">
                        <div class="row  align-center">
                            <amp-carousel id="custom-button" class="amp-carousel"
                                width="760"
                                height="320"
                                layout="responsive"
                                type="slides"
                                autoplay
                                controls
                                delay="5000">
                                <?php

                                    while($home_awards->have_posts()) : $home_awards->the_post();
                                        $award_name = get_post_meta($post->ID,"name",true);
                                        $award_body = get_the_terms($post->ID, 'award-body');
                                        $awarded_to = get_post_meta($post->ID,"awarded_to",true);

                                        $award_logo = '';
                                        foreach($award_body as $award)
                                        {
                                            $term_id = $award->term_id;
                                            $meta_data = get_term_meta($term_id);
                                            foreach($meta_data as $data)
                                            {
                                                $award_logo = $data[0];
                                            }
                                        }

                                        $city_name = '';
                                        $destination = get_destination_by_award_id($post->ID);
                                        if( $destination->have_posts() ) :
                                        
                                            while($destination->have_posts()) : $destination->the_post();
                                            
                                                $location = get_the_terms($post->ID, 'locations');
                                                $city_name = $location[0]->name;

                                            endwhile;
                                        endif;
                                        ?>
                                        <amp-img src="<?php echo $award_logo; ?>"
                                            layout="responsive"
                                            width="760"
                                            height="320"
                                            alt="<?php echo $award_name; ?>"></amp-img>
                                        <?php /*if(trim($award_to) != '' &&  trim($city_name) != '' && trim($award_name) != ''){ ?>
                                            <div class="reward-meta">
                                                <strong class="truncate"><?php echo $awarded_to.'-'.$city_name; ?></strong>
                                                <span  class="truncate"><?php echo $award_name; ?></span>                                   
                                            </div><!-- reward-meta -->                          
                                        <?php }*/ ?>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                ?>
                            </amp-carousel>
                        </div>
                    </div>
                    <?php
                //}
            endif;
        ?>

        <div class="container fluid-width section-space clearfix">
            <div  id="parallax" class="main-banner align-center large-banner-sec branding-sec parallax-section" style="background: url('/wp-content/themes/lalit/images/corporate-template.jpg') no-repeat center; background-size: cover;" data-paroller-factor="0.085" data-paroller-factor-xs="0.085">
                <div class="row align-center">
                    <div class="banner-content">
                        <h1 class="main-title text-white text-shadow">Traditionally Modern, Subtly Luxurious, Distinctly LaLiT</h1>
                    </div><!-- banner-content -->
                </div><!-- row -->  
            </div><!-- parallax-window -->
        </div><!-- container -->
        <?php

    include_once(get_template_directory() . '/amp/includes/pick-a-destination.php');

    $with_lalit = get_with_lalit();
    if( $with_lalit->have_posts() ) :

        $data_array = array();
        $i = 0;
        while($with_lalit->have_posts()) : $with_lalit->the_post();

            $data_array[$i]['title'] = get_the_title($post->ID);
            $image_id = get_post_meta($post->ID, 'image', true);
            $data_array[$i]['image'] = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
            $i++;
        endwhile;

        if(count($data_array) > 0){
            
            $height = 421;
            $width = 561;
            $section_title = 'At The LaLiT';
            include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');

        }

    endif;
    wp_reset_postdata();
    unset($data_array);


    $home_dinings = get_home_page_dinings();

    if( $home_dinings->have_posts() ) :

        $title = "Gastronomy";
        $description = "Combining the finest of traditional Indian cooking with culinary concepts from all over the world, The Lalit offers a host of signature restaurants serving delectable cuisines. Our dining venues are designed to evoke the senses, from enticing flavours and aromas to the brilliance of design and décor. Coupled with an extensive beverage menu and our impeccable service, the restaurants promise an unparalleled dining experience.";
        ?>
        
        <?php include(get_template_directory() . '/amp/includes/amp-title-description.php'); ?>

        <div class="container gastronomy-sec section-space align-center">
            <div class="row">
                <div class="gastronomy-listing-sec">
                    <?php

                        $dining_count = 0;
                        while($home_dinings->have_posts()) : $home_dinings->the_post();

                            $image = '';
                            $name = get_post_meta($post->ID, 'name', true);
                            $image_ids = get_post_meta($post->ID, 'images', true);
                            $image_ids = explode(",", $image_ids);
                            $image = wp_get_attachment_image_src($image_ids[0], 'medium_large')[0];
                            
                            $permalink = get_permalink($post->ID);
                            $city_name = '';
                            $destination = get_destination_by_dining_id($post->ID);
                        
                            if( $destination->have_posts() ) :
                            
                                while($destination->have_posts()) : $destination->the_post();
                                
                                    $location = get_the_terms($post->ID, 'locations');
                                    $city_name = $location[0]->name;
                                endwhile;

                            endif;
                            wp_reset_postdata();

                            $style = '';
                            $class = '';
                            if($dining_count > 2) { $style = "display:none"; $class="more"; }

            
                        if($dining_count % 3 == 0 && $dining_count != 0)
                        {
                            
                            ?>
                            </div>     
                            <div class="gastronomy-listing-sec hide" [class]="gastronomySecVisible ? 'show' : 'hide'">
                            <?php
                        }
                        ?>
                        <div class="gastronomy-listing">
                            <a href="<?php echo $permalink; ?>?amp" class="gastronomy-block background-color u-url">
                                <div class="img-block" data-src="background: url('<?php echo $image; ?>') no-repeat center center;" data-url="<?php echo $image; ?>" style="background: url('<?php echo $image; ?>') no-repeat center center;"></div><!-- img-block -->
                            
                                <h3 class="item-title"><?php echo $name; ?>, <span><?php echo $city_name; ?></span></h3>  
                            </a>
                        </div>
                        <?php
                        $dining_count++;
                    
                    endwhile;
                    ?>
                </div>
                <?php
                if($home_dinings->post_count > 3)
                {
                    ?>
                    <a class="btn secondary-btn view_more_dining" [text]="gastronomySecVisible ? 'View Less' : 'View More'" role="button" on="tap:AMP.setState({gastronomySecVisible: !gastronomySecVisible})">View More</a>
                    <?php
                }
                ?>
        </div>
    </div>
    <?php

    endif;
    wp_reset_postdata();

    $home_service = get_home_page_services();

    if( $home_service->have_posts() ) :
        
        $data_array = array();
        $i = 0;
        while($home_service->have_posts()) : $home_service->the_post();

            $data_array[$i]['title'] = get_post_meta($post->ID, 'name', true);
            $images = get_post_meta($post->ID, 'image', true);
            $images = explode(',', $images);
            $image = wp_get_attachment_url($images[0]);
            $data_array[$i]['image'] = $image;
            $i++;
        endwhile;
        
        if(count($data_array) > 0){
            
            $height = 400;
            $width = 400;
            $section_title = 'Award Winning Services';
            include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');

        }
    endif;

    $home_experience = get_home_page_experiences();
    if( $home_experience->have_posts() ) :
        
        $data_array = array();
        $i = 0;
        while($home_experience->have_posts()) : $home_experience->the_post();

            $data_array[$i]['title'] = get_post_meta($post->ID,"category_title",true);
            $image_id = get_post_meta($post->ID,"banner_image",true);
            $data_array[$i]['image'] = wp_get_attachment_image_src($image_id, 'detail_page_image')[0];
            $exp = get_experience_by_category($post->ID);

            $destination = '';
            if( $exp->have_posts() ) :

                $experience_id = '';
                while($exp->have_posts()) : $exp->the_post();
                
                    $experience_id = $post->ID;

                endwhile;
                
                $destination = get_destination_by_experience_id($experience_id);
            endif;
            wp_reset_postdata();

            if( $destination->have_posts() ) :
            
                while($destination->have_posts()) : $destination->the_post();
                
                    $location = get_the_terms($post->ID, 'locations');
                    $city_name = $location[0]->slug;
                    $data_array[$i]['permalink'] = site_url().'/the-lalit-'.$city_name.'/experience-the-lalit';

                endwhile;

            endif;

            $i++;
        endwhile;
        
        if(count($data_array) > 0){

            $height = 500;
            $width = 820;
            $section_title = '';
            include(get_template_directory() . '/amp/includes/amp-carousel-heading.php');
        }
    endif;
    wp_reset_postdata();
    ?>

    <div class="container cta-section section-space" id="loyalty">
        <div class="row cta-listing">
            <div class="cta-listing-block">
                <div class="cta-list">
                    <amp-img src="/wp-content/themes/lalit/images/photo2.jpg"
                        layout="responsive"
                        height="386"
                        width="798"
                        alt="Loyalty Program">
                    </amp-img>                                      
                    <div class="cta-head">
                        <h2  class="item-title">Save & Earn with Loyalty</h2>
                        <a href="<?php echo site_url(); ?>/the-lalit-loyalty/" class="btn primary-btn">Learn more</a>
                    </div><!-- item-blk -->
                </div>
            </div><!-- col -->
        </div><!-- room-types -->
    </div><!-- container -->
</div><!-- content-section -->