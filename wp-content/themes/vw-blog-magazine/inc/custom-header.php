<?php
/**
 * @package VW Blog Magazine
 * Setup the WordPress core custom header feature.
 *
 * @uses vw_blog_magazine_header_style()
*/
function vw_blog_magazine_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'vw_blog_magazine_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 320,
		'flex-width'             => true,
		'flex-height'            => true,
		'admin-preview-callback' => 'vw_blog_magazine_admin_header_image',
	) ) );
}

add_action( 'after_setup_theme', 'vw_blog_magazine_custom_header_setup' );

if ( ! function_exists( 'vw_blog_magazine_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vw_blog_magazine_header_style_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'vw_blog_magazine_header_style' );
function vw_blog_magazine_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .header,.logo{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
			background-size: 100%;
		}";
	   	wp_add_inline_style( 'vw-blog-magazine-basic-style', $custom_css );
	endif;
}
endif; // vw_blog_magazine_header_style