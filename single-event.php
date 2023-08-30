<?php
/*
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
		global $post;
		$slug = $post->post_name;
		$header_title = get_the_title();
		$header_color = ( has_cmb_value( 'event_color' ) ? get_cmb_value( 'event_color' ) : 'green' );
		if ( has_cmb_value( 'event_start' ) && has_cmb_value( 'event_end' ) ) {

			// get the event start and end datetimes
			$start = get_cmb_value( 'event_start' );
			$end = get_cmb_value( 'event_end' );

			// get daylight savings times
			$dt_start = get_cmb_value( 'event_start_dt' );
			$dt_end = get_cmb_value( 'event_end_dt' );

			// daylight time by default
			if ( empty( $dt_start ) ) $dt_start = 'DT';
			if ( empty( $dt_end ) ) $dt_end = 'DT';

			// show a title
			print "<h4>Date</h4>";

			if ( date( 'Ymd', $start ) != date( 'Ymd', $end ) ) {

				// if the event doesn't end on the same day as it starts
				print "<p><strong>" . date( "F j, Y", $start ) . "</strong><br>" . date( "g:i a", $start ) . " P" . $dt_start . " (" . date( "g:i a", $start + 3600 ) . " M" . $dt_start . ")<br>";
				print "&#8212;<br>" .
						"<strong>" . date( "F j, Y", $end ) . "</strong><br>" . date( "g:i a", $end ) . " P" . $dt_end. " (" . date( "g:i a", $end + 3600 ) . " M" . $dt_end . ")</p><br>";
				print "<p><label><strong>Duration:</strong></label><br>" . duration( get_cmb_value( 'event_start' ), get_cmb_value( 'event_end' ) ) . "</p>";

			} else {

				// if the event ends the same day as it starts
				print "<p><strong>" . date( "F j, Y", $start ) . "</strong><br>" . 
				date( "g:i a", $start ) . " (" . date( "g:i a", $start + 3600 ) . " M" . $dt_start . ") &#8212;<br>";
				print date( "g:i a", $end ) . " (" . date( "g:i a", $end + 3600 ) . " M" . $dt_start . ")</p><br>";
				print "<p><label><strong>Duration:</strong></label><br>" . duration( get_cmb_value( 'event_start' ), get_cmb_value( 'event_end' ) ) . "</p>";
			}


		}
		print "</div>";

		// get price dates
		$early_date = get_cmb_value( 'event_early_date' );
		$late_date = get_cmb_value( 'event_late_date' );
		$is_early = ( time() <= $early_date ? 1 : 0);
		$is_late = ( time() >= $late_date ? 1 : 0 );

		// get normal prices
		$early_price = get_cmb_value( 'event_early_price' );
		$regular_price = get_cmb_value( 'event_price' );
		$late_price = get_cmb_value( 'event_late_price' );

		// get small cu prices
		$small_early_price = get_cmb_value( 'event_small_early_price' );
		$small_regular_price = get_cmb_value( 'event_small_price' );
		$small_late_price = get_cmb_value( 'event_small_late_price' );

		// set current price variables for small and regular cus
		$current_price = str_replace( '.00', '', ( $is_early ? $early_price : ( $is_late ? $late_price : $regular_price ) ) );
		$small_current_price = str_replace( '.00', '', ( $is_early ? $small_early_price : ( $is_late ? $small_late_price : $small_regular_price ) ) );


		// start output the pricing information
		print '<div class="event-price">';
		print "<h4>Pricing</h4>";

		// if the small cu price is set, display with different styles
		if ( get_cmb_value( 'event_pricing_upcoming' ) == 'on' ) {
			print "<p>Pricing coming soon!</p>";
		} else {
			if ( $current_price == 0 ) {
				print "<p>Free</p>";
			} else if ( !empty( $small_current_price ) ) {
				print "<p><strong>Regular Price:</strong><br>$" . $current_price . ( $is_early ? ' (early bird price)' : ( $is_late ? ' (late registration price)' : '' ) ) . "</p>";	
				print "<p><strong>Small CU Price:</strong><br>$" . $small_current_price . ( $is_early ? ' (early bird price)' : ( $is_late ? ' (late registration price)' : '' ) ) . "</p>";	
			} else {
				print "<p>$" . $current_price . ( $is_early ? ' (early bird price)' : ( $is_late ? ' (late registration price)' : '' ) ) . "</p>";	
			}
		}
		print '</div>';
	

		// output the registration button if there's a registration link.
		if ( has_cmb_value( 'event_registration' ) ) {
			print '<div class="event-registration">';
			print '<p><a href="' . get_cmb_value( 'event_registration' ) . '" class="btn green large">Register Now</a></p>';
			print '</div>';
		}


		// output the event location information
		if ( has_cmb_value( 'event_location_text' ) ) {
			print '<div class="event-location">';
			print "<h4>Location</h4>";
			show_cmb_wysiwyg_value( 'event_location_text' );
			print '</div>';
		}


		// get event people group
		$event_people_group = get_cmb_value( 'people_group' );
		
		// if we have a people group
		if ( !empty( $event_people_group ) ) {

			// get the people group title
			$event_connect_title = get_cmb_value( 'event_connect_title' );

			// show a title if we have one.
			print ( !empty( $event_connect_title ) ? "<h4>" . $event_connect_title . "</h4>" : '' );

			print '<div class="event-people">';
			do_people_group( $event_people_group );
			print '</div>';
		}


		// get event ad group
		$event_ad_group = get_cmb_value( 'ad_group' );
		
		// if we have an ad group
		if ( !empty( $event_ad_group ) ) {

			// get the ad title
			$event_ad_title = get_cmb_value( 'event_ad_title' );

			// show a title if we have one.
			print ( !empty( $event_ad_title ) ? "<h4>" . $event_ad_title . "</h4>" : '' );

			print '<div class="event-ad">';
			do_ad_group( $event_ad_group );
			print '</div>';
		}

	endwhile;
endif;
*/

