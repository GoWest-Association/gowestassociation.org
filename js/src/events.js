

// tab controls
jQuery(document).ready(function($){

	if ( $( '.day-event-list' ).length ) {

		// clicks of the majors tab
		$( 'table.calendar td' ).click(function(){
			$( '.day-event-list' ).html( $(this).find( '.day-events' ).html() );
		});

	}

	$( 'select.event-category' ).change(function(){
		location.href = $.query.set( "event_category", $(this).val() );
	});

	$( 'a.month-nav' ).click(function(){
		location.href = $.query.set( "mo", $(this).data('month') ).set( "yr", $(this).data('year') );
	});

	// home events list minimum height
	var set_event_height = function(){

		// reset min-height
		$( 'body.home .event-list' ).css( 'min-height', 'auto' );

		// if the device is tablet or larger
		if ( $(window).width() >= 768 ) {

			// set the min-height of the event list			
			$( 'body.home .event-list' ).css( 'min-height', $( 'body.home .article-cards .entry:first-child').outerHeight() + 27 );

		}
	}

	// if we're om the homepage
	if ( $( 'body.home' ).length > 0 ) {

		// set event list min-height on load
		setTimeout(function(){
			set_event_height();
		}, 1000 );


		// set event list min-height on window resize
		$(window).resize( set_event_height );

	}


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

