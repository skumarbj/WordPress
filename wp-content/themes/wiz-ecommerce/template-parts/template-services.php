<?php
$wiz_ecommerce_services_heading = get_theme_mod( 'wiz_ecommerce_services_heading', __('Our <span>Services</span>','wiz-ecommerce') );
$wiz_ecommerce_service_page_ids = get_theme_mod( 'wiz_ecommerce_service_page_ids', '' );
if(is_array($wiz_ecommerce_service_page_ids) && $wiz_ecommerce_service_page_ids !=''): 
$wiz_ecommerce_service_args = array( 'post_type' => 'page',
								'post_status' => 'publish',
								'post__in' => $wiz_ecommerce_service_page_ids
							);
$wiz_ecommerce_services = new WP_Query($wiz_ecommerce_service_args);
if($wiz_ecommerce_services->have_posts()): ?>
<section class="why-us py-5">
	<div class="container">
		<?php if($wiz_ecommerce_services_heading != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_services_heading); ?></h3>
			<div class="ser-t">
				<b></b>
				<span><i></i></span>
				<b class="line"></b>
			</div>
		<?php endif; ?>
		<div class="row pt-5">
			<?php while($wiz_ecommerce_services->have_posts()): 
				$wiz_ecommerce_services->the_post();	?>
				<div class="col-sm-3 col-xs-6 p-3 highlights">
					<div class="about-overlay-under text-center">
						<div class="about-overlay-above">
							<i class="fa fa-check"></i>
						</div>
					</div>
					<h6><a href="<?php the_permalink(); ?>"><span class="highlights-first"><?php the_title(); ?></span></a></h6>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php endif; 
wp_reset_postdata();
endif; ?>