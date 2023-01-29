<?php


// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'flush_rewrite_rules' );


// set up the event brand options
global $event_brands;
$event_brands = array(
	'general' => 'General',
	'az' => 'Arizona',
	'co' => 'Colorado',
	'id' => 'Idaho',
	'or' => 'Oregon',
	'wa' => 'Washington',
	'wy' => 'Wyoming',
	'cuna' => 'CUNA GAC',
);


// let's create the function for the custom type
function event_post_type() { 

	// creating (registering) the custom type 
	register_post_type( 'event', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 
			'labels' => array(
				'name' => __( 'Events', 'ptheme' ), /* This is the Title of the Group */
				'singular_name' => __( 'Event', 'ptheme' ), /* This is the individual type */
				'all_items' => __( 'All Events', 'ptheme' ), /* the all items menu item */
				'add_new' => __( 'Add New', 'ptheme' ), /* The add new menu item */
				'add_new_item' => __( 'Add New Event', 'ptheme' ), /* Add New Display Title */
				'edit' => __( 'Edit', 'ptheme' ), /* Edit Dialog */
				'edit_item' => __( 'Edit Event', 'ptheme' ), /* Edit Display Title */
				'new_item' => __( 'New Event', 'ptheme' ), /* New Display Title */
				'view_item' => __( 'View Event', 'ptheme' ), /* View Display Title */
				'search_items' => __( 'Search Event', 'ptheme' ), /* Search Custom Type Title */ 
				'not_found' =>  __( 'Nothing found in the database.', 'ptheme' ), /* This displays if there are no entries yet */ 
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ptheme' ), /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Manage the events listed on the site.', 'ptheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-calendar-alt', /* the icon for the custom post type menu */
			'rewrite'	=> array( 
				'slug' => 'event', 
				'with_front' => false 
			), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
		) /* end of options */
	); /* end of register post type */

	// register_taxonomy_for_object_type( 'category', 'event' );	
	
}


// adding the function to the Wordpress init
add_action( 'init', 'event_post_type');



// now let's add custom categories (these act like categories)
register_taxonomy( 'event_cat', 
	array( 'event' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Event Categories', 'ptheme' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Event Category', 'ptheme' ), /* single taxonomy name */
			'search_items' =>  __( 'Search Event Categories', 'ptheme' ), /* search title for taxomony */
			'all_items' => __( 'All Event Categories', 'ptheme' ), /* all title for taxonomies */
			'parent_item' => __( 'Parent Event Category', 'ptheme' ), /* parent title for taxonomy */
			'parent_item_colon' => __( 'Parent Event Category:', 'ptheme' ), /* parent taxonomy title */
			'edit_item' => __( 'Edit Event Category', 'ptheme' ), /* edit custom taxonomy title */
			'update_item' => __( 'Update Event Category', 'ptheme' ), /* update title for taxonomy */
			'add_new_item' => __( 'Add New Event Category', 'ptheme' ), /* add new title for taxonomy */
			'new_item_name' => __( 'New Event Category Name', 'ptheme' ) /* name title for taxonomy */
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false
	)
);



// event metabox(es)
function event_metaboxes( $meta_boxes ) {

	global $event_brands;

    // event metabox
    $event_metabox = new_cmb2_box( array(
        'id' => 'event_metabox',
        'title' => 'Event',
        'object_types' => array( 'event' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $event_metabox->add_field( array(
        'name' => 'Branding',
        'id'   => CMB_PREFIX . 'event_branding',
        'type' => 'select',
        'default' => 'general',
        'options' => $event_brands
    ) );

    $event_metabox->add_field( array(
        'name' => 'Start Date/Time',
        'id'   => CMB_PREFIX . 'event_start',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Start Daylight/Standard Time',
        'id'   => CMB_PREFIX . 'event_start_dt',
        'type' => 'radio',
        'options' => array(
        	'DT' => 'Daylight',
        	'ST' => 'Standard'
        ),
        'default' => 'st'
    ) );

    $event_metabox->add_field( array(
        'name' => 'End Date/Time',
        'id'   => CMB_PREFIX . 'event_end',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'End Daylight/Standard Time',
        'id'   => CMB_PREFIX . 'event_end_dt',
        'type' => 'radio',
        'options' => array(
        	'DT' => 'Daylight',
        	'ST' => 'Standard'
        ),
        'default' => 'st'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Event Website',
        'id'   => CMB_PREFIX . 'event_website',
        'desc' => 'If populated, links from the calendar/listings will go directly to this URL instead of the event page on this website.',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Do not link from calendar.',
        'id'   => CMB_PREFIX . 'event_nolink',
        'type' => 'checkbox',
    ) );

    $event_metabox->add_field( array(
        'name' => 'Early Bird Deadline',
        'id'   => CMB_PREFIX . 'event_early_date',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Late Registration Date',
        'id'   => CMB_PREFIX . 'event_late_date',
        'type' => 'text_datetime_timestamp'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Pricing Coming Soon',
        'id'   => CMB_PREFIX . 'event_pricing_upcoming',
        'type' => 'checkbox'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Early Bird Price',
        'id'   => CMB_PREFIX . 'event_early_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Regular Price',
        'id'   => CMB_PREFIX . 'event_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Late Registration Price',
        'id'   => CMB_PREFIX . 'event_late_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Early Bird Price (Small CU)',
        'id'   => CMB_PREFIX . 'event_small_early_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Regular Price (Small CU)',
        'id'   => CMB_PREFIX . 'event_small_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Late Registration Price (Small CU)',
        'id'   => CMB_PREFIX . 'event_small_late_price',
        'type' => 'text_money'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Registration Button Text',
        'id'   => CMB_PREFIX . 'event_registration_text',
        'desc' => 'Registration Link',
        'type' => 'text',
        'default' => 'Register Now'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Registration Button Link',
        'id'   => CMB_PREFIX . 'event_registration',
        'desc' => 'Registration Link',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Call to Action Note',
        'id'   => CMB_PREFIX . 'event_cta_intro',
        'type' => 'wysiwyg',
        'options' => array(
			'textarea_rows' => 4,
		),
    ) );

    $event_metabox->add_field( array(
        'name' => 'Call to Action #1 Text',
        'id'   => CMB_PREFIX . 'event_cta1_text',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Call to Action #1 Link',
        'id'   => CMB_PREFIX . 'event_cta1_link',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Call to Action #2 Text',
        'id'   => CMB_PREFIX . 'event_cta2_text',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Call to Action #2 Link',
        'id'   => CMB_PREFIX . 'event_cta2_link',
        'type' => 'text'
    ) );

    $event_metabox->add_field( array(
        'name' => 'Location Description',
        'id'   => CMB_PREFIX . 'event_location_text',
        'type' => 'wysiwyg',
        'options' => array(
			'textarea_rows' => 5,
		),
    ) );

    $event_metabox->add_field( array(
        'name' => 'Connect With Us Title',
        'id'   => CMB_PREFIX . 'event_connect_title',
        'desc' => 'If populated, and the ad group is selected, this shows above the ads.',
        'type' => 'text'
    ) );

    $people_groups = get_all_people_cats();
    $event_metabox->add_field( array(
        'name' => 'People Group',
        'desc' => 'Select a group of people for the sidebar (if empty, no group will be displayed).',
        'id' => CMB_PREFIX . 'people_group',
        'type' => 'select',
        'options' => $people_groups 
    ) );

    $event_metabox->add_field( array(
        'name' => 'Ad/Sponsor Title',
        'id'   => CMB_PREFIX . 'event_ad_title',
        'desc' => 'If populated, and the ad group is selected, this shows above the ads.',
        'type' => 'text'
    ) );

    $ad_groups = array_merge( array(
        '0' => '- select an ad group -',
    ), get_ad_groups() );
    $event_metabox->add_field( array(
        'name' => 'Ad Group',
        'desc' => 'Select an ad group for the sidebar ad (if empty, no group will be displayed).',
        'id' => CMB_PREFIX . 'ad_group',
        'type' => 'select',
        'options' => $ad_groups 
    ) );

}
add_filter( 'cmb2_admin_init', 'event_metaboxes' );


// event url rewrite rules
add_action('init','event_rewrite_rules');
function event_rewrite_rules(){
    // Replace custom_post_type_slug with the slug of your custom post type
    add_rewrite_rule( 
		'^events/([^/]*)/([^/]*)/([^/]*)?', 
		"index.php?post_type=event", 
		'top'
	);
	add_rewrite_rule( 
		'^events/([^/]*)/([^/]*)/?', 
		"index.php?post_type=event", 
		'top'
	);
	add_rewrite_rule( 
		'^events/([^/]*)/?', 
		"index.php?post_type=event", 
		'top'
	);
}


// get the url parts from the request_uri
function get_url_parts() {

	// get the request uri
	$url = str_replace( '/events/', '', $_SERVER['REQUEST_URI'] );

	// split it and return it
	return explode( '/', $url );

}


// parse the event url and determine defaults if we don't have all we need
function parse_events_url() {

	// make our globals
	global $event_cat, $event_yr, $event_mo, $event_mo_name;

	// get url parts
	$url_parts = get_url_parts();

	// if we have a year
	if ( !empty( $url_parts[0] ) ) {
		$event_cat = $url_parts[0] ;
	}
	if ( !isset( $event_cat ) ) {
		// or set to all categories
		$event_cat = 'all';
	}

	// if we have a year
	if ( !empty( $url_parts[1] ) ) {
		$event_yr = $url_parts[1];
	} else { 
		// or current year
		$event_yr = date( 'Y' );
	}

	// if we have a month
	if ( !empty( $url_parts[2] ) ) {
		$event_mo = $url_parts[2];
		$event_mo_name = date( 'M', strtotime( $event_yr . '-' . $event_mo . '-01' ) );
	} else {
		// or current month
		$event_mo = date( 'n' );
		$event_mo_name = date( 'M' );
	}

}


// checks an event url to see if it's got all the required parameters, and redirect it if not.
function check_events_url() {

	// make our globals
	global $event_cat, $event_yr, $event_mo, $event_mo_name;

	// get the request uri parts
	$url_parts = get_url_parts();

	// parse the existing url
	parse_events_url();

	// verify that we have 
	if ( !isset( $url_parts[1] ) || !isset( $url_parts[2] ) || !isset( $url_parts[3] ) ) {
		
		// redirect to the defaults we set with parse_events_url function above
		wp_redirect( '/events/' . $event_cat . '/' . $event_yr . '/' . $event_mo . '/' );

	}

}


// function to get the event registration button
function get_registration_button( $event_id = 0 ) {
	
	// get the current post ID if we don't have one
	if ( $event_id == 0 ) $event_id = get_the_ID();

	$event_reg_text = get_cmb_value( 'event_registration_text', $event_id );
	$event_reg_link = get_cmb_value( 'event_registration', $event_id );

	// if the event text isn't set or is empty, set a default
	if ( empty( $event_reg_text ) ) $event_reg_text = 'Register Now';

	if ( !empty( $event_reg_link ) ) {
		return '<a href="' . $event_reg_link . '" class="btn green">' . $event_reg_text . '</a>';
	}

}
add_shortcode( 'event-registration-button', 'get_registration_button' );


// get the events for a given month
function get_month_events( $m, $y, $category='all' ) {

	$timestamp_start = mktime( 0, 0, 0, $m, 1, $y );
	$timestamp_end = mktime( 23, 59, 59, $m, date( 't', $timestamp_start ), $y );
	$timestamp_today = time();

	$args = array(
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'relation' => 'AND',
				array(
					'key' => '_p_event_start',
					'value' => $timestamp_start,
					'compare' => '>='
				),
				array(
					'key' => '_p_event_start',
					'value' => $timestamp_end,
					'compare' => '<='
				)
			),
			array(
				'relation' => 'AND',
				array(
					'key' => '_p_event_end',
					'value' => $timestamp_start,
					'compare' => '>='
				),
				array(
					'key' => '_p_event_end',
					'value' => $timestamp_end,
					'compare' => '<='
				)
			),
		),
		'post_type' => 'event',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => '_p_event_start',
		'posts_per_page' => 100
	);

	if ( $category != 'all' ) {
		$args[ 'event_cat' ] = $category;
	} /*
	else {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'event_cat',
				'field'    => 'slug',
				'terms'    => 'exclude',
				'operator' => 'NOT IN',
			),
		);
	}
	*/

	$event_query = new WP_Query( $args );
	$events = $event_query->get_posts();

	foreach ( $events as $key => $event ) {
		$event_info = array();
		$event_info = get_post_custom( $event->ID );

		foreach ( $event_info as $info_key => $info_item ) {		
			$events[$key]->$info_key = $info_item[0];
		}
	}

	wp_reset_query();
	
	return $events;

}


// get upcoming events based on optional category
function get_upcoming_events( $limit, $category = 0 ) {

	$timestamp_start = mktime( 0, 0, 0 );

	$args = array(
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => '_p_event_start',
				'value' => $timestamp_start,
				'compare' => '>='
			)
		),
		'post_type' => 'event',
		'orderby' => 'meta_value_num',
		'meta_key' => '_p_event_start',
		'order' => 'ASC',
		'posts_per_page' => $limit
	);

	if ( !empty( $category ) ) {
		$categories = explode( ',', $category );
		if ( is_string( $categories[0] ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'event_cat',
					'field' => 'slug',
					'terms' => $categories
				)
			);
		} else {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'event_cat',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}
	} /*
	else {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'event_cat',
				'field'    => 'slug',
				'terms'    => 'exclude',
				'operator' => 'NOT IN',
			),
		);
	}
	*/

	$event_query = new WP_Query( $args );
	$events = $event_query->get_posts();

	foreach ( $events as $key => $event ) {
		$event_info = array();
		$event_info = get_post_custom( $event->ID );

		foreach ( $event_info as $info_key => $info_item ) {		
			$events[$key]->$info_key = $info_item[0];
		}
	}

	wp_reset_query();
	
	return $events;

}


