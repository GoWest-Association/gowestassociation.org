<?php


// ad showcase
function the_icons() {

	// get the icons
	$icons = get_cmb_value( 'icon_showcase' );

	// if it's an array
	if ( is_array( $icons ) ) {

		if ( !empty( $icons[0]['link'] ) && !empty( $icons[0]['image'] ) && !empty( $icons[0]['title'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="icons">
			<?php
			foreach ( $icons as $icon ) {
				$color = ( !empty( $icon['color'] ) ? $icon['color'] : 'blue' );
				if ( !empty( $icon['link'] ) && !empty( $icon['image'] ) && !empty( $icon['title'] ) ) { 
                    $title = str_replace( '|', '<br>', $icon['title'] );
                    $title_alt = str_replace( '|', ' ', $icon['title'] );
                    $class = $icon['class'];
					?>
			<div data-href="<?php print $icon['link']; ?>" class="icon <?php print $color . ' ' . $class; ?>">
				<div class="icon-image"><img src="<?php print $icon['image']; ?>" alt="<?php print ( !empty( $icon['alt-text'] ) ? $icon['alt-text'] : $title_alt ); ?>"></div>
				<h3><?php print $title; ?></h3>
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



// add metabox(es)
function icon_metaboxes( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $icon_showcase_metabox = new_cmb2_box( array(
        'id' => 'icon_showcase_metabox',
        'title' => 'Icons',
        'show_on' => array( 'key' => 'page-template', 'value' => 'page-front.php' ),
        'object_types' => array( 'page' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $icon_showcase_metabox_group = $icon_showcase_metabox->add_field( array(
        'id' => 'icon_showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Icon', 'cmb2'),
            'remove_button' => __('Remove Icon', 'cmb2'),
            'group_title'   => __( 'Icon {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Icon Image',
        'desc' => 'Upload a 90x90 pixel icon image, ideally a transparent PNG with the icon in white.',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 90, 90 )
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Title',
        'desc' => 'Set a title to display below this icon.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Link',
        'desc' => 'Specify a URL to which this ad should link.',
        'id'   => 'link',
        'type' => 'text',
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Class',
        'desc' => 'Specify a link class.',
        'id'   => 'class',
        'type' => 'text',
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Color',
        'desc' => 'Choose a color for the background of the icon and the text-color.',
        'id'   => 'color',
        'type' => 'select',
        'options' => $colors,
        'default' => 'navy'
    ) );


}
add_filter( 'cmb2_init', 'icon_metaboxes' );

