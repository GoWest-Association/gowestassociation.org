<?php

/*
Template Name: Job Manager
*/

set_brand( 'association' );

global $post;
$job_mgr_url = '/' . $post->post_name . '/';


// delete a job based on the request variable in the URL.
if ( isset( $_GET['del'] ) ) {
	$the_post = get_post( $_GET['del'] );

	if ( !empty( $the_post ) ) {
		if ( $_SESSION['sf_user']['email'] == get_post_meta( $the_post->ID, '_p_job_creator', 1 ) ) {
			wp_delete_post( $the_post->ID );
		}
	}
}


get_header();


// global query object
global $wp_query;


// start building args for query_posts
$args = array(
	'post_type' => 'job',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'meta_key' => '_p_job_expires',
	'posts_per_page' => 1000,
    'meta_query' => array(
        'state_clause' => array(
            'key' => '_p_job_creator',
            'value' => $_SESSION['sf_user']['email'],
        ),
    ),
);


// query the posts
$the_query = new WP_Query( $args );


// get job count
$job_count = $the_query->found_posts;


// output the title
?>
<div class="page-title">
	<h1><?php the_title(); ?></h1>
</div>

<?php 
if ( is_member() ) { 
	?>

	<div class="content-wide" role="main">

		<div class="job-filter">
			<div class="job-search"><label for="job-search">Search:</label> <input type="text" id="job-search" value="" placeholder="Search Jobs"></div>
			<div class="job-count"><strong>Showing <?php print $job_count; ?> Job<?php print ( $job_count == 1 ? '' : 's' ) ?></strong></div>
		</div>
		<div class="job-list">
			<?php 

			if ( $the_query->have_posts() ) : 
				// Start the Loop.
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					global $post;
					?>
			<div class="entry-job group">
				<div class="job-title">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="job-excerpt">
					<?php if ( $_SESSION['sf_user']['email'] == get_cmb_value( 'job_creator' ) ) { ?><a href="<?php print $job_mgr_url; ?>?del=<?php the_ID(); ?>" class="job-delete" onClick="return confirm('Are you sure you want to delete that job?');">Delete Job</a><?php } ?>
					<p class="job-info"><?php print ( has_cmb_value( 'job_company' ) ? get_cmb_value( 'job_company' ) : '' ); ?><?php print ( has_cmb_value( 'job_region' ) ? " | " .get_cmb_value( 'job_region' ) : '' ); ?></p>
					<?php the_excerpt(); ?>
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
	<?php
} else {
	
	do_member_error();

}
?>

<?php

the_footer_buttons();

get_footer();

?>