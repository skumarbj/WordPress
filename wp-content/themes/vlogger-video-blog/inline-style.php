<?php

	$vw_blog_magazine_first_color = get_theme_mod('vw_blog_magazine_first_color');

	$custom_css = '';

	if($vw_blog_magazine_first_color != false){
		$custom_css .='.more-btn a:hover,.sidebar td#today,#playlist_sec button.owl-prev:hover, #playlist_sec button.owl-next:hover,#categry button.owl-prev:hover,#categry button.owl-next:hover,.imagebox .cat-tag:hover,a.post-tag,.footer-2{';
			$custom_css .='background-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='.video-content h2 a:hover,.box-content h4 a:hover,.sidebar td#prev a,.imagebox .cat-tag:hover a.post-tag,
		.search-box i:hover{';
			$custom_css .='color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='.more-btn a:hover{';
			$custom_css .='border-color: '.esc_html($vw_blog_magazine_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='#header, .header-fixed, .woocommerce-message{';
			$custom_css .='border-top-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='
		@media screen and (max-width: 1000px){
			.search-box i{';
			$custom_css .='background-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='} }';
	}

	/*---------------------------Width Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_blog_magazine_width_option','Full Width');
    if($theme_lay == 'Boxed'){
		$custom_css .='body{';
			$custom_css .='margin-right: auto !important; margin-left: auto !important;';
		$custom_css .='}';
		$custom_css .='.logo{';
			$custom_css .='width: 100%;';
		$custom_css .='}';
		$custom_css .='.read-btn{';
			$custom_css .='padding-right: 0 !important;';
		$custom_css .='}';
	}else if($theme_lay == 'Wide Width'){
		$custom_css .='.logo{';
			$custom_css .='width: 100%;';
		$custom_css .='}';
	}