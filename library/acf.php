<?php


// collapsed flexible content title overrides
function flexible_content_collapsed_title( $title, $field, $layout, $i ) {

    if ( $layout['name'] == 'section_title' ) {
        $title = '';
        $title .= 'Title: <strong>' . esc_html( get_sub_field('title') ) . '</strong>';
    }
    if ( $layout['name'] == 'question' ) {
        $title = '';
        $title .= 'Question: <strong>' . esc_html( get_sub_field('question') ) . '</strong>';
    }
    return $title;

}
add_filter( 'acf/fields/flexible_content/layout_title', 'flexible_content_collapsed_title', 10, 4 );

