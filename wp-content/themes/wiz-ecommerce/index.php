<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wiz eCommerce
 */

get_header();
?>
<section id="content" class="products">
	<?php get_template_part('template-parts/title','bar'); ?>
	<div id="main-content" class="wiz-site wiz-main-div container py-3">
		<div class="row mt-3">
			<div class="col-sm-9">
			<?php
				if ( have_posts() ) :
					
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'post' );

					endwhile;

					the_posts_pagination( array( 'mid_size' => 1 ) );

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
