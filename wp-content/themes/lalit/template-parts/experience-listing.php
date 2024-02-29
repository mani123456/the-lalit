<?php
$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
if ($destination_obj->have_posts()) :
	while ($destination_obj->have_posts()) : $destination_obj->the_post();

		$hotel_experiences = get_post_meta($post->ID, "hotel_experiences", true);

		$GLOBALS['address'] = get_post_meta($post->ID, "address", true);
		$GLOBALS['email'] = get_post_meta($post->ID, "email", true);
		$GLOBALS['phone'] = get_post_meta($post->ID, "phone", true);
		$GLOBALS['fax'] = get_post_meta($post->ID, "fax", true);

	endwhile;
endif;
?>

<div class="content-section">
	<?php
	if ($hotel_experiences) {
		foreach ($hotel_experiences as $experience_id) {
			if (get_post_status($experience_id) == 'publish') {
				$experience_category_ids[] = get_post_meta($experience_id, "experience_category", true);
			}
		}

		$experience_category_ids = array_unique($experience_category_ids);

		$count = 1;
		foreach ($experience_category_ids as $experience_category_id) {
			$experience_category_title = get_post_meta($experience_category_id, "category_title", true);
			$experience_category_description = wpautop(get_post_meta($experience_category_id, "description", true));
			$experience_category_banner_image_id = get_post_meta($experience_category_id, "banner_image", true);
			$experience_category_banner_image = wp_get_attachment_url($experience_category_banner_image_id);
			$experience_category_types = get_the_terms($experience_category_id, 'experience-category-type');
			$category_type = $experience_category_types[0]->name;

			if ($count == 1) {
				$attr = 'visible';
			} else {
				$attr = '';
			}
	?>
			<section class="cd-section <?php echo $attr; ?>">
				<div class="sec-banner" style="background: url('<?php echo $experience_category_banner_image; ?>') no-repeat left top;background-size: contain !important;">
					<div class="exp-listing">
						<div class="exp-listing-block">
							<h2 class="item-title">
								<small><?php echo $category_type; ?></small>
								<?php echo $experience_category_title; ?>
							</h2>
							<p><?php echo $experience_category_description; ?></p>
							<?php
							$type_array = explode(" ", $category_type);
							?>
							<span class="links-intro-text">Explore our <?php echo ucfirst($type_array[2]); ?> Experiences:</span>
							<ul class="unstyled-listing underline-list">
								<?php
								foreach ($hotel_experiences as $experience_id) {
									$exp_cat_id = get_post_meta($experience_id, 'experience_category', true);

									if ($exp_cat_id == $experience_category_id) {
										$experience_name = get_post_meta($experience_id, 'name', true);
										$experience_link = get_permalink($experience_id);
								?>
										<li>
											<a href="<?php echo $experience_link; ?>" target="_blank" data-id="<?php echo $experience_id; ?>" class="grey-text-link popup-link">
												<?php echo $experience_name; ?>
												<i class="ico-sprite sprite ico-white-right-arrow"></i>
											</a>
										</li>
								<?php
									}
								}
								?>

							</ul>
						</div><!-- exp-listing-block -->

						<span class="overlay"></span>
					</div><!-- exp-listing -->
				</div><!-- sec-banner -->
			</section>
		<?php
			$count++;
		}
		?>
		<nav>
			<ul class="cd-vertical-nav">
				<li><a href="#0" class="cd-prev inactive">Next</a></li>
				<li><a href="#0" class="cd-next">Prev</a></li>
			</ul>
		</nav><!-- .cd-vertical-nav -->
	<?php
	}
	?>
</div><!-- content-section -->