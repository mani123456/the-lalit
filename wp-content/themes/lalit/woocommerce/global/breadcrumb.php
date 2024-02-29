<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	$position = 1;
	$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
	$hotel_name = '';
	if($destination_obj->have_posts()){

		while($destination_obj->have_posts()){
			
			$destination_obj->the_post();
			$hotel_name = get_post_meta(get_the_id(), 'name', true);
		}

	}
	wp_reset_postdata();

	$itemList = [];
	$itemList[0]['@type'] = 'ListItem';
	$itemList[0]['position'] = $position;
	$itemList[0]['item']['@id'] = site_url().'/';
	$itemList[0]['item']['name'] = 'Home';


	$itemList[1]['@type'] = 'ListItem';
	$itemList[1]['position'] = $position + 1;
	$itemList[1]['item']['@id'] = site_url().'/the-lalit-'.$GLOBALS['location'][0]->slug.'/';
	$itemList[1]['item']['name'] = $hotel_name;




	$GLOBALS['breadcrumb'] = $breadcrumb;
	
	$p_id = get_the_ID();
	$p_name = get_post_meta($p_id, 'woocommerce_product_display_name', true);
	echo $wrap_before;

	$breadcrumb_count = 0;
	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if($breadcrumb_count == 0)
		{
			//if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<a class="breadcrumb-link" href="'.esc_url( $crumb[1] ).'">All offers at ' . esc_html( $crumb[0] ) . '</a>';
			/*} else {
				$a = explode(" ", $crumb[0]);
				array_pop($a);
				array_pop($a);
				$text = implode($a, " ");
				echo '<span class="breadcrumb-last-text">'.esc_html( trim($text) ).'</span>';
			}*/
			$itemList[2]['@type'] = 'ListItem';
			$itemList[2]['position'] = $position + 2;
			$itemList[2]['item']['@id'] = esc_url( $crumb[1] );
			$itemList[2]['item']['name'] = 'Offers At The Lalit '.ucfirst($GLOBALS['location'][0]->slug);
		}
		else
		{
			if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) 
			{
				echo '<a class="breadcrumb-link" href="'.esc_url( $crumb[1] ).'">' . esc_html( $crumb[0] ) . '</a>';

				$itemList[3]['@type'] = 'ListItem';
				$itemList[3]['position'] = $position + 3;
				$itemList[3]['item']['@id'] = esc_url( $crumb[1] );
				$itemList[3]['item']['name'] = esc_html( $crumb[0] );
			} 
			else 
			{
				
				echo '<span class="breadcrumb-last-text">'.esc_html( trim($p_name) ).'</span>';
				
				$itemList[4]['@type'] = 'ListItem';
				$itemList[4]['position'] = $position + 4;
				$itemList[4]['item']['@id'] = get_the_permalink();
				$itemList[4]['item']['name'] = esc_html( trim($p_name) );
			}
		}
		

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo "/";
		}
		$breadcrumb_count++;

	}

	echo $wrap_after;
	?>
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": <?php echo json_encode($itemList); ?>
	}
	</script>
	<?php
}
