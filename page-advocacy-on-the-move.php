<?php

/*
Template Name: Advocacy on the Move
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

the_icons();

the_page_events_row();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		if ( !empty( get_the_content() ) ) {
	?>
	<div class="content-wide" role="main">
		<?php
		if ( !has_introduction() && show_breadcrumbs() ) {
			breadcrumbs();
		}

		the_content();
		
		?>
	</div>
	<?php
		}
	endwhile;
endif;

the_page_articles( 12 );

the_footer_buttons();

get_footer();

