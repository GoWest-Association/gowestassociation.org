<?php

// Function that will return our Wordpress menu
function menu_shortcode( $atts, $content = null ) {

	// return the menu content 
	return wp_nav_menu( array( 
		'menu'            => $atts['id'], 
		'container'       => 'div', 
		'menu_class'      => 'menu', 
		'echo'            => false,
		'fallback_cb'     => 'wp_page_menu',
		'depth'           => 0,
    ) );

}
//Create the shortcode
add_shortcode( "menu", "menu_shortcode" );

