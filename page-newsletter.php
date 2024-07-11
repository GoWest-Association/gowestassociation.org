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
			$args = array( 'numberposts' => get_option( 'gw_posts_top' ), 'category_name' => 'headlines' );
			$posts = get_posts( $args );
			?>
			<div class="title-bar orange"><h3>Top Headlines</h3></div>
			<div class="right-column-inner">
				<div class="article-cards">

				<?php
				foreach ( $posts as $key => $a_post ) {
					if ( $key < 2 ) { ?>
					<div class="article-card">
						<?php
						print '<a href="' . get_the_permalink( $a_post ) . '" class="no-line">' . get_the_post_thumbnail( $a_post->ID ) . '</a>';
						print '<h4><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></h4>';
						print '<p class="post-author">' . get_the_date( null, $a_post ) . '</p>';
						print '<p>' . get_the_excerpt( $a_post ) . '</p>';
						?>
					</div>
					<?php
					}
				}
				?>
				</div>
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
			<?php the_page_ads(); ?>
			<div class="title-bar grey-dark"><h3>Compliance Resources</h3></div>
			<div class="right-column-inner">
				
				<?php print get_snippet( 'compliance-newsletter' ); ?>
				<!--
				<ul class="article-list">
				<?php
				/*
				$args = array( 'numberposts' => get_option( 'gw_posts_compliance' ), 'category_name' => 'compliance-resources' );
				$posts = get_posts( $args );
				foreach ( $posts as $key => $a_post ) {
					print '<li><a href="' . get_the_permalink( $a_post ) . '">' . $a_post->post_title . '</a></li>';
				}
				*/
				?>
				</ul>
				-->

			</div>
			<div class="title-bar navy"><h3>Want More Industry News?</h3></div>
			<div class="right-column-inner">

				<p><?php print do_shortcode( '[button url="/' . date( 'Y' ) . '" class="navy small"]View all Headlines[/button]' ); ?></p>

			</div>
		</div>
		<div class="sidebar">
			<div class="widget widget_categories">
				<?php wp_dropdown_categories( array( 'show_option_all' => 'Select Category', 'value_field' => 'slug', 'class' => 'category-dropdown', 'exclude' => array( 35 ), 'orderby' => 'name' ) ); ?>
			</div>

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) : ?><!-- no sidebar --><?php endif; ?>
		</div>

	</div><!-- #primary -->


<?php 

the_footer_buttons();

get_footer();

