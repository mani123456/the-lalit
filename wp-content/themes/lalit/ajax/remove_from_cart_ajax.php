<?php

	/*if ($_POST['jsonDataObj']) {
		
		$jsonDataObj = stripslashes($_POST['jsonDataObj']);
	  	$device = json_decode($jsonDataObj, true);
	  	$isMobile = $device['isMobile'];


		global $woocommerce;
	    $items = $woocommerce->cart->get_cart();
    	$i = 0;
    	$new_html = '';

        foreach($items as $item => $values) {

            $product =  wc_get_product( $values['data']->get_id());
       		if($product->is_virtual()){

	        	$product_id = $product->parent_id;
	        }
	        else{

				$product_id = $product->get_id();
	        }

	        $product_hotel_id = get_post_meta($product_id, 'hotel_product', true);
       		$product_hotel_name = get_post_meta($product_hotel_id[0], 'name', true);

       		$product_location_taxonomies = get_the_terms($product_hotel_id[0],'locations');

       		if($product_location_taxonomies){

       			foreach ($product_location_taxonomies as $product_location_taxonomy) {
       			
	       			if(!in_array($product_location_taxonomy->slug, $locations_array)){

		       			array_push($locations_array, $product_location_taxonomy->slug);
		       			$new_html .= '<p><a class="product-detail-category-link" href="'.site_url().'/the-lalit-'.$product_location_taxonomy->slug.'/offers/">View All Offers at '.$product_hotel_name.'<i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a></p>';
		       		}
	       		}
       		}
        }

		if( WC()->cart->get_cart_contents_count() != 0 )
		{
			$new_html .= '<h4 class="hotel-link-header">Browse All Other Offers</h4>';
		}
		else
		{
			$new_html .= '<h4 class="hotel-link-header">Browse Offers In</h4>';
		}
		if($isMobile)
		{
			$new_html .= '<div class="row sub-menu-links-block"><div class="mob-col mob-col6"><ul class="unstyled-listing">';
			$i = 1;
			foreach($locations as $l)
			{
				if($l->slug != 'london' && !in_array($l->slug, $locations_array)) 
				{
					$new_html .= '<li class="list-item"><a class="hotel-link" href="'.site_url().'/the-lalit-'.$l->slug.'/offers/">'.$l->name.'<i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a></li>';

					if( $i % 6 == 0 && $i < count($locations)-1)
					{
						$new_html .= '</ul><!-- unstyled-listing --></div><!-- col --><div class="mob-col mob-col6"><ul class="unstyled-listing">';
					}
					$i++;
				}
			}
			
			$new_html .= '</ul><!-- unstyled-listing --></div><!-- col --></div><!-- row -->';
		}
		else
		{
			$new_html .= '<div class="row sub-menu-links-block"><div class="col col3"><ul class="unstyled-listing">';
			$i = 1;
			foreach($locations as $l)
			{
				if($l->slug != 'london' && !in_array($l->slug, $locations_array)) 
				{
					$new_html .= '<li class="list-item"><a class="hotel-link" href="'.site_url().'/the-lalit-'.$l->slug.'/offers/">'.$l->name.'<i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a></li>';
					if( $i % 3 == 0 && $i < count($locations)-1)
					{
						$new_html .= '</ul><!-- unstyled-listing --></div><!-- col --><div class="col col3"><ul class="unstyled-listing">';
					}
					$i++;
				}
			}

			$new_html .= '</ul><!-- unstyled-listing --></div><!-- col --></div><!-- row -->';
		}

		$msg['new_html'] = $new_html;
		echo json_encode($msg['new_html'], true);
	}*/
?>