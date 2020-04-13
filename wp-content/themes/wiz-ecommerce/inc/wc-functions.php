<?php if ( ! function_exists( 'wiz_ecommerce_wc_activated' ) ) {
	function wiz_ecommerce_wc_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

//Woo Commerce Hooks

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10 );

if ( ! function_exists( 'woocommerce_template_loop_product_link_open' ) ) {
	function woocommerce_template_loop_product_link_open() {
		return '';
	}
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );

if ( ! function_exists( 'woocommerce_template_loop_product_link_close' ) ) {
	function woocommerce_template_loop_product_link_close() {
		return '';
	}
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() { ?>
		<h4 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ); ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>" ><?php echo esc_html(get_the_title()); ?></a></h2>
    <?php }
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
function woocommerce_template_loop_product_thumbnail($size = 'shop_catalog') {
	global $post, $woocommerce; ?>
	<div class="men-thumb-item">
		<?php if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail( $post->ID, $size, array('class' => 'pro-image-front') );
        } else {
             echo wc_placeholder_img( $size );
        }  ?>
		<div class="men-cart-pro">
			<div class="inner-men-cart-pro">
				<a href="#" class="link-product-add-cart" data-toggle="modal" data-target="#quickview" data-id="<?php echo esc_attr( $post->ID ); ?>"><?php esc_html_e('Quick View','wiz-ecommerce'); ?></a>
			</div>
		</div>
	</div>
<?php }
}

function wiz_ecommerce_cart_link(){ ?>
	<a class="wiz-cart-link dropdown-toggle" href="<?php echo esc_url( wc_get_cart_url()); ?>"><i class="fa fa-shopping-cart"></i><span class="badge"><?php echo esc_html(number_format_i18n(WC()->cart->get_cart_contents_count())); ?></span></a>
<?php }

function wiz_ecommerce_mini_cart() {
	if(wiz_ecommerce_wc_activated()){ ?>
		<div class="attr-nav pos-r pull-right cart">
			<ul class="list-unstyled">
				<li class="wiz-cart-nav dropdown">
					<?php wiz_ecommerce_cart_link();
					if(!is_cart() && !is_checkout()): ?>
						<div class="dropdown-menu cart-list">
							<?php the_widget( 'WC_Widget_Cart', array('title' => '') ); ?>
						</div>
					<?php endif; ?>
				</li>
			</ul>
		</div>
<?php }
}

function wiz_ecommerce_cart_link_fragment( $fragments ) {
	ob_start();
	wiz_ecommerce_cart_link();
	$fragments['a.wiz-cart-link'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'wiz_ecommerce_cart_link_fragment');

//Ajax for Product Quick view

add_action( 'wp_enqueue_scripts', 'wiz_ecommerce_ajax_scripts' );
function wiz_ecommerce_ajax_scripts($hook) {
    wp_enqueue_script( 'wiz_ecommerce-quick-view', get_template_directory_uri().'/js/get-product-data.js', array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'wiz_ecommerce-quick-view', 'wiz_ecommerce_product_data',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('wp_ajax_nopriv_wiz_ecommerce_product_data', 'wiz_ecommerce_product_data');
add_action('wp_ajax_wiz_ecommerce_product_data', 'wiz_ecommerce_product_data');

function wiz_ecommerce_product_data(){
	if(isset($_REQUEST['id'])){
	global $product;
	$wiz_ecommerce_pid = absint($_REQUEST['id']);
	$wiz_ecommerce_product = new WC_product($wiz_ecommerce_pid);
	$wiz_ecommerce_attachment_ids = $wiz_ecommerce_product->get_gallery_image_ids();
	$wiz_ecommerce_query_args = array( 'post_type' => 'product', 'post__in' => array($wiz_ecommerce_pid) );
		$wiz_ecommerce_products = new WP_Query( $wiz_ecommerce_query_args );
		if($wiz_ecommerce_products->have_posts()) {
			while ( $wiz_ecommerce_products->have_posts()) {
				$wiz_ecommerce_products->the_post(); ?>
				<div class="modal-body">
					<div class="row">
					<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_attr_e('Close','wiz-ecommerce'); ?>">
						<span aria-hidden="true">&times;</span>
					</button>
						<div class="col-sm-6 col-6">
							<div class="quick-slider">
								<?php if ( has_post_thumbnail() ): ?>

									<!--Carousel Wrapper-->
									<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
									<!--Slides-->
									<div class="carousel-inner" role="listbox">
									<div class="carousel-item active">

									<?php the_post_thumbnail('shop_catalog', array('class' => 'd-block w-100')); ?>
									</div>
									<?php if(is_array($wiz_ecommerce_attachment_ids)){
													foreach ($wiz_ecommerce_attachment_ids as $wiz_ecommerce_thumb_id) {
											$wiz_ecommerce_img_src = wp_get_attachment_image_src($wiz_ecommerce_thumb_id, 'shop_catalog'); ?>
											<div class="carousel-item">
												<img src="<?php echo esc_url($wiz_ecommerce_img_src[0]) ?>" class="d-block w-100">
											</div>
										<?php }
									} ?>
									</div>
									<!--/.Slides-->
										<?php if(is_array($wiz_ecommerce_attachment_ids) && !empty($wiz_ecommerce_attachment_ids)){ $count = 1; ?>
											<!--/.Controls-->
											<ol class="carousel-indicators">
												<li data-target="#carousel-thumb" data-slide-to="0" class="active"> <?php the_post_thumbnail('thumbnail', array('class' => 'd-block w-100')); ?></li>
												<?php foreach ($wiz_ecommerce_attachment_ids as $wiz_ecommerce_thumb_id) {
													$wiz_ecommerce_img_src = wp_get_attachment_image_src($wiz_ecommerce_thumb_id, 'thumbnail'); ?>
													<li data-target="#carousel-thumb" data-slide-to="<?php echo esc_attr($count); ?>">
														<img src="<?php echo esc_url($wiz_ecommerce_img_src[0]) ?>" class="d-block w-100">
													</li>
												<?php $count++; } ?>
											</ol>
										<?php } ?>
									</div>
									<!--/.Carousel Wrapper-->
								<?php endif; ?>
							</div>
						</div>
						<div class="col-sm-6 col-6">
							<?php woocommerce_template_loop_product_title(); ?>
							<div class="col-sm-12 p-0">
								<?php woocommerce_template_loop_rating(); ?>
								<hr>
								<?php woocommerce_template_single_price(); ?>
								<hr>
								<h6 class="mt-2"><?php esc_html_e('Quick Overview:','wiz-ecommerce'); ?></h6>
								<p><?php woocommerce_template_single_excerpt(); ?></p>
								<div class="pull-left button2">
									<?php woocommerce_template_single_add_to_cart(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('body .quantity input');</script>
			<?php }
		} wp_reset_postdata();
	}
		die();
}

// Apply filter
add_filter('body_class', 'wiz_ecommerce_body_wc_class');

function wiz_ecommerce_body_wc_class($classes) {
	if(wiz_ecommerce_wc_activated() && is_front_page()){
        $classes[] = 'woocommerce';
    }
	return $classes;
}