// determine the previous month
function get_previous_month( $month, $year ) {
	if ( $month == 1 ) {
		return array( 'month' => 12, 'year' => $year-1 );
	} else {
		return array( 'month' => $month-1, 'year' => $year );
	}
}


// determine the next month
function get_next_month( $month, $year ) {
	if ( $month == 12 ) {
		return array( 'month' => 1, 'year' => $year+1 );
	} else {
		return array( 'month' => $month+1, 'year' => $year );
	}
}


// show month events
function show_month_events( $month, $year, $category = 'all' ) {

	$event_base_url = "/events/";

	// let's make an empty calendar
	$calendar = '';

	// get the events for the month.
	$events = get_month_events( $month, $year, $category );

	// show next and previous month links.
	$prev = get_previous_month( $month, $year );
	$prev_ts = mktime( 0, 0, 0, $prev['month'], 1, $prev['year'] );
	$next = get_next_month( $month, $year );
	$next_ts = mktime( 0, 0, 0, $next['month'], 1, $next['year'] );

	// open the table tags
	$calendar .= '<div class="calendar-container"><div class="calendar-grid">';

	// add the prev and next buttons to switch months
	$calendar .= '<a href="' . $event_base_url . $category . '/' . $prev['year'] . '/' . $prev['month'] . '/" class="month-nav previous">&lt; Prev</a>';
	$calendar .= '<a href="' . $event_base_url . $category . '/' . $next['year'] . '/' . $next['month'] . '/" class="month-nav next">Next &gt;</a>';

	// get the month name based on the month and year passed
	$month_name = date( 'M', strtotime( $year . '-' . $month . '-01' ) );

	// month name
	$calendar .= '<h4>' . $month_name . " " . $year . '</h4>';

	// begin the table
	$calendar .= '<table cellpadding="0" cellspacing="0" class="calendar">';

	// day titles
	$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings ) . '</td></tr>';

	// days and weeks vars now ...
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	// row for week one
	$calendar .= '<tr class="calendar-row">';

	// print "blank" days until the first of the current week
	for ( $x = 0; $x < $running_day; $x++ ) :
		$calendar .= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	// keep going with days....
	for ( $list_day = 1; $list_day <= $days_in_month; $list_day++ ) :

		// let's check the start and end of the day
		$day_start = mktime( 0, 0, 0, $month, $list_day, $year );
		$day_end = mktime( 23, 59, 59, $month, $list_day, $year );

		// loop through all the events and list them for this day.
		$day_events = '';
		foreach ( $events as $event ) {
			if ( ( $event->_p_event_start > $day_start && $event->_p_event_start < $day_end ) || 
				 ( $event->_p_event_end > $day_start && $event->_p_event_end < $day_end ) /* || 
				 ( $event->_p_event_start < $day_start && $event->_p_event_end > $day_end ) */ ) {
				$day_events .= 'event';
			}
		}

		// start building out the day.
		$calendar .= '<td class="calendar-day' . ( !empty( $day_events ) ? ' has-events' : '' ) . '" data-day="' . $month . '-' . $list_day . '">' . $list_day . '</td>';

		// end row if it's the end of the week.
		if ( $running_day == 6 ) :
			$calendar .= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar .= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;

	endfor;

	// finish the rest of the days in the week
	if ( $days_in_this_week < 8 ) :
		for ( $x = 1; $x <= ( 8 - $days_in_this_week ); $x++ ) :
			$calendar .= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	// end final row
	$calendar .= '</tr>';

	// close the table
	$calendar .= '</table>';

	// get the category dropdown
	$event_categories = get_terms(array(
		'taxonomy' => 'event_cat',
		'hide_empty' => true,
	));

	$calendar .= '<div class="event-category-switcher-container"><label for="event-category-switcher">Event Category</label><select name="event-category-switcher" class="event-category-switcher">';
	$calendar .= '<option value="/events/all/' . $year . '/' . $month . '/"' . ( $category == 'all' ? ' selected' : '' ) . '>- All Categories -</option>';
