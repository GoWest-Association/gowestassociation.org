<?php

/*
Template Name: Homepage (SLI)
*/

set_brand( 'solutions' );

get_header();

?>

	<?php the_showcase(); ?>

	<?php
	$partners = get_partners();
	if ( !empty( $partners ) ) {
	?>
    <div class="partner-logos-container">
		<div class="partner-logos">
			<?php
			foreach ( $partners as $partner ) {
				if ( has_post_thumbnail( $partner->ID ) ) { 
					?>
			<div class="slide">
				<a href="<?php print get_the_permalink( $partner->ID ); ?>">
                	<?php print get_the_post_thumbnail( $partner->ID, array( 500, 500 ) ); ?>
                </a>
			</div>
					<?php 
				} 
			}
			?>
		</div>
    </div>
	<?php
	}
	?>

	<div class="content-pad sli-pad">

		<div class="articles">
			<?php print do_shortcode( '[articles cats="gowest-solutions" /]' ); ?>
		</div>

		<div class="events">
			<a href="/events" class="all-events">All Events</a>
			<?php print do_shortcode( '[events limit=3 category="featured-events" /]' ); ?>

			<?php do_ad_group( 'strategic-link' ) ?>
		</div>

	</div>

	<?php 

	// get the slides
	$slides = get_post_meta( get_the_ID(), "simple_showcase", 1 );

	if ( !empty( $slides ) ) {
		$link = $slides[0]['link'];
		$image = $slides[0]['image'];

		?>
		<?php if ( !empty( $link ) ) print '<a href="' . $link . '">'; ?>
		<img src="<?php print $image ?>" class="simple-showcase-single" />
		<?php if ( !empty( $link ) ) print '</a>'; ?>
		<?php
	}

	?>

<?php

get_footer();

?>