

// tab controls
jQuery(document).ready(function($){

	if ( $( '.accordion' ).length ) {

		$( '.accordion .accordion-handle' ).click(function(){
			$( this ).parent( '.accordion' ).toggleClass( 'open' );
		});

		// if there's a hash in the url, show the accordion
		var hash = window.location.hash.replace( '#', '' );
		$( 'a[name="'+hash+'"]' ).next( ".accordion" ).addClass( 'open' );
		
	}

});

