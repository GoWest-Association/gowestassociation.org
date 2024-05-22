<?php


// boolean for whether to show the title
function show_title() {
    if ( has_cmb_value( 'show_title' ) ) {
        if ( get_cmb_value( 'show_title') == 'on' ) return true;
    }
    return false;
}


// boolean for whether to show the breadcrumbs
function show_breadcrumbs() {
    if ( has_cmb_value( 'hide_breadcrumbs' ) ) {
        if ( get_cmb_value( 'hide_breadcrumbs') == 'on' ) return false;
    }
    return true;
}


// settings metabox
add_action( 'cmb2_admin_init', 'settings_metaboxes' );
function settings_metaboxes() {

    // area of interest information
    $settings_metabox = new_cmb2_box( array(
        'id' => 'settings_metabox',
        'title' => 'Settings',
        'object_types' => array( 'page', 'event', 'agenda' ), // Post type
        'context' => 'side',
        'priority' => 'high',
        'show_names' => false, // Show field names on the left
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Show Title',
        'id'   => CMB_PREFIX . 'show_title',
        'desc' => 'Show Page Title.',
        'type' => 'checkbox',
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Hide Breadcrumbs',
        'id'   => CMB_PREFIX . 'hide_breadcrumbs',
        'desc' => 'Hide Breadcrumbs',
        'type' => 'checkbox',
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Branding',
        'id'   => CMB_PREFIX . 'page_brand',
        'desc' => 'Choose the branding.',
        'type' => 'select',
        'default' => 'core',
        'options' => array(
            'core' => 'Core',
            'foundation' => 'Foundation',
            'newsletter' => 'Newsletter',
            'solutions' => 'Solutions',
        ),
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Member Only?',
        'id'   => CMB_PREFIX . 'member-only',
        'desc' => 'Members Only',
        'type' => 'checkbox'
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Board Only?',
        'id'   => CMB_PREFIX . 'board-only',
        'desc' => 'Board Members Only',
        'type' => 'checkbox'
    ) );

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

