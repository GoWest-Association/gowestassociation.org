<?php


function the_page_ads() {

    $group = get_cmb_value( 'page-ad-group' );

    if ( !empty( $group ) ) { ?>
        <div class="page-ads">
            <?php do_ad_group( $group, 10 ); ?>
        </div>
        <?php 
    }

}


// introduction metabox
add_action( 'cmb2_admin_init', 'page_ads_metaboxes' );
function page_ads_metaboxes() {

    global $colors;

    // area of interest information
    $page_ads_metabox = new_cmb2_box( array(
        'id' => 'page_ads_metabox',
        'title' => 'Page Ads',
        'object_types' => array( 'page' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $ad_cats = get_terms( 'ad_group' );
    $ad_groups = array( '' => '- select an ad group -' );
    foreach ( $ad_cats as $cat ) {
        $ad_groups[$cat->slug] = $cat->name;
    }
    $page_ads_metabox->add_field( array(
        'name' => 'Page Ad Group',
        'id'   => CMB_PREFIX . 'page-ad-group',
        'type' => 'select',
        'options' => $ad_groups
    ) );

}

