<?php

$media_coverage_title = get_post_meta($post->ID, 'media_coverage_title', true);
$body_copy = wpautop(get_post_meta($post->ID, 'body_copy', true));
//$publisher_logo = get_post_meta($post->ID,'publisher_logo',true);
//$publisher_logo = wp_get_attachment_url($publisher_logo);
$article_copy = get_post_meta($post->ID, 'article_copy', true);
$article_copy = wp_get_attachment_url($article_copy);
$publisher_url = get_post_meta($post->ID, 'publisher_url', true);
$published_date = get_post_meta($post->ID, 'published_date_media_coverage', true);
$publisher_name = get_post_meta($post->ID, 'publisher_name', true);


if ($published_date != '') {
    $published_date = date('j M Y', strtotime($published_date));
} else {
    $published_date = '';
}

if ($article_copy != '') {
    $url = parse_url($article_copy);
    $path = $url['path'];
    $path = explode('.', $path);
} else {
    $path = '';
}

/*if($published_date != '')
    {
        $published_date = date('j M Y',strtotime($published_date));
    }
    else
    {
        $published_date = '';
    }*/

if (trim($publisher_url) != '') {
    $parsed = parse_url($publisher_url);
    if (empty($parsed['scheme'])) {
        $publisher_url = 'http://' . ltrim($publisher_url, '/');
    }
}

//$location = get_the_terms($post->ID, 'locations');
//$year = get_the_terms($post->ID, 'press-room-year');
//$short_description = get_the_excerpt($post->ID);

?>
<div class="content-section section-space page-con detail-page">
    <div class="container fluid-width">
        <div class="row">
            <div class="col col8 align-content-center single-detail">
                <a class="sidebar-head" href="<?php echo site_url(); ?>/media-coverage/"> <strong> <i class="ico-sprite sprite size-12 ico-gre-left-arrow"></i> Back to Listing</strong></a>
                <ul class="date-info">
                    <li>Media Coverage </li>
                    <li><?php echo $published_date; ?>, <?php echo $publisher_name; ?></li>
                </ul>
                <h3><?php echo $media_coverage_title; ?></h3>
                <div class="social-share">
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
                <?php if (trim($body_copy) != '') { ?><?php echo $body_copy; ?><?php } ?>

                <div class="news-image-block">
                    <?php

                    if ($path != '') {
                        if ($path[1] == 'pdf') {
                    ?>
                            <p><a href="<?php echo $article_copy; ?>" target="_blank" class="text-link">Download Pdf <i class="ico-sprite sprite ico-red-right-arrow"></i></a></p>
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $article_copy; ?>" title="<?php echo $media_coverage_title; ?>" alt="<?php echo $media_coverage_title; ?>">
                    <?php
                        }
                    }
                    ?>
                </div>

                <?php

                if (trim($publisher_url) != '') {
                ?>
                    <a class="text-link" href="<?php echo $publisher_url; ?>" target="_blank">For More Information <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="single-full-width">
            <div class="row">
                <div class="col col8 align-content-center">
                    <h3>About The LaLiT Hotels</h3>
                    <!-- <p>The Lalit Suri Hospitality Group, an enterprise of Bharat Hotels Limited is India’s largest and the fastest growing privately owned Hotel Company. The company offers Seventeen luxury hotels, with 3600 rooms in the five-star deluxe segment with eleven operational hotels and six under development/restoration (including three overseas). The operational hotels include The Lalit New Delhi, The Lalit Mumbai, The Lalit Grand Palace Srinagar, The Lalit Golf & Spa Resort Goa, The Lalit Ashok Bangalore, The Lalit Laxmi Vilas Palace Udaipur, The Lalit Temple View Khajuraho, The Lalit Resort & Spa Bekal (Kerala), The Lalit Jaipur, The Lalit Chandigarh & The Lalit Great Eastern Kolkata.
                    The Group has also forayed into mid-segment hotels under the brand – ‘The Lalit Traveller’.<!--  The first two hotels under this brand opened in Jaipur and Khajuraho with 25 more hotels planned in the next five years.</p> -->
                    <p>
                        Headquartered in New Delhi, the company opened its first hotel here in 1988 under the dynamic leadership of Founder Chairman Mr. Lalit Suri, who spearheaded the Group’s unprecedented expansion plans.
                        <br />
                        Rapid expansion and consolidation of its leadership position continues under the enterprising stewardship of Dr. Jyotsna Suri, who took over as Chairperson & Managing Director in 2006.
                        <br />All hotels within the group operated under the brand The Grand – Hotels, Palaces & Resorts. It was re-branded as ‘The LaLiT’ on November 19, 2008 as a tribute to the company’s Founder Chairman Mr. Lalit Suri.
                        <br />The company offers twelve luxury Hotels, Places & Resorts and two mid market segment hotels under The LaLiT Traveller brand offering 2261 rooms.
                    </p>  
                </div>
            </div>
        </div>
    </div>
</div>
</div>