<?php

/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();
$GLOBALS['$fooddelivery-url'] = "https://thelalit.dotpe.in";
$GLOBALS['$eLearning-url'] = "https://elearning.thelalit.com";
$GLOBALS['home-content-hide-flag'] = true;

$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);

$destinations = get_destination_object();
$GLOBALS['$destinations'] = $destinations;
$GLOBALS['$destinations_by_name'] = get_destination_object_by_name();

$GLOBALS['facebook'] = 'http://www.facebook.com/TheLaLitGroup';
$GLOBALS['twitter'] = 'http://twitter.com/TheLalitGroup';
$GLOBALS['instagram'] = 'http://instagram.com/thelalitgroup';
$GLOBALS['google'] = 'http://plus.google.com/u/0/116826386288801459694/';
// $GLOBALS['linkedin'] = 'https://www.linkedin.com/company/the-lalit-suri-hospitality-group';
$GLOBALS['linkedin'] = 'https://www.linkedin.com/company/thelalitgroup';
if ($destination_obj->have_posts()) {
	while ($destination_obj->have_posts()) {
		$destination_obj->the_post();
		$property_logo = get_post_meta($post->ID, 'property_logo', true);
		$GLOBALS['facebook'] = get_post_meta($post->ID, 'facebook', true);
		if (!$GLOBALS['facebook']) {
			$GLOBALS['facebook'] = '';
		}
		$GLOBALS['twitter'] = get_post_meta($post->ID, 'twitter', true);
		if (!$GLOBALS['twitter']) {
			$GLOBALS['twitter'] = '';
		}
		$GLOBALS['instagram'] = get_post_meta($post->ID, 'instagram', true);
		if (!$GLOBALS['instagram']) {
			$GLOBALS['instagram'] = '';
		}
		$GLOBALS['google'] = get_post_meta($post->ID, 'google', true);
		if (!$GLOBALS['google']) {
			$GLOBALS['google'] = '';
		}
		$GLOBALS['linkedin'] = get_post_meta($post->ID, 'linkedin', true);
		if (!$GLOBALS['linkedin']) {
			$GLOBALS['linkedin'] = '';
		}
	}
}
wp_reset_postdata();

$city_name = $GLOBALS['location'][0]->slug;
$locations_array = get_terms(array('taxonomy' => 'locations', 'hide_empty' => false));
$GLOBALS['locations_array'] = $locations_array;

$destination_types_array = array();
$destination_interest_array = array();

$c = 0;
$types = get_terms(array('taxonomy' => 'types', 'hide_empty' => true));
if ($types) {
	foreach ($types as $type) {
		$destination_types_array[$c]['id'] = $type->term_id;
		$destination_types_array[$c]['name'] = $type->name;
		$destination_types_array[$c]['slug'] = $type->slug;
		$c++;
	}
}


$c1 = 0;
$interests = get_terms(array('taxonomy' => 'interests', 'hide_empty' => true));
if ($interests) {
	foreach ($interests as $interest) {
		$destination_interest_array[$c1]['id'] = $interest->term_id;
		$destination_interest_array[$c1]['name'] = $interest->name;
		$destination_interest_array[$c1]['slug'] = $interest->slug;
		$c1++;
	}
}

$destination_types_array = array_unique($destination_types_array, SORT_REGULAR);
$destination_interest_array = array_unique($destination_interest_array, SORT_REGULAR);
?>

<?php
$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();
global $post;

if ((is_checkout() && !$current_endpoint) || $post->post_name == 'terms-conditions') {
	$woo_class = "hide";
} else {
	$woo_class = "";
}

?>
<style>
	.header-covid {
		background-color: #1c1c1c;
		padding: 5px;
		margin-top: 0px;
	}

	.container-covid {
		position: relative;
		margin: 0 auto;
		padding: 6px;
		max-width: 80rem;
		text-align: center;
	}

	.main-text-covid {
		color: #ffffff;
		font-family: sans-serif;
		font-size: 15px;
		font-weight: bold;
		padding-right: 5px;
	}

	.link-text-covid {
		color: #ffffff;
		font-family: sans-serif;
		font-size: 15px;
		font-weight: normal;
		padding-right: 5px;
		text-decoration: none;
	}

	.link-text-covid:hover {
		color: #db2128 !important;
		font-weight: bold;
	}

	.close-icon-covid {
		color: #ffffff;
		float: right;

		margin-top: 0px;
	}

	.fa-external-link-alt-covid {
		margin-left: 5px;
	}

	#panel-covid {
		display: block;
	}

	.fancybox-close-covid {
		top: 10px;
		right: 35px;
		font-size: 12px;
		background-position: -1.86em -3.44em;
	}

	.fancybox-close-covid:hover {
		color: #fff;
	}

	.bg-white {
		background-color: #fff !important;
	}

	.content-section {
		padding-top: 0px !important;
	}

	header .navbar-fixed {
		position: fixed;
		top: 0;
		width: 100%;
		/* height: 48px; */
		z-index: 8;
		opacity: 1;
	}

	.mobile-sticky {
		position: relative !important;
	}
</style>

<?php if ($city_name != '') { ?>
	<style>
		@media screen and (max-width: 992px) {
			.content-section {
				top: 60px;
			}

			.mobile-nav .quaternary-nav-section .nav-bar-fill {
				top: 0px;
			}
		}
	</style>
<?php } ?>

<div class="header-covid" id="panel-covid">
	<a href="#!" class="close-icon-covid fancybox-item fancybox-close fancybox-close-covid" onclick="myFunction()"><i class="fas fa-times"></i></a>
	<div class="container-covid">
		<!-- <span class="main-text-covid">Travel Information: </span> -->
		<a class="link-text-covid" href="<?php site_url() ?>/we-care-thelalit" target="_blank">We Care at The LaLiT<i class="fas fa-external-link-alt-covid"></i></a>
	</div>
</div>

<script>
	function myFunction() {
		document.getElementById("panel-covid").style.display = "none";
	}
</script>



