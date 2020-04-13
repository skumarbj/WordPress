<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wiz eCommerce
 */

if ( ! is_active_sidebar( 'wiz-woo-sidebar' ) ) {
	return;
}
?>
<div class="col-sm-3">
	<?php dynamic_sidebar( 'wiz-woo-sidebar' ); ?>
</div>
