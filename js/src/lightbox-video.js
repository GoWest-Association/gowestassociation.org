

// onload
jQuery(document).ready(function($){
        
    // function to trigger the video lightbox
    var trigger_video_lightbox = function( href ){

        $.magnificPopup.open({
            mainClass: 'mfp-video',
            items: {
                src: href
            },
            type: 'iframe'
        });

    }

    // handle lightbox-video link/object clicks
    $('.lightbox-video').on( 'click', function(){

        // get the data-href property of the clicked element
        var href = $(this).data('href');
        
        // if that's empty, grab the href assuming it's a link
        if ( href.length == 0 ) {
            href = $(this).attr('href');
        }

        // if it's not empty after those checks
        if ( href.length > 0 ) {

            // check if we're on a tablet
            if ( $(window).width() < 768 ) {

                // open the link in a new tab
                window.open( href, '_blank' );
    
            } else {

                // trigger the video lightbox
                trigger_video_lightbox( href );

            }
        
        }
    });

});

