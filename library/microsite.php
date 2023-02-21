<?php


function the_microsite_header() {
    get_template_part( 'header-microsite' );
}


function the_microsite_footer() {
    get_template_part( 'footer-microsite' );
}


// ad showcase
function the_microsite_boxes() {

	// get the icons
	$links = get_cmb_value( 'microsite_boxes' );

	// if it's an array
	if ( is_array( $links ) ) {

		if ( !empty( $links[0]['link'] ) && !empty( $links[0]['image'] ) && !empty( $links[0]['title'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="microsite-boxes <?php show_cmb_value('microsite_boxes_theme'); ?>">
			<?php
			foreach ( $links as $link ) {
				if ( !empty( $link['link'] ) && !empty( $link['image'] ) && !empty( $link['title'] ) ) { 
                    $title = str_replace( '|', '<br>', $link['title'] );
					?>
			<div data-href="<?php print $link['link']; ?>" class="microsite-box <?php print $link['color'] ?>">
                <img src="<?php print $link['image']; ?>" />
                <a href="<?php print $link['link']; ?>"><?php print $title; ?></a>
            </div>
					<?php
				} 
			}
			?>
		</div>
		<?php
		}
	}
}


// add metabox
function microsite_metabox( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $microsite_metabox = new_cmb2_box( array(
        'id' => 'microsite_metabox',
        'title' => 'Microsite Settings',
        'object_types' => array( 'page' ),
        'show_on_cb'   => array( 'key' => 'page-template', 'value' => 'page-microsite.php' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $microsite_metabox->add_field( array(
        'name' => 'Header Logo',
        'desc' => 'Add a header logo',
        'id'   => 'microsite-logo',
        'type' => 'file',
        'preview_size' => array( 90, 90 )
    ) );

    $microsite_metabox->add_field( array(
        'name' => 'Footer Content',
        'desc' => 'Set the footer content.',
        'id'   => 'microsite-footer',
        'type' => 'wysiwyg',
        'sanitization_cb' => false
    ) );

}
add_filter( 'cmb2_init', 'microsite_metabox' );


// add metabox
function microsite_boxes_metaboxes( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $microsite_box_metabox = new_cmb2_box( array(
        'id' => 'microsite_boxes_metabox',
        'title' => 'Microsite Boxes',
        'object_types' => array( 'page' ),
        'show_on_cb'   => array( 'key' => 'page-template', 'value' => 'page-microsite.php' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $microsite_box_metabox->add_field( array(
        'name' => 'Theme',
        'id'   => 'microsite_boxes_theme',
        'type' => 'select',
        'options' => array(
            'state-az' => 'Arizona',
            'state-co' => 'Colorado',
            'state-id' => 'Idaho',
            'state-or' => 'Oregon',
            'state-wa' => 'Washington',
            'state-wy' => 'Wyoming',
        )
    ) );

    $microsite_box_metabox_group = $microsite_box_metabox->add_field( array(
        'id' => 'microsite_boxes',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Box', 'cmb2'),
            'remove_button' => __('Remove Box', 'cmb2'),
            'group_title'   => __( 'Box {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $microsite_box_metabox->add_group_field( $microsite_box_metabox_group, array(
        'name' => 'Box Icon',
        'desc' => 'Upload an icon for the box (transparent).',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 90, 90 )
    ) );

    $microsite_box_metabox->add_group_field( $microsite_box_metabox_group, array(
        'name' => 'Text',
        'desc' => 'Set text for this link.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $microsite_box_metabox->add_group_field( $microsite_box_metabox_group, array(
        'name' => 'Link',
        'desc' => 'Specify a URL.',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $microsite_box_metabox->add_group_field( $microsite_box_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'options' => $colors
    ) );

}
add_filter( 'cmb2_init', 'microsite_boxes_metaboxes' );

