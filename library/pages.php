<?php


// boolean for if there's an introduction
function has_introduction() {
    if ( has_cmb_value( 'intro_content' ) ) {
        return true;
    }
    return false;
}


// introduction output function
function the_introduction() {

    // get the slides
    $intro_video = get_cmb_value( 'intro_video' );
    $intro_content = get_cmb_value( 'intro_content' );

    if ( !empty( $intro_content ) ) {
        ?>
        <div class="intro-columns">
            <?php
            if ( $intro_video ) {
                print '<div class="intro-video">' . apply_filters( 'the_content', $intro_video ) . '</div>';
            }
            ?>
            <div class="intro-content">
                <?php print apply_filters( 'the_content', $intro_content ); ?>
            </div>
        </div>
        <?php
    }
}



// introduction metabox
add_action( 'cmb2_admin_init', 'page_metaboxes' );
function page_metaboxes() {

    global $colors;

    // area of interest information
    $page_metabox = new_cmb2_box( array(
        'id' => 'page_metabox',
        'title' => 'Introduction',
        'object_types' => array( 'page', 'event' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $page_metabox->add_field( array(
        'name' => 'Video URL',
        'id'   => CMB_PREFIX . 'intro_video',
        'type' => 'text',
    ) );

    $page_metabox->add_field( array(
        'name' => 'Content',
        'id'   => CMB_PREFIX . 'intro_content',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 14,
        ),
    ) );

}


function the_bottom_content(){
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); 
            the_content();
        endwhile;
    endif;
}


// function that checks if the content is empty
function has_content() {
    return trim( str_replace( '&nbsp;', '', strip_tags( get_the_content() ) ) ) == '';
}

