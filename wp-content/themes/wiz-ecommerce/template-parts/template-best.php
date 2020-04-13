<?php 
$wiz_ecommerce_woo_featured = get_theme_mod( 'wiz_ecommerce_woo_featured', __('<span>Featured</span> Products','wiz-ecommerce') );
?>
<section class="special py-4">
	<div class="container">
		<?php if($wiz_ecommerce_woo_featured != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_woo_featured); ?></h3>
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
					'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'product_visibility',
							    'field'    => 'name',
							    'terms'    => 'featured',
							    'operator' => 'IN', // or 'NOT IN' to exclude feature products
							),
							array(
								'taxonomy' => 'product_visibility',
						        'field'    => 'name',
						        'terms'    => 'exclude-from-catalog',
						        'operator' => 'NOT IN',
							),
						),
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