<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );



// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main'
) );



// register a generic sidebar.
register_sidebar( array(
	'id' => 'sidebar-generic',
	'name'=> 'General Sidebar',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
) );

