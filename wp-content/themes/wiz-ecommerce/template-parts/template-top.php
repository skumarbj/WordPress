<?php 
$wiz_ecommerce_woo_top = get_theme_mod( 'wiz_ecommerce_woo_top', __('Our <span>Gems</span>','wiz-ecommerce') )
?>

<section class="special py-4">
	<div class="container">
		<?php if($wiz_ecommerce_woo_top != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_woo_top); ?></h3>
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
					'posts_per_page' => 4,
					'meta_key' => '_wc_average_rating',
					'orderby' => 'meta_value_num',
					'order' => 'DESC',
					'tax_query' => WC()->query->get_tax_query(),
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