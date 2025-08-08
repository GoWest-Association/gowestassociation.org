

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

    $('.tabs .tab-handles .handle').on( 'click', function(){

        // store tab clicked
        var tab_id = $(this).data('tab');
        
        // find parent tabs container
        var parent_tabs = $(this).closest('.tabs');

        // remove active class from active tab and handle
        parent_tabs.find('.tab-handles .handle.active').removeClass( 'active' );
        parent_tabs.find('.tab-contents .content.active').removeClass( 'active' );

        // add active class to clicked tab handle and content
        parent_tabs.find( '.tab-handles .handle.tab-'+tab_id ).addClass( 'active' );
        parent_tabs.find( '.tab-contents .content.tab-'+tab_id ).addClass( 'active' );
        
    });

});

