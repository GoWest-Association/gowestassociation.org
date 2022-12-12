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

// the_page_events();

the_testimonials();

?>
<div class="content-wide" role="main">
	<?php
	if ( !has_introduction() && show_breadcrumbs() ) {
		breadcrumbs();
	}

	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_content();
		endwhile;
	endif;
	
	?>
</div>
<?php

the_agenda();

the_accordions();

the_link_boxes();

get_footer();
