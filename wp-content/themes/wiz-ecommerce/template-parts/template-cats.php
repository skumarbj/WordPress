<?php
$wiz_ecommerce_woo_cats = get_theme_mod( 'wiz_ecommerce_woo_cats', __('Our <span>Collection</span>','wiz-ecommerce') );
$wiz_ecommerce_cat_ids = get_theme_mod( 'wiz_ecommerce_cat_ids','');
$wiz_ecommerce_default_cat_img = get_theme_mod( 'wiz_ecommerce_default_cat_img', get_template_directory_uri().'/img/cat-placeholder.jpg');
if($wiz_ecommerce_default_cat_img ==''){
$wiz_ecommerce_default_cat_img = get_template_directory_uri().'/img/cat-placeholder.jpg';
}
?><section class="special py-4">
			<div class="container">
				<?php if($wiz_ecommerce_woo_cats != ''): ?>
					<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_woo_cats); ?></h3>
					<div class="ser-t">
						<b></b>
						<span><i></i></span>
						<b class="line"></b>
					</div>
				<?php endif; ?>
				<div class="row pt-5">
					<?php $wiz_ecommerce_categories = get_terms( 'product_cat', array(
					'orderby'    => 'name',
					'order'      => 'ASC',
					'include'      => $wiz_ecommerce_cat_ids,
					'hide_empty' => true
				));
				if(!empty($wiz_ecommerce_categories)):
					foreach( $wiz_ecommerce_categories as $wiz_ecommerce_cat ) :
						$wiz_ecommerce_thumb_id = get_term_meta( $wiz_ecommerce_cat->term_id, 'thumbnail_id', true );
						$wiz_ecommerce_catalog_img = wp_get_attachment_image_src( $wiz_ecommerce_thumb_id, 'shop_catalog' );
						$wiz_ecommerce_term_link = get_term_link( $wiz_ecommerce_cat, 'product_cat' );  ?>
							<div class="wiz-ecommerce-cat-box col-sm-4">
								<div class="col-sm-12">
									<a href="<?php echo esc_url($wiz_ecommerce_term_link); ?>" title="<?php echo esc_attr($wiz_ecommerce_cat->name); ?>">
										<div class="special-grid">
											<figure class="effect-roxy">
												<?php if($wiz_ecommerce_thumb_id){ ?>
												<img src="<?php echo esc_url($wiz_ecommerce_catalog_img[0]); ?>" alt="<?php echo esc_attr($wiz_ecommerce_cat->name); ?>" class="img-fluid">
											<?php }else{ ?>
												<img src="<?php echo esc_url($wiz_ecommerce_default_cat_img); ?>" alt="<?php echo esc_attr($wiz_ecommerce_cat->name); ?>" class="img-fluid">
											<?php } ?>
												<figcaption>
													<h3><?php echo esc_html($wiz_ecommerce_cat->name); ?></h3>
													<p><?php echo esc_html($wiz_ecommerce_cat->description); ?></p>
												</figcaption>
											</figure>
										</div>
									</a>
								</div>
							</div>
						<?php endforeach;
				endif;
				wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
