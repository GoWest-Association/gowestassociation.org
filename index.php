<?php
/*
Home/catch-all template
*/

// set the newsletter global
$is_newsletter = true;

set_brand( 'association' );

get_header(); 

the_showcase();

?>

	<div class="content-wide" role="main">

		<?php
		if ( is_search() ) {
			?><h1 class="post-title">Search Results for <span>'<?php print $_REQUEST["s"]; ?>'</span></h1><?php
		}

		if ( have_posts() ) : 
			?>
		<div class="article-cards">
			<?php
			$return = '';
			// Start the Loop.
			while ( have_posts() ) : the_post(); 
				$return .= '<div class="entry">';
				$return .= '<div class="entry-thumbnail">';
				$return .= '<a href="' . get_the_permalink() . '" class="no-line">';
				$return .= get_the_post_thumbnail( null, array( 768, 480 ) );
				$return .= '</a>';
				$return .= '</div>';
				$return .= '<div class="entry-inner">';
				$return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
				$return .= wpautop( get_the_excerpt() );
				$return .= '</div>';
				$return .= '</div>';
			endwhile;
			print $return;
			?>
		</div>
			<?php
		else :

			print "<p>There are currently no posts to list here.</p>";

		endif;
		?>
		
		<?php paginate(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>