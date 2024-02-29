<div class="container item-listing offer-bg js_fade"> 
    <h2 class="sec-title align-center">Offers</h2>
        <div class="row two-col-listing">
        <?php
        $city_name = $GLOBALS['location'][0]->slug;
        while($GLOBALS['listing_offers']->have_posts()) : $GLOBALS['listing_offers']->the_post();

            $offer_name = get_post_meta($post->ID, "name", true);
            $offer_summary = get_post_meta($post->ID, "offer_summary", true);
            $offer_image_id = get_post_meta($post->ID, "image", true);
            $offer_image = wp_get_attachment_url($offer_image_id);
            $permanlink = get_permalink($post->ID);
            $product_id = get_post_meta($post->ID,'products', true);
        ?>
            <div class="col col6 offer-block buy-now-offer">
                <img src="<?php echo $offer_image; ?>" height="335" alt="<?php echo $offer_name; ?>" title="<?php echo $offer_name; ?>"/>
                <?php if($product_id){ ?><span class="buy-now-text">Buy Now!</span><?php } ?>
                <div class="offer-text col col6">
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
                        <a href="<?php echo $permanlink; ?>" class="btn primary-btn">Know More</a>
                    <?php
                    }
                    ?>
                </div><!--lalit-ad-->    
            </div><!--col6-->
        <?php       
        endwhile;
        ?>
            <div class="col col12">
            <?php
            if($GLOBALS['type'])
            {
            ?>
                <a href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers?type=<?php echo $GLOBALS['type']; ?>" class="pull-right text-link">View More Offers <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i></a>
            <?php
            }
            else
            {
            ?>
                <a href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers/" class="pull-right text-link">View More Offers <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i></a>
            <?php
            }
            ?>
            </div>

        </div><!-- row -->  
</div>