<?php 
/**
 * The front page template file.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wiz eCommerce
 */
$wiz_ecommerce_display_slider = get_theme_mod( 'wiz_ecommerce_display_slider', 0 );
$wiz_ecommerce_display_service = get_theme_mod( 'wiz_ecommerce_display_service', 0 );
$wiz_ecommerce_display_latest = get_theme_mod( 'wiz_ecommerce_display_latest', 0 );
$wiz_ecommerce_display_cats = get_theme_mod( 'wiz_ecommerce_display_cats', 0 );
$wiz_ecommerce_display_sale = get_theme_mod( 'wiz_ecommerce_display_sale', 0 );
$wiz_ecommerce_display_top = get_theme_mod( 'wiz_ecommerce_display_top', 0 );
$wiz_ecommerce_display_featured = get_theme_mod( 'wiz_ecommerce_display_featured', 0 );
$wiz_ecommerce_display_cta = get_theme_mod( 'wiz_ecommerce_display_cta', 0 );
if ( 'posts' == get_option( 'show_on_front' ) ) {
	get_header(); ?>
	<section id="main-content" class="products">
	<?php if($wiz_ecommerce_display_slider != 0){
		get_template_part('template-parts/template','slider');
	}
	if($wiz_ecommerce_display_service != 0){
		get_template_part('template-parts/template','services');
	}
	if(wiz_ecommerce_wc_activated()){
		if($wiz_ecommerce_display_latest !=0){
			get_template_part('template-parts/template','latest');
		}
		if($wiz_ecommerce_display_cats != 0){
			get_template_part('template-parts/template','cats');
		}
		if($wiz_ecommerce_display_sale != 0){
			get_template_part('template-parts/template','sale');
		}
		if($wiz_ecommerce_display_top != 0){
			get_template_part('template-parts/template','top');
		}
		if($wiz_ecommerce_display_featured != 0){
			get_template_part('template-parts/template','best');
		}
	}
	get_template_part('template-parts/template','blog');
	if($wiz_ecommerce_display_cta != 0){
		get_template_part('template-parts/template','cta');
	} ?>
	</section>
	<?php get_footer();
} else {
    include( get_page_template() );
}