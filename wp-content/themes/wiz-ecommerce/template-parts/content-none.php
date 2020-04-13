<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wiz_ecommerce
 */

?>
<div class="sad text-center col-sm-12">
	<i class="fa fa-frown-o mb-3"></i>
	<div class="col-sm-12"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/404.png" class="img-fluid"></div>
	<h4 class="mt-2"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wiz-ecommerce' ); ?></h4>
	
	<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wiz-ecommerce' ); ?></p>
	
	<a href="<?php echo esc_url(site_url()); ?>" class="btn btn-green mb-3"><?php esc_html_e('Go Home','wiz-ecommerce'); ?></a>
</div>