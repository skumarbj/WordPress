<?php
/**
 * The template for displaying search forms in VW Blog Magazine
 *
 * @package VW Blog Magazine
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text">Search for:</span>
		<input type="search" class="search-field header-search" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'vw-blog-magazine' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'vw-blog-magazine' ); ?>">
</form>
