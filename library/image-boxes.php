<?php


// ad showcase
function the_image_boxes() {

	// get the icons
	$links = get_cmb_value( 'image_boxes' );

	// if it's an array
	if ( is_array( $links ) ) {

		if ( !empty( $links[0]['link'] ) && !empty( $links[0]['image'] ) && !empty( $links[0]['title'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="image-boxes">
			<?php
			foreach ( $links as $link ) {
				if ( !empty( $link['link'] ) && !empty( $link['image'] ) && !empty( $link['title'] ) ) { 
                    $title = str_replace( '|', '<br>', $link['title'] );
					?>
			<div data-href="<?php print $link['link']; ?>" class="image-box <?php print $link['color'] ?>" style="background-image: url(<?php print $link['image']; ?>);">
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
function image_boxes_metaboxes( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $image_box_metabox = new_cmb2_box( array(
        'id' => 'image_boxes_metabox',
        'title' => 'Image Boxes',
        'object_types' => array( 'page' ),
        'show_on_cb'   => array( 'key' => 'page-template', 'value' => 'page-advocacy.php' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $image_box_metabox_group = $image_box_metabox->add_field( array(
        'id' => 'image_boxes',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Box', 'cmb2'),
            'remove_button' => __('Remove Box', 'cmb2'),
            'group_title'   => __( 'Box {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $image_box_metabox->add_group_field( $image_box_metabox_group, array(
        'name' => 'Box Background',
        'desc' => 'Upload a photo for the background.',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 90, 90 )
    ) );

    $image_box_metabox->add_group_field( $image_box_metabox_group, array(
        'name' => 'Text',
        'desc' => 'Set text for this link.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $image_box_metabox->add_group_field( $image_box_metabox_group, array(
        'name' => 'Link',
        'desc' => 'Specify a URL.',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $image_box_metabox->add_group_field( $image_box_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'options' => $colors
    ) );

}
add_filter( 'cmb2_init', 'image_boxes_metaboxes' );

