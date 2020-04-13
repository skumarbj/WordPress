<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$wiz_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $wiz_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="nav nav-tabs responsive" role="tablist" id="tab-list">
			<?php foreach ( $wiz_tabs as $key => $wiz_ecommerce_tab ) : ?>
				<li class="nav-item">
					<a class="nav-link <?php if($key == 'description'){ echo esc_attr('active'); } ?>" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $wiz_ecommerce_tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content responsive" id="tab-contents">
			<?php foreach ( $wiz_tabs as $key => $wiz_ecommerce_tab ) : ?>
				<div class="tab-pane <?php if($key == 'description'){ echo esc_attr('active'); } ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel">
					<div class="container-fluid">
						<div class="row mt-3">
							<?php if ( isset( $wiz_ecommerce_tab['callback'] ) ) { call_user_func( $wiz_ecommerce_tab['callback'], $key, $wiz_ecommerce_tab ); } ?> 
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>
