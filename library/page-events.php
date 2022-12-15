<?php


function the_page_events( $display = 'list' ) {

    $event_category = get_cmb_value( 'page-events' );
    $event_category_info = get_term_by( 'slug', $event_category, 'event_cat' );
    //print_r( $event_category_info );

    if ( has_cmb_value( 'page-events' ) ) {
    ?>
    <div class="page-events <?php print $display ?>">
        <h3 class="page-events-title"><?php print get_cmb_value( 'page-events-title' ) ?></h3>
        <a href="/events?event_category=<?php print $event_category_info->term_id ?>" class="all-events">All Events</a>
        <?php print do_shortcode( '[events-cta display="' . $display . '" category="' . get_cmb_value( 'page-events' ) . '" /]' ); ?>
    </div>
    <?php
    }
}


function the_page_events_row() {

    $event_category = get_cmb_value( 'page-events' );
    $event_category_info = get_term_by( 'slug', $event_category, 'event_cat' );
    //print_r( $event_category_info );

    if ( has_cmb_value( 'page-events' ) ) {
    ?>
    <div class="page-events <?php print $display ?>">
        <h3 class="page-events-title"><?php print get_cmb_value( 'page-events-title' ) ?></h3>
        <a href="/events?event_category=<?php print $event_category_info->term_id ?>" class="all-events">All Events</a>
        <?php print do_shortcode( '[events category="' . get_cmb_value( 'page-events' ) . '" /]' ); ?>
    </div>
    <?php
    }
}


// introduction metabox
add_action( 'cmb2_admin_init', 'page_events_metaboxes' );
function page_events_metaboxes() {

    global $colors;

    // area of interest information
    $page_events_metabox = new_cmb2_box( array(
        'id' => 'page_events_metabox',
        'title' => 'Event List',
        'object_types' => array( 'page' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $page_events_metabox->add_field( array(
        'name' => 'Event List Title',
        'id'   => CMB_PREFIX . 'page-events-title',
        'type' => 'text',
        'default' => 'Upcoming Events',
    ) );

    $event_cats = get_terms( 'event_cat' );
    $event_groups = array( '' => '- select an event category -' );
    foreach ( $event_cats as $cat ) {
        $event_groups[$cat->slug] = $cat->name;
    }
    $page_events_metabox->add_field( array(
        'name' => 'Event Category',
        'id'   => CMB_PREFIX . 'page-events',
        'type' => 'select',
        'options' => $event_groups
    ) );

}

