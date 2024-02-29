<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
?>
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
				<div class="content-section">
					<div class="container section-space intro-text align-center four-zero-four">
						<div class="row">
							<h1 class="main-title text-black">Ooops! 404 pages are like being on the wrong floor...!</h1>
							<div class="row">
								<div class="col8 align-content-center">
									<p class="disp-text">Sorry that you found your way here.<br/>Its time to get you to your room... Let us help you find you the right door...!</p>
									<div class="btn-block">
										<a href="<?php echo home_url(); ?>/" class="btn tertiary-btn booking-nav-btn">Home</a>
										<a href="<?php echo home_url(); ?>/find-a-hotel/" class="btn tertiary-btn booking-nav-btn">Find a Hotel</a>
									</div><!-- btn-block -->	

									<div class="divider-block">
										<span class="lbl-or">Or</span>
									</div><!-- divider-block -->

									<div class="pick-destination">
										<h6 class="sub-menu-title">Pick a destination</h6>

										<div class="row destination-links">
											<div class="col col8 align-content-center">
												<div class="row">
													<div class="col col3">
														<ul class="unstyled-listing">
															<?php
																$i = 1;
																$max_rows = 4;
																foreach ($GLOBALS['locations_array'] as $locations_obj)
																{
																	?>
																	<li class="list-item"><a href="<?php echo get_home_url().'/the-lalit-'.$locations_obj->slug.'/';?>" class=""><?php echo $locations_obj->name; ?></a></li>
																	<?php
																		if($i == $max_rows)
																		{
																			?>
																				</ul><!-- unstyled-listing -->
																			</div>
																			<div class="col col3">
																				<ul class="unstyled-listing">
																			<?php

																			$i = 0;$max_rows = 3;
																		}

																		$i++;
																}
															?>
														</ul><!-- unstyled-listing -->
													</div><!-- col -->
												</div><!-- row -->	
											</div><!-- col -->
											<div class="motif-img">
												<img src="/wp-content/uploads/2017/04/The-Lalit-Motif.png" alt="">
											</div><!-- motif-img -->
										</div><!-- destination-links -->	
									</div><!-- pick-destination -->	
								</div><!-- col6 -->	
							</div><!-- row -->	
						</div><!-- row -->
					</div><!-- container -->
				</div><!-- content-section -->
			<?php get_footer(); ?>
		</div><!-- main-wrap -->
	</body>
</html>
