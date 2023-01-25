<?php



// accordion output function
function the_accordions() {

	// get the slides
	$accordions = get_post_meta( get_the_ID(), "accordions", 1 );

	if ( isset( $accordions[0]['title'] ) ) {
		?>
		<div class="accordions">
			<?php
			foreach ( $accordions as $key => $accordion ) {
				if ( !empty( $accordion["title"] ) ) {

					// store the title and subtitle
					$title = ( isset( $accordion["title"] ) ? $accordion["title"] : '' );
                    $content = ( isset( $accordion["content"] ) ? $accordion["content"] : '' );
                    $color = ( isset( $accordion["color"] ) ? $accordion["color"] : '' );

					?>
            <a name="accordion-<?php print $key+1; ?>"></a>
			<div class="accordion<?php print ( isset( $accordion['open'] ) ? ( $accordion['open'] == 'on' ? " open" : "" ) : "" ); ?> <?php print $color ?>">
				<div class="accordion-handle"><h3><?php print $title ?></h3></div>
				<div class="accordion-content">
					<?php print apply_filters( 'the_content', $content ); ?>
				</div>
			</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}



// accordion metaboxes
add_action( 'cmb2_admin_init', 'accordion_metaboxes' );
function accordion_metaboxes() {

    global $colors;

    $accordion_colors = $colors;
    $accordion_colors['green-dark'] = 'Green (Dark)';
    $accordion_colors['green-darker'] = 'Green (Darker)';
    $accordion_colors['vermillion-light'] = 'Vermillion (Light)';
    $accordion_colors['vermillion-ligher'] = 'Vermillion (Lighter)';
    $accordion_colors['navy-light'] = 'Navy (Light)';
    $accordion_colors['navy-lighter'] = 'Navy (Lighter)';
    asort( $accordion_colors );

    // area of interest information
    $accordion_metabox = new_cmb2_box( array(
        'id' => 'accordions',
        'title' => 'Accordions',
        'object_types' => array( 'page', 'event' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $accordion_metabox_group = $accordion_metabox->add_field( array(
        'id' => 'accordions',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Accordion', 'cmb'),
            'remove_button' => __('Remove Accordion', 'cmb'),
            'group_title'   => __( 'Accordion {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Title',
        'id'   => 'title',
        'type' => 'text',
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Color',
        'id'   => 'color',
        'type' => 'select',
        'options' => $accordion_colors
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Open By Default',
        'id'   => 'open',
        'type' => 'checkbox',
    ) );

    $accordion_metabox->add_group_field( $accordion_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 5,
        ),
    ) );

}


