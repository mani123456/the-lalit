<?php
   
   $terms_obj =  get_terms('locations');

   $terms_array = array();

   foreach ($terms_obj as $obj) {
      array_push($terms_array, $obj->name);
   }
   
   $args = array(
      'post_type'=>'destination',
      'post_status'=>'publish',
      'posts_per_page'=>'-1',
      'tax_query' => array(
            array(
               'taxonomy' => 'locations',
               'field'    => 'Name',
               'terms'    => $terms_array
            )
         )
   );

   $destinations_loop = new WP_Query($args);
   $awards_by_destinations = array();
   while ($destinations_loop->have_posts()):$destinations_loop->the_post();

      $hotel_name = get_post_meta(get_the_id(), 'name', true);

      if(get_post_meta(get_the_id(), 'hotel_awards', true)){

         $awards_by_destinations[$hotel_name] = get_post_meta(get_the_id(), 'hotel_awards', true);
      }

   endwhile;
   wp_reset_postdata();
?>
<div class="content-section small-banner">
   <div class="container align-center small-banner-sec awards-banner-sec">
      <div class="row">
         <div class="banner-content">
            <h1 class="main-title text-shadow">Awards</h1>
         </div>
         <!-- banner-content -->
      </div>
      <!-- row -->
   </div>
   <!-- container -->
   <div class="container intro-text align-center">
      <div class="row">
         <?php

         foreach($awards_by_destinations as $key => $value){

            $count = 1;
         ?>
        <div class="awards-bdr-bottom">
	        <h2 class="sec-title section-space"><?php echo $key; ?></h2>
	        <ul class="award-list">
	           <?php
	           
	           $award_id_count = count($value);
	           foreach ($value as $award_id) {

	              $award_post = get_post($award_id);
	              $award_title = get_post_meta($award_id, 'name', true);
	              $award_body = get_the_terms($award_id, 'award-body');
	              //$award_description = apply_filters('the_content', $award_post->post_content);
	              $award_to = get_post_meta($award_id, 'awarded_to', true);

	              $award_logo = '';
	              $award_logo = get_post_meta($award_id, 'image', true);

	              if(!$award_logo || $award_logo != '')
	              {

	              		$term_id = $award_body[0]->term_id;
		            	$meta_data = get_term_meta($term_id);
		            	foreach($meta_data as $data)
		            	{
		            		$award_logo = $data[0];
		            	}
	              }
	              else if($award_logo){

	              		$award_logo_array = wp_get_attachment_image_src($award_logo, array('200','125'));
	              		$award_logo = $award_logo_array[0];
	              }

	              if(get_post_status ( $award_id ) == 'publish'){
							if($award_title || $award_logo){
								?>
								<li class="span span3 awards-span">
									<div class="reward-item">
										<?php

										if($award_logo){
										?>
										<div class="reward-logo">
											<img src="<?php echo $award_logo; ?>" class="image js_image_load image-tag" alt="<?php echo $award_title; ?>" title="<?php echo $award_title; ?>" data-src="<?php echo $award_logo; ?>" style="display: inline;">
										</div>
										<?php
										}

										if($award_title || $award_to){
										?>
										<div class="reward-meta">
											<?php if($award_to){ ?><strong><?php echo $award_to; ?></strong><?php } ?>
											<?php if($award_title){ ?><span><?php echo $award_title; ?></span><?php } ?>
										</div>
										<?php
										}
										?>
									</div>
								</li>
								<?php
							}

							$count++;
						}

	              if($count % 5 == 0 && $award_id_count != ($count-1)){
	                 ?>
	                 </ul>
	                 <ul class="award-list">
	                 <?php
	              }
	           }
	           ?>
	        </ul>
        </div>
         <?php
         }
         ?>
      </div>
   </div>
   <!-- row -->
</div>
<!-- container -->
</div><!-- content-section -->