<?php
/**
 * The template for displaying Archive pages
 */

set_brand( 'association' );

get_header(); 

parse_event_url();

?>
	<div class="page-title bg-forest">
		<h1>Events: <span><?php print $event_mo_name . ' ' . $event_yr ?></h1>
	</div>
	
	<div id="content" class="wrap content-wide" role="main">
		<?php

		// output month
		show_month_events( $event_mo, $event_yr );

		?>
	</div><!-- #content -->

<?php

get_footer();

?>