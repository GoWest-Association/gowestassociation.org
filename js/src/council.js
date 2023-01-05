

// onload
jQuery(document).ready(function($){

	// fixed registration
	$( window ).on( 'scroll', function(){

		// function to figure if we've scrolled to the content
		var past_content = function() {
			return $( window ).width() >= 768 && $(window).scrollTop() >= $( 'header' ).offset().top ? true : false;
		}

		// function to figure if we reached the footer
		var footer_reached = function() {
			return $( window ).width() >= 768 && $(window).scrollTop() >= ( $( '.footer' ).offset().top - $( window ).height() ) ? true : false;
		}

		// if we're past the showcase and before the footer
		if ( past_content() && !footer_reached() ) {

			// get the event reg height
			var button_bar_height = $( '.footer-buttons' ).height();

			// fixed event reg
			$( '.footer-buttons' ).addClass( 'fixed' );

			// margin on footer to stop flicker
			$( 'footer' ).css( 'margin-top', button_bar_height+'px' );

		} else {

			// default mode
			$( '.footer-buttons' ).removeClass( 'fixed' );
			$( 'footer' ).css( 'margin-top', 0 );
			
		}
	});

});

