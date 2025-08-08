<?php

$mode = get_sub_field( 'mode' );

if ( $mode == 'generic' ) {

    // get the agenda post object
    $agenda = get_sub_field( 'agenda' );

    // output the agenda in question using a shortcode.
    print do_shortcode( '[agenda slug="' . $agenda->post_name . '" /]');

} else {

    $event_category = get_sub_field( 'event_category' );
    print do_shortcode( '[event-agenda category="' . $event_category->slug . '" /]');

}
