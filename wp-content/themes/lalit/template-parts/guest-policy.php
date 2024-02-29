<div class="content-section">
    <div class="banner-slider align-center">
        <div id="banner-slider" class="flexslider">
            <ul class="slides">
                <li>
                    <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Management.jpg" />  
                </li>
            </ul>
        </div>                 
    </div> 
    <div class="page-con">    
        <div class="container js_fade section-space">                                   
            <div class="row">
                <div class="page-heading">
                    <h2 class="card-info-title bdr-bottom">
                        <span class="bdr-bottom-gold"><?php the_title(); ?></span>
                    </h2>
                </div>
                <?php
    
                    if( $GLOBALS['destination']->have_posts() ) : 
                        while($GLOBALS['destination']->have_posts()) : $GLOBALS['destination']->the_post();

                            $check_in_time = get_post_meta( $post->ID, "check_in_time", true);
                            $check_out_time = get_post_meta( $post->ID, "check_out_time", true);
                            $check_in_check_out_policy = wpautop(get_post_meta( $post->ID, "check_in_and_check_out_policy", true));
                            $child_policy = wpautop(get_post_meta( $post->ID, "child_policy", true));
                            $pet_policy = wpautop(get_post_meta( $post->ID, "pet_policy", true));
                            $reservation_policy = wpautop(get_post_meta( $post->ID, "reservation_policy", true));
                            $cancellation_policy = wpautop(get_post_meta( $post->ID, "cancellation_policy", true));
                            $food_and_beverage_policy = wpautop(get_post_meta( $post->ID, "food_and_beverage_policy", true));
				            $alcohol_policy = wpautop(get_post_meta( $post->ID, "alcohol_policy", true));
				            $visitors_policy = wpautop(get_post_meta( $post->ID, "visitors_policy", true));
                            $safety_and_security = wpautop(get_post_meta( $post->ID, "safety_and_security", true));
                        
                            ?>

                            <div id="policies">
                                <!-- <div class="page-heading">
                                    <h2 class="card-info-title bdr-bottom">
                                        <span class="bdr-bottom-gold">Guest Policy</span>
                                    </h2>
                                </div> -->
                                <ul class="unstyled-listing">
                                    <?php if(trim($check_in_time) != '' || trim($check_out_time) != '' || trim($check_in_check_out_policy) != ''){ ?>
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Check-in and Check-out Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php if(trim($check_in_time) != '' || trim($check_out_time) != ''){ ?>
                                                    <div class="check-col">
                                                        <?php if(trim($check_in_time) != ''){ ?>
                                                            <span class="span span4">
                                                                <span class="meta-label">Check-in:</span>
                                                                <span class="meta-value"><?php echo $check_in_time; ?></span>
                                                            </span>
                                                        <?php } ?>
                                                        <?php if(trim($check_out_time) != ''){ ?>
                                                            <span class="span span4">
                                                                <span class="meta-label">Check-out:</span>
                                                                <span class="meta-value"><?php echo $check_out_time; ?></span>
                                                            </span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <?php echo $check_in_check_out_policy; ?>
                                            </div><!-- guest-policy-section -->     
                                        </li>
                                    <?php } ?>
                                    <?php if(trim($child_policy) != '') { ?>
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Child Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php echo $child_policy; ?>
                                            </div><!-- guest-policy-section -->     
                                        </li>
                                    <?php } ?>
                                    <?php if(trim($pet_policy) != '') { ?>  
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Pet Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php
                                                echo $pet_policy;
                                                ?>
                                            </div><!-- guest-policy-section -->  
                                        </li>
                                    <?php } ?>
                                    <?php if(trim($reservation_policy) != '') { ?>  
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Reservation Gaurantee</h6>
                                            <div class="guest-policy-section">
                                                <?php
                                                echo $reservation_policy;
                                                ?>
                                            </div><!-- guest-policy-section -->  
                                        </li>
                                    <?php } ?>
                                    <?php if(trim($cancellation_policy) != '') { ?>  
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Cancellation Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php
                                                echo $cancellation_policy;
                                                ?>
                                            </div><!-- guest-policy-section -->  
                                        </li>
                                    <?php } ?>
                                    <?php if(trim($food_and_beverage_policy) != '') { ?>  
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Food and Beverage Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php
                                                echo $food_and_beverage_policy;
                                                ?> 
                                            </div><!-- guest-policy-section -->   
                                        </li>
									<?php } ?>
                                    <?php if(trim($alcohol_policy) != '') { ?>
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Alcohol Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php echo $alcohol_policy; ?>
                                            </div><!-- guest-policy-section -->     
                                        </li> 
									<?php } ?>
                                    <?php if(trim($visitors_policy) != '') { ?>
                                        <li class="guest-policy-list">
                                            <h6 class="guest-policy-heading">Visitors Policy</h6>
                                            <div class="guest-policy-section">
                                                <?php echo $visitors_policy; ?>
                                            </div><!-- guest-policy-section -->     
                                        </li> 
                                    <?php } ?>
                                    <?php if(trim($safety_and_security) != '') { ?>  
                                        <li class="guest-policy-list">
                                            <span>
                                                <h6 class="guest-policy-heading">Safety and Security</h6>
                                            </span>
                                            <div class="guest-policy-section">
                                                <p>
                                                <?php
                                                echo $safety_and_security;
                                                ?>
                                                </p>
                                            </div><!-- guest-policy-section -->
                                        </li>
                                    <?php } ?>
                                </ul><!-- accordion -->  
                            </div><!-- pop-up --> 
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div><!--content-section-->