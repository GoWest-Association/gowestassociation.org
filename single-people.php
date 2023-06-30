<?php

set_brand( 'association' );

get_header();

?>

<div class="page-title">
	<h1><?php the_title() ?></h1>
</div>
<div class="two-column bio" role="main">
	<div class="sidebar">

		<?php the_post_thumbnail( 'headshot' ); ?>
		<div class="person-info">
			<h2><?php the_title(); ?></h2>
			<?php if ( has_cmb_value( "person_pronouns" ) ) { ?><p class="pronouns">Pronouns: <?php print get_cmb_value( "person_pronouns" ); ?></p><?php } ?>
			<?php if ( has_cmb_value( "person_title" ) ) { ?><h4 class="person-title"><?php print get_cmb_value( "person_title" ); ?></h4><?php } ?>
			<?php if ( has_cmb_value( "person_organization" ) ) { ?><p><?php print get_cmb_value( "person_organization" ); ?></p><?php } ?>
			<?php if ( has_cmb_value( "person_email" ) ) { ?><p><a href="mailto:<?php print get_cmb_value( "person_email" ); ?>"><?php print get_cmb_value( "person_email" ); ?></a></p><?php } ?>
			<?php if ( has_cmb_value( "person_phone" ) ) { ?><p>Phone: <?php print get_cmb_value( "person_phone" ); ?></p><?php } ?>
			<?php if ( has_cmb_value( "person_tollfree" ) ) { ?><p>Toll-free: <?php print get_cmb_value( "person_tollfree" ); ?></p><?php } ?>
			<?php if ( has_cmb_value( "person_office" ) ) { ?><p>Office: <?php print get_cmb_value( "person_office" ); ?></p><?php } ?>
			<?php if ( has_cmb_value( "person_website" ) ) { ?><p>Website: <a href='<?php show_cmb_value( "person_website" ) ?>' target='_blank'>Visit Website</a></p><?php } ?>
			<?php if ( has_cmb_value( "person_cv" ) ) { ?><p>CV/Resume: <a href='<?php show_cmb_value( "person_cv" ) ?>' target='_blank'>Download</a></p><?php } ?>
			<p class="person-social">
				<?php if ( has_cmb_value( "person_facebook" ) ) { ?><a href='<?php show_cmb_value( "person_facebook" ) ?>' target='_blank'><img src="<?php bloginfo('template_url') ?>/img/social-partner-facebook.png" alt="Facebook" /></a><?php } ?>
				<?php if ( has_cmb_value( "person_twitter" ) ) { ?><a href='<?php show_cmb_value( "person_twitter" ) ?>' target='_blank'><img src="<?php bloginfo('template_url') ?>/img/social-partner-twitter.png" alt="Twitter" /></a><?php } ?>
				<?php if ( has_cmb_value( "person_instagram" ) ) { ?><a href='<?php show_cmb_value( "person_instagram" ) ?>' target='_blank'><img src="<?php bloginfo('template_url') ?>/img/social-partner-insta.png" alt="Instagram" /></a><?php } ?>
				<?php if ( has_cmb_value( "person_youtube" ) ) { ?><a href='<?php show_cmb_value( "person_youtube" ) ?>' target='_blank'><img src="<?php bloginfo('template_url') ?>/img/social-partner-youtube.png" alt="Youtube" /></a><?php } ?>
				<?php if ( has_cmb_value( "person_linkedin" ) ) { ?><a href='<?php show_cmb_value( "person_linkedin" ) ?>' target='_blank'><img src="<?php bloginfo('template_url') ?>/img/social-partner-linkedin.png" alt="LinkdIn" /></a><?php } ?>
			</p>
		</div>

	</div>
	<div class="right-column">
		<div class="right-column-inner">
		<?php 
		
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
		<?php the_content(); ?>
				<?php
			endwhile;
		endif;

		if ( has_cmb_value( 'person_group' ) ) print do_shortcode( '[people category="' . get_cmb_value( 'person_group' ) . '" exclude="' . get_the_ID() .  '" /]' );

		?>
		</div>
		<?php the_accordions(); ?>
	</div>
</div><!-- #content -->

<?php
if ( has_cmb_value( 'page-articles' ) ) {
	?>
<div class="page-articles">
	<?php print do_shortcode( '[articles cats="' . get_cmb_value('page-articles') . '" posts_per_page=3 /]' ); ?>
</div>
	<?php
}
?>

<?php

get_footer();

?>