<header>
	<input type="hidden" id="isHome" class="isHome" value="<?php echo (is_front_page()) ? true : false; ?>">
	<?php
	/*if(isMobile())
		{*/
	?>
	<div class="mobile-nav<?php if ($city_name != '') {
								echo  ' ' . $city_name;
							} ?>">
		<div class="container">
			<div class="mobile-sticky clearfix">
				<div class="logo-block h-card">
					<a href="#" id="trigger" class="menu-trigger <?php echo $woo_class; ?>"><i class="ico-sprite sprite size-32 ico-humbug ico-grey-close"></i></a>
					<a class="logo u-logo u-url<?php if ($city_name != '') {
													echo ' city-logo';
												} ?>" href="<?php if ($city_name != '') {
																echo '/the-lalit-' . $city_name . '/';
															} else {
																echo '/';
															} ?>" itemprop="url" title="<?php if ($city_name != '') {
																						} else {
																							echo 'The Lalit';
																						} ?>"><img src="<?php if ($city_name != '') {
																											echo wp_get_attachment_url($property_logo);
																										} else {
																											echo get_stylesheet_directory_uri() . '/images/head-logo.png';
																										} ?>" itemprop="logo" alt="The Lalit"></a>
				</div><!-- logo-block -->

				<div class="btn-block <?php echo $woo_class; ?>">
					<?php
					if ($city_name == 'londono') {
					?>
						<a href="<?php echo $GLOBALS['$fooddelivery-url']; ?>" class='food-global-icon'>
							<img src="/wp-content/themes/lalit/images/delivery-icon/food-delivery-icon.png" alt="" style="vertical-align: middle;" width="27px" height="27px" style="
    vertical-align: middle;
    padding-top: 6px;">
						</a>
					<?php } ?>
					<a href="#mobile-book-widget" class="btn tertiary-btn mobile-book-stay">Book A Stay</a>
					<?php
					if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
						$count = WC()->cart->cart_contents_count;
					?>
						<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
							<i class="ico-sprite sprite size-22 ico-cart"></i>
							<?php
							$cls = '';
							if ($count > 0) {
								$cls = 'cart-no';
							} else {
								$count = '';
							}
							?>
							<span class="<?php echo $cls; ?>"> <?php echo $count; ?> </span>
						</a>
					<?php
					}
					?>
				</div><!-- btn-block -->
			</div><!-- mobile-sticky -->

			<div class="<?php echo $woo_class; ?> container primary-nav<?php if ($city_name != '') {
																			echo ' local-nav';
																		} ?>">
				<div class="<?php if ($city_name != '') {
								echo ' local-global-nav';
							} else {
								echo '';
							} ?>">
					<nav class="nav horizontal align-right" style="display: none;">

						<ul class="primary-navigation">
							<?php
							if ($city_name == 'londono') {
							?>
								<li class="nav-item login-resigter-mob ">
									<!-- <h3 class='login-register-header mob-nav-head'>Food Delivery</h3> -->
									<div class="sub-menu">
										<div class="row">
											<article class="sub-menu-item">
												<a href="<?php echo $GLOBALS['$fooddelivery-url']; ?>" style="margin-top:40px;">Food Delivery</a>
											</article><!-- col -->
										</div><!-- row -->
									</div><!-- sub-menu -->
								</li>
							<?php } ?>
							<li class="nav-item login-resigter-mob " style="display: none;">
								<!-- <h3 class='login-register-header mob-nav-head'>Food Delivery</h3> -->
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item">
											<a href="<?php echo $GLOBALS['$eLearning-url']; ?>">eLearning</a>
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>

							<!-- <li class="nav-item offers>
								<a href="<?php site_url() ?>/food-delivery" class="nav-item find-a-hotel mob-click">Food Delivery</a>
							</li> -->
							<?php
							if (!$city_name) {
							?>
								<li class="nav-item ">
									<!-- <h3 class="mob-nav-head"> Plan an Event</h3> -->
									<div class="sub-menu">
										<div class="row">
											<article class="sub-menu-item">
												<!--<h6 class="sub-menu-title">Meetings & Events</h6>-->
												<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">Meetings &amp; Events <i class="ico-sprite sprite ico-small-right-black"></i></a>
												<div class="sub-menu-links-block sub-nav-menu-list">
													<a href="javascript:void(0);" class="back-link"><span class="nav-item">Meetings &amp; Events</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
													<div class="text-link-block">
														<div class="row">
															<ul class="unstyled-listing h-card">
																<?php
																$i = 1;
																$max_rows = 4;
																foreach ($locations_array as $locations_obj) {
																?>
																	<?php
																	//if ($locations_obj->slug != 'london') {
																	?>
																	<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-' . $locations_obj->slug . '/meetings-and-events/'; ?>"><?php echo $locations_obj->name; ?></a>
																	</li>
																	<?php //} 
																	?>
																	<?php
																	if ($i == $max_rows) {
																	?>
															</ul><!-- unstyled-listing -->
															<ul class="unstyled-listing">
														<?php

																		$i = 0;
																		$max_rows = 3;
																	}

																	$i++;
																}
														?>
															</ul><!-- unstyled-listing col col3 -->
														</div><!-- row  -->
													</div><!-- text-link-block -->
												</div><!-- sub-menu-links-block -->
											</article><!-- col -->
											<article class="sub-menu-item">
												<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">Weddings <i class="ico-sprite sprite ico-small-right-black"></i></a>
												<div class="sub-menu-links-block sub-nav-menu-list">
													<a href="javascript:void(0);" class="back-link"><span class="nav-item">Weddings</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>

													<div class="text-link-block weddings-block">
														<div class="row">
															<div class="">
																<div class="weddings-inner-block">
																	<h3 class="item-title">Beach Weddings</h3>
																	<ul class="unstyled-listing h-card">
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-goa/weddings/'; ?>" class="">Goa</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-bekal/weddings/'; ?>" class="">Bekal</a></li>
																	</ul><!-- unstyled-listing -->
																</div><!-- weddings-inner-block -->
															</div><!-- col4 -->

															<div class="">
																<div class="weddings-inner-block">
																	<h3 class="item-title">Regal Weddings</h3>
																	<ul class="unstyled-listing h-card">
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-udaipur/weddings/'; ?>" class="">Udaipur</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-jaipur/weddings/'; ?>" class="">Jaipur</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-srinagar/weddings/'; ?>" class="">Srinagar</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-khajuraho/weddings/'; ?>" class="">Khajuraho</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-kolkata/weddings/'; ?>" class="">Kolkata</a></li>
																	</ul><!-- unstyled-listing -->
																</div><!-- weddings-inner-block -->
															</div><!-- col4 -->

															<div class="">
																<div class="weddings-inner-block">
																	<h3 class="item-title">City Weddings</h3>
																	<ul class="unstyled-listing h-card">
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-delhi/weddings/'; ?>" class="">New Delhi</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-bangalore/weddings/'; ?>" class="">Bangalore</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-mumbai/weddings/'; ?>" class="">Mumbai</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-kolkata/weddings/'; ?>" class="">Kolkata</a></li>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-chandigarh/weddings/'; ?>" class="">Chandigarh</a></li>
																	</ul><!-- unstyled-listing -->
																</div><!-- weddings-inner-block -->
															</div><!-- col4 -->
														</div><!-- row -->
													</div><!-- text-link-block -->
												</div><!-- sub-menu-links-block -->
											</article><!-- col -->
										</div><!-- row -->
									</div><!-- sub-menu -->
								</li>
								<?php if ($GLOBALS['home-content-hide-flag'] == false) { ?>
									<li class="nav-item ">
										<!-- <h3 class='experience-the-lalit mob-nav-head'>City Experiences</h3> -->
										<div class="sub-menu">
											<div class="row">
												<article class="sub-menu-item">
													<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click experience-lalit">City Experiences<i class="ico-sprite sprite ico-small-right-black"></i></a>
													<div class="row sub-menu-links-block sub-nav-menu-list">
														<a href="javascript:void(0);" class="back-link"><span class="nav-item">Experiences Across our Destinations</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
														<div class="">
															<ul class="unstyled-listing h-card">
																<?php
																$i = 1;
																foreach ($locations_array as $locations_obj) {
																?>
																	<?php
																	//if ($locations_obj->slug != 'london') {
																	?>
																	<li class="list-item<?php echo ' ' . $locations_obj->slug; ?>">
																		<a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-' . $locations_obj->slug . '/experience-the-lalit'; ?>"><?php echo $locations_obj->name; ?></a>
																	</li>
																	<?php //} 
																	?>
																	<?php
																	if ($i % 5 == 0) {
																	?>
															</ul><!-- unstyled-listing -->
														</div><!-- col -->
														<div class="">
															<ul class="unstyled-listing">
														<?php
																	}

																	$i++;
																}
														?>
															</ul><!-- unstyled-listing -->
														</div><!-- col -->
													</div><!-- row -->
												</article><!-- col -->
											</div><!-- row -->
										</div><!-- sub-menu -->
									</li>
								<?php } ?>

								<?php global $wp; ?>
								<li class="nav-item login-resigter-mob">
									<h3 class='login-register-header mob-nav-head'>My Account</h3>
									<div class="sub-menu">
										<div class="row">
											<article class="sub-menu-item">
												<?php
												if (!is_user_logged_in()) {
												?>
													<a href="<?php site_url() ?>/my-account/" class="nav-item find-a-hotel<?php if (is_account_page() && !isset($_GET['action'])) {
																																echo ' active';
																															} ?>">Login</a>
													<a href="<?php site_url() ?>/my-account?action=register" class="nav-item find-a-hotel<?php if (is_account_page() && isset($_GET['action']) && $_GET['action'] == 'register') {
																																				echo ' active';
																																			} ?>">Register</a>
												<?php
												} else {
												?>
													<div class="row">
														<div class="<?php if (isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col6<?php } ?>">
															<ul class="unstyled-listing">
																<li class="list-item<?php if (is_account_page() && (strpos(home_url($wp->request), '/my-account') == true && strpos(home_url($wp->request), '/edit-address') != true && strpos(home_url($wp->request), '/edit-account') != true && strpos(home_url($wp->request), '/orders') != true)) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/" class="">Dashboard</a>
																</li>
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/orders') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/orders/" class="">Orders</a>
																</li>
																<li class="list-item"><a href="<?php echo esc_url(wc_logout_url(wc_get_page_permalink('myaccount'))); ?>" class="">Logout</a></li>
															</ul>
														</div>
														<div class="<?php if (isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col6<?php } ?>">
															<ul class="unstyled-listing">
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/edit-address') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/edit-address/" class="">Addresses</a>
																</li>
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/edit-account') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/edit-account/" class="">Personal Details</a>
																</li>
															</ul>
														</div>
													</div>
												<?php
												}
												?>
											</article><!-- col -->
										</div><!-- row -->
									</div><!-- sub-menu -->
								</li>
							<?php
							} else {

								global $wp;
							?>
								<li class="nav-item offers<?php if ($GLOBALS['current_theme_template'] == 'offers-template.php' || $GLOBALS['current_theme_template'] == 'single-offer.php') {
																echo ' active';
															} ?>">
									 
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/" class='offers mob-nav-head'>Offers</a>
									 
								</li>
								<li class="nav-item experience-lalit<?php if ($GLOBALS['current_theme_template'] == 'experience-the-lalit-template.php' || $GLOBALS['current_theme_template'] == 'single-experience.php') {
																		echo ' active';
																	} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/" class='experience-the-lalit mob-nav-head'>Experience<?php echo ' ' . ucfirst($GLOBALS['location'][0]->name); ?></a>
								</li>
								<li class="nav-item meetings-events<?php if ($GLOBALS['current_theme_template'] == 'events-template.php') {
																		echo ' active';
																	} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/" class='meetings-and-events mob-nav-head'>Meetings &amp; Events</a>
								</li>
								<li class="nav-item weddings<?php if ($GLOBALS['current_theme_template'] == 'weddings-template.php') {
																echo ' active';
															} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/" class='weddings mob-nav-head'>Weddings</a>
								</li>
								<li class="nav-item login-resigter-mob">
									<h3 class='login-register-header mob-nav-head'>My Account</h3>
									<div class="sub-menu">
										<div class="row">
											<article class="sub-menu-item">
												<?php
												if (!is_user_logged_in()) {
												?>
													<a href="<?php site_url() ?>/my-account/" class="nav-item find-a-hotel <?php if (is_account_page() && !isset($_GET['action'])) {
																																echo 'active';
																															} ?>">Login</a>
													<a href="<?php site_url() ?>/my-account?action=register" class="nav-item find-a-hotel <?php if (is_account_page() && isset($_GET['action']) && $_GET['action'] == 'register') {
																																				echo 'active';
																																			} ?>">Register</a>
												<?php
												} else {
												?>
													<div class="row">
														<div class="<?php if (isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col6<?php } ?>">
															<ul class="unstyled-listing">
																<li class="list-item<?php if (is_account_page() && (strpos(home_url($wp->request), '/my-account') == true && strpos(home_url($wp->request), '/edit-address') != true && strpos(home_url($wp->request), '/edit-account') != true && strpos(home_url($wp->request), '/orders') != true)) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/" class="">Dashboard</a>
																</li>
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/orders') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/orders/" class="">Orders</a>
																</li>
																<li class="list-item"><a href="<?php echo esc_url(wc_logout_url(wc_get_page_permalink('myaccount'))); ?>" class="">Logout</a></li>
															</ul>
														</div>
														<div class="mob-col mob-col6">
															<ul class="unstyled-listing">
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/edit-address') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/edit-address/" class="">Addresses</a>
																</li>
																<li class="list-item<?php if (is_account_page() && strpos(home_url($wp->request), '/edit-account') == true) {
																						echo ' active';
																					} ?>">
																	<a href="<?php echo site_url() ?>/my-account/edit-account/" class="">Personal Details</a>
																</li>
															</ul>
														</div>
													</div>
												<?php
												}
												?>
											</article><!-- col -->
										</div><!-- row -->
									</div><!-- sub-menu -->
								</li>
							<?php
							}
							?>
							<li class="nav-item">
								<h3 class="mob-nav-head"></i> <a href="<?php echo home_url(); ?>/find-a-hotel/">Find a
										Hotel By Destination</a></h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item by-destination">
											<div class="row sub-menu-links-block">
												<div class="col col4">
													<ul class="unstyled-listing h-card">
														<?php
														$i = 1;
														foreach ($locations_array as $locations_obj) {
														?>
															<?php
															if ($locations_obj->slug != 'london') {
															?>
																<li class="list-item<?php if ($city_name == $locations_obj->slug) {
																						echo ' active';
																					} ?>">
																	<a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-' . $locations_obj->slug; ?>">
																		<?php
																		if ($locations_obj->slug == 'london') {
																			echo 'London (Managed By The LaLiT)';
																		} else {
																			echo $locations_obj->name;
																		} ?>
																	</a>
																</li>
															<?php }
															?>
															<?php
															if ($i % 5 == 0) {
															?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
												<div class="col col4">
													<ul class="unstyled-listing h-card">
												<?php
															}
															$i++;
														}
												?>
												<li class="list-item">
													<a class="p-name u-url" href="https://www.thelalit.com/the-lalit-london">
														London (Managed By The LaLiT) </a>
												</li>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
											</div><!-- row -->
										</article><!-- col -->
										<?php if (!$city_name) { ?>
											<article class="sub-menu-item">
												<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click<?php if (get_query_var('taxonomy') == 'types') {
																														echo ' active';
																													} ?>">By
													Type <i class="ico-sprite sprite ico-small-right-black"></i></a>
												<div class="row sub-menu-links-block sub-nav-menu-list">
													<a href="javascript:void(0);" class="back-link"><span class="nav-item">By Type </span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
													<div class="">
														<ul class="unstyled-listing h-card">
															<?php
															$i = 1;
															foreach ($destination_types_array as $destination_types_obj) {
															?>
																<li class="list-item<?php /*if(get_query_var( 'term' ) == $destination_types_obj['slug']){ echo ' active'; }*/ ?>">
																	<a class="p-category u-url" href="<?php echo get_home_url() . '/' . $destination_types_obj['slug']; ?>/" class=""><?php echo $destination_types_obj['name']; ?></a>
																</li>
																<?php
																if ($i % 7 == 0) {
																?>
														</ul><!-- unstyled-listing -->
													</div><!-- col -->
													<div class="col col6">
														<ul class="unstyled-listing">
													<?php
																}
																$i++;
															}
													?>
														</ul><!-- unstyled-listing -->
													</div><!-- col -->
												</div><!-- row -->
											</article><!-- col -->

											<article class="sub-menu-item by-interest">
												<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click<?php if (get_query_var('taxonomy') == 'interests') {
																														echo ' active';
																													} ?>">By
													Interest <i class="ico-sprite sprite ico-small-right-black"></i></a>
												<div class="row sub-menu-links-block sub-nav-menu-list">
													<a href="javascript:void(0);" class="back-link"><span class="nav-item">By Interest </span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
													<div class="">
														<ul class="unstyled-listing h-card">
															<?php
															$i = 1;
															foreach ($destination_interest_array as $destination_interest_obj) {
															?>
																<li class="list-item<?php /*if(get_query_var( 'term' ) == $destination_interest_obj['slug']){ echo ' active'; } */ ?>">
																	<a class="p-category u-url" href="<?php echo get_home_url() . '/' . $destination_interest_obj['slug']; ?>/" class=""><i class="sprite<?php echo ' ico-' . $destination_interest_obj['slug']; ?>"></i><?php echo $destination_interest_obj['name']; ?></a>
																</li>
																<?php
																if ($i % 7 == 0) {
																?>
														</ul><!-- unstyled-listing -->
													</div><!-- col -->
													<div class="col col6">
														<ul class="unstyled-listing">
													<?php
																}

																$i++;
															}
													?>
														</ul><!-- unstyled-listing -->
													</div><!-- col -->
												</div><!-- row -->
											</article><!-- col -->
										<?php } ?>
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
						</ul><!-- primary-navigation -->
					</nav><!-- nav -->
				</div><!-- col -->
			</div><!-- container -->
			<?php
			if ($GLOBALS['location']) {
			?>
				<div class="quaternary-nav-section <?php echo $woo_class; ?>">
					<div class="nav-bar-fill">
						<div class="fluidRow">
							<div class="container">
								<div class='row'>
									<nav class='nav horizontal'>
										<input type="hidden" id="city_slug" value="<?php if ($city_name != '') {
																						echo $city_name;
																					} else {
																						echo '';
																					} ?>">
										<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
											<li id="menu-item-514" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'hotel-template.php') {
																						echo ' active';
																					} ?>">
												<a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/"><i class="sprite ico-overview"></i></a>
											</li>
											<li id="menu-item-515" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'suite-and-room-template.php' || $GLOBALS['current_theme_template'] == 'single-suite-and-room.php') {
																						echo ' active';
																					} ?>">
												<a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/"><i class="sprite ico-stay"></i></a>
											</li>
											<li id="menu-item-516" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'dining-template.php' || $GLOBALS['current_theme_template'] == 'single-dining.php') {
																						echo ' active';
																					} ?>">
												<a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/"><i class="sprite ico-eat-drink"></i></a>
											</li>
											<li id="menu-item-1805" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'relax-and-unwind.php') {
																						echo ' active';
																					} ?>">
												<a class="relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/"><i class="sprite ico-relax-unwind"></i></a>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'photo-gallery-template.php') {
																						echo ' active';
																					} ?>">
												<a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/"><i class="sprite ico-photo-gallery"></i></a>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'location-template.php') {
																						echo ' active';
																					} ?>">
												<a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/"><i class="sprite ico-location"></i></a>
											</li>
											<li class="nav-item book-item"><button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button>

												<div class="booking-widget clearfix v-align-widget" style="display:none">
													<?php get_template_part('includes/booking', 'widget'); ?>
												</div><!-- booking-widget -->

											</li>
										</ul>

									</nav>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div><!-- container -->

		<div class="booking-widget clearfix pop-up v-align-widget" id="mobile-book-widget" style="display:none">
			<?php get_template_part('includes/booking', 'widget'); ?>
		</div><!-- booking-widget -->
	</div><!-- mobile-nav -->
	<?php
	/*}
		else
		{*/
	?>
	<div class="desktop-nav <?php if ($city_name == '') {
								echo ' nav-bar-fill bg-white';
							} ?> <?php if ($city_name != '') {
										echo ' local-navigation';
									} ?><?php if ($city_name != '') {
											echo  ' ' . $city_name;
										} ?>">
		<div class="container bg-white primary-nav<?php if ($city_name != '') {
														echo ' local-nav';
													} else {
														echo '';
													} ?>">
			<div class="row">
				<div class="col col2 vcard">
					<?php /* if ($city_name != '') { ?>	
					<a class="logo local-city-logo u-url" href="<?php echo '/the-lalit-' . $city_name . '/';?>" itemprop="url" title="<?php echo 'The LaLit' . ucfirst($city_name) . '/'; ?>" >
				<img class="u-photo" src="<?php  echo wp_get_attachment_url($property_logo); ?>" itemprop="logo" alt="The Lalit"></a>																																					<?php } else { */ ?>
					<a class="logo u-url" href="/" itemprop="url" title="The Lalit"><img class="u-photo" src="<?php echo get_stylesheet_directory_uri() . '/images/head-logo.png';  ?>" itemprop="logo" alt="The Lalit"></a> <?php
																																																								/* } */
																																																								?>
				</div><!-- col -->


				<div class="col col10<?php if ($city_name != '') {
											echo ' local-global-nav';
										} else {
											echo '';
										} ?> <?php echo $woo_class; ?>">


					<nav class="nav horizontal align-right">
						<ul class="top-navigation">
							<?php if (!$city_name) { ?><li class="nav-item our_hotel"><a href="<?php echo site_url(); ?>/find-a-hotel/"> Our Hotels</a></li><?php } ?>
							<li class="nav-item global-nav-menu-top<?php if ($post->ID == '4233') {
																		echo ' active';
																	} ?>"><a href="<?php echo site_url(); ?>/the-lalit-loyalty/">The Lalit Loyalty</a></li>

							<!-- <?php
									if ($city_name != 'mangar' && $city_name != 'london') {
									?>
								<li class="nav-item global-nav-menu-top clickme"><a href="javascript:void(0);"><i class="ico-sprite sprite size-15 ico-bell"></i> Speak to Guest Relations</a>
								</li>
							<?php
									}
							?> -->
							<?php if (!$city_name) { ?>
								<li class="nav-item global-nav-menu-top<?php if ($GLOBALS['current_theme_template'] == 'contact-us-hotel-template.php' || $GLOBALS['current_theme_template'] == 'contact-us-template.php') {
																			echo ' active';
																		} ?>">
									<a href="<?php if ($GLOBALS['location'][0]->slug) {
													echo site_url() . '/the-lalit-' . $GLOBALS['location'][0]->slug . '/contact-us/';
												} else {
													echo site_url() . '/contact-us/';
												} ?>">
										<!--i class="ico-sprite sprite size-15 ico-tel"></i--> Contact Us</a>
								</li>
							<?php } ?>
							<?php
							if (is_user_logged_in()) {
								$user_id = get_current_user_id();
								if (get_user_meta($user_id, 'account_first_name', true)) {
									$first_name = get_user_meta($user_id, 'account_first_name', true);
								} else {
									$first_name = get_user_meta($user_id, 'first_name', true);
								}

								if (get_user_meta($user_id, 'account_last_name', true)) {
									$last_name = get_user_meta($user_id, 'account_last_name', true);
								} else {
									$last_name = get_user_meta($user_id, 'last_name', true);
								}
								$name = 'Hi,' . ' ' . $first_name . ' ' . $last_name;
								if (strlen($name) > 9) {
									$name = substr($name, 0, 9) . '...';
								}
							?>
								<li class="nav-item global-nav-menu-top login-register-list loggedIn">
									<a class="loggedIn-link" href="javascript:void(0);"><?php echo $name; ?> <i class="ico-sprite sprite size-18 ico-gre-down-arrow"></i></a>
									<div class="sub-menu-login">
										<ul class="sub-menu-list">
											<?php
											$cls1 = '';
											if (is_account_page() && $current_endpoint != 'orders') {
												$cls1 = 'active';
											}
											?>
											<li class="sub-menu-list-link <?php echo $cls1; ?>">
												<a href="<?php echo site_url() ?>/my-account/">Dashboard</a>
											</li>
											<?php
											$cls2 = '';
											if (is_account_page() && $current_endpoint == 'orders') {
												$cls2 = 'active';
											}
											?>
											<li class="sub-menu-list-link <?php echo $cls2; ?>">
												<a href="<?php echo site_url() ?>/my-account/orders/">Orders</a>
											</li>
											<li class="sub-menu-list-link <?php echo $cls2; ?>">
												<a href="<?php echo site_url() ?>/my-account/edit-address/">Addresses</a>
											</li>
											<li class="sub-menu-list-link <?php echo $cls2; ?>">
												<a href="<?php echo site_url() ?>/my-account/edit-account/">Personal
													Details</a>
											</li>
											<li class="sub-menu-list-link">
												<a href="<?php echo esc_url(wc_logout_url(wc_get_page_permalink('myaccount'))); ?>">Logout</a>
											</li>
										</ul>
									</div>
								</li>
							<?php
							} else {
							?>
								<li class="nav-item global-nav-menu-top login-register-list loggedOut">
									<a href="<?php site_url() ?>/my-account/" class="<?php if (is_account_page() && !isset($_GET['action']) && !$current_endpoint) {
																							echo 'active';
																						} ?>">Login
									</a>
									<p class="header-delimeter-login">/</p>
									<a href="<?php site_url() ?>/my-account?action=register" class="<?php if (is_account_page() && isset($_GET['action']) && $_GET['action'] == 'register') {
																										echo 'active';
																									} ?>">
										Register </a>
								</li>
							<?php
							}
							?>
					          <!--		<li class="nav-item global-nav-menu-top">
							<a href="tel:9650082422">
							<i class="ico-sprite sprite size-15 ico-tel"></i>+91 9650082422</a></li> -->
						</ul><!-- top-navigation -->
						<ul class="primary-navigation">
							<?php
							/* if (!$city_name) { */
							?>
							<li class="nav-item"><a href="<?php echo home_url(); ?>/find-a-hotel/" class="find-a-hotel">Find a Hotel</a>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item col col6">
											<h6 class="sub-menu-title title-underline">By Destination</h6>
											<div class="row sub-menu-links-block">
												<div class="col col4">
													<ul class="unstyled-listing h-card">
														<?php
														$i = 1;
														foreach ($locations_array as $locations_obj) {
														?>
															<?php
															if ($locations_obj->slug != 'london') {
															?>
																<li class="list-item"><a href="<?php echo get_home_url() . '/the-lalit-' . $locations_obj->slug; ?>" class="p-name u-url">
																		<?php if ($locations_obj->slug == 'london') {
																			echo 'London (Managed By The LaLiT)';
																		} else {
																			echo $locations_obj->name;
																		} ?>
																	</a>
																</li>
															<?php }
															?>
															<?php
															if ($i % 5 == 0) {
															?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
												<div class="col col4">
													<ul class="unstyled-listing h-card">
												<?php
															}

															$i++;
														}
												?>
												<li class="list-item"><a href="https://www.thelalit.com/the-lalit-london" class="p-name u-url">
														London (Managed By The LaLiT) </a></li>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
											</div><!-- row -->
										</article><!-- col -->

										<article class="sub-menu-item col col3">
											<h6 class="sub-menu-title title-underline">By Type</h6>
											<div class="row sub-menu-links-block">
												<div class="col col10">
													<ul class="unstyled-listing h-card">
														<?php
														$i = 1;
														foreach ($destination_types_array as $destination_types_obj) {
														?>
															<li class="list-item"><a href="<?php echo get_home_url() . '/' . $destination_types_obj['slug']; ?>/" class="p-category u-url"><?php echo $destination_types_obj['name']; ?></a>
															</li>
															<?php
															if ($i % 7 == 0) {
															?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
												<div class="col col6">
													<ul class="unstyled-listing h-card">
												<?php
															}

															$i++;
														}
												?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
											</div><!-- row -->
										</article><!-- col -->

										<article class="sub-menu-item col col3">
											<h6 class="sub-menu-title title-underline">By Interest</h6>
											<div class="row sub-menu-links-block">
												<div class="col col10">
													<ul class="unstyled-listing h-card">
														<?php
														$i = 1;
														foreach ($destination_interest_array as $destination_interest_obj) {
														?>
															<li class="list-item"><a href="<?php echo get_home_url() . '/' . $destination_interest_obj['slug']; ?>/" class="p-category u-url"><i class="sprite<?php echo ' ico-' . $destination_interest_obj['slug']; ?>"></i><?php echo $destination_interest_obj['name']; ?></a>
															</li>
															<?php
															if ($i % 7 == 0) {
															?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
												<div class="col col6">
													<ul class="unstyled-listing h-card">
												<?php
															}

															$i++;
														}
												?>
													</ul><!-- unstyled-listing -->
												</div><!-- col -->
											</div><!-- row -->
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
							<li class="nav-item  plan-event">
								<!-- <a href="javascript:void(0);">Plan an Event</a> -->
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item col col6">
											<h6 class="sub-menu-title">Meetings &amp; Events</h6>
											<div class="img-block">
												<div style="background: url(<?php echo site_url(); ?>/wp-content/themes/lalit/images/meetings-events.jpg) no-repeat left top">
												</div>
											</div><!-- img-block -->
											<div class="text-link-block">
												<div class="row">
													<ul class="unstyled-listing col col3 h-card">
														<?php
														$i = 1;
														$max_rows = 4;
														foreach ($locations_array as $locations_obj) {
														?>
															<?php
															//if ($locations_obj->slug != 'london') {
															?>
															<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-' . $locations_obj->slug . '/meetings-and-events/'; ?>"><?php echo $locations_obj->name; ?></a>
															</li>
															<?php //} 
															?>
															<?php
															if ($i == $max_rows) {
															?>
													</ul><!-- unstyled-listing -->
													<ul class="unstyled-listing col col3 h-card">
												<?php

																$i = 0;
																$max_rows = 3;
															}

															$i++;
														}
												?>
													</ul><!-- unstyled-listing col col3 -->
												</div><!-- row  -->
												<?php /*<a href="" class="text-link">Contact our event specialits <i class="ico-sprite sprite ico-red-right-arrow"></i></a>*/ ?>
											</div><!-- text-link-block -->
										</article><!-- col -->
										<article class="sub-menu-item col col6">
											<h6 class="sub-menu-title">Weddings</h6>
											<div class="text-link-block weddings-block">
												<div class="row">
													<div class="col col4">
														<div class="weddings-inner-block">
															<div class="img-block">
																<div style="background: url(<?php echo site_url(); ?>/wp-content/themes/lalit/images/beach-weddings.jpg) no-repeat left top">
																</div>
																<h3 class="item-title">Beach Weddings</h3>
															</div><!-- img-block -->

															<ul class="unstyled-listing h-card">
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-goa/weddings/'; ?>" class="">Goa</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-bekal/weddings/'; ?>" class="">Bekal</a></li>
															</ul><!-- unstyled-listing -->
														</div><!-- weddings-inner-block -->
													</div><!-- col4 -->

													<div class="col col4">
														<div class="weddings-inner-block">
															<div class="img-block">
																<div style="background: url(<?php echo site_url(); ?>/wp-content/themes/lalit/images/regal-weddings.jpg) no-repeat left top">
																</div>
																<h3 class="item-title">Regal Weddings</h3>
															</div><!-- img-block -->
															<ul class="unstyled-listing h-card">
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-udaipur/weddings/'; ?>" class="">Udaipur</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-jaipur/weddings/'; ?>" class="">Jaipur</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-srinagar/weddings/'; ?>" class="">Srinagar</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-khajuraho/weddings/'; ?>" class="">Khajuraho</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-kolkata/weddings/'; ?>" class="">Kolkata</a></li>
															</ul><!-- unstyled-listing -->
														</div><!-- weddings-inner-block -->
													</div><!-- col4 -->

													<div class="col col4">
														<div class="weddings-inner-block">
															<div class="img-block">
																<div style="background: url(<?php echo site_url(); ?>/wp-content/themes/lalit/images/city-weddings.jpg) no-repeat left top">
																</div>
																<h3 class="item-title">City Weddings</h3>
															</div><!-- img-block -->
															<ul class="unstyled-listing h-card">
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-delhi/weddings/'; ?>" class="">New Delhi</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-bangalore/weddings/'; ?>" class="">Bangalore</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-mumbai/weddings/'; ?>" class="">Mumbai</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-kolkata/weddings/'; ?>" class="">Kolkata</a></li>
																<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url() . '/the-lalit-chandigarh/weddings/'; ?>" class="">Chandigarh</a></li>
															</ul><!-- unstyled-listing -->
														</div><!-- weddings-inner-block -->
													</div><!-- col4 -->
												</div><!-- row -->
												<?php /*<a href="" class="text-link">Contact our wedding specialits <i class="ico-sprite sprite ico-red-right-arrow"></i></a> */ ?>
											</div><!-- text-link-block -->
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
							<?php if ($GLOBALS['home-content-hide-flag'] == false) { ?>
								<li class="nav-item experience-lalit"><a href="javascript:void(0);" class='experience-the-lalit'>City Experiences</a>
									<div class="sub-menu">
										<div class="row">
											<div class="align-center">
												<ul class="unstyled-listing first-col img-grid">
													<ul class="unstyled-listing img-inner-grid clearfix h-card">
														<li class="exp-bangalore">
															<a href="<?php echo site_url(); ?>/the-lalit-bangalore/experience-the-lalit/" class="hotels-block img-grid-bangalore u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/bangalore.jpg" alt="Bangalore Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Bangalore</span>
															</a>
														</li>
														<li class="exp-chandigarh">
															<a href="<?php echo site_url(); ?>/the-lalit-chandigarh/experience-the-lalit/" class="hotels-block img-grid-chandigarh u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/chandigarh.jpg" alt="Chandigarh Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Chandigarh</span>
															</a>
														</li>
													</ul><!-- img-inner-grid -->
												</ul><!-- col col2 -->

												<ul class="unstyled-listing sec-col img-grid">
													<ul class="unstyled-listing img-inner-grid clearfix h-card">
														<li class="exp-bekal">
															<a href="<?php echo site_url(); ?>/the-lalit-bekal/experience-the-lalit/" class="hotels-block img-grid-bekal u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/bekal.jpg" alt="Bekal Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Bekal</span>
															</a>
														</li>
														<!-- <li class="exp-london">
														<a href="<?php echo site_url(); ?>/the-lalit-london/experience-the-lalit/" class="hotels-block img-grid-golf u-url">
															<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/london.jpg" alt="Golf Expereince" />
															<span class="item-title p-name">London</span>
														</a>
													</li> -->
														<li class="exp-goa">
															<a href="<?php echo site_url(); ?>/the-lalit-goa/experience-the-lalit/" class="hotels-block img-grid-goa u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/goa.jpg" alt="Goa Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Goa</span>
															</a>
														</li>
													</ul><!-- img-inner-grid -->
												</ul><!-- col col3 -->

												<ul class="unstyled-listing third-col img-grid">
													<ul class="unstyled-listing img-inner-grid clearfix h-card">
														<li class="exp-khajuraho">
															<a href="<?php echo site_url(); ?>/the-lalit-khajuraho/experience-the-lalit/" class="hotels-block img-grid-khajuraho u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/khajuraho.jpg" alt="Khajuraho Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Khajuraho</span>
															</a>
														</li>

														<li class="exp-jaipur">
															<a href="<?php echo site_url(); ?>/the-lalit-jaipur/experience-the-lalit/" class="hotels-block img-grid-jaipur u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/jaipur.jpg" alt="Jaipur Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Jaipur</span>
															</a>
														</li>
													</ul><!-- img-inner-grid -->
												</ul><!-- col col2 -->

												<ul class="unstyled-listing forth-col img-grid">
													<ul class="unstyled-listing  img-inner-grid h-card">
														<li class="exp-kolkata">
															<a href="<?php echo site_url(); ?>/the-lalit-kolkata/experience-the-lalit/" class="hotels-block img-grid-kolkata u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/kolkata.jpg" alt="Kolkata Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Kolkata</span>
															</a>
														</li>
														<li class="exp-mangar">
															<a href="<?php echo site_url(); ?>/the-lalit-mangar/experience-the-lalit/" class="hotels-block img-grid-mangar u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/mangar.jpg" alt="Mangar Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Mangar</span>
															</a>
														</li>

														<li class="no-link no-link-exp-collage-box">
															<a href="javascript:void()" class="hotels-block img-grid-collage-box">
																<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/collage-box.jpg" alt="Collage-Box Experience" /><!-- hotel-img-Block -->
															</a>
														</li>
														<li class="img-new-delhi exp-new-delhi">
															<a href="<?php echo site_url(); ?>/the-lalit-delhi/experience-the-lalit/" class="hotels-block img-grid-new-delhi u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/new-delhi.jpg" alt="New-Delhi Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">New Delhi</span>
															</a>
														</li>
														<li class="img-grid-mumbai exp-mumbai">
															<a href="<?php echo site_url(); ?>/the-lalit-mumbai/experience-the-lalit/" class="hotels-block img-grid-mumbai u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/mumbai.jpg" alt="Mumbai Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Mumbai</span>
															</a>
														</li>
													</ul><!-- img-inner-grid -->
												</ul><!-- col col7 -->

												<ul class="unstyled-listing fifth-col img-grid">
													<ul class="unstyled-listing img-inner-grid clearfix h-card">
														<li class="exp-srinagar">
															<a href="<?php echo site_url(); ?>/the-lalit-srinagar/experience-the-lalit/" class="hotels-block img-grid-srinagar u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/srinagar.jpg" alt="Srinagar Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Srinagar</span>
															</a>
														</li>
														<li class="no-link no-link-exp-sweets">
															<a href="javascript:void()" class="hotels-block img-grid-sweets">
																<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/sweets.jpg" alt="Sweets Experience" /><!-- hotel-img-Block -->
															</a>
														</li>
														<li class="exp-udaipur">
															<a href="<?php echo site_url(); ?>/the-lalit-udaipur/experience-the-lalit/" class="hotels-block img-grid-udaipur u-url">
																<img class="hotel-img-Block hotel-img u-photo" src="/wp-content/themes/lalit/images/experience-mega-nav/udaipur.jpg" alt="Udaipur Experience" /><!-- hotel-img-Block -->
																<span class="item-title p-name">Udaipur</span>
															</a>
														</li>
													</ul><!-- img-inner-grid -->
												</ul><!-- col col7 -->
											</div><!-- col -->
										</div><!-- row -->
									</div><!-- sub-menu -->
								</li>
							<?php } ?>
							<?php
							if ($city_name == 'londono') {
							?>
								<li class="nav-item food-item">
									<a href="<?php echo $GLOBALS['$fooddelivery-url']; ?>" class=''>
										<img src="/wp-content/themes/lalit/images/delivery-icon/food-delivery-icon.png" style="vertical-align: middle;" alt="" width="27px" height="27px">
										Food Delivery</a>
								</li>
							<?php } ?>
							<!-- <li class="nav-item e-learn-item">
								<a href="<?php echo $GLOBALS['$eLearning-url']; ?>" class=''> -->
							<!-- <img src="/wp-content/themes/lalit/images/delivery-icon/e-learning.svg" style="vertical-align: middle;" alt="" width="27px" height="27px"> -->
							<!-- eLearning</a></li> -->
							<?php
							if (isIPad()) {
							?>
								<li class="nav-item book-item">
									<!--<button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button>-->
									<a href="#mobile-book-widget" class="mobile-book-stay"><button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button></a>
								</li>
								<?php
								if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
									$count = WC()->cart->cart_contents_count;
								?>
									<li class="nav-item cart-global">
										<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
											<i class="ico-sprite sprite size-22 ico-cart"></i>
											<?php
											$cls = '';
											if ($count > 0) {
												$cls = 'cart-no';
											} else {
												$count = '';
											}
											?>
											<span class="<?php echo $cls; ?>"> <?php echo $count; ?> </span>

										</a>
									</li>
								<?php
								}
							} else {
								?>
								<li class="nav-item book-item"><button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button>

									<div class="booking-widget clearfix v-align-widget" style="display:none" id="mobile-book-widget">
										<?php get_template_part('includes/booking', 'widget'); ?>
									</div><!-- booking-widget -->

								</li>
								<?php
								if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
									$count = WC()->cart->cart_contents_count;
								?>
									<li class="nav-item cart-global">
										<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
											<i class="ico-sprite sprite size-22 ico-cart"></i>
											<?php
											$cls = '';
											if ($count > 0) {
												$cls = 'cart-no';
											} else {
												$count = '';
											}
											?>
											<span class="<?php echo $cls; ?>"> <?php echo $count; ?> </span>

										</a>
									</li>
							<?php
								}
							}
							/*}  else {
								?>
								<li class="nav-item experience-lalit<?php if ($GLOBALS['current_theme_template'] == 'experience-the-lalit-template.php' || $GLOBALS['current_theme_template'] == 'single-experience.php') {
																		echo ' active';
																	} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/" class='experience-the-lalit'>Experience<?php echo ' ' . ucfirst($GLOBALS['location'][0]->name); ?></a>
								</li>
								<li class="nav-item meetings-events<?php if ($GLOBALS['current_theme_template'] == 'events-template.php') {
																		echo ' active';
																	} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/" class='meetings-and-events<?php echo " " . $city_name; ?>'>Meetings &amp; Events</a>
								</li>
								<li class="nav-item weddings<?php if ($GLOBALS['current_theme_template'] == 'weddings-template.php') {
																echo ' active';
															} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/" class='weddings'>Weddings</a></li>
								<li class="nav-item offers<?php if ($GLOBALS['current_theme_template'] == 'offers-template.php' || $GLOBALS['current_theme_template'] == 'single-offer.php') {
																echo ' active';
															} ?>">
									<a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/" class='offers'>Offers</a></li>
								<?php
								if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
									$count = WC()->cart->cart_contents_count;
								?>
									<li class="nav-item cart-global">
										<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
											<i class="ico-sprite sprite size-22 ico-cart"></i>
											<?php
											if ($count > 0) {
											?>
												<span class="cart-no"><?php echo $count; ?></span>
											<?php
											}
											?>
										</a>
									</li>
							<?php
								}
							}*/
							?>
						</ul><!-- primary-navigation -->
					</nav>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<?php
		if ($GLOBALS['location']) {
		?>
			<div class="quaternary-nav-section">
				<div class="nav-bar-fill">
					<div class="fluidRow">
						<div class="container">
							<div class='row'>
								<div class='col col2 vcard' style="margin-left:-38px">
									<ul id="menu-hotel-secondary-nav-delhi" class="align-left">
										<li id="menu-item-514" class="nav-item <?php /* if ($GLOBALS['current_theme_template'] == 'hotel-template.php') {
																					echo ' active';
																				} */ ?>">
											<a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/">
												<?php if ($city_name != 'delhi') {
													echo $city_name;
												} else {
													echo 'New Delhi';
												} ?>
											</a>
										</li>
									</ul>
								</div>
