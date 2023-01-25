

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	// handle icon clicks
	$( '.image-boxes .image-box' ).on( 'click', function(){
		var icon = $(this);

		// if the window is smaller than tablet portait
		if ( $(window).width() < 768 ) {

			window.open( icon.attr( 'data-href' ), '_blank' );

		} else {
			if ( icon.hasClass( 'lightbox-icon' ) ) {
				$.magnificPopup.open({
					items: {
						src: icon.attr( 'data-href' )
					},
					type: 'iframe'
				});
			} else {
				location.href = icon.attr( 'data-href' );
			}
		}

	});

});

