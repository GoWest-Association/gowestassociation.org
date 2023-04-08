<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js?v=17', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );



// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main',
	'main-menu-sli' => 'Main (Solutions)',
	'footer' => 'Footer',
	'newletter-sidebar' => 'Newsletter'
) );


// parse the query string
function parse_query_string() {
	$url_parts = wp_parse_url( $_SERVER['REQUEST_URI'] );
	if ( isset( $url_parts['query'] ) ) {
		parse_str( $url_parts['query'], $query_args );
		return $query_args;
	} else {
		return array();
	}
}


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



function paginate( $prev = '&laquo;', $next = '&raquo;' ) {
    global $wp_query, $wp_rewrite;

	// output the pagination links
    echo '<div class="pagination">' . paginate_links() . '</div>';
}



function breadcrumbs( $items = array() ) {

	// if we don't have manually set breadcrumbs
	if ( empty( $items ) ) {

		// empty item ids array
		$item_ids = array();

		// get current parent
		$parent = wp_get_post_parent_id();

		// add to the items_id array if not empty
		if ( $parent > 0 ) array_push( $item_ids, $parent );

		// set up an array based on page heirarchy
		while ( $parent > 0 ) {
			
			// get the parent
			$parent = wp_get_post_parent_id( $parent );

			// add it to the item_ids array
			if ( $parent > 0 ) array_push( $item_ids, $parent );

		}

		// reverse the array of items
		$item_ids = array_reverse( $item_ids );

		// construct the items array
		foreach ( $item_ids as $a_item ) {
			array_push( $items, array(
				'href' => get_permalink( $a_item ),
				'text' => get_the_title( $a_item )
			) );
		}

	}

	// loop through the items
	print '<div class="breadcrumbs">';

	// show home crumb
	print '<a href="/">Home</a> &raquo; ';

	// if we have items besides the home and current page
	if ( !empty( $items ) ) {

		// loop through them and output
		foreach ( $items as $item ) {
			print '<a href="' . $item['href'] . '">' . $item['text'] . '</a> &raquo; ';
		}

	}

	// show current page title only
	print '<span class="current">' . get_the_title() . '</span>';

	// close breadcrumbs
	print '</div>';

}

