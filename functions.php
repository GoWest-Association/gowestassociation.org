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
    'core', 'admin', 'metabox', 
    'post-type/people', 'post-type/event', 'post-type/job', 'post-type/partner',
    'images', 'paginate', 'metabox', 'showcase', 'button', 'icons', 'accordion', 'stats' 
);

