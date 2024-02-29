<?php

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/press-releases/';
$itemList[1]['item']['name'] = 'Press Releases';

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = get_the_permalink(get_the_id());
$itemList[2]['item']['name'] = get_post_meta(get_the_id(), 'press_release_title', true);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
        </script>
        <style type="text/css">
            .ui-datepicker-trigger{
                display:none;
            }
        </style>
    </head>
    <body <?php body_class('global-page hide-sharing'); ?>>
        <div class="main-wrap">
            <?php get_header(); ?>
                <?php get_template_part( 'detail-pages/press-release', 'detail' ); ?>
            <?php get_footer(); ?>
        </div><!-- main-wrap -->
        <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58be9abe8e3c62001498dd2f&product=inline-share-buttons"></script>    
    </body>    
</html>   





