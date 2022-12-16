<?php

// include the cmb2
require_once 'cmb2/init.php';

define( 'CMB_PREFIX', '_p_' );


// get CMB value
function get_cmb_value( $field, $id = 0 ) {
    if ( $id == 0 ) $id = get_the_ID();

    $val = get_post_meta( $id, $field, 1 );
    if ( empty( $val ) ) {
        $val = get_post_meta( get_the_ID(), CMB_PREFIX . $field, 1 );
    }
    return $val;
}


// get CMB value
function has_cmb_value( $field ) {
    $cval = get_cmb_value( $field );
    return ( !empty( $cval ) ? true : false );
}


// get CMB value
function show_cmb_value( $field ) {
    print get_cmb_value( $field );
}


// get CMB value
function show_cmb_wysiwyg_value( $field ) {
    print apply_filters( 'the_content', get_cmb_value( $field ) );
}

