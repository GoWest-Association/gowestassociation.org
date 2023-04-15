<?php


// start a session.
session_start();


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
    'solutions' => "Solutions",
    'navy' => "Navy",
    'vermillion' => "Vermillion",
    'fulvous' => "Fulvous",
    'state-az' => "State (Arizona)",
    'state-co' => "State (Colorado)",
    'state-id' => "State (Idaho)",
    'state-or' => "State (Oregon)",
    'state-wa' => "State (Washington)",
    'state-wy' => "State (Wyoming)",
);


// include utility functions
require_multi( 
    'core', 'admin', 'metabox', 'images', 'login', 'settings', 

    // include the post types
    'post-type/people', 'post-type/event', 'post-type/job', 'post-type/partner', 'post-type/agenda', 'post-type/lightbox',

    // include the metaboxes in the order we want them to show up in the editor pages
    'newsletter', 'showcase', 'stats', 'icons', 'partner-logos', 'testimonials', 'page', 'page-events', 'page-ads', 'page-articles', 
    'accordion', 'link-boxes', 'button-bar', 'price-table', 'footer-buttons', 'image-boxes', 'notice', 

    // add shortcodes
    'shortcode/button', 'shortcode/menu', 'shortcode/communities',

    // microsite
    'microsite'
);

