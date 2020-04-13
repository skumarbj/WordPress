<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_blog_magazine_first_color = get_theme_mod('vw_blog_magazine_first_color');

	$custom_css = '';

	if($vw_blog_magazine_first_color != false){
		$custom_css .='.footer .tagcloud a:hover,.blogbutton-small, .footer .custom-social-icons i:hover, .sidebar .custom-social-icons i:hover, .sidebar input[type="submit"], .footer input[type="submit"], .scrollup i, .woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .pagination .current, .pagination a:hover, nav.woocommerce-MyAccount-navigation ul li, #comments a.comment-reply-link, input[type="submit"], .toggle-nav i, .sidebar .widget_price_filter .ui-slider .ui-slider-range, .sidebar .widget_price_filter .ui-slider .ui-slider-handle, .sidebar .woocommerce-product-search button, .footer .widget_price_filter .ui-slider .ui-slider-range, .footer .widget_price_filter .ui-slider .ui-slider-handle, .footer .woocommerce-product-search button{';
			$custom_css .='background-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='#comments input[type="submit"].submit{';
			$custom_css .='background-color: '.esc_html($vw_blog_magazine_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='a, .custom-social-icons i:hover, .logo h1 a, .logo p, .postbox:hover h4, .postbox:hover i, .metabox i, .blogbutton-small:hover, .blog-icon i:hover, .footer .custom-social-icons i, .sidebar .custom-social-icons i, .footer h3, .woocommerce-message::before, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .entry-content a, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, h4.section-title a, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, h2.section-title a{';
			$custom_css .='color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='.blogbutton-small, .footer .custom-social-icons i:hover, .sidebar .custom-social-icons i:hover, input[type="submit"]{';
			$custom_css .='border-color: '.esc_html($vw_blog_magazine_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='hr.big, .footer-2, .logo, .main-navigation ul ul, .page-template-custom-home-page .logo{';
			$custom_css .='border-top-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}
	if($vw_blog_magazine_first_color != false){
		$custom_css .='.logo, .header-fixed, .main-navigation ul ul, .page-template-custom-home-page .logo{';
			$custom_css .='border-bottom-color: '.esc_html($vw_blog_magazine_first_color).';';
		$custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_blog_magazine_width_option','Full Width');
    if($theme_lay == 'Boxed'){
		$custom_css .='body{';
			$custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$custom_css .='}';
		$custom_css .='.logo{';
			$custom_css .='width: 97.4%;';
		$custom_css .='}';
	}else if($theme_lay == 'Wide Width'){
		$custom_css .='body{';
			$custom_css .='width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$custom_css .='}';
		$custom_css .='.logo{';
			$custom_css .='width: 97.7%;';
		$custom_css .='}';
	}else if($theme_lay == 'Full Width'){
		$custom_css .='body{';
			$custom_css .='max-width: 100%;';
		$custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_blog_magazine_blog_layout_option','Default');
    if($theme_lay == 'Default'){
		$custom_css .='.postbox smallpostimage{';
			$custom_css .='';
		$custom_css .='}';
		$custom_css .='.new-text{';
			$custom_css .='padding: 10px 25px;';
		$custom_css .='}';
	}else if($theme_lay == 'Center'){
		$custom_css .='.postbox smallpostimage, .postbox h2, .inner-service .metabox, .box-content p, .testbutton,.box-image, .box-content h3, .inner-service .read-btn {';
			$custom_css .='text-align:center;';
		$custom_css .='}';
		$custom_css .='.inner-service hr.big{';
			$custom_css .='margin:10px auto 0;';
		$custom_css .='}';
		$custom_css .='.box-image{';
			$custom_css .='margin-bottom: 10px;';
		$custom_css .='}';
		$custom_css .='.box-content p{';
			$custom_css .='margin-top: 10px;';
		$custom_css .='}';
	}else if($theme_lay == 'Left'){
		$custom_css .='.postbox smallpostimage, .postbox h2, .metabox, .box-content p, .testbutton{';
			$custom_css .='text-align:Left;';
		$custom_css .='}';
		$custom_css .='.box-content p{';
			$custom_css .='margin-top: 10px;';
		$custom_css .='}';
		$custom_css .='.postbox h2{';
			$custom_css .='margin-top: 10px;';
		$custom_css .='}';
	}

	/*----- Share link ------*/
	if(get_theme_mod('vw_blog_magazine_toggle_share_link',false) == 0){ 
		if($theme_lay == 'Center'){
			$custom_css .='.read-btn{';
				$custom_css .='text-align:center; margin: 12px 0 20px;';
			$custom_css .='}';
		}
	}

	/*------------------------------Responsive Media -----------------------*/

	$stickyheader = get_theme_mod( 'vw_blog_magazine_stickyheader_hide_show',true);
    if($stickyheader == true){
    	$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.header-fixed{';
			$custom_css .='display:block;';
		$custom_css .='} }';
	}else if($stickyheader == false){
		$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.header-fixed{';
			$custom_css .='display:none;';
		$custom_css .='} }';
	}

	$metabox = get_theme_mod( 'vw_blog_magazine_metabox_hide_show',true);
    if($metabox == true){
    	$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.metabox{';
			$custom_css .='display:block;';
		$custom_css .='} }';
	}else if($metabox == false){
		$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.metabox{';
			$custom_css .='display:none;';
		$custom_css .='} }';
	}

	$sidebar = get_theme_mod( 'vw_blog_magazine_sidebar_hide_show',true);
    if($sidebar == true){
    	$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.sidebar{';
			$custom_css .='display:block;';
		$custom_css .='} }';
	}else if($sidebar == false){
		$custom_css .='@media screen and (max-width:575px) {';
		$custom_css .='.sidebar{';
			$custom_css .='display:none;';
		$custom_css .='} }';
	}

	/*---------------- Button Settings ------------------*/

	$vw_blog_magazine_button_padding_top_bottom = get_theme_mod('vw_blog_magazine_button_padding_top_bottom');
	$vw_blog_magazine_button_padding_left_right = get_theme_mod('vw_blog_magazine_button_padding_left_right');
	if($vw_blog_magazine_button_padding_top_bottom != false || $vw_blog_magazine_button_padding_left_right != false){
		$custom_css .='#our-services .blogbutton-small{';
			$custom_css .='padding-top: '.esc_html($vw_blog_magazine_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_blog_magazine_button_padding_top_bottom).';padding-left: '.esc_html($vw_blog_magazine_button_padding_left_right).';padding-right: '.esc_html($vw_blog_magazine_button_padding_left_right).';';
		$custom_css .='}';
	}

	$vw_blog_magazine_button_border_radius = get_theme_mod('vw_blog_magazine_button_border_radius');
	if($vw_blog_magazine_button_border_radius != false){
		$custom_css .='#our-services .blogbutton-small{';
			$custom_css .='border-radius: '.esc_html($vw_blog_magazine_button_border_radius).'px;';
		$custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_blog_magazine_copyright_alingment = get_theme_mod('vw_blog_magazine_copyright_alingment');
	if($vw_blog_magazine_copyright_alingment != false){
		$custom_css .='.copyright p{';
			$custom_css .='text-align: '.esc_html($vw_blog_magazine_copyright_alingment).';';
		$custom_css .='}';
	}

	$vw_blog_magazine_copyright_padding_top_bottom = get_theme_mod('vw_blog_magazine_copyright_padding_top_bottom');
	if($vw_blog_magazine_copyright_padding_top_bottom != false){
		$custom_css .='.footer-2{';
			$custom_css .='padding-top: '.esc_html($vw_blog_magazine_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_blog_magazine_copyright_padding_top_bottom).';';
		$custom_css .='}';
	}
