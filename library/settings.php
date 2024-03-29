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

}


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
