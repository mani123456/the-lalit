<?php

$destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

$gallery_obj = array();
if( $destination_obj->have_posts() ) : 
   	while($destination_obj->have_posts()) : $destination_obj->the_post();

   		$photo_galleries_object = get_post_meta( $post->ID, "photo_galleries", true);
   			
		$hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);

	   	$GLOBALS['address'] = get_post_meta($post->ID,"address",true);
	    $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
	    $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
	    $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
	    $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true);

   	endwhile;
endif;

$gallery_categories = array();
$image_array = array();
if($photo_galleries_object)
{
   	$c = 0;
   	foreach($photo_galleries_object as $photo_gallery_id)
   	{
        if(get_post_status ( $photo_gallery_id ) == 'publish')
        {
            $gallery_category_obj = get_the_terms($photo_gallery_id, 'gallery-category');
            if($gallery_category_obj)
            {   
                foreach($gallery_category_obj as $gallery_category)
                {
                    $term_id = $gallery_category->term_id;
                    $gallery_categories[$c] = $term_id;
                }
            }

            $gallery_images = get_post_meta( $photo_gallery_id, "images", true);
            $gallery_images = explode(",", $gallery_images);
               
            foreach($gallery_images as $image_id)
            {
                if(isMobile())
                {   
                 	$image = wp_get_attachment_image_src($image_id, 'box_image');
                 	$image_url = $image[0];
                 	$image_width = $image[1];
                 	$image_heigth = $image[2];
                }
                else
                {     	
                 	$image = wp_get_attachment_image_src($image_id, 'medium_large');
                 	$image_url = $image[0];
                 	$image_width = $image[1];
                 	$image_heigth = $image[2];
                }

                if($image_url)
                {
                	$meta_data = wp_get_attachment($image_id);
                 	$image_array[$c]['category'] = $category;
                 	$image_array[$c]['t_id'] = $term_id;
                 	$image_array[$c]['image_caption'] = $meta_data['description'];
                 	if($image_array[$c]['image_caption'] == '')
                 	{
                 		$image_array[$c]['image_caption'] = $meta_data['caption'];
                 	}
                 	$image_array[$c]['image'] = $image_url;
                 	$image_array[$c]['image_width'] = $image_width;
                 	$image_array[$c]['image_height'] = $image_heigth;
                 	$c++;
                }     
            }
        }
    }
}

array_unique($gallery_categories);
$terms = get_terms( array(
    'taxonomy' => 'gallery-category',
    'hide_empty' => false,
) );
$total_gallery_categories = array();
foreach($terms as $value)
{
	$total_gallery_categories[] = $value->term_id;
}
?>

<div class="content-section">	
<?php
    if($hotel_additional_information)
    {
        foreach($hotel_additional_information as $info_id)
        {
            $gallery_title = get_post_meta($info_id, 'gallery_title', true);
            $gallery_description = wpautop(get_post_meta($info_id, 'gallery_description', true));
        }

        if($gallery_title && $gallery_description)
        {
?>
	        <div class="container section-space intro-text align-center">
	            <div class="row">
	                <div class="seperator"></div>
	                <?php
	                if($gallery_title)
	                {
	                ?>
	                    <h4 class="sec-title"><?php echo $gallery_title; ?></h4>
	                <?php
	                }
	                ?>

	                <?php
	                if($gallery_description)
	                {
	                ?>
	                    <div class="col col10 align-content-center "><?php echo $gallery_description; ?></div>
	                <?php
	                }
	                ?>      
	            </div> 
	        </div>
<?php

    	}

    }
?>


<?php
	if($image_array && count($image_array) > 0)
	{
		shuffle($image_array);
?>
		<div class="">
			<div class="container gallery-sec">
				<div class="row">

				<?php
				if(count($total_gallery_categories) > 0 && $gallery_categories && count($gallery_categories) > 0)
				{
				?>
					<nav class="nav horizontal tertiary-nav align-center" style="display:none;">
		                <ul>
		                <?php
		                foreach($total_gallery_categories as $cat)
		                {
		                	if(in_array($cat, $gallery_categories))
		                	{   	
		                		$term = get_term($cat, 'gallery-category');
		                		$name = $term->name;
		                		$term_id = $term->term_id;
		                ?>
			                	<li class="nav-item">
			                		<a href="<?php echo $term_id; ?>" class=""><?php echo $name; ?></a>
			                	</li>
		                <?php
		                	}	
		                }
		                ?> 
		                	<li class="nav-item">
		                		<a href="all">All</a>
		                	</li> 	
		                </ul>
		            </nav><!-- nav -->
		        <?php
		    	}
		        ?>

			        <div class="content">
			        	<div id="loader" style="display:none;">
				            <span class="loader-icon"></span>
				        </div><!-- loader -->
			        	<div class="grid" id="grid" style="position:relative;min-height:500px;">
			        	<?php
			        	foreach($image_array as $image)
			        	{ 		
			        	?>
			        			<div class="grid__item <?php echo $image['t_id']; ?> item" data-size="<?php echo $image['image_width']; ?>x<?php echo $image['image_height']; ?>" style="opacity:0;min-height:150px;min-width:150px;" data-url="<?php echo $image['image']; ?>">
	                    			<a href="<?php echo $image['image']; ?>" class="img-wrap">
	                    				<img class="image" alt="<?php echo $image['image_caption']; ?>" title="<?php echo $image['image_caption']; ?>" data-src=""/>
	                      				<div class="description description--grid"><?php echo $image['image_caption']; ?></div>
	                    			</a>
	                  			</div>
			        	<?php
			        	}
			        	?>
			        	</div><!-- grid -->

			        	<div class="preview">
			        		<button class="action action--close"><i class="ico-sprite sprite size-24 ico-grey-close"></i></button>
			        		<div class="description description--preview"></div>
			        	</div><!-- preview -->
			        </div><!-- /content -->

				</div><!-- row -->	
			</div><!-- container -->
        </div><!-- content-section --> 
<?php

	}
?>
</div>