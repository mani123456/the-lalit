<?php

/**
 * This component used on the property overview and location pages.
 * Parameters needed are as follows:
 * 
 * $height, $width --> Height and width for the image
 * $image_path --> Path of the map image file
 * $hotel_name --> Name of the hotel to be used in alt attribute
 * $address and $getting_here_obj to be used in the Well Located section on the hotel overview amp page
 * 
*/
?>
<div class="container map-sec"> 
    <a href="<?php echo $link?>">
        <amp-img src="<?php echo $image_path; ?>"
            layout="responsive"
            width="<?php echo $width; ?>"
            height="<?php echo $height; ?>"
            alt="<?php echo $hotel_name; ?>"></amp-img>
    </a>
    <?php if($address != '' || $getting_here_obj){ ?>
    <div class="map-sec-inner">
        <div class="row">
            <div class="address-block">
                <div class="address-block-inner">
                    <div class="arrow-design-blk">
                        <?php
                        if($address != '')
                        {
                        ?>
                            <h6>Location</h6>
                            <address><?php echo $address; ?></address>
                        <?php
                        } 
                        if($getting_here_obj)
                        {
                        ?>
                            <ul class="unstyled-listing">
                                <?php
                                foreach($getting_here_obj as $getting_here)
                                {
                                    $heading = $getting_here['heading'];
                                    $value = $getting_here['value'];

                                    if($heading != '' || $value != '')
                                    {
                                ?>
                                        <li>
                                            <span class="span span6 place-name"><?php echo $heading; ?></span>
                                            <span class="distance"><?php echo $value; ?></span>
                                        </li>
                                <?php
                                    }

                                }
                                ?>
                            </ul>
                        <?php
                        }
                        ?>
                        <a class="btn tertiary-btn" href="<?php echo $link; ?>">MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>