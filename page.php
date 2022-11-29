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
	
	the_introduction();

	the_partner_logos();

	?>
</div><!-- #content -->
	<?php
}

the_testimonials();

?>
<div class="content-wide" role="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>
	<?php the_content(); ?>
			<?php
		endwhile;
	endif;
	?>
</div>
<?php

the_accordions();

the_link_boxes();

get_footer();

