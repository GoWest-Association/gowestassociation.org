<?php


// pagination
function paginate( $prev = '&laquo;', $next = '&raquo;' ) {
    global $wp_query, $wp_rewrite;

    /*
    $request = parse_query_string();

    $posts_per_page = ( isset( $wp_query->query_vars['posts_per_page'] ) ? $wp_query->query_vars['posts_per_page'] : 18 );

    $total = ceil( $wp_query->found_posts / $posts_per_page );

    $current = ( isset( $request['paged'] ) ? $request['paged'] : 1 );

    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $total,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
    );
    */

    echo '<div class="pagination">' . paginate_links( $pagination ) . '</div>';
}



