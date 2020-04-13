<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wiz eCommerce
 */
$wiz_ecommerce_display_topbar = get_theme_mod('wiz_ecommerce_display_topbar_setting', 0);
$wiz_ecommerce_display_cart = get_theme_mod('wiz_ecommerce_display_cart', 0);
$wiz_ecommerce_cart_class = 'col-10';
if($wiz_ecommerce_display_cart != 1){
	$wiz_ecommerce_cart_class = 'col-12';
}
$wiz_ecommerce_display_social = get_theme_mod('wiz_ecommerce_display_social_setting', 0);
$wiz_ecommerce_display_nav = get_theme_mod('wiz_ecommerce_display_nav', 0);
$wiz_ecommerce_sticky_header = get_theme_mod('wiz_ecommerce_sticky_header', 1);
$wiz_ecommerce_product_search = get_theme_mod('wiz_ecommerce_product_search', 0);
$wiz_ecommerce_mail_address = get_theme_mod('wiz_ecommerce_mail_address', 'demo@example.com');
$wiz_ecommerce_contact_number = get_theme_mod('wiz_ecommerce_contact_number', '9876543210');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
<a class="skip-link screen-reader-text" href="#main-content">
<?php esc_html_e( 'Skip to content', 'wiz-ecommerce' ); ?></a>
	<div class="thetop"></div>
	<?php if($wiz_ecommerce_display_topbar != 0): ?>
		<div class="top-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 text-center text-sm-left py-1">
							<?php if($wiz_ecommerce_mail_address !=''): ?>
								<a href="mailto:<?php echo esc_html( $wiz_ecommerce_mail_address ); ?>"><span class="email"><?php echo esc_html( $wiz_ecommerce_mail_address ); ?></span></a> |
								<?php endif;
								if($wiz_ecommerce_contact_number !=''): ?><a href="tel:<?php echo esc_html( $wiz_ecommerce_contact_number ); ?>"><span class="email"><?php echo esc_html( $wiz_ecommerce_contact_number ); ?></span></a>
							<?php endif; ?>
						</div>
						<div class="col-sm-6 text-center text-sm-right">
							<div class="py-1">
								<?php if($wiz_ecommerce_display_social != 0): ?>
									<span class="social">
										<?php for ($wiz_ecommerce_var=1; $wiz_ecommerce_var <= 4 ; $wiz_ecommerce_var++) {
											$wiz_ecommerce_social_icon = get_theme_mod( 'wiz_ecommerce_social_icon_'.$wiz_ecommerce_var);
											$wiz_ecommerce_social_link = get_theme_mod( 'wiz_ecommerce_social_link_'.$wiz_ecommerce_var);
											if($wiz_ecommerce_social_icon !='' && $wiz_ecommerce_social_link !=''): ?>
											<a href="<?php echo esc_url($wiz_ecommerce_social_link); ?>"><i class="<?php echo esc_attr($wiz_ecommerce_social_icon); ?>"></i></a>
										<?php endif;
									} ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php endif; ?>
		<header <?php if($wiz_ecommerce_sticky_header != 0): ?> id="head-bar" <?php endif; ?>>
			<div class="wiz-head">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div class="navigation brand py-2">
								<?php $wiz_ecommerce_logo_id = get_theme_mod( 'custom_logo' );
								$wiz_ecommerce_logo_data = wp_get_attachment_image_src( $wiz_ecommerce_logo_id , 'full' );
								$wiz_ecommerce_logo = $wiz_ecommerce_logo_data[0];	?>
							<a class="logo-wrapper" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php if(isset($wiz_ecommerce_logo)){ ?>
							<img src="<?php echo esc_url($wiz_ecommerce_logo); ?>" class="img-fluid" alt="<?php bloginfo( 'name' ); ?>" >
							<?php }else{
								if(display_header_text()){ ?>
								<h3 class="text-center m-0">
									<?php bloginfo( 'name' ); ?>
								</h3>
								<h5 class="tagline my-1 text-center"><?php bloginfo( 'description' ); ?></h5>
						<?php }
					} ?></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#wizHeadNavigation" aria-controls="wizHeadNavigation" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
							</div>
						</div>
						<div class="col-md-5">
						<?php if(wiz_ecommerce_wc_activated() && $wiz_ecommerce_product_search != 0): ?>
							<div id="custom-search-input" class="my-3">
								<?php get_template_part('searchform', 'product'); ?>
							</div>
						<?php endif; ?>
						</div>
						<div class="col-md-4 text-center text-md-right">
							<div class="row">
							<div class="<?php echo esc_attr($wiz_ecommerce_cart_class); ?> mt-md-4 wiz-store-nav">
								<?php if($wiz_ecommerce_display_nav != 0):
									wp_nav_menu( array( 'theme_location' => 'wiz-store-nav', 'container' => false, 'menu_class' => 'text-center text-md-right m-0'));
							endif; ?>
							</div>
									<?php if($wiz_ecommerce_display_cart != 0){ ?>
								<div class="col-2 mt-md-3">
								<?php wiz_ecommerce_mini_cart(); ?>
								</div>
								<?php }  ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="navigation wiz-head-navs col-sm-12 row m-0">
				<div class="container">
					<div class="collapse navbar-collapse" id="wizHeadNavigation">
						<div id="wiz-navigation" class="main-navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'wiz-primary-nav', 'container' => 'ul', 'menu_class' => 'sm sm-simple navbar-nav mr-auto')); ?>
						</div>
					</div>
				</div>
			</div>
		</header>
