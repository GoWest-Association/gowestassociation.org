<?php

/*
Template Name: Councils (Main)
*/

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

if ( is_member() && is_board() ) {

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

	the_page_events_row();

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

	the_price_table();

	the_link_boxes();

	the_footer_buttons();

} else {

	do_member_error();

}

get_footer();

