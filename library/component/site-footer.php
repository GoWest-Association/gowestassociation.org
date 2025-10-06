<?php

$links_menu = get_sub_field( 'nav-menu' );
$content = get_sub_field( 'content' );

?>
    <!--- footer --->
	<footer class="footer">
		<div class="footer-inner">
		
			<p class="phone">
				<a href="tel:8009959064">800.995.9064</a>
			</p>

			<div class="columns">
				<div class="column address">
					<?php print get_snippet( 'footer-address-one' ); ?>
				</div>
				<div class="column address">
					<?php print get_snippet( 'footer-address-two' ); ?>
					<div class="social">
						<?php print get_snippet( 'footer-social' ) ?>
					</div>
				</div>
				<div class="column menu">
					<h4>Links</h4>
					<?php
                    if ( !empty( $links_menu ) ) {
                        wp_nav_menu( array(
                            'menu' => $links_menu
                        ) );
                    } else {
                        print do_shortcode( '[menu id=103 /]');
                    }
					// wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) ); 
					?>
				</div>
				<?php if ( !is_foundation() ) { ?>
				<div class="column subscribe">
					<?php 
                    if ( !empty( $content ) ) {
                        print $content;
                    } else {
                        print get_snippet( 'footer-subscribe' ); 
                    }
                    ?>
				</div>
				<?php } ?>
			</div>

			<p class="small">Copyright &copy; <?php print date( 'Y' ); ?> GoWest Credit Union Association. All Rights Reserved.</p>

		</div>
	</footer>
	<!--- /footer --->
