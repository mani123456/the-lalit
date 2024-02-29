<?php
global $woocommerce;
// print_r($post->ID);
$we_care_name = get_post_meta($post->ID, 'name', true);
$we_care_sub_title =  get_post_meta($post->ID, "sub_title", true);
$we_care_related_product_item = get_post_meta($post->ID, "related_product_item", true);
// print_r($we_care_related_product_item);
$we_care_images = get_post_meta($post->ID, "images", true);
$we_care_video_id = get_post_meta($post->ID, "course_video", true);
$we_care_video = wp_get_attachment_url($we_care_video_id);
$course_video_link = get_post_meta($post->ID, "course_video_link", true);

// print_r($we_care_video);
// print_r(the_field('course_video'));
// $we_care_video = the_field('course_video'); // get_post_meta($post->ID, "course_video", true);

// $we_care_video = wp_get_attachment_image_src($we_care_video)[0];
$we_care_summary = get_post_meta($post->ID, "course_summary", true);
$we_care_description = wpautop(get_post_meta($post->ID, "description", true));
$we_care_contact = get_post_meta($post->ID, "contact", true);
$we_care_ratings = get_post_meta($post->ID, "rating", true);
$we_care_ratings_total = get_post_meta($post->ID, "ratings_total", true);
$we_care_main_banner_image_id = get_post_meta($post->ID, "main_banner_image", true);
$we_care_main_banner_image = wp_get_attachment_url($we_care_main_banner_image_id);

$we_care_detail_banner_image_id = get_post_meta($post->ID, "detail_banner_image", true);
// print_r($we_care_detail_banner_image_id);
$we_care_detail_banner_image = wp_get_attachment_url($we_care_detail_banner_image_id);
if ($we_care_detail_banner_image == '') {
    $we_care_detail_banner_image = $we_care_main_banner_image;
}

// print_r($we_care_detail_banner_image);
$we_care_course_video = get_post_meta($post->ID, "course_video", true);
$we_care_images = get_post_meta($post->ID, "", true);

$we_care_description = get_post_meta($post->ID, "description", true);
$we_care_skill_detail = get_post_meta($post->ID, "skill_detail", true);
$we_care_duration = get_post_meta($post->ID, "duration", true);
$we_care_course_language = get_post_meta($post->ID, "course_language", true);
$we_care_contact = get_post_meta($post->ID, "contact", true);
$we_care_is_featured = get_post_meta($post->ID, "is_featured", true);
$we_care_syllabus_title = get_post_meta($post->ID, "syllabus_title", true);
$we_care_syllabus_summary = get_post_meta($post->ID, "syllabus_summary", true);
$we_care_instructor_title = get_post_meta($post->ID, "instructor_title", true);
$we_care_instructor_detail = get_post_meta($post->ID, "instructor_detail", true);
$we_care_instructor_profile_image_id = get_post_meta($post->ID, "instructor_profile_image", true);
$we_care_instructor_profile_image = wp_get_attachment_url($we_care_instructor_profile_image_id);
// print_r($we_care_instructor_profile_image);
$we_care_review_user_1 = get_post_meta($post->ID, "review_user_1", true);
$we_care_review_rating_1 = get_post_meta($post->ID, "review_rating_1", true);
$we_care_review_detail_1 = get_post_meta($post->ID, "review_detail_1", true);
$we_care_review_user_2 = get_post_meta($post->ID, "review_user_2", true);
$we_care_review_rating_2 = get_post_meta($post->ID, "review_rating_2", true);
$we_care_review_detail_2 = get_post_meta($post->ID, "review_detail_2", true);
$we_care_faq_question_1 = get_post_meta($post->ID, "faq_question_1", true);
$we_care_faq_answer_1 = get_post_meta($post->ID, "faq_answer_1", true);
$we_care_faq_question_2 = get_post_meta($post->ID, "faq_question_2", true);
$we_care_faq_answer_2 = get_post_meta($post->ID, "faq_answer_2", true);
$we_care_faq_question_3 = get_post_meta($post->ID, "faq_question_3", true);
$we_care_faq_answer_3 = get_post_meta($post->ID, "faq_answer_3", true);

session_start();
$_SESSION['training-course-flag'] = 'y';
$_SESSION['training-course-name'] = $we_care_name;
$_SESSION['training-course-id'] = $post->ID;




