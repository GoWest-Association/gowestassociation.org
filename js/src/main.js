

// onload responsive footer and menu stuff
jQuery(document).ready(function($){


	// remove height and width from images inside
	var fluid_images = $( '.content img' );
	fluid_images.removeAttr( 'width' ).removeAttr( 'height' );


	// show/hide menus when they click the toggler
	var menu = $( 'header nav' );
	var menu_toggle = menu.find( 'button.menu-toggle' );
	var menu_ul = menu.find( '.nav-menu' );
	menu_toggle.click(function(){

		// if the menu is visible, hide it, 
		if ( menu_ul.is( ':visible' ) ) {
			menu_ul.hide();
		} else {
			menu_ul.show();
		}

		// when user clicks a link in the menu, open submenu if it exists.
		menu_ul.find( 'a' ).click(function(){
			var parent_li = $( this ).parent( 'li' );
			var submenu = $( this ).next( 'ul' );
			if ( !submenu.is( ':visible' ) && parent_li.hasClass( 'menu-item-has-children' ) ) {
				event.preventDefault();
				parent_li.addClass( 'open' );
				submenu.show();
			}
		});

	});


	// couple of quick bindings for magnific popup
	$( '.lightbox-iframe' ).magnificPopup({ 'type': 'iframe' });
	$( '.lightbox' ).magnificPopup({ 'type': 'image' });


});

