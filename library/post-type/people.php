<?php



// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function people_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'people', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'People', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'People', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All People', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Person', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Person', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Person', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Person', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search People', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the people directory.', 'ptheme' ), /* Custom Type Description */
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
				'slug' => 'bio'
			),
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions' )
		) /* end of options */
	); /* end of register post type */
	
	// add post tags to our cpt
	register_taxonomy_for_object_type( 'post_tag', 'people' );
	
}


// adding the function to the Wordpress init
add_action( 'init', 'people_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'people_cat', 
	array('people'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'People Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'People Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search People Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All People Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent People Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent People Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit People Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update People Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New People Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New People Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
	)
);


// People metabox
add_action( 'cmb2_admin_init', 'person_metaboxes' );
function person_metaboxes() {

    // area of interest information
    $person_box = new_cmb2_box( array(
        'id' => 'person_info',
        'title' => 'Person Details',
        'object_types' => array( 'people' ), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );
    $person_box->add_field( array(
        'name' => 'First Name',
        'id' => CMB_PREFIX . 'person_fname',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Last Name',
        'id' => CMB_PREFIX . 'person_lname',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Title',
        'id' => CMB_PREFIX . 'person_title',
        'type' => 'text'
    ) );
    $person_box->add_field( array(
        'name' => 'Organization',
        'id' => CMB_PREFIX . 'person_organization',
        'type' => 'text'
    ) );
    $person_box->add_field( array(
        'name' => 'Office Number',
        'id' => CMB_PREFIX . 'person_office',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Phone Number',
        'id' => CMB_PREFIX . 'person_phone',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Phone Number (Toll-free)',
        'id' => CMB_PREFIX . 'person_tollfree',
        'type' => 'text_medium'
    ) );
    $person_box->add_field( array(
        'name' => 'Email Address',
        'id' => CMB_PREFIX . 'person_email',
        'type' => 'text_email'
    ) );
    $person_box->add_field( array(
        'name' => 'Website',
        'id' => CMB_PREFIX . 'person_website',
        'type' => 'text',
        'desc' => 'Include the Full URL (including "http(s)") to this People members website.'
    ) );
    $person_box->add_field( array(
        'name' => 'CV/Resume',
        'id' => CMB_PREFIX . 'person_cv',
        'type' => 'file',
        'desc' => 'Upload a CV/Resume file.'
    ) );
    
    $people_cats = get_terms( 'people_cat' );
    $groups = array( '' => '- select a group -' );
    foreach ( $people_cats as $cat ) {
        $groups[$cat->slug] = $cat->name;
    }
    $person_box->add_field( array(
        'name' => 'Bio Group',
        'desc' => 'Select the people group that should be displayed on this persons bio page.',
        'id' => CMB_PREFIX . 'person_group',
        'type' => 'select',
        'options' => $groups
    ) );
    $person_box->add_field( array(
        'name' => 'Facebook',
        'id' => CMB_PREFIX . 'person_facebook',
        'type' => 'text',
    ) );
    $person_box->add_field( array(
        'name' => 'Twitter',
        'id' => CMB_PREFIX . 'person_twitter',
        'type' => 'text',
    ) );
    $person_box->add_field( array(
        'name' => 'Instagram',
        'id' => CMB_PREFIX . 'person_instagram',
        'type' => 'text',
    ) );
    $person_box->add_field( array(
        'name' => 'Youtube',
        'id' => CMB_PREFIX . 'person_youtube',
        'type' => 'text',
    ) );
    $person_box->add_field( array(
        'name' => 'LinkedIn',
        'id' => CMB_PREFIX . 'person_linkedin',
        'type' => 'text',
    ) );

}


// a small function to get all the people categories
function get_all_people_cats() {
	$people_cats = get_categories('taxonomy=people_cat&type=people');

	// loop through them
	$return_cats = array(
		'' => '- select a group of people -'
	);
	foreach ( $people_cats as $pcat ) {
		$return_cats[$pcat->slug] = $pcat->name;
	}

	return $return_cats;
}


// a simple function to output a people group using the shortcode
function do_people_group( $group_name ) {

	// if we have a group
	if ( !empty( $group_name ) ) {

		print do_shortcode( '[people category="' . $group_name . '" /]' );

	}

}


// add a people shortcode
function people_shortcode( $atts ) {

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
		"post_type" => 'people',
		"orderby" => 'meta_value',
		"meta_key" => CMB_PREFIX . 'person_lname',
		"order" => 'ASC'
	);

	// exclude specific posts
	if ( $exclude > 0 ) $vars['post__not_in'] = explode( ',', $exclude );

	if ( !empty( $category ) ) {
		$vars["tax_query"] = array(
	        array (
	            'taxonomy' => 'people_cat',
	            'field' => 'slug',
	            'terms' => $category,
	            'include_children' => false
	        )
	    );
	}


	// run the query
    $p = new WP_Query( $vars );

    $people_content = '<section class="people ' . $style . '">';

   	if ( $show_search ) {
		$people_content .= '<div class="people-search"><input type="text" name="people-search-term" id="s" placeholder="Search Name, Academic Department, or Title"></div>';
	}

	if ( $p->have_posts() ) : 

		$people_content .='<div class="people-listing">';

		// Start the Loop.
		while ( $p->have_posts() ) : $p->the_post();
			$post = get_the_ID();

			$people_content .='<div class="person-entry visible">' . 
				'<div class="person-thumbnail">' . ( $link ? '<a href="' . get_the_permalink() . '">' : '' ) . get_the_post_thumbnail() . ( $link ? '</a>' : '' ) . "</div>" .
				'<div class="person-info">
					<h4>' . ( $link ? '<a href="' . get_the_permalink() . '">' : '' ) . get_cmb_value( "person_fname" ) . ' ' . get_cmb_value( "person_lname" ) . ( $link ? '</a>' : '' ) . '</h4>' .
					( has_cmb_value( 'person_title' ) ? '<p class="person-title">' . get_cmb_value( "person_title" ) . '</p>' : '' ) .
					( has_cmb_value( 'person_organization' ) && $show_org ? '<p class="person-organization">' . get_cmb_value( "person_organization" ) . '</p>' : '' ) .
					( $style != 'list-simple' ?
					( has_cmb_value( 'person_phone' ) ? '<p class="person-phone">Phone: ' . get_cmb_value( "person_phone" ) . '</p>' : '' ) .
					( has_cmb_value( 'person_tollfree' ) ? '<p class="person-tollfree">Toll-free: ' . get_cmb_value( "person_tollfree" ) . '</p>' : '' ) .
					( has_cmb_value( 'person_email' ) ? '<p class="person-email"><a href="mailto:' . get_cmb_value( "person_email" ) . '">' . get_cmb_value( "person_email" ) . '</a></p>' : '' ) .
					'<p class="person-excerpt">' . get_the_excerpt() . '</p>' .
					'<p class="person-bio-link"><a href="' . get_the_permalink() . '" class="btn navy">Learn More</a></p>' : '' ) .
				.</div>
			</div>';

		endwhile;

		$people_content .="</div>";

	else :
		
		$people_content .= '<p>No people found in database.</p>';

	endif;

	$people_content .='</section>';

	wp_reset_postdata();

	return $people_content;
}
add_shortcode( 'people', 'people_shortcode' );



