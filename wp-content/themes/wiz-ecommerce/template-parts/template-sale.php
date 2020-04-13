<?php
$wiz_ecommerce_woo_sale = get_theme_mod( 'wiz_ecommerce_woo_sale', __('Latest <span>Offers</span>','wiz-ecommerce') )
?>
<section class="special py-4">
	<div class="container">
		<?php if($wiz_ecommerce_woo_sale != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_woo_sale); ?></h3>
			<div class="ser-t">
				<b></b>
				<span><i></i></span>
				<b class="line"></b>
			</div>
		<?php endif; ?>
		<div class="row pt-5">
			<?php global $product;
				$wiz_ecommerce_query_args = array( 
					'post_type' => 'product', 
					'stock' => 1, 
					'orderby' =>'date',
					'order' => 'DESC',
					'posts_per_page' => 4,
					'tax_query' => WC()->query->get_tax_query(),
					'post__in' => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
					);
				$wiz_ecommerce_products = new WP_Query( $wiz_ecommerce_query_args );
				if($wiz_ecommerce_products->have_posts()) {
					while ( $wiz_ecommerce_products->have_posts()) {
						$wiz_ecommerce_products->the_post(); ?>						
						<div class="col-sm-3 product-men">
							<?php wc_get_template_part('product-data'); ?>
						</div>
					<?php }
				} wp_reset_postdata();	
			?>
		</div>
	</div>
</section>