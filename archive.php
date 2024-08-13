<?php
/**
 * The template for displaying Archive pages
 */

$is_newsletter = true;

if ( is_foundation() ) {
	set_brand( 'foundation' );
} else {
	set_brand( 'newsletter' );
}

get_header(); 


if ( is_day() ) :
	$page_title = 'Daily Archives: <span>' . get_the_date() . '</span>';
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_month() ) :
	$page_title = 'Monthly Archives: <span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) . '</span>' ;
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_year() ) :
	$page_title = 'Yearly Archives: <span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) . '</span>';
	$page_subtitle = get_snippet( 'header-news' );

elseif ( is_category() ) :
	$category = get_queried_object();
	$page_title = $category->name;
	$page_subtitle = ( !empty( $category->category_description ) ? $category->category_description : '&nbsp;' );

else :
	$page_title = 'Archives';

endif;

?>
	
	<div class="page-title">
		<h1><?php print $page_title; ?></h1>
	</div>
	<?php
	if ( !is_foundation() ) {
		$term = get_queried_object();
		?>
	<div class="news-aux">
		<div class="news-aux-col">
			<h5>By Category</h5>
			<?php

			/// get all the advocacy on the move category ids
			$aotm_cats = get_aotm_categories();

			// display the category dropdown, excluding aotm ones.
			wp_dropdown_categories( array( 'show_option_all' => 'Select Category', 'value_field' => 'slug', 'class' => 'category-dropdown', 'selected' => $term->slug, 'exclude' => $aotm_cats, 'orderby' => 'name' ) );
			
			?>
		</div>
		<div class="news-aux-col">
			<h5>By Month</h5>
			<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;"><option>Select a Month</option><?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?></select>
		</div>
		<div class="news-aux-col right"><a href="/onthego" class="btn small navy">&laquo; Back to News</a></div>
	</div>
		<?php
	}
	?>

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
			<p class="post-author"><?php print get_the_date() ?></p>
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