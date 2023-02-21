<?php

/* 
Template Name: Microsite (State)
*/


the_microsite_header();

if ( show_title() ) {
	?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>
	<?php
}
 
if ( is_member() ) {
	
	the_microsite_boxes();

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
	
	the_showcase();
	
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

	the_footer_buttons();

} else {

	do_member_error();

}

the_microsite_footer();

