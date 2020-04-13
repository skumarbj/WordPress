<?php
/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Wiz eCommerce
*/
$wiz_ecommerce_footer_credit = get_theme_mod( 'wiz_ecommerce_footer_credit', __('All Rights Reserved ','wiz-ecommerce') );
$wiz_ecommerce_footer_company = get_theme_mod( 'wiz_ecommerce_footer_company', get_bloginfo( 'name' ) );
$wiz_ecommerce_footer_link = get_theme_mod( 'wiz_ecommerce_footer_link', home_url( '/' ) );

?>
<footer class="wiz-footer">
	<div class="foot-overlay py-5">
		<div class="container">
			<div class="row">
				<?php if ( is_active_sidebar( 'wiz-footer' ) ) {
					dynamic_sidebar( 'wiz-footer' );
				} ?>
			</div>
		</div>
	</div>
</footer>
<section class="copyright py-2">
	<div class="container text-center">
		<?php echo esc_html( $wiz_ecommerce_footer_credit );
		if($wiz_ecommerce_footer_company !='' && $wiz_ecommerce_footer_link !=''): ?>
			<a href="<?php echo esc_url($wiz_ecommerce_footer_link); ?>"><?php echo esc_html( $wiz_ecommerce_footer_company ); ?></a>
		<?php endif;
		esc_html_e('Theme by','wiz-ecommerce'); ?> <a href="<?php echo esc_url('http://wizorbit.com/'); ?>" target="_blank"><?php esc_html_e('Wizorbit Softwares','wiz-ecommerce'); ?></a>
	</div>
</section>
<div class='scrolltop'>
	<div class='scroll icon'><i class="fa fa-4x fa-angle-up"></i></div>
</div>
<?php if(wiz_ecommerce_wc_activated()): ?>
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg quick-view-model" role="document">
		<div class="modal-content"></div>
	</div>
</div>
<?php endif;
wp_footer(); ?>
</body>
</html>
