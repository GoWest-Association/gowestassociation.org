

// tab controls
jQuery(document).ready(function($){

	if ( $( '.accordions' ).length ) {

		$( '.accordions .accordion .accordion-handle' ).click(function(){
			$( this ).parent( '.accordion' ).toggleClass( 'open' );
		});

	}

});

