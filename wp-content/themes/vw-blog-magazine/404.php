<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Blog Magazine
 */

get_header(); ?>

<main id="maincontent" role="main" class="content-vw">
	<div class="container">
        <div class="page-content">
				<h1><?php echo esc_html(get_theme_mod('vw_blog_magazine_404_page_title',__('404 Not Found','vw-blog-magazine')));?></h1>
				<p class="text-404"><?php echo esc_html(get_theme_mod('vw_blog_magazine_404_page_content',__('Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.','vw-blog-magazine')));?></p>
				<div class="read-moresec">
        			<a href="<?php echo esc_url( home_url() ) ?>" class="button"><?php echo esc_html(get_theme_mod('vw_blog_magazine_404_page_button_text',__('Return to Home Page','vw-blog-magazine')));?><span class="screen-reader-text"><?php esc_html_e( 'Return to Home Page','vw-blog-magazine' );?></span></a>
				</div>
			<div class="clearfix"></div>
        </div>
	</div>
</main>

<?php get_footer(); ?>