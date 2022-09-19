

// onload
jQuery(document).ready(function($){

	// grab the showcase
	$( '.showcase' ).each(function(){
		var showcase = $( this );

		// set auto-rotate timer var so that it exists.
		var auto_rotate = 0;

		// count the slides
		var slide_count = showcase.find( '.slide' ).size();

		// if it exists
		if ( typeof( showcase ) !== 'undefined' ) {

			// grab the first slide
			var first_slide = showcase.find( '.slide.visible' );


			// grab the last slide
			var last_slide = showcase.find( '.slide' ).last();


			// function to switch to the previous slide
			var prev_slide = function() {

				// get current and next slide objects
				var current_slide = get_current_slide();
				var prev_slide = current_slide.prev(".slide");

				// if next slide doesn't exist, go back to the first
				if ( !prev_slide.length ) {
					prev_slide = last_slide;
				}

				// switch the slides
				current_slide.attr( 'class', 'slide' );
				prev_slide.attr( 'class', 'slide visible' );

				// wait a second and mimic infinite looping
				setTimeout(function(){
					current_slide.attr( 'class', 'slide hide-left' );
				}, 400 );

			};
			

			// function to switch to the next side.
			var next_slide = function() {

				// get current and next slide objects
				var current_slide = get_current_slide();
				var next_slide = current_slide.next( '.slide' );

				// if next slide doesn't exist, go back to the first
				if ( !next_slide.length ) {
					next_slide = first_slide;
				}

				// switch the slides
				current_slide.attr( 'class', 'slide hide-left' );
				next_slide.attr( 'class', 'slide visible' );

				// wait a second and mimic infinite looping
				setTimeout(function(){
					current_slide.attr( 'class', 'slide' );
				}, 400 );

			};


			// grab the current slide
			var get_current_slide = function(){
				return showcase.find( '.slide.visible' );
			};


			// on click handler
			showcase.find( '.slide.visible' ).on( 'click', function(){
				var href = $(this).data('href');
				if ( href.length > 0 ) {
					location.href = href;
				}
			});


			// set showcase initial height when the first image is loaded.
			setTimeout( function() {

				// once we're loaded up, set a timer to auto-rotate the slides.
				if ( slide_count > 1 ) {
					auto_rotate = setInterval( next_slide, 10000 );
				}
			}, 500 );


			// next/previous click
			showcase.find( '.showcase-nav a' ).click(function(){
				if ( $(this).hasClass( 'previous' ) ) {
					prev_slide();
				} else {
					next_slide();
				}

				// stop auto-rotation
				if ( slide_count > 1 ) {
					clearInterval( auto_rotate );
				}
			});

			// move slides to left if they mouse over the previous nav
			// gives the illusion of infinite scrolling
			showcase.find( '.showcase-nav a.previous' ).hover(function(){
				showcase.find( '.slide:not(.visible)' ).attr( 'class', 'slide hide-left' );
			});

			// move slides to right (default) if they mouse over the next nav
			// gives the illusion of infinite scrolling
			showcase.find( '.showcase-nav a.next' ).hover(function(){
				showcase.find( '.showcase .slide:not(.visible)' ).attr( 'class', 'slide' );
			});

		}

	});

});

