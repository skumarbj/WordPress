<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wiz_ecommerce
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wiz_ecommerce_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wiz_ecommerce_pingback_header' );

// post/page navigation
function wiz_ecommerce_post_link(){
	$defaults = array(
		'before'           => '<div class="link-content">' . __( 'Pages:','wiz-ecommerce' ),
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page','wiz-ecommerce'),
		'previouspagelink' => __( 'Previous page','wiz-ecommerce'),
		'pagelink'         => '%',
		'echo'             => 1
	);
				wp_link_pages( $defaults );
}

//Post Pagination
function wiz_ecommerce_post_navigation(){
	global $post;
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
		<div class="row wiz-pagination">
    		<div class="col-md-12 p-0">
    			<div class="float-left"><?php next_post_link( '%link' ); ?></div>
    			<div class="float-right"><?php previous_post_link( '%link' ); ?></div>
    		</div>
        </div>
	<?php
}

function wiz_ecommerce_section_title($heading){
	return wp_kses($heading, array('span' => array()));
}

function wiz_ecommerce_color_style(){
	$color_code = get_theme_mod( 'wiz_ecommerce_theme_color_setting', '#0098ff' );
    if(null !== get_header_textcolor()){
        $header_text_color = '#'.get_header_textcolor();
    }else{
        $header_text_color = '<?php echo esc_html($color_code); ?>';
    }
		$header_textcolor = get_header_textcolor();
?>
<style>
header a{
	color: #<?php echo esc_html($header_textcolor); ?>;
}

#set_menu ul li a{
    color:<?php echo esc_html($color_code); ?>;
}

#set_menu .dropdown-menu{
    border: 1px solid #d6d99b;
    background: #e4e6be;
}

#set_menu .dropdown-menu a:hover{
    background: <?php echo esc_html($color_code); ?>;
}

.ser-t b,
.scroll{
    background: <?php echo esc_html($color_code); ?>;
}

.ser-t span i{
    border: 2px solid <?php echo esc_html($color_code); ?>;
}

.special-grid h4{
    background: #d6d99b;
}

.snipcart-details input.button, .snipcart-details input.button:hover {
    background: <?php echo esc_html($color_code); ?>;
}

.snipcart-details input.button {
    background: <?php echo esc_html($color_code); ?>;
}

.snipcart-details input.button, .snipcart-details input.button:hover {
    background: <?php echo esc_html($color_code); ?>;
}

.hvr-outline-out{
    background: <?php echo esc_html($color_code); ?>;
}

.hvr-outline-out:before{
    border: <?php echo esc_html($color_code); ?> solid 4px;
}

.highlights .about-overlay-under,
.highlights:hover .about-overlay-above{
    border: 4px solid <?php echo esc_html($color_code); ?>;
}

.footer-section a:hover{
    color: <?php echo esc_html($color_code); ?>;
}

.copyright a{
    color:<?php echo esc_html($color_code); ?>;
}

#quickview .modal-header{
    background: <?php echo esc_html($color_code); ?>;
}

#quickview .modal-body h4{
    color: <?php echo esc_html($color_code); ?>;
}

.categories h5, .discounts h5, .best-seller h5{
    color: <?php echo esc_html($color_code); ?>;
}

.categories h5::before, .discounts h5::before, .best-seller h5::before{
    color: <?php echo esc_html($color_code); ?>;
}

.cart-page h3{
    color: <?php echo esc_html($color_code); ?>;
}

.stock{
    color: #adb706;
}

.wiz-single-post-date .day {
    background: #d6d99b;
}

.wiz-single-post-date .month{
    background: <?php echo esc_html($color_code); ?>;
}

.wiz-post-date .day{
    color: <?php echo esc_html($color_code); ?>;
}

.wiz-post-date .month{
    background: <?php echo esc_html($color_code); ?>;
}

.wiz-post-content h3 a{
    color: <?php echo esc_html($color_code); ?>;
}

.wiz-post-meta a{
    color:<?php echo esc_html($color_code); ?>;
}

#paginate .page-item.active .page-link{
    background-color: <?php echo esc_html($color_code); ?>;
    border-color: <?php echo esc_html($color_code); ?>;
}

#paginate .page-link{
    color: <?php echo esc_html($color_code); ?>;
}

.comment-block a{
    color: <?php echo esc_html($color_code); ?>;
}

.wiz-reply .btn-green,
.btn-green{
    background: <?php echo esc_html($color_code); ?>;
}
.wiz-reply .btn-green:hover, .btn-green:hover {
    color: #00bf1c;
    background: #fff;
    border: 1px solid;
}
.wiz-reply .btn-green:hover,
.btn-green:hover{
    color: <?php echo esc_html($color_code); ?>;
    background: #fff;
    border: 1px solid;
}

.breadcrumb a,
.breadcrumb-item+.breadcrumb-item::before{
    color:<?php echo esc_html($color_code); ?>;
}

.sad i{
    color: <?php echo esc_html($color_code); ?>;
}

#wiz_ecommerce-slider .btn-slide{
    background: <?php echo esc_html($color_code); ?>;
}

.blog-box-content a h4 {
    color: <?php echo esc_html($color_code); ?>;
}

a.btn-more {
    background: <?php echo esc_html($color_code); ?>;
}

.wiz-post-date {
    border: 1px solid <?php echo esc_html($color_code); ?>;
}
.widget_calendar #wp-calendar thead,
.widget_calendar #wp-calendar td {
    border: 1px solid <?php echo esc_html($color_code); ?>;
}
.widget_calendar #wp-calendar thead {
    background-color: <?php echo esc_html($color_code); ?>;
}

.wiz-post-date {
    border: 1px solid <?php echo esc_html($color_code); ?>;
}
.nav-links a {
    background-color: <?php echo esc_html($color_code); ?>;
}
.wiz-logo-block {
    border-bottom: 2px solid <?php echo esc_html($color_code); ?>;
}
.blog-pagination a,
.wiz-pagination a{
    background-color: <?php echo esc_html($color_code); ?>;
    border: 1px solid <?php echo esc_html($color_code); ?>;
}
.blog-pagination a:hover,
.wiz-pagination a:hover,
.wiz-pagination a:focus{
    color:<?php echo esc_html($color_code); ?>;
}
#quickview .woocommerce button.button.alt{
    background-color: <?php echo esc_html($color_code); ?>;
}
</style>
<?php }
add_action( 'wp_head', 'wiz_ecommerce_color_style');

/**
 * Fix skip link focus in IE11.
 */
function wiz_ecommerce_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'wiz_ecommerce_skip_link_focus_fix' );
