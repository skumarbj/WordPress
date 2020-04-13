<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Post1_Templates' ) ) {

	/**
	 * Blog_Post_Templates Class For Gutentor
	 * @package Gutentor
	 * @since 2.0.0
	 *
	 */
	class Gutentor_Post1_Templates extends Gutentor_Query_Elements{

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 2.0.0
		 * @return object
		 */
		public static function get_instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}
		
        /**
		 * Run Block
		 *
		 * @access public
		 * @since 2.0.0
		 * @return void
		 */
		public function run(){
            add_filter( 'gutentor_post_module_post1_template_data', array( $this, 'load_blog_post_template' ), 999, 3 );
            add_filter( 'gutentor_post_module_main_wrap_class', array( $this, 'add_main_wrap_classes_post1' ), 10, 2 );
            add_filter( 'gutentor_post1_content_on_image_template_data', array( $this, 'add_link_to_post_thumbnails' ), 9999999, 3 );
            add_filter( 'gutentor_post1_default_template_featured_image_data', array( $this, 'add_link_to_post_thumbnails' ), 99999, 3 );

        }

        /**
         * Adding Google Map Section Classes
         *
         * @param {array} output
         * @param {object} props
         * @return {array}
         */
        public function add_main_wrap_classes_post1( $output, $attributes ){

            $gutentorBlockName      = (isset($attributes['gName'])) ? $attributes['gName'] : '';
            $block_list             = array('gutentor/post1');
            if(!in_array($gutentorBlockName , $block_list)){
                return $output;
            }
            $local_data = '';
            if(isset($attributes['pContentOnImage'])){
                $local_data      = $attributes['pContentOnImage'] ? 'gutentor-content-on-image' : '';
            }
            /*Concat Output with local data*/
            $local_data = gutentor_concat_space($output, $local_data);

            return $local_data;


        }

        /**
         * Adding Link to Post Thumbnails
         *
         * @param {array} output
         * @param {object} props
         * @return {array}
         */
        public function add_link_to_post_thumbnails($output,$url, $attributes) {
            $output_wrap = '';
            $target      = '';
            $rel      = '';
            if ( empty( $output ) || $output == null ) {
                return $output;
            }
            if ( !array_key_exists( 'pImgOnLink', $attributes ) ) {
                return $output;
            }
            if ( ! $attributes['pImgOnLink'] ) {
                return $output;
            }
            if (array_key_exists( 'pImgOpenNewTab', $attributes ) ) {
                $target = $attributes['pImgOpenNewTab'] ?  'target="_blank"' : '';
            }
            if (array_key_exists( 'pImgLinkRel', $attributes ) ) {
                $rel = ($attributes['pImgLinkRel']) ? 'rel="'.$attributes['pImgLinkRel'].'"' : '';

            }
            $output_wrap = '<a class="gutentor-post-image-link" href="'.$url.'" '.$target.' '.$rel.'>'.$output.'</a>';
            return $output_wrap;

        }

        /**
         * Load Template 2
         *
         * @param {string} $data
         * @param {array} $post
         * @param {array} $attributes
         * @return {mix}
         */
        public function gutentor_template1( $data, $post, $attributes ){

            $output = '';
            $content_on_image = (isset($attributes['pContentOnImage'])) ? $attributes['pContentOnImage'] : false;
            if ($content_on_image ){
                $output = $this->content_on_image_template1($data, $post, $attributes );
            }
            else{
                $output = $this->default_template1($data, $post, $attributes );
            }
            return $output;
        }

        /**
         * Default Template 1
         *
         * @param {string} $data
         * @param {array} $post
         * @param {array} $attributes
         * @return {mix}
         */
        public function default_template1( $data, $post, $attributes ){

            $output = '';
            $bg_output = '';
            $enableFeaturedImage        = (isset($attributes['pOnFImg'])) ? $attributes['pOnFImg'] : false;
            if($enableFeaturedImage) {
                if (has_post_thumbnail($post->ID)) {
                    $enable_overlayImage = false;
                    $overlayImage        = (isset($attributes['pFImgOColor'])) ? $attributes['pFImgOColor'] : false;
                    if ($overlayImage) {
                        $enable_overlayImage = (isset($attributes['pFImgOColor']['enable'])) ? $attributes['pFImgOColor']['enable'] : false;
                    }
                    $url       = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    $overlay   = $enable_overlayImage ? ' gutentor-overlay' : '';
                    $bg_output = '<div class="' . gutentor_concat_space('gutentor-bg-image', $overlay) . '" style="background-image:url(' . $url . ')"></div>';
                    $output    .= apply_filters('gutentor_post1_default_template_featured_image_data', $bg_output, get_permalink($post->ID), $attributes);

                }
            }
            $output .= '<div class="gutentor-post-content">';
            $output .= $this->get_primary_meta($post,$attributes);
            $output .= $this->get_title($post,$attributes);
            $output .= $this->get_description($post,$attributes);
            $output .= $this->get_secondary_meta($post,$attributes);
            $output .= $this->get_button($post,$attributes);
            $output .= '</div>';/*.gutentor-post-content*/
            return $output;
        }

        /**
         * Content On Image Template 1
         *
         * @param {string} $data
         * @param {array} $post
         * @param {array} $attributes
         * @return {mix}
         */
        public function content_on_image_template1( $data, $post, $attributes ){

            $output = '';
            $url = $overlay= '';
            if (has_post_thumbnail( $post->ID ) ){
                $enable_overlayImage = false;
                $overlayImage        = (isset($attributes['pFImgOColor'])) ? $attributes['pFImgOColor'] : false;
                if ($overlayImage) {
                    $enable_overlayImage = (isset($attributes['pFImgOColor']['enable'])) ? $attributes['pFImgOColor']['enable'] : false;
                }
                $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                $overlay= $enable_overlayImage?'gutentor-overlay':'';
            }
            $output .= '<div class="'.gutentor_concat_space('gutentor-bg-image',$overlay).'" style="background-image:url(' . $url . ')">';
            $output .= '<div class="gutentor-post-content">';
            $output .= $this->get_primary_meta($post,$attributes);
            $output .= $this->get_title($post,$attributes);
            $output .= $this->get_description($post,$attributes);
            $output .= $this->get_secondary_meta($post,$attributes);
            $output .= $this->get_button($post,$attributes);
            $output .= '</div>';/*.gutentor-post-content*/
            $output .= '</div>';/*.gutentor-bg-image*/
            return $output;
        }

        /**
         * Get Categories Template 3
         *
         * @param {mix} $post_id
         * @return string
         */
        function get_categories_template3( $post_id = false ) {

            global $wp_rewrite;
            $categories = get_the_category( $post_id );
            $rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';
            $i = 0;
            $cat_list = '';

            foreach ( $categories as $category ) {
                if ( 0 <= $i )
                    $cat_list .= '<a href="' . get_category_link( $category->term_id ) . ' " class="post-category gutentor-cat-'.$category->slug. '" ' . $rel . '>' . $category->name.'</a>';
                    $cat_list .= ' ';
                ++$i;
            }
            return  $cat_list;
        }

        /**
         * Blog Post Templates
         *
         * @param {string} $data
         * @param {array} $post
         * @param {array} $attributes
         * @return {mix}
         */

        public function load_blog_post_template( $data, $post, $attributes ){

            $output = $data;
            $template = (isset($attributes['post1Temp'])) ? $attributes['post1Temp'] : '';
            if( method_exists( $this, $template ) ){
                $output = $this->$template($data, $post, $attributes);
            }
            return $output;
        }
		
	}
}
Gutentor_Post1_Templates::get_instance()->run();