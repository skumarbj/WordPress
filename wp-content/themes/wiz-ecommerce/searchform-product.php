<div class="search">
	<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="input-group">
		<input type="text" placeholder="<?php esc_attr_e( 'Search product..','wiz-ecommerce'); ?>" value="<?php the_search_query(); ?>" id="s" name="s" class="form-control" required >
		<input type="hidden" name="post_type" value="product">
		<div class="input-group-append">
			<button type="submit" class="btn btn-grey-search">
				<i class="fa fa-search"></i>
			</button>
		</div>
	</div>
</form>
</div>
