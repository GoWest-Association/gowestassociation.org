<?php
/*
Template Name: Newsletter
*/

// set the newsletter global
$is_newsletter = true;

get_header(); 

the_showcase();

?>

	<div class="two-column" role="main">
		<div class="sidebar">
			<div class="widget">
				<h4>Browse by Category</h4>
				<?php wp_dropdown_categories(); ?>
			</div>
			<div class="widget">
				<h4>Browse by Date</h4>
				<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
					<option value=""><?php esc_attr( _e( 'Select Month', 'textdomain' ) ); ?></option> 
					<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
				</select>
			</div>
			<div class="widget">
				<?php wp_nav_menu( 'newsletter' ); ?>
			</div>
			<div class="widget">
				<?php print do_shortcode( "[events limit=2 /]" ); ?>
			</div>
			<div class="widget">
				<?php do_ad_group( 'anthem-news' ); ?>
			</div>
		</div>
		<div class="right-column">
			<div class="right-column-inner">

			<?php
			if ( is_search() ) {
				?><h1 class="post-title">Search Results for <span>'<?php print $_REQUEST["s"]; ?>'</span></h1><?php
			}

			if ( have_posts() ) : 

				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
				<p class="quiet">Posted by <?php print get_the_author_link() ?> in <?php print get_the_category_list( ', ' ) ?>.</p>
				<hr />
					<?php
				endwhile;

			else :

				print "<p>There are currently no posts to list here.</p>";

			endif;
			?>
			
			<?php paginate(); ?>

			</div>
		</div>
	</div><!-- #primary -->


<?php get_footer(); ?>