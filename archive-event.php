<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

if ( isset( $_REQUEST['event_category'] ) && $_REQUEST['event_category'] != 0 ) {
	$category_info = get_term_by( 'id', $_REQUEST['event_category'], 'event_cat' );
	$page_title = $category_info->name;
} else {
	$page_title = "Events Calendar";
}

?>
	<div class="page-title bg-forest">
		<h1><?php print $page_title ?></h1>
	</div>
	
	<div id="content" class="wrap content-wide" role="main">
		<div class="events-content">
			<!--<?php print do_shortcode( '[snippet slug="events-calendar-download"]' ); ?>-->
		</div>

		<h3>Search All Events</h3>
		<form role="search" method="get" id="searchform" class="searchform" action="/" _lpchecked="1">
			<input type="text" value="<?php print ( isset( $_REQUEST['s'] ) ? strip_tags( $_REQUEST['s'] ) : '' ) ?>" name="s" id="s" placeholder="Search">
			<input type="hidden" value="event" name="post_type">
			<input type="submit" id="searchsubmit" value="Search Events" class="btn-arrow">
		</form>
		<hr>
		<?php
		if ( is_search() ) {

			if ( have_posts() ) {
				$count = 1;
				while ( have_posts() ) : the_post();
					?>
					<div class="entry entry-event">
						<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
						<p class="quiet"><strong>Event Date:</strong> <?php print date( 'n/j/Y \a\t g:ia', get_cmb_value( 'event_start' ) ); ?></p>
						<?php echo wpautop( wp_trim_words( strip_tags( get_the_excerpt() ), 50 ) ); ?>
					</div>
					<hr />
					<?php
					$count++;
				endwhile;
			} else {
				print "<p>Sadly, your search returned no results. Please try another or navigate using the main menu.</p>";
			}

		} else {
			?>
			<h3>Browse Events</h3>
			<p><strong>Filter by Event Type:</strong> <?php filter_by_event_type(); ?></p>
			<br>
			<?php 

			/*
			$url_parts = explode( "?", $_SERVER['REQUEST_URI'] );
			parse_str( $url_parts[1], $request );
			*/

			// get URL parameters and default to current month.
			$month = ( isset( $_REQUEST['mo'] ) ? $_REQUEST['mo'] : date( "n" ) );
			$year = ( isset( $_REQUEST['yr'] ) ? $_REQUEST['yr'] : date( "Y" ) );

			// output month
			show_month_events( $month, $year );
		}
		?>
	</div><!-- #content -->

<?php

get_footer();

?>