<?php


// ad showcase
function the_icons() {

	// get the icons
	$icons = get_cmb_value( 'icon_showcase' );
    $icons_per_row = get_cmb_value( 'icons_per_row' );

    // default for posts where it's not set
    if ( empty( $icons_per_row ) ) $icons_per_row = 'all';

	// if it's an array
	if ( is_array( $icons ) ) {

		if ( !empty( $icons[0]['link'] ) && !empty( $icons[0]['image'] ) && !empty( $icons[0]['title'] ) ) {

    		// if it's an array, we'll assume it's got content
    		?>
		<div class="icons <?php print $icons_per_row ?>">
			<?php
			foreach ( $icons as $icon ) {
				$color = ( !empty( $icon['color'] ) ? $icon['color'] : 'blue' );
				if ( !empty( $icon['link'] ) && !empty( $icon['image'] ) && !empty( $icon['title'] ) ) { 
                    $title = str_replace( '|', '<br>', $icon['title'] );
                    $title_alt = str_replace( '|', ' ', $icon['title'] );
                    $class = ( isset( $icon['class'] ) ? $icon['class'] : '' );
					?>
			<a href="<?php print $icon['link']; ?>" class="icon <?php print $color . ' ' . $class; ?>">
                <div class="icon-image"><img src="<?php print $icon['image']; ?>" alt="<?php print ( !empty( $icon['alt-text'] ) ? $icon['alt-text'] : $title_alt ); ?>"></div>
                <h3><?php print $title; ?></h3>
            </a>
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
        'object_types' => array( 'page', 'event' ),
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
        'desc' => 'Set a title to display below this icon. Add "|" to insert a line break.',
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

    $icon_showcase_metabox->add_field( array(
        'name' => 'Icons per Row',
        'desc' => 'Set the number of icons per row when there are more than 6 and you want to split them evenly.',
        'id'   => 'icons_per_row',
        'type' => 'select',
        'options' => array( 
            'all' => 'All',
            'three' => 'Three', 
            'four' => 'Four', 
            'five' => 'Five',
            'six' => 'Six',
        ),
        'default' => 'all'
    ) );


}
add_filter( 'cmb2_init', 'icon_metaboxes' );