foreach ( $event_categories as $event_category ) {
		$calendar .= '<option value="/events/' . $event_category->slug . '/' . $year . '/' . $month . '/"' . ( $event_category->slug == $category ? ' selected' : '' ) . '>' . 
			$event_category->name . 
			'</option>';
	}
	$calendar .= '</select></div>';
	
	// close the grid container
	$calendar .= '</div>';

	// loop through all the events and list them for this day.
	$events_list = '';
	if ( !empty( $events ) ) {
		foreach ( $events as $event ) {
			$show_times = ( date( "g:ia", $event->_p_event_start ) != '12:00am' ? true : false );
			$same_day = ( date( "FjY", $event->_p_event_start ) == date( "FjY", $event->_p_event_end ) ? true : false );
			$start_time = ( $show_times ? date( "F jS g:i a", $event->_p_event_start ) : date( "F jS", $event->_p_event_start ) );
			$end_time = ( $same_day ? ( $show_times ? date( "g:i a", $event->_p_event_end ) : '' ) : ( $show_times ? date( "F jS g:i a", $event->_p_event_end ) : date( "F jS", $event->_p_event_end ) ));
			$events_list .= "<div class='event' data-day='" . date( 'n', $event->_p_event_start ) . "-" . date( 'j', $event->_p_event_start ) . "'>
				<div class='event-title'>" . ( $event->_p_event_nolink == 'on' ? "" : "<a href=\"" . ( !empty( $event->_p_event_website ) ? $event->_p_event_website : get_permalink( $event->ID ) ) . "\" target='_blank'>" ) . $event->post_title . ( $event->_p_event_nolink == 'on' ? "" : "</a>" ) . "</div>
				<div class='event-time'>" . $start_time . ( !$same_day ? " - " . $end_time : '' ) . "</div>
				<div class='event-description'>" . $event->post_excerpt . "</div>
			</div>";
		}
	} else {
		$events_list .= '<p>No events to list for the selected month.</p>';
	}

	// add an empty div to populate event list into (for use on mobile).
	$calendar .= '<div class="calendar-event-list"><a class="clear-filter">Show All</a>' . $events_list . '</div></div>';
	
	/* all done, return result */
	print $calendar;

}


