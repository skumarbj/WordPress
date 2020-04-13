<?php
$wiz_ecommerce_cta_btn = get_theme_mod( 'wiz_ecommerce_cta_btn', __('Contact Us','wiz-ecommerce') );
$wiz_ecommerce_cta_page = get_theme_mod( 'wiz_ecommerce_cta_page', '' );
if(isset($wiz_ecommerce_cta_page) && $wiz_ecommerce_cta_page != ''):
$wiz_ecommerce_cta_args = array( 'post_type' => 'page',
							'posts_per_page' => 1,
							'post_status' => 'publish',
							'post__in' => array($wiz_ecommerce_cta_page),
						);
$wiz_ecommerce_cta = new WP_Query($wiz_ecommerce_cta_args);
if($wiz_ecommerce_cta->have_posts()):
	while($wiz_ecommerce_cta->have_posts()):
		$wiz_ecommerce_cta->the_post();
		?>
		<section class="newsletter" <?php if ( has_post_thumbnail() ) { ?>
				style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url()); ?>');"
			<?php } ?>>
			<div class="news-overlay py-5">
				<div class="container text-center">
					<h3><?php the_title(); ?></h3>
					<p><?php echo esc_html(wp_trim_words( get_the_excerpt(), 25)); ?></p>
					<a href="<?php the_permalink(); ?>" class="btn news-btn mt-4"><?php echo esc_html( $wiz_ecommerce_cta_btn ); ?></a>
				</div>
			</div>
		</section>
<?php endwhile;
endif;
wp_reset_postdata();
endif; ?>
