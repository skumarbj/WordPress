<?php
$wiz_ecommerce_woo_latest = get_theme_mod( 'wiz_ecommerce_woo_latest', __('Latest <span>Products</span>','wiz-ecommerce') );
?>

<section class="special py-4">
	<div class="container">
		<?php if($wiz_ecommerce_woo_latest != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_woo_latest); ?></h3>
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
