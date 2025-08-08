<?php

$snippet = get_sub_field( 'snippet' );

if ( !empty( $snippet ) ) {
    print get_snippet( $snippet->post_name );
}

