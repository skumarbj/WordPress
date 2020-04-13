<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Gutentor_Post2_Templates' ) ) {

    /**
     * Blog_Post_Templates Class For Gutentor
     * @package Gutentor
     * @since 2.0.0
     *
     */
    class Gutentor_Post2_Templates extends Gutentor_Query_Elements{

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
            add_filter( 'gutentor_post_module_post2_template_data', array( $this, 'load_blog_post_template' ), 99999, 3 );
            add_filter( 'gutentor_post_module_grid_column_class', array( $this, 'add_grid_class' ), 99999, 3 );
        }
        /**
         * Add Classes
         *
         * @param {string} $all_classes
         * @param {array} $attributes
         * @return {string} $all_classes
         */
        public function add_grid_class( $all_classes, $attributes ){
            $post2Temp = (isset($attributes['post2Temp'])) ? $attributes['post2Temp'] : false;
            if ('template1' == $post2Temp) {
                return $all_classes.' grid-12';
            }
            if ('template2' == $post2Temp) {
                return $all_classes.' grid-6';
            }
            return $all_classes;

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
                $output .= $this->content_on_image_template1($data, $post, $attributes );
            }
            else{
                $output .= $this->default_template1($data, $post, $attributes );
            }
            return $output;
        }

        /**
         * Load Template 2
         *
         * @param {string} $data
         * @param {array} $post
         * @param {array} $attributes
         * @return {mix}
         */
        public function template2( $data, $post, $attributes ){

            $output = $this->gutentor_template1($data, $post, $attributes);
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
            if (has_post_thumbnail( $post->ID ) ){
                $enable_overlayImage = false;
                $overlayImage        = (isset($attributes['pFImgOColor'])) ? $attributes['pFImgOColor'] : false;
                if ($overlayImage) {
                    $enable_overlayImage = (isset($attributes['pFImgOColor']['enable'])) ? $attributes['pFImgOColor']['enable'] : false;
                }
                $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                $overlay= $enable_overlayImage?' gutentor-overlay':'';
                $output .= '<div class="gutentor-bg-image'.$overlay.'" style="background-image:url(' . $url . ')">';
                $output .= '</div>';/*.gutentor-bg-image*/
            }
            $output .= '<div class="gutentor-post-content">';
            $output .= $this->get_title($post,$attributes);
            $output .= $this->get_primary_meta($post,$attributes);
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
                $overlay= $enable_overlayImage?' gutentor-overlay':'';
            }
            $output .= '<div class="gutentor-bg-image'.$overlay.'" style="background-image:url(' . $url . ')">';

            $output .= '<div class="gutentor-post-content">';
            $output .= $this->get_title($post,$attributes);
            $output .= $this->get_primary_meta($post,$attributes);
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
            $template = (isset($attributes['post2Temp'])) ? $attributes['post2Temp'] : '';
            if( method_exists( $this, $template ) ){
                $output = $this->$template($data, $post, $attributes);
            }
            return $output;
        }

    }
}
Gutentor_Post2_Templates::get_instance()->run();