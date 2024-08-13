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

    $newsletter_metabox->add_field( array(
        'name' => 'Hide Author',
        'desc' => 'Hide the author from the post page.',
        'id'   => CMB_PREFIX . 'hide-author',
        'type' => 'checkbox',
    ) );

}
add_filter( 'cmb2_init', 'newsletter_metabox' );


// get advocacy-on-the-move and all its children as an array of ids.
function get_aotm_categories() {

    // get aotm category
    $aotm_parent = get_category_by_slug( 'advocacy-on-the-move' );

    // get aotm children
    $aotm_cats = get_term_children( $aotm_parent->term_id, 'category' );

    // add the parent category to the list.
    $aotm_cats[] = $aotm_parent->term_id;

    // return the array of ids,
    return $aotm_cats;
}


function exclude_category_posts( $category_array ) {

    global $wp_query;
    print $wp_query->category__not_in;

}