// get a list of event categories in an array
function get_event_categories() {
    $args = array(
		'orderby'            => 'name',
		'order'              => 'ASC',
		'number'             => null,
		'echo'               => 0,
		'taxonomy'           => 'event_cat',
    );
    return get_categories( $args ); 
}


// filter events by category using a dropdown menu
function filter_by_event_type() {

	wp_dropdown_categories( 
		array(
			'show_option_all' => 'All Event Categories',
			'orderby' => 'NAME', 
			'taxonomy' => 'event_cat',
			'class' => 'event-category',
			'exclude' => '7756',
			'hierarchical' => 1,
			'depth' => 1,
			'selected' => ( isset( $_GET['event_category'] ) ? $_GET['event_category'] : 0 )
		) 
	);

}


// returns a duration from start and end timestamps
function duration( $start, $end ) {
	// get duration in seconds
	$duration_seconds = $end - $start;

	// calculate days, then hours, then minutes
	$days = floor( $duration_seconds / 86400 );
	$hours = floor( ( $duration_seconds - ( $days * 86400 ) ) / 3600 );
	$minutes = floor( ( $duration_seconds - ( $days * 86400 ) - ( $hours * 3600 ) ) / 60 );

	// build a time string
	$time_string_parts = array();
	if ( $days > 0 ) $time_string_parts[] = $days . ' day' . ( $days > 1 ? 's' : '' );
	if ( $hours > 0 ) $time_string_parts[] = $hours . ' hour' . ( $hours > 1 ? 's' : '' );
	if ( $minutes > 0 ) $time_string_parts[]= $minutes . ' minute' . ( $minutes > 1 ? 's' : '' );

	// return it.
	return implode( ", ", $time_string_parts );
}



