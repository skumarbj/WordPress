<?php //Template Name: Left Sidebar Page
get_header();
the_post();
?>
<section id="content" class="products">
	<?php get_template_part('template-parts/title','bar'); ?>
	<div id="main-content" class="wiz-main-div container py-3">
		<div class="row mt-3">
			<?php get_sidebar(); ?>
			<div class="col-sm-9">
					<div id="post-<?php the_ID(); ?>" <?php post_class('wiz-blog mb-5'); ?>>
					<?php if ( has_post_thumbnail() ): ?>
					<div class="wiz-blog-img mb-3">
						<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
					</div>
					<?php endif; ?>
					<div class="wiz-blog-content">
						<div class="wiz-post-content">
							<h1><?php the_title(); ?></h1>
							<div class="wiz-content"><?php the_content(); ?>
								<?php wiz_ecommerce_post_link(); ?>
							</div>
						</div>
						<div class="row wiz-comments mt-3">
							<div class="col-sm-12">
							<?php if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
						</div>
						</div>
					</div>
				</div><!-- #post-<?php the_ID(); ?> -->
			</div>
		</div>
	</div>
</section>
<?php get_footer();
