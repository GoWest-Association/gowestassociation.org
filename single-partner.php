<?php

set_brand( 'solutions' );

get_header();

the_showcase();


?>
<div class="page-title grey-dark">
	<h1><?php the_title(); ?></h1>
</div>

<div class="two-column single-partner <?php print ( has_showcase() ? '' : ' no-showcase' ) ?>" role="main">
	<div class="sidebar">
		<div class="partner-thumbnail">
			<?php the_post_thumbnail( array( 500, 500 ) ); ?>
		</div>
		<h3 class="partner-title"><?php the_title(); ?></h3>
		<p>For more information on this solution please reach out to the Strategic Link team below.</p>
		<p class="partner-buttons"><?php print do_shortcode( '[button url="mailto:strategiclink@nwcua.org" class="teal"]Email Us[/button] [button url="tel:8009959064" class="teal phone"]&#9743; 800.995.9064[/button]' ); ?></p>
		<p>Learn more about <?php the_title(); ?> by visiting their social media accounts or website below.</p>
		<div class="partner-links">
			<div class="partner-website">
				<?php print do_shortcode( '[button url="' . get_cmb_value( 'partner_website' ) . '" class="teal"]Visit Website[/button]' ); ?>
			</div>
			<div class="partner-social">
				<?php print partner_social_link( 'twitter' ); ?>
				<?php print partner_social_link( 'facebook' ); ?>
				<?php print partner_social_link( 'youtube' ); ?>
				<?php print partner_social_link( 'linkedin' ); ?>
			</div>
		</div>
	</div>
	<div class="right-column">
		<div class="right-column-inner">
		<div class="sli-breadcrumbs">
			<a href="/solutions/partners/" class="teal">All Partners</a> <span>&raquo;</span> <?php the_title() ?>
		</div>
		<?php 

		if ( is_member() ) {

			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); 
					the_content();

					// if we have a video
					if ( has_cmb_value( 'partner_video' ) ) {
						// output the video and process the oembed
						print '<div class="partner-video">' . wp_oembed_get( get_cmb_value( 'partner_video' ) ) . '</div>';
					}

					// if we have products
					if ( has_cmb_value( 'partner_products' ) ) {

						// get the products
						$products_string = get_cmb_value( 'partner_products' );

						// get the products into an array
						$products = explode( "\n", $products_string );

						// count the products
						$product_count = count( $products );

						if ( !empty( $products ) ) {

							// set counter
							$c = 1;

							// output the start of the products section
							print '<h4 class="partner-products-title">Products Offered</h4><div class="partner-products"><div class="products-column"><ul>';

							// loop through the products
							foreach ( $products as $product ) {

								// display product
								print '<li>' . $product . '</li>';

								// if we're halfway or more through the array, break to the second column.
								if ( $c == round( $product_count/2 ) ) {
									print '</ul></div><div class="products-column"><ul>';
								}

								// increment
								$c++;

							}

							// close the products section
							print '</ul></div></div>';

						}

					}
				endwhile;
			endif;

		} else {
			do_member_error(); 
		}
		?>
		</div>
	</div>

</div><!-- #content -->

<?php
if ( has_cmb_value( 'partner_tag' ) ) {
	?>
<div class="page-articles">
	<?php print do_shortcode( '[articles tags="' . get_cmb_value('partner_tag') . '" posts_per_page=3 /]' ); ?>
</div>
	<?php
}
?>

<?php

get_footer();

?>