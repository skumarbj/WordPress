<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wiz_ecommerce
 */

?>
<div id="post-<?php the_ID(); ?>"  <?php post_class('wiz-blog mb-5'); ?>>
	<?php if ( has_post_thumbnail() ): ?>
	<div class="wiz-blog-img mb-3">
		<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
	</div>
	<?php endif; ?>
	<div class="wiz-blog-content">
		<div class="wiz-post-date">
			<span class="day"><?php the_time( 'd' ); ?></span>
			<span class="month"><?php the_time( 'M' ); ?></span>
		</div>
		<div class="wiz-post-content ml-5">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="wiz-excerpt"><?php the_excerpt(); ?></div>
			<div class="wiz-post-meta">
				<span><i class="fa fa-user"></i> <?php echo esc_html_e('By','wiz-ecommerce'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a> </span>
				<?php if(get_the_category_list() != '') : ?>
				<span><i class="fa fa-folder"></i> <?php the_category(', '); ?> </span>
			<?php endif; ?>
				<span><i class="fa fa-comments"></i> <a href="<?php echo esc_url(get_comments_link()); ?>"><?php echo esc_html(get_comments_number()); ?></a></span>
				<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="<?php the_permalink(); ?>" class="btn-read text-uppercase"><?php esc_html_e('Read More','wiz-ecommerce'); ?></a></span>
			</div>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
<hr>
