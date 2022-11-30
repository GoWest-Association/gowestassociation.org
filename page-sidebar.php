<?php

/*
Template Name: Page w/ Sidebar
*/

set_brand( 'core' );

get_header();

the_showcase();

?>

<div class="content-wide" role="main">
	<div class="quarter sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-generic') ) : ?>no sidebar selected<?php endif; ?>
	</div>
	<div class="three-quarter">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>
	<h1 class="post-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>
			<?php
		endwhile;
	endif;

	?>
	</div>
</div><!-- #content -->

<?php

get_footer();

?>