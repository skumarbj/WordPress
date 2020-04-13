<?php
/**
 * @package business-ecommerce
 * Custom Business Ecommerce template tags
 */

if ( ! function_exists( 'business_ecommerce_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 * Create your own business_ecommerce_entry_meta() function to override in a child theme.
	 */
	function business_ecommerce_entry_meta() {
	
	
		if ( 'post' === get_post_type() ) {
			$author_avatar_size = apply_filters( 'business_ecommerce_author_avatar_size', 49 );
			printf(
				'<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
				get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
				esc_html_x( 'Author', 'Used before post author name.', 'business-ecommerce' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			business_ecommerce_entry_date();
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf(
				'<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
				sprintf( '<span class="screen-reader-text">%s </span>', esc_html_x( 'Format', 'Used before post format.', 'business-ecommerce' ) ),
				esc_url( get_post_format_link( $format ) ),
				esc_html(get_post_format_string( $format ))
			);
		}

		if ( 'post' === get_post_type() ) {
			business_ecommerce_entry_taxonomies();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( __( '&nbsp; Leave a comment<span class="screen-reader-text"> on %s</span>', 'business-ecommerce' ), esc_html(get_the_title()) ) );
			echo '</span>';
		}
		
		
	}
endif;


if ( ! function_exists( 'business_ecommerce_entry_date' ) ) :
	/**
	 * @package twentysixteen
 	 * @subpackage business-ecommerce
	 * Prints HTML with date information for current post.
	 * Create your own business_ecommerce_entry_date() function to override in a child theme.
	 */
	function business_ecommerce_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Posted on', 'Used before publish date.', 'business-ecommerce' ),
			esc_url( get_permalink() ),
			wp_kses_post($time_string)
		);
	}
endif;

if ( ! function_exists( 'business_ecommerce_entry_taxonomies' ) ) :
	/**
	 * @package twentysixteen
 	 * @subpackage business-ecommerce	
	 * Prints HTML with category and tags for current post.
	 * Create your own business_ecommerce_entry_taxonomies() function to override in a child theme.
	 */
	function business_ecommerce_entry_taxonomies() {
		$categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'business-ecommerce' ) );
		if ( $categories_list && business_ecommerce_categorized_blog() ) {
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Categories', 'Used before category names.', 'business-ecommerce' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'business-ecommerce' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf(
				'<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Tags', 'Used before tag names.', 'business-ecommerce' ),
				$tags_list
			);
		}
	}
endif;

if ( ! function_exists( 'business_ecommerce_post_thumbnail' ) ) :
	
	function business_ecommerce_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

		<?php
	endif; // End is_singular()
	}
endif;

if ( ! function_exists( 'business_ecommerce_excerpt' ) ) :
	
	function business_ecommerce_excerpt( $class = 'entry-summary' ) {
		$class = $class ;

		if ( has_excerpt() || is_search() ) :
			?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo esc_attr( $class ); ?> -->
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'business_ecommerce_excerpt_more' ) && ! is_admin() ) :

	function business_ecommerce_excerpt_more() {
		$link = sprintf(
			'<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'business-ecommerce' ), get_the_title( get_the_ID() ) )
		);
		return ' &hellip; ' . $link;
	}
	add_filter( 'excerpt_more', 'business_ecommerce_excerpt_more' );
endif;

if ( ! function_exists( 'business_ecommerce_categorized_blog' ) ) :
	/**
	 * @package twentysixteen
 	 * @subpackage business-ecommerce	
	 * Determines whether blog/site has more than one category.
	 * @return bool True if there is more than one category, false otherwise.
	 */
	function business_ecommerce_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'business_ecommerce_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields' => 'ids',
					// We only need to know if there is more than one category.
					'number' => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'business_ecommerce_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 || is_preview() ) {
			// This blog has more than 1 category so business_ecommerce_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so business_ecommerce_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Flushes out the transients used in business_ecommerce_categorized_blog()
 *
 */
function business_ecommerce_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'business_ecommerce_categories' );
}
add_action( 'edit_category', 'business_ecommerce_category_transient_flusher' );
add_action( 'save_post', 'business_ecommerce_category_transient_flusher' );

