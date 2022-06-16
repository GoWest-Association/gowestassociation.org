<?php
/**
 * The Template for displaying all single posts
 */

get_header();

the_showcase();

?>

	<div class="content-wide" role="main">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<p class="quiet">Posted by <?php print get_the_author_link() ?> in <?php print get_the_category_list( ', ' ) ?>.</p>
				<?php
			endwhile;
		endif;
		?>
	</div>

<?php

get_footer();

?>