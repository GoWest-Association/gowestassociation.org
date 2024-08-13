<?php

set_brand( 'newsletter' );

get_header();

if ( is_foundation() ) {
?>
<div class="page-title">
	<h1>Foundation News</h1>
</div>
<?php
}

the_showcase();

if ( !is_foundation() ) {
?>
	<div class="two-column article" role="main">
		<div class="sidebar">
			<div class="widget widget_categories">
				<?php

				/// get all the advocacy on the move category ids
				$aotm_cats = get_aotm_categories();

				// display the category dropdown, excluding aotm ones.
				wp_dropdown_categories( array( 'show_option_all' => 'Select Category', 'value_field' => 'slug', 'class' => 'category-dropdown', 'exclude' => $aotm_cats, 'orderby' => 'name' ) );
				
				?>
			</div>

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		<div class="right-column">
			<div class="right-column-inner">
			<?php 
} else {
	?>
	<div class="content-wide article" role="main">
		
			<?php 
}	

			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
				// loop through the items
				print '<div class="breadcrumbs">';

				// show home crumb
				print '<a href="/">Home</a> &raquo; ';
				if ( is_foundation() ) {
					print '<a href="/news">Foundation News</a> &raquo; ';
				} else if ( in_category( 35 ) ) {
					print '<a href="/advocacy-on-the-move/">Advocacy On The Move</a> &raquo; ';
				} else {
					print '<a href="/onthego">On The Go</a> &raquo; ';
				}

				// close breadcrumbs
				print '</div>';
					$hide = get_cmb_value( 'hide-author' );
					$hide = ( $hide == 'on' ? true : false );
					?>
				<h1><?php the_title(); ?></h1>
				<p class="post-date"><?php if ( !$hide ) { ?>Posted by <?php the_author_posts_link(); ?> on <?php } the_date(); ?></p>
				<div class="featured-image">
					<?php the_post_thumbnail( 'full' ); ?>
					<?php if ( has_cmb_value( 'caption' ) ) { ?><div class="caption"><?php show_cmb_value( 'caption' ) ?></div><?php } ?>
				</div>
				<?php the_content(); ?>
				<p class="quiet">Posted in <?php print get_the_category_list( ', ' ) ?>.</p>
					<?php
				endwhile;
			endif;
if ( !is_foundation() ) {
			?>
			</div>
			<div class="page-ads">
				<?php print do_shortcode( '[ad group="example-ad-group" /]' ); ?>
			</div>
		</div>
	</div>
<?php
} else {
	?>
	</div>
	<?php
}

get_footer();

