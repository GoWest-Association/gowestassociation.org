<?php



// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );



// let's create the function for the custom type
function agenda_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'agenda', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array(
			'labels' => array(
				'name' => __( 'Agendas', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Agenda', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Agendas', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Agenda', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Agenda', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Agenda', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Agenda', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Agendas', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the agendas.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-editor-ol', /* the icon for the custom post type menu */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'page',
			'hierarchical' => true,
			'rewrite' => array(
				'slug' => 'agenda'
			),
			'supports' => array( 'title', 'revisions', 'page-attributes' )
		) /* end of options */
	); /* end of register post type */
	
}


// adding the function to the Wordpress init
add_action( 'init', 'agenda_post_type');


// accordion metaboxes
add_action( 'cmb2_admin_init', 'agenda_metaboxes' );
function agenda_metaboxes() {

    global $colors;

    // area of interest information
    $agenda_metabox = new_cmb2_box( array(
        'id' => 'agenda',
        'title' => 'Agenda (Legacy)',
        'object_types' => array( 'agenda', 'event', 'page' ), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ) );

	/*
	$agenda_metabox->add_field( array(
        'name' => 'Timezone',
        'id'   => 'agenda-timezone',
        'type' => 'select',
		'options' => array(
			'pt' => 'Pacific Time',
			'mt' => 'Mountain Time',
		)
    ) );
    
	$agenda_metabox->add_field( array(
        'name' => 'Style',
        'id'   => 'agenda-style',
        'type' => 'select',
		'options' => array(
			'normal' => 'Normal',
			'slim' => 'Slim',
		),
		'default' => 'normal'
    ) );
    
	$agenda_metabox->add_field( array(
        'name' => 'Show Heading',
        'id'   => 'agenda-heading',
        'type' => 'checkbox',
		'default' => 'on'
    ) );
	*/
    
    $agenda_metabox_group = $agenda_metabox->add_field( array(
        'id' => 'agenda',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Agenda Item', 'cmb'),
            'remove_button' => __('Remove Agenda Item', 'cmb'),
            'group_title'   => __( 'Agenda Item {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $agenda_metabox->add_group_field( $agenda_metabox_group, array(
        'name' => 'Date/Time',
        'id'   => 'time',
        'type' => 'text_datetime_timestamp',
    ) );

    $agenda_metabox->add_group_field( $agenda_metabox_group, array(
        'name' => 'Location',
        'id'   => 'location',
        'type' => 'text',
    ) );

    $agenda_metabox->add_group_field( $agenda_metabox_group, array(
        'name' => 'Content',
        'id'   => 'content',
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 5,
        ),
    ) );

}


// shorten the wysiwygs in this section
add_action('admin_head', 'admin_styles');
function admin_styles() {
    if( get_post_type() == "agenda" ) {
	?>
	<style>
		.acf-editor-wrap iframe {
			height: 120px !important;
			min-height: 120px;
		}
	</style>
	<?php
	}
}


// output the agenda for the current post/page/event
function the_agenda() {
	print do_shortcode( '[agenda id="' . get_the_ID() . '" ]' );
}


// add a people shortcode
function agenda_shortcode( $atts ) {

	// set default params and override with those in shortcode
	extract( shortcode_atts( array(
		'slug' => '',
		'id' => 0,
		'show_title' => 0,
		'style' => ''
	), $atts ));

	// if we have a slug
	if ( !empty( $slug ) || !empty( $id ) ) {

		// if we have an ID, override
		if ( $id > 0 ) {

			// get the specific agenda by id
			$agenda = get_post( $id );

		} else {

			// get the agenda posts matching the slug
		    $agenda_posts = get_posts( array(
				'name' => $slug,
				'posts_per_page' => 1,
				'post_type' => 'agenda',
				'post_status' => 'publish'
		    ) );

		    // grab the first one
		    $agenda = $agenda_posts[0];
		}

	    // get the agenda items
	    $agenda_timezone = get_field( 'agenda-timezone', $agenda->ID );
	    $agenda_style = get_field( 'agenda-style', $agenda->ID );
	    $agenda_heading = get_field( 'agenda-heading', $agenda->ID );

		// get legacy values
	    $agenda_items = get_post_meta( $agenda->ID, 'agenda', 1 );

	    // empty content in case we don't have agenda items
	    $agenda_content = '<div class="agenda-container' . ( !empty( $agenda_style ) ? ' ' . $agenda_style : '' ) . '">';

	    // make sure we have agenda items
	    if ( !empty( $agenda_items ) || have_rows('item', $agenda->ID ) ) {

			$agenda_content .= '<div class="agenda-timezone">All times listed are <strong>' . ( $agenda_timezone == 'pt' ? 'Pacific' : 'Mountain' ) . '</strong>.</div>';

		    // start generating the agenda code
		    $agenda_content .= '<section class="agenda">';

			// if we're supposed to display the headers, do so
			if ( $agenda_heading ) {
				$agenda_content .='<div class="agenda-item agenda-heading">' . 
					'<div class="time">Date/Time</div>' .
					'<div class="location">Room Name</div>' .
					'<div class="content">Session Description/Speaker</div>' .
				'</div>';
			}

			// get and display the acf items
			if ( have_rows('item') ):
				while ( have_rows('item') ) : the_row();
					$time = get_sub_field( 'time' );
					$time = strtotime( $time );
					$datetime = get_ap_month( date( 'n', $time ) ) . ' ' .date( 'j', $time ) . ( !stristr( date( 'g:ia', $time ), '12:00am' ) ? ': ' : '' ) . str_replace( ':00', '', str_replace( '12:00am', "", date( 'g:ia', $time ) ) );
					$agenda_content .='<div class="agenda-item">' . 
						'<div class="time"><strong>' . $datetime . '</strong></div>' .
						'<div class="location">' . get_sub_field( 'location' ) . '</div>' .
						'<div class="content">' . get_sub_field( 'content' ) . '</div>' .
					'</div>';
				endwhile;
			else :
				// no rows found
			endif;

			// loop through and display the legacy items
			if ( !empty( $agenda_items ) ) {
				foreach ( $agenda_items as $item ) {
					$datetime = get_ap_month( date( 'n', $item['time'] ) ) . ' ' .date( 'j', $item['time'] ) . ( !stristr( date( 'g:ia', $item['time'] ), '12:00am' ) ? ': ' : '' ) . str_replace( ':00', '', str_replace( '12:00am', "", date( 'g:ia', $item['time'] ) ) );
					$agenda_content .='<div class="agenda-item">' . 
						'<div class="time"><strong>' . $datetime . '</strong></div>' .
						'<div class="location">' . ( isset( $item['location'] ) ? $item['location'] : '' ) . '</div>' .
						'<div class="content">' . apply_filters( 'the_content', $item['content'] ) . '</div>' .
					'</div>';
				}
			}

			// close the agenda div
			$agenda_content .='</section>';

	    }

		$agenda_content .= '</div>';
    }

	return $agenda_content;
}
add_shortcode( 'agenda', 'agenda_shortcode' );


// display month (by number) in AP style
function get_ap_month( $m ) {
	$months = array(
		1 => 'Jan.',
		2 => 'Feb.',
		3 => 'March',
		4 => 'April',
		5 => 'May',
		6 => 'June',
		7 => 'July',
		8 => 'Aug.',
		9 => 'Sept.',
		10 => 'Oct.',
		11 => 'Nov.',
		12 => 'Dec.',
	);
	return $months[$m];
}

