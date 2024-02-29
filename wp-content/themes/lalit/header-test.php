<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>
<?php
	$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

	$destinations = get_destination_object();
	$GLOBALS['$destinations'] = $destinations;
	$GLOBALS['$destinations_by_name'] = get_destination_object_by_name();

	$GLOBALS['facebook'] = 'http://www.facebook.com/TheLaLitGroup';
	$GLOBALS['twitter'] = 'http://twitter.com/TheLalitGroup';
	$GLOBALS['instagram'] = 'http://instagram.com/thelalitgroup';
	$GLOBALS['google'] = 'http://plus.google.com/u/0/116826386288801459694/';
	$GLOBALS['linkedin'] = 'https://www.linkedin.com/company/the-lalit-suri-hospitality-group';
	if($destination_obj->have_posts())
	{
		while($destination_obj->have_posts())
		{
			$destination_obj->the_post();
			$property_logo = get_post_meta($post->ID,'property_logo',true);
			$GLOBALS['facebook'] = get_post_meta($post->ID,'facebook',true);
			if(!$GLOBALS['facebook'])
			{
				$GLOBALS['facebook'] = '';
			}
			$GLOBALS['twitter'] = get_post_meta($post->ID,'twitter',true);
			if(!$GLOBALS['twitter'])
			{
				$GLOBALS['twitter'] = '';
			}
			$GLOBALS['instagram'] = get_post_meta($post->ID,'instagram',true);
			if(!$GLOBALS['instagram'])
			{
				$GLOBALS['instagram'] = '';
			}
			$GLOBALS['google'] = get_post_meta($post->ID,'google',true);
			if(!$GLOBALS['google'])
			{
				$GLOBALS['google'] = '';
			}
			$GLOBALS['linkedin'] = get_post_meta($post->ID,'linkedin',true);
			if(!$GLOBALS['linkedin'])
			{
				$GLOBALS['linkedin'] = '';
			}
		}
	}
	wp_reset_postdata();

	$city_name = $GLOBALS['location'][0]->slug;
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
<header>

