<div class="content-section small-banner media-coverage">
    <!-- slider -->     
    <div class="container align-center small-banner-sec js_fade" style="background-image:url('/wp-content/themes/lalit/images/media-coverage.jpg')">
      <div class="row">
          <div class="banner-content">
            <h1 class="main-title text-shadow"><?php the_title(); ?></h1>
          </div><!-- banner-content -->
      </div><!-- row -->
  </div><!-- container -->
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
                                                'post_type'=>'media-coverage',
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
                                                    if($city_slugs[$j] != "london")
                                                    {
                                                    ?>
                                                    <li class="list-item nav-item" data-location-name='<?php echo $city_slugs[$j]; ?>'><a href="javascript:void(0);" class="city-filter"><?php echo $city_names[$j]; ?></a></li>
                                                    <?php
                                                    }
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
                                                        <?php
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
            <h1 class="main-title text-black">Sorry! No Media Coverage Available</h1>
            <div class="row ">
                <div class="col8 align-content-center">
                    <p class="disp-text">We are sorry that we have nothing to display here. Please try a different filter to access other coverage.</p>
            
                </div><!-- col6 --> 
            </div><!-- row -->
            <div class="motif-img">
                <img src="/wp-content/themes/lalit/images/404-motif.png" alt="">
            </div><!-- motif-img -->
        </div><!-- row -->                        
    </div><!-- container --> 
    <div class="container fluid-width main-container" style="min-height:300px;">
        <?php

            $media_coverage_object = get_press_rooms('media-coverage','published_date_media_coverage');

            if($media_coverage_object->have_posts()):
                ?>
                <!-- listing-->    
                <div class="row">
                    <ul class="col col8 align-content-center listing-sec unstyled-listing tablecell">
                        <?php

                            $GLOBALS['publisher_logo'] = array();
                            while($media_coverage_object->have_posts()):
                                $media_coverage_object->the_post();
                                $media_coverage_title = get_post_meta($post->ID,'media_coverage_title',true);
                                //$body_copy = get_post_meta($post->ID,'body_copy',true);
                                $publisher_logo = get_field('publisher_logo');
                                //$article_copy = get_post_meta($post->ID,'article_copy',true);
                                //$publisher_url = get_post_meta($post->ID,'publisher_url',true);
                                $published_date = get_post_meta($post->ID,'published_date_media_coverage',true);
                                $publisher_name = get_post_meta($post->ID,'publisher_name',true);

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
                            
                                if(trim($media_coverage_title) != '' && $published_date != '' && trim($publisher_name) != '' && trim($short_description) != '' && $publisher_logo != '' && !empty($location) && !empty($year))
                                {
                                    array_push($GLOBALS['publisher_logo'], $publisher_logo);
                                    ?>
                                    <li class="<?php echo ' all-years all-destinations '.$location[0]->slug.' '.$year[0]->slug; ?>" style="display:none;">
                                        <div class="row table-sec"> 
                                            <div class="col col4 tablecell align-center table-container">
                                                <img src="" class="media-logo">
                                            </div>     
                                            <div class="col col8">
                                                <?php if(trim($publisher_name) != '' && $published_date != '' && trim($publisher_name) != '') { ?><span><?php echo $published_date; ?>, <?php echo $publisher_name; ?></span><?php } ?>
                                                <?php if(trim($media_coverage_title) != '') { ?><h3><a href="<?php the_permalink(); ?>" class=""><?php echo $media_coverage_title; ?></a></h3><?php } ?>
                                                <?php if(trim($short_description) != '') {?><p><?php echo $short_description; ?></p><?php } ?>
                                                <a href="<?php the_permalink(); ?>" class="text-link">Read More <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            endwhile;
                        ?>       
                    </ul>
                </div><!-- row -->
                <?php
            endif;

            wp_reset_postdata();
        ?>
    </div>  
    <div class="container fluid-width media-contact">
        <div class="row">
            <div class="col col2 align-content-center align-center"> 
                <h3>Media Contact</h3>              
                <p> <a href="tel:+91 11 26554329">+91 11 44447777</a></p>
                <p>  <a href="mailto:thelalitmedia@thelalit.com">thelalitmedia@thelalit.com</a>
                </p>
            </div>
            <?php /*<div class="col col2"> <h3>Press Kit</h3>
                <p>Download the high resolution version on our press kit page. </p>
                <a href="#">Go to Brand Assets</a>
            </div>*/?>       
        </div>
    </div>
</div><!-- content- section-->
