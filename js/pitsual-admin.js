(function($){
	
	$( '.btnUALink' ).click( function(e) {
        e.preventDefault();
        var $temp = jQuery("<input>");
        jQuery("body").append($temp);
        $temp.val(jQuery(this).attr('href')).select();
        document.execCommand("copy");
        $temp.remove();
	});

}(jQuery));