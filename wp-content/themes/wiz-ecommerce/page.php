<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
	<div id="post-<?php the_ID(); ?>" <?php post_class('wiz-blog mb-5 col-sm-12'); ?>>
	<?php if ( has_post_thumbnail() ): ?>
	<div class="wiz-blog-img mb-3">
		<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
	</div>
	<?php endif; ?>
	<div class="wiz-blog-content">
		<div class="row wiz-post-content">
			<div class="entry-title col-sm-12">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="col-sm-12 wiz-content">
				<?php the_content();
			wiz_ecommerce_post_link(); ?>
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
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer();