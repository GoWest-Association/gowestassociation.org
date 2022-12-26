<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$admin_email = get_option( 'admin_email' );
?>
	
	</section>
	
	<?php if ( !isset( $_REQUEST['notemplate'] ) ) { ?>
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
						<a href="https://twitter.com/GoWestCUA" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-twitter.png" /></a><a href="https://www.facebook.com/GoWestCUA/" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-facebook.png" /></a><a href="https://www.youtube.com/channel/UCx4WZCnp-2losXaGN4rCHUg" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-youtube.png" /></a><a href="https://www.linkedin.com/company/gowestcua/about/" target="_blank"><img src="<?php bloginfo( 'template_url' ); ?>/img/social-linkedin.png" /></a>
					</div>
				</div>
				<div class="column menu">
					<h4>Links</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) ); ?>
				</div>
				<div class="column subscribe">
					<?php print get_snippet( 'footer-subscribe' ); ?>
				</div>
			</div>

			<p class="small">Copyright &copy; 2022 GoWest Credit Union Association. All Rights Reserved.</p>

		</div>
	</footer>
	<?php } ?>

</div><!-- #container -->

<script type="text/javascript">
(function(e,t,o,n,p,r,i){e.visitorGlobalObjectAlias=n;e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){(e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
vgo('setAccount', '252687469');
vgo('setTrackByDefault', true);
vgo('process');
</script>

<?php wp_footer(); ?>
</body>
</html>