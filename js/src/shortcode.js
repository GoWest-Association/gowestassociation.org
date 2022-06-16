

jQuery(document).ready(function($){

	// find code in content, and replace the '{' with square brackets
	// strictly for documenting shortcodes in wordpress posts.
	// just remove this whole file if they won't be needed.
	$( "pre,code" ).each(function(){ 
		$(this).html( $(this).html().replace(/{/g,"[").replace(/}/g,"]") );
	});

});

