<?php
/*
Template Name: Newsletter
*/

set_brand( 'newsletter' );

get_header(); 

the_showcase();

?>

	<div class="two-column newsletter reverse" role="main">
		<div class="right-column">
			<?php
			$args = array( 'numberposts' => get_option( 'gw_posts_top' ) );
			$posts = get_posts( $args );
			?>
			<div class="title-bar orange"><h3>Top Headlines</h3></div>
			<div class="right-column-inner article-cards">

				<?php
				foreach ( $posts as $key => $a_post ) {
					if ( $key < 2 ) { ?>
				<div class="article-card">
					<?php
					print '<a href="' . get_the_permalink( $a_post ) . '">' . get_the_post_thumbnail( $a_post->ID, array( 720, 480 ) ) . '</a>';
					print '<h4><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></h4>';
					print '<p>' . get_the_excerpt( $a_post ) . '</p>';
					?>
				</div>
					<?php
					}
				}
				?>

				<ul class="article-list">
				<?php
				foreach ( $posts as $key => $a_post ) {
					if ( $key >= 2 ) { 
						print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
					}
				}
				?>
				</ul>

			</div>
			<div class="title-bar green"><h3>Regional Member News</h3></div>
			<div class="right-column-inner">

				<ul class="article-list">
				<?php
				$args = array( 'numberposts' => get_option( 'gw_posts_member' ), 'category_name' => 'regional-member-news' );
				$posts = get_posts( $args );
				foreach ( $posts as $key => $a_post ) {
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
				}
				?>
				</ul>

			</div>
			<div class="title-bar grey-dark"><h3>Compliance Resources</h3></div>
			<div class="right-column-inner">

				<ul class="article-list">
				<?php
				$args = array( 'numberposts' => get_option( 'gw_posts_compliance' ), 'category_name' => 'compliance-resources' );
				$posts = get_posts( $args );
				foreach ( $posts as $key => $a_post ) {
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
				}
				?>
				</ul>
				<p><?php print do_shortcode( '[button url="/2023" class="navy small"]View all News[/button]' ); ?></p>

			</div>
		</div>
		<div class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>

	</div><!-- #primary -->


<?php get_footer(); ?>