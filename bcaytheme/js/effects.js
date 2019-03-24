jQuery(document).ready(function() {

/* Banner class */

	jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');

 
/* Navigation */
	jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	

/* Slider */	
	
	jQuery('.flexslider').flexslider({
		controlNav: false
		});
	

	
});

