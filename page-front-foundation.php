<?php

/*
Template Name: Home (Foundation)
*/

set_brand( 'foundation' );

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
<div class="content-wide" role="main">
	<?php 

	if ( show_breadcrumbs() ) breadcrumbs();

	the_introduction();

	?>
</div><!-- #content -->
	<?php
}

the_button_bar();

the_icons();

the_stats();

the_page_articles();

the_page_events_row();

the_page_ads();

the_link_boxes();

the_footer_buttons();

get_footer();