// set the event columns for the event custom post type
add_filter( 'manage_edit-event_columns', 'edit_event_columns' ) ;
function edit_event_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Event' ),
		'start' => __( 'Starts' ),
		'end' => __( 'Ends' ),
		'category' => __( 'Category' ),
	);

	return $columns;
}



// add some post clauses to select more fields when we get events.
add_filter( 'posts_clauses', 'manage_event_clauses', 1, 2 );
function manage_event_clauses( $pieces, $query ) {
	global $wpdb;

	/**
	* We only want our code to run in the main WP query
	* AND if an orderby query variable is designated.
	*/
	if ( $query->get( 'post_type' ) == 'event' && $query->get( 'orderby' ) == 'event_cat' ) {

		// Get the order query variable - ASC or DESC
		$order = strtoupper( $query->get( 'order' ) );

		// Make sure the order setting qualifies. If not, set default as ASC
		if ( $order != 'ASC' ) $order = 'DESC';

		// join category name
		$pieces[ 'join' ] .= " LEFT JOIN $wpdb->term_relationships wp_termrel ON wp_termrel.object_id = {$wpdb->posts}.ID ";
		$pieces[ 'join' ] .= " LEFT JOIN $wpdb->term_taxonomy wp_termtax ON wp_termrel.term_taxonomy_id = wp_termtax.term_id ";
		$pieces[ 'join' ] .= " LEFT JOIN $wpdb->terms wp_terms ON wp_terms.term_id = wp_termtax.term_id ";
		
		// add order
		$pieces[ 'orderby' ] = "wp_terms.name $order";

	}

	return $pieces;

}



