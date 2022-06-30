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
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>
		<div class="right-column">
			<?php
			$args = array( 'numberposts' => 6 );
			$posts = get_posts( $args );
			?>
			<div class="title-bar orange"><h3>Top Headlines</h3></div>
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
					if ( $key >= 2 ) { 
						print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
					}
				}
				?>
				</ul>
				<p><?php print do_shortcode( '[button url="/news/" class="navy small"]View all[/button]' ); ?></p>

			</div>
			<div class="title-bar green"><h3>Regional Member News</h3></div>
			<div class="right-column-inner">

				<ul class="article-list">
				<?php
				$args = array( 'numberposts' => 3, 'category_name' => 'regional-member-news	' );
				$posts = get_posts( $args );
				foreach ( $posts as $key => $a_post ) {
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
				}
				?>
				</ul>
				<p><?php print do_shortcode( '[button url="/category/around-the-nw/" class="navy small"]View all[/button]' ); ?></p>

			</div>
			<div class="title-bar grey-dark"><h3>Compliance Resources</h3></div>
			<div class="right-column-inner">

				<ul class="article-list">
				<?php
				$args = array( 'numberposts' => 3, 'category_name' => 'compliance-resources' );
				$posts = get_posts( $args );
				foreach ( $posts as $key => $a_post ) {
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
				}
				?>
				</ul>
				<p><?php print do_shortcode( '[button url="/category/compliance/" class="navy small"]View all[/button]' ); ?></p>

			</div>
		</div>
	</div><!-- #primary -->


<?php get_footer(); ?>