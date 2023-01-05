<?php


function the_button_bar() {

	$heading = get_cmb_value( 'buttons_heading' );
	$buttons = get_cmb_value( 'buttons' );
	
	// if we've got buttons
	if ( !empty( $buttons ) ) {

		print '<div class="button-bar">';
		if ( !empty( $heading ) ) print '<h3>' . $heading . '</h3>';
		print '<div class="button-bar-inner">';

		// loop through them
		foreach ( $buttons as $button ) {
			print do_shortcode( '[button url="' . $button['link'] . '" class="' . $button['class'] . '"]' . $button['text'] . '[/button] ' );
		}

		print '</div>';
		print '</div>';

	}

}


// introduction metabox
add_action( 'cmb2_admin_init', 'button_metabox' );
function button_metabox() {

    // area of interest information
    $button_metabox = new_cmb2_box( array(
        'id' => 'buttons_metabox',
        'title' => 'Button Bar',
        'object_types' => array( 'page', 'event' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $button_metabox->add_field( array(
        'name' => 'Heading',
        'id'   => CMB_PREFIX . 'buttons_heading',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $button_metabox_group = $button_metabox->add_field( array(
        'id' => CMB_PREFIX . 'buttons',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Button', 'cmb2'),
            'remove_button' => __('Remove Button', 'cmb2'),
            'group_title'   => __( 'Button {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $button_metabox->add_group_field( $button_metabox_group, array(
        'name' => 'Button Text',
        'id'   => 'text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $button_metabox->add_group_field( $button_metabox_group, array(
        'name' => 'Button Link',
        'id'   => 'link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $button_metabox->add_group_field( $button_metabox_group, array(
        'name' => 'Button Class',
        'desc' => 'Set a class. Example: `green lightbox-iframe`',
        'id'   => 'class',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

}


