<?php

$category = get_sub_field( 'category' );
if ( !empty( $category ) ) {
    print do_shortcode( '[people category="' . $category->slug . '" style="bubble"]' );
}
