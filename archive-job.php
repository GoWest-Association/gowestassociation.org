<?php
/**
 * The template for displaying Archive pages
 */

set_brand( 'association' );

get_header(); 

global $wp_query;


// start building args for query_posts
$args = array_merge( $wp_query->query_vars, array(
	'post_type' => 'job',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'meta_key' => '_p_job_expires',
	'posts_per_page' => 1000
) );


$request = parse_query_string();
if ( isset( $request['sort'] ) ) {
	$sort = $request['sort'];
} else {
	$sort = 'title';
}
switch ( $sort ) {
	case 'title':
		$args['orderby'] = 'title';
		$args['order'] = 'ASC';
	break;
	case 'date-asc':
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	break;
	case 'date-desc':
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	break;
}


// start building meta query for job expiration
$today = date( 'Y-m-d' );
$expires_query = array(
	'relation' => 'OR',
	array(
		'key' => '_p_job_expires',
		'value' => '',
		'compare' => '='
	),
	array(
		'key' => '_p_job_expires',
		'value' => $today,
		'compare' => '>='
	)
);


// add meta_query for job type if set
if ( isset( $_GET['job_type'] ) ) {
	$type_query = array(
		'key' => '_p_job_type',
		'value' => $_GET['job_type'],
		'compare' => '='
	);
}


// if we have a type query
if ( !empty( $type_query ) ) {
	// add it in addition to the expiration query
	$args['meta_query'] = array(
		'relation' => 'AND',
		$expires_query,
		$type_query
	);
} else {
	// othewise just use the expiration query.
	$args['meta_query'] = $expires_query;
}


query_posts( $args );

$job_count = $wp_query->found_posts;

?>
	<div class="page-title bg-<?php print $header_color ?>">
		<h1>Career Center</h1>
	</div>

	<div class="content-wide" role="main">

		<div class="job-filter">
			<div class="job-search"><label for="job-search">Search:</label> <input type="text" id="job-search" value="" placeholder="Search Jobs"></div>
			<div class="job-sort"><form name="job-sort" action="/jobs" method="GET"><label>Sort By:</label> <select name="sort"><option value="expiration">Expiration Date</option><option value="title"<?php print ( $sort == 'title' ? ' selected' : '' ) ?>>Job Title</option><option value="date-desc"<?php print ( $sort == 'date-desc' ? ' selected' : '' ) ?>>Newest to Oldest</option><option value="date-asc"<?php print ( $sort == 'date-asc' ? ' selected' : '' ) ?>>Oldest to Newest</option></select></form></div>
			<div class="job-count"><strong>Showing <?php print $job_count; ?> Job<?php print ( $job_count == 1 ? '' : 's' ) ?></strong></div>
		</div>

		<div class="job-list">
			<?php

			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					?>
			<div class="entry-job <?php show_cmb_value( 'job_color' ); ?>">
				<div class="job-title">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="job-excerpt">
					<p class="job-info"><?php print ( has_cmb_value( 'job_company' ) ? get_cmb_value( 'job_company' ) : '' ); ?><?php print ( has_cmb_value( 'job_region' ) ? " | " .get_cmb_value( 'job_region' ) : '' ); ?></p>
					<?php print wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
				</div>
			</div>
					<?php
				endwhile;
			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );
			endif;
			?>
		</div>

	</div><!-- #content -->

	</section><!-- #primary -->

<?php

get_footer();

?>