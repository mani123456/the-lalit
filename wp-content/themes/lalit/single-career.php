<?php

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/careers';
$itemList[1]['item']['name'] = 'Careers';

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url().'/careers/openings/';
$itemList[2]['item']['name'] = 'Openings';

$itemList[3]['@type'] = 'ListItem';
$itemList[3]['position'] = $position + 3;
$itemList[3]['item']['@id'] = get_the_permalink(get_the_id());
$itemList[3]['item']['name'] = get_the_title(get_the_id());
?>
?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
    </head>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": <?php echo json_encode($itemList); ?>
    }
    </script>
    <body <?php body_class('global-page hide-sharing'); ?>>
        <div class="main-wrap">
            <?php get_header(); ?>

                <?php get_template_part( 'detail-pages/careers', 'detail' ); ?>

            <?php get_footer(); ?>
        </div>
        <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58be9abe8e3c62001498dd2f&product=inline-share-buttons"></script>
    </body>
</html>