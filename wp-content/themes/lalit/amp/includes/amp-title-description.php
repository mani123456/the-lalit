<?php

/**
 * This component used on all the property listing pages below the leader board banner.
 * Parameters needed are as follows:
 * 
 * $title --> to display the title in golden heading tags
 * $description --> to display the description below the title
 * $link_text --> to display the text on the button
 * $link --> to link the button to
*/

?>
<div class="container section-space intro-text align-center">
    <div class="row">
        <?php
        if($title)
        {
        ?>
            <h4 class="sec-title"><?php echo $title; ?></h4>
        <?php
        }
        if($description)
        {
        ?>
            <p><?php echo the_lalit_remove_image_tags_amp($description); ?></p>
        <?php
        }

        if($link && $link_text)
        {
        ?>
            <a href="<?php echo $link; ?>" class="btn primary-btn" title="<?php echo $link_text; ?>"><?php echo $link_text; ?></a>
        <?php
        }
        ?>      
    </div> 
</div>