<?php

    /*$press_release_object = get_press_rooms('press-release');

    if($press_release_object->have_posts()):

        while($press_release_object->have_posts()):

            $press_release_object->the_post();
            $press_release_title = get_post_meta($post->ID,'media_coverage_title',true);
            $body_copy_press_release = get_post_meta($post->ID,'body_copy_press_release',true);
            //$thumbnail = get_post_meta($post->ID,'thumbnail_media_coverage',true);
            //$article_copy = get_post_meta($post->ID,'article_copy',true);
            //$publisher_logo = get_post_meta($post->ID,'publisher_logo',true);
            //$publisher_url = get_post_meta($post->ID,'publisher_url',true);
            $location = get_the_terms($post->ID, 'locations');
            $year = get_the_terms($post->ID, 'press-room-year');

            $destination_object = get_destination_by_taxanomy('locations',$location[0]->term_id);

            if($destination_object->have_posts()):

                while($destination_object->have_posts()):

                    $destination_object->the_post();
                    $hotel_name = get_post_meta($post->ID,'name',true);

                endwhile;

            endif;

            wp_reset_postdata();

        endwhile;

    endif;

    wp_reset_postdata();*/
?>
<div class="content-section lalit-insight-container">

      <!-- slider -->
     <div class="align-center js_fade">
        <img src="/wp-content/themes/lalit/images/lalit-insight.jpg" />
        <div class="container parent-container">
          <div class="row">
              <div class="banner-content">
                <h1 class="main-title text-shadow"><?php the_title(); ?></h1>
              </div><!-- banner-content -->
          </div><!-- row -->
      </div><!-- container -->
    </div>
    
    
    <!-- filter-->
    <div class="container fluid-width small-wrap" > 
        <div class="row filter-outer">          
            <div class="col col8 align-content-center">   
                <ul class="unstyled-listing filter-box filter-tab align-center">
                    <li class="filter-item"><strong>Filter By:</strong></li>
                    <li class="filter-item">
                        <a class="city">Destinations <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                        <div class="sub-menu">
                            <div class="row" style="display: block;">
                                <div class="col col12">
                                    <ul class="unstyled-listing drop-down-menu">
                                        <?php

                                            $args = array(
                                                'post_type'=>'the-lalit-insight',
                                                'post_status'=>'publish',
                                                'posts_per_page'=>'-1',
                                                'order'=>'ASC',
                                            );

                                            $loop = new WP_Query($args);

                                            $i=0;$city_names = $city_slugs = array();

                                            if($loop->have_posts())
                                            {
                                                while($loop->have_posts())
                                                {
                                                    $loop->the_post();
                                                    $locations = get_the_terms($post->ID,'location-filter');

                                                    if(!empty($locations))
                                                    {
                                                        foreach($locations as $location)
                                                        {
                                                            if(trim($location->slug) != '')
                                                            {
                                                                if(!in_array($location->slug, $city_slugs) && !in_array($location->name, $city_names))
                                                                {
                                                                    $city_names[$i] = $location->name;
                                                                    $city_slugs[$i] = $location->slug;
                                                                    $i++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            wp_reset_postdata();

                                            sort($city_names);sort($city_slugs);

                                            if(!empty($city_names) && !empty($city_slugs))
                                            {
                                                ?>
                                                <li class="list-item nav-item" data-location-name="all-destinations"><a href="javascript:void(0);" class="city-filter">All Destinations</a></li>
                                                <?php
                                                
                                                for($j=0;$j<$i;$j++)
                                                {
                                                    ?>
                                                    <li class="list-item nav-item" data-location-name='<?php echo $city_slugs[$j]; ?>'><a href="javascript:void(0);" class="city-filter"><?php echo $city_names[$j]; ?></a></li>
                                                    <?php
                                                }
                                            }
                                            
                                        ?>
                                    </ul><!-- unstyled-listing -->
                                </div><!-- col -->    
                            </div><!-- row -->  
                        </div><!-- sub-menu -->
                    </li>
                    <li class="filter-item"><a class="year">Year <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                        <div class="sub-menu">
                            <div class="row" style="display: block;">
                                <div class="col col12">
                                    <ul class="unstyled-listing drop-down-menu">
                                        <?php

                                            $years = get_terms(array('taxonomy'=>'press-room-year','hide_empty'=>false,'orderby'=>'name','order'=>'DESC'));

                                            if(!empty($years))
                                            {
                                                ?>
                                                <li class="list-item nav-item" data-year-name="all-years"><a href="javascript:void(0);" class="year-filter">All Years</a></li>
                                                <?php
                                                foreach($years as $year)
                                                {
                                                    if(trim($year->slug) != '')
                                                    {
                                                        ?>
                                                        <li class="list-item nav-item" data-year-name="<?php echo $year->slug;?>"><a href="javascript:void(0);" class="year-filter"><?php echo $year->name; ?></a></li>
                                                        <?
                                                    }
                                                }
                                            }
                                        ?>
                                    </ul><!-- unstyled-listing -->
                                </div><!-- col -->    
                            </div><!-- row -->  
                        </div><!-- sub-menu -->
                    </li>
                </ul><!-- filter-tab --> 
            </div>
        </div>
    </div>
    <div class="container align-center no-record-found" style="display:none;">
        <div class="row  no-record">
            <h1 class="main-title text-black">Sorry! No Insights Available</h1>
            <div class="row ">
                <div class="col8 align-content-center">
                    <p class="disp-text">We are sorry that we have nothing to display here. Please try a different filter to access other insights.</p>
            
                </div><!-- col6 --> 
            </div><!-- row -->
            <div class="motif-img">
                <img src="/wp-content/themes/lalit/images/404-motif.png" alt="">
            </div><!-- motif-img -->
        </div><!-- row -->                        
    </div><!-- container -->   
    <?php

        $lalit_insight_object = get_press_rooms('the-lalit-insight','insight_published_date');

        if($lalit_insight_object->have_posts()):

            ?>
            <!-- listing-->
            <div class="container fluid-width small-wrap main-container" style="min-height:300px;">
                <div class="row">
                    <ul class="col col8 listing-sec unstyled-listing align-content-center">
                        <?php

                            while($lalit_insight_object->have_posts()):

                                $lalit_insight_object->the_post();
                                $lalit_insight_title = get_post_meta($post->ID,'insight_title',true);
                                //$body_copy_press_release = get_post_meta($post->ID,'body_copy_press_release',true);
                                //$publisher_name = get_post_meta($post->ID,'publisher_name',true);
                                
                                $published_date = get_post_meta($post->ID,'insight_published_date',true);
                                

                                if($published_date != '')
                                {
                                    $published_date = date('j M Y',strtotime($published_date));
                                }
                                else
                                {
                                    $published_date = '';
                                }
                                
                                $location = get_the_terms($post->ID, 'location-filter');
                                $year = get_the_terms($post->ID, 'press-room-year');
                                $short_description = get_the_excerpt($post->ID);

                                if($published_date != '' && trim($lalit_insight_title) != '' && trim($short_description) != '' && !empty($location) && !empty($year))
                                {
                                    ?>
                                    <li class="<?php echo ' all-years all-destinations '.$location[0]->slug.' '.$year[0]->slug; ?>"> 
                                        <div class="row">
                                            <div class="col col9 release-list"> 
                                                <?php if($published_date != '') { ?><span><?php echo $published_date; ?></span><?php } ?>
                                                <?php if(trim($lalit_insight_title) != '') { ?><h3><a href="<?php the_permalink(); ?>" class=""><?php echo $lalit_insight_title; ?></a></h3><?php } ?>
                                                <?php if(trim($short_description) != '') {?><p><?php echo $short_description; ?></p><?php } ?>
                                                <a href="<?php the_permalink(); ?>" class="text-link">Read More <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                }
                            endwhile
                        ?>
                    </ul>
                </div>
            </div>
            <?php

        endif;

        wp_reset_postdata();
    ?>
</div><!-- content- section-->