$res_types = '';
if (get_post_status($post->ID) == 'publish') {
    $types = get_the_terms($post->ID, 'training_course-type');
    foreach ($types as $type) {
        if ($type->parent != 0) {
            $res_types .= $type->name . ', ';
        }
    }
}

$res_types = rtrim($res_types, ', ');
wp_reset_postdata();

$image_array = array();
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
 -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous"></script> -->
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>

<div class="course-detail-section">
    <div class="auto-container">
        <div class="upper-content container item-listing">
            <div class="row">
                <style type="text/css">
                    .services-dtl-info-block li {
                        font-size: 1.4em;
                        line-height: 1.2857142857142856em;
                        color: #666;
                        letter-spacing: 0.2px;
                        font-weight: 300;
                    }

                    @media only screen and (max-width: 768px) {
                        .course-detail-section .upper-content .right-column .buttons-box .theme-btn {
                            max-width: 100%;
                        }
                    }

                    .tabs-nav {
                        list-style: none;
                        margin: 0;
                        padding: 0;
                    }

                    .tabs-nav li:first-child a {
                        border-right: 0;
                        -moz-border-radius-topleft: 6px;
                        -webkit-border-top-left-radius: 6px;
                        border-top-left-radius: 6px;
                    }

                    .tabs-nav .tab-active a {
                        background: hsl(0, 100%, 100%);
                        border-bottom-color: hsla(0, 0%, 0%, 0);
                        color: #db2128;
                        cursor: default;
                    }

                    .tabs-nav a {
                        background: hsl(120, 11%, 96%);
                        /* border: 1px solid hsl(210, 6%, 79%); */
                        color: hsl(215, 6%, 57%);
                        display: block;
                        font-size: 11px;
                        font-weight: bold;
                        height: 40px;
                        line-height: 44px;
                        text-align: center;
                        text-transform: uppercase;
                        width: 159px;
                    }

                    .tabs-nav li {
                        float: left;
                    }

                    .tabs-stage {
                        /* border: 1px solid hsl(210, 6%, 79%); */
                        -webkit-border-radius: 0 0 6px 6px;
                        -moz-border-radius: 0 0 6px 6px;
                        -ms-border-radius: 0 0 6px 6px;
                        -o-border-radius: 0 0 6px 6px;
                        border-radius: 0 0 6px 6px;
                        border-top: 0;
                        clear: both;
                        margin-bottom: 20px;
                        position: relative;
                        /* top: -1px; */
                        /* width: 281px; */
                    }

                    .tabs-stage p {
                        margin: 0;
                        padding: 6px;
                        color: hsl(0, 0%, 33%);
                    }

                    .videos img {
                        width: 100%;
                        height: auto;
                    }

                    a.video {
                        float: left;
                        position: relative;
                    }

                    a.video span {
                        width: 100%;
                        height: 100%;
                        position: absolute;
                        background: url("../path-to-your-image/play-btn.png") no-repeat;
                        background-position: 50% 50%;
                        background-size: 300%;
                    }

                    @media screen and (max-width: 480px) {
                        a.video span {
                            background-size: 400%;
                        }
                    }
                </style>
                <script type="text/javascript">
                    $(document).ready(function() {
                        // Change tab class and display content
                        $('.tabs-nav a').on('click', function(event) {
                            event.preventDefault();
                            $('.tab-active').removeClass('tab-active');
                            $(this).parent().addClass('tab-active');
                            $('.tabs-stage .tab').hide();
                            $($(this).attr('href')).show();
                        });

                        $('.tabs-nav a:first').trigger('click'); // Default
                    })
                </script>

            </div>
            <!-- <div class="row">
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".acc-content").hide();
                        $(".acc-toggler").on("click", function(e) {
                            var accContent = $(this).next(".acc-content");
                            $(".acc-content").not(accContent).slideUp();
                            accContent.slideToggle();
                        });
                    })
                </script>
                <style>
                    .acc-toggler {
                        padding: 10px 12px;
                        border-bottom: 1px solid #ccc;
                        background: #ddd;
                        cursor: pointer;
                    }

                    .acc-content {
                        padding: 10px 12px;
                        background: #eee;
                    }
                </style>
                <div>
                    <h3 class="acc-toggler">Accordion 1</h3>
                    <div class="acc-content">Text Content 1</div>
                    <h3 class="acc-toggler">Accordion 2</h3>
                    <div class="acc-content">Text Content 2</div>
                    <h3 class="acc-toggler">Accordion 3</h3>
                    <div class="acc-content">Text Content 3</div>
                </div>
            </div> -->
            <div class="row clearfix">
                <div class="left-column col-lg-12 col-md-12 col-sm-12  col-xs-12">
                    <div class="detail-breadcrumb-container">
                        <a class="detail-breadcrumb-link" href="/all-courses/">All Courses</a>
                        <span class="breadcrumb-separator"></span>
                        <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $we_care_name; ?></a>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!-- Left Column -->
                <div class="left-column col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <!-- <a href="#" class="btn btn-default" data-toggle="modal" data-target="#videoModal" data-theVideo="//player.vimeo.com/video/134818083"><img src="http://i.vimeocdn.com/video/528480182_200x150.webp" /></a>
                        <?php if (get_field('slider_video')) : ?>
                            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <div>
                                                <iframe width="100%" height="350" src=""></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?> -->
                        <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script> -->
                        <script>
                            $(document).ready(function() {
                                (function($) {

                                    $.fn.VideoPopUp = function(options) {

                                        var defaults = {
                                            backgroundColor: "#000000",
                                            opener: "video_course",
                                            maxweight: "340",
                                            idvideo: "v1Inner",
                                            pausevideo: true
                                        };

                                        var patter = this.attr('id');

                                        var settings = $.extend({}, defaults, options);

                                        var video = document.getElementById(settings.idvideo);

                                        function stopVideo() {
                                            video.pause();
                                            video.currentTime = 0;
                                        }
                                        $('#' + patter + '').css("display", "none");
                                        $('#' + patter + '').append('<div id="opct"></div>');
                                        $('#opct').css("background", settings.backgroundColor);
                                        $('#' + patter + '').css("z-index", "100001");
                                        $('#' + patter + '').css("position", "fixed")
                                        $('#' + patter + '').css("top", "0");
                                        $('#' + patter + '').css("bottom", "0");
                                        $('#' + patter + '').css("right", "0");
                                        $('#' + patter + '').css("left", "0");
                                        $('#' + patter + '').css("padding", "auto");
                                        $('#' + patter + '').css("text-align", "center");
                                        $('#' + patter + '').css("background", "none");
                                        $('#' + patter + '').css("vertical-align", "vertical-align");
                                        $("#videCont").css("z-index", "100002");
                                        $('#' + patter + '').append('<div id="closer_videopopup">&otimes;</div>');
                                        $("#" + settings.opener + "").on('click', function() {
                                            $('#' + patter + "").show();
                                            $('#' + settings.idvideo + '').trigger('play');

                                        });
                                        $("#closer_videopopup").on('click', function() {
                                            if (settings.pausevideo == true) {
                                                $('#' + settings.idvideo + '').trigger('pause');
                                            } else {
                                                stopVideo();
                                            }
                                            $('#' + patter + "").hide();
                                        });
                                        return this.css({

                                        });
                                    };

                                }(jQuery));

                                $(function() {
                                    $('#vidBox').VideoPopUp({
                                        backgroundColor: "#17212a",
                                        opener: "video_course",
                                        maxweight: "340",
                                        idvideo: "v1Inner",
                                        pausevideo: true
                                    });
                                });
                            })
                        </script>
                        <link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/Responsive-HTML5-Video-Popup-Plugin-With-jQuery-videopopup-js/css/videopopup.css" media="screen" />
                        <!-- Video Box -->
                        <div class="intro-video img" style="background-image: url(<?php if ($we_care_detail_banner_image != '') echo $we_care_detail_banner_image;
                                                                                    else echo '/wp-content/themes/lalit/images/teach-course.jpg'; ?>)">
                            <?php
                            if ($we_care_name != '' && $we_care_video != '') {
                            ?>
                                <a href="javascript:void(0)" id="video_course" class="lightbox-image intro-video-box"><img src="/wp-content/themes/lalit/images/play-button-arrowhead.svg" style="vertical-align: middle;" alt="" width="50px" height="50px"></a>
                                <h4>Preview this course</h4>
                            <?php } ?>
                            <?php
                            if ($we_care_name != '' && $course_video_link != '') {
                            ?>
                                <a href="javascript:void(0)" id="video_course" class="lightbox-image intro-video-box">
                                    <img src="/wp-content/themes/lalit/images/play-button-arrowhead.svg" style="vertical-align: middle;" alt="" width="50px" height="50px">
                                </a>
                                <h4>Preview this course</h4>
                            <?php } ?>
                        </div>
                        <?php
                        if ($we_care_name != '' && $we_care_video != '') {
                        ?>
                            <div id="vidBox" style="display:none;">
                                <div id="videCont">
                                    <video autoplay id="v1Inner" preload="none" controls controlsList="nodownload">>
                                        <source src="<?php echo $we_care_video; ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if ($course_video_link != '') {
                        ?>
                            <!--  <div id="vidBox" style="display:none;">
                                <iframe src="" data="<?php echo $course_video_link; ?>" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
                            </div> -->
                            <div id="vidBox" style="display:none;">
                                <div id="videCont">
                                    <div id="yt_video">
                                        <iframe id="v1Inner" allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/D9cmyJCgw7g"></iframe>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-column col-lg-7 col-md-7 col-sm-12">
                    <div class="inner-column">
                        <div class="services-dtl-info-block">
                            <?php
                            if ($we_care_name != '') {
                                // print_r($course_video_link);
                            ?>
                                <h2 class="m-r-1 m-b-0 bold headline-4-text"><span class="bdr-bottom-gold"><?php echo $we_care_name; ?></span></h2>
                            <?php } ?>
                            <?php
                            if ($we_care_summary != '') {
                            ?>
                                <p class="intro-text" style="margin-top:20px;">
                                    <?php echo $we_care_summary; ?>
                                </p>
                            <?php
                            }
                            ?>
                        </div><!-- services-dtl-info-block -->
                        <!-- <div class="sub-text">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                            fugit.</div> -->
                        <?php
                        if ($we_care_ratings != '') {
                        ?>
                            <div class="rating"><span class="rate"><?php echo $we_care_ratings; ?> <i class="fa fa-star"></i></span><span class="total-rating"><?php echo $we_care_ratings_total; ?> Ratings</span></div>
                        <?php } ?>
                        <!-- Course Detail Info Boxed -->
                        <?php if ($we_care_instructor_title != '') { ?>
                            <div class="course-detail-info-boxed">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <!-- <div class="follow"><a href="#">By: &nbsp;</a></div> -->
                                        <div class="author">
                                            <div class="user-image">
                                                <?php
                                                if ($we_care_instructor_profile_image != '') {
                                                ?>
                                                    <img src="<?php echo $we_care_instructor_profile_image; ?>" alt="">
                                                <?php } ?>
                                            </div>
                                            <?php
                                            if ($we_care_instructor_title != '') {
                                            ?>
                                                <?php echo $we_care_instructor_title; ?>
                                            <?php } ?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if ($we_care_related_product_item != '' && count($we_care_related_product_item) > 0) {
                            $_product = wc_get_product($we_care_related_product_item[0]);
                            if ($_product != '') {
                        ?>
                                <div class="price">Course Price: <span>INR <?php echo $_product->get_regular_price(); ?></span></div>
                        <?php
                            }
                        } ?>
                        <div class="row">
                            <div class="right-column col-lg-8 col-md-12 col-sm-12">
                                <!-- End Course Detail Info Boxed -->
                                <div class="buttons-box">
                                    <a href="/my-account/?action=register" class="theme-btn btn-style-two checkout-button cart-checkout-button button alt wc-forward"><span class="txt">Register </span></a>
                                    <?php
                                    if ($we_care_related_product_item != '' && count($we_care_related_product_item) > 0) {
                                    ?>
                                        <a href="/cart/?add-to-cart=<?php echo $we_care_related_product_item[0] ?>" class="theme-btn btn-style-one checkout-button cart-checkout-button button alt wc-forward"><span class="txt">Add To Cart</span></a>
                                        <!-- <a href="/checkout/?add-to-cart=<?php echo $we_care_related_product_item[0] ?>" class="theme-btn btn-style-one checkout-button cart-checkout-button button alt wc-forward"><span class="txt">Buy Now</span></a> -->
                                    <?php } ?>
                                    <!-- <?php
                                            /* $shortcodetoadd = '[add_to_cart id="' . $we_care_related_product_item[0] . '"]';
                            // print_r($shortcodetoadd);
                            echo do_shortcode($shortcodetoadd); */
                                            ?> -->

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Course Detail Info Boxed -->
            <!-- <div class="course-detail-info-boxed">
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="follow"><a href="#">By: &nbsp;</a></div>
                                <div class="author">
                                    <div class="user-image"><img src="<?php echo $we_care_instructor_profile_image; ?>" alt=""></div><?php echo $we_care_instructor_detail; ?>
                                </div>

                            </div>
                            <!-- <div class="pull-right">
                                <ul class="social-box">
                                    <li class="share">Share now on</li>
                                    <li class="facebook"><a href="#" class="fa fa-facebook"></a></li>
                                    <li class="google"><a href="#" class="fa fa-google"></a></li>
                                    <li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
            <!-- End Course Detail Info Boxed -->

        </div>

        <!-- Lower Content -->
        <div class="lower-content container ">
            <!-- <ul class="tabs-nav">
                <li class=""><a href="#tab-1" rel="nofollow">Features</a>
                </li>
                <li class="tab-active"><a href="#tab-2" rel="nofollow">Details</a>
                </li>
            </ul>
            <div class="tabs-stage">
                <div id="tab-1" style="display: none;">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec neque nisi, dictum aliquet lectus.</p>
                </div>
                <div id="tab-2" style="display: block;">
                    <p>Phasellus pharetra aliquet viverra. Donec scelerisque tincidunt diam, eu fringilla urna auctor at.</p>
                </div>
            </div> -->
            <!-- Instructor Info Tabs-->
            <div class="instructor-info-tabs row">
                <!-- Instructor Tabs-->
                <div class="instructor-tabs tabs-box">

                    <!-- Tab Btns -->
                    <ul class="clearfix tabs-nav">
                        <li data-tab="prod-about" class="tab-btn active-btn">
                            <a href="#prod-about" rel="nofollow">About</a>
                        </li>
                        <li data-tab="prod-about" class="tab-btn active-btn tab-active">
                            <a href="#prod-course" rel="nofollow">Course Content</a>
                        </li>
                        <?php
                        if ($we_care_instructor_title != '') {
                        ?>
                            <li data-tab="prod-about" class="tab-btn active-btn tab-active">
                                <a href="#course-instructor" rel="nofollow">Instructors</a>
                            </li>
                        <?php } ?>
                        <li data-tab="prod-about" class="tab-btn active-btn tab-active">
                            <a href="#prod-faq" rel="nofollow">Faq</a>
                        </li>
                        <!-- <li data-tab="#prod-course" class="tab-btn">Course Content</li>
                        <li data-tab="#course-instructor" class="tab-btn">Instructors</li>
                        <li data-tab="#prod-review" class="tab-btn">Reviews</li> 
                        <li data-tab="#prod-faq" class="tab-btn">Faq</li> -->
                    </ul>

                    <!-- Tabs Container -->
                    <div class=" tabs-stage">

                        <!-- Tab / Active Tab -->
                        <div class="tab" id="prod-about" style="display: none;">
                            <div class="content class-detail-content">
                                <div class="row">
                                    <div class="col col12 text-center">
                                        <h2 class="m-r-1 m-b-0 bold headline-4-text"><span class="bdr-bottom-gold">ABOUT</span></h2>
                                    </div>
                                </div>
                                <div class="row  tab-full-width">
                                    <div class="col col12">
                                        <div class="services-dtl-info-block" style="margin-top: 18px;">
                                            <?php
                                            if ($we_care_description != '') {
                                            ?>
                                                <p class="intro-text">
                                                    <?php echo apply_filters('the_content', $we_care_description); ?>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </div><!-- services-dtl-info-block -->
                                    </div><!-- col -->
                                </div><!-- row -->
                            </div>
                        </div>

                        <!-- Tab  -->
                        <div class="tab " id="prod-course" style="display: block;">
                            <div class="content class-detail-content">
                                <div class="row ">
                                    <div class="col col12 text-center">
                                        <h2 class="m-r-1 m-b-0 bold headline-4-text"><span class="bdr-bottom-gold">
                                                <?php
                                                if ($we_care_syllabus_title != '') {
                                                ?>
                                                    <?php echo apply_filters('the_content', $we_care_syllabus_title); ?>
                                                <?php } else { ?>
                                                    Course Content
                                                <?php } ?>
                                            </span></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col12">
                                        <div class="services-dtl-info-block" style="margin-top: 20px;">
                                            <?php
                                            if ($we_care_syllabus_summary != '') {
                                            ?>
                                                <p class="intro-text">
                                                    <?php echo apply_filters('the_content', $we_care_syllabus_summary); ?>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        </div><!-- services-dtl-info-block -->
                                    </div><!-- col -->
                                </div><!-- row -->
                            </div>
                        </div>
                        <?php if ($we_care_instructor_title != '') { ?>
                            <!-- Tab  -->
                            <div class="tab " id="course-instructor" style="display: block;">
                                <div class="content class-detail-content">
                                    <div class="row">
                                        <div class="col col12 text-center">
                                            <h2 class="m-r-1 m-b-0 bold headline-4-text"><span class="bdr-bottom-gold">
                                                    <?php
                                                    if ($we_care_instructor_title != '') {
                                                    ?>
                                                        <?php echo $we_care_instructor_title; ?>
                                                    <?php } ?>
                                                </span></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col3">
                                            <div class="author">
                                                <div class="user-image">
                                                    <?php
                                                    if ($we_care_instructor_profile_image != '') {
                                                    ?>
                                                        <img src="<?php echo $we_care_instructor_profile_image; ?>" alt="">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col9">
                                            <div class="services-dtl-info-block">
                                                <?php
                                                if ($we_care_instructor_detail != '') {
                                                ?>
                                                    <p class="intro-text">
                                                        <?php echo $we_care_instructor_detail; ?>
                                                    </p>
                                                <?php
                                                }
                                                ?>
                                            </div><!-- services-dtl-info-block -->
                                        </div><!-- col -->

                                    </div><!-- row -->
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Tab  -->
                        <div class="tab" id="prod-faq" style="display: block;">
                            <div class="content class-detail-content">
                                <style>
                                    .accordion {
                                        box-shadow: none;
                                        border: 0px;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col col12 text-center">
                                        <h2 class="m-r-1 m-b-0 bold headline-4-text"><span class="bdr-bottom-gold">FAQ</span></h2>
                                    </div>
                                </div>
                                <div class="row faq-box">
                                    <div class="col col12">
                                        <ul class="accordion accordion-2 one-open">
                                            <?php if ($we_care_faq_question_1 != '') { ?>
                                                <li class="active">
                                                    <div class="title">
                                                        <h4 class="inline-block mb0"><span class="sad"><?php echo $we_care_faq_question_1 ?></span></h4>
                                                    </div>
                                                    <div class="content">
                                                        <p><?php echo $we_care_faq_answer_1 ?></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <?php if ($we_care_faq_question_2 != '') { ?>
                                                <li class="active">
                                                    <div class="title">
                                                        <h4 class="inline-block mb0"><span class="sad"><?php echo $we_care_faq_question_2 ?></span></h4>
                                                    </div>
                                                    <div class="content">
                                                        <p><?php echo $we_care_faq_answer_2 ?></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <?php if ($we_care_faq_question_3 != '') { ?>
                                                <li class="active">
                                                    <div class="title">
                                                        <h4 class="inline-block mb0"><span class="sad"><?php echo $we_care_faq_question_3 ?></span></h4>
                                                    </div>
                                                    <div class="content">
                                                        <p><?php echo $we_care_faq_answer_3 ?></p>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- <div class="clearfix">
    <ul class="tabs wc-tabs detail-list-tab" role="tablist">
        <li class="detail-list-link-tab description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
            <a class="detail-tab-link" href="#tab-description">Description1</a></li>
        <li class="detail-list-link-tab description_tab" id="tab-title-description2" role="tab" aria-controls="tab-description2">
            <a class="detail-tab-link" href="#tab-description2">Description2</a></li>
    </ul>
    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="display: block;">
        <p>Mutton Rogan</p>
    </div>
    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description2" role="tabpanel" aria-labelledby="tab-title-description" style="display: none;">
        <p>Mutton dsdsdsdsd</p>
    </div>
</div> -->

<?php
$GLOBALS['image_array'] = $image_array;
?>