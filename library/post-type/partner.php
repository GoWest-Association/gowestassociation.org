<?php



// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function partner_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'partner', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Partners', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Partner', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Partners', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Partner', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Partner', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Partner', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Partner', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Partner', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the partner directory.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-businessperson', /* the icon for the custom post type menu */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => 'partner'
			),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
		) /* end of options */
	); /* end of register post type */
	
	// add post tags to our cpt
	// register_taxonomy_for_object_type( 'post_tag', 'partner' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'partner_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'partner_cat', 
	array('partner'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true, /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Partner Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Partner Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Partner Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All Partner Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Partner Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Partner Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Partner Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Partner Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Partner Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Partner Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
	)
);


// Partner metabox
add_action( 'cmb2_admin_init', 'partner_metaboxes' );
function partner_metaboxes() {

	// get all the article tags and put them in an array for a select field.
	$all_tags = get_tags();
	$select_tags = array(
		'' => '- no tag selected -'
	);
	foreach ( $all_tags as $a_tag ) {
		$select_tags[ $a_tag->slug ] = $a_tag->name;
	}

    // area of interest information
    $partner_box = new_cmb2_box( array(
        'id' => 'partner_info',
        'title' => 'Partner Details',
        'object_types' => array( 'partner' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $partner_box->add_field( array(
        'name' => 'Website',
        'id' => CMB_PREFIX . 'partner_website',
        'type' => 'text_medium'
    ) );
    $partner_box->add_field( array(
        'name' => 'Facebook',
        'id' => CMB_PREFIX . 'partner_facebook',
        'type' => 'text'
    ) );
    $partner_box->add_field( array(
        'name' => 'Twitter',
        'id' => CMB_PREFIX . 'partner_twitter',
        'type' => 'text'
    ) );
    $partner_box->add_field( array(
        'name' => 'Youtube',
        'id' => CMB_PREFIX . 'partner_youtube',
        'type' => 'text_medium'
    ) );
    $partner_box->add_field( array(
        'name' => 'LinkedIn',
        'id' => CMB_PREFIX . 'partner_linkedin',
        'type' => 'text_medium'
    ) );
    $partner_box->add_field( array(
        'name' => 'Featured Video',
        'id' => CMB_PREFIX . 'partner_video',
        'type' => 'text_medium'
    ) );
    $partner_box->add_field( array(
        'name' => 'Products Offered',
        'id' => CMB_PREFIX . 'partner_products',
        'type' => 'textarea'
    ) );
    $partner_box->add_field( array(
        'name' => 'Articles Tag',
        'id' => CMB_PREFIX . 'partner_tag',
        'type' => 'select',
        'default' => '',
        'options' => $select_tags
    ) );
    $partner_box->add_field( array(
        'name' => 'Sort',
        'id' => CMB_PREFIX . 'partner_sort',
        'type' => 'text_small',
        'default' => '99'
    ) );

    
}


// a small function to get all the artner categories
function get_all_partner_cats() {
	$partner_cats = get_categories('taxonomy=partner_cat&type=partner');

	// loop through them
	$return_cats = array(
		'' => '- select a group of partners -'
	);
	foreach ( $partner_cats as $pcat ) {
		$return_cats[$pcat->slug] = $pcat->name;
	}

	return $return_cats;
}


// a simple function to output a partner group using the shortcode
function do_partner_group( $group_name ) {

	// if we have a group
	if ( !empty( $group_name ) ) {

		print do_shortcode( '[partner category="' . $group_name . '" /]' );

	}
}


// retreive a partner social link as html
function partner_social_link( $network, $partner_id = 0 ) {
	if ( empty( $partner_id ) ) $partner_id = get_the_ID();
	if ( has_cmb_value( 'partner_' . $network, $partner_id ) ) {
		return '<a href="' . get_cmb_value( 'partner_' . $network ) . '" target="_blank"><img src="' . get_bloginfo( 'template_url' ) . '/img/social-partner-' . $network . '.png" class="social-icon" /></a>';
	}
}


// add a partner shortcode
function partners_shortcode( $atts ) {

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'category' => '',
		'link' => 1,
		'show_search' => 0,
		'show_org' => 1,
		'style' => 'list', // cards, list
		'exclude' => 0
	), $atts ));


	// set some query vars
	$vars = array( 
		"posts_per_page" => 200,
		"post_type" => 'partner',
		"orderby" => 'title',
		"order" => 'ASC'
	);

	// 
	if ( $exclude > 0 ) $vars['post__not_in'] = explode( ',', $exclude );

	if ( !empty( $category ) ) {
		$vars["tax_query"] = array(
	        array (
	            'taxonomy' => 'partner_cat',
	            'field' => 'slug',
	            'terms' => $category,
	        )
	    );
	}


	// run the query
    $p = new WP_Query( $vars );

    $partner_content = '<section class="people ' . $style . '">';

   	if ( $show_search ) {
		$partner_content .= '<div class="people-search"><input type="text" name="people-search-term" id="s" placeholder="Search Name, Academic Department, or Title"></div>';
	}

	if ( $p->have_posts() ) : 

		$partner_content .='<div class="people-listing">';

		// Start the Loop.
		while ( $p->have_posts() ) : $p->the_post();
			$post = get_the_ID();

			$partner_content .='<div class="person-entry visible">' . 
				'<div class="person-thumbnail">' . ( $link ? '<a href="' . get_the_permalink() . '">' : '' ) . get_the_post_thumbnail() . ( $link ? '</a>' : '' ) . "</div>" .
				'<div class="person-info">
					<h4>' . ( $link ? '<a href="' . get_the_permalink() . '">' : '' ) . get_cmb_value( "partner_fname" ) . ' ' . get_cmb_value( "partner_lname" ) . ( $link ? '</a>' : '' ) . '</h4>' .
					( has_cmb_value( 'partner_title' ) ? '<p class="person-title">' . get_cmb_value( "partner_title" ) . '</p>' : '' ) .
					( has_cmb_value( 'partner_organization' ) && $show_org ? '<p class="person-organization">' . get_cmb_value( "partner_organization" ) . '</p>' : '' ) .
					( has_cmb_value( 'partner_phone' ) ? '<p class="person-phone">Phone: ' . get_cmb_value( "partner_phone" ) . '</p>' : '' ) .
					( has_cmb_value( 'partner_tollfree' ) ? '<p class="person-tollfree">Toll-free: ' . get_cmb_value( "partner_tollfree" ) . '</p>' : '' ) .
					( has_cmb_value( 'partner_email' ) ? '<p class="person-email"><a href="mailto:' . get_cmb_value( "partner_email" ) . '">' . get_cmb_value( "partner_email" ) . '</a></p>' : '' ) .
					'<p class="person-excerpt">' . get_the_excerpt() . '</p>' .
					'<p class="person-bio-link"><a href="' . get_the_permalink() . '" class="btn navy">Learn More</a></p>
				</div>
			</div>';

		endwhile;

		$partner_content .="</div>";

	else :
		
		$partner_content .= '<p>No partners found in database.</p>';

	endif;

	$partner_content .='</section>';

	wp_reset_postdata();

	return $partner_content;
}
add_shortcode( 'partners', 'partner_shortcode' );