// add a person shortcode
function person_shortcode( $atts ) {

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'link' => true,
		'id' => '',
	), $atts ) );

	if ( !empty( $id ) ) {

		// set some query vars
		$person = get_post( $id );

	    $person_content = '<section class="person-single">';

		$person_content .='<div class="person-thumbnail">' . ( $link ? '<a href="' . get_the_permalink( $id ) . '">' : '') . get_the_post_thumbnail( $id ) . ( $link ? '</a>' : '') . '</div>' .
			'<div class="person-info">
				<h4>' . ( $link ? '<a href="' . get_the_permalink( $id ) . '">' : '') . get_cmb_value( "person_fname", $id ) . ' ' . get_cmb_value( "person_lname", $id ) . ( $link ? '</a>' : '') . '</h4>' .
					( has_cmb_value( 'person_title', $id ) ? '<p class="person-title">' . get_cmb_value( "person_title", $id ) . '</p>' : '' ) .
					( has_cmb_value( 'person_organization', $id ) ? '<p class="person-organization">' . get_cmb_value( "person_organization", $id ) . '</p>' : '' ) .

				'<p class="person-email"><a href="mailto:' . get_cmb_value( "person_email", $id ) . '">' . get_cmb_value( "person_email", $id ) . '</a></p>
			</div>';

		$person_content .='</section>';

		wp_reset_postdata();

		return $person_content;

	} else {
		return '';
	}
}
add_shortcode( 'person', 'person_shortcode' );


