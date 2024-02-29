
<h2 class="sec-title"> <small>Available</small> Offers</h2>
<?php
while($GLOBALS['detail_offers']->have_posts()) : $GLOBALS['detail_offers']->the_post();
    $offer_name = get_post_meta($post->ID, "name", true);
    $offer_summary = get_post_meta($post->ID, "offer_summary", true);
    $offer_image_id = get_post_meta($post->ID, "image", true);
    $offer_image = wp_get_attachment_image_src($offer_image_id, 'listing_page_image')[0];
    $permanlink = get_permalink($post->ID);
    $product_id = get_post_meta($post->ID,'products', true);
?>
    <div class="offer-block buy-now-offer">
        <amp-img src="<?php echo $offer_image; ?>"
            width="610"
            height="324"
            layout="responsive"
            alt="<?php echo $offer_name;?>">
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
            <a href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers/?amp" class="view-offers-link text-link">View More Offers <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i></a>
        <?php
        //}
        ?>
    </div><!-- align-right -->