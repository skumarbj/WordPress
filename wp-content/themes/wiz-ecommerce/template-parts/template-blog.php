<?php
$wiz_ecommerce_blog_title = get_theme_mod( 'wiz_ecommerce_blog_title', __('Latest <span>News</span>','wiz-ecommerce') )
?>
<section class="blog-section py-5">
	<div class="container">
		<?php if($wiz_ecommerce_blog_title != ''): ?>
			<h3 class="text-center"><?php echo wiz_ecommerce_section_title($wiz_ecommerce_blog_title); ?></h3>
			<div class="ser-t">
				<b></b>
				<span><i></i></span>
				<b class="line"></b>
			</div>
		<?php endif; ?>
		<?php $wiz_ecommerce_blog_args = array('post_type' => 'post', 'post_status' => 'publish', 'post__not_in' => get_option( 'sticky_posts' ) );
		$wiz_ecommerce_blog = new WP_Query($wiz_ecommerce_blog_args);
		if($wiz_ecommerce_blog->have_posts()): ?>
		<div class="row pt-5 Block-Slider owl-carousel owl-theme">
			<?php while($wiz_ecommerce_blog->have_posts()):
				$wiz_ecommerce_blog->the_post();	?>
			<div class="col-md-12">
				<div class="blog-box my-3">
					<?php if ( has_post_thumbnail() ): ?>
						<div class="blog-box-img">
						<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
						</div>
					<?php endif; ?>
					<?php if(get_the_category_list() != '') : ?>
						<div class="category-name">
							<?php the_category(', '); ?>
						</div>
					<?php endif; ?>
					<div class="blog-box-content p-3">
						<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						<p><?php the_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="btn-more"><i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	<?php endif; wp_reset_postdata(); ?>
	</div>
</section>
<script>
jQuery( '.Block-Slider' ).owlCarousel({
    items: 3,
    nav: true,
    dots: false,
    mouseDrag: true,
    responsiveClass: true,
    responsive: {
        0:{
          items: 1
        },
        480:{
          items: 3
        },
        769:{
          items: 3
        }
    }
});

</script>
