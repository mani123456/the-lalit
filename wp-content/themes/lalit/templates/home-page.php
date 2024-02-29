<?php

/**
 *
  Template Name: Home Page
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Paper_Plane
 * @since PaperPlane 1.0
 */

$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url() . '/';
$itemList[0]['item']['name'] = 'Home';
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
        #container {
            width: 80%;
            margin: auto;
        }

        .item {
            /*background: rgb(135, 199, 135);width: 320px;height: 320px;*/
        }

        .ui-datepicker-today .ui-state-default {
            font-weight: bold;
        }

        #ui-datepicker-div button.ui-datepicker-current {
            display: none;
        }
    </style>
</head>

<body <?php body_class('lalit-booking-widget global-page'); ?>>
    <div class="main-wrap">
        <?php get_header(); ?>

        <?php get_template_part('template-parts/home', 'landing'); ?>

        <?php get_footer(); ?>
    </div>
    <script type="text/javascript" async>
        var is_iPad = navigator.userAgent.match(/iPad/i) != null;
        var ismobile = navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
        var at_lalit_images = <?php echo json_encode($GLOBALS['at_the_lalit_images']); ?>;
        var lalit_loyalty_new_images = <?php echo json_encode($GLOBALS['lalit_loyalty_new_images']); ?>;
        var service_images = <?php echo json_encode($GLOBALS['hotel_service_image']); ?>;
        var banner_images = <?php echo json_encode($GLOBALS['banner_images']); ?>;
    </script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/home-page.min.js?ver=1.3" async></script>
</body>

</html>