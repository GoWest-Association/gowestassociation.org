

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	var testimonials = $( '.testimonials' );
	testimonials.find('.control').on( 'click', function(){

		if ( testimonials.length > 0 ) {

			// select the current ad
			var current_testimonial = testimonials.find( '.testimonial:visible' );

			// select the next ad
			var next_testimonial = current_testimonial.next('.testimonial');

			// if the next ad is not empty
			if ( next_testimonial.length > 0 ) {

				// hide the current ad
				current_testimonial.hide();

				// show the next ad
				next_testimonial.show();		

			} else {

				// hide visible ad
				current_testimonial.hide();

				// show the first ad in the group
				testimonials.find( '.testimonial:first-child' ).show();

			}

		}

	});

});

