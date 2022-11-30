<?php


// removing this constant will mess up any modules that add to the theme options dashboard area.
define( 'PURE', true );


// require multiple - a little helper function to require multiple files from the library directory in a one 
function require_multi( $files ) {
    $files = func_get_args();
    foreach ( $files as $file )
        require_once 'library/' . $file . '.php';
}


// the colors used in the theme
$colors = array(
    'green' => "Green",
    'blue' => "Blue",
    'sky' => "Sky",
    'navy' => "Navy",
    'orange' => "Orange",
);


// include utility functions
require_multi( 
    'core', 'admin', 'metabox', 'images',

    // include the post types
    'post-type/people', 'post-type/event', 'post-type/job', 'post-type/partner', 'post-type/agenda',

    // include the metaboxes in the order we want them to show up in the editor pages
    'settings', 'newsletter', 'showcase', 'stats', 'icons', 'partner-logos', 'testimonials', 'pages', 'accordion', 'link-boxes',

    // add shortcodes
    'button'
);

