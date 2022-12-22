<?php

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
<div class="content-wide" role="main">
	<?php 

	if ( show_breadcrumbs() ) breadcrumbs();

	the_introduction();

	the_partner_logos();

	?>
</div><!-- #content -->
	<?php
}

the_button_bar();

the_icons();

the_page_events();

the_testimonials();

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

the_agenda();

the_accordions();

the_page_ads();

the_page_articles();

the_price_table();

the_link_boxes();

get_footer();

