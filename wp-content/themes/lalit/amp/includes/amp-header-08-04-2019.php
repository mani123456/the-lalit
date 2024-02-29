<?php
/**
 * This file contains the navigation and analytics code and is included in the template files.
 * The navigation menu changes to property based navigation if the $city_name variable is present (hotel overview and other inner property pages).
 */
if(ENV == 'production'){

	?>
	<amp-analytics type="gtag" data-credentials="include">
		<script type="application/json">
			{
				"vars" : {
					"gtag_id": "UA-11443455-1",
					"config" : {
						"UA-11443455-1": { 
							"groups": "default",
							"linker": { "domains": ["gc.synxis.com", "myhotelreservation.net"] }
						}
					}
				}
			}
		</script>
    </amp-analytics>
    <amp-analytics type="gtag" data-credentials="include">
		<script type="application/json">
			{
				"vars" : {
					"gtag_id": "UA-49165825-1",
					"config" : {
						"UA-49165825-1": { "groups": "default" }
					}
				}
			}
		</script>
    </amp-analytics>
	<?php
}

$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

$destinations = get_destination_object();
$GLOBALS['$destinations'] = $destinations;
$GLOBALS['$destinations_by_name'] = get_destination_object_by_name();

$GLOBALS['facebook'] = 'http://www.facebook.com/TheLaLitGroup';
$GLOBALS['twitter'] = 'http://twitter.com/TheLalitGroup';
$GLOBALS['instagram'] = 'http://instagram.com/thelalitgroup';
$GLOBALS['google'] = 'http://plus.google.com/u/0/116826386288801459694/';
$GLOBALS['linkedin'] = 'https://www.linkedin.com/company/the-lalit-suri-hospitality-group';

$height = 38;
$width = 65;
if($destination_obj->have_posts())
{
	while($destination_obj->have_posts())
	{
		$destination_obj->the_post();
		$property_logo = get_post_meta(get_the_id(),'property_logo',true);
		$GLOBALS['facebook'] = get_post_meta(get_the_id(),'facebook',true);
		if(!$GLOBALS['facebook'])
		{
			$GLOBALS['facebook'] = '';
		}
		$GLOBALS['twitter'] = get_post_meta(get_the_id(),'twitter',true);
		if(!$GLOBALS['twitter'])
		{
			$GLOBALS['twitter'] = '';
		}
		$GLOBALS['instagram'] = get_post_meta(get_the_id(),'instagram',true);
		if(!$GLOBALS['instagram'])
		{
			$GLOBALS['instagram'] = '';
		}
		$GLOBALS['google'] = get_post_meta(get_the_id(),'google',true);
		if(!$GLOBALS['google'])
		{
			$GLOBALS['google'] = '';
		}
		$GLOBALS['linkedin'] = get_post_meta(get_the_id(),'linkedin',true);
		if(!$GLOBALS['linkedin'])
		{
			$GLOBALS['linkedin'] = '';
		}
	}
}
wp_reset_postdata();

$city_name = $GLOBALS['location'][0]->slug;

if($city_name){
	$width = 58;
	$height = 40;
}
$locations_array = get_terms(array('taxonomy'=>'locations','hide_empty'=>false));
$GLOBALS['locations_array'] = $locations_array;

$destination_types_array = array();
$destination_interest_array = array();

$c = 0;
$types = get_terms(array('taxonomy'=>'types','hide_empty'=>true));
if($types)
{    
    foreach($types as $type)
    {
        $destination_types_array[$c]['id'] = $type->term_id;
        $destination_types_array[$c]['name'] = $type->name;
        $destination_types_array[$c]['slug'] = $type->slug;
        $c++;
    }
}


