<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'wiz-ecommerce' ),
		'shipping' => __( 'Shipping address', 'wiz-ecommerce' ),
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing address', 'wiz-ecommerce' ),
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>

<p>
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'wiz-ecommerce' ) ); ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="woocommerce-Addresses row addresses">
<?php endif; ?>

<?php foreach ( $get_addresses as $wiz_ecommerce_name => $wiz_ecommerce_title ) : ?>

	<div class="col-md-12 woocommerce-Address">
		<header class="woocommerce-Address-title title">
			<h3><?php echo esc_html($wiz_ecommerce_title); ?></h3>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $wiz_ecommerce_name ) ); ?>" class="edit"><?php esc_html_e( 'Edit', 'wiz-ecommerce' ); ?></a>
		</header>
		<address><?php
			$address = wc_get_account_formatted_address( $wiz_ecommerce_name );
			echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'wiz-ecommerce' );
		?></address>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
<?php endif;
