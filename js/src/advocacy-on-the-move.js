

// tab controls
jQuery(document).ready(function($){
	if ( $( '.aotm-listing' ).length ) {
		var do_filtering = function(){
			var show_arizona = $( '.arizona-filter' ).is(':checked');
			var show_colorado = $( '.colorado-filter' ).is(':checked');
			var show_idaho = $( '.idaho-filter' ).is(':checked');
			var show_oregon = $( '.oregon-filter' ).is(':checked');
			var show_washington = $( '.washington-filter' ).is(':checked');
			var show_wyoming = $( '.wyoming-filter' ).is(':checked');
			var show_regulatory = $( '.regulatory-filter' ).is(':checked');

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
	}

	$('.category-select').on( 'change', function(){
		location.href = '/category/' + $(this).val();
	});
});

