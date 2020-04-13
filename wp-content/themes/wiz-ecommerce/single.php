<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wiz eCommerce
 */

get_header();
the_post();
?>
<section id="content" class="products">
	<?php get_template_part('template-parts/title','bar'); ?>
	<div id="main-content" class="wiz-main-div container py-3">
		<div class="row mt-3">
			<div class="col-sm-9">
				<div id="post-<?php the_ID(); ?>" <?php post_class('wiz-blog mb-5'); ?>>
					<?php if ( has_post_thumbnail() ): ?>
					<div class="col-md-12 wiz-blog-img mb-3">
						<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
					</div>
					<?php endif; ?>
					<div class="wiz-blog-content">
						<div class="col-md-12">
							<div class="wiz-post-date">
								<span class="day"><?php the_time( 'd' ); ?></span>
								<span class="month"><?php the_time( 'M' ); ?></span>
							</div>
							<div class="wiz-post-meta ml-5">
							<h1><?php the_title(); ?></h1>
							<div class="wiz-post-meta">
								<span><i class="fa fa-user"></i> <?php echo esc_html_e('By','wiz-ecommerce'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
								<?php if(get_the_category_list() != '') : ?>
								<span><i class="fa fa-folder"></i> <?php the_category(', '); ?> </span>
							<?php endif; ?>
							<?php wiz_ecommerce_post_link(); 
								if(get_the_tag_list()) { 
									the_tags('<span><i class="fa fa-tag"> </i> ',', ','</span>');
								}
								?>
								<span><i class="fa fa-comments"></i> <a href="<?php echo esc_url(get_comments_link()); ?>"><?php echo esc_html(get_comments_number()); ?></a></span>
							</div>						
							</div>
							<div class="row wiz-post-content">
								<div class="col-sm-12 wiz-content"><?php the_content(); ?></div>
								<div class="col-sm-12 wiz-navigation mt-3">
									<?php wiz_ecommerce_post_navigation(); ?>
								</div>
							</div>
						</div>
						
						
						
						<?php $wiz_ecommerce_author_intro = get_the_author_meta( 'description' );
						if($wiz_ecommerce_author_intro !='' && 'post' == get_post_type()): ?>
							<div class="wiz-post-author card mt-5">
								<div class="card-header bg-secondary text-white"><h4><?php esc_html_e('About Author','wiz-ecommerce'); ?></h4></div>
								<div class="row card-body">
									<div class="col-md-2 author-img">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 150, '', get_the_author(), array('class' => 'img-fluid') ); ?>
									</div>
									<div class="col-md-10 author-data">
										<h4><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>" title="<?php esc_attr_e('View All Posts By ', 'wiz-ecommerce'); the_author(); ?>"><?php the_author(); ?></a></h4>
										<p><?php echo esc_html($wiz_ecommerce_author_intro); ?></p>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="wiz-comments mt-3">
							<?php if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>
					</div>
				</div><!-- #post-<?php the_ID(); ?> -->
			</div>
				<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer();