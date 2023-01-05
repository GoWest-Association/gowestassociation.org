<?php


function the_footer_buttons() {

	$buttons = get_cmb_value( 'footer-buttons' );
	
	// if we've got buttons
	if ( !empty( $buttons ) ) {

		print '<div class="footer-buttons">';
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
add_action( 'cmb2_admin_init', 'footer_buttons_metabox' );
function footer_buttons_metabox() {

    // area of interest information
    $footer_buttons_metabox = new_cmb2_box( array(
        'id' => 'footer_buttons_metabox',
        'title' => 'Footer Buttons',
        'object_types' => array( 'page', 'event' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $footer_buttons_metabox_group = $footer_buttons_metabox->add_field( array(
        'id' => CMB_PREFIX . 'footer-buttons',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Button', 'cmb2'),
            'remove_button' => __('Remove Button', 'cmb2'),
            'group_title'   => __( 'Button {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $footer_buttons_metabox->add_group_field( $footer_buttons_metabox_group, array(
        'name' => 'Button Text',
        'id'   => 'text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $footer_buttons_metabox->add_group_field( $footer_buttons_metabox_group, array(
        'name' => 'Button Link',
        'id'   => 'link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $footer_buttons_metabox->add_group_field( $footer_buttons_metabox_group, array(
        'name' => 'Button Class',
        'desc' => 'Set a class. Example: `green lightbox-iframe`',
        'id'   => 'class',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

}


