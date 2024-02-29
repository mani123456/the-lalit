<?php

    $job_title = get_post_meta($post->ID,'job_title',true);
    $detailed_description = wpautop(get_post_meta($post->ID,'detailed_description',true));
    $posted_on = get_the_date();

    $department = get_the_terms($post->ID, 'career_department');
    $location = get_the_terms($post->ID, 'location-filter');

    $position_closed = get_post_meta($post->ID,'position_open',true);

    if($posted_on != '')
    {
        $posted_on = strtoupper(date('j F Y',strtotime($posted_on)));
    }
    /*else
    {
        $posted_on = '';
    }*/

    $job_type = get_post_meta($post->ID,'job_type',true);
    if($job_type == '0')
    {
        $job_type = "Full Time";
    }
    else
    {
        $job_type = "Part Time";
    }

    $mail_subject = '';
    
    if(trim($job_title) != '' && !is_wp_error( $location ) && !empty($location))
    {
        $mail_subject = 'Application for '.$job_title.' ('.$location[0]->name.')';
        $mail_subject = str_replace(' ', '%20', $mail_subject);
    }
?>

<?php
    
    if($position_closed == '')
    {
        ?>
        <div class="content-section press-release careers-details page-con detail-page" style="padding-top: 100px;">
            <div class="container fluid-width small-wrap single-detail">
                <div class="sticky-head">
                    <div class="row">
                        <div class="col col8 align-content-center">
                            <a class="sidebar-head" href="<?php echo site_url(); ?>/careers/openings/"> <strong> <i class="ico-sprite sprite size-12 ico-gre-left-arrow"></i> Back to Listing</strong></a>
                            <div class="row">
                                <div class="col col12">                          
                                    <?php if(!is_wp_error( $location ) && !empty($location) && trim($posted_on) != '' ) { ?>
                                        <ul class="date-info">
                                            <li><?php echo strtoupper($location[0]->name); ?>, <?php if($location[0]->slug == 'london') { echo 'ENGLAND'; } else { echo 'INDIA'; } ?></li>
                                            <li>POSTED ON <?php echo $posted_on; ?></li>
                                        </ul><!-- date-info --> 
                                    <?php } ?>
                                    
                                    <div class="row">
                                        <div class="col col9">
                                            <?php if(trim($job_title) != '') { ?><h3><?php echo $job_title; ?></h3><?php } ?>
                                            
                                            <?php if(!is_wp_error( $department ) && !empty($department) && $job_type != '') { ?>
                                                <ul class="unstyled-listing date-info discp-info">
                                                    <li><?php echo $department[0]->name; ?> Department</li>
                                                    <li><?php echo $job_type; ?></li>
                                                </ul><!-- discp-info --> 
                                            <?php } ?>
                                        </div><!-- col -->

                                        <div class="col col3 align-right btn-apply-now">
                                            <a href="mailto:careers@thelalit.com?subject=<?php echo $mail_subject; ?>" class="btn primary-btn" title="Apply Now">Apply Now</a>
                                        </div><!-- col -->    
                                    </div><!-- row -->
                                </div><!-- col -->
                            </div><!-- row -->    
                            <div class="social-share"><div class="sharethis-inline-share-buttons"></div></div>
                        </div><!-- col8 -->
                    </div><!-- row -->
                </div><!-- sticky-head -->    
                
                <div class="row non-stick-body">
                    <div class="col col8 align-content-center">
                        <?php

                            if(trim($detailed_description) != '')
                            {
                                ?>
                                <h5 class="item-title">Job Responsibilities:</h5>
                                <p>
                                    <?php echo $detailed_description; ?>
                                </p>
                                <?php
                            }
                        ?>
                    </div><!-- col8 -->
                </div><!-- row -->
            </div><!-- container -->
        </div>
        <?php
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

