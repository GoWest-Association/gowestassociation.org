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
				<?php wp_dropdown_categories( array(
					'show_option_all' => 'Select Category',
					'orderby' => 'name'
				) ); ?>
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
			<?php
			$args = array( 'numberposts' => 6 );
			$posts = get_posts( $args );
			?>
			<div class="title-bar navy"><h3>Top Headlines</h3></div>
			<div class="right-column-inner article-cards">

				<?php
				foreach ( $posts as $key => $a_post ) {
					if ( $key < 2 ) {  ?>
				<div class="article-card">
					<?php
					print get_the_post_thumbnail( $a_post->ID, array( 720, 480 ) );
					print '<h4><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></h4>';
					print '<p>' . get_the_excerpt( $a_post ) . '</p>';
					?>
				</div>
					<?php
					}
				}
				?>
			</div>
			<div class="title-bar navy"><h3>More News</h3></div>
			<div class="right-column-inner">

				<ul class="article-list">
				<?php
				foreach ( $posts as $key => $a_post ) {
					if ( $key >= 2 ) {  ?>
					<?php
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
					?>
					<?php
					}
				}
				?>
				</ul>
				<p><?php print do_shortcode( '[button url="/news" class="green small"]View all[/button]' ); ?></p>

			</div>
		</div>
	</div><!-- #primary -->


<?php get_footer(); ?>