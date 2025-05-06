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

if ( function_exists( 'gowest_association_lightbox' ) ) {
	if ( is_front_page() ) {
		gowest_association_lightbox();
	}
}
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
						<?php print get_snippet( 'footer-social' ) ?>
					</div>
				</div>
				<div class="column menu">
					<h4>Links</h4>
					<?php 
					print do_shortcode( '[menu id=103 /]')
					// wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu' ) ); 
					?>
				</div>
				<?php if ( !is_foundation() ) { ?>
				<div class="column subscribe">
					<?php print get_snippet( 'footer-subscribe' ); ?>
				</div>
				<?php } ?>
			</div>

			<p class="small">Copyright &copy; <?php print date( 'Y' ); ?> GoWest Credit Union Association. All Rights Reserved.</p>

		</div>
	</footer>
	<?php 
}
if ( get_the_ID() == 116984 ) {
	?>
	<script type="text/javascript">
	_linkedin_partner_id = "7236228";
	window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
	window._linkedin_data_partner_ids.push(_linkedin_partner_id);
	</script><script type="text/javascript">
	(function(l) {
	if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
	window.lintrk.q=[]}
	var s = document.getElementsByTagName("script")[0];
	var b = document.createElement("script");
	b.type = "text/javascript";b.async = true;
	b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
	s.parentNode.insertBefore(b, s);})(window.lintrk);
	</script>
	<noscript>
	<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=7236228&fmt=gif" />
	</noscript>
	<?php
}
?>

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