<?php
if(isMobile())
{
?>
	<div class="mobile-nav<?php if($city_name != '') { echo  ' '.$city_name; } ?>">
		<div class="container">
			<div class="mobile-sticky clearfix">
				<div class="logo-block">
					<a href="#" id="trigger" class="menu-trigger"><i class="ico-sprite sprite size-32 ico-humbug ico-grey-close"></i></a>
					<a class="logo<?php if($city_name != ''){ echo ' city-logo'; } ?>" href="/" itemprop="url" title="The Lalit"><img src="<?php if($city_name != ''){ echo wp_get_attachment_url($property_logo); } else{ echo get_stylesheet_directory_uri().'/images/head-logo.png'; } ?>" itemprop="logo" alt="The Lalit"></a>
				</div><!-- logo-block -->	

				<div class="btn-block">
					<a href="#mobile-book-widget" class="btn tertiary-btn mobile-book-stay">Book A Stay</a>
				</div><!-- btn-block -->		
			</div><!-- mobile-sticky -->

			<div class="container primary-nav<?php if($city_name !=''){ echo ' local-nav'; }?>">
				<div class="<?php if($city_name !=''){ echo ' local-global-nav'; }else{ echo ''; } ?>">
					<nav class="nav horizontal align-right" style="display: none;">
						
						<ul class="primary-navigation">
							<li class="nav-item"><h3 class="mob-nav-head"></i> <a href="<?php echo home_url();?>/find-a-hotel/">Find a Hotel By Destination</a></h3>
								<div class="sub-menu">
									<div class="row">
										<article class="sub-menu-item col col6 by-destination">
											<div class="row sub-menu-links-block">
												<div class="col col4">
													<ul class="unstyled-listing">
														<?php
															$i = 1;
															foreach ($locations_array as $locations_obj)
															{
														?>
																<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug;?>" class=""><?php echo $locations_obj->name; ?></a></li>
														<?php
																if($i % 5 == 0)
																{
														?>
																		</ul><!-- unstyled-listing -->
																	</div><!-- col -->
																	<div class="col col4">
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

										<article class="sub-menu-item col col3">
											<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">By Type <i class="ico-sprite sprite ico-small-right-black"></i></a>
											<div class="row sub-menu-links-block">
												<a href="javascript:void(0);" class="back-link"><span class="nav-item">By Type </span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
												<div class="col col10">
													<ul class="unstyled-listing">
														<?php
															$i = 1;
															foreach ($destination_types_array as $destination_types_obj)
															{
														?>
																<li class="list-item"><a href="<?php echo get_home_url().'/find-a-hotel?type='.$destination_types_obj['slug'];?>" class=""><?php echo $destination_types_obj['name']; ?></a></li>
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
										</article><!-- col -->

										<article class="sub-menu-item col col3 by-interest">
											<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">By Interest <i class="ico-sprite sprite ico-small-right-black"></i></a>
											<div class="row sub-menu-links-block">
												<a href="javascript:void(0);" class="back-link"><span class="nav-item">By Interest </span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
												<div class="col col10">
													<ul class="unstyled-listing">
														<?php
															$i = 1;
															foreach ($destination_interest_array as $destination_interest_obj)
															{
														?>
																<li class="list-item"><a href="<?php echo get_home_url().'/find-a-hotel?interest='.$destination_interest_obj['slug'];?>" class=""><i class="sprite<?php echo ' ico-'.$destination_interest_obj['slug']; ?>"></i><?php echo $destination_interest_obj['name']; ?></a></li>
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
										</article><!-- col -->
									</div><!-- row -->
								</div><!-- sub-menu -->
							</li>
							<?php
								if(!$city_name)
								{
							?>
									<li class="nav-item "><h3 class="mob-nav-head"> Plan an Event</h3>
										<div class="sub-menu">
											<div class="row">
												<article class="sub-menu-item col col6">
													<!--<h6 class="sub-menu-title">Meetings & Events</h6>-->
													<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">Meetings & Events <i class="ico-sprite sprite ico-small-right-black"></i></a>
													<div class="sub-menu-links-block">
														<a href="javascript:void(0);" class="back-link"><span class="nav-item">Meetings & Events</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
														<div class="text-link-block">
															<div class="row">
																<ul class="unstyled-listing col col3">
																	<?php
																		$i = 1;
																		$max_rows = 4;
																		foreach ($locations_array as $locations_obj)
																		{
																			?>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/meetings-and-events/';?>"><?php echo $locations_obj->name; ?></a></li>
																			<?php
																				if($i == $max_rows)
																				{
																					?>
																					</ul><!-- unstyled-listing -->
																					<ul class="unstyled-listing col col3">
																					<?php

																					$i = 0;$max_rows = 3;
																				}

																				$i++;
																		}
																	?>
																</ul><!-- unstyled-listing col col3 -->	
															</div><!-- row  -->
														</div><!-- text-link-block -->
													</div><!-- sub-menu-links-block -->	
												</article><!-- col -->
												<article class="sub-menu-item col col6">
													<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">Weddings <i class="ico-sprite sprite ico-small-right-black"></i></a>
													<div class="sub-menu-links-block">
														<a href="javascript:void(0);" class="back-link"><span class="nav-item">Weddings</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>

														<div class="text-link-block weddings-block">
															<div class="row">
																<div class="col col4">
																	<div class="weddings-inner-block">
																		<h3 class="item-title">Beach Weddings</h3>
																		<ul class="unstyled-listing ">	
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-goa/weddings/';?>" class="">Goa</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-bekal/weddings/';?>" class="">Bekal</a></li>
																		</ul><!-- unstyled-listing -->	
																	</div><!-- weddings-inner-block -->	
																</div><!-- col4 -->

																<div class="col col4">
																	<div class="weddings-inner-block">
																		<h3 class="item-title">Regal Weddings</h3>
																		<ul class="unstyled-listing ">	
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-udaipur/weddings/';?>" class="">Udaipur</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-jaipur/weddings/';?>" class="">Jaipur</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-srinagar/weddings/';?>" class="">Srinagar</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-khajuraho/weddings/';?>" class="">Khajuraho</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>" class="">Kolkata</a></li>
																		</ul><!-- unstyled-listing -->	
																	</div><!-- weddings-inner-block -->		
																</div><!-- col4 -->

																<div class="col col4">
																	<div class="weddings-inner-block">
																		<h3 class="item-title">City Weddings</h3>
																		<ul class="unstyled-listing ">	
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-delhi/weddings/';?>" class="">New Delhi</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-bangalore/weddings/';?>" class="">Bangalore</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-mumbai/weddings/';?>" class="">Mumbai</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>" class="">Kolkata</a></li>
																			<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-chandigarh/weddings/';?>" class="">Chandigarh</a></li>
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
									<li class="nav-item  experience-lalit"><h3 class='experience-the-lalit mob-nav-head'>Experience the Lalit</h3>
										<div class="sub-menu">
											<div class="row">
												<article class="sub-menu-item col col6">
													<a href="javascript:void(0);" class="nav-item find-a-hotel mob-click">Experiences Across our Destinations <i class="ico-sprite sprite ico-small-right-black"></i></a>
													<div class="row sub-menu-links-block">
														<a href="javascript:void(0);" class="back-link"><span class="nav-item">Experiences Across our Destinations</span> <i class="ico-sprite sprite ico-small-left-black"></i></a>
														<div class="col col4">
															<ul class="unstyled-listing">
																<?php
																	$i = 1;
																	foreach ($locations_array as $locations_obj)
																	{
																		?>
																		<li class="list-item<?php echo ' '.$locations_obj->slug;?>"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/experience-the-lalit';?>" class=""><?php echo $locations_obj->name; ?></a></li>
																		<?php
																		if($i % 5 == 0)
																		{
																				?>
																				</ul><!-- unstyled-listing -->
																			</div><!-- col -->
																			<div class="col col4">
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
							<?php
								}
								else
								{
							?>
									<li class="nav-item experience-lalit<?php if($GLOBALS['current_theme_template']=='experience-the-lalit-template.php' || $GLOBALS['current_theme_template']=='single-experience.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/" class='experience-the-lalit mob-nav-head'>Experience<?php echo ' '.ucfirst($GLOBALS['location'][0]->name); ?></a></li>
									<li class="nav-item meetings-events<?php if($GLOBALS['current_theme_template']=='events-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/" class='meetings-and-events mob-nav-head'>Meetings &amp; Events</a></li>
									<li class="nav-item weddings<?php if($GLOBALS['current_theme_template']=='weddings-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/" class='weddings mob-nav-head'>Weddings</a></li>
									<li class="nav-item offers<?php if($GLOBALS['current_theme_template']=='offers-template.php' || $GLOBALS['current_theme_template']=='single-offer.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/" class='offers mob-nav-head'>Offers</a></li>
							<?php
								}
							?>
						</ul><!-- primary-navigation -->
					</nav><!-- nav -->
				</div><!-- col -->
			</div><!-- container -->
		<?php
			if($GLOBALS['location'])
			{			
		?>
				<div class="quaternary-nav-section"> 
					<div class="nav-bar-fill">
						<div class="fluidRow">
							<div class="container">                        
								<div class='row'>

									<nav class='nav horizontal'>
										
										<input type="hidden" id="city_slug" value="<?php if($city_name != ''){ echo $city_name; }else{ echo ''; } ?>" >
										<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
											<li id="menu-item-514" class="nav-item<?php if($GLOBALS['current_theme_template']=='hotel-template.php'){ echo ' active'; } ?>"><a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/"><i class="sprite ico-overview"></i></a></li>
											<li id="menu-item-515" class="nav-item<?php if($GLOBALS['current_theme_template']=='suite-and-room-template.php' || $GLOBALS['current_theme_template']=='single-suite-and-room.php'){ echo ' active'; } ?>"><a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/"><i class="sprite ico-stay"></i></a></li>
											<li id="menu-item-516" class="nav-item<?php if($GLOBALS['current_theme_template']=='dining-template.php' || $GLOBALS['current_theme_template']=='single-dining.php'){ echo ' active'; } ?>"><a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/"><i class="sprite ico-eat-drink"></i></a></li>
											<li id="menu-item-1805" class="nav-item<?php if($GLOBALS['current_theme_template']=='relax-and-unwind.php'){ echo ' active'; } ?>"><a class="relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/"><i class="sprite ico-relax-unwind"></i></a></li>
											<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='photo-gallery-template.php'){ echo ' active'; } ?>"><a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/"><i class="sprite ico-photo-gallery"></i></a></li>
											<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='location-template.php'){ echo ' active'; } ?>"><a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/"><i class="sprite ico-location"></i></a></li>
											<li class="nav-item book-item"><button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button>	

											<div class="booking-widget clearfix v-align-widget" style="display:none">
												<?php get_template_part( 'includes/booking', 'widget' ); ?>
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

		<div class="booking-widget clearfix pop-up v-align-widget"  id="mobile-book-widget" style="display:none">
			<?php get_template_part( 'includes/booking', 'widget' ); ?>
		</div><!-- booking-widget -->
	</div><!-- mobile-nav -->
<?php
}
else
{
?>
	<div class="desktop-nav<?php if($city_name !=''){ echo ' local-navigation'; }?><?php if($city_name != '') { echo  ' '.$city_name; } ?>">
		<div class="container primary-nav<?php if($city_name !=''){ echo ' local-nav'; }else{ echo ' sticy-nav'; } ?>">
			<div class="row">
				<div class="col col2">
					<a class="logo<?php if($city_name !=''){ echo ' local-city-logo'; }else{ echo ''; } ?>" href="/" itemprop="url" title="The Lalit"><img src="<?php if($city_name != ''){ echo wp_get_attachment_url($property_logo); } else{ echo get_stylesheet_directory_uri().'/images/head-logo.png'; } ?>" itemprop="logo" alt="The Lalit"></a>
				</div><!-- col -->

				<div class="col col10<?php if($city_name !=''){ echo ' local-global-nav'; }else{ echo ''; } ?>">
                  
                     
					<nav class="nav horizontal align-right">
						<ul class="top-navigation">
                            <?php if($city_name){ ?><li class="nav-item our_hotel"><a href="<?php echo site_url();?>/find-a-hotel/"> Our Hotels</a></li><?php } ?>
							<li class="nav-item global-nav-menu-top<?php if($post->ID=='4233'){ echo ' active'; } ?>"><a href="<?php echo site_url(); ?>/the-lalit-loyalty/">The Lalit Loyalty</a></li>						

							<?php
							if($city_name != 'mangar' && $city_name != 'london')
							{
							?>
							<li class="nav-item global-nav-menu-top clickme"><a href="javascript:void(0);"><i class="ico-sprite sprite size-15 ico-bell"></i> Speak to Guest Relations</a></li>
							<?php
							}
							?>

							<li class="nav-item global-nav-menu-top<?php if($GLOBALS['current_theme_template'] == 'contact-us-hotel-template.php' || $GLOBALS['current_theme_template'] == 'contact-us-template.php'){ echo ' active'; } ?>"> <a href="<?php if($GLOBALS['location'][0]->slug){ echo site_url().'/the-lalit-'.$GLOBALS['location'][0]->slug.'/contact-us/'; }else{ echo site_url().'/contact-us/'; } ?>"> <i class="ico-sprite sprite size-15 ico-tel"></i> Contact Us</a></li>		
						</ul><!-- top-navigation -->
						<ul class="primary-navigation">
							<?php
								if(!$city_name)
								{
									?>
									<li class="nav-item"><a href="<?php echo home_url();?>/find-a-hotel/" class="find-a-hotel">Find a Hotel</a>
										<div class="sub-menu">
											<div class="row">
												<article class="sub-menu-item col col6">
													<h6 class="sub-menu-title title-underline">By Destination</h6>
													<div class="row sub-menu-links-block">
														<div class="col col4">
															<ul class="unstyled-listing">
															<?php
																$i = 1;
																foreach ($locations_array as $locations_obj)
																{
															?>
																	<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug;?>" class=""><?php echo $locations_obj->name; ?></a></li>
																	<?php
																	if($i % 5 == 0)
																	{
																	?>
																			</ul><!-- unstyled-listing -->
																		</div><!-- col -->
																		<div class="col col4">
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

												<article class="sub-menu-item col col3">
													<h6 class="sub-menu-title title-underline">By Type</h6>
													<div class="row sub-menu-links-block">
														<div class="col col10">
															<ul class="unstyled-listing">
															<?php
																$i = 1;
																foreach ($destination_types_array as $destination_types_obj)
																{
																	?>
																	<li class="list-item"><a href="<?php echo get_home_url().'/find-a-hotel?type='.$destination_types_obj['slug'];?>" class=""><?php echo $destination_types_obj['name']; ?></a></li>
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
												</article><!-- col -->

												<article class="sub-menu-item col col3">
													<h6 class="sub-menu-title title-underline">By Interest</h6>
													<div class="row sub-menu-links-block">
														<div class="col col10">
															<ul class="unstyled-listing">
															<?php
																$i = 1;
																foreach ($destination_interest_array as $destination_interest_obj)
																{
																	?>
																	<li class="list-item"><a href="<?php echo get_home_url().'/find-a-hotel?interest='.$destination_interest_obj['slug'];?>" class=""><i class="sprite<?php echo ' ico-'.$destination_interest_obj['slug']; ?>"></i><?php echo $destination_interest_obj['name']; ?></a></li>
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
												</article><!-- col -->
											</div><!-- row -->
										</div><!-- sub-menu -->
									</li>
									<li class="nav-item  plan-event"><a href="javascript:void(0);">Plan an Event</a>
										<div class="sub-menu">
											<div class="row">
												<article class="sub-menu-item col col6">
													<h6 class="sub-menu-title">Meetings & Events</h6>
													<div class="img-block">
														<div style="background: url(<?php echo site_url(); ?>/wp-content/themes/lalit/images/meetings-events.jpg) no-repeat left top"></div>	
													</div><!-- img-block -->
													<div class="text-link-block">
														<div class="row">
															<ul class="unstyled-listing col col3">
																<?php
																	$i = 1;
																	$max_rows = 4;
																	foreach ($locations_array as $locations_obj)
																	{
																		?>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/meetings-and-events/';?>"><?php echo $locations_obj->name; ?></a></li>
																		<?php
																			if($i == $max_rows)
																			{
																				?>
																				</ul><!-- unstyled-listing -->
																				<ul class="unstyled-listing col col3">
																				<?php

																				$i = 0;$max_rows = 3;
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
																	
																	<ul class="unstyled-listing ">	
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-goa/weddings/';?>" class="">Goa</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-bekal/weddings/';?>" class="">Bekal</a></li>
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
																	<ul class="unstyled-listing ">	
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-udaipur/weddings/';?>" class="">Udaipur</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-jaipur/weddings/';?>" class="">Jaipur</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-srinagar/weddings/';?>" class="">Srinagar</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-khajuraho/weddings/';?>" class="">Khajuraho</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>" class="">Kolkata</a></li>
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
																	<ul class="unstyled-listing">	
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-delhi/weddings/';?>" class="">New Delhi</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-bangalore/weddings/';?>" class="">Bangalore</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-mumbai/weddings/';?>" class="">Mumbai</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-kolkata/weddings/';?>" class="">Kolkata</a></li>
																		<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-chandigarh/weddings/';?>" class="">Chandigarh</a></li>
																	</ul><!-- unstyled-listing -->	
																</div><!-- weddings-inner-block -->		
															</div><!-- col4 -->
														</div><!-- row -->
														<?php /*<a href="" class="text-link">Contact our wedding specialits <i class="ico-sprite sprite ico-red-right-arrow"></i></a> */?>
													</div><!-- text-link-block -->	
												</article><!-- col -->
											</div><!-- row -->
										</div><!-- sub-menu -->
									</li>
									<li class="nav-item experience-lalit"><a href="javascript:void(0);" class='experience-the-lalit'>Experience the LaLiT</a>
										<div class="sub-menu">
											<div class="row">
												<div class="align-center">
													<ul class="unstyled-listing  first-col img-grid">
														<ul class="unstyled-listing img-inner-grid clearfix">
															<li class="exp-bangalore">
																<a href="<?php echo site_url(); ?>/the-lalit-bangalore/experience-the-lalit/" class="hotels-block img-grid-bangalore">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/bangalore.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Bangalore</span>  
						                    					</a>
						                    				</li>
															<li class="exp-chandigarh">
																<a href="<?php echo site_url(); ?>/the-lalit-chandigarh/experience-the-lalit/" class="hotels-block img-grid-chandigarh">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/chandigarh.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Chandigarh</span>  
						                    					</a>
															</li>
														</ul><!-- img-inner-grid -->
													</ul><!-- col col2 -->

													<ul class="unstyled-listing sec-col img-grid">
														<ul class="unstyled-listing img-inner-grid clearfix">
															<li class="exp-bekal">
																<a href="<?php echo site_url(); ?>/the-lalit-bekal/experience-the-lalit/" class="hotels-block img-grid-bekal">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/bekal.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Bekal</span>  
						                    					</a>
															</li>
															<li class="no-link no-link-exp-golf">
																<a href="javascript:void()" class="hotels-block img-grid-golf">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/golf.jpg"/><!-- hotel-img-Block -->
						                    					</a>
															</li>
															<li class="exp-goa">
																<a href="<?php echo site_url(); ?>/the-lalit-goa/experience-the-lalit/" class="hotels-block img-grid-goa">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/goa.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Goa</span>  
						                    					</a>
															</li>
														</ul><!-- img-inner-grid -->
													</ul><!-- col col3 -->

													<ul class="unstyled-listing third-col img-grid">
														<ul class="unstyled-listing img-inner-grid clearfix">
															<li class="exp-khajuraho">
																<a href="<?php echo site_url(); ?>/the-lalit-khajuraho/experience-the-lalit/" class="hotels-block img-grid-khajuraho">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/khajuraho.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Khajuraho</span>  
						                    					</a>
															</li>
															
															<li class="exp-jaipur">
																<a href="<?php echo site_url(); ?>/the-lalit-jaipur/experience-the-lalit/" class="hotels-block img-grid-jaipur">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/jaipur.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Jaipur</span>  
						                    					</a>
															</li>
														</ul><!-- img-inner-grid -->
													</ul><!-- col col2 -->

													<ul class="unstyled-listing forth-col img-grid">
														<ul class="unstyled-listing  img-inner-grid">
															<li class="exp-kolkata">
																<a href="<?php echo site_url(); ?>/the-lalit-kolkata/experience-the-lalit/" class="hotels-block img-grid-kolkata">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/kolkata.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Kolkata</span>  
						                    					</a>
															</li>
															<li class="exp-mangar">
																<a href="<?php echo site_url(); ?>/the-lalit-mangar/experience-the-lalit/" class="hotels-block img-grid-mangar">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/mangar.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Mangar</span>  
						                    					</a>
															</li>
															
															<li class="no-link no-link-exp-collage-box">
																<a href="javascript:void()" class="hotels-block img-grid-collage-box">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/collage-box.jpg"/><!-- hotel-img-Block -->
						                    					</a>
															</li>
															<li class="img-new-delhi exp-new-delhi">
																<a href="<?php echo site_url(); ?>/the-lalit-delhi/experience-the-lalit/" class="hotels-block img-grid-new-delhi">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/new-delhi.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">New Delhi</span>  
						                    					</a>
															</li>
															<li class="img-grid-mumbai exp-mumbai">
																<a href="<?php echo site_url(); ?>/the-lalit-mumbai/experience-the-lalit/" class="hotels-block img-grid-mumbai">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/mumbai.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Mumbai</span>  
						                    					</a>
															</li>
														</ul><!-- img-inner-grid -->
													</ul><!-- col col7 -->

													<ul class="unstyled-listing fifth-col img-grid">
														<ul class="unstyled-listing img-inner-grid clearfix">
															<li class="exp-srinagar">
																<a href="<?php echo site_url(); ?>/the-lalit-srinagar/experience-the-lalit/" class="hotels-block img-grid-srinagar">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/srinagar.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Srinagar</span>  
						                    					</a>
															</li>
															<li class="no-link no-link-exp-sweets">
																<a href="javascript:void()" class="hotels-block img-grid-sweets">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/sweets.jpg"/><!-- hotel-img-Block -->
						                    					</a>
															</li>
															<li class="exp-udaipur">
																<a href="<?php echo site_url(); ?>/the-lalit-udaipur/experience-the-lalit/" class="hotels-block img-grid-udaipur">
																	<img class="hotel-img-Block hotel-img" src="/wp-content/themes/lalit/images/experience-mega-nav/udaipur.jpg"/><!-- hotel-img-Block -->
						                                    		<span class="item-title">Udaipur</span>  
						                    					</a>
															</li>
														</ul><!-- img-inner-grid -->
													</ul><!-- col col7 -->
												</div><!-- col -->	
											</div><!-- row -->
										</div><!-- sub-menu -->	
									</li>
									<?php
									if(isIPad())
									{
									?>
										<li class="nav-item book-item">
											<!--<button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button>-->
											<a href="#mobile-book-widget" class="mobile-book-stay"><button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button></a>
										</li>
									<?php
									}
									else
									{
									?>
									<li class="nav-item book-item"><button type="button" class="btn tertiary-btn booking-nav-btn">Book A Stay</button>

										<div class="booking-widget clearfix v-align-widget" style="display:none" id="mobile-book-widget">
												<?php get_template_part( 'includes/booking', 'widget' ); ?>
										</div><!-- booking-widget -->

									</li>
									<?php
									}
								}
								else
								{
									?>
									<li class="nav-item experience-lalit<?php if($GLOBALS['current_theme_template']=='experience-the-lalit-template.php' || $GLOBALS['current_theme_template']=='single-experience.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/experience-the-lalit/" class='experience-the-lalit'>Experience<?php echo ' '.ucfirst($GLOBALS['location'][0]->name); ?></a></li>
									<li class="nav-item meetings-events<?php if($GLOBALS['current_theme_template']=='events-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/meetings-and-events/" class='meetings-and-events<?php echo " ".$city_name; ?>'>Meetings &amp; Events</a></li>
									<li class="nav-item weddings<?php if($GLOBALS['current_theme_template']=='weddings-template.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/weddings/" class='weddings'>Weddings</a></li>
									<li class="nav-item offers<?php if($GLOBALS['current_theme_template']=='offers-template.php' || $GLOBALS['current_theme_template']=='single-offer.php'){ echo ' active'; } ?>"><a href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/offers/" class='offers'>Offers</a></li>
									<!--<<li class="nav-item"><a href="#">Gifting</a></li>-->
									<?php
								}
							?>
						</ul><!-- primary-navigation -->
					</nav>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<?php
				if($GLOBALS['location'])
				{	
		?>
					<div class="quaternary-nav-section"> 
						<div class="nav-bar-fill">
							<div class="fluidRow">
								<div class="container">                        
									<div class='row'>

										<nav class='nav horizontal'>
											
											<input type="hidden" id="city_slug" value="<?php if($city_name != ''){ echo $city_name; }else{ echo ''; } ?>" >
											<ul id="menu-hotel-secondary-nav-delhi" class="align-right">
												<li id="menu-item-514" class="nav-item<?php if($GLOBALS['current_theme_template']=='hotel-template.php'){ echo ' active'; } ?>"><a class="overview sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/">Overview</a></li>
												<li id="menu-item-515" class="nav-item<?php if($GLOBALS['current_theme_template']=='suite-and-room-template.php' || $GLOBALS['current_theme_template']=='single-suite-and-room.php'){ echo ' active'; } ?>"><a class="stay sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/suites-and-rooms/">Stay</a></li>
												<li id="menu-item-516" class="nav-item<?php if($GLOBALS['current_theme_template']=='dining-template.php' || $GLOBALS['current_theme_template']=='single-dining.php'){ echo ' active'; } ?>"><a class="eat-and-drink sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/eat-and-drink/">Eat &amp; Drink</a></li>
												<li id="menu-item-1805" class="nav-item<?php if($GLOBALS['current_theme_template']=='relax-and-unwind.php'){ echo ' active'; } ?>"><a class="relax-and-unwind sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/relax-and-unwind/">Relax &amp; Unwind</a></li>
												<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='photo-gallery-template.php'){ echo ' active'; } ?>"><a class="photo-gallery sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/photo-gallery/">Photo Gallery</a></li>
												<li id="menu-item-518" class="nav-item<?php if($GLOBALS['current_theme_template']=='location-template.php'){ echo ' active'; } ?>"><a class="location sec_nav_menu" href="<?php echo get_site_url(); ?>/the-lalit-<?php echo $city_name; ?>/location/">Location</a></li>

												<?php
												if(isIPad())
												{
												?>
													<li class="nav-item book-item">
														<a href="#mobile-book-widget" class="mobile-book-stay"><button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button></a>
													</li>
												<?php
												}
												else
												{
												?>
												<li class="nav-item book-item">
													<button type="button" class="btn primary-btn booking-nav-btn">Book A Stay</button>

													<div class="booking-widget clearfix v-align-widget" style="display:none">
															<?php get_template_part( 'includes/booking', 'widget' ); ?>
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
	
	if(isIPad())
	{
?>
		<div class="booking-widget clearfix pop-up v-align-widget"  id="mobile-book-widget" style="display:none">
			<?php get_template_part( 'includes/booking', 'widget' ); ?>
		</div><!-- booking-widget -->
<?php
	}
}
?>
</header><!-- content-section -->