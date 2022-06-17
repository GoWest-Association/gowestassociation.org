<?php

// include the cmb2
require_once 'cmb2/init.php';

define( 'CMB_PREFIX', '_p_' );


// get CMB value
function get_cmb_value( $field ) {
    return get_post_meta( get_the_ID(), $field, 1 );
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

