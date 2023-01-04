<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => '',
		'category__not_in' => '',
		'post_type' => 'post',
		'posts_per_page' => 4
	), $atts );

	$args = array(
		'posts_per_page' => $a['posts_per_page']
	);

	if ( !empty( $a['tags'] ) ) {
		$args['tag'] = $a['tags'];
	}

	if ( !empty( $a['cats'] ) ) {
		$args['category_name'] = $a['cats'];
	}

	if ( !empty( $a['category__not_in'] ) ) {
		$args['category__not_in'] = explode( ',', $a['category__not_in'] );
	}

	$query = new WP_Query( $args );

	// Check that we have query results.
	if ( $query->have_posts() ) {

		$return = '<div class="article-cards">';
	  
	    // Start looping over the query results.
	    while ( $query->have_posts() ) {
	        $query->the_post();
	        $categories = get_the_category();
	        $cat = $categories[0];
	        $color = get_category_color( $cat->term_id );
	        $return .= '<div class="entry">';
	        $return .= '<div class="entry-thumbnail">';
	        $return .= '<a href="' . get_the_permalink() . '">';
	        $return .= get_the_post_thumbnail( null, array( 768, 480 ) );
	        $return .= '</a>';
		    $return .= '<div class="entry-category ' . $cat->slug . ' ' . $color . '">' . $cat->name . '</div>';
		    $return .= '</div>';
	        $return .= '<div class="entry-inner">';
		    $return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
		    $return .= wpautop( get_the_excerpt() );
		    $return .= '</div>';
		    $return .= '</div>';
	    }

		$return .= '</div>';
	  
	} else {
		return '';
	}

	  
	// Restore original post data.
	wp_reset_postdata();
	  

	return $return;
}
add_shortcode( 'articles', 'articles_shortcode' );



// pagination
function pagination( $prev = '&laquo;', $next = '&raquo;' ) {
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



// add a metabox for featured image caption
function caption_metabox( $meta_boxes ) {

    $showcase_metabox = new_cmb2_box( array(
        'id' => 'caption_metabox',
        'title' => 'Featured Image Caption',
        'object_types' => array( 'post' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_metabox->add_field( array(
        'name' => 'Caption',
        'desc' => 'Enter the caption for the featured image.',
        'id'   => CMB_PREFIX . 'caption',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_admin_init', 'caption_metabox' );


