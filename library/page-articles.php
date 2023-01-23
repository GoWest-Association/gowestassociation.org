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
            $return .= '<div class="entry">';
            $return .= '<div class="entry-thumbnail">';
            $return .= '<a href="' . get_the_permalink() . '">';
            $return .= get_the_post_thumbnail( null, array( 768, 480 ) );
            $return .= '</a>';
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


// the metabox
add_action( 'cmb2_admin_init', 'page_articles_metaboxes' );
function page_articles_metaboxes() {

    // area of interest information
    $page_articles_metabox = new_cmb2_box( array(
        'id' => 'page_articles_metabox',
        'title' => 'Page Articles',
        'object_types' => array( 'page' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

    $page_articles_metabox->add_field( array(
        'name' => 'Articles Title',
        'id'   => CMB_PREFIX . 'page-articles-title',
        'type' => 'text',
        'default' => 'Articles'
    ) );

    $cats = get_categories();
    $page_cats = array( '' => '- select an article category -' );
    foreach ( $cats as $cat ) {
        $page_cats[$cat->slug] = $cat->name;
    }
    $page_articles_metabox->add_field( array(
        'name' => 'Articles',
        'id'   => CMB_PREFIX . 'page-articles',
        'type' => 'select',
        'options' => $page_cats
    ) );

}



// the output function
function the_page_articles( $posts_per_page = 3 ) {
    if ( has_cmb_value( 'page-articles' ) ) {
        print '<div class="page-articles">';
        print '<h2>' . get_cmb_value( 'page-articles-title') . '</h2>';
        print do_shortcode( '[articles cats="' . get_cmb_value('page-articles') . '" posts_per_page=' . $posts_per_page . ' /]' );
        print '</div>';
    }
}

