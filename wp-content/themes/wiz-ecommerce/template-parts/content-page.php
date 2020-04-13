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
		<div class="wiz-post-content">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="wiz-excerpt"><?php the_excerpt(); ?></div>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
<hr>