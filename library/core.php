<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );



// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main',
	'main-menu-sli' => 'Main (SLI)',
	'newletter-sidebar' => 'Newsletter'
) );



// register a generic sidebar.
register_sidebar( array(
	'id' => 'generic',
	'name'=> 'General Sidebar',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
) );
register_sidebar( array(
	'id' => 'newsletter',
	'name'=> 'Newsletter Sidebar',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
) );


// is newsletter boolean function
function is_newsletter() {

	// if the newsletter global is set
	if ( BRAND == 'newsletter' ) {
		return true;
	}

	// otherwise, return false
	return false;
}


function is_foundation() {

	// if the foundation global is set
	if ( BRAND == 'foundation' ) {
		return true;
	}

	// otherwise, return false
	return false;
}


function is_solutions() {
	global $is_solutions;

	// if the solutions global is set
	if ( BRAND == 'solutions' ) {
		return true;
	}

	// otherwise, return false
	return false;
}


function set_brand( $brand = '' ) {
	define( 'BRAND', $brand );
}
