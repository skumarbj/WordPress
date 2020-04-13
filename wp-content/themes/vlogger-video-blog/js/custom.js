jQuery(document).ready(function() {

	window.currentfocus=null;
  	vlogger_video_blog_checkfocusdElement();
	var body = document.querySelector('body');
	body.addEventListener('keyup', vlogger_video_blog_check_tab_press);
	var gotoHome = false;
	var gotoClose = false;
	window.mobileMenu=false;
 	function vlogger_video_blog_checkfocusdElement(){
	 	if(window.currentfocus=document.activeElement.className){
		 	window.currentfocus=document.activeElement.className;
	 	}
 	}
	function vlogger_video_blog_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.mobileMenu){
			if (!e.shiftKey) {
				if(gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				gotoHome = true;
			} else {
				gotoHome = false;
			}

		}else{

			if(window.currentfocus=="mobiletoggle"){
				jQuery( ".search-box input[type='search']" ).focus();
			}
			}
		}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){						
			if(window.currentfocus=="search-field header-search"){
				jQuery(".mobiletoggle").focus();
			}else{
				if(window.mobileMenu){					
				if(gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					gotoClose = true;
				} else {
					gotoClose = false;
				}

				if (e.target.parentNode.previousElementSibling.childElementCount == 2) {
					if(e.target.parentNode.previousElementSibling.children[1].className === "sub-menu"){
						e.target.parentNode.previousElementSibling.children[1].style.display = "block";
					}
				}

			}else if(window.currentfocus=="search-field header-search"){
				jQuery(".mobiletoggle").focus();
			}else{

			if(window.mobileMenu){
			}
			}

			}
		}
		}
	 	vlogger_video_blog_checkfocusdElement();
	}

	var owl = jQuery('#playlist_sec .owl-carousel');
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
			    items: 2
			  },
			  1024: {
			    items: 2
			}
		}
	})
})
