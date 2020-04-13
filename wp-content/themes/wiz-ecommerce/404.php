<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wiz eCommerce
 */

get_header();
?>
<section id="content" class="products">
	<?php get_template_part('template-parts/title','bar'); ?>
	<div id="main-content" class="wiz-main-div container py-3">
		<div class="row mt-3">
			<div class="sad text-center col-sm-12">
				<i class="fa fa-frown-o mb-3"></i>
				<h4 class="mt-2"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wiz-ecommerce' ); ?></h4>

				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wiz-ecommerce' ); ?></p>

				<a href="<?php echo esc_url(site_url()); ?>" class="btn btn-green mb-3"><?php esc_html_e('Go Home','wiz-ecommerce'); ?></a>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
