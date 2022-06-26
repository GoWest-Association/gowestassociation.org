<?php

/*
Template Name: Homepage
*/

get_header();

?>

	<?php the_showcase(); ?>
	
	<div class="content-wide">
		<div class="front-columns">
			<div class="front-column-content">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();
				endwhile;
			endif;
			?>
			</div>
			<div class="front-column-buttons">
				<?php print get_snippet( 'home-buttons-associations' ); ?>
			</div>
		</div>
	</div>

	<div class="content-wide icons-container grey">
		<?php the_icons(); ?>
	</div>


	<div class="content-wide front-events">
		<a href="#"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-calendar.png" class="front-events-link" /></a>
		<?php print get_snippet( 'home-events' ); ?>
	</div>

	<div class="content-wide front-columns bg-orange-circle">
		<div class="front-column-content">
			<?php print get_snippet( 'home-columns-foundations' ); ?>
		</div>
		<div class="front-column-buttons">
			<?php print get_snippet( 'home-buttons-foundations' ); ?>
		</div>
	</div>

	<div class="content-wide front-columns bg-kraken-hatch grey">
		<div class="front-column-content">
			<?php print get_snippet( 'home-columns-service-corps' ); ?>
		</div>
		<div class="front-column-buttons">
			<?php print get_snippet( 'home-buttons-service-corps' ); ?>
		</div>
	</div>

	<div class="content-wide front-columns">
		<?php the_stats(); ?>
	</div>

	<div class="front-states">
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-az.png?v=1"><h5>Arizona</h5></div>
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-co.png?v=1"><h5>Colorado</h5></div>
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-id.png?v=1"><h5>Idaho</h5></div>
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-or.png?v=1"><h5>Oregon</h5></div>
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-wa.png?v=1"><h5>Washington</h5></div>
		<div class="front-state"><img src="<?php bloginfo( "template_url" ) ?>/img/icon-state-wy.png?v=1"><h5>Wyoming</h5></div>
	</div>

<?php

get_footer();

?>