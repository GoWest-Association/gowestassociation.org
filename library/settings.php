<?php


// boolean for whether to show the title
function show_title() {
    if ( has_cmb_value( 'show_title' ) ) {
        if ( get_cmb_value( 'show_title') == 'on' || get_cmb_value( 'show_title') == true ) return true;
    }
    return false;
}


// boolean for whether to show the breadcrumbs
function show_breadcrumbs() {
    if ( has_cmb_value( 'hide_breadcrumbs' ) ) {
        if ( get_cmb_value( 'hide_breadcrumbs') == 'on' || get_cmb_value( 'hide_breadcrumbs') == true ) return false;
    }
    return true;
}


// is newsletter boolean function
function is_newsletter() {

    // if the brand constant is set
    if ( defined( 'BRAND' ) ) {
        // if the newsletter global is set
        if ( BRAND == 'newsletter' ) {
            return true;
        }
    }

    // otherwise, return false
    return false;
}


function is_foundation() {

    $response = false;

    // if we're on the foundation site
    $site = ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '' );
    if ( stristr( $site, 'foundation' ) ) {
        $response = true;
    }

    // if the brand constant is set
    if ( defined( 'BRAND' ) ) {
        // if the foundation global is set
        if ( BRAND == 'foundation' ) {
            $response = true;
        }
    }

    // otherwise, return false
    return $response;
}


function is_solutions() {
    global $is_solutions;

    // if the brand constant is set
    if ( defined( 'BRAND' ) ) {
        // if the solutions global is set
        if ( BRAND == 'solutions' ) {
            return true;
        }
    }

    // otherwise, return false
    return false;
}


function set_brand( $brand = '' ) {
    define( 'BRAND', $brand );
}


function get_brand() {
    if ( defined( 'BRAND' ) ) {
        return BRAND;
    } else {
        return false;
    }
}


// add category support to pages
function categories_for_pages() {  
    register_taxonomy_for_object_type( 'category', 'page' );  
}
add_action( 'init', 'categories_for_pages' );


// exclude pages that are in a specific category from search results.
function wpb_search_filter( $query ) {
    if ( $query->is_search && !is_admin() ) {
        $category = get_category_by_slug( 'exclude' );
        if ( !empty( $category ) ) {
            $query->set( 'cat', '-' . $category->term_id );
        }
    }
    return $query;
}
add_filter( 'pre_get_posts', 'wpb_search_filter' );

