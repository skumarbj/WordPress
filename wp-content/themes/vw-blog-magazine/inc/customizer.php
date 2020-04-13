<?php
/**
 * VW Blog Magazine Theme Customizer
 *
 * @package VW Blog Magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_blog_magazine_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_blog_magazine_custom_controls' );

function vw_blog_magazine_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$VWBlogMagazineParentPanel = new VW_Blog_Magazine_WP_Customize_Panel( $wp_customize, 'vw_blog_magazine_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'VW Settings',
		'priority' => 10,
	));

	$wp_customize->add_section( 'vw_blog_magazine_left_right', array(
    	'title'      => __( 'General Settings', 'vw-blog-magazine' ),
		'priority'   => 30,
		'panel' => 'vw_blog_magazine_panel_id'
	) );

	$wp_customize->add_setting('vw_blog_magazine_width_option',array(
        'default' => __('Full Width','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Blog_Magazine_Image_Radio_Control($wp_customize, 'vw_blog_magazine_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-blog-magazine'),
        'description' => __('Here you can change the width layout of Website.','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_blog_magazine_theme_options',array(
        'default' => __('Right Sidebar','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_blog_magazine_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-blog-magazine'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-blog-magazine'),
            'Right Sidebar' => __('Right Sidebar','vw-blog-magazine'),
            'One Column' => __('One Column','vw-blog-magazine'),
            'Three Columns' => __('Three Columns','vw-blog-magazine'),
            'Four Columns' => __('Four Columns','vw-blog-magazine'),
            'Grid Layout' => __('Grid Layout','vw-blog-magazine')
        ),
	));

	$wp_customize->add_setting('vw_blog_magazine_page_layout',array(
        'default' => __('One Column','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
	));
	$wp_customize->add_control('vw_blog_magazine_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-blog-magazine'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-blog-magazine'),
            'Right Sidebar' => __('Right Sidebar','vw-blog-magazine'),
            'One Column' => __('One Column','vw-blog-magazine')
        ),
	) );

	//Sticky Header
	$wp_customize->add_setting( 'vw_blog_magazine_sticky_header',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-blog-magazine' ),
        'section' => 'vw_blog_magazine_left_right'
    )));

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_blog_magazine_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_left_right'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_blog_magazine_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_left_right'
    )));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_blog_magazine_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-blog-magazine' ),
        'section' => 'vw_blog_magazine_left_right'
    )));

	$wp_customize->add_setting('vw_blog_magazine_loader_icon',array(
        'default' => __('Two Way','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
	));
	$wp_customize->add_control('vw_blog_magazine_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','vw-blog-magazine'),
            'Dots' => __('Dots','vw-blog-magazine'),
            'Rotate' => __('Rotate','vw-blog-magazine')
        ),
	) );

	//Our Blog Category section
  	$wp_customize->add_section('vw_blog_magazine_category_section',array(
	    'title' => __('Category Section','vw-blog-magazine'),
	    'description' => '',
	    'priority'  => null,
	    'panel' => 'vw_blog_magazine_panel_id',
	)); 

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_blog_magazine_category',array(
	    'default' => 'select',
	    'sanitize_callback' => 'vw_blog_magazine_sanitize_choices',
  	));

  	$wp_customize->add_control('vw_blog_magazine_category',array(
	    'type'    => 'select',
	    'choices' => $cat_pst,
	    'label' => __('Select Category to display Latest Post','vw-blog-magazine'),
	    'section' => 'vw_blog_magazine_category_section',
	));

	//Category section 2
  	$wp_customize->add_section('vw_blog_magazine_cat_two_sec',array(
	    'title' => __('Category section 2','vw-blog-magazine'),
	    'description' => '',
	    'priority'  => null,
	    'panel' => 'vw_blog_magazine_panel_id',
	)); 

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst1[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst1[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_blog_magazine_section_two',array(
	    'default' => 'select',
	    'sanitize_callback' => 'vw_blog_magazine_sanitize_choices',
  	));

  	$wp_customize->add_control('vw_blog_magazine_section_two',array(
	    'type'    => 'select',
	    'choices' => $cat_pst1,
	    'label' => __('Select Category to display Latest Post','vw-blog-magazine'),
	    'section' => 'vw_blog_magazine_cat_two_sec',
	));

	//Category 2 excerpt
	$wp_customize->add_setting( 'vw_blog_magazine_category_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control( 'vw_blog_magazine_category_excerpt_number', array(
		'label'       => esc_html__( 'Category Excerpt length','vw-blog-magazine' ),
		'section'     => 'vw_blog_magazine_cat_two_sec',
		'type'        => 'range',
		'settings'    => 'vw_blog_magazine_category_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	));

	//Blog Post
	$wp_customize->add_panel( $VWBlogMagazineParentPanel );

	$BlogPostParentPanel = new VW_Blog_Magazine_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-blog-magazine' ),
		'panel' => 'vw_blog_magazine_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_blog_magazine_post_settings', array(
		'title' => __( 'Post Settings', 'vw-blog-magazine' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting( 'vw_blog_magazine_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-blog-magazine' ),
        'section' => 'vw_blog_magazine_post_settings'
    )));

    $wp_customize->add_setting( 'vw_blog_magazine_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_toggle_author',array(
		'label' => esc_html__( 'Author','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_post_settings'
    )));

    $wp_customize->add_setting( 'vw_blog_magazine_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_post_settings'
    )));

    $wp_customize->add_setting( 'vw_blog_magazine_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_post_settings'
    )));

    $wp_customize->add_setting( 'vw_blog_magazine_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	));
	$wp_customize->add_control( 'vw_blog_magazine_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-blog-magazine' ),
		'section'     => 'vw_blog_magazine_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_blog_magazine_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	));

	//Blog layout
    $wp_customize->add_setting('vw_blog_magazine_blog_layout_option',array(
        'default' => __('Default','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Blog_Magazine_Image_Radio_Control($wp_customize, 'vw_blog_magazine_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_post_settings',
        'choices' => array(
            'Default' => get_template_directory_uri().'/images/blog-layout1.png',
            'Center' => get_template_directory_uri().'/images/blog-layout2.png',
            'Left' => get_template_directory_uri().'/images/blog-layout3.png',
    ))));

    // Button Settings
	$wp_customize->add_section( 'vw_blog_magazine_button_settings', array(
		'title' => __( 'Button Settings', 'vw-blog-magazine' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('vw_blog_magazine_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-blog-magazine'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_blog_magazine_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-blog-magazine'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_blog_magazine_button_border_radius', array(
		'default'              => '',
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_blog_magazine_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-blog-magazine' ),
		'section'     => 'vw_blog_magazine_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_blog_magazine_button_text',array(
		'default'=> 'Read Full',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_button_text',array(
		'label'	=> __('Add Button Text','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( 'Read Full', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_blog_magazine_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-blog-magazine' ),
		'panel' => 'blog_post_parent_panel',
	));

    $wp_customize->add_setting( 'vw_blog_magazine_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_related_post',array(
		'label' => esc_html__( 'Related Post','vw-blog-magazine' ),
		'section' => 'vw_blog_magazine_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_blog_magazine_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_blog_magazine_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_related_posts_settings',
		'type'=> 'number'
	));

    //404 Page Setting
	$wp_customize->add_section('vw_blog_magazine_404_page',array(
		'title'	=> __('404 Page Settings','vw-blog-magazine'),
		'panel' => 'vw_blog_magazine_panel_id',
	));	

	$wp_customize->add_setting('vw_blog_magazine_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_blog_magazine_404_page_title',array(
		'label'	=> __('Add Title','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_blog_magazine_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_blog_magazine_404_page_content',array(
		'label'	=> __('Add Text','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_blog_magazine_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to Home Page', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_404_page',
		'type'=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('vw_blog_magazine_responsive_media',array(
		'title'	=> __('Responsive Media','vw-blog-magazine'),
		'panel' => 'vw_blog_magazine_panel_id',
	));

    $wp_customize->add_setting( 'vw_blog_magazine_stickyheader_hide_show',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_stickyheader_hide_show',array(
          'label' => esc_html__( 'Sticky Header','vw-blog-magazine' ),
          'section' => 'vw_blog_magazine_responsive_media'
    )));

	$wp_customize->add_setting( 'vw_blog_magazine_metabox_hide_show',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_metabox_hide_show',array(
          'label' => esc_html__( 'Show / Hide Metabox','vw-blog-magazine' ),
          'section' => 'vw_blog_magazine_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_blog_magazine_sidebar_hide_show',array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_sidebar_hide_show',array(
          'label' => esc_html__( 'Show / Hide Sidebar','vw-blog-magazine' ),
          'section' => 'vw_blog_magazine_responsive_media'
    )));

    $wp_customize->add_setting('vw_blog_magazine_res_menu_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Blog_Magazine_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_blog_magazine_res_menu_open_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-blog-magazine'),
		'transport' => 'refresh',
		'section'	=> 'vw_blog_magazine_responsive_media',
		'setting'	=> 'vw_blog_magazine_res_menu_open_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_blog_magazine_res_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Blog_Magazine_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_blog_magazine_res_close_menu_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-blog-magazine'),
		'transport' => 'refresh',
		'section'	=> 'vw_blog_magazine_responsive_media',
		'setting'	=> 'vw_blog_magazine_res_close_menu_icon',
		'type'		=> 'icon'
	)));

	//Content Creation
	$wp_customize->add_section( 'vw_blog_magazine_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-blog-magazine' ),
		'priority' => null,
		'panel' => 'vw_blog_magazine_panel_id'
	));

	$wp_customize->add_setting('vw_blog_magazine_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	));

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Blog_Magazine_Content_Creation( $wp_customize, 'vw_blog_magazine_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-blog-magazine' ),
		),
		'section' => 'vw_blog_magazine_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-blog-magazine' ),
	)));

	//footer
	$wp_customize->add_section('vw_blog_magazine_footer_section',array(
		'title'	=> __('Footer Text','vw-blog-magazine'),
		'description'	=> __('Add some text for footer like copyright etc.','vw-blog-magazine'),
		'priority'	=> null,
		'panel' => 'vw_blog_magazine_panel_id',
	));
	
	$wp_customize->add_setting('vw_blog_magazine_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('vw_blog_magazine_footer_copy',array(
		'label'	=> __('Copyright Text','vw-blog-magazine'),
		'section'	=> 'vw_blog_magazine_footer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_blog_magazine_copyright_alingment',array(
        'default' => __('center','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Blog_Magazine_Image_Radio_Control($wp_customize, 'vw_blog_magazine_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_footer_section',
        'settings' => 'vw_blog_magazine_copyright_alingment',
        'choices' => array(
            'left' => get_template_directory_uri().'/images/copyright1.png',
            'center' => get_template_directory_uri().'/images/copyright2.png',
            'right' => get_template_directory_uri().'/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_blog_magazine_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_blog_magazine_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-blog-magazine'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-blog-magazine'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-blog-magazine' ),
        ),
		'section'=> 'vw_blog_magazine_footer_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_blog_magazine_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_blog_magazine_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Blog_Magazine_Toggle_Switch_Custom_Control( $wp_customize, 'vw_blog_magazine_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-blog-magazine' ),
      	'section' => 'vw_blog_magazine_footer_section'
    )));

    $wp_customize->add_setting('vw_blog_magazine_scroll_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Blog_Magazine_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_blog_magazine_scroll_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-blog-magazine'),
		'transport' => 'refresh',
		'section'	=> 'vw_blog_magazine_footer_section',
		'setting'	=> 'vw_blog_magazine_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_blog_magazine_scroll_top_alignment',array(
        'default' => __('Right','vw-blog-magazine'),
        'sanitize_callback' => 'vw_blog_magazine_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Blog_Magazine_Image_Radio_Control($wp_customize, 'vw_blog_magazine_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-blog-magazine'),
        'section' => 'vw_blog_magazine_footer_section',
        'settings' => 'vw_blog_magazine_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/layout1.png',
            'Center' => get_template_directory_uri().'/images/layout2.png',
            'Right' => get_template_directory_uri().'/images/layout3.png'
    ))));
	
	// Has to be at the top
	$wp_customize->register_panel_type( 'VW_Blog_Magazine_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Blog_Magazine_WP_Customize_Section' );
}
add_action( 'customize_register', 'vw_blog_magazine_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {

  class VW_Blog_Magazine_WP_Customize_Panel extends WP_Customize_Panel {

    public $panel;
    public $type = 'vw_blog_magazine_panel';
    public function json() {

      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
      $array['content'] = $this->get_content();
      $array['active'] = $this->active();
      $array['instanceNumber'] = $this->instance_number;
      return $array;
    }
  }
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  class VW_Blog_Magazine_WP_Customize_Section extends WP_Customize_Section {
  	
    public $section;
    public $type = 'vw_blog_magazine_section';
    public function json() {

      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
      $array['content'] = $this->get_content();
      $array['active'] = $this->active();
      $array['instanceNumber'] = $this->instance_number;

      if ( $this->panel ) {
        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
      } else {
        $array['customizeAction'] = 'Customizing';
      }
      return $array;
    }
  }
}

// Enqueue our scripts and styles
function vw_blog_magazine_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_blog_magazine_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
if ( ! class_exists ( 'VW_Blog_Magazine_Customize' ) ) {
final class VW_Blog_Magazine_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Blog_Magazine_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_Blog_Magazine_Customize_Section_Pro($manager,'example_1',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Premium Blog Theme', 'vw-blog-magazine' ),
			'pro_text' => esc_html__( 'Upgrade Pro',         'vw-blog-magazine' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/best-premium-wordpress-blog-theme/')
		)));

		// Register sections.
		$manager->add_section(new VW_Blog_Magazine_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Documentation', 'vw-blog-magazine' ),
			'pro_text' => esc_html__( 'Docs', 'vw-blog-magazine' ),
			'pro_url'  => esc_url( 'themes.php?page=vw_blog_magazine_guide' )
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-blog-magazine-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-blog-magazine-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Blog_Magazine_Customize::get_instance();
}