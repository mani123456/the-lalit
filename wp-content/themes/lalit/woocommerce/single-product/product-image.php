<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
if(isMobile())
{
 	$thumbnail_size    = 'shop_catalog';
}
else
{
	$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
}
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="row">
	<div class="col col12">
		<div class="product-detail-breadcrumb">
			<?php
			/**
			 * the_lalit_breadcrum hook.
			 * 
			 * @hooked the_lalit_breadcrum - 20
			 */
			//do_action('the_lalit_breadcrum');
			/**
			 * the_lalit_breadcrum hook.
			 * 
			 * @hooked the_lalit_add_to_cart_message_div
			 */
			do_action('the_lalit_custom_notices');
			?>
		</div><!-- product-detail-breadcrumb -->
	</div>
	<div class="row">
		<div class="single-product-image single-product-sec col <?php if(isIPad()) { ?>col12<?php } else { ?>col6<?php } ?>">
			<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> flexslider slider" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
				<ul class="slides">
					<?php
					$attributes = array(
						'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
						'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);

					if ( has_post_thumbnail() ) {
						$html  = '<li data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
						if(isMobile())
						{
							$html .= get_the_post_thumbnail( $post->ID, 'shop_catalog', $attributes );
						}
						else
						{
							$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
						}
						$html .= '</a></li>';
					} else {
						$html  = '<li class="woocommerce-product-gallery__image--placeholder product-detail-image-container">';
						$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image product-detail-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
						$html .= '</li>';
					}

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

					do_action( 'woocommerce_product_thumbnails' );
					?>
				</ul>
			</div>
			<?php
				if(!isIPad() && !isMobile())
				{
					/**
					 * the_lalit_product_details_tabs hook.
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * 
					 */
					do_action( 'the_lalit_product_details_tabs' );
				}
			?>
		</div>
