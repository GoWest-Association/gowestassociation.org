<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

?>
	
	<div class="page-title">
		<h1>Archive</h1>
	</div>
	<div class="content-wide article-cards" role="main">

	<?php 
	if ( have_posts() ) : 

		// Start the Loop.
		while ( have_posts() ) : the_post(); 
			?>
		<div class="article-card">
			<?php the_post_thumbnail( array( 720, 480 ) ); ?>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
		</div>
			<?php
		endwhile;

	else :

		print "<p>There are currently no posts to list here.</p>";

	endif;
	?>

	</div><!-- #primary -->

	<?php paginate(); ?>

<?php

get_footer();

?>