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
					?>
				<h1><?php the_title(); ?></h1>
				<p class="post-date"><?php the_date(); ?></p>
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