global $post;

if ( has_cmb_value( 'page_brand' ) ) {
	set_brand( get_cmb_value( 'page_brand' ) );
} else {
	set_brand( 'core' );
}

get_header();

if ( show_title() ) {
	?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>
	<?php
}

the_showcase();

if ( has_introduction() ) {
	?>
<div class="content-wide after-showcase" role="main">
	<?php 

	if ( show_breadcrumbs() ) {
		breadcrumbs( array(
			array(
				'href' => '/events/',
				'text' => 'Events'
			)
		) );
	}

	the_introduction();

	the_partner_logos();

	?>
</div><!-- #content -->
	<?php
}

the_icons();

the_accordions();

the_testimonials();

// if ( has_content() ) {
	?>
<div class="content-wide" role="main">
	<?php
	if ( !has_introduction() && show_breadcrumbs() ) {
		$breadcrumb_array = array(
			array(
				'href' => '/events/',
				'text' => 'Events'
			)
		);
		if ( $post->post_parent ) { 
			array_push( $breadcrumb_array, array( 
				'href' => get_permalink( $post->post_parent ),
				'text' => get_the_title( $post->post_parent )
			) );
		}

		breadcrumbs( $breadcrumb_array );
	}

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

		
			the_content();

			// show the event info if they have the 'hide on page' feature unchecked.
			if ( !get_field( 'hide_info_on_page' ) ) {
				// output datetime
				$time = strtotime( get_field( '_p_event_start', get_the_ID() ) );
				$time_end = strtotime( get_field( '_p_event_end', get_the_ID() ) );
				$same_day = ( date( 'md', $time ) == date( 'md', $time_end ) ? true : false );
				$at = '<span class="date-at">@</span>';
				$datetime = date( 'F', $time ) . ' ' . date( 'j', $time ) . '<sup>' . date( 'S', $time ) . '</sup> ' . ( $same_day ? '<span class="date-at">from</span>' : $at ) . ' ' . ( !stristr( date( 'g:i a', $time ), '12:00 am' ) ? ' ' : '' ) . str_replace( ':00', '', str_replace( '12:00 am', "", date( 'g:i a', $time ) ) );
				$datetime_end = ( !$same_day ? date( 'F', $time_end ) . ' ' . date( 'j', $time_end ) . '<sup>' . date( 'S', $time_end ) . '</sup> ' . $at . ' ' : '' ) . ( !stristr( date( 'g:i a', $time_end ), '12:00 am' ) ? ' ' : '' ) . str_replace( ':00', '', str_replace( '12:00 am', "", date( 'g:i a', $time_end ) ) );
				print "<hr><h4>Event Date / Time</h4>";
				print '<p>' . $datetime . ' &mdash; ' . $datetime_end . '</p>';

				// the call to action intro
				if ( has_cmb_value( 'event_location_text' ) ) {		
					print '<hr><h4>Room Name / Location</h4>';
					print '<div class="location">';
					print apply_filters( 'the_content', get_cmb_value( 'event_location_text') );
					print '</div>';
				}

				// put together the people
				$people = get_field( 'people' );
				$people_content = '';
				if ( !empty( $people ) ) {
					foreach ( $people as $person ) {
						$person_info = get_post( $person );
						$person_thumbnail = get_the_post_thumbnail_url( $person_info );
						$people_content .= '<div class="person">' . 
							( !empty( $person_thumbnail ) ? '<div class="person-thumbnail"><a href="' . get_the_permalink( $person_info ) . '"><img src="' . get_the_post_thumbnail_url( $person_info ) . '" class="person-thumbnail" /></a></div>' : '' ) .
							'<div class="person-info"><strong>' . $person_info->post_title . '</strong><br>' . get_post_meta( $person, '_p_person_title', 1 ) . '</div>' .
						'</div>';
					}
					print '<hr><h4>Speakers</h4><div class="event-people">' . $people_content . '</div>';
				}

				// put together the sponsors
				$sponsor_content = '';
				if ( have_rows( 'sponsors' ) ) {
					while ( have_rows( 'sponsors' ) ) : the_row();
						$sponsor_content .= '<div class="sponsor"><img src="' . get_sub_field( 'logo' ) . '" alt="' . get_sub_field( 'name' ) . '" /></div>';
					endwhile;
					print '<hr><h4>Sponsors</h4><div class="event-sponsors">' . $sponsor_content . '</div>';
				}
			}


		endwhile;
	endif;
	

	?>
</div>
	<?php
// }

the_agenda();

the_page_articles();

the_link_boxes();

// output the registration button if there's a registration link.
if ( has_cmb_value( 'event_registration' ) ) {

	// the event registration bar	
	print '<div class="event-registration">';

	// the call to action intro
	if ( has_cmb_value( 'event_cta_intro' ) ) {		
		print '<div class="content">';
		print apply_filters( 'the_content', get_cmb_value( 'event_cta_intro') );
		print '</div>';
	}

	// the call to action buttons
	print '<div class="buttons">';
	print get_registration_button() . ' ';
	if ( has_cmb_value( 'event_cta1_link' ) && has_cmb_value( 'event_cta1_text' ) ) {
		print '<a href="' . get_cmb_value( 'event_cta1_link' ) . '" class="btn navy">' . get_cmb_value( 'event_cta1_text' ) . '</a>';
	}
	print '</div>';

	print '</div>';

}

the_footer_buttons();

get_footer();

