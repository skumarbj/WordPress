<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Query_Elements' ) ) {

	/**
	 * Base Class For Gutentor for common functions
	 * @package Gutentor
	 * @since 1.0.1
	 *
	 */
	class Gutentor_Query_Elements{

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 1.0.1
		 * @return object
		 */
		public static function get_base_instance() {

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
		 * Title
		 *
		 * @static
		 * @access public
		 * @since 2.0.1
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_title($post,$attributes) {
			$output = '';
			if (isset($attributes['pOnTitle']) && $attributes['pOnTitle']) {
				$title_tag = $attributes['pTitleTag'];
				$output .= '<'.$title_tag.' class="gutentor-post-title">';
				$output .= '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">';
				$output .= get_the_title();
				$output .= '</a>';
				$output .= '</'.$title_tag.'>';
			}
			return $output;

		}


		/**
		 * Description
		 *
		 * @static
		 * @access public
		 * @since 2.0.1
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_description($post,$attributes) {
			$output = '';
			if(!isset($attributes['PExcerptLen']) || !isset($attributes['pOnDesc'])){
			    return $output;
            }
			if ($attributes['PExcerptLen'] > 0 && $attributes['pOnDesc']) {
				$output         .= '<div class="gutentor-post-desc">';
				$output         .= "<p>" . gutentor_get_excerpt_by_id( $post->ID, $attributes['PExcerptLen'] ) . "</p>";
				$output         .= '</div>';
			}
			return $output;

		}

		/**
		 * Featured Image
		 *
		 * @static
		 * @access public
		 * @since 2.0.1
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_featured_image($post,$attributes) {
			$output = '';
			$overlay_obj = (isset($attributes['pFImgOColor']) ) ? $attributes['pFImgOColor'] :false;
			$overlay_enable = ($overlay_obj && array_key_exists('enable',$overlay_obj)) ? $attributes['pFImgOColor']['enable'] :false;

			$overlay = ($overlay_enable) ? "<div class='overlay'></div>" : '';
			$enable_image_display = isset($attributes['pOnImgDisplayOpt']) ? $attributes['pOnImgDisplayOpt'] : false;
			$image_display = isset($attributes['pImgDisplayOpt']) ? $attributes['pImgDisplayOpt'] : false;
			if (isset($attributes['pOnFImg']) && $attributes['pOnFImg'] ) {
				$image_output = '';
				if(has_post_thumbnail()) {
					if ( 'bg-image' == $image_display && $enable_image_display ) {
						$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
						if ( $url ) {
							$image_output .= '<div class="gutentor-bg-image" style="background-image:url(' . $url . ')">';
							$image_output .= $overlay;
							$image_output .= '</div>';
						}

					} else {
						$image_output .= '<div class="gutentor-image-thumb">';
						$image_output .= get_the_post_thumbnail( '', '', '' );
						$image_output .= $overlay;
						$image_output .= '</div>';
					}
					$output .= apply_filters( 'gutentor_save_item_image_display_data', $image_output, get_permalink(), $attributes );
				}
			}
			return $output;

		}

		/**
		 * Primary Meta Date
		 *
		 * @static
		 * @access public
		 * @since 2.0.5
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_primary_meta_date_data($post,$attributes) {
			$output = '';
			if (isset($attributes['pOnDateMeta1']) && $attributes['pOnDateMeta1'] ) {
                $dateFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-calendar' : 'far fa-calendar-alt';
                $output .= '<div class="posted-on"><i class="'.$dateFontAwesomeClass.'"></i>';
				$output .= '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_date() . '</a>';
				$output .= '</div>';

			}
			return $output;
		}

        /**
         * Secondary Meta Date
         *
         * @static
         * @access public
         * @since 2.0.5
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta_date_data($post,$attributes) {
            $output = '';
            if (isset($attributes['pOnDateMeta2']) && $attributes['pOnDateMeta2'] ) {

                $dateFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-calendar' : 'far fa-calendar-alt';
                $output .= '<div class="posted-on"><i class="'.$dateFontAwesomeClass.'"></i>';
                $output .= '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_date() . '</a>';
                $output .= '</div>';

            }
            return $output;

        }

        /**
         * Primary Meta Comment
         *
         * @static
         * @access public
         * @since 2.0.5
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_primary_meta_comment_data($post,$attributes) {
            $output = '';
            if(!is_object($post)){
                return $output;
            }
            $comment_data = wp_count_comments($post->ID);;
            if(!$comment_data->total_comments){
                return $output;
            }
            if (isset($attributes['pOnCommentMeta1']) && $attributes['pOnCommentMeta1'] ) {
                $commentFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-comment':'fas fa-comment';
                $output .= '<div class="comments-link"><i class="'.$commentFontAwesomeClass.'"></i>';
                $output .= $comment_data->total_comments;
                $output .= '</div>';

            }
            return $output;
        }

        /**
         * Secondary Meta Comment
         *
         * @static
         * @access public
         * @since 2.0.5
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta_comment_data($post,$attributes) {
            $output = '';
            $comment_data = wp_count_comments($post->ID);;
            if(!$comment_data->total_comments){
                return $output;
            }
            if (isset($attributes['pOnCommentMeta2']) && $attributes['pOnCommentMeta2'] ) {
                $commentFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-comment':'fas fa-comment';
                $output .= '<div class="comments-link"><i class="'.$commentFontAwesomeClass.'"></i>';
                $output .= $comment_data->total_comments;
                $output .= '</div>';

            }
            return $output;
        }

		/**
		 * Primary Meta Author
		 *
		 * @static
		 * @access public
		 * @since 2.0.5
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_primary_meta_author_data($post,$attributes) {
			$output = '';
			if (isset($attributes['pOnAuthorMeta1']) && $attributes['pOnAuthorMeta1']) {
                $authorFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ?'fa fa-user':'far fa-user';
				$output .= '<div class="author vcard"><i class="'.$authorFontAwesomeClass.'"></i>';
				$output .= '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_author() . '</a>';
				$output .= '</div>';
			}
			return $output;

		}

        /**
         * Secondary Meta Author
         *
         * @static
         * @access public
         * @since 2.0.5
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta_author_data($post,$attributes) {
            $output = '';
            if (isset($attributes['pOnAuthorMeta2']) && $attributes['pOnAuthorMeta2']) {
                $authorFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ?'fa fa-user':'far fa-user';
                $output .= '<div class="author vcard"><i class="'.$authorFontAwesomeClass.'"></i>';
                $output .= '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_author() . '</a>';
                $output .= '</div>';
            }
            return $output;

        }

		/**
		 * Primary Meta Categories
		 *
		 * @static
		 * @access public
		 * @since 2.0.5
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_primary_meta_categories_data($post,$attributes) {
			$output = '';
			if (isset($attributes['pOnCatMeta1']) && $attributes['pOnCatMeta1']) {
				$categories_list = get_the_category_list(esc_html__(', ', 'gutentor'));
				if ($categories_list) {
                    $catFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-tags':'fas fa-tags';
					$output .= '<div class="gutentor-categories"><i class="'.$catFontAwesomeClass.'"></i>' . $categories_list . '</div>';
				}
			}
			return $output;

		}

        /**
         * Secondary Categories
         *
         * @static
         * @access public
         * @since 2.0.5
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta_category_data($post,$attributes) {
            $output = '';
            if (isset($attributes['pOnCatMeta2']) && $attributes['pOnCatMeta2']) {
                $categories_list = get_the_category_list(esc_html__(', ', 'gutentor'));
                if ($categories_list) {
                    $catFontAwesomeClass = (int)gutentor_get_options('gutentor_font_awesome_version') === 4 ? 'fa fa-tags':'fas fa-tags';
                    $output .= '<div class="gutentor-categories"><i class="'.$catFontAwesomeClass.'"></i>' . $categories_list . '</div>';
                }
            }
            return $output;

        }

        /**
         * Primary Entry Meta
         *
         * @static
         * @access public
         * @since 2.0.1
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_primary_meta_sorting_data($post,$attributes) {
            $meta_sorting      = array_key_exists('pMeta1Sorting',$attributes) ? $attributes['pMeta1Sorting'] : false;
            $output = '';
            if(!$meta_sorting){
                return $output;
            }
            $output .= '<div class="gutentor-entry-meta gutentor-entry-meta-primary">';
            foreach( $meta_sorting as $element ):
                if(!(array_key_exists('itemValue',$element))){
                    return $output;
                }
                switch ( $element['itemValue'] ) {
                    case 'meta-author':
                        $output .= $this->get_primary_meta_author_data($post,$attributes);
                        break;
                    case 'meta-date':
                        $output .= $this->get_primary_meta_date_data($post,$attributes);
                        break;
                    case 'meta-category':
                        $output .= $this->get_primary_meta_categories_data($post,$attributes);
                        break;
                    case 'meta-comment':
                        $output .= $this->get_primary_meta_comment_data($post,$attributes);
                        break;
                    default:
                        $output .= '';
                        break;
                }
            endforeach;
            $output .= '</div>';/*.entry-meta*/
            return $output;

        }

        /**
         * Primary Entry Meta
         *
         * @static
         * @access public
         * @since 2.0.1
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta_sorting_data($post,$attributes) {
            $meta_sorting      = array_key_exists('pMeta2Sorting',$attributes) ? $attributes['pMeta2Sorting'] : false;
            $output = '';
            if(!$meta_sorting){
                return $output;
            }
            $output .= '<div class="gutentor-entry-meta gutentor-entry-meta-secondary">';
            foreach( $meta_sorting as $element ):
                if(!(array_key_exists('itemValue',$element))){
                    return $output;
                }
                switch ( $element['itemValue'] ) {
                    case 'meta-author':
                        $output .= $this->get_secondary_meta_author_data($post,$attributes);
                        break;
                    case 'meta-date':
                        $output .= $this->get_secondary_meta_date_data($post,$attributes);
                        break;
                    case 'meta-category':
                        $output .= $this->get_secondary_meta_category_data($post,$attributes);
                        break;
                    case 'meta-comment':
                        $output .= $this->get_secondary_meta_comment_data($post,$attributes);
                        break;
                    default:
                        $output .= '';
                        break;
                }
            endforeach;
            $output .= '</div>';/*.entry-meta*/
            return $output;

        }

        /**
         * Primary Meta
         *
         * @static
         * @access public
         * @since 2.0.1
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_primary_meta($post,$attributes) {
            $output = '';
            if (isset($attributes['pOnMeta1']) && $attributes['pOnMeta1']) {
                $output .= $this->get_primary_meta_sorting_data($post,$attributes);
            }
            return $output;
        }

        /**
         * Secondary Meta
         *
         * @static
         * @access public
         * @since 2.0.1
         * @param {array} $post
         * @param {array} $attributes
         * @return string
         */
        public function get_secondary_meta($post,$attributes) {
            $output = '';
            if (isset($attributes['pOnMeta2']) && $attributes['pOnMeta2']) {
                $output .= $this->get_secondary_meta_sorting_data($post,$attributes);
            }
            return $output;
        }

		/**
		 * Button
		 *
		 * @static
		 * @access public
		 * @since 2.0.1
		 * @param {array} $post
		 * @param {array} $attributes
		 * @return string
		 */
		public function get_button($post,$attributes) {
			$output = '';
			if (isset($attributes['pOnBtn']) && $attributes['pOnBtn']) {
				$default_class = gutentor_concat_space('gutentor-button','gutentor-post-button');
				$icon = (isset($attributes['pBtnIcon'])&& $attributes['pBtnIcon']['value']) ?  '<i class="gutentor-button-icon '.$attributes['pBtnIcon']['value'].'" ></i>' : '';
				$icon_options = (isset($attributes['pBtnIconOpt'])) ?  $attributes['pBtnIconOpt'] : '';
				$link_options = (isset($attributes['pBtnLink'])) ?  $attributes['pBtnLink'] : '';
				$output .= '<a class="'.gutentor_concat_space($default_class,GutentorButtonOptionsClasses($icon_options)).'" '.apply_filters('gutentor_save_link_attr','',esc_url(get_permalink()),$link_options). '>'.$icon.'<span>'.  esc_html($attributes['pBtnText']) . '</span></a>';
			}
			return $output;

		}

	}
}


