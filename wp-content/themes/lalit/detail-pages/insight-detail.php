<?php

$insight_title = get_post_meta($post->ID, 'insight_title', true);
$body_copy = wpautop(get_post_meta($post->ID, 'insight_body_copy', true));
//$publisher_name = get_post_meta($post->ID,'publisher_name',true);

$published_date = get_post_meta($post->ID, 'insight_published_date', true);
$article_or_file = get_post_meta($post->ID, 'insight_article_or_file', true);

$article_or_file = wp_get_attachment_url($article_or_file);

//$embed_code = get_post_meta($post->ID,'insight_video_embed_code',true);

if ($article_or_file != '') {
    $url = parse_url($article_or_file);
    $path = $url['path'];
    $path = explode('.', $path);
} else {
    $path = '';
}

if ($published_date != '') {
    $published_date = date('j M Y', strtotime($published_date));
} else {
    $published_date = '';
}
//echo $insight_title."<br> ".$publisher_name.' <br>'.$published_date.'<br> '.$body_copy_press_release;exit;
//$location = get_the_terms($post->ID, 'locations');
//$year = get_the_terms($post->ID, 'press-room-year');
//$short_description = get_the_excerpt($post->ID);


?>
<div class="content-section section-space">
    <div class="container fluid-width">
        <div class="row">
            <div class="col col8 align-content-center single-detail">
                <a class="sidebar-head" href="<?php echo site_url(); ?>/the-lalit-insight/"> <strong> <i class="ico-sprite sprite size-12 ico-gre-left-arrow"></i> Back to Listing</strong></a>
                <ul class="date-info">
                    <li>The Lalit Insights </li>
                    <li><?php echo $published_date; ?></li>
                </ul>
                <h3><?php echo $insight_title; ?></h3>
                <div class="social-share">
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
                <?php if (trim($body_copy) != '') {
                    echo $body_copy;
                } ?>

                <?php
                if ($path != '') {
                    if ($path[1] == 'pdf') {
                ?>
                        <p><a href="<?php echo $article_or_file; ?>" target="_blank" class="text-link">Download Pdf <i class="ico-sprite sprite ico-red-right-arrow"></i></a></p>
                <?php
                    }
                }
                ?>


                <?php
                /*if($embed_code != '')
                    {
                    ?>
                        <div class="video_embed">
                            <?php echo $embed_code; ?>
                        </div>
                    <?php
                    }*/
                ?>


                <?php

                if ($path != '') {
                    if ($path[1] != 'pdf') {
                ?>
                        <img src="<?php echo $article_or_file; ?>">
                <?php
                    }
                }
                ?>

            </div>
        </div>
        <div class="single-full-width">
            <div class="row">
                <div class="col col8 align-content-center">

                    <h3>About The LaLiT Hotels</h3>
                    <!-- <p>The Lalit Suri Hospitality Group, an enterprise of Bharat Hotels Limited is India’s largest and the fastest growing privately owned Hotel Company. The company offers Seventeen luxury hotels, with 3600 rooms in the five-star deluxe segment with eleven operational hotels and six under development/restoration (including three overseas). The operational hotels include The Lalit New Delhi, The Lalit Mumbai, The Lalit Grand Palace Srinagar, The Lalit Golf & Spa Resort Goa, The Lalit Ashok Bangalore, The Lalit Laxmi Vilas Palace Udaipur, The Lalit Temple View Khajuraho, The Lalit Resort & Spa Bekal (Kerala), The Lalit Jaipur, The Lalit Chandigarh & The Lalit Great Eastern Kolkata.
                    The Group has also forayed into mid-segment hotels under the brand – ‘The Lalit Traveller’. <!-- The first two hotels under this brand opened in Jaipur and Khajuraho with 25 more hotels planned in the next five years. </p> -->
                    <p>
                        Headquartered in New Delhi, the company opened its first hotel here in 1988 under the dynamic leadership of Founder Chairman Mr. Lalit Suri, who spearheaded the Group’s unprecedented expansion plans.
                    </p>
                    <p>
                        Rapid expansion and consolidation of its leadership position continues under the enterprising stewardship of Dr. Jyotsna Suri, who took over as Chairperson & Managing Director in 2006.
                    </p>
                    <p>
                        All hotels within the group operated under the brand The Grand – Hotels, Palaces & Resorts. It was re-branded as ‘The LaLiT’ on November 19, 2008 as a tribute to the company’s Founder Chairman Mr. Lalit Suri.
                    </p>
                    <p>
                        The company offers twelve luxury Hotels, Places & Resorts and two mid market segment hotels under The LaLiT Traveller brand offering 2261 rooms.
                    </p>
                </div>
            </div>
        </div>
    </div>