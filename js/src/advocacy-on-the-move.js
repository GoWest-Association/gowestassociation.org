

// tab controls
jQuery(document).ready(function($){
	if ( $( '.aotm-listing' ).length ) {
		var do_filtering = function(){
			var show_arizona = $( '.arizona-filter' ).is(':checked');
			if ( show_arizona ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'arizona'
				});
			}

			var show_colorado = $( '.colorado-filter' ).is(':checked');
			if ( show_colorado ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'colorado'
				});
			}

			var show_idaho = $( '.idaho-filter' ).is(':checked');
			if ( show_idaho ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'idaho'
				});
			}

			var show_oregon = $( '.oregon-filter' ).is(':checked');
			if ( show_oregon ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'oregon'
				});
			}

			var show_washington = $( '.washington-filter' ).is(':checked');
			if ( show_washington ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'washington'
				});
			}

			var show_wyoming = $( '.wyoming-filter' ).is(':checked');
			if ( show_wyoming ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'wyoming'
				});
			}

			var show_regulatory = $( '.regulatory-filter' ).is(':checked');
			if ( show_regulatory ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'regulatory'
				});
			}

			var show_federal = $( '.federal-filter' ).is(':checked');
			if ( show_federal ) {
				gtag('event', 'screen_view', {
					'app_name': 'advocacyStateSelect',
					'screen_name': 'federal'
				});
			}

			var advocacy_blog = $( '.aotm-listing' );
			advocacy_blog.find('.entry').each(function(){
				$(this).hide();
				if ( show_arizona && $(this).hasClass( 'arizona' ) ) {
					$(this).show();
				}
				if ( show_colorado && $(this).hasClass( 'colorado' ) ) {
					$(this).show();
				}
				if ( show_idaho && $(this).hasClass( 'idaho' ) ) {
					$(this).show();
				}
				if ( show_oregon && $(this).hasClass( 'oregon' ) ) {
					$(this).show();
				}
				if ( show_washington && $(this).hasClass( 'washington' ) ) {
					$(this).show();
				}
				if ( show_wyoming && $(this).hasClass( 'wyoming' ) ) {
					$(this).show();
				}
				if ( show_regulatory && $(this).hasClass( 'regulatory' ) ) {
					$(this).show();
				}
				if ( show_federal && $(this).hasClass( 'federal' ) ) {
					$(this).show();
				}
			});

			if ( !show_arizona && !show_colorado && !show_idaho && !show_oregon && !show_washington && !show_wyoming && !show_regulatory ) {
				advocacy_blog.find('.entry').show();
			}
		}

		$( '.arizona-filter' ).change( do_filtering );
		$( '.colorado-filter' ).change( do_filtering );
		$( '.idaho-filter' ).change( do_filtering );
		$( '.oregon-filter' ).change( do_filtering );
		$( '.washington-filter' ).change( do_filtering );
		$( '.wyoming-filter' ).change( do_filtering );
		$( '.regulatory-filter' ).change( do_filtering );
		$( '.federal-filter' ).change( do_filtering );
	}

	$('.category-select').on( 'change', function(){
		location.href = '/category/' + $(this).val();
	});

	setTimeout( function(){
		if ( $('body').hasClass( 'aotm-refresh-onload' ) ) {
			do_filtering();
		}
	}, 500 )

});

