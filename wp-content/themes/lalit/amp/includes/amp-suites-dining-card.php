<div class="row align-center">
    <?php
        $room_count = 1;
        foreach($suites_and_rooms_object as $suite_and_room_id)
        {
            if(get_post_status ( $suite_and_room_id ) == 'publish')
            {
                $room_term_id = '';
                $room_type_obj = get_the_terms($suite_and_room_id, 'room_type');
                if($room_type_obj && count($room_type_obj) > 0)
                {
                    foreach($room_type_obj as $room_types)
                    {
                        $room_term_id = $room_types->term_id;
                    }
                }

                $room_name = get_post_meta( $suite_and_room_id, "name", true);
                $room_description = get_post_meta( $suite_and_room_id, "room_summary", true);
                $room_images = get_post_meta( $suite_and_room_id, "images", true);
                $room_images = explode(',', $room_images);
                if(strlen($room_description) > 150)
                {
                    $room_description = substr($room_description, 0, 150).'...';
                }

                $size_ft = get_post_meta( $suite_and_room_id, "size_ft", true);
                $size_mt = get_post_meta( $suite_and_room_id, "size_mt", true);
                $bed_type = get_post_meta( $suite_and_room_id, "bed_type", true);
                $view = get_post_meta( $suite_and_room_id, "view", true);
                $room_base_price = get_post_meta( $suite_and_room_id, "base_price", true);

                $permalink = get_permalink($suite_and_room_id);

                if($room_term_id == $term_id)
                {
    ?>                          
    <a href="<?php echo $permalink.'amp'; ?>">
        <div class="col card-item">
            <div id="slider">
                <amp-carousel id="custom-button"
                width="400"
                height="300"
                layout="responsive"
                type="slides"
                autoplay
                controls>
                <?php
                    if($room_images)
                    {
                        foreach($room_images as $room_image_id)
                        {
                            $room_image = wp_get_attachment_image_src($room_image_id, 'box_image')[0];

                            if(trim($room_image) != '')
                            {
                ?>
                            <amp-img src="<?php echo $room_image; ?>"
                            width="400"
                            height="300"
                            layout="responsive"
                            alt="<?php echo $room_name; ?>">
                            </amp-img>
                        <?php   
                            }
                        }
                    }
                ?>
                </amp-carousel>
            </div><!-- slider -->

            <div class="card-info h-product">
                <input type="hidden" class="permalink" value="<?php echo $permalink; ?>">
                <h3 class="card-info-title bdr-bottom">
                    <span class="bdr-bottom-gold p-name"><?php echo $room_name; ?></span>
                </h3>
                <p><?php echo $room_description; ?></p>
                <div class="row">
                    <ul class="unstyled-listing">
                        <?php
                            if($size_ft != '' || $size_mt != '')
                            {
                        ?>
                        <li class="meta-item u-identifier clearfix">
                            <span class="meta-label">SIZE</span>
                            <span class="meta-value">
                                <?php
                                    if($size_ft != '' && $size_mt == '')
                                    {
                                        echo $size_ft.' ft<sup>2</sup>';
                                    }
                                    else if($size_ft == '' && $size_mt != '')
                                    {
                                        echo $size_mt.' m<sup>2</sup>';
                                    }
                                    else
                                    {
                                        echo $size_ft.' ft<sup>2</sup> / '.$size_mt.' m<sup>2</sup>';
                                    }
                                ?>
                            </span>
                        </li>
                        <?php
                            }
                        ?>

                        <?php
                            if($view != '')
                            {
                        ?>
                        <li class="meta-item u-identifier clearfix">
                            <span class="meta-label">VIEW</span><span class="meta-value"><?php echo ucfirst($view); ?></span>
                        </li>
                        <?php
                            }
                        ?>
                    </ul><!-- unstyled-listing -->

                    <ul class="unstyled-listing">

                        <?php
                            if($room_base_price != '')
                            {
                        ?>
                        <li class="starting-price-section clearfix">
                            <span class="starting-price-label">Starting at</span>
                            <strong class="starting-price-value p-price"><?php echo $curr; ?><?php echo number_format($room_base_price); ?></strong>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="discover-link">
                            <span class="text-link">Discover 
                                <i class="ico-sprite sprite size-32 ico-red-right-arrow"></i>
                            </span>
                        </li>
                    </ul> <!-- unstyled-listing -->
                </div><!-- row -->    
            </div><!-- card-info -->
                        
        </div><!-- card-item-block -->
    </a>

            <?php
                $room_count++;
            }
        }
    }
    ?>
</div><!-- row --> 