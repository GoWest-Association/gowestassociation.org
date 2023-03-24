

// onload notice bar functionality.
jQuery(document).ready(function($){

    var lightbox_class = '.lightbox-theme'
    var lightbox = $( lightbox_class );

    if ( lightbox.length > 0 ) {

        // a boolean we'll adjust as we go to make sure should display the lightbox
        var display_lightbox = false;

        // cookie name we'll use to hide this specific lightbox permanently where applicable
        var cookie_name = lightbox.data( 'cookie' );

        // get the cookie
        if ( $.cookies.get( cookie_name ) == null ) {
            display_lightbox = true;
        }

        // if 'always show' is checked
        if ( lightbox.data( 'pageload' ) ) {
            display_lightbox = true;
        }

        // see if lightbox has expiration date
        if ( lightbox.data('expires').length ) {

            // get current and expiration times
            var timestamp_now = Date.now();
            var timestamp_expires = Date.parse( lightbox.data('expires') );

            // if lightbox is expired
            if ( timestamp_now > timestamp_expires ) {

                // suppress lightbox
                display_lightbox = false;
            }
        }

        // see if we should open the lightbox
        if ( display_lightbox ) {

            // actually open the lightbox
            $.magnificPopup.open({
                items: {
                    src: lightbox_class
                },
                type: 'inline',
                callbacks: {

                    // runs when the lightbox gets closed
                    close: function(){

                        // set the cookie to prevent it from showing again
                        $.cookies.set( cookie_name, 'true' );
                    }

                }
            });
        }
    }

});

