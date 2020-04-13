jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
  	});
});

function vw_blog_magazine_menu_open_nav() {
  	window.mobileMenu=true;
	document.getElementById("mySidenav").style.top ="0";
}
function vw_blog_magazine_menu_close_nav() {
	window.mobileMenu=false;
	document.getElementById("mySidenav").style.top = "-110%";
}

(function( $ ) {

	// makes sure the whole site is loaded
	jQuery(window).load(function() {
        // will first fade out the loading animation
	    jQuery("#status").fadeOut();
	        // will fade out the whole DIV that covers the website.
	    jQuery("#preloader").delay(1000).fadeOut("slow");
	})

	$(window).scroll(function(){
	  var sticky = $('.header-sticky'),
	      scroll = $(window).scrollTop();

	  if (scroll >= 100) sticky.addClass('header-fixed');
	  else sticky.removeClass('header-fixed');
	});

	jQuery(document).ready(function() {
		var owl = jQuery('#categry .owl-carousel');
			owl.owlCarousel({
				margin: 25,
				nav: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
				responsive: {
				  0: {
				    items: 1
				  },
				  600: {
				    items: 3
				  },
				  1000: {
				    items: 3
				}
			}
		})
	})

	$(document).ready(function () {

		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});

		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});

	});

})( jQuery );
