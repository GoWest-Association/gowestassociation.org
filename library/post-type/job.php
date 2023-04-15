<?php


// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function job_post_type() { 


	// creating (registering) the custom type 
	register_post_type( 'job', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 
			'labels' => array(
				'name' => __( 'Jobs', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Job', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Jobs', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Job', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Job', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Job', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Job', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Jobs', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => '',
				'delete_posts' => 'Delete Jobs'
			), /* end of arrays */
			'description' => __( 'Manage the jobs listed on the site.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-clipboard', /* the icon for the custom post type menu */
			'rewrite'	=> array( 
				'slug' => 'job', 
				'with_front' => false 
			), /* you can specify its url slug */
			'has_archive' => 'jobs', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'author' )
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type( 'post_tag', 'job' );	

}


// adding the function to the Wordpress init
add_action( 'init', 'job_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'job_cat', 
	array( 'job' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Job Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Job Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Job Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All Job Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Job Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Job Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Job Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Job Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Job Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Job Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 
			'slug' => 'jobs'
		)
	)
);



// add metabox(es)
function job_metaboxes( $meta_boxes ) {

	global $colors;

    // job metabox
    $job_metabox = new_cmb2_box( array(
        'id' => 'job_metabox',
        'title' => 'Job',
        'object_types' => array( 'job' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ));

    $job_metabox->add_field( array(
        'name' => 'Region',
        'id'   => CMB_PREFIX . 'job_region',
        'type' => 'text',
    ) );

    $job_metabox->add_field( array(
        'name' => 'Job Type',
        'id'   => CMB_PREFIX . 'job_type',
        'type' => 'select',
        'options' => array(
            'Staff' => 'Staff',
            'Management' => 'Management'
        ),
        'default' => 'Staff'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Credit Union',
        'id'   => CMB_PREFIX . 'job_company',
        'type' => 'text',
    ) );

    $job_metabox->add_field( array(
        'name' => 'Credit Union Summary',
        'id'   => CMB_PREFIX . 'job_company_description',
        'type' => 'wysiwyg',
        'options' => array( 'textarea_rows' => 7 )
    ) );

    $job_metabox->add_field( array(
        'name' => 'Contact Name',
        'id'   => CMB_PREFIX . 'job_contact_name',
        'type' => 'text'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Contact Email',
        'id'   => CMB_PREFIX . 'job_contact_email',
        'type' => 'text_email'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Contact Phone',
        'id'   => CMB_PREFIX . 'job_contact_phone',
        'type' => 'text'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Apply Email',
        'id'   => CMB_PREFIX . 'job_apply_email',
        'type' => 'text'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Apply Link',
        'id'   => CMB_PREFIX . 'job_apply_link',
        'type' => 'text'
    ) );

    $job_metabox->add_field( array(
        'name' => 'Job Expires',
        'id'   => CMB_PREFIX . 'job_expires',
        'type' => 'text_date',
        'date_format' => "Y-m-d"
    ) );

    $job_metabox->add_field( array(
        'name' => 'Job Creator',
        'id'   => CMB_PREFIX . 'job_creator',
        'type' => 'text'
    ) );

}
add_filter( 'cmb2_admin_init', 'job_metaboxes' );



// add capabilities
function add_job_caps() {

    // gets the author role
    $role = get_role( 'administrator' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'read_job' );
    $role->add_cap( 'edit_job' );
    $role->add_cap( 'delete_job' );
    $role->add_cap( 'edit_jobs' );
    $role->add_cap( 'edit_others_jobs' );
    $role->add_cap( 'publish_jobs' );
    $role->add_cap( 'read_private_jobs' );
    $role->add_cap( 'edit_private_jobs' );
    $role->add_cap( 'edit_published_jobs' );

}
add_action( 'admin_init', 'add_job_caps');



// check if user owns job
function user_owns_job( $post_id ) {

	// empty email variable in case not logged in
	$email = '';

	// check if they're logged in via salesforce
	if ( isset( $_SESSION['sf_user']['email'] ) ) {
		$email = $_SESSION['sf_user']['email'];

	// check if they're logged into wordpress
	} else if ( is_user_logged_in() ) {
		$the_user = wp_get_current_user();
		$email = $the_user->data->user_email;
	}

	// if the job creator matches or if the wordpress user is an administrator
	if ( get_cmb_value( 'job_creator', $post_id ) == $email || current_user_can( 'administrator' ) ) {
		return true;
	}

	// if no response yet, return false
	return false;
}



// edit job form
function edit_job_form() {
	global $post;

	// if the current user (sf or wp) owns the job
	if ( user_owns_job( $post->ID ) ) {

		$fields = array(
			'job_title' => $post->post_title,
			'job_company' => get_cmb_value( 'job_company' ),
			'job_contact_name' => get_cmb_value( 'job_contact_name' ),
			'job_contact_email' => get_cmb_value( 'job_contact_email' ),
			'job_contact_phone' => get_cmb_value( 'job_contact_phone' ),
			'job_region' => get_cmb_value( 'job_region' ),
			'job_company_description' => get_cmb_value( 'job_company_description' ),
			'job_short_description' => $post->post_excerpt,
			'job_full_description' => $post->post_content,
			'job_apply_email' => get_cmb_value( 'job_apply_email' ),
			'job_apply_link' => get_cmb_value( 'job_apply_link' ),
			'job_expires' => get_cmb_value( 'job_expires' ),
			'edit_job_id' => $post->ID
		);

		//actual form
		gravity_form( 13, true, false, false, $fields );

	}
}


// when a user submits the job editor form
add_action( 'gform_after_submission_20', 'update_job', 10, 2 );
function update_job( $entry, $form ) {
 	
 	// store the post ID
 	$post_id = $entry[29];

	// if the current user owns the job
 	if ( user_owns_job( $post_id ) ) {

		// let's assemble some post data
	 	$post_fields = array(
	 		'ID' => $post_id,
	 		'post_title' => $entry[30],
	 		'post_excerpt' => $entry[31],
	 		'post_content' => $entry[32]
	 	);

	    wp_update_post( $post_fields );

	    // update the post meta data
		update_post_meta( $post_id, '_p_job_company', $entry[33] );
		update_post_meta( $post_id, '_p_job_company_description', $entry[23] );
		update_post_meta( $post_id, '_p_job_contact_name', $entry[34] );
		update_post_meta( $post_id, '_p_job_contact_email', $entry[35] );
		update_post_meta( $post_id, '_p_job_contact_phone', $entry[37] );
		update_post_meta( $post_id, '_p_job_region', $entry[38] );
		update_post_meta( $post_id, '_p_job_apply_email', $entry[39] );
		update_post_meta( $post_id, '_p_job_apply_link', $entry[40] );
		update_post_meta( $post_id, '_p_job_expires', date( 'Y-m-d', strtotime( $entry[41] ) ) );

	}

 	$the_post = get_post( $post_id );
 	wp_redirect( '/job/' . $the_post->post_name );

}


// list a specific job category
function list_job_category( $category ) {

	// select the areas of interest in the category
	$areas = get_job_category( $category );

	// count em
	$area_count = count( $areas );

	// determine what a quarter of the total records is so we can make columns
	$quarter = ceil( $area_count / 4 );

	// loop through the post results
	$num = 1;
	foreach ( $areas as $area ) {
		if ( $num == 1 || $num == $quarter+1 || $num == ( $quarter * 2 )+1 || $num == ( $quarter * 3 )+1 ) {
			?>
	<ul class="column<?php print ( $num == 1 ? ' one' : '' ); print ( $num == $quarter+1 ? ' two' : '' ); print ( $num == ($quarter*2)+1 ? ' three' : '' ); print ( $num == ($quarter*3)+1 ? ' four' : '' ); ?>">
			<?php
		}
		?>
		<li><a href="/area/<?php print $area->post_name ?>"><?php print $area->post_title; ?></a></li>
		<?php 
		if ( $num == $quarter || $num == ( $quarter * 2 ) || $num == ( $quarter * 3 ) || $num == $area_count ) {
			?>
	</ul>
			<?php
		}
		$num++;
	}
	?>
	<?php
	
	// reset the post data
	wp_reset_postdata();

}


// get the jobs in a particular category
function get_job_category( $category ) {
	global $wpdb;

	// Count custom post type by custom taxonomy
	$sql = "SELECT * FROM $wpdb->posts p
	JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id)
	JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'job_cat')
	JOIN $wpdb->terms t ON (tt.term_id = t.term_id AND t.slug = '$category' )
	WHERE p.post_type = 'job'
	AND (p.post_status = 'publish')
	AND p.post_date < NOW() ORDER BY p.post_title;";

	$rows = $wpdb->get_results( $sql );

	return $rows;
}