$c1 = 0;
$interests = get_terms(array('taxonomy'=>'interests','hide_empty'=>true));
if($interests)
{
    foreach($interests as $interest)
    {
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

if( (is_checkout() && !$current_endpoint) || $post->post_name == 'terms-conditions' )
{
	$woo_class = "hide";
}
else {
	$woo_class = "";
}
					
?>
<amp-sidebar id="sidebar" layout="nodisplay" side="left" class="custom-amp-sidebar">
<button type="reset" class="sprite icon-close ico-grey-close" id="menu-button" on="tap:sidebar.toggle"></button>
	<div class="<?php echo $woo_class; ?> primary-nav<?php if($city_name !=''){ echo ' local-nav'; }?>">
		<div class="<?php if($city_name !=''){ echo ' local-global-nav'; }else{ echo ''; } ?>">
			<span class="city-name"><?php if($city_name !=''){ echo ucfirst($city_name); }?></span>
			<nav id="mobile-menu-navigation" class="nav horizontal align-right">
				
				<ul class="primary-navigation">
					<li class="nav-item"><h3 class="mob-nav-head"></i> <a href="<?php echo home_url();?>/find-a-hotel/">Find a Hotel By Destination</a></h3>
						<div class="sub-menu">
							<div class="row">
								<article class="sub-menu-item col col6 by-destination">
									<div class="row sub-menu-links-block">
										<div class="col col4">
											<ul class="unstyled-listing h-card">
												<?php
													$i = 1;
													foreach ($locations_array as $locations_obj)
													{
												?>
														<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug;?>?amp"><?php echo $locations_obj->name; ?></a></li>
												<?php
														if($i % 5 == 0)
														{
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
											</ul><!-- unstyled-listing -->
										</div><!-- col -->
									</div><!-- row -->
								</article><!-- col -->

								<?php if(!$city_name){ ?>
								<article class="sub-menu-item">
									<amp-accordion>
										<section>
											<h4 class="nav-item find-a-hotel mob-click accordion-navigation-link<?php if(get_query_var( 'taxonomy' ) == 'types'){ echo ' active'; } ?>">By Type 
												<i class="ico-sprite sprite ico-small-down-black"></i>
											</h4>
											<div class="row sub-nav-menu-list">
												<div>
													<ul class="unstyled-listing h-card">
														<?php
															$i = 1;
															foreach ($destination_types_array as $destination_types_obj)
															{
														?>
																<li class="list-item<?php /*if(get_query_var( 'term' ) == $destination_types_obj['slug']){ echo ' active'; }*/ ?>"><a class="p-category u-url" href="<?php echo get_home_url().'/'.$destination_types_obj['slug'];?>/"><?php echo $destination_types_obj['name']; ?></a></li>
														<?php
																if($i % 7 == 0)
																{
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
										</section>
									</amp-accordion>
								</article><!-- col -->

								<article class="sub-menu-item by-interest">
									<amp-accordion>
										<section>
											<h4 class="nav-item find-a-hotel mob-click accordion-navigation-link<?php if(get_query_var( 'taxonomy' ) == 'interests'){ echo ' active'; } ?>">By Interest 
												<i class="ico-sprite sprite ico-small-down-black"></i>		
											</h4>
											<div class="row sub-nav-menu-list interest-listing-section">
												<div>
													<ul class="unstyled-listing h-card">
														<?php
															$i = 1;
															foreach ($destination_interest_array as $destination_interest_obj)
															{
														?>
																<li class="list-item<?php /*if(get_query_var( 'term' ) == $destination_interest_obj['slug']){ echo ' active'; } */?>"><a class="p-category u-url" href="<?php echo get_home_url().'/'.$destination_interest_obj['slug'];?>/"><i class="sprite<?php echo ' ico-'.$destination_interest_obj['slug']; ?>"></i><?php echo $destination_interest_obj['name']; ?></a></li>
														<?php
																if($i % 7 == 0)
																{
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
										</section>
									</amp-accordion>
								</article><!-- col -->
								<?php } ?>
							</div><!-- row -->
						</div><!-- sub-menu -->
					</li>
						<?php if($city_name) { ?>
					<input type="hidden" id="city_slug" value="<?php if($city_name != ''){ echo $city_name; }else{ echo ''; } ?>" >
					<li id="menu-item-515" class="nav-item<?php if($GLOBALS['current_theme_template']=='suite-and-room-template.php' || $GLOBALS['current_theme_template']=='single-suite-and-room.php'){ echo ' active'; } ?>"><a class="mob-nav-head" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/?amp">Stay</a></li>
					<li id="menu-item-516" class="nav-item<?php if($GLOBALS['current_theme_template']=='dining-template.php' || $GLOBALS['current_theme_template']=='single-dining.php'){ echo ' active'; } ?>"><a class="mob-nav-head" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/">Eat & Drink</a></li>
					<li id="menu-item-1805" class="nav-item<?php if($GLOBALS['current_theme_template']=='relax-and-unwind.php'){ echo ' active'; } ?>"><a class="mob-nav-head" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/">Relax & Unwind</a></li>
					<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='photo-gallery-template.php'){ echo ' active'; } ?>"><a class="mob-nav-head" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/">Photo Gallery</a></li>
					<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='location-template.php'){ echo ' active'; } ?>"><a class="mob-nav-head" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/">Location</a></li>
					<?php
							}
						if(!$city_name)
						{
					?>
							<li class="nav-item "><h3 class="mob-nav-head"> Plan an Event</h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item">
											<amp-accordion>
												<section>
													<h4 class="nav-item find-a-hotel mob-click accordion-navigation-link">Meetings &amp; Events 
														<i class="ico-sprite sprite ico-small-down-black"></i>
													</h4>
													<div class="sub-nav-menu-list">
														<div class="text-link-block clearfix">
															<ul class="unstyled-listing three-column-section">
																<?php
																	$i = 1;
																	$max_rows = 5;
																	foreach ($locations_array as $locations_obj)
																	{
																		?>
																		<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/meetings-and-events/';?>"><?php echo $locations_obj->name; ?></a></li>
																		<?php
																			if($i == $max_rows)
																			{
																				?>
																				</ul><!-- unstyled-listing -->
																				<ul class="unstyled-listing three-column-section">
																				<?php

																				$i = 0;$max_rows = 5;
																			}

																			$i++;
																	}
																?>
															</ul><!-- unstyled-listing col col3 -->
														</div><!-- text-link-block -->
													</div><!-- sub-nav-menu-list -->	
												</section>
											</amp-accordion>
										</article><!-- col -->

										<article class="sub-menu-item col col6">
											<amp-accordion>
												<section>
													<h4 class="nav-item find-a-hotel mob-click accordion-navigation-link">Weddings 
														<i class="ico-sprite sprite ico-small-down-black"></i>		
													</h4>
													<div class="sub-nav-menu-list wedding-section">
														<div class="text-link-block">
															<amp-accordion>
																<section>
																	<h3 class="item-title accordion-navigation-link">Beach Weddings
																		<i class="ico-sprite sprite ico-small-down-black"></i>		
																	</h3>
																	<div class="sub-nav-menu-list">
																		<ul class="unstyled-listing h-card">	
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-goa/weddings/';?>" >Goa</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-bekal/weddings/';?>" >Bekal</a></li>
																		</ul><!-- unstyled-listing -->	
																	</div>
																</section>
															</amp-accordion>
															<amp-accordion>
																<section>
																	<h3 class="item-title accordion-navigation-link">Regal Weddings
																		<i class="ico-sprite sprite ico-small-down-black"></i>		
																	</h3>
																	<div class="sub-nav-menu-list">
																		<ul class="unstyled-listing h-card">	
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-udaipur/weddings/';?>" >Udaipur</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-jaipur/weddings/';?>" >Jaipur</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-srinagar/weddings/';?>" >Srinagar</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-khajuraho/weddings/';?>" >Khajuraho</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>" >Kolkata</a></li>
																		</ul><!-- unstyled-listing -->
																	</div>
																</section>
															</amp-accordion>
															<amp-accordion>
																<section>
																	<h3 class="item-title accordion-navigation-link city-navigation-link">City Weddings
																		<i class="ico-sprite sprite ico-small-down-black"></i>		
																	</h3>
																	<div class="sub-nav-menu-list">
																		<ul class="unstyled-listing h-card">	
																			<li class="list-item first-city-name"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-delhi/weddings/';?>">New Delhi</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-bangalore/weddings/';?>">Bangalore</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-mumbai/weddings/';?>">Mumbai</a></li>
																			<li class="list-item"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>">Kolkata</a></li>
																			<li class="list-item last-city-name"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-chandigarh/weddings/';?>">Chandigarh</a></li>
																		</ul><!-- unstyled-listing -->	
																	</div>
																</section>
															</amp-accordion>
														</div><!-- text-link-block -->	
													</div><!-- sub-menu-links-block -->		
												</section>
											</amp-accordion>
											
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
							<li class="nav-item  experience-lalit"><h3 class='experience-the-lalit mob-nav-head'>Experience the Lalit</h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item">
											<amp-accordion>
												<section>
													<h4 class="nav-item find-a-hotel mob-click accordion-navigation-link">Experiences Across our Destinations 
														<i class="ico-sprite sprite ico-small-down-black"></i>		
													</h4>
													<div class="sub-nav-menu-list">
														<div class="text-link-block clearfix">
															<ul class="unstyled-listing three-column-section">
																<?php
																	$i = 1;
																	foreach ($locations_array as $locations_obj)
																	{
																		?>
																		<li class="list-item<?php echo ' '.$locations_obj->slug;?>"><a class="p-name u-url" href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/experience-the-lalit';?>"><?php echo $locations_obj->name; ?></a></li>
																		<?php
																		if($i % 5 == 0)
																		{
																				?>
																				</ul><!-- unstyled-listing -->
																				<ul class="unstyled-listing three-column-section">
																				<?php
																		}
																		$i++;
																	}
																?>
															</ul><!-- unstyled-listing -->
														</div>
													</div><!-- row -->
												</section>
											</amp-accordion>
											
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
							
							<?php /*<li class="nav-item rejuve-spa"><h3 class="rejuve-the-spa mob-nav-head"><a href="/rejuve-the-spa/">Rejuve The Spa</a></h3>
							</li>*/?>

							<li class="nav-item  login-resigter-mob"><h3 class='login-register-header mob-nav-head'>My Account</h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item col col6">
											<?php
											if(!is_user_logged_in())
											{		
											?>
												<a href="<?php site_url()?>/my-account/" class="nav-item find-a-hotel if(is_account_page() && !isset($_GET['action'])) { echo 'active'; } ?>">Login</a>
												<a href="<?php site_url()?>/my-account?action=register" class="nav-item find-a-hotel <?php if(is_account_page() && isset($_GET['action']) && $_GET['action']=='register') { echo 'active'; } ?>">Register</a>
											<?php
											}
											else
											{
											?>
												<div class="clearfix">
													<div class="two-column-section">
														<ul class="unstyled-listing">
																<li class="list-item"><a href="<?php echo site_url()?>/my-account/" class="dashboard-navigation">Dashboard</a></li>
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/orders/" class="dashboard-navigation">Orders</a></li>
																<li class="list-item"><a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="dashboard-navigation">Logout</a></li>
														</ul>
													</div>
													<div class="two-column-section">
														<ul class="unstyled-listing">
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/edit-address/" class="dashboard-navigation">Addresses</a></li>
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/edit-account/" class="dashboard-navigation">Personal Details</a></li>
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
						else
						{
					?>
							<li class="nav-item experience-lalit<?php if($GLOBALS['current_theme_template']=='experience-the-lalit-template.php' || $GLOBALS['current_theme_template']=='single-experience.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/" class='experience-the-lalit mob-nav-head'>Experience<?php echo ' '.ucfirst($GLOBALS['location'][0]->name); ?></a></li>
							<li class="nav-item rejuve-lalit<?php if($GLOBALS['current_theme_template']=='rejuve-the-spa-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/rejuve-the-spa/" class='rejuve-the-spa mob-nav-head'>Rejuve The Spa</a></li>
							<li class="nav-item meetings-events<?php if($GLOBALS['current_theme_template']=='events-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/" class='meetings-and-events mob-nav-head'>Meetings &amp; Events</a></li>
							<li class="nav-item weddings<?php if($GLOBALS['current_theme_template']=='weddings-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/" class='weddings mob-nav-head'>Weddings</a></li>
							<li class="nav-item offers<?php if($GLOBALS['current_theme_template']=='offers-template.php' || $GLOBALS['current_theme_template']=='single-offer.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/?amp" class='offers mob-nav-head'>Offers</a></li>
							<li class="nav-item login-resigter-mob"><h3 class='login-register-header mob-nav-head'>My Account</h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item col col6">
											<?php
											if(!is_user_logged_in())
											{		
											?>
												<a href="<?php site_url()?>/my-account/" class="nav-item find-a-hotel if(is_account_page() && !isset($_GET['action'])) { echo 'active'; } ?>">Login</a>
												<a href="<?php site_url()?>/my-account?action=register" class="nav-item find-a-hotel <?php if(is_account_page() && isset($_GET['action']) && $_GET['action']=='register') { echo 'active'; } ?>">Register</a>
											<?php
											}
											else
											{
											?>
												<div class="clearfix">
													<div class="two-column-section">
														<ul class="unstyled-listing">
																<li class="list-item"><a href="<?php echo site_url()?>/my-account/" class="dashboard-navigation">Dashboard</a></li>
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/orders/" class="dashboard-navigation" >Orders</a></li>
																<li class="list-item"><a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="dashboard-navigation">Logout</a></li>
														</ul>
													</div>
													<div class="two-column-section">
														<ul class="unstyled-listing">
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/edit-address/" class="dashboard-navigation">Addresses</a></li>
																<li class="list-item"><a href="<?php echo site_url() ?>/my-account/edit-account/" class="dashboard-navigation">Personal Details</a></li>
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
				</ul><!-- primary-navigation -->
			</nav><!-- nav -->
		</div><!-- col -->
	</div><!-- container -->
	</form>
</amp-sidebar>
<header>
	<input type="hidden" id="isHome" class="isHome" value="<?php echo (is_front_page()) ? true : false; ?>">
	<div class="mobile-nav<?php if($city_name != '') { echo  ' '.$city_name; } ?>">
		<div class="container ">
			<div class="mobile-sticky clearfix">
				<div class="logo-block h-card">
					<a href="#" id="trigger" class="menu-trigger <?php echo $woo_class; ?>" on="tap:sidebar.toggle"><i class="ico-sprite sprite size-24 ico-hamburger"></i></a>
					<a class="logo u-logo u-url<?php if($city_name != ''){ echo ' city-logo'; } ?>" href="<?php if($city_name != ''){ echo '/the-lalit-'.$city_name.'/?amp'; } else{ echo '/?amp'; } ?>" itemprop="url" title="The Lalit"><amp-img src="<?php if($city_name != ''){ echo wp_get_attachment_url($property_logo); } else{ echo get_stylesheet_directory_uri().'/images/head-logo.png'; } ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" itemprop="logo" alt="The Lalit"></amp-img></a>
				</div><!-- logo-block -->	

				<div class="btn-block <?php echo $woo_class; ?>">
					<?php
						include_once(get_template_directory() . '/amp/includes/amp-booking-widget.php');
						if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
						{
							//$count = WC()->cart->cart_contents_count;
						?>	
						<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
							<i class="ico-sprite sprite size-22 ico-cart"></i>
							<?php
							/*$cls = '';
							if ( $count > 0 ) 
							{
								$cls = 'cart-no';
							}
							else
							{
								$count = '';
							}*/
							?>
							<?php /*<span class="<?php echo $cls; ?>"> <?php echo $count; ?> </span>*/?>		
						</a>	
						<?php
						}
					?>
				</div><!-- btn-block -->
			</div><!-- mobile-sticky -->
			<?php
					if($GLOBALS['location'])
					{			
				?>
						<div class="quaternary-nav-section <?php echo $woo_class; ?>"> 
							<div class="nav-bar-fill">
								<div class="fluidRow">
									<div class="container">                        
										<div class='row'>

											<nav class='nav horizontal'>
												
												<input type="hidden" id="city_slug" value="<?php if($city_name != ''){ echo $city_name; }else{ echo ''; } ?>" >
												<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
													<li id="menu-item-514" class="nav-item<?php if($GLOBALS['current_theme_template']=='hotel-overview'){ echo ' active'; } ?>"><a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/?amp"><i class="sprite ico-overview"></i></a></li>
													<li id="menu-item-515" class="nav-item<?php if($GLOBALS['current_theme_template']=='suite-and-room' || $GLOBALS['current_theme_template']=='single-suite-and-room'){ echo ' active'; } ?>"><a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/?amp"><i class="sprite ico-stay"></i></a></li>
													<li id="menu-item-516" class="nav-item<?php if($GLOBALS['current_theme_template']=='dining' || $GLOBALS['current_theme_template']=='single-dining'){ echo ' active'; } ?>"><a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/?amp"><i class="sprite ico-eat-drink"></i></a></li>
													<li id="menu-item-1805" class="nav-item<?php if($GLOBALS['current_theme_template']=='relax-and-unwind.php'){ echo ' active'; } ?>"><a class="relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/"><i class="sprite ico-relax-unwind"></i></a></li>
													<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='photo-gallery-template.php'){ echo ' active'; } ?>"><a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/"><i class="sprite ico-photo-gallery"></i></a></li>
													<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='location'){ echo ' active'; } ?>"><a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/?amp"><i class="sprite ico-location"></i></a></li>
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
	</div><!-- mobile-nav -->
</header><!-- content-section -->
<div class="main-wrap" id="main-wrap-container">
