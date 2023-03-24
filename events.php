<?php
/**
 * Template Name: Events Calendar
 */

set_brand( 'association' );

get_header(); 

check_events_url();

?>
	<div class="page-title bg-forest">
		<h1>Events</h1>
	</div>
	
	<div id="content" class="wrap content-wide" role="main">
		<?php

		// output month
		show_month_events( $event_mo, $event_yr, $event_cat );

		?>
	</div><!-- #content -->

<?php

get_footer();

?>