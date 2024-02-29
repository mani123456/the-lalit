<?php
if ($GLOBALS['$destinations']) {
    $destination_obj = $GLOBALS['$destinations'];
} else {
    $destination_obj = get_destination_object();
}

$des_images = array();

$hotel_types = array();
$hotel_interests = array();

if ($destination_obj->have_posts()) :

    $c = 0;
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
        $types = get_the_terms($post->ID, 'types');
        if ($types) {
            foreach ($types as $type) {
                $hotel_types[$c]['id'] = $type->term_id;
                $hotel_types[$c]['name'] = $type->name;
                $hotel_types[$c]['slug'] = $type->slug;
                $c++;
            }
        }
    endwhile;

    $c1 = 0;
    while ($destination_obj->have_posts()) : $destination_obj->the_post();
        $interests = get_the_terms($post->ID, 'interests');
        if ($interests) {
            foreach ($interests as $interest) {
                $hotel_interests[$c1]['id'] = $interest->term_id;
                $hotel_interests[$c1]['name'] = $interest->name;
                $hotel_interests[$c1]['slug'] = $interest->slug;
                $c1++;
            }
        }
    endwhile;

    $filter_list = array();
    $hotel_types  = array_unique($hotel_types, SORT_REGULAR);
    $hotel_interests  = array_unique($hotel_interests, SORT_REGULAR);

    $filter_list = array_merge($hotel_types, $hotel_interests);
?>
    <div class="container fluid-width  view-port-detect container-shadow section-space" id="pick-destination" >
        <div class="row clearfix">
            <?php
            if (!$GLOBALS['page-name'] && !$GLOBALS['page-name'] == 'find-a-hotel') {
            ?>
                <h2 class="sec-title align-center page-title-home">Popular Destinations</h2>
                <!--<h4 class="intro-sec-title align-center margin-bottom50">From 13 Extraordinary Destinations in India &nbsp; United Kingdom - From 13 Extraordinary Destinations</h4>-->
            <?php
            }
            ?>
            <ul class="unstyled-listing filter-box filter-tab align-center">
                <li class="filter-item"><strong></strong></li>
                <?php
                if ($hotel_types && count($hotel_types) > 0) {
                ?>
                    <li class="filter-item filter-list"><a class="selected_value">Type <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                        <div class="sub-menu">
                            <div class="row" style="display: block;">
                                <div class="col col12">
                                    <ul class="unstyled-listing list" id="types">
                                        <li class="list-item nav-item all"><a href="all">All Types</a></li>
                                        <?php
                                        foreach ($hotel_types as $types) {
                                        ?>
                                            <li class="list-item nav-item <?php echo $types['slug']; ?>"><a href="<?php echo $types['slug']; ?>"><?php echo $types['name']; ?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul><!-- unstyled-listing -->
                                </div><!-- col -->
                            </div><!-- row -->
                        </div><!-- sub-menu -->
                    </li>
                <?php
                }

                if ($hotel_interests && count($hotel_interests) > 0) {
                ?>
                    <li class="filter-item filter-list"><a class="selected_value">Interest <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                        <div class="sub-menu">
                            <div class="row" style="display: block;">
                                <div class="col col12">
                                    <ul class="unstyled-listing list" id="interests">
                                        <li class="list-item nav-item all"><a href="all">All Interests</a></li>
                                        <?php
                                        foreach ($hotel_interests as $interests) {
                                        ?>
                                            <li class="list-item nav-item <?php echo $interests['slug']; ?>"><a href="<?php echo $interests['slug']; ?>"><?php echo $interests['name']; ?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul><!-- unstyled-listing -->
                                </div><!-- col -->
                            </div><!-- row -->
                        </div><!-- sub-menu -->
                    </li>
                <?php
                }
                ?>
            </ul><!-- filter-tab -->


            <div class="row hotels-listing">
                <ul class="hotels-list">
                    <?php

                    while ($destination_obj->have_posts()) : $destination_obj->the_post();

                        $title = get_the_title($post->ID);
                        $image_id = get_post_meta($post->ID, 'property_image', true);
                        if (isMobile()) {
                            $image = wp_get_attachment_image_src($image_id, 'box_image')[0];
                        } else {
                            $image = wp_get_attachment_url($image_id);
                        }
                        //$image = wp_get_attachment_url($image_id);
                        $location = get_the_terms($post->ID, 'locations');
                        $city_name = $location[0]->slug;
                        $permalink = site_url() . '/the-lalit-' . $city_name . '/';

                        $class = '';
                        $destination_type = get_the_terms($post->ID, 'types');
                        if ($destination_type) {
                            foreach ($destination_type as $type) {
                                $class .= $type->slug . ' ';
                            }
                        }
                        $destination_interest = get_the_terms($post->ID, 'interests');
                        if ($destination_interest) {
                            foreach ($destination_interest as $interest) {
                                $class .= $interest->slug . ' ';
                            }
                        }

                        $class = rtrim($class, ' ');
                    ?>
                    <?php
                    if($city_name!='london')
                    {
                        ?>
                        <li class="colZero col3 hotel">
                            <a href="<?php echo $permalink; ?>" class="hotels-block <?php echo $class; ?>">
                                <?php
                                if ($image != '') {
                                ?>
                                    <div class="hotel-img-Block hotel-img background-color">
                                        <img data-src="<?php echo $image; ?>" src="" alt="" class="des-images js_image_load image-tag" />
                                    </div><!-- hotel-img-Block -->

                                <?php
                                }
                                ?>
                                <h3 class="item-title"><?php echo $location[0]->name; ?></h3>
                            </a>
                        </li>

                    <?php
                    }
                    endwhile;
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php

endif;
wp_reset_postdata();
?>