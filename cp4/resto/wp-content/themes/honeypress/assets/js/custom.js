( function ($) {	
			
		    jQuery('a,input').bind('focus', function() {
             if(!jQuery(this).closest(".menu-item").length ) {
                jQuery("li.dropdown ul").css("display", "none");
            }
       });  
       
       jQuery('a,input').bind('focus', function() {
             if(!jQuery(this).closest(".menu-item").length && !jQuery(this).closest(".search-box-outer").length && ( jQuery(window).width() <= 992) ) {
                jQuery('.navbar-collapse').removeClass('show');
             }})
				
}) ( jQuery);