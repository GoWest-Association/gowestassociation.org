<?php


// ad showcase
function the_stats() {

	// get the icons
	$stats = get_cmb_value( 'stat_showcase' );

	// if it's an array
	if ( is_array( $stats ) ) {

		if ( !empty( $stats[0]['title'] ) && !empty( $stats[0]['subtitle'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="stats">
			<?php
			foreach ( $stats as $stat ) {
                $title = str_replace( '|', '<br>', $stat['title'] );
                $subtitle = $stat['subtitle'];
				?>
    		<div class="stat">
                <h3><?php print $title; ?></h3>
                <p><?php print $subtitle; ?></p>
    		</div>
				<?php 
			}
			?>
		</div>
		<?php
		}
	}
}



// add metabox(es)
function stat_metaboxes( $meta_boxes ) {

	global $colors;

    // thumb showcase metabox
    $stat_showcase_metabox = new_cmb2_box( array(
        'id' => 'stat_showcase_metabox',
        'title' => 'Stats',
        'show_on' => array( 'key' => 'page-template', 'value' => 'page-front-foundation.php' ),
        'object_types' => array( 'page' ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $stat_showcase_metabox_group = $stat_showcase_metabox->add_field( array(
        'id' => 'stat_showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Stat', 'cmb2'),
            'remove_button' => __('Remove Stat', 'cmb2'),
            'group_title'   => __( 'Stat {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $stat_showcase_metabox->add_group_field( $stat_showcase_metabox_group, array(
        'name' => 'Title',
        'desc' => 'Set a title to display below this icon.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $stat_showcase_metabox->add_group_field( $stat_showcase_metabox_group, array(
        'name' => 'Subtitle',
        'desc' => 'Set a subtitle to display below this icon.',
        'id'   => 'subtitle',
        'type' => 'text',
        'sanitization_cb' => false
    ) );



}
add_filter( 'cmb2_init', 'stat_metaboxes' );