<style>
.dropbtn {
color: white;
padding: 16px;
font-size: 16px;
border: none;
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: rgba(46, 45, 45, 0.85);
min-width: 258px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
text-align: left;
font-size: 9.1px;
font-family: Roboto, sans-serif;
}

.dropdown-content a {
color: #949292;
padding: 12px 16px;
text-decoration: none;
display: block;
}
.dropdown-content a:hover { color : #fff;}
.dropdown:hover .dropdown-content {display: block;}
</style>
								<div class='col col10'>
									<nav class='nav horizontal'>
										<input type="hidden" id="city_slug" value="<?php if ($city_name != '') {
																						echo $city_name;
																					} else {
																						echo '';
																					} ?>">
										<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
											<?php /*<li id="menu-item-514" class="nav-item<?php if($GLOBALS['current_theme_template']=='hotel-template.php'){ echo ' active'; } ?>"><a
                                        class="overview sec_nav_menu"
                                        href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/">Home</a>
                                    </li> */ ?>
											<li id="menu-item-515" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'suite-and-room-template.php' || $GLOBALS['current_theme_template'] == 'single-suite-and-room.php') {
																						echo ' active';
																					} ?>">
												<a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/">Stay</a>
											</li>
											<li id="menu-item-516" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'dining-template.php' || $GLOBALS['current_theme_template'] == 'single-dining.php') {
																						echo ' active';
																					} ?>">
												<a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/">Dining</a>
											</li>
											
										   <?php if($city_name=='bekal') { ?>
											<li id="" class="nav-item dropdown">
											<a class="dropbtn stay sec_nav_menu" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes">Swasthya programmes</a>
											<div class="dropdown-content">
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/weight-management-programme/">Weight Management Programme</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/pain-management-and-joint-care/">Pain Management and Joint care</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/anti-ageing-and-rejuvenation/">Anti Ageing and Rejuvenation</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/geriatric-care-programme/">Geriatric Care Programme </a>
											<!--a href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/expertise/">Expertise </a-->
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/panchakarma-programmes/">Panchakarma Programmes</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/blossom-at-50s-women-healthcare/">Blossom at 50s  (Women Healthcare)</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/andro-care/">Androcare </a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/destress-programme/">Destress Programme</a>
											</div>
											
											</li>
											<?php } ?>
											
											<li id="menu-item-1805" class="<?php if($city_name=='bekal') { ?>dropdown<?php } ?> nav-item<?php if ($GLOBALS['current_theme_template'] == 'relax-and-unwind.php') {
																						echo ' active';
																					} ?>">
																				
												<a class="<?php if($city_name=='bekal') { ?>dropbtn<?php } ?> relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/">Wellness</a>
												  <?php if($city_name=='bekal') { ?>
													<div class="dropdown-content">
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/relax-and-unwind/ayurveda/">Ayurveda</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/yoga-meditation/">Yoga & Meditation</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/journey-at-rejuve-the-spa/">Journey at Rejuve-The Spa</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/expertise/">Expertise</a>
													</div>
													<?php } ?>
												
												
											</li>
											<li id="menu-item-1805" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'events-template.php') {
																						echo ' active';
																					} ?>">
												<a class="meetings-and-events sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/">Events</a>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'weddings-template.php') {
																						echo ' active';
																					} ?>">
												<a class="weddings sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/">Weddings</a>
											</li>
											 <?php if($city_name!='london') { ?>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'experience-the-lalit-template.php') {
																						echo ' active';
																					} ?>">
												<a class="experience sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/">City Attractions</a>
											</li>
											 <?php } ?>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'offers-template.php') {
																						echo ' active';
																					} ?>">
											<?php
												if ($city_name != 'london') {
												?>
													 
													<a class="offers sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/">Offers</a>
												 
												<?php } ?>
												 
												
												<?php
												if ($city_name == 'london') {
												?>
													<a class="offers sec_nav_menu" href="https://thelalit.giftpro.co.uk/">Gift Vouchers</a>
												<?php } ?>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'photo-gallery-template.php') {
																						echo ' active';
																					} ?>">
												<a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/">Gallery</a>
											</li>
											<!-- <li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'location-template.php') {
																							echo ' active';
																						} ?>">
												<a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/">Location</a>
											</li> -->
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'contact-us-hotel-template.php') {
																						echo ' active';
																					} ?>">
												<a class="contact-us sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/contact-us/">Contact Us</a>
											</li>

											<?php
											if (isIPad()) {
											?>
												<?php
												if ($city_name == 'londono') {
												?>
													<li class="nav-item book-item">
														<a href="<?php echo $GLOBALS['$fooddelivery-url']; ?>" class=''>
															<img src="/wp-content/themes/lalit/images/delivery-icon/food-delivery-icon.png" alt="" style="vertical-align: middle;" width="27px" height="27px">
															Food Delivery</a>
													</li>
												<?php } ?>
												<!-- <li class="nav-item book-item">
													<a href="<?php echo $GLOBALS['$eLearning-url']; ?>" class=''> -->
												<!-- <img src="/wp-content/themes/lalit/images/delivery-icon/e-learning.svg" alt="" style="vertical-align: middle;" width="27px" height="27px"> -->
												<!-- eLearning</a>
												</li> -->
												<li class="nav-item book-item">
													<a href="#mobile-book-widget" class="mobile-book-stay"><button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button></a>
												</li>


											<?php
											} else {
											?>
												<li class="nav-item book-item" style="display:none">
													<button type="button" class="btn primary-btn booking-nav-btn">Book A
														Stay</button>
													<div class="booking-widget clearfix v-align-widget book-a-stay" style="display:none">
														<?php get_template_part('includes/booking', 'widget'); ?>
													</div><!-- booking-widget -->
												</li>
											<?php
											}
											?>
										</ul>

									</nav>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
		}
			?>
			</div><!-- desktop-nav -->
		<?php
		if ($city_name!='bekal' && ($post->post_name=='swasthya-programmes' || $post->post_name=='ayurveda' || $post->post_name=='weight-management-programme' || $post->post_name=='pain-management-and-joint-care' || $post->post_name=='anti-ageing-and-rejuvenation'
		 || $post->post_name=='geriatric-care-programme' || $post->post_name=='swasthyarakshana-chikitsa-panchakarma-programmes' || $post->post_name=='andro-care' || $post->post_name=='blossom-at-50s-women-healthcare' || $post->post_name=='destress-programme' || $post->post_name=='yoga-meditation'
		  || $post->post_name=='panchakarma-programmes' || $post->post_name=='expertise' || $post->post_name=='journey-at-rejuve-the-spa' || $post->post_name=='andro-care')) {
			$city_name ='bekal';
		?>
			<div class="quaternary-nav-section">
				<div class="nav-bar-fill">
					<div class="fluidRow">
						<div class="container">
							<div class='row'>
								<div class='col col2 vcard' style="margin-left:-38px">
									<ul id="menu-hotel-secondary-nav-delhi" class="align-left">
										<li id="menu-item-514" class="nav-item <?php /* if ($GLOBALS['current_theme_template'] == 'hotel-template.php') {
																					echo ' active';
																				} */ ?>">
											<a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/">
												<?php if ($city_name != 'delhi') {
													echo $city_name;
												} else {
													echo 'New Delhi';
												} ?>
											</a>
										</li>
									</ul>
								</div>
