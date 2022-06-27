

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

});