// job category list
function the_job_category_list() {

	$taxonomy = 'job_cat';
	$tax_terms = get_terms( $taxonomy );
	foreach ( $tax_terms as $tax_term ) { 
		$term_id = $tax_term->term_id;
		$category_info = Taxonomy_MetaData::get( $taxonomy, $term_id );
		?>
		<a href="<?php print esc_attr( get_term_link( $tax_term, $taxonomy ) ); ?>"><div class="solution bg-<?php print $category_info['color'] ?>">
			<div class="solution-icon">
				<img src="<?php print $category_info['icon'] ?>">
			</div>
			<h3><?php print $tax_term->name ?></h3>
		</div></a>
		<?php
	}

}



// get job category list (array)
function get_job_categories() {
	return get_terms( 'job_cat' );
}



// job listing
function the_job_list( $jobs = '', $random = false ) {

    $args = array( 'post_type' => 'job', 'posts_per_page' => 30 );
    if ( !empty( $jobs ) ) {
    	$args[ 'post__in' ] = $jobs;
    }
    if ( $random ) {
    	$args[ 'orderby' ] = 'rand';
    }
    $loop = new WP_Query( $args );
    $jobs = array();
    while ( $loop->have_posts() ) : $loop->the_post();
    	global $post;
        $jobs[get_the_ID()] = $post;
        $jobs[get_the_ID()]->icon = get_cmb_value( 'job_icon' );
        ?><a href="/job/<?php print $post->post_name ?>"><div class="job bg-<?php print get_cmb_value( 'large-title-color' ) ?>">
				<div class="job-icon">
					<img src="<?php print get_cmb_value( 'large-title-icon' ) ?>">
				</div>
				<h3><?php print get_the_title() ?></h3>
			</div></a><?php
    endwhile;
    wp_reset_query();

}


add_filter( 'gform_field_value_salesforce_user', 'populate_salesforce_user' );
function populate_salesforce_user( $value ) {

	if ( isset( $_SESSION['sf_user']['email'] ) ) {

		// if it's a salesforce user, get the email
		return $_SESSION['sf_user']['email'];

	} else if ( is_user_logged_in() ) {

		// if it's a wordpress user
		$the_user = wp_get_current_user();
		return $the_user->data->user_email;

	}

	// otherwise, return nothing
    return '';

}


// enable the excerpt field in advanced post creation plugin
add_filter( 'gform_advancedpostcreation_excerpt', 'enable_excerpt', 10, 1 );
function enable_excerpt( $enable_excerpt ){
    return true;
}


function jobs_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'jobs_excerpt_length', 999 );