if ( ! function_exists( 'business_ecommerce_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 */
	function business_ecommerce_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'business_ecommerce_wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Business Ecommerce 1.0.0
	 */
	function business_ecommerce_wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 */
		do_action( 'wp_body_open' );
	}
endif;


/**
 * Adds custom classes to the array of body classes.
 */
function business_ecommerce_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	

	// Adds a class of no-sidebar to sites without active sidebar.
	if ((class_exists('WooCommerce') && !is_woocommerce()) ) {
		if(!is_active_sidebar( 'sidebar-1' )) {
			$classes[] = 'no-sidebar';
		}
	} else if((class_exists('WooCommerce') && is_woocommerce())) {
	// Adds a class of no-sidebar to sites without active sidebar.
		if ( ! is_active_sidebar( 'woocommerce-sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}	
	} else if(!is_active_sidebar( 'sidebar-1' )){
			$classes[] = 'no-sidebar';		
	}
	

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'business_ecommerce_body_classes' );

/**
 * @package twentysixteen
 * @subpackage business-ecommerce
 * Converts a HEX value to RGB.
 */
function business_ecommerce_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * @package twentysixteen
 * @subpackage business-ecommerce
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 */
function business_ecommerce_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'business_ecommerce_content_image_sizes_attr', 10, 2 );

/**
 * @package twentysixteen
 * @subpackage business-ecommerce
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 */
function business_ecommerce_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'business_ecommerce_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 */
function business_ecommerce_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'business_ecommerce_widget_tag_cloud_args' );



/* 
 * check valid list item has been selected. 
 * If the input is a valid key, return it; otherwise, return the default.
 */ 
function business_ecommerce_sanitize_select( $input, $setting ) {
	
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;	
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/* 
 * sanitization of check box values 
 */
function business_ecommerce_sanitize_checkbox( $checked ) {
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function business_ecommerce_get_post_categories(){
	$categories = get_categories();
	$arry = array();
	$arry[''] = '-- Select Category --';
	foreach($categories as $category){
		$arry[$category->term_id] = $category->name;
	}
	return $arry;
}

/**
 * Add cart to navigation menu
 */
function business_ecommerce_add_search_form_to_menu($items, $args) {

  // If this isn't the main navbar menu, do nothing
  if(  !($args->theme_location == 'primary') )
    return $items;
  // On main menu: put styling around search and append it to the menu items
  global $woocommerce;
  
  return $items .'<li class="menu-item menu-item-type-custom menu-item-object-custom">'.
  '<a class="cart-contents" href="'.esc_url(wc_get_cart_url()).'"><span class="cart-contents-count fa fa-cart-plus">&nbsp;('.$woocommerce->cart->cart_contents_count.')</span></a></li>';
}

if(class_exists('woocommerce')) {
	add_filter('wp_nav_menu_items', 'business_ecommerce_add_search_form_to_menu', 10, 2); 
}
/**
 * Add Cart icon and count to header if WooCommerce is active
 */
function business_ecommerce_wc_cart_count() {
 
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	global $woocommerce; 
	?>
    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('Cart View', 'business-ecommerce'); ?>">
	<span class="cart-contents-count fa fa-cart-plus">&nbsp;(<?php echo esc_html($woocommerce->cart->cart_contents_count); ?>)</span>
    </a> 
    <?php
	
	} 
 
}
add_action( 'business_ecommerce_woocommerce_cart_top', 'business_ecommerce_wc_cart_count' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function business_ecommerce_add_to_cart_fragment( $fragments ) {

	if(!class_exists('woocommerce')) return;

	global $woocommerce;
	ob_start();
	?>
    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View Cart', 'business-ecommerce'); ?>">
    <span class="cart-contents-count fa fa-cart-plus">&nbsp;(<?php echo esc_html($woocommerce->cart->cart_contents_count); ?>)&nbsp;</span>
    </a> 
    <?php
	$cart_fragments['a.cart-contents'] = ob_get_clean();
	return $cart_fragments;
	
}
add_filter( 'woocommerce_add_to_cart_fragments', 'business_ecommerce_add_to_cart_fragment' );



