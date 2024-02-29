<?php

/**
 * This is the leader board banner component used on all the listing pages.
 * Parameters needed are as follows:
 * $banners --> loop to fetch the banner content
 * $height, $width --> Height and width for the image
 * $image_present_flag to check if the banner has a mobile banner image field set in the CMS
 * $video_present_flag to check if the video field has been set in the CMS and accordingly set the amp-carousel(disable autoplay) parameters
*/
if( $banners->have_posts() && $image_present_flag ) :  
    ?>
    <div class="align-center">
        <div id="banner-slider" class="flexslider">
            <amp-carousel id="custom-button" class="amp-carousel"
                width="<?php echo $width; ?>"
                height="<?php echo $height; ?>"
                layout="responsive"
                type="slides"
                <?php echo (!$video_present_flag) ? 'autoplay' : ''; ?>
                controls
                delay="8000">
                <?php
                $count = 1;
                while($banners->have_posts()) : $banners->the_post();
                    
                    $heading = get_post_meta($post->ID, 'banner_heading', true);
                    $description = get_post_meta($post->ID, 'banner_description', true);
                    $url = trim(get_post_meta($post->ID, 'url', true));
                    $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                    $image = wp_get_attachment_url($image_id);
                    $banner_type = get_post_meta($post->ID, 'banner_type', true);

                    if($banner_type == 0 && $image != ''){
                        if($url && trim($url) != ''){ echo '<a href="'.$url.'">'; }
                            ?>
                            <div class="slide">
                                <amp-img src="<?php echo $image; ?>"
                                layout="responsive"
                                width="<?php echo $width; ?>"
                                height="<?php echo $height; ?>"
                                alt=""></amp-img>
                                <?php if(trim($heading) != '' || trim($description) != ''){ ?>
                                    <div class="caption">
                                        <?php if(trim($heading) != ''){ ?><h1 class="main-title"><?php echo $heading; ?></h1><?php } ?>
                                        <?php if(trim($description) != ''){ ?><p class="title-description"><?php echo $description; ?></p><?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php 
                        if($url && trim($url) != ''){ echo '</a>'; }
                    }
                    else{

                        $video_url = get_post_meta($post->ID, 'video_url', true);
                        //if($url && trim($url) != ''){ echo '<a href="'.$url.'">'; }
                        if(trim($video_url) != '' && $image != '')
                        {
                            $video_code = str_replace('https://www.youtube.com/embed/', '', $video_url);

                            if(strpos($video_code, '?') !== false){
                                $video_code = str_replace(substr($video_code, strpos($video_code, '?')), '', $video_code);
                            }
                            $video_code = rtrim($video_code, '/');
                            ?>
                            <div class="slide">
                                <amp-youtube
                                    data-videoid="<?php echo $video_code; ?>"
                                    layout="responsive"
                                    width="<?php echo $width; ?>"
                                    height="<?php echo $height; ?>"
                                    autoplay
                                    data-param-loop="1"
                                    data-param-rel="0">
                                    <amp-img
                                        src="<?php echo $image; ?>"
                                        placeholder
                                        layout="fill">
                                    </amp-img>
                                </amp-youtube>
                                <?php /*if(trim($heading) != '' || trim($description) != ''){ ?>
                                    <div class="caption">
                                        <?php if(trim($heading) != ''){ ?><h1 class="main-title"><?php echo $heading; ?></h1><?php } ?>
                                        <?php if(trim($description) != ''){ ?><p><?php echo $description; ?></p><?php } ?>
                                    </div>
                                <?php }*/ ?>
                            </div>
                            <?php 
                        //if($url && trim($url) != ''){ echo '</a>'; }
                        }
                    }
                endwhile;
                wp_reset_postdata();
                ?>      
            </amp-carousel>
        </div> <!-- slider -->
    </div>
    <?php
endif;      
?>