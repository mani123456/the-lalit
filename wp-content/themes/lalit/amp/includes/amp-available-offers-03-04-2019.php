<?php
/**
 * Cross sell offers that appears on the eat and drink, suites and rooms (both listing and detail)
 * Parameters needed are as follows:
 * $loop --> offer loop to fetch those offers that are set to be displayed on the listing and detail page of suites and rooms, eat and drink
 * $height, $width --> Height and width for the image
 * $section_title --> Section title to set the title of the cross sell offers section
 * $class --> Classes if neccessary.
 * $city_name --> to add a View More Offers button that links to that city's offers amp page.
*/
?>

<div class="offer-bg content-body"> 
<h2 class="sec-title <?php if(!$class){ ?>align-center<?php } ?>"><?php echo $section_title;?></h2>
        <div class="row<?php if($class){ echo ' '.$class; } ?>">
        <?php

        while($loop->have_posts()) : $loop->the_post();

            $offer_name = get_post_meta($post->ID, "name", true);
            $offer_summary = get_post_meta($post->ID, "offer_summary", true);
            $offer_image_id = get_post_meta($post->ID, "image", true);
            $offer_image = wp_get_attachment_url($offer_image_id);
            $permanlink = get_permalink($post->ID);
            $product_id = get_post_meta($post->ID,'products', true);
            ?>
            <div class="offer-block buy-now-offer">
                <amp-img src="<?php echo $offer_image; ?>"
                    width="<?php echo $width; ?>"
                    height="<?php echo $height; ?>"
                    layout="responsive"
                    alt="<?php echo $offer_name; ?>">
                </amp-img>
                <?php if($product_id){ ?><span class="buy-now-text">Buy Now!</span><?php } ?>
                <div class="offer-text">
                    <span class="offer-title"><?php echo $offer_name; ?></span>
                    <p><?php echo $offer_summary; ?></p>
                    <?php

                    if($product_id){

                    ?>
                        <a href="<?php the_permalink($product_id[0]); ?>" class="btn primary-btn">Buy Now</a>
                    <?php
                    }
                    else{

                    ?>
                        <a href="<?php echo $permanlink.'amp'; ?>" class="btn primary-btn">Know More</a>
                    <?php
                    }
                    ?>
                </div><!-- offer-text -->    
            </div><!-- offer-block -->
            <?php       
        endwhile;
        ?>
            <div class="align-right">
            <?php
            /*if($GLOBALS['type'])
            {
            ?>
                <a href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers?type=<?php echo $GLOBALS['type']; ?>" class="view-offers-link text-link">View More Offers <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i></a>
            <?php
            }
            else
            {*/
            ?>
                <a href="/the-lalit-<?php echo $city_name; ?>/offers/?amp" class="view-offers-link text-link">View More Offers <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i></a>
            <?php
            //}
            ?>
            </div>

        </div><!-- align-right -->  
</div>