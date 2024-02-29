<!DOCTYPE html>
<html>
    <head>
        <title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
    </head>
    <body <?php body_class('global-page hide-sharing'); ?>>
        <div class="main-wrap">
            <?php get_header(); ?>

                <?php get_template_part( 'detail-pages/careers', 'detail' ); ?>

            <?php get_footer(); ?>
        </div>
        <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58be9abe8e3c62001498dd2f&product=inline-share-buttons"></script>
    </body>
</html>