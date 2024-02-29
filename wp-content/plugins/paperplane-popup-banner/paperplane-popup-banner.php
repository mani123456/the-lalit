<?php
/*
    Plugin Name: Cookie PopUp Banner
    Description: Plugin to display cookie popup banner
    Version: 1.0
    Author: The PaperPlane Team
    License: GPL2
   */


register_activation_hook(__FILE__, 'paperplane_show_cookie_popup');
function paperplane_show_cookie_popup()
{

    paperplane_add_cookie_popup_markup();
    the_lalit_register_popup_styles();
}

register_deactivation_hook(__FILE__, 'paperplane_hide_cookie_popup');
function paperplane_hide_cookie_popup()
{

    remove_action('wp_footer', 'paperplane_add_cookie_popup_markup', 10);
    wp_deregister_style('popup_banner_stylesheet');
    wp_dequeue_style('popup_banner_stylesheet');
    remove_action('wp_enqueue_scripts', 'the_lalit_register_popup_styles', 9);
}


function paperplane_add_cookie_popup_markup()
{

    if ($_COOKIE['popUpBannerShown'] != '1') {
?>
        <div id="pp-cookie-banner-container" class="cookies-section" style="display: block;">
            <div class="cookies-container">
                <div class="cookies-row clearfix">
                    <div class="cookies-description-section">
                        <span class="cookies-description">
                            <?php
                            if (isMobile()) {
                            ?>
                                We use cookies to enhance your website experience. See our <a href="/privacy-policy/" class="cookies-link">Privacy Policy</a>.</span>
                           <?php
} else {
?>
 We use cookies to enhance your website experience. By continuing to use this site,
                                you accept these cookies. See our <a href="/privacy-policy/" class="cookies-link">Privacy Policy</a> for more information on cookies and how to manage them.</span>
<?php } ?>

                    </div>
                    <div class="cookies-close-section">
                        <a onclick="closeCookieBanner()" href="javascript:void(0);" class="cookies-close"></a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function closeCookieBanner() {

                var cookieBannerContainer = document.getElementById('pp-cookie-banner-container');
                cookieBannerContainer.style.display = 'none';
                theLalitSetCookie();
                return false;
            }

            function theLalitSetCookie() {

                var exdate = new Date();
                var c_name = "popUpBannerShown";
                var c_value = "1";
                document.cookie = c_name + "=" + c_value + "; path=/";
            }
        </script>
<?php
    }
}
add_action('wp_footer', 'paperplane_add_cookie_popup_markup', 10);

function the_lalit_register_popup_styles()
{

    if ($_COOKIE['popUpBannerShown'] != '1' && (function_exists('is_amp_endpoint') &&  !is_amp_endpoint())) {

        wp_register_style('popup_banner_stylesheet', plugins_url('/css/style.css', __FILE__));
        wp_enqueue_style('popup_banner_stylesheet');
    }
}
add_action('wp_enqueue_scripts', 'the_lalit_register_popup_styles', 9);
?>