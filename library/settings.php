<?php


// boolean for whether to show the title
function show_title() {
    if ( has_cmb_value( 'show_title' ) ) {
        if ( get_cmb_value( 'show_title') == 'on' ) return true;
    }
    return false;
}


// settings metabox
add_action( 'cmb2_admin_init', 'settings_metaboxes' );
function settings_metaboxes() {

    // area of interest information
    $settings_metabox = new_cmb2_box( array(
        'id' => 'settings_metabox',
        'title' => 'Settings',
        'object_types' => array( 'page' ), // Post type
        'context' => 'side',
        'priority' => 'high',
        'show_names' => false, // Show field names on the left
    ) );

    $settings_metabox->add_field( array(
        'name' => 'Show Title',
        'id'   => CMB_PREFIX . 'show_title',
        'desc' => 'Show the page title.',
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