// add a partner shortcode
function partner_shortcode( $atts ) {

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'link' => true,
		'id' => '',
	), $atts ) );

	if ( !empty( $id ) ) {

		// set some query vars
		$person = get_post( $id );

	    $partner_content = '<section class="person-single">';

		$partner_content .='<div class="person-thumbnail">' . ( $link ? '<a href="' . get_the_permalink( $id ) . '">' : '') . get_the_post_thumbnail( $id ) . ( $link ? '</a>' : '') . '</div>' .
			'<div class="person-info">
				<h4>' . ( $link ? '<a href="' . get_the_permalink( $id ) . '">' : '') . get_cmb_value( "partner_fname", $id ) . ' ' . get_cmb_value( "partner_lname", $id ) . ( $link ? '</a>' : '') . '</h4>' .
					( has_cmb_value( 'partner_title', $id ) ? '<p class="person-title">' . get_cmb_value( "partner_title", $id ) . '</p>' : '' ) .
					( has_cmb_value( 'partner_organization', $id ) ? '<p class="person-organization">' . get_cmb_value( "partner_organization", $id ) . '</p>' : '' ) .

				'<p class="person-email"><a href="mailto:' . get_cmb_value( "partner_email", $id ) . '">' . get_cmb_value( "partner_email", $id ) . '</a></p>
			</div>';

		$partner_content .='</section>';

		wp_reset_postdata();

		return $partner_content;

	} else {
		return '';
	}
}
add_shortcode( 'partner', 'partner_shortcode' );


function do_sli() {
	add_action( 'template_redirect', function(){ global $sli; } );
}


function get_partner_cats() {
	return get_terms( 'partner_cat', array(
	    'hide_empty' => 0,
	) );
}


// partner
function get_partners() {

	// set some query vars
	$vars = array( 
		"posts_per_page" => 200,
		"post_type" => 'partner',
		"orderby" => 'title',
		"order" => 'ASC'
	);

	// run the query
    $p = new WP_Query( $vars );

    // start array
    $partners_arr = array();

	if ( $p->have_posts() ) : 

		// Start the Loop.
		while ( $p->have_posts() ) : $p->the_post();

			// get all post data
			global $post;

			// store this partner
			$partners_arr[] = $post;

		endwhile;

	endif;

	wp_reset_postdata();

	return $partners_arr;
}


