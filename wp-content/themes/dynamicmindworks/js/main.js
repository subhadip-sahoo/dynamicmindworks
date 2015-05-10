jQuery(document).ready(function () {

	$('.flexslider').flexslider({
	    animation: "slide",
	    directionNav: false
	});

	 $('.bxslider').bxSlider();
	 $('#course_images').bxSlider({			  	  
		  pager: false,
		  slideWidth: 208,				  
		  moveSlides: 1,
		  controls: true,
		  auto: true,
		  minSlides: 2,
		  maxSlides: 5,
		  slideMargin: 10
	  });
	  $('#course_testimonials').bxSlider({
		  mode: 'fade',			  	  
		  pager: false,				  
		  moveSlides: 1,
		  auto: true,
		  minSlides: 1,
		  maxSlides: 1,
		  slideMargin: 10,
		  adaptiveHeight: true,
		  adaptiveHeightSpeed: 500,
		  speed: 500,
		  pause: 8000,
		  controls: false
	  });
	  
	  $('#course_events').bxSlider({			  	  
		  pager: false,				  
		  moveSlides: 1,
		  controls: true,
		  auto: false,
		  minSlides: 1,
		  maxSlides: 1,
		  slideMargin: 0,
		  adaptiveHeight: true,
		  adaptiveHeightSpeed: 1500,
		  infiniteLoop: false,
		  hideControlOnEnd: true
	  });
	 
    jQuery('header nav').meanmenu();

    jQuery(".video-area").fitVids();
	jQuery(".single-image-area").fitVids();
	jQuery(".blog-image").fitVids();
	
	 
	jQuery('#commentform input[type=text]').addClass('form-control'); 
	jQuery('#commentform input[type=url]').addClass('form-control');
	jQuery('#commentform input[type=email]').addClass('form-control'); 
	jQuery('#commentform textarea').addClass('form-control');
	jQuery('#commentform input[type=submit]').addClass('btn comment-btn');
	
});
