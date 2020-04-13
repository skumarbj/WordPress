<div class="col-sm-12 title-bar" style="background-image: url(<?php header_image(); ?>);">
	<div class="container">
		<div class="row">
			
			<div class="col-md-4 text-md-left">
				<?php if(is_singular()){ ?>
					<h3 class="m-0"><strong><?php the_title(); ?></strong></h3>
				<?php }else{
					the_archive_title( '<h3 class="m-0">', '</h3>' );
					} 
					if(is_category() || is_tax() || is_tag()){ ?>
						<span><?php echo term_description(); ?></span>
					<?php } 
					if( is_author() && get_the_author_meta( 'description' )!='' ){
						echo esc_html(get_the_author_meta( 'description' ));
					} ?>
			</div>
			<div class="col-md-8">
				<?php if (function_exists('wiz_ecommerce_breadcrumbs')){ wiz_ecommerce_breadcrumbs(); } ?>
			</div>
		</div>
	</div>
</div>