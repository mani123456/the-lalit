    <?php 

        $args = array(
            'post_type'=>'career',
            'post_status'=>'publish',
            'posts_per_page'=>'-1',
            'order'=>'ASC',
            'orderby'=>'meta_value',
            'meta_key'=>'job_title',
            'meta_query'=>array(
                array(
                    'key'=>'position_open',
                    'value'=>'1',
                    'compare'=>'NOT LIKE',
                )
            )
        );

        $loop = new WP_Query($args);

        if($loop->post_count > 0)
        {
            ?>
            <div class="content-section press-release small-banner not-found careers-listing">
                <!-- slider -->
                <div class="container align-center small-banner-sec js_fade" style="background-image:url('/wp-content/themes/lalit/images/careers-listing-page.jpg')">
                    <div class="row">
                        <div class="banner-content">
                            <h1 class="main-title text-shadow">Careers</h1>
                        </div><!-- banner-content -->
                    </div><!-- row -->
                </div><!-- container -->
                <div class="container fluid-width small-wrap" style="min-height: 800px;">
                    <div class="row filter-outer"> 
                        <div class="col col8 align-content-center">
                            <ul class="unstyled-listing filter-box filter-tab align-left">
                                <li class="filter-item"><strong>Filter By:</strong></li>
                                <li class="filter-item">
                                    <a class="city">City <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                                    <div class="sub-menu">
                                        <div class="row" style="display: block;">
                                            <div class="col col12">
                                                <ul class="unstyled-listing drop-down-menu">
                                                    <?php

                                                        $i=0;$city_names = $city_slugs = array();

                                                        if($loop->have_posts())
                                                        {
                                                            while($loop->have_posts())
                                                            {
                                                                $loop->the_post();
                                                                $locations = wp_get_post_terms($post->ID,'location-filter',array('order'=>'ASC'));

                                                                
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
                                                        

                                                        sort($city_names);sort($city_slugs);

                                                        if(!empty($city_names) && !empty($city_slugs))
                                                        {
                                                            ?>
                                                            <li class="list-item nav-item" data-location-name='all-destinations'><a href="javascript:void(0);" class="city-filter">All Cities</a></li>
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
                                <li class="filter-item">
                                    <a class="dept">Department <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                                    <div class="sub-menu">
                                        <div class="row" style="display: block;">
                                            <div class="col col12">
                                                <ul class="unstyled-listing drop-down-menu">
                                                    <?php

                                                        $i=0;$dept_names = $dept_slugs = array();

                                                        if($loop->have_posts())
                                                        {
                                                            while($loop->have_posts())
                                                            {
                                                                $loop->the_post();
                                                                $depts = wp_get_post_terms($post->ID,'career_department',array('order'=>'ASC'));

                                                                
                                                                foreach($depts as $dept)
                                                                {
                                                                    if(trim($dept->slug) != '')
                                                                    {
                                                                        if(!in_array($dept->slug, $dept_slugs) && !in_array($dept->name, $dept_names))
                                                                        {
                                                                            $dept_names[$i] = $dept->name;
                                                                            $dept_slugs[$i] = $dept->slug;
                                                                            $i++;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if(!empty($dept_names) && !empty($dept_slugs))
                                                        {
                                                            ?>
                                                            <li class="list-item nav-item" data-dept-name='all-departments'><a href="javascript:void(0);" class="dept-filter">All Departments</a></li>
                                                            <?php

                                                            sort($dept_names);sort($dept_slugs);

                                                            for($j=0;$j<$i;$j++)
                                                            {
                                                                ?>
                                                                <li class="list-item nav-item" data-dept-name='<?php echo $dept_slugs[$j]; ?>'><a href="javascript:void(0);" class="dept-filter"><?php echo $dept_names[$j]; ?></a></li>
                                                                <?php
                                                            }
                                                        }

                                                    ?>
                                                </ul><!-- unstyled-listing -->
                                            </div><!-- col -->    
                                        </div><!-- row -->  
                                    </div><!-- sub-menu -->
                                </li>
                            </ul><!-- filter-tab -->  
                        </div><!-- col8 -->
                    </div><!-- filter-outer -->

                    <?php

                        $career_departments = get_terms(array('taxonomy'=>'career_department','hide_empty'=>true,'orderby'=>'name','order'=>'ASC'));
                    ?>
                    <div class="row">
                        <div class="col col8 align-content-center">
                            <ul class="unstyled-listing release-list job-listing">
                                <?php

                                    foreach($career_departments as $department)
                                    {
                                        ?>
                                        <li class="<?php echo 'all-departments all-destinations '.$department->slug; ?>">
                                            <?php
                                                
                                                $job = get_jobs_by_taxonomy('career','career_department',$department->slug);

                                                if($job->have_posts()):

                                                    ?>
                                                    <h3 class="card-info-title bdr-bottom"><span class="bdr-bottom-gold"><?php echo $department->name; ?></span></h3>
                                                    <?php
                                                        while($job->have_posts()):

                                                            $job->the_post();

                                                            $job_title = get_post_meta($post->ID,'job_title',true);
                                                            $cities = wp_get_post_terms($post->ID,'location-filter',array('order'=>'ASC'));
                                                            $job_type = get_post_meta($post->ID,'job_type',true);

                                                            if($job_type == '0')
                                                            {
                                                                $job_type = "Full-Time";
                                                            }
                                                            else
                                                            {
                                                                $job_type = "Part-Time";
                                                            }

                                                            if(trim($job_title) != '' && (!is_wp_error( $cities ) && !empty($cities))) 
                                                            { 
                                                                ?>
                                                                <a href="<?php the_permalink(); ?>" class="clearfix job-listing-block<?php echo ' '.$cities[0]->slug; ?>"> 
                                                                    <span class="job-dtl col col8">
                                                                        <?php if(trim($job_title) != ''){ ?><span class="job-title"><?php echo $job_title; ?></span><?php } ?>
                                                                        <span class="job-discp"><?php echo $job_type; ?></span>
                                                                    </span><!-- job-dtl -->    
                                                                    <?php

                                                                        $city_name_str = $city_slugs_str = '';
                                                                        $city_names = $city_slugs = array();

                                                                        foreach ($cities as $city)
                                                                        {   
                                                                            if(trim($city->slug) != '') 
                                                                            {
                                                                                $city_names[] = $city->name;
                                                                                $city_slugs[] = $city->slug;
                                                                            }
                                                                        }

                                                                        $city_name_str = implode(', ', $city_names);
                                                                        $city_slugs_str = implode(' ', $city_slugs);

                                                                        if(trim($city_name_str) != '')
                                                                        {
                                                                            ?>
                                                                            <span class="job-location col col4<?php echo ' '.$city_slugs_str; ?>"><?php echo $city_name_str; ?></span>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </a><!-- col -->
                                                                <?php
                                                            }
                                                        endwhile;
                                                endif;
                                            ?>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul><!-- positions-list -->
                        </div><!-- col8 -->
                    </div><!-- row -->
                    <div class="container align-center no-record-found" style="display:none;">
                        <div class="row  no-record">
                            <h1 class="main-title text-black">No Record Found!</h1>
                            <div class="row ">
                                <div class="col8 align-content-center">
                                    <p class="disp-text">we are really very sorry but the page you requested cannot be found.</p>
                                </div><!-- col6 --> 
                            </div><!-- row -->
                            <div class="motif-img">
                                <img src="/wp-content/themes/lalit/images/404-motif.png" alt="">
                            </div><!-- motif-img -->
                        </div><!-- row -->                        
                    </div><!-- container -->                   
                </div><!-- container -->
            </div>
            <?php

            wp_reset_postdata();
        }
        else
        {
            ?>
            <div class="content-section">
                <div class="container section-space intro-text align-center four-zero-four">
                    <div class="row">
                        <h1 class="main-title text-black">No Job Openings at this time!</h1>
                        <div class="row">
                            <div class="col8 align-content-center">
                                <p class="disp-text">We’re sorry but we don’t have any openings for this city/department. If you are interested in working with us, please drop us a line at <a href="mailto:careers@thelalit.com">careers@thelalit.com</a> with a short note describing your capabilities and your resume.</p>
                                <div class="btn-block">
                                    <a href="<?php echo home_url(); ?>/" class="btn tertiary-btn booking-nav-btn">Home</a>
                                    <a href="<?php echo home_url(); ?>/find-a-hotel/" class="btn tertiary-btn booking-nav-btn">Find a Hotel</a>
                                </div><!-- btn-block -->    

                                <div class="divider-block">
                                    <span class="lbl-or">Or</span>
                                </div><!-- divider-block -->

                                <div class="pick-destination">
                                    <h6 class="sub-menu-title">Pick a destination</h6>

                                    <div class="row destination-links">
                                        <div class="col col8 align-content-center">
                                            <div class="row">
                                                <div class="col col3">
                                                    <ul class="unstyled-listing">
                                                        <?php
                                                            $i = 1;
                                                            $max_rows = 4;
                                                            $locations_array = get_terms(array('taxonomy'=>'locations','hide_empty'=>false));
                                                            foreach ($locations_array as $locations_obj)
                                                            {
                                                                ?>
                                                                <li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/';?>" class=""><?php echo $locations_obj->name; ?></a></li>
                                                                <?php
                                                                    if($i == $max_rows)
                                                                    {
                                                                        ?>
                                                                            </ul><!-- unstyled-listing -->
                                                                        </div>
                                                                        <div class="col col3">
                                                                            <ul class="unstyled-listing">
                                                                        <?php

                                                                        $i = 0;$max_rows = 3;
                                                                    }

                                                                    $i++;
                                                            }
                                                        ?>
                                                    </ul><!-- unstyled-listing -->
                                                </div><!-- col -->
                                            </div><!-- row -->  
                                        </div><!-- col -->
                                        <div class="motif-img">
                                            <img src="/wp-content/themes/lalit/images/404-motif.png" alt="">
                                        </div><!-- motif-img -->
                                    </div><!-- destination-links -->    
                                </div><!-- pick-destination --> 
                            </div><!-- col6 --> 
                        </div><!-- row -->  
                    </div><!-- row -->
                </div>
            </div>
            <?php
        }
    ?>
</div><!-- content- section-->
