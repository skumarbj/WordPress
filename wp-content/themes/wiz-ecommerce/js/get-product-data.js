jQuery(function($) {
	jQuery('.link-product-add-cart').on('click', function(e) {
		e.preventDefault();
		jQuery('#quickview .modal-content').html('');
		var post_id = jQuery(this).data('id');
		jQuery.ajax({
			type:"POST",
			url: wiz_ecommerce_product_data.ajax_url,
			data: {
				action: "wiz_ecommerce_product_data",
				id: post_id
			},
			success:function(data){
				jQuery('#quickview .modal-content').html(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	})

});
