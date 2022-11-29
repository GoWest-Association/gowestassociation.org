<?php


// ad showcase
function the_link_boxes() {

	// get the icons
	$links = get_cmb_value( 'link_boxes' );

	// if it's an array
	if ( is_array( $links ) ) {

		if ( !empty( $links[0]['link'] ) && !empty( $links[0]['image'] ) && !empty( $links[0]['title'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="link-boxes">
			<?php
			foreach ( $links as $link ) {
				if ( !empty( $link['link'] ) && !empty( $link['image'] ) && !empty( $link['title'] ) ) { 
                    $title = str_replace( '|', '<br>', $link['title'] );
					?>
			<div class="link-box" style="background-image: url(<?php print $link['image']; ?>);">
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
function link_boxes_metaboxes( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $link_box_metabox = new_cmb2_box( array(
        'id' => 'link_boxes_metabox',
        'title' => 'Link Boxes',
        'object_types' => array( 'page' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $link_box_metabox_group = $link_box_metabox->add_field( array(
        'id' => 'link_boxes',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Link', 'cmb2'),
            'remove_button' => __('Remove Link', 'cmb2'),
            'group_title'   => __( 'Link {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $link_box_metabox->add_group_field( $link_box_metabox_group, array(
        'name' => 'Box Background',
        'desc' => 'Upload a photo for the background.',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 90, 90 )
    ) );

    $link_box_metabox->add_group_field( $link_box_metabox_group, array(
        'name' => 'Text',
        'desc' => 'Set text for this link.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $link_box_metabox->add_group_field( $link_box_metabox_group, array(
        'name' => 'Link',
        'desc' => 'Specify a URL.',
        'id'   => 'link',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_init', 'link_boxes_metaboxes' );