<style>
.dropbtn {
color: white;
padding: 16px;
font-size: 16px;
border: none;
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: rgba(46, 45, 45, 0.85);
min-width: 258px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
text-align: left;
font-size: 9.1px;
font-family: Roboto, sans-serif;
}

.dropdown-content a {
color: #949292;
padding: 12px 16px;
text-decoration: none;
display: block;
}
.dropdown-content a:hover { color : #fff;}
.dropdown:hover .dropdown-content {display: block;}
</style>
								<div class='col col10'>
									<nav class='nav horizontal'>
										<input type="hidden" id="city_slug" value="<?php if ($city_name != '') {
																						echo $city_name;
																					} else {
																						echo '';
																					} ?>">
										<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
											<?php /*<li id="menu-item-514" class="nav-item<?php if($GLOBALS['current_theme_template']=='hotel-template.php'){ echo ' active'; } ?>"><a
                                        class="overview sec_nav_menu"
                                        href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/">Home</a>
                                    </li> */ ?>
											<li id="menu-item-515" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'suite-and-room-template.php' || $GLOBALS['current_theme_template'] == 'single-suite-and-room.php') {
																						echo ' active';
																					} ?>">
												<a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/">Stay</a>
											</li>
											<li id="menu-item-516" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'dining-template.php' || $GLOBALS['current_theme_template'] == 'single-dining.php') {
																						echo ' active';
																					} ?>">
												<a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/">Dining</a>
											</li>
											
										   <?php if($city_name=='bekal') { ?>
											<li id="" class="nav-item dropdown <?php if ($post->post_name=='swasthya-programmes' || $post->post_name=='weight-management-programme' || $post->post_name=='pain-management-and-joint-care' || $post->post_name=='anti-ageing-and-rejuvenation'
		 || $post->post_name=='geriatric-care-programme' || $post->post_name=='blossom-at-50s-women-healthcare' || $post->post_name=='destress-programme' 
		  || $post->post_name=='panchakarma-programmes' || $post->post_name=='andro-care') {
																						echo ' active';
																					} ?>">
											<a class="dropbtn stay sec_nav_menu" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes">Swasthya programmes</a>
											<div class="dropdown-content">
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/weight-management-programme/">Weight Management Programme</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/pain-management-and-joint-care/">Pain Management and Joint care</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/anti-ageing-and-rejuvenation/">Anti Ageing and Rejuvenation</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/geriatric-care-programme/">Geriatric Care Programme </a>
											<!--a href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/expertise/">Expertise </a-->
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/panchakarma-programmes/">Panchakarma Programmes</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/blossom-at-50s-women-healthcare/">Blossom at 50s  (Women Healthcare)</a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/andro-care/">Androcare </a>
											<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/swasthya-programmes/destress-programme/">Destress Programme</a>
											</div>
											
											</li>
											<?php } ?>
											
											<li id="menu-item-1805" class="<?php if($city_name=='bekal') { ?>dropdown<?php } ?> nav-item<?php if ($post->post_name=='ayurveda' || $post->post_name=='yoga-meditation' || $post->post_name=='journey-at-rejuve-the-spa' || $post->post_name=='expertise') {
																						echo ' active';
																					} ?>">
																				
												<a class="<?php if($city_name=='bekal') { ?>dropbtn<?php } ?> relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/">Wellness</a>
												  <?php if($city_name=='bekal') { ?>
													<div class="dropdown-content">
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/relax-and-unwind/ayurveda/">Ayurveda</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/yoga-meditation/">Yoga & Meditation</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/journey-at-rejuve-the-spa/">Journey at Rejuve-The Spa</a>
													<a style="border-bottom: 0px solid #db2128 !important;" href="https://www.thelalit.com/the-lalit-bekal/wellness/expertise/">Expertise</a>
													</div>
													<?php } ?>
												
												
											</li>
											<li id="menu-item-1805" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'events-template.php') {
																						echo ' active';
																					} ?>">
												<a class="meetings-and-events sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/">Events</a>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'weddings-template.php') {
																						echo ' active';
																					} ?>">
												<a class="weddings sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/">Weddings</a>
											</li>
											<?php
												if ($city_name != 'london') {
												?>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'experience-the-lalit-template.php') {
																						echo ' active';
																					} ?>">
												<a class="experience sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/">City Attractions</a>
											</li>
												<?php } ?>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'offers-template.php') {
																						echo ' active';
																					} ?>">
												<?php
												if ($city_name != 'london') {
												?>
													
													<a class="offers sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/">Offers</a>
													 
												<?php } ?>
												 
												<?php
												if ($city_name == 'london') {
												?>
													<a class="offers sec_nav_menu" href="https://thelalit.giftpro.co.uk/">Gift Vouchers</a>
												<?php } ?>
											</li>
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'photo-gallery-template.php') {
																						echo ' active';
																					} ?>">
												<a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/">Gallery</a>
											</li>
											<!-- <li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'location-template.php') {
																							echo ' active';
																						} ?>">
												<a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/">Location</a>
											</li> -->
											<li id="menu-item-518" class="nav-item<?php if ($GLOBALS['current_theme_template'] == 'contact-us-hotel-template.php') {
																						echo ' active';
																					} ?>">
												<a class="contact-us sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/contact-us/">Contact Us</a>
											</li>

											<?php
											if (isIPad()) {
											?>
												<?php
												if ($city_name == 'londono') {
												?>
													<li class="nav-item book-item">
														<a href="<?php echo $GLOBALS['$fooddelivery-url']; ?>" class=''>
															<img src="/wp-content/themes/lalit/images/delivery-icon/food-delivery-icon.png" alt="" style="vertical-align: middle;" width="27px" height="27px">
															Food Delivery</a>
													</li>
												<?php } ?>
												<!-- <li class="nav-item book-item">
													<a href="<?php echo $GLOBALS['$eLearning-url']; ?>" class=''> -->
												<!-- <img src="/wp-content/themes/lalit/images/delivery-icon/e-learning.svg" alt="" style="vertical-align: middle;" width="27px" height="27px"> -->
												<!-- eLearning</a>
												</li> -->
												<li class="nav-item book-item">
													<a href="#mobile-book-widget" class="mobile-book-stay"><button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button></a>
												</li>


											<?php
											} else {
											?>
												<li class="nav-item book-item" style="display:none">
													<button type="button" class="btn primary-btn booking-nav-btn">Book A
														Stay</button>
													<div class="booking-widget clearfix v-align-widget book-a-stay" style="display:none">
														<?php get_template_part('includes/booking', 'widget'); ?>
													</div><!-- booking-widget -->
												</li>
											<?php
											}
											?>
										</ul>

									</nav>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
		}
			?>
			</div><!-- desktop-nav -->
			<?php

			if (isIPad()) {
			?>
				<div class="booking-widget clearfix pop-up v-align-widget" id="mobile-book-widget" style="display:none">
					<?php get_template_part('includes/booking', 'widget'); ?>
				</div><!-- booking-widget -->
			<?php
			}




			//}
			?>

</header><!-- content-section -->
