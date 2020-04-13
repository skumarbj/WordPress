jQuery(document).ready(function() {
	loadNumberPoint();
	jQuery('#wiz-navigation>ul').smartmenus({
		mainMenuSubOffsetX: -1,
		subMenusSubOffsetX: 10,
		subMenusSubOffsetY: 0
	});
	jQuery('.has-submenu').on('focus', function(){
		jQuery(this).addClass('highlighted');
	});
	jQuery(window).scroll(function() {
	    if (jQuery(this).scrollTop() > 50 ) {
	        jQuery('.scrolltop:hidden').stop(true, true).fadeIn();
	    } else {
	        jQuery('.scrolltop').stop(true, true).fadeOut();
	    }
	});
	jQuery(function(){jQuery(".scroll").click(function(){jQuery("html,body").animate({scrollTop:jQuery(".thetop").offset().top},"1000");return false})})



	var isSticky = jQuery('#head-bar').offset();
	if(isSticky != undefined){
	var stickyNavTop = jQuery('#head-bar').offset().top;


	var stickyNav = function(){
	var scrollTop = jQuery(window).scrollTop();

	if (scrollTop > stickyNavTop) {
		jQuery('#head-bar').addClass('sticky-head');
	} else {
		jQuery('#head-bar').removeClass('sticky-head');
	}
	};
	stickyNav();

	 jQuery(window).scroll(function() {
		stickyNav();
	});
	}
});

jQuery(document).ajaxStop(function(){
	loadNumberPoint();
});

function loadNumberPoint(){
	jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('body .quantity input');
	jQuery('body .quantity').each(function() {
		var spinner = jQuery(this),
			input = spinner.find('input[type="number"]'),
			btnUp = spinner.find('.quantity-up'),
			btnDown = spinner.find('.quantity-down'),
			min = input.attr('min'),
			max = input.attr('max');

		btnUp.click(function() {

			var oldValue = parseFloat(input.val());
			var newVal = oldValue + 1;
			spinner.find("input.qty").val(newVal);
			spinner.find("input.qty").trigger("change");
		});

		btnDown.click(function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input.qty").val(newVal);
			spinner.find("input.qty").trigger("change");
		});

	});
}
