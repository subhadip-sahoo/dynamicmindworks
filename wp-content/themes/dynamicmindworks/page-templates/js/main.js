jQuery(document).ready(function () {

	$('.flexslider').flexslider({
	    animation: "slide",
	    directionNav: false
	});

	 $('.bxslider').bxSlider();
	 
    jQuery('header nav').meanmenu();

     jQuery(".video-area").fitVids();
	
});
