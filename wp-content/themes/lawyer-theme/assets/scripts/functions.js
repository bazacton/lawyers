/* ---------------------------------------------------------------------------
* Navigation Height Function
* --------------------------------------------------------------------------- */
  jQuery(document).ready(function($) {
	  "use strict";
        if ($('.logo a,.navigation ul > li > a').length) {
            var contentH = $('.main-navbar').height() - 0;
            $('.logo a,.navigation .navbar-collapse > ul > li > a,.search-sec .cs_searchbtn').height();
            $('.logo a,.navigation .navbar-collapse > ul > li > a,.search-sec .cs_searchbtn').css('min-height', contentH + 'px');
            $('.logo a,.navigation .navbar-collapse > ul > li > a,.search-sec .cs_searchbtn').css('line-height', contentH + 'px');
        }
  });

/* ---------------------------------------------------------------------------
*	Navigation SubMenu Function
* --------------------------------------------------------------------------- */
jQuery(".sub-dropdown").parent("li").addClass("parentIcon");
/* ---------------------------------------------------------------------------
	* nice scroll for theme
 	* --------------------------------------------------------------------------- */
	function cs_nicescroll(){
		'use strict';	
		var nice = jQuery("html").niceScroll({mousescrollstep: "20",scrollspeed: "150",}); 
	}
/* ---------------------------------------------------------------------------
*	Search Toggle Function
* --------------------------------------------------------------------------- */
jQuery(document).ready(function($){
		"use strict";
	  jQuery('.search-sec form').hide();
		jQuery("a.cs_searchbtn").click(function(){
			jQuery('.search-sec form').hide();
			jQuery(".search-sec form").fadeToggle();
	   });
	   jQuery('html').click(function() {
		jQuery(".search-sec form").fadeOut();
	   });
	  jQuery('.search-sec').click(function(event){
		   event.stopPropagation();
	   });
});


/* ---------------------------------------------------------------------------
* Parallex Function
* --------------------------------------------------------------------------- */
function cs_parallax_func(){
	"use strict";
	// Cache the Window object     
	jQuery('section.parallex-bg[data-type="background"]').each(function(){
		var $bgobj = jQuery(this); // assigning the object
		jQuery(window).scroll(function() {
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -(jQuery(window).scrollTop() / $bgobj.data('speed')); 
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
		}); // window scroll Ends
	});
}

/* ---------------------------------------------------------------------------
  * Blog Filter Function
  * --------------------------------------------------------------------------- */
  jQuery(document).ready(function($) {
	  "use strict";
    jQuery(".cs-filter-menu li a").on("click", function(event) {
      if (jQuery(this).hasClass('addclose')) {
        jQuery(this).removeClass('addclose');
      } else {
        jQuery(".cs-filter-menu li a").removeAttr('class');
        jQuery(this).addClass('addclose');
      }
      var a = jQuery(this).attr('href');
      jQuery('.filter-pager').not(a).slideUp();
      jQuery(a).slideToggle(300)
      return false;
     });
  });
  
/* ---------------------------------------------------------------------------
	* skills Function
 	* --------------------------------------------------------------------------- */
	function cs_skill_bar(){
		
		"use strict";	 
		jQuery(document).ready(function($){
			jQuery('.skillbar').each(function($) {
				jQuery(this).waypoint(function(direction) {
					jQuery(this).find('.skillbar-bar').animate({
						width: jQuery(this).attr('data-percent')
					}, 2000);
				}, {
					offset: "100%",
					triggerOnce: true
				});
			});
		});
	}

/* ---------------------------------------------------------------------------
  * Textarea Focus Function's
  * --------------------------------------------------------------------------- */
  jQuery(document).ready(function($){
	  "use strict";
		jQuery('input,textarea').focus(function(){
		   jQuery(this).data('placeholder',jQuery(this).attr('placeholder'))
		   jQuery(this).attr('placeholder','');
		});
		jQuery('input,textarea').blur(function(){
		   jQuery(this).attr('placeholder',jQuery(this).data('placeholder'));
		});
});