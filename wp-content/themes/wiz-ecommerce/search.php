<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Wiz eCommerce
 */

get_header();
?>
<section id="content" class="products">
	<?php get_template_part('template-parts/title','bar'); ?>
	<div id="main-content" class="wiz-main-div container py-3">
		<div class="row mt-3">
			<div class="col-sm-9">
			<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						if('post' == get_post_type()) {
							get_template_part( 'template-parts/content', 'post' );
						} else {
							get_template_part( 'template-parts/content', 'page' );
						}
					endwhile;

					the_posts_pagination( array( 'mid_size' => 2 ) );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php
get_footer();
