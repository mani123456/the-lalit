<?php
/**
 * This component is used on the global homepage in the following sections:
 * At the Lalit
 * Award Winning Services
 * Experience Slider
 * 
 * It is also used on the hotel overview pages in the following section:
 * At a Glance
 * Experience [City-Name]
 * Taking care of your needs
 * City Attractions
 * 
 * 
 * Parameters needed are as follows:
 * $data --> an array containing permalink, title and image. This is used to display experiences on the global home page with the Discover button
 * $height, $width --> Height and width for the image
 * $section_title --> Section title to set the title of the cross sell offers section
*/
?>
<div class="container section-space<?php if(trim($data['permalink']) != ''){ echo ' experience-slider'; } ?>">
    <?php if($section_title){ ?><h2 class="sec-title align-center"><?php echo $section_title; ?></h2><?php } ?>
    <amp-carousel class="amp-carousel"
            layout="responsive"
            height="<?php echo $height; ?>"
            width="<?php echo $width; ?>"
            controls
            type="slides">
        <?php
            foreach($data_array as $data)
            {
                if($data['title'] || $data['image'])
                ?>
                <div class="slide">
                    <amp-img src="<?php echo $data['image']; ?>"
                    layout="fill"
                    alt="<?php echo $data['title']; ?>"></amp-img>
                    <?php if(trim($data['title']) != '' && trim($data['permalink']) == ''){ ?>
                        <div class="glance-caption">
                            <span class="glance-header"><?php echo $data['title']; ?></span>
                        </div>
                    <?php }else if($data['permalink'] || $data['title']){ ?>
                        <div class="banner-content">
                            <?php if(trim($data['title']) != ''){ ?><h1 class="experience-title"><?php echo $data['title']; ?></h1><?php } ?>
                            <?php if(trim($data['permalink']) != ''){ ?><a href="<?php echo $data['permalink']; ?>" class="btn primary-btn discover-btn" title="discover">Discover</a><?php } ?>
                        </div><!-- banner-content -->
                    <?php } ?>
                </div>
                <?php
            }
        ?>
    </amp-carousel>
</div>