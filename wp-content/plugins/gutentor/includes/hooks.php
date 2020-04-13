<?php

/**
 * The Gutentor theme hooks callback functionality of the plugin.
 *
 * @link       https://www.gutentor.com/
 * @since      1.0.0
 *
 * @package    Gutentor
 */

/**
 * The Gutentor theme hooks callback functionality of the plugin.
 *
 * Since Gutentor theme is hooks base theme, this file is main callback to add/remove/edit the functionality of the Gutentor Plugin
 *
 * @package    Gutentor
 * @author     Gutentor <info@gutentor.com>
 */
class Gutentor_Hooks {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( ) {}

	/**
	 * Main Gutentor_Hooks Instance
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @return object $instance Gutentor_Hooks Instance
	 */
	public static function instance() {

		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new Gutentor_Hooks;
			$instance->plugin_name = GUTENTOR_PLUGIN_NAME;
			$instance->version = GUTENTOR_VERSION;
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Callback functions for customize_register,
	 * Add Panel Section control
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param object $wp_customize
	 * @return void
	 */
	function customize_controls_enqueue_scripts(){
        wp_enqueue_style( 'gutentor-custom-control', GUTENTOR_URL . '/includes/customizer/custom-controls/assets/custom-controls.css' );
        wp_style_add_data( 'gutentor-custom-control', 'rtl', 'replace' );

        wp_enqueue_script( 'gutentor-custom-control', GUTENTOR_URL . '/includes/customizer/custom-controls/assets/custom-controls.js', array( 'jquery','wp-color-picker','customize-base','jquery-ui-core','jquery-ui-slider','jquery-ui-sortable','jquery-ui-draggable'), false, true );

        wp_localize_script( 'gutentor-custom-control', 'cwp_general', array(
            'ajaxurl'          => admin_url( 'admin-ajax.php' ),
            'wpnonce'          => wp_create_nonce( 'cwp_general_nonce' ),
        ) );
        wp_localize_script( 'gutentor-custom-control', 'gutentorLocalize', array(
                'colorPalettes' => gutentor_default_color_palettes() )
        );
    }

    /**
     * Callback functions for customize_register,
     * Add Panel Section control
     *
     * @since    1.0.0
     * @access   public
     *
     * @param object $wp_customize
     * @return void
     */
	function customize_register( $wp_customize ) {
        require_once GUTENTOR_PATH . 'includes/customizer/custom-controls/group/class-control-group.php';
		$defaults = gutentor_get_default_options();

        /**
         * Gutentor Theme options Panel
         */
        $wp_customize->add_panel( 'gutentor-general-theme-options-panel', array(
            'title' 			=> esc_html__( 'Gutentor Options', 'gutentor'),
            'priority'          => 100,
        ) );

        /*adding sections for general options*/
        $wp_customize->add_section( 'gutentor-general-theme-options', array(
            'priority'          => 10,
            'capability'        => 'edit_theme_options',
            'title'             => esc_html__( 'General Options', 'gutentor' ),
            'panel'             => 'gutentor-general-theme-options-panel'
        ) );

		/*Google map api*/
		$wp_customize->add_setting( 'gutentor_map_api', array(
			'type'             => 'option',
			'default'			=> $defaults['gutentor_map_api'],
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control( 'gutentor_map_api', array(
			'label'		        => esc_html__( 'Google Map API Key', 'gutentor' ),
			'section'           => 'gutentor-general-theme-options',
			'settings'          => 'gutentor_map_api',
			'type'	  	        => 'text'
		) );

		/*gutentor_dynamic_style_location*/
		$wp_customize->add_setting( 'gutentor_dynamic_style_location', array(
			'type'             => 'option',
			'default'			=> $defaults['gutentor_dynamic_style_location'],
			'sanitize_callback' => 'sanitize_text_field'
		) );


		$wp_customize->add_control( 'gutentor_dynamic_style_location', array(
			'choices'  	    => array(
				'default'   => esc_html__( 'Default', 'gutentor' ),
				'head'      => esc_html__( 'Head' , 'gutentor' ),
				'file'      => esc_html__( 'File' , 'gutentor' ),
			),
			'label'		    => esc_html__( 'Dynamic CSS Options', 'gutentor' ),
			'section'       => 'gutentor-general-theme-options',
			'settings'      => 'gutentor_dynamic_style_location',
			'type'	  	    => 'select'
		) );

		/*gutentor_font_awesome_version*/
		$wp_customize->add_setting( 'gutentor_font_awesome_version', array(
			'type'             => 'option',
			'default'			=> $defaults['gutentor_font_awesome_version'],
			'sanitize_callback' => 'sanitize_text_field'
		) );


		$wp_customize->add_control( 'gutentor_font_awesome_version', array(
			'choices'  	    => array(
				'5'   => esc_html__( 'Font Awesome 5', 'gutentor' ),
				'4'      => esc_html__( 'Font Awesome 4' , 'gutentor' ),
			),
			'label'		    => esc_html__( 'Font Awesome Version', 'gutentor' ),
			'section'       => 'gutentor-general-theme-options',
			'settings'      => 'gutentor_font_awesome_version',
			'type'	  	    => 'select'
		) );

		if( gutentor_get_theme_support()){
			$args = array(
				'numberposts' => 200,
				'post_type'   => 'wp_block'
			);

			$choices = array();
			$choices[0]= esc_html__( 'None', 'gutentor' );
			$lastposts = get_posts( $args );
			if ( $lastposts ) {
				foreach ( $lastposts as $post ) :
					$choices[absint($post->ID)] = esc_attr( $post->post_title );
				endforeach;
				wp_reset_postdata();
			}

			/*gutentor_header_template*/
			$wp_customize->add_setting( 'gutentor_header_template', array(
				'type'             => 'option',
				'default'			=> $defaults['gutentor_header_template'],
				'sanitize_callback' => 'sanitize_text_field'
			) );


			$wp_customize->add_control( 'gutentor_header_template', array(
				'choices'  	    => $choices,
				'label'		    => esc_html__( 'Header Template', 'gutentor' ),
				'section'       => 'gutentor-general-theme-options',
				'settings'      => 'gutentor_header_template',
				'type'	  	    => 'select'
			) );

			/*gutentor_footer_template*/
			$wp_customize->add_setting( 'gutentor_footer_template', array(
				'type'             => 'option',
				'default'			=> $defaults['gutentor_footer_template'],
				'sanitize_callback' => 'sanitize_text_field'
			) );


			$wp_customize->add_control( 'gutentor_footer_template', array(
				'choices'  	    => $choices,
				'label'		    => esc_html__( 'Header Template', 'gutentor' ),
				'section'       => 'gutentor-general-theme-options',
				'settings'      => 'gutentor_footer_template',
				'type'	  	    => 'select'
			) );
		}

        /*adding sections for Category Color*/
        $wp_customize->add_section( 'gutentor-theme-categories-options', array(
            'priority'          => 20,
            'capability'        => 'edit_theme_options',
            'title' => esc_html__('Category Color', 'gutentor'),
            'panel' => 'gutentor-general-theme-options-panel'
        ) );

        /*categories*/
        $i                = 10;
        $args             = array(
            'orderby'    => 'id',
            'hide_empty' => 0
        );
        $categories       = get_categories($args);
        $wp_category_list = array();
        foreach ($categories as $category_list) {
            $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

            $wp_customize->add_setting('gutentor-cat-' . get_cat_id($wp_category_list[$category_list->cat_ID]) . '', array(
                'type'             => 'option',
                'sanitize_callback' => 'gutentor_sanitize_field_background',
                'default'           =>'',
            ));
            $wp_customize->add_control(
                new Gutentor_Custom_Control_Group(
                    $wp_customize,
                    'gutentor-cat-' . get_cat_id($wp_category_list[$category_list->cat_ID]) . '',
                    array(
                        'label'    => sprintf(__('"%s" Color', 'gutentor'), $wp_category_list[$category_list->cat_ID]),
                        'section'  => 'gutentor-theme-categories-options',
                        'settings' => 'gutentor-cat-' . get_cat_id($wp_category_list[$category_list->cat_ID]) . '',
                        'priority' =>  $i
                    ),
                    array(
                        'background-color'         => array(
                            'type'  => 'color',
                            'label' => esc_html__('Background Color', 'gutentor'),
                        ),
                        'background-hover-color'   => array(
                            'type'  => 'color',
                            'label' => esc_html__('Background Hover Color', 'gutentor'),
                        ),
                        'text-color'        => array(
                            'type'  => 'color',
                            'label' => esc_html__('Text Color', 'gutentor'),
                        ),
                        'text-hover-color'  => array(
                            'type'  => 'color',
                            'label' => esc_html__('Text Hover Color', 'gutentor'),
                        ),
                    )
                )
            );
            $i++;
        }

	}

    /**
     * Get Thumbnail all sizes.
     *
     * @since 2.0.0
     */
    public static function get_thumbnail_all_sizes()
    {

        global $_wp_additional_image_sizes;

        $sizes       = get_intermediate_image_sizes();
        $image_sizes = array();

        $image_sizes[] = array(
            'value' => 'full',
            'label' => esc_html__('Full', 'gutentor'),
        );

        foreach ($sizes as $size) {
            if (in_array($size, array('thumbnail', 'medium', 'medium_large', 'large'), true)) {
                $image_sizes[] = array(
                    'value' => $size,
                    'label' => ucwords(trim(str_replace(array('-', '_'), array(' ', ' '), $size))),
                );
            }
        }
        return $image_sizes;
    }

	/**
	 * Callback functions for block_categories,
	 * Adding Block Categories
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param array $categories
	 * @return array
	 */
	public function add_block_categories( $categories ) {

		return array_merge(
			array(
                array(
                    'slug'  => 'gutentor-elements',
                    'title' => __('Gutentor Elements', 'gutentor'),
                ),
                array(
                    'slug'  => 'gutentor-modules',
                    'title' => __('Gutentor Module', 'gutentor'),
                ),
                array(
                    'slug'  => 'gutentor-posts',
                    'title' => __('Gutentor Posts', 'gutentor'),
                ),
                array(
	                'slug'  => 'gutentor',
	                'title' => __('Gutentor Widget', 'gutentor'),
                ),
			),
            $categories
		);
	}

	/**
	 * Callback functions for init,
	 * Register Settings for Google Maps Block
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	public function register_gmap_settings() {

		register_setting(
			'gutentor_map_api',
			'gutentor_map_api',
			array(
				'type'              => 'string',
				'description'       => __( 'Google Map API key for the Google Maps Gutenberg Block.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => ''
			)
		);
		register_setting(
			'gutentor_dynamic_style_location',
			'gutentor_dynamic_style_location',
			array(
				'type'              => 'string',
				'description'       => __( 'Dynamic CSS options.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => ''
			)
		);
		register_setting(
			'gutentor_font_awesome_version',
			'gutentor_font_awesome_version',
			array(
				'type'              => 'string',
				'description'       => __( 'Font Awesome Version', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => '5'
			)
		);
		register_setting(
			'gutentor_header_template',
			'gutentor_header_template',
			array(
				'type'              => 'string',
				'description'       => __( 'Header Template.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => ''
			)
		);
		register_setting(
			'gutentor_footer_template',
			'gutentor_footer_template',
			array(
				'type'              => 'string',
				'description'       => __( 'Footer Template.', 'gutentor' ),
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'           => ''
			)
		);
	}

	/**
	 * Callback functions for enqueue_block_assets,
	 * Enqueue Gutenberg block assets for both frontend + backend.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	function block_assets() { // phpcs:ignore

		if( !is_admin()){

			/*Slick Slider Styles*/
			wp_enqueue_style(
				'slick',
				GUTENTOR_URL . '/assets/library/slick/slick' . GUTENTOR_SCRIPT_PREFIX . '.css',
				array(),
				'1.7.1'
			);
            /*Animate CSS*/
			wp_enqueue_style(
				'animate',
				GUTENTOR_URL . '/assets/library/animatecss/animate' . GUTENTOR_SCRIPT_PREFIX . '.css',
				array(),
				'3.7.2'
			);
            wp_style_add_data( 'animate', 'rtl', 'replace' );

            // Scripts.
			wp_enqueue_script(
				'countUp', // Handle.
				GUTENTOR_URL . '/assets/library/countUp/countUp' . GUTENTOR_SCRIPT_PREFIX . '.js',
				array('jquery'), // Dependencies, defined above.
				'1.9.3', // Version: File modification time.
				true // Enqueue the script in the footer.
			);

			// Wow.
			wp_enqueue_script(
				'wow', // Handle.
				GUTENTOR_URL . '/assets/library/wow/wow' . GUTENTOR_SCRIPT_PREFIX . '.js',
				array('jquery'), // Dependencies, defined above.
				'1.2.1', // Version: File modification time.
				true // Enqueue the script in the footer.
			);

			//Waypoint js
			wp_enqueue_script(
				'waypoints', // Handle.
				GUTENTOR_URL . '/assets/library/waypoints/jquery.waypoints' . GUTENTOR_SCRIPT_PREFIX . '.js',
				array('jquery'), // Dependencies, defined above.
				'4.0.1', // Version: File modification time.
				true // Enqueue the script in the footer.
			);

			//Easy Pie Chart Js
			wp_enqueue_script(
				'jquery-easypiechart', // Handle.
				GUTENTOR_URL . '/assets/library/jquery-easypiechart/jquery.easypiechart' . GUTENTOR_SCRIPT_PREFIX . '.js',
				array('jquery'), // Dependencies, defined above.
				'2.1.7', // Version: File modification time.
				true // Enqueue the script in the footer.
			);

			//Slick Slider Js
			wp_enqueue_script(
				'slick', // Handle.
				GUTENTOR_URL . '/assets/library/slick/slick' . GUTENTOR_SCRIPT_PREFIX . '.js',
				array('jquery'), // Dependencies, defined above.
				'1.7.1', // Version: File modification time.
				true // Enqueue the script in the footer.
			);


			wp_enqueue_script('masonry');

			if ( has_block( 'gutentor/google-map' ) || has_block( 'gutentor/e4' )) {


				// Get the API key
				if ( gutentor_get_options( 'gutentor_map_api' ) ) {
					$apikey =  gutentor_get_options('gutentor_map_api');
				} else {
					$apikey = false;
				}

				// Don't output anything if there is no API key
				if ( null === $apikey || empty( $apikey ) ) {
					return;
				}

				wp_enqueue_script(
					'gutentor-google-maps',
					GUTENTOR_URL . '/assets/js/google-map-loader' . GUTENTOR_SCRIPT_PREFIX . '.js',
					array('jquery'), // Dependencies, defined above.
					'1.0.0',
					true
				);

				wp_enqueue_script(
					'google-maps',
					'https://maps.googleapis.com/maps/api/js?key=' . $apikey . '&libraries=places&callback=initMapScript',
					array( 'gutentor-google-maps' ),
					'1.0.0',
					true
				);

			}
		}

        //Isotope Js
        wp_enqueue_script(
            'isotope', // Handle.
	        GUTENTOR_URL . '/assets/library/isotope/isotope.pkgd' . GUTENTOR_SCRIPT_PREFIX . '.js',
            array('jquery'), // Dependencies, defined above.
            '3.0.6', // Version: File modification time.
            true // Enqueue the script in the footer.
        );

        /*Magnific Popup Styles*/
        wp_enqueue_style(
            'magnific-popup',
            GUTENTOR_URL . '/assets/library/magnific-popup/magnific-popup' . GUTENTOR_SCRIPT_PREFIX . '.css',
            array(),
            '1.8.0'
        );
        wp_style_add_data( 'magnific-popup', 'rtl', 'replace' );


        /* Wpness Grid Styles*/
		wp_enqueue_style(
			'wpness-grid',
			GUTENTOR_URL . '/assets/library/wpness-grid/wpness-grid' . GUTENTOR_SCRIPT_PREFIX . '.css',
			array(),
			'1.0.0'
		);
        wp_style_add_data( 'wpness-grid', 'rtl', 'replace' );

        // Styles.
		if( 4 == gutentor_get_options('gutentor_font_awesome_version')){
			wp_enqueue_style(
				'fontawesome', // Handle.
				GUTENTOR_URL . '/assets/library/font-awesome-4.7.0/css/font-awesome' . GUTENTOR_SCRIPT_PREFIX . '.css',
				array(),
				'4'
			);
		}
		else{
			wp_enqueue_style(
				'fontawesome', // Handle.
				GUTENTOR_URL . '/assets/library/fontawesome/css/all' . GUTENTOR_SCRIPT_PREFIX . '.css',
				array(),
				'5.12.0'
			);
		}
        wp_style_add_data( 'fontawesome', 'rtl', 'replace' );


        wp_enqueue_style(
			'gutentor-css', // Handle.
			GUTENTOR_URL . '/dist/blocks.style.build.css',
			array('wp-editor'), // Dependency to include the CSS after it.
			GUTENTOR_VERSION // Version: File modification time.
		);
        wp_style_add_data( 'gutentor-css', 'rtl', 'replace' );

        //magnify popup  Js
        wp_enqueue_script(
            'magnific-popup', // Handle.
	        GUTENTOR_URL . '/assets/library/magnific-popup/jquery.magnific-popup' . GUTENTOR_SCRIPT_PREFIX . '.js',
            array('jquery'), // Dependencies, defined above.
            '1.1.0', // Version: File modification time.
            true // Enqueue the script in the footer.
        );

		wp_enqueue_script(
			'gutentor-block', // Handle.
			GUTENTOR_URL . '/assets/js/gutentor' . GUTENTOR_SCRIPT_PREFIX . '.js',
			array('jquery'), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		/*CSS for default/popular themes*/
		$templates = array('twentynineteen', "twentytwenty", "oceanwp", "astra", "generatepress");
		$current_template =  get_template();
		if (in_array($current_template, $templates)){
		  	wp_enqueue_style(
				'gutentor-theme-'.esc_attr($current_template), // Handle.
				GUTENTOR_URL . '/dist/gutentor-'.esc_attr($current_template).'.css',
				array(), // Dependency to include the CSS after it.
				GUTENTOR_VERSION // Version: File modification time.
			);
            wp_style_add_data( 'gutentor-theme-'.esc_attr($current_template), 'rtl', 'replace' );
        }
	}

	/**
	 * Callback functions for enqueue_block_editor_assets,
	 * Enqueue Gutenberg block assets for backend only.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param null
	 * @return void
	 */
	public function block_editor_assets() { // phpcs:ignore

		// Scripts.
		wp_enqueue_script(
			'gutentor-js', // Handle.
			GUTENTOR_URL . '/dist/blocks.build.js',//Block.build.js: We register the block here. Built with Webpack.
			array('jquery','lodash', 'wp-api', 'wp-i18n', 'wp-blocks', 'wp-components', 'wp-compose', 'wp-data', 'wp-editor', 'wp-edit-post', 'wp-element', 'wp-keycodes', 'wp-plugins', 'wp-rich-text' ,'wp-viewport', ), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);
		wp_set_script_translations( 'gutentor-js', 'gutentor' );

		wp_localize_script( 'gutentor-js', 'gutentor', array(
			'currentTheme' => get_template(),
			'p1TemplateCategoriesColor' => p1_template_categories_color(),
			'isProActive' => function_exists( 'gutentor_pro'),
			'thumbnailAllSizes' => self::get_thumbnail_all_sizes(),
			'mapsAPI' => '',
			'dirUrl' => GUTENTOR_URL,
			'iconSvg' => GUTENTOR_URL.'assets/img/block-icons/icon.svg',
			'singleColSvg' => GUTENTOR_URL.'assets/img/block-icons/single-column.svg',
			'pricingSvg' => GUTENTOR_URL.'assets/img/block-icons/pricing.svg',
			'simpleTextSvg' => GUTENTOR_URL.'assets/img/block-icons/simple-text.svg',
			'coverSvg' => GUTENTOR_URL.'assets/img/block-icons/cover.svg',
			'carouselSvg' => GUTENTOR_URL.'assets/img/block-icons/carousel.svg',
			'sliderSvg' => GUTENTOR_URL.'assets/img/block-icons/slider.svg',
			'openHoursSvg' => GUTENTOR_URL.'assets/img/block-icons/opening-hours.svg',
			'notificationSvg' => GUTENTOR_URL.'assets/img/block-icons/notification.svg',
			'advancedTextSvg' => GUTENTOR_URL.'assets/img/block-icons/advance-text.svg',
			'featuredSvg' => GUTENTOR_URL.'assets/img/block-icons/featured-block.svg',
			'tabSvg' => GUTENTOR_URL.'assets/img/block-icons/tabs.svg',
			'counterSvg' => GUTENTOR_URL.'assets/img/block-icons/counter.svg',
			'contentBoxSvg' => GUTENTOR_URL.'assets/img/block-icons/content-box.svg',
			'buttonSvg' => GUTENTOR_URL.'assets/img/block-icons/button.svg',
			'buttonGroupSvg' => GUTENTOR_URL.'assets/img/block-icons/button-group.svg',
			'dynamicColSvg' => GUTENTOR_URL.'assets/img/block-icons/dynamic-col.svg',
			'defaultImage' => GUTENTOR_URL.'assets/img/default-image.jpg',
			'gutentorSvg' => GUTENTOR_URL.'assets/img/gutentor.svg',
			'gutentorWhiteSvg' => GUTENTOR_URL.'assets/img/gutentor-white-logo.svg',
			'fontAwesomeVersion' => gutentor_get_options('gutentor_font_awesome_version'),
            'nonce' => wp_create_nonce( 'gutentorNonce' )
		) );

		// Scripts.
		wp_enqueue_script(
			'gutentor-editor-block-js', // Handle.
			GUTENTOR_URL . '/assets/js/block-editor' . GUTENTOR_SCRIPT_PREFIX . '.js',
			array('jquery','magnific-popup'), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);

		// Styles.
		wp_enqueue_style(
			'gutentor-editor-css', // Handle.
			GUTENTOR_URL . '/dist/blocks.editor.build.css',
			array('wp-edit-blocks'), // Dependency to include the CSS after it.
			GUTENTOR_VERSION // Version: File modification time.
		);
        wp_style_add_data( 'gutentor-editor-css', 'rtl', 'replace' );

        /*if woo is active and woocomkmerce plugin is activated*/
		// Scripts.
		/*wp_enqueue_script(
			'gutentor-woo-js', // Handle.
			GUTENTOR_URL . '/dist/gutentor-woocommerce.js',//gutentor-woocommerce.js: We register the block here. Built with Webpack.
			array('gutentor-js', ), // Dependencies, defined above.
			GUTENTOR_VERSION, // Version: File modification time.
			true // Enqueue the script in the footer.
		);
		wp_set_script_translations( 'gutentor-woo-js', 'gutentor' );

		wp_localize_script( 'gutentor-woo-js', 'gutentor_woo', array(
			'dirUrl' => GUTENTOR_URL,
			'defaultImage' => GUTENTOR_URL.'assets/img/default-image.jpg',
			'gutentorWooSvg' => GUTENTOR_URL.'assets/img/gutentor.svg',
			'gutentorWooWhiteSvg' => GUTENTOR_URL.'assets/img/gutentor-white-logo.svg',
			'fontAwesomeVersion' => gutentor_get_options('gutentor_font_awesome_version'),
			'nonce' => wp_create_nonce( 'gutentorNonce' )
		) );*/

	}

	/**
	 * Callback functions for body_class,
	 * Adding Body Class.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param array $classes
	 * @return array
	 */
	function add_body_class( $classes ) {

		$classes[] = 'gutentor-active';
		return $classes;
	}

	/**
	 * Callback functions for body_class,
	 * Adding Admin Body Class.
	 *
	 * @since    1.0.0
	 * @access   public
	 *
	 * @param string $classes
	 * @return string
	 */
	function add_admin_body_class( $classes ) {
		// Wrong: No space in the beginning/end.
		$classes .= ' gutentor-active';

		return $classes;
	}

    /**
     * Create Page Template
     * @param {string} $templates
     * @return string $templates
     */
    function gutentor_add_page_template ($templates) {
        $templates['template-gutentor-full-width.php'] = esc_html__('Gutentor Full Width','gutentor');
        $templates['template-gutentor-canvas.php'] = esc_html__('Gutentor Canvas','gutentor');
        return $templates;
    }

    /**
     * Redirect Custom Page Template
     * @param {string} $templates
     * @return string $templates
     */
    function gutentor_redirect_page_template ($template) {
        $post = get_post();
        $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
        if ('template-gutentor-full-width.php' == basename ($page_template)) {
            $template = GUTENTOR_PATH . '/page-templates/template-gutentor-full-width.php';
            return $template;
        }
        elseif('template-gutentor-canvas.php' == basename ($page_template)) {
            $template = GUTENTOR_PATH . '/page-templates/template-gutentor-canvas.php';
            return $template;
        }
        return $template;
    }

	/**
	 * Allowed style on post save
	 * Since gutentor add internal style per post page
	 *
	 * @param  array $allowedposttags
	 * @return  array
	 */
	public function allow_style_tags( $allowedposttags ){
		$allowedposttags['style'] = array(
			'type' => true
		);
		return $allowedposttags;
	}

    /**
     * By default gutentor use fontawesome 5
     * Changing default fontawesome to 4
     * Quick fix for acmethemes
     *
     * @param  array  $defaults, All default options of gutentor
     * @return array $defaults, modified version of default
     */
    function acmethemes_alter_default_options( $defaults ) {
        $current_theme = wp_get_theme();
        $current_theme_author = $current_theme->get('Author');
        if( $current_theme_author != 'acmethemes' ){
            return  $defaults;
        }

        $defaults['gutentor_font_awesome_version'] = 4; /*default is fontawesome 5, we change here 4*/
        return $defaults;
    }

	/**
	 * Register Gutentor_Reusable_Block_Widget
	 *
	 */
	function register_gutentor_reusable_block_selector_widget() {
		register_widget( 'Gutentor_WP_Block_Widget' );
	}
}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function gutentor_hooks( ) {
	return Gutentor_Hooks::instance();
}