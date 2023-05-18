<?php
/**
 * The template for displaying Archive pages
 */
set_brand( 'newsletter' );

get_header(); 

$page_title = "<span>Author</span>: " . get_the_author() . "";

?>

	<div class="page-title">
		<h1><?php print $page_title; ?></h1>
	</div>
	<div class="content-wide" role="main">
	<?php
	// loop through the items
	print '<div class="breadcrumbs">';

	// show home crumb
	print '<a href="/">Home</a> &raquo; ';
	if ( is_foundation() ) {
		print '<a href="/news">Foundation News</a> &raquo; ';
	} else {
		print '<a href="/onthego">On The Go</a> &raquo; ';
	}

	// show current page title only
	print '<span class="current">' . $page_title . '</span>';

	// close breadcrumbs
	print '</div>';

	print '<div class="article-cards">';
	if ( have_posts() ) : 

		// Start the Loop.
		while ( have_posts() ) : the_post(); 
			?>
		<div class="article-card">
			<a href="<?php the_permalink(); ?>" class="no-line"><?php the_post_thumbnail( array( 720, 480 ) ); ?></a>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
		</div>
			<?php
		endwhile;

	else :

		print "<p>There are currently no posts to list here.</p>";

	endif;
	?>

		</div><!-- /article-cards -->
	</div><!-- /content-wide -->

	<?php paginate(); ?>

<?php

get_footer();

?>