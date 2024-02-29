<?php

/**
 *
  Template Name: About Us Template
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

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url() . '/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = get_the_title(get_the_id());
?>
<!DOCTYPE html>
<html>

<head>
    <?php wp_head(); ?>
    <?php get_template_part('includes/css', 'js'); ?>
    <style type="text/css">
        .ui-datepicker-trigger {
            display: none;
        }
    </style>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
    </script>
</head>

<body <?php body_class('global-page'); ?>>
    <div class="main-wrap">
        <?php get_header(); ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="content-section">
                <?php

                $page_title = get_the_title();

                if ($page_title != 'Privacy Policy') {
                ?>
                    <div class="banner-slider align-center">
                        <div id="banner-slider" class="flexslider">
                            <ul class="slides">
                                <!--    <li>
                                                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2017/11/we-care.jpg" />  
                                                </li>   -->
                                <li>
                                    <img src="<?php echo home_url(); ?>/wp-content/themes/lalit/images/About-us-1.jpg" />
                                </li>
                                <li>
                                    <img src="<?php echo home_url(); ?>/wp-content/themes/lalit/images/About-us-2.jpeg" />
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="page-con">
                    <div class="container fullwidth js_fade section-space">
                        <div class="row">
                            <div class="page-heading">
                                <h2 class="card-info-title bdr-bottom">
                                    <span class="bdr-bottom-gold"><?php the_title(); ?></span>
                                </h2>
                            </div>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="container fluid-width" style="display:none;">
                        <div class="video-sec">
                            <div class="row">
                                <div class="col col6 align-content-center">
                                    <a href="javascript:void(0)" class="video-thumb" title="Lalit Suri - I Did It My Way"><span class="video-play-btn"><i class="ico-sprite sprite ico-play-in-white"></i></span><img src="/wp-content/themes/lalit/images/i-did-it-myway.jpg" alt="Lalit Suri - I Did It My Way"></a>
                                    <iframe style="display: none;" width="560" height="315" class="video-block" src="" data="https://www.youtube.com/embed/x_9LZYQKarc?rel=0&autohide=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>
                                </div><!-- col -->
                            </div><!-- row -->
                        </div><!-- video-sec -->
                    </div><!-- container -->
                </div>
            </div>
            <!--content-section-->
        <?php endwhile; ?>
        <?php get_footer(); ?>
    </div><!-- main-wrap -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(".video-thumb").on('touchstart click', function() {
                var data = jQuery(this).next(".video-block").attr("data");
                jQuery(this).next(".video-block").attr("src", data);
                jQuery(this).css("display", "none");
                jQuery(this).next(".video-block").css("display", "block");

            });
        });
    </script>
</body>

</html>