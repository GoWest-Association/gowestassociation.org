<?php
/*
Search results template
*/

set_brand( 'association' );

get_header(); 


$query_args['post_type'] = ( isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : array( 'post', 'page', 'event', 'job' ) );
$query_args['posts_per_page'] = 30;
$query_args['s'] = $_REQUEST['s'];
$query_args['paged'] = $paged;
query_posts( $query_args );

if ( $paged > 0 ) {
	$result_range_start = ( ( $paged - 1 ) * 30 ) + 1;
	$result_range_end = ( $result_range_start + 29 );
	if ( $wp_query->found_posts > $result_range_end ) {
		$result_range = $result_range_start . ' - ' . $result_range_end; 
	} else {
		$result_range = $result_range_start . ' - ' . $wp_query->found_posts;
	}
} else {
	if ( $wp_query->found_posts > 30 ) {
		$result_range = '1 - 30';
	} else {
		$result_range = '1 - ' . $wp_query->found_posts;
	}
}

?>

	<div class="page-title">
		<h1>Search: '<?php print htmlspecialchars( $_REQUEST['s'] ) ?>'</h1>
	</div>
		
    <!--
	<?php if ( $paged == 0 ) { ?>
	<div class="featured-search">
		<p class="featured-search-title">Trending Searches:</p>
		<div class="article-cards">
			<?php
			$featured_posts = get_posts( array( 'posts_per_page' => 3, 'category_name' => 'trending', 'post_type' => 'post' ) );
			foreach( $featured_posts as $fpost ) {
		        $categories = get_the_category( $fpost->ID );
		        $cat = $categories[0];
		        $color = get_category_color( $cat->term_id );
		        $permalink = get_permalink( $fpost->ID );
				?>
			<div class="entry">
	        	<div class="entry-thumbnail">
	        		<a href="<?php print $permalink ?>"><?php print get_the_post_thumbnail( $fpost->ID, array( 768, 480 ) ); ?></a>
		    		<div class="entry-category <?php print $cat->slug ?> <?php print $color ?>"><?php print $cat->name ?></div>
		   		</div>
	        	<div class="entry-inner">
		    		<h4><a href="<?php print $permalink ?>"><?php print $fpost->post_title ?></a></h4>
		    		<p><?php print $fpost->post_excerpt; ?></p>
		    	</div>
		    </div>
				<?php 
			} 
			?>
		</div>
	</div>
	<?php } ?>
    -->

	<div id="content" class="content-wide search-list" role="main">

		<?php include( 'searchform-advanced.php' ); ?>
		<hr />
		<div class="quiet total-results">
			Found <strong><?php echo $wp_query->found_posts; ?></strong> total results. Showing results <strong><?php print $result_range; ?></strong>.
		</div>
		<div class="entries">
		<?php
		if ( have_posts() ) {
			$count = 1;
			while ( have_posts() ) : the_post();
				?>
				<div class="entry <?php print $post->post_type ?>">
					<div class="description">
						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<?php 

						// output the excerpt
						the_excerpt();
						
						$categories = get_the_category();
						if ( !empty( $categories ) ) { 
							?>
						<span class="quiet">Posted in </span> 
						<div class="post-category">
							<?php print get_cat_name( $categories[0]->term_id ); ?>
						</div>
						<span class="quiet">on <strong><?php print get_the_date( 'F jS, Y' ); ?></strong></span>
							<?php
						}

						?>
					</div>
				</div>
				<?php
				$count++;
			endwhile;
			?>
			<?php
		} else {
			print "<p>Sadly, your search returned no results. Please try another or navigate using the main menu.</p>";
		}
		?>
		</div>
	</div><!-- #content -->
	<div class="pagination">
		<?php pagination(); ?>
	</div>
<?php 


get_footer();

