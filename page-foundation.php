<?php

/*
Template Name: Page - Foundation
*/

set_brand( 'foundation' );

get_header();

the_showcase();

?>

<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>

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
</div><!-- #content -->

<?php

get_footer();

?>