// add content to custom event admin listing columns
add_action( 'manage_event_posts_custom_column', 'manage_event_columns', 10, 2 );
function manage_event_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'start' :

			/* Get the post meta. */
			$start = get_post_meta( $post_id, '_p_event_start', true );

			/* If no duration is found, output a default message. */
			if ( empty( $start ) )
				echo __( '-' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( date( 'n/j/Y @ g:ia', $start ) );

			break;

		/* If displaying the 'duration' column. */
		case 'end' :

			/* Get the post meta. */
			$end = get_post_meta( $post_id, '_p_event_end', true );

			/* If no duration is found, output a default message. */
			if ( empty( $end ) )
				echo __( '-' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				printf( date( 'n/j/Y @ g:ia', $end) );

			break;

		/* If displaying the 'genre' column. */
		case 'category' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'event_cat' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'event_cat' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'event_cat', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Category' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}



// event shortcode
function events_shortcode( $event_atts ) {

	// set shortcode defaults
	$a = shortcode_atts( array(
		'limit' => 5,
		'category' => 0,
		'show_excerpt' => 0,
		'display' => 'list'
	), $event_atts );


	// get the events
	$events = get_upcoming_events( $a['limit'], $a['category'] );

	// start an empty event.
	$list = '';

	// list the events
	if ( !empty( $events ) ) {
		$list .= '<div class="event-list">';
		$num = 0;
		foreach ( $events as $event ) {

			// piece together an excerpt.
			$excerpt = ( !empty( $event->post_excerpt ) ? $event->post_excerpt : wp_trim_words( $event->post_content, 30 ) . "[...]" );

			$list .= '<div class="event' . ( $num == 0 ? ' first' : '' ) . '">';
			$list .= '<div class="event-date">';
				$list .= '<span class="event-date-month">' . date( 'M', $event->_p_event_start ) . '</span>';
				$list .= '<span class="event-date-day">' . date( 'j', $event->_p_event_start ) . '</span>';
			$list .= '</div>';
			$list .= '<h3><a href="' . ( !empty( $event->_p_event_website ) ? $event->_p_event_website : get_permalink( $event->ID ) ) . '"' . ( !empty( $event->_p_event_website ) ? ' target="_blank"' : '' ) . '>' . $event->post_title . '</a></h3>';
			$list .= '<div class="event-excerpt">' . $excerpt . '</div>';
			$list .= '</div>';
			$num++;
		}
		$list .= '</div>';
	}

	return $list;

}
add_shortcode( 'events', 'events_shortcode' );



// event-cta shortcode
function events_cta_shortcode( $event_atts ) {

	// set shortcode defaults
	$a = shortcode_atts( array(
		'limit' => -1,
		'category' => 0,
		'show_excerpt' => 0,
		'display' => 'list'
	), $event_atts );


	// get the events
	$events = get_upcoming_events( $a['limit'], $a['category'] );

	// start an empty event.
	$list = '';

	// list the events
	if ( !empty( $events ) ) {
		$list .= '<div class="event-list-cta' . ( $a['display'] == 'narrow' ? ' narrow' : '' ) . '">';
		$num = 0;
		foreach ( $events as $event ) {

			// piece together an excerpt.
			$excerpt = ( !empty( $event->post_excerpt ) ? $event->post_excerpt : wp_trim_words( $event->post_content, 20 ) );

			$link_url = get_permalink( $event->ID );

			// open the event item
			$list .= '<div class="event' . ( $num == 0 ? ' first' : '' ) . '">';

			// narrow styles
			if ( $a['display'] == 'narrow' ) {
				$list .= '<div class="event-date">';
					$list .= '<span class="event-date-month">' . date( 'M', $event->_p_event_start ) . '</span>';
					$list .= '<span class="event-date-day">' . date( 'j', $event->_p_event_start ) . '</span>';
				$list .= '</div>';
			} else {
				// state-related event list-style branding
				$list .= '<div class="event-branding ' . $event->_p_event_branding . '">';
				$list .= '<img src="' . get_bloginfo( 'template_url' ) . '/img/event-brand/' . $event->_p_event_branding . '.svg" />';
				$list .= '</div>';
			}

			// start event columns
			$list .= '<div class="event-cta-columns">';

			// start event info
			$list .= '<div class="event-info">';
			$list .= '<h3><a href="' . ( !empty( $event->_p_event_website ) ? $event->_p_event_website : get_permalink( $event->ID ) ) . '"' . ( !empty( $event->_p_event_website ) ? ' target="_blank"' : '' ) . '>' . $event->post_title . '</a></h3>';
			$list .= '<div class="event-date">' . date( 'M j, Y \a\t g:i a', $event->_p_event_start ) . '</div>';
			$list .= '<p class="event-excerpt">' . $excerpt . '</p>';
			$list .= '</div>';

			$registration_text = $event->_p_event_registration_text;
			if ( empty( $event->_p_event_registration_text ) ) {
				$registration_text = 'Register Now';
			}

			// start event ctas
			$list .= '<div class="event-ctas">';
			$list .= '<a href="' . $link_url . '" class="more-info">More Info</a>';
			$list .= '<a href="' . $event->_p_event_registration . '" class="register">' . $registration_text . '</a>';
			if ( !empty( $event->_p_event_cta1_link ) ) $list .= '<a href="' . $event->_p_event_cta1_link . '" class="cta1">' . $event->_p_event_cta1_text . '</a>';
			if ( !empty( $event->_p_event_cta2_link ) ) $list .= '<a href="' . $event->_p_event_cta2_link . '" class="cta2">' . $event->_p_event_cta2_text . '</a>';
			$list .= '</div>';

			// end event columns
			$list .= '</div>';

			// close the event item
			$list .= '</div>';
			$num++;
		}
		$list .= '</div>';
	}

	return $list;

}
add_shortcode( 'events-cta', 'events_cta_shortcode' );



// enable sortable columns for event post type
add_filter("manage_edit-event_sortable_columns", 'edit_event_sort');
function edit_event_sort($columns) {
	$custom = array(
		'start' 	=> '_p_event_start',
		'end' 		=> '_p_event_end',
		'category'	=> 'event_cat'
	);
	return wp_parse_args($custom, $columns);
}



// add the event data to the RSS feed for event post types.
function rss_event_date() {
	global $post;
	if ( $post->post_type == 'event' ) {
		print "<eventDate>" . date( 'r', get_post_meta( $post->ID, CMB_PREFIX . 'event_start', 1 ) ) . "</eventDate>";
	}
}
add_action( 'rss2_item', 'rss_event_date' );



// hook into feed and sort/limit event post type by event date.
function rss_event_sort( $query ) {
	if ( $query->is_feed && ( !empty( $query->get('event_cat') ) || $query->get('post_type')=='event' ) ) {
		$query->set('orderby','meta_value');
		$query->set('meta_key', CMB_PREFIX . 'event_start');
		$query->set('order','ASC');
		$query->set('posts_per_page','30');
		$query->set('meta_value',mktime());
		$query->set('meta_compare','>=');
	}
	return $query;
}
add_filter( 'pre_get_posts', 'rss_event_sort' );


