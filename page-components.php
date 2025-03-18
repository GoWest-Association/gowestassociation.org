<?php

/*
Template Name: Components
*/

if ( has_cmb_value( 'page_brand' ) ) {
	set_brand( get_cmb_value( 'page_brand' ) );
} else {
	set_brand( 'core' );
}

get_header();

if ( is_member() && is_board() ) {
	
	the_components();

} else {

	do_member_error();

}

get_footer();

