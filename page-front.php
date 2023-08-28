<?php

/*
Template Name: Home (Association)
*/

set_brand( 'association' );

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

the_page_events_row();

the_page_articles();

the_page_ads();

the_link_boxes();

print '<div class="content-wide" role="main">';
print "<h3 class='text-center'>Your Solutions Partners</h3>";
the_partner_logos();
print '</div>';

the_footer_buttons();

get_footer();

