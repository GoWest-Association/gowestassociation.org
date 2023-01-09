

jQuery(document).ready(function($){

	// find code in content, and replace the '{' with square brackets
	// strictly for documenting shortcodes in wordpress posts.
	// just remove this whole file if they won't be needed.
	var update_partner_filters = function() {

		// empty partner filters array
		var partners_show = [];

		// add checked filters to array
		$('.partner-filter').each(function(){
			if ( $(this).is( ':checked' ) ) {
				partners_show.push( $(this).val() );
			}
		});

		// hide all partners
		$('.partner-entry').removeClass( 'visible' );

		// if there are no filters
		if ( partners_show.length == 0 ) {

			// show all partners
			$('.partner-entry').addClass( 'visible' );

		} else {

			// loop through all the partners
			jQuery.each( partners_show, function( pi, pv ) {

				// loop through each entry
				$('.partner-entry').each(function(){

					// if it has the filter as a class
					if ( $(this).hasClass( pv ) ) {
						
						// show it
						$(this).addClass( 'visible' );

					}
				});
			});
		}

	}
	
	// handle clicks on a partner filter
	$('.partner-filter').on( 'click', function(){
		update_partner_filters();
	});


	// process the filters on page load
	update_partner_filters();


	// handle clicks on a partner
	$('.partner-entry').on( 'click', function(){
		var partner_id = '#partner-' + $(this).data('id');
		if ( $(window).width() < 768 ) {
			location.href = '/partner/' + $(this).data('slug');
		} else {
			$( partner_id ).show();
			$.magnificPopup.open({
				items: {
					src: partner_id
				},
				type: 'inline'
			});
		}
	});


	// if on small screen
	$( '.single-partner .right-column' ).fitVids();

});

