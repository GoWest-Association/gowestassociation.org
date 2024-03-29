<?php


// add the anthem metabox
function newsletter_metabox( $meta_boxes ) {

    $newsletter_metabox = new_cmb2_box( array(
        'id' => 'newsletter_metabox',
        'title' => 'Post Information',
        'object_types' => array( 'post' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );


    $newsletter_metabox->add_field( array(
        'name' => 'Caption',
        'desc' => 'Specify the caption to display below the featured image.',
        'id'   => CMB_PREFIX . 'caption',
        'type' => 'textarea_small',
    ) );


}
add_filter( 'cmb2_init', 'newsletter_metabox' );

