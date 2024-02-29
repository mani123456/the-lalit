<?php 
    $all_destinations = $GLOBALS['$destinations'];
?>
<div class="content-section">
    <div class="container section-space motif-blk">
        <div class="row site-map">

            <div class="col col10 align-content-center">   
                <h2 class="sec-title">Site Map</h2>
                <h3 class="item-title find-hotel-link home-link"><a href="<?php echo home_url(); ?>" title="Home">Home</a></h2>
                <h3 class="item-title find-hotel-link"><a href="<?php echo site_url(); ?>/find-a-hotel" title="Find a Hotel">Find a Hotel</a></h2>

                <?php
                if( $all_destinations->have_posts() ) : 
                ?>
                    <div class="row">    
                        <h3 class="item-title bdr-bottom">The LaLiT Properties</h2>
                            <div class="row page-listing">
                            <?php
                            $count = 1;
                            while($all_destinations->have_posts()) : $all_destinations->the_post();

                                $hotel_title = get_the_title($post->ID);
                                $hotel_title_array = explode(" ", $hotel_title, 3);
                                $hotel_title = $hotel_title_array[0].' '.$hotel_title_array[1].'<br/> '.$hotel_title_array[2];
                                $location_obj = get_the_terms($post->ID, 'locations');

                                $location = '';
                                $location_slug = '';
                                
                                $location = $location_obj[0]->name;
                                $location_slug = $location_obj[0]->slug;
                            ?>

                                <article class="sub-menu-item col col3">
                                    <h6 class="sub-menu-title"><?php echo $hotel_title; ?></h6>
                                    <div class="sub-menu-links-block">
                                        <ul class="unstyled-listing">
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>">Overview</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/suites-and-rooms/">Stay</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/eat-and-drink/">Eat & Drink</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/relax-and-unwind/">Relax & Unwind</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/photo-gallery/">Photo Gallery</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/location/">Location</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/experience-the-lalit/">Experience <?php echo $location; ?></a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/meetings-and-events/">Meetings & Events</a>
                                            </li>
                                            <?php
                                            if($location_slug != 'london' && $location_slug != 'mangar')
                                            {
                                            ?>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/weddings/">Weddings</a>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/offers/">Offers</a>
                                            </li>
                                            <li class="list-item">
                                                <a href="<?php echo site_url(); ?>/the-lalit-<?php echo $location_slug; ?>/contact-us/">Contact Us</a>
                                            </li>
                                        </ul><!-- unstyled-listing -->
                                    </div><!-- sub-menu-links-block -->
                                </article><!-- sub-menu-item -->
                        <?php
                        if($count%4 == 0)
                        {
                        ?>
                            </div><!-- page-listing -->
                            <div class="row page-listing">
                        <?php
                        }
                        ?>

                            
                        <?php
                                $count++;
                            endwhile;
                        ?>
                            </div><!-- page-listing -->
                        
                    </div><!-- row -->
                <?php
                    endif;
                ?> 
                
                    <div class="row">
                        <div class="col col4" style="display:none">
                            <h3 class="item-title bdr-bottom">The LaLiT Brands</h2>
                            <div class="row page-listing">
                                <article class="sub-menu-item col col12">
                                    <div class="sub-menu-links-block">
                                        <ul class="unstyled-listing">
                                            <li class="list-item"><a href="http://www.kittysu.com/" target="_blank">Kitty Su</a></li>
                                            <li class="list-item"><a href="http://www.thebaluchi.com/" target="_blank">Baluchi</a></li>
                                            <li class="list-item"><a href="http://www.thelalitftc.com/" target="_blank">The LaLiT Food Truck Company</a></li>
                                            <li class="list-item"><a href="http://www.tlshs.com/" target="_blank">The LaLiT Suri Hospitality School</a></li>
                                        </ul><!-- unstyled-listing -->
                                    </div><!-- sub-menu-links-block -->
                                </article><!-- sub-menu-item -->
                            </div><!-- page-listing -->
                        </div><!-- col -->

                        <div class="col col7">
                            <h3 class="item-title bdr-bottom">The LaLiT Suri Hospitality Group</h2>
                            <div class="row page-listing">
                                <article class="sub-menu-item col col4">
                                    <div class="sub-menu-links-block">
                                        <ul class="unstyled-listing">
                                            <li class="list-item"><a href="<?php echo site_url();?>/about-us/">About Us</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/management/">Management</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/the-lalit-loyalty/">The LaLiT Loyalty</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/careers/">Careers</a></li>
                                            <li class="list-item"><a href="<?php echo site_url(); ?>/media-coverage/">Media Coverage</a></li>
                                            <li class="list-item"><a href="<?php echo site_url(); ?>/wp-content/uploads/2017/07/thelalit-published-rates-july-2017.pdf" target="_blank">Published Rates</a></li>
                                            <?php
                                            $args = array(
                                                'post_type'=>'the-lalit-insight',
                                                'post_status'=>'publish',
                                                'posts_per_page'=>'-1',
                                            );

                                            $loop = new WP_Query($args);
                                            if($loop->post_count > 0){
                                            ?>
                                            <li class="list-item"><a href="<?php echo site_url(); ?>/the-lalit-insights/" target="_blank">The LaLiT Insights  </a></li>
                                            <?php
                                            }
                                            wp_reset_postdata();
                                            ?>
                                        </ul><!-- unstyled-listing -->
                                    </div><!-- sub-menu-links-block -->
                                </article><!-- sub-menu-item -->

                                <article class="sub-menu-item col col4">
                                    <div class="sub-menu-links-block">
                                        <ul class="unstyled-listing">
                                            
                                            <li class="list-item"><a href="<?php echo site_url(); ?>/press-release/">Press Releases</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/awards/">Awards</a></li>
                                            <li class="list-item"><a href="<?php echo site_url(); ?>/investors-relations/">Investors Relations</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/privacy-policy/">Privacy Policy</a></li>
                                            <li class="list-item"><a href="http://blog.thelalit.com/">Blog</a></li>
                                            <li class="list-item"><a href="<?php echo site_url();?>/contact-us/">Contact Us</a></li>
                                        </ul><!-- unstyled-listing -->
                                    </div><!-- sub-menu-links-block -->
                                </article><!-- sub-menu-item -->
                            </div><!-- page-listing -->
                        </div><!-- col -->
                    </div><!-- row -->   
            </div><!-- col10 --> 

        </div><!-- row -->
    </div><!-- container -->
</div><!-- content-section -->
