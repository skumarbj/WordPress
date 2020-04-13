<?php
$wiz_ecommerce_slider_page_ids = get_theme_mod( 'wiz_ecommerce_slider_page_ids', '');
if(is_array($wiz_ecommerce_slider_page_ids)):
	$wiz_ecommerce_default_slide = get_theme_mod( 'wiz_ecommerce_default_slide', get_template_directory_uri().'/img/slide-placeholder.jpg');
	if($wiz_ecommerce_default_slide ==''){
		$wiz_ecommerce_default_slide = get_template_directory_uri().'/img/slide-placeholder.jpg';
	}
	$wiz_ecommerce_slider_args = array( 'post_type' => 'page',
									'post_status' => 'publish',
									'post__in' => $wiz_ecommerce_slider_page_ids
								);
	$wiz_ecommerce_slides = new WP_Query($wiz_ecommerce_slider_args);
	$wiz_ecommerce_align_class = array('left', 'right', 'center');
	if($wiz_ecommerce_slides->have_posts()):
		$wiz_ecommerce_count = 1;
	?>
	<section class="p-rel">
		<div id="wiz_ecommerce-slider" class="carousel slide" data-ride="carousel">


			<!-- The slideshow -->
			<div class="carousel-inner">
				<?php while($wiz_ecommerce_slides->have_posts()):
			$wiz_ecommerce_slides->the_post(); ?>
			<div class="carousel-item <?php if($wiz_ecommerce_count == 1): echo esc_attr('active'); endif; ?>">
			<?php if ( has_post_thumbnail() ){
				the_post_thumbnail('wiz-slide', array('class' => 'img-fluid'));
			}else{ ?>
				<img class="img-fluid" alt="<?php the_title(); ?>" src="<?php echo esc_url( $wiz_ecommerce_default_slide ); ?>">
			<?php } ?>
				<div class="container">
					<div class="carousel-caption text-<?php echo esc_attr( $wiz_ecommerce_align_class[array_rand($wiz_ecommerce_align_class)]); ?>">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="slide-desc"><p><?php echo esc_html(wp_trim_words( get_the_excerpt(), 25) ); ?></p></div>
						<a href="<?php the_permalink(); ?>" class="btn btn-slide"><?php esc_html_e('Read More','wiz-ecommerce'); ?></a>
					</div>
				</div>
			</div>
			 <?php $wiz_ecommerce_count++;
			 endwhile; ?>
			</div>
			<!-- Indicators -->
			<ul class="carousel-indicators">
				<?php for ($wiz_ecommerce_var=1; $wiz_ecommerce_var < $wiz_ecommerce_count ; $wiz_ecommerce_var++) {
					$wiz_ecommerce_var2 = $wiz_ecommerce_var-1; ?>
					<li data-target="#wiz_ecommerce-slider" data-slide-to="<?php echo esc_attr( $wiz_ecommerce_var2 ); ?>" <?php if($wiz_ecommerce_var == 1): ?> class="active" <?php endif; ?>></li>
				<?php } ?>

			</ul>
			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#wiz_ecommerce-slider" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#wiz_ecommerce-slider" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</section>
	<?php endif;
	wp_reset_postdata();
endif; ?>
