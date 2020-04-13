<?php
/**
 * wiz_ecommerce Theme Customizer
 *
 * @package wiz_ecommerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wiz_ecommerce_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.brand a',
			'render_callback' => 'wiz_ecommerce_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.tagline',
			'render_callback' => 'wiz_ecommerce_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section( 'wiz_ecommerce_general_section' , array(
		'title'       => __( 'General Options', 'wiz-ecommerce' ),
		'priority'    => 20,
		'description' => __( 'Theme\'s general settings ', 'wiz-ecommerce' ),
	) );

	$wp_customize->add_setting( 'wiz_ecommerce_theme_color_setting', array (
		'default'     => '#0098ff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wiz_ecommerce_theme_color', array(
		'label'    => __( 'Theme Color', 'wiz-ecommerce' ),
		'section'  => 'wiz_ecommerce_general_section',
		'settings' => 'wiz_ecommerce_theme_color_setting',
	) ) );

	//Header settings
	$wp_customize->add_section( 'wiz_ecommerce_header_section' , array(
		'title'       => __( 'Header Settings', 'wiz-ecommerce' ),
		'priority'    => 20,
	) );

	$wp_customize->add_setting('wiz_ecommerce_sticky_header', array(
			'default'        => 1,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_sticky_header', array(
		'settings' => 'wiz_ecommerce_sticky_header',
		'label'    => __('Sticky Header', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_header_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));



	$wp_customize->add_setting('wiz_ecommerce_display_nav', array(
			'default'        => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_display_nav', array(
		'settings' => 'wiz_ecommerce_display_nav',
		'label'    => __('Display Store menu', 'wiz-ecommerce'),
		'description'    => __('To add menu item please set <strong>Menu for Woocommerce pages</strong> ', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_header_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	if(wiz_ecommerce_wc_activated()){
		$wp_customize->add_setting('wiz_ecommerce_product_search', array(
				'default'        => 1,
				'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_product_search', array(
			'settings' => 'wiz_ecommerce_product_search',
			'section'  => 'wiz_ecommerce_header_section',
			'label'    => __('Display product search', 'wiz-ecommerce'),
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_display_cart', array(
			'default'        => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_cart', array(
			'settings' => 'wiz_ecommerce_display_cart',
			'label'    => __('Display Cart Icon', 'wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_header_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));
	}


	$wp_customize->add_setting('wiz_ecommerce_display_topbar_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_display_topbar_setting', array(
		'settings' => 'wiz_ecommerce_display_topbar_setting',
		'label'    => __('Display TopBar', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_header_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));

	$wp_customize->add_setting('wiz_ecommerce_mail_address', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email',
	));

	$wp_customize->add_control('wiz_ecommerce_mail_address', array(
		'settings' => 'wiz_ecommerce_mail_address',
		'label' => __('Email:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_header_section',
		'active_callback' =>'wiz_ecommerce_topbar_active_callback',
		'priority'	=> 24
	));

	$wp_customize->add_setting('wiz_ecommerce_contact_number', array(
		'default' => '',
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	));

	$wp_customize->add_control('wiz_ecommerce_contact_number', array(
		'settings' => 'wiz_ecommerce_contact_number',
		'label' => __('Contact Number:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_header_section',
		'active_callback' =>'wiz_ecommerce_topbar_active_callback',
		'priority'	=> 24
	));


	$wp_customize->add_setting('wiz_ecommerce_display_social_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_display_social_setting', array(
		'settings' => 'wiz_ecommerce_display_social_setting',
		'label'    => __('Display Social Icons', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_header_section',
		'type'     => 'checkbox',
		'active_callback' =>'wiz_ecommerce_topbar_active_callback',
		'priority'	=> 24
	));
	for($i=1; $i<=4; $i++){
	$wp_customize->add_setting('wiz_ecommerce_social_icon_'.$i, array(
		'default' => '',
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	));

	$wp_customize->add_control('wiz_ecommerce_social_icon_'.$i, array(
		'settings' => 'wiz_ecommerce_social_icon_'.$i,
		'label' => __('Header Social Icon ','wiz-ecommerce').$i,
		'description' => __( 'Please add <strong>FontAwesome</strong> Class of respective social. Like  <strong>fa fa-facebook</strong>', 'wiz-ecommerce' ),
		'section' => 'wiz_ecommerce_header_section',
		'active_callback' =>'wiz_ecommerce_topbar_active_callback',
		'priority'	=> 24
	));

	$wp_customize->add_setting('wiz_ecommerce_social_link_'.$i, array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('wiz_ecommerce_social_link_'.$i, array(
		'settings' => 'wiz_ecommerce_social_link_'.$i,
		'label' => __('Social Icon Link ','wiz-ecommerce').$i,
		'description' => __( 'Please add Social Icon Link', 'wiz-ecommerce' ),
		'section' => 'wiz_ecommerce_header_section',
		'active_callback' =>'wiz_ecommerce_topbar_active_callback',
		'priority'	=> 24
	));
	}

	//front page panel
	$wp_customize->add_panel( 'wiz_ecommerce_frontpage_panel', array(
	    'priority' => 20,
	    'title' => __( 'Front Page Option', 'wiz-ecommerce' ),
	    'description' => __( 'Manage Theme\'s front page sections.', 'wiz-ecommerce' ),
	) );

	//home slider
	$wp_customize->add_section( 'wiz_ecommerce_slider_section', array(
	    'priority' => 20,
	    'title' => __( 'Slider', 'wiz-ecommerce' ),
	    'description' => __( 'Manage theme slider and it\'s features', 'wiz-ecommerce' ),
	    'panel' => 'wiz_ecommerce_frontpage_panel',
	) );

	$wp_customize->add_setting('wiz_ecommerce_display_slider', array(
		'default'        => 0,
		'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_display_slider', array(
		'settings' => 'wiz_ecommerce_display_slider',
		'label'    => __('Show theme slider', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_slider_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));


	$wp_customize->add_setting( 'wiz_ecommerce_slider_page_ids', array (
		'default'     => '',
		'sanitize_callback' => 'wiz_ecommerce_sanitize_post_control',
	) );

	$wp_customize->add_control(
		new Wiz_Ecommerce_Page_Control(
			$wp_customize,
			'wiz_ecommerce_slider_page_ids',
			array(
				'label'    => __('Select Pages', 'wiz-ecommerce'),
				'settings' => 'wiz_ecommerce_slider_page_ids',
				'section'  => 'wiz_ecommerce_slider_section',
				'active_callback' =>'wiz_ecommerce_slider_active_callback',
				'priority'	=> 24
			)
		)
	);

	$wp_customize->add_setting('wiz_ecommerce_default_slide', array(
		'default' => get_template_directory_uri().'/img/slide-placeholder.jpg',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'wiz_ecommerce_default_slide',
           array(
				'label'      => __( 'Default Image for Slide', 'wiz-ecommerce' ),
				'description'      => __( 'Recommended size <strong>1920*800</strong>', 'wiz-ecommerce' ),
				'section'    => 'wiz_ecommerce_slider_section',
				'settings'   => 'wiz_ecommerce_default_slide',
				'active_callback' =>'wiz_ecommerce_slider_active_callback',
				'priority'	=> 24
           )
       )
   	);


	//home service
	$wp_customize->add_section( 'wiz_ecommerce_service_section', array(
	    'priority' => 20,
	    'title' => __( 'Services', 'wiz-ecommerce' ),
	    'description' => __( 'Manage theme services', 'wiz-ecommerce' ),
	    'panel' => 'wiz_ecommerce_frontpage_panel',
	) );

	$wp_customize->add_setting('wiz_ecommerce_display_service', array(
		'default'        => 0,
		'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));
	$wp_customize->add_control('wiz_ecommerce_display_service', array(
		'settings' => 'wiz_ecommerce_display_service',
		'label'    => __('Show theme service section', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_service_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));

	$wp_customize->add_setting('wiz_ecommerce_services_heading', array(
		'default' => 'Our <span>Services</span>',
		'sanitize_callback' => 'wiz_ecommerce_section_title',
	));

	$wp_customize->add_control('wiz_ecommerce_services_heading', array(
		'settings' => 'wiz_ecommerce_services_heading',
		'label' => __('Service Section Heading:','wiz-ecommerce'),
		'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_service_section',
		'active_callback' =>'wiz_ecommerce_service_active_callback',
		'priority'	=> 24
	));

	$wp_customize->add_setting( 'wiz_ecommerce_service_page_ids', array (
		'default'     => '',
		'sanitize_callback' => 'wiz_ecommerce_sanitize_post_control',
	) );

	$wp_customize->add_control(
		new Wiz_Ecommerce_Page_Control(
			$wp_customize,
			'wiz_ecommerce_service_page_ids',
			array(
				'label'    => __('Select Pages', 'wiz-ecommerce'),
				'settings' => 'wiz_ecommerce_service_page_ids',
				'section'  => 'wiz_ecommerce_service_section',
				'active_callback' =>'wiz_ecommerce_service_active_callback',
				'priority'	=> 24
			)
		)
	);

	//WooCommerce Section
	if(wiz_ecommerce_wc_activated()){
		$wp_customize->add_section( 'wiz_ecommerce_woo_latest', array(
		    'priority' => 20,
		    'title' => __( 'Latest Product Section', 'wiz-ecommerce' ),
		    'description' => __( 'Show latest 4 products added', 'wiz-ecommerce' ),
		    'panel' => 'wiz_ecommerce_frontpage_panel',
		) );

		$wp_customize->add_setting('wiz_ecommerce_display_latest', array(
			'default'        => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_latest', array(
			'settings' => 'wiz_ecommerce_display_latest',
			'label'    => __('Latest Products', 'wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_woo_latest',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_woo_latest', array(
			'default' => 'Latest <span>Products</span>',
			'sanitize_callback' => 'wiz_ecommerce_section_title',
		));

		$wp_customize->add_control('wiz_ecommerce_woo_latest', array(
			'settings' => 'wiz_ecommerce_woo_latest',
			'label' => __('Latest Products Section Heading:','wiz-ecommerce'),
			'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
			'section' => 'wiz_ecommerce_woo_latest',
			'priority'	=> 24
		));

		$wp_customize->add_section( 'wiz_ecommerce_woo_on_sale', array(
		    'priority' => 20,
		    'title' => __( 'On Sale Product Section', 'wiz-ecommerce' ),
		    'description' => __( 'Show latest 4 on-sale products.', 'wiz-ecommerce' ),
		    'panel' => 'wiz_ecommerce_frontpage_panel',
		) );

		$wp_customize->add_setting('wiz_ecommerce_display_sale', array(
			'default' => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_sale', array(
			'settings' => 'wiz_ecommerce_display_sale',
			'label'    => __('Products on Sale', 'wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_woo_on_sale',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_woo_sale', array(
			'default' => 'Latest <span>Offers</span>',
			'sanitize_callback' => 'wiz_ecommerce_section_title',
		));

		$wp_customize->add_control('wiz_ecommerce_woo_sale', array(
			'settings' => 'wiz_ecommerce_woo_sale',
			'label' => __('On Sale Section Heading:','wiz-ecommerce'),
			'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
			'section' => 'wiz_ecommerce_woo_on_sale',
			'priority'	=> 24
		));

		$wp_customize->add_section( 'wiz_ecommerce_woo_cats_section', array(
		    'priority' => 20,
		    'title' => __( 'Product Category Section', 'wiz-ecommerce' ),
		    'description' => __( 'Show selected product categories. <strong>Please add image to the category else default image will show.</strong>', 'wiz-ecommerce' ),
		    'panel' => 'wiz_ecommerce_frontpage_panel',
		) );

		$wp_customize->add_setting('wiz_ecommerce_display_cats', array(
			'default'        => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_cats', array(
			'settings' => 'wiz_ecommerce_display_cats',
			'label'    => __('Products Categories', 'wiz-ecommerce'),
			'description' => __('This section will show product category with image.','wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_woo_cats_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_woo_cats', array(
			'default' => 'Our <span>Collection</span>',
			'sanitize_callback' => 'wiz_ecommerce_section_title',
		));

		$wp_customize->add_control('wiz_ecommerce_woo_cats', array(
			'settings' => 'wiz_ecommerce_woo_cats',
			'label' => __('Product Categories Section Heading:','wiz-ecommerce'),
			'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
			'section' => 'wiz_ecommerce_woo_cats_section',
			'priority'	=> 24
		));

		$wp_customize->add_setting( 'wiz_ecommerce_cat_ids', array (
			'default'     => '',
			'sanitize_callback' => 'wiz_ecommerce_sanitize_post_control',
		) );

		$wp_customize->add_control(
			new wiz_Ecommerce_Category_Control(
				$wp_customize,
				'wiz_ecommerce_cat_ids',
				array(
					'label'    => __('Select Product Categories', 'wiz-ecommerce'),
					'settings' => 'wiz_ecommerce_cat_ids',
					'section'  => 'wiz_ecommerce_woo_cats_section',
					'priority'	=> 24
				)
			)
		);

		$wp_customize->add_setting('wiz_ecommerce_default_cat_img', array(
			'default' => get_template_directory_uri().'/img/cat-placeholder.jpg',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control(
	       new WP_Customize_Image_Control(
	           $wp_customize,
	           'wiz_ecommerce_default_cat_img',
	           array(
					'label'      => __( 'Default Image for Category', 'wiz-ecommerce' ),
					'description'    => __('Recommended size <strong>300*300</strong>', 'wiz-ecommerce'),
					'section'    => 'wiz_ecommerce_woo_cats_section',
					'settings'   => 'wiz_ecommerce_default_cat_img',
					'priority'	=> 24
	           )
	       )
	   	);

		$wp_customize->add_section( 'wiz_ecommerce_woo_top_section', array(
		    'priority' => 20,
		    'title' => __( 'High Rated Product Section', 'wiz-ecommerce' ),
		    'description' => __( 'Show 4 top rated products.', 'wiz-ecommerce' ),
		    'panel' => 'wiz_ecommerce_frontpage_panel',
		) );

		$wp_customize->add_setting('wiz_ecommerce_display_top', array(
			'default' => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_top', array(
			'settings' => 'wiz_ecommerce_display_top',
			'label'    => __('Most Reviewed Products', 'wiz-ecommerce'),
			'description' => __('This section will show most reviewed products.','wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_woo_top_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_woo_top', array(
			'default' => 'Our <span>Gems</span>',
			'sanitize_callback' => 'wiz_ecommerce_section_title',
		));

		$wp_customize->add_control('wiz_ecommerce_woo_top', array(
			'settings' => 'wiz_ecommerce_woo_top',
			'label' => __('Most reviewed Products Section Heading:','wiz-ecommerce'),
			'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
			'section' => 'wiz_ecommerce_woo_top_section',
			'priority'	=> 24
		));

		$wp_customize->add_section( 'wiz_ecommerce_woo_featured_section', array(
		    'priority' => 20,
		    'title' => __( 'Featured Product Section', 'wiz-ecommerce' ),
		    'description' => __( 'Show latest 4 featured Products. You can mark featured product by clicking star on products list(admin area).', 'wiz-ecommerce' ),
		    'panel' => 'wiz_ecommerce_frontpage_panel',
		) );

		$wp_customize->add_setting('wiz_ecommerce_display_featured', array(
			'default'        => 0,
			'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
		));
		$wp_customize->add_control('wiz_ecommerce_display_featured', array(
			'settings' => 'wiz_ecommerce_display_featured',
			'label'    => __('Featured Products', 'wiz-ecommerce'),
			'description' => __('This section will show most featured products.','wiz-ecommerce'),
			'section'  => 'wiz_ecommerce_woo_featured_section',
			'type'     => 'checkbox',
			'priority'	=> 24
		));

		$wp_customize->add_setting('wiz_ecommerce_woo_featured', array(
			'default' => '<span>Featured</span> Products',
			'sanitize_callback' => 'wiz_ecommerce_section_title',
		));

		$wp_customize->add_control('wiz_ecommerce_woo_featured', array(
			'settings' => 'wiz_ecommerce_woo_featured',
			'label' => __('Featured Products Section Heading:','wiz-ecommerce'),
			'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
			'section' => 'wiz_ecommerce_woo_featured_section',
			'priority'	=> 24
		));
	}

	$wp_customize->add_section( 'wiz_ecommerce_blog_section', array(
	    'priority' => 20,
	    'title' => __( 'Blog Section', 'wiz-ecommerce' ),
	    'panel' => 'wiz_ecommerce_frontpage_panel',
	) );

	$wp_customize->add_setting('wiz_ecommerce_blog_title', array(
		'default' => 'Latest <span>News</span>',
		'sanitize_callback' => 'wiz_ecommerce_section_title',
	));

	$wp_customize->add_control('wiz_ecommerce_blog_title', array(
		'settings' => 'wiz_ecommerce_blog_title',
		'label' => __('Home Blog Section Heading:','wiz-ecommerce'),
		'description' => __('Please include text in <strong>span</strong> tag to show text in bold.','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_blog_section',
		'priority'	=> 24
	));

	$wp_customize->add_section( 'wiz_ecommerce_cta_section', array(
	    'priority' => 20,
	    'title' => __( 'Call To Action', 'wiz-ecommerce' ),
	    'description' => __( 'Manage front page Call To Action Settings', 'wiz-ecommerce' ),
	    'panel' => 'wiz_ecommerce_frontpage_panel',
	) );
	$wp_customize->add_setting('wiz_ecommerce_display_cta', array(
		'default'        => 0,
		'sanitize_callback' => 'wiz_ecommerce_sanitize_checkbox',
	));

	$wp_customize->add_control('wiz_ecommerce_display_cta', array(
		'settings' => 'wiz_ecommerce_display_cta',
		'label'    => __('Call To Action', 'wiz-ecommerce'),
		'section'  => 'wiz_ecommerce_cta_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));

	$wp_customize->add_setting('wiz_ecommerce_cta_btn', array(
		'default' => __('Contact Us','wiz-ecommerce'),
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	));

	$wp_customize->add_control('wiz_ecommerce_cta_btn', array(
		'settings' => 'wiz_ecommerce_cta_btn',
		'label' => __('Call To Action Button Text:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_cta_section',
		'priority'	=> 24
	));

	$wp_customize->add_setting( 'wiz_ecommerce_cta_page', array (
		'default'     => '',
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	) );

	$wp_customize->add_control(
		new Wiz_Ecommerce_Page_Single_Control(
			$wp_customize,
			'wiz_ecommerce_cta_page',
			array(
				'label'    => __('Select Pages', 'wiz-ecommerce'),
				'settings' => 'wiz_ecommerce_cta_page',
				'section'  => 'wiz_ecommerce_cta_section',
				'priority'	=> 24
			)
		)
	);


	//footer
	$wp_customize->add_section( 'wiz_ecommerce_footer_section' , array(
		'title'       => __( 'Footer Settings', 'wiz-ecommerce' ),
		'priority'    => 25,
		'description' => __( 'Customize theme footer', 'wiz-ecommerce' ),
	) );

	$wp_customize->add_setting('wiz_ecommerce_footer_credit', array(
		'default' => __('All Rights Reserved ','wiz-ecommerce'),
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	));


	$wp_customize->add_control('wiz_ecommerce_footer_credit', array(
		'settings' => 'wiz_ecommerce_footer_credit',
		'label' => __('Footer Credit Text:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_footer_section',
		'priority'	=> 30
	));

	$wp_customize->add_setting('wiz_ecommerce_footer_company', array(
		'default' => get_bloginfo( 'name' ),
		'sanitize_callback' => 'wiz_ecommerce_sanitize_text_field',
	));

	$wp_customize->add_control('wiz_ecommerce_footer_company', array(
		'settings' => 'wiz_ecommerce_footer_company',
		'label' => __('Footer Company Name:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_footer_section',
		'priority'	=> 30
	));

	$wp_customize->add_setting('wiz_ecommerce_footer_link', array(
		'default' => home_url( '/' ),
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('wiz_ecommerce_footer_link', array(
		'settings' => 'wiz_ecommerce_footer_link',
		'label' => __('Footer Company Link:','wiz-ecommerce'),
		'section' => 'wiz_ecommerce_footer_section',
		'priority'	=> 30
	));
}
add_action( 'customize_register', 'wiz_ecommerce_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wiz_ecommerce_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wiz_ecommerce_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wiz_ecommerce_customize_preview_js() {
	wp_enqueue_script( 'wiz_ecommerce-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wiz_ecommerce_customize_preview_js' );

//Sanitize checkbox

if (!function_exists( 'wiz_ecommerce_sanitize_checkbox' ) ) :
	function wiz_ecommerce_sanitize_checkbox( $input ) {
		if ( $input != 1 ) {
			return 0;
		} else {
			return 1;
		}
	}
endif;

//sanitize array output
if (!function_exists( 'wiz_ecommerce_sanitize_post_control' ) ) :
	function wiz_ecommerce_sanitize_post_control( $input ) {
		if(is_array($input)){
			return $input;
		}else{
			$input= array();
			return $input;
		}

	}
endif;


// Text field sanitize function
if (!function_exists( 'wiz_ecommerce_sanitize_text_field' ) ) :
	function wiz_ecommerce_sanitize_text_field( $str ) {
		return sanitize_text_field( $str );

	}
endif;

//active callback function
function wiz_ecommerce_topbar_active_callback() {
	if ( get_theme_mod( 'wiz_ecommerce_display_topbar_setting', 0 ) ) {
		return true;
	}
	return false;
}

function wiz_ecommerce_slider_active_callback() {
	if ( get_theme_mod( 'wiz_ecommerce_display_slider', 0 ) ) {
		return true;
	}
	return false;
}

function wiz_ecommerce_service_active_callback() {
	if ( get_theme_mod( 'wiz_ecommerce_display_service', 0 ) ) {
		return true;
	}
	return false;
}

//custom control
if( class_exists( 'WP_Customize_Control' ) ):
	class Wiz_Ecommerce_Page_Control extends WP_Customize_Control {
		public function render_content() {
		$wiz_ecommerce_page_list= array('post_type'=>'page', 'post_status' => 'publish',  'posts_per_page'=>-1);
		$wiz_ecommerce_pages = new WP_Query($wiz_ecommerce_page_list);
		if($wiz_ecommerce_pages->have_posts()){
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
					<?php while($wiz_ecommerce_pages->have_posts()){
					$wiz_ecommerce_pages->the_post();
					?>
					<option value="<?php the_ID(); ?>" <?php if(null != $this->value() && is_array($this->value())):foreach($this->value() as $post_id){ if($post_id== get_the_ID()) echo 'selected'; } endif; ?>><?php the_title(); ?></option>
					<?php } ?>
				</select>
			</label>
		<?php }else{ ?>
			<p style="color:red;"><?php esc_html_e( 'No Page Found', 'wiz-ecommerce' ); ?></p>
		<?php }
		wp_reset_postdata();
		}
	}
endif;

if( class_exists( 'WP_Customize_Control' ) ):
	class wiz_Ecommerce_Category_Control extends WP_Customize_Control {
		public function render_content() {
		$prod_categories = get_terms( 'product_cat', array(
					'orderby'    => 'name',
					'order'      => 'ASC',
					'hide_empty' => true
				));
		if(!empty($prod_categories)){ ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
					<?php foreach( $prod_categories as $prod_cat ) { ?>
					<option value="<?php echo esc_attr( $prod_cat->term_id); ?>" <?php if(null != $this->value() && is_array($this->value())):foreach($this->value() as $id){ if($id== $prod_cat->term_id) echo 'selected'; } endif; ?>><?php echo esc_html($prod_cat->name); ?></option>
					<?php } ?>
				</select>
			</label>
		<?php }else{ ?>
			<p style="color:red;"><?php esc_html_e( 'No Product Category Found', 'wiz-ecommerce' ); ?></p>
		<?php }
		wp_reset_postdata();
		}
	}
endif;

if( class_exists( 'WP_Customize_Control' ) ):
	class Wiz_Ecommerce_Page_Single_Control extends WP_Customize_Control {
		public function render_content() {
		$wiz_ecommerce_page_list= array('post_type'=>'page', 'post_status' => 'publish',  'posts_per_page'=>-1);
		$wiz_ecommerce_pages = new WP_Query($wiz_ecommerce_page_list);
		if($wiz_ecommerce_pages->have_posts()){
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> style="height: 100%;">
					<?php while($wiz_ecommerce_pages->have_posts()){
					$wiz_ecommerce_pages->the_post();
					?>
					<option value="<?php the_ID(); ?>" <?php if(null != $this->value() && is_array($this->value())):foreach($this->value() as $post_id){ if($post_id== get_the_ID()) echo 'selected'; } endif; ?>><?php the_title(); ?></option>
					<?php } ?>
				</select>
			</label>
		<?php }else{ ?>
			<p style="color:red;"><?php esc_html_e( 'No Page Found', 'wiz-ecommerce' ); ?></p>
		<?php }
		wp_reset_postdata();
		}
	}
endif;
