

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	var category_dropdown = $( '.category-dropdown' );
	category_dropdown.on( 'change', function(){
		console.log( $(this) );
	});

});

