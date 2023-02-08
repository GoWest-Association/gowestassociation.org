

// tab controls
jQuery(document).ready(function($){

	var filter_events = function( number = 0 ){

	};

	// clicks of the majors tab
	$( 'table.calendar td.has-events' ).click(function(){

		// store the day they click
		var day = $(this).data('day');
		
		// show all
		$( '.calendar-event-list .event.hide' ).removeClass( 'hide' );

		// loop through events, and hide everything that isn't the day they click
		$( '.calendar-event-list .event' ).each(function(){
			if ( $(this).data( 'day' ) != day ) {
				$(this).addClass( 'hide' );
			}
		});

		// show 'clear filter' buttons
		$( '.calendar-event-list .clear-filter' ).css( 'display', 'block' );

	});

	// clear the day filters on click
	$( '.calendar-event-list .clear-filter' ).click(function(){
		$( '.calendar-event-list .event.hide' ).removeClass( 'hide' );
		$(this).hide();
	});


	$( 'select.event-category-switcher' ).change(function(){
		location.href = $(this).val();
	});


	// if we're on an individual event page
	if ( $( 'body' ).hasClass( 'event' ) ) {

		// fixed registration
		$( window ).on( 'scroll', function(){

			// function to figure if we've scrolled to the content
			var past_content = function() {
				return $( window ).width() >= 768 && $(window).scrollTop() >= $( '.after-showcase' ).offset().top ? true : false;
			}

			// function to figure if we reached the footer
			var footer_reached = function() {
				return $( window ).width() >= 768 && $(window).scrollTop() >= ( $( '.footer' ).offset().top - $( window ).height() ) ? true : false;
			}

			// if we're past the showcase and before the footer
			if ( past_content() && !footer_reached() ) {

				// get the event reg height
				var event_reg_height = $( '.event-registration' ).height() + 40;

				// fixed event reg
				$( '.event-registration' ).addClass( 'fixed' );

				// margin on footer to stop flicker
				$( 'footer' ).css( 'margin-top', event_reg_height+'px' );

			} else {

				// default mode
				$( '.event-registration' ).removeClass( 'fixed' );
				$( 'footer' ).css( 'margin-top', 0 );
				
			}
		});

	}

});

